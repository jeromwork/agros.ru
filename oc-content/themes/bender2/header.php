<?php
/*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">

<head>
    <?php osc_current_web_theme_path('common/head.php'); ?>
</head>

<body>
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <?php if (osc_users_enabled()) { ?>
        <?php if (!osc_is_web_user_logged_in()) { ?>

    <!-- Modal -->
        <div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="modal_loginLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_loginLabel">Вход через мобильный номер</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="phoneNC">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="tel" class="form-control" name="integer" id="phoneNumber" placeholder="+79991112233">
                                    <span class="messages hide" id="phoneNumberErr"><p class="text-danger error">Неправильный формат номера телефона (пример +79991115522)</p></span>
                                </div>
                            </div>
                            <div id="recaptcha-container"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="sign-in-button" class="btn btn-primary">Получить код</button>
                        </div>
                    </div>
                    <div style="display: none;" id="codeNc">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="number" id="phone_code" class="form-control" placeholder="код из СМС" />
                                    <span class="messages hide" id="phone_code_err"><p class="text-danger error">Неправильный код из смс. Проверьте СМС еще раз</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="confirm-code" class="btn btn-primary">Вход</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="success_modal_login" tabindex="-1" role="dialog" aria-labelledby="success_modal_loginLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="success_modal_loginLabel">Добро пожаловать!</h5>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php } ?>

    <div class="modal-backdrop hide"></div>



    <div id="pcoded" class="pcoded" vertical-nav-type="offcanvas">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="/">
                            <img class="img-fluid" src="<?php echo osc_current_web_theme_url('images/logo.png'); ?>" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">

                            <?php if (osc_users_enabled()) { ?>
                                <?php if (osc_is_web_user_logged_in()) { ?>

                                    <li class="header-notification">
                                        <div class="dropdown-primary dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="feather icon-bell"></i>
                                                <span class="badge bg-c-pink">5</span>
                                            </div>
                                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <li>
                                                    <h6>Notifications</h6>
                                                    <label class="label label-danger">New</label>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <img class="d-flex align-self-center img-radius" src="<?php echo osc_current_web_theme_url('images/avatar-4.jpg'); ?>" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="notification-user">John Doe</h5>
                                                            <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                                elit.</p>
                                                            <span class="notification-time">30 minutes ago</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <img class="d-flex align-self-center img-radius" src="<?php echo osc_current_web_theme_url('images/avatar-3.jpg'); ?>" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="notification-user">Joseph William</h5>
                                                            <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                                elit.</p>
                                                            <span class="notification-time">30 minutes ago</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <img class="d-flex align-self-center img-radius" src="<?php echo osc_current_web_theme_url('images/avatar-4.jpg'); ?>" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="notification-user">Sara Soudein</h5>
                                                            <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                                elit.</p>
                                                            <span class="notification-time">30 minutes ago</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="header-notification">
                                        <div class="dropdown-primary dropdown">
                                            <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                                <i class="feather icon-message-square"></i>
                                                <span class="badge bg-c-green">3</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="user-profile header-notification">
                                        <div class="dropdown-primary dropdown">
                                            
                                            <div class="dropdown-toggle" data-toggle="dropdown">
                                                <img src="<?php echo osc_current_web_theme_url('images/avatar-4.jpg'); ?>" class="img-radius" alt="User-Profile-Image">
                                                <span><?php echo  osc_logged_user_name(); ?></span>
                                                <i class="feather icon-chevron-down"></i>
                                            </div>
                                            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <li>
                                                    <a href="<?php echo osc_user_dashboard_url(); ?>">
                                                        <i class="feather icon-user"></i> Profile
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="email-inbox.htm">
                                                        <i class="feather icon-mail"></i> My Messages
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo osc_user_logout_url(); ?>">
                                                        <i class="feather icon-log-out"></i> Logout
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                    </li>
                                    <?php if (!osc_reg_user_post()) { ?>
                                <li class="publish"><a href="<?php echo osc_item_post_url_in_category(); ?>" ><i class="feather icon-plus"></i></a></li>
                            <?php } ?>
                                <?php } else { ?>
                                    
                                    <li class="publish"><a href="" data-toggle="modal" data-target="#modal_login"><i class="feather icon-user"></i>   Вход</a></li>
                                    <?php if (!osc_reg_user_post()) { ?>
                                <li class="publish"><a href="" data-toggle="modal" data-target="#modal_login"><i class="feather icon-plus"></i></a></li>
                            <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </nav>
            <?php if (osc_users_enabled()) { ?>
                                <?php if (osc_is_web_user_logged_in()) { ?>
            <div id="recaptcha-container"></div>
            <?php } ?><?php } ?>
            <!-- Sidebar chat start -->
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="card card_main p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-inner-header">
                                <div class="back_chatBox">
                                    <div class="right-icon-control">
                                        <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                        <div class="form-icon">
                                            <i class="icofont icofont-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-friend-list">
                                <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius img-radius" src="/oc-content/themes/bender2/images/avatar-3.jpg" alt="Generic placeholder image ">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Josephin Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="/oc-content/themes/bender2/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Lary Doe</div>
                                    </div>
                                </div>

                                <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="/oc-content/themes/bender2/images/avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Suzen</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat start-->
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="/oc-content/themes/bender2/images/avatar-3.jpg" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="/oc-content/themes/bender2/images/avatar-4.jpg" alt="Generic placeholder image">
                        </a>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="feather icon-navigation"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat end-->


            <div class="pcoded-main-container">

                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu active pcoded-trigger">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="active">
                                            <a href="index-1.htm">
                                                <span class="pcoded-mtext">Default</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="dashboard-crm.htm">
                                                <span class="pcoded-mtext">CRM</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="dashboard-analytics.htm">
                                                <span class="pcoded-mtext">Analytics</span>
                                                <span class="pcoded-badge label label-info ">NEW</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                                        <span class="pcoded-mtext">Page layouts</span>
                                        <span class="pcoded-badge label label-warning">NEW</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-mtext">Vertical</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class=" ">
                                                    <a href="menu-static.htm">
                                                        <span class="pcoded-mtext">Static Layout</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="menu-header-fixed.htm">
                                                        <span class="pcoded-mtext">Header Fixed</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="menu-compact.htm">
                                                        <span class="pcoded-mtext">Compact</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="menu-sidebar.htm">
                                                        <span class="pcoded-mtext">Sidebar Fixed</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li class=" pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-mtext">Horizontal</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class=" ">
                                                    <a href="menu-horizontal-static.htm" target="_blank">
                                                        <span class="pcoded-mtext">Static Layout</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="menu-horizontal-fixed.htm" target="_blank">
                                                        <span class="pcoded-mtext">Fixed layout</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="menu-horizontal-icon.htm" target="_blank">
                                                        <span class="pcoded-mtext">Static With Icon</span>
                                                    </a>
                                                </li>
                                                <li class=" ">
                                                    <a href="menu-horizontal-icon-fixed.htm" target="_blank">
                                                        <span class="pcoded-mtext">Fixed With Icon</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class=" ">
                                            <a href="menu-bottom.htm">
                                                <span class="pcoded-mtext">Bottom Menu</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="box-layout.htm" target="_blank">
                                                <span class="pcoded-mtext">Box Layout</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="menu-rtl.htm" target="_blank">
                                                <span class="pcoded-mtext">RTL</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a href="navbar-light.htm">
                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                        <span class="pcoded-mtext">Navigation</span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                                        <span class="pcoded-mtext">Widget</span>
                                        <span class="pcoded-badge label label-danger">100+</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="widget-statistic.htm">
                                                <span class="pcoded-mtext">Statistic</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="widget-data.htm">
                                                <span class="pcoded-mtext">Data</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="widget-chart.htm">
                                                <span class="pcoded-mtext">Chart Widget</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                            <div class="pcoded-navigatio-lavel">UI Element</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                                        <span class="pcoded-mtext">Basic Components</span>
                                    </a>
                                    <ul class="pcoded-submenu">

                                        <li class=" ">
                                            <a href="list.htm">
                                                <span class="pcoded-mtext">List</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="tooltip.htm">
                                                <span class="pcoded-mtext">Tooltip And Popover</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="typography.htm">
                                                <span class="pcoded-mtext">Typography</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="other.htm">
                                                <span class="pcoded-mtext">Other</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-gitlab"></i></span>
                                        <span class="pcoded-mtext">Advance Components</span>
                                    </a>
                                    <ul class="pcoded-submenu">

                                        <li class=" ">
                                            <a href="nestable.htm">
                                                <span class="pcoded-mtext">Nestable</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="toolbar.htm">
                                                <span class="pcoded-mtext">Toolbar</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="x-editable.htm">
                                                <span class="pcoded-mtext">X-Editable</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-package"></i></span>
                                        <span class="pcoded-mtext">Extra Components</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="session-timeout.htm">
                                                <span class="pcoded-mtext">Session Timeout</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="session-idle-timeout.htm">
                                                <span class="pcoded-mtext">Session Idle Timeout</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="offline.htm">
                                                <span class="pcoded-mtext">Offline</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class=" ">
                                    <a href="animation.htm">
                                        <span class="pcoded-micon"><i class="feather icon-aperture rotate-refresh"></i><b>A</b></span>
                                        <span class="pcoded-mtext">Animations</span>
                                    </a>
                                </li>
                                <li class=" ">
                                    <a href="sticky.htm">
                                        <span class="pcoded-micon"><i class="feather icon-cpu"></i></span>
                                        <span class="pcoded-mtext">Sticky Notes</span>
                                        <span class="pcoded-badge label label-danger">HOT</span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-command"></i></span>
                                        <span class="pcoded-mtext">Icons</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="icon-font-awesome.htm">
                                                <span class="pcoded-mtext">Font Awesome</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="icon-themify.htm">
                                                <span class="pcoded-mtext">Themify</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="icon-simple-line.htm">
                                                <span class="pcoded-mtext">Simple Line Icon</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="icon-ion.htm">
                                                <span class="pcoded-mtext">Ion Icon</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="icon-material-design.htm">
                                                <span class="pcoded-mtext">Material Design</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="icon-icofonts.htm">
                                                <span class="pcoded-mtext">Ico Fonts</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="icon-weather.htm">
                                                <span class="pcoded-mtext">Weather Icon</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="icon-typicons.htm">
                                                <span class="pcoded-mtext">Typicons</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="icon-flags.htm">
                                                <span class="pcoded-mtext">Flags</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </nav>
                    <div class="pcoded-content">





                        <?php osc_show_widgets('header'); ?>
                        <div class="wrapper wrapper-flash">
                            <?php
                            $breadcrumb = osc_breadcrumb('&raquo;', false, get_breadcrumb_lang());
                            if ($breadcrumb !== '') { ?>
                                <div class="breadcrumb">
                                    <?php echo $breadcrumb; ?>
                                    <div class="clear"></div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php osc_show_flash_message(); ?>
                        </div>
                        <?php osc_run_hook('before-content'); ?>
                        <div class="wrapper" id="content">
                            <?php osc_run_hook('before-main'); ?>
                            <div id="main">

                           