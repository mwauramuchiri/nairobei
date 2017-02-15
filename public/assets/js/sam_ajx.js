
function login(){
	var email = document.getElementById('login-form').elements['email'].value;
	var password = document.getElementById('login-form').elements['password'].value;
	var site_url = document.getElementById('site_url').value;
	if (email.length == 0 || password.length == 0) {
		$('.login-message').html('Please enter all fields');
	} else{

		jQuery.ajax(
		{
			type: 'POST',
			url: site_url.concat('/admin/user/login'),
			data: {
				ajax: true,
				password: password,
				email: email
			},
			success: function (response) {
				try{
					//console.log(response);
					/**
					*
					* TODO:
					*     work on re-routing issues
					*
					*/
					var err = response.error;
					var success = response.success;
					if (response.error) {
						$('.login-message').html(response.error);
					} else if (response.success) {
						$('.login-message').html('Login success!');
						$('.login-form').hide();
						//take them back where they came from or the default
					}

				}catch(e){
					/** 
					* aka something wierd happened
					* most likey the logic makes no sense
					* all exeption raised during  tests came from arrors in back end
					* 
					*/
					 $('.login-message').html("Sometimes code don't make sense!");
				}
			},
			error: function () {
				/**
				* something less but still wierd happened
				* most likely the url privided returns 404
				*
				* 
				*/

				$('.login-message').html("Error while request..."); 
			}
		});
	};
		
	}

function change_background (img_id,nihii) {
    
	var site_url = document.getElementById('site_url').value;
	if (nihii) {
		//alert();
		//return false;
	} else {
		jQuery.ajax(
		{
			type: 'POST',
			url: site_url.concat('/admin/site/background'),
			data: {
				ajax: true,
				id: img_id
			},
			success: function (response) {
                
				try{
					var err = response.error;
					var success = response.success;
					if (response.error) {
						alert(response.error);
					} else if (response.success) {
					//reorganize the images
					s_animate(img_id);
					}

				}catch(e){
					/** 
					* aka something wierd happened
					* most likey the logic makes no sense
					* all exeption raised during  tests came from arrors in back end
					* which were resolved 
					* 
					*/
					 alert("Sometimes code don't make sense!");
				}
			},
			error: function () {
                console.log(response);
				/**
				* something less but still wierd happened
				* most likely the url privided returns 404
				*
				* 
				*/

				alert("That link is probably broken"); 
			}
		});
	}
}

function s_animate (img_id) {
	
	$(".back_image").animate({
		width: '150px'
	}, {duration:100,queue: false});
	$("#".concat(img_id)).animate({
		width: '+=50px'
	}, {duration:200,queue: false});
}
/*function s_delete_img (id) {
	var site_url = document.getElementById('site_url').value;
	var uri = site_url.concat('/admin/site/delete_img');
	jQuery.ajax(
		{
			type: 'POST',
			url: site_url.concat('/admin/site/background'),
			data: {
				ajax: true,
				id: id
			},
			success: function (response) {
				try{
					var err = response.error;
					var success = response.success;
					if (response.error) {
						alert(response.error);
					} else if (response.success) {
					//reorganize the images
					s_animate(img_id);
					}

				}catch(e){
					/** 
					* aka something wierd happened
					* most likey the logic makes no sense
					* all exeption raised during  tests came from arrors in back end
					* which were resolved 
					* 
					*
					 alert("Sometimes code don't make sense!");
				}
			},
			error: function () {
				/**
				* something less but still wierd happened
				* most likely the url privided returns 404
				*
				* 
				*

				alert("That link is probably broken"); 
			}
		});
}*/

/*function s_img_upload () {
	$('#message').empty();
	var site_url = document.getElementById('site_url').value;
	var uri = site_url.concat('/admin/site/upload_back_image');
	alert(uri);
	//var file = document.getElementById('image-upload').elements['file'].value;
		jQuery.ajax(
		{
			type: 'POST',
			url: uri,
			data: {
				ajax: true,
				img: new FormData(this)
			},
			contentType: false,
			cache: false,
			processData: false,
			success: function (response) {
				alert(response);
				console.log(response);
				/*try{
					var err = response.error;
					var success = response.success;
					if (response.error) {
						alert(response.error);
					} else if (response.success) {

					}

				}catch(e){
					/** 
					* aka something wierd happened
					* most likey the logic makes no sense
					* all exeption raised during  tests came from arrors in back end
					* which were resolved 
					* 
					*
					 alert("Sometimes code don't make sense!");
				}*
			},
			error: function () {
				/**
				* something less but still wierd happened
				* most likely the url privided returns 404
				*
				* 
				*

				alert("That link is probably broken"); 
			}
		});
}*/
function show_img_dialog () {
	$('#image-upload').css('visibility','visible');
}