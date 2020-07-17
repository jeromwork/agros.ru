<?php
/* Developed by WEBmods
 * Zagorski oglasnik j.d.o.o. za usluge | www.zagorski-oglasnik.com
 *
 * License: GPL-3.0-or-later
 * More info in license.txt
*/
if(!defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');
?>
<h1><?php _e('Help', usercf_plugin()); ?></h1>
<div class="row">
    <div class="col-12">
        <p>Get a field value by field and user ID.</p>
        <p>
            <var>$field</var> - here you need to specify field ID.
        </p>
        <p>
            <var>$user</var> - here you need to specify user ID. Example values:
            <ul>
                <li><var>osc_logged_user_id()</var> - for logged user</li>
                <li><var>osc_item_user_id()</var> - for item page and search page (loop)</li>
                <li><var>osc_comment_user_id()</var> - for item comments</li>
                <li><var>osc_user_id()</var> - for public profile</li>
            </ul>
        </p>
        <pre><code>usercf_user_field(<var>$field</var>, <var>$user</var>)</code></pre>
    </div>
    <div class="col-12">
        <p>Get all fields by user ID.</p>
        <p>
            <var>$user</var> - here you need to specify user ID. Example values:
            <ul>
                <li><var>osc_logged_user_id()</var> - for logged user</li>
                <li><var>osc_item_user_id()</var> - for item page and search page (loop)</li>
                <li><var>osc_comment_user_id()</var> - for item comments</li>
                <li><var>osc_user_id()</var> - for public profile</li>
            </ul>
        </p>
        <pre><code>usercf_user_fields(<var>$user</var>)</code></pre>
    </div>
</div>

<?php echo usercf_footer(); ?>
