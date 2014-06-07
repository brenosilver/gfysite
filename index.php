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

	var eventt = new Event('loadPosts');
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
	
</script>
</head>

<body>

	<div id="header">
		<a class="button" onclick="randomizePosts();">Randomize</a>
		<!--<a class="button" onclick="reloadPage();">Randomize</a>-->
	</div>
	
	<div id="centerContainer">
		<?php include_once('scripts/mainLoop.php'); ?>
	</div>

	
	<script type="text/javascript" src="js/jsFunctions.js"></script>
</body>

</html>