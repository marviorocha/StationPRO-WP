<?php
function wpdocs_theme_name_scripts() {
  
  wp_enqueue_style( 'tailwindcss', "https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" );

  
  
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
?>
<?php function player(){ ?>


  <div class="fixed w-full overscroll-y-none overscroll-x-none  bottom-0"  id="player_stationpro">
 
        <iframe id="iframe_default" class="w-full h-auto " src="<?php echo WP_PLUGIN_URL ?>/station_dev/class/player/index.php" frameborder="0">
            <p>Your browser is not supported iframe</p>
        </iframe>
    </div>
 
<?php }
add_action('wp_footer','player');
 // end player ?>