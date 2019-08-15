<?php

require_once(ABSPATH.'wp-load.php');
global $wpdb;
global $post;

function player_layout(){

$titan         = TitanFramework::getInstance('my-theme');
$layout_player = $titan->getOption('layout_player');

if($layout_player == 1){
return "top: 0;";
}else{
return "bottom:0;";
}
}
?>
<?php function style_player(){ ?>
  <style media="screen">
  #iframe_main{position:fixed;<?php echo player_layout(); ?>}
  #idiv{position:relative;height:70px;z-index:998;left:0;right:0;bottom:0}
  </style>
<?php } // end style player function ?>
<?php add_action('wp_head','style_player');  ?>
<?php function player(){ ?>
  <div id='idiv'>
    <iframe  id="iframe_main" scrolling="no" height="70" frameborder="0" 
    src="<?php echo WP_PLUGIN_URL ?>/station-pro/lib/player/index.php"
      width="100%"></iframe>
  </div>
<?php }
add_action('wp_footer','player');
 // end player ?>
<?php 
 
add_filter('the_content','podstation');

function podstation($content){
if (is_singular('station_post')) {

$podcast = get_post_meta(get_the_ID(),'podcast', true );
$titan         = TitanFramework::getInstance('my-theme');
$color_player = $titan->getOption('color_player');
$content .= '
<div class="wevescolor" src="'. $color_player[1] .'"></div>
<div class="container">
<div class="row">
   
<!-- Mz Player Card -->
<div class="col s12 m12 l12">
<div class="card">
    <div class="card-image">
        <div id="waveform"></div>
            
        '. wp_get_attachment_image(  $podcast['podcast_image'], 'thumbnails') .'
        
        <span class="card-title"> '.$podcast['podcast_title'].' </span>


        <a id="play-sp" src="'.$podcast['podcast_audio'].'" href="javascript:;" class="btn-floating play_sp halfway-fab waves-effect waves-light blue">
            <i class="material-icons">play_arrow</i>
        </a>

    </div>
    <div class="card-content">
        <p> '.$podcast['podcast_descricao'].' </p>
    </div>
</div>
</div>
 
 
</div>
</div>';

}
return $content;
} // end function podcast
?>