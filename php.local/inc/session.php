<?php
	$sid = '';
	$ip = preg_replace('/[g-z]/i', '_', preg_replace('/\W/', '_', $_SERVER['REMOTE_ADDR']));
	$ua = preg_replace('/[`\'"]/i', '’', $_SERVER['HTTP_USER_AGENT']);
	$logged = false;
	// Cookie ellenőrzés
	if(!isset($_COOKIE) || !isset($_COOKIE['sid']) || !preg_match('/^[a-f0-9]{40}$/', $_COOKIE['sid'])) {
		$sid = create_new_cookie($ip, $ua);
	} else {
		$sid = $_COOKIE['sid'];
	};
	// SQL ellenőrzés
	$sql = "SELECT * FROM sessions_fulldata "
		. "WHERE session_id = '$sid';";
	$rs = $db->execute($sql);
	if($row = $rs->fetchRow()) {
		if($row['session_ip'] !== $ip) {
			// IP-cím megváltozott
			if($row['user_id'] != '')
				$message = array(
					'type' => 'warning',
					'strong' => 'Kilépés!',
					'text' => 'Biztonsági okokból kiléptettük a felhasználót. E4435643'
				);
			session_logout($sid);
			$sid = create_new_cookie($ip, $ua);
			create_new_session($sid, $ip, $ua);
		} elseif($row['session_ua'] !== $ua) {
			// User agent megváltozott
			if($row['user_id'] != '')
				$message = array(
					'type' => 'warning',
					'strong' => 'Kilépés!',
					'text' => 'Biztonsági okokból kiléptettük a felhasználót. E5765654'
				);
			session_logout($sid);
			$sid = create_new_cookie($ip, $ua);
			create_new_session($sid, $ip, $ua);
		} elseif(($row['user_id'] == '') || ($row['session_timeout'] == '')) {
			// Nem volt belépve
			session_logout($sid);
		} else {
			// Biztonsági időkorlát ellenőrzése
			/*
			TIMEOUT_DEFAULT
			TIMEOUT_MIN
			TIMEOUT_MAX
			user_timeout
			now
			session_timeout
			*/
			$timeout_actual = ((int) TIMEOUT_MIN > ((int) $row['user_timeout'] ? (int) $row['user_timeout'] : (int) TIMEOUT_DEFAULT)) ?
				(int) TIMEOUT_MIN :
				((int) TIMEOUT_MAX < ((int) $row['user_timeout'] ? (int) $row['user_timeout'] : (int) TIMEOUT_DEFAULT) ?
					(int) TIMEOUT_MAX :
					((int) $row['user_timeout'] ? (int) $row['user_timeout'] : (int) TIMEOUT_DEFAULT)
				);
			$timeout_session = strtotime($row['now']) - strtotime($row['session_timeout']);
			$timeout_ok = $timeout_actual - $timeout_session;
			if($timeout_ok > 0) {
				// Marad belépve
				$logged = true;
				$user = $row['user_id'];
				session_extend($sid);
			} else {
				// Lejárt a session
				$message = array(
					'type' => 'warning',
					'strong' => 'Kilépés!',
					'text' => 'Lejárt a biztonsági időkorlát.'
				);
				session_logout($sid);
			};
		};
	} else {
		create_new_session($sid, $ip, $ua);
	};
	// Belépési kísérlet
	if(isset($_POST) && isset($_POST['user']) && isset($_POST['pass'])) {
		$user = preg_replace('/\W/', '', $_POST['user']);
		if($user === $_POST['user']) {
			$pass = sha1($_POST['pass']);
			$sql = "SELECT * FROM users WHERE user_id = '$user' AND user_pass = '$pass';";
			$rs = $db->execute($sql);
		};
		if(isset($pass) && $row = $rs->fetchRow()) {
			$logged = true;
			session_login($sid, $user);
			$message = array(
				'type' => 'success',
				'strong' => 'Sikeres belépés!',
				'text' => ''
			);
		} else {
			$logged = false;
			session_logout($sid);
			$message = array(
				'type' => 'danger',
				'strong' => 'Sikertelen belépés!',
				'text' => 'A megadott felhasználói név vagy jelszó helytelen.'
			);
		};
	} elseif(isset($_POST) && isset($_POST['logout'])) {
		$logged = false;
		session_logout($sid);
		$message = array(
			'type' => 'success',
			'strong' => 'Sikeres kilépés!',
			'text' => ''
		);
	};
?>