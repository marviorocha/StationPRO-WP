<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Night Club Lite
 */

get_header(); ?>

<div class="container">
    <div id="tabnavigator">
        <div class="template_contentbx">
            <header class="page-header">
                <h1 class="entry-title"><?php esc_html_e( '404 Not Found', 'night-club-lite' ); ?></h1>                
            </header><!-- .page-header -->
            <div class="page-content">
                <p><?php esc_html_e( 'Looks like you have taken a wrong turn....Dont worry... it happens to the best of us.', 'night-club-lite' ); ?></p>  
            </div><!-- .page-content -->
        </div><!-- template_contentbx-->   
        <?php get_sidebar();?>       
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>