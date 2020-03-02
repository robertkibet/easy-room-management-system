<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Golan Accomodations</title>
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
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="<?= base_url() ?>assets/assets/js/loader.js"></script>

<!--    <script src="--><?//= base_url() ?><!--assets/global_assets/js/plugins/visualization/d3/d3.min.js"></script>-->
<!--    <script src="--><?//= base_url() ?><!--assets/global_assets/js/plugins/visualization/c3/c3.min.js"></script>-->
    <script src="<?= base_url() ?>assets/assets/js/app.js"></script>

</head>

<body>

<?php $this->load->view('partials/navbar') ?>


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-4">

                    <!-- Members online -->
                    <div class="panel bg-success-400">
                        <div class="panel-body">
                            <div class="heading-elements">
                                <span class="heading-text badge bg-success-800"></span>
                            </div>

                            <h3 class="no-margin"><?php
                                $year= date('Y');
                                $visits=$this->db->query("select count(id) as visits from bookings where DAY(checkin) = DAY(CURDATE()) AND MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE())")->row();
                                $vst=$visits->visits;
                                echo number_format($vst)
                                ?></h3>
                            Bookings Today
                            <div class="text-muted text-size-small"></div>
                        </div>

                    </div>
                    <!-- /members online -->

                </div>
                <div class="col-lg-4">

                    <!-- Today's revenue -->
                    <div class="panel bg-blue-400">
                        <div class="panel-body">
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="reload"></a></li>
                                </ul>
                            </div>

                            <h3 class="no-margin">KES.<?php
                                $totalamount=$this->db->query("select sum(amountpaid) as amtd from bookings where DAY(checkin) = DAY(CURDATE()) AND MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE())")->row();
                                $amtd=$totalamount->amtd;
                                echo number_format($amtd)
                                ?></h3>
                            Today's revenue
                            <div class="text-muted text-size-small"></div>
                        </div>

                    </div>
                    <!-- /today's revenue -->

                </div>
                <div class="col-lg-4">

                    <!-- Members online -->
                    <div class="panel bg-teal-400">
                        <div class="panel-body">
                            <div class="heading-elements">
                                <span class="heading-text badge bg-teal-800">

                                </span>
                            </div>

                            <h3 class="no-margin">
                                KES.<?php
                                $rentcollected1 = $this->db->query("SELECT sum(amount) as rent FROM  tbl_rental_payments where YEAR(dateadded) = '$year' ");
                                $totalrent1=0;
                                if($rentcollected1->num_rows()>0){
                                    $getrent1=$rentcollected1->row();
                                    $totalrent1=$getrent1->rent;
                                }else{
                                    $totalrent1=0;
                                }
//                                $totalamount=$this->db->query("select sum(amountpaid) as amtd from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE())")->row();
                                $totalamount=$this->db->query("select sum(amountpaid) as amtd from bookings where YEAR(checkin) = '$year'")->row();
                                $amtd=$totalamount->amtd;
                                echo number_format($amtd + $totalrent1)
                                ?>
                            </h3>
                            Total Collections (Bookings + Long Term Bookings)
                            <div class="text-muted text-size-small"></div>
                        </div>

                    </div>
                    <!-- /members online -->

                </div>

                <div class="col-lg-4">

                    <!-- Current server load -->
                    <div class="panel bg-indigo-400">
                        <div class="panel-body">
                            <div class="heading-elements">

                            </div>

                            <h3 class="no-margin"><?php
                                $monthstats=$this->db->query("select count(id) as visits from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE())")->row();
                                $mnts = $monthstats->visits;
                                echo number_format($mnts);
                                ?></h3>
                            Bookings this Month
                            <div class="text-muted text-size-small"></div>
                        </div>

                    </div>
                    <!-- /current server load -->

                </div>
                <div class="col-lg-4">

                    <!-- Current server load -->
                    <div class="panel bg-brown-400">
                        <div class="panel-body">
                            <div class="heading-elements">

                            </div>

                            <h3 class="no-margin"><?php
                                $monthlyamount=$this->db->query("select sum(amountpaid) as monthstats from bookings where MONTH(checkin) = MONTH(CURDATE()) AND YEAR(checkin) = YEAR(CURDATE())")->row();
                                $mntsamt = $monthlyamount->monthstats;
                                echo 'KES.'.number_format($mntsamt);
                                ?></h3>
                            Revenue this Month
                            <div class="text-muted text-size-small"></div>
                        </div>

                    </div>
                    <!-- /current server load -->

                </div>
                <div class="col-lg-4">

                    <!-- Current server load -->
                    <div class="panel bg-pink-400">
                        <div class="panel-body">
                            <div class="heading-elements">

                            </div>

                            <h3 class="no-margin"><?php
                                $boookingss=$this->db->query("select count(id) as bkk from bookings ")->row();
                                $bkk = $boookingss->bkk;
                                echo number_format($bkk);
                                ?></h3>
                            Total Bookings
                            <div class="text-muted text-size-small"></div>
                        </div>

                    </div>
                    <!-- /current server load -->

                </div>

            </div>

            <!-- Main charts -->
            <div class="row">


                <div class="col-lg-8">
                    <div class="panel panel-flat">

                        <div class="table-responsive">
                            <table class="table table-xlg text-nowrap">
                                <tbody>
                                <tr>
                                    <td class="col-md-3">
                                        <div class="media-left media-middle">
                                            <a href="" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-bed2"></i></a>
                                        </div>

                                        <div class="media-left">
                                            <h5 class="text-semibold no-margin">
                                                <?php
                                                    $bookings=$this->db->query("select count(id) as bookings from bookings where active=1 ")->row();
                                                    $bks=$bookings->bookings;
                                                    echo number_format($bks)
                                                ?><small class="display-block no-margin">Active Rooms</small>
                                            </h5>
                                        </div>
                                    </td>

                                    <td class="col-md-3">
                                        <div class="media-left media-middle">
                                            <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i class="icon-home"></i></a>
                                        </div>

                                        <div class="media-left">
                                            <h5 class="text-semibold no-margin">
                                                <?php
                                                $rooms=$this->db->query("select count(id) as rooms from tbl_rooms ")->row();
                                                $rms=$rooms->rooms;
                                                echo number_format($rms)
                                                ?><small class="display-block no-margin">Total Rooms</small>
                                            </h5>
                                        </div>
                                    </td>


                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Overall Summary</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="reload"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="chart-container">
                                <div style="min-height: 700px" class="chart" id="curve_chart"></div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Long Term Bookings ::: <?php  echo $year;?></h6>
                            <div class="heading-elements">


                                <?php


                                $rentalsbooked = $this->db->query("SELECT count(distinct (room)) as rental FROM  tbl_rentals_reservations where YEAR(datefrom) = '$year' ");
                                if($rentalsbooked->num_rows()>0){
                                    $getrentals=$rentalsbooked->row();
                                    $totalrentals=$getrentals->rental;
                                }else{
                                    $totalrentals=0;

                                }
                                $rentcollected = $this->db->query("SELECT sum(amount) as rent FROM  tbl_rental_payments where YEAR(dateadded) = '$year' ");
                                if($rentcollected->num_rows()>0){
                                    $getrent=$rentcollected->row();
                                    $totalrent=($getrent->rent==null)?0.00:$getrent->rent;
                                }else{
                                    $totalrent=0.00;
                                }



                                $sumtotal = $this->db->query("select sum(amountpaid) as amt from bookings where DATE(`checkin`) = CURDATE()")->row();

                                ?>
                                <span class="heading-text">Bookings: <span
                                            class="text-bold text-danger-600 position-right"><?= $totalrentals?> rooms</span></span><br>
                                <span class="heading-text">Collections: <span
                                            class="text-bold text-danger-600 position-right">KES. <?= $totalrent?></span></span>

                            </div>
                        </div>

                        <div class="panel-body">
                            <div id="sales-heatmap"></div>
                        </div>

                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Expiry</h6>

                        </div>

                        <div class="panel-body">
                            <div id="sales-heatmap"></div>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                <tr>
                                    <th>Booking</th>
                                    <th>Days Remaining</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $date=date('Y-m-d');
                                $getbookings1 = $this->db->query("select * from bookings where checkout <= '$date' and active='1' order by checkout asc")->result_array();
                                foreach($getbookings1 as $bookings1):
                                    $roomid1= $bookings1['room'];
                                    $getroom1 = $this->db->query("select roomnumber from tbl_rooms where id='$roomid1'")->row();

                                    $estateid1= $bookings1['estate'];
                                    $estates1 = $this->db->query("select estatename from tbl_estates where id='$estateid1'")->row();
                                    $roomno1 = ucwords($getroom1->roomnumber);

                                    $now = strtotime(date('Y-m-d')); // or your date as well
                                    $checkout = strtotime($bookings1['checkout']);
                                    $datediff = $checkout - $now;

                                    $daysremaining = round($datediff / (60 * 60 * 24));
                                    if($daysremaining<0){
                                        $daysremaining='EXPIRED';
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="media-left media-middle">
                                                <a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
                                                    <span class="letter-icon"><?= $roomno1[0]?></span>
                                                </a>
                                            </div>

                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <a href="#" class="letter-icon-title"><?= $roomno1?></a>
                                                </div>

                                                <div class="text-muted text-size-small"><i
                                                            class="icon-checkmark3 text-size-mini position-left"></i> <?= ucwords($estates1->estatename)?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            if($daysremaining==='EXPIRED'){
                                                ?>
                                                <span class="label label-danger" style="">EXPIRED</span>

                                            <?php }else{
                                                ?>
                                                <span class="label label-default" style=""><?= $daysremaining ?> day(s) </span>

                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                                </tbody>
                            </table>
                        </div>
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
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Collections'],
            <?php

                $fetchmonths = $this->db->query("select MONTH(checkin) as setmonth, MONTHNAME(checkin) as mname  from bookings where YEAR(checkin) = YEAR(CURDATE()) group by setmonth order by setmonth asc")->result_array();
                foreach($fetchmonths as $months):
                    $getmonths =$months['setmonth'];
                    $monthName= $months['mname'];
//                    echo $monthName;
                    echo '[\''.$monthName.'\',';

                    $getpayments = $this->db->query("select sum(amountpaid) as amounts from bookings where YEAR(checkin) = YEAR(CURDATE()) and MONTH(checkin)='$getmonths'")->row();
                    $paid = $getpayments->amounts;
                    echo $paid.'],';
//                    echo $getmonths;

                endforeach;

            ?>
        ]);

        var options = {
            curveType: 'function',
            legend: { position: 'top' },

        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>

</body>

</html>

}