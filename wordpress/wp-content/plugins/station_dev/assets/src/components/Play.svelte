<script>
 let active = false;
  export let icon_play = "play_circle_outline";
  export let icon_pause = "pause_circle_outline";
  export let toggle = false;
</script>
 
<button id="player" on:click on:click={() => {toggle = !toggle}} class="transition transform duration-500 ease-in hover:scale-105">
  {#if toggle == true }
  <span class="material-icons md-36 fill-current relative z-10 text-blue-600 bg-white rounded-full 
  shadow-lg  hover:text-opacity-70">
     {icon_pause}
    </span> 
    <span
      class="animate-ping absolute top-2 left-2 z-1 rounded-full w-11 h-11 bg-white opacity-40"
      ></span>
      {:else}
      <span class="material-icons md-36 fill-current relative z-10 text-blue-600 bg-white rounded-full 
      shadow-lg  hover:text-opacity-70">
         {icon_play}
        </span> 
     
          {/if}
 </button>
  
    
<style>
  .material-icons.md-36 { font-size: 3.5em; }
 </style>