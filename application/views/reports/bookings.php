<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookings Report</title>
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
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_select2.js"></script>

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
                    <?php
                    if (isset($error)) {
                        echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <strong>Sorry</strong> No record found within the set range.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-8">
                            <center>
                                <form action="<?= base_url('welcome/reports/bookings/bookings_reports_sorted_category') ?>"
                                      role="form"
                                      method="post">

                                    <div class="content-group">
                                        <div class="col-md-10">
                                            <div class="container col-md-6">

                                                <div class="form-group">
                                                    <label class="display-block">Select Estate</label>
                                                    <select name="estates" class="select" style="width: 80%">
                                                        <option value="0" selected>-- SELECT ESTATE --</option>
                                                        <?php
                                                        $listestates = $this->db->query("select * from tbl_estates order by estatename asc")->result_array();
                                                        foreach ($listestates as $listestate):
                                                            echo '<option value="' . $listestate['id'] . '">' . strtoupper($listestate['estatename']) . '</option>';
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="container col-md-6" style="border-right: 1px dashed #333;">

                                                <div class="form-group">
                                                    <label class="display-block">Select Room No.</label>
                                                    <select name="rooms" class="select" style="width: 80%">
                                                        <option value="0" selected>-- SELECT ROOM NO. --</option>
                                                        <?php
                                                        $getrms = $this->db->query("select distinct(room) as rms from bookings order by id desc")->result_array();
                                                        if (count($getrms) > 0) {
                                                            foreach ($getrms as $rms):
                                                                $mid = $rms['rms'];
                                                                $getsuites = $this->db->query("select * from tbl_rooms where id='$mid'")->row();
                                                                echo '<option value="' . $getsuites->id . '">' . strtoupper($getsuites->roomnumber) . '</option>';
                                                            endforeach;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="container col-md-12">
                                                <button type="submit"
                                                        href="<?= base_url('welcome/reports/print_bookings_report') ?>"
                                                        class="btn btn-sm btn-primary"><i class="icon-printer"></i>
                                                    Sort by Estates
                                                </button>
                                            </div>

                                            <br>


                                        </div>

                                    </div>
                                </form>

                            </center>
                        </div>
                        <div class="col-md-4">
                            <center>
                                <form action="<?= base_url('welcome/reports/bookings/bookings_reports_sorted') ?>"
                                      role="form"
                                      method="post">

                                    <div class="content-group">
                                        <div class="col-md-10">
                                            <div class="container col-md-12">
                                                <form action="<?= base_url('welcome/reports/bookings/bookings_reports_sorted') ?>"
                                                      role="form"
                                                      method="post">

                                                    <div class="content-group">
                                                        <label>Select Checkin Dates and Print </label>
                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i
                                                                        class="icon-calendar22"></i></span>
                                                            <input name="customrange" type="text"
                                                                   class="form-control daterange-basic"
                                                                   value="" placeholder="Click to select dates">
                                                        </div>
                                                        <br>
                                                        <button type="submit"
                                                                href="<?= base_url('welcome/reports/print_bookings_report') ?>"
                                                                class="btn btn-sm btn-danger"><i
                                                                    class="icon-printer"></i>
                                                            Sort by Dates
                                                        </button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>

                    </div>
                </div>

            </div>
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Bookings Report</h5>


                    <div class="heading-elements">

                        <ul class="icons-list">
                            <li><a href="<?= base_url('welcome/print_all_bookings') ?>"
                                   class="btn btn-sm btn-success"><i class="icon-printer"></i>
                                    Print All</a></li>
                        </ul>
                    </div>
                </div>
                <?php
                if (isset($errorss)) {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <strong>Sorry</strong> No records found to print.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                }
                ?>


                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Room</th>
                        <th>Estate</th>
                        <th>Days</th>
                        <th>Visitors</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th>Rates</th>
                        <th>Amount Paid</th>
                        <th>Date of Booking</th>
                        <th>Served By</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $estates = $this->db->query("select * from bookings order by id desc")->result_array();
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
                                <td><?= $getestate ?></td>
                                <td><span class="label label-success" style=""><?= $estate['days'] ?> days </span></td>
                                <td><?= $estate['visitors'] ?></td>
                                <td><?= $estate['checkin'] ?></td>
                                <td><?= $estate['checkout'] ?></td>
                                <td>KES.<?= number_format($estate['amountpaid']) ?></td>
                                <td>KES.<?= number_format($estate['billing']) ?></td>
                                <td><?= $estate['dateadded'] ?></td>
                                <td><?= $estate['servedby'] ?></td>

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
</body>
<script>
    /* ------------------------------------------------------------------------------
*
*  # Date and time pickers
*
*  Demo JS code for picker_date.html page
*
* ---------------------------------------------------------------------------- */

    document.addEventListener('DOMContentLoaded', function () {

        // Date limits
        $('.daterange-basic').daterangepicker({
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default',
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

    });

</script>

</html>
