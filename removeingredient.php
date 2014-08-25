<?php

include 'core/init.php';



if(isset($_GET['id'])){
	
	$ingredient_id = (int)$_GET['id'];
	
	// make sure it's the same user and session id, only allow removal from recipes uploaded by them
	//select * ingredient ids for recipes uploaded by this user, must be in array to delete. 


	if(in_array($rating, [1,2,3,4,5])){
		
	
	
					
	$query = mysql_query("SELECT COUNT(`grub_id`) from `grubs_ratings` WHERE `user_id` = '$user_id' AND `grub_id` = '$image_id' ");
	
	if(mysql_result($query,0)>0) {
	
	mysql_query("UPDATE `grubs_ratings` SET `grub_id` = '$image_id' , `user_id`= '$user_id' , `rating` = '$rating'
	 WHERE `grub_id` = '$image_id' AND `user_id` = '$user_id' ");
	
	
	} else{	 

	 mysql_query("INSERT INTO `grubs_ratings` (`grub_id`, `user_id`,`rating`) VALUES ('$image_id', '$user_id' , '$rating')");

	}
		
		
		
		
		
		
	
	}
	
	
	
	
	header('Location:grubinfo.php?image='.$image);
	
}

?>