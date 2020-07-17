<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/

if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
?>
<header class="wm-topbar">
    <div class="container">
      <div class="row">
        <!-- social icon-->
        <div class="col-sm-12">
            <p>Plugin by <a href="//wmods.zagorski-oglasnik.com" target="_blank">WEBmods</a> | Published on <a href="//loveosclass.com">LoveOsclass</a> | <a href="//osclasscommunity.com">Osclass Community</a></p>
        </div>
      </div>
    </div>
</header>
<nav class="wm-navbar navbar navbar-expand-md navbar-dark wm-background">
    <div class="container">
        <a class="navbar-brand" href="index.html" style="text-transform: uppercase;"><?php _e('User Custom Fields', usercf_plugin()); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php if(usercf_is_route('usercf-field-list')) { echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo osc_route_admin_url('usercf-field-list'); ?>"><?php _e('Fields', usercf_plugin()); ?></a>
                </li>
                <li class="nav-item <?php if(usercf_is_route('usercf-field-add')) { echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo osc_route_admin_url('usercf-field-add'); ?>"><?php _e('Add a field', usercf_plugin()); ?></a>
                </li>
                <li class="nav-item <?php if(usercf_is_route('usercf-help')) { echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo osc_route_admin_url('usercf-help'); ?>"><?php _e('Help', usercf_plugin()); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="//osclasscommunity.com" target="_blank"><?php _e('Osclass Community', usercf_plugin()); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="//wmods.zagorski-oglasnik.com" target="_blank"><?php _e('WEBmods', usercf_plugin()); ?></a>
                </li>
          </ul>
      </div>
    </div>
</nav>
