<script>
  import { getContext, onMount } from "svelte";
  import { fly } from "svelte/transition";
  import Play from "./Play.svelte";
  import Volume from "./Volume.svelte";
  import Timer from "./Timer.svelte";
  import Share from "./Share.svelte";
  import Metadata from "./Metadata.svelte";
  import Brand from "./Brand.svelte";
  let loading = false;
  let meta = JSON.parse(getContext("meta"));
  onMount(async () => {
    loading = true;
  });
</script>

{#if loading}
  <nav
    in:fly={{ y: 100, duration: 1000 }}
    class="h-24 bg-{meta.bg_color}-500 mx-auto  {meta.transparent} flex justify-between items-center space-x-1 shadow px-14 mt-16"
  >
    <div class="text-white flex flex-1 flex-shrink-0  items-center space-x-3">
      <Metadata />
    </div>
    <div class="flex flex-1 space-x-2 items-center place-items-center">
      <Play />
    </div>

    <div class="flex items-center justify-items-end space-x-2">
      <Share />
      <Brand />
    </div>
  </nav>
  <p />
{/if}

<style>
  @import url("https://fonts.googleapis.com/icon?family=Material+Icons");
</style>
