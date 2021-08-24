<script>
  import { onMount, getContext } from "svelte";
  import LiveOn from "./Live.svelte";
  import Volume from "./Volume.svelte";
  import { Howl, Howler } from "howler";

  let meta = JSON.parse(getContext("meta"));
  let play = meta.autoplay != "" ? true : false;
  let load = null;
  let live = false;
  export let server = meta.icecast != "" ? meta.icecast : meta.shoutcast;
  let volume = "0.5";
  let icon_play = "play_circle_outline";
  let icon_pause = "pause_circle_outline";
  let toggle = meta.autoplay != "" ? true : false;
  let show = false;

  let sound = new Howl({
    src: server,
    autoplay: meta.autoplay != "" ? true : false,
    html5: true,
    preload: true,
    usingWebAudio: true,
    format: ["mp3", "aac"],
  });

  const PlayAudio = async () => {
    play = !play;

    if (play) {
      load =
        "<img class='w-14 h-14' src='../../assets/images/preload.gif' alt='preload' /> <b class='text-white text-sm'>loading...</b>";
    } else {
      sound.stop();
      live = false;
    }
  };

  sound.once("load", function () {
    if (play) {
      sound.play();
      load = "";
      live = true;
    } else {
      sound.stop();
    }
  });

  const ChangeVolume = (event) => {
    sound.volume(event.detail.change);
  };
</script>

<button
  id="player"
  on:click
  on:click={PlayAudio}
  on:click={() => {
    toggle = !toggle;
  }}
  class="transition focus:outline-none transform duration-500 ease-in
  hover:scale-105"
>
  {#if toggle}
    <span
      class="material-icons md-36 fill-current relative z-10 text-blue-600 bg-white rounded-full 
  shadow-lg  hover:text-opacity-70"
    >
      {icon_pause}
    </span>
    <span
      class="absolute top-2 left-2 z-1 rounded-full w-11 h-11 bg-white opacity-40"
    />
  {:else}
    <span
      class="material-icons md-36 fill-current relative z-10 text-blue-600 bg-white rounded-full 
      shadow-lg  hover:text-opacity-70"
    >
      {icon_play}
    </span>
  {/if}
</button>

{#if load}
  {@html load}
{:else}
  <LiveOn {live} />
{/if}

<!-- Volume Component -->

<Volume
  on:mouseenter={() => {
    show = !show;
  }}
  {show}
  {volume}
  on:vol={ChangeVolume}
  bind:value={volume}
/>

<style>
  .material-icons.md-36 {
    font-size: 3.5em;
  }
</style>
