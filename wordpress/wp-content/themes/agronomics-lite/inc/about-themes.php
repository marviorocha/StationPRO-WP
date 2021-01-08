<?php
/**
 *Agronomics Lite About Theme
 *
 * @package Agronomics Lite
 */

//about theme info
add_action( 'admin_menu', 'agronomics_lite_abouttheme' );
function agronomics_lite_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'agronomics-lite'), __('About Theme Info', 'agronomics-lite'), 'edit_theme_options', 'agronomics_lite_guide', 'agronomics_lite_mostrar_guide');   
} 

//Info of the theme
function agronomics_lite_mostrar_guide() { 	
?>
<div class="wrap-GT">
	<div class="gt-left">
   		   <div class="heading-gt">
			  <h3><?php esc_html_e('About Theme Info', 'agronomics-lite'); ?></h3>
		   </div>
          <p><?php esc_html_e('Agronomics Lite is a creative and unbounded, sophisticated and modern, colorful and youthful, beautiful and outspoken, highly customizable and readily responsive organic farm WordPress theme. This theme help you create an impressive website for agriculture, food, gardening, landscaping, lawn, organic and health stores. This amazingly flexible, fast loading and multipurpose theme well suited for fulfilling the requirement of all type of websites. It can be used to develop a website for corporate, business, portfolio, product catalog, personal blog and services web pages. You can also use it for construction, real estate, traveling, tourism websites, eCommerce ventures, hotel projects and more.','agronomics-lite'); ?></p>
<div class="heading-gt"> <?php esc_html_e('Theme Features', 'agronomics-lite'); ?></div>
 

<div class="col-2">
  <h4><?php esc_html_e('Theme Customizer', 'agronomics-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'agronomics-lite'); ?></div>
</div>

<div class="col-2">
  <h4><?php esc_html_e('Responsive Ready', 'agronomics-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'agronomics-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('Cross Browser Compatible', 'agronomics-lite'); ?></h4>
<div class="description"><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'agronomics-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('E-commerce', 'agronomics-lite'); ?></h4>
<div class="description"><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'agronomics-lite'); ?></div>
</div>
<hr />  
</div><!-- .gt-left -->
	
<div class="gt-right">			
        <div>				
            <a href="<?php echo esc_url( agronomics_lite_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'agronomics-lite'); ?></a> | 
            <a href="<?php echo esc_url( agronomics_lite_PROTHEME_URL ); ?>" target="_blank"><?php esc_html_e('Purchase Pro', 'agronomics-lite'); ?></a> | 
            <a href="<?php echo esc_url( agronomics_lite_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'agronomics-lite'); ?></a>
        </div>		
</div><!-- .gt-right-->
<div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>