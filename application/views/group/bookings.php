<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Group Bookings</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/global_assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url() ?>assets/global_assets/images/favicon.ico" type="image/x-icon">
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="<?= base_url() ?>assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/assets/css/core.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/nicescroll.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/switch.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script src="<?= base_url() ?>assets/assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/assets/js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>

    <script src="<?= base_url() ?>assets/assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_multiselect.js"></script>


    <!--    <script src="--><? //= base_url() ?><!--assets/global_assets/js/demo_pages/form_select2.js"></script>-->

    <!-- /theme JS files -->


    <!-- /theme JS files -->

</head>

<body>

<?php //$this->load->view('partials/navbar') ?>


<!-- Page container -->
<div class="page-container" style="min-height:90% !important;">

    <!-- Page content -->
    <div class="page-content" style="min-height:90% !important;">

        <!-- Main content -->
        <div class="content-wrapper" style="min-height:90% !important;">

            <!-- Basic datatable -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><?= date('Y-m-d') ?></h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a href="<?= base_url('welcome') ?>" class="btn btn-sm btn-default"> Back Home</a></li>
                        </ul>
                    </div>
                </div>

                <fieldset class="content-group">
                    <form id="bookingform" role="form">
                        <div class="col-md-7">
                            <center><p>Only Free (Available Rooms) will be displayed. Rooms with active session will not
                                    be displayed</p></center>


                            <?php
                            $suites = $this->db->query("select * from tbl_rooms_types order by id asc")->result_array();


                            foreach ($suites as $suite):
                                echo '<center><strong>' . strtoupper($suite['roomtype']) . '</strong></center>';
                                echo '<div class="row">';

                                $type = $suite['id'];

                                $rooms = $this->db->query("select id,roomnumber from tbl_rooms where booked='0' and roomtype='$type' order by roomtype asc");
                                $response = $rooms->result_array();
                                if(count($response)>0) {
                                    foreach ($response as $room):
                                        echo '
                                        <div class="col-md-4 col-xs-6">
                                        
                                            <label><input name="suites" type="checkbox" class="control-primary" value="' . $room['id'] . '">' . strtoupper($room['roomnumber']) . '</label>
													
                                        </div> 
                                    ';

                                    endforeach;
                                }else{
                                    echo '<center><p><code>ALL ROOMS BOOKED</code></p></center>';
                                }
                                echo '</div><hr>';
                            endforeach;
                            ?>
                            <br><br>
                            <div class="form-group col-md-6">
                                <label class="display-block">Checkin</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-calendar"></i></span>
                                        <input type="date" class="form-control input-xlg" id="datefrom"
                                               placeholder="Enter Amount Paid">
                                    </div>
                                    <code>REQUIRED</code>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="display-block">Checkout</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-calendar"></i></span>
                                        <input type="date" class="form-control input-xlg" id="dateto"
                                               placeholder="Enter Amount Paid">
                                    </div>
                                    <code>REQUIRED</code>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12">
                                <label class="display-block">Residents</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                        <input type="number" class="form-control input-xlg"
                                               id="residentsnumber"
                                               placeholder="Enter number of residents">
                                        <span id="msgvisitors"></span>
                                    </div>
                                    <code>REQUIRED</code>
                                </div>

                            </div>
                            <div class="form-group col-md-12">
                                <label class="display-block">How many will stay in Single Rooms</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                        <input type="number" class="form-control input-xlg"
                                               id="singleroom"
                                               placeholder="Enter number of single room users">
                                    </div>
                                    <code>Leave blank if room will not be in use, else, Specify the number of people</code>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="display-block">How many will stay in One Bedrooms</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                        <input type="number" class="form-control input-xlg"
                                               id="oneroom"
                                               placeholder="Enter number of single room users">
                                    </div>
                                    <code>Leave blank if room will not be in use, else, Specify the number of people</code>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="display-block">How many will stay in 2 Bed Rooms</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                        <input type="number" class="form-control input-xlg"
                                               id="tworoom"
                                               placeholder="Enter number of 2 Bed room user">
                                    </div>
                                    <code>Leave blank if room will not be in use, else, Specify the number of people</code>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="display-block">How many will stay in 3 Bed Rooms</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                        <input type="number" class="form-control input-xlg"
                                               id="threeroom"
                                               placeholder="Enter number of 3 Bed room users">
                                    </div>
                                    <code>Leave blank if room will not be in use, else, Specify the number of people</code>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="well" style="min-height: 300px">
                                <h3>Invoice summary</h3>
                                <center><button type="button"
                                                class="btn btn-primary " id="btngetSummary"><span>GET SUMMARY</span>
                                    </button></center>
                                <br>
                                <div id="setprice"></div>
                                <hr>

                                <div style=" bottom: 0;">
                                    <center>
                                        <button type="submit"
                                                style="width: 100% !important; min-height: 50px !important; font-size: 40px !important;"
                                                class="btn btn-success btn-lg btn-block btn-huge" id="btnMakeBooking"><i
                                                    class="icon-bed2" style="font-size: 40px !important;"></i> <span>Group Booking</span>
                                        </button>
                                        <br><br>
                                        <button type="button"
                                                class="btn btn-dark " id="" onclick="location.reload()"><span>RESET FIELDS</span>
                                        </button>
                                    </center>
                                    <br>
                                    <br>
                                </div>

                            </div>

                        </div>

                        <br>
                        <br>
                    </form>

                </fieldset>
                <br><br>
            </div>


        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->


<!-- Footer -->
<div class="footer text-muted">
    &copy; 2019. <a href="#">Easy Room Management System</a> by <a href="#" target="_blank">SenSen Ventures</a>

</div>
<script>
$(document).ready(function () {
    $('#btnMakeBooking').prop('disabled', true);
})
    $('#btngetSummary').click(function (e) {
        $('#setprice').empty();
        $('#btnMakeBooking').prop('disabled', true);

        e.preventDefault();
        var room = [];
        $.each($("input[name='suites']:checked"), function () {
            var selectedroom = $(this).val();
            room.push(selectedroom);
        });
        var rooms = room.join(", ");
        var checkin = $('#datefrom').val();
        var checkout = $('#dateto').val();
        var residents = $('#residentsnumber').val();
        var amountpaid = $('#amountpaid').val();
        var roomsnumber = rooms.split(",");
        var singleroom = $('#singleroom').val();
        var oneroom = $('#oneroom').val();
        var tworoom = $('#tworoom').val();
        var threeroom = $('#threeroom').val();

        if (roomsnumber.length < 2) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'To qualify as Group Booking You must select more than One Room'
            })
        } else if (residents < 1) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Enter the Number of people in the Group'
            })
        }else if (singleroom.length < 1 && oneroom.length < 1 && tworoom.length < 1 && threeroom.length < 1) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Specify the number of guests taking each type of room'
            })
        } else {
            $.ajax({
                url: '<?=base_url('group_bookings/save_booking_details/')?>',
                method: 'post',
                data: {
                    rooms: rooms,
                    checkin: checkin,
                    checkout: checkout,
                    residents: residents,
                    singleroom: singleroom,
                    oneroom: oneroom,
                    tworoom: tworoom,
                    threeroom: threeroom
                },
                success: function (response) {
                    // var data = parse.json(response);
                    var data = response;
                    if (data === 'enter_checkin') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Specify the Checkin Date'
                        })
                    } else if (data === 'enter_checkout') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Specify the Checkout Date'
                        })
                    } else if (data === 'start_greater_than_today' || data === 'end_before_today' || data === 'invalid_request') {
                        Swal.fire({
                            type: 'error',
                            text: 'Checkin and Checkout dates are invalid. Check your Date selection and retry'
                        })
                    } else if (data === 'failed_amount') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Payment should be made in Full'
                        })
                    } else if (data === 'room_already_booked') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Booking Failed! One of the Rooms has an active session already.'
                        })
                    } else if (data === 'min_limit') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'The number of visitors does not qualify to book this room'
                        })
                    } else if (data === 'max_limit') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'The number of visitors are in excess hence does not qualify to book this room'
                        })
                    } else {
                        $('#setprice').empty();
                        $('#setprice').append(data);

                    }


                }, error: function (data, exception) {

                    swal.fire(
                        'Error',
                        'We could not process this request. Check your connection and Try again',
                        'error'
                    )
                }
            });


        }
    });
    $('#btnMakeBooking').click(function (e) {
        e.preventDefault();
        var room = [];
        $.each($("input[name='suites']:checked"), function () {
            var selectedroom = $(this).val();
            room.push(selectedroom);
        });
        var rooms = room.join(", ");
        var checkin = $('#datefrom').val();
        var checkout = $('#dateto').val();
        var residents = $('#residentsnumber').val();
        var amountpaid = $('#amountpaid').val();
        var roomsnumber = rooms.split(",");
        var singleroom = $('#singleroom').val();
        var oneroom = $('#oneroom').val();
        var tworoom = $('#tworoom').val();
        var threeroom = $('#threeroom').val();

        if (roomsnumber.length < 2) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'To qualify as Group Booking You must select more than One Room'
            })
        } else if (residents < 1) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Enter the Number of people in the Group'
            })
        }else if (singleroom.length < 1 && oneroom.length < 1 && tworoom.length < 1 && threeroom.length < 1) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Specify the number of guests taking each type of room'
            })
        } else if (amountpaid.length < 3) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Enter the Amount Paid by the Group'
            })
        } else {
            $.ajax({
                url: '<?=base_url('group_bookings/save_booking_details_completed/')?>',
                method: 'post',
                data: {
                    rooms: rooms,
                    checkin: checkin,
                    checkout: checkout,
                    residents: residents,
                    singleroom: singleroom,
                    amountpaid: amountpaid,
                    oneroom: oneroom,
                    tworoom: tworoom,
                    threeroom: threeroom
                },
                success: function (response) {
                    // var data = parse.json(response);
                    var data = response;
                    if (data === 'enter_checkin') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Specify the Checkin Date'
                        })
                    } else if (data === 'enter_checkout') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Specify the Checkout Date'
                        })
                    } else if (data === 'start_greater_than_today' || data === 'end_before_today' || data === 'invalid_request') {
                        Swal.fire({
                            type: 'error',
                            text: 'Checkin and Checkout dates are invalid. Check your Date selection and retry'
                        })
                    } else if (data === 'failed_amount') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Payment should be made in Full'
                        })
                    } else if (data === 'room_already_booked') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Booking Failed! One of the Rooms has an active session already.'
                        })
                    } else if (data === 'min_limit') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'The number of visitors does not qualify to book this room'
                        })
                    } else if (data === 'max_limit') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'The number of visitors are in excess hence does not qualify to book this room'
                        })
                    } else if(data ==='success'){
                        swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Group Booking was a Success',
                            allowOutsideClick:false,
                            allowEscapeKey:false
                        }).then(function () {
                            location.reload();
                        })
                    }else{
                        swal.fire({
                            html: data,
                        })
                    }


                }, error: function (data, exception) {

                    swal.fire(
                        'Error',
                        'We could not process this request. Check your connection and Try again',
                        'error'
                    )
                }
            });


        }
    });


</script>
</body>

</html>
