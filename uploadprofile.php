<?php
session_start();
require_once 'classes/Membership.php';
include ("includes/constants.php");
include ("classes/profileloader.php");

$membership = New Membership();
$membership->confirm_Member();

$uploadresponse = "";


$target_dir = "media/profileimages/" . $_SESSION['sessionProfileID'] . "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$sql_file = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadresponse = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $uploadresponse = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $uploadresponse = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadresponse = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadresponse = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $uploadresponse = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

			$qP = "UPDATE ProfileImages SET imgName = '$sql_file' WHERE profileID = '$profileidprofile'";
			$queryProfile = mysqli_query($db, $qP);

				if($queryProfile){
					$uploadresponse = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				}
				else{
				$uploadresponse = "Sorry, there was an error assigning your profile image location." . $qP;
				}

    } else {
        $uploadresponse = "Sorry, there was an error uploading your file.";
    }
}
?>

<html>
<body style="background: #ED4A4A;">

<head>
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link rel="stylesheet" type="text/css" href="css/m.frnd.css">
</head>

<!--session email: <?php echo("{$_SESSION['username']}"); ?>-->

<!--session profileID: <?php echo("{$_SESSION['sessionProfileID']}"); ?>-->

<div style="width: 100%; display: block; marin-left: auto; margin-right: auto; text-align: center;">
<br>
	<div id="profileHeadContainer">
		<img src="<?=$profilesource . $profileid . '/' . $profileimgname; ?>" alt="test" class="profileImage" />
	</div>


<br><br><br>
<br><br><br>
<br><br>

<form action="uploadprofile.php" method="post" enctype="multipart/form-data">
    <div style="font-family: 'Arial Black', Arial, sans-serif;
				font-size:14px;
				line-height:1.43em;
				letter-spacing: -1px;
				color: #FFF;"> Select image to upload: </div>
    <input type="file" name="fileToUpload" id="fileToUpload"  accept="images/*"
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
				color: #FFF;
				margin-top: 15px;
				margin-left: 15px;
				padding-left: 10px;

				">
	<br>
    <input type="submit" value="Upload Image" name="submit" style="
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
				margin-left: 15px;
				padding-left: 10px;

				">
	</form>
	<br>
			<div style = "font-family: arial; color: #FFF; font-size: 12px;">
			<?php echo $uploadresponse; ?>
			</div>
	<br>
	<br>
	<br>

			<div id="LoginButtons" style="marin-left: auto; margin-right: auto; display: block; width: 200px;" onClick="$('#idiv').load('profile.php');">< Back to Profile</div>
	<br>
	<br>
	<br>
</div>
</body>
</html>
