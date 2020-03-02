<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Kibet
 * Date: 3/4/2019
 * Time: 10:19 AM
 */
class Rental extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('rentals_model');
        $this->load->add_package_path(APPPATH . 'third_party/fpdf');
        $this->load->library('pdf');
        if ($this->session->userdata('client_is_logged_in')) {
            $this->client_is_logged_in = true;
        } else {
            redirect('login');
        }

    }
    public function houses(){
        $header=$this->uri->segment(3);
        if($header==='save_rates'){
            $this->rentals_model->save_rates();
        }if($header==='reservations'){
            $this->load->view('rentals/reserve');
        }else if($header==='make_rental_booking'){
            $this->rentals_model->make_rental_booking();
        }else if($header==='collect_rent'){
            $this->load->view('rentals/rent_collection');
        }else if($header==='make_payments'){
            $this->rentals_model->make_payments();

        }else {
            $this->load->view('rentals/manage');
        }
    }
    public function release_house(){
        $rental=$this->input->post('rental', true);
        $getdetails = $this->db->query("select * from tbl_rentals_reservations where id='$rental'")->row();
        $room = $getdetails->room;
        $amountreceived = $this->db->query("select sum(amount) as amountpaid from tbl_rental_payments where rented_house='$rental'")->row();
        $grosstotal = $getdetails->dailyrent * $getdetails->stayduration;
        $amt = ($amountreceived->amountpaid==null)?0:$amountreceived->amountpaid;
        $bal = $grosstotal - $amt;
        if($bal>0){
            echo json_encode('failed');
        }else{
            $this->db->query("update tbl_rentals_reservations set status=1, paymentcompleted=1 where id='$rental'  limit 1");
            if($this->db->affected_rows()===1){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }

    }
    public function release_house_forced(){
        $rental=$this->input->post('rental', true);
        $this->db->query("update tbl_rentals_reservations set status=2 where id='$rental' limit 1");
        if($this->db->affected_rows()===1){
            echo json_encode('success');
        }else{
            echo json_encode('failed');
        }

    }
    public function mark_as_complete(){
        $rental=$this->input->post('rental', true);
        $getdetails = $this->db->query("select * from tbl_rentals_reservations where id='$rental'")->row();
        $room = $getdetails->room;
        $amountreceived = $this->db->query("select sum(amount) as amountpaid from tbl_rental_payments where rented_house='$rental'")->row();
        $grosstotal = $getdetails->dailyrent * $getdetails->stayduration;
        $amt = ($amountreceived->amountpaid==null)?0:$amountreceived->amountpaid;
        $bal = $grosstotal - $amt;
        if($bal>0){
            echo json_encode('failed');
        }else{
            $this->db->query("update tbl_rentals_reservations set status=1, paymentcompleted=1 where id='$rental'  limit 1");
            if($this->db->affected_rows()===1){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }

    }
    public function mark_as_complete_forced(){
        $rental=$this->input->post('rental', true);
        $this->db->query("update tbl_rentals_reservations set status=2, paymentcompleted=1 where id='$rental'  limit 1");
        if($this->db->affected_rows()===1){
            echo json_encode('success');
        }else{
            echo json_encode('failed');
        }

    }
    public function reservations(){
        $header=$this->uri->segment(3);
        $rented_hse=$this->uri->segment(4);
        if($header==='payments'){
            $checkdata = $this->db->query("select * from tbl_rental_payments where rented_house='$rented_hse'")->result_array();
            if (count($checkdata) > 0) {
                $getdetails = $this->db->query("select * from tbl_rentals_reservations where id='$rented_hse'")->row();
                $room = $getdetails->room;
                $amountreceived = $this->db->query("select sum(amount) as amountpaid from tbl_rental_payments where rented_house='$rented_hse'")->row();
                $grosstotal = $getdetails->dailyrent * $getdetails->stayduration;
                $amt = ($amountreceived->amountpaid == null) ? 0 : $amountreceived->amountpaid;
                $bal = $grosstotal - $amt;
                if ($bal < 2) {
                    $this->db->query("update tbl_rentals_reservations set status=1, paymentcompleted=1 where id='$rented_hse'  limit 1");
                }
            }
            $this->load->view('rentals/payments_history');
        }else {
            $this->load->view('rentals/reservations');
        }

    }
    public function reports(){
        $header=$this->uri->segment(3);
        if($header==='print_single_rental'){
            $tcpdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $tcpdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '', array(0, 0, 0), array(255, 255, 255));

            $tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

//        $tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);

            $tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            $tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            $tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            $tcpdf->AddPage();
            $uriheader=$this->uri->segment(4);
            $getalldata = $this->db->query("select * from tbl_rental_payments where rented_house='$uriheader'")->result_array();

            if (count($getalldata) < 1) {
                $this->load->view('rentals/payments_history', array('error'=>'No record found'));

            } else {
                $url = $this->uri->segment(4);
                $getdetails = $this->db->query("select * from tbl_rentals_reservations where id='$uriheader'")->row();
                $room = $getdetails->room;
                $suitestatus = $getdetails->status;
                $completed = $getdetails->paymentcompleted;
                $suite = $getdetails->suite;
                $getrental = $this->db->query("select * from tbl_rentals_rates where suite='$suite'")->row();
                $getsuite = $this->db->query("select * from tbl_rooms_types where id='$suite'")->row();
                $roomtype = $getsuite->roomtype;
                $estateid = $getsuite->estateid;
                $getestate = $this->db->query("select * from tbl_estates where id='$estateid'")->row();
                $estate = $getestate->estatename;
                $getroom = $this->db->query("select * from tbl_rooms where id='$room'")->row();
                $roomnumber = $getroom->roomnumber;
                $amountreceived = $this->db->query("select sum(amount) as amountpaid from tbl_rental_payments where rented_house='$uriheader'")->row();
                $grosstotal = $getdetails->dailyrent * $getdetails->stayduration;
                $balance = $grosstotal - $amountreceived->amountpaid;

                                    if ($suitestatus == 2) {
                                        $txt = 'CANCELLED';
                                    } else if ($suitestatus == 1 && $completed == 1) {
                                        $txt = 'COMPLETED';
                                    } else {
                                        $txt = 'ACTIVE';
                                    }
                $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
<br>
RATES : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES.' . number_format($getdetails->dailyrent) . 'pd / KES.' . number_format($getdetails->monthlyrent) . 'pm</i>
<br>
DURATION : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($getdetails->stayduration) . ' days</i>
<br>
RECEIVED : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($amountreceived->amountpaid) . '</i>
<br>
BALANCE : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($balance) . '</i>
<br>
STATUS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . $txt. '</i>
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">SUITE: ' . strtoupper($roomnumber) . '</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th><h5 style="font-size: 10px;">AMOUNT</h5></th>
                        <th><h5 style="font-size: 10px;">PAYMENT TYPE</h5></th>
                        <th><h5 style="font-size: 10px;">ADDED BY</h5></th>
                        <th><h5 style="font-size: 10px;">DATE</h5></th>
                    </tr>
                
                ';

                if (count($getalldata) > 0) {
                    $i = 0;

                    foreach ($getalldata as $alldata):

                        $i++;
                        $user = $alldata['addedby'];
                        $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$user'")->row();
                        $phone = $addedby->phone;

                        if ($i % 2 == 0) {
                            $bgcolor = 'background-color: #fff;';
                        } else {
                            $bgcolor = 'background-color: #ebebeb;';
                        }

                        $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>KES. ' . number_format($alldata['amount']) . '</td>
                                <td>' . $alldata['paymenttype'] . '</td>
                                <td>' . $phone . '</td>
                                <td>' . $alldata['dateadded'] . '</td>

                            </tr>
                            
                ';
                    endforeach;
                } else {
                    $this->load->view('rentals/payments_history', array('error'=>'No record found'));
                }


                $set_html .= '        
            </table>



</body>

</html>

        
        ';

                //Print content utilizing writeHTMLCell()
                $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', false);

                $record = date('ymdh');
                // Close and yield PDF record
                // This technique has a few choices, check the source code documentation for more data.
                $tcpdf->Output($roomnumber.'_payments_'. $record . '_.pdf', 'D');
                // successfully created CodeIgniter TCPDF Integration

            }
        }
    }
    public function getrates()
    {
        $room = $this->input->post('typeofroom', true);
        $datefrom = $this->input->post('datefrom', true);
        $dateto = $this->input->post('dateto', true);

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
            } else if($datedifference<20){
                echo 'categorized_as_booking';
            }else{

                $check = $this->db->query("select * from tbl_rentals_rates where suite='$room'")->result_array();
                if (count($check) < 1) {
                    echo 'missing';
                } else {
                    $get = $this->db->query("select * from tbl_rentals_rates where suite='$room' limit 1")->row();
                    $pricing = $get->monthly;
                    $suite = $this->input->post('selectroom', true);

                    $checkroom = $this->db->query("select * from bookings where room ='$suite' and active ='1' ")->result_array();
                    if (count($checkroom) > 0) {
                        echo 'room_already_booked';
                    } else {

                        $gethse = $this->db->query("SELECT * FROM  tbl_rooms_types WHERE id='$room'")->row();
                        $roomtype = $gethse->roomtype;
                        $dailypricing = $pricing/30;
                        $totalpricing = $datedifference * $dailypricing;

                        $rates = '';
                        $rates .= '
                <table class="table table-hover">
                    
                    <tbody>
                      <tr>
                        <td>' . ucwords($roomtype) . '</td>
                        <td>KES. ' . number_format($pricing) . '</td>
                      </tr>
                      <tr>
                        <td>Duration</td>
                        <td>'.number_format($datedifference).' days</td>
                      </tr>
                      <tr>
                        <td>Daily Rates</td>
                        <td>KES '.number_format($dailypricing).'</td>
                      </tr>
                      <tr>
                        <td>Total Amount</td>
                        <td>KES. '.number_format($totalpricing).'</td>
                      </tr>
                    </tbody>
                </table>
                  <br>
                  <p>The client will be billed a minimum of <strong>KES. ' . number_format($pricing) . '</strong> every month as <strong>RENT</strong>.<br>
                  This is as from the date <strong>' . $datefrom . '</strong>  to <strong>' . $dateto . '</strong>
                  </p>
                ';

                        echo $rates;
                    }
                }
            }
        }
    }

    public function getRooms()
    {
        $type = $this->input->post('typeofroom', true);

//        $response = array();
        $rooms = $this->db->query("select id,roomnumber from tbl_rooms where roomtype='$type' order by roomnumber asc");
        $response = $rooms->result_array();

        echo json_encode($response);
    }
}