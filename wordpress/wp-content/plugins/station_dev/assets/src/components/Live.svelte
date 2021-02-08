<script>
    
    export let live;
 
</script>


{#if live == true }
<span class="text-xs font-semibold antialiased text-xs text-white shadow-md bg-red-600 p-1 rounded-md uppercase"
>Live</span>
{:else}
<span class="text-xs font-semibold antialiased text-xs text-white shadow-md bg-gray-500 p-1 rounded-md uppercase"
>Offline</span>
{/if}