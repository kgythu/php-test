#!c:\xampp\perl\bin\perl

print("Content-type: text/html; charset=utf8\n\n");
$_ = "géza csicska.";
s/Géza/Béla/i;
print;

$a = "Géza csicska.";
$a =~ s/Géza/Béla/;
print $a;

print("<br />\n--------------------------------------------<br />\n");
print("Géza");
if(/Géza/) {
	print(" igen");
} else {
	print(" nem");
};