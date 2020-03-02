<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room Profile</title>
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
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
    <script src="<?= base_url() ?>assets/assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/user_pages_profile.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/uploader_bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <style>
        .selected img {
            opacity: 0.5;
        }
    </style>
    <!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
<?php $this->load->view('partials/navbar') ?>
<!-- /main navbar -->
<?php $mydata = $this->session->all_userdata() ?>


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <?php
            $id = $this->uri->segment(4);
            $cover = $this->db->query("select * from 	tbl_rooms_images where roomid = '$id'")->row();
            $countcover = $this->db->query("select * from 	tbl_rooms_images where roomid= '$id'")->result_array();
            ?>
            <!-- Cover area -->
            <div class="profile-cover">
                <?php if (count($countcover) > 0) { ?>
                    <div class="container">
                        <h1><?php
                            $room = $this->db->query("select * from tbl_rooms where id='$id'")->row();

                            ?>
                            ROOM <?= strtoupper($room->roomnumber) ?></h1>
                    </div>


                    <!-- main slider carousel -->
                    <div class="row">
                        <div class="col-md-9" id="slider">

                            <div class="col-md-12" id="carousel-bounding-box">
                                <div id="myCarousel" class="carousel slide">
                                    <!-- main slider carousel items -->
                                    <div class="carousel-inner">
                                        <?php
                                        $images = $this->db->query("select * from tbl_rooms_images where roomid='$id'")->result_array();

                                        $i = 0;
                                        foreach ($images as $imgs):
                                            $i++;
                                            ?>
                                            <div class="<?= ($i == '1') ? 'active' : '' ?> item"
                                                 data-slide-number="<?= $i ?>">
                                                <img src="<?= base_url() . $imgs['filepath'] ?>"
                                                     style="width:auto !important; height: 400px !important; display: block !important; margin: auto !important; "
                                                     class="img-responsive">
                                            </div>
                                        <?php
                                        endforeach;
                                        ?>
                                    </div>
                                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>

                                    <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3">

                            <!-- Navigation -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Room Information</h6>

                                </div>

                                <div class="list-group no-border no-padding-top">
                                    <div class="table-responsive">
                                        <table class="table table-striped">

                                            <tbody>
                                            <tr>
                                                <td>Room No:</td>
                                                <td><?= $room->roomnumber ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <center>
                                        <a class="btn btn-primary" href="<?= base_url('welcome/rooms/photos/' . $id) ?>"><i
                                                    class="fa fa-plus"></i> Add More Photos</a>
                                    </center>
                                </div>
                            </div>
                            <!-- /navigation -->

                        </div>

                    </div>
                    <!--/main slider carousel-->

                <?php } else { ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="container">
                            <h1><?php
                                $room = $this->db->query("select * from tbl_rooms where id='$id'")->row();

                                ?>
                                ROOM <?= strtoupper($room->roomnumber) ?></h1>
                            <br><br>
                            <center><h5>No Images for this Room Currently. You can Add images</h5></center>
                        </div>
                    </div>
                    <div class="col-lg-3">

                        <!-- Navigation -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Room Information</h6>

                            </div>

                            <div class="list-group no-border no-padding-top">
                                <div class="table-responsive">
                                    <table class="table table-striped">

                                        <tbody>
                                        <tr>
                                            <td>Room No:</td>
                                            <td><?= $room->roomnumber ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                               <center> <a class="btn btn-primary" href="<?= base_url('welcome/rooms/photos/' . $id) ?>"><i
                                               class="fa fa-plus"></i> Add More Photos</a></center>

                            </div>
                        </div>
                        <!-- /navigation -->

                    </div>

                    <?php } ?>


                </div>
                <!-- /cover area -->

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

            $('#myCarousel').carousel({
                interval: 4000
            });

// handles the carousel thumbnails
            $('[id^=carousel-selector-]').click(function () {
                var id_selector = $(this).attr("id");
                var id = id_selector.substr(id_selector.length - 1);
                id = parseInt(id);
                $('#myCarousel').carousel(id);
                $('[id^=carousel-selector-]').removeClass('selected');
                $(this).addClass('selected');
            });

// when the carousel slides, auto update
            $('#myCarousel').on('slid', function (e) {
                var id = $('.item.active').data('slide-number');
                id = parseInt(id);
                $('[id^=carousel-selector-]').removeClass('selected');
                $('[id^=carousel-selector-' + id + ']').addClass('selected');
            });
        });
    </script>
    <div id="covermodal" class="modal fade" tabindex="-1" data-controls-modal="covermodal" data-backdrop="static"
         data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-brown">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Update Cover Photo</h6>
                </div>

                <div class="modal-body">
                    <form action="#" id="imgform" method="post">
                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">Select Cover Photo:</label>
                            <div class="col-lg-10">
                                <input id="coverimage" type="file" name="file" class="file-input-preview"
                                       data-show-remove="true">
                                <span class="help-block">Maximum file upload size to 1MB. (JPG, PNG files only)</span>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" onclick="upload_images()" class="btn bg-brown btn-sm ">Upload Cover Photo
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="profilemodal" class="modal fade" tabindex="-1" data-controls-modal="profilemodal" data-backdrop="static"
         data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Update Profile Photo</h6>
                </div>

                <div class="modal-body">
                    <form action="#" id="profileform" method="post">
                        <div class="form-group">
                            <label class="col-lg-2 control-label text-semibold">Select Profile Photo:</label>
                            <div class="col-lg-10">
                                <input id="profileimage" type="file" name="file" class="file-input-preview"
                                       data-show-remove="true">
                                <span class="help-block">Maximum file upload size to 1MB. (JPG, PNG files only)</span>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="button" onclick="upload_profile_images()" class="btn bg-blue btn-sm ">Upload Profile
                        Photo
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function upload_profile_images() {

        var bimage = document.getElementById("profileimage").files.length;
        if (bimage === 0) {
            Swal.fire('Select Cover Image')
        } else {
            var formData = new FormData($('#profileform')[0]);

            $.ajax({
                url: "<?= base_url('welcome/profile/upload_profile/' . $id)?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                // dataType: 'text json',
                success: function (data) {

                    if (data == 'image_added') {
                        $('#profilemodal').modal('hide');

                        location.reload();

                    } else {
                        Swal.fire('Something went wrong.Please try again, If this persists contact Admin')
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire('Fatal Error! Please try again, If this persists contact Admin')


                }
            });
        }
    }

    function upload_images() {

        var bimage = document.getElementById("coverimage").files.length;
        if (bimage === 0) {
            Swal.fire('Select Cover Image')
        } else {
            var formData = new FormData($('#imgform')[0]);

            $.ajax({
                url: "<?= base_url('welcome/profile/upload_cover/' . $id)?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                // dataType: 'text json',
                success: function (data) {

                    if (data === 'image_added') {
                        $('#covermodal').modal('hide');

                        location.reload();

                    } else {
                        Swal.fire('Something went wrong.Please try again, If this persists contact Admin')
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire('Fatal Error! Please try again, If this persists contact Admin')


                }
            });
        }
    }
</script>

</html>
