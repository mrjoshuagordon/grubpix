<?php

$dir = 'uploads/';
$dh  = opendir($dir);
$allowed = array('jpg','jpeg','gif','png');


while (false !== ($filename = readdir($dh))) {

$file_ext  = strtolower(end(explode('.',$filename)));

	if( in_array($file_ext, $allowed)) {
	
    $files[] = $filename;
    
    } 
} 

foreach($files as $file){

	$fileloc = 'uploads/thumbs/'.$file;

if(!file_exists($fileloc)) {
	create_thumbnail($dir.'/'.$file, 'uploads/thumbs/'.$file, 100, 100);
	echo 'file created' . $file;
//echo "The file $fileloc does not exists" . '<br>';
	} else{
	//echo "The file $fileloc exists".'<br>';
	
	}
} 

?>