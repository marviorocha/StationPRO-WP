<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Night Club Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
<a class="skip-link screen-reader-text" href="#tabnavigator">
<?php esc_html_e( 'Skip to content', 'night-club-lite' ); ?>
</a>
<?php
$night_club_lite_show_frontpageslider_section 	       = esc_attr( get_theme_mod('night_club_lite_show_frontpageslider_section', false) );
$night_club_lite_show_4circle_sections    = esc_attr( get_theme_mod('night_club_lite_show_4circle_sections', false) );
?>
<div id="templatelayout" <?php if( get_theme_mod( 'night_club_lite_boxlayoutoptions' ) ) { echo 'class="boxlayout"'; } ?>>
<?php
if ( is_front_page() && !is_home() ) {
	if( !empty($night_club_lite_show_frontpageslider_section)) {
	 	$inner_cls = '';
	}
	else {
		$inner_cls = 'siteinner';
	}
}
else {
$inner_cls = 'siteinner';
}
?>

<div class="site-header <?php echo esc_attr($inner_cls); ?> ">   
 <div class="container"> 
     <div class="logo">    
           <?php night_club_lite_the_custom_logo(); ?>
            <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
     </div><!-- logo --> 
  
     <div id="mainnavigator">       
		   <button class="menu-toggle" aria-controls="main-navigation" aria-expanded="false" type="button">
			<span aria-hidden="true"><?php esc_html_e( 'Menu', 'night-club-lite' ); ?></span>			
            <span class="dashicons" aria-hidden="true"></span>
		   </button>

		  <nav id="main-navigation" class="site-navigation primary-navigation" role="navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container' => 'ul',
				'menu_id' => 'primary',
				'menu_class' => 'primary-menu menu',
			) );
			?>
		  </nav><!-- .site-navigation -->
	    </div><!-- #mainnavigator -->
       <div class="clear"></div>       
  </div><!-- .container --> 
</div><!--.site-header --> 
 
<?php 
if ( is_front_page() && !is_home() ) {
if($night_club_lite_show_frontpageslider_section != '') {
	for($i=1; $i<=3; $i++) {
	  if( get_theme_mod('night_club_lite_frontslide'.$i,false)) {
		$slider_Arr[] = absint( get_theme_mod('night_club_lite_frontslide'.$i,true));
	  }
	}
?> 
<div class="frontslider-sections">              
<?php if(!empty($slider_Arr)){ ?>
<div id="slider" class="nivoSlider">
<?php 
$i=1;
$slidequery = new WP_Query( array( 'post_type' => 'page', 'post__in' => $slider_Arr, 'orderby' => 'post__in' ) );
while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
?>
<?php if(!empty($image)){ ?>
<img src="<?php echo esc_url( $image ); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php }else{ ?>
<img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider-default.jpg" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php } ?>
<?php $i++; endwhile; ?>
</div>   

<?php 
$j=1;
$slidequery->rewind_posts();
while( $slidequery->have_posts() ) : $slidequery->the_post(); ?>                 
    <div id="slidecaption<?php echo esc_attr( $j ); ?>" class="nivo-html-caption">         
    	<h2><?php the_title(); ?></h2>
    	<?php the_excerpt(); ?>
		<?php
        $night_club_lite_frontslidebutton = get_theme_mod('night_club_lite_frontslidebutton');
        if( !empty($night_club_lite_frontslidebutton) ){ ?>
            <a class="slide_morebtn" href="<?php the_permalink(); ?>"><?php echo esc_html($night_club_lite_frontslidebutton); ?></a>
        <?php } ?>                  
    </div>   
<?php $j++; 
endwhile;
wp_reset_postdata(); ?>   
<?php } ?>
 </div><!-- .frontslider-sections -->    
<?php } } ?>

        
<?php if ( is_front_page() && ! is_home() ) { ?>
   <?php if( $night_club_lite_show_4circle_sections != ''){ ?> 
   <section id="frontpage_services_panel">
      <div class="bottom-shadow-top">
         <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
         width="1400.000000pt" height="129.000000pt" viewBox="0 0 1400.000000 129.000000"
         preserveAspectRatio="xMidYMid meet">
        <g transform="translate(0.000000,129.000000) scale(0.100000,-0.100000)"
        fill="#ffffff" stroke="none">
        <path d="M13972 1207 c-62 -223 -208 -422 -415 -568 -152 -106 -394 -205 -626
        -253 -250 -53 -326 -59 -816 -64 -2115 -20 -6590 323 -11531 883 -314 36 -574
        65 -578 65 -3 0 -6 -286 -6 -635 l0 -635 7000 0 7000 0 0 645 c0 355 -1 645
        -2 645 -2 0 -13 -37 -26 -83z"/>
        </g>
        </svg>
  </div><!-- bottom-shadow-top -->
     <div class="container">        
      <?php
        $night_club_lite_services_section_title = get_theme_mod('night_club_lite_services_section_title');
        if( !empty($night_club_lite_services_section_title) ){ ?>
            <h2 class="servicestitle"><?php echo esc_html($night_club_lite_services_section_title); ?></h2>
        <?php } ?>
         
               <?php 
                for($n=1; $n<=4; $n++) {    
                if( get_theme_mod('night_club_lite_4circle_col'.$n,false)) {      
                    $queryvar = new WP_Query('page_id='.absint(get_theme_mod('night_club_lite_4circle_col'.$n,true)) );		
                    while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>     
                    <div class="column4circle_box <?php if($n % 4 == 0) { echo "last_column"; } ?>">                                                      
                        <?php if(has_post_thumbnail() ) { ?>
                        <div class="srviconbox"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>        
                        <?php } ?>
                        <div class="short_content_col">              	
                          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> 
                          <?php the_excerpt(); ?>                                              
                         </div>                                           
                    </div>
                    <?php endwhile;
                    wp_reset_postdata();                                  
                } } ?>                                 
            <div class="clear"></div>       
      </div><!-- .container -->
    </section><!-- #frontpage_services_panel -->
  <?php } ?>
<?php } ?>