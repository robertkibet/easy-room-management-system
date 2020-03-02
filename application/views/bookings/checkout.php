<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room Checkout</title>
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

    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/nicescroll.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/forms/styling/switch.min.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script src="<?= base_url() ?>assets/assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/assets/js/sweetalert2.all.min.js"></script>

    <script src="<?= base_url() ?>assets/assets/js/app.js"></script>
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
    <!--    <script src="--><? //= base_url() ?><!--assets/global_assets/js/demo_pages/form_select2.js"></script>-->

    <!-- /theme JS files -->


    <!-- /theme JS files -->

</head>

<body>

<?php $this->load->view('partials/navbar') ?>


<!-- Page container -->
<div class="page-container" style="min-height:90% !important;">

    <!-- Page content -->
    <div class="page-content" style="min-height:90% !important;">

        <!-- Main content -->
        <div class="content-wrapper" style="min-height:90% !important;">

            <!-- Basic datatable -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Room Checkout <code>Today: <?= date('Y-m-d') ?></code></h5>

                </div>
                <div class="table-responsive">
                    <table class="table datatable-basic table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Room</th>
                            <th>Checkin</th>
                            <th>Checkout</th>
                            <th>Date of Booking</th>
                            <th>Days Remaining</th>
                            <th>Checkout</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $date = date('Y-m-d');
                        $estates = $this->db->query("select * from bookings where checkout <= '$date' and active='1' order by checkout asc")->result_array();
                        if (count($estates) > 0):
                            $i = 0;
                            foreach ($estates as $estate):
                                $i++;
                                $bookingid=$estate['id'];
                                $id = $estate['room'];
                                $estateid = $estate['estate'];
                                $room = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$id'")->row();
                                $getroom = $room->roomnumber;
                                $estatefind = $this->db->query("SELECT * FROM  tbl_estates WHERE id='$estateid'")->row();
                                $getestate = $estatefind->estatename;

                                $now = strtotime(date('Y-m-d')); // or your date as well
                                $checkout = strtotime($estate['checkout']);
                                $datediff = $checkout - $now;

                                $daysremaining = round($datediff / (60 * 60 * 24));
                                if ($daysremaining < 0) {
                                    $daysremaining = 'EXPIRED';
                                }

                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><a href="#"><?= ucwords($getroom) ?></a></td>
                                    <td><?= $estate['checkin'] ?></td>
                                    <td><?= $estate['checkout'] ?></td>
                                    <td><?= $estate['dateadded'] ?></td>
                                    <td>
                                        <?php
                                        if ($daysremaining === 'EXPIRED') {
                                            ?>
                                            <span class="label label-danger" style="">EXPIRED</span>

                                        <?php } else {
                                            ?>
                                            <span class="label label-default"
                                                  style=""><?= $daysremaining ?> day(s) </span>

                                        <?php } ?>
                                    </td>

                                    <td>
                                        <a href="javascript:void(0)" onclick="clearbooking(<?= $bookingid ?>)"
                                           class="btn bg-indigo-300 btn-labeled btn-xs"><b><i
                                                        class="icon-check2"></i></b> CHECKOUT</a>

                                </tr>
                            <?php
                            endforeach;
                        else:
                            echo '<tr><td colspan="7"><center><h4>Everything seems alright. Come back later</h4></center></td></tr>';
                        endif; ?>

                        </tbody>
                    </table>
                </div>

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
    function clearbooking(id) {

        Swal.fire({
            title: 'Are you sure?',
            html: "<p>You are about to make a Room Checkout. <br>This Room will be made available for new bookings</p>",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            allowEscapeKey: false,
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?=base_url('welcome/checkout/')?>',
                    method: 'post',
                    data: {id: id},
                    dataType: 'text',
                    success: function (response) {
                        if (response === 'checked_out') {
                            swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Checkout Success'
                            }).then(function () {
                                location.reload();
                            })
                        } else {
                            swal.fire({
                                type: 'failed',
                                title: 'Failed',
                                text: 'Try again or contact administrator'
                            })
                        }
                    }
                });

            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Swal.fire(
                    'Cancelled',
                    'Ensure to keep checking and updating this records :)',
                    'error'
                )
            }
        })

    }

</script>
</body>

</html>
