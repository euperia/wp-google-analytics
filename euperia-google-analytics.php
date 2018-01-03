<?php
/*
Plugin Name: Euperia Google Analytics Tag
Plugin URI: https://www.euperia.com/wordpress-plugins/google-analytics/1855
Description: A basic Google Analytics plugin. Simply adds the Google Analytics tracking code to all Wordpress pages.
Version: 0.0.1
Author: Andrew McCombe <euperia@gmail.com>
Author URI: https://www.euperia.com/about
License: GPLv2 or later
Text Domain: Google Analytics
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2017-2047 Andrew McCombe <euperia@gmail.com>.
 *
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
     die;
}

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/* Force include any classes */
foreach (glob(__DIR__ . '/inc/class-*.php') as $class) {
    require_once $class;
}

function euperia_add_google_analytics()
{

    $deserializer = new Deserializer();
    $trackingID = $deserializer->get_value('euperia-google-analytics-id');

    if (strlen($trackingID) === 0) {
        echo <<<EOT

    <!-- Added by Euperia Google Analytics Plugin -->
    <!-- 
        You haven't set your Google Analytics Tracking ID up yet.
        Go to the Admin > Settings > Google Analytics ID and update your ID
    -->
    <!--// End Euperia Google Analytics Plugin -->

EOT;
    return;
    }

echo <<<EOT

    <!-- Added by Euperia Google Analytics Plugin -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={$trackingID}"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '${trackingID}');
    </script>

    <!--// End Euperia Google Analytics Plugin -->


EOT;


} 

add_action('wp_footer', 'euperia_add_google_analytics', 30);


// admin functionality

function euperia_google_analytics_admin()
{
    $serializer = new Serializer();
    $serializer->init();

    $deserializer = new Deserializer();

    $plugin = new Submenu(new Submenu_Page($deserializer));
    $plugin->init();
}

add_action('plugins_loaded', 'euperia_google_analytics_admin');
