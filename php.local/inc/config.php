<?php
	// SQL
	define('DB_TYPE', 'mysqli');           // SQL server type (eg. mysqli, postresql)
	define('DB_USER', 'phplocal');         // SQL user
	define('DB_PASS', 'Betp3BtiCtMSAmuQ'); // SQL user's password
	define('DB_BASE', 'phplocal');         // SQL database name
	define('DB_HSTN', 'localhost');        // SQL server hostname
	define('DB_PORT', 3306);               // SQL server port
///////////////////////////////////////////////////////////////////////////////
// Don't edit bellow this line
///////////////////////////////////////////////////////////////////////////////
	if((DB_TYPE === 'mysqli') && (DB_PORT === 3306))
		define('DB_HOST', DB_HSTN);	
	else
		define('DB_HOST', DB_HSTN . ':' . DB_PORT);	
	require_once('inc/adodb5/adodb.inc.php');
	$db = adoNewConnection(DB_TYPE);
	$db->connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);
	$sql = 'SET NAMES utf8;';
	$db->execute($sql);
	// Site
	$sql = "SELECT * FROM options;";
	$rs = $db->execute($sql);
	while($row = $rs->fetchRow())
		define(strtoupper($row['option_id']), $row['option_value']);
	if(null === SITE_NAME)
		define('SITE_NAME', 'Adatbázishiba!');
?>