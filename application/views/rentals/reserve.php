<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Make Rental Reservation</title>

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
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_select2.js"></script>

    <!-- /theme JS files -->


    <!-- /theme JS files -->

</head>

<body >

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
                                <label class="display-block">Select Suite</label>

                                <div class="col-lg-8">
                                    <select onblur="process_reservation()"  class="select" id="typeofroom" style="width: 100% !important;">
                                        <option selected value="0"> -- Select Suite --</option>
                                        <?php
                                        $getestate = $this->db->query("select * from tbl_rentals_rates order by suite asc")->result_array();
                                        foreach ($getestate as $estates_list):
                                            $suiteid = $estates_list['suite'];
                                            $suite = $this->db->query("select * from tbl_rooms_types where id='$suiteid'")->row();

                                            echo '<option value="' . $suite->id . '">' . ucwords($suite->roomtype) . '</option>';
                                        endforeach;
                                        ?>
                                        <option disabled> End of List</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12">
                                <label class="display-block">Select Room</label>

                                <div class="col-lg-8">
                                    <select onblur="process_reservation()"  class="select" id="selectroom" style="width: 100% !important;">
                                        <option selected="selected" value="0">-- Select type of room first --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="display-block">When does the client intend to Move in?</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-calendar"></i></span>
                                        <input onblur="process_reservation()"  type="date" class="form-control input-xlg" id="datefrom"
                                               placeholder="Enter Amount Paid">
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12">
                                <label class="display-block">When does the client intend to Check Out?</label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-calendar"></i></span>
                                        <input onblur="process_reservation()"  type="date" class="form-control input-xlg" id="dateto"
                                               placeholder="Enter Amount Paid">
                                    </div>
                                </div>
                                <span class="col-md-8">
                                <code>If client is staying for more than 1 year or the client is not sure of the checkout date, select last date of the current Year
                                </code>
                                    </span>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12">
                                <label class="display-block">What is the Nature of this Reservation?</label>
                                <div class="col-lg-8">
                                    <select onblur="process_reservation()"  class="select display-block" id="bookingnature"
                                            style="width: 100% !important;">
                                        <option value="0" selected>-- SELECT --</option>
                                        <option value="reserve">Reservation ONLY</option>
                                        <option value="movin">Reservation &amp; Moving IN</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group col-md-12">
                                <label class="display-block">What is the expected duration of stay</label>
                                <div class="col-lg-8">
                                    <select class="select display-block" id="stayduration"
                                            style="width: 100% !important;">
                                        <option value="0" selected>-- SELECT --</option>
                                        <option value="4">MAXIMUM 4 MONTHS</option>
                                        <option value="6">MAXIMUM 6 MONTHS</option>
                                        <option value="12">MAXIMUM 12 MONTHS</option>
                                        <option value="365">OVER 1 YEAR</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        <div class="col-md-5">
                            <div class="well" style="min-height: 300px">
                                <h3>Invoice summary</h3>
                                <br>
                                <div class="table-responsive" id="setrates">

                                </div>
                                <hr>
                                <br>
                                <div class="form-group col-md-12">
                                    <label class="control-label col-lg-2">Checklist</label>
                                    <div class="col-lg-10">
                                        <span>
                                    <input type="checkbox" class="switchery" id="agreementsigned"
                                           value="agreementsigned">
                                    Agreement Signed
                                </span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="display-block">Amount to be Billed per Month?</label>
                                    <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-cash2"></i></span>
                                        <input type="number" class="form-control" id="rent"
                                               value="0">
                                    </div>
                                    <p><code>This is required</code>. Discounts can be made to a Maximum of 10% of the
                                        Standard rate for this Room</p>

                                </div>
                                <br>
                                <div style=" bottom: 0;">
                                    <center>
                                        <button type="submit"
                                                style="width: 100% !important; min-height: 50px !important; font-size: 40px !important;"
                                                class="btn btn-success btn-lg btn-block btn-huge" id="btnMakeBooking"><i
                                                    class="icon-home" style="font-size: 40px !important;"></i> <span>Rent this House</span>
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

    // $('#selectroom').select2();
    function process_reservation(){
        $('#setrates').empty();

        var stay = $('#stayduration');
        var typeofroom = $('#typeofroom').val();
        var selectroom = $('#selectroom').val();
        var datefrom = $('#datefrom').val();
        var dateto = $('#dateto').val();
        var bookingnature = $('#bookingnature').val();
        var stayduration = stay.val();
        var rent = $('#rent').val();

        $.ajax({
            url: '<?=base_url('rental/getrates/')?>',
            method: 'post',
            data: {
                typeofroom: typeofroom,
                selectroom: selectroom,
                datefrom: datefrom,
                dateto: dateto
            },
            dataType: 'html',
            success: function (response) {
                var data = response;
                $('#setrates').append(response);

            }
        });
    }

    $('#btnMakeBooking').click(function (e) {
        e.preventDefault();

        var stay = $('#stayduration');
        var typeofroom = $('#typeofroom').val();
        var selectroom = $('#selectroom').val();
        var datefrom = $('#datefrom').val();
        var dateto = $('#dateto').val();
        var bookingnature = $('#bookingnature').val();
        var stayduration = stay.val();
        var rent = $('#rent').val();

        if (typeofroom == 0) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Please select Type of Room'
            }).then(function () {
                $('#typeofroom').focus();
            });
        } else if (selectroom == 0 || selectroom ==undefined) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Please select Room to Give'
            }).then(function () {
                $('#selectroom').focus();
            });
        } else if (stayduration == 0) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Select calendar period customer intends to stay'
            }).then(function () {
                $('#paymentcalendar').focus();
            });
        } else if (parseInt(rent) < 20000) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Amount to be billed is way below standard rates of this Room'
            }).then(function () {
                $('#rent').focus();
            });
        } else if (agreementsigned === false) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Agreement must be signed by client. Check and update if signed.'
            }).then(function () {
                $('#agreementsigned').focus();
            });
        } else {
            $.ajax({
                url: '<?=base_url('rental/houses/make_rental_booking/')?>',
                method: 'post',
                data: {
                    typeofroom: typeofroom,
                    selectroom: selectroom,
                    datefrom: datefrom,
                    dateto: dateto,
                    stayduration: stayduration,
                    bookingnature: bookingnature,
                    rent: rent
                },
                success: function (response) {
                    // var data = parse.json(response);
                    var data = response;

                    if (data === 'enter_checkin') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Specify the Date client intends to Move in'
                        })
                    } else if (data === 'enter_checkout') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Specify the date client intends to Move out'
                        })

                    } else if (data === 'categorized_as_booking') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Number of days client intends to stay is lower than 20, hence this does not qualify as a Rental Item'
                        })
                    } else if (data === 'start_greater_than_today' || data === 'end_before_today' || data === 'invalid_request') {
                        Swal.fire({
                            type: 'error',
                            text: 'Dates specified are invalid. Check your Date selection and retry'
                        })
                    } else if (data === 'discount_is_alot') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'You cannot bill the client such an amount. Use standard rates of the house or give a maximum of 10% discount'
                        })
                    }else if(data==='required_deposit'){
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'First payments should be equal to a days payment or more'
                        })
                    }else if(data==='booked_as_regular'){
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'This Room has been booked under category,Bookings, and hence cannot be reserved as a Rental'
                        })
                    } else if (data === 'room_already_booked') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'We failed to make this Booking for it has an existing session already'
                        })
                    } else {
                        window.location="<?= base_url('rental/houses/')?>"+data;
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


    $('#stayduration').change(function () {
        $('#setrates').empty();

        var stay = $('#stayduration');
        var typeofroom = $('#typeofroom').val();
        var selectroom = $('#selectroom').val();
        var datefrom = $('#datefrom').val();
        var dateto = $('#dateto').val();
        var bookingnature = $('#bookingnature').val();
        var stayduration = stay.val();

        if (typeofroom == 0) {
            Swal.fire({
                type: 'error',
                title: 'House is required'
            });
            $('select#stayduration')[0].selectedIndex = 0;

        } else if (selectroom == 0) {
            Swal.fire({
                type: 'error',
                title: 'Room Number is required'
            });
            $('select#stayduration')[0].selectedIndex = 0;
        } else if (bookingnature == 0) {
            Swal.fire({
                type: 'error',
                title: 'Specify the Nature of this Reservation'
            });
            $('select#stayduration')[0].selectedIndex = 0;
        } else if (stayduration == 0) {
            Swal.fire({
                type: 'error',
                title: 'Specify the expected duration of stay'
            });
            $('select#stayduration')[0].selectedIndex = 0;
        } else {
            $('#setrates').empty();
            $.ajax({
                url: '<?=base_url('rental/getrates/')?>',
                method: 'post',
                data: {
                    typeofroom: typeofroom,
                    selectroom: selectroom,
                    datefrom: datefrom,
                    dateto: dateto
                },
                dataType: 'html',
                success: function (response) {
                    $('#setrates').empty();


                    var data = response;

                    if (data === 'room_already_booked') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'We failed to make this Reservation for it has an existing session already'
                        })
                        $('select#stayduration')[0].selectedIndex = 0;

                    } else if (data === 'missing') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'You have not set this Room as available for Rentals.'
                        })
                        $('select#stayduration')[0].selectedIndex = 0;

                    } else if (data === 'enter_checkin') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Specify the Date client intends to Move in'
                        })
                        $('select#stayduration')[0].selectedIndex = 0;

                    } else if (data === 'enter_checkout') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Specify the date client intends to Move out'
                        })
                        $('select#stayduration')[0].selectedIndex = 0;

                    } else if (data === 'categorized_as_booking') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Number of days client intends to stay is lower than 20, hence this does not qualify as a Rental Item'
                        })
                        $('select#stayduration')[0].selectedIndex = 0;

                    } else if (data === 'start_greater_than_today' || data === 'end_before_today' || data === 'invalid_request') {
                        Swal.fire({
                            type: 'error',
                            text: 'Dates specified are invalid. Check your Date selection and retry'
                        })
                        $('select#stayduration')[0].selectedIndex = 0;

                    } else if (data === 'discount_is_alot') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'You cannot bill the client such an amount. Use standard rates of the house or give a maximum of 10% discount'
                        })
                        $('select#stayduration')[0].selectedIndex = 0;

                    } else if (data === 'room_already_booked') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'We failed to make this Booking for it has an existing session already'
                        })
                        $('select#stayduration')[0].selectedIndex = 0;

                    } else {
                        $('#setrates').empty();
                        $('#setrates').append(response);
                    }


                }
            });
        }
    });
    $('#typeofroom').change(function () {
        $('#setrates').empty();

        $('#selectroom').empty();
        $('#selectroom').append('<option selected value="0" selected><i class="fa fa-spinner-third"></i> processing</option>');

        var typeofroom = $(this).val();
        var estate = $('#estates').val();

        // AJAX request
        $.ajax({
            url: '<?=base_url('rental/getRooms/')?>',
            method: 'post',
            data: {
                estate: estate,
                typeofroom: typeofroom
            },
            dataType: 'json',
            success: function (response) {
                $('#setrates').empty();

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

</script>
<!-- /footer -->
</body>

</html>
