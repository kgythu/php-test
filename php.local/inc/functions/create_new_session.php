<?php
function create_new_session($sid, $ip, $ua) {
	global $db;
	$sql = "INSERT INTO sessions(session_id, session_ip, session_ua) "
		. "VALUES('$sid', '$ip', '$ua');";
	$db->execute($sql);
}
?>