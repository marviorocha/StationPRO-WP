<script>
	 
 export let volume = '0.5'
 
 

</script>

<button  class="material-icons  text-white">
  
     
  
    {#if volume >= 30 }
    volume_mute
    {/if}
    {#if volume >= 50 }
    volume_down
    {/if}
    {#if volume > 50 }
    volume_up
    {/if}
   
</button>
{volume}
  <div class="relative right-20">

    <input  bind:value={volume} type="range" class="rounded-full absolute  z-50 opacity-90 overflow-hidden 
    appearance-none transform rotate-90 bottom-14 left-2  cursor-pointer bg-gray-400 h-4 w-24" min="1" max="100" step="1">
     
  </div>