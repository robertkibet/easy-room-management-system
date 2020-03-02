<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Created by PhpStorm.
 * User: Kibet
 * Date: 3/4/2019
 * Time: 10:21 AM
 */
class Rentals_model extends CI_Model
{
    public function save_rates()
    {
        $house = $this->input->post('house', true);
        $monthly = $this->input->post('monthly', true);
        $daily = $this->input->post('daily', true);

        $check = $this->db->query("select * from tbl_rentals_rates where suite='$house'")->result_array();
        if (count($check) > 0) {
            echo json_encode('exists');
        } else {
            $user = $this->session->all_userdata();
            $usr = $user['id'];
            $data = array(
                'suite' => $house,
                'monthly' => $monthly,
                'daily' => $daily,
                'addedby' => $usr
            );
            $this->db->insert('tbl_rentals_rates', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode('success');
            } else {
                echo json_encode('failed');
            }
        }
    }

    public function make_payments()
    {
        $paymenttype = $this->input->post('paymenttype', true);
        $amountpaid = $this->input->post('amountpaid', true);
        $rented_hse = $this->input->post('rented_hse', true);
        $dailyamt = $this->input->post('dailyamt', true);
        $check = $this->db->query("select * from tbl_rental_payments where rented_house ='$rented_hse'")->result_array();
        if (count($check) > 0) {
            $payment = 'progressive';
        } else {
            $payment = 'initial';
        }
        if ($amountpaid > $dailyamt) {
            $user = $this->session->all_userdata();
            $usr = $user['id'];

            $data = array(
                'rented_house' => $rented_hse,
                'amount' => $amountpaid,
                'paymenttype' => $payment,
                'addedby' => $usr
            );
            $getdetails = $this->db->query("select * from tbl_rentals_reservations where id='$rented_hse'")->row();
            $room = $getdetails->room;
            $amountreceived = $this->db->query("select sum(amount) as amountpaid from tbl_rental_payments where rented_house='$rented_hse'")->row();
            $grosstotal = $getdetails->dailyrent * $getdetails->stayduration;
            $amt = ($amountreceived->amountpaid == null) ? 0 : $amountreceived->amountpaid;
            $bal = $grosstotal - $amt;

            if ($payment === 'progressive' && $amountpaid > $bal) {
                echo 'balanced_out';
            } else if ($amountpaid > $grosstotal) {
                echo 'failed_payment';
            } else {
                $this->db->insert('tbl_rental_payments', $data);
                if ($this->db->affected_rows() > 0) {
                    echo 'success';
                } else {
                    echo 'failed';
                }
            }
        } else {
            echo 'required_deposit';
        }

    }

    public function make_rental_booking()
    {
        $room = $this->input->post('typeofroom', true);
        $selectroom = $this->input->post('selectroom', true);
        $datefrom = $this->input->post('datefrom', true);
        $dateto = $this->input->post('dateto', true);
        $bookingnature = $this->input->post('bookingnature', true);
        $stayduration = $this->input->post('stayduration', true);
        $rent = $this->input->post('rent', true);
        $checkroom = $this->db->query("select * from bookings where room ='$selectroom' and active='1'")->result_array();
        if (count($checkroom) > 0) {
            echo 'booked_as_regular';
        } else {
            if (strlen($datefrom) === 0) {
                echo 'enter_checkin';
            } else if (strlen($dateto) === 0) {
                echo 'enter_checkout';
            } else {

                $datetoday = strtotime(Date('m/d/Y'));

                $enddate = strtotime($dateto);
                $startdate = strtotime($datefrom);

                $datediff = $enddate - $startdate;

                $datedifference = round($datediff / (60 * 60 * 24));

                $days = $datediff / (60 * 60 * 24);

                if ($days < 2) {
                    $days = 1;
                }

                if ($datetoday > $startdate) {
                    echo 'start_greater_than_today';
                } else if ($datetoday > $enddate) {
                    echo 'start_greater_than_today';

                } else if ($datedifference < 0) {
                    echo 'invalid_request';
                } else if ($datedifference < 20) {
                    echo 'categorized_as_booking';
                } else {
                    $check = $this->db->query("select * from tbl_rentals_rates where suite='$room'")->result_array();
                    if (count($check) < 1) {
                        echo 'missing';
                    } else {
                        $get = $this->db->query("select * from tbl_rentals_rates where suite='$room' limit 1")->row();

                        $pricingrate = $get->monthly;
                        $pricing = $rent;
                        $suite = $this->input->post('selectroom', true);

                        $checkroom = $this->db->query("select * from bookings where room ='$suite' and active ='1' ")->result_array();
                        if (count($checkroom) > 0) {
                            echo 'room_already_booked';
                        } else {

                            $gethse = $this->db->query("SELECT * FROM  tbl_rooms_types WHERE id='$room'")->row();
                            $roomtype = $gethse->roomtype;
                            $dailypricing = $pricing / 30;
//                        $totalpricing = $datedifference * $dailypricing;
                            $mydata = $this->session->all_userdata();

                            $data = array(
                                'suite' => $room,
                                'room' => $selectroom,
                                'datefrom' => $datefrom,
                                'dateto' => $dateto,
//                            'bookingnature' => $bookingnature,
                                'stayduration' => $days,
                                'monthlyrent' => $pricing,
                                'start_billing' => date('Y-m-d'),
                                'dailyrent' => $dailypricing,
                                'roomtype' => $roomtype,
                                'addedby' => $mydata['id']
                            );
                            $checkbooking = $this->db->query("select * from tbl_rentals_reservations where room ='$selectroom' and status=0")->result_array();
                            if (count($checkbooking) > 0) {
                                echo 'room_already_booked';
                            } else {
                                $this->db->query("update tbl_rooms set booked='1' where id='$selectroom' limit 1");

                                $this->db->insert('tbl_rentals_reservations', $data);
                                if ($this->db->affected_rows() > 0) {
                                    $id = $this->db->insert_id();
//                                if ($datetoday === $startdate) {
                                    echo 'collect_rent/' . $id;
//                                } else {
//                                    echo 'collect_deposit/' . $id;
//                                }
                                } else {
                                    echo 'failed';
                                }
                            }

                        }
                    }
                }
            }
        }
    }

}