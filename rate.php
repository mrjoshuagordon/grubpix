<?php

include 'core/init.php';



if(isset($_GET['grub_id'],$_GET['rating'])){
	
	$image_id = (int)$_GET['grub_id'];
	$rating = (int)$_GET['rating'];
	$image = image_name_from_id($image_id); 
	$user_id = user_id_from_imagename($image);
	
	if(in_array($rating, [1,2,3,4,5])){
		
	
	
			
			 mysql_query("INSERT INTO `grubs_ratings` (`grub_id`, `user_id`,`rating`) VALUES ('$image_id', '$user_id' , '$rating')");
		
		
	
	}
	
	
	
	
	header('Location:grubinfo.php?image='.$image);
	
}

?>