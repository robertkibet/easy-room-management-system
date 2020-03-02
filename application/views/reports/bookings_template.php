<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookings Report Template</title>
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
<div class="content-wrapper">

    <div class="panel panel-white">

        <div class="panel-body no-padding-bottom">
            <div class="row">
                <div class="col-sm-6 content-group">
                    <img src="<?= base_url()?>assets/global_assets/images/logo_demo.png" class="content-group mt-10" alt="" style="width: 120px;">
                    <ul class="list-condensed list-unstyled">
                        <li>2269 Elba Lane</li>
                        <li>Paris, France</li>
                        <li>888-555-2311</li>
                    </ul>
                </div>

                <div class="col-sm-6 content-group">
                    <div class="invoice-details">
                        <h5 class="text-uppercase text-semibold">Invoice #49029</h5>
                        <ul class="list-condensed list-unstyled">
                            <li>Date: <span class="text-semibold">January 12, 2015</span></li>
                            <li>Due date: <span class="text-semibold">May 12, 2015</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-9 content-group">
                    <span class="text-muted">Invoice To:</span>
                    <ul class="list-condensed list-unstyled">
                        <li><h5>Rebecca Manes</h5></li>
                        <li><span class="text-semibold">Normand axis LTD</span></li>
                        <li>3 Goodman Street</li>
                        <li>London E1 8BF</li>
                        <li>United Kingdom</li>
                        <li>888-555-2311</li>
                        <li><a href="#">rebecca@normandaxis.ltd</a></li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-3 content-group">
                    <span class="text-muted">Payment Details:</span>
                    <ul class="list-condensed list-unstyled invoice-payment-details">
                        <li><h5>Total Due: <span class="text-right text-semibold">$8,750</span></h5></li>
                        <li>Bank name: <span class="text-semibold">Profit Bank Europe</span></li>
                        <li>Country: <span>United Kingdom</span></li>
                        <li>City: <span>London E1 8BF</span></li>
                        <li>Address: <span>3 Goodman Street</span></li>
                        <li>IBAN: <span class="text-semibold">KFH37784028476740</span></li>
                        <li>SWIFT code: <span class="text-semibold">BPT4E</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-lg">
                <thead>
                <tr>
                    <th>Description</th>
                    <th class="col-sm-1">Rate</th>
                    <th class="col-sm-1">Hours</th>
                    <th class="col-sm-1">Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <h6 class="no-margin">Create UI design model</h6>
                        <span class="text-muted">One morning, when Gregor Samsa woke from troubled.</span>
                    </td>
                    <td>$70</td>
                    <td>57</td>
                    <td><span class="text-semibold">$3,990</span></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="no-margin">Support tickets list doesn't support commas</h6>
                        <span class="text-muted">I'd have gone up to the boss and told him just what i think.</span>
                    </td>
                    <td>$70</td>
                    <td>12</td>
                    <td><span class="text-semibold">$840</span></td>
                </tr>
                <tr>
                    <td>
                        <h6 class="no-margin">Fix website issues on mobile</h6>
                        <span class="text-muted">I am so happy, my dear friend, so absorbed in the exquisite.</span>
                    </td>
                    <td>$70</td>
                    <td>31</td>
                    <td><span class="text-semibold">$2,170</span></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="panel-body">
            <div class="row invoice-payment">
                <div class="col-sm-7">
                    <div class="content-group">
                        <h6>Authorized person</h6>
                        <div class="mb-15 mt-15">
                            <img src="../../../../global_assets/images/signature.png" class="display-block" style="width: 150px;" alt="">
                        </div>

                        <ul class="list-condensed list-unstyled text-muted">
                            <li>Eugene Kopyov</li>
                            <li>2269 Elba Lane</li>
                            <li>Paris, France</li>
                            <li>888-555-2311</li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="content-group">
                        <h6>Total due</h6>
                        <div class="table-responsive no-border">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">$7,000</td>
                                </tr>
                                <tr>
                                    <th>Tax: <span class="text-regular">(25%)</span></th>
                                    <td class="text-right">$1,750</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td class="text-right text-primary"><h5 class="text-semibold">$8,750</h5></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b> Send invoice</button>
                        </div>
                    </div>
                </div>
            </div>

            <h6>Other information</h6>
            <p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>
        </div>
    </div>

</div>

<!-- Footer -->
<div class="footer text-muted">
    &copy; 2019. <a href="#">Easy Room Management System</a> by <a href="#" target="_blank">SenSen Ventures</a>

</div>
<!-- /footer -->
</body>

</html>
