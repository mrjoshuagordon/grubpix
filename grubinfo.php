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



	echo ' <div class="grub_info">  <a href='.$link.'> <img src='.$link.'> </a> </div> <br>'; 

	$image_id = image_id_from_imagename($image);
	$image_data = image_data($image_id);
}





if(empty($_POST) === false) {

	if(empty($_POST['Edit']) === false) {
	
	include 'includes/usersgrub.php' ;
	
	} else if(empty($_POST['comment_submit']) === false){
	
	require 'includes/grubcomment.php' ;
//	echo 'good';
	header('Location:'.$current_file.'?image='.$image);
	exit();
	
	}else{

			if(empty($_POST['title']) === true) {
				$errors[] = 'Title is Required';
		
			}			
		

		
			if(empty($_POST['location']) === true)  {
				$errors[] = 'Location is required';
		
			}
			
			
					
			if(empty($errors) === false ) {
			echo '<h2> Please fix the following:</h2>';
				echo output_errors($errors);		
			}  else{
			
			$image_id = image_id_from_imagename($image);			
			
			if( isset($_POST['public_check']) && $_POST['public_check'] == 'on'){
			$allow_public = 1;
						
			} else{
			
			$allow_public = 0 ;
			} 		
			
				
			
			if($allow_public === 1 ) {
				add_image($image_id, $_POST['title'], $_POST['location'], $_POST['description']);
				publish_image($image_id);
			
			} else{
				add_image($image_id, $_POST['title'], $_POST['location'], $_POST['description']);
			
			}
			
							
				header('Location:'.$current_file.'?image='.$image);
				exit();	
			}
		
			}
		}



//	$image_id = image_id_from_imagename($image);
//	$image_data = image_data($image_id);
	$user_id = user_id_from_imagename($image);

	
	if($session_user_id == $user_id) {


  if( empty($_POST['Edit']) === true ) {

	include 'includes/usersgrub_prompt_edit.php' ; 

  }



} else{

	include 'includes/publicgrub.php' ; 



}



?>











































<!-- 
<h4> Please fill out the image details, fields marked with an * are required: </h4>
	
<form action="" method="post">  
		Recipe: 
	
			<li> 
				<input type="checkbox" name="include_recipe">  Would you like to include a recipe? 
			</li>
	
	</form> 
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
-->

<?php 



include 'includes/overall/overallfooter.php'; ?> 

