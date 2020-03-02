
<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>404 | Swift &amp; Easy Bookings Bookings</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="robots" content="index, follow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <!--=============== css  ===============-->
    <!--    <link type="text/css" rel="stylesheet" href="--><? //= site_url()?><!--assets/css/bootstrap.min.css">-->
    <link href="<?= site_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <!--    <link rel="stylesheet" href="--><? //= site_url()?><!--assets/editor/summernote-bs4.css">-->
    <link type="text/css" rel="stylesheet" href="<?= site_url() ?>assets/css/reset.css">
    <link type="text/css" rel="stylesheet" href="<?= site_url() ?>assets/css/plugins.css">
    <link type="text/css" rel="stylesheet" href="<?= site_url() ?>assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="<?= site_url() ?>assets/css/color.css">

    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="<?= site_url() ?>assets/images/favicon.ico">
</head>
<body>
<!--loader-->
<div class="loader-wrap">
    <div class="pin">
        <div class="pulse"></div>
    </div>
</div>
<div id="main">
    <!-- header-->
    <?php $this->load->view('partials/navbar') ?> <!--  header end -->
    <!--  wrapper  -->
    <div id="wrapper">
        <!-- content-->
        <div class="content">
            <!--  section  -->
            <section class="color-bg parallax-section">
                <div class="city-bg"></div>
                <div class="cloud-anim cloud-anim-bottom x1"><i class="fal fa-cloud"></i></div>
                <div class="cloud-anim cloud-anim-top x2"><i class="fal fa-cloud"></i></div>
                <div class="overlay op1 color3-bg"></div>
                <div class="container">
                    <div class="error-wrap">
                        <h2>404</h2>
                        <p>We're sorry, but the Page you were looking for, couldn't be found.</p>
                        <div class="clearfix"></div>
                        <form action="<??>">
                            <input name="se" id="se" type="text" class="search" placeholder="Search.." value="">
                            <button class="search-submit color-bg" id="submit_btn"><i class="fal fa-search"></i> </button>
                        </form>
                        <div class="clearfix"></div>
                        <p>Or</p>
                        <a href="index.html" class="btn     color2-bg flat-btn">Back to Home Page<i class="fal fa-home"></i></a>
                    </div>
                </div>
            </section>
            <!--  section  end-->
        </div>
        <!-- content end-->
    </div>
    <!--wrapper end -->
    <?php $this->load->view('partials/footer') ?>

</div>
<!-- Main end -->
<!-- Main end -->
<!--=============== scripts  ===============-->
<script type="text/javascript" src="<?= site_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= site_url()?>assets/js/plugins.js"></script>
<script type="text/javascript" src="<?= site_url()?>assets/js/scripts.js"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmr9UKukNecSkB_1S0w0c_F8FnJPILw_U&libraries=places"></script>
<script type="text/javascript" src="<?= site_url()?>assets/js/map-single.js"></script>
<script type="text/javascript" src="<?= site_url()?>assets/js/sweetalert2.all.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>-->
</body>

</html>