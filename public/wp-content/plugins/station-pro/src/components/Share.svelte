<script>
  import { getContext } from "svelte";
  let meta = JSON.parse(getContext("meta"));
  var a2a_config = a2a_config || {};
  a2a_config.onclick = 1;
</script>

<svelte:head>
  <script async src="https://static.addtoany.com/menu/page.js"></script>
</svelte:head>

<!-- AddToAny BEGIN -->
<div
  class="a2a_kit a2a_kit_size_32 a2a_default_style"
  data-a2a-url={meta.root_url}
>
  {#if meta.shere[0]}
    <a class="a2a_button_facebook" />
  {/if}

  {#if meta.shere[1]}
    <a class="a2a_button_twitter" />
  {/if}

  {#if meta.shere[2]}
    <a class="a2a_button_whatsapp" />
  {/if}

  {#if meta.shere[3]}
    <a class="a2a_button_telegram" />
  {/if}

  {#if meta.shere[4]}
    <a class="a2a_button_linkedin" />
  {/if}

  {#if meta.shere[5]}
    <a class="a2a_button_pinterest" />
  {/if}

  {#if meta.shere[6]}
    <a class="a2a_button_email" />
  {/if}
</div>

<!-- AddToAny END -->
