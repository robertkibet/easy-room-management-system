<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calendar | Golan Accomodations</title>
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
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>

    <script src="<?= base_url() ?>assets/assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/assets/js/moment.js"></script>

</head>

<body>

<?php $this->load->view('partials/navbar') ?>


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Main charts -->
            <div class="row">


                <div class="col-lg-12">

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Basic line</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="fullcalendar-basic"></div>

                        </div>

                        <!--                        <div class="panel-body">-->
                        <!--                            <div class="chart-container">-->
                        <!--                                <canvas class="chart has-fixed-height" id="graphCanvas"></canvas>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>

                </div>
            </div>
            <!-- /main charts -->

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
    /* ------------------------------------------------------------------------------
*
*  # Fullcalendar basic options
*
*  Demo JS code for extra_fullcalendar_views.html and
*  extra_fullcalendar_styling.html pages
*
* ---------------------------------------------------------------------------- */

    document.addEventListener('DOMContentLoaded', function() {


        // Add events
        // ------------------------------

        // Default events
        var events = [
            <?php $getbookings = $this->db->query("select * from bookings where active ='1' order by checkin desc")->result_array();
            foreach($getbookings as $bookings):
            $roomid= $bookings['room'];
            $getroom = $this->db->query("select roomnumber from tbl_rooms where id='$roomid'")->row();

            $estateid= $bookings['estate'];
            $estates = $this->db->query("select estatename from tbl_estates where id='$estateid'")->row();

                echo '{
                title: \''.'Room No. '.$getroom->roomnumber.' ('.ucwords($estates->estatename).')'.'\',
                start: \''.$bookings['checkin'].'\',
                end: \''.$bookings['checkout'].'\'
            },';
            ?>

            <?php endforeach; ?>
        ];

        $('.fullcalendar-basic').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: moment().format("YYYY-MM-DD"),
            editable: true,
            eventLimit: true,
            events: events,
            isRTL: $('html').attr('dir') == 'rtl' ? true : false
        });

    });
</script>
</body>

</html>
