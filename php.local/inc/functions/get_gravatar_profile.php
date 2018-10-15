<?php
// https://en.gravatar.com/site/implement/profiles/php/
function get_gravatar_profile($email) {
	$url = 'https://www.gravatar.com/';
	$url .= md5(strtolower(trim($email)));
	$url .= ".php";
	$str = file_get_contents($url);
	$profile = unserialize($str);
	if (is_array($profile) && isset($profile['entry']))
		return $profile;
	return false;
}
?>