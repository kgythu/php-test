<?php
function session_login($sid, $user) {
	global $db;
	$sql = 'UPDATE sessions SET '
		. "user_id = '$user', session_timeout = NOW() "
		. "WHERE session_id = '$sid';";
	$db->execute($sql);
}
?>