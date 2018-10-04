<?php
header("Content-type: text/html; charset=utf8");
$a = "Géza csicska.";
$a = preg_replace("/Géza/", 'Béla', $a);
echo $a;
echo "<br />\n--------------------------------------------<br />\n";
echo "Géza";
if(preg_match("/Géza/", $a)) {
	echo " igen";
} else {
	echo " nem";
};
?>