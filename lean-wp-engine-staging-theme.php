<?php
/*
Plugin Name: Lean WP Engine Staging Theme
Plugin URI: http://leanplugins.com/lean-wp-engine-staging-theme
Description: Activates a custom theme when using viewing your site on staging at WPengine to alert you visually you are on staging not prodcution. - Upload and Activate.
Author: Lean Plugins
Version: 1.0
Author URI: http://leanplugins.com
License: GPLv2 or later.
 
Lean WP Engine Staging Theme is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Lean WP Engine Staging Theme is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Lean WP Engine Staging Theme. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

//Check if you're on WPengine Staging
if (preg_match('/.staging.wpengine.com$/', WP_SITEURL)) { 

//Load Plugin Style Sheet for Staging
function lean_wp_engine_staging_theme_style() {
    wp_enqueue_style('lean-wp-engine-staging-theme', plugins_url('lean-wp-engine-staging-theme.css', __FILE__));
}
//Add to Admin Pages
add_action('admin_enqueue_scripts', 'lean_wp_engine_staging_theme_style');
//Add to View, Edit, New Pages 
add_action( 'wp_enqueue_scripts', 'lean_wp_engine_staging_theme_style' );

//Add STAGING alert text to My Account Area in Admin Bar
add_filter( 'admin_bar_menu', 'staging_alert', 25 );

    function staging_alert( $wp_admin_bar ) {

        $my_account = $wp_admin_bar->get_node('my-account');

        $newtitle = 'STAGING | '.$my_account->title.' | STAGING';

        $wp_admin_bar->add_node( array(

            'id' => 'my-account',

            'title' => $newtitle,

        ));
    }

//Add STAGING alert text to Site Name Area in Admin Bar
add_action( 'admin_bar_menu', 'lean_modify_site_name_in_toolbar', 35 );

        function lean_modify_site_name_in_toolbar( $wp_admin_bar ) {
            if ( ! $wp_admin_bar->get_node( 'site-name' ) ) {
                return;
            }

            $siteName = $wp_admin_bar->get_node( 'site-name' );    

            $newSiteName = 'STAGING | '.$siteName->title.' | STAGING';

            $menu = array( 'id' => 'site-name', 'title' => $newSiteName );
            
            $wp_admin_bar->add_menu( $menu );
        }
    
}//END WPengine Staging Check