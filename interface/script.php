<?php include 'head.php'; ?>

<body>
	<?php 
		include 'navbar-top.php';
	 	include 'nav-side-menu.php'; 
		extract($_GET);
	?>
	
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
						
						<div id="alertsuccess" class="alert alert-success" role="alert" style="display: none;">
		  					New script was created successfully!
						</div>
						<div id="alerterror" class="alert alert-danger" role="alert" style="display: none;">
		  					Unexpected error!
						</div>
						
						<form id="mainForm" action="file_processing.php">
							
						  <div class="form-group">
						  	<div class="container">
						  		<div class="row">
						    		<label for="script_name">Script Name</label>
								</div>
						    	<div class="row">
						    		<div class="col-lg-6">
						    			 <input type="text" class="form-control" id="script_name" placeholder="Script name" name="filename" value="<?php echo "$filename";?>">
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
						    			<textarea class="form-control" id="editor" name="code" value="">
						    				<?php 
						    					if($filename != "")
						    						echo readfile($saved_scripts_dir . $filename);
						    				?>
						    			</textarea>	
						    		</div>
						    	</div>
						    	<div class="row" style="margin-top: 30px;">
						    		<div class="col-lg-8 buttons-row">	
						    		</div>
						    	</div>
						  	</div>
						</div>
						  
						 <input id="cmdPostParam" type="hidden" name="command" value="">
						
						</form>
					</div>
				</article>
			</div>
		</div>
	</div>
	
	<script>
			//var filename = parseUrl();
			var editor, filename, buttons;
			$( document ).ready(function() {
				initCodeMirror();
				filename = $('#mainForm input');
				buttons = $('.buttons-row');
			});
	</script>
	
	<?php
	if($cmd == "edit"){ ?>
		<script>
			$( document ).ready(function() {
				
				buttons.append('<button type="submit" class="btn btn-info btn-lg" name="create_new_script" id="save_btn" style="margin-right: 10px;">Save code</button>');
				buttons.append('<button type="button" class="btn btn-danger btn-lg" id="delete_btn">Delete</button>');
				buttons.append('<button type="button" class="btn btn-light btn-lg pull-right" style="border: 2px solid #CCCCCC;" id="cancel_btn" onclick="cancel();">Cancel</button>');
				
				//DELETE BUTTON AND DELETE EVENT
				var delete_btn = $('#delete_btn');
				
				delete_btn.on("click", function(){
					$.confirm({
					    title: 'Delete file',
					    content: 'Are you sure you want to delete: ' + filename.val() + ' ?',
					    buttons: {
					        confirm: function () {
					        	
						        var deleteStatus = function(output){
						        	if(output == "success"){
						        		location.replace("http://edu.robotic.bg/iliyan/interface/view_scripts.php?cmd=del&status=success");
						        	}
						        	else if(output == "error"){
						        		location.replace("http://edu.robotic.bg/iliyan/interface/view_scripts.php?cmd=del&status=error");
						        	}
						        }
						        
						        ajax_delete("file_processing.php", filename.val()).done(deleteStatus);		
					        	
					        },
					        cancel: function () {
					        }
					    }
					});
				});
		 		
		 		//FILENAME CHANGE EVENT
		 		$('#mainForm input').change(function(){
		 			$(this).closest('form').data('changed', true);
		 		});
		 		
		 		//SUBMIT THE FORM
		 		$('#mainForm').submit(function(e){
		 			if($(this).data('changed')){
		 				ajax_delete("file_processing.php", filename.val());
		 			}
		 		
					e.preventDefault();
					var value = editor.getValue();
				
					var editedStatus = function(output){
						if(output == "error"){
							$('#alerterror').show();
						}
						else if(output == "success"){
							$('#alertsuccess').text("This script was edited successfully!");
							$('#alertsuccess').show();
						}
					}
					var newFileName = $('#mainForm input').val();
					ajax_write("file_processing.php", newFileName, value).done(editedStatus);
				});
			});
		</script>
<?php		
	}
	else if($cmd == "create"){ ?>
		<script>
			$( document ).ready(function() {
				buttons.append('<button type="submit" class="btn btn-info btn-lg" name="create_new_script" id="save_btn" style="margin-right: 10px;">Save code</button>');
				buttons.append('<button type="button" class="btn btn-light btn-lg pull-right" style="border: 2px solid #CCCCCC;" id="cancel_btn" onclick="cancel();">Cancel</button>');
				filename.attr("value", "");
				editor.setValue("");
				$('#cmdPostParam').attr("value", "create");
			});
		</script>
<?php
	}
	else if($cmd == "execute"){ ?>
		<script>
			$( document ).ready(function() {
				
				//SET VALUE TO FILENAME FIELD
				var filenameField = $('#script_name');
				filenameField.prop("readonly", true);
				
				//var editor = $('.CodeMirror')[0].CodeMirror;
				console.log(editor);
				
						
				//SET FILE CONTENT AS A EDITOR VALUE
				/*var url_cust = 'file_processing.php';
				var data_cust = {action: 'read', filename: filename};
				var succ_func = function(output){
					editor.setValue(output);
				};
				
				ajax_custom(url_cust, data_cust).done(succ_func);*/
				//ajax_read("file_processing.php",filename, editor);
				
				//NO POINTER EVENTS OVER CODE MIRROR
				var codeEditor = $('.CodeMirror');
				codeEditor.css("pointer-events", "none");
				
				
				//BUTTONS
				buttons.append('<button type="button" class="btn btn-dark btn-lg" id="execute_btn" style="margin-right: 10px;">Execute</button>');
				buttons.append('<button type="button" class="btn btn-info btn-lg" id="edit_btn">Edit Mode</button>');
				buttons.append(' <button type="button" class="btn btn-light btn-lg pull-right" style="border: 2px solid #CCCCCC;" id="cancel_btn" onclick="cancel();">Cancel</button>');
				
				//IFRAME
				$('#execute_btn').click(function(){
					var url = "http://edu.robotic.bg/iliyan/interface/executed_script.php?filename=" + filename;
					var iframe = "<iframe src=" + url + " style=\"width: 100%; height: 500px;\"></iframe>";
					
					$('.left-side>h4').replaceWith('<button type="button" class="btn btn-default navbar-btn pull-left goback">' +
						'<i class="fas fa-chevron-left"></i></button>');
						
					$('.goback').click(function(){
						window.history.go(-1);
					});
    				
					$("form").hide();
					$('.content-container').append(iframe);	
				});
				
				//EDIT MODE
				$('#edit_btn').click(function(){
					console.log("editing mode out");
					codeEditor.css("pointer-events", "auto");
				});
			});
		</script>
	<?php
	}
?>
	<script>
		function cancel(){
			window.history.go(-1);	
		}
	</script>
		
	<!-- <div class="brand"><a href="#">MAIN MENU</a></div> -->
<?php include 'footer.php'; ?>