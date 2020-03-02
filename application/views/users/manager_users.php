<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Users</title>
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
                    <h5 class="panel-title">System users</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <button type="button" class="btn bg-indigo-300 btn-sm" data-toggle="modal"
                            data-target="#modal_backdrop">Add User <i class="icon-user-plus position-right"></i>
                    </button>
                </div>
                <div id="modal_backdrop" class="modal fade" data-backdrop="false" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title"><i class="icon-user-plus"></i> Add new User</h5>
                            </div>

                            <div class="modal-body">
                                <fieldset class="content-group">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Firstname</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-address-book2"></i></span>
                                                <input type="text" class="form-control" id="firstname"
                                                       placeholder="Enter Firstname">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Lastname</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-address-book"></i></span>
                                                <input type="text" class="form-control" id="lastname"
                                                       placeholder="Enter Lastname">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Phone</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-phone"></i></span>
                                                <input type="text" class="form-control" id="phonenumber"
                                                       placeholder="Enter Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Role</label>
                                        <div class="col-lg-10">
                                            <select name="role" id="usrrole" class="select form-control">
                                                <option selected value="0">-- SELECT USER ROLE --</option>
                                                <option value="manager">Manager</option>
                                                <option value="caretaker">Caretaker</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Password</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-key"></i></span>
                                                <input type="text" class="form-control" id="usrpassword"
                                                       placeholder="Enter Password">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close
                                </button>
                                <button class="btn btn-primary" id="saveuserButton"><i class="icon-check"></i> Add user
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Names</th>
                        <th>Role</th>
                        <th>Phone No.</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $user = $this->db->query("select * from system_users order by id desc")->result_array();
                        if(count($user)>0):
                            $i =0;
                            foreach($user as $usr):
                                $i++;
                    ?>
                    <tr>
                        <td><?= $i?></td>
                        <td><?= ucwords($usr['firstname'].' '.$usr['lastname'])?></td>
                        <td><?= $usr['role']?></td>
                        <td><?= $usr['phone']?></td>
                        <td><span class="label label-success">Active</span></td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#"><i class="icon-user-cancel"></i> Remove</a></li>
                                        <!--                                        <li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>-->
                                        <!--                                        <li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>-->
                                    </ul>
                                </li>
                            </ul>
                        </td>                    </tr>
                    <?php
                        endforeach;
                        endif;
                    ?>
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
        $('#saveuserButton').on('click', function(e){

        e.preventDefault();

        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var phone = $('#phonenumber').val();
            var password = $('#usrpassword').val();
            var role = $('#usrrole').val();
        if (firstname.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Firstname is required'
            })
            $('#firstname').focus();
        } else if (lastname.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Lastname is required'
            })
            $('#lastname').focus();
        }
        else if (phone.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Firstname is required'
            })
            $('#phone').focus();
        } else if (password.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Enter User password'
            })
            $('#usrpassword').focus();
        } else if (role==0) {
            swal.fire({
                type: 'error',
                text: 'Select User Role'
            })
            $('#usrrole').focus();
        }
        else {

            $.ajax({
                url: "<?= base_url('welcome/system/save_user')?>",
                type: "POST",
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    phone: phone,
                    password: password,
                    role: role
                },
                dataType: "text",
                success: function (results) {
                    var data = JSON.parse(results);
                    // var data = results;
                    console.log(data);
                    if (data === 'failed_to_add_user') {
                        Swal.fire({
                            title: 'Sorry',
                            type: 'info',
                            text: ' We could not add this user. Try again or contact admin',
                            confirmButtonText:
                                'OK',

                        })
                        $('#saveuser').append('Try Again');

                    }else if (data === 'exists') {
                        Swal.fire({
                            title: 'Failed',
                            type: 'error',
                            text: ' A user with this phone number already exists in the system'

                        })
                        $('#saveuser').append('Try Again');

                    } else if (data ==='user_added'){
                        $('#saveuser').append('<i class="fa fa-spinner fa-spin"></i> please wait...');

                        Swal.fire({
                            title: 'Success',
                            type: 'success',
                            text: 'User was added successfully.'
                        }).then(function(){
                            location.reload();
                        })
                    }else {
                        Swal.fire({
                            title: 'Failed',
                            type: 'error',
                            text: ' Something went wrong. Check your internet connection and try again'

                        })
                        $('#saveuser').append('Try Again');

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
