<?php
/**
 * The template used for displaying content search.php
 * @package Agronomics Lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

 		<?php 
        if (has_post_thumbnail() ){
			echo '<div class="post-thumb">';
            the_post_thumbnail();
			echo '</div>';
		}
        ?>    
    <header class="entry-header">
        <?php the_title( '<h3 class="single-title">', '</h3>' ); ?>
    </header><!-- .entry-header -->    
     <div class="postmeta">
            <div class="post-date"><?php the_date(); ?></div><!-- post-date -->
            <div class="post-comment"> <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>            
    </div><!-- postmeta -->  

    <div class="entry-content">		
        <?php the_content(); ?>
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'agronomics-lite' ),
            'after'  => '</div>',
        ) );
        ?>
        <div class="postmeta">          
            <div class="post-tags"><?php the_tags(); ?> </div>
            <div class="clear"></div>
        </div><!-- postmeta -->
    </div><!-- .entry-content -->
   
    <footer class="entry-meta">
      <?php edit_post_link( __( 'Edit', 'agronomics-lite' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
</article>