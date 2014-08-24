<?php



function find_user_rating ($image_id, $user_id) {

$result = array();

$query = mysql_query("SELECT `rating` FROM `grubs_ratings` WHERE `grub_id` = '$image_id'  AND `user_id` = '$user_id' ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	

		$result[] = $row['rating'];
	
	} 
	if(!empty($result)) {
	return $result[0];
	} else{
	
	return '-';
	
	}
	

}



function find_overall_rating ($image_id) {



$query = mysql_query("SELECT AVG(`rating`) as 'rating' FROM `grubs_ratings` WHERE `grub_id` = '$image_id'  ");

while(($row = mysql_fetch_assoc($query)) !== false){
	

		$result[] = $row['rating'];
	
	} 

	if(!empty($result)) {
		print_r(round($result[0],2));
	} else{
	
	return '-';
	
	}
	

}

 




function post_rating($image_id, $user_id, $calories, $protein, $fat, $carb, $fiber){



	$query = mysql_query("SELECT COUNT(`grub_id`) from `grub_guess` WHERE `grub_id` = '$image_id' AND `user_id` = '$user_id' ");
	
		
	if(mysql_result($query,0) == 0) {
	
		mysql_query("INSERT INTO `grub_guess` (`grub_id`,`user_id`,`calories`,`protein`,`fat`,`carbs`,`fiber`) VALUES ('$image_id', '$user_id', '$calories','$protein','$fat','$carb', '$fiber')");

	} else{	 

	mysql_query("UPDATE `grub_guess` SET  `calories` = '$calories', `protein` = '$protein', `fat` = '$fat', `carbs` = '$carb', `fiber` = '$fiber' WHERE `grub_id` = '$image_id' AND `user_id` = '$user_id' ");


	}



}





function find_user_macros ($image_id, $user_id) {

$result = array();

$query = mysql_query("SELECT * FROM `grub_guess` WHERE `grub_id` = '$image_id'  AND `user_id` = '$user_id' ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array($row['calories'], $row['protein'], $row['fat'], $row['carbs'], $row['fiber'] ) ;
	
	} 
	if(!empty($result)) {
	return $result[0];
	} else{
	
	return array('0','0','0','0','0');
	
	}
	

}





?>