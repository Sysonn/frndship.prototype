<?php
session_start();
require_once 'classes/Membership.php';
include ("includes/constants.php");
include ("classes/profileloader.php");

$membership = New Membership();
$membership->confirm_Member();
$email = $_SESSION['username'];

$desc = $_POST['descbox'];

/*update description*/
	if(!empty($_POST["dsubmit"])) {
		$qD = "UPDATE ProfileDesc SET Description = '$desc' WHERE profileID = '$profileidprofile'";
		$queryDesc = mysqli_query($db, $qD);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<script>


	window.onload = function(){
	var x = document.getElementById('dedit');
		x.style.display = 'none';
	};

	function toggleDiv() {
	var x = document.getElementById('dedit');
	var y = document.getElementById('desc');
    var z = document.getElementById('quil');
		if (x.style.display === 'none') {
			x.style.display = 'block';
			y.style.display = 'none';
            z.style.display = 'none';
		} else {
			x.style.display = 'none';
			y.style.display = 'block';
		}
	};

	</script>


	<link rel="stylesheet" type="text/css" href="css/iframe.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/frnds.css"> -->
	<link rel="stylesheet" type="text/css" href="css/profile.css">
</head>


	<div class="coverButton" style="float: left; margin-top: 8px; height: 30px; width: 50px; margin-left: 5px; margin-right: -80px; z-index: 11;"  onClick="$('#idiv').load('uploadcover.php');">
		<!-- <a href="uploadcover.php">Cover</a> -->
		<img src="media/coverbutton.png" style="width: 25px;"/>
	</div>

	<br>
	<br>

	<div class="profileHeadContainer">
		<img style onerror='this.src="media/profileimages/defaults/default.png"' src="<?=$profilesource . $profileid . '/' . $profileimgname; ?>" alt="test" class="profileImage" onClick="$('#idiv').load('uploadprofile.php');"/>
		<div id="profileName">
			<?php echo $namefirst; echo " "; echo $namelast; ?>
		</div>
		<div id="profileLocation" style="float:left;">
			<img src="media/location.png" style="height: 14px;"><?php echo $profilelocation;?>
		</div>
	</div>

	<div id="profileCoverContainer">
		<div id="profileImageContainer">
		<img onerror='this.style.display = "none"' src="<?=$coversource . $profileid . '/' . $coverimgname; ?>" alt="test" onClick="window.location = 'uploadcover.php';" />
		</div>
	</div>

	<div class="profileDescBorder">

		<div class="profileDescContainer">

			<!-- <div id="desc"><?php echo $desccontent; ?></div> -->
			<div id="desc">
			<textarea readonly style="text-align: center; margin-top: 22px; width: 100%; height: 150px; resize: none; font-family: arial; color: #999; font-size: 14px; border: none; outline: none; overflow: hidden;"> <?php echo $desccontent; ?> </textarea>
			</div>

			<form action="profile.php" method="post">
				<div id='dedit' style="display: none;">
				<textarea name="descbox"style="margin-top: 24px; width: 100%; height: 140px; resize: none; font-family: arial; color: #999; border-color: #ED4A4A; overflow: hidden; "><?php echo $desccontent; ?></textarea>
				<input type="submit" name="dsubmit" style="float: right; margin-top: 8px; border-radius: 15px; color: white; background-color: #ED4A4A; border: none; padding: 7px;"></input>
				</div>
			</form>

		<?php echo $msgtest; ?>
		</div>

		<div id='quil' style="float: right; margin-top: 55px; padding-right: 0px; right: 0px; margin-right: 10px;"  onClick="toggleDiv();">
			<img src="media/quil.png" style="width: 25px;"/>
		</div>


	</div>

	<br><br>
	<br><br>
	<br><br>
	<br><br>

	<div id="LogOutButton" class="LogOutButton" target="_parent" onClick="window.parent.location = 'login.php?status=loggedout';">
	<a target="_parent" href="login.php?status=loggedout">Log Out</a>
	</div>

	<br><br>
	<br><br>
	<br><br>

	<script>
	$( document ).ready(function() {

	  $(".profileHeadContainer").velocity("transition.slideDownBigIn", {duration: 600 });
	  $(".profileDescContainer").velocity("transition.slideUpBigIn", {duration: 600 });
		$(".profileDescBorder").velocity("transition.slideUpBigIn", {duration: 600 });
		$(".coverButton").velocity("transition.slideLeftBigIn", {duration: 600 });
		$(".LogOutButton").velocity("transition.slideUpBigIn", {duration: 600 });
	});

	</script>

</html>
