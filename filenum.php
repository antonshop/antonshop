<?php
$dir = dirname(__FILE__); 
echo $dir;
$filename = array();
$num = 0;
echo '<pre>';
print_r(scandir($dir));
echo '</pre>';

function filenum($dir) {
	global $filename, $num;
	
	//if($dirpath[strlen($dirpath)-1] !='\\'){ $dirpath.='\\';}
	$tempdir = scandir($dir);
	
	foreach($tempdir as $item) {
		if(($item == '.' || $item == '..')) { 
			continue;
		}
		if(is_dir($item)) {
			//echo $dir . '/' . $item . ' ccccc';exit;
			filenum($dir . '/' . $item);
		} else {
			//echo 'xxxxx';
			$num++;
		}
		//print_r($item);exit;
	}
	return $num;
}
echo filenum($dir);
function read_dir_all($dir) { 
	global $filename;
	
	$ret = array('dirs'=>array(), 'files'=>array()); 
	
	if ($handle = opendir($dir)) { 
		while (false !== ($file = readdir($handle))) { 
		if($file != '.' && $file !== '..') { 
			$cur_path = $dir . DIRECTORY_SEPARATOR . $file; 
			if(is_dir($cur_path)) { 
				$ret['dirs'][$cur_path] = read_dir_all($cur_path); 
			} else { 
				$ret['files'][] = $cur_path;
				$zipname = basename($cur_path);
				if(substr($zipname, 0, 1) == '-'){
					$zipname = substr($zipname, 1);
				}
				if(substr($zipname, -4, 4) == '.zip'){
					$filename[] = str_replace('www.', '', $zipname);
				}
			} 
		} 
	} 
		closedir($handle); 
	} 
		$ret['filename'] = $filename;
		return $ret; 
} 

?>