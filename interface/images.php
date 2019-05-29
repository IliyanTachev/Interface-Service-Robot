<?php 
	//include 'login.php';
	include 'head.php';
	include 'navbar-top.php';
	include 'nav-side-menu.php';
	include 'db_con.php';
	include 'func-robot.php';
	
	//Show Image on Robot
	$ID = (int) $_GET['ID'];
	$cmd = $_GET['cmd'];
	if($cmd == "show" AND $ID > 0){	
		show_image($ID);
	}
?>
<body>
		<div class="container gallery-container col-lg-9">

			<div class="tz-gallery">

        	<div class="row images">
		
			<?php 
			$sql = "SELECT * FROM media_files";
			$res = mysqli_query($conn, $sql);
			if(mysqli_num_rows($res) == 0){ ?>
				<div id="no-files-found"><h1 class="no-files-found">No files found.</h1></div>
			<?php
			}
			else{
				$sql = "SELECT * FROM media_files WHERE content_type=1";
				$res = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($res)){
					$dir = $media_sources."images/";
					$imgPath = $root_dir."uploads/images/".$row['file_name'];
					$imageSRC = $media_sources . "images/" . $row['file_name'];
					if(file_exists($imgPath)){ ?>
						<div class="col-sm-6 col-md-3 gallery">
							  <a href="<?php echo $imageSRC;?>" class="lightbox">
							 	  <img src="<?php echo $imageSRC;?>" class="gallery-images" alt="Image unavailable" name="<?php echo $row['file_name'];?>">  
								</a>
								<div class="buttonImgShow"><a href="view_images.php?cmd=show&ID=<?php echo $row['ID']; ?>"> SHOW </a>
						</div>
					<?php 
					} 
					//echo $row['file_name'];
			}
		} ?>
				
				</div>
			</div>
		</div>
	
		<script>
    		baguetteBox.run('.tz-gallery');
		</script>

		<div class="uploader" style="display: none;">
			<form id="upload_file" enctype="multipart/form-data" method="post" action="uploader.php">
				<input type="file" name="file" id="fileInput" />
				<input type="hidden" name="type" value="1" /> 
			</form>
		</div>

	<!--	<div class="modal-img">
			<span class="close">&times;</span>
			<img class="modal-content" />
		</div> -->

<?php
	function getExtension($fileName){
		$nameToArray = explode('.', $fileName);
		return end($nameToArray);
	}
	include 'footer.php';
	mysqli_close($conn);
?>
