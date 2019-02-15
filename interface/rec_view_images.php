<?php 
	include 'head.php';
	function getImgName($fileName){
		$nameToArray = explode('.', $fileName);
		return $nameToArray[0];
	}
?>
<body>
	<?php 
		include 'navbar-top.php';
		include 'nav-side-menu.php';
	?>

	<?php
		$dirPath = "/usr/hosting/robotic-bg/edu.robotic.bg/iliyan/interface/uploads/images";
		echo is_dir_empty();
		if(is_dir_empty()){ ?>
			<h1 class="no-files-found">No files found.</h1>
		<?}
		else{
	?>
				<div class="gallery-scripts-content">
					<?
						$dir = scandir($dirPath);
						foreach($dir as $file){ ?>
								<div class="gallery-scripts">
									<img src="/usr/hosting/robotic-bg/edu.robotic.bg/iliyan/interface/uploads/images/<?= $file ?>" class="script-image" name="<?= $file ?>"/>
									<div class="script-name"><?= getImgName($file) ?></div>
							  	</div>
							  	<? 
						} ?>
				</div>
				<form action="uploader.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="file" />
					<input type="submit" name="submit" value="Upload" /> 
					<br /> 
						<b id="file_upload_status"> </b>
				</form>
		<? }?>

<?php
	function is_dir_empty(){
		global $dirPath;

		$dir = scandir($dirPath);
		$i=0;
		foreach($dir as $file){
			$i++;
		}

		if($i==0) return true;
		return false;
	}
?>
<?php include 'footer.php';?>