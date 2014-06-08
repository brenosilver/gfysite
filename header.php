<div id="header">
	<a class="button" onclick="randomizePosts();">Randomize</a>
	
	<ul id="nav" class="floatRight">
		<li onclick="openLogin();">
		<?php
			if ($login->isUserLoggedIn() == true) {
				echo "logout";
			}
			else{
				echo "login / register";
			}
		?>
		</li>
	</ul>
	
	<div id="loginHeader">
		<a class="loginClose pointer" onclick="closeLogin();">close window</a>
	<?php
		if ($login->isUserLoggedIn() == true) {
	// the user is logged in. you can do whatever you want here.
	// for demonstration purposes, we simply show the "you are logged in" view.
	include("php-login-advanced/views/logged_in.php");

	} else {
		// the user is not logged in. you can do whatever you want here.
		// for demonstration purposes, we simply show the "you are not logged in" view.
		echo "<div class='floatLeft' style='padding-right:40px; border-right: 2px solid #D3D3D3;
'>";
		require_once('php-login-advanced/frontRegister.php');
		echo "</div>";
		echo "<div class='floatRight' style='padding-left:40px;>";
		include("php-login-advanced/views/front_not_logged_in.php");
		echo "</div>";
	}
	?>
	</div>
</div>