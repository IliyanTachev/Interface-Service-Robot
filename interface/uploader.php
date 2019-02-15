<?php
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
	include 'config.php';
	
	unset($msg);
	unset($fileNameNew);
	$type = (int)$_POST['type'];
	
	$file = $_FILES['file'];
	$fileName= $file['name'];
	$tmpFileName= $file['tmp_name'];
	$fileError= $file['error'];
	$fileSize= $file['size'];
		
	if($fileError){
			//echo $fileError;
			$msg.= "$fileError There was an error uploading your file!\n";
		}
		else{
			$nameToArray = explode(".", $fileName);
			$realExtension = strtolower(end($nameToArray));
			$allowed="";
			$dir="";
			$url_source="";
				
			if($type == 1){
				$allowed = $allowed_image_formats;
				$dir = $upload_dir . "images/";
				upload_file($allowed, $dir);
				$url_source = $media_sources . "images/$fileNameNew";
			}
			else if($type == 2){
				$allowed = $allowed_audio_formats;
				$dir = $upload_dir . "audios/";
				upload_file($allowed, $dir);
				$url_source = $media_sources . "audios/$fileNameNew";
			}
			else if($type == 3){
				$allowed = $allowed_video_formats;
				$dir = $upload_dir . "videos/";
				upload_file($allowed, $dir);
				$url_source = $media_sources . "videos/$fileNameNew";
			}
			
			echo "$url_source, $msg"; 
		}

	function upload_file($allowed, $dir){
		
		global $tmpFileName, $realExtension, $msg, $fileNameNew;
		
		$allowedToString = implode(", ", $allowed);
					
		if(!in_array($realExtension, $allowed)){
			$msg.= "Unallowed file extension! Please choose from: " . $allowedToString . "\n";
		}
		else{

			if($fileSize > 10000000){ // 1000MB
				$msg.=  "Your file is too big!";
			}
			else{

				$fileNameNew = md5(rand(1,1000000).microtime()) . "." . $realExtension;
				$destinationFile = $dir . $fileNameNew;

				if(!move_uploaded_file($tmpFileName, $destinationFile)){
					$msg.= "Unexpected Error!\n";
				}
				else{
					$msg.= "File successfully uploaded!\n";
				}
			}
		}
	}
?>