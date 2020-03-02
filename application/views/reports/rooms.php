<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rooms Report</title>
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
                    <h5 class="panel-title">Rooms Report</h5>

                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li style="color: white"><a href="<?= base_url('welcome/reports/rooms/rooms_reports_sorted') ?>" class="btn btn-sm btn-success"><i class="icon-printer"></i> Print</a></li>
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
                        <th>Room Number<br><span style="font-size:80%">&nbsp;</span></th>
                        <th>Status<br><span style="font-size:80%">&nbsp;</span></th>
                        <th>Tye of Room<br><span style="font-size:80%">&nbsp;</span></th>
                        <th>Max people<br><span style="font-size:80%">&nbsp;</span></th>
                        <th>Min People<br><span style="font-size:80%">&nbsp;</span></th>
                        <th>Amount<br><span style="font-size:80%">(per person)</span></th>
                        <th>Estate<br><span style="font-size:80%">&nbsp;</span></th>
                        <!--                        <th>Number of Rooms<br><span style="font-size:80%">&nbsp;</span></th>-->
                        <th>Added By<br><span style="font-size:80%">&nbsp;</span></th>
                        <th class="text-center">Actions<br><span style="font-size:80%">&nbsp;</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $rooms = $this->db->query("select * from tbl_rooms order by id desc")->result_array();
                    if(count($rooms)>0):
                        $i =0;
                        foreach($rooms  as $room):
                            $i++;
                            $id=$room['addedby'];
                            $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$id'")->row();
                            $phone = $addedby->phone;
                            $roomid=$room['id'];
                            $roomtype=$room['roomtype'];

                            $gettypes = $this->db->query("SELECT roomtype FROM  tbl_rooms_types WHERE id='$roomtype'")->row();
                            $types=$gettypes->roomtype;

                            $estateid=$room['estateid'];
                            $getestates = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                            $estatename = $getestates->estatename;

                            $checkroom= $this->db->query("select * from bookings where room='$roomid' and active ='1'")->result_array();

                            ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><a href="#"><?= $room['roomnumber']?></a></td>
                                <td><?= (count($checkroom)>0)?'<span class="label label-success" style="">ACTIVE</span>':''?></td>
                                <td><?= $types?></td>
                                <td><?= $room['maxpeople']?></td>
                                <td><?= $room['minpeople']?></td>
                                <td><?= $room['amountperperson']?></td>
                                <td><?= ucwords($estatename)?></td>
                                <!--                                <td>--><?//= $room['numberofrooms']?><!--</td>-->
                                <td><?= $phone?></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
<!--                                                <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>-->
<!--                                                <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>-->
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    endif;?>

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

</html>
