<?php










function get_ingredients(){

	$name = array();
	$query_run = mysql_query("SELECT * FROM `grub_ingredients` ");
		
		while($query_row = mysql_fetch_assoc($query_run)){
		
			  $name[] = $query_row['ingredient_name'];
		
		}

	$arr = array_unique($name);
 	$out = '"'.implode('", "',$arr).'"';
	return($out);
}





function get_recipe_name_and_directions($recipe_id){

	$result = array();

	$query = mysql_query("SELECT * FROM `grub_recipe` WHERE 
	`recipe_id` = '$recipe_id' ");
	
	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array( 'recipe_directions' => $row['recipe_directions'], 'recipe_name' => $row['recipe_name']);
	
	} 
	
	
	
	 
	if(!empty($result)) 	{	
	return $result[0];
	
	}
	
	
}





function get_user_recipes($user_id){

	$result = array();

	$query = mysql_query("SELECT `recipe_id` FROM `grub_recipe` WHERE 
	`user_id` = '$user_id' ");
	
	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = $row['recipe_id'];
	
	} 
	return $result; 
	
	
}


function get_user_ingedients_recipes($recipe_ids){
	
	$result = array();

	$query = mysql_query("SELECT * FROM `grub_ingredients`");
	
	while(($row = mysql_fetch_assoc($query)) !== false){
	
		if(in_array($row['recipe_id'], $recipe_ids)){ 
	
		$result[] = $row['ingredient_id'];
	
	}
	
	} 
	return $result; 

}











function find_recipe_data($recipe_id) {


	$result = array();

	$query = mysql_query("SELECT * FROM `grub_ingredients` WHERE `recipe_id` = '$recipe_id' ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array('ingredient_id' => $row['ingredient_id'],
		'ingredient_name' => $row['ingredient_name'], 
		'amount' => $row['amount'], 
		'unit' => $row['unit']
		
		);
	
	} 
	return $result;



}











function post_ingredients($recipe_id,  $BX_Ingredient, $Amount, $Unit){
		 
	
	for($i = 0; $i < count($BX_Ingredient); $i++) {
	
	$temp_ingredient = $BX_Ingredient[$i];
	$temp_amount  = $Amount[$i];
	$temp_unit = $Unit[$i];

	
	mysql_query("INSERT INTO `grub_ingredients` (`recipe_id`, `ingredient_name`, `amount`, `unit`) VALUES ('$recipe_id', '$temp_ingredient', '$temp_amount','$temp_unit' )");  
	
	}
	

}


function get_recipe_id($image_id){
	$result = array();

	$query = mysql_query("SELECT `recipe_id` FROM `grub_recipe` WHERE `grub_id` = '$image_id' ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array('recipe_id' => $row['recipe_id']);
	
	} 

	if(!empty($result)) 
		{	return $result[0];
	
		}
		

}




function post_recipe($user_id, $image_id, $recipe_name, $recipe_directions){

$recipe_name         = sanitize($recipe_name);
$recipe_directions = sanitize($recipe_directions);

	$query = mysql_query("SELECT COUNT(`grub_id`) from `grub_recipe` WHERE `grub_id` = '$image_id'");
	
		
	if(mysql_result($query,0) == 0) {
	
	mysql_query("INSERT INTO `grub_recipe` (`user_id`, `grub_id`, `recipe_name`, `recipe_directions`) 
	VALUES ( '$user_id' , '$image_id', '$recipe_name',' $recipe_directions' )");
	} else{	 

	mysql_query("UPDATE `grub_recipe` SET  `recipe_name` = '$recipe_name', `recipe_directions` = '$recipe_directions'  
	WHERE `grub_id` = '$image_id' AND `user_id` = '$user_id' ");


	}




}




function get_recipe ($image_id){


$result = array();

$query = mysql_query("SELECT * FROM `grub_recipe` WHERE `grub_id` = '$image_id' ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array('recipe_name' => $row['recipe_name'], 'recipe_directions' => $row['recipe_directions']);
	
	} 
	if(!empty($result)) 
	{	return $result[0];
	
	}
		


}









?>