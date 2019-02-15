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
		      <!--  <li class="nav-link">
			   		<a href="#" class="btn btn-danger"><i class="fa fa-power-off system-icons"></i><p>Emergency Stop</p></a>
		      </li>  -->
		    </ul>
		  </div> 
			<button class="navbar-toggler visible_pre d-lg-none ml-auto" type="button" aria-controls="navbarNav2" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class= "navbar-collapse" id="navbarNav2" style="display: none!important;">
		    <ul class="navbar-nav2">
		      <li class="nav-item active">
		        <a class="nav-link" href="#" style="color: white;">Robot Dashboard</a>
		      </li>
		      
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" style="color: white;" data-toggle="dropdown" id="navbarDropdown">Robot Scripts</a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="view_scripts.php">View Scripts</a>
		          <a class="dropdown-item" href="script.php?cmd=execute">Execute script</a>
				  <a class="dropdown-item" href="script.php?cmd=create">Create new script</a>
		        </div>
		      </li>
		      
		      <li class="nav-item">
		        <a class="nav-link" href="#" style="color: white;">Media Files</a>
		      </li>
		       <li class="nav-item">
		        <a class="nav-link" href="#" style="color: white;">Manual Control</a>
		      </li>
		       <li class="nav-item">
		        <a class="nav-link" href="#" style="color: white;">Settings</a>
		      </li>
		      <!-- <li class="nav-link">
			   		<a href="#" class="btn btn-danger"><i class="fa fa-power-off system-icons"></i><p>Emergency Stop</p></a>
		      </li> -->
		    </ul>
		  </div>

		</nav>
		  	
	</header>