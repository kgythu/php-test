<?php
function session_logout($sid) {
	global $db;
	$sql = 'UPDATE sessions SET '
		. 'user_id = NULL, session_timeout = NULL '
		. "WHERE session_id = '$sid';";
	$db->execute($sql);
}
?>