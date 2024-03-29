<?php
if (!function_exists('stationpro')) {
    // Create a helper function for easy SDK access.
    function stationpro()
    {
        global $stationpro;

        if (!isset($stationpro)) {
            // Activate multisite network integration.
            if (!defined('WP_FS__PRODUCT_981_MULTISITE')) {
                define('WP_FS__PRODUCT_981_MULTISITE', true);
            }

            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/scripts/freemius/start.php';

            $stationpro = fs_dynamic_init(array(
                'id'                  => '981',
                'slug'                => 'station-pro',
                'type'                => 'plugin',
                'public_key'          => 'pk_7e44969a6c07ed0649c307b2d5e3f',
                'is_live'             => false,
                'is_premium'          => true,
                'premium_suffix'      => 'Station Pro (Premium)',
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'slug'           => 'station-pro',
                    'override_exact' => true,
                    'first-path'     => 'admin.php?page=station-pro&welcome-messager=true',
                    'support'        => false,
                    'network'        => true,
                    'parent'         => array(
                        'slug' => 'station-pro',
                    ),
                ),
                // Set the SDK to work in a sandbox mode (for development & testing).
                // IMPORTANT: MAKE SURE TO REMOVE SECRET KEY BEFORE DEPLOYMENT.
                'secret_key'          => 'sk_mG+^^?E>y(B#jB)}vBH6dxi[LvWY7',
            ));
        }

        return $stationpro;
    }

    // Init Freemius.
    stationpro();
    // Signal that SDK was initiated.
    do_action('stationpro_loaded');

    function stationpro_settings_url()
    {
        return admin_url('admin.php?page=station-pro&tab=activation');
    }

    stationpro()->add_filter('connect_url', 'stationpro_settings_url');
    stationpro()->add_filter('after_skip_url', 'stationpro_settings_url');
    stationpro()->add_filter('after_connect_url', 'stationpro_settings_url');
    stationpro()->add_filter('after_pending_connect_url', 'stationpro_settings_url');
    stationpro()->add_action('after_uninstall', 'stationpro_uninstall_cleanup');
}
