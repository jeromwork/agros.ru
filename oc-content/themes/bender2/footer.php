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
</div><!-- content -->
<?php osc_run_hook('after-main'); ?>
</div>
<div id="responsive-trigger"></div>
<!-- footer -->
<div class="clear"></div>
<?php osc_show_widgets('footer');?>


<button class="click-plugin">Get from plugin</button>
<div class="data"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.click-plugin').click(function () {
            var result = '';
            var id = '2';
            var url = '<?php echo osc_ajax_plugin_url('PhoneAuth/ajax.php') . '&request=my_request&id='; ?>' + id;
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                success: function (data) {
                    var length = data.message.length;
                    if (length > 0) {
                        result += data.message + ':' + data.id;
                    } else {
                        result += 'No results';
                    }
                    $('.data').html(result);
                }
            });
        });
    });
</script>


<div id="footer">

    <div class="wrapper">
        <ul class="resp-toggle">
            <?php if( osc_users_enabled() ) { ?>
            <?php if( osc_is_web_user_logged_in() ) { ?>
                <li>
                    <?php echo sprintf(__('Hi %s', 'bender2'), osc_logged_user_name() . '!'); ?>  &middot;
                    <strong><a href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'bender2'); ?></a></strong> &middot;
                    <a href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', 'bender2'); ?></a>
                </li>
            <?php } else { ?>
                <li><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'bender2'); ?></a></li>
                <?php if(osc_user_registration_enabled()) { ?>
                    <li>
                        <a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', 'bender2'); ?></a>
                    </li>
                <?php } ?>
            <?php } ?>
            <?php } ?>
            <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
            <li class="publish">
                <a href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Publish your ad for free", 'bender2');?></a>
            </li>
            <?php } ?>
        </ul>
        <ul>
        <?php
        osc_reset_static_pages();
        while( osc_has_static_pages() ) { ?>
            <li>
                <a href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a>
            </li>
        <?php
        }
        ?>
            <li>
                <a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'bender2'); ?></a>
            </li>
        </ul>
        <?php if( (!defined('MULTISITE') || MULTISITE==0) && osc_get_preference('footer_link', 'bender2') !== '0') {
            echo '<div>' . sprintf(__('Наш сайт использует <a title="Osclass" href="%s">скрипт доски объявлений</a> <strong>Osclass</strong>'), 'https://osclass.pro/') . '</div>';
        }
        ?>
        <?php if ( osc_count_web_enabled_locales() > 1) { ?>
            <?php osc_goto_first_locale(); ?>
            <strong><?php _e('Language:', 'bender2'); ?></strong>
            <?php $i = 0;  ?>
            <?php while ( osc_has_web_enabled_locales() ) { ?>
            <span><a id="<?php echo osc_locale_code(); ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ); ?>"><?php echo osc_locale_name(); ?></a></span><?php if( $i == 0 ) { echo " &middot; "; } ?>
                <?php $i++; ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<?php osc_run_hook('footer'); ?>


<script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>
<script data-cfasync="false" src="<?php echo osc_current_web_theme_url('pages/widget/amchart/amcharts.js') ; ?>"></script>
    
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/jquery-ui/js/jquery-ui.min.js') ; ?>"></script>
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/popper.js/js/popper.min.js') ; ?>"></script>
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/bootstrap/js/bootstrap.min.js') ; ?>"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/jquery-slimscroll/js/jquery.slimscroll.js') ; ?>"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/modernizr/js/modernizr.js') ; ?>"></script>
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/modernizr/js/css-scrollbars.js') ; ?>"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/chart.js/js/Chart.js') ; ?>"></script>
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/stroll/js/stroll.js') ; ?>"></script>
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('pages/list-scroll/list-custom.js') ; ?>"></script>

    <!-- amchart js -->
    <script src="<?php echo osc_current_web_theme_url('pages/widget/amchart/amcharts.js') ; ?>"></script>
    <script src="<?php echo osc_current_web_theme_url('pages/widget/amchart/serial.js') ; ?>"></script>
    <script src="<?php echo osc_current_web_theme_url('pages/widget/amchart/light.js') ; ?>"></script>
    <script src="<?php echo osc_current_web_theme_url('js/jquery.mCustomScrollbar.concat.min.js') ; ?>"></script>
    <script src="<?php echo osc_current_web_theme_url('js/select2.full.min.js') ; ?>"></script>
    <script src="<?php echo osc_current_web_theme_url('js/select2-custom.js') ; ?>"></script>
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('js/SmoothScroll2.js') ; ?>"></script>
    <script src="<?php echo osc_current_web_theme_url('js/pcoded.min.js') ; ?>"></script>
    <!-- custom js -->
    <script src="<?php echo osc_current_web_theme_url('js/vartical-layout.min.js') ; ?>"></script>
    <!--script type="text/javascript" src="<?php echo osc_current_web_theme_url('pages/dashboard/custom-dashboard.js') ; ?>"></script-->
    <script type="text/javascript" src="<?php echo osc_current_web_theme_url('js/script.js') ; ?>"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=bc2dd9e0-c668-4b7b-a105-684bc08042bc" type="text/javascript"></script>
    

</div></div></div></div></div></div>
</body></html>
