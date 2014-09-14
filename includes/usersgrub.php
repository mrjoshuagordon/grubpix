

	

	
	<?php if(!empty($_POST['submit_recipe'])) {
	$recipe_name = $_POST['recipe_name'];
	$recipe_directions = $_POST['recipe_directions'];
	
	$BX_Ingredient = $_POST['BX_Ingredient'];
	$Amount = $_POST['BX_Amount'];
	$Unit = $_POST['BX_Unit'];
	
//	echo $recipe_name;
//	print_r($BX_Ingredient[0]);
//	print_r($BX_Amount);
///	print_r($BX_Unit);
	

	
	
	if(empty($_POST['recipe_name'])) {
	
	$comment_errors[] = 'Please enter a recipe name';
			echo '<div class="comment_container"> <h2 class="h2-alert" > Please fix the following:</h2>';
				echo output_errors($comment_errors);		
			echo '</div>'	;	
	
	}  else{
	post_recipe($session_user_id, $image_id, $recipe_name, $recipe_directions);
	
	}
	
	if(!empty($BX_Ingredient[0])){
		//$comment_errors[] = 'Please enter at least one ingredient';
		//	echo '<div class="comment_container"> <h2> Please fix the following:</h2>';
		//		echo output_errors($comment_errors);		
		//	echo '</div>'	;
			 $recipe_result = get_recipe_id($image_id);	
		$recipe_id =  $recipe_result['recipe_id'] ;
		post_ingredients($recipe_id,  $BX_Ingredient, $Amount, $Unit);

	
	}
	
	}
	  ?>
	
	
<script type="text/javascript" src="js/script.js"></script> 
	

<?php   

$get_recipe = get_recipe($image_id) ;

//print_r($get_recipe);

$get_recipe_name = empty($get_recipe['recipe_name']) ? "" :  $get_recipe['recipe_name'] ;   
$get_recipe_directions = empty($get_recipe['recipe_directions']) ? "" :  $get_recipe['recipe_directions'] ;  


?>






	
<form action="" method="post" name="recipeForm">  
		<h2> Recipe: </h2> 
	
			
		<li> 	Recipe Name:	<input type="text" name="recipe_name" value="<?php echo $get_recipe_name ; ?>">  </li>
		<li> 	Directions:	<br > <textarea id="direction-textarea"type="text" name="recipe_directions" ><?php echo $get_recipe_directions; ?></textarea>  </li>	




<div class="comment_output_table">

<table class="comment_table">
<?php

 $recipe_result = get_recipe_id($image_id);	
$recipe_id =  $recipe_result['recipe_id'] ;

$recipe_data = find_recipe_data($recipe_id);
//print_r($recipe_data );

echo '<form action="" method="post" name="ingredientForm">   <tr> <td> Ingredient </td> <td> Amount </td> <td> Unit </td> <td>  Remove? </td> </tr>';
for($i = 0; $i < count($recipe_data ); $i++){
	$id[] = $recipe_data[$i]['ingredient_id'];
	echo '<tr> <td>'.  $recipe_data[$i]['ingredient_name'].'</td> <td>'. $recipe_data[$i]['amount'] . '</td> <td>'. $recipe_data[$i]['unit'] . '</td> <td><a href="removeingredient.php?id='.$recipe_data[$i]['ingredient_id'].'&grub_id='.$image_id.'"> Remove </a> </td>  </tr>';
}
echo '</form>'

//."<td>" . " <input type='submit' id= ' $recipe_data[$i]['ingredient_id'] ' . ' value='Delete' >" .  "</td> 


?>
</table> 

</div>

 

<p> 
  <input type="button" value="Add Ingredient" onClick="addRow('dataTable')" /> 
  <input type="button" value="Remove Ingredient" onClick="deleteRow1('dataTable')" /> 
</p>

<table id="dataTable" class="form" border="1">
 <tbody>

  <tr>
	<p>
	
	<td>
	<label>Ingredient</label><br>

	 <input type="text" id="BX_Ingredient" name="BX_Ingredient[]">

	</td>
	<td>
	<label for="BX_age">Amount</label> <br>
	<input id="BX_amount" type="text" class="small"  name="BX_Amount[]">
	</td>
	<td id="unit-selector">
	<label for="BX_gender">Units</label> <br>
	<select id="BX_gender" name="BX_Unit[]">
		<option>....</option>
		<option>Grams</option>
		<option>Ml</option>
		<option>Ounces</option>
		<option>Fl Ounces</option>
	</select>
	</td>
	</p>
  </tr>
  	
 </tbody>
</table>

  <input type="Submit" value="Submit Recipe" name="submit_recipe" id="recipe-submit">    
  
  	</form> 

<br><br><br><br>
