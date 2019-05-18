<?php
	ini_set('post_max_size', '64M');
	ini_set('upload_max_filesize', '64M');
	include 'config.php';
	include 'db_con.php';

	unset($msg);
	unset($fileNameNew);
	$type = (int)$_POST['type'];
	
	$file = $_FILES['file'];
	$fileName = $file['name'];
	$tmpFileName = $file['tmp_name'];
	$fileError = $file['error'];
	$fileSize = $file['size'];
	$ID=0;
		
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
				$new_name = upload_file($allowed, $dir);
				$url_source = $media_sources . "images/$new_name";
			}
			else if($type == 2){
				$allowed = $allowed_audio_formats;
				$dir = $upload_dir . "audios/";
				$new_name = upload_file($allowed, $dir);
				$url_source = $media_sources . "audios/$new_name";
			}
			else if($type == 3){
				$allowed = $allowed_video_formats;
				$dir = $upload_dir . "videos/";
				$new_name = upload_file($allowed, $dir);
				$url_source = $media_sources . "videos/$new_name";
			}
			
			$sql = "SELECT ID FROM media_files WHERE file_name='$new_name'";
			$res = mysqli_query($conn, $sql);
			$result = mysqli_fetch_assoc($res);
			
			if($type == 1){
				header("Location: " . "view_images.php");
			/*	echo "$('.images').append(
								'<div class=\"col-sm-6 col-md-4 gallery\">  <a href=\"' + $url_source + '\" class=\"lightbox\">'
								 + '<img src=\"' + $url_source + '\" class=\"gallery-images\" alt=\"Image unavailable\" name=\"' + $msg + '\"> </a>
								 + <div class=\"buttonImgShow\"><a href=\"view_images.php?cmd=show&ID=$result[ID]\"> SHOW </a> </div>');";*/
			}
			else if($type == 2){
				header("Location: " . "view_audios.php");
			/*	echo "$('.images').append(
								'<div class=\"col-sm-6 col-md-4 gallery\">  <a href=\"' + $url_source + '\" class=\"lightbox\">'
								 + '<img src=\"audio-file.png\" class=\"gallery-images\" alt=\"Image unavailable\" name=\"' + $msg + '\"> </a>
								 + <div class=\"buttonMusicPlay\"><a href=\"view_audios.php?cmd=play&ID=$result[ID]\"> PLAY </a> </div>');";*/
			} 
			else if($type == 3){
				header("Location: " . "view_videos.php");
			}
		}

	function upload_file($allowed, $dir){
		
		global $tmpFileName, $realExtension, $msg, $fileNameNew, $type, $conn;
		
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
				
				//Add to DB
				$sql = "INSERT INTO media_files SET file_name='$fileNameNew', content_type='$type', create_date=NOW(), operator_ID='1'";
				$res = mysqli_query($conn, $sql);
				if(!move_uploaded_file($tmpFileName, $destinationFile) || !$res){
					$msg.= "Unexpected Error!\n";
				}
				else{
					$msg.= "File successfully uploaded!\n";
				}
			}
		}
		return $fileNameNew;
	}
?>
