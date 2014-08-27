<?php

include 'core/init.php';



if(isset($_GET['id'])){
	
	$ingredient_id = (int)$_GET['id'];
	$image_id = (int) $_GET['grub_id'];
	$image = image_name_from_id($image_id);
	
	// make sure it's the same user and session id, only allow removal from recipes uploaded by them
	//select * ingredient ids for recipes uploaded by this user, must be in array to delete. 
	$user_id = $session_user_id;
	$recipe_ids = get_user_recipes($user_id);
	$ingredient_recipe_ids = get_user_ingedients_recipes($recipe_ids);
	print_r($recipe_ids);
	print_r($ingredient_recipe_ids);


if(in_array($ingredient_id, $ingredient_recipe_ids)) {

//delete from table

mysql_query("DELETE FROM `grub_ingredients` WHERE `ingredient_id` = '$ingredient_id '  ");
header('Location: grubedit.php?image='.$image ); 
exit();
}


/*
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
	
	*/
	
}

?>