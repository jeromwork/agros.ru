<h2 class="render-title"><?php _e('HybridAuth Settings', 'HybridAuth'); ?></h2>
<form action="<?php echo osc_admin_render_plugin_url('hybridauth/HybridAuth.php'); ?>" method="post">
    <input type="hidden" name="action_specific" value="HybridAuth" />
	<fieldset>
        <div class="form-horizontal">
            
            
            
            	<h2 class="render-title separate-top">Redirect после входа</h2>
			<div class="form-row">
                <div class="form-label">Redirect to USER_PROFILE</div>
                <div class="form-controls">
					<select name="HybridRedirect">
                        <option value="1" <?php echo (osc_get_preference('HybridRedirect', 'HybridAuth'))?'selected="selected"':''; ?>>Yes</option>
						<option value="0" <?php echo (!osc_get_preference('HybridRedirect', 'HybridAuth'))?'selected="selected"':''; ?>>No</option>
                    </select>
                </div>
            </div>
            
            
            <div class="form-actions">
                <input type="submit" value="<?php _e('Save Changes', 'HybridAuth'); ?>" class="btn btn-submit">
            </div>
		</div>
    </fieldset>
    
</form>