$( document ).ready(function() {
	 	
	 	var toggleButton = $('#toggle-nav-btn');
		toggleButton.on('click', function(){
		if(toggleButton.hasClass('visible_pre')){
			//$("#navbarNav2").css("display", "block");
			$("#navbarNav2").slideDown();
			$("button").removeClass('visible_pre');
		}
		else {
			$("#navbarNav2").slideUp();
			//$("#navbarNav2").css("display", "none");
			$("button").addClass('visible_pre');
		}
	});
		
	if($( window ).width() <= 505){
		$('#connected').html('<i class="fas fa-wifi system-icons"></i>');
	}else{
		$('#connected').html('<i class="fas fa-wifi system-icons"></i> connected'); 
	}
	
	$( window ).resize(function() {
		if($( window ).width() <= 505){
			$('#connected').html('<i class="fas fa-wifi system-icons"></i>');
		}
		else{
			$('#connected').html('<i class="fas fa-wifi system-icons"></i> connected');
		}
	});
	
	$('a.clickable').on("click", function () {
    	console.log("cuknato e");
       	if ($(this).hasClass('panel-collapsed')) {
       		$(this).parents('li').next().slideDown();
          	// $(this).parents('.active').find('.collapsein').slideDown();
       		$(this).removeClass('panel-collapsed');
       	}
       	else {
       		$(this).parents('li').next().slideUp();
       		$(this).addClass('panel-collapsed');
	   	}
    });
	 	
	 	console.log("running");
	/*$('.buttonImgShow').click(function(){
		$.ajax({
			url: "showImg.php",
			type: 'post',
			data: {"name": $(this).prev().find('img').attr('name')},
			success: function(output){
				console.log("Image showed: " + output);
			}
		});
	});*/
	//$('#executeSaveBtn').click(
	//	function(){
	//		$('#mainForm').submit();
	//		console.log("clicked");	
	//	}
	//);
});
	 // MODALS
			//var musicModal = $(".modal.music");
			/*var musicModal = "";
			var image_audio = $(".audio-image");
			var image = $('.image-gallery');

			image_audio.on("click", function(){
				musicModal = $(this).parents("div").find($('.modal.music'));
				musicModal.show();
			});

			image.on("click", function(){
				$(".modal-img").show();
				$(".modal-content").attr("src", $(this).attr("src"));
			});

			$(".close1").click(function(){
				//$('#music').pause();
				musicModal.hide();
			});

			$(".close2").click(function(){
				$('.modal-img').hide();
			});*/

		//UPLOAD A MEDIA FILE
		/*	$('#upload_file').submit(function(e){
				var myForm = new FormData(this);
				e.preventDefault();
				$.ajax({
					url: "uploader.php",
					type: 'post',
					data: myForm,
					processData: false,
					contentType: false,
					success: function(output){
						console.log(output);
						if(output){
							var data = JSON.parse(output);
							$('.images').append(
								'<div class="col-sm-6 col-md-4">  <a href="' + data.url + '" class="lightbox">'
								 + '<img src="' + data.url + '" class="gallery-images" alt="Image unavailable" name="' + data.msg + '"> </a> </div>');
						}
					}
				});

			});*/
			
  /*$('#formLogin').submit(function(e){
		e.preventDefault();
	 	
	 	var formData = $('#formLogin').serialize();
		$.ajax({
			url: "login.php",
			data: formData,
			type: 'post',
			success: function(output){
				var jsonObject = JSON.parse(output);
				if(jsonObject.error != ""){
					console.log("ERROR");
					location.href = "http://edu.robotic.bg/iliyan/interface/signin.php?error=" + jsonObject.error;
				}
				else{
					console.log("shto ne redirectvash be");
					location.href = "http://edu.robotic.bg/iliyan/interface/index.php";
				}
			}
		});
	});*/
	
  /*$('#formRegister').submit(function(e){
  	console.log("submitted");
		e.preventDefault();
	 	
	 	var formData = $('#formRegister').serialize();

		$.ajax({
			url: "register.php",
			data: formData,
			type: 'post',
			dataType: 'json',
			success: function(output){
				var jsonObject = JSON.parse(output);
				if(jsonObject.error != ""){
					window.location = "http://edu.robotic.bg/iliyan/interface/signup.php?error=" + jsonObject.error;
				}
				else{
					window.location = "http://edu.robotic.bg/iliyan/interface/signin.php?signup=success";
				}
			}
		})
	});*/
	
	/*$('.logout').click(function(e){
		e.preventDefault(); 
		$.ajax({
			url: "logout.php",
			success: function(output){
				if(output == "success"){
					location.href="signin.php?loggedOut=success";
				}
				else{
					location.href="index.php?loggedOut=error";
				}
			}
		}); 
		
		//return false; 
	}); */
	
/*	$(".gallery img").mouseover(
		function(){
			console.log("mouserover");
			$(".gallery img").popover({
        placement: 'bottom',
        html: 'true',
        title : '<span class="text-info"><strong>title</strong></span>'+
                '<button type="button" id="close" class="close" onclick="$(&quot;#example&quot;).popover(&quot;hide&quot;);">&times;</button>',
        content : 'test'
    	});
		}
	);
	$(".gallery img").popover({
        placement: 'bottom',
        html: 'true',
        title : '<span class="text-info"><strong>title</strong></span>'+
                '<button type="button" id="close" class="close" onclick="$(&quot;#example&quot;).popover(&quot;hide&quot;);">&times;</button>',
        content : 'test'
    	});
	
	
});*/
    
/*function deleteConfirm(){
	var deleteFlag = false;
	bootbox.confirm({
	   title: "Delete Confirmation",
	   message: "Are you sure you want to selete this script?",
		  buttons: {
		      cancel: {
		          label: '<i class="fa fa-times"></i> Cancel'
		      },
		      confirm: {
		          label: '<i class="fa fa-check"></i> Confirm'
		      }
		  },
		  callback: function (result) {
		  		deleteFlag = result;
		  }
  });*/
  //	return confirm('Please confirm deletion');

    //AJAX FUNCTIONS
    
    /*function ajax_read(url_cust, filename_cust, editor){
    	return $.ajax({
			url: url_cust,
			data: {action: 'read', filename: filename_cust},
			type: 'post',
			success: function(output){
		 		editor.setValue(output);
		 	}
		});
    }*/
    
   /* function ajax_write(url_cust, filename_cust, value){
    	return $.ajax({
				url: url_cust,
		  	data: {action: 'write', filename: filename_cust, code: value},
				type: 'post'
			});
    }
    
    function ajax_delete(url_cust, filename_cust){
    	return $.ajax({
			url: url_cust,
		    data: {action: 'delete', filename: filename_cust},
				type: 'post'
			});
    }*/
    
    function subName(name){
    	if(name.length > 10){
    		return name.substr(0, 10) + '.' + name.split('.').pop();
    	}
    }
    
    function cancel(){
			window.history.go(-1);	
		}
		
		
		function browse() {
      $("#fileInput").click();
      $("#fileInput").change(function(){
      	$("#upload_file").submit();
      });
   }

	// CREATE CODEMIRROR INSTANCE
	function initCodeMirror(){
		editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
			mode: "text/x-php",
			theme: "rubyblue",
			lineNumbers: true,
			matchBrackets: true
		});
	}
	
  //Client-Side password validation
	
	/*function validate_pass(){
		console.log("tuka sme")
		var reg_pass = document.getElementById("reg_pass");
		var reg_pass_confirm = document.getElementById("reg_pass_confirm");
		
		if(reg_pass.value != reg_pass_confirm.value){
			 reg_pass_confirm.setCustomValidity("Passwords Don't Match");
			 console.log("error");
		}
		else{
			reg_pass_confirm.setCustomValidity("");
			 console.log("success");
		}
	}*/
	
