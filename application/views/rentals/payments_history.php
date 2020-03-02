<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Reservations</title>
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
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_select2.js"></script>


    <!-- /theme JS files -->

</head>

<body>

<?php $this->load->view('partials/navbar');

$url = $this->uri->segment(4);
$checkdata = $this->db->query("select * from tbl_rental_payments where rented_house='$url'")->result_array();
if (count($checkdata) > 0) {
    $getdetails = $this->db->query("select * from tbl_rentals_reservations where id='$url'")->row();
    $room = $getdetails->room;
    $suitestatus = $getdetails->status;
    $completed = $getdetails->paymentcompleted;
    $suite = $getdetails->suite;
    $getrental = $this->db->query("select * from tbl_rentals_rates where suite='$suite'")->row();
    $getsuite = $this->db->query("select * from tbl_rooms_types where id='$suite'")->row();
    $roomtype = $getsuite->roomtype;
    $estateid = $getsuite->estateid;
    $getestate = $this->db->query("select * from tbl_estates where id='$estateid'")->row();
    $estate = $getestate->estatename;
    $getroom = $this->db->query("select * from tbl_rooms where id='$room'")->row();
    $roomnumber = $getroom->roomnumber;
    $amountreceived = $this->db->query("select sum(amount) as amountpaid from tbl_rental_payments where rented_house='$room'")->row();
    $grosstotal = $getdetails->dailyrent * $getdetails->stayduration;
    $balance = $grosstotal - $amountreceived->amountpaid;


    ?>

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <strong>Sorry</strong> No records found to print
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                }
                ?>
                <!-- Basic datatable -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Payment History</h5>
                        <div class="heading-elements">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary"><i class="icon-cog5 position-left"></i>
                                    Quick Actions
                                </button>
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <?php
                                    if ($completed != 1 && $suitestatus != 2) {

                                        ?>
                                        <li><a href="<?= base_url('rental/houses/collect_rent/' . $url) ?>"><i
                                                        class="icon-cash2"></i> Collect Payment</a></li>
                                        <li><a href=javascript:void(0)" id="completebtn"><i
                                                        class="icon-checkbox-checked"></i> Mark as Completed</a></li>
                                        <li><a href="<?= base_url('rental/reports/print_single_rental/' . $url) ?>"><i
                                                        class="icon-printer"></i> Payment History</a></li>
                                        <li class="divider"></li>
                                        <li><a href="javascript:void(0)" id="cancelbtn"><i class="icon-cross"></i>
                                                Cancel Reservation</a></li>
                                    <?php } else { ?>
                                        <li><a href="#"><i class="icon-printer"></i> Generate Payment History</a></li>

                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="table table-responsive">
                                <table class="table table-borderless">

                                    <tbody>
                                    <tr>
                                        <td>ESTATE</td>
                                        <td><?= ucwords($estate) ?></td>
                                    </tr>
                                    <tr>
                                        <td>SUITE</td>
                                        <td><?= ucwords($roomtype) ?></td>
                                    </tr>
                                    <tr>
                                        <td>ROOM</td>
                                        <td><?= ucwords($roomnumber) ?></td>
                                    </tr>
                                    <tr>
                                        <td>STANDARD RATE</td>
                                        <td><?= 'KES. ' . number_format($getrental->monthly) ?> Monthly<br>
                                            <?= 'KES. ' . number_format($getrental->daily) ?> Daily
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>BILLED RATE</td>
                                        <td><?= 'KES. ' . number_format($getdetails->monthlyrent) ?> Monthly<br>
                                            <?= 'KES. ' . number_format($getdetails->dailyrent) ?> Daily
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Duration</td>
                                        <td><?= $getdetails->stayduration ?> days</td>
                                    </tr>
                                    <tr>
                                        <td>Checkin</td>
                                        <td><?= $getdetails->datefrom ?></td>
                                    </tr>
                                    <tr>
                                        <td>STATUS</td>
                                        <?php
                                        if ($suitestatus == 2) {
                                            $btn = 'label label-danger';
                                            $txt = 'CANCELLED';
                                        } else if ($suitestatus == 1 && $completed == 1) {
                                            $btn = 'label bg-blue';
                                            $txt = 'COMPLETED';
                                        } else {
                                            $btn = 'label label-success';
                                            $txt = 'ACTIVE';
                                        }
                                        ?>
                                        <td><label class="<?= $btn ?>"><?= $txt ?></label></td>
                                    </tr>
                                    <tr>
                                        <td>TOTAL AMOUNT</td>
                                        <td><?= 'KES. ' . number_format($grosstotal) ?></td>
                                    </tr>
                                    <tr>

                                        <td>AMOUNT RECEIVED</td>
                                        <td><?= 'KES.' . number_format($amountreceived->amountpaid) ?></td>
                                    </tr>
                                    <tr>

                                        <td>BALANCE</td>
                                        <td><?= 'KES.' . number_format($balance) ?></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <br>

                            <br><br>
                        </div>
                        <div class="col-md-8">
                            <table class="table datatable-basic">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>AMOUNT PAID</th>
                                    <th>TYPE</th>
                                    <th>ADDED BY</th>
                                    <th>DATE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $rentals = $this->db->query("select * from tbl_rental_payments where rented_house='$url' order by id desc")->result_array();
                                if (count($rentals) > 0):
                                    $i = 0;
                                    foreach ($rentals as $item):
                                        $i++;
                                        $id = $item['addedby'];
                                        $addedby = $this->db->query("SELECT * FROM  system_users WHERE id='$id'")->row();
                                        $phone = $addedby->phone;
                                        $rentalid = $item['id'];
                                        $status = $item['paymenttype'];
                                        if ($status === 'progressive') {
                                            $stats = 'label bg-purple';
                                            $text = 'PROGRESSIVE';
                                        } else {
                                            $stats = 'label label-success';
                                            $text = 'INITIAL';
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= 'KES. ' . number_format($item['amount']) ?></td>
                                            <td><span class="<?= $stats ?>"><?= $text ?></span></td>
                                            <td><?= $phone ?></td>
                                            <td><?= $item['dateadded'] ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /basic datatable -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

<?php } else {
    echo '<div class="page-container"><center><h3>NO DATA FOUND</h3></center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div> ';
}
?>
<!-- Footer -->
<div class="footer text-muted">
    &copy; 2019. <a href="#">Easy Room Management System</a> by <a href="#" target="_blank">SenSen Ventures</a>

</div>
<!-- /footer -->
<script>
    $('#monthly').on('keyup', function () {
        var monthly = document.getElementById('monthly').value;
        var daily = parseInt(monthly) / 30;
        $('#daily').empty();
        var amount = Math.ceil(daily);
        $('#daily').val(amount);
    });
    $('#completebtn').on('click', function () {
        Swal.fire({
            html: "Marking Complete will release the house to be available for bookings",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed',
            cancelButtonText: 'No, Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('rental/mark_as_complete')?>",
                    type: "POST",
                    data: {
                        rental: <?= $url?>,
                    },
                    dataType: "text",
                    success: function (results) {
                        var data = JSON.parse(results);
                        // var data = results;
                        console.log(data);
                        if (data === 'failed') {
                            Swal.fire({
                                html: "There is still some pending balance.<br><br> Do you still want to mark this House as Complete?",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No, Cancel',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        url: "<?= base_url('rental/mark_as_complete_forced')?>",
                                        type: "POST",
                                        data: {
                                            rental: <?= $url?>,
                                        },
                                        dataType: "text",
                                        success: function (res) {
                                            var data = JSON.parse(res);
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
                                    })
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
                        } else {
                            Swal.fire(
                                'Success',
                                'Room marked as Complete',
                                'success'
                            ).then(function () {
                                location.reload();
                            })
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
    })
    $('#cancelbtn').on('click', function () {
        Swal.fire({
            html: "You are about to cancel this Reservation",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed',
            cancelButtonText: 'No, Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('rental/release_house')?>",
                    type: "POST",
                    data: {
                        rental: <?= $url?>,
                    },
                    dataType: "text",
                    success: function (results) {
                        var data = JSON.parse(results);
                        // var data = results;
                        console.log(data);
                        if (data === 'failed') {
                            Swal.fire({
                                html: "Pending Balances Found <br><br> Do you still want to cancel this reservation?",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No, Cancel',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        url: "<?= base_url('rental/release_house_forced')?>",
                                        type: "POST",
                                        data: {
                                            rental: <?= $url?>,
                                        },
                                        dataType: "text",
                                        success: function (res) {
                                            var data = JSON.parse(res);
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
                                    })
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
                        } else {
                            Swal.fire(
                                'Success',
                                'Room marked as Complete',
                                'success'
                            ).then(function () {
                                location.reload();
                            })
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
    })

</script>
</body>

</html>
