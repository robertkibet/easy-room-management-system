<!-- Main navbar -->
<?php $mydata = $this->session->all_userdata()?>
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?= base_url('welcome')?>"><img style="height: 25px !important;" src="<?= base_url()?>assets/global_assets/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">


        <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown language-switch">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?= base_url()?>assets/global_assets/images/flags/gb.png" class="position-left" alt="">
                    English
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li><a class="english"><img src="<?= base_url()?>assets/global_assets/images/flags/gb.png" alt=""> English</a></li>
                </ul>
            </li>


            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">

                    <?php
                    $userid = $mydata['id'];

                    $profile = $this->db->query("select * from tbl_user_profile where userid = '$userid'")->row();
                    $countprofile = $this->db->query("select * from tbl_user_profile where userid = '$userid'")->result_array();
                    if (count($countprofile) > 0) { ?>
                        <img style="width: 30px !important; height: 30px !important;" src="<?= ($profile->filepath == null) ? base_url() . 'assets/global_assets/images/demo/users/face11.jpg' : base_url() . $profile->filepath ?>" alt="">

                    <?php } else { ?>
                        <img src="<?= base_url()?>assets/global_assets/images/demo/users/face11.jpg" alt="">

                    <?php } ?>
                    <span><?= $mydata['lastname']?></span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?= base_url('welcome/profile/settings')?>"><i class="icon-gear"></i> Profile</a></li>
                    <li><a href="<?= base_url('welcome/logout')?>"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?= base_url('welcome')?>"><i class="icon-display4 position-left"></i> Dashboard</a></li>
            <li class=""><a href="<?= base_url('welcome/bookings/make_booking')?>"><i class="icon-person position-left"></i> Single Bookings</a></li>
            <li><a href="<?= base_url('group_bookings/make_booking')?>"><i class="icon-people"></i> Group Bookings</a></li>
            <li><a href="<?= base_url('rental/houses/reservations')?>"><i class="icon-stamp"></i> Rentals (L.T.B)</a></li>

            <li class=""><a href="<?= base_url('welcome/bookings/checkout')?>"><i class="icon-file-check2 position-left"></i> Checkouts</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-stars position-left"></i> Manage Rentals & Groups <span class="caret"></span>
                </a>

                <ul class="dropdown-menu width-200">
                    <li><a href="<?= base_url('group_bookings/manage')?>"><i class="icon-people"></i> Manage Group Bookings</a></li>
                    <li><a href="<?= base_url('rental/reservations')?>"><i class="icon-notebook"></i> Manage Reservations</a></li>
                    <li><a href="<?= base_url('rental/houses/manage')?>"><i class="icon-home7"></i> Manage Rentals</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-width position-left"></i> Manage Estate <span class="caret"></span>
                </a>

                <ul class="dropdown-menu width-200">
                    <li class=""><a href="<?= base_url('welcome/rooms/room_types')?>"><i class="icon-stack-check position-left"></i> Types of Rooms</a></li>
                    <li class=""><a href="<?= base_url('welcome/estates/manage_estates')?>"><i class="icon-home position-left"></i> Estates</a></li>
                    <li class=""><a href="<?= base_url('welcome/rooms/manage_rooms')?>"><i class="icon-bed2 position-left"></i> Rooms</a></li>
                    <li class=""><a href="<?= base_url('welcome/system/users')?>"><i class="icon-users position-left"></i> System Users</a></li>

                </ul>
            </li>


            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-strategy position-left"></i> Reports <span class="caret"></span>
                </a>

                <ul class="dropdown-menu width-200">
                    <li><a href="<?= base_url('welcome/reports/revenue')?>"><i class="icon-align-center-horizontal"></i> Revenue Report</a></li>
<!--                    <li><a href="#0" onclick="Swal.fire('Under Development.')"><i class="icon-align-center-horizontal"></i> Rental Houses Report</a></li>-->
                    <li><a href="<?= base_url('welcome/reports/bookings')?>"><i class="icon-align-center-horizontal"></i> Bookings Report</a></li>
                    <li><a href="<?= base_url('welcome/reports/rooms')?>"><i class="icon-align-center-horizontal"></i> Rooms Report</a></li>
                    <li><a href="<?= base_url('welcome/reports/estates')?>"><i class="icon-align-center-horizontal"></i> Estates Report</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /second navbar -->
<?php
$date=date('Y-m-d');
$checkrooms = $this->db->query("select * from bookings where checkout < '$date' and active='1'")->result_array();

if(count($checkrooms)>0){
    ?>
    <div class="alert bg-warning alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Warning!</span> <strong><?= count($checkrooms)?> room(s)</strong> are way past check-out date. <a class="btn btn-info" href="<?= base_url('welcome/bookings/checkout')?>">CLICK HERE</a> to view and clear them.
    </div>
<?php }
?>
<?php
$date=date('Y-m-d');
$checkroomsgrouped = $this->db->query("select * from tbl_group_bookings where checkout < '$date' and status=1 ")->result_array();

if(count($checkroomsgrouped)>0){
    ?>
    <div class="alert bg-warning alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Warning!</span> <strong><?= count($checkroomsgrouped)?> Group Booking </strong> are way past check-out date. <a class="btn btn-info" href="<?= base_url('group_bookings/manage')?>">CLICK HERE</a> to view and clear them.
    </div>
<?php }
?>
<?php
$date=date('Y-m-d');
$checkrentals = $this->db->query("select * from tbl_rentals_reservations where dateto < '$date' and status=1")->result_array();

if(count($checkrentals)>0){
    ?>
    <div class="alert bg-warning alert-styled-left">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        <span class="text-semibold">Warning!</span> <strong><?= count($checkrentals)?> Long Term Booking</strong> are way past check-out date. <a class="btn btn-info" href="<?= base_url('rental/reservations')?>">CLICK HERE</a> to view and clear them.
    </div>
<?php }
?>
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">

            <h4>
                <i class="icon-arrow-left52 position-left"></i>
                <span class="text-semibold">Home</span> - Dashboard
                <?php
                date_default_timezone_set("Africa/Nairobi");

                $Hour = date('G');

                if ( $Hour >= 5 && $Hour <= 11 ) {
                    $greetings=  "Good Morning, ";
                } else if ( $Hour >= 12 && $Hour <= 18 ) {
                    $greetings= "Good Afternoon, ";
                } else if ( $Hour >= 19 || $Hour <= 4 ) {
                    $greetings=  "Good Evening, ";
                }
                ?>

                <small class="display-block"><?= $greetings.''.ucwords($mydata['lastname'])?>!</small>
            </h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">

                <a href="<?= base_url('welcome/calendar')?>" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Calendar</span></a>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->