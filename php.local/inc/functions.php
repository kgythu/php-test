<?php
$dir = 'inc/functions';
if(is_dir($dir)) {
    if($dh = opendir($dir)) {
        while(($file = readdir($dh)) !== false) {
			//echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
			if(preg_match('/\.php$/', $file)) {
				require_once($dir . '/' . $file);
			};
        };
        closedir($dh);
    };
};
?>