<?php
session_start();

require_once 'classes/Membership.php';
$membership = new Membership();



// If the user clicks the "Log Out" link on the index page.
if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
	$membership->log_User_Out();
}

// Did the user enter a password/username and click submit?
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {
	$_SESSION['username'] = $_POST['username'];
	$response = $membership->validate_User($_POST['username'], $_POST['pwd']);
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">


<head>
<title>Frndship - Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#ED4A4A" />
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="css/m.frnd.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.ui.min.js"></script>
</head>
<body >


	<div id="LoginSmartScreen" style = "background-color: #ED4A4A; ">

	<!--Start Smart Screen-------->


		<div id="LoginMain" class="LoginMain" >

			<!--Start Content------------------------------------------------------------------>


			<img src="media/login_logo.png"
			style="
			width: 150px;
			margin-left: auto;
			margin-right: auto;
			display: block;
			margin-top: 30px;"></img>

			<form method="post" action="" id="login-form">
				<input type="text" name="username" value="" placeholder="Email"
				style="
				font-color: #999;
				border-radius: 10px;
				border-width: 0px;
				outline:none;
				height: 30px;
				width: 230px;
				font-family: 'Arial Black', Arial, sans-serif;
				font-size:14px;
				line-height:1.43em;
				letter-spacing: -1px;
				color: #ED4A4A;
				margin-top: 15px;

				padding-left: 10px;

				display: block;
				margin-left: auto;
				margin-right: auto;

				">
				<br>

				<input type="password" name="pwd" value="" placeholder="Password"
				style="
				font-color: #999;
				border-radius: 10px;
				border-width: 0px;
				outline:none;
				height: 30px;
				width: 230px;
				font-family: 'Arial Black', Arial, sans-serif;
				font-size:14px;
				line-height:1.43em;
				letter-spacing: -1px;
				color: #ED4A4A;

				margin-top: 20px;
				padding-left: 10px;

				display: block;
				margin-left: auto;
				margin-right: auto;
				">

				<br>

				<a href="login.php"
				style="
				color: #fff;
				font-family: arial;
				font-size: 10px;
				margin-left: auto;
				margin-right: auto;
				padding-top: 10px;
				text-align: center;
				display: block;

				">
				Forgot Password?
				</a>

				<br>

				<div style = "display: block; margin-left: auto; margin-right: auto; text-align: center; color: #f4ce42;">
				<?php if(isset($response)) echo "<h1 style=' font-family: arial; font-size: 12px;'>" . $response . "</h1>"; ?>
				</div>

				<br>
					<script>
						$("input").keypress(function(event) {
						if (event.which == 13) {
							event.preventDefault();
							$("form").submit();
							}
						});
					</script>

				<div id="LoginButtons" type="submit" onClick="document.forms['login-form'].submit();">Login</div>
				<br>

				<!--<input type="submit" id="submit" value="Login" name="submit" />-->
				<div id="LoginButtons" onClick="window.location = 'm.register.php';">Sign Up</div>
				<br><br><br>
			</form>


			<div id="LoginButtons" style="width: 30px;">?</div>




			<!--------------------------------------------------------------------->
		</div>


	</div>

	<script>
	$( document ).ready(function() {


	  $(".LoginMain").velocity("transition.slideUpBigIn", {duration: 1200 });
		$(".passClass").velocity("transition.slideUpBigIn", {duration: 1200 });

	});

	</script>




</body>
</html>
