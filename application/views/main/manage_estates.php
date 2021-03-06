
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>Dashboard</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="<?= base_url()?>assets/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!--bootstrap -->
    <link href="<?= base_url()?>assets/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/assets/plugins/summernote/summernote.css" rel="stylesheet">
    <!-- morris chart -->
    <link href="<?= base_url()?>assets/assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="<?= base_url()?>assets/assets/plugins/material/material.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/assets/css/material_style.css">
    <!-- animation -->
    <link href="<?= base_url()?>assets/assets/css/pages/animate_page.css" rel="stylesheet">
    <!-- Template Styles -->
    <link href="<?= base_url()?>assets/assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/assets/css/theme-color.css" rel="stylesheet" type="text/css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url()?>assets/assets/img/favicon.ico" />
</head>
<!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
<div class="page-wrapper">
    <!-- start header -->
    <!-- end header -->
    <?php $this->load->view('partials/navbar')?>
    <!-- start page container -->
    <div class="page-container">
        <!-- start sidebar menu -->
        <?php $this->load->view('partials/sidebar')?>
        <!-- end sidebar menu -->
        <!-- start page content -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title">Dashboard</div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- start widget -->
                <div class="state-overview">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="info-box bg-blue">
                                <span class="info-box-icon push-bottom"><i class="material-icons">style</i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Today</span>
                                    <span class="info-box-number">450</span>
                                    <div class="progress">
                                        <div class="progress-bar width-60"></div>
                                    </div>
                                    <span class="progress-description">
					                    Bookings
					                  </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="info-box bg-orange">
                                <span class="info-box-icon push-bottom"><i class="material-icons">card_travel</i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Bookings</span>
                                    <span class="info-box-number">155</span>
                                    <div class="progress">
                                        <div class="progress-bar width-40"></div>
                                    </div>
                                    <span class="progress-description">
					                    40% Increase in 28 Days
					                  </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="info-box bg-purple">
                                <span class="info-box-icon push-bottom"><i class="material-icons">phone_in_talk</i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Income</span>
                                    <span class="info-box-number">58000</span>
                                    <div class="progress">
                                        <div class="progress-bar width-80"></div>
                                    </div>
                                    <span class="progress-description">
					                    Today: 6500
					                  </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="info-box bg-success">
                                <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Rooms</span>
                                    <span class="info-box-number">13,921</span><span>$</span>
                                    <div class="progress">
                                        <div class="progress-bar width-60"></div>
                                    </div>
                                    <span class="progress-description">
					                    23 Estates
					                  </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- end widget -->
                <!-- chart start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-box">
                            <div class="card-head">
                                <header>Chart Survey</header>
                                <div class="tools">
                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                </div>
                            </div>
                            <div class="card-body no-padding height-9">
                                <div class="row text-center">
                                    <div class="col-sm-3 col-6">
                                        <h4 class="margin-0">$ 209 </h4>
                                        <p class="text-muted"> Today's Income</p>
                                    </div>
                                    <div class="col-sm-3 col-6">
                                        <h4 class="margin-0">$ 837 </h4>
                                        <p class="text-muted">This Week's Income</p>
                                    </div>
                                    <div class="col-sm-3 col-6">
                                        <h4 class="margin-0">$ 3410 </h4>
                                        <p class="text-muted">This Month's Income</p>
                                    </div>
                                    <div class="col-sm-3 col-6">
                                        <h4 class="margin-0">$ 78,000 </h4>
                                        <p class="text-muted">This Year's Income</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="area_line_chart" class="width-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Chart end -->
                <!-- start Payment Details -->
                <!-- end Payment Details -->
            </div>
        </div>
        <!-- end page content -->
        <!-- start chat sidebar -->
        <div class="chat-sidebar-container" data-close-on-body-click="false">
            <div class="chat-sidebar">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon"  data-toggle="tab">Theme
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#quick_sidebar_tab_2" class="nav-link tab-icon"  data-toggle="tab"> Chat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#quick_sidebar_tab_3" class="nav-link tab-icon"  data-toggle="tab">  Settings
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane chat-sidebar-settings in show active animated shake" role="tabpanel" id="quick_sidebar_tab_1">
                        <div class="slimscroll-style">
                            <div class="theme-light-dark">
                                <h6>Sidebar Theme</h6>
                                <button type="button" data-theme="white" class="btn lightColor btn-outline btn-circle m-b-10 theme-button">Light Sidebar</button>
                                <button type="button" data-theme="dark" class="btn dark btn-outline btn-circle m-b-10 theme-button">Dark Sidebar</button>
                            </div>
                            <div class="theme-light-dark">
                                <h6>Sidebar Color</h6>
                                <ul class="list-unstyled">
                                    <li class="complete">
                                        <div class="theme-color sidebar-theme">
                                            <a href="#" data-theme="white"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="blue"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="indigo"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="cyan"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="green"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="red"><span class="head"></span><span class="cont"></span></a>
                                        </div>
                                    </li>
                                </ul>
                                <h6>Header Brand color</h6>
                                <ul class="list-unstyled">
                                    <li class="theme-option">
                                        <div class="theme-color logo-theme">
                                            <a href="#" data-theme="logo-white"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-dark"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-blue"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-indigo"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-cyan"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-green"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-red"><span class="head"></span><span class="cont"></span></a>
                                        </div>
                                    </li>
                                </ul>
                                <h6>Header color</h6>
                                <ul class="list-unstyled">
                                    <li class="theme-option">
                                        <div class="theme-color header-theme">
                                            <a href="#" data-theme="header-white"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-dark"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-blue"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-indigo"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-cyan"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-green"><span class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-red"><span class="head"></span><span class="cont"></span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Start Doctor Chat -->
                    <div class="tab-pane chat-sidebar-chat animated slideInRight" id="quick_sidebar_tab_2">
                        <div class="chat-sidebar-list">
                            <div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd" data-wrapper-class="chat-sidebar-list">
                                <div class="chat-header"><h5 class="list-heading">Online</h5></div>
                                <ul class="media-list list-items">
                                    <li class="media"><img class="media-object" src="<?= base_url()?>assets/assets/img/user/user3.jpg" width="35" height="35" alt="...">
                                        <i class="online dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">John Deo</h5>
                                            <div class="media-heading-sub">Spine Surgeon</div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-success">5</span>
                                        </div> <img class="media-object" src="<?= base_url()?>assets/assets/img/user/user1.jpg" width="35" height="35" alt="...">
                                        <i class="busy dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Rajesh</h5>
                                            <div class="media-heading-sub">Director</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="<?= base_url()?>assets/assets/img/user/user5.jpg" width="35" height="35" alt="...">
                                        <i class="away dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Jacob Ryan</h5>
                                            <div class="media-heading-sub">Ortho Surgeon</div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-danger">8</span>
                                        </div> <img class="media-object" src="<?= base_url()?>assets/assets/img/user/user4.jpg" width="35" height="35" alt="...">
                                        <i class="online dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Kehn Anderson</h5>
                                            <div class="media-heading-sub">CEO</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="<?= base_url()?>assets/assets/img/user/user2.jpg" width="35" height="35" alt="...">
                                        <i class="busy dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Sarah Smith</h5>
                                            <div class="media-heading-sub">Anaesthetics</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="<?= base_url()?>assets/assets/img/user/user7.jpg" width="35" height="35" alt="...">
                                        <i class="online dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Vlad Cardella</h5>
                                            <div class="media-heading-sub">Cardiologist</div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="chat-header"><h5 class="list-heading">Offline</h5></div>
                                <ul class="media-list list-items">
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-warning">4</span>
                                        </div> <img class="media-object" src="<?= base_url()?>assets/assets/img/user/user6.jpg" width="35" height="35" alt="...">
                                        <i class="offline dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Jennifer Maklen</h5>
                                            <div class="media-heading-sub">Nurse</div>
                                            <div class="media-heading-small">Last seen 01:20 AM</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="<?= base_url()?>assets/assets/img/user/user8.jpg" width="35" height="35" alt="...">
                                        <i class="offline dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Lina Smith</h5>
                                            <div class="media-heading-sub">Ortho Surgeon</div>
                                            <div class="media-heading-small">Last seen 11:14 PM</div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-success">9</span>
                                        </div> <img class="media-object" src="<?= base_url()?>assets/assets/img/user/user9.jpg" width="35" height="35" alt="...">
                                        <i class="offline dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Jeff Adam</h5>
                                            <div class="media-heading-sub">Compounder</div>
                                            <div class="media-heading-small">Last seen 3:31 PM</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="<?= base_url()?>assets/assets/img/user/user10.jpg" width="35" height="35" alt="...">
                                        <i class="offline dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Anjelina Cardella</h5>
                                            <div class="media-heading-sub">Physiotherapist</div>
                                            <div class="media-heading-small">Last seen 7:45 PM</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="chat-sidebar-item">
                            <div class="chat-sidebar-chat-user">
                                <div class="page-quick-sidemenu">
                                    <a href="javascript:;" class="chat-sidebar-back-to-list">
                                        <i class="fa fa-angle-double-left"></i>Back
                                    </a>
                                </div>
                                <div class="chat-sidebar-chat-user-messages">
                                    <div class="post out">
                                        <img class="avatar" alt="" src="<?= base_url()?>assets/assets/img/dp.jpg" />
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:10</span>
                                            <span class="body-out"> could you send me menu icons ? </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt="" src="<?= base_url()?>assets/assets/img/user/user5.jpg" />
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:10</span>
                                            <span class="body"> please give me 10 minutes. </span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt="" src="<?= base_url()?>assets/assets/img/dp.jpg" />
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:11</span>
                                            <span class="body-out"> ok fine :) </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt="" src="<?= base_url()?>assets/assets/img/user/user5.jpg" />
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:22</span>
                                            <span class="body">Sorry for
													the delay. i sent mail to you. let me know if it is ok or not.</span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt="" src="<?= base_url()?>assets/assets/img/dp.jpg" />
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:26</span>
                                            <span class="body-out"> it is perfect! :) </span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt="" src="<?= base_url()?>assets/assets/img/dp.jpg" />
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Kiran Patel</a> <span class="datetime">9:26</span>
                                            <span class="body-out"> Great! Thanks. </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt="" src="<?= base_url()?>assets/assets/img/user/user5.jpg" />
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Jacob Ryan</a> <span class="datetime">9:27</span>
                                            <span class="body"> it is my pleasure :) </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-sidebar-chat-user-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Type a message here...">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn deepPink-bgcolor">
                                                <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Doctor Chat -->
                    <!-- Start Setting Panel -->
                    <div class="tab-pane chat-sidebar-settings animated slideInUp" id="quick_sidebar_tab_3">
                        <div class="chat-sidebar-settings-list slimscroll-style">
                            <div class="chat-header"><h5 class="list-heading">Layout Settings</h5></div>
                            <div class="chatpane inner-content ">
                                <div class="settings-list">
                                    <div class="setting-item">
                                        <div class="setting-text">Sidebar Position</div>
                                        <div class="setting-set">
                                            <select class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                                <option value="left" selected="selected">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Header</div>
                                        <div class="setting-set">
                                            <select class="page-header-option form-control input-inline input-sm input-small ">
                                                <option value="fixed" selected="selected">Fixed</option>
                                                <option value="default">Default</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Sidebar Menu </div>
                                        <div class="setting-set">
                                            <select class="sidebar-menu-option form-control input-inline input-sm input-small ">
                                                <option value="accordion" selected="selected">Accordion</option>
                                                <option value="hover">Hover</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Footer</div>
                                        <div class="setting-set">
                                            <select class="page-footer-option form-control input-inline input-sm input-small ">
                                                <option value="fixed">Fixed</option>
                                                <option value="default" selected="selected">Default</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-header"><h5 class="list-heading">Account Settings</h5></div>
                                <div class="settings-list">
                                    <div class="setting-item">
                                        <div class="setting-text">Notifications</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for = "switch-1">
                                                    <input type = "checkbox" id = "switch-1"
                                                           class = "mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Show Online</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for = "switch-7">
                                                    <input type = "checkbox" id = "switch-7"
                                                           class = "mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Status</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for = "switch-2">
                                                    <input type = "checkbox" id = "switch-2"
                                                           class = "mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">2 Steps Verification</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for = "switch-3">
                                                    <input type = "checkbox" id = "switch-3"
                                                           class = "mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-header"><h5 class="list-heading">General Settings</h5></div>
                                <div class="settings-list">
                                    <div class="setting-item">
                                        <div class="setting-text">Location</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for = "switch-4">
                                                    <input type = "checkbox" id = "switch-4"
                                                           class = "mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Save Histry</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for = "switch-5">
                                                    <input type = "checkbox" id = "switch-5"
                                                           class = "mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Auto Updates</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class = "mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for = "switch-6">
                                                    <input type = "checkbox" id = "switch-6"
                                                           class = "mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end chat sidebar -->
    </div>
    <!-- end page container -->
    <!-- start footer -->
    <div class="page-footer">
        <div class="page-footer-inner"> 2018 &copy; Spice Hotel Template By
            <a href="mailto:redstartheme@gmail.com" target="_top" class="makerCss">RedStar Theme</a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- end footer -->
</div>
<!-- start js include path -->
<script src="<?= base_url()?>assets/assets/plugins/jquery/jquery.min.js" ></script>
<script src="<?= base_url()?>assets/assets/plugins/popper/popper.min.js" ></script>
<script src="<?= base_url()?>assets/assets/plugins/jquery-blockui/jquery.blockui.min.js" ></script>
<script src="<?= base_url()?>assets/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- bootstrap -->
<script src="<?= base_url()?>assets/assets/plugins/bootstrap/js/bootstrap.min.js" ></script>
<script src="<?= base_url()?>assets/assets/plugins/sparkline/jquery.sparkline.min.js" ></script>
<script src="<?= base_url()?>assets/assets/js/pages/sparkline/sparkline-data.js" ></script>
<!-- Common js-->
<script src="<?= base_url()?>assets/assets/js/app.js" ></script>
<script src="<?= base_url()?>assets/assets/js/layout.js" ></script>
<script src="<?= base_url()?>assets/assets/js/theme-color.js" ></script>
<!-- material -->
<script src="<?= base_url()?>assets/assets/plugins/material/material.min.js"></script>
<!-- animation -->
<script src="<?= base_url()?>assets/assets/js/pages/ui/animations.js" ></script>
<!-- morris chart -->
<script src="<?= base_url()?>assets/assets/plugins/morris/morris.min.js" ></script>
<script src="<?= base_url()?>assets/assets/plugins/morris/raphael-min.js" ></script>
<script src="<?= base_url()?>assets/assets/js/pages/chart/morris/morris_home_data.js" ></script>
<!-- end js include path -->
</body>

</html>