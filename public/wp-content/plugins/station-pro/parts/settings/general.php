<?php
/*
Title: Settings Radio Station
Setting: piklist_core
Tab: General Settings
Flow: General
*/



piklist('field', array(
  'type' => 'file', 'field' => 'logo', 'scope' => 'post_meta', 'label' => 'Logo Or Your Picture', 'help' => 'Put in player your pic or logo 180px x180px', 'options' => array(
    'modal_title' => 'Add File(s)', 'button' => 'Add Image'
  ), 'required' => true
));

piklist('field', array(
  'type' => 'text',
  'field' => 'radio_name',
  'label' => 'Radio Name:',
  'attributes' => array(
    'class' => 'regular-text' // WordPress css class
  ), 'required' => true
));


piklist('field', array(
  'type' => 'text', 'field' => 'shoutcast', 'description' => 'Leave it blank if you working with Icecast', 'placeholder' => 'https://yourstreming.com:8088/stream', 'help' => 'Your Radio URL is full url to brondcast in Station Pro Player', 'label' => 'Shotcast URL:',
  'attributes' => array(
    'class' => 'regular-text' // WordPress css class
  )
));


piklist('field', array(
  'type' => 'text', 'field' => 'icecast', 'description' => 'Leave it blank if you working with Shoutcast', 'help' => 'Your Radio URL is full url to brondcast in Station Pro Player', 'placeholder' => 'https://yourstreming.com:8088', 'label' => 'Icecast URL:',
  'attributes' => array(
    'class' => 'regular-text' // WordPress css class
  )
));


piklist('field', array(
  'type' => 'checkbox', 'field' => 'autoplay', 'help' => 'If it enabled you load the player with song the your radio', 'label' => __('Auto Player', 'stationpro'), 'value' => 'third', 'choices' => array(
    'autoplay' => __('Auto Start Radio when started', 'piklist')
  )
));


if (stationpro()->is_plan('premium', true)) {
  piklist('field', array(
    'type' => 'checkbox',
    'field' => 'brand',
    'label' => 'Hidden Brand StationPro.co',
    'value' => 'hidden', // set default value
    'choices' => array(
      'brand' => 'Hidden Brand',

    )
  ));
} else {
  piklist('field', array(
    'type' => 'html',
    'label' => 'Remove brand the navigation player with premium version',
    'value' => '<strong>Premium version can remove brand of player</strong>',
  ));

  piklist('field', array(
    'type' => 'hidden',
    'field' => 'brand',
    'value' =>  'null'
  ));
}

 
        
   


 




// Validations
