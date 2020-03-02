<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Step 1 | Add Room</title>
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
                    <h5 class="panel-title">STEP 1 : Adding a Room</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <fieldset class="content-group">
                    <div class="container" style="max-width: 50%">
                        <div class="form-group">
                            <label class="control-label col-lg-4">Room Number</label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-home"></i></span>
                                    <input type="text" class="form-control" id="roomnumber"
                                           placeholder="Enter Room Number">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label class="control-label col-lg-4">Estate</label>

                            <div class="col-lg-8">
                                <select class="form-control select2" id="estates">
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
                        <br><br>
                        <div class="form-group ">
                            <label class="control-label col-lg-4">Type of Room</label>

                            <div class="col-lg-8">
                                <select class="form-control select2" id="typeofroom">
                                    <option selected disabled> -- select estates first --</option>

                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label class="control-label col-lg-4">Maximum Number of People</label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                    <input type="number" class="form-control" id="maxpeople"
                                           placeholder="Maximum number of people">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label class="control-label col-lg-4">Minimum Number of People</label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-users"></i></span>
                                    <input type="number" class="form-control" id="minpeople"
                                           placeholder="Minimum number of people">
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <label class="control-label col-lg-4">Amount Per person</label>
                            <div class="col-lg-8">
                                <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-cash"></i></span>
                                    <input type="number" class="form-control" id="amountperperson"
                                           placeholder="Amount per person">
                                </div>
                            </div>
                        </div>
                        <br><br>
                    </div>

                    <br>
                    <br>
                    <div class="container">
                        <center>
                            <button class="btn btn-default " data-dismiss="modal"><i class="icon-cross"></i> Cancel
                            </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-primary " id="saveuserButton"><i class="icon-plus2"></i> Add this
                                Room
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
    $(document).ready(function() {

        // City change
        $('#estates').change(function () {
            $('#typeofroom').append('<option selected disabled><i class="fa fa-spinner-third"></i> processing</option>');

            var estate = $(this).val();

            // AJAX request
            $.ajax({
                url: '<?=base_url('welcome/getRoomslist/')?>',
                method: 'post',
                data: {estate: estate},
                dataType: 'json',
                success: function (response) {
                    $('#typeofroom').empty();

                    // Remove options
                    $('#typeofroom').find('option').not(':first').remove();
                    $('#typeofroom').append('<option value="0">-- Select Room --</option>');

                    $.each(response, function (index, data) {
                        $('#typeofroom').append('<option value="' + data['id'] + '">' + data['roomtype'] + '</option>');
                    });
                }
            });
        });
    });
</script>
<script>
    $('#saveuserButton').on('click', function (e) {

        e.preventDefault();

        var roomnumber = $('#roomnumber').val();
        var typeofroom = $('#typeofroom').val();
        var estates = $('#estates').val();
        var maxpeople = $('#maxpeople').val();
        var minpeople = $('#minpeople').val();
        var amountperperson = $('#amountperperson').val();
        if (roomnumber.length <1) {
            swal.fire({
                type: 'error',
                text: 'Room Number is required'
            })
            $('#roomnumber').focus();
        } else if (estates === 0) {
            swal.fire({
                type: 'error',
                text: 'Select Estates First'
            })
            $('#estates').focus();
        }else if (typeofroom === 0) {
            swal.fire({
                type: 'error',
                text: 'Select the type of room'
            })
            $('#typeofroom').focus();
        } else if (maxpeople.length ===0) {
            swal.fire({
                type: 'error',
                text: 'Enter the Maximu number of people allowed for this room'
            })
            $('#maxpeople').focus();
        } else if (minpeople.length === 0) {
            swal.fire({
                type: 'error',
                text: 'Enter the minimum number of people required for this room'
            })
            $('#minpeople').focus();
        } else if (amountperperson.length === 0) {
            swal.fire({
                type: 'error',
                text: 'Enter Amount to be paid per person'
            })
            $('#amountperperson').focus();
        }
        else {
            $.ajax({
                url: "<?= base_url('welcome/rooms/saveroom_step1')?>",
                type: "POST",
                data: {
                    roomnumber:roomnumber,
                    estates:estates,
                    typeofroom: typeofroom,
                    maxpeople: maxpeople,
                    minpeople: minpeople,
                    amountperperson: amountperperson,
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
                            text: ' We could not add this Room. Try again or contact admin',
                            confirmButtonText:
                                'OK',

                        })

                    } else if (data === 'exists') {
                        Swal.fire({
                            title: 'Failed',
                            type: 'error',
                            text: ' A Room in this Estate with the same Room Number already exists in the system'

                        })

                    } else{
                        Swal.fire({
                            title: 'Success',
                            type: 'success',
                            text: 'Room was added successfully.'
                        }).then(function(){
                            window.location=data
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

    })
</script>
</body>

</html>
