<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Kibet
 * Date: 2/14/2019
 * Time: 8:30 PM
 */
class Main_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Africa/Nairobi");

        $this->mydata=$this->session->all_userdata();


    }
    public function save_rates(){
        $housetype=$this->input->post('housetype', true);
        $rent=$this->input->post('rent', true);

        $check=$this->db->query("select * from tbl_rentals_rates where house_type='$housetype'")->result_array();
        if(count($check)>0){
            echo json_encode('exists');
        }else{
            $us=$this->session->all_userdata();
            $user=$us['id'];
            $data=array(
                'house_type'=>$housetype,
                'monthly'=>$rent,
                'addedby'=>$user
            );
            $this->db->insert('tbl_rentals_rates', $data);
            if($this->db->affected_rows()>0){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }
    }
    public function make_rental_booking(){
        $estates = $this->input->post('estates', true);
        $typeofroom = $this->input->post('typeofroom', true);
        $selectroom = $this->input->post('selectroom', true);
        $stayduration = $this->input->post('stayduration', true);
        $calendar = $this->input->post('calendar', true);
        $agreementsigned = $this->input->post('agreementsigned', true);
        $rent = $this->input->post('rent', true);

        $get = $this->db->query("select * from tbl_rentals_rates where house_type='$typeofroom' limit 1")->row();
        $pricing = $get->monthly;

        $discount = $pricing - $rent;
        $discount2 = $rent - $pricing;

        if($discount>10000 || $discount2 > 10000){
            echo 'discount_is_alot';
        }else{
            $checkroom = $this->db->query("select * from bookings where room ='$selectroom' and active ='1' ")->result_array();
            if (count($checkroom) > 0) {
                echo 'room_already_booked';
            } else {
                $us=$this->session->all_userdata();
                $user=$us['id'];
                $data = array(
                  'estate'=>$estates,
                  'typeofroom'=>$typeofroom,
                  'selectroom'=>$selectroom,
                  'stayduration'=>$stayduration,
                  'calendar'=>$calendar,
                  'agreementsigned'=>$agreementsigned,
                  'rent'=>$rent,
                  'status'=>1,
                  'added_by'=>$user
                );
                $check = $this->db->query("select * from tbl_rentals_rates where house_type='$typeofroom'")->result_array();
                if (count($check) > 0) {
                    echo 'room_already_booked';
                } else {
                    $this->db->insert('tbl_reserved_rentals', $data);
                    if ($this->db->affected_rows() > 0) {
                        echo 'success';
                    } else {
                        echo 'failed';
                    }
                }
            }

        }
    }

    function get_items()
    {
        $this->db->order_by("it_created", "asc");
        $result = $this->db->get("d_items");
        return $result->result_array();
    }

    public function update_details()
    {
        $firstname = $this->input->post('firstname', true);
        $lastname = $this->input->post('lastname', true);
        $phone = $this->input->post('phone', true);
        $email = $this->input->post('email', true);
        $id = $this->mydata['id'];

        $this->db->query("update system_users set firstname='$firstname', lastname='$lastname', phone='$phone', email='$email' where id='$id' limit 1");
        if ($this->db->affected_rows() > 0) {
            echo json_encode('added');
        } else {
            echo json_encode('failed');
        }
    }

    public function update_password()
    {
        $newpassword = sha1($this->input->post('newpassword', true));
        $id = $this->mydata['id'];
        $this->db->query("update system_users set password='$newpassword' where id='$id' limit 1");
        if ($this->db->affected_rows() > 0) {
            $this->session->sess_destroy();
            echo json_encode('added');
        } else {
            echo json_encode('failed');
        }
    }

    public function save_user()
    {
        $firstname = $this->input->post('firstname', true);
        $lastname = $this->input->post('lastname', true);
        $phone = $this->input->post('phone', true);
        $role = $this->input->post('role', true);
        $password = $this->input->post('password', true);

        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'role' => $role,
            'password' => sha1($password)
        );
        $users = $this->db->where('phone', $phone)->count_all_results('system_users');
        if ($users < 1) {

            $this->db->insert('system_users', $data);

            if ($this->db->affected_rows() > 0) {
                echo json_encode('user_added');
            } else {
                echo json_encode('failed_to_add_user');
            }
        } else {
            echo json_encode('exists');
        }
    }

    public function save_estate()
    {
        $estatename = $this->input->post('estatename', true);
        $estatelocation = $this->input->post('estatelocation', true);
        $mydata = $this->session->all_userdata();

        $data = array(
            'estatename' => $estatename,
            'estatelocation' => $estatelocation,
            'addedby' => $mydata['id']
        );
        $users = $this->db->like('estatename', $estatename)->count_all_results('tbl_estates');
        if ($users < 1) {

            $this->db->insert('tbl_estates', $data);

            if ($this->db->affected_rows() > 0) {
                echo json_encode('added');
            } else {
                echo json_encode('failed_to_add');
            }
        } else {
            echo json_encode('exists');
        }
    }

    public function save_room_images_step_2()
    {
        if (!empty($_FILES)) {
            $room = $this->uri->segment(4);
            $roomnumbers =$this->db->query("select * from tbl_rooms where id='$room'")->row();
            $thisroom = $roomnumbers->roomnumber;
            $imgpath = 'uploads/rooms/' . str_replace(' ', '_', str_replace('-','_', $thisroom));
            if (!is_dir($imgpath)) //create the folder if it's not already exists
            {
                mkdir($imgpath, 0755, TRUE);
            }
            $path_parts = pathinfo($_FILES["file"]["name"]);
            $file_name = md5($path_parts['filename'] . '.' . $path_parts['extension']);
            $image_path = $file_name . '.' . $path_parts['extension'];
            move_uploaded_file($file_tmp = $_FILES["file"]["tmp_name"], $imgpath . "/" . $image_path);
            $newpath = $imgpath . "/" . $image_path; //path of file to save to DB
            $mydata = $this->session->all_userdata();
            //if you want to save in db,where here
            // with out model just for example
            $this->db->insert('tbl_rooms_images', array(
                'filepath' => $newpath,
                'filename' => $file_name,
                'roomid' => $room,
                'uploadedby' => $mydata['id']
            ));
            if ($this->db->affected_rows() > 0) {
                echo 'image_added';
            } else {
                echo 'image_failed_to_add';
            }


        }
    }

    public function make_booking()
    {
        $estate = $this->input->post('estates', true);
        $typeofroom = $this->input->post('typeofroom', true);
        $selectroom = $this->input->post('selectroom', true);
        $billing = $this->input->post('billing', true);

        $residentsnumber = $this->input->post('residentsnumber', true);
        $datefrom = $this->input->post('datefrom', true);
        $dateto = $this->input->post('dateto', true);
//        $checkin = $this->input->post('checkin', true);
        $paymentcompleted = $this->input->post('paymentcompleted', true);
        $agreementsigned = $this->input->post('agreementsigned', true);
        $amountpaid = $this->input->post('amountpaid', true);
//        echo strlen($datefrom).' to '. strlen($dateto);
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
            } else {
                $rooms = $this->db->query("select * from tbl_rooms where id=$selectroom and estateid=$estate limit 1");
                $response = $rooms->row();
//                echo $estate.'-'.$selectroom;

//                $getestate = $this->db->query("select estatename from tbl_estates where id='$estate' limit 1")->row();
                $roomcharges = $billing;// used billing to cater for discounts
                $totalvisitors = $residentsnumber;
                $numberofdays = $days;
                if ($typeofroom == 1) {
                    $totalcharges = $roomcharges * $totalvisitors * $numberofdays;

                } else {
                    $totalcharges = $roomcharges * $numberofdays;
                }
//                echo $totalcharges.'-'.$amountpaid;

                if ($amountpaid < $totalcharges) {
                    echo 'failed_amount';
                } else {
                    $maxpeople = $response->maxpeople;
                    $minpeople = $response->minpeople;
                    if ($residentsnumber > $maxpeople) {
                        echo 'max_limit';
                    } else if ($residentsnumber < $minpeople) {
                        echo 'min_limit';
                    } else {
                        $mydata = $this->session->all_userdata();
                        $user = $mydata['phone'];

                        $data = array(
                            'estate' => $estate,
                            'suite' => $typeofroom,
                            'room' => $selectroom,
                            'visitors' => $residentsnumber,
                            'checkin' => $datefrom,
                            'checkout' => $dateto,
                            'billing' => $billing,
                            'paymentcompleted' => 'true',
                            'agreementsigned' => 'true',
                            'amountpaid' => $amountpaid,
                            'days' => $days,
                            'servedby' => $user,
                        );
                        $checkrooms = $this->db->query("select * from bookings where room='$selectroom' and  estate='$estate' and active='1' ")->result_array();
                        if (count($checkrooms) > 0) {
                            echo 'room_already_booked';
                        } else {
                            $this->db->query("update tbl_rooms set booked='1' where id='$selectroom' limit 1");

                            $this->db->insert('bookings', $data);
                            if ($this->db->affected_rows() === 1) {
                                $id = $this->db->insert_id();
                                echo $id;

                            } else {
                                echo 'failed_insert';
                            }
                        }
                    }
                }


            }
        }
    }

    public function saveroom_step1()
    {
        $roomnumber = $this->input->post('roomnumber', true);
        $maxpeople = $this->input->post('maxpeople', true);
        $typeofroom = $this->input->post('typeofroom', true);
        $minpeople = $this->input->post('minpeople', true);
        $estateid = $this->input->post('estates', true);
        $amountperperson = $this->input->post('amountperperson', true);
        $mydata = $this->session->all_userdata();

        $data = array(
            'roomnumber ' => $roomnumber,
            'maxpeople' => $maxpeople,
            'minpeople' => $minpeople,
            'estateid' => $estateid,
            'roomtype' => $typeofroom,
            'amountperperson' => $amountperperson,
            'addedby' => $mydata['id']
        );
        $rooms = $this->db
            ->where('roomnumber', $roomnumber)
            ->where('roomtype ', $typeofroom)
            ->count_all_results('tbl_rooms');
        if ($rooms < 1) {

            $this->db->insert('tbl_rooms', $data);

            if ($this->db->affected_rows() > 0) {
                $room = $this->db->insert_id();
                echo json_encode(base_url('welcome/rooms/add_room_images_step_2/' . $room));
            } else {
                echo json_encode('failed_to_add');
            }
        } else {
            echo json_encode('exists');
        }
    }

    public function save_room_type()
    {
        $roomtype = $this->input->post('roomtype', true);
        $estatelocation = $this->input->post('estatelocation', true);
        $mydata = $this->session->all_userdata();

        $data = array(
            'roomtype ' => $roomtype,
            'estateid' => $estatelocation,
            'addedby' => $mydata['id']
        );
        $users = $this->db->where('estateid', $estatelocation)->like('roomtype ', $roomtype)->count_all_results('tbl_rooms_types');
        if ($users < 1) {

            $this->db->insert('tbl_rooms_types', $data);

            if ($this->db->affected_rows() > 0) {
                echo json_encode('added');
            } else {
                echo json_encode('failed_to_add');
            }
        } else {
            echo json_encode('exists');
        }

    }
}