<?php 
	include 'head.php';
	include 'navbar-top.php';
	include 'nav-side-menu.php';
	include 'db_con.php';
	include 'func-robot.php';
	include 'config.php';
	
	//Play Video on Robot
	$ID = (int) $_GET['ID'];
	$cmd = $_GET['cmd'];
	if($cmd == "play" AND $ID > 0){
		$sql = "SELECT file_name FROM media_files WHERE ID='$ID'";
		$res = mysqli_query($conn, $sql);
		$result = mysqli_fetch_assoc($res);
		play_media($media_sources."videos/".$result['file_name']);
	}
?>
<body>

		<div class="gallery-scripts-content">
		
			<?php 
			$sql = "SELECT * FROM media_files WHERE content_type=3";
			$res = mysqli_query($conn, $sql);
			if(mysqli_num_rows($res) == 0){ ?>
				<div id="no-files-found"><h1 class="no-files-found">No files found.</h1></div>
			<?php
			}
			else{
				$sql = "SELECT * FROM media_files WHERE content_type=3";
				$res = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($res)){
					$dir = $media_sources."videos/";
					$videoPath = $root_dir."uploads/videos/".$row['file_name'];
					//$musicSRC = $media_sources . "audios/" . $row['file_name'];
					if(file_exists($videoPath)){ ?>
							<div class="gallery-scripts">
									<video width="250" controls>
										<source src="<?=$dir.$row['file_name']?>" type="video/mp4">
									</video>
									<div class="script-name">
										<?php
											$file = $row['file_name'];
											if(strlen($file) - getExtension($file) > 10) {
												$subFileName = substr($file, 0, 10);
												echo $subFileName . "." . getExtension($file);
											} 
										?>
									</div>
									<div class="buttonVideoPlay" style="text-align: center;"><a href="view_videos.php?cmd=play&ID=<?php echo $row['ID'];?>" style="color: black;text-decoration: none;display: inline-block;"> PLAY </a>
							</div>
					<?php 
						}
					} 
				} ?>
		</div>

		<div class="uploader" style="display: none;">
			<form id="upload_file" enctype="multipart/form-data">
				<input type="file" name="file" />
				<input type="submit" name="submit" value="Upload" /> 
				<input type="hidden" name="type" value="3" /> 
				<br /> 
				<b id="file_upload_status"> 
				</b>
			</form>
		</div>

<?php
	function getVideoName($fileName){
		$nameToArray = explode('.', $fileName);
		return $nameToArray[0];
	}
	
	function getExtension($fileName){
		$nameToArray = explode('.', $fileName);
		return end($nameToArray);
	} 
include 'footer.php'; ?>
