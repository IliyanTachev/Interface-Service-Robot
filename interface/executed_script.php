<?php
	include 'config.php';
	
	switch($_SERVER['REQUEST_METHOD'])
	{
		case 'GET': 
			$query = $_SERVER['QUERY_STRING'];
			$parsed = explode("&",$query);
			$arguments="";
			foreach($parsed as $param){
				$pair = explode("=",$param);
				$arguments[$pair[0]] = $pair[1];
			}
			
			$file_dir = $saved_scripts_dir . $arguments['filename'];
			$file_content = file_get_contents($file_dir);
			eval(stripslashes($file_content));
		break;
	}
?>