<?php
	require_once('inc/config.php');
?><!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="utf8" />
	<title>Működik</title>
</head>
<body>
<div id="main">
	<h1>Működik</h1>
	<p>webler.w</p>
	<pre><?php
		$users = array(0);
		$sql_user_datas = array('(SELECT * FROM quiz_answers) AS answer0');
		$sql = 'SELECT * FROM quiz_users;';
		$rs = $db->execute($sql);
		if($rs) while($row = $rs->fetchRow()) {
			$users[$row['quiz_user_id'] - 0] = (integer) $row['quiz_user_id'];
			$sql_user_datas[$row['quiz_user_id'] - 0] =
				'(SELECT quiz_answer_id, quiz_answer_answer AS user'
				. $row['quiz_user_id']
				. ' FROM quiz_answers_by_users WHERE quiz_user_id = '
				. $row['quiz_user_id']
				. ') AS answer'
				. $row['quiz_user_id'];
		};
		$sql = '';
		$sql_b = '';
		foreach($users as $key => $value) {
			if($sql === '') {
				$sql .= 'SELECT answer' . $key . '.*';
				$sql_b .= "\n" . ' FROM ' . $sql_user_datas[$key];
				$on = ' ON answer' . $key . '.quiz_answer_id = answer';
			} else {
				$sql .= ', answer' . $key . '.user' . $key;
				$sql_b .= "\n" . ' JOIN ' . $sql_user_datas[$key]
					. $on . $key . '.quiz_answer_id';
			};
		};
		$sql .= $sql_b;
/*
SELECT answer0.*, answer1.user1 FROM $sql_user_datas[0] JOIN $sql_user_datas[1]
ON quiz_answers.quiz_answer_id = answer1.quiz_answer_id
*/
		//var_dump($users);
		//var_dump($sql_user_datas);
		echo $sql;
	?></pre>
</div>
</body>
</html>