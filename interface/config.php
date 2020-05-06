<?php
	$site_ip = "10.10.10.10";
  //$site_ip = "192.168.1.120";
	$site_url = "//".$site_ip."/";
	$root_dir = "/var/www/html/";
	$files_root_dir = $root_dir . "interface/";
	$upload_dir = $root_dir."uploads/";
	$files_dir = $site_url . "interface/"; 
	$media_sources = $site_url . "uploads/";
	$saved_scripts_dir = $root_dir . "scripts/";
	$turtlebot_files_dir = "/var/www/html";
	
	//Media files allowed formats
	$allowed_image_formats = array("jpg", "png");
	$allowed_audio_formats = array("mp3", "wav");
	$allowed_video_formats = array("mp4", "flv", "avi");
	
?>
