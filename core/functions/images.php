<?php


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


?>