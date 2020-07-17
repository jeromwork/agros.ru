<?php
/*
Plugin Name: PhoneAuth
Plugin URI: https://www.agros.ru/
Description: PhoneAuth A PHP Library for authentication through phone
Version: mod 0.1 
Author: 
Plugin update URI: phoneauth
*/

require_once osc_plugins_path() . osc_plugin_folder(__FILE__) . 'PhoneAuthClass.php';
//require_once osc_plugins_path() . osc_plugin_folder(__FILE__) . 'ModelAUT.php';

function PhoneAuth_install() {
	
	osc_set_preference('PhoneAuthRedirect','1','PhoneAuth','BOOLEAN');
}
osc_register_plugin(osc_plugin_path(__FILE__), 'PhoneAuth') ;

/* PhoneAuth Uninstall */

function PhoneAuth_uninstall() {
	Preference::newInstance()->delete(array('s_section' => 'PhoneAuth'));
}
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'PhoneAuth_uninstall') ;


function PhoneAuth_settings(){
	if(Params::getParam('action_specific') =='PhoneAuth' ){
		$PhoneAuthRedirect = Params::getParam('PhoneAuthRedirect');
		Preference::newInstance()->update(array("s_value" => $PhoneAuthRedirect),array("s_section" => "PhoneAuth", "s_name" => "PhoneAuthRedirect"));
		
		
		osc_add_flash_ok_message(__('PhoneAuth updated correctly', 'PhoneAuth'), 'admin');
		osc_redirect_to(osc_admin_render_plugin_url('PhoneAuth/PhoneAuthSettings.php'));
	}
}
osc_add_hook('init_admin', 'PhoneAuth_settings');

/* PhoneAuth Init  */
function PhoneAuth_init(){

	if (Params::getParam('login') == 'Phone') {
		PhoneAuthClass::newInstance()->loginwith('Phone');
	}
	if(Params::getParam('endpoint') == 'true'){
		//PhoneAuthClass::newInstance()->endpoint();
	}
}
osc_add_hook( 'before_html', 'PhoneAuth_init' ) ;
 
/* PhoneAuth Logout */
function PhoneAuth_logout(){
	//PhoneAuthClass::newInstance()->logout();
}

/* PhoneAuth Login url */
function PhoneAuth_Login(){
	require_once(osc_plugins_path() . 'PhoneAuth/login.php');
}

osc_add_hook('logout','PhoneAuth_logout');


/* Admin Menu */
function PhoneAuth_Admin() {
	echo '<h3><a href="#">PhoneAuth</a></h3>
	<ul>
		<li><a href="'.osc_admin_render_plugin_url('PhoneAuth/PhoneAuthSettings.php').'">&raquo; ' . __('PhoneAuth', 'PhoneAuth') . '</a></li>
		<li><a href="'.osc_admin_render_plugin_url('PhoneAuth/help.php').'">&raquo; ' . __('Help / FAQ', 'PhoneAuth') . '</a></li>
	</ul>';
}
osc_add_hook('admin_menu', 'PhoneAuth_Admin');

/* Configure */
function PhoneAuth_Configure() {
	osc_admin_render_plugin('PhoneAuth/PhoneAuthSettings.php');
}
osc_add_hook(osc_plugin_path(__FILE__)."_configure", 'PhoneAuth_Configure');

?>