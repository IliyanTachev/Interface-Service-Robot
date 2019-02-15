	 $( document ).ready(function() {
	 	
	 	var toggleButton = $('button');
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
			$('#upload_file').submit(function(e){
				var myForm = new FormData(this);
				e.preventDefault();
				$.ajax({
					url: "uploader.php",
					type: 'post',
					data: myForm,
					processData: false,
					contentType: false,
					success: function(output){
						if(output.length > 0){
							var res = output.split(',');
							var urlParams = res[0].split('/');
							//alert(output);
							$("#file_upload_status").text(res[1]);
							
							if($('.no-files-found').is(':visible')) $('.no-files-found').hide();
							$('.images').append(
								'<div class="col-sm-6 col-md-4">  <a href="' + res[0] + '" class="lightbox">'
								 + '<img src="' + res[0] + '" class="gallery-images" alt="Image unavailable" name="' + urlParams[urlParams.length - 1] + '"> </a> </div>');
						}
					}
				});

			});
    });
    
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
    
    function ajax_write(url_cust, filename_cust, value){
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
    }
    
    //Parse URL
    function parseUrl(){
		var filename="";
		var fullURL = window.location.search.substring(1);
		var parameters = fullURL.split("&");
		for(var i = 0; i<parameters.length;i++){
			var currParam = parameters[i].split("=");
			if(currParam[0] == "filename") filename = currParam[1];
		}
		return filename;
    }
    
    function subName(name){
    	if(name.length > 10){
    		return name.substr(0, 10) + '.' + name.split('.').pop();
    	}
    }

	// CREATE CODEMIRROR INSTANCE
	function initCodeMirror(){
		editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
			mode: "text/x-php",
			theme: "rubyblue",
			lineNumbers: true,
			autoCloseTags: true,
			//autofocus: true,
			matchBrackets: true
		});
	}
