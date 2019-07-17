<?php
session_start();
require_once 'classes/Membership.php';
include ("includes/constants.php");
include ("classes/profileloader.php");
/*require_once 'messages.php';*/

$membership = New Membership();
$membership->confirm_Member();
$email = $_SESSION['username'];
$newfetchChatID = $_GET['fetchid'];
$chaturl2="chat.php?fetchid=" . $newfetchChatID;

$messageurl="messages.php?fetchid=" . $newfetchChatID;

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $textmessage = $_POST["searchinput"];

    if(!empty($_POST["searchinput"])){
      $qChat = "INSERT INTO chatTable (profileID, frndID, message, messageDate)VALUES ('$profileidprofile', '$newfetchChatID', '$textmessage', now())";
      $queryChat = mysqli_query($db, $qChat);
    }else {

    }

  }

?>

<head>
<link rel="stylesheet" type="text/css" href="css/m.frnd.css">
<link rel="stylesheet" type="text/css" href="css/cat.css">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">

<script type="text/javascript" src="js/chat.js"></script>

<script>

$(document).ready(function(){
	loadChat("<?php echo $messageurl; ?>");


});

</script>

</head>

<div style = "
position: absolute;
width: 100%;
bottom: 50px;
top: 0px;
overflow-y: hidden;
overflow-x: hidden;
">
<div id="chat-box" style="overflow: scroll; overflow-x: hidden; width: 100%; height: 100%; "></div>

<div>
<?php

/*
if(!empty( $_GET['fetchid'])){
    $chatfrnd_sql = "SELECT * FROM chatTable WHERE (profileID = '$profileidprofile' AND frndID = '$newfetchID') OR (profileID = '$newfetchID' AND frndID = '$profileidprofile') ORDER BY messageDate";
    $chatfrnd_query = mysqli_query($db, $chatfrnd_sql);

    while($chatfrnd_fetch = mysqli_fetch_array($chatfrnd_query,MYSQLI_ASSOC)){
      $chatmessage = $chatfrnd_fetch['message'];
      $varprofile = $chatfrnd_fetch['profileID'];

      $varfrnd = $chatfrnd_fetch['frndID'];

      if($varprofile == $profileidprofile){
          echo '<div style="
          float: right;
          font-family: Arial, sans-serif;
          font-size:12px;
          text-align: center;
          line-height:1.43em;
          color: #fff;
          height: 28px;
          width: 40%;
          padding-bottom: 5px;
          padding-top: 4px;
          border-radius: 15px;
          background-color: #ED4A4A;
          box-sizing: border-box;
          ">'
          . $chatmessage .
          '</div></br></br>';
        }elseif($varprofile ==  $newfetchID){

          echo '<div style="
          float: left;
          font-family: Arial, sans-serif;
          font-size:12px;
          text-align: center;
          line-height:1.43em;
          color: #fff;
          height: 28px;
          width: 40%;
          padding-bottom: 5px;
          padding-top: 4px;
          border-radius: 15px;
          background-color: #999;
          box-sizing: border-box;
          ">'
          . $chatmessage .
          '</div></br></br>';
        }

    }

  }
*/

?>

<script>




$('form').submit(function() { // catch the form's submit event

    $.ajax({ // create an AJAX call...
        data: $(this).serialize(), // get the form data
        type: $(this).attr('method'), // GET or POST
        url: $(this).attr('action'), // the file to call
        success: function(response) { // on success..
            $('#idiv').html(response); // update the DIV
        }
    });
    return false; // cancel original event to prevent form submitting
});


</script>

<div class="chatBar" style="
width:100%;
display:block;
position:fixed;
bottom:10px;
left:0;
background-color: #ff8d8d;
padding: 4px;
padding-top: 8px;
padding-bottom: 8px;
">
<?php echo '<form action="' . $chaturl2 . '" method="post" id="searchForm">'; ?>
<input type="text" value="" placeholder="Enter Text." name="searchinput" autocomplete="off"
style="
border-radius: 10px;
border-width: 0px;
outline:none;
height: 30px;
width: 70%;
margin-left: 10px;
margin-bottom: 5px;
padding-left: 40px;
font-family: Arial, sans-serif;
font-weight: 900;
font-size:1.2em;
line-height:1.43em;
letter-spacing: -1px;
color: #ED4A4A;
position: absolute
">

<input  id="LoginButtons" type="submit" name="submit" style="height: 30px; width: 20%; max-width: 150px;"></input>
<script>
  $("#LoginButtons").keypress(function(event) {
  if (event.which == 13) {
    event.preventDefault();
    $("#searchForm").submit();
    }
  });
</script>

</form>

</div>
