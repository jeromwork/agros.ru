<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

class UserCf {
    public $model_meta;
    public $model_field;

    function __construct() {
        $this->model_meta = UserCfModel_Meta::newInstance();
        $this->model_field = UserCfModel_Field::newInstance();

        osc_add_filter('user_add_flash_error', array(&$this, 'userRegError'));
        osc_add_filter('user_edit_flash_error', array(&$this, 'userDashError'));
        // osc_add_hook('pre_user_post', array(&$this, 'userPrePost'));
        osc_add_hook('user_register_completed', array(&$this, 'userPost'));
        osc_add_hook('user_edit_completed', array(&$this, 'userPost'));
        osc_add_hook('user_register_form', array(&$this, 'userRegForm'));
        osc_add_hook('user_form', array(&$this, 'userDashForm'));
        osc_add_hook('delete_user', array(&$this, 'userDelete'));

        // CSS and JS
        osc_add_hook('init', array(&$this, 'enqueueCSSJS'));
        osc_add_hook('footer', array(&$this, 'footerJS'));
    }

    function userRegError($errors) {
        $fields = UserCfModel_Field::newInstance()->listReg(true);
        return $this->userPrePostError($errors, $fields);
    }

    function userDashError($errors) {
        $fields = UserCfModel_Field::newInstance()->listDash(true);
        return $this->userPrePostError($errors, $fields);
    }

    function userPrePostError($errors, $fields) {
        // Get all required fields.
        $data = Params::getParam('field');
        if(count($fields) > 0) {
            foreach($fields as $field) {
                if($field['s_type'] == 'CHECKBOX') {
                    continue;
                }

                if(array_key_exists($field['pk_i_id'], $data)) {
                    if(!empty($data[$field['pk_i_id']])) {
                        continue;
                    }
                }

                $errors .= sprintf(__('Field %s is missing.', usercf_plugin()), $field['s_name']) . PHP_EOL;
            }
        }

        $this->userPrePost();

        if($errors != '') {
            Session::newInstance()->_setForm('usercf-error', 1);
            Session::newInstance()->_keepForm('usercf-error');
        }

        return $errors;
    }

    function userPrePost() {
        // Get Params. Set Session. Keep Session.
        $meta = Params::getParam('field');
        Session::newInstance()->_setForm('usercf-field', $meta);
        Session::newInstance()->_keepForm('usercf-field');
    }

    function userPost($user) {
        // If exists in Session insert.
        $meta = Session::newInstance()->_getForm('usercf-field');
        Session::newInstance()->_dropKeepForm('usercf-error');
        Session::newInstance()->_dropKeepForm('usercf-field');
        if(count($meta) > 0) {
            foreach($meta as $field => $value) {
                if(is_array($value)) {
                    if(count($value) > 1) {
                        $value = implode('","', $value);
                        $value = '"'.$value.'"';
                    } else {
                        $value = '"'.$value[0].'"';
                    }
                } else {
                    $value = osc_esc_html($value);
                }

                $data = array(
                    'fk_i_user_id' => $user,
                    'fk_i_field_id' => $field,
                    's_value' => $value,
                );

                if(Params::getParam('action') == 'profile_post') {
                    $where = array('fk_i_user_id' => $user, 'fk_i_field_id' => $field);
                    $result = $this->model_meta->findWhere($where);
                    if($result) {
                        $this->model_meta->updateByPrimaryKey($data, $result['pk_i_id']);
                    } else {
                        $this->model_meta->insert($data);
                    }
                } else {
                    $this->model_meta->insert($data);
                }
            }
        }

    }

    function userRegForm() {
        if(!Session::newInstance()->_get('usercf-error')) {
            Session::newInstance()->_dropKeepForm('usercf-field');
        }

        // Get all fields.
        $fields = UserCfModel_Field::newInstance()->listReg();
        View::newInstance()->_exportVariableToView('usercf-fields', $fields);
        include USERCF_PATH.'views/web/user.php';
    }

    function userDashForm($user = null) {
        if(!Session::newInstance()->_get('usercf-error')) {
            Session::newInstance()->_dropKeepForm('usercf-field');
        }

        // Get all fields.
        if(OC_ADMIN) {
            $fields = UserCfModel_Field::newInstance()->listBoth();
        } else {
            $fields = UserCfModel_Field::newInstance()->listDash();
        }

        View::newInstance()->_exportVariableToView('usercf-fields', $fields);
        $user = (is_null($user)) ? osc_logged_user_id() : $user['pk_i_id'];

        // Get field data.
        $meta = UserCfModel_Meta::newInstance()->listWhere(array('fk_i_user_id' => $user));
        if(count($meta) > 0) {
            $session = array();
            foreach($meta as $field) {
                $session[$field['fk_i_field_id']] = $field['s_value'];
            }

            Session::newInstance()->_setForm('usercf-field', $session);
            Session::newInstance()->_keepForm('usercf-field');
        }

        include USERCF_PATH.'views/web/user.php';
    }

    function userDelete($user) {
        // Delete meta.
        $this->model_meta->deleteUser($user);
    }

    function enqueueCSSJS() {
        osc_enqueue_style('usercf', osc_plugin_url('zo_usercf/assets/web/main.css') . 'main.css');
        osc_register_script('jquery-ui-touch-punch', osc_plugin_url('zo_usercf/assets/web/jquery.ui.touch-punch.min.js') . 'jquery.ui.touch-punch.min.js', array('jquery', 'jquery-ui'));
        osc_enqueue_script('jquery-ui-touch-punch');
    }

    function footerJS() {
        ?>
        <script>
        $(function() {
            $('.usercf-range-single').each(function() {
                var handle = $(this).find('.ui-slider-handle');
                var input = $($(this).attr('data-input'));
                var minVal = parseInt($(this).attr('data-min'));
                var maxVal = parseInt($(this).attr('data-max'));
                var val = $(this).attr('data-value');
                if(val == '' || val == null) {
                    val = minVal;
                }

                $(this).slider({
                    min: minVal,
                    max: maxVal,
                    value: val,
                    create: function() {
                        handle.text($(this).slider('value'));
                        input.attr('value', $(this).slider('value'));
                    },
                    slide: function(event, ui) {
                        handle.text(ui.value);
                        input.attr('value', ui.value);
                    }
                });
            });

            $('.usercf-range-fromto').each(function() {
                var handle1 = $(this).find('.ui-slider-handle-1');
                var handle2 = $(this).find('.ui-slider-handle-2');
                var input = $($(this).attr('data-input'));
                var minVal = parseInt($(this).attr('data-min'));
                var maxVal = parseInt($(this).attr('data-max'));
                var val = $(this).attr('data-value');
                if(val == '' || val == null) {
                    val = [minVal, maxVal];
                } else {
                    val = val.split(',');
                }

                $(this).slider({
                    range: true,
                    min: minVal,
                    max: maxVal,
                    values: val,
                    create: function() {
                        var inputVal = $(this).slider('values', 0) + ',' + $(this).slider('values', 1);

                        handle1.text($(this).slider('values', 0));
                        handle2.text($(this).slider('values', 1));
                        input.attr('value', inputVal);
                    },
                    slide: function(event, ui) {
                        var inputVal = ui.values[0] + ',' + ui.values[1];

                        handle1.text(ui.values[0]);
                        handle2.text(ui.values[1]);
                        input.attr('value', inputVal);
                    }
                });
            });
        });
        </script>
        <?php
    }
}
$UserCf = new UserCf();

class UserCfAdmin {
    public function __construct() {
        osc_add_hook('init_admin', array(&$this, 'includes'));
        osc_add_hook('renderplugin_controller', array(&$this,'controller'));
        osc_add_hook('admin_menu_init', array(&$this, 'admin_menu'));

        $this->addRoutes();
    }

    function controller() {
        if(is_null(Params::getParam('route'))) return;

        if (usercf_is_admin(Params::getParamsAsArray())) {
            $controller = new UserCfController_Admin();
            $controller->doModel();
        }
    }

    function includes() {
        // Add backend JS and CSS.
        if(!usercf_is_admin(Params::getParamsAsArray())) return;

        osc_add_hook('admin_header', array(&$this, 'adminHeader'));
        osc_register_script('jquery', osc_plugin_url('zo_usercf/assets/admin/js/plugins/jquery/jquery.min.js') . 'jquery.min.js');
        osc_register_script('bootstrap.bundle', osc_plugin_url('zo_usercf/assets/admin/js/plugins/bootstrap/js/bootstrap.bundle.min.js') . 'bootstrap.bundle.min.js', array('jquery'));
        osc_enqueue_script('bootstrap.bundle');
        osc_enqueue_script('php-date');

        osc_enqueue_style('adminlte.min', osc_plugin_url('zo_usercf/assets/admin/css/adminlte.css') . 'adminlte.css');
        osc_enqueue_style('usercf-admin', osc_plugin_url('zo_usercf/assets/admin/main.css') . 'main.css');
    }

    function addRoutes() {
        // Add backend routes.
        osc_add_route('usercf-field-list', 'usercf/field/list/', 'usercf/field/list/', USERCF_FOLDER.'views/admin/list.php');
        osc_add_route('usercf-field-add', 'usercf/field/add/', 'usercf/field/add/', USERCF_FOLDER.'views/admin/add.php');
        osc_add_route('usercf-field-edit', 'usercf/field/add/([0-9]+)/', 'usercf/field/add/{id}/', USERCF_FOLDER.'views/admin/edit.php');
        osc_add_route('usercf-field-delete', 'usercf/field/delete/([0-9]+)/', 'usercf/field/delete/{id}/', USERCF_FOLDER.'views/admin/list.php');
        osc_add_route('usercf-field-enable', 'usercf/field/enable/([0-9]+)/', 'usercf/field/enable/{id}/', USERCF_FOLDER.'views/admin/list.php');
        osc_add_route('usercf-field-disable', 'usercf/field/disable/([0-9]+)/', 'usercf/field/disable/{id}/', USERCF_FOLDER.'views/admin/list.php');
        osc_add_route('usercf-field-reorder', 'usercf/field/reorder/', 'usercf/field/reorder/', USERCF_FOLDER.'views/admin/list.php');
        osc_add_route('usercf-help', 'usercf/help/', 'usercf/help/', USERCF_FOLDER.'views/admin/help.php');
    }

    function adminHeader() {
        // Add custom admin header.
        osc_remove_hook('admin_page_header', 'customPageHeader');
        osc_add_hook('admin_page_header', array(&$this,'pageHeader'), 9);
    }

    function admin_menu() {
        // Add admin submenu (under Plugins menu).
        osc_add_admin_submenu_divider('users', __('Custom Fields', usercf_plugin()), 'zo_usercf_divider', 'administrator');
        osc_add_admin_submenu_page('users', __('List', usercf_plugin()), osc_route_admin_url('usercf-field-list'), 'usercf_field_list', 'administrator');
        osc_add_admin_submenu_page('users', __('Add a field', usercf_plugin()), osc_route_admin_url('usercf-field-add'), 'usercf_field_add', 'administrator');
        osc_add_admin_submenu_page('users', __('Help', usercf_plugin()), osc_route_admin_url('usercf-help'), 'usercf_help', 'administrator');
    }

    function pageHeader() {
        // Add custom admin header - include.
        include(USERCF_PATH.'views/admin/header.php');
    }
}
$UserCfAdmin = new UserCfAdmin();
