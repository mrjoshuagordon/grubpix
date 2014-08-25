<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;



?> 



<h1> Grub Info </h1>

<?php




if(isset($_GET['image']) && !empty($_GET['image'])){

	$image = $_GET['image'];
    $link  ='./uploads/'.$image;



	echo ' <div class="grub_info">  <a href='.$link.'> <img src='.$link.'> </a> </div> <br>'; 

	$image_id = image_id_from_imagename($image);
	$image_data = image_data($image_id);
	

	
}




$user_id = user_id_from_imagename($image);

	
	if($session_user_id == $user_id) {

	include 'includes/usersgrub_prompt_edit.php' ; 

  



} else{

	include 'includes/publicgrub.php' ; 



}





?>









<?php include 'includes/overall/overallfooter.php'; ?> 

