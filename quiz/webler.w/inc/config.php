<?php
    define('SQL_TYPE', 'mysqli');           // Adatbázisszerver típusa
    define('SQL_HOST', 'localhost');        // Hoszt, ahol fut
    define('SQL_PORT', '3306');             // Port száma
    define('SQL_BASE', 'weblerw');          // Adatbázis neve
    define('SQL_USER', 'weblerw');          // Felhasználó neve
    define('SQL_PASS', '07ieqoXV8K7mCQhd'); // Felhasználó jelszava
    require_once('inc/adodb5/adodb.inc.php');
    $db = adoNewConnection(SQL_TYPE);
    $db->connect(SQL_HOST . ':' . SQL_PORT, SQL_USER, SQL_PASS, SQL_BASE);
    $sql = 'SET NAMES utf8;';
    $db->execute($sql);
?>