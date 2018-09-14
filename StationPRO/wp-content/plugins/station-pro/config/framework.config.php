<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
//
// $settings           = array(
//  'menu_title'      => 'Station Pro',
//  'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
//  'menu_slug'       => 'station-pro',
//  'menu_icon'       =>  'dashicons-microphone',
//  'menu_position'   => 20,
//  'ajax_save'       => true,
//  'show_reset_all'  => false,
//  'framework_title' => 'Station Pro <small>by Marvio Rocha</small>',
// );



$settings = [
'menu_title'        => 'Integrations',
'menu_type'         => 'submenu',
'menu_parent'       => 'station-pro', // <-------
  'menu_slug'       => 'integrations',
  'ajax_save'       => false,
  'show_reset_all'  => false,
  'framework_title' => 'Station Pro <small>by Marvio Rocha</small>'

];

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

// ----------------------------------------
// a option section for options overview  -
// ----------------------------------------

// ------------------------------
// Welcome Player                      -
// ------------------------------

$options[] = [
'name'   => 'shoutcast',
'title'  => 'Shoutcast API (beta)',
'icon'   => 'fa fa-bolt',
'fields' => [

 /* Welcome Player Content */
array(
  'type'     => 'heading',
  'content'  => 'Shoutcast API',
),


 array(
  'type'    => 'content',
  'content' => "Shoutcast's comming soon!",
),


], // End fields Shoutcast
];


/**
 *  Icecast API
 */


 $options[] = [
 'name'   => 'icecast',
 'title'  => 'Icecast API',
 'icon'   => 'fa fa-music',
 'fields' => [

  /* Welcome Player Content */
  array(
    'type'     => 'heading',
    'content'  => 'Icecast API',
  ),
  
  array(
   'type'    => 'content',
   'content' => "It' s comming soon!",
 ),


 ], // End fields icecast
 ];



// ------------------------------
// Schedule                      -
// ------------------------------


 $options[] = [
 'name'   => 'schedule',
 'title'  => 'Schedule',
 'icon'   => 'fa fa-calendar',
 'fields' => [

  /* Welcome Player Content */

 array(
  'type'     => 'heading',
  'content'  => 'Display schedule by Teamup in your radio',
),

// schendule content

array(
  'type'     => 'content',
  'content'  => '<p style="padding:3px"><img src="https://www.teamup.com/wp-content/themes/g5_teamup/images/logo.png"  alt="Teamup"></p>Teamup simplifies how groups share plans, schedule events, and communicate statuses. Color-code calendars for team members, jobs, projects, and bookable resources. Centrally managed with highly customizable role-specific access permissions. 
    No accounts are required. <p><a target="_blank" href="https://www.teamup.com">Register Here</a></p>',
),

// schendule tutorial step one

array(
  'type'    => 'subheading',
  'content' => 'Step 1.  Copy the calendar link',
),

array(
  'type'     => 'content',
  'content'  => 'Go to your calendar Settings > Sharing (you need to be a calendar administrator to access the Settings), create a read-only link, customize it if you would like to share only selected sub-calendars.  Alternatively use an existing link as most calendars have a Reader link pre-configured in your Settings which displays all sub-calendars with the read-only permission.  Copy the link you want to use for embedding.

  ',
),


// temup url put here

array(
  'id'      => 'teamup', 
  'type'    => 'text',
  'title'   => 'Your Url:',
  'desc'    => 'Add your read mode temup url',
  'help'    => 'Get url in administration teamup',
  'default' => 'http://',
),

array(
  'type'    => 'subheading',
  'content' => 'Step 2.  Put shortcode in your page',
),

array(
  'type'     => 'content',
  'content'  => 'Create a page or post and enter the shortcode: <b> [schedule] </b> for display your schedule.',
),


 ], // End fields scahedule
 ];


// ------------------------------
// iFlayChat                       -
// ------------------------------

// $options[] = [
// 'name'   => 'chat',
// 'title'  => 'Chat',
// 'icon'   => 'fa fa-comments',
// 'fields' => [

//  /* Welcome Player Content */

//  array(
//   'type'    => 'content',
//   'content' => '',
// ),


// ], // End fields scahedule
// ];


// ------------------------------
// license                      -
// ------------------------------


CSFramework::instance( $settings, $options);
