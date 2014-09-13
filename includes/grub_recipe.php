<script>
function toggleTable() {
    var lTable = document.getElementById("recipeTable");
    var dTable = document.getElementById("directionsTable");
    var rDiv = document.getElementById("recipe-div");
    var iDiv = document.getElementById("ingredients-div");
    var dHt = document.getElementById('recipe'); 
    
    lTable.style.display = (lTable.style.display == "table") ? "none" : "table";
    dTable.style.display = (dTable.style.display == "table") ? "none" : "table";
   //	rDiv.style.border =  (rDiv.style.border == "inset black 1px") ? "none" : "inset black 1px";
   //	iDiv.style.border =  (iDiv.style.border == "inset black 1px") ? "none" : "inset black 1px";
   	
   	dHt.innerHTML =  ( 	dHt.innerHTML ==  '<span id="recipe"><a id="loginLink" onclick="toggleTable();" href="#recipe">  <h4> Hide Recipe </h4> </a> </span>') ? 
   	'<span id="recipe"><a id="loginLink" onclick="toggleTable();" href="#recipe">  <h4> Show Recipe </h4> </a> </span>'
   	
   	: '<span id="recipe"><a id="loginLink" onclick="toggleTable();" href="#recipe">  <h4> Hide Recipe </h4> </a> </span>';
   	
   	
}




  </script>
  
  <?php

 $recipe_result = get_recipe_id($image_id);	

if(!empty( $recipe_result)) {

?> 
  
  
  <div id="recipe-div"> 
  
  <?php

//get_recipe ($image_id) <?php   echo  ;  


//empty($recipe_result) ;
//print_r($recipe_result);
$recipe_id =  $recipe_result['recipe_id'] ;

$name_directions = get_recipe_name_and_directions($recipe_id);
//print_r($name_directions);


//only show recipe toggle if recipe id exists
if($recipe_id > 1) { 


?>
 <span id="recipe"><a id="loginLink" onclick="toggleTable();" href="#recipe"> <h4> Show Recipe </h4> </a> </span> 
  
  <?php
  }
  
  ?>



<table id="directionsTable" cellpadding="0" cellspacing="0" style="display:none"> 
<tr> 
	<td class="directions-title"> Recipe Name:    </td> 
	<td class="directions-content" colspan="2"><?php echo  $name_directions['recipe_name']; ?> </td>
</tr>
<tr> 
	<td class="directions-title">  Directions: </td> 
	<td class="directions-content" colspan="2"> <?php echo  $name_directions['recipe_directions']; ?></td>
</tr>
</table>


<br>

<table id="recipeTable" style="display:none">  

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
</div>
<?php
}
?>
