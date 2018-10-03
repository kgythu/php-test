<?php
	$page_title = '404 Not found';
	$page_id    = '404';
	$page_text  = false;
	if(!isset($_GET['page']))
		$_GET['page'] = 'index';
	if(!preg_match('/\W/', $_GET['page']) && $_GET['page']) {
		$sql = "SELECT * FROM pages WHERE page_id = '{$_GET['page']}';";
		$rs = $db->execute($sql);
		while($row = $rs->fetchRow()) {
			if($logged || $row['page_public']) {
				$page_title = $row['page_title'];
				$page_id    = $row['page_id'];
				$page_text  = $row['page_text'];
			} else {
				$sql = "SELECT * FROM pages WHERE page_id = '403';";
				$rs = $db->execute($sql);
				while($row = $rs->fetchRow()) {
					$page_title = $row['page_title'];
					$page_id    = $row['page_id'];
					$page_text  = $row['page_text'];
				};
			};
		};
		if($page_text === false) {
			$sql = "SELECT * FROM pages WHERE page_id = '404';";
			$rs = $db->execute($sql);
			while($row = $rs->fetchRow()) {
				$page_title = $row['page_title'];
				$page_id    = $row['page_id'];
				$page_text  = $row['page_text'];
			};
		};
	};
?>