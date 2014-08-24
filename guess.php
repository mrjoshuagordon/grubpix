<?php

include 'core/init.php';



if(isset($_GET['grub_id'])){
	
	
	
	/* $image_id = (int)$_GET['grub_id'];
	$rating = (int)$_GET['rating'];
	$image = image_name_from_id($image_id); 
	//$user_id = user_id_from_imagename($image);
	$user_id = $user_data['user_id'];
	if(in_array($rating, [1,2,3,4,5])){
		
	
	
					
	$query = mysql_query("SELECT COUNT(`grub_id`) from `grubs_ratings` WHERE `user_id` = '$user_id' AND `grub_id` = '$image_id' ");
	
	if(mysql_result($query,0)>0) {
	
	mysql_query("UPDATE `grubs_ratings` SET `grub_id` = '$image_id' , `user_id`= '$user_id' , `rating` = '$rating'
	 WHERE `grub_id` = '$image_id' AND `user_id` = '$user_id' ");
	
	
	} else{	 

	 mysql_query("INSERT INTO `grubs_ratings` (`grub_id`, `user_id`,`rating`) VALUES ('$image_id', '$user_id' , '$rating')");

	}
		
		
		
		
		
		
	
	}
	
	*/ 
	
	$image_id = (int)$_GET['grub_id'];
	$image = image_name_from_id($image_id);
	header('Location:grubedit.php?image='.$image);
	
}

?>