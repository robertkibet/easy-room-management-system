<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Reservations</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
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
                    <h5 class="panel-title">Reservations</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Suite</th>
                        <th>Checkin</th>
                        <th>Monthly</th>
                        <th>Daily</th>
                        <th>Added By</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rentals = $this->db->query("select * from tbl_rentals_reservations order by id desc")->result_array();
                    if (count($rentals) > 0):
                        $i = 0;
                        foreach ($rentals as $item):
                            $i++;
                            $type = $item['room'];
                            $suitename = $this->db->query("select roomnumber from tbl_rooms where id='$type'")->row();
                            $suite = $suitename->roomnumber;
                            $id = $item['addedby'];
                            $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$id'")->row();
                            $phone = $addedby->phone;
                            $rentalid = $item['id'];
                            $status = $item['status'];
                            if ($status === '0') {
                                $stats = 'label bg-purple';
                                $text = 'ACTIVE';
                            } else if ($status === '1') {
                                $stats = 'label label-success';
                                $text = 'COMPLETED';
                            } else if ($status === '2') {
                                $stats = 'label label-danger';
                                $text = 'CANCELLED';
                            }
                            ?>
                            <tr>
                                <td><span class="<?= $stats ?>"><?= $text ?></span></td>
                                <td><a href="#"><?= strtoupper($suite) ?></a></td>
                                <td><?= $item['datefrom'] ?></td>
                                <td><?= 'KES. ' . number_format($item['monthlyrent']) ?></td>
                                <td><?= 'KES. ' . number_format($item['dailyrent']) ?></td>
                                <td><?= $phone ?></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="<?= base_url('rental/houses/collect_rent/' . $rentalid) ?>"><i
                                                                class="icon-cash3"></i> Collect Payments</a></li>
                                                <li><a href="<?= base_url('rental/reservations/payments/' . $rentalid) ?>"><i class="icon-file-check2"></i> Payments Records</a></li>
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

                    } else {
                        window.location = "<?= base_url('rentals/bookings/')?>" + data;
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
