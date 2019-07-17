<?php
session_start();
require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>

<!DOCTYPE HTML>
<html lang="en">


<head>
<title>Frndship</title>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
<meta name="theme-color" content="#ED4A4A"/>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="css/m.frnd.css">
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link rel="stylesheet" type="text/css" href="css/iframe.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.ui.min.js"></script>


<script>


		function setURL(url){
		document.getElementById('idiv').src = url;

		}

		$('a').click(function() {

		    alert('hello');

		});

/*********************************************/
			$(document).ready(function(){

			     var loadName = function(){
					  var url2 = $('#idiv').attr("src");

			      $('#idiv').load(url2);
						}


			$('#BBItem1').click(function(){
				$('#idiv').load('home.php');
			});
			$('#BBItem2').click(function(){
				$('#idiv').load('cat.php');
			});
			$('#BBItem3').click(function(){
				$('#idiv').load('sail.php');
			});
			$('#BBItem4').click(function(){
				$('#idiv').load('frnds.php');
			});
			$('#BBItem5').click(function(){
				$('#idiv').load('profile.php');
			});

			$('#TopSettings').click(function(){
				$('#idiv').load('settings.php');
			});


			loadName();
			});

</script>

</head>
<body>
<!--<div id="SmartScreenBorder">


-->
<div id="SmartScreen" style="overflow: hidden;">

	<!--Start Smart Screen-------->
		<div id="SSTopBar">

		<div id="TopBarTitle">Profile</div>
		<div id="TopSettings" onclick="setURL('settings.php); setTitle('Settings');"></div>
		</div>

		<div id="ContentMain">

	<!--Start Content------------------------------------------------------------>





		<script>


		function setTitle(title){
		document.getElementById('TopBarTitle').innerHTML = title;
		}
		</script>

			<!--<iframe id="iframe" src="home.php" frameBorder="0" style="margin-top: 40px; margin-bottom: 40px; height: 100%; width: 100%; overflow:auto;-webkit-overflow-scrolling:touch;"></iframe>-->
			<div id="idiv" src="profile.php" frameBorder="0" style="bottom: 80px; height: 100%; width: 100%; overflow: scroll; -webkit-overflow-scrolling: touch; overflow-x: hidden;"></div>
			<!--<div id="chat-box" style="margin-top: 40px; overflow: scroll; overflow-x: hidden; width: 100%; height: 70%; top: 0px;">why now</div>-->
	<!-------------------------------------------------------------------->

		</div>

		<div id="SSBottomBar" style="background: #ED4A4A;">

			<div class="BBItem" id="BBItem1" onclick="setURL('home.php'); setTitle('Home');">
				<img src="media/nav_buttons/home_button.png" class="BBImage" height = "30px" style="padding-top: 3px;">
			</div>

			<div class="BBItem" id="BBItem2" onclick="setURL('cat.php'); setTitle('Categories');">
				<img src="media/nav_buttons/flags_button.png" class="BBImage" height="25px" style="padding-top: 7px;">
			</div>

			<div class="BBItem" id="BBItem3" onclick="setURL('sail.html'); setTitle('Sail');">
				<img src="media/nav_buttons/sail_button.png" class="BBImage" height="30px" style="padding-top: 5px;">
			</div>

			<div class="BBItem" id="BBItem4" onclick="setURL('frnds.php'); setTitle('Frnds');">
				<img src="media/nav_buttons/frnds_button.png" class="BBImage" height="30px" style="padding-top: 5px;">
			</div>

			<div class="BBItem" id="BBItem5" onclick="setURL('profile.php'); setTitle('Profile');">
				<img src="media/nav_buttons/profile_button.png" class="BBImage" height="25px" style="padding-top: 7px;">
			</div>

		</div>
	<!------------------------>
	<!--</div>-->

	</div>
	<script>
	$( document ).ready(function() {

	  $(".BBItem").velocity("transition.bounceIn", {stagger: 175, drag: true, duration: 1200 });

	});

	</script>


</body>
</html>
