<?php 
	include 'head.php';
?>
<body>
	<?php 
		include 'navbar-top.php';
		include 'nav-side-menu.php';
	?>

	<?php
		$dirPath = $upload_dir . "videos/";
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
									<!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSG-ou4D1dAUyR0IdOEYlcwJsGgRIiJkYgGitICrMkQpVrgBbrg" class="script-image" name="<?= $file ?>"/> -->
									<video width="250" controls>
										<source src="<?=$media_sources?>videos/<?=$file?>" type="video/mp4">
									</video>
									<div class="script-name">
										<?
											if(strlen($file) - getExtension($file) > 10) {
												$subFileName = substr($file, 0, 10);
												echo $subFileName . "." . getExtension($file);
											} 
										?>
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
				<input type="hidden" name="type" value="3" /> 
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
	
	function getVideoName($fileName){
		$nameToArray = explode('.', $fileName);
		return $nameToArray[0];
	}
	
	function getExtension($fileName){
		$nameToArray = explode('.', $fileName);
		return end($nameToArray);
	}
?>
<?php include 'footer.php';?>