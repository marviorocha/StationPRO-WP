<style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css");
    @import url("https://fonts.googleapis.com/icon?family=Material+Icons");
</style>

<script>
   import {Howl, Howler} from 'howler';
   import Play from "./Play.svelte"
   import Volume from './Volume.svelte';
   import Live from './Live.svelte';
   import Timer from './Timer.svelte';
   import Metadata from './Metadata.svelte';
   const stationData = document.body.dataset.station
   const station = JSON.parse(stationData)
 
   let sound = new Howl({
     src: station.icecast != "" ? station.icecast : station.shoutcast,
     autoplay: false,
     html5: true, 
     usingWebAudio: true,
     format: ['mp3', 'aac']
    });
  
    let active = false;
    let volume = "0.5";
    let show = false;
    let live_on = false;
   
    const get_volume_change = (event) => {
      sound.volume(event.detail.change)
    }
  
  const station_player = () => {
  
  if(active == true){
     sound.stop() 
      
  }else{
     sound.play()
     
   }
    
  }
   
</script>

 

 
 
    <nav id="app" class="bg-blue-500 mt-16 flex items-center bg-opacity-100 h-24">
        
        <div class="relative flex space-x-9 items-center   w-full w-screen  max-w-screen-lg container mx-auto ">
        
          <Metadata> </Metadata>
             
        <div class="flex justify-center items-center px-1 md:px-24 space-x-3">
        
          
         
       <Play on:click={()=> {live_on = !live_on}} toggle={sound._autoplay} on:click={station_player} on:click={() => {active = !active}}   ></Play>
        
       <Live live={live_on}></Live>
          
     
       <Volume  on:mouseenter={() => {show = !show}}  show={show}  on:vol={get_volume_change}  volume={volume} bind:value={volume}></Volume>
            
        <Timer timeZone="America/Sao_paulo" ></Timer>
         
          
          <div class="icons-button">
            <button   class="material-icons text-white">favorite_border</button>
           
            <button class="material-icons text-white">share</button>
             
 
          </div>
        </div>
      </div>
    </nav>
  
  
   
   

 