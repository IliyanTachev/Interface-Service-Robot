<?php 
	include 'head.php';
	session_start();
?>
<body>
	<?php 
		include 'navbar-top.php';
		include 'nav-side-menu.php';
	?>

	<?php
		$dirPath = $upload_dir . "audios/";
	?>

		<div class="gallery-scripts-content">
		
			<? 
			if(is_dir_empty()){ ?>
				<div><h1 class="no-files-found">No files found.</h1></div>

				<?
			}
			else{
					$dir = scandir($dirPath);
					$dots = array(".", "..");
					foreach($dir as $file){ 
						if(!in_array($file, $dots)) {
					?>
							<div class="gallery-scripts">
									<img src="https://img.icons8.com/color/1600/audio-file.png" class="audio-image" name="<?=$file?>"/>
									<div class="script-name">
										<?
											if(strlen($file) - getExtension($file) > 10) {
												$subFileName = substr($file, 0, 10);
												echo $subFileName . "." . getExtension($file);
											} 
										?>
									</div>
								    <div class="modal music">
										<span class="close1">&times;</span>
										<video controls name="media" id="music">
											<source src="http://edu.robotic.bg/iliyan/uploads/audios/<?=$file?>" type="audio/mpeg" id="source">
										</video>
									</div>
							</div>
							
					<? 
						}
					}
					 
				} ?>
		</div>

		<div class="uploader">
			<form id="upload_file" enctype="multipart/form-data">
				<input type="file" name="file" />
				<input type="submit" name="submit" value="Upload" /> 
				<input type="hidden" name="type" value="2" /> 
				<br /> 
				<b id="file_upload_status"> 
				</b>
			</form>
		</div>

<?php
	function is_dir_empty(){
		global $dirPath;

		$dir = scandir($dirPath);
		$dots = array(".", "..");
		$i=0;
		foreach($dir as $file){
			if(!in_array($file, $dots))
			$i++;
		}

		if($i==0) return true;
		return false;
	}
	
	function getAudioName($fileName){
		$nameToArray = explode('.', $fileName);
		return $nameToArray[0];
	}
	
	function getExtension($fileName){
		$nameToArray = explode('.', $fileName);
		return end($nameToArray);
	}
?>
<?php include 'footer.php';?>