<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

class UserCfFieldForm extends Form {
    static public function i18n_datePicker() { ?>
        <script type="text/javascript">
            $.datepicker.regional['custom'] = { // Default regional settings
                closeText: '<?php echo osc_esc_js ( __('Done') ); ?>', // Display text for close link
                prevText: '<?php echo osc_esc_js ( __('Prev') ); ?>', // Display text for previous month link
                nextText: '<?php echo osc_esc_js ( __('Next') ); ?>', // Display text for next month link
                currentText: '<?php echo osc_esc_js ( __('Today') ); ?>', // Display text for current month link
                monthNames: ['<?php echo osc_esc_js ( __('January') ); ?>','<?php echo osc_esc_js ( __('February') ); ?>','<?php echo osc_esc_js ( __('March') ); ?>','<?php echo osc_esc_js ( __('April') ); ?>','<?php echo osc_esc_js ( __('May') ); ?>','<?php echo osc_esc_js ( __('June') ); ?>','<?php echo osc_esc_js ( __('July') ); ?>','<?php echo osc_esc_js ( __('August') ); ?>','<?php echo osc_esc_js ( __('September') ); ?>','<?php echo osc_esc_js ( __('October') ); ?>','<?php echo osc_esc_js ( __('November') ); ?>','<?php echo osc_esc_js ( __('December') ); ?>'], // Names of months for drop-down and formatting
                monthNamesShort: ['<?php _e('Jan'); ?>', '<?php _e('Feb'); ?>', '<?php _e('Mar'); ?>', '<?php _e('Apr'); ?>', '<?php _e('May'); ?>', '<?php _e('Jun'); ?>', '<?php _e('Jul'); ?>', '<?php _e('Aug'); ?>', '<?php _e('Sep'); ?>', '<?php _e('Oct'); ?>', '<?php _e('Nov'); ?>', '<?php _e('Dec'); ?>'], // For formatting
                dayNames: ['<?php echo osc_esc_js ( __('Sunday') ); ?>', '<?php echo osc_esc_js ( __('Monday') ); ?>', '<?php echo osc_esc_js ( __('Tuesday') ); ?>', '<?php echo osc_esc_js ( __('Wednesday') ); ?>', '<?php echo osc_esc_js ( __('Thursday') ); ?>', '<?php echo osc_esc_js ( __('Friday') ); ?>', '<?php echo osc_esc_js ( __('Saturday') ); ?>'], // For formatting
                dayNamesShort: ['<?php _e('Sun'); ?>', '<?php _e('Mon'); ?>', '<?php _e('Tue'); ?>', '<?php _e('Wed'); ?>', '<?php _e('Thu'); ?>', '<?php _e('Fri'); ?>', '<?php _e('Sat'); ?>'], // For formatting
                dayNamesMin: ['<?php _e('Su'); ?>','<?php _e('Mo'); ?>','<?php _e('Tu'); ?>','<?php _e('We'); ?>','<?php _e('Th'); ?>','<?php _e('Fr'); ?>','<?php _e('Sa'); ?>'], // Column headings for days starting at Sunday
                weekHeader: '<?php _e('Wk'); ?>', // Column header for week of the year
                dateFormat: 'dd/mm/yy', // See format options on parseDate
                firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
                isRTL: false, // True if right-to-left language, false if left-to-right
                showMonthAfterYear: false, // True if the year select precedes month, false for month then year
                yearSuffix: '' // Additional text to append to the year in the month headers
            };
        </script>
    <?php }

    static public function initDatePicker($id_field, $dateFormat, $value, $type='none') {
        if($value == '') $value = 0;
        $value = $value - 86400;
        $aux = <<<FB
        <script type="text/javascript">
        $(document).ready(function(){
            $('.$id_field').datepicker({
                onSelect: function() {
                    // format to unix timestamp
                    var fecha = $(this).datepicker('getDate');
                    if('$type'=='from') {
                        fecha.setHours('0');
                        fecha.setMinutes('0');
                        fecha.setSeconds('0');
                    } else if('$type'=='to') {
                        fecha.setHours('23');
                        fecha.setMinutes('59');
                        fecha.setSeconds('59');
                    }
                    // new date format
                    var new_date = date('$dateFormat', fecha.getTime()/1000 );
                    // hack - same dateformat as php date function
                    $('.$id_field').prop('value', new_date);
                    $('#$id_field').prop('value', fecha.getTime() / 1000 + 86400);
                },
                inline: true,
                navigationAsDateFormat: true,
                dateFormat: '@' // javascript timestamp
            });
            $.datepicker.setDefaults($.datepicker.regional['custom']);
            if($value>0 && $value!='') {
                // hack - same dateformat as php date function
                $('.$id_field').prop('value', date('$dateFormat', $value));
                $('#$id_field').prop('value', '$value');
            }
            $(".$id_field").change( function () {
                if($(".$id_field").prop('value') == '') {
                    $('#$id_field').prop('value', '');
                }
            });
            });
        </script>
FB;
        echo $aux;
    }

    static public function field($field = null) {
        if($field != null) {
            $session = Session::newInstance()->_getForm('usercf-field');
            if(is_array($session)) {
                if(array_key_exists($field['pk_i_id'], $session)) {
                    $field['s_value'] = $session[$field['pk_i_id']];
                }
            }

            $esc_value = (isset($field['s_value']) && !empty($field['s_value'])) ? osc_esc_html($field['s_value']) : '';
            $name = ($field['b_required']) ? $field['s_name'].' *' : $field['s_name'];

            echo '<div class="control-group">';

            switch($field['s_type']) {
                case 'TEXT':
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    echo '<input id="field_'.$field['s_slug'].'" type="text" name="field['.$field['pk_i_id'].']" value="'.$esc_value.'" />';
                    echo '</div>';
                break;
                case 'NUMBER':
                    if($field['i_min'] != null && $field['i_max'] != null) {
                        $minmax = 'min="'.$field['i_min'].'" max="'.$field['i_max'].'"';
                    }

                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    echo '<input id="field_'.$field['s_slug'].'" type="number" name="field['.$field['pk_i_id'].']" value="'.$esc_value.'" '.$minmax.' />';
                    echo '</div>';
                break;
                case 'RANGE':
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    echo '<div class="usercf-range-single" data-min="'.$field['i_min'].'" data-max="'.$field['i_max'].'" data-value="'.$esc_value.'" data-input="#field_'.$field['s_slug'].'">';
                    echo '<div class="ui-slider-handle"></div>';
                    echo '</div>';
                    echo '<input id="field_'.$field['s_slug'].'" type="hidden" name="field['.$field['pk_i_id'].']" value="'.$esc_value.'"  />';
                    echo '</div>';
                break;
                case 'RANGEFROMTO':
                    if($field['i_min'] != null && $field['i_max'] != null) {
                        $minmax = 'min="'.$field['i_min'].'" max="'.$field['i_max'].'"';
                    }

                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    echo '<div class="usercf-range-fromto" data-min="'.$field['i_min'].'" data-max="'.$field['i_max'].'" data-value="'.$esc_value.'" data-input="#field_'.$field['s_slug'].'">';
                    echo '<div class="ui-slider-handle ui-slider-handle-1"></div>';
                    echo '<div class="ui-slider-handle ui-slider-handle-2"></div>';
                    echo '</div>';
                    echo '<input id="field_'.$field['s_slug'].'" type="hidden" name="field['.$field['pk_i_id'].']" value="'.$esc_value.'"  />';
                    echo '</div>';
                break;
                case 'TEXTAREA':
                    $field_textarea_value = (isset($field["s_value"])) ? $field["s_value"] : '';
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    echo '<textarea id="field_' . $field['s_slug'] . '" name="field['.$field['pk_i_id'].']" rows="10">'.$field_textarea_value.'</textarea>';
                    echo '</div>';
                break;
                case 'DROPDOWN':
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    if(isset($field) && isset($field['s_options'])) {
                        $options = explode(",", $field['s_options']);
                        if(count($options) > 0) {
                            echo '<select id="field_'.$field['s_slug'].'" name="field['.$field['pk_i_id'].']">';
                            foreach($options as $option) {
                                echo '<option value="'.osc_esc_html($option).'" '.($esc_value == $option ? 'selected="selected"' : '').'>'.$option.'</option>';
                            }
                            echo '</select>';
                        }
                    }
                    echo '</div>';
                break;
                case 'RADIO':
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    if(isset($field) && isset($field['s_options'])) {
                        $options = explode(",", $field['s_options']);
                        if(count($options) > 0) {
                            echo '<ul>';
                            foreach($options as $key => $option) {
                                echo '<li><input type="radio" id="field_'.$field['s_slug'].'_'.$key.'" name="field['.$field['pk_i_id'].']" value="'.osc_esc_html($option).'"'.($field['s_value'] == $option ? ' checked="checked"' : '').' /><label for="field_'.$field['s_slug'].'_'.$key.'">'.$option.'</label></li>';
                            }
                            echo '</ul>';
                        }
                    }
                    echo '</div>';
                break;
                case 'CHECKBOXGROUP':
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    if(isset($field) && isset($field['s_options'])) {
                        $options = explode(",", $field['s_options']);
                        $values = explode(',', str_replace('"', '', $field['s_value']));
                        if(count($options) > 0) {
                            echo '<ul>';
                            foreach($options as $key => $option) {
                                if(in_array($option, $values)) {
                                    $checked = 'checked="checked"';
                                } else {
                                    $checked = '';
                                }

                                echo '<li><input type="checkbox" id="field_'.$field['s_slug'].'_'.$key.'" name="field['.$field['pk_i_id'].'][]" value="'.osc_esc_html($option).'"'.$checked.' /><label for="field_'.$field['s_slug'].'_'.$key.'">'.$option.'</label></li>';
                            }
                            echo '</ul>';
                        }
                    }
                    echo '</div>';
                break;
                case 'CHECKBOX':
                    $checkbox = '<input id="field_'.$field['s_slug'].'" type="checkbox" name="field['.$field['pk_i_id'].']"  value="1"'.((isset($field['s_value']) && $field['s_value'] == 1) ? ' checked="checked"' : '').' />';
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$checkbox.$name.'</label>';
                break;
                case 'URL':
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    echo '<input id="field_'.$field['s_slug'].'" type="url" name="field['.$field['pk_i_id'].']" value="'.$esc_value.'" />';
                    echo '</div>';
                break;
                case 'DATE':
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    echo '<input id="field_'.$field['s_slug'].'" type="hidden" name="field['.$field['pk_i_id'].']" value="" />';
                    echo '<input class="field_'.$field['s_slug'].' cf_date" type="text" value="" />';
                    UserCfFieldForm::initDatePicker('field_'.$field['s_slug'], osc_date_format(), $esc_value);
                    echo '</div>';
                break;
                default:
                    echo '<label class="control-label" for="'.$field['s_slug'].'">'.$name.': </label>';
                    echo '<div class="controls">';
                    echo '<input id="field_'.$field['s_slug'].'" type="text" name="field['.$field['pk_i_id'].']" value="'.$esc_value.'" />';
                    echo '</div>';
                break;
            }

            echo '</div>';
        }
    }
}
?>
