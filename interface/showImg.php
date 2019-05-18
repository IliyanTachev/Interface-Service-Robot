<?php
	//include 'login.php';
	include 'config.php';
	include 'func-robot.php';
	$imgName = $_POST['name'];
	echo $imgName;
	show_image($upload_dir."images/".$imgName);
?>

