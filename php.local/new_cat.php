<?php
	require_once('inc/functions.php');
	require_once('inc/config.php');
	require_once('inc/session.php');
	$json_obj = new StdClass();
	$json_obj->status = false;
	$json_obj->statusNumber = 0;
	$json_obj->message = 'Hiba 57645327';
	if(isset($_POST)
		&& isset($_POST['name'])
		&& isset($_POST['sex'])
		&& isset($_POST['chip'])
		&& isset($_POST['birth'])
		&& isset($_POST['neutered'])
	) {
		$json_obj->message = 'Hiba 83256521';
		$name     = preg_replace('/\s+/', ' ', preg_replace('/[\'`]/', '’', $_POST['name']));
		$sex      = (integer) $_POST['sex'];
		$chip     = (integer) $_POST['chip'];
		$birth    = preg_replace('/\D+/', '-', $_POST['birth']);
		$neutered = (integer) $_POST['neutered'];
		if($name === '') {
			$json_obj->message = 'A név mező nem maradhat üres!';
		} else if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birth)) {
			$json_obj->message = 'A dátum mező formátuma nem megfelelő!';
		} else if(!preg_match('/^[01]$/', $chip)) {
			$json_obj->message = 'A chip mező tartalma hibás!';
		} else if(!preg_match('/^[01]$/', $neutered)) {
			$json_obj->message = 'Az ivartalanítás mező tartalma hibás!';
		} else {
			$birth_unixtime = strtotime($birth . ' 00:00:00');
			$now_unixtime   = time();
			// Jövőbeli dátum vizsgálata
			if(($now_unixtime - $birth_unixtime) < 0) {
				$json_obj->message = 'A születési idő nem lehet a jövőben!';
				$json_obj->statusNumber = 2;
			} else {
				// Nemek ellenőrzése adatbázisból
				$sql = "SELECT * FROM cat_sexes WHERE cat_sex_id = $sex;";
				$rs = $db->execute($sql);
				if($rs->fetchRow()) {
					$cat_num_before = 0;
					$cat_num_after = 0;
					$sql = 'SELECT COUNT(cat_name) AS c FROM cats;';
					$rs2 = $db->execute($sql);
					if($row = $rs2->fetchRow()) {
						$cat_num_before += $row['c'];
					};
					$sql = 'INSERT INTO cats(cat_name, cat_sex, cat_chip, cat_birth, cat_neutered)'
						. " VALUES ('$name', $sex, $chip, '$birth', $neutered);";
					$db->execute($sql);
					$sql = 'SELECT COUNT(cat_name) AS c FROM cats;';
					$rs2 = $db->execute($sql);
					if($row = $rs2->fetchRow()) {
						$cat_num_after += $row['c'];
					};
					// Vizsgálat, hogy bekerült-e
					if(($cat_num_after - $cat_num_before) > 0) {
						$json_obj->message = 'Sikeres feltöltés. Az adatok bekerültek az adatbázisba.';
					} else {
						$json_obj->message = 'Sikeres feltöltés.';
					};
					// Új táblázat küldése
					$order = '';
					if(preg_match('/^https?\:\/\/php.local\/macskak\?o\=(\w+)/', $_POST['url'], $matches)) {
						$order = $matches[1];
					};
					ob_start();
					require_once('modules/catadmin.tbody.php');
					$json_obj->tbody = ob_get_clean();
					$json_obj->status = true;
					$json_obj->statusNumber = 1;
					/* */
				} else {
					$json_obj->message = 'A nem mező tartalma hibás!';
				};
			};
		};
	};
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($json_obj);
?>
