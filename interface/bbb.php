<html>
	<head>
		
	</head>
	<body>
			<a href="#" id="zdr">ZDR</a>		
	</body>
</html>
<script>
	$(document).ready(function(){
		$('#zdr').click(function(){
			console.log("pressed");
			<?php 
				echo "zdr wa pressed";
			?>
		});
	});
</script>