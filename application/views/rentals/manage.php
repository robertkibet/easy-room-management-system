<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rentals</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/global_assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url() ?>assets/global_assets/images/favicon.ico" type="image/x-icon">
    <link href="<?= base_url() ?>assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/assets/css/core.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/loaders/pace.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/nicescroll.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>

    <script src="<?= base_url() ?>assets/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <!--    <script src="-->
    <? //= base_url()?><!--assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>-->
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/inputs/touchspin.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/notifications/bootbox.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/notifications/noty.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/notifications/jgrowl.min.js"></script>

    <script src="<?= base_url() ?>assets/assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/datatables_basic.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/components_modals.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/components_notifications_other.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_select2.js"></script>


    <!-- /theme JS files -->

</head>

<body>

<?php $this->load->view('partials/navbar') ?>


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Basic datatable -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Rental Rooms</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <button type="button" class="btn bg-indigo-300 btn-sm" data-toggle="modal"
                            data-target="#modal_backdrop">Add a Rental House Rate<i
                                class="icon-home2 position-right"></i>
                    </button>
                </div>
                <div id="modal_backdrop" class="modal fade" data-backdrop="false" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title"><i class="icon-home2"></i> Assign a House as a Rental</h5>
                            </div>

                            <div class="modal-body">
                                <fieldset class="content-group">
                                    <div class="form-group">
                                        <label class="display-block">Select House</label>
                                        <select class="select display-block" id="house" style="width: 100% !important;">
                                            <option value="0" selected>-- SELECT --</option>
                                            <?php
                                            $gethouses = $this->db->query("select * from tbl_rooms_types order by id desc")->result_array();
                                            if (count($gethouses) > 0) {
                                                foreach ($gethouses as $hse):
                                                    ?>
                                                    <option value="<?= $hse['id'] ?>"><?= strtoupper($hse['roomtype']) ?></option>
                                                <?php
                                                endforeach;
                                            } ?>
<!--                                            --><?php
//                                            $penthouse = $this->db->query("select * from tbl_rooms where roomnumber ='PentHouse' limit 1")->row();
//                                            echo '<option value'.$penthouse->roomnumber.' >'.strtoupper($penthouse->roomnumber).'</option>';
//                                            ?>
                                        </select>
                                        <code>Each type of house will have one uniform rates across all its units</code>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="display-block">Expected Monthly Rate</label>
                                        <div class="">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-piggy-bank"></i></span>
                                                <input type="number" class="form-control" id="monthly"
                                                       value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="display-block">Daily Rates</label>
                                        <div class="">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-cash2"></i></span>
                                                <input type="number"
                                                       style="pointer-events: none !important; background-color: #ebebeb !important;"
                                                       class="form-control" id="daily"
                                                       placeholder="Daily Rates">
                                            </div>
                                            <code>Calculated as (Monthly Rate / 30days)</code>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close
                                </button>
                                <button class="btn btn-primary" id="savebtn"><i class="icon-check"></i> Add this Rate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Suite</th>
                        <th>Monthly Rates</th>
                        <th>Daily Rates</th>
                        <th>Added By</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rates = $this->db->query("select * from tbl_rentals_rates order by id desc")->result_array();
                    if (count($rates) > 0):
                        $i = 0;
                        foreach ($rates as $rate):
                            $i++;
                            $type = $rate['suite'];
                            $suitename = $this->db->query("select roomtype from tbl_rooms_types where id='$type'")->row();
                            $suite = $suitename->roomtype;
                            $id=$rate['addedby'];
                            $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$id'")->row();
                            $phone = $addedby->phone;
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><a href="#"><?= strtoupper($suite) ?></a></td>
                                <td><?= 'KES. '.number_format($rate['monthly']) ?></td>
                                <td><?= 'KES. '.number_format($rate['daily']) ?></td>
                                <td><?= $phone?></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <!--                                                <li><a href="#"><i class="icon-key"></i> Remove</a></li>-->
                                                <!--                                        <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>-->
                                                <!--                                        <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>-->
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
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
<!-- /footer -->
<script>
    $('#monthly').on('keyup', function () {
        var monthly = document.getElementById('monthly').value;
        var daily = parseInt(monthly) / 30;
        $('#daily').empty();
        var amount = Math.ceil(daily);
        $('#daily').val(amount);
    });
    $('#savebtn').on('click', function (e) {

        e.preventDefault();

        var house = $('#house').val();
        var monthly = $('#monthly').val();
        var daily = $('#daily').val();
        if (house == 0) {
            swal.fire({
                type: 'error',
                text: 'Select the House'
            })
            $('#firstname').focus();
        } else if (parseInt(monthly) < 20000) {
            swal.fire({
                type: 'error',
                text: 'It seems this amount is quite Low.'
            })
            $('#firstname').focus();
        } else if (parseInt(daily) < 100) {
            swal.fire({
                type: 'error',
                text: 'It seems the Daily rates are quite Low'
            })
            $('#lastname').focus();
        } else {

            $.ajax({
                url: "<?= base_url('rental/houses/save_rates')?>",
                type: "POST",
                data: {
                    house: house,
                    monthly: monthly,
                    daily: daily,
                },
                dataType: "text",
                success: function (results) {
                    var data = JSON.parse(results);
                    // var data = results;
                    console.log(data);
                    if (data === 'failed') {
                        Swal.fire({
                            title: 'Sorry',
                            type: 'info',
                            text: ' We could not add this rates. Try again or contact admin',

                        })
                        $('#savebtn').append('Try Again');

                    } else if (data === 'exists') {
                        Swal.fire({
                            title: 'Failed',
                            type: 'error',
                            text: 'This already exists in the system'

                        })
                        $('#savebtn').append('Try Again');

                    }else {
                        window.location="<?= base_url('rentals/bookings/')?>"+data;
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: 'Failed',
                        type: 'error',
                        text: ' Something went wrong. Check your connection and Try again or contact admin',
                        confirmButtonText:
                            'OK',
                    })
                }
            })

        }

    })
</script>
</body>

</html>
