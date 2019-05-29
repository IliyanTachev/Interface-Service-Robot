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
<html>
	<body>
			<div class="contentGallery col-10" style="position: relative;">
				<div class="baguetteBoxOne galleryImgs">
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
								  <a href="<?php echo $imageSRC;?>" class="lightbox" style="text-align: center;">
								 	  <img src="<?php echo $imageSRC;?>" class="gallery-images" alt="Image unavailable" name="<?php echo $row['file_name'];?>">  
									</a>
									<!--<div class="buttonImgShow"><a href="view_images.php?cmd=show&ID=<?php echo $row['ID']; ?>"> SHOW </a> -->
						<?php 
						} 
						//echo $row['file_name'];
					}
				} ?>
					
					</div>
				</div>
			<script>
	    		window.onload = function() {
	        	baguetteBox.run('.baguetteBoxOne');
	   			};
			</script>

			<div class="uploader" style="display: none;">
				<form id="upload_file" enctype="multipart/form-data" method="post" action="uploader.php">
					<input type="file" name="file" id="fileInput" />
					<input type="hidden" name="type" value="1" /> 
				</form>
			</div>
	</body>
</html>
<script>
	$(document).ready(function(){
  	/*$( window ).resize(function() {
			if($( document ).width() <= 991){
				$('.contentGallery').css("left", "0");
				$('.contentGallery').addClass("container");
				$('.galleryImgs').css("text-align", "center");
			}
			else if($( document ).width() >= 992) {
				$('.contentGallery').css({"position":"relative", "left":"260"});
				$('.contentGallery').removeClass("container");
				$('.galleryImgs').css("text-align", "");
			}
		});*/
  });
</script>
<?php
	function getExtension($fileName){
		$nameToArray = explode('.', $fileName);
		return end($nameToArray);
	}
	include 'footer.php';
	mysqli_close($conn);
?>
