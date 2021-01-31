<?php require('../../../../../wp-load.php');

 global $wpdb;
 $root_path = plugins_url() . "/station_dev/assets/js";
 


 
 

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
//   $icecast   = $titan->getOption('icecast');
//   $shoutcast = $titan->getOption('shoutcast');


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
  
 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
    <style>
     
    </style>

  </head>
  <body>
  
 
  <nav id="app" class="bg-blue-500    mt-20 flex items-center bg-opacity-100 h-24">
      
      <div class="relative flex space-x-9 items-center   w-full w-screen  max-w-screen-lg container mx-auto ">
      
      <div class="p-1 mr-20">
        <img
          class="w-24 block h-24 duration-75 delay-500  rounded-xl absolute bottom-0"
          src="https://placeimg.com/640/480/natural"
          alt=""
        />
      </div>

      <div class="text-white antialiased text-xs md:text-base md:antialiased"><b class=""> PLAY NOW:</b> Music Forrever <br /></div>
      
      <div class="flex justify-center items-center px-1 md:px-24 space-x-3">
        <button id="player"  
          class="transition transform duration-500 ease-in hover:scale-105"
        >
         
        <svg  
            class="player fill-current relative z-10 text-blue-600 w-16 bg-white rounded-full 
            shadow-lg h-16 hover:text-opacity-70"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            aria-hidden="true"
            style="
              -ms-transform: rotate(360deg);
              -webkit-transform: rotate(360deg);
            "
            viewBox="0 0 24 24"
            transform="rotate(360deg)"
          >
            <path
              d="M12 20c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m0-18A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m-2 14.5l6-4.5l-6-4.5v9z"
            />
            <rect />
          </svg>
          <span
            class="animate-ping absolute top-3 left-2 z-1 rounded-full w-11 h-11 bg-white opacity-40"
          ></span>
        </button>
        <span
          class="text-xs font-semibold antialiased text-xs text-white shadow-md bg-red-600 p-1 rounded-md uppercase"
          >Live</span
        > 
        
        
        <button class="material-icons  text-white">
          volume_down 
        </button>
      
        <div class="relative right-20">

          <input type="range" class="rounded-full absolute  opacity-90 overflow-hidden 
          appearance-none transform rotate-90 bottom-14 left-2  cursor-pointer bg-gray-400 h-4 w-24" min="1" max="100" step="1">
          
        </div>

      
     
        <span class="leading-8 hidden md:block text-white">Time: 01:01</span>
        <div class="icons-button">
          <button class="material-icons text-white">favorite_border</button>
          <button class="material-icons text-white">share</button>
           
          <my-tag></my-tag>


           
        </div>
      </div>
    </div>
  </nav>


 
 
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
     -->
      <script type="text/javascript" src="<?php echo $root_path ?>/admin.js"></script>
  </body>
</html>
