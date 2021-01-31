<?php    
/**
 *night-club-lite Theme Customizer
 *
 * @package Night Club Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function night_club_lite_customize_register( $wp_customize ) {	
	
	function night_club_lite_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function night_club_lite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	} 
	
	function night_club_lite_sanitize_phone_number( $phone ) {
		// sanitize phone
		return preg_replace( '/[^\d+]/', '', $phone );
	} 
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	 //Panel for section & control
	$wp_customize->add_panel( 'night_club_lite_panel_section', array(
		'priority' => null,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options Panel', 'night-club-lite' ),		
	) );
	
	//Site Layout Options
	$wp_customize->add_section('night_club_lite_layout_sections',array(
		'title' => __('Site Layout Options','night-club-lite'),			
		'priority' => 1,
		'panel' => 	'night_club_lite_panel_section',          
	));		
	
	$wp_customize->add_setting('night_club_lite_boxlayoutoptions',array(
		'sanitize_callback' => 'night_club_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'night_club_lite_boxlayoutoptions', array(
    	'section'   => 'night_club_lite_layout_sections',    	 
		'label' => __('Check to Show Box Layout','night-club-lite'),
		'description' => __('If you want to show box layout please check the Box Layout Option.','night-club-lite'),
    	'type'      => 'checkbox'
     )); //Site Layout Options 
	
	$wp_customize->add_setting('night_club_lite_template_coloroptions',array(
		'default' => '#d81362',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'night_club_lite_template_coloroptions',array(
			'label' => __('Color Options','night-club-lite'),			
			'description' => __('More color options available in PRO Version','night-club-lite'),
			'section' => 'colors',
			'settings' => 'night_club_lite_template_coloroptions'
		))
	);	
	
	
	// Front Slider Section		
	$wp_customize->add_section( 'night_club_lite_frontpageslider_section', array(
		'title' => __('Frontpage Slider Sections', 'night-club-lite'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 745 pixel.','night-club-lite'), 
		'panel' => 	'night_club_lite_panel_section',           			
    ));
	
	$wp_customize->add_setting('night_club_lite_frontslide1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'night_club_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('night_club_lite_frontslide1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 1:','night-club-lite'),
		'section' => 'night_club_lite_frontpageslider_section'
	));	
	
	$wp_customize->add_setting('night_club_lite_frontslide2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'night_club_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('night_club_lite_frontslide2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 2:','night-club-lite'),
		'section' => 'night_club_lite_frontpageslider_section'
	));	
	
	$wp_customize->add_setting('night_club_lite_frontslide3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'night_club_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('night_club_lite_frontslide3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 3:','night-club-lite'),
		'section' => 'night_club_lite_frontpageslider_section'
	));	// Homepage Slider Section
	
	$wp_customize->add_setting('night_club_lite_frontslidebutton',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('night_club_lite_frontslidebutton',array(	
		'type' => 'text',
		'label' => __('enter slider Read more button name here','night-club-lite'),
		'section' => 'night_club_lite_frontpageslider_section',
		'setting' => 'night_club_lite_frontslidebutton'
	)); // Home Slider Read More Button Text
	
	$wp_customize->add_setting('night_club_lite_show_frontpageslider_section',array(
		'default' => false,
		'sanitize_callback' => 'night_club_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'night_club_lite_show_frontpageslider_section', array(
	    'settings' => 'night_club_lite_show_frontpageslider_section',
	    'section'   => 'night_club_lite_frontpageslider_section',
	     'label'     => __('Check To Show This Section','night-club-lite'),
	   'type'      => 'checkbox'
	 ));//Show Frontpage Slider Section	
	 
	 
	 //Four Circle column Services Section
	$wp_customize->add_section('night_club_lite_threecolumn_services_sections', array(
		'title' => __('Four Circle column Services Section','night-club-lite'),
		'description' => __('Select pages from the dropdown for 4 circle column services sections','night-club-lite'),
		'priority' => null,
		'panel' => 	'night_club_lite_panel_section',          
	));	
	
	
	$wp_customize->add_setting('night_club_lite_services_section_title',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('night_club_lite_services_section_title',array(	
		'type' => 'text',
		'label' => __('Enter services section title here','night-club-lite'),
		'section' => 'night_club_lite_threecolumn_services_sections',
		'setting' => 'night_club_lite_services_section_title'
	)); //Services sections title
	
	
	$wp_customize->add_setting('night_club_lite_4circle_col1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'night_club_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'night_club_lite_4circle_col1',array(
		'type' => 'dropdown-pages',			
		'section' => 'night_club_lite_threecolumn_services_sections',
	));		
	
	$wp_customize->add_setting('night_club_lite_4circle_col2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'night_club_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'night_club_lite_4circle_col2',array(
		'type' => 'dropdown-pages',			
		'section' => 'night_club_lite_threecolumn_services_sections',
	));
	
	$wp_customize->add_setting('night_club_lite_4circle_col3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'night_club_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'night_club_lite_4circle_col3',array(
		'type' => 'dropdown-pages',			
		'section' => 'night_club_lite_threecolumn_services_sections',
	));	
	
	$wp_customize->add_setting('night_club_lite_4circle_col4',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'night_club_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'night_club_lite_4circle_col4',array(
		'type' => 'dropdown-pages',			
		'section' => 'night_club_lite_threecolumn_services_sections',
	));
	
	
	$wp_customize->add_setting('night_club_lite_show_4circle_sections',array(
		'default' => false,
		'sanitize_callback' => 'night_club_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'night_club_lite_show_4circle_sections', array(
	   'settings' => 'night_club_lite_show_4circle_sections',
	   'section'   => 'night_club_lite_threecolumn_services_sections',
	   'label'     => __('Check To Show This Section','night-club-lite'),
	   'type'      => 'checkbox'
	 ));//Show four circle column Services Section
	 
	 
	//Sidebar Settings
	$wp_customize->add_section('night_club_lite_sidebar_options', array(
		'title' => __('Sidebar Options','night-club-lite'),		
		'priority' => null,
		'panel' => 	'night_club_lite_panel_section',          
	));	
	
	$wp_customize->add_setting('night_club_lite_hidesidebar_from_homepage',array(
		'default' => false,
		'sanitize_callback' => 'night_club_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'night_club_lite_hidesidebar_from_homepage', array(
	   'settings' => 'night_club_lite_hidesidebar_from_homepage',
	   'section'   => 'night_club_lite_sidebar_options',
	   'label'     => __('Check to hide sidebar from latest post page','night-club-lite'),
	   'type'      => 'checkbox'
	 ));// Hide sidebar from latest post page
	 
	 
	 $wp_customize->add_setting('night_club_lite_hidesidebar_singlepost',array(
		'default' => false,
		'sanitize_callback' => 'night_club_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'night_club_lite_hidesidebar_singlepost', array(
	   'settings' => 'night_club_lite_hidesidebar_singlepost',
	   'section'   => 'night_club_lite_sidebar_options',
	   'label'     => __('Check to hide sidebar from single post','night-club-lite'),
	   'type'      => 'checkbox'
	 ));// hide sidebar single post	 

		 
}
add_action( 'customize_register', 'night_club_lite_customize_register' );

function night_club_lite_custom_css(){ 
?>
	<style type="text/css"> 					
        a, .listview_blogstyle h2 a:hover,
        #sidebar ul li a:hover,
		#sidebar ul li a:focus,						
        .listview_blogstyle h3 a:hover,
		.listview_blogstyle h3 a:focus,
		.blog_postmeta a:focus,		
        .postmeta a:hover,
		.site-navigation .menu a:hover,
		.site-navigation .menu a:focus,
		.site-navigation .menu ul a:hover,
		.site-navigation .menu ul a:focus,
		.site-navigation ul li a:hover, 
		.site-navigation ul li.current-menu-item a,
		.site-navigation ul li.current-menu-parent a.parent,
		.site-navigation ul li.current-menu-item ul.sub-menu li a:hover, 			
        .button:hover,
		.site-footer h5,
		.nivo-caption h2 span,
		h2.services_title span,
		.column4circle_box:hover h3 a,		
		.blog_postmeta a:hover,		
		.site-footer ul li a:hover,
		.site-footer ul li a:focus, 
		.site-footer ul li.current_page_item a		
            { color:<?php echo esc_html( get_theme_mod('night_club_lite_template_coloroptions','#d81362')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,
		nav.pagination .page-numbers:hover,		
        .nivo-controlNav a.active,
		.sd-search input, .sd-top-bar-nav .sd-search input,			
		a.blogreadmore,
		h3.widget-title,			
		.nivo-caption .slide_morebtn,
		.learnmore:hover,		
		.copyrigh-wrapper:before,
		.infobox a.get_an_enquiry:hover,									
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,		
		.blogreadbtn,
		a.getanappointment,		
        .toggle a	
            { background-color:<?php echo esc_html( get_theme_mod('night_club_lite_template_coloroptions','#d81362')); ?>;}
			
		
		.tagcloud a:hover,		
		.topsocial_icons a:hover,
		.site-footer h5::after,	
		.column4circle_box:hover .srviconbox,	
		h3.widget-title::after
            { border-color:<?php echo esc_html( get_theme_mod('night_club_lite_template_coloroptions','#d81362')); ?>;}
			
		
	
		 button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus,
		.listview_blogstyle h3 a:focus,
		#templatelayout a:focus		
            { outline:thin dotted <?php echo esc_html( get_theme_mod('night_club_lite_template_coloroptions','#d81362')); ?>;}
			
		#sidebar input[type="search"]:focus
            { outline: auto <?php echo esc_html( get_theme_mod('night_club_lite_template_coloroptions','#d81362')); ?>;}
					
			
	
    </style> 
<?php                                                                                        
}
         
add_action('wp_head','night_club_lite_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function night_club_lite_customize_preview_js() {
	wp_enqueue_script( 'night_club_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '19062019', true );
}
add_action( 'customize_preview_init', 'night_club_lite_customize_preview_js' );