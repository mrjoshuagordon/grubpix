<script>
function toggleTable() {
    var lTable = document.getElementById("recipeTable");
    lTable.style.display = (lTable.style.display == "table") ? "none" : "table";
    
        var dTable = document.getElementById("directionsTable");
   			 dTable.style.display = (dTable.style.display == "table") ? "none" : "table";
   			 
   	  document.getElementById('recipe').innerHTML = '<span id="recipe"><a id="loginLink" onclick="toggleTable();" href="#recipe">Hide Recipe</a> </span>';
}


  </script>
  
  
  <?php

//get_recipe ($image_id) <?php   echo  ;  


?>
  

<span id="recipe"><a id="loginLink" onclick="toggleTable();" href="#recipe">Show Recipe</a> </span>
 
<table id="directionsTable" class="comment_table" border="1" align="center" style="display:none"> 
<tr> <td> Test </td><tr>

</table>
<br>

<table id="recipeTable" class="comment_table" border="1" align="center" style="display:none">  

<?php

 $recipe_result = get_recipe_id($image_id);	
$recipe_id =  $recipe_result['recipe_id'] ;

$recipe_data = find_recipe_data($recipe_id);
//print_r($recipe_data );

echo   ' <tr> <td> Ingredient </td> <td> Amount </td> <td> Unit </td> </tr>';
for($i = 0; $i < count($recipe_data ); $i++){
	$id[] = $recipe_data[$i]['ingredient_id'];
	echo '<tr> <td>'.  $recipe_data[$i]['ingredient_name'].'</td> <td>'. $recipe_data[$i]['amount'] . '</td> <td>'. $recipe_data[$i]['unit'] . '</td> </tr>';
}


?>

</table>
</br>