<?php 




function get_locations_for_gallery(){

	$name = array();
	$query_run = mysql_query("SELECT `location` FROM(
							SELECT `location`, count(`location`) as numb from `image_data` GROUP BY `location` )  as temp
WHERE numb > 3");
		
		while($query_row = mysql_fetch_assoc($query_run)){
		
			  $name[] = $query_row['location'];
		
		}

	return($name);
}








//






// user to find get the images returned the order specified by the user on the gallery page
function find_public_images_query( $grub_ids, $order, $rating, $location ) {

$ids = join(',',$grub_ids);  

$result = array();

$query = mysql_query("SELECT * FROM `grubs` WHERE `grub_id` IN ($ids) AND `grub_id` IN (
					SELECT `grub_id` FROM `image_data`  WHERE `location` LIKE '$location' AND `grub_id` IN(
						SELECT `grub_id` FROM (
												SELECT `grub_id`, AVG(`rating`) AS rating FROM `grubs_ratings` GROUP BY `grub_id`
													) as temp1 WHERE rating >= '$rating'
											) 
							) ORDER BY `grub_id` $order ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array( 'image' => $row['image']);
	
	} 
	return $result;
	
	
	


}




















































function find_grub_ids_by_user_id ($session_user_id) {

$result = array();

$query = mysql_query(" SELECT `image` FROM `grubs` WHERE  `user_id` = '$session_user_id' AND `grub_id` IN
					(SELECT `grub_id` FROM `image_data` WHERE `active` = 1) 
						ORDER BY `grub_id` DESC
																		
						 ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = $row['image'];
	
	} 
	return $result;

}






























function find_profile($user_id){


$result = array();

$query = mysql_query("SELECT * FROM `users` WHERE `user_id` = '$user_id'  ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array( 'profile' => $row['profile']);
	
	} 
	


 	return $result[0];
 



}






























function find_grub_ids_by_settings() {

$result = array();

$query = mysql_query("SELECT `grub_id` FROM `image_data` WHERE `active` = 1");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = $row['grub_id'];
	
	} 
	return $result;

}














function get_locations(){

	$name = array();
	$query_run = mysql_query("SELECT * FROM `image_data` ");
		
		while($query_row = mysql_fetch_assoc($query_run)){
		
			  $name[] = $query_row['location'];
		
		}

	$arr = array_unique($name);
 	$out = '"'.implode('", "',$arr).'"';
	return($out);
}





function non_drag_add_image($user_id, $file_temp, $file_ext, $file_name){
	$name = $file_name;
	
		do { 
	$upload_name = substr(md5(time()),rand(0,9), rand(30,40)).'.' .$file_ext ;
	$random_name = 'uploads/'.$upload_name;
			} while(file_exists($random_name)); 
	
	
	/*
	$file_check = $random_name;
	

	
	if(file_exists($file_check)){
	$upload_name = substr(md5(time()),rand(0,9), rand(30,40)).'.'.$file_ext ;
	$random_name = 'uploads/'.$upload_name;
	
	}	
	
	*/
	date_default_timezone_set('America/Los_Angeles');
	$time = date("Y-m-d h:i:sa", time()) ; 
	
		move_uploaded_file($file_temp, $random_name);
		mysql_query("INSERT INTO `grubs` (`user_id`, `image`, `name`, `time`) VALUES ('$user_id' , '$upload_name' , '$name', '$time' )");	 

		 $display_name = 'uploads/thumbs/'.$upload_name;
		 echo 'Image Uploaded! <br> <a href=./grubinfo.php?image='.$upload_name.' target="blank"><img src="'.$display_name.'"> </a> <br>';
		 echo '<a href=./grubinfo.php?image='.$upload_name.' target="blank">'. $file_name. '</a>';
}








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

if(count($data) > 1) {
 		
return $data;	

} else {

return array(
	'data_id' => '',
	'grub_id' => '',
	'title' => '',
	'location' => '',
	'description' => '',
	'price' => '',
	'time' => '',
	'active' => ''

);

}


}

function find_grub_ids () {

$result = array();

$query = mysql_query("SELECT `grub_id` FROM `image_data` WHERE `active` = 1 ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = $row['grub_id'];
	
	} 
	return $result;

}



function find_public_images( $grub_ids ) {

$ids = join(',',$grub_ids);  

$result = array();

$query = mysql_query("SELECT * FROM `grubs` WHERE `grub_id` IN ($ids) ORDER BY `grub_id` DESC ");

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


function user_id_from_image_id($image_id){
	return mysql_result(mysql_query("SELECT `user_id` from `grubs` WHERE `grub_id` = '$image_id' "),0,
	'user_id');
} 






function image_id_from_imagename($imagename){
	$imagename = sanitize($imagename);
	return mysql_result(mysql_query("SELECT `grub_id` from `grubs` where `image` = '$imagename'"),0,
	'grub_id');
} 


function add_image($image_id, $title, $location, $description, $price){

	$title = sanitize($title);
	$location = sanitize($location);
	$description = sanitize($description);
	$price = sanitize($price);
	
	date_default_timezone_set('America/Los_Angeles');
	$time = date("F j, Y", time()) ; 
	
	
	$query = mysql_query("SELECT COUNT(`grub_id`) from `image_data` WHERE `grub_id` = '$image_id' ");
			
		if( mysql_result($query,0)>=1) {
			
		mysql_query("UPDATE `image_data` SET `title` = '$title' , `location`= '$location' , `description` = '$description', `price` = '$price', `time` = '$time' WHERE `grub_id` = '$image_id' ");
					
	
		} else{
				
		mysql_query("INSERT INTO `image_data` (`grub_id`, `title`, `location`, `description`, `price`, `time`) VALUES ('$image_id' , '$title' , '$location','$description', '$price', '$time' )");

		} 
	

}


function publish_image($image_id){
	mysql_query("UPDATE `image_data` SET `active` = 1 WHERE `grub_id` = '$image_id' ");

}


function find_user_images  ($session_user_id) {

$result = array();

$query = mysql_query("SELECT *  FROM `grubs` WHERE `user_id` = $session_user_id ORDER BY `grub_id` DESC ");

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