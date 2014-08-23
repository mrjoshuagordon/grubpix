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

 







?>