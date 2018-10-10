<?php
/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array()) {
	$url = 'https://www.gravatar.com/avatar/';
	$url .= md5(strtolower(trim($email)));
	$url .= "?s=$s&d=$d&r=$r";
	if($img) {
		$url = '<img src="' . $url . '"';
		foreach($atts as $key => $val)
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	};
	return $url;
}
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
function microtime_float() {
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}
function create_new_cookie($ip, $ua) {
	$sid = sha1($ip . $ua . microtime_float());
	//setcookie('sid', $sid, 2147483647);
	header('Set-Cookie: sid=' . $sid . '; expires=Fri, 31-Dec-9999 23:59:59 GMT');
	return $sid;
}
function create_new_session($sid, $ip, $ua) {
	global $db;
	$sql = "INSERT INTO sessions(session_id, session_ip, session_ua) "
		. "VALUES('$sid', '$ip', '$ua');";
	$db->execute($sql);
}
function session_logout($sid) {
	global $db;
	$sql = 'UPDATE sessions SET '
		. 'user_id = NULL, session_timeout = NULL '
		. "WHERE session_id = '$sid';";
	$db->execute($sql);
}
function session_extend($sid) {
	global $db;
	$sql = 'UPDATE sessions SET '
		. 'session_timeout = NOW() '
		. "WHERE session_id = '$sid';";
	$db->execute($sql);
}
function session_login($sid, $user) {
	global $db;
	$sql = 'UPDATE sessions SET '
		. "user_id = '$user', session_timeout = NOW() "
		. "WHERE session_id = '$sid';";
	$db->execute($sql);
}
?>