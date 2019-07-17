<?php

	include ("includes/constants.php");

	$msg = "";
	if(isset($_POST["submit"]))
	{
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];

		$password = $_POST["password"];
		$passwordmatch = $_POST["passwordmatch"];

		$firstname = mysqli_real_escape_string($db, $firstname);
		$lastname = mysqli_real_escape_string($db, $lastname);
		$email = mysqli_real_escape_string($db, $email);
		$password = mysqli_real_escape_string($db, $password);
		$password = md5($password);


		function randomKey($length) {
			$pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

			for($i=0; $i < $length; $i++) {
				$key .= $pool[mt_rand(0, count($pool) - 1)];
			}
			return $key;
		}


		$confirmcode = randomKey(15);
		$profileid = rand();

		$emailmessage =
		"
		Welcome Aboard!

		Click the link below to verify your account:

		http://www.frndship.hiatus-studios.com/register.php?firstname=$firstname&code=$confirmcode
		";

		$sql="SELECT userEmail FROM Profiles WHERE userEmail='$email'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		if($_POST["password"] != $_POST["passwordmatch"]){

			$msg = "Whoops! Passwords do not match.";
		}
		elseif(mysqli_num_rows($result) == 1)
		{
			$msg = "Sorry! Email already exists.";
		}
		else
		{
			$q1 = "INSERT INTO Profiles (profileID, firstName, lastName, userEmail, confirmCode, passWord, created)VALUES ('$profileid', '$firstname', '$lastname', '$email', '$confirmcode' , '$password', now());";
			$q2 = "INSERT INTO ProfileImages (profileID, imgSource, imgName, position, imgCat, fileType, imgDate, coverSource, coverName, coverFileType, coverDate)VALUES ('$profileid', 'media/profileimages/', 'defaults/default.png', '1', 'profile', 'png', now(), 'media/profileimages/', '/defaults/cover.png', 'png', now())";
			$q3 = "INSERT INTO ProfileDesc (profileID, Description)VALUES ('$profileid', 'Description.')";
			$q4 = "INSERT INTO ProfileCategories (profileID)VALUES ('$profileid')";
			$query = mysqli_query($db, $q1);
			$query2 = mysqli_query($db, $q2);
			$query3 = mysqli_query($db, $q3);
			$query4 = mysqli_query($db, $q4);
			if($query)
			{
				if($query2)
				{
				mail($email, "Frndship - Confirmation", $emailmessage,"From:donotreply@frndship.hiatus-studios.com");
				mkdir("media/profileimages/" . $profileid, 0755);
				$msg = "Thank You! A confirmation email has been sent. Please confirm to continue.";
				}
				else
				{
					$msg = "Server Error 2 Ho!";
				}
			}
			else
			{
				$msg = "Server Error 1 Ho!";
			}
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<body >

<head>
<title>Frndship - Login</title>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="css/m.frnd.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#ED4A4A" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>




</head>


<div id="LoginSmartScreen" style = "background-color: #ED4A4A; ">

	<!--Start Smart Screen-------->


	<div id="LoginMain" >

		<h1
				style="
				color: #FFF;
				height: 10px;
				width: 250px;
				font-family: 'Arial Black', Arial, sans-serif;
				font-size:1.6em;
				line-height:1.43em;
				letter-spacing: -1px;
				padding-left: 10px;
				text-align: center;
				margin-left: auto;
				margin-right: auto;
				display: block;
				"
				>
				Ahoy, sailor.
		</h1>

		<!--<div style="margin-left: auto; margin-right: auto; display: block;">-->
			<form method="post" action="" id="register-form" style="width: 100%">


				<table width="280px" border="0" cellpadding="10" cellspacing="10" style="margin-left: auto; margin-right: auto; display: block;">

				<tr>
				<td>
				<input name="firstname" type="text" class="input" placeholder="First Name" required
				style="
				font-color: #999;
				border-radius: 10px;
				border-width: 0px;
				outline:none;
				height: 25px;
				width: 230px;
				font-family: 'Arial Black', Arial, sans-serif;
				font-size:14px;
				line-height:1.43em;
				letter-spacing: -1px;
				color: #ED4A4A;
				padding-left: 10px;
				"
				/>
				</td>
				</tr>

				<tr>
				<td>
				<input name="lastname" type="text" class="input" placeholder="Last Name" required
				style="
				font-color: #999;
				border-radius: 10px;
				border-width: 0px;
				outline:none;
				height: 25px;
				width: 230px;
				font-family: 'Arial Black', Arial, sans-serif;
				font-size:14px;
				line-height:1.43em;
				letter-spacing: -1px;
				color: #ED4A4A;
				padding-left: 10px;
				"
				/>
				</td>
				</tr>

				<tr>
				<td><input name="email" type="email" class="input" placeholder="Email" required
				style="
				font-color: #999;
				border-radius: 10px;
				border-width: 0px;
				outline:none;
				height: 25px;
				width: 230px;
				font-family: 'Arial Black', Arial, sans-serif;
				font-size:14px;
				line-height:1.43em;
				letter-spacing: -1px;
				color: #ED4A4A;
				padding-left: 10px;
				"
				/>
				</td>
				</tr>

				<tr>
				<td><input name="password" type="password" class="input" placeholder="Password" required
				style="
				font-color: #999;
				border-radius: 10px;
				border-width: 0px;
				outline:none;
				height: 25px;
				width: 230px;
				font-family: 'Arial Black', Arial, sans-serif;
				font-size:14px;
				line-height:1.43em;
				letter-spacing: -1px;
				color: #ED4A4A;
				padding-left: 10px;
				"
				/>
				</td>
				</tr>

				<tr>
				<td><input name="passwordmatch" type="password" class="input" placeholder="Re-enter Password" required
				style="
				margin-left: auto;
				margin-right: auto;
				font-color: #999;
				border-radius: 10px;
				border-width: 0px;
				outline:none;
				height: 25px;
				width: 230px;
				font-family: 'Arial Black', Arial, sans-serif;
				font-size:14px;
				line-height:1.43em;
				letter-spacing: -1px;
				color: #ED4A4A;
				padding-left: 10px;
				"
				/>
				</td>
				</tr>

				<style>

					#RegButton{
						font-family: "Arial Black", Arial, sans-serif;
						font-size:16px;
						text-align: center;
						line-height:1.43em;
						letter-spacing: -1.5px;
						color: #ED4A4A;
						height: 28px;
						width: 40%;
						padding-bottom: 5px;
						padding-top: 4px;
						margin-left: 30%;
						border-radius: 15px;
						background-color: #FFF;
						box-sizing: border-box;
						border: none;
						}

						#RegButton:hover{
						background: #ff8d8d;
						color: #fff;
						}

				</style>

				<tr>
				<td>
				<input id="RegButton" type="submit" name="submit" value="Sign Up"></input>

				</td>
				</tr>

				<tr>
				<td colspan="2" align="center" class="error"
				style="color: #fff; font-family: arial; font-size: 12px;" >
				<?php echo $msg;?>
				</td>
				</tr>

				</table>


			<div id="LoginButtons" style="margin-left: auto; margin-right: auto; display: block; width: 150px;" onClick="window.location = 'login.php';">< Back to Login</div>




			</form>

			<!---------------------------------------------------------------->
		</div>


	</div>
</div>




</body>
</html>
