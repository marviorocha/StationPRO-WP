<?php

/*
Plugin Name: Google Analytics
Plugin URI: https://www.xtraorbit.com/wordpress-google-analytics-dashboard-widget/
Description: Full width Google Analytics dashboard widget for Wordpress admin interface, which also inserts latest Google Analytics tracking code to your pages.
Version: 2.0.2
Author: Amr M. Ibrahim
Author URI: https://www.xtraorbit.com/
License: GPL2
*/

define ("lrgawidget_plugin_version", "2.0.2");
define ("lrgawidget_plugin_scripts_version", "202");
define ("lrgawidget_plugin_prefiex", "lrgalite-");
define ("lrgawidget_plugin_dist_dir", plugin_dir_url( __FILE__ ).'dist/');
define ("lrgawidget_plugin_plugins_dir", plugin_dir_url( __FILE__ ).'dist/plugins/');

global $wpdb;
define ("lrgawidget_plugin_table", $wpdb->base_prefix . 'lrgawidget_global_settings');

register_activation_hook(__FILE__,'lrgawidget_activate');
register_uninstall_hook(__FILE__, 'lrgawidget_uninstall' );
add_action( 'admin_enqueue_scripts', 'lrgawidget_enqueue',1000 );
add_action( 'wp_ajax_lrgawidget_hideShowWidget', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getAuthURL', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getAccessToken', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getProfiles', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_setProfileID', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_settingsReset', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getSessions', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getBrowsers', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getLanguages', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getOS', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getDevices', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getScreenResolution', 'lrgawidget_callback' );
add_action( 'wp_ajax_lrgawidget_getPages', 'lrgawidget_callback' );

add_action( 'wp_head', 'lrgawidget_ga_code');

function lrgawidget_enqueue($hook) {
    if ( 'index.php' != $hook || !current_user_can('manage_options')) {
        return;
    }
	$user_id = get_current_user_id();
	$wstate = get_user_option( 'lrgawidget_hideShowWidget', $user_id );	
	
	if ($wstate !== "hide"){
		wp_enqueue_style( lrgawidget_plugin_prefiex.'lrgawidget', plugin_dir_url( __FILE__ ).'dist/css/'.lrgawidget_plugin_prefiex.'main.css'  ,array(),lrgawidget_plugin_scripts_version);
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( lrgawidget_plugin_prefiex.'main', plugin_dir_url( __FILE__ ).'dist/js/'.lrgawidget_plugin_prefiex.'main.js' ,array('jquery'),lrgawidget_plugin_scripts_version,true);
		wp_localize_script( lrgawidget_plugin_prefiex.'main', 'lrgawidget_ajax_object', array( 'lrgawidget_ajax_url' => admin_url( 'admin-ajax.php' ) ));	
		add_action( 'admin_notices', 'lrga_welcome_panel' );
	}else{
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( lrgawidget_plugin_prefiex.'main', plugin_dir_url( __FILE__ ).'dist/js/lrgawidget_control.js' ,array('jquery'),lrgawidget_plugin_scripts_version);
		wp_localize_script( lrgawidget_plugin_prefiex.'main', 'lrgawidget_ajax_object', array( 'lrgawidget_ajax_url' => admin_url( 'admin-ajax.php' ) ));
	}
}



function lrgawidget_internal_permissions(){
	$parray = array();
	$globalWidgetPermissions = array("lrgawidget_perm_admin",
									 "lrgawidget_perm_sessions",
									 "lrgawidget_perm_browsers",
									 "lrgawidget_perm_languages",
									 "lrgawidget_perm_os",
									 "lrgawidget_perm_devices",
									 "lrgawidget_perm_screenres",
									 "lrgawidget_perm_pages",
									 "lrgawidget_perm_promo");	 
	$parray["permissions"] = $globalWidgetPermissions;
	return $parray;
}

function lrgawidget_callback() {
	global $wpdb;
	$user_id = get_current_user_id();
	$lrperm = lrgawidget_internal_permissions();
	$lrdata = $_POST;
	$modifiedAction = explode("_", $lrdata['action']);
	$lrdata['action'] = $modifiedAction[1];

	if ($lrdata['action'] == "setProfileID"){
		if ( (isset($lrdata['enable_universal_tracking'])) && !empty($lrdata['property_id'])){
			update_option('lrgawidget_property_id', $lrdata['property_id']);
		}else{
			delete_option('lrgawidget_property_id');
		}
	}
	if ($lrdata['action'] == "settingsReset"){
		delete_option('lrgawidget_property_id');
	}
	
	if ($lrdata['action'] == "hideShowWidget"){
		update_user_option( $user_id, 'lrgawidget_hideShowWidget', $lrdata['wstate'] );
		lrgawidget_jsonOutput();
	};
	
	
	require (dirname(__FILE__).'/core/lrgawidget.handler.php');
}

function lrgawidget_jsonOutput(){
	header('Content-Type: application/json');
	$output['status'] = "done";
	echo json_encode($output);	
	exit();
}

function lrga_welcome_panel() {
	$actLrgaTabs= array(); 
	$lrperm = lrgawidget_internal_permissions();
	$globalWidgetPermissions = $lrperm['permissions']; 
	require_once (dirname(__FILE__).'/widgets/lrgawidget.php');
}
 
function lrgawidget_ga_code(){
	$lrgawidget_property_id = get_option('lrgawidget_property_id',"");
	if (!current_user_can('edit_posts') &&  !empty($lrgawidget_property_id) ) {
?>

<!-- Google Analytics by Lara - https://www.xtraorbit.com/wordpress-google-analytics-dashboard-widget/ -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $lrgawidget_property_id ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $lrgawidget_property_id ?>', { 'anonymize_ip': true });
</script>
	
<?php
	}
	
} 

function lrgawidget_activate() {
  	global $wpdb;
	if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die('<p>'.sprintf('This plugin can not be activated because it requires a PHP version greater than <b>5.3.0</b>.<br>You are currently using PHP <b>%1$s</b>.<br><br>Your PHP version can be updated by your hosting company.',PHP_VERSION).'</p><a href="'. admin_url('plugins.php').'">Go back</a>');
	}else{
		$sql = "CREATE TABLE IF NOT EXISTS `".lrgawidget_plugin_table."` (`id` int(10) NOT NULL AUTO_INCREMENT, `name` TEXT NOT NULL, `value` TEXT NOT NULL, PRIMARY KEY (`id`))";
		$wpdb->query($sql);
	}
}

function lrgawidget_uninstall() {
   	global $wpdb;
	$sql = "DROP TABLE `".lrgawidget_plugin_table."`";
	$wpdb->query($sql);
	delete_option('lrgawidget_property_id');
}
?>