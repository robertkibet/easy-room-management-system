<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Group Bookings</title>

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
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_select2.js"></script>


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
                    <h5 class="panel-title">Group Bookings</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Rooms</th>
                        <th>Amount Paid</th>
                        <th>Discount</th>
                        <th>Checkin</th>
                        <th>Checkout</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $groups = $this->db->query("select * from tbl_group_bookings where status='1' order by id desc")->result_array();
                    if (count($groups) > 0):
                        $i = 0;
                        foreach ($groups as $group):
                            $i++;
                            $bookingid = $group['id'];
                            $type = $group['rooms'];
                            $id = $group['addedby'];
                            $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$id'")->row();
                            $phone = $addedby->phone;
                            $allrooms = explode(",", $type);
                            $result = count($allrooms);
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><a href="javascript:void(0)" onclick="getrooms_booked(<?= $bookingid ?>)">
                                        <?php

                                        echo $result . ' rooms';
                                        ?>
                                    </a></td>
                                <td><?= 'KES. ' . number_format($group['amountpaid']) ?></td>
                                <td><?= 'KES. ' . number_format($group['expectedamount'] - $group['amountpaid']) ?></td>
                                <td><?= $group['checkin'] ?></td>
                                <td><?= $group['checkout'] ?></td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" onclick="release_room(<?= $bookingid ?>)"
                                       id="completebtn" class="btn bg-indigo-300 btn-labeled btn-xs"><b><i class="icon-check2"></i></b> CHECKOUT</a>
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
    function getrooms_booked(bookingid) {
        console.log(bookingid);
        $.ajax({
            url: "<?= base_url('group_bookings/fetchrooms_booked')?>",
            type: "POST",
            data: {
                bookingid: bookingid,
            },
            dataType: "html",
            success: function (results) {
                Swal.fire(
                    {
                        html: results
                    }
                )
            }
        });
    }

    function release_room(bookingid) {
        Swal.fire({
            html: "Marking Complete will release all rooms in this Group booking to be available for bookings",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed',
            cancelButtonText: 'No, Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('group_bookings/mark_as_complete')?>",
                    type: "POST",
                    data: {
                        bookingid: bookingid,
                    },
                    dataType: "text",
                    success: function (results) {
                        var data = JSON.parse(results);
                        // var data = results;
                        if (data == 'success') {
                            Swal.fire(
                                'Success',
                                'House has been released for more bookings',
                                'success'
                            ).then(function () {
                                location.reload();
                            })
                        } else {
                            Swal.fire(
                                'Failed to mark this House as completed. Try again or contact admin',
                            )
                        }
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Swal.fire(
                    'Great',
                    'Please proceed as required',
                    'info'
                )
            }
        })
    }

</script>
</body>

</html>
