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
?>

<?php $size = explode('x', osc_thumbnail_dimensions()); ?>

<div class="col-12">
    <div class="card declaration-card  user-card <?php osc_run_hook("highlight_class"); ?>listing-card <?php echo $class;
                                                                                                        if (osc_item_is_premium()) {
                                                                                                            echo ' premium';
                                                                                                        } ?>">
        <div class="row h-100 nonm">

            <div class="col-12">
                <div class="row">
                    <?php if (osc_price_enabled_at_items()) { ?><div class="col-2 b"><?php echo osc_format_price(osc_item_price()); ?></div><?php } ?>

                    <div class="col-10 b">
                        <a href="<?php echo osc_item_url(); ?>" class="title" title="<?php echo osc_esc_html(osc_item_title()); ?>">
                            <h3><?php echo osc_highlight(osc_item_title(), 150); ?></h3>
                        </a></div>
                </div>
            </div>

            <div class="col-2 h-100">
                <div class="row">
                    <div class="col-12"> <?php if (osc_images_enabled_at_items()) { ?>
                            <?php if (osc_count_item_resources()) { ?>
                                <a class="listing-thumb" href="<?php echo osc_item_url(); ?>" title="<?php echo osc_esc_html(osc_item_title()); ?>">
                                    <img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()); ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" class="dimg"></a>
                            <?php } else { ?>
                                <a class="listing-thumb" href="<?php echo osc_item_url(); ?>" title="<?php echo osc_esc_html(osc_item_title()); ?>"><img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_esc_html(osc_item_title()); ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" class="dimg"></a>
                            <?php } ?>
                        <?php } ?></div>
                    <div class="col-12">
                        <?php echo osc_format_date(osc_item_pub_date()); ?>
                    </div>
                    <div class="col-12">
                        <?php echo osc_item_category(); ?> 
                        
                    </div>
                    <div class="col-12">

                    <?php if (osc_item_region() != '') { ?> 
                        
                        <a href="<?php echo osc_item_region_url(osc_item_region_id());  ?>"><?php echo osc_item_city(); ?> <em>(<?php echo osc_item_region(); ?>)</em></a>
                    
                        <?php } ?>
                        </div>
                    <div class="col-12">связаться с продавцом</div>
                </div>

            </div>
            <div class="col-10">
                <div class="row ">
                    <div class="col-12 b">
                        <p><?php echo osc_highlight(osc_item_description(), 250); ?></p>
                    </div>
                    <div class="col-12 b">контакты</div>
                    <div class="col-12 b">еще продукты компании</div>
                </div>

            </div>
        </div>
    </div>
</div>