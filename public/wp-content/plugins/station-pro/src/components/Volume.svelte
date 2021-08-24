<script>
  import { createEventDispatcher } from "svelte";
  import { onMount } from "svelte";
  import { fade } from "svelte/transition";
  const dispatch = createEventDispatcher();

  export let value = "0";
  export let volume = value;
  export let show;

  const muteVol = () => {
    volume = 0.01;
  };
  const change_volume = () => {
    dispatch("vol", {
      change: volume,
    });
  };
</script>

<button
  on:click={muteVol}
  on:focus
  on:mouseover={() => {
    show = !show;
  }}
  class="material-icons focus:outline-none  text-white"
>
  {#if volume > 0.01}
    volume_up
  {:else}
    volume_off
  {/if}
</button>

<div class="relative right-20">
  {#if show}
    <input
      in:fade={{ duration: 300 }}
      out:fade={{ deley: 300 }}
      orient="vertical"
      on:mouseleave={() => {
        show = !show;
      }}
      on:change={change_volume}
      bind:value
      type="range"
      class="rounded-lg  overflow-hidden appearance-none"
      min="0.0"
      max=".99"
      step=".01"
    />
  {/if}
</div>

<style>
  @media screen and (-webkit-min-device-pixel-ratio: 0) {
    input[type="range"][orient="vertical"] {
      writing-mode: bt-lr; /* IE */
      -webkit-appearance: slider-vertical; /* WebKit */
      width: 20px;
      height: 125px;
      background: rgb(0, 174, 255);
      padding: 0 5px;
      cursor: -webkit-grab;
      margin-left: 74px;
      margin-bottom: 90px;
    }
  }

  input[type="range"][orient="vertical"]::-moz-range-thumb {
    -moz-appearance: none;
    -webkit-appearance: none;
    border: 2px solid;
    border-radius: 50%;
    height: 15px;
    width: 15px;
    max-width: 80px;
    position: relative;
    bottom: 11px;
    background-color: #1a172c;
    cursor: -moz-grab;
    -moz-transition: border 1000ms ease;
    transition: border 1000ms ease;
  }

  input[type="range"][orient="vertical"]::-webkit-slider-runnable-track {
    -webkit-appearance: none;
    -moz-appearance: none;
    background: rgb(180, 231, 255);
    height: 2px;
  }

  input[type="range"][orient="vertical"]::-moz-slider-runnable-track {
    -webkit-appearance: none;
    -moz-appearance: none;
    border-radius: 50%;
    background: rgb(180, 231, 255);
    height: 2px;
  }

  input[type="range"][orient="vertical"]:focus {
    outline: none;
  }

  input[type="range"][orient="vertical"]::-webkit-slider-thumb:active {
    cursor: -webkit-grabbing;
  }

  input[type="range"][orient="vertical"]::-moz-range-thumb:active {
    cursor: -moz-grabbing;
  }
</style>
