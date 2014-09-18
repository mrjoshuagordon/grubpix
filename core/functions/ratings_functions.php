<?php





function get_setting_limit($user_id) {


$result = array();

$query = mysql_query("SELECT * FROM `user_settings` WHERE `user_id` = '$user_id'  ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array( 'limit' => $row['image_view'], 'order' => $row['order'], 'rating' => $row['rating'], 'location' => $row['location']);
	
	} 

if(!empty($result[0])) {
	return $result[0];
}



} 





function user_setting_limit_input($user_id, $limit, $order, $rating, $location){

	$limit= (int) $limit; 
	
	$query = mysql_query("SELECT COUNT(`user_id`) from `user_settings` WHERE `user_id` = '$user_id'  ");
			
		if( mysql_result($query,0)>=1) {
			
		mysql_query("UPDATE `user_settings` SET `image_view` = '$limit', `order` = '$order', `rating` = '$rating', `location` = '$location'  WHERE `user_id` = '$user_id' ");
					
	
		} else{
				
		mysql_query("INSERT INTO `user_settings` (`user_id`, `image_view`, `order`, `rating`, `location`) VALUES ('$user_id' , '$limit', '$order', '$rating', '$location')");

		} 
	

}
























































function get_reported_images(){

$result = array();

$query = mysql_query("SELECT `grub_id`, `user_id`, `reason`, COUNT(`grub_id`) as `count` FROM `grub_reporting` GROUP BY `grub_id` ORDER BY `count` DESC");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array( 'grub_id' => $row['grub_id'], 'user_id' => $row['user_id'], 'reason'=> $row['reason'], 'count' => $row['count']);
	
	} 
	if(!empty($result)) {
		return $result;
	} 

}


function find_number_of_guesses($image_id) {

return mysql_result(mysql_query("SELECT COUNT(DISTINCT `user_id`) as `user_id` from `grub_guess` WHERE `grub_id` = '$image_id'"),0,
	'user_id');
	
}



function find_number_of_ratings($image_id) {

return mysql_result(mysql_query("SELECT COUNT(DISTINCT `user_id`) as `user_id` from `grubs_ratings` WHERE `grub_id` = '$image_id'"),0,
	'user_id');
	
}



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
	
		$result[] = array('calories' => $row['calories'], 'protein' => $row['protein'],
		'fat' => $row['fat'], 'carbs' => $row['carbs'], 'fiber' => $row['fiber'] ) ;
	
	} 
	if(!empty($result)) {
	return $result[0];
	} else{
	
	$result[] = array('calories' => '0', 'protein' => '0',
		'fat' => '0', 'carbs' => '0', 'fiber' => '0' ) ;
	
	}
	

}






function find_overall_macros($image_id) {



$query = mysql_query("SELECT AVG(`calories`) as 'calories',
							 AVG(`protein`)  as 'protein', 
							 AVG(`fat`)  as 'fat', 
							 AVG(`carbs`)  as 'carbs',
							 AVG(`fiber`)  as 'fiber'
					  FROM `grub_guess` 
					  WHERE `grub_id` = '$image_id'  ");

while(($row = mysql_fetch_assoc($query)) !== false){
	

		$result[] = array( 'overall_calories' => $row['calories'], 'overall_protein' => $row['protein'], 'overall_fat' => $row['fat'], 'overall_carbs' => $row['carbs'], 'overall_fiber' => $row['fiber'] ) ;
	} 

	if(!empty($result)) {
		return $result[0];
	} else{
		
		$no_result = array( 'overall_calories' => '0', 'overall_protein' => '0', 'overall_fat' => '0', 'overall_carbs' => '0', 'overall_fiber' => '0' );
	
		return  $no_result[0] ;
	
	}
	

}






?>