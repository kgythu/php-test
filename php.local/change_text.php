<?php
	require_once('inc/functions.php');
	require_once('inc/config.php');
	require_once('inc/session.php');
	$json_obj = new StdClass();
	$json_obj->status = false;
	$json_obj->message = 'Hiba 57645327';
	if(isset($_POST) && isset($_POST['name']) && isset($_POST['value'])) {
		$json_obj->message = 'Hiba 83256521';
		if(preg_match('/^(cat_[a-z]+)_(\d+)$/', $_POST['name'], $matches)) {
			$value = preg_replace('/\s+/', ' ', preg_replace('/[\'`]/', '’', $_POST['value']));
			$sql = "UPDATE cats SET {$matches[1]} = '$value' WHERE cat_id = {$matches[2]};";
			$db->execute($sql);
			$json_obj->status = true;
			$json_obj->message = 'Sikeres változtatás.';
			$json_obj->name = $matches[0];
			$json_obj->value = $value;
		};
	};
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($json_obj);
?>
