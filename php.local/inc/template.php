<!DOCTYPE html>
<html lang="hu">
<head>
	<title><?=$page_title?> • <?=SITE_NAME?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="/favicon.ico?ver=<?php
		echo filemtime('favicon.ico');
	?>" />
	<link rel="icon" href="/favicon.ico?ver=<?php
		echo filemtime('favicon.ico');
	?>" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<!--[if gte IE 9]> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- <![endif]-->
	<!--[if lt IE 9]>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<![endif]-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/style.css?ver=<?php
		echo filemtime('style.css');
	?>" />
	<script src="/main.js?ver=<?php
		echo filemtime('main.js');
	?>"></script>
</head>
<body>
<div id="logo" class="container">
	<p><a href="/"><img src="images/logo.png" alt="Logó" /></a></p>
</div>
<?php
	/*
	require
	include
	require_once
	include_once
	*/
	require('inc/menu.php');
?>
<div id="main" class="container">
<?php
	if(isset($message) && is_array($message)
		&& isset($message['type']) && isset($message['strong']) && isset($message['text'])) {
?>
	<div class="alert alert-<?=$message['type']?> alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><?=$message['strong']?></strong> <?=$message['text']?>
	</div>
<?php
	};
?>
	<h1><?=$page_title?></h1>
<?php
	if(preg_match('/\[module (\w+)(( \w+)*)\]/', $page_text, $matches)) {
		if(is_file('modules/' . $matches[1] . '.php'))
			require('modules/' . $matches[1] . '.php');
		else
			echo $page_text;
	} else {
		echo $page_text;
	};
?>
</div>
</body>
</html>