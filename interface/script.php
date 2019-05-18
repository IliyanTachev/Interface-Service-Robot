<?php
		//include 'login.php';
		require 'db_con.php';
		include 'head.php'; 
		include 'navbar-top.php';
	 	include 'nav-side-menu.php'; 
	 	include 'func-robot.php';
		
		$cmd = $_GET['cmd'];
		$ID = (int) $_GET['ID'];
		
		if($cmd == "delete"){
			$sql = "SELECT script_title FROM scripts WHERE ID='$ID'";
			$res = mysqli_query($conn, $sql);
			if($res) $row = mysqli_fetch_assoc($res);
			else echo mysqli_error($conn);
			$filename = $row['script_title'];
			
			$sql = "DELETE FROM scripts WHERE ID='$ID'";
			$res = mysqli_query($conn, $sql);
			$delStatus = unlink($saved_scripts_dir.$filename);
			
			if($res AND $delStatus) {
				$cmd = "";
				$delFlag = true;
			}
		}
		
		if($cmd == "exsavescript"){
			echo "<script>$( document ).ready(function() {"  
				."$('#mainForm').submit();" .
				"});" .
				"</script>";
			$exsaveFlag = true;
			$cmd = "save";
		}
		
		if($cmd == "save"){
			$scriptTitle = $_POST['scriptName'];
			$scriptCode = $_POST['code'];
			
			if($ID > 0){
				$sql = "SELECT script_title FROM scripts WHERE ID='$ID'";
				$row=mysqli_fetch_assoc(mysqli_query($conn, $sql));
				$res = true;
				
				if($row['script_title'] != $scriptTitle){
					$sql = "UPDATE scripts SET script_title='$scriptTitle', last_modified=NOW() WHERE ID='$ID'";
					$res = mysqli_query($conn, $sql);
					unlink($saved_scripts_dir.$row['script_title']);
				}
				else{
					$sql = "UPDATE scripts SET last_modified=NOW() WHERE ID='$ID'";
					$res = mysqli_query($conn, $sql);
				}
				
				$written = file_put_contents($saved_scripts_dir.$scriptTitle, stripslashes($scriptCode));
				
				//if($res AND $written) echo "<script>alert(\"Script was edited succesfully.\");</script>";
				if(!$res OR !$written) echo "<script>alert(\"An ERROR occured.\");</script>";
				if($_POST['stayOnPage']) $cmd="edit";
				else $cmd = "";
			}
			elseif($ID == 0){
				$sql = "SELECT ID FROM operators WHERE cookie='$_COOKIE[userID]' LIMIT 1";
				$res = mysqli_query($conn, $sql);
				$record= mysqli_fetch_assoc($res);
				$user_ID = $record['ID'];
				$sql = "INSERT INTO scripts SET script_title='$scriptTitle', create_date=NOW(), operator_ID='$user_ID'";
				$res = mysqli_query($conn, $sql);
				$written = file_put_contents($saved_scripts_dir.$scriptTitle, stripslashes($scriptCode));
				//if($res AND $written) echo "<script>alert(\"New script was created succesfully.\");</script>";
				//else  echo "<script>alert(\"An ERROR occured.\");</script>";
				$cmd="";
			}
			if(isset($_POST['executeSaveBtn'])){
				$cmd="execscript";
			}
		}
		
		if($cmd == "execscript"){
			if($ID > 0)
			{
				$sql = "SELECT script_title FROM scripts WHERE ID=$ID";
				$res = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($res);
				$code = file_get_contents($saved_scripts_dir.$row['script_title']);
				$sql = "UPDATE scripts SET last_executed=NOW() WHERE ID=$ID";
				$res = mysqli_query($conn, $sql);
				$out = eval($code);
				echo $out;
				$cmd="execute";
			}
		}
		
		if($cmd == "edit" || $cmd == "create" || $cmd == "execute"){
			if($ID > 0){
				$sql = "SELECT * FROM scripts WHERE ID=$ID LIMIT 1";
				$res = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($res);
				$filename = $row['script_title'];
				$filePath = $saved_scripts_dir . $filename;
				$file = file_get_contents($filePath);
			}
			elseif($ID == 0){
				$filename="";
				$file = "";
			} ?>
	
			<div class="content col-lg-10">
				<article>
					<div class="content-header">
						<header>
							<div class="header"><h4>Robot Scripts</h4></div>
						</header>
					</div>
					<div class="content-container">
						<div class="inside-header">
								<div id="header-title">
									<h4>Create New Robot Script</h4>
								</div>
								<div id="scriptSign">
									&lt;&gt;
								</div>
						</div>
						
						<div id="alerterror" class="alert alert-danger" role="alert" style="display: none;">
		  					Unexpected error!
						</div>
						
						<form id="mainForm" action="script.php?cmd=save&ID=<?=$ID?>" method="POST">
							
						  <div class="form-group">
						  	<div class="container">
						  		<div class="row">
						    		<label for="script_name">Script Name</label>
								</div>
						    	<div class="row">
						    		<div class="col-lg-6">
						    			 <input type="text" class="form-control" id="script_name" placeholder="Script name" name="scriptName" value="<?=$filename;?>">
						    		</div>
						    	</div>
						    </div>
						  </div>
					
						  <div class="form-group">
						  	<div class="container">
						  		<div class="row">
						    		<label for="code">Code</label>
						    	</div>
						    	<div class="row">
						    		<div class="col-lg-8">
						    			<textarea class="form-control" id="editor" name="code"><?=$file;?></textarea>	
						    		</div>
						    	</div>
						    	<div class="row" style="margin-top: 30px;">
						    		<div class="col-lg-8 buttons-row">	
						    		</div>
						    	</div>
						  	</div>
							</div>
							<?php 
								if($cmd == "edit"){ ?>
									<div class="form-check custom-checkbox">
							      <label class="form-check-label" for="check1">
							        <input type="checkbox" class="form-check-input" id="check1" name="stayOnPage" checked> Stay on page after save
							      </label>
							    </div>
									<?php
								}
							if($cmd != "execute") 
								echo "<button type=\"submit\" class=\"btn btn-info btn-lg\" name=\"saveBtn\" id=\"saveBtn\" style=\"margin-right: 10px;\">Save code</button>";
							else {
								echo "<a href=\"script.php?cmd=execscript&ID=$ID\"><button type=\"button\" class=\"btn btn-info btn-lg\" name=\"executeBtn\" id=\"executeBtn\" style=\"margin-right: 10px;\">Execute</button></a>";	
								echo "<button type=\"submit\" class=\"btn btn-info btn-lg\" name=\"executeSaveBtn\" id=\"executeSaveBtn\" style=\"margin-right: 10px;\">Save & Execute</button>";
							}
							?>
							
						<?php
							//javascript: return confirm('Please confirm deletion');
								if($cmd == "edit"){ 
									echo "<a onclick=\"return confirm('Are you sure you want to delete?');\" href=\"script.php?cmd=delete&ID=$ID\">
									<button type=\"button\" class=\"btn btn-danger btn-lg\">Delete</button></a>";
								}
							?>
								<button type="button" onclick="window.history.back();" class="btn btn-info btn-lg" name="cancelBtn" id="cancelBtn" style="margin-right: 10px;">Cancel</button>
						</form>
					</div>
				</article>
			</div>
		</div>
	</div>
	
	<script>
				var editor;
				initCodeMirror();
	</script>
	<?php	}
	if($cmd == "" || $cmd == "executeview"){
		include 'view_scripts.php';
	}
?>
