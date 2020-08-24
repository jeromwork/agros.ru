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

osc_enqueue_script('jquery-validate');
bender2_add_body_class('item item-post');
$action = 'item_add_post';
$edit = false;
if (Params::getParam('action') == 'item_edit') {
    $action = 'item_edit_post';
    $edit = true;
}

?>
<?php osc_current_web_theme_path('header.php'); ?>
<?php
if (bender2_default_location_show_as() == 'dropdown') {
    ItemForm::location_javascript();
} else {
    ItemForm::location_javascript_new();
}
?>
<div class="form-container form-horizontal">
    <div class="resp-wrapper">



        <ul id="error_list"></ul>

        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Объявление</h1>
                    <!-- Product edit card start -->
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="product-edit">
                                        <ul class="nav nav-tabs nav-justified md-tabs " role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#home7" role="tab" aria-expanded="true">
                                                    <div class="f-20">
                                                        <i class="icofont icofont-edit"></i>
                                                    </div>
                                                    <?php _e('General Information', 'bender2'); ?>
                                                </a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#profile7" role="tab" aria-expanded="false">
                                                    <div class="f-20">
                                                        <i class="icofont icofont-document-search"></i>
                                                    </div>
                                                    Дополнительные параметры
                                                </a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#messages7" role="tab" aria-expanded="false">
                                                    <div class="f-20">
                                                        <i class="icofont icofont-ui-image"></i>
                                                    </div>
                                                    Изображения
                                                </a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#messages8" role="tab" aria-expanded="false">
                                                    <div class="f-20">
                                                        <i class="icofont icofont-comment"></i>
                                                    </div>
                                                    Местоположение
                                                </a>
                                                <div class="slide"></div>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="home7" role="tabpanel" aria-expanded="true">
                                                <form class="md-float-material card-block" name="item" action="<?php echo osc_base_url(true); ?>" method="post" enctype="multipart/form-data" id="item-post">
                                                    <fieldset>
                                                        <input type="hidden" name="action" value="<?php echo $action; ?>" />
                                                        <input type="hidden" name="page" value="item" />
                                                        <?php if ($edit) { ?>
                                                            <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                                                            <input type="hidden" name="secret" value="<?php echo osc_item_secret(); ?>" />
                                                        <?php } ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="input-group">

                                                                    <?php ItemForm::category_select(null, null, __('Select a category', 'bender2')); ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">



                                                                    <span class="input-group-addon"><i class="icofont icofont-cur-dollar"></i></span>
                                                                    <?php
                                                                    $item = osc_item();
                                                                    if (Session::newInstance()->_getForm('price') != "") {
                                                                        $item['i_price'] = Session::newInstance()->_getForm('price');
                                                                    }
                                                                    ?>
                                                                    <input class="form-control" placeholder="Цена" id="price" type="text" name="price" value="<?php echo (isset($item['i_price'])) ? osc_prepare_price($item['i_price']) : ''; ?>">


                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="icofont icofont-megaphone"></i></span>
                                                                    <input id="title<?php echo osc_current_user_locale(); ?>" type="text" name="title[<?php echo osc_current_user_locale(); ?>]" value="<?php echo osc_esc_html(bender2_item_title()); ?>" class="form-control" placeholder="<?php _e('Title', 'bender2'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <textarea rows="5" cols="5" class="form-control" placeholder="<?php echo osc_esc_html(bender2_item_description()); ?>" id="description<?php echo osc_current_user_locale(); ?>" name="description[<?php echo osc_current_user_locale(); ?>]"></textarea>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr>

                                                    </fieldset>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="profile7" role="tabpanel" aria-expanded="false">
                                                <form class="md-float-material card-block">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icofont icofont-all-caps"></i></span>
                                                                <input type="text" class="form-control" placeholder="Title">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icofont icofont-underline"></i></span>
                                                                <input type="text" class="form-control" placeholder="Label Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icofont icofont-ui-keyboard"></i></span>
                                                                <input type="text" class="form-control" placeholder="Keyword">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icofont icofont-copy-alt"></i></span>
                                                                <input type="text" class="form-control" placeholder="Description">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="text-center m-t-20">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light m-r-10">Save</button>
                                                                <button type="button" class="btn btn-warning waves-effect waves-light">Discard</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="messages7" role="tabpanel" aria-expanded="false">
                                                <div class="md-float-material card-block">

                                                    <?php if (osc_images_enabled_at_items()) {
                                                        ItemForm::ajax_photos();
                                                    } ?>
                                                    <hr>

                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="messages8" role="tabpanel" aria-expanded="false">
                                                <div class="card-block">
                                                <input id="location0" type="text" class="mapg" name="location[0][]" placeholder="введите адрес 1">
			<div id="location0map" class="ymap"></div>
                                                    
                                                    <div id="footer">
                                                        <div id="messageHeader"></div>
                                                        <div id="message"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">


                                                            <div class="input-group">

                                                            </div>




                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="text-center m-t-20">
                                                                <button type="button" class="btn btn-primary waves-effect waves-light m-r-10">Save
                                                                </button>
                                                                <button type="button" class="btn btn-warning waves-effect waves-light">Discard
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product edit card end -->
                </div>
            </div>
        </div>





        <form name="item" action="<?php echo osc_base_url(true); ?>" method="post" enctype="multipart/form-data" id="item-post">
            <fieldset>
                <input type="hidden" name="action" value="<?php echo $action; ?>" />
                <input type="hidden" name="page" value="item" />
                <?php if ($edit) { ?>
                    <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                    <input type="hidden" name="secret" value="<?php echo osc_item_secret(); ?>" />
                <?php } ?>
                <h2><?php _e('General Information', 'bender2'); ?></h2>
                <div class="control-group">
                    <label class="control-label" for="select_1"><?php _e('Category', 'bender2'); ?></label>
                    <div class="controls">
                        <?php ItemForm::category_select(null, null, __('Select a category', 'bender2')); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="title[<?php echo osc_current_user_locale(); ?>]"><?php _e('Title', 'bender2'); ?></label>
                    <div class="controls">
                        <?php ItemForm::title_input('title', osc_current_user_locale(), osc_esc_html(bender2_item_title())); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="description[<?php echo osc_current_user_locale(); ?>]"><?php _e('Description', 'bender2'); ?></label>
                    <div class="controls">
                        <?php ItemForm::description_textarea('description', osc_current_user_locale(), osc_esc_html(bender2_item_description())); ?>
                    </div>
                </div>
                <?php if (osc_price_enabled_at_items()) { ?>
                    <div class="control-group control-group-price">
                        <label class="control-label" for="price"><?php _e('Price', 'bender2'); ?></label>
                        <div class="controls">
                            <?php ItemForm::price_input_text(); ?>
                            <?php ItemForm::currency_select(); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (osc_images_enabled_at_items()) {
                    ItemForm::ajax_photos();
                } ?>

                <div class="box location">
                    <h2><?php _e('Listing Location', 'bender2'); ?></h2>











                    <?php if (count(osc_get_countries()) > 1) { ?>
                        <div class="control-group">
                            <label class="control-label" for="country"><?php _e('Country', 'bender2'); ?></label>
                            <div class="controls">
                                <?php ItemForm::country_select(osc_get_countries(), osc_user()); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="regionId"><?php _e('Region', 'bender2'); ?></label>
                            <div class="controls">
                                <?php
                                if (bender2_default_location_show_as() == 'dropdown') {
                                    if ($edit) {
                                        ItemForm::region_select(osc_get_regions(osc_item_country_code()), osc_item());
                                    } else {
                                        ItemForm::region_select(osc_get_regions(osc_user_field('fk_c_country_code')), osc_user());
                                    }
                                } else {
                                    if ($edit) {
                                        ItemForm::region_text(osc_item());
                                    } else {
                                        ItemForm::region_text(osc_user());
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        $aRegions = array();
                        $_countryCode = '';
                        $aCountries = osc_get_countries();
                        if (count($aCountries) > 0) {
                            $_countryCode = $aCountries[0]['pk_c_code'];
                            $aRegions = osc_get_regions($_countryCode);
                        }
                    ?>
                        <input type="hidden" id="countryId" name="countryId" value="<?php echo osc_esc_html($_countryCode); ?>" />
                        <div class="control-group">
                            <label class="control-label" for="region"><?php _e('Region', 'bender2'); ?></label>
                            <div class="controls">
                                <?php
                                if (bender2_default_location_show_as() == 'dropdown') {
                                    if ($edit) {
                                        ItemForm::region_select($aRegions, osc_item());
                                    } else {
                                        ItemForm::region_select($aRegions, osc_user());
                                    }
                                } else {
                                    if ($edit) {
                                        ItemForm::region_text(osc_item());
                                    } else {
                                        ItemForm::region_text(osc_user());
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="control-group">
                        <label class="control-label" for="city"><?php _e('City', 'bender2'); ?></label>
                        <div class="controls">
                            <?php
                            if (bender2_default_location_show_as() == 'dropdown') {
                                if ($edit) {
                                    ItemForm::city_select(null, osc_item());
                                } else { // add new item
                                    ItemForm::city_select(osc_get_cities(osc_user_region_id()), osc_user());
                                }
                            } else {
                                ItemForm::city_text(osc_user());
                            }
                            ?>
                        </div>
                    </div>















                    <div class="control-group">
                        <label class="control-label" for="cityArea"><?php _e('City Area', 'bender2'); ?></label>
                        <div class="controls">
                            <?php ItemForm::city_area_text(osc_user()); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="address"><?php _e('Address', 'bender2'); ?></label>
                        <div class="controls">
                            <?php ItemForm::address_text(osc_user()); ?>
                        </div>
                    </div>
                </div>
                <!-- seller info -->
                <?php if (!osc_is_web_user_logged_in()) { ?>
                    <div class="box seller_info">
                        <h2><?php _e("Seller's information", 'bender2'); ?></h2>
                        <div class="control-group">
                            <label class="control-label" for="contactName"><?php _e('Name', 'bender2'); ?></label>
                            <div class="controls">
                                <?php ItemForm::contact_name_text(); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="contactEmail"><?php _e('E-mail', 'bender2'); ?></label>
                            <div class="controls">
                                <?php ItemForm::contact_email_text(); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls checkbox">
                                <?php ItemForm::show_email_checkbox(); ?> <label for="showEmail"><?php _e('Show e-mail on the listing page', 'bender2'); ?></label>
                            </div>
                        </div>
                    </div>
                <?php
                }
                if ($edit) {
                    ItemForm::plugin_edit_item();
                } else {
                    ItemForm::plugin_post_item();
                }
                ?>
                <div class="control-group">
                    <?php if (osc_recaptcha_items_enabled()) { ?>
                        <div class="controls">
                            <?php osc_show_recaptcha(); ?>
                        </div>
                    <?php } ?>
                    <div class="controls">
                        <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php if ($edit) {
                                                                                                    _e("Update", 'bender2');
                                                                                                } else {
                                                                                                    _e("Publish", 'bender2');
                                                                                                } ?></button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#price').bind('hide-price', function() {
        $('.control-group-price').hide();
    });

    $('#price').bind('show-price', function() {
        $('.control-group-price').show();
    });

    <?php if ($edit && !osc_item_category_price_enabled(osc_item_category_id())) { ?>
        $('#price').trigger('hide-price');
    <?php } ?>


    <?php if (osc_locale_thousands_sep() != '' || osc_locale_dec_point() != '') { ?>
        $().ready(function() {
            $("#price").blur(function(event) {
                var price = $("#price").prop("value");
                <?php if (osc_locale_thousands_sep() != '') { ?>
                    while (price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>') != -1) {
                        price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
                    }
                <?php }; ?>
                <?php if (osc_locale_dec_point() != '') { ?>
                    var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point()) ?>');
                    if (tmp.length > 2) {
                        price = tmp[0] + '<?php echo osc_esc_js(osc_locale_dec_point()) ?>' + tmp[1];
                    }
                <?php }; ?>
                $("#price").prop("value", price);
            });
        });
    <?php }; ?>
</script>
<?php osc_current_web_theme_path('footer.php'); ?>