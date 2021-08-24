<script>
  import { onMount, getContext, setContext } from "svelte";

  // Variable
  let logo = getContext("get_logo");
  let meta = JSON.parse(getContext("meta"));
  let play_now = meta.radio_name;

  // arrow function

  onMount(() => {
    play_now = localStorage.getItem("play_now")
      ? localStorage.getItem("play_now")
      : meta.radio_name;
  });
</script>

<img
  class="shadow w-16 h-16 bottom-2 block rounded-md"
  src={logo}
  alt={play_now}
/>
<p
  class="flex-1 w-32 break-words text-white antialiased text-xs md:text-base px-3 md:antialiased hidden md:block"
>
  {play_now}
</p>
