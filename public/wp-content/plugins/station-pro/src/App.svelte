<script>
  import Container from "./components/Container.svelte";

  import { setContext, onMount, afterUpdate, beforeUpdate } from "svelte";

  let get_logo = localStorage.getItem("image_logo");
  let metaData = localStorage.getItem("stationData");

  setContext("get_logo", get_logo);
  setContext("meta", metaData);

  import Nav from "./components/Nav.svelte";
</script>

<Container>
  <Nav />
</Container>

<style global lang="postcss">
  @tailwind base;
  @tailwind components;
  @tailwind utilities;
</style>
