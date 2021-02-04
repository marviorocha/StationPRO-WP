<style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css");
    @import url("https://fonts.googleapis.com/icon?family=Material+Icons");
</style>

<script>
   import {Howl, Howler} from 'howler';
   import Play from "./Play.svelte"
   let sound = new Howl({
     src: "http://bbcmedia.ic.llnwd.net/stream/bbcmedia_radio1_mf_q",
     html5: true, 
     format: ['mp3', 'aac']
    });

   let active = false;
     
  const station_player = () => {
   if(active == true){
     sound.stop()
  }else{
     sound.play()
   }
    
  }
  
 
    
  
  
     
</script>

<div class="fixed w-full overscroll-y-none overscroll-x-none  bottom-0"  id="player_stationpro">
 

    <div id="app"></div> 
 
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
        
            
            <Play on:click={station_player} on:click={() => {active = !active}} ></Play>
       
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
  
       
          <span class="leading-8 hidden md:block text-white">Time: {sound.state()}</span>
          <div class="icons-button">
            <button class="material-icons text-white">favorite_border</button>
            <button class="material-icons text-white">share</button>
             
 
          </div>
        </div>
      </div>
    </nav>
  
  
   
   

</div>