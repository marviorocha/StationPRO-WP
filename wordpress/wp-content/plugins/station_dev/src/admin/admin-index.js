/**
 * Admin entry point.
 *
 * src/admin/admin-index.js
 */
import React from "react";
import ReactDOM from "react-dom";

function Clock(props) {
  return (
    <div>
      <h1>Hello, world!</h1>
      <h2>It is {props.date.toLocaleTimeString()}.</h2>
    </div>
  );
}

function tick() {
  ReactDOM.render(<Clock date={new Date()} />, document.getElementById("app"));
}

setInterval(tick, 1000);

// import { Howl, Howler } from "howler";
// var sound = new Howl({
//   src: ["sound.mp3"],
//   autoplay: true,
//   loop: true,
//   volume: 0.5,
//   onend: function () {
//     console.log("Finished!");
//   },
// });
