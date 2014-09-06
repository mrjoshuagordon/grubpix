<script>
function toggleTable() {
    var lTable = document.getElementById("recipeTable");
    lTable.style.display = (lTable.style.display == "table") ? "none" : "table";
    
        var dTable = document.getElementById("directionsTable");
   			 dTable.style.display = (dTable.style.display == "table") ? "none" : "table";
   			 
   	  document.getElementById('recipe').innerHTML = '<span id="recipe"><a id="loginLink" onclick="toggleTable();" href="#recipe">Recipe</a> </span>';
}


  </script>
  
  
  <?php

//get_recipe ($image_id) <?php   echo  ;  

 $recipe_result = get_recipe_id($image_id);	

//print_r($recipe_result);
$recipe_id =  $recipe_result['recipe_id'] ;

$name_directions = get_recipe_name_and_directions($recipe_id);
//print_r($name_directions);


//only show recipe toggle if recipe id exists
if($recipe_id > 1) { 


?>
 <span id="recipe"><a id="loginLink" onclick="toggleTable();" href="#recipe">Show Recipe</a> </span> 
  
  <?php
  }
  
  ?>


 
 
<table id="directionsTable" class="comment_table" border="1" align="center" style="display:none"> 
<tr> 
	<td class="directions-title"> Recipe Name:    </td> 
	<td class="directions-content" colspan="2"><?php echo  $name_directions['recipe_name']; ?> </td>
</tr>
<tr> 
	<td class="directions-title">  Directions: </td> 
	<td class="directions-content" colspan="2"> <?php echo  $name_directions['recipe_directions']; ?></td>
</tr>
</table>

<table id="recipeTable" class="comment_table" border="1" align="center" style="display:none">  

<?php



$recipe_data = find_recipe_data($recipe_id);



echo   ' <tr> <td> Ingredient </td> <td> Amount </td> <td> Unit </td> </tr>';

	if(!empty($recipe_data)) {

for($i = 0; $i < count($recipe_data ); $i++){
//	$id[] = $recipe_data[$i]['ingredient_id'];
	echo '<tr> <td>'.  $recipe_data[$i]['ingredient_name'].'</td> <td>'. $recipe_data[$i]['amount'] . '</td> <td>'. $recipe_data[$i]['unit'] . '</td> </tr>';
	}

} else{
	
	echo '<tr> <td> <b>'.  '?' .' </b> </td> <td> <b>'.  '?' . ' </b></td> <td> <b>'.  '?' . '</b></td> </tr>';
	}

?>

</table>
