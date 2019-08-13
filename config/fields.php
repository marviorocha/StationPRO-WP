<?php 

function __construct() {
    add_action( 'tf_create_options', array( $this, 'my_theme_create_options' ) );
}


function my_theme_create_options() {
    // Initialize Titan with my special unique namespace
    $titan = TitanFramework::getInstance( 'my-theme' );
   
   
   
   
   
   // Create my admin panel
    $panel = $titan->createAdminPanel( array(
    'name' => 'Station Pro',
    'icon' => 'dashicons-microphone',
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
   
   function btn_buy(){
   
     if ( stationpro()->is_not_paying() ) {
      
       return '<a class="button button-primary button.button-large button-hero load-customize hide-if-no-customize"
       href="'.stationpro()->get_upgrade_url() .'">  <span class="dashicons dashicons-cart"></span> Get Now Premium Version</a>
      ';
   }
     
   }
   
   // backend welcome
   $panel->createOption([
   'type'  => 'custom',
   'custom'   => '<div id="welcome-panel" class="welcome-panel">
       <input type="hidden" id="welcomepanelnonce" name="welcomepanelnonce" value="37dba816f3">
         <div class="welcome-panel-content">
     <h1>Welcome to Station Pro!</h1>
     <p class="about-description">For all the listeners of your radio station:</p>
     <div class="welcome-panel-column-container">
     <div class="welcome-panel-column">
             <p>
   '.btn_buy().'
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
   ]);
   
           
   $panel->createOption([
     'type' => 'custom',
     'custom' => ' <h1>Getting started</h1>
   Take a look in the settigns of the Customizer and see yourself how easy and quick to customize your radio player as you wish.
     <table style="width:100%; height:100%;"><tr>
   
     <tr>
   
     <td ><a target="_blank" href="https://oceanwp.org/?ref=272" title="OceanWP - a free Multi-Purpose WordPress theme"><img src="https://s3-us-west-2.amazonaws.com/aff-creatives/oneaff.png" alt="OceanWP - a free Multi-Purpose WordPress theme" /></a></td>
     <td > <a title="Upgrade Station Pro Premium" target="_blank" href="'. stationpro()->get_upgrade_url() .'">
        <img src="https://i.imgur.com/NgdR1s3.jpg?1" alt="Free Multi-Purpose WordPress Theme">
      </a></td>
     <td> </td>
     </tr></table>
     </div>' ,
   ]);
   
   
   /**
    * Geral Tabs Settings
    */
   
   
   $general ->createOption([
   'name'        => 'Logo Or Your Picture',
   'id'          => 'image_logo',
   'type'        => 'upload',
   'desc'        => __( 'Put in player your pic or logo 180px x180px', 'default' ),
   ]);
   
   
   $general ->createOption([
     'name'      => 'DJ Name Or Radio Name',
     'id'        => 'dj_name',
     'type'      => 'text',
     'label'     => __( 'Perform It!', 'default' ),
   ]);
   
   $general->createOption( array(
   'name'        => 'Shoutcast URL',
   'id'          => 'shoutcast',
   'type'        => 'text',
   'placeholder' => 'http://mystreaming.com:8080',
   'desc'        => 'Leave it blank if use the streaming below'
   ) );
   
   $general->createOption( array(
   'name'        => 'Icecast URL',
   'id'          => 'icecast',
   'type'        => 'text',
   'desc'        => 'Leave it blank if use the shoutcast'
   ) );
   
   $general->createOption( array(
   'name'        => 'Auto Play',
   'id'          => 'auto_play',
   'type'        => 'enable',
   'default'     => false,
   'desc'        => __('If it enabled you load the player with song the your radio'),
   ) );
   
   if ( stationpro()->is__premium_only() ) {
     if ( stationpro()->can_use_premium_code() ) {
       $general->createOption( array(
         'name'      => 'Brand Station Pro',
         'id'        => 'brand',
         'type'      => 'enable',
         'default'   => true,
         'desc'      => __('If it enabled it display brand Station Pro in player'),
         ) );
     }
   }
   
   if ( stationpro()->is_not_paying() ) {
   
     $general->createOption( array(
       'name'      => 'Brand Station Pro',
       'id'        => 'brand',
       'type'      => 'radio',
       'options' => array(
         '1' => 'If it enabled it display brand Station Pro in player',
       ),
   
       'default'   => 1,
      
        
       ) );
   
   }
   
   
     
     $general->createOption( array(
       'type'    => 'save',
       ) );
   
   
   
   /**
    * Style Tabs
    */
   
   if ( stationpro()->is_not_paying() ) {
   
     $style->createOption( array(
       'name' => 'My Player Style',
       'id' => 'color_player',
       'type' => 'radio-palette',
       'desc' => 'Choose a style for your player',
       
       'options' => array(
       
       array(
       "#2196f3",
       "#1e88e5",
       "#1976d2",
       "#1565c0",
       "#0d47a1",
       ),
       
        
       ),
       'default' => 0,
       ) );
      
     
   }
   
   
   
   if ( stationpro()->is__premium_only() ) {
     if ( stationpro()->can_use_premium_code() ) {
    $style->createOption( array(
    'name' => 'My Player Style',
    'id' => 'color_player',
    'type' => 'radio-palette',
    'desc' => 'Choose a style for your player',
    
    'options' => array(
    
    array(
    "#2196f3",
    "#1e88e5",
    "#1976d2",
    "#1565c0",
    "#0d47a1",
    ),
    
    array(
    "#f44336",
    "#e53935",
    "#d32f2f",
    "#c62828",
    "#b71c1c",
    ),
    array(
    "#9c27b0",
    "#8e24aa",
    "#7b1fa2",
    "#6a1b9a",
    "#4a148c",
    ),
    array(
    "#009688",
    "#00897b",
    "#00796b",
    "#00695c",
    "#004d40",
    ),
    array(
    "#ffeb3b",
    "#fdd835",
    "#fbc02d",
    "#f9a825",
    "#f57f17",
    ),
    array(
    "#795548",
    "#6d4c41",
    "#5d4037",
    "#4e342e",
    "#3e2723",
    ),
    array(  
    "#ec407a",
    "#e91e63",
    "#d81b60",
    "#ff4081",
    "#f50057",
    ),
    array(
    "#9e9e9e",
    "#757575",
    "#616161",
    "#424242",
    "#212121",
    )
    ),
    'default' => 0,
    ) );
   
   }
   }
   
   
   if ( stationpro()->is__premium_only() ) {
     if ( stationpro()->can_use_premium_code() ) {
       $style->createOption( array(
         'name' => 'Player Layout above and below',
         'id' => 'layout_player',
         'options' => array(
         '1' => 'The Player is Fixed in <b>Header</b> the website',
         '2' => 'The Player is Fixed in <b>Footer</b> the website',
          ),
         'type' => 'radio',
         'desc' => 'Select player for layout',
         'default' => '2',
         ) );
   
     }}
   
     if ( stationpro()->is_not_paying() ) {
   
    $style->createOption( array(
    'name' => 'Player Layout above and below',
    'id' => 'layout_player',
    'options' => array(
   
    '2' => 'The Player is Fixed in <b>Footer</b> the website',
     ),
    'type' => 'radio',
    'desc' => 'Select player for layout',
    'default' => '2',
    ) );
   
   }
   
    $style->createOption( array(
    'type' => 'save',
    ) );
   
   
    }

?>