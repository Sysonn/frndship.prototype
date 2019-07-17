<?php

require_once 'classes/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>
<html>
<head>
		<link rel="stylesheet" type="text/css" href="css/iframe.css">
		<link rel="stylesheet" type="text/css" href="css/cat.css">
</head>
<body>

		<div class="menuBar">

		<input type="text" value="" placeholder="search"
		style="

		font-color: #999;
		border-radius: 10px;
		border-width: 0px;
		outline:none;
		height: 30px;
		width: 80%;
		margin-left: 10px;
		margin-top: 5px;
		margin-bottom: 5px;

		padding-left: 40px;
		font-family: 'Arial Black', Arial, sans-serif;
		font-size:1.2em;
		font-weight: 900;
		line-height:1.43em;
		letter-spacing: -1px;
		color: #ED4A4A;
		">


		</div>

		<br><br>
		<br><br>

		<div class="CatBox">music</div>
		<div class="CatBox">movies</div>
		<div class="CatBox">video games</div>
		<div class="CatBox">media</div>
		<div class="CatBox">art</div>
		<div class="CatBox">technology</div>
		<div class="CatBox">cars</div>
		<div class="CatBox">fashion</div>
		<div class="CatBox">beauty</div>
		<div class="CatBox">fitness</div>
		<div class="CatBox">business</div>
		<div class="CatBox">development</div>
		<div class="CatBox">projects</div>
		<div class="CatBox">dating</div>
		<div class="CatBox">open sail</div>

	<div style="width: 100%; height: 15px; font-size: 10px; color: #ED4A4A; text-align: center;"> &copy; Frndship</div>
	<!--<div style="width: 100%; height: 15px; font-size: 10px; color: #ED4A4A; text-align: center;"> All rights reserved.</div> -->
	<br>
	<br><br>
	<br><br>

	<script>
	$( document ).ready(function() {

		$(".CatBox").velocity("transition.slideUpBigIn", {stagger: 275, drag: true, duration: 800 });
		$(".menuBar").velocity("transition.slideUpBigIn", {duration: 800 });
		
	});

	</script>

</body>
	</html>
