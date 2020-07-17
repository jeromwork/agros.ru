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

<?php
    $js_lang = array(
        'delete' => __('Delete', 'bender2'),
        'cancel' => __('Cancel', 'bender2')
    );

    //osc_enqueue_script('jquery');
    //osc_enqueue_script('jquery-ui');
    //osc_register_script('global-theme-js', osc_current_web_theme_js_url('global.js'), 'jquery');
    //osc_register_script('delete-user-js', osc_current_web_theme_js_url('delete_user.js'), 'jquery-ui');
    //osc_enqueue_script('global-theme-js');
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<title><?php echo meta_title() ; ?></title>
<meta name="title" content="<?php echo osc_esc_html(meta_title()); ?>" />
<?php if( meta_description() != '' ) { ?>
<meta name="description" content="<?php echo osc_esc_html(meta_description()); ?>" />
<?php } ?>
<?php if( meta_keywords() != '' ) { ?>
<meta name="keywords" content="<?php echo osc_esc_html(meta_keywords()); ?>" />
<?php } ?>
<?php if( osc_get_canonical() != '' ) { ?>
<!-- canonical -->
<link rel="canonical" href="<?php echo osc_get_canonical(); ?>"/>
<!-- /canonical -->
<?php } ?>
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />

<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- favicon -->
<link rel="shortcut icon" href="<?php echo osc_current_web_theme_url('favicon/favicon-48.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo osc_current_web_theme_url('favicon/favicon-144.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo osc_current_web_theme_url('favicon/favicon-114.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo osc_current_web_theme_url('favicon/favicon-72.png'); ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo osc_current_web_theme_url('favicon/favicon-57.png'); ?>">
<!-- /favicon -->

<link href="<?php //echo osc_current_web_theme_url('js/jquery-ui/jquery-ui-1.10.2.custom.min.css') ; ?>" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    var bender2 = window.bender2 || {};
    bender2.base_url = '<?php echo osc_base_url(true); ?>';
    bender2.langs = <?php echo json_encode($js_lang); ?>;
    bender2.fancybox_prev = '<?php echo osc_esc_js( __('Previous image','bender2')) ?>';
    bender2.fancybox_next = '<?php echo osc_esc_js( __('Next image','bender2')) ?>';
    bender2.fancybox_closeBtn = '<?php echo osc_esc_js( __('Close','bender2')) ?>';
</script>
<link href="<?php //echo osc_current_web_theme_url('css/main.css') ; ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('bower_components/bootstrap/css/bootstrap.min.css') ; ?>">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('icon/feather/css/feather.css') ; ?>">


    <!--link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('pages/list-scroll/list.css') ; ?>"-->
    <link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('bower_components/stroll/css/stroll.css') ; ?>">
    <!-- Style.css --><link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/select2.min.css') ; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/style.css') ; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/nstyle.css') ; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/jquery.mCustomScrollbar.css') ; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/themify-icons.css') ; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/icofont.css') ; ?>">
    <!--script type="text/javascript" src="<?php echo osc_current_web_theme_url('bower_components/jquery/js/jquery.min.js') ; ?>"></script-->
    
	<style>

        #map {
            width: 100%;
            height: 200px;
        }
    </style>
<?php 
osc_run_hook('header') ; 
?>
