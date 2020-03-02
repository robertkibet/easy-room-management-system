<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll">
            <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <?php $mydata = $this->session->all_userdata()?>
                        <div class="profile-usertitle">
                            <div class="sidebar-userpic-name"><?= ucwords($mydata['firstname']).' '.ucwords($mydata['lastname'])?></div>
                            <div class="profile-usertitle-job"> Manager </div>
                        </div>
                        <div class="sidebar-userpic-btn">
                            <a class="tooltips" href="user_profile.html" data-placement="top" data-original-title="Profile">
                                <i class="material-icons">person_outline</i>
                            </a>
                            <a class="tooltips" href="email_inbox.html" data-placement="top" data-original-title="Mail">
                                <i class="material-icons">mail_outline</i>
                            </a>
                            <a class="tooltips" href="chat.html" data-placement="top" data-original-title="Chat">
                                <i class="material-icons">chat</i>
                            </a>
                            <a class="tooltips" href="login.html" data-placement="top" data-original-title="Logout">
                                <i class="material-icons">input</i>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="menu-heading">
                    <span>-- Main</span>
                </li>
                <li class="nav-item start active">
                    <a href="<?= base_url('welcome')?>" class="nav-link nav-toggle">
                        <i class="material-icons">dashboard</i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start ">
                    <a href="<?= base_url('welcome/bookings/make_booking')?>" class="nav-link nav-toggle">
                        <i class="material-icons">check</i>
                        <span class="title">Bookings</span>
                        <span class=""></span>
                    </a>
                </li>
                <li class="nav-item start ">
                    <a href="<?= base_url('welcome/rooms/manage_rooms')?>" class="nav-link nav-toggle">
                        <i class="material-icons">vpn_key</i>
                        <span class="title">Rooms</span>
                        <span class=""></span>
                    </a>
                </li>
                <li class="nav-item start ">
                    <a href="<?= base_url('welcome/rooms/room_types')?>" class="nav-link nav-toggle">
                        <i class="material-icons">vpn_key</i>
                        <span class="title">Room Types</span>
                        <span class=""></span>
                    </a>
                </li>
                <li class="nav-item start ">
                    <a href="<?= base_url('welcome/estates/manage_estates')?>" class="nav-link nav-toggle">
                        <i class="material-icons">vpn_key</i>
                        <span class="title">Estates</span>
                        <span class=""></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link nav-toggle">
                        <i class="material-icons">reorder</i>
                        <span class="title">Reports</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="<?= site_url('welcome/estates/manage_estates')?>" class="nav-link ">
                                <span class="title">Bookings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('welcome/estates/report')?>" class="nav-link ">
                                <span class="title">Rooms</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('welcome/estates/report')?>" class="nav-link ">
                                <span class="title">Estates</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('welcome/staff/manage_staff')?>" class="nav-link nav-toggle">
                        <i class="material-icons">group</i>
                        <span class="title">Staffs</span>
                        <span class=""></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
