<?php
	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
		exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
		require_once('php-login-advanced/libraries/password_compatibility_library.php');
	}
	require_once('php-login-advanced/config/config.php');
	require_once('php-login-advanced/translations/en.php');
	require_once('php-login-advanced/libraries/PHPMailer.php');
	require_once('php-login-advanced/classes/Login.php');
	$login = new Login(); 
?>

<!DOCTYPE html>
<html>

<head>
	<title>Funny Bee</title>
	
	
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="gfycat_test_may18.js"></script>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

	
<script>

	//var eventt = new Event('loadPosts');
	//eventt.initEvent('loadPosts', false, true);
	var a = 0;

	function randomizePosts(){
	var myHtml = "";
		$.ajax({
				"type": "GET",
				"url":"http://funnybee.videohater.com/scripts/api.php",
				"dataType":"json"
			})
			.fail(function(){
				reloadPage();
			})
			.done(function(data){
				$.each(data, function( index, item ) {
					console.log("item: " + a++);
					myHtml += "<img class='gfyitem' data-controls='false' data-title='false' data-expand='false' data-autoplay='true' data-id='" + item.link + "' />";
					
				});
				// Populate main container
				$('#centerContainer').html(myHtml);
				
				// Refresh the page with new posts
				elem_coll = $(".gfyitem");
				for (var i = 0; i < elem_coll.length; i++) {
					var gfyObj1 = new gfyObject(elem_coll[i]);
					gfyObj1.init();
				}

			});	
	}
	
	// Reload Page
	function reloadPage(){
		document.location.href = "/";
	}
	
	function openLogin(){
		$("#loginHeader").show();
	}
	
	function closeLogin(){
		$("#loginHeader").hide();
	}

	$(document).ready(function(){
		// Close login Window when click outside
		$('body').click(function(e){
			if($(e.target).closest('#loginHeader').length === 0){
				if(e.target.tagName != "LI")
					closeLogin();
			}
		});
		
	});

	
</script>
</head>

<body>

	<?php require_once("header.php"); ?>
	
	
	<div id="centerContainer">
		<?php require_once('scripts/mainLoop.php'); ?>
				
	</div>

	
	<script type="text/javascript" src="js/jsFunctions.js"></script>
</body>

</html>