<?php
function session_extend($sid) {
	global $db;
	$sql = 'UPDATE sessions SET '
		. 'session_timeout = NOW() '
		. "WHERE session_id = '$sid';";
	$db->execute($sql);
}
?>