<?php
session_start();
require_once 'classes/Membership.php';
include ("includes/constants.php");

/*
$firstname = mysqli_real_escape_string($db, $firstname);
$lastname = mysqli_real_escape_string($db, $lastname);
*/

$email = $_SESSION['username'];

/*---------------------------------------------------*/
/* First and Last Name*/
$namesql="SELECT * FROM Profiles WHERE userEmail='$email'";
$nameresult=mysqli_query($db,$namesql);
$namerow=mysqli_fetch_array($nameresult,MYSQLI_ASSOC);
$namefirst=$namerow['firstName'];
$namelast=$namerow['lastName'];
$profileidprofile=$namerow['profileID'];

$_SESSION['sessionProfileID'] = $profileidprofile;

/* Location */
$profilelocation = $namerow['profilelocation'];


/* Profile Image */
$profilesql="SELECT * FROM ProfileImages WHERE profileID='$profileidprofile'";
$profileresult=mysqli_query($db,$profilesql);
$profilerow=mysqli_fetch_array($profileresult,MYSQLI_ASSOC);
$profileid=$profilerow['profileID'];
$profilesource=$profilerow['imgSource'];
$profileimgname=$profilerow['imgName'];

/* Cover Image */

$coversource=$profilerow['coverSource'];
$coverimgname=$profilerow['coverName'];

/* Profile Description */

$descsql="SELECT * FROM ProfileDesc WHERE profileID='$profileidprofile'";
$descresult=mysqli_query($db,$descsql);
$descrow=mysqli_fetch_array($descresult,MYSQLI_ASSOC);
$descid=$descrow['profileID'];
$desccontent=$descrow['Description'];

/* other profile functions */
	
?>
