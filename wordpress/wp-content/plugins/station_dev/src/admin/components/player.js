import $ from "jquery";
import { Howl, Howler } from "howler";

var sound = new Howl({
  src: ["sound.mp3"],
  loop: true,
  volume: 0.5,
  onend: function () {
    console.log("Finished!");
  },
});

$("#player").click(function () {
  sound.play();
});
