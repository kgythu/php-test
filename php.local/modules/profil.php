	<h2>Személyes adatok</h2>
<?php
	echo "\t<p class=\"avatar\">";
	echo get_gravatar($user_datas['user_email'], 300, 'mp', 'g', true);
	// Másik megoldás
	// https://tecadmin.net/php-script-to-get-gravatar-image-using-email-address/
	echo "</p>";
	echo "\t<p>Név: <strong>";
	if($user_datas['user_easternorder']) {
		echo $user_datas['user_title'],
			' ', $user_datas['user_lastname'],
			' ', $user_datas['user_firstname'];
	} else {
		echo $user_datas['user_title'],
			' ', $user_datas['user_firstname'],
			' ', $user_datas['user_lastname'];
	};
	echo "</strong></p>\n";
	echo "\t<p>E-mail: <strong><a href=\"mailto:{$user_datas['user_email']}\">";
	echo $user_datas['user_email'];
	echo "</a></strong></p>\n";
	echo "\t<p>Nem: <strong><select name=\"usersex{$user_datas['user_id']}\" class=\"usersex form-control\">\n";
	$sql = 'SELECT * FROM user_sexes;';
	$rs2 = $db->execute($sql);
	while($row2 = $rs2->fetchRow()) {
		echo "\t\t<option";
		if($user_datas['user_sex'] === $row2['user_sex_id']) {
			echo ' selected="selected"';
		};
		echo " value=\"{$row2['user_sex_id']}\">{$row2['user_sex_name']}</option>\n";
	};
	echo "\t</select></strong></p>\n";
	echo "\t<pre>\n";
	var_dump(get_gravatar_profile($user_datas['user_email']));
	echo "\t</pre>\n";
?>