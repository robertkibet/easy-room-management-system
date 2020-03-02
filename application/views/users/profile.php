<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Settings</title>
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
            $id = $mydata['id'];
            $user = $this->db->query("select * from system_users where id = '$id'")->row();
            $profile = $this->db->query("select * from tbl_user_profile where userid = '$id'")->row();
            $countprofile = $this->db->query("select * from tbl_user_profile where userid = '$id'")->result_array();
            $cover = $this->db->query("select * from tbl_user_images where userid = '$id'")->row();
            $countcover = $this->db->query("select * from tbl_user_images where userid = '$id'")->result_array();
            ?>
            <!-- Cover area -->
            <div class="profile-cover">
                <?php if (count($countcover) > 0) { ?>
                    <div class="profile-cover-img"
                         style="background-image: url(<?= ($cover->filepath == null) ? base_url() . 'assets/global_assets/images/demo/blog/1.jpg' : base_url() . $cover->filepath ?>)"></div>
                <?php } else { ?>
                    <div class="profile-cover-img"
                         style="background-image: url(<?= base_url() . 'assets/global_assets/images/demo/blog/1.jpg' ?>)"></div>

                <?php } ?>


                <div class="media">
                    <?php if (count($countprofile) > 0) { ?>
                        <div class="media-left">
                            <a href="#" class="profile-thumb">
                                <img src="<?= ($profile->filepath == null) ? base_url() . 'assets/global_assets/images/demo/users/face11.jpg' : base_url() . $profile->filepath ?>"
                                     class="img-circle img-md" alt="">
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="media-left">
                            <a href="#" class="profile-thumb">
                                <img src="<?= base_url() . 'assets/global_assets/images/demo/users/face11.jpg' ?>"
                                     class="img-circle img-md" alt="">
                            </a>
                        </div>
                    <?php } ?>


                    <div class="media-body">
                        <h1><?= ucwords($user->firstname . ' ' . $user->lastname) ?>
                            <small class="display-block">Role: <?= ucwords($user->role) ?></small>
                        </h1>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
                            <li><a id="updatecover" href="javascript:void(0)" class="btn btn-default"><i
                                            class="icon-file-picture position-left"></i> Cover image</a></li>
                            <li><a id="updatephoto" href="javascript:void(0)" class="btn btn-default"><i
                                            class="icon-profile position-left"></i> Profile Image</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /cover area -->


            <!-- Toolbar -->
            <div class="navbar navbar-default navbar-xs navbar-component no-border-radius-top">
                <ul class="nav navbar-nav visible-xs-block">
                    <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i
                                    class="icon-menu7"></i></a></li>
                </ul>

                <div class="navbar-collapse collapse" id="navbar-filter">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i>
                                Settings</a></li>
                    </ul>

                </div>
            </div>
            <!-- /toolbar -->


            <!-- User profile -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="tabbable">
                        <div class="tab-content">

                            <div class="tab-pane fade in active" id="settings">

                                <!-- Profile info -->
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Profile information</h6>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a data-action="collapse"></a></li>
                                                <li><a data-action="reload"></a></li>
                                                <li><a data-action="close"></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <form action="#">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Firstname</label>
                                                        <input type="text" value="<?= $user->firstname ?>"
                                                               id="firstname" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Lastname</label>
                                                        <input type="text" value="<?= $user->lastname ?>" id="lastname"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Email</label>
                                                        <input type="text" value="<?= $user->email ?>" id="email"
                                                               class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Phone</label>
                                                        <input type="text" value="<?= $user->phone ?>" id="phone"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" id="updateprofile" class="btn btn-primary"><i
                                                            class="icon-profile position-right"></i> Update Details
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <!-- /profile info -->


                                <!-- Account settings -->
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Password</h6>

                                    </div>

                                    <div class="panel-body">
                                        <form action="#">
                                            <div class="col-md-4">
                                                <label>Old Password</label>
                                                <input type="password" disabled value="<?= $user->password ?>"
                                                       class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>New Password</label>
                                                <input type="password" id="newpassword" value="" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Confirm Password</label>
                                                <input type="password" id="confpassword" value="" class="form-control">
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-right">
                                                <button type="button" id="updatepassword" class="btn btn-primary"><i
                                                            class="icon-key position-right"></i> Update Password
                                                </button>
                                                <br>
                                                <code style="font-size: smaller">You will be logged out after changing password</code>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /account settings -->

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">

                    <!-- Navigation -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Navigation</h6>

                        </div>

                        <div class="list-group no-border no-padding-top">
                            <div class="list-group-divider"></div>
                            <a href="<?= base_url('welcome/calendar') ?>" class="list-group-item"><i
                                        class="icon-calendar3"></i> Calendar</a>
                        </div>
                    </div>
                    <!-- /navigation -->

                </div>
            </div>
            <!-- /user profile -->

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

        $('#updatecover').on('click', function (e) {
            e.preventDefault();
            $('#covermodal').modal('show');

        });
        $('#updatephoto').on('click', function (e) {
            e.preventDefault();
            $('#profilemodal').modal('show');

        });
        $('#updatepassword').on('click', function (e) {
            e.preventDefault();
            var newpassword = $('#newpassword').val();
            var confirmpassword = $('#confpassword').val();
            if (newpassword.length < 6) {
                swal.fire({
                    type: 'error',
                    text: 'Password should be 6 or more characters'
                });
                $('#newpassword').focus();
            } else if (confirmpassword !== newpassword) {
                swal.fire({
                    type: 'error',
                    text: 'Confirm Password donot match with New Password'
                });
                $('#confirmpassword').focus();
            } else {

                $.ajax({
                    url: "<?= base_url('welcome/profile/update_password')?>",
                    type: "POST",
                    data: {
                        newpassword: newpassword
                    },
                    dataType: "text",
                    success: function (results) {
                        var data = JSON.parse(results);
                        // var data = results;
                        if (data === 'added') {
                            Swal.fire({
                                title: 'Success',
                                type: 'success',
                                text: 'Password Updated successfully.'
                            }).then(function () {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: 'Failed',
                                type: 'error',
                                text: ' Something went wrong. Check your internet connection and try again'

                            })

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
        });

        $('#updateprofile').on('click', function (e) {
            e.preventDefault();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            if (phone.length < 10) {
                swal.fire({
                    type: 'error',
                    text: 'Incorrect Phone Number'
                });
                $('#phone').focus();
            } else if (lastname.length < 1) {
                swal.fire({
                    type: 'error',
                    text: 'Lastname is required'
                });
                $('#lastname').focus();
            } else if (email.length < 1) {
                swal.fire({
                    type: 'error',
                    text: 'Email is required'
                });
                $('#email').focus();
            } else if (isEmail(email) !== true) {
                swal.fire({
                    type: 'error',
                    text: 'Valid Email is required'
                });
                $('#email').focus();
            } else {

                $.ajax({
                    url: "<?= base_url('welcome/profile/update_details')?>",
                    type: "POST",
                    data: {
                        firstname: firstname,
                        lastname: lastname,
                        email: email,
                        phone: phone
                    },
                    dataType: "text",
                    success: function (results) {
                        var data = JSON.parse(results);
                        // var data = results;
                        if (data === 'added') {
                            Swal.fire({
                                title: 'Success',
                                type: 'success',
                                text: 'Your details has been updated successfully.'
                            }).then(function () {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: 'Failed',
                                type: 'error',
                                text: ' Something went wrong. Check your internet connection and try again'

                            })

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
        });

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
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
                <button type="button" onclick="upload_images()" class="btn bg-brown btn-sm ">Upload Cover Photo</button>
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
