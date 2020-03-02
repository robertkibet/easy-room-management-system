<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice No. <?= $this->uri->segment(4) ?></title>
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
    <script src="<?= base_url() ?>assets/global_assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/assets/js/printthis.js"></script>

    <!-- /theme JS files -->

</head>

<body>

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Invoice template -->
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title">Invoice</h6>
                    <div class="heading-elements">
                        <a href="<?= base_url('welcome') ?>" type="button" class="btn btn-default btn-xs heading-btn"><i
                                    class="icon-file-check position-left"></i> Back Home</a>
                        <button onclick="printpage()" type="button" class="btn btn-default btn-xs heading-btn"><i
                                    class="icon-printer position-left"></i> Print
                        </button>
                    </div>
                </div>
                <div id="printablearea">
                    <div class="container">

                        <div class="panel-body no-padding-bottom">
                            <div class="row">
                                <div class="col-sm-6 content-group">
                                    <img src="<?= base_url() ?>assets/global_assets/images/logo_demo.png"
                                         class="content-group mt-10" alt="" style="width: 120px;">
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
                                        <li><h5>Total Due: <span class="text-right text-semibold">$8,750</span></h5>
                                        </li>
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
                                </tbody>
                            </table>
                        </div>

                        <div class="panel-body">
                            <div class="row invoice-payment">
                                <div class="col-sm-7">
                                    &nbsp;
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
                                                    <td class="text-right text-primary"><h5 class="text-semibold">
                                                            $8,750</h5></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /invoice template -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->


<!-- Footer -->
<div class="footer text-muted">
    &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene
        Kopyov</a>
</div>
<!-- /footer -->
<script>
    function printpage() {
        $('#printablearea').printThis();
    }
</script>
</body>

</html>
