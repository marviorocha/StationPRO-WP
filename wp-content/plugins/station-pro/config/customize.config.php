<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// CUSTOMIZE SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================


 

$options              = array();

// -----------------------------------------
// Customize Core Fields                   -
// -----------------------------------------
//
//



$options[]            = array(
  'name'              => 'wp_core_fields',
  'title'             => 'Theme CleanStation',
  'settings'          => array(


    // footer

  array(
      'name'          => 'footer_1',
      'control'       => array(
        'type'        => 'cs_field',
        'options'     => array(
          'type'      => 'heading',
          'content'   => 'Talk to us',
        ),
      ),
    ),

    // Footer Setting
    array(
      'name'          => 'address_1',
      'default'       => '512 Delicious Street, San Francisco, CA 10880',
      'control'       => array(
        'label'       => 'Address:',
        'type'        => 'textarea',

      ),
    ),

    // Footer Phone
    array(
      'name'          => 'phone_1',
      'default'       => '+55 1 9999 9999',
      'control'       => array(
        'label'       => 'Phone',
        'type'        => 'text',
      ),
    ),

    // text with default
    array(
      'name'          => 'email_1',
      'default'       => 'exemple@exemple.com',
      'control'       => array(
        'label'       => 'E-mail',
        'type'        => 'text',
      ),
    ),

    array(
      'name'          => 'copyright',
      'default'       => 'All Reserved',
      'control'       => array(
        'label'       => 'Copyright',
        'type'        => 'text',
      ),
    ),

 ),
);

// -----------------------------------------
// Customize Codestar Fields               -
// -----------------------------------------
$options[]            = array(
  'name'              => 'fields_social',
  'title'             => 'Social',
  'settings'          => array(

    // codestar color picker
    array(
      'name'          => 'facebook',
      'default'       => 'http://facebook.com/username',
      'control'       => array(
        'type'        => 'text',
        'desc'        => 'Put here your social profile',
        'label'       => 'Facebook:'
      ),
    ),

     array(
      'name'          => 'twitter',
      'default'       => 'http://twitter.com/username',
      'control'       => array(
        'type'        => 'text',
        'desc'        => 'Put here your social profile',
        'label'       => 'Twitter:'
      ),
    ),

      array(
      'name'          => 'gogoleplus',
      'default'       => 'http://googleplus.com/+/username',
      'control'       => array(
        'type'        => 'text',
        'desc'        => 'Put here your social profile',
        'label'       => 'Google Plus:'
      ),
    ),

       array(
      'name'          => 'Instagram',
      'default'       => 'http://instagram.com/username',
      'control'       => array(
        'type'        => 'text',
        'desc'        => 'Put here your social profile',
        'label'       => 'Instagram:'
      ),
    ),


     array(
      'name'          => 'pintrest',
      'default'       => 'http://pinterest.com/username/',
      'control'       => array(
        'type'        => 'text',
        'desc'        => 'Put here your social profile',
        'label'       => 'Pint Rest:'
      ),
    ),

 array(
      'name'          => 'linkedin',
      'default'       => 'http://linkedin.com/in/username/',
      'control'       => array(
        'type'        => 'text',
        'desc'        => 'Put here your social profile',
        'label'       => 'Linkedin:'
      ),
    ),


   ),
);

// -----------------------------------------
// Customize Panel Options Fields          -
// -----------------------------------------
$options[]            = array(
  'name'              => 'codestar_panel_1',
  'title'             => 'Codestar Framework Panel',
  'description'       => 'Codestar customize panel description.',
  'sections'          => array(

    // begin: section
    array(
      'name'          => 'section_1',
      'title'         => 'Section 1',
      'settings'      => array(

        array(
          'name'      => 'color_option_1',
          'default'   => '#ffbc00',
          'control'   => array(
            'type'    => 'cs_field',
            'options' => array(
              'type'  => 'color_picker',
              'title' => 'Color Option 1',
            ),
          ),
        ),

        array(
          'name'      => 'color_option_2',
          'default'   => '#2ecc71',
          'control'   => array(
            'type'    => 'cs_field',
            'options' => array(
              'type'  => 'color_picker',
              'title' => 'Color Option 2',
            ),
          ),
        ),

        array(
          'name'      => 'color_option_3',
          'default'   => '#e74c3c',
          'control'   => array(
            'type'    => 'cs_field',
            'options' => array(
              'type'  => 'color_picker',
              'title' => 'Color Option 3',
            ),
          ),
        ),

        array(
          'name'      => 'color_option_4',
          'default'   => '#3498db',
          'control'   => array(
            'type'    => 'cs_field',
            'options' => array(
              'type'  => 'color_picker',
              'title' => 'Color Option 4',
            ),
          ),
        ),

        array(
          'name'      => 'color_option_5',
          'default'   => '#555555',
          'control'   => array(
            'type'    => 'cs_field',
            'options' => array(
              'type'  => 'color_picker',
              'title' => 'Color Option 5',
            ),
          ),
        ),

      ),
    ),
    // end: section

    // begin: section
    array(
      'name'          => 'section_2',
      'title'         => 'Section 2',
      'settings'      => array(

        array(
          'name'      => 'text_option_1',
          'control'   => array(
            'type'    => 'cs_field',
            'options' => array(
              'type'  => 'text',
              'title' => 'Text Option 1',
            ),
          ),
        ),

        array(
          'name'      => 'text_option_2',
          'control'   => array(
            'type'    => 'cs_field',
            'options' => array(
              'type'  => 'text',
              'title' => 'Text Option 2',
            ),
          ),
        ),

        array(
          'name'      => 'text_option_3',
          'control'   => array(
            'type'    => 'cs_field',
            'options' => array(
              'type'  => 'text',
              'title' => 'Text Option 3',
            ),
          ),
        ),

      ),
    ),
    // end: section

  ),
  // end: sections

);

CSFramework_Customize::instance( $options );
