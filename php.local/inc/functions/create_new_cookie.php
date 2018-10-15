<?php
function create_new_cookie($ip, $ua) {
	$sid = sha1($ip . $ua . microtime_float());
	//setcookie('sid', $sid, 2147483647);
	header('Set-Cookie: sid=' . $sid . '; expires=Fri, 31-Dec-9999 23:59:59 GMT');
	return $sid;
}
?>