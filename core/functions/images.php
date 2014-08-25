<?php 














function make_profile_thumbs() {

$dir = 'images/profile/';
$dh  = opendir($dir);
$allowed = array('jpg','jpeg','gif','png');


while (false !== ($filename = readdir($dh))) {

$file_ext  = strtolower(end(explode('.',$filename)));

	if( in_array($file_ext, $allowed)) {
	
    $files[] = $filename;
    
    } 
} 

foreach($files as $file){

	$fileloc = 'images/profile/thumbs'.$file;

if(!file_exists($fileloc)) {
	create_thumbnail($dir.'/'.$file, 'images/profile/thumbs/'.$file, 100, 100);
//	echo 'file created' . $file;
//echo "The file $fileloc does not exists" . '<br>';
	} else{
	//echo "The file $fileloc exists".'<br>';
	
	}
}  


}





function image_data( $image_id) {
	
$data = mysql_fetch_assoc(mysql_query("SELECT * FROM `image_data` WHERE `grub_id` = $image_id"));
		
return $data;	


}

function find_grub_ids () {

$result = array();

$query = mysql_query("SELECT `grub_id` FROM `image_data` WHERE `active` = 1");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = $row['grub_id'];
	
	} 
	return $result;

}



function find_public_images( $grub_ids ) {

$ids = join(',',$grub_ids);  

$result = array();

$query = mysql_query("SELECT * FROM `grubs` WHERE `grub_id` IN ($ids) ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = $row['image'];
	
	} 
	return $result;


}



function image_name_from_id($image_id){
	$image_id = sanitize($image_id);
	return mysql_result(mysql_query("SELECT `image` from `grubs` where `grub_id` = '$image_id'"),0,
	'image');
} 





function user_id_from_imagename($imagename){
	$user_id = sanitize($imagename);
	return mysql_result(mysql_query("SELECT `user_id` from `grubs` where `image` = '$imagename'"),0,
	'user_id');
} 





function image_id_from_imagename($imagename){
	$imagename = sanitize($imagename);
	return mysql_result(mysql_query("SELECT `grub_id` from `grubs` where `image` = '$imagename'"),0,
	'grub_id');
} 


function add_image($image_id, $title, $location, $description){

	$title = sanitize($title);
	$location = sanitize($location);
	$description = sanitize($description);
	
	
	$query = mysql_query("SELECT COUNT(`grub_id`) from `image_data` WHERE `grub_id` = '$image_id' ");
			
		if( mysql_result($query,0)>=1) {
			
		mysql_query("UPDATE `image_data` SET `title` = '$title' , `location`= '$location' , `description` = '$description' WHERE `grub_id` = '$image_id' ");
					
	
		} else{
				
		mysql_query("INSERT INTO `image_data` (`grub_id`, `title`, `location`, `description`) VALUES ('$image_id' , '$title' , '$location','$description')");

		} 
	

}


function publish_image($image_id){
	mysql_query("UPDATE `image_data` SET `active` = 1 WHERE `grub_id` = '$image_id' ");

}


function find_user_images  ($session_user_id) {

$result = array();

$query = mysql_query("SELECT *  FROM `grubs` WHERE `user_id` = $session_user_id ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	

		$result[] = $row['image'];
	
	} 
	return $result;

}





function make_thumbs() {

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
//	echo 'file created' . $file;
//echo "The file $fileloc does not exists" . '<br>';
	} else{
	//echo "The file $fileloc exists".'<br>';
	
	}
}  


}

function create_thumbnail($path, $save, $width, $height){
	$info = getimagesize($path);
	$size = array($info[0], $info[1]);
	
	if ($info['mime'] == 'image/png') {
			$src = imagecreatefrompng($path);
	} else if ($info['mime'] == 'image/jpeg') {
		$src = imagecreatefromjpeg($path);
	} else if ($info['mime'] == 'image/gif') {
		$src = imagecreatefromgif($path);
	} else{
		return false;
	}
	
	$thumb = imagecreatetruecolor($width, $height);
	
	$src_aspect = $size[0]/ $size[1];
	$thumb_aspect = $width/$height;
	
	if($src_aspect < $thumb_aspect){
		$scale = $width / $size[0] ;
		$new_size = array($width, $width/$src_aspect);
		$src_pos =  array(0, ($size[1] * $scale - $height) / $scale / 2);
	} else if ( $src_aspect > $thumb_aspect) {
		$scale = $height / $size[1];
		$new_size = array($height * $src_aspect , $height);
		$src_pos =  array(($size[0] * $scale - $width) / $scale / 2,0);	
	} else {
		$new_size = array($width, $height);
		$src_pos =  array(0,0);	
	}
	
	$new_size[0] = max($new_size[0],1);
	$new_size[1] = max($new_size[1],1);
	
	imagecopyresampled($thumb, $src, 0,0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
	
	if($save === false) {
		return imagepng($thumb);
	} else{
	
	return imagepng($thumb, $save);
	
	}
}





?>