<?php 
	include 'head.php';
	include 'navbar-top.php';
	include 'nav-side-menu.php';
	include 'db_con.php';
?>
<body>
		<div class="container gallery-container col-lg-9">

			<div class="tz-gallery gallery">
		
			<?php 
			$sql = "SELECT * FROM media_files";
			$res = mysqli_query($conn, $sql);
			if(mysqli_num_rows($res) == 0){ ?>
				<div id="no-files-found"><h1 class="no-files-found">No files found.</h1></div>
			<?php
			}
			else{
				$sql = "SELECT * FROM media_files";
				$res = mysqli_query($conn, $sql);
				while($row = mysqli_fetch_assoc($res)){
					$dir = $media_sources."images/";
					$imgPath = $root_dir."uploads/images/".$row['file_name'];
					$imageSRC = $media_sources . "images/" . $row['file_name'];
					if(file_exists($imgPath)){ ?>
							  <a href="<?php echo $imageSRC;?>" class="lightbox">
							 	  <img src="<?php echo $imageSRC;?>" class="gallery-images" alt="Image unavailable" name="<?php echo $image;?>">  
								</a>
					<?php 
					} 
					//echo $row['file_name'];
			}
		} ?>
				
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
