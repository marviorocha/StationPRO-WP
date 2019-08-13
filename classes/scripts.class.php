<?php

/*
Loading css style
*/



function player_script() {

     wp_enqueue_style( 'materialize-icon',  plugins_url('station-pro') . '/lib/player/css/podcast.min.css');
 

 }

add_action('wp_print_styles', 'player_script');

/*
Loading js
*/

// Register Script
 // Register Script

 // Register Script
 
 
function wpdocs_theme_name_scripts() {
     
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js", array(), '3.1.1' );
    wp_register_script( 'materialize', "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.js", array(), '6546578' );
    wp_enqueue_script('wevesurf', '//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/2.0.5/wavesurfer.min.js', array(), '987653', true);
     wp_enqueue_script( 'podcast', plugins_url('station-pro') . '/lib/player/js/podcast.js', array('jquery'), '987654', true );
  
 
 }
 add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );



?>
