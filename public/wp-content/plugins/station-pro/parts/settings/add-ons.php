<?php
/*
Title: Station Pro Addons
Setting: piklist_core_addons
Tab Order: 0
*/
?>

  <p>
    <?php printf(__('%1$s Cooming soon! Your addons for you extends your Station PRo', 'piklist'), '<a href="https://stationpro.co/">', '</a>');?>
  </p>

<?php

  piklist('field', array(
    'type' => 'add-ons'
    ,'field' => 'add-ons'
    ,'template' => 'field'
    ,'label' => __('Plugin Add-ons', 'piklist')
    ,'choices' => piklist(piklist_add_on::$available_add_ons, array('add_on', 'name'))
  ));
