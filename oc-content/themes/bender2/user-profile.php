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

// meta tag robots
osc_add_hook('header', 'bender2_nofollow_construct');

bender2_add_body_class('user user-profile');
osc_add_hook('before-main', 'sidebar');
function sidebar()
{
	osc_current_web_theme_path('user-sidebar.php');
}
osc_add_filter('meta_title_filter', 'custom_meta_title');
function custom_meta_title($data)
{
	return __('Update account', 'bender2');
}
osc_current_web_theme_path('header.php');
$osc_user = osc_user();
?>
<h1><?php _e('Update account', 'bender2'); ?></h1>
<?php UserForm::location_javascript(); ?>

<div class="form-container form-horizontal">
	<div class="resp-wrapper">
		<ul id="error_list"></ul>
		<form action="<?php echo osc_base_url(true); ?>" method="post" onsubmit="return false;">
			<input type="hidden" name="page" value="user" />
			<input type="hidden" name="action" value="profile_post" />
			<div class="control-group">
				<label class="control-label" for="name"><?php _e('Name', 'bender2'); ?></label>
				<div class="controls">
					<?php UserForm::name_text(osc_user()); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="user_type"><?php _e('User type', 'bender2'); ?></label>
				<div class="controls">
					<?php UserForm::is_company_select(osc_user()); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="phoneMobile"><?php _e('Cell phone', 'bender2'); ?></label>
				<div class="controls">
					<?php UserForm::mobile_text(osc_user()); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="phoneLand"><?php _e('Phone', 'bender2'); ?></label>
				<div class="controls">
					<?php UserForm::phone_land_text(osc_user()); ?>
				</div>
			</div>
			<script type="text/javascript">
			let agro={
					locations:[
						{
						i : 0,
						ymapadress : 'Россия, Воронежская область, Новоусманский район, село Новая Усмань',
						coord1:51.64346330701437,
						coord2:39.4102694999999
						},						
						{
						i : 1,
						ymapadress : 'Россия, Воронежская область, село Каширское',
						coord1:51.414063980554474,
						coord2:39.60654999999995
						}
					]
					}
				
				
				;</script>
			<div id="mapcont">
<button id="ymapblock" style="display: none; position: absolute; "></button>
			<div id="loci">
				<div class="control-group" data-pm="0">
					
					<input id="location0" type="text" class="mapg" name="location[0][]" placeholder="введите адрес 1" size="50" value="">
					<input type="hidden" name="location[0][coord1]" class="coord1" id="location0coord1" value="51">
					<input type="hidden" name="location[0][coord2]" class="coord2" id="location0coord2" value="39.4102694999999">
					<input id="locationfull0" type="text" name="location[0][locationfull]" value="" readonly>

					<button class="deletelocation">X</button>
				</div>
				
				</div>
			</div>
<button class="addlocation">add</button>
			<div id="locationmap" class="ymap"></div>
	</div>
	<div class="control-group">
		<label class="control-label" for="country"><?php _e('Country', 'bender2'); ?></label>
		<div class="controls">
			<?php UserForm::country_select(osc_get_countries(), osc_user()); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="region"><?php _e('Region', 'bender2'); ?></label>
		<div class="controls">
			<?php UserForm::region_select(osc_get_regions(), osc_user()); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="city"><?php _e('City', 'bender2'); ?></label>
		<div class="controls">
			<?php UserForm::city_select(osc_get_cities(), osc_user()); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="city_area"><?php _e('City area', 'bender2'); ?></label>
		<div class="controls">
			<?php UserForm::city_area_text(osc_user()); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" l for="address"><?php _e('Address', 'bender2'); ?></label>
		<div class="controls">
			<?php UserForm::address_text(osc_user()); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="webSite"><?php _e('Website', 'bender2'); ?></label>
		<div class="controls">
			<?php UserForm::website_text(osc_user()); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="s_info"><?php _e('Description', 'bender2'); ?></label>
		<div class="controls">
			<?php UserForm::info_textarea('s_info', osc_locale_code(), @$osc_user['locale'][osc_locale_code()]['s_info']); ?>
		</div>
	</div>
	<?php osc_run_hook('user_profile_form', osc_user()); ?>
	<div class="control-group">
		<div class="controls">
			<button type="button" class="ui-button ui-button-middle ui-button-main"><?php _e("Update", 'bender2'); ?></button>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<?php osc_run_hook('user_form', osc_user()); ?>
		</div>
	</div>
	</form>

</div>

<script type = "text/template" id="addrestemplate">
<div class="control-group" data-pm="{i}">
	<input id="location{i}" type="text" class="mapg" name="location[{i}][ymapadress]" placeholder="введите адрес" size="50" value="{ymapadress}">
					<input type="hidden" name="location[{i}][coord1]" class="coord1" value="{coord1}">
					<input type="hidden" name="location[{i}][coord2]" class="coord2" value="{coord2}">
					<input  type="text" name="location[{i}][locationfull]" value="{ymapadress}" readonly>

					<button class="deletelocation">X</button>
	
	
	</div>
</script>


</div>
<?php osc_current_web_theme_path('footer.php'); ?>