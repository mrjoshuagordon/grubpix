<?php


function post_comment($image_id, $user_id, $username, $comment){

$comment = sanitize($comment);


	$query = mysql_query("SELECT COUNT(`grub_id`) from `grub_comment` WHERE `grub_id` = '$image_id' AND `user_id` = '$user_id' ");
	
	if(mysql_result($query,0)>0) {
	
	mysql_query("UPDATE `grub_comment` SET `grub_id` = '$image_id' , `user_id`= '$user_id' , `username` = '$username', `comment` = '$comment'
	 WHERE `grub_id` = '$image_id' ");
	
	} else{	 

	mysql_query("INSERT INTO `grub_comment` (`grub_id`, `user_id`, `username`, `comment`) VALUES ('$image_id' , '$user_id' , '$username',' $comment' )");

	}



}


function find_image_comments ($image_id) {

$result = array();

$query = mysql_query("SELECT * FROM `grub_comment` WHERE `grub_id` = '$image_id' ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	

		$result[] = array($row['username'], $row['comment']);
	
	} 
	return $result;

}








?>