<?php
$dir = dirname(__FILE__).'/images/';
echo $dir;
$filename = array();
$num = 0;
$str = '100%-asd';
echo "**".strpos($str, '%')."**";

function checkimgname($dir) {
	global $filename, $num;
	$tempdir = scandir($dir);
	//print_r($tempdir);
	foreach($tempdir as $value) {
		if(strpos($value, '%')) {
			echo 123;
			rename($dir . $value, $dir . str_replace('%', '', $value));
			$filename[] = $value;
			$num++;
		}
	}
	
}
checkimgname($dir);
echo $num;
echo '<pre>';
print_r($filename);
echo '</pre>';
?>