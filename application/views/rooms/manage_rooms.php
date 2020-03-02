<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Rooms</title>
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
                    <h5 class="panel-title">Manage Rooms</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <a type="button" class="btn bg-indigo-300 btn-sm"
                       href="<?= base_url('welcome/rooms/add_new_room_step_1') ?>">Add a New Room <i
                                class="icon-home position-right"></i>
                    </a>
                </div>
                <div id="modal_backdrop" class="modal fade" data-backdrop="false" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title"><i class="icon-home"></i> Add new Room Type</h5>
                            </div>

                            <div class="modal-body">
                                <fieldset class="content-group">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Room Number</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-home"></i></span>
                                                <input type="text" class="form-control" id="roomnumber"
                                                       placeholder="Enter Type of Room">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-lg-10">
                                            <select class="form-control select2" onchange="setrooms()" id="typeofroom">
                                                <option selected disabled> -- Select Estate --</option>
                                                <?php
                                                $getestate = $this->db->query("select * from tbl_estates order by estatename asc")->result_array();
                                                foreach ($getestate as $estates_list):
                                                    echo '<option value="' . $estates_list['id'] . '">' . ucwords($estates_list['estatename']) . '</option>';
                                                endforeach;
                                                ?>
                                                <option disabled> End of List</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-lg-10">
                                            <select class="form-control select2" id="typeofroom">
                                                <option selected disabled> -- Select Type of Room --</option>
                                                <?php
                                                $getestate = $this->db->query("select * from tbl_rooms_types order by roomtype desc")->result_array();
                                                foreach ($getestate as $estates_list):
                                                    echo '<option value="' . $estates_list['id'] . '">' . ucwords($estates_list['roomtype']) . '</option>';
                                                endforeach;
                                                ?>
                                                <option disabled> End of List</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Maximum Number of People</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                                <input type="number" class="form-control" id="maxpeople"
                                                       placeholder="Enter Type of Room">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Minimum Number of People</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                                <input type="number" class="form-control" id="minpeople"
                                                       placeholder="Enter Type of Room">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Amount Per person</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-cash"></i></span>
                                                <input type="number" class="form-control" id="amountperperson"
                                                       placeholder="Enter Type of Room">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Number of Rooms</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-bed2"></i></span>
                                                <input type="text" class="form-control" id="numberofrooms"
                                                       placeholder="Enter Location">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </fieldset>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-link" data-dismiss="modal"><i class="icon-cross"></i> Close
                                </button>
                                <button class="btn btn-primary" id="saveuserButton"><i class="icon-check"></i> Add Room
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="alert bg-danger alert-styled-left">-->
<!--                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span-->
<!--                                class="sr-only">Close</span></button>-->
<!--                    <span class="text-semibold">Alert</span> <strong>This Page (Rooms Module) is undergoing Maintenance. Other functionalities works well, except you cannot Add any Room as of Now</strong>-->
<!--                </div>-->
                <table class="table datatable-basic">
                    <code>Click on Room Number to view Details about the Room including its Images</code>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile<br><span style="font-size:80%">&nbsp;</span></th>
                        <th>Room Number<br><span style="font-size:80%">&nbsp;</span></th>
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
                    if (count($rooms) > 0):
                        $i = 0;
                        foreach ($rooms as $room):
                            $i++;
                            $id = $room['addedby'];
                            $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$id'")->row();
                            $phone = $addedby->phone;
                            $roomid = $room['id'];
                            $roomtype = $room['roomtype'];

                            $gettypes = $this->db->query("SELECT roomtype FROM  tbl_rooms_types WHERE id='$roomtype'")->row();
                            $types = $gettypes->roomtype;

                            $estateid = $room['estateid'];
                            $getestate = $this->db->query("SELECT * FROM tbl_estates WHERE id='$estateid'");

                            if ($getestate->num_rows() > 0) {
                                $getss = $getestate->row();
                                $estatename = $getss->estatename;
                            } else {
                                $estatename = '';
                            }
                            $rmid=$room['id'];
                            $imgs = $this->db->query("select * from tbl_rooms_images where roomid='$rmid' order by RAND() limit 1");
                            if($imgs->num_rows()>0){
                                $images = $imgs->row();
                                $profile = $images->filepath;
                            }else{
                                $profile = '';
                            }


                            ?>
                            <tr>

                                <td><?= $i ?></td>
                                <td class="no-padding-right" style="width: 45px;">
                                    <a href="#">
                                        <img src="<?= base_url() . $profile?>" height="60" class="" alt="">
                                    </a>
                                </td>
                                <td><a href="<?= base_url('welcome/rooms/view/'.$room['id'])?>"><?= $room['roomnumber'] ?></a></td>
                                <td><?= $types ?></td>
                                <td><?= $room['maxpeople'] ?></td>
                                <td><?= $room['minpeople'] ?></td>
                                <td><?= $room['amountperperson'] ?></td>
                                <td><?= ucwords($estatename) ?></td>
                                <td><?= $phone ?></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="<?= base_url('welcome/rooms/photos/'.$room['id'])?>"><i class="icon-images2"></i> Add Photos</a></li>
                                                <li><a href="<?= base_url('welcome/rooms/pricing/'.$room['id'])?>"><i class="icon-wallet"></i> Manage Pricing</a></li>
                                                <li><a href="<?= base_url('welcome/rooms/remove/'.$room['id'])?>"><i class=" icon-trash"></i> Remove this Room</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
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
<script>
    $('#saveuserButton').on('click', function (e) {

        e.preventDefault();

        var roomnumber = $('#roomnumber').val();
        var typeofroom = $('#typeofroom').val();
        var maxpeople = $('#maxpeople').val();
        var minpeople = $('#minpeople').val();
        var amountperperson = $('#amountperperson').val();
        var numberofrooms = $('#numberofrooms').val();
        if (roomnumber.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Room Number is required'
            })
            $('#roomnumber').focus();
        } else if (typeofroom === 0) {
            swal.fire({
                type: 'error',
                text: 'Select the type of room'
            })
            $('#typeofroom').focus();
        } else if (maxpeople.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Enter the Maximu number of people allowed for this room'
            })
            $('#maxpeople').focus();
        } else if (minpeople.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Enter the minimum number of people required for this room'
            })
            $('#minpeople').focus();
        } else if (amountperperson.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Enter Amount to be paid per person'
            })
            $('#amountperperson').focus();
        } else {
            $.ajax({
                url: "<?= base_url('welcome/rooms/save_rooms')?>",
                type: "POST",
                data: {
                    estatename: estatename,
                    estatelocation: estatelocation
                },
                dataType: "text",
                success: function (results) {
                    var data = JSON.parse(results);
                    // var data = results;
                    console.log(data);
                    if (data === 'failed_to_add') {
                        Swal.fire({
                            title: 'Sorry',
                            type: 'info',
                            text: ' We could not add this Estate. Try again or contact admin',
                            confirmButtonText:
                                'OK',

                        })
                        document.getElementById('saveuser').innerHTML = 'Try Again';

                    } else if (data === 'exists') {
                        Swal.fire({
                            title: 'Failed',
                            type: 'error',
                            text: ' An Estate with this Name already exists in the system'

                        })
                        document.getElementById('saveuser').innerHTML = 'Try Again';

                    } else if (data === 'added') {
                        Swal.fire({
                            title: 'Success',
                            type: 'success',
                            text: 'Estate was added successfully.'
                        })
                    } else {
                        Swal.fire({
                            title: 'Failed',
                            type: 'error',
                            text: ' Something went wrong. Check your internet connection and try again'

                        })
                        document.getElementById('saveuser').innerHTML = 'Try Again';

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
