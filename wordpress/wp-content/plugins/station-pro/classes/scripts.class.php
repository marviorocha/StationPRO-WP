<?php
require_once(ABSPATH.'wp-load.php');

global $wpdb;
global $post;
/*
Loading css style
*/



function player_script() {

    //  wp_enqueue_style( 'materialize-icon',  plugins_url('station-pro') . '/lib/player/css/podcast.min.css');
 
 }

add_action('wp_print_styles', 'player_script');
 
 
 
function wpdocs_theme_name_scripts() {

 
    wp_register_script( 'Jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js', null, null, true );
    wp_enqueue_script('Jquery');     
 
 
     
}
    add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );


 
?>