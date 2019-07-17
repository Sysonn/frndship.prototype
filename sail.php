<?php
session_start();
require_once 'classes/Membership.php';
include ("includes/constants.php");
include ("classes/profileloader.php");

$membership = New Membership();
$membership->confirm_Member();
$email = $_SESSION['username'];

$desc = $_POST['descbox'];

?>

<!DOCTYPE html>
<html>
<head>

    <script src="//cdnjs.cloudflare.com/ajax/libs/hammer.js/1.0.5/hammer.min.js"></script>

    <script type="text/javascript">

        var element = document.getElementByClassName('profileHeadContainer');
        hammertime.get('swipe').set({ direction: Hammer.DIRECTION_VERTICAL });
        hammertime.on('swipe', function(event){
                        alert("swiped!");
        });
        
    </script> 

	<link rel="stylesheet" type="text/css" href="css/iframe.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/frnds.css"> -->
    
</head>

	<br>
	<br>

	<div class="profileHeadContainer">
		<img style onerror='this.src="media/profileimages/defaults/default.png"' src="<?=$profilesource . $profileid . '/' . $profileimgname; ?>" alt="test" class="profileImage" />
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

	</div>


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
