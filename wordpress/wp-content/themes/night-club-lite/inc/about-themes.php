<?php
/**
 * Night Club Lite About Theme
 *
 * @package Night Club Lite
 */

//about theme info
add_action( 'admin_menu', 'night_club_lite_abouttheme' );
function night_club_lite_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'night-club-lite'), __('About Theme Info', 'night-club-lite'), 'edit_theme_options', 'night_club_lite_guide', 'night_club_lite_mostrar_guide');   
} 

//Info of the theme
function night_club_lite_mostrar_guide() { 	
?>
<div class="wrap-GT">
	<div class="gt-left">
   		<div class="heading-gt">
		 <h3><?php esc_html_e('About Theme Info', 'night-club-lite'); ?></h3>
		</div>
       <p><?php esc_html_e('Night Club Lite is a fantastic and versatile music streaming WordPress theme for the nightclubs and music industry. It is specially developed for the music bands, orchestra, radio stations, festival event, artists, restaurants and bars, DJ websites and entertainment sites. With its extremely clean and futuristic design, this theme is mainly focused on the underground music and nightclub scene.', 'night-club-lite'); ?></p>
<div class="heading-gt"> <?php esc_html_e('Theme Features', 'night-club-lite'); ?></div>
 

<div class="col-2">
  <h4><?php esc_html_e('Theme Customizer', 'night-club-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'night-club-lite'); ?></div>
</div>

<div class="col-2">
  <h4><?php esc_html_e('Responsive Ready', 'night-club-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'night-club-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('Cross Browser Compatible', 'night-club-lite'); ?></h4>
<div class="description"><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'night-club-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('E-commerce', 'night-club-lite'); ?></h4>
<div class="description"><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'night-club-lite'); ?></div>
</div>
<hr />  
</div><!-- .gt-left -->
	
<div class="gt-right">    
     <a href="http://www.gracethemesdemo.com/night-club/" target="_blank"><?php esc_html_e('Live Demo', 'night-club-lite'); ?></a> | 
     <a href="http://www.gracethemesdemo.com/documentation/night-club/#homepage-lite" target="_blank"><?php esc_html_e('Documentation', 'night-club-lite'); ?></a>    
</div><!-- .gt-right-->
<div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>