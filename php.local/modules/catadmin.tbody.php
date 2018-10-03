<?php
	/* * /
	$sql = 'SELECT cats.*, cat_sexes.cat_sex_name FROM cats JOIN cat_sexes '
		. 'ON cats.cat_sex = cat_sexes.cat_sex_id;';
	/* */
	$sql = 'SELECT * FROM cats ORDER BY ';
	if(isset($order)) {
		switch($order) {
			case 'name2':
				$sql .= 'cat_name DESC';
				break;
			case 'sex2':
				$sql .= 'cat_sex DESC';
				break;
			case 'chip2':
				$sql .= 'cat_chip DESC';
				break;
			case 'birth2':
				$sql .= 'cat_birth DESC';
				break;
			case 'neutered2':
				$sql .= 'cat_neutered DESC';
				break;
			case 'id2':
				$sql .= 'cat_id DESC';
				break;
			case 'name':
				$sql .= 'cat_name';
				break;
			case 'sex':
				$sql .= 'cat_sex';
				break;
			case 'chip':
				$sql .= 'cat_chip';
				break;
			case 'birth':
				$sql .= 'cat_birth';
				break;
			case 'neutered':
				$sql .= 'cat_neutered';
				break;
			default:
				$sql .= 'cat_id';
				break;
		};
	} else {
		$sql .= 'cat_id';
	};
	$sql .= ';';
	$rs = $db->execute($sql);
	while($row = $rs->fetchRow()) {
		echo "\t\t\t<tr>\n";
		echo "\t\t\t\t<td>{$row['cat_id']}</td>\n";
		echo "\t\t\t\t<td><input class=\"cat_text form-control\" name=\"cat_name_{$row['cat_id']}\" value=\"{$row['cat_name']}\" /></td>\n";
		echo "\t\t\t\t<td><select class=\"cat_number form-control\" name=\"cat_sex_{$row['cat_id']}\">\n";
		$sql = 'SELECT * FROM cat_sexes;';
		$rs2 = $db->execute($sql);
		while($row2 = $rs2->fetchRow()) {
			echo "\t\t\t\t\t<option";
			if($row['cat_sex'] === $row2['cat_sex_id']) {
				echo ' selected="selected"';
			};
			echo " value=\"{$row2['cat_sex_id']}\">{$row2['cat_sex_name']}</option>\n";
		};
		//echo {$row['cat_sex_name']};
		echo "\t\t\t\t</select></td>\n";
		echo "\t\t\t\t<td><select class=\"cat_number form-control\" name=\"cat_chip_{$row['cat_id']}\">\n";
		$yesno = array('nem', 'igen');
		foreach($yesno as $key => $value) {
			echo "\t\t\t\t\t<option";
			if((integer) $row['cat_chip'] === $key) {
				echo ' selected="selected"';
			};
			echo " value=\"$key\">$value</option>\n";
		};
		//{$row['cat_chip']}
		echo "\t\t\t\t</select></td>\n";
		echo "\t\t\t\t<td><input class=\"cat_date form-control\" type=\"date\" name=\"cat_birth_{$row['cat_id']}\" value=\"{$row['cat_birth']}\" /></td>\n";
		//echo "\t\t\t\t<td>{$row['cat_birth']}</td>\n";
		echo "\t\t\t\t<td><select class=\"cat_number form-control\" name=\"cat_neutered_{$row['cat_id']}\">\n";
		$yesno = array('nem', 'igen');
		foreach($yesno as $key => $value) {
			echo "\t\t\t\t\t<option";
			if((integer) $row['cat_neutered'] === $key) {
				echo ' selected="selected"';
			};
			echo " value=\"$key\">$value</option>\n";
		};
		//{$row['cat_neutered']}
		echo "\t\t\t\t</select></td>\n";
		echo "\t\t\t\t<td class=\"text-right\"><button class=\"btn btn-danger btn-block\">\n";
		echo "\t\t\t\t\tTörlés <span class=\"glyphicon glyphicon-floppy-remove\"></span>\n";
		echo "\t\t\t\t</button></td>\n";
		echo "\t\t\t</tr>\n";
	};
/*
cat_id
cat_name
cat_sex
cat_chip
cat_birth
cat_neutered
*/
	//echo 'Catadmin';
?>