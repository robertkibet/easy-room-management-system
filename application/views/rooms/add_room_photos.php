<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Room Images</title>
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

    <script src="<?= base_url() ?>assets/global_assets/js/plugins/uploaders/dropzone.min.js"></script>

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
                    <?php
                    $id=$this->uri->segment(4);
                    $room =$this->db->query("select * from tbl_rooms where id='$id'")->row();
                    $roomtype =$this->db->query("select roomtype from tbl_rooms where id='$id'")->row();
                    $roomtypeid = $roomtype->roomtype;
                    $typeid =$this->db->query("select estateid from tbl_rooms_types where id='$roomtypeid'")->row();
                    $eid = $typeid->estateid;
                    $estate = $this->db->query("select * from tbl_estates where id='$eid'")->row();
                    $getestate = $estate->estatename;
                    ?>
                    <h5 class="panel-title">Add more images for room <strong><?= strtoupper($room->roomnumber)?></strong> in <strong><?= ucwords($getestate)?></strong></h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <fieldset class="content-group">
                    <form action="<?= base_url('welcome/rooms/save_room_images_step_2/'.$id)?>" class="dropzone" id="dropzone_multiple"></form>
                    <br>
                    <br>
                    <div class="container">
                        <center>
                            <button class="btn btn-primary" id="proceedtoCompleteButton"><i class="icon-check"></i> Click to Complete the Process
                            </button>
                        </center>
                    </div>
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
<!-- /footer -->
<script>
    $(document).ready(function () {
        document.getElementById('proceedtoCompleteButton').addEventListener('click', function (e) {
            $.ajax({
                url: "<?= base_url('welcome/rooms/check_room_images_step_2/'.$id)?>",
                type: "POST",
                dataType: "text",
                data: {
                    roomid:<?= $id?>
                },
                success: function (results) {
                    var data = results;
                    if (data === 'images_ready') {
                        Swal.fire({
                            title: 'All Set',
                            type: 'success',
                            confirmButtonText:
                                'Click to Proceed to Rooms <i class="fa fa-arrow-right></i>',

                        }).then(function () {
                            location.href = "<?= site_url('welcome/rooms/manage_rooms')?>";
                        })

                    } else if (data === 'images_insufficient') {
                        Swal.fire({
                            title: 'Failed',
                            type: 'info',
                            text: 'Please add more than 2 Images for this Room',
                            confirmButtonText:
                                'OK',

                        })
                    } else if (data === 'images_not_ready') {
                        Swal.fire({
                            title: 'Add Images',
                            type: 'info',
                            text: 'Minimum of 3 Images for this Room is required',
                            confirmButtonText:
                                'OK',

                        })
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: 'Fatal Error',
                        type: 'error',
                        text: 'Process incomplete. Try again or contact admin if persistent <?= $this->config->item("admin_email")?>',
                        confirmButtonText:
                            'OK',

                    })
                }
            });
        });

    });
</script>
</body>

</html>
