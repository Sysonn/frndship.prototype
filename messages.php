<?php
session_start();
require_once 'classes/Membership.php';
include ("includes/constants.php");
include ("classes/profileloader.php");


$membership = New Membership();
$membership->confirm_Member();
/*$email = $_SESSION['username'];*/
$newchatID = $_GET['fetchid'];


if(!empty( $_GET['fetchid'])){
    $chatfrnd_sql = "SELECT * FROM chatTable WHERE (profileID = '$profileidprofile' AND frndID = '$newchatID') OR (profileID = '$newchatID' AND frndID = '$profileidprofile') ORDER BY messageDate";
    $chatfrnd_query = mysqli_query($db, $chatfrnd_sql);

    while($chatfrnd_fetch = mysqli_fetch_array($chatfrnd_query,MYSQLI_ASSOC)){
      $chatmessage = $chatfrnd_fetch['message'];
      $varprofile = $chatfrnd_fetch['profileID'];
      $messageTime = $chatfrnd_fetch['messageDate'];
      $varfrnd = $chatfrnd_fetch['frndID'];

      if($varprofile == $profileidprofile){
          echo '<div style = "float: right; width: 100%; position: relative;"> <div style="
          float: right;
          font-family: Arial, sans-serif;
          font-size:12px;
          text-align: center;
          line-height:1.43em;
          color: #fff;
          height: auto;
          width: auto;
          max-width: 50%;
          min-width: 100px;
          padding: 10px;
          padding-bottom: 5px;
          padding-top: 4px;
          border-radius: 15px;
          background-color: #ED4A4A;
          box-sizing: border-box;
          margin-right: 15px;
          margin-top: 10px;
          margin-bottom: 10px;
          word-break:break-all;
          ">'
          . $chatmessage .
          '</div></div>

          <div style = "
          font-size: 8px;
          color: #9e9e9e;
          float: right;
          font-family: Arial;
          margin-right: 20px;
          margin-top: -5px;
          ">'. $messageTime .'</div>
          </br></br></br>';

        }elseif($varprofile ==  $newchatID){

          echo '<div style = "float: left; width: 100%; position: relative;"> <div style="
          float: left;
          font-family: Arial, sans-serif;
          font-size:12px;
          text-align: center;
          line-height:1.43em;
          color: #fff;
          height: auto;
          width: auto;
          max-width: 50%;
          min-width: 100px;
          padding: 10px;
          padding-bottom: 5px;
          padding-top: 4px;
          border-radius: 15px;
          background-color: #999;
          box-sizing: border-box;
          margin-left: 10px;
          margin-top: 10px;
          margin-bottom: 10px;
          word-break:break-all;
          ">'
          . $chatmessage .
          '</div></div>

          <div style = "
          font-size: 8px;
          color: #9e9e9e;
          float: left;
          font-family: Arial;
          margin-left: 20px;
          margin-top: -5px;
          ">'. $messageTime .'</div>
          </br></br></br>';
        }

    }

  }

?>
