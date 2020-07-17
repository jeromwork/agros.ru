<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

class UserCfController_Admin extends AdminSecBaseModel {
    public $model_field;

    public function __construct() {
        parent::__construct();
        $this->model_field = UserCfModel_Field::newInstance();
    }

    public function doModel() {
        parent::doModel();
        switch(Params::getParam('route')) {
            // List fields.
            case 'usercf-field-list':
                $fields = UserCfModel_Field::newInstance()->listAll();
                View::newInstance()->_exportVariableToView('usercf-fields', $fields);
            break;
            // Add a field.
            case 'usercf-field-add':
                if(Params::getParam('add')) {
                    $return = osc_route_admin_url('usercf-field-add');

                    $data = array(
                        's_name' => osc_esc_html(Params::getParam('name')),
                        's_slug' => osc_sanitize_string(osc_esc_html(Params::getParam('name'))),
                        's_type' => osc_esc_html(Params::getParam('type')),
                        's_options' => (Params::getParam('options') != '') ? osc_esc_html(Params::getParam('options')) : null,
                        'i_min' => (Params::getParam('min') != '') ? osc_esc_html(Params::getParam('min')) : null,
                        'i_max' => (Params::getParam('max') != '') ? osc_esc_html(Params::getParam('max')) : null,
                        'b_enabled' => osc_esc_html(Params::getParam('status')),
                        'b_public' => osc_esc_html(Params::getParam('public')),
                        'b_required' => osc_esc_html(Params::getParam('required')),
                        'e_position' => osc_esc_html(Params::getParam('position')),
                        'i_order' => $this->model_field->getLastOrder() + 1,
                    );

                    if(!$this->model_field->insert($data)) {
                        osc_add_flash_error_message(__('Error while adding the field. Please try again.', usercf_plugin()), 'admin');
                        osc_redirect_to($return);
                    }

                    osc_add_flash_ok_message(__('Field added successfully.', usercf_plugin()), 'admin');
                    osc_redirect_to(osc_route_admin_url('usercf-field-list'));
                }
            break;
            // Edit a field.
            case 'usercf-field-edit':
                $id = (int) osc_esc_html(Params::getParam('id'));
                if($id === null) {
                    osc_add_flash_error_message(__('ID is not valid!', usercf_plugin()), 'admin');
                    osc_redirect_to(osc_route_admin_url('usercf-field-list'));
                }

                $return = osc_route_admin_url('usercf-field-edit', array('id' => $id));
                $field = UserCfModel_Field::newInstance()->findByPrimaryKey($id);
                View::newInstance()->_exportVariableToView('usercf-field', $field);

                if(Params::getParam('edit')) {
                    $where = array('pk_i_id' => $id);
                    $data = array(
                        's_name' => osc_esc_html(Params::getParam('name')),
                        's_slug' => osc_sanitize_string(osc_esc_html(Params::getParam('name'))),
                        's_type' => osc_esc_html(Params::getParam('type')),
                        's_options' => (Params::getParam('options') != '') ? osc_esc_html(Params::getParam('options')) : null,
                        'i_min' => (Params::getParam('min') != '') ? osc_esc_html(Params::getParam('min')) : null,
                        'i_max' => (Params::getParam('max') != '') ? osc_esc_html(Params::getParam('max')) : null,
                        'b_enabled' => osc_esc_html(Params::getParam('status')),
                        'b_public' => osc_esc_html(Params::getParam('public')),
                        'b_required' => osc_esc_html(Params::getParam('required')),
                        'e_position' => osc_esc_html(Params::getParam('position')),
                    );

                    if(!$this->model_field->updateByPrimaryKey($data, $id)) {
                        osc_add_flash_error_message(__('Error while editing the field. Please try again.', usercf_plugin()), 'admin');
                        osc_redirect_to($return);
                    }

                    osc_add_flash_ok_message(__('Field edited successfully.', usercf_plugin()), 'admin');
                    osc_redirect_to(osc_route_admin_url('usercf-field-list'));
                }
            break;
            // Delete (a) field(s).
            case 'usercf-field-delete':
                $return = osc_route_admin_url('usercf-field-list');
                $id = osc_esc_html(Params::getParam('id'));

                if(strpos($id, ',') !== false) {
                    $id = usercf_where_in($id); // SQL injection prevention attempt.
                    if(!$this->model_field->deleteBulk($id)) {
                        osc_add_flash_error_message(__('Error while deleting the fields. Please try again.', usercf_plugin()), 'admin');
                        $this->redirectTo($return);
                    }
                } else {
                    if(!$this->model_field->deleteByPrimaryKey($id)) {
                        osc_add_flash_error_message(__('Error while deleting the field. Please try again.', usercf_plugin()), 'admin');
                        $this->redirectTo($return);
                    }
                }

                osc_add_flash_ok_message(__('Field(s) deleted successfully.', usercf_plugin()), 'admin');
                $this->redirectTo($return);
            break;
            // Enable (a) field(s).
            case 'usercf-field-enable':
                $return = osc_route_admin_url('usercf-field-list');
                $id = osc_esc_html(Params::getParam('id'));

                if(strpos($id, ',') !== false) {
                    $id = usercf_where_in($id); // SQL injection prevention attempt.
                    if(!$this->model_field->dao->update($this->model_field, array('b_enabled' => 1), sprintf('pk_i_id IN ("%s")', $id))) {
                        osc_add_flash_error_message(__('Error while enabling the fields. Please try again.', usercf_plugin()), 'admin');
                        $this->redirectTo($return);
                    }
                } else {
                    if(!$this->model_field->updateByPrimaryKey(array('b_enabled' => 1), $id)) {
                        osc_add_flash_error_message(__('Error while enabling the field. Please try again.', usercf_plugin()), 'admin');
                        $this->redirectTo($return);
                    }
                }

                osc_add_flash_ok_message(__('Field(s) enabled successfully.', usercf_plugin()), 'admin');
                $this->redirectTo($return);
            break;
            // Disable (a) field(s).
            case 'usercf-field-disable':
                $return = osc_route_admin_url('usercf-field-list');
                $id = osc_esc_html(Params::getParam('id'));

                if(strpos($id, ',') !== false) {
                    $id = usercf_where_in($id); // SQL injection prevention attempt.
                    if(!$this->model_field->dao->update($this->model_field->getTableName(), array('b_enabled' => 0), sprintf('pk_i_id IN ("%s")', $id))) {
                        osc_add_flash_error_message(__('Error while disabling the fields. Please try again.', usercf_plugin()), 'admin');
                        $this->redirectTo($return);
                    }
                } else {
                    if(!$this->model_field->updateByPrimaryKey(array('b_enabled' => 0), $id)) {
                        osc_add_flash_error_message(__('Error while disabling the field. Please try again.', usercf_plugin()), 'admin');
                        $this->redirectTo($return);
                    }
                }

                osc_add_flash_ok_message(__('Field(s) disabled successfully.', usercf_plugin()), 'admin');
                $this->redirectTo($return);
            break;
            // Reorder fields.
            case 'usercf-field-reorder':
                $order = Params::getParam('order');
                if(!is_array($order)) {
                    exit();
                }

                for($orderNo = 0; $orderNo < count($order); $orderNo++) {
                    $this->model_field->updateByPrimaryKey(array('i_order' => $orderNo + 1), $order[$orderNo]);
                }

                exit();
            break;
        }
    }

    function missingField($name, $return) {
        osc_add_flash_error_message(sprintf(__('Field "%s" is missing.', usercf_plugin()), $name), 'admin');
        $this->redirectTo($return);
    }

    function doView($file) {
        osc_run_hook("before_admin_html");
        osc_current_admin_theme_path($file);
        Session::newInstance()->_clearVariables();
        osc_run_hook("after_admin_html");
    }
}
?>
