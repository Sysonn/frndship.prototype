<?php
session_start();
require_once 'classes/Membership.php';
include ("includes/constants.php");
include ("classes/profileloader.php");

$membership = New Membership();
$membership->confirm_Member();
$email = $_SESSION['username'];

$newfetchID = $_GET['fetchid'];
$desc = $_POST['descbox'];
$chaturl="'chat.php?fetchid=" . $newfetchID  . "'";
$chatload = "$('#idiv').load(" . $chaturl . ")"; /*ajax load*/

  /*FRND NAME*/
  $fpID_sql = "SELECT * FROM Profiles WHERE profileID = '$newfetchID'";
  $fpID_query = mysqli_query($db, $fpID_sql);
  $fpID_fetch = mysqli_fetch_array($fpID_query,MYSQLI_ASSOC);
  $frndFirst = $fpID_fetch['firstName'];
  $frndLast = $fpID_fetch['lastName'];
  $frndLocation = $fpID_fetch['profilelocation'];

  /* Frnd Profile Image */
  $frndpicsql="SELECT * FROM ProfileImages WHERE profileID='$newfetchID'";
  $frndpicresult=mysqli_query($db,$frndpicsql);
  $frndpicrow=mysqli_fetch_array($frndpicresult,MYSQLI_ASSOC);
  $frndprofilesource=$frndpicrow['imgSource'];
  $frndprofileimgname=$frndpicrow['imgName'];

  $frndcoversource=$frndpicrow['coverSource'];
  $frndcoverimgname=$frndpicrow['coverName'];

  /* Frnd Profile Image */
  $frnddescsql="SELECT * FROM ProfileDesc WHERE profileID='$newfetchID'";
  $frnddescresult=mysqli_query($db,$frnddescsql);
  $frnddescrow=mysqli_fetch_array($frnddescresult,MYSQLI_ASSOC);
  $frnddesc=$frnddescrow['Description'];

?>


	<link rel="stylesheet" type="text/css" href="css/iframe.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/frnds.css"> -->
	<link rel="stylesheet" type="text/css" href="css/profile.css">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <script>

  jQuery('#masterdiv div').html('');

  </script>
	<!-- <?php echo("{$_SESSION['username']}"); ?> -->

	</br>
	</br>

	<div class="profileHeadContainer">
		<img onerror='this.src="media/profileimages/defaults/default.png"' src="<?=$frndprofilesource . $newfetchID . '/' . $frndprofileimgname; ?>" alt="test" class="profileImage" style="background-color: #FFF;" />
		<div id="profileName">
			<?php echo $frndFirst; echo " "; echo $frndLast; ?>
		</div>
		<div id="profileLocation" style="float: right;">
				<img src="media/location.png" style="height: 14px;"> <?php echo $frndLocation;?>
		</div>
	</div>

	<div id="profileCoverContainer">
		<div id="profileImageContainer">
		<img onerror='this.style.display = "none"' src="<?=$frndcoversource . $newfetchID . '/' . $frndcoverimgname; ?>" alt="test"/>
		</div>
	</div>

	<div class="profileDescBorder">

		<div class="profileDescContainer">

			<div id="desc">
			<textarea readonly style=" text-align: center; margin-top: 22px; width: 92%; height: 150px; padding: 10px; resize: none; font-family: arial; color: #999; font-size: 14px; border: none; outline: none; overflow: hidden;"> <?php echo $frnddesc; ?> </textarea>
			</div>


		<?php echo $msgtest; ?>
		</div>


	</div>
<br>
<div style="width: 80%; height: 80px; margin-right: auto; margin-left: auto;">
<?php

if(!empty( $_GET['fetchid'])){
    $isfrnd_sql = "SELECT * FROM frndsTable WHERE profileID = '$newfetchID' AND frndID = '$profileidprofile'";
    $isfrnd_query = mysqli_query($db, $isfrnd_sql);
    $isfrnd_fetch = mysqli_fetch_array($isfrnd_query,MYSQLI_ASSOC);
    $isfrndID_R = $isfrnd_fetch['requested'];
    $isfrndID_A = $isfrnd_fetch['accepted'];

    $isprofile_sql = "SELECT * FROM frndsTable WHERE frndID = '$newfetchID' AND profileID = '$profileidprofile'";
    $isprofile_query = mysqli_query($db, $isprofile_sql);
    $isprofile_fetch = mysqli_fetch_array($isprofile_query,MYSQLI_ASSOC);
    $isprofileID_R = $isprofile_fetch['requested'];
    $isprofileID_A = $isprofile_fetch['accepted'];


      if($isfrndID_R == '1' && $isfrndID_A == '1'){
        echo  '<div onclick='. $chatload . ' style=" display: block; text-decoration: none; color: inherit; height: 80px;">
              <div  id="LogOutButton" style="height: 30px; width: 80%; text-align: center;"> Message </div></div>';



      }
      elseif($isprofileID_R == '1' && $isprofileID_A == '1')
      {
        echo '<div onclick='. $chatload . ' style=" display: block; text-decoration: none; color: inherit; height: 80px;">
              <div  id="LogOutButton" style="height: 30px; width: 80%; text-align: center;"> Message </div></div>';


      }
      else
      {
          echo '<div  id="LogOutButton" style="height: 30px; width: 80%; text-align: center; color: #fff;"> Add Frnd </div>';
      }
  }
?>
</div>

<script>
$( document ).ready(function() {

  $(".profileHeadContainer").velocity("transition.slideDownBigIn", {duration: 800 });
  $(".profileDescContainer").velocity("transition.slideUpBigIn", {duration: 800 });
  $(".profileDescBorder").velocity("transition.slideUpBigIn", {duration: 800 });
});

</script>

	<br><br>
	<br><br>
	<br><br>
