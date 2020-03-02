<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Revenue Report</title>
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

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Revenue Report</h5>

                </div>
                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <strong>Sorry</strong> No records found to print.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                }
                ?>
<!--                <div class="alert bg-danger alert-styled-left">-->
<!--                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span-->
<!--                                class="sr-only">Close</span></button>-->
<!--                    <span class="text-semibold">Alert</span> <strong>This Page (REVENUE REPORTS) is undergoing Maintenance. Other functionalities works well, except you cannot generate any invoice as of Now</strong>-->
<!--                </div>-->
                <div class="col-md-8">

<!--                    --><?php
//                    $mya=$this->session->all_userdata();
//                    if($mya['role'] ==='admin'){
//                    ?>
                    <center>
                        <p>Generate amounts collected from both Bookings and Rentals</p>
                        <form action="<?= base_url('welcome/reports/revenue/print_revenue_report') ?>"
                              role="form"
                              method="post">

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <select name="monthname" class="select" style="width: 100%">
                                                <option value="0" selected>-- SELECT MONTH --</option>
                                                <option value="ALL">ALL</option>
                                                <option value="01" >JANUARY</option>
                                                <option value="02" >FEBRUARY</option>
                                                <option value="03" >MARCH</option>
                                                <option value="04" >APRIL</option>
                                                <option value="05" >MAY</option>
                                                <option value="06" >JUNE</option>
                                                <option value="07" >JULY</option>
                                                <option value="08" >AUGUST</option>
                                                <option value="09" >SEPTEMBER</option>
                                                <option value="10" >OCTOBER</option>
                                                <option value="11" >NOVEMBER</option>
                                                <option value="12" >DECEMBER</option>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <select name="yearname" class="select" style="width: 100%">
                                                <option value="0" selected>-- SELECT YEAR--</option>
                                                <option value="ALL" >ALL</option>
                                                <?php
                                                $firstYear = 2018;
                                                $lastYear = $firstYear + 10;
                                                for($i=$firstYear;$i<=$lastYear;$i++)
                                                {
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="icon-printer"></i> PRINT RECORD</button>
                                        </div>

                                    </div>
                                    <br>


                                </div>

                        </form>

                    </center>
<!--                    --><?php //}?>
                </div>
<br><br><br><br><br><br><br><br><br><br>
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
