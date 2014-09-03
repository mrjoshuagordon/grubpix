<?php
	$image_id = image_id_from_imagename($image);
	$macro_user_id = $session_user_id;
	 $result = find_user_macros ($image_id, $macro_user_id); 
	$calorie_guess = empty($result['calories']) ? 0 :  $result['calories'] ;
	$protein_guess = empty($result['protein'])  ? 0 :  $result['protein']; 
	$fat_guess = empty($result['fat'])          ? 0 :  $result['fat'];
	$carb_guess = empty($result['carbs'])       ? 0 :  $result['carbs'];
	$fiber_guess = empty($result['fiber'])      ? 0 :  $result['fiber']; 
	


	$output = find_overall_macros($image_id);
	
	!empty($result['calories']) ? $overall_calories = round($output['overall_calories'],2) :  $overall_calories = '?';
 	!empty($result['protein'])  ? $overall_protein = round($output['overall_protein'],2) :  $overall_protein = '?';
	!empty($result['fat'])          ? $overall_fat = round($output['overall_fat'],2) :  $overall_fat = '?';
 	!empty($result['carbs'])       ? $overall_carbs = round($output['overall_carbs'],2) :  $overall_carbs = '?';
	!empty($result['fiber'])      ? $overall_fiber = round($output['overall_fiber'],2) :  $overall_fiber = '?';
	
	
	
	//print_r($output);

/*	
	if(!empty($_POST['macro-submit']) && isset($_POST['macro-submit'])) {  
	$calories = $_POST['calories'];
	$protein = $_POST['protein'];
	$fat = $_POST['fat'];
	$carb = $_POST['carbs'];
	$fiber = $_POST['fiber'];
	$image_id = image_id_from_imagename($image); 

	$macro_user_id = $session_user_id;

	

	post_rating($image_id, $macro_user_id, $calories, $protein, $fat, $carb, $fiber);



 	header( 'Location: grubinfo.php?image='.$image );

}
	*/


//	print_r(array($user_id, $image_id, $calories, $protein, $fat, $carb, $fiber));
	
	



?>

<div class="table_container">
	<h4> Guess the Calories of this Grub! </h4> 
	 <h5> Users Guessed: <?php echo find_number_of_guesses($image_id);?> </h5>
	<form name="macroForm" method="post"> 
		<table class="grub_guess_table" border="1" style="width:100%">
		<tr>
		  <td class="guess-header"> Energy Type: </td>
		  <td class="guess-header">Slide to Guess:</td> 
		  <td class="guess-header">Your Guess:</td>
		  <td class="guess-header">Overall:</td>
		</tr>
		<tr>
		  <td class="guess-type">Calories </td>
		  <td width="150"><input name= "calories" type="range" min="0" max="3500" value="<?php echo $calorie_guess; ?>" step="10" onchange="showCaloriesValue(this.value)" /></td> 
		  <td width="150"><span id="calories"> <?php  print_r($calorie_guess); ?></span></td>
		  <td width="150"><?php echo $overall_calories ;?></td>
		</tr>
		<tr>
		  <td class="guess-type">Protein (grams) </td>
		  <td width="150"> <input name= "protein" type="range" min="0" max="350" value="<?php echo $protein_guess; ?>" step="5" onchange="showProteinValue(this.value)" /></td> 
		  <td width="150"><span id="protein"><?php  print_r($protein_guess); ?></span></td>
		  <td width="150"><?php echo $overall_protein ;?></td>
		</tr>
		<tr>
		  <td class="guess-type">Fat (grams) </td>
		  <td width="150"> <input name= "fat" type="range" min="0" max="200" value="<?php echo $fat_guess; ?>" step="5" onchange="showFatValue(this.value)" /></td> 
		  <td width="150"><span id="fat"><?php  print_r($fat_guess); ?></span></td>
		  <td width="150"><?php echo $overall_fat ;?></td>
		</tr>
		<tr>
		  <td class="guess-type">Carbs (grams) </td>
		  <td width="150"> <input name= "carbs" type="range" min="0" max="500" value="<?php echo $carb_guess; ?>" step="5" onchange="showCarbValue(this.value)" /></td> 
		  <td width="150"><span id="carbs"><?php  print_r($carb_guess); ?></span></td>
		  <td width="150"><?php echo $overall_carbs ;?></td>
		</tr>
		<tr>
		  <td class="guess-type">Fiber(grams) </td>
		  <td width="150"> <input name= "fiber" type="range" min="0" max="50" value="<?php echo $fiber_guess; ?>" step="5" onchange="showFiberValue(this.value)" /></td> 
		  <td width="150"><span id="fiber"><?php  print_r($fiber_guess); ?></span></td>
		  <td width="150"><?php echo $overall_fiber ;?></td>
		</tr>
		<tr>
		  <td class="guess-type" colspan="4">	<input type="submit" name="macro-submit" value="Submit Guess" onclick="show_alert();" /> </td>
		</tr>
		</table>
	</form>
</div>

<script>
    function show_alert(){
        return alert("Guess Submitted!");
    }
</script>



<script type="text/javascript">
function showCaloriesValue(newValue)
{
	document.getElementById("calories").innerHTML=newValue;
}

function showProteinValue(newValue)
{
	document.getElementById("protein").innerHTML=newValue;
} 

function showFatValue(newValue)
{
	document.getElementById("fat").innerHTML=newValue;
}
 
function showCarbValue(newValue)
{
	document.getElementById("carbs").innerHTML=newValue;
}
 
function showFiberValue(newValue)
{
	document.getElementById("fiber").innerHTML=newValue;
} 

</script>