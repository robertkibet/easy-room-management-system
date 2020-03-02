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
                    <h5 class="panel-title">Estates</h5>
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
                            data-target="#modal_backdrop">Add New Estate <i class="icon-home position-right"></i>
                    </button>
                </div>
                <div id="modal_backdrop" class="modal fade" data-backdrop="false" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="modal-title"><i class="icon-home"></i> Add new Estate</h5>
                            </div>

                            <div class="modal-body">
                                <fieldset class="content-group">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Estate name</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-home"></i></span>
                                                <input type="text" class="form-control" id="estatename"
                                                       placeholder="Enter Name">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Location</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-location3"></i></span>
                                                <input type="text" class="form-control" id="estatelocation"
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
                                <button class="btn btn-primary" id="saveuserButton"><i class="icon-check"></i> Add Estate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Estate Name</th>
                        <th>Location</th>
                        <th>Number of Rooms</th>
                        <th>Date Added</th>
                        <th>Added By</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $estates = $this->db->query("select * from tbl_estates order by id desc")->result_array();
                    if(count($estates)>0):
                        $i =0;
                        foreach($estates as $estate):
                            $i++;
                            $eid=$estate['id'];
                            $getrooms=$this->db->query("select count(id) as numbers from tbl_rooms where estateid='$eid'")->row();
                            $roomsnumber=$getrooms->numbers;

                            $id=$estate['addedby'];
                            $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$id'")->row();
                            $phone = $addedby->phone;



                            ?>
                            <tr>
                                <td><?= $i?></td>
                                <td><a href="#"><?= ucwords($estate['estatename'])?></a></td>
                                <td><?= $estate['estatelocation']?></td>
                                <td><?= $roomsnumber?> rooms</td>
                                <td><?= $estate['dateadded']?></td>
                                <td><?= $phone?></td>

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
<script>
    $('#saveuserButton').on('click', function(e){

        e.preventDefault();

        var estatename = $('#estatename').val();
        var estatelocation = $('#estatelocation').val();
        if (estatename.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Name of Estate is required'
            })
            $('#estatename').focus();
        } else if (estatelocation.length < 2) {
            swal.fire({
                type: 'error',
                text: 'Location of Estate is required'
            })
            $('#estatelocation').focus();
        }
        else {

            $.ajax({
                url: "<?= base_url('welcome/estates/save_estate')?>",
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

                    }else if (data === 'exists') {
                        Swal.fire({
                            title: 'Failed',
                            type: 'error',
                            text: ' An Estate with this Name already exists in the system'

                        })
                        document.getElementById('saveuser').innerHTML = 'Try Again';

                    } else if (data ==='added'){
                        Swal.fire({
                            title: 'Success',
                            type: 'success',
                            text: 'Estate was added successfully.'
                        }).then(function(){
                            location.reload();
                        })
                    }else {
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
