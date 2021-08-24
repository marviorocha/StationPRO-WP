<script>
  import { fly } from "svelte/transition";
  export let live = false;
</script>

{#if live}
  <span
    in:fly={{ y: -100, duration: 2000 }}
    class="text-xs font-semibold antialiased text-xs text-white shadow-md bg-red-600 p-1 rounded-md uppercase"
    >On AIR</span
  >
{:else}
  <span
    out:fly={{ y: 100, duration: 1000 }}
    class="text-xs font-semibold antialiased text-xs text-white shadow-md bg-gray-500 p-1 rounded-md uppercase"
    >Offline</span
  >
{/if}
