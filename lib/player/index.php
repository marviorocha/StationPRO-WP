<?php require('../../../../../wp-load.php');
  global $wpdb;

 $titan         = TitanFramework::getInstance('my-theme');
 $djname        = $titan->getOption('dj_name');
 $shoutcast     = $titan->getOption('shoutcast');
 $icecast       = $titan->getOption('icecast');
 $autoplay      = $titan->getOption('auto_play');
 $color_player  = $titan->getOption('color_player');
 $brand         = $titan->getOption('brand');
 $layout_player = $titan->getOption('layout_player');


/**
 * Radio Function Player
 */

function radio(){
  $titan     = TitanFramework::getInstance('my-theme');
  $icecast   = $titan->getOption('icecast');
  $shoutcast = $titan->getOption('shoutcast');


if(!$shoutcast == ""){
  return $shoutcast ."/stream";
  }else{
  return $icecast;
  }
} // end radio function


/**
 * function Logo Imagem Player
 */

function logo_player(){
 $titan         = TitanFramework::getInstance('my-theme');
 $logo          = $titan->getOption('image_logo');
 $image_attributes = wp_get_attachment_image_src( $attachment_id = $logo   );
if($logo == ""){

return  get_avatar_url(get_the_author_meta(get_current_user_id()));

}else{
return $image_attributes[0];
}

} // end radio function



?>
<!DOCTYPE html>
<html lang="eng">
  <head>
  
    <!-- Compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="css/materialize.css"> -->
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/player.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <style>
      .sp-bg {
        opacity: 0.8;
        width: 100%;
        display: block;
        background-color: <?php echo $color_player[4] ?>;
        height: 65px;
        position: fixed;
      }
    </style>

  </head>
  <body>
    <div id="<?php echo $autoplay ?>" class="radio_autoplayer"></div>
    <div class="navbar-fixed">

      <div class="container">

        <div id="btn-show" class="col s3 m3 right">
          <p></p>
          <button id="show" class="btn-floating btn waves-effect waves-light blue  darken-2 pulse"><i class="fas fa-music"></i></button>
        </div>

      </div>

      <nav id="player-nav" class="transparent  darken-4">
        <div class="sp-bg"> </div>
        <div class="container">

          <div class="nav-wrapper">
            <div class="row">
              <!-- Image Thumbinal  -->
              <div class="col s1 m1 l1 ">
                <div class="valign-wrapper">
                  <a style="margin:5px" href="#!" class="">
<?php echo  wp_get_attachment_image_src( $attachment_id = logo_player() )  ?>

              <img width="50" height="50" id="image" src="<?php echo logo_player()  ?>" class="circle responsive-img hide-on-small-only">

              </a>

                </div>


              </div>
              <!-- Player to thumbinal  -->
              <div class="col s3 m2">
                <ul>
                  <li>
                    <span class="djlive"><?php echo $djname ?></span>
                    <span class="live">Live</span>
                    <li>
                </ul>

              </div>

              <!-- player div start -->
              <div class="col s6 m3">
                <ul>
                  <li class="active"><a title="<?php echo radio(); ?>" id="play" class="waves-effect pulse transparent">
               <i class="far fa-play-circle fa-2x"></i></a></li>

                  <li class="active"><a id="btnStop" class="waves-effect transparent">
                        <i class="far fa-stop-circle fa-2x"></i></a></li>
                  <li>

                    <li class="vol hide-on-small-only">

                      <i class="fas fa-volume-down"></i> <input class="range" type="range" id="volume" value="1" min="0" max="1" step="0.1" />
                    </li>

                    <li class="vol">
                      <!-- Stations -->
                      <div id="playing" class="playing hide-on-small-only">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                      </div>

                    </li>

                </ul>
              </div>
              <!-- end player div -->



              <!-- left menu player -->
              <div class="col s1 m5 ">

                <ul>
                  <li> <a id="hidden" href="javascript:;">
                    <i class="far fa-minus-square"></i> Hide </a></li>
                  <li>

                      <a target="_parent" href="<?php echo home_url( $wp->request ) ?>/podstation/">
                      <i class="fas fa-podcast"></i> Podcast</a></li>
                      <li class="right">
<?php if($brand == true){  ?>
                        <a style="font-size:0.800em" rel="follow" target="_blank" title="Station Pro - Easy Player Radio " href="https://stationpro.marviorocha.com/"><i class="fas fa-microphone"></i> by Station Pro</a>
<?php } // end brand enable ?>                     
                      </li>
                </ul>
              </div>


            </div>
          </div>

        </div>

      </nav>

    </div>
    </div>
    <!--  End App VUE -->


    <br /><br />


<div class="row">
  <div class="col s12 m12">
    <div class="">
      <div class="row valign-wrapper">
        <div class="col s2">
          <img id="get_image-sp" src="images/song1.jpg" alt="" class="responsive-img">
          <!-- notice the "circle" class -->
        </div>
        <div class="col s10">
          <span class="black-text">

          <div id="waveform"></div>
       
          </span>
        </div>
      </div>
    </div>
  </div>

 

 
    <script defer src="https://use.fontawesome.com/releases/v5.0.12/js/all.js" integrity="sha384-Voup2lBiiyZYkRto2XWqbzxHXwzcm4A5RfdfG6466bu5LqjwwrjXCMBQBLMWh7qR" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" charset="utf-8"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/2.0.5/wavesurfer.min.js"></script>
    <script type="text/javascript" src="./js/player.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.0.12/howler.min.js"></script>
  </body>
</html>
