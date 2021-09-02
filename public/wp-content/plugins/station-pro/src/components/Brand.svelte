<script>
  import { getContext } from "svelte";

  let meta = JSON.parse(getContext("meta"));
</script>

{#if meta.brand === "null"}
  <a
    title="Station PRO - Web Radio Player"
    target="_blank"
    href="http://stationpro.co"
    class="text-white font-bold shadow text-xs transition duration-500 rounded-full hover:bg-indigo-800  border-2 block bg-indigo-500  p-1"
  >
    by: StationPRO.co
  </a>
{/if}
