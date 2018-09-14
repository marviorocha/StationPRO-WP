<?php

if ( !defined( 'ABSPATH' ) ) {
    die;
}
// Cannot access pages directly.
/**
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Station Pro - Easy Web Radio in Wordpress - by marviorocha.com
 *
 *
 * Plugin Name: Station PRO (Premium)
 * Plugin URI: http://marviorocha.com/stationpro
 * Tags: streaming, shoutcast, icacast, radio, live streaming, web radio, online radio, automation online, station, on ar, comunication, player, html5 player
 * Author: Marvio Rocha <marviorocha@marviorocha.com>
 * Author URI: http://marviorocha.com/
 * Version: 2.1.8
 * Description:  The Station PRO is plugin to automation web radio SHOUTcast or Icecast. With responsive and custom player for your wordpress site.
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: station-pro
 * @fs_premium_only /lib/functions.php, /premium-files/
 * ------------------------------------------------------------------------------------------------
 *
 * Copyright 2017 Marvio Rocha <marviorocha@marviorocha.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * ------------------------------------------------------------------------------------------------
 *
 */

if ( !function_exists( 'stationpro' ) ) {
    // ------------------------------------------------------------------------------------------------
    require_once plugin_dir_path( __FILE__ ) . '/cs-framework-path.php';
    // ------------------------------------------------------------------------------------------------
    
    if ( !function_exists( 'cs_framework_init' ) && !class_exists( 'CSFramework' ) ) {
        function cs_framework_init()
        {
            // active modules
            defined( 'CS_ACTIVE_FRAMEWORK' ) or define( 'CS_ACTIVE_FRAMEWORK', true );
            defined( 'CS_ACTIVE_METABOX' ) or define( 'CS_ACTIVE_METABOX', true );
            defined( 'CS_ACTIVE_TAXONOMY' ) or define( 'CS_ACTIVE_TAXONOMY', true );
            defined( 'CS_ACTIVE_SHORTCODE' ) or define( 'CS_ACTIVE_SHORTCODE', true );
            defined( 'CS_ACTIVE_CUSTOMIZE' ) or define( 'CS_ACTIVE_CUSTOMIZE', true );
            defined( 'CS_ACTIVE_LIGHT_THEME' ) or define( 'CS_ACTIVE_LIGHT_THEME', false );
            // helpers
            cs_locate_template( 'functions/deprecated.php' );
            cs_locate_template( 'functions/fallback.php' );
            cs_locate_template( 'functions/helpers.php' );
            cs_locate_template( 'functions/actions.php' );
            cs_locate_template( 'functions/enqueue.php' );
            cs_locate_template( 'functions/sanitize.php' );
            cs_locate_template( 'functions/validate.php' );
            // classes
            cs_locate_template( 'classes/abstract.class.php' );
            cs_locate_template( 'classes/options.class.php' );
            cs_locate_template( 'classes/framework.class.php' );
            cs_locate_template( 'classes/metabox.class.php' );
            cs_locate_template( 'classes/taxonomy.class.php' );
            cs_locate_template( 'classes/shortcode.class.php' );
            cs_locate_template( 'classes/customize.class.php' );
            cs_locate_template( 'classes/navbar.class.php' );
            cs_locate_template( 'classes/scripts.class.php' );
            // configs
            cs_locate_template( 'config/framework.config.php' );
            cs_locate_template( 'config/metabox.config.php' );
            cs_locate_template( 'config/taxonomy.config.php' );
            cs_locate_template( 'config/shortcode.config.php' );
            cs_locate_template( 'config/customize.config.php' );
        }
        
        add_action( 'init', 'cs_framework_init', 10 );
    }
    
    /**
     * Fremiuns Settings Player
     */
    // Create a helper function for easy SDK access.
    function stationpro()
    {
        global  $stationpro ;
        
        if ( !isset( $stationpro ) ) {
            // Activate multisite network integration.
            if ( !defined( 'WP_FS__PRODUCT_981_MULTISITE' ) ) {
                define( 'WP_FS__PRODUCT_981_MULTISITE', true );
            }
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $stationpro = fs_dynamic_init( array(
                'id'               => '1047',
                'slug'             => 'station-pro',
                'type'             => 'plugin',
                'public_key'       => 'pk_7e44969a6c07ed0649c307b2d5e3f',
                'is_live'          => true,
                'is_premium'       => true,
                'has_addons'       => false,
                'has_paid_plans'   => true,
                'is_org_compliant' => true,
                'menu'             => array(
                'slug'       => 'station-pro',
                'first-path' => 'admin.php?page=station-pro&welcome-messager=true',
                'support'    => false,
                'network'    => true,
                'parent'     => array(
                'slug' => 'station-pro',
            ),
            ),
            ) );
        }
        
        return $stationpro;
    }
    
    // Init Freemius.
    stationpro();
    // Signal that SDK was initiated.
    do_action( 'stationpro_loaded' );
    global  $stationpro ;
    $stationpro->get_account_url();
    function stationpro_settings_url()
    {
        return admin_url( 'admin.php?page=station-pro' );
    }
    
    stationpro()->add_filter( 'connect_url', 'stationpro_settings_url' );
    stationpro()->add_filter( 'after_skip_url', 'stationpro_settings_url' );
    stationpro()->add_filter( 'after_connect_url', 'stationpro_settings_url' );
    stationpro()->add_filter( 'after_pending_connect_url', 'stationpro_settings_url' );
    stationpro()->add_action( 'after_uninstall', 'stationpro_uninstall_cleanup' );
    // End Fremiuns Settings
    // titan framework
    // Check whether the Titan Framework plugin is activated, and notify if it isn't
    // require_once( 'titan/titan-framework-checker.php' );
    require_once 'titan/titan-framework-embedder.php';
    add_action( 'tf_create_options', 'my_theme_create_options' );
    // Register Custom Post Type
    function station_casting()
    {
        $labels = array(
            'name'                  => _x( 'Podcast', 'Post Type General Name', 'default' ),
            'singular_name'         => _x( 'Podcast', 'Post Type Singular Name', 'default' ),
            'menu_name'             => __( 'PodStation', 'default' ),
            'name_admin_bar'        => __( 'PodStation', 'default' ),
            'archives'              => __( 'Item Archives', 'default' ),
            'attributes'            => __( 'Item Attributes', 'default' ),
            'parent_item_colon'     => __( 'Parent Item:', 'default' ),
            'all_items'             => __( 'All Items', 'default' ),
            'add_new_item'          => __( 'Add New Item', 'default' ),
            'add_new'               => __( 'Add New', 'default' ),
            'new_item'              => __( 'New Item', 'default' ),
            'edit_item'             => __( 'Edit Item', 'default' ),
            'update_item'           => __( 'Update Item', 'default' ),
            'view_item'             => __( 'View Item', 'default' ),
            'view_items'            => __( 'View Items', 'default' ),
            'search_items'          => __( 'Search Item', 'default' ),
            'not_found'             => __( 'Not found', 'default' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'default' ),
            'featured_image'        => __( 'Featured Image', 'default' ),
            'set_featured_image'    => __( 'Set featured image', 'default' ),
            'remove_featured_image' => __( 'Remove featured image', 'default' ),
            'use_featured_image'    => __( 'Use as featured image', 'default' ),
            'insert_into_item'      => __( 'Insert into item', 'default' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'default' ),
            'items_list'            => __( 'Items list', 'default' ),
            'items_list_navigation' => __( 'Items list navigation', 'default' ),
            'filter_items_list'     => __( 'Filter items list', 'default' ),
        );
        $args = array(
            'label'               => __( 'Podcast', 'default' ),
            'description'         => __( 'Podcast Station Pro', 'default' ),
            'labels'              => $labels,
            'supports'            => array( 'title' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 23,
            'menu_icon'           => 'dashicons-playlist-audio',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'rewrite'             => array(
            'slug' => 'podstation',
        ),
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        register_post_type( 'station_post', $args );
    }
    
    if ( stationpro()->is__premium_only() ) {
        if ( stationpro()->can_use_premium_code() ) {
            add_action( 'init', 'station_casting', 0 );
        }
    }
    /**
     * Fremiuns Settings to plugins
     */
    function stationpro_custom_connect_message_on_update(
        $message,
        $user_first_name,
        $plugin_title,
        $user_login,
        $site_link,
        $freemius_link
    )
    {
        return sprintf(
            __( 'Hey %1$s' ) . ',<br>' . __( 'Please help us improve %2$s! If you opt-in, some data about your usage of %2$s will be sent to %5$s. If you skip this, that\'s okay! %2$s will still work just fine.', 'station-pro' ),
            $user_first_name,
            '<b>' . $plugin_title . '</b>',
            '<b>' . $user_login . '</b>',
            $site_link,
            $freemius_link
        );
    }
    
    stationpro()->add_filter(
        'connect_message_on_update',
        'stationpro_custom_connect_message_on_update',
        10,
        6
    );
    function my_theme_create_options()
    {
        // Initialize Titan with my special unique namespace
        $titan = TitanFramework::getInstance( 'my-theme' );
        // Create my admin panel
        $panel = $titan->createAdminPanel( array(
            'name'     => 'Station Pro',
            'icon'     => 'dashicons-microphone',
            'position' => 21,
        ) );
        // Admin Geral Tabs
        $adminPanel = $panel->createAdminPanel( array(
            'name' => 'Settings',
        ) );
        $general = $adminPanel->createTab( array(
            'name' => 'Radio Genaral',
        ) );
        $style = $adminPanel->createTab( array(
            'name' => 'Style',
        ) );
        /**
         * Painel Home Station Pro
         */
        function btn_buy()
        {
            if ( stationpro()->is_not_paying() ) {
                return '<a class="button button-primary button.button-large button-hero load-customize hide-if-no-customize"
    href="' . stationpro()->get_upgrade_url() . '">  <span class="dashicons dashicons-cart"></span> Get Now Premium Version</a>
   ';
            }
        }
        
        // backend welcome
        $panel->createOption( [
            'type'   => 'custom',
            'custom' => '<div id="welcome-panel" class="welcome-panel">
    <input type="hidden" id="welcomepanelnonce" name="welcomepanelnonce" value="37dba816f3">
      <div class="welcome-panel-content">
  <h1>Welcome to Station Pro!</h1>
  <p class="about-description">For all the listeners of your radio station:</p>
  <div class="welcome-panel-column-container">
  <div class="welcome-panel-column">
          <p>
' . btn_buy() . '
       </p>
      </div>
  <div class="welcome-panel-column">
    <h3>Featured of premium</h3>
    <ul>
          <li class="welcome-icon dashicons-format-video">Custom Player</li>
          <li class="welcome-icon dashicons-format-gallery"> Transparent Player</li>
          <li class="welcome-icon dashicons-playlist-audio">PodStation</li>
    </ul>
  </div>
  <div class="welcome-panel-column welcome-panel-last">
    <h3></h3>
    <ul>
          <li><div class="welcome-icon dashicons-controls-volumeon">Support <a target="_blank" href="http://icecast.org/">icecast</a> or <a target="_blank" href="https://www.shoutcast.com/">shoutcast</a></div></li>

          <li class="welcome-icon dashicons-update">Recurrent Update</li>
    </ul>
  </div>
  </div>
  </div>
    </div>
',
        ] );
        $panel->createOption( [
            'type'   => 'custom',
            'custom' => ' <h1>Getting started</h1>
Take a look in the settigns of the Customizer and see yourself how easy and quick to customize your radio player as you wish.
  <table style="width:100%; height:100%;"><tr>

  <tr>

  <td >  <a title="Get now NinjaWP" target="_blank" href="http://bit.ly/2xwN3YC">
     <img src="https://i.imgur.com/Kr6LYbt.png?1" alt="Free Multi-Purpose WordPress Theme">
   </a> </td>
  <td > <a title="Upgrade Station Pro Premium" target="_blank" href="' . stationpro()->get_upgrade_url() . '">
     <img src="https://i.imgur.com/NgdR1s3.jpg?1" alt="Free Multi-Purpose WordPress Theme">
   </a></td>
  <td> </td>
  </tr></table>
  </div>',
        ] );
        /**
         * Geral Tabs Settings
         */
        $general->createOption( [
            'name' => 'Logo Or Your Picture',
            'id'   => 'image_logo',
            'type' => 'upload',
            'desc' => __( 'Put in player your pic or logo 180px x180px', 'default' ),
        ] );
        $general->createOption( [
            'name'  => 'DJ Name Or Radio Name',
            'id'    => 'dj_name',
            'type'  => 'text',
            'label' => __( 'Perform It!', 'default' ),
        ] );
        $general->createOption( array(
            'name'        => 'Shoutcast URL',
            'id'          => 'shoutcast',
            'type'        => 'text',
            'placeholder' => 'http://mystreaming.com:8080',
            'desc'        => 'Leave it blank if use the streaming below',
        ) );
        $general->createOption( array(
            'name' => 'Icecast URL',
            'id'   => 'icecast',
            'type' => 'text',
            'desc' => 'Leave it blank if use the shoutcast',
        ) );
        $general->createOption( array(
            'name'    => 'Auto Play',
            'id'      => 'auto_play',
            'type'    => 'enable',
            'default' => false,
            'desc'    => __( 'If it enabled you load the player with song the your radio' ),
        ) );
        if ( stationpro()->is__premium_only() ) {
            if ( stationpro()->can_use_premium_code() ) {
                $general->createOption( array(
                    'name'    => 'Brand Station Pro',
                    'id'      => 'brand',
                    'type'    => 'enable',
                    'default' => true,
                    'desc'    => __( 'If it enabled it display brand Station Pro in player' ),
                ) );
            }
        }
        if ( stationpro()->is_not_paying() ) {
            $general->createOption( array(
                'name'    => 'Brand Station Pro',
                'id'      => 'brand',
                'type'    => 'radio',
                'options' => array(
                '1' => 'If it enabled it display brand Station Pro in player',
            ),
            ) );
        }
        $general->createOption( array(
            'type' => 'save',
        ) );
        /**
         * Style Tabs
         */
        if ( stationpro()->is_not_paying() ) {
            $style->createOption( array(
                'name'    => 'My Player Style',
                'id'      => 'color_player',
                'type'    => 'radio-palette',
                'desc'    => 'Choose a style for your player',
                'options' => array( array(
                "#2196f3",
                "#1e88e5",
                "#1976d2",
                "#1565c0",
                "#0d47a1"
            ) ),
                'default' => 0,
            ) );
        }
        if ( stationpro()->is__premium_only() ) {
            if ( stationpro()->can_use_premium_code() ) {
                $style->createOption( array(
                    'name'    => 'My Player Style',
                    'id'      => 'color_player',
                    'type'    => 'radio-palette',
                    'desc'    => 'Choose a style for your player',
                    'options' => array(
                    array(
                    "#2196f3",
                    "#1e88e5",
                    "#1976d2",
                    "#1565c0",
                    "#0d47a1"
                ),
                    array(
                    "#f44336",
                    "#e53935",
                    "#d32f2f",
                    "#c62828",
                    "#b71c1c"
                ),
                    array(
                    "#9c27b0",
                    "#8e24aa",
                    "#7b1fa2",
                    "#6a1b9a",
                    "#4a148c"
                ),
                    array(
                    "#009688",
                    "#00897b",
                    "#00796b",
                    "#00695c",
                    "#004d40"
                ),
                    array(
                    "#ffeb3b",
                    "#fdd835",
                    "#fbc02d",
                    "#f9a825",
                    "#f57f17"
                ),
                    array(
                    "#795548",
                    "#6d4c41",
                    "#5d4037",
                    "#4e342e",
                    "#3e2723"
                ),
                    array(
                    "#ec407a",
                    "#e91e63",
                    "#d81b60",
                    "#ff4081",
                    "#f50057"
                ),
                    array(
                    "#9e9e9e",
                    "#757575",
                    "#616161",
                    "#424242",
                    "#212121"
                )
                ),
                    'default' => 0,
                ) );
            }
        }
        if ( stationpro()->is__premium_only() ) {
            if ( stationpro()->can_use_premium_code() ) {
                $style->createOption( array(
                    'name'    => 'Player Layout above and below',
                    'id'      => 'layout_player',
                    'options' => array(
                    '1' => 'The Player is Fixed in <b>Header</b> the website',
                    '2' => 'The Player is Fixed in <b>Footer</b> the website',
                ),
                    'type'    => 'radio',
                    'desc'    => 'Select player for layout',
                    'default' => '2',
                ) );
            }
        }
        if ( stationpro()->is_not_paying() ) {
            $style->createOption( array(
                'name'    => 'Player Layout above and below',
                'id'      => 'layout_player',
                'options' => array(
                '2' => 'The Player is Fixed in <b>Footer</b> the website',
            ),
                'type'    => 'radio',
                'desc'    => 'Select player for layout',
                'default' => '2',
            ) );
        }
        $style->createOption( array(
            'type' => 'save',
        ) );
    }

}

// end function my plugins freemius -->