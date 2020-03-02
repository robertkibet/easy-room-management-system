<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collect Rent</title>
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
    <script src="<?= base_url() ?>assets/global_assets/js/demo_pages/form_select2.js"></script>

    <!-- /theme JS files -->


    <!-- /theme JS files -->

</head>

<body>

<!-- Page container -->
<div class="page-container" style="min-height:90% !important;">

    <!-- Page content -->
    <div class="page-content" style="min-height:90% !important;">

        <!-- Main content -->
        <div class="content-wrapper" style="min-height:90% !important;">

            <!-- Basic datatable -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"><?= date('Y-m-d') ?></h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a href="<?= base_url('welcome') ?>" class="btn btn-sm btn-default"> Back Home</a></li>
                        </ul>
                    </div>
                </div>

                <fieldset class="content-group">
                    <form id="bookingform" role="form">
                        <div class="container">
                            <div class="well" style="min-height: 300px">
                                <h3>Rent Collection</h3>
                                <br>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="table-responsive" id="setrates">

                                            <?php
                                            $reservationid = $this->uri->segment(4);


                                            $getdata = $this->db->query("select * from tbl_rentals_reservations where id='$reservationid' limit 1")->row();
                                            $room = $getdata->room;
                                            $itemid = $getdata->id;
                                            $getsuite = $getdata->suite;
                                            $pricing = $getdata->monthlyrent;
//                                            $suite = $this->input->post('selectroom', true);
                                            $datefrom = $getdata->datefrom;
                                            $dateto = $getdata->dateto;

                                            $enddate = strtotime($dateto);
                                            $startdate = strtotime($datefrom);

                                            $datediff = $enddate - $startdate;

                                            $datedifference = round($datediff / (60 * 60 * 24));

                                            $days = $datediff / (60 * 60 * 24);

                                            if ($days < 2) {
                                                $days = 1;
                                            }
                                            $gethse = $this->db->query("SELECT * FROM  tbl_rooms_types WHERE id='$getsuite'")->row();
                                            $roomtype = $gethse->roomtype;
                                            $getroomnumber = $this->db->query("SELECT * FROM  tbl_rooms WHERE id='$room'")->row();
                                            $roomnumber = $getroomnumber->roomnumber;
                                            $dailypricing = $pricing / 30;
                                            $totalpricing = $datedifference * $dailypricing;

                                            $url=$this->uri->segment(4);
                                            $getreservation =$this->db->query("select * from tbl_rentals_reservations where id ='$url'")->row();
                                            $dicountedprice=$getreservation->monthlyrent;
                                            $discounteddailyrent=$getreservation->dailyrent;
                                            $totaldiscountedamount = $discounteddailyrent * $datedifference;

                                            $rates = '';
                                            $rates .= '
<center><h4>ROOM: '.$roomnumber.'</h4></center>
                <table class="table table-hover">
                    <thead>
                    <th>Description</th>
                    <th>Standard Rates</th>
                    <th>After Discount</th>
</thead>
                    <tbody>
                      <tr>
                        <td>' . ucwords($roomtype) . '</td>
                        <td>KES. ' . number_format($pricing) . '</td>
                        <td>KES. ' . number_format($dicountedprice) . '</td>
                      </tr>
                      <tr>
                        <td>Duration</td>
                        <td>' . number_format($datedifference) . ' days</td>
                        <td>' . number_format($datedifference) . ' days</td>
                      </tr>
                      <tr>
                        <td>Daily Rates</td>
                        <td>KES ' . number_format($dailypricing) . '</td>
                        <td>KES ' . number_format($discounteddailyrent) . '</td>
                      </tr>
                      <tr>
                        <td>Total Amount</td>
                        <td>KES. ' . number_format($totalpricing) . '</td>
                        <td>KES. ' . number_format($totaldiscountedamount) . '</td>
                      </tr>
                    </tbody>
                </table>
                  <br>
                  <center><p>This becomes effective as from <strong>' . $datefrom . '</strong>
                  </p></center>
                ';

                                            echo $rates;

                                            ?>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="display-block">Which Payment is this?</label>
                                                <select class="select display-block" id="paymenttype" style="width: 100% !important;">
                                                    <option value="0" selected>-- SELECT --</option>
                                                    <option value="inital">INITIAL PAYMENT</option>
                                                    <option value="progressive">PROGRESSIVE PAYMENTS</option>
                                                </select>
                                        </div>
                                        <div class="form-group">

                                            <label class="display-block">Amount received</label>
                                            <div class="input-group">
                                                <span class="input-group-addon bg-primary"><i
                                                            class="icon-cash2"></i></span>
                                                <input type="number" class="form-control" id="amountpaid"
                                                       value="0">
                                            </div>
                                            <p><code>Enter amount paid by client</code></p>

                                        </div>
                                        <br>
                                        <div style=" bottom: 0;">
                                            <center>
                                                <button type="submit"
                                                        style="width: 70% !important; min-height: 25px !important; font-size: 20px !important;"
                                                        class="btn btn-success" id="btnMakeBooking"><i
                                                            class="icon-cash3" style="font-size: 20px !important;"></i>
                                                    <span>COLLECT PAYMENT</span>
                                                </button>
                                                <br><br>
                                                <?php
                                                $checkpayments =$this->db->query("select * from tbl_rental_payments where rented_house='$reservationid'")->result_array();
                                                if(count($checkpayments)>0){
                                                ?>
                                                <a href="javascript:void(0)"
                                                        class="btn btn-secondary " id="" onclick="process_later()"><span>COLLECT PAYMENT LATER</span>
                                                </a>
                                                <?php }else{
                                                    echo '<center><p>This is a first payment hence, user is required to Pay a Minimum of 1 days rent, calculated from standard daily rates of this House, if they want to reserve or rent this room</p><br>
                                                            </center>';
                                                }?>
                                            </center>
                                            <br>
                                            <br>
                                        </div>

                                    </div>
                                </div>
                                <hr>

                            </div>

                        </div>
                        <br>
                        <br>
                    </form>

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
<script>
    function process_later(){
        Swal.fire({
            title: 'Hold Up!',
            html: "Do you want to skip and complete it later?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Proceed',
            cancelButtonText: 'No, Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Okay',
                    'If no initial payment is made, this room will be available for booking',
                    'success'
                ).then(function () {
                    window.location = "<?= base_url('rental/reservations')?>"
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
    }
    $('#btnMakeBooking').click(function (e) {
        e.preventDefault();

        var paymenttype = $('#paymenttype').val();
        var amountpaid = $('#amountpaid').val();
        var rented_hse = "<?= $this->uri->segment(4)?>";
         if (paymenttype == '0' ) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Specify the type of payment being made by client'
            })
        } else if (amountpaid == 0 ) {
            swal.fire({
                type: 'error',
                title: 'Failed',
                text: 'Enter the amount paid by the client'
            })
        } else {
            $.ajax({
                url: '<?=base_url('rental/houses/make_payments/')?>',
                method: 'post',
                data: {
                    rented_hse: rented_hse,
                    amountpaid: amountpaid,
                    paymenttype: paymenttype,
                    dailyamt:<?=$discounteddailyrent?>
                },
                success: function (response) {
                    // var data = parse.json(response);
                    var data = response;

                    if (data === 'not_enough') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'Deposits should be made'
                        })
                    }else if (data === 'balanced_out') {
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            html: 'This amount exceeds remaining balance. <br>Check Payment records to get the Remaining Balance'
                        })
                    }else if(data==='required_deposit'){
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'First payments should be equal to a days payment or more'
                        })
                    } else if(data==='failed_payment'){
                        swal.fire({
                            type: 'error',
                            title: 'Failed',
                            text: 'This payment exceeds the total amount as per the indicated duration of stay. Consider extending this users stay if indeed they intend to extend their stay so as to update this payment'
                        })
                    } else if(data ==='success'){
                        Swal.fire({
                            type:'success',
                            text:'Payment Saved'
                        }).then(function () {
                            window.location="<?= base_url('rental/reservations')?>"
                        })
                    }else {
                        Swal.fire({
                            type:'error',
                            text:'We could not save this payment details. Check connection and try again'
                        })
                    }


                }, error: function (data, exception) {

                    swal.fire(
                        'Error',
                        'We could not process this request. Check your connection and Try again',
                        'error'
                    )
                }
            });
        }
    });
</script>
<!-- /footer -->
</body>

</html>
