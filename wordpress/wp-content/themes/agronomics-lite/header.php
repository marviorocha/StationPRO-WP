<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Agronomics Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	}
?>
<a class="skip-link screen-reader-text" href="#innerpage_fixer">
<?php esc_html_e( 'Skip to content', 'agronomics-lite' ); ?>
</a>

<?php
$agronomics_lite_show_header_contact_info 	  			= get_theme_mod('agronomics_lite_show_header_contact_info', false);
$agronomics_lite_showslide_area 	  		            = get_theme_mod('agronomics_lite_showslide_area', false);
$agronomics_lite_show_3colservices_section 	  	        = get_theme_mod('agronomics_lite_show_3colservices_section', false);
$show_agronomics_lite_welcomepagebx	                    = get_theme_mod('show_agronomics_lite_welcomepagebx', false);
$agronomics_lite_show_agro2col_section 	  	            = get_theme_mod('agronomics_lite_show_agro2col_section', false);
$agronomics_lite_show_socialsection 	  			    = get_theme_mod('agronomics_lite_show_socialsection', false);
?>
<div id="sitelayout_type" <?php if( get_theme_mod( 'agronomics_lite_boxlayout' ) ) { echo 'class="boxlayout"'; } ?>>
<?php
if ( is_front_page() && !is_home() ) {
	if( !empty($agronomics_lite_showslide_area)) {
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

<div class="site-header <?php echo esc_attr($inner_cls); ?>">      
<div class="container">  
     <div class="logo">
        <?php agronomics_lite_the_custom_logo(); ?>
           <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div><!-- logo -->
       <div class="header_contactinfo_area">
		<?php if(!dynamic_sidebar('headerinfowidget')): ?>        
            <?php if( $agronomics_lite_show_header_contact_info != ''){ ?>      
               <?php 
               $agronomics_lite_header_address = get_theme_mod('agronomics_lite_header_address');
               if( !empty($agronomics_lite_header_address) ){ ?> 
                <div class="infobox">
                 <i class="fas fa-map-marker-alt"></i>
                 <span><b class="addbx"><?php esc_html_e('Office Address','agronomics-lite'); ?></b>
				 <?php echo esc_html($agronomics_lite_header_address); ?></span>
                </div>
               <?php } ?>
               
               <?php 
               $agronomics_lite_header_contactno = get_theme_mod('agronomics_lite_header_contactno');
               if( !empty($agronomics_lite_header_contactno) ){ ?> 
                <div class="infobox">
                 <i class="fas fa-phone"></i>
                 <span><b class="addbx"><?php esc_html_e('Call us toll free','agronomics-lite'); ?></b>
				 <?php echo esc_html($agronomics_lite_header_contactno); ?></span>
                </div>
               <?php } ?> 
               
               <?php 
               $agronomics_lite_header_workinghours = get_theme_mod('agronomics_lite_header_workinghours');
               if( !empty($agronomics_lite_header_workinghours) ){ ?> 
                <div class="infobox">
                 <i class="far fa-clock"></i>
                 <span><b class="addbx"><?php esc_html_e('Working Hours','agronomics-lite'); ?></b>
				 <?php echo esc_html($agronomics_lite_header_workinghours); ?></span>
                </div>
               <?php } ?> 
                                          
           <?php } ?>     
      <?php endif; ?>
          
        </div><!--.header_contactinfo_area -->
      <div class="clear"></div>  
 
  </div><!-- .container -->  
  </div><!--.site-header --> 
  
  <div class="header-navigation">
   	 <div class="container">
     	<div class="toggle">
         <a class="toggleMenu" href="#"><?php esc_html_e('Menu','agronomics-lite'); ?></a>
       </div><!-- toggle --> 
       <div class="sitenav">                   
         <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
       </div><!--.sitenav -->
        
         <?php if( $agronomics_lite_show_socialsection != ''){ ?> 
           <div class="header-socialicons">                                                
                   <?php $agronomics_lite_fb_link = get_theme_mod('agronomics_lite_fb_link');
                    if( !empty($agronomics_lite_fb_link) ){ ?>
                    <a title="facebook" class="fab fa-facebook-f" target="_blank" href="<?php echo esc_url($agronomics_lite_fb_link); ?>"></a>
                   <?php } ?>
                
                   <?php $agronomics_lite_twitt_link = get_theme_mod('agronomics_lite_twitt_link');
                    if( !empty($agronomics_lite_twitt_link) ){ ?>
                    <a title="twitter" class="fab fa-twitter" target="_blank" href="<?php echo esc_url($agronomics_lite_twitt_link); ?>"></a>
                   <?php } ?>
            
                  <?php $agronomics_lite_gplus_link = get_theme_mod('agronomics_lite_gplus_link');
                    if( !empty($agronomics_lite_gplus_link) ){ ?>
                    <a title="google-plus" class="fab fa-google-plus" target="_blank" href="<?php echo esc_url($agronomics_lite_gplus_link); ?>"></a>
                  <?php }?>
            
                  <?php $agronomics_lite_linked_link = get_theme_mod('agronomics_lite_linked_link');
                    if( !empty($agronomics_lite_linked_link) ){ ?>
                    <a title="linkedin" class="fab fa-linkedin" target="_blank" href="<?php echo esc_url($agronomics_lite_linked_link); ?>"></a>
                  <?php } ?>                  
         </div><!--end .header-socialicons--> 
      <?php } ?> 
           
     <div class="clear"></div>
   </div><!-- .container-->      
  </div><!-- .header-navigation -->
  
<?php 
if ( is_front_page() && !is_home() ) {
if($agronomics_lite_showslide_area != '') {
	for($i=1; $i<=3; $i++) {
	  if( get_theme_mod('agronomics_lite_slidepgebx'.$i,false)) {
		$slider_Arr[] = absint( get_theme_mod('agronomics_lite_slidepgebx'.$i,true));
	  }
	}
?> 
<div class="headerslider_panel">                
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
      <div class="custominfo">       
    	<h2><?php the_title(); ?></h2>
    	<?php the_excerpt(); ?>
		<?php
        $agronomics_lite_slidereadmore_btn = get_theme_mod('agronomics_lite_slidereadmore_btn');
        if( !empty($agronomics_lite_slidereadmore_btn) ){ ?>
            <a class="slide_more" href="<?php the_permalink(); ?>"><?php echo esc_html($agronomics_lite_slidereadmore_btn); ?></a>
        <?php } ?>
       </div><!-- .custominfo -->                    
    </div>   
<?php $j++; 
endwhile;
wp_reset_postdata(); ?>  
<div class="clear"></div>  
</div><!--end .headerslider_panel -->     
<?php } ?>
<?php } } ?>
       
        
<?php if ( is_front_page() && ! is_home() ) {
 if( $agronomics_lite_show_3colservices_section != ''){ ?>  
<div class="container pagefeaturecolumn">                      
<?php 
for($n=1; $n<=3; $n++) {    
if( get_theme_mod('agronomics_lite_servicescol'.$n,false)) {      
	$queryvar = new WP_Query('page_id='.absint(get_theme_mod('agronomics_lite_servicescol'.$n,true)) );		
	while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>     
	<div class="features_column rdbx<?php echo esc_attr( $n ); ?>">                                       
		<?php if(has_post_thumbnail() ) { ?>
		<div class="imagebox"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a></div>        
		<?php } ?>		
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>                                     
		<?php the_excerpt(); ?>	                                      
	</div>
	<?php endwhile;
	wp_reset_postdata();                                  
} } ?>                                 
<div class="clear"></div>  
</div><!-- .container -->                  
                	      
<?php } ?>


<?php if( $show_agronomics_lite_welcomepagebx != ''){ ?>  
<section id="welcome_wrapper">
<div class="container">                               
<?php 
if( get_theme_mod('agronomics_lite_welcomepagebx',false)) {     
$queryvar = new WP_Query('page_id='.absint(get_theme_mod('agronomics_lite_welcomepagebx',true)) );			
    while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>                               
     <div class="welcome_descbx">   
     <h3><?php the_title(); ?></h3>   
     <?php the_content();  ?> 
      <a class="learnmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','agronomics-lite'); ?></a>	    
    </div>
    <div class="welcome_imagebx"><?php the_post_thumbnail();?></div>                                          
    <?php endwhile;
     wp_reset_postdata(); ?>                                    
    <?php } ?>                                 
<div class="clear"></div>                       
</div><!-- container -->
</section><!-- #welcome_section-->
<?php } ?>



<?php if( $agronomics_lite_show_agro2col_section != ''){ ?>  
<section id="fourcol_services_wrapper">
<div class="container">                      
<?php 
for($n=1; $n<=4; $n++) {    
if( get_theme_mod('agronomics_lite_pgecolbox'.$n,false)) {      
	$queryvar = new WP_Query('page_id='.absint(get_theme_mod('agronomics_lite_pgecolbox'.$n,true)) );		
	while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>     
	<div class="fourpgebx_srv <?php if($n % 2 == 0) { echo "last_column"; } ?>">                                       
		<?php if(has_post_thumbnail() ) { ?>
		<div class="fourpgebx_thumbx"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a></div>        
		<?php } ?>
		<div class="fourpgebx_contentcol">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>                                     
		<?php the_excerpt(); ?>	
        <a class="pagereadmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more...','agronomics-lite'); ?></a>	                        
		</div>                                   
	</div>
	<?php endwhile;
	wp_reset_postdata();                                  
} } ?>                                 
<div class="clear"></div>  
</div><!-- .container -->                  
</section><!-- #fourcol_services_wrapper-->                      	      
<?php } ?>
<?php } ?>