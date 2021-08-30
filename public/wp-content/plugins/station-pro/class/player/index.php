<?php require('../../../../../wp-load.php');

global $wpdb;
$option = get_option("piklist_core");
$image_logo = wp_get_attachment_image_url($option['logo'][0]);


function radio()
{
  $option = get_option("piklist_core");

  $icecast   = $option['icecast'];
  $shoutcast = $option['shoutcast'];

  if (!$shoutcast == "") {
    return $shoutcast;
  } else {
    return $icecast;
  }
} // end radio function





//  $titan         = TitanFramework::getInstance('my-theme');
//  $djname        = $titan->getOption('dj_name');
//  $shoutcast     = $titan->getOption('shoutcast');
//  $icecast       = $titan->getOption('icecast');
//  $autoplay      = $titan->getOption('auto_play');
//  $color_player  = $titan->getOption('color_player');
//  $brand         = $titan->getOption('brand');
//  $layout_player = $titan->getOption('layout_player');






// compile sass css with php


/**
 * Radio Function Player
 */

// function radio(){
//   $titan     = TitanFramework::getInstance('my-theme');
//   $icecast   = $option['icecast'];
//   $shoutcast = $option['shoutcast'];


// if(!$shoutcast == ""){
//   return $shoutcast ."/stream";
//   }else{
//   return $icecast;
//   }
// } // end radio function


/**
 * function Logo Imagem Player
 */

// function logo_player(){

//  $titan             = TitanFramework::getInstance('my-theme');
//  $logo              = $titan->getOption('image_logo');
//  $image_attributes  = wp_get_attachment_image_src( $attachment_id = $logo   );

// if($logo == ""){

// return  get_avatar_url(get_the_author_meta(get_current_user_id()));

// }else{
// return $image_attributes[0];
// }

// } // end radio function

// get the images url
// wp_get_attachment_image_src( $attachment_id = logo_player() );

?>
<!DOCTYPE html>
<html lang="eng">

<head>


  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="<?php echo plugins_url('../../dist/bundle.css', __FILE__) ?>">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <?php
  if (stationpro()->is_plan('premium', true)) {

  ?>
    <script src="<?php echo plugins_url('../../class/metadata/icecast-metadata-stats-0.0.2.min.js', __FILE__) ?>"> </script>

    <script>
      const onStats = (stats) => {

        localStorage.setItem('play_now', stats.icy.StreamTitle);

      };

      const statsListener =
        new IcecastMetadataStats(
          '<?php echo radio() ?>', {
            sources: ["icy"],
            onStats
          }
        );
      statsListener.start();
    </script>

  <?php } ?>

  <script>
    localStorage.setItem('stationData', '<?php echo json_encode($option); ?>');
    localStorage.setItem('image_logo', '<?php echo  $image_logo; ?>');
  </script>
</head>

<body>


  <script src="<?php echo plugins_url('../../dist/bundle.js', __FILE__) ?>"></script>
</body>

</html>