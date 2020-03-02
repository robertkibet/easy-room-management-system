<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_bookings_model extends CI_Model
{
    public function save_booking_details()
    {

        $roombooked = $this->input->post('rooms', true);
        $checkin = $this->input->post('checkin', true);
        $checkout = $this->input->post('checkout', true);
        $residents = $this->input->post('residents', true);
        $singleroom = $this->input->post('singleroom', true);
        $oneroom = $this->input->post('oneroom', true);
        $tworoom = $this->input->post('tworoom', true);
        $threeroom = $this->input->post('threeroom', true);

        $submittedsingles = strlen(($singleroom));
        $submittedonebedroom = strlen(($oneroom));
        $submittedtwobedroom = strlen(($tworoom));
        $submittedthreebedroom = strlen(($threeroom));

        if ($submittedsingles < 1) {
            $singleroom = 0;
        }
        if ($submittedonebedroom < 1) {
            $oneroom = 0;
        }
        if ($submittedtwobedroom < 1) {
            $tworoom = 0;
        }
        if ($submittedthreebedroom < 1) {
            $threeroom = 0;
        }


        $expectedvisitors = $singleroom + $oneroom + $tworoom + $threeroom;
        if ($residents > 5) {
            if ($residents == $expectedvisitors) {


                if (strlen($checkin) === 0) {
                    echo 'enter_checkin';
                } else if (strlen($checkout) === 0) {
                    echo 'enter_checkout';
                } else {
                    $datetoday = strtotime(Date('Y-m-d'));

                    $enddate = strtotime($checkout);
                    $startdate = strtotime($checkin);

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

                        //get number of rooms from the database using selected room numbers
                        $getsinglerooms = $this->db->query("select count(*) as singlerooms from tbl_rooms where id in ($roombooked) and roomtype='1'")->row();
                        $countsingle = ($getsinglerooms->singlerooms == null) ? 0 : $getsinglerooms->singlerooms;
                        $selectedoneroom = $this->db->query("select count(*) as selectedoneroom from tbl_rooms where id in ($roombooked) and roomtype='2'")->row();
                        $countonerooms = ($selectedoneroom->selectedoneroom == null) ? 0 : $selectedoneroom->selectedoneroom;
                        $gettworooms = $this->db->query("select count(*) as selectedtworooms from tbl_rooms where id in ($roombooked) and roomtype='3'")->row();
                        $counttworooms = ($gettworooms->selectedtworooms == null) ? 0 : $gettworooms->selectedtworooms;
                        $getthreerooms = $this->db->query("select count(*) as selectedthreerooms from tbl_rooms where id in ($roombooked) and roomtype='4'")->row();
                        $countthreerooms = ($getthreerooms->selectedthreerooms == null) ? 0 : $getthreerooms->selectedthreerooms;
                        //end

                        //get pricing for each type of room
                        $getallsinglespricefetch = $this->db->query("select amountperperson from tbl_rooms where roomtype='1' limit 1");
                        $getallonebedroompricefetch = $this->db->query("select amountperperson from tbl_rooms where roomtype='2' and booked=0 limit 1");
                        $getalltwobedroompricefetch = $this->db->query("select amountperperson from tbl_rooms where roomtype='3' and booked=0 limit 1");
                        $getallthreebedroompricefetch = $this->db->query("select amountperperson from tbl_rooms where roomtype='4' and booked=0 limit 1");

                        if ($getallsinglespricefetch->num_rows()<1) {
                            $getallsinglesprice = 0;
                        } else {
                            $singleroomdata = $getallsinglespricefetch->row();
                            $getallsinglesprice = $singleroomdata->amountperperson;
                        }

                        if ($getallonebedroompricefetch->num_rows()<1) {
                            $getallonebedroomprice = 0;
                        } else {
                            $oneroomdata = $getallonebedroompricefetch->row();
                            $getallonebedroomprice = $oneroomdata->amountperperson;
                        }

                        if ($getalltwobedroompricefetch->num_rows()<1) {
                            $getalltwobedroomprice = 0;
                        } else {
                            $tworoomdata = $getalltwobedroompricefetch->row();
                            $getalltwobedroomprice = $tworoomdata->amountperperson;
                        }
                        if ($getallthreebedroompricefetch->num_rows()<1) {
                            $getallthreebedroomprice = 0;
                        } else {
                            $threeroomdata = $getallonebedroompricefetch->row();
                            $getallthreebedroomprice = $threeroomdata->amountperperson;
                        }


                        //end
                        //calculate pricing per type of room

                        $checksingleselected = (strlen($singleroom) < 1) ? 0 : $singleroom;
                        $possiblebookingsforsinglerooms = $countsingle * 2;

                        if ($checksingleselected > $possiblebookingsforsinglerooms) {
                            //check if single rooms has been exceeded the available
                            echo 'single_exceeded';
                        } else {
                            //price for single rooms
//                            $totalforsinglerooms = $countsingle * $checksingleselected * $days * $getallsinglesprice;
                            $totalsingleroomstobebooked = ceil($possiblebookingsforsinglerooms / 2);
                            $totalforsinglerooms = $checksingleselected * $days * $getallsinglesprice;
                            echo $days;


                            //check one bedrooms
                            $checkonebedroomselected = (strlen($oneroom) < 1) ? 0 : $oneroom; //get selected number of people to stay in one bedrooms from the form
                            $possiblebookingsforonebedrooms = $countonerooms * 2; //get total possible occupants of one bedrooms from the database
                            $bookingsproposedforonebedroom = $checkonebedroomselected; //get number of rooms that can be occupied as per selected number in form.
                            if ($bookingsproposedforonebedroom > $possiblebookingsforonebedrooms) {
                                echo 'one_bed_room_exeeded';
                            } else {
                                $totalonebedroomstobebooked = ceil($bookingsproposedforonebedroom / 2); //one bed rooms to be booked as per input in the form
                                $totalforonebedroom = $totalonebedroomstobebooked * $days * $getallonebedroomprice;//total amount for one bed rooms to be booked

                                //check two bed rooms
                                $checktwobedroomselected = (strlen($tworoom) < 1) ? 0 : $tworoom; //get selected number of people to stay in two bedrooms from the form
                                $possiblebookingsfortwobedrooms = $counttworooms * 4; //get total possible occupants of two bedrooms from the database
                                $bookingsproposedfortwobedroom = $checktwobedroomselected; //get number of rooms that can be occupied as per selected number in form.
                                if ($bookingsproposedfortwobedroom > $possiblebookingsfortwobedrooms) {
                                    echo 'two_bed_room_exeeded';
                                } else {
                                    $totaltwobedroomstobebooked = ceil($bookingsproposedfortwobedroom / 4); //two bed rooms to be booked as per input in the form
                                    $totalfortwobedroom = $totaltwobedroomstobebooked * $days * $getalltwobedroomprice;//total amount for two bed rooms to be booked

                                    //check two bed rooms
                                    $checkthreebedroomselected = (strlen($threeroom) < 1) ? 0 : $threeroom; //get selected number of people to stay in three bedrooms from the form
                                    $possiblebookingsforthreebedrooms = $countthreerooms * 6; //get total possible occupants of three bedrooms from the database
                                    $bookingsproposedforthreebedroom = $checkthreebedroomselected; //get number of rooms that can be occupied as per selected number in form.
                                    if ($bookingsproposedforthreebedroom > $possiblebookingsforthreebedrooms) {
                                        echo 'three_bed_room_exeeded';
                                    } else {
                                        $totalthreebedroomstobebooked = ceil($bookingsproposedforthreebedroom / 6); //three bed rooms to be booked as per input in the form
                                        $totalforthreebedroom = $totalthreebedroomstobebooked * $days * $getallthreebedroomprice; //total amount for three bed rooms to be booked

                                        $grossamount = $totalforsinglerooms + $totalforonebedroom + $totalfortwobedroom + $totalforthreebedroom; //final gross amount
                                        $totalvisitors = $oneroom + $singleroom + $threeroom + $tworoom;//total number of visitors as from form

                                        //check available rooms vs required rooms
                                        echo $totalthreebedroomstobebooked;

                                        if ($totalsingleroomstobebooked > $countsingle) {
                                            echo 'Single Rooms Allocated are not enough for this group of people';
                                        } else if ($totalonebedroomstobebooked > $countonerooms) {
                                            echo 'One Bed Rooms Allocated are not enough for this group of people';

                                        } else if ($totaltwobedroomstobebooked > $counttworooms) {
                                            echo 'Two Bedrooms Allocated are not enough for this group of people';

                                        } else if ($totalthreebedroomstobebooked > $countthreerooms) {
                                            echo 'Three Bedrooms Allocated are not enough for this group of people';

                                        } else {

                                            echo '
<p>                                            <hr>
                                            <table class="table table-bordered">
                                            <thead>
                                            <th><center>SUMMARY</center></th>
                                            <th><center>AMOUNT</center></th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Single Rooms</td>
                                                <td>' . $countsingle . '</td>
                                            </tr>
                                            <tr>
                                                <td>One Bed Rooms</td>
                                                <td>' . $totalonebedroomstobebooked . '</td>
                                            </tr>
                                            <tr>
                                                <td>Two Bed Rooms</td>
                                                <td>' . $totaltwobedroomstobebooked . '</td>
                                            </tr>
                                            <tr>
                                                <td>Three Bed Rooms</td>
                                                <td>' . $totalthreebedroomstobebooked . '</td>
                                            </tr>
                                            <tr>
                                                <td><strong>VISITORS</strong></td>
                                                <td>' . $totalvisitors . '</td>
                                            </tr>
                                            <tr>
                                                <td><strong>DURATION</strong></td>
                                                <td>' . $days . ' day(s)</td>
                                            </tr>
                                            <tr>
                                                <td><strong>TOTAL COST</strong</td>
                                                <td>' . $grossamount . '</td>
                                            </tr>
</tbody>
</table>
                                            <br>
                                            
                                            Total amounts could be subjected to a maximum of 10% discounts.
                                            <hr>
                                            <div class="form-group col-md-12">
                                    <div class="col-lg-12">
                                        <label class="display-block">Amount Paid</label>

                                        <div class="input-group col-lg-12">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-cash2"></i></span>
                                            <input type="number" onfocus="$(\'#btnMakeBooking\').prop(\'disabled\', false);" class="form-control input-xlg"
                                                   id="amountpaid"
                                                   placeholder="Enter Amount Paid">
                                        </div>
                                    </div>
                                </div>
                                        
</p>';

                                        }
                                    }
                                }
                            }


                        }


                    }
                }

            } else {
                echo 'visitors_count_does_not_match';
            }
        } else {
            echo 'Group bookings is considered for 6 people or more';
        }
    }

    public function save_booking_details_completed()
    {

        $roombooked = $this->input->post('rooms', true);
        $checkin = $this->input->post('checkin', true);
        $checkout = $this->input->post('checkout', true);
        $residents = $this->input->post('residents', true);
        $amountpaid = $this->input->post('amountpaid', true);
        $singleroom = $this->input->post('singleroom', true);
        $oneroom = $this->input->post('oneroom', true);
        $tworoom = $this->input->post('tworoom', true);
        $threeroom = $this->input->post('threeroom', true);

        $submittedsingles = strlen(($singleroom));
        $submittedonebedroom = strlen(($oneroom));
        $submittedtwobedroom = strlen(($tworoom));
        $submittedthreebedroom = strlen(($threeroom));

        if ($submittedsingles < 1) {
            $singleroom = 0;
        }
        if ($submittedonebedroom < 1) {
            $oneroom = 0;
        }
        if ($submittedtwobedroom < 1) {
            $tworoom = 0;
        }
        if ($submittedthreebedroom < 1) {
            $threeroom = 0;
        }

        $expectedvisitors = $singleroom + $oneroom + $tworoom + $threeroom;
        if ($residents > 5) {
            if ($residents == $expectedvisitors) {

                $data = array($roombooked, $checkin, $checkout, $residents, $amountpaid);

                if (strlen($checkin) === 0) {
                    echo 'enter_checkin';
                } else if (strlen($checkout) === 0) {
                    echo 'enter_checkout';
                } else {
                    $datetoday = strtotime(Date('Y-m-d'));

                    $enddate = strtotime($checkout);
                    $startdate = strtotime($checkin);

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

                        //get number of rooms from the database using selected room numbers
                        $getsinglerooms = $this->db->query("select count(*) as singlerooms from tbl_rooms where id in ($roombooked) and roomtype='1'")->row();
                        $countsingle = ($getsinglerooms->singlerooms == null) ? 0 : $getsinglerooms->singlerooms;
                        $selectedoneroom = $this->db->query("select count(*) as selectedoneroom from tbl_rooms where id in ($roombooked) and roomtype='2'")->row();
                        $countonerooms = ($selectedoneroom->selectedoneroom == null) ? 0 : $selectedoneroom->selectedoneroom;
                        $gettworooms = $this->db->query("select count(*) as selectedtworooms from tbl_rooms where id in ($roombooked) and roomtype='3'")->row();
                        $counttworooms = ($gettworooms->selectedtworooms == null) ? 0 : $gettworooms->selectedtworooms;
                        $getthreerooms = $this->db->query("select count(*) as selectedthreerooms from tbl_rooms where id in ($roombooked) and roomtype='4'")->row();
                        $countthreerooms = ($getthreerooms->selectedthreerooms == null) ? 0 : $getthreerooms->selectedthreerooms;
                        //end

                        //get pricing for each type of room
                        $getallsinglespricefetch = $this->db->query("select amountperperson from tbl_rooms where roomtype='1' limit 1");
                        $getallonebedroompricefetch = $this->db->query("select amountperperson from tbl_rooms where roomtype='2' and booked=0 limit 1");
                        $getalltwobedroompricefetch = $this->db->query("select amountperperson from tbl_rooms where roomtype='3' and booked=0 limit 1");
                        $getallthreebedroompricefetch = $this->db->query("select amountperperson from tbl_rooms where roomtype='4' and booked=0 limit 1");

                        if ($getallsinglespricefetch->num_rows()<1) {
                            $getallsinglesprice = 0;
                        } else {
                            $singleroomdata = $getallsinglespricefetch->row();
                            $getallsinglesprice = $singleroomdata->amountperperson;
                        }

                        if ($getallonebedroompricefetch->num_rows()<1) {
                            $getallonebedroomprice = 0;
                        } else {
                            $oneroomdata = $getallonebedroompricefetch->row();
                            $getallonebedroomprice = $oneroomdata->amountperperson;
                        }

                        if ($getalltwobedroompricefetch->num_rows()<1) {
                            $getalltwobedroomprice = 0;
                        } else {
                            $tworoomdata = $getalltwobedroompricefetch->row();
                            $getalltwobedroomprice = $tworoomdata->amountperperson;
                        }
                        if ($getallthreebedroompricefetch->num_rows()<1) {
                            $getallthreebedroomprice = 0;
                        } else {
                            $threeroomdata = $getallonebedroompricefetch->row();
                            $getallthreebedroomprice = $threeroomdata->amountperperson;
                        }
//end

                        //calculate pricing per type of room

                        $emptysingleroom = strlen($singleroom);
                        $emptyonebedroom = strlen($oneroom);
                        $emptytwobedroom = strlen($tworoom);
                        $emptythreebedroom = strlen($threeroom);


                        $checksingleselected = (strlen($singleroom) < 1) ? 0 : $singleroom;
                        $possiblebookingsforsinglerooms = $countsingle * 2;
                        $totalsingleroomstobebooked = ceil($possiblebookingsforsinglerooms / 2);

                        if ($checksingleselected > $possiblebookingsforsinglerooms) {
                            //check if single rooms has been exceeded the available
                            echo 'single_exceeded';
                        } else {
                            //price for single rooms
//                            $totalforsinglerooms = $countsingle * $checksingleselected * $days * $getallsinglesprice;
                            $totalforsinglerooms = $checksingleselected * $days * $getallsinglesprice;


                            //check one bedrooms
                            $checkonebedroomselected = (strlen($oneroom) < 1) ? 0 : $oneroom; //get selected number of people to stay in one bedrooms from the form
                            $possiblebookingsforonebedrooms = $countonerooms * 2; //get total possible occupants of one bedrooms from the database
                            $bookingsproposedforonebedroom = $checkonebedroomselected; //get number of rooms that can be occupied as per selected number in form.
                            if ($bookingsproposedforonebedroom > $possiblebookingsforonebedrooms) {
                                echo 'one_bed_room_exeeded';
                            } else {
                                $totalonebedroomstobebooked = ceil($bookingsproposedforonebedroom / 2); //one bed rooms to be booked as per input in the form
                                $totalforonebedroom = $totalonebedroomstobebooked * $days * $getallonebedroomprice;//total amount for one bed rooms to be booked

                                //check two bed rooms
                                $checktwobedroomselected = (strlen($tworoom) < 1) ? 0 : $tworoom; //get selected number of people to stay in two bedrooms from the form
                                $possiblebookingsfortwobedrooms = $counttworooms * 4; //get total possible occupants of two bedrooms from the database
                                $bookingsproposedfortwobedroom = $checktwobedroomselected; //get number of rooms that can be occupied as per selected number in form.
                                if ($bookingsproposedfortwobedroom > $possiblebookingsfortwobedrooms) {
                                    echo 'two_bed_room_exeeded';
                                } else {
                                    $totaltwobedroomstobebooked = ceil($bookingsproposedfortwobedroom / 4); //two bed rooms to be booked as per input in the form
                                    $totalfortwobedroom = $totaltwobedroomstobebooked * $days * $getalltwobedroomprice;//total amount for two bed rooms to be booked

                                    //check two bed rooms
                                    $checkthreebedroomselected = (strlen($threeroom) < 1) ? 0 : $threeroom; //get selected number of people to stay in three bedrooms from the form
                                    $possiblebookingsforthreebedrooms = $countthreerooms * 6; //get total possible occupants of three bedrooms from the database
                                    $bookingsproposedforthreebedroom = $checkthreebedroomselected; //get number of rooms that can be occupied as per selected number in form.
                                    if ($bookingsproposedforthreebedroom > $possiblebookingsforthreebedrooms) {
                                        echo 'three_bed_room_exeeded';
                                    } else {
                                        $totalthreebedroomstobebooked = ceil($bookingsproposedforthreebedroom / 6); //three bed rooms to be booked as per input in the form
                                        $totalforthreebedroom = $totalthreebedroomstobebooked * $days * $getallthreebedroomprice; //total amount for three bed rooms to be booked

                                        $grossamount = $totalforsinglerooms + $totalforonebedroom + $totalfortwobedroom + $totalforthreebedroom; //final gross amount
                                        $totalvisitors = $oneroom + $singleroom + $threeroom + $tworoom;//total number of visitors as from form

                                        $user = $this->session->all_userdata();
                                        $datatosave = array(
                                            'rooms' => $roombooked,
                                            'duration' => $days,
                                            'nature' => 'group',
                                            'amountpaid' => $amountpaid,
                                            'expectedamount' => $grossamount,
                                            'visitors' => $totalvisitors,
                                            'checkin' => $checkin,
                                            'checkout' => $checkout,
                                            'addedby' => $user['id'],
                                            'status'=>1
                                        );
                                        $discounted = 0.9 * $grossamount; //set the discounts to be maximum of 10%
                                        if ($totalsingleroomstobebooked > $countsingle) {
                                            echo 'Single Rooms Allocated are not enough for this group of people';
                                        } else if ($totalonebedroomstobebooked > $countonerooms) {
                                            echo 'One Bed Rooms Allocated are not enough for this group of people';

                                        } else if ($totaltwobedroomstobebooked > $counttworooms) {
                                            echo 'Two Bedrooms Allocated are not enough for this group of people';

                                        } else if ($totalthreebedroomstobebooked > $countthreerooms) {
                                            echo 'Three Bedrooms Allocated are not enough for this group of people';

                                        } else {

                                            if ($discounted > $amountpaid) {
                                                echo 'Invalid Payments. Amount paid is way below discounted rates';
                                            } else if ($amountpaid > $grossamount) {
                                                echo 'Invalid Payments. Amount paid is way above Gross Amount';
                                            } else {
                                                $this->db->query("update tbl_rooms set booked =1 where id in ($roombooked)");


                                                $this->db->insert('tbl_group_bookings', $datatosave);
                                                if ($this->db->affected_rows() > 0) {
                                                    echo 'success';
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
            } else {
                echo 'visitors_count_does_not_match';
            }
        } else {
            echo 'Group bookings is considered for 6 people or more';
        }
    }

}