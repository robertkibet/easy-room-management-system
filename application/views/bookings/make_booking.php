<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book a Room</title>
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

    <script src="<?= base_url() ?>assets/assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
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

                            <div class="form-group col-md-12">
                                <label class="control-label col-lg-2">Select an Estate</label>

                                <div class="col-lg-8">
                                    <select class="select-size-lg" id="estates" style="width: 100% !important;">
                                        <option selected value="0"> -- Select Estate --</option>
                                        <?php
                                        $getestate = $this->db->query("select * from tbl_estates order by estatename asc")->result_array();
                                        foreach ($getestate as $estates_list):
                                            echo '<option value="' . $estates_list['id'] . '">' . ucwords($estates_list['estatename']) . '</option>';
                                        endforeach;
                                        ?>
                                        <option disabled> End of List</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12" style="width: 100% !important;">
                                <label class="control-label col-lg-2">Type of Room</label>

                                <div class="col-lg-8">
                                    <select class="select-size-lg" id="typeofroom" style="width: 100% !important;">
                                        <option selected value="0"> -- select estates first --</option>

                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12">
                                <label class="control-label col-lg-2">Select Room</label>

                                <div class="col-lg-8">
                                    <select class="select-size-lg" id="selectroom" style="width: 100% !important;">
                                        <option selected="selected" value="0">-- Select type of room first --</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>

                            <div class="form-group col-md-12">
                                <label class="control-label col-lg-2">Checkin</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-calendar"></i></span>
                                        <input type="date" class="form-control input-xlg" id="datefrom"
                                               placeholder="Enter Amount Paid">
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12">
                                <label class="control-label col-lg-2">Checkout</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-calendar"></i></span>
                                        <input type="date" class="form-control input-xlg" id="dateto"
                                               placeholder="Enter Amount Paid">
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12">
                                <label class="control-label col-lg-2">Residents</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                        <input onkeyup="viewcharges()" type="number" class="form-control input-xlg"
                                               id="residentsnumber"
                                               placeholder="Enter number of residents">
                                        <span id="msgvisitors"></span>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <!--                            <div class="form-group col-md-12">-->
                            <!--                                <label class="control-label col-lg-2">Checkin Date</label>-->
                            <!--                                <div class="col-lg-8">-->
                            <!--                                    <div class="input-group">-->
                            <!--                                                <span class="input-group-addon bg-primary"><i-->
                            <!--                                                            class="icon-calendar"></i></span>-->
                            <!--                                        <input type="date" class="form-control input-xlg" id="checkin"-->
                            <!--                                               placeholder="Checkin Date">-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->

                        </div>
                        <div class="col-md-5">
                            <div class="well" style="min-height: 300px">
                                <h3>Invoice summary</h3>
                                <br>
                                <div class="table-responsive" id="setpricing">

                                </div>
                                <br>
                                <div class="table-responsive" id="settotal">

                                </div>
                                <br><br><br>
                                <div class="form-group col-md-12">
                                    <label class="control-label col-lg-2">Checklist</label>
                                    <div class="col-lg-10">

                                <span>
                                    <input type="checkbox" class="switchery" name="paymentcompleted"
                                           id="paymentcompleted"
                                           value="paymentcomplete">
                                    Payment Completed
                                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span>
                                    <input type="checkbox" class="switchery" id="agreementsigned"
                                           value="agreementsigned">
                                    Agreement Signed
                                </span>
                                    </div>
                                </div>
                                <br>
                                <h3 id="setprice"></h3>
                                <br><br>
                                <div class="form-group col-md-12">
                                    <div class="col-lg-12">
                                        <label class="control-label col-lg-4">Billing Per Day</label>

                                        <div class="input-group col-lg-8">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-cash2"></i></span>
                                            <input onblur="gettotals()" type="number" class="form-control input-xlg"
                                                   id="billing"
                                                   placeholder="Enter Billing Per Day">
                                            <span id="msgstatus"></span>
                                            <input type="hidden" id="totalsvals">

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5 id="totaltobepayed"></h5>
                                <br>
                                <div class="form-group col-md-12">
                                    <div class="col-lg-12">
                                        <label class="control-label col-lg-4">Amount Paid</label>

                                        <div class="input-group col-lg-8">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-cash2"></i></span>
                                            <input onkeyup="checktotals()" type="number" class="form-control input-xlg"
                                                   id="amountpaid"
                                                   placeholder="Enter Amount Paid">
                                        </div>
                                    </div>
                                </div>
                                <div style=" bottom: 0;">
                                    <center>
                                        <button type="submit"
                                                style="width: 100% !important; min-height: 50px !important; font-size: 40px !important;"
                                                class="btn btn-success btn-lg btn-block btn-huge" id="btnMakeBooking"><i
                                                    class="icon-bed2" style="font-size: 40px !important;"></i> <span>Make Booking</span>
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

            <!-- Basic datatable -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <center><h4>Recent Bookings</h4>
                    </center>
                </div>
                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Room</th>
                        <th>Days</th>
                        <th>Checkin</th>
                        <th>Days</th>
                        <th>Rates</th>
                        <th>Amount Paid</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $date = date('Y-m-d');
                    $estates = $this->db->query("select * from bookings order by id desc limit 3")->result_array();
                    if (count($estates) > 0):
                        $i = 0;
                        foreach ($estates as $estate):
                            $i++;
                            $id = $estate['room'];
                            $estateid = $estate['estate'];
                            $room = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$id'")->row();
                            $getroom = $room->roomnumber;
                            $estatefind = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                            $getestate = $estatefind->estatename;

                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><a href="#"><?= ucwords($getroom) ?></a></td>
                                <td><span class="label label-success" style=""><?= $estate['days'] ?> days </span></td>
                                <td><?= $estate['checkin'] ?></td>
                                <td><?= $estate['days'] ?></td>
                                <td><?= 'KES.' . number_format($estate['billing']) ?></td>
                                <td><?= 'KES.' . number_format($estate['amountpaid']) ?></td>

                            </tr>
                        <?php
                        endforeach;
                    endif; ?>

                    </tbody>
                </table>


            </div>
            <!-- /basic datatable -->

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
    function gettotals() {
        var base = document.getElementById('getnodays').value;
        var users = document.getElementById('residentsnumber').value;
        var roomtype = $('#typeofroom').val();
        var numberField = document.getElementById('billing');

        numberField.onblur = numberField.onpaste = function () {
            if (this.value.length === 0) {
                document.getElementById('totaltobepayed').innerHTML = '';
                return;
            }
            var number = parseInt(this.value);
            if (isNaN(number)) return;
            var rates = document.getElementById('getrates').value;
            var maxrates = rates + <?= $this->config->item('maxrates')?>;
            var minrates = rates - <?= $this->config->item('minrates')?>;
            if (number > maxrates) {

                document.getElementById('msgstatus').innerHTML = '<code style="font-size:10px !important;">You have exceeded Allowed Rates</code>';
                $('#billing').val('');
            } else if (minrates > number) {
                document.getElementById('msgstatus').innerHTML = '<code style="font-size:10px !important;">You are way below Allowed Rates</code>';
                $('#btnMakeBooking').prop("disabled", true);
                $('#billing').val('');
            } else {
                document.getElementById('msgstatus').innerHTML = '';
                // alert(roomtype)

                if(roomtype==1){
                    var totals = number * base * users;

                }else{
                    var totals = number * base;

                }

                document.getElementById('totaltobepayed').innerHTML = '<p>TOTAL BILLING: <strong>KES. ' + totals + '</strong></p>';
                $('#totalsvals').val(totals);

            }
        };
        numberField.onblur(); //could just as easily have been onpaste();
    }

    function checktotals() {
        var checktotal = parseInt(document.getElementById('totalsvals').value);
        var total = parseInt(document.getElementById('amountpaid').value);
        // alert(total+'---'+checktotal)

        if (checktotal === total) {
            $('#btnMakeBooking').prop("disabled", false);

        }

    }

    function viewcharges() {
        document.getElementById('msgvisitors').innerHTML = '';

        var estates = $('#estates').select2().val();
        var typeofroom = $('#typeofroom').select2().val();
        var selectroom = $('#selectroom').select2().val();
        var residentsnumber = document.getElementById('residentsnumber').value;
        // alert(residentsnumber);
        var datefrom = $('#datefrom').val();
        var dateto = $('#dateto').val();

        $.ajax({
            url: '<?=base_url('welcome/viewcharges/')?>',
            method: 'post',
            data: {
                estates: estates,
                typeofroom: typeofroom,
                selectroom: selectroom,
                residentsnumber: residentsnumber,
                datefrom: datefrom,
                dateto: dateto
            },
            dataType: 'html',
            success: function (response) {
                $('#settotal').empty();

                var data = response;
                if (data === 'enter_checkin') {
                    swal.fire({
                        type: 'error',
                        title: 'Failed',
                        text: 'Specify the Checkin Date'
                    })
                    $('#residentsnumber').val('');
                } else if (data === 'enter_checkout') {
                    swal.fire({
                        type: 'error',
                        title: 'Failed',
                        text: 'Specify the Checkout Date'
                    })
                    $('#residentsnumber').val('');


                } else if (data === 'minreached') {
                    document.getElementById('msgvisitors').innerHTML = '<code>Enter the number of Visitors</code>';
                    $('#residentsnumber').val('');


                } else if (data === 'maxreached') {
                    swal.fire({
                        type: 'error',
                        title: 'Failed',
                        text: 'You have exceeded maximum allowed people for this room'
                    })
                    $('#residentsnumber').val('');


                } else if (data === 'missing_house') {
                    swal.fire({
                        type: 'error',
                        title: 'Failed',
                        text: 'Select Estate, Type of Room and Room Number first'
                    })
                    $('#residentsnumber').val('');


                } else if (data === 'start_greater_than_today' || data === 'end_before_today' || data === 'invalid_request') {
                    Swal.fire({
                        type: 'error',
                        text: 'Checkin and Checkout dates are invalid. Check your Date selection and retry'
                    })
                    $('#residentsnumber').val('');

                } else {
                    if (data === 'failed_amount') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Payment should be made in Full'
                        })
                        $('#residentsnumber').val('');

                    } else if (data === 'room_already_booked') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'We failed to make this Booking for it has an existing session already'
                        })
                        $('#residentsnumber').val('');

                    } else if (data === 'min_limit') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'The number of visitors does not qualify to book this room'
                        })
                        $('#residentsnumber').val('');

                    } else if (data === 'max_limit') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'The number of visitors are in excess hence does not qualify to book this room'
                        })
                        $('#residentsnumber').val('');

                    } else {
                        document.getElementById('msgvisitors').innerHTML = '';

                        $('#settotal').append(response);
                    }
                }

            }
        });

    }

    function clearbooking(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You are about to make a Room Checkout. This Room will be made available for new bookings",
            icon: "warning",
            buttons: [
                'Cancel it!',
                'Yes, Proceed!'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '<?=base_url('welcome/checkout/')?>',
                    method: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function (response) {
                        if (response === 'checked_out') {
                            swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Checkout Success'
                            })
                        } else {
                            swal.fire({
                                type: 'failed',
                                title: 'Failed',
                                text: 'Try again or contact administrator'
                            })
                        }
                    }
                });

            } else {
                Swal.fire("Cancelled", "Your imaginary file is safe :)", "info");
            }
        })
    }

</script>
<script type="application/javascript">
    $(document).ready(function () {
        $('#btnMakeBooking').prop("disabled", true);

        var checkbox = document.querySelector("input[name=paymentcompleted]");

        $('#estates').select2();
        $('#selectroom').select2();
        $('#typeofroom').select2();

        // City change
        // document.getElementById('residentsnumber').addEventListener('KeyUp', function () {
        //
        // });
        $('#estates').keypress(function () {
            var residents = $('#residentsnumber').val();
            var roomprice = $('#getroomprice').val();

            if (roomprice.length < 1) {
                swal.fire({
                    type: 'error',
                    text: 'Please select the Room first'
                });
            } else {
                var total = residents * roomprice;
                $('#setprice').append('KES. ' + total);
            }
        });
        $('#estates').change(function () {

            $('#setpricing').empty();
            $('#settotal').empty();
            // $('#estates').empty();
            $('#typeofroom').empty();
            $('#selectroom').empty();
            $('#residentsnumber').empty();
            $('#datefrom').empty();
            $('#dateto').empty();
            $('#typeofroom').empty();
            $('#selectroom').empty();
            $('#typeofroom').append('<option value="0" selected><i class="fa fa-spinner-third"></i> processing</option>');
            $('#selectroom').append('<option value="0" selected>-- select type of room first</option>');

            var estate = $(this).val();

            // AJAX request
            $.ajax({
                url: '<?=base_url('welcome/getRoomsType/')?>',
                method: 'post',
                data: {estate: estate},
                dataType: 'json',
                success: function (response) {
                    $('#typeofroom').empty();
                    if (response.length < 1) {
                        $('#typeofroom').append('<option value="0">No Rooms Available</option>');


                    } else {

                        // Remove options
                        $('#typeofroom').find('option').not(':first').remove();
                        $('#typeofroom').append('<option value="0" selected>-- Select Type Room --</option>');

                        $.each(response, function (index, data) {
                            $('#typeofroom').append('<option value="' + data['id'] + '">' + data['roomtype'] + '</option>');
                        });
                    }
                }
            });
        });
        $('#typeofroom').change(function () {
            $('#setpricing').empty();
            $('#settotal').empty();

            // $('#estates').empty();
            // $('#typeofroom').empty();
            // $('#selectroom').empty();
            $('#residentsnumber').empty();
            $('#datefrom').empty();
            $('#dateto').empty();

            $('#selectroom').empty();
            $('#selectroom').append('<option selected value="0" selected><i class="fa fa-spinner-third"></i> processing</option>');

            var typeofroom = $(this).val();
            var estate = $('#estates').val();

            // AJAX request
            $.ajax({
                url: '<?=base_url('welcome/getRooms/')?>',
                method: 'post',
                data: {
                    estate: estate,
                    typeofroom: typeofroom
                },
                dataType: 'json',
                success: function (response) {
                    $('#selectroom').empty();
                    if (response.length < 1) {
                        $('#selectroom').append('<option value="0" selected>No Rooms Available</option>');

                    } else {


                        // Remove options
                        $('#selectroom').find('option').not(':first').remove();
                        $('#selectroom').append('<option value="0">-- Select Room --</option>');

                        $.each(response, function (index, data) {
                            $('#selectroom').append('<option value="' + data['id'] + '">' + data['roomnumber'] + '</option>');
                        });
                    }
                }
            });
        });
        $('#selectroom').change(function () {
            $('#setpricing').empty();
            $('#settotal').empty();

            // $('#estates').empty();
            // $('#typeofroom').empty();
            // $('#selectroom').empty();
            $('#residentsnumber').empty();
            $('#datefrom').empty();
            $('#dateto').empty();

            var room = $(this).val();
            var estates = $('#estates').select2().val();

            // AJAX request
            $.ajax({
                url: '<?=base_url('welcome/getcharges/')?>',
                method: 'post',
                data: {
                    estate: estates,
                    room: room
                },
                dataType: 'html',
                success: function (response) {
                    $('#setpricing').append(response);
                }
            });
        });

        $('#btnMakeBooking').click(function (e) {
            e.preventDefault();

            var estates = $('#estates').select2().val();
            var typeofroom = $('#typeofroom').select2().val();
            var selectroom = $('#selectroom').select2().val();
            var residentsnumber = $('#residentsnumber').val();
            // var checkin = $('#checkin').val();
            var datefrom = $('#datefrom').val();
            var dateto = $('#dateto').val();
            var paymentcompleted = $('#paymentcompleted').val();
            var agreementsigned = $('#agreementsigned').prop("checked");
            var amountpaid = $('#amountpaid').val();

            if (estates == 0) {
                swal.fire({
                    type: 'error',
                    title: 'Failed',
                    text: 'Please select Estate'
                }).then(function () {
                    $('#estates').focus();
                });
            } else if (typeofroom == 0) {
                swal.fire({
                    type: 'error',
                    title: 'Failed',
                    text: 'Please select Type of Room'
                }).then(function () {
                    $('#typeofroom').focus();
                });
            } else if (selectroom == 0) {
                swal.fire({
                    type: 'error',
                    title: 'Failed',
                    text: 'Please select Room to Give'
                }).then(function () {
                    $('#selectroom').focus();
                });
            } else if (residentsnumber === 0) {
                swal.fire({
                    type: 'error',
                    title: 'Failed',
                    text: 'Enter the number of residents'
                }).then(function () {
                    $('#residentsnumber').focus();
                });
            } else if (agreementsigned === false) {
                swal.fire({
                    type: 'error',
                    title: 'Failed',
                    text: 'Agreement must be signed by client. Check and update if signed.'
                }).then(function () {
                    $('#agreementsigned').focus();
                });
            } else if (paymentcompleted === false) {
                swal.fire({
                    type: 'error',
                    title: 'Failed',
                    text: 'Payment Must be made to completion'
                }).then(function () {
                    $('#amountpaid').focus();
                });
            } else if (amountpaid == 0) {
                swal.fire({
                    type: 'error',
                    title: 'Failed',
                    text: 'Enter the Amount Paid'
                }).then(function () {
                    $('#amountpaid').focus();
                });
            } else {

                var billing = $('#billing').val();

                if (billing.length !== 4) {
                    swal.fire({
                        type: 'error',
                        title: 'Failed',
                        text: 'Specify Amount to be billed per day'
                    })
                    $('#billing').focus();

                } else {
                    $.ajax({
                        url: '<?=base_url('welcome/checkdiscounts/')?>',
                        method: 'post',
                        data: {
                            estates: estates,
                            selectroom: selectroom,
                            billing: billing
                        },
                        dataType: 'html',
                        success: function (response) {
                            var data = response;
                            if (data === 'rates_accepted') {

                                $.ajax({
                                    url: '<?=base_url('welcome/make_booking/')?>',
                                    method: 'post',
                                    data: {
                                        estates: estates,
                                        typeofroom: typeofroom,
                                        selectroom: selectroom,
                                        residentsnumber: residentsnumber,
                                        datefrom: datefrom,
                                        dateto: dateto,
                                        paymentcompleted: paymentcompleted,
                                        agreementsigned: agreementsigned,
                                        amountpaid: amountpaid,
                                        billing: billing


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
                                        } else {
                                            if (data === 'failed_amount') {
                                                swal.fire({
                                                    type: 'error',
                                                    title: 'Failed',
                                                    text: 'Payment should be made in Full'
                                                })
                                            } else if (data === 'room_already_booked') {
                                                swal.fire({
                                                    type: 'error',
                                                    title: 'Failed',
                                                    text: 'We failed to make this Booking for it has an existing session already'
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
                                                swal.fire({
                                                    type: 'success',
                                                    title: 'Success',
                                                    text: 'Room Booked'
                                                }).then(function () {
                                                    location.reload();
                                                })
                                                //    .then(function(){
                                                //    window.location="<?//= base_url('welcome/bookings/receipt/')?>//"+data;
                                                //})
                                            }
                                        }

                                    }, error: function (data, exception) {

                                        swal.fire(
                                            'Error',
                                            'We could not process this request. Check your connection and Try again',
                                            'error'
                                        )
                                    }
                                });
                            } else {

                                swal.fire({
                                    type: 'info',
                                    title: 'Failed',
                                    text: 'Billing per Day should match the suite amount per day or discounted amount per day'
                                })
                            }
                        }
                    })
                }


            }
        });

        function sort_payment(estates, typeofroom, checkin, selectroom, residentsnumber, datefrom, dateto, paymentcompleted, agreementsigned, amountpaid) {
        }
    });
</script>
</body>

</html>
