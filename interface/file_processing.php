<?php
	include 'config.php';
	extract($_POST);
	
	$filePath = $saved_scripts_dir . $filename;
	
	if($action === 'write' || $command === 'create'){

		$filePath = $saved_scripts_dir . $filename; 
			
		$writtenFileContents = file_put_contents($filePath, stripslashes($code));
			
		if(!$writtenFileContents){
			echo "error";
		}
		else{
			echo "success";
		}
		
		if($command === 'create'){
			if(!$writtenFileContents){
				header('Location: ' . $files_dir . 'view_scripts.php?cmd=create&status=error');
			}
			else{
				header('Location: ' . $files_dir . 'view_scripts.php?cmd=create&status=success');
			}
		}
	}
	else if($action === 'delete'){
		$status = unlink($filePath);
		if(!$status){
			echo "error";
		} else{
			echo "success";
		}
	}
?>