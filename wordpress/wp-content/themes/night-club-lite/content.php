<?php
/**
 * @package Night Club Lite
 */
?>
 <div class="listview_blogstyle">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>        
        
        <header class="entry-header">
            <h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>      
                           
            <?php if ( 'post' == get_post_type() ) : ?>
                <div class="blog_postmeta">
                    <div class="post-date"> <i class="far fa-clock"></i>  <?php echo get_the_date(); ?></div><!-- post-date --> 
                    <?php if( get_theme_mod( 'night_club_lite_hide_postcategory' ) == '') { ?> 
                      <span class="blogpost_cat"> <i class="far fa-folder-open"></i> <?php the_category( __( ', ', 'night-club-lite' ));?></span>
                   <?php } ?>                                             
                </div><!-- .blog_postmeta -->
            <?php endif; ?>                    
        </header><!-- .entry-header -->
        
         <?php if (has_post_thumbnail() ){ ?>
			<div class="blgimagebx">
             <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
		<?php } ?> 
          
        <?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
           	<?php the_excerpt(); ?>
            <a class="blogreadbtn" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more &rarr;','night-club-lite'); ?></a>         
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'night-club-lite' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'night-club-lite' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
        <div class="clear"></div>
    </article><!-- #post-## -->
</div>