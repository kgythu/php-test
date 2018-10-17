<!DOCTYPE html>
<html lang="hu">
<head>
	<title><?=$page_title?> • <?=SITE_NAME?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="icon" href="/favicon.ico" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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
<footer>
<div id="mainfoot" class="container-fluid">
	IP: <?php
		echo $ip_formatted = (preg_match('/^([12]?\d\d?_){3}[12]?\d\d?$/', $ip)) ? preg_replace('/_/', '.', $ip) :
			preg_replace('/_/', ':', $ip);
		echo ' – ';
		// https://ipapi.com/documentation
		// Please don't use my access key.
		// You can get free api key: https://ipapi.com/signup
		$url = 'http://api.ipapi.com/' . $ip_formatted . '?access_key=b5d69fc75ce349b08bd204fb9326655b&format=0';
		$ipObj = json_decode(file_get_contents($url));
		/*
{
  "ip":"1.2.3.4",
  "type":"ipv4",
  "continent_code":"EU",
  "continent_name":"Europe",
  "country_code":"HU",
  "country_name":"Hungary",
  "region_code":"BU",
  "region_name":"Budapest",
  "city":"Budapest",
  "zip":"1012",
  "latitude":47.5,
  "longitude":19.0833,
  "location":{
    "geoname_id":3054643,
    "capital":"Budapest",
    "languages":[
      {
        "code":"hu",
        "name":"Hungarian",
        "native":"Magyar"
      }
    ],
    "country_flag":"http:\/\/assets.ipapi.com\/flags\/hu.svg",
    "country_flag_emoji":"\ud83c\udded\ud83c\uddfa",
    "country_flag_emoji_unicode":"U+1F1ED U+1F1FA",
    "calling_code":"36",
    "is_eu":true
  }
}
		*/
		echo $ipObj->country_name;
		//echo ' ' . $ipObj->location->country_flag_emoji;
		echo " <img src=\"{$ipObj->location->country_flag}\" alt=\"{$ipObj->country_name}\" class=\"flag-emoji\" />";
	?>
</div>
</footer>
</body>
</html>
