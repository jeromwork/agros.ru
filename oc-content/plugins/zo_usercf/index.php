<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/

/*
Plugin Name: User Custom Fields
Plugin URI: https://www.zagorski-oglasnik.com/
Description: You can create custom fields for users and show them on register and dashboard forms. 8 field types supported, including checkbox groups.
Version: 1.1.1
Author: WEBmods by Zagorski Oglasnik jdoo
Author URI: https://www.zagorski-oglasnik.com/
Plugin update URI: http://loveosclass.com/update/usercf/free
*/

define('USERCF_PATH', dirname(__FILE__) . '/' );
define('USERCF_FOLDER', osc_plugin_folder(__FILE__) . '/' );
define('USERCF_VERSION', 1110);

require_once USERCF_PATH.'oc-load.php';

function usercf_install() {
    UserCfModel::newInstance()->install();
    osc_set_preference('version', USERCF_VERSION, 'plugin_usercf');
}
osc_register_plugin(osc_plugin_path(__FILE__), 'usercf_install');

function usercf_uninstall() {
    UserCfModel::newInstance()->uninstall();
    Preference::newInstance()->delete(array('s_section' => 'plugin_usercf'));
}
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'usercf_uninstall');

function usercf_check_update() {
    if(file_exists(USERCF_PATH.'needs_update.php')) {
        $current_version = osc_get_preference('version', 'plugin_usercf');
        if(!$current_version || version_compare(USERCF_VERSION, $current_version)) {
            usercf_update($current_version);
        }

        unlink(USERCF_PATH.'needs_update.php');
    }
}

function usercf_update($current_version) {
    osc_set_preference('version', USERCF_VERSION, 'plugin_usercf');
    osc_set_preference('marketAllowExternalSources', '1', 'osclass', 'BOOLEAN');

    if(version_compare($current_version, 1100)) {
        UserCfModel::newInstance()->updatePlugin(1100);
    }

    if(version_compare($current_version, 1110)) {
        UserCfModel::newInstance()->updatePlugin(1110);
    }
}

usercf_check_update();
