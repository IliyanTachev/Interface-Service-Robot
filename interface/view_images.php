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
		$dirPath = $upload_dir . "images/";
	?>

		<div class="container gallery-container col-lg-9">

			<div class="tz-gallery">

        	<div class="row images">
		
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
			
							<div class="col-sm-6 col-md-4">
							 	 <a href="<?=$site_url?>uploads/images/<?=$file?>" class="lightbox">
							 	 	<img src="<?=$site_url?>uploads/images/<?=$file?>" class="gallery-images" alt="Image unavailable" name="<?=$file?>">  
									<!--<div class="script-name">
										<?
											/*if(strlen($file) - getExtension($file) > 10) {
												$subFileName = substr($file, 0, 10);
												echo $subFileName . "." . getExtension($file);
											}*/
										?>
									</div>-->
								</a>
							 </div>
				
							
					<? 
						}
					} ?>
					
				<?	} ?>
				</div>
			</div>
		</div>
	
		<script>
    		baguetteBox.run('.tz-gallery');
		</script>

		<div class="uploader">
			<form id="upload_file" enctype="multipart/form-data">
				<input type="file" name="file" />
				<input type="submit" name="submit" value="Upload" /> 
				<input type="hidden" name="type" value="1" /> 
				<br /> 
				<b id="file_upload_status"> 
					<?
						if(isset($_SESSION['msg'])){
							echo $_SESSION['msg'];
							unset($_SESSION['msg']);
						}
					?>
				</b>
			</form>
		</div>

	<!--	<div class="modal-img">
			<span class="close">&times;</span>
			<img class="modal-content" />
		</div> -->

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
	
	function getExtension($fileName){
		$nameToArray = explode('.', $fileName);
		return end($nameToArray);
	}
?>
<?php include 'footer.php';?>