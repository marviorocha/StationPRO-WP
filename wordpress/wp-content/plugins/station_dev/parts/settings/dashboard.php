<?php
/*
Title: Dashboard
Setting: piklist_core
Order: 10
Tab: Layout
Flow: General
*/

piklist('field', array(
  'type' => 'checkbox'
  ,'field' => 'checkbox_add_more'
  ,'label' => __('Checkbox Add More', 'piklist-demo')
  ,'add_more' => true
  ,'value' => 'third'
  ,'choices' => array(
    'first' => 'First Choice'
    ,'second' => 'Second Choice'
    ,'third' => 'Third Choice'
  )
));