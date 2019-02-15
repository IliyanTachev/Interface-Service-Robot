<?php include 'head.php'; ?>
<body>
<?php 
	include 'navbar-top.php';
	include 'nav-side-menu.php';
	extract($_GET);
	$url = "script.php?cmd=edit&filename=";
	
	if($cmd == "del") {
		if($status == "success"){ ?>
				<script>
					$( document ).ready(function() {
						var deleteDialog = $('#deleteStatus');
						deleteDialog.fadeIn();
    					$('#deleteStatus').delay(2000).fadeOut();
					});
				</script>	
		<?php } 
			else if($status == "error"){ ?>
				<script>
					$(document).ready(function() {
						var deleteDialog = $('#deleteStatus');
						deleteDialog.text("Unexpected error occured while deleting your file!");
						deleteDialog.fadeIn();
						deleteDialog.delay(2000).fadeOut();	
					});
				</script>
		<?php }
	}
	else if($cmd == "execute"){ 
		$url = "script.php?cmd=execute&filename=";
	}
?>
	
	<div class="alert alert-info" id="deleteStatus" role="alert">
	  	Your file was successfully deleted!
	</div>
	
	<div class="content col-lg-10 scripts-view">
		<?php
		if(is_dir_empty()){ ?>
			<div id="no-files-found"><h1 class="no-files-found">No files found.</h1></div>
		<?php
		}
		else{
				
			$dir = scandir($saved_scripts_dir);
			foreach($dir as $file){
				if(strstr(strtolower($file), ".php")) { ?>
					
						<a href="<?=$url . $file?>" class="script-view-link"><img src="<?=$files_dir ?>script_image.png" class="script-image" name="<?= $file ?>"/>
						<div class="script-name">
							<?php
								if(strlen($file) - 3 > 10){
									$subFileName = substr($file, 0, 10);
									echo $subFileName . ".php";
								} 
							  else{
							  	echo $file;
							  }
							?>
				  		</div>
				<?php }
			} 
		}?>
	</div>
	<button type="button" class="btn btn-info edit-script-btn">Save</button>
	<div class="edit-script">
		<textarea id="editor"></textarea>
	</div>
<?php
	function is_dir_empty(){
		global $saved_scripts_dir;

		$dir = scandir($saved_scripts_dir);
		$dots = array(".", "..");
		$i=0;
		foreach($dir as $file){
			if(!in_array($file, $dots))
			$i++;
		}

		if($i==0) return true;
		return false;
	}

 include 'footer.php';
?>