<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Golan Accomodations</title>
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
    <script src="<?= base_url() ?>assets/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>


    <!-- Theme JS files -->
    <script src="<?= base_url() ?>assets/assets/js/app.js"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href=""><img src="<?= base_url() ?>assets/global_assets/images/logo_light.png"
                                                       alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Simple login form -->
            <form action="#">
                <div class="panel panel-body login-form">
                    <div class="text-center">
                        <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                        <h5 class="content-group"><?= $this->config->item('owner');?>
                            <small class="display-block">Enter your credentials below</small>
                        </h5>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="text" class="form-control" id="userPhone" placeholder="Username">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <input type="password" class="form-control" id="userPassword" placeholder="Password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <a id="loginButton" type="button" class="btn btn-primary btn-block">Sign in <i
                                    class="icon-circle-right2 position-right"></i></a>
                    </div>

                </div>
            </form>
            <!-- /simple login form -->

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
    $(document).ready(function () {

        // $('#loginButton').on('click', function (e) {
        //     e.preventDefault();
        //     Swal.fire({
        //         title:'SYSTEM OFFLINE',
        //         type:'info',
        //         html:'Kindly check back in 2hrs, System undergoing maintenance.<br> It will be back online exactly 2300hrs',
        //         confirmButtonText: 'OK'
        //     })
        // })
        $('#loginButton').on('click', function (e) {
            e.preventDefault();
            let phone = $('#userPhone').val();
            let password = $('#userPassword').val();


            if (phone.length < 10) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Valid Phone Number is required',
                    type: 'error',
                    confirmButtonText: 'OK'
                })
            } else if (password.length < 1) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Valid Password is required',
                    type: 'error',
                    confirmButtonText: 'OK'
                })
            } else {
                $.ajax({
                    url: "login/user",
                    type: "POST",
                    data: {
                        phone: phone,
                        password: password
                    },
                    dataType: "text",
                    success: function (results) {
                        var data = JSON.parse(results);
                        // var data = results;
                        // console.log(data);
                        if (data === 3 || data === 2) {
                            Swal.fire({
                                title: 'Failed',
                                type: 'error',
                                text: 'Invalid Credentials. Contact Admin if this was not expected',
                                confirmButtonText:
                                    'OK',

                            })
                            document.getElementById('loginButton').innerHTML = 'Try Again';

                        } else {

                            document.getElementById('loginButton').innerHTML = '<i class="fa fa-spinner fa-spin"></i> please wait...';
                            document.getElementById('loginButton').disabled = true;
                            Swal.fire({
                                title: 'Hello',
                                type: 'success',
                                text: 'Account authenticated.',
                                confirmButtonText:
                                    'Proceed <i class="fa fa-home></i>',

                            }).then(function () {
                                window.location = data;
                            })
                        }


                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            title: 'Failed',
                            type: 'error',
                            text: ' Something went wrong. Try again or contact us',
                            confirmButtonText:
                                'OK',

                        })
                    }
                });
            }

        });

        // function isEmail(email) {
        //     var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        //     return regex.test(email);
        // }
    });
    </script>
    </body>

    </html>