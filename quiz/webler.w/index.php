<?php
	require_once('inc/config.php');
?><!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="utf8" />
	<title>Működik</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="main" class="container">
	<h1>Működik</h1>
	<p>webler.w</p>
	<table class="table table-bordered table-striped table-hover">
<?php
	$users = array(0);
	$sql_user_datas = array(' FROM (SELECT * FROM quiz_answers) AS answer0');
	$sql = 'SELECT * FROM quiz_users;';
	$rs = $db->execute($sql);
	if($rs) while($row = $rs->fetchRow()) {
		$users[$row['quiz_user_id'] - 0] = (integer) $row['quiz_user_id'];
		$sql_user_datas[$row['quiz_user_id'] - 0] =
			' JOIN (SELECT quiz_answer_id, quiz_answer_answer AS user'
			. $row['quiz_user_id']
			. ' FROM quiz_answers_by_users WHERE quiz_user_id = '
			. $row['quiz_user_id']
			. ') AS answer'
			. $row['quiz_user_id']
			. ' ON answer0.quiz_answer_id = answer'
			. $row['quiz_user_id']
			. '.quiz_answer_id';
	};
	$order = 'quiz_answer_id';
	if(isset($_GET['o']) && preg_match('/^([a-z0-9_]+)(-2)?$/', $_GET['o'], $matches)) {
		switch($matches[1]) {
			case 'quiz_answer_id':
			case 'quiz_answer_answer':
				$order = $matches[1];
				break;
			default:
				foreach($users as $i) {
					if($matches[1] === 'user' . $i) {
						$order = $matches[1];
					};
				};
		};
		if(isset($matches[2]) && ($matches[2] === '-2')) {
			$order .= ' DESC';
		};
	};
?>
		<thead>
			<tr>
				<th class="text-center"><?php if($order !== 'quiz_answer_id') {
					?><a href="?o=quiz_answer_id">ID
					<span class="glyphicon glyphicon-sort-by-order"></span></a> <?php
				} else {
					?>ID <span class="glyphicon glyphicon-sort-by-order"></span> <?php
				};
				if($order !== 'quiz_answer_id DESC') {
					?>

					<a href="?o=quiz_answer_id-2">
					<span class="glyphicon glyphicon-sort-by-order-alt"></span></a><?php
				} else {
					?><span class="glyphicon glyphicon-sort-by-order-alt"></span><?php
				};
				?></th>
				<th class="text-center"><?php if($order !== 'quiz_answer_answer') {
					?>

					<a href="?o=quiz_answer_answer">Helyes
					<span class="glyphicon glyphicon-sort-by-alphabet"></span></a><?php
				} else {
					?>Helyes <span class="glyphicon glyphicon-sort-by-alphabet"></span> <?php
				};
				if($order !== 'quiz_answer_answer DESC') {
					?>

					<a href="?o=quiz_answer_answer-2">
					<span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></a><?php
				} else {
					?>

					<span class="glyphicon glyphicon-sort-by-alphabet-alt"></span><?php
				};
				?></th>
<?php
for($i = 1; $i < count($users); $i++) {
	echo "				<th class=\"text-center\">";
	if($order !== 'user' . $i) echo "<a href=\"?o=user$i\">";
	echo "User $i\n\t\t\t\t\t";
	echo '<span class="glyphicon glyphicon-sort-by-alphabet"></span>';
	if($order !== 'user' . $i) echo '</a>';
	echo "\n\t\t\t\t\t";
	if($order !== 'user' . $i . ' DESC') echo "<a href=\"?o=user$i-2\">";
	echo '<span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>';
	if($order !== 'user' . $i . ' DESC') echo '</a>';
	echo "</th>\n";
};
?>
			</tr>
		</thead>
		<tbody>
<?php
	$sql = '';
	$sql2 = '';
	foreach($users as $key => $value) {
		$sql .= ($sql === '') ?
			'SELECT answer0.*' :
			', answer' . $key . '.user' . $key;
		$sql2 .= "\n" . $sql_user_datas[$key];
	};
	$sql .= $sql2 . ' ORDER BY ';
	$sql .= $order . ';';
	$rs = $db->execute($sql);
	if($rs) while($row = $rs->fetchRow()) {
?>
			<tr>
				<td class="text-right"><?=$row['quiz_answer_id']?></td>
				<td class="text-center"><?=$row['quiz_answer_answer']?></td>
<?php
for($i = 1; $i < count($users); $i++) {
?>
				<td class="text-center<?php
					echo ($row['quiz_answer_answer'] === $row['user' . $i]) ?
					' success' : '';
				?>"><?=$row['user' . $i]?></td>
<?php
};
?>
			</tr>
<?php
	};
	//echo $sql;
?>
		</tbody>
	</table>
</div>
</body>
</html>