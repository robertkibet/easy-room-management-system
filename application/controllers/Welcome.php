<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Africa/Nairobi");
        $this->load->add_package_path(APPPATH . 'third_party/fpdf');
        $this->load->library('pdf');

        $this->load->model('main_model');

        if ($this->session->userdata('client_is_logged_in')) {
            $this->client_is_logged_in = true;
        } else {
            redirect('login');
        }


    }

    public function getrates()
    {
        $room = $this->input->post('typeofroom', true);
        $check = $this->db->query("select * from tbl_rentals_rates where house_type='$room'")->result_array();
        if (count($check) < 1) {
            echo 'missing';
        } else {
            $get = $this->db->query("select * from tbl_rentals_rates where house_type='$room' limit 1")->row();
            $pricing = $get->monthly;
            $suite = $this->input->post('selectroom', true);

            $checkroom = $this->db->query("select * from bookings where room ='$suite' and active ='1' ")->result_array();
            if (count($checkroom) > 0) {
                echo 'room_already_booked';
            } else {
//            $checkroom2 = $this->db->query("select * from tbl_rentals where room ='$suite' and active ='1' ")->result_array();


                $gethse = $this->db->query("SELECT * FROM  tbl_rooms_types WHERE id='$room'")->row();
                $roomtype = $gethse->roomtype;

                $rates = '';
                $rates .= '
                <table class="table table-hover">
    <thead>
      <tr>
        <th>HOUSE</th>
        <th>MONTHLY RATES</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>' . ucwords($roomtype) . '</td>
        <td>KES. ' . number_format($pricing) . '</td>
      </tr>
    </tbody>
  </table>
                      <br>
                      <p>The client will be billed a minimum of <strong>KES. ' . number_format($pricing) . '</strong> every month as <strong>RENT</strong>.</p>
                ';

                echo $rates;
            }
        }
    }

    public function rentals()
    {
        $header = $this->uri->segment(3);
        if ($header === 'save_rates') {
            $this->main_model->save_rates();
        } elseif ($header === 'rent_a_house') {
            $this->load->view('rentals/make_booking');
        } elseif ($header === 'make_rental_booking') {
            $this->main_model->make_rental_booking();
        } else if ($header === 'rent_collection') {
            $this->load->view('rentals/rent_collection');
        } else {
            $this->load->view('rentals/manage_rooms');
        }
    }

    public function profile()
    {
        $mydata = $this->session->all_userdata();

        $ge = $this->uri->segment(3);
        if ($ge === 'settings') {
            $this->load->view('users/profile');
        } else if ($ge === 'upload_cover') {
            if (!empty($_FILES)) {
                $user = $mydata['id'];
                $imgpath = 'uploads/user_' . $user;
                if (!is_dir($imgpath)) //create the folder if it's not already exists
                {
                    mkdir($imgpath, 0755, TRUE);
                }
                $path_parts = pathinfo($_FILES["file"]["name"]);
                $file_name = 'cover_' . md5($path_parts['filename'] . '.' . $path_parts['extension']);
                $image_path = $file_name . '.' . $path_parts['extension'];
                move_uploaded_file($file_tmp = $_FILES["file"]["tmp_name"], $imgpath . "/" . $image_path);
                $newpath = $imgpath . "/" . $image_path; //path of file to save to DB

                $checkrows = $this->db->query("select * from tbl_user_images where userid ='$user'")->result_array();

                if (count($checkrows) < 1) {
                    $this->db->insert('tbl_user_images', array(
                        'filepath' => $newpath,
                        'filename' => $file_name,
                        'userid' => $user,
                    ));
                    if ($this->db->affected_rows() > 0) {
                        echo 'image_added';
                    } else {
                        echo 'image_failed_to_add';
                    }
                } else {
                    $this->db->query("delete from tbl_user_images where userid='$user'");

                    $this->db->insert('tbl_user_images', array(
                        'filepath' => $newpath,
                        'filename' => $file_name,
                        'userid' => $user,
                    ));
                    if ($this->db->affected_rows() > 0) {
                        echo 'image_added';
                    } else {
                        echo 'image_failed_to_add';
                    }
                }

            }
        } else if ($ge === 'upload_profile') {
            if (!empty($_FILES)) {
                $user = $mydata['id'];
                $imgpath = 'uploads/user_' . $user;
                if (!is_dir($imgpath)) //create the folder if it's not already exists
                {
                    mkdir($imgpath, 0755, TRUE);
                }
                $path_parts = pathinfo($_FILES["file"]["name"]);
                $file_name = 'profile_' . md5($path_parts['filename'] . '.' . $path_parts['extension']);
                $image_path = $file_name . '.' . $path_parts['extension'];
                move_uploaded_file($file_tmp = $_FILES["file"]["tmp_name"], $imgpath . "/" . $image_path);
                $newpath = $imgpath . "/" . $image_path; //path of file to save to DB
                //if you want to save in db,where here
                // with out model just for example
                $checkrows = $this->db->query("select * from tbl_user_profile where userid ='$user'")->result_array();

                if (count($checkrows) < 1) {
                    $this->db->insert('tbl_user_profile', array(
                        'filepath' => $newpath,
                        'userid' => $user,
                    ));
                    if ($this->db->affected_rows() > 0) {
                        echo 'image_added';
                    } else {
                        echo 'image_failed_to_add';
                    }
                } else {
                    $this->db->query("delete from tbl_user_profile where userid='$user'");

                    $this->db->insert('tbl_user_profile', array(
                        'filepath' => $newpath,
                        'userid' => $user,
                    ));
                    if ($this->db->affected_rows() > 0) {
                        echo 'image_added';
                    } else {
                        echo 'image_failed_to_add';
                    }
                }


            }
        } else if ($ge === 'update_details') {
            $this->main_model->update_details();
        } else if ($ge === 'update_password') {
            $this->main_model->update_password();
        } else {
            show_404();
        }
    }

    public function reports_template()
    {
        $this->load->view('reports/template');
    }

    public function calendar()
    {
        $this->load->view('calendar/calendar');

    }

    public function index()
    {
        $this->load->view('main/dashboard');
    }

    public function getpayments()
    {

        $result = $this->db->query("SELECT sum(amountpaid) as payments, estate FROM bookings group by estate")->result_array();

        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }

        echo json_encode($data);
    }

    public function checkout()
    {
        $id = $this->input->post('id', true);

        $mydata = $this->session->all_userdata();
        $user = $mydata['phone'];
        $date = date('Y-m-d H:i');
        $getdata = $this->db->query("select room from bookings where id='$id'")->row();
        $thisroom = $getdata->room;

        $this->db->query("update tbl_rooms set booked='0' where id='$thisroom' limit 1");
//        echo $thisroom;

        if ($this->db->affected_rows() > 0) {
            $this->db->query("update bookings set active ='0', checkedoutdate='$date', checkedoutby='$user' where id='$id' limit 1");
            if ($this->db->affected_rows() > 0) {
                echo 'checked_out';
            }else{
                echo 'failed_to_check_out';
            }
        } else {
            echo 'failed_to_check_out_step';
        }
    }

    public function viewcharges()
    {
        $estate = $this->input->post('estates', true);
        $typeofroom = $this->input->post('typeofroom', true);
        $selectroom = $this->input->post('selectroom', true);
        $residentsnumber = $this->input->post('residentsnumber', true);
        $datefrom = $this->input->post('datefrom', true);
        $dateto = $this->input->post('dateto', true);
        if ($estate == 0 || $typeofroom == 0 || $selectroom == 0) {
            echo 'missing_house';
        } else if (strlen($datefrom) === 0) {
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
                $max = $response->maxpeople;
                $min = $response->minpeople;
                if ($min > $residentsnumber) {
                    echo 'minreached';
                } else if ($residentsnumber > $max) {
                    echo 'maxreached';
                } else {
//                echo $estate.'-'.$selectroom;

//                $getestate = $this->db->query("select estatename from tbl_estates where id='$estate' limit 1")->row();
                    $roomcharges = $response->amountperperson;
                    $totalvisitors = $residentsnumber;
                    $numberofdays = $days;
                    if ($typeofroom == 1) {
                        $totalcharges = $roomcharges * $totalvisitors * $numberofdays;

                    } else {
                        $totalcharges = $roomcharges * $numberofdays;
                    }//                echo $totalcharges.'-'.$amountpaid;

                    echo '<table class="table">
                                        <tbody>
                                        
                                        <tr>
                                            
                                            <td>
                                            <h3 class="text-semibold">Total Amount</h3>
                                            </td>
                                                <td>
                                                <h3 class="text-semibold">' . ucwords('KES ' . number_format($totalcharges)) . '<input id="getrates" type="hidden" value="' . $roomcharges . '"> </h3>
                                                <p>Rates <strong>' . ucwords('KES ' . number_format($roomcharges)) . '</strong><input id="getnodays" type="hidden" value="' . $numberofdays . '"> for <strong>' . ucwords(number_format($numberofdays)) . '</strong> day(s)</p>
                                                
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>';
                }
            }
        }
    }

    public function reports()
    {
        $he = $this->uri->segment(3);
        if ($he === 'bookings') {
            $ge = $this->uri->segment(4);
            if ($ge === 'bookings_reports_sorted') {
                $date = $this->input->post('customrange', true);
                list($startDate, $endDate) = explode(' - ', $date);

                $this->print_by_category_of_bookings($startDate, $endDate);

            } else if ($ge === 'bookings_reports_sorted_category') {
                $listestates = $this->input->post('estates', true);
                $listrooms = $this->input->post('rooms', true);
                if ($listestates == 0 && $listrooms == 0) {
                    $this->print_all_bookings();
                } else if ($listestates !== 0 && $listrooms == 0) {
                    $this->print_all_bookings_by_estates($listestates);
                } else if ($listrooms !== 0 && $listestates == 0) {
                    $this->print_all_bookings_by_rooms($listrooms);

                } else if ($listrooms !== 0 && $listestates !== 0) {
                    $this->print_all_bookings_by_estates_and_rooms($listestates, $listrooms);

                } else {
                    $this->load->view('reports/bookings', array('error' => 'We could not process this request. Select your category and hit the button'));
                }
            } else {
                $this->load->view('reports/bookings');
            }
        } else if ($he === 'rooms') {
            $ge = $this->uri->segment(4);
            if ($ge === 'rooms_reports_sorted') {
//                $date=$this->input->post('customrange', true);
//                list($startDate, $endDate) = explode(' - ', $date);

                $this->print_all_rooms();

            } else {
                $this->load->view('reports/rooms');
            }

        } else if ($he === 'revenue') {
            $ge = $this->uri->segment(4);
            if ($ge === 'print_revenue_report') {
                $month = $this->input->post('monthname', true);
                $year = $this->input->post('yearname', true);
                if ($month == 0 && $year == 0) {
                    $this->print_all_revenue_records();
                } else if ($month == 'ALL' && $year == '0') {
                    $this->print_all_revenue_records();
                } else if ($month == '0' && $year == 'ALL') {
                    $this->print_all_revenue_records();
                } else if ($month != 0 && $month != 'ALL' && $year == 0) {
                    $this->print_all_revenue_months($month);
                } else if ($year != 0 && $year != 'ALL' && $month == 0) {
                    $this->print_all_revenue_year($year);
                } else if ($year != 0 && $year != 'ALL' && $month != 0 && $month != 'ALL') {
                    $this->print_all_revenue_months_years($year, $month);
                }

            } else {
                $this->load->view('reports/revenue');
            }

        } else if ($he === 'estates') {
            $ge = $this->uri->segment(4);
            if ($ge === 'estates_reports_sorted') {
                $this->print_all_estates();

            } else {
                $this->load->view('reports/estates');
            }

        } else if ($he === 'print_bookings_report') {
//            $this->load->view('reports/bookings_template');

            $this->print_all_estates();

        } else if ($he === 'print_rooms_report') {

        } else if ($he === 'print_estates_report') {

        }
    }

    public function print_all_revenue_months_years($year, $month)
    {
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
        $revenue = $this->db->query("select * from bookings where MONTH(checkin) = '$month' and YEAR(checkin) = '$year' order by id desc")->result_array();

        if (count($revenue) < 1) {
            $this->load->view('reports/revenue', array("error" => "No records found within this range"));

        } else {

            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 11px; line-height: 15px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">PAYMENTS</h5>
</span>
<table id="reports" style="font-size: 12px; background-color: #fff; border-color: #ebebeb">
                <tr>
                        
                        <th style="background-color: #323232; color: #fff;width: 80% !important;"><span>DESCRIPTION</span></th>
                        <th style="background-color: #323232; color: #fff;"><span style="">TOTAL</span></th>
                    </tr>
                
                ';
            $rentc = $this->db->query("SELECT sum(amountpaid) as amount FROM  bookings where MONTH(checkin) = '$month'  and YEAR(checkin) = '$year' ")->row();
            $rent = $rentc->amount;
            $roomsbooked = $this->db->query("SELECT count(amountpaid) as roomsbooked FROM  bookings where MONTH(checkin) = '$month'  and YEAR(checkin) = '$year' ")->row();
            $rms = $roomsbooked->roomsbooked;

            $rentalsbooked = $this->db->query("SELECT count(distinct (room)) as rental FROM  tbl_rentals_reservations where MONTH(datefrom) = '$month'  and YEAR(datefrom) = '$year' ");
            $totalrentals = 0;
            if ($rentalsbooked->num_rows() > 0) {
                $getrentals = $rentalsbooked->row();
                $totalrentals = $getrentals->rental;
            } else {
                $totalrentals = 0;

            }

            $rentcollected = $this->db->query("SELECT sum(amount) as rent FROM  tbl_rental_payments where MONTH(dateadded) = '$month'  and YEAR(dateadded) = '$year' ");
            $totalrent = 0;
            if ($rentcollected->num_rows() > 0) {
                $getrent = $rentcollected->row();
                $totalrent = $getrent->rent;
            } else {
                $totalrent = 0;
            }
            $groupbookings = $this->db->query("SELECT sum(amountpaid) as rent FROM  tbl_group_bookings where MONTH(dateadded) = '$month'  and YEAR(dateadded) = '$year' ");
            $totalrentgroup = 0;
            if ($groupbookings->num_rows() > 0) {
                $getrentgroup = $groupbookings->row();
                $totalrentgroup = $getrentgroup->rent;
            } else {
                $totalrentgroup = 0;
            }

            $tax = $this->config->item('tax');

            $set_html .= '

                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Reports of ' . date("F", strtoupper(mktime(0, 0, 0, $month, 10))) . ' ' . $year . '
                                </span>
                                </td>
                                <td><span></span></td>
                            </tr>
                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Total Rooms Booked 
                                </span>
                                </td>
                                <td><span style="line-height: 20px !important;">' . $rms . ' rooms</span></td>
                            </tr>
                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Long Term Bookings (LTB)
                                </span>
                                </td>
                                <td><span style="line-height: 20px !important;">' . $totalrentals . ' rooms</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (LTB)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($totalrent) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (BOOKINGS)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($rent) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (GROUP)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($totalrentgroup) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>SUB TOTAL</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($rent + $totalrent + $totalrentgroup) . '</span></td>
                            </tr>
                            <tr>
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                    <i style=" display: block"><strong>TAX of ' . $tax . '</strong> </i>
                                </td>
                                <td><span>KES. 0.00</span>
                                
                                </td>
                            </tr>
                            <tr >
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                <i style=" display: block"><strong>TOTAL</strong> </i>
                                </td>
                                <td style=""><span>KES.' . number_format($rent + $totalrent + $totalrentgroup) . '</span></td>
                            </tr>                            
                ';


            $set_html .= '        
            </table>
            <br>
            <br>
            <br>
            <p style=" font-size: 9px !important; text-align: center !important;">Report Generated on ' . date('d/m/Y') . '</p>



</body>

</html>

        
        ';

            //Print content utilizing writeHTMLCell()
            $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', false);

            $record = date('Y-m-d');
            // Close and yield PDF record
            // This technique has a few choices, check the source code documentation for more data.
            $tcpdf->Output('revenue_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_revenue_months($month)
    {
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
        $revenue = $this->db->query("select * from bookings where MONTH(checkin) = '$month' order by id desc")->result_array();

        if (count($revenue) < 1) {
            $this->load->view('reports/revenue', array("error" => "No records found within this range"));

        } else {

            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 11px; line-height: 15px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">MONTHLY SUMMARY</h5>
</span>
<table id="reports" style="font-size: 12px; background-color: #fff; border-color: #ebebeb">
                <tr>
                        
                        <th style="background-color: #323232; color: #fff;width: 80% !important;"><span>DESCRIPTION</span></th>
                        <th style="background-color: #323232; color: #fff;"><span style="">TOTAL</span></th>
                    </tr>
                
                ';
            $rentc = $this->db->query("SELECT sum(amountpaid) as amount FROM  bookings where MONTH(checkin) = '$month'")->row();
            $rent = $rentc->amount;
            $roomsbooked = $this->db->query("SELECT count(amountpaid) as roomsbooked FROM  bookings where MONTH(checkin) = '$month' ")->row();
            $rms = $roomsbooked->roomsbooked;
            $tax = $this->config->item('tax');

            $rentalsbooked = $this->db->query("SELECT count(distinct (room)) as rental FROM  tbl_rentals_reservations where MONTH(datefrom) = '$month' ");
            $totalrentals = 0;
            if ($rentalsbooked->num_rows() > 0) {
                $getrentals = $rentalsbooked->row();
                $totalrentals = $getrentals->rental;
            } else {
                $totalrentals = 0;

            }

            $rentcollected = $this->db->query("SELECT sum(amount) as rent FROM  tbl_rental_payments where MONTH(dateadded) = '$month'  ");
            $totalrent = 0;
            if ($rentcollected->num_rows() > 0) {
                $getrent = $rentcollected->row();
                $totalrent = $getrent->rent;
            } else {
                $totalrent = 0;
            }

            $groupbookings = $this->db->query("SELECT sum(amountpaid) as rent FROM  tbl_group_bookings where MONTH(dateadded) = '$month' ");
            $totalrentgroup = 0;
            if ($groupbookings->num_rows() > 0) {
                $getrentgroup = $groupbookings->row();
                $totalrentgroup = $getrentgroup->rent;
            } else {
                $totalrentgroup = 0;
            }

            $tax = $this->config->item('tax');

            $set_html .= '

                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Reports, Month of ' . date("F", strtoupper(mktime(0, 0, 0, $month, 10))) . '
                                </span>
                                </td>
                                <td><span></span></td>
                            </tr>
                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Total Rooms Booked 
                                </span>
                                </td>
                                <td><span style="line-height: 20px !important;">' . $rms . ' rooms</span></td>
                            </tr>
                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Long Term Bookings (LTB)
                                </span>
                                </td>
                                <td><span style="line-height: 20px !important;">' . $totalrentals . ' rooms</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (LTB)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($totalrent) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (GROUP)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($totalrentgroup) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>SUB TOTAL</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($rent + $totalrent + $totalrentgroup) . '</span></td>
                            </tr>
                            <tr>
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                    <i style=" display: block"><strong>TAX of ' . $tax . '</strong> </i>
                                </td>
                                <td><span>KES. 0.00</span>
                                
                                </td>
                            </tr>
                            <tr >
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                <i style=" display: block"><strong>TOTAL</strong> </i>
                                </td>
                                <td style=""><span>KES.' . number_format($rent + $totalrent + $totalrentgroup) . '</span></td>
                            </tr>                             
                ';

            $set_html .= '        
            </table>
            <br>
            <br>
            <br>
            <p style=" font-size: 9px !important; text-align: center !important;">Report Generated on ' . date('d/m/Y') . '</p>



</body>

</html>

        
        ';

            //Print content utilizing writeHTMLCell()
            $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', false);

            $record = date('Y-m-d');
            // Close and yield PDF record
            // This technique has a few choices, check the source code documentation for more data.
            $tcpdf->Output('revenue_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_revenue_year($year)
    {
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
        $revenue = $this->db->query("select * from bookings where YEAR(checkin) = '$year' order by id desc")->result_array();

        if (count($revenue) < 1) {
            $this->load->view('reports/revenue', array("error" => "No records found within this range"));

        } else {

            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 11px; line-height: 15px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">YEARLY SUMMARY</h5>
</span>
<table id="reports" style="font-size: 12px; background-color: #fff; border-color: #ebebeb">
                <tr>
                        
                        <th style="background-color: #323232; color: #fff;width: 80% !important;"><span>DESCRIPTION</span></th>
                        <th style="background-color: #323232; color: #fff;"><span style="">TOTAL</span></th>
                    </tr>
                
                ';
            $rentc = $this->db->query("SELECT sum(amountpaid) as amount FROM  bookings where YEAR(checkin) = '$year'")->row();
            $rent = $rentc->amount;
            $roomsbooked = $this->db->query("SELECT count(amountpaid) as roomsbooked FROM  bookings where YEAR(checkin) = '$year' ")->row();
            $rms = $roomsbooked->roomsbooked;

            $rentalsbooked = $this->db->query("SELECT count(distinct (room)) as rental FROM  tbl_rentals_reservations where YEAR(datefrom) = '$year' ");
            $totalrentals = 0;
            if ($rentalsbooked->num_rows() > 0) {
                $getrentals = $rentalsbooked->row();
                $totalrentals = $getrentals->rental;
            } else {
                $totalrentals = 0;

            }

            $rentcollected = $this->db->query("SELECT sum(amount) as rent FROM  tbl_rental_payments where YEAR(dateadded) = '$year'  ");
            $totalrent = 0;
            if ($rentcollected->num_rows() > 0) {
                $getrent = $rentcollected->row();
                $totalrent = $getrent->rent;
            } else {
                $totalrent = 0;
            }
            $groupbookings = $this->db->query("SELECT sum(amountpaid) as rent FROM  tbl_group_bookings where year(dateadded) = '$year' ");
            $totalrentgroup = 0;
            if ($groupbookings->num_rows() > 0) {
                $getrentgroup = $groupbookings->row();
                $totalrentgroup = $getrentgroup->rent;
            } else {
                $totalrentgroup = 0;
            }

            $tax = $this->config->item('tax');

            $set_html .= '

                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Bookings reports, Year ' . $year . '
                                </span>
                                </td>
                                <td><span></span></td>
                            </tr>
                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Total Rooms Booked 
                                </span>
                                </td>
                                <td><span style="line-height: 20px !important;">' . $rms . ' rooms</span></td>
                            </tr>
                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Long Term Bookings (LTB)
                                </span>
                                </td>
                                <td><span style="line-height: 20px !important;">' . $totalrentals . ' rooms</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (LTB)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($totalrent) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (BOOKINGS)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($rent) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (GROUP)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($totalrentgroup) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>SUB TOTAL</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($rent + $totalrent + $totalrentgroup) . '</span></td>
                            </tr>
                            <tr>
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                    <i style=" display: block"><strong>TAX of ' . $tax . '</strong> </i>
                                </td>
                                <td><span>KES. 0.00</span>
                                
                                </td>
                            </tr>
                            <tr >
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                <i style=" display: block"><strong>TOTAL</strong> </i>
                                </td>
                                <td style=""><span>KES.' . number_format($rent + $totalrent + $totalrentgroup) . '</span></td>
                            </tr>                             
                ';


            $set_html .= '        
            </table>
            <br>
            <br>
            <br>
            <p style=" font-size: 9px !important; text-align: center !important;">Report Generated on ' . date('d/m/Y') . '</p>



</body>


</html>

        
        ';

            //Print content utilizing writeHTMLCell()
            $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', false);

            $record = date('Y-m-d');
            // Close and yield PDF record
            // This technique has a few choices, check the source code documentation for more data.
            $tcpdf->Output('revenue_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_revenue_records()
    {
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
        $revenue = $this->db->query("select * from bookings order by id desc")->result_array();

        if (count($revenue) < 1) {
            $this->load->view('reports/revenue', array("error" => "No records found within this range"));

        } else {
            $rentc = $this->db->query("SELECT sum(amountpaid) as amount FROM  bookings")->row();
            $rent = $rentc->amount;
            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 11px; line-height: 15px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">SUMMARY REPORT</h5>
</span>
<table id="reports" style="font-size: 12px; background-color: #fff; border-color: #ebebeb">
                <tr>
                        
                        <th style="background-color: #323232; color: #fff;width: 80% !important;"><span>DESCRIPTION</span></th>
                        <th style="background-color: #323232; color: #fff;"><span style="">TOTAL</span></th>
                    </tr>
                
                ';
            $rentc = $this->db->query("SELECT sum(amountpaid) as amount FROM  bookings")->row();
            $rent = $rentc->amount;
            $roomsbooked = $this->db->query("SELECT count(amountpaid) as roomsbooked FROM  bookings")->row();
            $rms = $roomsbooked->roomsbooked;
            $tax = $this->config->item('tax');

            $rentalsbooked = $this->db->query("SELECT count(distinct (room)) as rental FROM  tbl_rentals_reservations");
            $totalrentals = 0;
            if ($rentalsbooked->num_rows() > 0) {
                $getrentals = $rentalsbooked->row();
                $totalrentals = $getrentals->rental;
            } else {
                $totalrentals = 0;

            }

            $rentcollected = $this->db->query("SELECT sum(amount) as rent FROM  tbl_rental_payments ");
            $totalrent = 0;
            if ($rentcollected->num_rows() > 0) {
                $getrent = $rentcollected->row();
                $totalrent = $getrent->rent;
            } else {
                $totalrent = 0;
            }
            $groupbookings = $this->db->query("SELECT sum(amountpaid) as rent FROM  tbl_group_bookings");
            $totalrentgroup = 0;
            if ($groupbookings->num_rows() > 0) {
                $getrentgroup = $groupbookings->row();
                $totalrentgroup = $getrentgroup->rent;
            } else {
                $totalrentgroup = 0;
            }

            $set_html .= '

                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Summary Report of All Bookings Made and Payments received 
                                </span>
                                </td>
                                <td><span></span></td>
                            </tr>
                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Total Rooms Booked 
                                </span>
                                </td>
                                <td><span style="line-height: 20px !important;">' . $rms . ' rooms</span></td>
                            </tr>
                            <tr style="">
                               
                                <td style="width: 80% !important; height: 20px !important;">
                                <span style="line-height: 20px !important;">Long Term Bookings (LTB)
                                </span>
                                </td>
                                <td><span style="line-height: 20px !important;">' . $totalrentals . ' rooms</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (LTB)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($totalrent) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>RENT COLLECTIONS (GROUP)</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($totalrentgroup) . '</span></td>
                            </tr>
                            <tr>
                               
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                        <i style=" display: block"><strong>SUB TOTAL</strong> </i>
                                   </td>
                                <td><span>KES.' . number_format($rent + $totalrent + $totalrentgroup) . '</span></td>
                            </tr>
                            <tr>
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                    <i style=" display: block"><strong>TAX of ' . $tax . '</strong> </i>
                                </td>
                                <td><span>KES. 0.00</span>
                                
                                </td>
                            </tr>
                            <tr >
                                <td style="width: 80% !important; text-align: right; height: 20px !important;">
                                <i style=" display: block"><strong>TOTAL</strong> </i>
                                </td>
                                <td style=""><span>KES.' . number_format($rent + $totalrent + $totalrentgroup) . '</span></td>
                            </tr>                         
                ';


            $set_html .= '        
            </table>
            <br>
            <br>
            <br>
            <p style=" font-size: 9px !important; text-align: center !important;">Report Generated on ' . date('d/m/Y') . '</p>



</body>

</html>

        
        ';

            //Print content utilizing writeHTMLCell()
            $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', false);

            $record = date('Y-m-d');
            // Close and yield PDF record
            // This technique has a few choices, check the source code documentation for more data.
            $tcpdf->Output('revenue_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_bookings_by_estates($listestates)
    {
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
        $estates = $this->db->query("select * from bookings where estate = '$listestates' order by checkin asc")->result_array();

        if (count($estates) < 1) {
            $this->load->view('reports/bookings', array("error" => "No records found within this range"));

        } else {
            $totalrent = $this->db->query("select sum(amountpaid) as paidamt , sum(visitors) as visitors from bookings where estate = '$listestates' ")->row();
            $myestate = $this->db->query("select estatename from tbl_estates where id= '$listestates' ")->row();
            $monthstats = $this->db->query("select SUM(visitors) as visits from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE()) AND estate = '$listestates'")->row();
            $mnts = $monthstats->visits;
            $monthlyamount = $this->db->query("select sum(amountpaid) as monthstats from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE()) AND estate = '$listestates'")->row();
            $mntsamt = $monthlyamount->monthstats;
            $rent = $totalrent->paidamt;
            $visitors = $totalrent->visitors;
            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
<br>
TOTAL COLLECTIONS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($rent) . '</i>
<br>
TOTAL VISITORS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($visitors) . '</i>
<br>
COLLECTIONS THIS MONTH : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($mntsamt) . '</i>
<br>
VISITORS THIS MONTH : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($mnts) . '</i>
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">BOOKINGS REPORT FOR ' . strtoupper($myestate->estatename) . '</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th><h5 style="font-size: 10px;">ROOM NO.</h5></th>
                        <th><h5 style="font-size: 10px;">ESTATE</h5></th>
                        <th><h5 style="font-size: 10px;">DAYS</h5></th>
                        <th><h5 style="font-size: 10px;">VISITORS</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKIN</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKOUT</h5></th>
                        <th><h5 style="font-size: 10px;">AMOUNT</h5></th>
                                                <th><h5 style="font-size: 10px;">RATE</h5></th>

                        <th><h5 style="font-size: 10px;">SERVED BY</h5></th>
                    </tr>
                
                ';

            if (count($estates) > 0) {
                $i = 0;

                foreach ($estates as $estate):

                    $i++;
                    $id = $estate['room'];
                    $estateid = $estate['estate'];
                    $room = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$id'")->row();
                    $getroom = $room->roomnumber;
                    $estatefind = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                    $getestate = $estatefind->estatename;
                    if ($i % 2 == 0) {
                        $bgcolor = 'background-color: #fff;';
                    } else {
                        $bgcolor = 'background-color: #ebebeb;';
                    }

                    $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>' . ucwords($getroom) . '</td>
                                <td>' . $getestate . '</td>
                                <td>' . $estate['days'] . ' days</td>
                                <td>' . $estate['visitors'] . '</td>
                                <td>' . $estate['checkin'] . '</td>
                                <td>' . $estate['checkout'] . '</td>
                                <td>' . number_format($estate['amountpaid']) . '</td>
                                <td>' . number_format($estate['billing']) . '</td>
                                <td>' . $estate['servedby'] . '</td>

                            </tr>
                            
                ';
                endforeach;
            } else {
                $set_html .= '
                <tr style="border: 1px solid #ddd;">
                                <center>No Data Available</center>

                            </tr>
                ';
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
            $tcpdf->Output('bookings_sorted_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_bookings_by_rooms($listrooms)
    {
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
        $estates = $this->db->query("select * from bookings where room = '$listrooms' order by checkin asc")->result_array();
        $monthstats = $this->db->query("select SUM(visitors) as visits from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE()) AND room = '$listrooms'")->row();
        $mnts = $monthstats->visits;
        $monthlyamount = $this->db->query("select sum(amountpaid) as monthstats from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE()) AND room = '$listrooms'")->row();
        $mntsamt = $monthlyamount->monthstats;
        if (count($estates) < 1) {
            $this->load->view('reports/bookings', array("error" => "No records found within this range"));

        } else {
            $totalrent = $this->db->query("select sum(amountpaid) as paidamt , sum(visitors) as visitors from bookings where room = '$listrooms' ")->row();
            $roomname = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$listrooms'")->row();

            $rent = $totalrent->paidamt;
            $visitors = $totalrent->visitors;
            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
<br>
TOTAL COLLECTIONS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($rent) . '</i>
<br>
TOTAL VISITORS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($visitors) . '</i>
<br>
COLLECTIONS THIS MONTH : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($mntsamt) . '</i>
<br>
VISITORS THIS MONTH : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($mnts) . '</i>
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">ROOM NO. ' . $roomname->roomnumber . '</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th><h5 style="font-size: 10px;">ROOM NO.</h5></th>
                        <th><h5 style="font-size: 10px;">ESTATE</h5></th>
                        <th><h5 style="font-size: 10px;">DAYS</h5></th>
                        <th><h5 style="font-size: 10px;">VISITORS</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKIN</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKOUT</h5></th>
                        <th><h5 style="font-size: 10px;">AMOUNT</h5></th>
                                                <th><h5 style="font-size: 10px;">RATE</h5></th>

                        <th><h5 style="font-size: 10px;">SERVED BY</h5></th>
                    </tr>
                
                ';

            if (count($estates) > 0) {
                $i = 0;

                foreach ($estates as $estate):

                    $i++;
                    $id = $estate['room'];
                    $estateid = $estate['estate'];
                    $room = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$id'")->row();
                    $getroom = $room->roomnumber;
                    $estatefind = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                    $getestate = $estatefind->estatename;
                    if ($i % 2 == 0) {
                        $bgcolor = 'background-color: #fff;';
                    } else {
                        $bgcolor = 'background-color: #ebebeb;';
                    }

                    $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>' . ucwords($getroom) . '</td>
                                <td>' . $getestate . '</td>
                                <td>' . $estate['days'] . ' days</td>
                                <td>' . $estate['visitors'] . '</td>
                                <td>' . $estate['checkin'] . '</td>
                                <td>' . $estate['checkout'] . '</td>
                                <td>' . number_format($estate['amountpaid']) . '</td>
                                <td>' . number_format($estate['billing']) . '</td>
                                <td>' . $estate['servedby'] . '</td>

                            </tr>
                            
                ';
                endforeach;
            } else {
                $set_html .= '
                <tr style="border: 1px solid #ddd;">
                                <center>No Data Available</center>

                            </tr>
                ';
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
            $tcpdf->Output('bookings_sorted_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_bookings_by_estates_and_rooms($listestates, $listrooms)
    {
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
        $estates = $this->db->query("select * from bookings where room = '$listrooms' and estate='$listestates' order by checkin asc")->result_array();

        if (count($estates) < 1) {
            $this->load->view('reports/bookings', array("error" => "No records found within this range"));

        } else {
            $totalrent = $this->db->query("select sum(amountpaid) as paidamt , sum(visitors) as visitors from bookings where room = '$listrooms' and estate='$listestates' ")->row();
            $roomname = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$listrooms'")->row();
            $fetchestate = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$listestates'")->row();
            $monthstats = $this->db->query("select SUM(visitors) as visits from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE()) AND room = '$listrooms' and estate='$listestates'")->row();
            $mnts = $monthstats->visits;
            $monthlyamount = $this->db->query("select sum(amountpaid) as monthstats from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE()) AND room = '$listrooms' and estate='$listestates'")->row();
            $mntsamt = $monthlyamount->monthstats;
            $rent = $totalrent->paidamt;
            $visitors = $totalrent->visitors;
            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
<br>
TOTAL COLLECTIONS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($rent) . '</i>
<br>
TOTAL VISITORS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($visitors) . '</i>
<br>
COLLECTIONS THIS MONTH : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($mntsamt) . '</i>
<br>
VISITORS THIS MONTH : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($mnts) . '</i>
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">' . strtoupper($roomname->roomnumber) . ' FULL REPORT - ' . strtoupper($fetchestate->estatename) . '</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th><h5 style="font-size: 10px;">ROOM NO.</h5></th>
                        <th><h5 style="font-size: 10px;">ESTATE</h5></th>
                        <th><h5 style="font-size: 10px;">DAYS</h5></th>
                        <th><h5 style="font-size: 10px;">VISITORS</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKIN</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKOUT</h5></th>
                        <th><h5 style="font-size: 10px;">AMOUNT</h5></th>
                                                <th><h5 style="font-size: 10px;">RATE</h5></th>

                        <th><h5 style="font-size: 10px;">SERVED BY</h5></th>
                    </tr>
                
                ';

            if (count($estates) > 0) {
                $i = 0;

                foreach ($estates as $estate):

                    $i++;
                    $id = $estate['room'];
                    $estateid = $estate['estate'];
                    $room = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$id'")->row();
                    $getroom = $room->roomnumber;
                    $estatefind = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                    $getestate = $estatefind->estatename;
                    if ($i % 2 == 0) {
                        $bgcolor = 'background-color: #fff;';
                    } else {
                        $bgcolor = 'background-color: #ebebeb;';
                    }

                    $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>' . ucwords($getroom) . '</td>
                                <td>' . $getestate . '</td>
                                <td>' . $estate['days'] . ' days</td>
                                <td>' . $estate['visitors'] . '</td>
                                <td>' . $estate['checkin'] . '</td>
                                <td>' . $estate['checkout'] . '</td>
                                <td>' . number_format($estate['amountpaid']) . '</td>
                                <td>' . number_format($estate['billing']) . '</td>
                                <td>' . $estate['servedby'] . '</td>

                            </tr>
                            
                ';
                endforeach;
            } else {
                $set_html .= '
                <tr style="border: 1px solid #ddd;">
                                <center>No Data Available</center>

                            </tr>
                ';
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
            $tcpdf->Output('bookings_sorted_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_by_category_of_bookings($startDate, $endDate)
    {
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
        $estates = $this->db->query("select * from bookings where checkin between '$startDate' and '$endDate' order by checkin asc")->result_array();

        if (count($estates) < 1) {
            $this->load->view('reports/bookings', array("error" => "No records found within this range"));

        } else {
            $totalrent = $this->db->query("select sum(amountpaid) as paidamt , sum(visitors) as visitors from bookings where checkin between '$startDate' and '$endDate' ")->row();

            $rent = $totalrent->paidamt;
            $visitors = $totalrent->visitors;
            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
<br>
TOTAL COLLECTIONS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($rent) . '</i>
<br>
VISITORS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($visitors) . '</i>
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">ROOM CHECKINS (' . $startDate . ' to ' . $endDate . ')</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th><h5 style="font-size: 10px;">ROOM NO.</h5></th>
                        <th><h5 style="font-size: 10px;">ESTATE</h5></th>
                        <th><h5 style="font-size: 10px;">DAYS</h5></th>
                        <th><h5 style="font-size: 10px;">VISITORS</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKIN</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKOUT</h5></th>
                        <th><h5 style="font-size: 10px;">AMOUNT</h5></th>
                                                <th><h5 style="font-size: 10px;">RATE</h5></th>

                        <th><h5 style="font-size: 10px;">SERVED BY</h5></th>
                    </tr>
                
                ';

            if (count($estates) > 0) {
                $i = 0;

                foreach ($estates as $estate):

                    $i++;
                    $id = $estate['room'];
                    $estateid = $estate['estate'];
                    $room = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$id'")->row();
                    $getroom = $room->roomnumber;
                    $estatefind = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                    $getestate = $estatefind->estatename;
                    if ($i % 2 == 0) {
                        $bgcolor = 'background-color: #fff;';
                    } else {
                        $bgcolor = 'background-color: #ebebeb;';
                    }

                    $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>' . ucwords($getroom) . '</td>
                                <td>' . $getestate . '</td>
                                <td>' . $estate['days'] . ' days</td>
                                <td>' . $estate['visitors'] . '</td>
                                <td>' . $estate['checkin'] . '</td>
                                <td>' . $estate['checkout'] . '</td>
                                <td>' . number_format($estate['amountpaid']) . '</td>
                                <td>' . number_format($estate['billing']) . '</td>
                                <td>' . $estate['servedby'] . '</td>

                            </tr>
                            
                ';
                endforeach;
            } else {
                $set_html .= '
                <tr style="border: 1px solid #ddd;">
                                <center>No Data Available</center>

                            </tr>
                ';
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
            $tcpdf->Output('bookings_sorted_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_bookings()
    {
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
        $totalrentss = $this->db->query("select * from bookings ")->result_array();

        if (count($totalrentss) < 1) {
            $this->load->view('reports/bookings', array("errorss" => "No records found within this range"));

        } else {
            $totalrent = $this->db->query("select sum(amountpaid) as paidamt , sum(visitors) as visitors from bookings ")->row();


            $rent = $totalrent->paidamt;
            $visitors = $totalrent->visitors;
            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
<br>
TOTAL COLLECTIONS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($rent) . '</i>
<br>
TOTAL VISITORS: <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($visitors) . '</i>
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">BOOKINGS REPORT</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th><h5 style="font-size: 10px;">ROOM NO.</h5></th>
                        <th><h5 style="font-size: 10px;">ESTATE</h5></th>
                        <th><h5 style="font-size: 10px;">DAYS</h5></th>
                        <th><h5 style="font-size: 10px;">VISITORS</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKIN</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKOUT</h5></th>
                        <th><h5 style="font-size: 10px;">AMOUNT</h5></th>
                                                <th><h5 style="font-size: 10px;">RATE</h5></th>

                        <th><h5 style="font-size: 10px;">SERVED BY</h5></th>
                    </tr>
                
                ';

            $estates = $this->db->query("select * from bookings order by id desc")->result_array();
            if (count($estates) > 0) {
                $i = 0;

                foreach ($estates as $estate):

                    $i++;
                    $id = $estate['room'];
                    $estateid = $estate['estate'];
                    $room = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$id'")->row();
                    $getroom = $room->roomnumber;
                    $estatefind = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                    $getestate = $estatefind->estatename;
                    if ($i % 2 == 0) {
                        $bgcolor = 'background-color: #fff;';
                    } else {
                        $bgcolor = 'background-color: #ebebeb;';
                    }

                    $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>' . ucwords($getroom) . '</td>
                                <td>' . $getestate . '</td>
                                <td>' . $estate['days'] . ' days</td>
                                <td>' . $estate['visitors'] . '</td>
                                <td>' . $estate['checkin'] . '</td>
                                <td>' . $estate['checkout'] . '</td>
                                <td>' . number_format($estate['amountpaid']) . '</td>
                                <td>' . number_format($estate['billing']) . '</td>
                                <td>' . $estate['servedby'] . '</td>

                            </tr>
                            
                ';
                endforeach;
            } else {
                $set_html .= '
                <tr style="border: 1px solid #ddd;">
                                <center>No Data Available</center>

                            </tr>
                ';
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
            $tcpdf->Output('all_bookings' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_rooms()
    {
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
        $roomsnumberss = $this->db->query("select * from tbl_rooms")->result_array();

        if (count($roomsnumberss) < 1) {
            $this->load->view('reports/rooms', array("errorss" => "No records found within this range"));

        } else {
            $roomsnumber = $this->db->query("select count(id) as id from tbl_rooms")->row();

            $totalrooms = $roomsnumber->id;
            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
<br>
TOTAL ROOMS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($totalrooms) . '</i>
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">ROOMS REPORT</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th>ROOM NO.</th>
                        <th>STATUS</th>
                        <th>SUITE</th>
                        <th>MAX PEOPLE</th>
                        <th>MIN PEOPLE</th>
                        <th>AMOUNT</th>
                        <th>ESTATE</th>
                    </tr>
                
                ';
            $rooms = $this->db->query("select * from tbl_rooms")->result_array();

            if (count($rooms) > 0) {
                $i = 0;
                foreach ($rooms as $room):
                    $i++;
                    $userid = $room['addedby'];
                    $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$userid'")->row();
                    $phone = $addedby->phone;
                    $roomid = $room['id'];

                    $gettypes = $this->db->query("SELECT * FROM  tbl_rooms_types WHERE estateid='$roomid'");
                    $gettype = $gettypes->row();
                    if ($gettypes->num_rows() > 0) {
                        $type = $gettype->roomtype;
                    } else {
                        $type = '';
                    }
                    $estateid = $room['estateid'];
                    $getestates = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                    $estatename = $getestates->estatename;

                    $checkroom = $this->db->query("select * from bookings where room='$roomid' and active ='1'")->result_array();

                    if ($i % 2 == 0) {
                        $bgcolor = 'background-color: #fff;';
                    } else {
                        $bgcolor = 'background-color: #ebebeb;';
                    }
                    if (count($checkroom) > 0) {
                        $active = 'ACTIVE';
                    } else {
                        $active = '';
                    }

                    $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>' . $room['roomnumber'] . '</td>
                                <td>' . $active . '</td>
                                <td>' . $type . '</td>
                                <td>' . $room['maxpeople'] . '</td>
                                <td>' . $room['minpeople'] . '</td>
                                <td>' . $room['amountperperson'] . '</td>
                                <td>' . ucwords($estatename) . '</td>
                            </tr>
                            
                ';
                endforeach;
            } else {
                $set_html .= '
                <tr style="border: 1px solid #ddd;">
                                <center>No Data Available</center>

                            </tr>
                ';
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
            $tcpdf->Output('all_rooms' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_by_category_of_estates($startDate, $endDate)
    {
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
        $estates = $this->db->query("select * from bookings where checkin >= '$startDate' and checkout <= '$endDate' order by checkin asc")->result_array();

        if (count($estates) < 1) {
            $this->load->view('reports/estates', array("error" => "No records found within this range"));

        } else {
            $totalrent = $this->db->query("select sum(amountpaid) as paidamt , sum(visitors) as visitors from bookings where checkin >= '$startDate' and checkout <= '$endDate' ")->row();

            $rent = $totalrent->paidamt;
            $visitors = $totalrent->visitors;
            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
<br>
TOTAL COLLECTIONS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">KES. ' . number_format($rent) . '</i>
<br>
TOTAL VISITORS : <i style="color: #0b0b0b; font-family: helvetica; font-weight: bolder;">' . number_format($visitors) . '</i>
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">BOOKINGS REPORT (' . $startDate . ' to ' . $endDate . ')</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th><h5 style="font-size: 10px;">ROOM NO.</h5></th>
                        <th><h5 style="font-size: 10px;">ESTATE</h5></th>
                        <th><h5 style="font-size: 10px;">DAYS</h5></th>
                        <th><h5 style="font-size: 10px;">VISITORS</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKIN</h5></th>
                        <th><h5 style="font-size: 10px;">CHECKOUT</h5></th>
                        <th><h5 style="font-size: 10px;">AMOUNT</h5></th>
                                                <th><h5 style="font-size: 10px;">RATE</h5></th>

                        <th><h5 style="font-size: 10px;">SERVED BY</h5></th>
                    </tr>
                
                ';

            if (count($estates) > 0) {
                $i = 0;

                foreach ($estates as $estate):

                    $i++;
                    $id = $estate['room'];
                    $estateid = $estate['estate'];
                    $room = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$id'")->row();
                    $getroom = $room->roomnumber;
                    $estatefind = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                    $getestate = $estatefind->estatename;
                    if ($i % 2 == 0) {
                        $bgcolor = 'background-color: #fff;';
                    } else {
                        $bgcolor = 'background-color: #ebebeb;';
                    }

                    $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>' . ucwords($getroom) . '</td>
                                <td>' . $getestate . '</td>
                                <td>' . $estate['days'] . ' days</td>
                                <td>' . $estate['visitors'] . '</td>
                                <td>' . $estate['checkin'] . '</td>
                                <td>' . $estate['checkout'] . '</td>
                                <td>' . number_format($estate['amountpaid']) . '</td>
                                <td>' . number_format($estate['billing']) . '</td>
                                <td>' . $estate['servedby'] . '</td>

                            </tr>
                            
                ';
                endforeach;
            } else {
                $set_html .= '
                <tr style="border: 1px solid #ddd;">
                                <center>No Data Available</center>

                            </tr>
                ';
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
            $tcpdf->Output('bookings_sorted_' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function print_all_estates()
    {
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
        $estatesss = $this->db->query("select * from tbl_estates order by id desc")->result_array();

        if (count($estatesss) < 1) {
            $this->load->view('reports/estates', array("errorss" => "No records found within this range"));

        } else {

            $set_html = '
            <!DOCTYPE html>
<html lang="en">

<body style="background-color: #fff;">
<span style="font-size: 8px; line-height: 10px;display:block;">Room Management System<br>   Eldoret, Kenya<br>   Email: ' . $this->config->item('admin_email') . '<br>   Phone: ' . $this->config->item('phone') . '<br>   ' . date('F j, Y') . '<br></span>
<span style="font-size: 8px; line-height: 10px;display:block; text-align: right">
</span>

<span style="text-align: center;">
<h5 style="text-decoration: underline; font-size: 14px;">ESTATES</h5>
</span>
<table id="reports" style="font-size: 10px; background-color: #fff;">
                <tr style="    background-color: #212529; color: #fff;">
                        <th>#</th>
                        <th>ESTATE</th>
                        <th>LOCATION</th>
                        <th>ROOMS</th>
                    </tr>
                
                ';

            $estates = $this->db->query("select * from tbl_estates order by id desc")->result_array();
            if (count($estates) > 0) {
                $i = 0;
                foreach ($estates as $estate):
                    $i++;
                    $eid = $estate['id'];
                    $getrooms = $this->db->query("select count(id) as numbers from tbl_rooms where estateid='$eid'")->row();
                    $roomsnumber = $getrooms->numbers;

                    if ($i % 2 == 0) {
                        $bgcolor = 'background-color: #fff;';
                    } else {
                        $bgcolor = 'background-color: #ebebeb;';
                    }

                    $set_html .= '
                <tr style="' . $bgcolor . '">
                                <td>' . $i . '</td>
                                <td>' . ucwords($estate['estatename']) . '</td>
                                <td>' . $estate['estatelocation'] . '</td>
                                <td>' . $roomsnumber . ' rooms</td>
                            </tr>
                            
                ';
                endforeach;
            } else {
                $set_html .= '
                <tr style="border: 1px solid #ddd;">
                                <center>No Data Available</center>

                            </tr>
                ';
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
            $tcpdf->Output('all_estates' . $record . '_.pdf', 'D');
            // successfully created CodeIgniter TCPDF Integration

        }
    }

    public function estates()
    {
        $header = $this->uri->segment(3);
        if ($header === 'manage_estates') {
            $this->load->view('estates/manage');
        } else if ($header === 'save_estate') {
            $this->main_model->save_estate();
        }
    }

    public function getRoomsType()
    {
        $id = $this->input->post('estate', true);

//        $response = array();
        $rooms = $this->db->query("select id,roomtype from tbl_rooms_types where estateid='$id' order by roomtype desc");
        $response = $rooms->result_array();

        echo json_encode($response);
    }

    public function getcharges()
    {
        $estates = $this->input->post('estate', true);
        $room = $this->input->post('room', true);

        $rooms = $this->db->query("select * from tbl_rooms where id='$room' order by roomtype desc");
        $response = $rooms->row();
        if ($rooms->num_rows() < 1) {
            echo '<div class="alert alert-danger"><p>Error! no Room Available</p></div>';
        } else {

            $getestate = $this->db->query("select estatename from tbl_estates where id='$estates' limit 1")->row();

            $charges = '';
            $charges .= '<table class="table">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-semibold">Room Number</a>
                                                
                                            </td>
                                            <td>
                                                <p class="text-semibold">' . ucwords($response->roomnumber) . '</p>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark bg-danger position-left"></span>
                                                    ' . ucwords($getestate->estatename) . '
                                                    <input type="hidden" value="' . $response->amountperperson . '" id="getroomprice">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                            <td>
                                            <a class="text-semibold">Room Pricing</a>
                                            </td>
                                                <td>
                                                <p class="text-semibold">' . ucwords('KES ' . number_format($response->amountperperson)) . '</p>
                                                <div class="text-muted text-size-small">
                                                    <span class="status-mark bg-danger position-left"></span>
                                                    Max: ' . ucwords($response->maxpeople) . ', Min: ' . ucwords($response->minpeople) . '
                                                </div>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>';

            echo $charges;
        }
    }

    public function getRooms()
    {
        $id = $this->input->post('estate', true);
        $type = $this->input->post('typeofroom', true);

//        $response = array();
        $rooms = $this->db->query("select id,roomnumber from tbl_rooms where estateid='$id' and roomtype='$type' order by roomtype desc");
        $response = $rooms->result_array();

        echo json_encode($response);
    }

    public function getRoomslist()
    {
        $id = $this->input->post('estate', true);
        $rooms = $this->db->query("select id,roomtype from tbl_rooms_types where estateid='$id' order by roomtype desc");
        $response = $rooms->result_array();

        echo json_encode($response);
    }

    public function bookings()
    {
        $h = $this->uri->segment(3);
        if ($h === 'make_booking') {
            $this->load->view('bookings/make_booking');
        } else if ($h === 'receipt') {
            $this->load->view('bookings/receipt');

        } else if ($h === 'checkout') {
            $this->load->view('bookings/checkout');

        } else {
            show_404();
        }
    }

    public function rooms()
    {
        $header = $this->uri->segment(3);
        if ($header === 'manage_rooms') {
            $this->load->view('rooms/manage_rooms');

        } else if ($header === 'room_types') {
            $this->load->view('rooms/roomtypes');

        } else if ($header === 'add_new_room_step_1') {
            $this->load->view('rooms/add_room_step_1');

        } else if ($header === 'saveroom_step1') {
            $this->main_model->saveroom_step1();

        } else if ($header === 'add_room_images_step_2') {
            $this->load->view('rooms/add_room_step_2');

        } else if ($header === 'photos') {
            $this->load->view('rooms/add_room_photos');

        } else if ($header === 'view') {
            $this->load->view('rooms/single_room');

        } else if ($header === 'check_room_images_step_2') {
            $room_id = $this->input->post('roomid', true);
            $total_images = $this->db->get_where('tbl_rooms_images', array('roomid' => $room_id))->num_rows();
            if ($total_images > 2) {
//                $uri = $this->uri->segment(5);
//                $this->db->query(" update tbl_listings set listing_images_complete ='1' where id= '$room_id' limit 1");

                echo 'images_ready';
            } else if ($total_images <= 2 && $total_images > 0) {
                echo 'images_insufficient';
            } else {
                echo 'images_not_ready';
            }
        } else if ($header === 'steps_complete') {
            $this->load->view('rooms/add_complete');
        } else if ($header === 'save_room_images_step_2') {
            $this->main_model->save_room_images_step_2();

        } else if ($header === 'save_room_type') {
            $this->main_model->save_room_type();
        } else {
            show_404();
        }
    }

    public function system()
    {
        $header = $this->uri->segment(3);
        if ($header === 'users') {
            $this->load->view('users/manager_users');
        } else if ($header === 'save_user') {
            $this->main_model->save_user();
        } else {
            $this->load->view('rooms/manage');
        }
    }

    public function make_booking()
    {
        $this->main_model->make_booking();


    }

    public function checkdiscounts()
    {
        $estate = $this->input->post('estates', true);
        $selectroom = $this->input->post('selectroom', true);
        $billing = $this->input->post('billing', true);

        $rooms = $this->db->query("select * from tbl_rooms where id=$selectroom and estateid=$estate limit 1");
        $response = $rooms->row();
        $roomcharges = $response->amountperperson;
        $min = $roomcharges - $billing; //500
        $max = $billing - $roomcharges; //1500
        $mindiscount = $this->config->item('minrates');
        $maxdiscount = $this->config->item('maxrates');

        if ($min > $mindiscount) {
            echo 'min_discount_exceeded';
        } else if ($max > $maxdiscount) {
            echo 'max_discount_exceeded';
        } else {
            echo 'rates_accepted';
        }
    }


    //Log Out
    function logout()
    {
        $mydata = $this->session->all_userdata();
        $id = $mydata['id'];

        $date = date('g:ia  D, M j Y');

        $sql1 = " update system_users set lastsession ='$date' where id= '$id' limit 1";
        $this->db->query($sql1);
        if ($this->db->affected_rows() == 1) {
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('activeemail');
            $this->session->unset_userdata('user_type');
            $this->session->sess_destroy();
            redirect('login');
            return true;
        } else {
            echo 'Well that was not supposed to happen, Please contact admin at ' . $this->config->item('admin_email');
            return true;
        }
    }
}
