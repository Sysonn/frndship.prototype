<?php
session_start();
require_once 'classes/Membership.php';
include ("includes/constants.php");
include ("classes/profileloader.php");

$membership = New Membership();
$membership->confirm_Member();
$email = $_SESSION['username'];

$newfetchID = $_GET['fetchid'];

if(!empty( $_GET['fetchid'])){
        require_once 'classes/Membership.php';
        include ("includes/constants.php");
        include ("classes/profileloader.php");

        $searchfrnd_sql = "SELECT * FROM frndsTable WHERE frndID = '$newfetchID' AND profileID='$profileidprofile'";
        $searchprofile_sql = "SELECT * FROM frndsTable WHERE profileID = '$newfetchID' AND frndID='$profileidprofile'";

        $searchfrnd_query= mysqli_query($db, $searchfrnd_sql);
        $searchprofile_query = mysqli_query($db, $searchprofile_sql);

        /*if($searchfrnd_query){ echo 'searchfrndQ worked.. </br></br>';}else{echo'searchfrndQ NOT work...</br></br>';}
        if($searchprofile_query){ echo 'searchprofileQ worked..</br></br>';}else{echo 'searchprofileQ NOT work... </br></br>';}*/

        $fetch_sf= mysqli_fetch_array($searchfrnd_query,MYSQLI_ASSOC);
        $fetch_sp = mysqli_fetch_array($searchprofile_query,MYSQLI_ASSOC);

        /*if($fetch_sf){ echo 'searchfrndFETCH worked..</br></br>';}else{echo'searchfrndFETCH NOT work...</br></br>';}
        if($fetch_sp){ echo 'searchprofileFETCH worked..</br></br>';}else{echo 'searchprofileFETCH NOT work... </br></br>';}*/

        $searchfrndVal = $fetch_sf['accepted'];
        $searchprofileVal = $fetch_sp['accepted'];

        $searchfrndReq = $fetch_sf['requested'];
        $searchprofileReq = $fetch_sp['requested'];


        if($searchfrndVal == '0' && $searchfrndReq == '1'){
          $fvr01 = "UPDATE frndsTable SET accepted = '1' WHERE frndID = '$newfetchID'";
      		$fvr01_query = mysqli_query($db, $fvr01);

        }
        elseif($searchprofileVal == '0' && $searchprofileReq == '1'){
          $pvr01 = "UPDATE frndsTable SET accepted = '1' WHERE profileID = '$newfetchID'";
      		$pvr01_query = mysqli_query($db, $pvr01);
        }
        else
        {
          $sfvr01 = "INSERT INTO frndsTable(profileID, frndID, requested)VALUES ('$profileidprofile', '$newfetchID', '1')";
          $sfvr01_query = mysqli_query($db, $sfvr01);
            if($sfvr01_query){
              echo 'Friend Requested! <br>';
            }else{
              echo 'Friend fAIL! <br>';
            }

          /*  echo 'Error - Frnd Request not Sent </br> </br>';
            echo $nfetchID . '</br></br>';
            echo $searchfrndVal;
            echo $searchfrndReq;
            echo $searchprofileVal;
            echo $searchprofileReq;
            echo $searchfrnd_sql . '<br></br>';
            echo $searchprofile_sql;
		*/
        }
      listSearch();
  }
?>

<body style="padding: 50px; background: #E0E0E0;">

<head>
<link rel="stylesheet" type="text/css" href="css/iframe.css">
<link rel="stylesheet" type="text/css" href="css/m.frnd.css">
<link rel="stylesheet" type="text/css" href="css/cat.css">

<script type="text/javascript" src="js/chat.js"></script>
<script>
$(document).ready(function(){

	$('#idiv').scrollTop(0);
	clearInterval(intervalID);
	intervalID = 0;
});


  $('#frndInput').keypress(function(event) {
  if (event.which == 13) {
    event.preventDefault();

      $("#searchForm").submit();
    /*  $('#idiv').load('showfrnds.php');*/

    }
  });



$('#searchForm').submit(function() {

    $.ajax({
        data: $(this).serialize(),
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        success: function(response) {
            $('#idiv').html(response);
        }
    });
    return false;
});

function urload(source){

  source.src="media/profileimages/defaults/default.png";
};

</script>

</head>

<div style="width: 100%;"><div class="menuBar">
<form id="searchForm" action="frnds.php" method="post" >
<input type="text" value="" placeholder="search someone" name="searchinput"
style="
border-radius: 10px;
border-width: 0px;
outline:none;
height: 30px;
width: 80%;
margin-left: 10px;
margin-top: 5px;
margin-bottom: 5px;

padding-left: 40px;
font-family: Arial, sans-serif;
font-weight: 900;
font-size:1.2em;
line-height:1.43em;
letter-spacing: -1px;
color: #ED4A4A;
">

<!--<input id="frndinput" type="submit" name="submit" style="position: absolute; left: -1px;"></input>-->
<input id="frndinput" type="submit" name="submit" style="position: absolute; left: -9999px;"></input>


</form>
</div></div>

<!---Seach People Function--------------------->
<br><br><br>
<?php

	 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    listSearch();
  }


function listSearch(){
  require_once 'classes/Membership.php';
  include ("includes/constants.php");
  include ("classes/profileloader.php");

  if(!empty( $_GET['fetchid'])){
    $term = $_GET['fetchterm'];
  }else{
    $term = $_POST["searchinput"];
  }
    $showing = 'Showing results for: ' . $term;
    $search_sql = "SELECT * FROM Profiles WHERE CONCAT(firstName , ' ', lastName) LIKE '%".$term."%' ORDER BY firstName ASC";
    $search_query = mysqli_query($db, $search_sql);
	  $searchrowcount=mysqli_num_rows($search_query);

	if ($searchrowcount==0)
	{

	echo
          '<div style="
              height: 15px;
              padding: 15px;
              color: #999;
              font-weight: bold;
               ">
			   No results for: ' . $term .
               '</div>
			   </br>';

			   echo '<div style= "width: 80%; margin-right: auto; margin-left: auto; background: #999; height: 3px;""></div>';
	}
	else
	{

          if($term != ""){

          echo
          '<div style="
              height: 15px;
              padding: 15px;
              color: #999;
              font-weight: bold;
              font-family: arial;
               ">'
               . $showing .
          '</div>';

              while($search_fetch = mysqli_fetch_array($search_query,MYSQLI_ASSOC)){

                      $searchID = $search_fetch['profileID'];

                        /* Link URLs */
                        $searchurl="'showprofile.php?fetchid=" . $searchID  . "'";
    				            /*$addurl="'frnds.php?fetchid=" . $searchID  . "'";*/
                        $addurl="'frnds.php?fetchid=" . $searchID  . "&fetchterm=". $term  ."'";

						$searchload = "$('#idiv').load(" . $searchurl . ")";
						$addload = "$('#idiv').load(" . $addurl . ")";

                      $simgsql="SELECT * FROM ProfileImages WHERE profileID='$searchID'";
                      $simgresult=mysqli_query($db,$simgsql);
                      $simgrow=mysqli_fetch_array($simgresult,MYSQLI_ASSOC);
                      $simgsource=$simgrow['imgSource'];
                      $simgname=$simgrow['imgName'];

                echo


                  '<div class = "FrndBox" onclick='. $searchload .' style=" display: block; text-decoration: none; color: inherit; height: 1px;">'.

                /* onclick = location.href='. $searchurl . ' */
                /* Image */
  							'<div style="float: left; padding-right: 15px;">'.
                                '<img onerror="urload(this);" src="'. $simgsource . $searchID . '/' . $simgname .'" style="width: 60px; height: 60px; border-radius: 5px;">' .
  							'</div>'.

                '<div style="height: 25px; width: 500px;">'.
                    /* Name */
                  '<div style="
  									float: left;
  									color: #ED4A4A;
  									font-weight:bold;
  									font-size: 1.2em;
  									font-family: Arial, sans-serif;
  									font-weight: 900;
  									letter-spacing: -1px;">'

                      . $search_fetch['firstName'] . ' ' . $search_fetch['lastName'] . '</div>'.
                  '</div>'.
                    	/* Location */
                    '<div style = "font-family: Arial;"><img src="media/location.png" style="height: 12px;">' . $search_fetch['profilelocation'] . '</img></div>';
  							  /* Add Symbol */
                    /*'<a href=' .$addurl . ' style="text-decoration: none; color: inherit;">'.*/
                    $searchfrnd_sql = "SELECT * FROM frndsTable WHERE frndID = '$searchID' AND profileID='$profileidprofile'";
                    $searchprofile_sql = "SELECT * FROM frndsTable WHERE profileID = '$searchID' AND frndID='$profileidprofile'";

                    $searchfrnd_query= mysqli_query($db, $searchfrnd_sql);
                    $searchprofile_query = mysqli_query($db, $searchprofile_sql);

                    $fetch_searchfrnd = mysqli_fetch_array($searchfrnd_query,MYSQLI_ASSOC);
                    $fetch_searchprofile = mysqli_fetch_array($searchprofile_query,MYSQLI_ASSOC);

                    $searchfrndVal = $fetch_searchfrnd['accepted'];
                    $searchprofileVal = $fetch_searchprofile['accepted'];

                    $searchfrndReq = $fetch_searchfrnd['requested'];
                    $searchprofileReq = $fetch_searchprofile['requested'];

                  if( $searchID == $profileidprofile){
                    echo '</div>';
                  }
                  elseif($searchfrndVal == '1' && $searchfrndReq == '1' ){
                    echo
                    '<div style = "
                    height: 30px;
                    width: 30px;
                    float: right;
                    margin-right: 10px;
                    margin-top: -55px;
                    font-size: 40px;
                    font-weight: bold;
                    border-color: #000;
                    border-width: 1px;
                    z-index: 2;
                    "><img src="media/acceptedfrnd.png" style="width: inherit; height: inherit; margin-top: 40px;"></img></div>'.  '</div>';
                  }
                  elseif($searchprofileVal == '1' && $searchprofileReq == '1' ){
                    echo
                    '<div style = "
                    height: 30px;
                    width: 30px;
                    float: right;
                    margin-right: 10px;
                    margin-top: -55px;
                    font-size: 40px;
                    font-weight: bold;
                    border-color: #000;
                    border-width: 1px;
                    z-index: 2;
                    "><img src="media/acceptedfrnd.png" style="width: inherit; height: inherit; margin-top: 40px;"></img></div>'.  '</div>';
                  }
                  elseif($searchfrndVal == '0' && $searchfrndReq == '1'){
                    echo
                    '<div style = "
                    height: 30px;
                    width: 30px;
                    float: right;
                    margin-right: 10px;
                    margin-top: -55px;
                    font-size: 40px;
                    font-weight: bold;
                    border-color: #000;
                    border-width: 1px;
                    z-index: 2;
                    "><img src="media/sentfrnd.png" style="width: inherit; height: inherit; margin-top: 40px;"></img></div>'.  '</div>';
                  }
                  elseif($searchprofileVal == '0' && $searchprofileReq == '1'){
                    echo
                    '<div onClick = '. $addload . '; style = "
                    height: 30px;
                    width: 30px;
                    float: right;
                    margin-right: 10px;
                    margin-top: -55px;
                    font-size: 40px;
                    font-weight: bold;
                    border-color: #000;
                    border-width: 1px;
                    z-index: 2;
                    "><img src="media/addfrnd.png" style="width: inherit; height: inherit; margin-top: 40px;"></img></div>'.  '</div>';
                  }
                  else
                  {
                    echo
                    '<div onClick = '. $addload . '; style = "
                    height: 30px;
                    width: 30px;
                    float: right;
                    margin-right: 10px;
                    margin-top: -55px;
                    font-size: 40px;
                    font-weight: bold;
                    border-color: #000;
                    border-width: 1px;
                    z-index: 2;
                    "><img src="media/addfrnd.png" style="width: inherit; height: inherit; margin-top: 40px;"></img></div>'.  '</div>';
                  }

                }
                echo '<div style= "width: 80%; margin-right: auto; margin-left: auto; background: #999; height: 3px;""></div>';
  			  }
        }
  	}
?>
<!-------------------------------------------------->

<br>

<!---Frnds List--------------------->

<?php
/*
$profile_frnd_sql = "SELECT profileID FROM frndsTable WHERE frndID = '$profileidprofile' JOIN (SELECT frndID FROM frndsTable WHERE profileID = '$profileidprofile')";
*/

$profile_frnd_sql = "SELECT * FROM frndsTable WHERE frndID = '$profileidprofile' and requested = '1' and accepted = '1'";
$frnd_profile_sql = "SELECT * FROM frndsTable WHERE profileID = '$profileidprofile' and requested = '1' and accepted = '1'";

$profile_frnd_query = mysqli_query($db, $profile_frnd_sql);
$frnd_query = mysqli_query($db, $frnd_profile_sql);


?>

<div>
<?php
while($fetchprofile = mysqli_fetch_array($profile_frnd_query,MYSQLI_ASSOC)){
  $fetchprofileID = $fetchprofile['profileID'];


  $fpID_sql = "SELECT * FROM Profiles WHERE profileID = '$fetchprofileID'";
  $fpID_query = mysqli_query($db, $fpID_sql);
  $fpID_fetch = mysqli_fetch_array($fpID_query,MYSQLI_ASSOC);


  /* Frnd Profile Image */
  $frndpicsql="SELECT * FROM ProfileImages WHERE profileID='$fetchprofileID'";
  $frndpicresult=mysqli_query($db,$frndpicsql);
  $frndpicrow=mysqli_fetch_array($frndpicresult,MYSQLI_ASSOC);
  $frndprofilesource=$frndpicrow['imgSource'];
  $frndprofileimgname=$frndpicrow['imgName'];

  $frnddescsql="SELECT * FROM ProfileDesc WHERE profileID='$fetchprofileID'";
  $frnddescresult=mysqli_query($db,$frnddescsql);
  $frnddescrow=mysqli_fetch_array($frnddescresult,MYSQLI_ASSOC);
  $frnddesc=$frnddescrow['Description'];

  $frndurl="'showprofile.php?fetchid=" . $fetchprofileID  . "'";
  $frndload = "$('#idiv').load(" . $frndurl . ")";

  $frndmssgurl="'chat.php?fetchid=" . $fetchprofileID  . "'";
  $frndmssgload = "$('#idiv').load(" . $frndmssgurl . ")"; /*ajax load*/

  echo
      '<div class = "FrndBox">' .

      '<div style="
      height: 100%;
      width: 80%;
      max-width: 800px;
      min-height: 80px;
      max-height: 200px;
      overflow: hidden;
      box-sizing: border-box;
      padding: 10px;
      display: block;
      " onClick = '. $frndload . ';>'.

        '<div style="float: left; padding-right: 15px;">'.
          '<img onerror="urload(this);" src="'. $frndprofilesource . $fetchprofileID . '/' . $frndprofileimgname .'" style="width: 60px; height: 60px; border-radius: 5px;">' .
        '</div>'.
        '<div style="
        float: left;
        color: #ED4A4A;
        font-weight:bold;
        font-size: 1.2em;
        font-family: Arial, sans-serif;
        font-weight: 900;
        letter-spacing: -1px;">'

        . $fpID_fetch['firstName'] . ' ' . $fpID_fetch['lastName'] . '</div>'.
        '<div style = "margin-top: 25px;"><img src="media/location.png" style="height: 12px;">' . $fpID_fetch['profilelocation'] . '</img></div>'.
          /*'</br> <div style="float: left;">' . $frnddesc . '</div>'.*/
'</div>'.
          '<div onClick='. $frndmssgload . '; style = "
          height: 25px;
          width: 30px;
          float: right;
          display: block
          margin-right: 50px;
          margin-top: -60px;
          font-size: 40px;
          font-weight: bold;
          z-index: 12;
          "><img src="media/chaticon.png" style="width: inherit; height: inherit;"></img></div>'.  '</div>'.

      '</div>'
      ;
  }

  /* Second Half */

while($fetchfrnd = mysqli_fetch_array($frnd_query,MYSQLI_ASSOC)){
  $fetchfrndID = $fetchfrnd['frndID'];

  $ffID_sql = "SELECT * FROM Profiles WHERE profileID = '$fetchfrndID'";
  $ffID_query = mysqli_query($db, $ffID_sql);
  $ffID_fetch = mysqli_fetch_array($ffID_query, MYSQLI_ASSOC);

  /* Frnd Profile Image */
  $frndpicsql="SELECT * FROM ProfileImages WHERE profileID='$fetchfrndID'";
  $frndpicresult=mysqli_query($db,$frndpicsql);
  $frndpicrow=mysqli_fetch_array($frndpicresult,MYSQLI_ASSOC);
  $frndprofilesource=$frndpicrow['imgSource'];
  $frndprofileimgname=$frndpicrow['imgName'];

  $frndurl="'showprofile.php?fetchid=" . $fetchfrndID  . "'";
  $frndload = "$('#idiv').load(" . $frndurl . ")";

  $frndmssgurl="'chat.php?fetchid=" . $fetchfrndID  . "'";
  $frndmssgload = "$('#idiv').load(" . $frndmssgurl . ")"; /*ajax load*/
/*  echo
      '<div class = "FrndBox" onClick = '. $frndload . ';>' .
        '<div style="float: left; padding-right: 15px;">'.
          '<img onerror="urload(this);" src="'. $frndprofilesource . $fetchfrndID . '/' . $frndprofileimgname .'" style="width: 60px; height: 60px; border-radius: 5px;">' .
        '</div>'.
        '<div style="
        float: left;
        color: #ED4A4A;
        font-weight:bold;
        font-size: 1.2em;
        font-family: Arial, sans-serif;
        font-weight: 900;
        letter-spacing: -1px;">'

        . $ffID_fetch['firstName'] . ' ' . $ffID_fetch['lastName'] . '</div>'.
        '<div style = "margin-top: 25px;"><img src="media/location.png" style="height: 12px;">' . $ffID_fetch['profilelocation'] . '</img></div>'.
      '</div>'
      ;
  }
*/

echo
    '<div class = "FrndBox">' .

    '<div style="
    height: 100%;
    width: 80%;
    max-width: 800px;
    min-height: 80px;
    max-height: 200px;
    overflow: hidden;
    box-sizing: border-box;
    padding: 10px;
    display: block;
    " onClick = '. $frndload . ';>'.

      '<div style="float: left; padding-right: 15px;">'.
        '<img onerror="urload(this);" src="'. $frndprofilesource . $fetchfrndID . '/' . $frndprofileimgname .'" style="width: 60px; height: 60px; border-radius: 5px;">' .
      '</div>'.
      '<div style="
      float: left;
      color: #ED4A4A;
      font-weight:bold;
      font-size: 1.2em;
      font-family: Arial, sans-serif;
      font-weight: 900;
      letter-spacing: -1px;">'

      . $ffID_fetch['firstName'] . ' ' . $ffID_fetch['lastName'] . '</div>'.
      '<div style = "margin-top: 25px;"><img src="media/location.png" style="height: 12px;">' . $ffID_fetch['profilelocation'] . '</img></div>'.
        /*'</br> <div style="float: left;">' . $frnddesc . '</div>'.*/
'</div>'.
        '<div onClick='. $frndmssgload . '; style = "
        height: 25px;
        width: 30px;
        float: right;
        display: block
        margin-right: 50px;
        margin-top: -60px;
        font-size: 40px;
        font-weight: bold;
        z-index: 12;
        "><img src="media/chaticon.png" style="width: inherit; height: inherit;"></img></div>'.  '</div>'.

    '</div>'
    ;
}


?>

</div>

<br><br><br>
<br><br><br>

<script>
$( document ).ready(function() {

  $(".FrndBox").velocity("transition.slideUpBigIn", {stagger: 275, drag: true, duration: 500 });
  $(".menuBar").velocity("transition.slideUpBigIn", {duration: 500 });
});

</script>
</body>
