<?php
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