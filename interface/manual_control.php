<?php
	include 'head.php';  
	include 'navbar-top.php';
	include 'nav-side-menu.php';
?>

	<script type="text/javascript">
	
	var ros = new ROSLIB.Ros({
		url: 'ws://localhost:9090'
	});

	ros.on('connection', function(){
		console.log('Connected to websocket server.');
	});

	ros.on('error', function(error){
		console.log('Error connecting to websocket server: ', error);
	});

	ros.on('close', function(){
		console.log('Connection to websocket server closed.');
	});
   
     var cmdVel = new ROSLIB.Topic({
       ros : ros,
       name : '/cmd_vel_mux/input/teleop',
       messageType : 'geometry_msgs/Twist'
     });
   
     var twistLeft = new ROSLIB.Message({
       linear : {
         x : 0.2,
         y : 0.0,
         z : 0.0
       },
       angular : {
         x : 0.0,
         y : 0.0,
         z : 1.0
       }
     });

     var forward = new ROSLIB.Message({
       linear : {
         x : 0.5,
         y : 0.0,
         z : 0.0
       },
       angular : {
         x : 0.0,
         y : 0.0,
         z : 0.0
       }
     });

     var twistRight = new ROSLIB.Message({
       linear : {
         x : 0.2,
         y : 0.0,
         z : 0.0
       },
       angular : {
         x : 0.0,
         y : 0.0,
         z : -1.0
       }
     });


    /* var listener = new ROSLIB.Topic({
       ros : ros,
       name : '/cmd_vel',
       messageType : 'geometry_msgs/Twist'
     });
   
     listener.subscribe(function(message) {
       console.log('Received message on ' + listener.name + ': ' + message.data);
       listener.unsubscribe();
     }); */
       
    $( document ).ready(function() {
    	console.log( "ready!" );
		$(document).bind('keypress', function(e){
	       if(e.keyCode == 37){
		   		cmdVel.publish(twistLeft);
		   		var leftKey = $('#left');
		   		
		   		leftKey.removeClass('bg-dark text-white');
		   		leftKey.addClass('bg-light text-dark');	
		   }
		   else if(e.keyCode == 39){
		   		cmdVel.publish(twistRight);
		   		$('#right').removeClass('bg-dark text-white');
		   		$('#right').addClass('bg-light text-dark');
		   }
		   else if(e.keyCode == 38){
		   		cmdVel.publish(forward);
		   		$('#up').removeClass('bg-dark text-white');
		   		$('#up').addClass('bg-light text-dark');
		   }
	    });

    });       

	</script>
	
	<div class="content">
		<div id="canvas_container">
			<div id="keyboard_control">
				<div class="row">
					<div id="up" class="arrows bg-dark text-white">Up</div>
				</div>
				<div class="row">
					<div id="wrapper">
						<div id="left" class="arrows bg-dark text-white"><!--<i class="fas fa-arrow-left"></i>-->Left</div>
						<div id="down" class="arrows bg-dark text-white">Down</div>
						<div id="right" class="arrows bg-dark text-white">Right</div>
				</div>
			</div>			
		</div>
	</div>

<?php	
	include 'footer.php';
?>
