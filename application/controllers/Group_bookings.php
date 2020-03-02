<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_bookings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Africa/Nairobi");
        $this->load->add_package_path(APPPATH . 'third_party/fpdf');
        $this->load->library('pdf');

        $this->load->model('group_bookings_model');

        if ($this->session->userdata('client_is_logged_in')) {
            $this->client_is_logged_in = true;
        } else {
            redirect('login');
        }


    }

    public function manage()
    {
        $this->load->view('group/manage');
    }

    public function mark_as_complete()
    {
        $bookingid = $this->input->post('bookingid', true);
        $rooms = $this->db->query("select * from tbl_group_bookings where id  in ('$bookingid')")->result_array();
        foreach ($rooms as $rmss):

            $roombooked = $rmss['rooms'];
//            echo 'rms-'.$roombooked;

            $this->db->query("update tbl_rooms set booked =0 where id in ($roombooked)");
//            echo 'step1 -'.$this->db->affected_rows();

            $this->db->query("update tbl_group_bookings set status =0 where id = ($bookingid)");
//            echo 'step2 -'.$this->db->affected_rows();
//            if ($this->db->affected_rows() > 0) {
//            } else {
//                echo json_encode('failed');
//            }
        endforeach;
        echo json_encode('success');


    }

    public function fetchrooms_booked()
    {
        $bookingid = $this->input->post('bookingid', true);
        $rooms = $this->db->query("select * from tbl_group_bookings where id ='$bookingid'")->row();
        $roombooked = $rooms->rooms;

        $fetch = $this->db->query("select * from tbl_rooms where id in ($roombooked)")->result_array();
        $data = '
<center><h4>BOOKED ROOMS</h4></center>
<table class="table table-hover" >
                <thead><th><center>ROOMS</center></th></thead>
                <tbody>';

        foreach ($fetch as $rms):
            $data .= '      <tr><td>' . strtoupper($rms['roomnumber']) . '</td></tr>';
        endforeach;
        $data .= '
</tbody>
</table>';
        echo $data;


    }

    public function make_booking()
    {
        $this->load->view('group/bookings');
    }

    public function getrates()
    {
        $selectedroom = $this->input->post('selectedroom', true);
        $getroom = $this->db->query("select * from tbl_rooms where id='$selectedroom'")->row();
        $roomprice = $getroom->amountperperson;
        $roomnumber = $getroom->roomnumber;
        $estate = $getroom->estateid;
        $suite = $getroom->roomtype;

        $getsuite = $this->db->query("select * from tbl_rooms_types where id='$suite'")->row();
        $suitename = $getsuite->roomtype;

        echo '    <tr>
                    <td>' . $suitename . '</td>
                    <td>' . $roomnumber . '</td>
                    <td>' . $roomprice . ' p/p</td>
                  </tr>';
    }

    public function save_booking_details()
    {
        $this->group_bookings_model->save_booking_details();
    }

    public function save_booking_details_completed()
    {
        $this->group_bookings_model->save_booking_details_completed();
    }

    public function getRooms()
    {
        $id = $this->input->post('estate', true);
        $type = $this->input->post('typeofroom', true);

        $rooms = $this->db->query("select id,roomnumber from tbl_rooms where estateid='$id' and roomtype='$type' and booked='0' order by roomtype asc");
        $response = $rooms->result_array();
        $rms = '';
        foreach ($response as $room):
            $rms .= '
                                        <div class="col-md-4">
                                            <label>
													<input type="checkbox" class="control-primary" value="' . $room['id'] . '">
													' . strtoupper($room['roomnumber']) . '
                                            </label>
                                        </div> 
                                    ';
        endforeach;
        echo $rms;
    }
}
