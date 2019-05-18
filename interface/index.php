
<?php
	//include 'config.php';
	
	include 'head.php';
	include 'navbar-top.php';
	include 'nav-side-menu.php';
	include 'db_con.php';
?>
	<div>
		<h1 style="
    position: relative;
    top: 200px;
    left: 400px;
		">
			<?php 
				$sql = "SELECT names FROM operators WHERE cookie = '$_COOKIE[userID]' LIMIT 1";
				$res = mysqli_query($conn, $sql);
				$user = mysqli_fetch_assoc($res);
				echo "Welcome, " . $user['names'] . " !";
			?> 
		</h1>
	</div>
<?php	
	include 'footer.php';
?>
