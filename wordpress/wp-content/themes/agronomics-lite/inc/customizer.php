<?php    
/**
 *Agronomics Lite Theme Customizer
 *
 * @package Agronomics Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function agronomics_lite_customize_register( $wp_customize ) {	
	
	function agronomics_lite_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function agronomics_lite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}  
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	 //Panel for section & control
	$wp_customize->add_panel( 'agronomics_lite_panel_area', array(
		'priority' => null,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options Panel', 'agronomics-lite' ),		
	) );
	
	//Layout Options
	$wp_customize->add_section('agronomics_lite_layout_option',array(
		'title' => __('Site Layout','agronomics-lite'),			
		'priority' => 1,
		'panel' => 	'agronomics_lite_panel_area',          
	));		
	
	$wp_customize->add_setting('agronomics_lite_boxlayout',array(
		'sanitize_callback' => 'agronomics_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'agronomics_lite_boxlayout', array(
    	'section'   => 'agronomics_lite_layout_option',    	 
		'label' => __('Check to Box Layout','agronomics-lite'),
		'description' => __('If you want to box layout please check the Box Layout Option.','agronomics-lite'),
    	'type'      => 'checkbox'
     )); //Layout Section 
	
	$wp_customize->add_setting('agronomics_lite_color_scheme',array(
		'default' => '#71b002',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'agronomics_lite_color_scheme',array(
			'label' => __('Color Scheme','agronomics-lite'),			
			'description' => __('More color options in PRO Version','agronomics-lite'),
			'section' => 'colors',
			'settings' => 'agronomics_lite_color_scheme'
		))
	);	
	
	//Header Contact info
	$wp_customize->add_section('agronomics_lite_hdr_contact_section',array(
		'title' => __('Header Contact info','agronomics-lite'),				
		'priority' => null,
		'panel' => 	'agronomics_lite_panel_area',
	));
	
	$wp_customize->add_setting('agronomics_lite_header_address',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('agronomics_lite_header_address',array(	
		'type' => 'text',
		'label' => __('Add address here','agronomics-lite'),
		'section' => 'agronomics_lite_hdr_contact_section',
		'setting' => 'agronomics_lite_header_address'
	));	
	
		
	$wp_customize->add_setting('agronomics_lite_header_contactno',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('agronomics_lite_header_contactno',array(	
		'type' => 'text',
		'label' => __('Add phone number here','agronomics-lite'),
		'section' => 'agronomics_lite_hdr_contact_section',
		'setting' => 'agronomics_lite_header_contactno'
	));	
	
	
	$wp_customize->add_setting('agronomics_lite_header_workinghours',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('agronomics_lite_header_workinghours',array(	
		'type' => 'text',
		'label' => __('Add working hours here','agronomics-lite'),
		'section' => 'agronomics_lite_hdr_contact_section',
		'setting' => 'agronomics_lite_header_workinghours'
	));	
	
	
	$wp_customize->add_setting('agronomics_lite_show_header_contact_info',array(
		'default' => false,
		'sanitize_callback' => 'agronomics_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'agronomics_lite_show_header_contact_info', array(
	   'settings' => 'agronomics_lite_show_header_contact_info',
	   'section'   => 'agronomics_lite_hdr_contact_section',
	   'label'     => __('Check To show This Section','agronomics-lite'),
	   'type'      => 'checkbox'
	 ));//Show header contact info
	
	 
	 //Header social icons
	$wp_customize->add_section('agronomics_lite_social_section',array(
		'title' => __('Header social icons','agronomics-lite'),
		'description' => __( 'Add social icons link here to display icons in header.', 'agronomics-lite' ),			
		'priority' => null,
		'panel' => 	'agronomics_lite_panel_area', 
	));
	
	$wp_customize->add_setting('agronomics_lite_fb_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'	
	));
	
	$wp_customize->add_control('agronomics_lite_fb_link',array(
		'label' => __('Add facebook link here','agronomics-lite'),
		'section' => 'agronomics_lite_social_section',
		'setting' => 'agronomics_lite_fb_link'
	));	
	
	$wp_customize->add_setting('agronomics_lite_twitt_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('agronomics_lite_twitt_link',array(
		'label' => __('Add twitter link here','agronomics-lite'),
		'section' => 'agronomics_lite_social_section',
		'setting' => 'agronomics_lite_twitt_link'
	));
	
	$wp_customize->add_setting('agronomics_lite_gplus_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('agronomics_lite_gplus_link',array(
		'label' => __('Add google plus link here','agronomics-lite'),
		'section' => 'agronomics_lite_social_section',
		'setting' => 'agronomics_lite_gplus_link'
	));
	
	$wp_customize->add_setting('agronomics_lite_linked_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('agronomics_lite_linked_link',array(
		'label' => __('Add linkedin link here','agronomics-lite'),
		'section' => 'agronomics_lite_social_section',
		'setting' => 'agronomics_lite_linked_link'
	));
	
	$wp_customize->add_setting('agronomics_lite_show_socialsection',array(
		'default' => false,
		'sanitize_callback' => 'agronomics_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'agronomics_lite_show_socialsection', array(
	   'settings' => 'agronomics_lite_show_socialsection',
	   'section'   => 'agronomics_lite_social_section',
	   'label'     => __('Check To show This Section','agronomics-lite'),
	   'type'      => 'checkbox'
	 ));//Show Header Social icons Section 			
	
	// Slider Section		
	$wp_customize->add_section( 'agronomics_lite_slide_panelarea', array(
		'title' => __('Slider Section', 'agronomics-lite'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 633 pixel.','agronomics-lite'), 
		'panel' => 	'agronomics_lite_panel_area',           			
    ));
	
	$wp_customize->add_setting('agronomics_lite_slidepgebx1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('agronomics_lite_slidepgebx1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide one:','agronomics-lite'),
		'section' => 'agronomics_lite_slide_panelarea'
	));	
	
	$wp_customize->add_setting('agronomics_lite_slidepgebx2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('agronomics_lite_slidepgebx2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide two:','agronomics-lite'),
		'section' => 'agronomics_lite_slide_panelarea'
	));	
	
	$wp_customize->add_setting('agronomics_lite_slidepgebx3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('agronomics_lite_slidepgebx3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide three:','agronomics-lite'),
		'section' => 'agronomics_lite_slide_panelarea'
	));	// Slider Section	
	
	$wp_customize->add_setting('agronomics_lite_slidereadmore_btn',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('agronomics_lite_slidereadmore_btn',array(	
		'type' => 'text',
		'label' => __('Add slider Read more button name here','agronomics-lite'),
		'section' => 'agronomics_lite_slide_panelarea',
		'setting' => 'agronomics_lite_slidereadmore_btn'
	)); // Slider Read More Button Text
	
	$wp_customize->add_setting('agronomics_lite_showslide_area',array(
		'default' => false,
		'sanitize_callback' => 'agronomics_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'agronomics_lite_showslide_area', array(
	    'settings' => 'agronomics_lite_showslide_area',
	    'section'   => 'agronomics_lite_slide_panelarea',
	     'label'     => __('Check To Show This Section','agronomics-lite'),
	   'type'      => 'checkbox'
	 ));//Show Slider Section	
	 
	 
	 // Three column Services section
	$wp_customize->add_section('agronomics_lite_3colservices_section', array(
		'title' => __('Top Three Services Section','agronomics-lite'),
		'description' => __('Select pages from the dropdown for services section','agronomics-lite'),
		'priority' => null,
		'panel' => 	'agronomics_lite_panel_area',          
	));	
	
	$wp_customize->add_setting('agronomics_lite_servicescol1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'agronomics_lite_servicescol1',array(
		'type' => 'dropdown-pages',			
		'section' => 'agronomics_lite_3colservices_section',
	));		
	
	$wp_customize->add_setting('agronomics_lite_servicescol2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'agronomics_lite_servicescol2',array(
		'type' => 'dropdown-pages',			
		'section' => 'agronomics_lite_3colservices_section',
	));
	
	$wp_customize->add_setting('agronomics_lite_servicescol3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'agronomics_lite_servicescol3',array(
		'type' => 'dropdown-pages',			
		'section' => 'agronomics_lite_3colservices_section',
	));
	
	
	$wp_customize->add_setting('agronomics_lite_show_3colservices_section',array(
		'default' => false,
		'sanitize_callback' => 'agronomics_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'agronomics_lite_show_3colservices_section', array(
	   'settings' => 'agronomics_lite_show_3colservices_section',
	   'section'   => 'agronomics_lite_3colservices_section',
	   'label'     => __('Check To Show This Section','agronomics-lite'),
	   'type'      => 'checkbox'
	 ));//Show services section
	 
	 
	 // Welcome Section 
	$wp_customize->add_section('agronomics_lite_aboutsection', array(
		'title' => __('Welcome Section','agronomics-lite'),
		'description' => __('Select Pages from the dropdown for welcome section','agronomics-lite'),
		'priority' => null,
		'panel' => 	'agronomics_lite_panel_area',          
	));		
	
	$wp_customize->add_setting('agronomics_lite_welcomepagebx',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'agronomics_lite_welcomepagebx',array(
		'type' => 'dropdown-pages',			
		'section' => 'agronomics_lite_aboutsection',
	));		
	
	$wp_customize->add_setting('show_agronomics_lite_welcomepagebx',array(
		'default' => false,
		'sanitize_callback' => 'agronomics_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'show_agronomics_lite_welcomepagebx', array(
	    'settings' => 'show_agronomics_lite_welcomepagebx',
	    'section'   => 'agronomics_lite_aboutsection',
	    'label'     => __('Check To Show This Section','agronomics-lite'),
	    'type'      => 'checkbox'
	));//Show about Section 
	 
	
	// Two Column Services section
	$wp_customize->add_section('agronomics_lite_agro2col_section', array(
		'title' => __('Two Column Services Section','agronomics-lite'),
		'description' => __('Select pages from the dropdown for 2 column services section','agronomics-lite'),
		'priority' => null,
		'panel' => 	'agronomics_lite_panel_area',          
	));	
	
	$wp_customize->add_setting('agronomics_lite_pgecolbox1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'agronomics_lite_pgecolbox1',array(
		'type' => 'dropdown-pages',			
		'section' => 'agronomics_lite_agro2col_section',
	));		
	
	$wp_customize->add_setting('agronomics_lite_pgecolbox2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'agronomics_lite_pgecolbox2',array(
		'type' => 'dropdown-pages',			
		'section' => 'agronomics_lite_agro2col_section',
	));
	
	$wp_customize->add_setting('agronomics_lite_pgecolbox3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'agronomics_lite_pgecolbox3',array(
		'type' => 'dropdown-pages',			
		'section' => 'agronomics_lite_agro2col_section',
	));	
	
	$wp_customize->add_setting('agronomics_lite_pgecolbox4',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'agronomics_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'agronomics_lite_pgecolbox4',array(
		'type' => 'dropdown-pages',			
		'section' => 'agronomics_lite_agro2col_section',
	));
	
	
	$wp_customize->add_setting('agronomics_lite_show_agro2col_section',array(
		'default' => false,
		'sanitize_callback' => 'agronomics_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'agronomics_lite_show_agro2col_section', array(
	   'settings' => 'agronomics_lite_show_agro2col_section',
	   'section'   => 'agronomics_lite_agro2col_section',
	   'label'     => __('Check To Show This Section','agronomics-lite'),
	   'type'      => 'checkbox'
	 ));//Show 2 column services section 	 
	 
		 
}
add_action( 'customize_register', 'agronomics_lite_customize_register' );

function agronomics_lite_custom_css(){ 
?>
	<style type="text/css"> 					
        a, .blogpost_lyout h2 a:hover,
        #sidebar ul li a:hover,								
        .blogpost_lyout h3 a:hover,
		.welcome_descbx h3 span,					
        .recent-post h6:hover,
		.header-socialicons a:hover,       						
        .postmeta a:hover,
		.sitenav ul li a:hover, 
		.sitenav ul li.current-menu-item a,
		.sitenav ul li.current-menu-parent a.parent,
		.sitenav ul li.current-menu-item ul.sub-menu li a:hover,
        .button:hover,
		.infobox i,	
		.fourpgebx_srv .pagereadmore,	
		.fourpgebx_srv:hover h3 a,		           
		.footer-wrapper h2 span,
		.footer-wrapper ul li a:hover, 
		.footer-wrapper ul li.current_page_item a        				
            { color:<?php echo esc_html( get_theme_mod('agronomics_lite_color_scheme','#71b002')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,		
        .nivo-controlNav a.active,		
        .learnmore,
		.features_column:hover,
		.nivo-caption .slide_more:hover, 		
		.fourpgebx_srv:hover .pagereadmore,												
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,   
		.logo, .logo::after, .logo::before,    		
        .toggle a	
            { background-color:<?php echo esc_html( get_theme_mod('agronomics_lite_color_scheme','#71b002')); ?>;}
			
		.nivo-caption .slide_more:hover,
		.infobox i,
		.fourpgebx_srv .pagereadmore,
		blockquote	        
            { border-color:<?php echo esc_html( get_theme_mod('agronomics_lite_color_scheme','#71b002')); ?>;}
			
		#sidebar ul li:hover, #sidebar ul li:first-child	        
            { border-left:4px solid <?php echo esc_html( get_theme_mod('agronomics_lite_color_scheme','#71b002')); ?>;}	
			
		.welcome_imagebx	        
            { box-shadow:15px 15px 0 0 <?php echo esc_html( get_theme_mod('agronomics_lite_color_scheme','#71b002')); ?>;}			
						
			
         	
    </style> 
<?php            
}
         
add_action('wp_head','agronomics_lite_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function agronomics_lite_customize_preview_js() {
	wp_enqueue_script( 'agronomics_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20191002', true );
}
add_action( 'customize_preview_init', 'agronomics_lite_customize_preview_js' );