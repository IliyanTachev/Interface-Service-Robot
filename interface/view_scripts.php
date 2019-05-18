	
	<?php
		//include 'login.php';
		if($delFlag){?>
			<div class="alert alert-info" id="deleteStatus" role="alert">
	  		Your file was successfully deleted!
			</div>
			<?php
		}
	?>
	
	<div class="content col-lg-10 scripts-view">
		<?php
		$sql = "SELECT * FROM scripts";
		$res = mysqli_query($conn, $sql);
		if(mysqli_num_rows($res) == 0){ ?>
			<div id="no-files-found"><h1 class="no-files-found">No files found.</h1></div>
		<?php
		}
		else{
			if($cmd == "") $cmd = "edit";
			else if($cmd == "executeview") $cmd = "execute";
			$sql = "SELECT * FROM scripts";
			$res = mysqli_query($conn, $sql);
			if(!$res) echo "ERROR: " . mysqli_error($conn);
			while($row = mysqli_fetch_assoc($res)){
				if(file_exists($saved_scripts_dir.$row['script_title'])){ ?>
					<a href="script.php?cmd=<?php echo $cmd;?>&ID=<?php echo $row['ID'];?>" class="script-view-link"><img src="<?=$files_dir ?>script_image.png" class="script-image" name="<?=$row['script_title']?>"/>
						<div class="script-name">
							<?php
								if(strlen($file) - 3 > 10){
									$subFileName = substr($row['script_title'], 0, 10);
									echo $subFileName . ".php";
								} 
							  else{
							  	echo $row['script_title'];
							  }
							?>
				  	</div>
			<?php	}
			}
		} 
		?>
	</div>
