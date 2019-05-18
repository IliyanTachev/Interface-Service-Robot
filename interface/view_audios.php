<?php 
	include 'head.php';
	include 'navbar-top.php';
	include 'nav-side-menu.php';
	include 'db_con.php';
	include 'func-robot.php';
	include 'config.php';
	
	//Play Music on Robot
	$ID = (int) $_GET['ID'];
	$cmd = $_GET['cmd'];
	if($cmd == "play" AND $ID > 0){
		$sql = "SELECT file_name FROM media_files WHERE ID='$ID'";
		$res = mysqli_query($conn, $sql);
		$result = mysqli_fetch_assoc($res);
		$url = "http:".$media_sources."audios/".$result['file_name'];
		echo $url;
		play_media($url);
	}
?>
<body>
		<div class="container gallery-container col-lg-9">

			<div class="tz-gallery">

        	<div class="row images">
		
			<?php 
			$sql = "SELECT * FROM media_files WHERE content_type=2";
			$res = mysqli_query($conn, $sql);
			if(mysqli_num_rows($res) == 0){ ?>
				<div id="no-files-found"><h1 class="no-files-found">No files found.</h1></div>
			<?php
			}
			else{
				$sql = "SELECT * FROM media_files WHERE content_type=2";
				$res = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($res)){
					$dir = $media_sources."audios/";
					$musicPath = $root_dir."uploads/audios/".$row['file_name'];
					$musicSRC = $media_sources . "audios/" . $row['file_name'];
					if(file_exists($musicPath)){ ?>
						<div class="gallery-scripts">
							  <a href="<?php echo $musicSRC;?>">
							 	  <img src="audio-file.png" class="audio-image" alt="Audio unavailable" name="<?php echo $row['file_name'];?>">
							 	  <div class="script-name">
										<?php 
											$file = $row['file_name'];
											if(strlen($file) - getExtension($file) > 10) {
												$subFileName = substr($file, 0, 10);
												echo $subFileName . "." . getExtension($file);
											} 
										?>
									</div>  
								</a>
								<div class="buttonMusicPlay" style="text-align:center;"><a href="view_audios.php?cmd=play&ID=<?php echo $row['ID'];?>" style="color: black;text-decoration:none;display:inline-block;"> PLAY </a>
						</div>
					<?php 
					} 
			}
		} ?>
				
				</div>
			</div>
		</div>

		<div class="uploader" style="display: none;">
			<form id="upload_file" enctype="multipart/form-data" method="post" action="uploader.php">
				<input type="file" name="file" id="fileInput" />
				<input type="hidden" name="type" value="2" /> 
			</form>
		</div>

<?php
	function getExtension($fileName){
		$nameToArray = explode('.', $fileName);
		return end($nameToArray);
	}
	include 'footer.php';
	mysqli_close($conn);
?>
