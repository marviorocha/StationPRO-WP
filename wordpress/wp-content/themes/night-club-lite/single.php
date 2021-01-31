<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Night Club Lite
 */

get_header(); ?>

<div class="container">
     <div id="tabnavigator">
        <div class="template_contentbx <?php if( esc_attr( get_theme_mod( 'night_club_lite_hidesidebar_singlepost' )) ) { ?>fullwidth<?php } ?>">            
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'single' ); ?>
                    <?php the_post_navigation(); ?>
                    <div class="clear"></div>
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                    	comments_template();
                    ?>
                <?php endwhile; // end of the loop. ?>                  
         </div>  <!-- .template_contentbx-->        
          <?php if( esc_attr(get_theme_mod( 'night_club_lite_hidesidebar_singlepost' )) == '') { ?> 
          	  <?php get_sidebar();?>
          <?php } ?>       
        <div class="clear"></div>
    </div><!-- #tabnavigator -->
</div><!-- container -->	
<?php get_footer(); ?>