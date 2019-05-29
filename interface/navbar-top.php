<body>
	<header>
		<nav class="navbar fixed-top navbar-dark bg-primary" style="justify-content: initial;">
		  <a class="navbar-brand" href="index.php"><i class='fab fa-android'></i> Robot Control</a>
			
		   <div>
		    <ul class="navbar-nav">
		      <li class="nav-item active">
		        <a class="nav-link" href="#"><i class="fa fa-user system-icons"></i></a>
		      </li>
		      <li class="nav-item">
		       <div class="container">
		       		<a class="nav-link" href="#" style="color: white;"><i class="material-icons system-icons">battery_full</i><div class="d-none d-inline-block-lg">99%</div></a>
		       </div> 
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" id="connected" href="#" style="color: white;"></a>
		      </li>
	<!--	      <li class="nav-item">
		      	<a href="login.php?cmd=logout"><i class="fas fa-sign-out-alt logout-icon" style="font-size: 24px;"></i></a>
		        <!--<a class="nav-link logout" href="#" style="color: white;">Logout</a>-->
<!--		      </li>  --> 		
			    <li class="nav-item">
				   		<a href="func-robot.php?func=stop" class="btn btn-danger" id="emg_stop"><i class="fa fa-power-off system-icons" style="float: left;"></i><p style="display: inline-block;">Emergency Stop</p></a>
			      </li>  
		    </ul>
			    
		  </div> 
		  <?php getURLPage(); ?>
		  <button type="button" class="btn btn-dark ml-auto" onclick="browse();" id="upload-btn">Upload</button>
		  <a href="login.php?cmd=logout" style="margin-left: 30px;" class="ml-auto" id="logout-link"><i class="fas fa-sign-out-alt logout-icon" style="font-size: 28px; color: black;"></i></a>

			<button class="navbar-toggler visible_pre d-lg-none ml-auto" type="button" aria-controls="navbarNav2" aria-expanded="false" aria-label="Toggle navigation" id="toggle-nav-btn">
				<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class= "navbar-collapse" id="navbarNav2" style="display: none!important;">
		    <ul class="navbar-nav2">
		      <li class="nav-item active">
		        <a class="nav-link" href="#" style="color: white;">Robot Dashboard</a>
		      </li>
		      
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle dropdown-btn-scripts" href="#" style="color: white;" data-toggle="dropdown" data-ul="scripts">Robot Scripts</a>
		      </li>
		      <ul style="display: none;" class="ul-scripts-dropdown" data-name="scripts">
		      	<li><a class="dropdown-item" href="script.php">View Scripts</a></li>
		      	<li><a class="dropdown-item" href="script.php?cmd=execute">Execute script</a></li>
		      	<li> <a class="dropdown-item" href="script.php?cmd=create">Create new script</a></li>
		      </ul>
		      
		      
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle dropdown-btn-scripts" href="#" style="color: white;" data-toggle="dropdown" data-ul="media">Media files</a>
		      </li>
		      <ul style="display: none;" class="ul-scripts-dropdown" data-name="media">
		      	<li><a class="dropdown-item" href="view_images.php">Images</a></li>
		      	<li><a class="dropdown-item" href="view_audios.php">Audio Files</a></li>
		      	<li> <a class="dropdown-item" href="view_videos.php">Video Files</a></li>
		      </ul>
		       <li class="nav-item">
		        <a class="nav-link" href="manual_control.php" style="color: white;">Manual Control</a>
		      </li>
		       <li class="nav-item">
		       <a class="nav-link" href="#" style="color: white;">Settings</a>
			      </li>
			      <li class="nav-item" style="backgroung-color: grey;">
			      	<a href="login.php?cmd=logout"><i class="fas fa-sign-out-alt logout-icon" style="font-size: 24px;"></i></a>
			        <!--<a class="nav-link logout" href="#" style="color: white;">Logout</a>-->
			      </li>
			    </ul>
			  </div>

			</nav>
	</header>
	<script>
		$(document).ready(function(){
			$(".dropdown-btn-scripts").click(function(){
				var data = $(this).attr("data-ul");
				$(`ul[data-name='${data}']`).toggle("slow");
			});
		});
	</script>

<?php
		function getURLPage(){
		$rootPath = $_SERVER['PHP_SELF']; 
		$rootPathArr = explode('/', $rootPath);
		$page = end($rootPathArr);
		if($page == "view_images.php" || $page == "view_audios.php" || $page == "view_videos.php"){ ?>
			<script>
				$(document).ready(function(){
					$("#upload-btn").show();
					$("#logout-link").removeClass("ml-auto");
				});
			</script>
	<?php }
	}
?>
