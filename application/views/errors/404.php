
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page not Found</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?= base_url()?>assets/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url()?>assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url()?>assets/assets/css/core.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url()?>assets/assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url()?>assets/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="<?= base_url()?>assets/global_assets/js/plugins/loaders/pace.min.js"></script>
    <script src="<?= base_url()?>assets/global_assets/js/core/libraries/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/global_assets/js/core/libraries/bootstrap.min.js"></script>
    <script src="<?= base_url()?>assets/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="<?= base_url()?>assets/global_assets/js/plugins/ui/nicescroll.min.js"></script>
    <script src="<?= base_url()?>assets/global_assets/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->
    <script src="<?= base_url()?>assets/assets/js/app.js"></script>
    <!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
<?php $this->load->view('partials/navbar') ?>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Error title -->
            <div class="text-center content-group">
                <h1 class="error-title">404</h1>
                <h5>Oops, an error has occurred. Page not found!</h5>
                <p>If you are seeing this wrognly, Contact Admin</p>
            </div>
            <!-- /error title -->


            <!-- Error content -->
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                    <form action="#" class="main-search">

                        <center class="row">
                            <center >
                                <a href="<?= base_url('welcome')?>" class="btn btn-primary content-group"><i class="icon-circle-left2 position-left"></i> Go to dashboard</a>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /error wrapper -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->


</body>

</html>
