<script>
  import {createEventDispatcher} from "svelte"
  
  const dispatch = createEventDispatcher();

  
  export let value = "0";
  export let volume = value;
  export let show;
 
  const change_volume = () => {
    dispatch('vol', {
      change: volume
    })
  }
 
</script>

<button on:mouseenter class="material-icons  text-white">
 
    {#if volume < 0.40 }
    volume_mute
    {:else if volume < 0.60 }
    volume_down
    {/if}
    {#if volume > 0.60 }
    volume_up
    {/if}
    
  </button>
 
  
  <div class="relative right-20">
    {#if show == true}
     <input  on:change={change_volume}  bind:value type="range"  class="rounded-full absolute  z-50 opacity-90 overflow-hidden 
     appearance-none transform rotate-90 bottom-14 left-2   cursor-pointer bg-gray-400 h-4 w-24" min="0.1" max=".99" step=".01" >
    {/if}
  </div>