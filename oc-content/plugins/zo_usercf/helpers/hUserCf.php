<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

/* Get plugin folder. */
function usercf_plugin() {
    return 'zo_usercf';
}

/* Check if current admin page belongs to User Custom Fields. */
function usercf_is_admin($params) {
    if(array_key_exists('file', $params)) {
        return (strpos($params['file'], usercf_plugin()) !== false);
    } else if(array_key_exists('route', $params)) {
        if(preg_match('/^usercf.*$/', $params['route'])) return true;
    }

    return false;
}

/* Compare current route with route name. */
function usercf_is_route($route) {
    return (Params::getParam('route') == $route);
}

/* Get field types and their labels. */
function usercf_field_types() {
    $types = array(
        'TEXT' => __('Text', usercf_plugin()),
        'NUMBER' => __('Number', usercf_plugin()),
        'RANGE' => __('Range (single)', usercf_plugin()),
        'RANGEFROMTO' => __('Range (from-to)', usercf_plugin()),
        'TEXTAREA' => __('Textarea', usercf_plugin()),
        'RADIO' => __('Radio', usercf_plugin()),
        'DROPDOWN' => __('Dropdown', usercf_plugin()),
        'CHECKBOX' => __('Checkbox', usercf_plugin()),
        'CHECKBOXGROUP' => __('Checkbox group', usercf_plugin()),
        'URL' => __('URL', usercf_plugin()),
        'DATE' => __('Date', usercf_plugin()),
    );

    return $types;
}

/* Get field types that need options. */
function usercf_field_types_options() {
    $types = array(
        'RADIO',
        'DROPDOWN',
        'CHECKBOXGROUP',
    );

    return $types;
}

/* Get field types that need min/max. */
function usercf_field_types_minmax() {
    $types = array(
        'NUMBER',
        'RANGE',
        'RANGEFROMTO',
    );

    return $types;
}

/* Get field from View. */
function usercf_get_field() {
    return View::newInstance()->_get('usercf-field');
}

/* Get fields from View. */
function usercf_get_fields() {
    return View::newInstance()->_get('usercf-fields');
}

/* Type to text. */
function usercf_format_type($type) {
    $types = usercf_field_types();
    return $types[$type];
}

/* Format ptions and min max for options column in admin list. */
function usercf_format_options($options, $min, $max) {
    if($options != null && $options != '') { // '' is deprecated, null is used from now on for empty options.
        return $options;
    } else if ($min != null && $max != null) {
        return sprintf('<strong>Min:</strong> %s', $min).' '.sprintf('<strong>Max:</strong> %s', $max);
    }
}
/* Public field to text. */
function usercf_format_public($field) {
    return ($field) ? __('Public', usercf_plugin()) : __('Private', usercf_plugin());
}

/* Position to text. */
function usercf_format_position($field) {
    switch($field) {
        case 'REG':
            return __('Register only', usercf_plugin());
        break;
        case 'DASH':
            return __('Dashboard only', usercf_plugin());
        break;
        case 'BOTH':
        default:
            return __('Register and dashboard', usercf_plugin());
        break;
    }
}

/* Status field to text. */
function usercf_format_status($field) {
    return ($field) ? __('Enabled', usercf_plugin()) : __('Disabled', usercf_plugin());
}

/* Format fields value (frontend). */
function usercf_field_value($field) {
    if($field['e_type'] == 'DATE') {
        $value = date(osc_date_format(), $field['s_value']);
    } else if($field['e_type'] == 'CHECKBOX') {
        $value = ($field['s_value']) ? __('Yes', usercf_plugin()) : __('No', usercf_plugin());
    } else {
        $value = $field['s_value'];
    }

    return $value;
}

/* SQL injection prevention when using WHERE IN. */
function usercf_where_in($id) {
    $aId = explode(',', $id);
    foreach($aId as $key => $value) {
        if(!is_numeric($value)) unset($aId[$key]);
    }
    $id = implode('","', $aId);

    return $id;
}

/* Show footer with link to LoveOsclass. */
function usercf_footer() {
    include USERCF_PATH.'views/admin/footer.php';
}

/* Get field value by user and field ID. */
function usercf_user_field($field, $user) {
    $dao = UserCfModel_Meta::newInstance();
    $result = $dao->findWhere(array('fk_i_field_id' => $field, 'fk_i_user_id' => $user));
    if($result) {
        if(count($result)) {
            return $result['s_value'];
        }
    }

    return null;
}

/* Get all fields by user ID. */
function usercf_user_fields($user) {
    $dao = UserCfModel_Meta::newInstance();
    $result = $dao->listWhere(array('fk_i_user_id' => $user));
    if($result) {
        if(count($result)) {
            return $result;
        }
    }

    return null;
}
