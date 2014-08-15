<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;



?> 

<script type="text/javascript" src="js/script.js"></script> 

<h1> Grub Info </h1>

<?php

if(isset($_GET['image']) && !empty($_GET['image'])){

	$image = $_GET['image'];
	$link  ='./uploads/'.$image;



	echo ' <div class="grub_info">  <a href='.$link.'> <img src='.$link.'> </a> </div>'; 




}



?>

<h4> Please fill out the image details, fields marked with an * are required: </h4>
	
<div class="form_container"> 
	
	<form action="" method="post" autocomplete="off"> 
			<ul > 
				<label>
					<li> Image Title*:<br>
						<input type="text" name="title" size=35>  
					</li>
				</label>
				<li> Location (e.g. Homemade, Chipotle, etc.)*:<br>
						<input type="text" name="location" size=35>  
				</li>
				<li> Ingredients:<br>
					<input type="text" name="ingredients" size=35>  
				</li>
				<li> 
					<input type="Submit" value="Publish">  
				</li>
			</ul>
		</form> 

	<form action="" method="post">  
		Recipe: 
	
			<li> 
				<input type="checkbox" name="include_recipe">  Would you like to include a recipe? 
			</li>
	
	</form> 

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
	<label>Ingredient</label>
	<input type="text" name="BX_NAME[]">
	</td>
	<td>
	<label for="BX_age">Amount</label>
	<input type="text" class="small"  name="BX_age[]">
	</td>
	<td>
	<label for="BX_gender">Units</label>
	<select id="BX_gender" name="BX_gender">
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

<br><br><br><br>

<?php include 'includes/overall/overallfooter.php'; ?> 

