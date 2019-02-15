<?php
	include 'config.php';
	unset($status);
	/*if(isset($_POST['submit'])){
		$fileName = $_POST['script_name'];
		$file = "/usr/hosting/robotic-bg/edu.robotic.bg/iliyan/interface/scripts/".$fileName;
		$status = file_put_contents($file, $_POST['codemirror-value']);

		if(!$status){
			header('Location: '."http://edu.robotic.bg/iliyan/interface/index.php?create_status=error");
		}
		else{
			header('Location: '."http://edu.robotic.bg/iliyan/interface/index.php?create_status=success");
		}
	}
	else{
		header('Location: '."http://edu.robotic.bg/iliyan/interface/index.php");
	}*/
	
	$fileName = $_POST['filename'];
	$code = $_POST['codemirror_value'];

	$file_path = $saved_scripts_dir . $fileName;

	$written = file_put_contents($file_path, $code);
	
	if(!$written){
		$status.="ERROR";
	}
	else {
		$status.= "SUCCESS";
	}
	
	echo $status;
	
?>