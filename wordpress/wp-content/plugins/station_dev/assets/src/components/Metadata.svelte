<script>
   import "../radio-libs/worker.min.js"
   navigator.serviceWorker.addEventListener('message', event => {
    if(event.origin != 'http://113fm-edge2.cdnstream.com/5117_128'){
        return;
    }
    var meta = event.data.msg;
    meta = meta.substring(meta.indexOf("'") + 1,meta.lastIndexOf("'"));
    document.querySelector('div').innerText = meta;
    console.log(meta);
});

</script>

<div class="p-1 mr-20">
    <img
      class="w-24 block h-24 duration-75 delay-500  rounded-xl absolute bottom-0"
      src="https://placeimg.com/640/480/natural"
      alt=""
    />
  </div>

  <div class="text-white antialiased text-xs md:text-base md:antialiased">
      <b class=""> PLAY NOW:</b> Marvio Rocha <br /></div>
