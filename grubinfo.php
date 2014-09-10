<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;



?> 





<?php



if(isset($_GET['image']) && !empty($_GET['image'])){

	$image = $_GET['image'];
    $link  ='./uploads/'.$image;


	
}
	
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


	


//	print_r(array($user_id, $image_id, $calories, $protein, $fat, $carb, $fiber));
	
	
}

echo ' <div class="grub_info">  <a href='.$link.'> <img id="grub-main" src='.$link.'> </a> </div> <br>'; 

	$image_id = image_id_from_imagename($image);
	$image_data = image_data($image_id);


//	print_r($image_data);

$user_id = user_id_from_imagename($image);

	
	if($session_user_id == $user_id) {

	include 'includes/usersgrub_prompt_edit.php' ; 

  



} else{

	include 'includes/publicgrub.php' ; 



}





?>









<?php include 'includes/overall/overallfooter.php'; ?> 

