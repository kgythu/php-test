<?php
	require_once('inc/functions.php');
	require_once('inc/config.php');
	require_once('inc/session.php');
	$json_obj = new StdClass();
	$json_obj->status = false;
	$json_obj->statusNumber = 0;
	$json_obj->message = 'Hiba 34658632';
	if(isset($_POST) && isset($_POST['id'])) {
		$json_obj->message = 'Hiba 21635763';
		if(!preg_match('/^del(\d+)$/', $_POST['id'], $matches)) {
			$json_obj->message = 'A megadott tartalom nem törölhető! 26525625';
		} else {
            $cat_delete_success = 0;
			$sql = "UPDATE cats SET cat_deleted = TRUE WHERE cat_id = {$matches[1]};";
			$db->execute($sql);
			$sql = "SELECT COUNT(cat_name) AS c FROM cats WHERE cat_deleted = TRUE AND cat_id = {$matches[1]};";
			$rs2 = $db->execute($sql);
			if($row = $rs2->fetchRow()) {
				$cat_delete_success += $row['c'];
			};
			// Vizsgálat, hogy törlődött-e
			if($cat_delete_success) {
				$json_obj->message = 'Az adatok sikeresen törlődtek.';
                $json_obj->status = true;
			} else {
				$json_obj->message = 'Hiba a törlés során! 52363456';
			};
		};
	};
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($json_obj);
?>
