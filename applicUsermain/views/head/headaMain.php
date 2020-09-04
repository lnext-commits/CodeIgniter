<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
		<title><?php echo $title ?></title>
		<link rel="stylesheet" type="text/css" href="resurUs/css/stylemain.css">
		<link rel="stylesheet" type="text/css" href="resurUs/windowWhite/style.css">
		<link rel="stylesheet" type="text/css" href="resurUs/css/<?php echo $css ?>.css">
		<script src="resurUs/js/jquery-1.10.2.min.js"></script>
		<script src="resurUs/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="resurUs/windowWhite/script.js"></script>
		<script src="resurUs/js/<?php echo $js ?>.js"></script>
	</head>
	<body >
		<form method="post">
			<img src="resurUs/images/go-home3.png" class="gohome iqonav cur" onclick="window.location.pathname='amain'">
			<img src="resurUs/images/gnome3.png" class="gnome iqonav cur" onclick="submit()">
			<input type="hidden" value="выход" name="exit">
		</form>
		<div class="clean"></div>
		<div id="box_head">
			<div id="box_fio" class="box_headmenu"><span class="textHeadMenu"><?php echo $fio ?></span></div>
			<div id="box_tip" class="box_headmenu"><span class="textHeadMenu"><?php echo $tip ?></span></div>
			<div id="box_leftinfo" class="box_headmenu"><span class="textHeadMenu"><small><small><?php echo $info ?></small></small></span></div>
			<div id="box_classnomber" class="box_headmenu"><span class="textHeadMenu"></span></div>		
		</div>
		<div class="clean"></div>
		<hr>
		<div id="box_content">