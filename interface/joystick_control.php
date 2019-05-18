<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">

    <title>Gamepad API buttons test page</title>

    <link rel="stylesheet" href="">
    <!--[if lt IE 9]>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
      #ball {
        width: 40px;
        height: 40px;
        border-radius: 20px;
        background-color: red;
        background-image: -webkit-radial-gradient(40% 40%, circle, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));;
        background-image: -moz-radial-gradient(40% 40%, circle, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));;
        background-image: -ms-radial-gradient(40% 40%, circle, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));;
        background-image: radial-gradient(circle at 40% 40%, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4));
        position: relative;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  </head>

  <body>
    <p id="gamepad-info">Waiting for Gamepad.</p>
    <div id="ball"></div>

  </body>

<script>
	$(document).ready(function(){
			var gamepadInfo = document.getElementById("gamepad-info");
var ball = document.getElementById("ball");
var start;
var a = 0;
var b = 0;
var last_a_position=0;
var last_b_position=0;
var rAF = window.mozRequestAnimationFrame ||
  window.webkitRequestAnimationFrame ||
  window.requestAnimationFrame;
var rAFStop = window.mozCancelRequestAnimationFrame ||
  window.webkitCancelRequestAnimationFrame ||
  window.cancelRequestAnimationFrame;
window.addEventListener("gamepadconnected", function() {
  var gp = navigator.getGamepads()[0];
  gamepadInfo.innerHTML = "Gamepad connected at index " + gp.index + ": " + gp.id + ". It has " + gp.buttons.length + " buttons and " + gp.axes.length + " axes.";
  gameLoop();
});
window.addEventListener("gamepaddisconnected", function() {
  gamepadInfo.innerHTML = "Waiting for gamepad.";
  rAFStop(start);
});
if(!('GamepadEvent' in window)) {
  // No gamepad events available, poll instead.
  var interval = setInterval(pollGamepads, 500);
}
function pollGamepads() {
  var gamepads = navigator.getGamepads ? navigator.getGamepads() : (navigator.webkitGetGamepads ? navigator.webkitGetGamepads : []);
  for (var i = 0; i < gamepads.length; i++) {
    var gp = gamepads[i];
    if(gp) {
      gamepadInfo.innerHTML = "Gamepad connected at index " + gp.index + ": " + gp.id + ". It has " + gp.buttons.length + " buttons and " + gp.axes.length + " axes.";
      gameLoop();
      clearInterval(interval);
    }
  }
}
function buttonPressed(b) {
  if (typeof(b) == "object") {
    return b.pressed;
  }
  return b == 1.0;
}
function gameLoop() {
  var gamepads = navigator.getGamepads ? navigator.getGamepads() : (navigator.webkitGetGamepads ? navigator.webkitGetGamepads : []);
  if (!gamepads)
    return;
  var gp = gamepads[0];
  if (buttonPressed(gp.buttons[0])) {
    b--; //gore
  } else if (buttonPressed(gp.buttons[2])) {
    b++; //dolu
  }
  if(buttonPressed(gp.buttons[1])) {
    a++; //dqsno
    
  } else if(buttonPressed(gp.buttons[3])) {
    a--; //lqvo
  }

  if(last_b_position < b){
 		 		$.ajax({
 		 			url: 'func-robot.php',
 		 			type: 'post',
 		 			data: {'func':'move', 'lin_speed':'-1.0'}
 		 		});
 	}
 	else if(last_b_position > b){
 		 		$.ajax({
 		 			url: 'func-robot.php',
 		 			type: 'post',
 		 			data: {'func':'move', 'lin_speed':'1.0'}
 		 		});
 	}
 	
 	
 	
  ball.style.left = a*2 + "px";
  ball.style.top = b*2 + "px";

  console.log("A(left-right)=%d", a);
  console.log("B(top-bottom)=%d", b);
  last_a_position = a;
  last_b_position = b;
  var start = rAF(gameLoop);
}
	});

</script>
</html>