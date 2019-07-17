<?php


require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();
?>

	<html>
	<head><title>Frndship</title></head>
		<link rel="stylesheet" type="text/css" href="css/iframe.css">
		<!--<link rel="stylesheet" type="text/css" href="css/frnds.css">-->
		<link rel="stylesheet" type="text/css" href="css/home.css">

		<br>

		<div class="ContentBoxDefaultBorder">*Testing* *Testing*</div>
		<div class="ContentBoxDefaultBorder">Test 2</div>
		<div class="ContentBoxDefaultBorder">Test 3<br>3<br>3</div>
		<div class="ContentBoxDefaultBorder">TEST 4</div>

		<div class="ContentBoxDefaultBorder">
		TEST 5<br>TEST 5<br>TEST 5<br>TEST 5<br>TEST 5<br>TEST 5<br>
		</div>

		<div class="ContentBoxDefaultBorder">This is a test.</div>
		<div class="ContentBoxDefaultBorder">Testes.</div>
		<div class="ContentBoxDefaultBorder">Testes 2.<br>Testes 2.</div>

<br>
<div style="width: 100%; height: 15px; font-size: 10px; color: #ED4A4A; text-align: center;"> &copy; Frndship</div>
<!--<div style="width: 100%; height: 15px; font-size: 10px; color: #ED4A4A; text-align: center;"> All rights reserved.</div> -->
<br>
<br><br>
<br><br>

<script>
$( document ).ready(function() {

  $(".ContentBoxDefaultBorder").velocity("transition.slideUpBigIn", {stagger: 275, drag: true, duration: 800 });

});

</script>

</html>
