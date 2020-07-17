<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');

$fields = usercf_get_fields();
?>

<h1><?php _e('All fields', usercf_plugin()); ?></h1>
<div class="row">
    <div class="col-12 d-flex mb-3">
        <div class="ml-auto">
            <button class="btn btn-warning usercf-action-btn bulk-action bulk-enable" disabled>
                <?php _e('Enable selected', usercf_plugin()); ?>
            </button>
            <button class="btn btn-warning usercf-action-btn bulk-action bulk-disable" disabled>
                <?php _e('Disable selected', usercf_plugin()); ?>
            </button>
            <button class="btn btn-danger usercf-action-btn bulk-action bulk-delete" disabled>
                <?php _e('Delete selected', usercf_plugin()); ?>
            </button>
        </div>
    </div>
    <!-- <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
            <?php _e('Warning: deleting fields that have user attached to them may cause problems!', usercf_plugin()); ?>
        </div>
    </div> -->
</div>
<hr>
<?php if(count($fields)) { ?>
    <div class="table-responsive">
        <table class="table" style="border: 0;">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 1%;"><input type="checkbox" class="check-all" /></th>
                    <th><?php _e('ID', usercf_plugin()); ?></th>
                    <th><?php _e('ID', usercf_plugin()); ?></th>
                    <th><?php _e('Name', usercf_plugin()); ?></th>
                    <th><?php _e('Type', usercf_plugin()); ?></th>
                    <th><?php _e('Options', usercf_plugin()); ?></th>
                    <th><?php _e('Public', usercf_plugin()); ?></th>
                    <th><?php _e('Position', usercf_plugin()); ?></th>
                    <th><?php _e('Status', usercf_plugin()); ?></th>
                    <th><?php _e('Action', usercf_plugin()); ?></th>
                </tr>
            </thead>
            <tbody id="usercf-fields">
                <?php foreach($fields as $field) { ?>
                <tr data-id="<?php echo $field['pk_i_id']; ?>">
                    <td><input type="checkbox" class="check-one" data-id="<?php echo $field['pk_i_id']; ?>" /></td>
                    <td><?php echo $field['pk_i_id']; ?></td>
                    <td><?php echo $field['s_name']; ?></td>
                    <td><?php echo usercf_format_type($field['s_type']) ?></td>
                    <td><?php echo usercf_format_options($field['s_options'], $field['i_min'], $field['i_max']); ?></td>
                    <td><?php echo usercf_format_public($field['b_public']); ?></td>
                    <td><?php echo usercf_format_position($field['e_position']); ?></td>
                    <td><?php echo usercf_format_status($field['b_enabled']); ?></td>
                    <td>
                        <a href="<?php echo osc_route_admin_url('usercf-field-edit', array('id' => $field['pk_i_id'])); ?>" class="btn btn-info usercf-action-btn">
                            <?php _e('Edit', usercf_plugin()); ?>
                        </a>
                        <a href="<?php echo (!$field['b_enabled']) ? osc_route_admin_url('usercf-field-enable', array('id' => $field['pk_i_id'])) : osc_route_admin_url('usercf-field-disable', array('id' => $field['pk_i_id'])); ?>" class="btn btn-warning usercf-action-btn">
                            <?php echo ($field['b_enabled']) ? __('Disable', usercf_plugin()) : __('Enable', usercf_plugin()); ?>
                        </a>
                        <a href="<?php echo osc_route_admin_url('usercf-field-delete', array('id' => $field['pk_i_id'])); ?>" class="btn btn-danger usercf-action-btn">
                            <?php _e('Delete', usercf_plugin()); ?>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php echo usercf_footer(); ?>

    <script>
    function arrRemoveVal(arr, value) {
       return arr.filter(function(ele){
           return ele != value;
       });
    }

    function bulkButtonState(arr) {
        if(arr.length < 1) {
            $('.bulk-action').attr('disabled', true).css('opacity', '0.7');
        } else {
            $('.bulk-action').attr('disabled', false).css('opacity', '1');
        }
    }

    var bulk_checked = [];
    $('.check-all').click(function() {
        if($(this).prop('checked')) {
            $('.check-one').each(function() {
                var id = $(this).attr('data-id');
                bulk_checked.push(id);
            }).prop('checked', true);
        } else {
            bulk_checked = [];
            $('.check-one').prop('checked', false);
        }
        bulkButtonState(bulk_checked);
    });

    $('.check-one').click(function() {
        var id = $(this).attr('data-id');
        if($(this).prop('checked')) {
            bulk_checked.push(id);
        } else {
            bulk_checked = arrRemoveVal(bulk_checked, id);
        }
        bulkButtonState(bulk_checked);
    });

    $('.bulk-action').click(function() {
        bulkButtonState(bulk_checked);

        if($(this).hasClass('bulk-delete')) {
            url = '<?php echo osc_route_admin_url('usercf-field-delete', array('id' => '')); ?>';
        } else if($(this).hasClass('bulk-enable')) {
            url = '<?php echo osc_route_admin_url('usercf-field-enable', array('id' => '')); ?>';
        } else if($(this).hasClass('bulk-disable')) {
            url = '<?php echo osc_route_admin_url('usercf-field-disable', array('id' => '')); ?>';
        }

        var fields = bulk_checked.join(',');
        var url = url + fields;
        window.location.href = url;
    });


    $(function() {
        $('#usercf-fields').sortable({
            placeholder: 'ui-state-highlight',
        	update: function(event, ui) {
        		var orderIds = new Array();
        		$('#usercf-fields tr').each(function() {
        			orderIds.push($(this).attr('data-id'));
        		});

        		$.ajax({
        			url: '<?php echo osc_route_admin_url('usercf-field-reorder'); ?>',
        			method: 'POST',
        			data: {
                        order: orderIds
                    },
        			success: function(data) {
                        console.info(data);
        			}
        		});
        	}
        });
    });
    </script>
<?php } else { ?>
    <p class="text-center"><?php _e('No fields, yet', usercf_plugin()); ?></p>
<?php } ?>
