<?php


include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;

if(isset($_GET['success'])){

 echo 'Report Submitted!';

} else { 
	

		if(isset($_GET['image'],$_GET['reason'])){
	
			$image_id = (int)$_GET['image'];
			$reason = sanitize($_GET['reason']);
			//$image = image_name_from_id($image_id); 
			$user_id = $user_data['user_id'];



	$query = mysql_query("SELECT COUNT(`grub_id`) from `grub_reporting` WHERE `user_id` = '$user_id' AND `grub_id` = '$image_id' ");
	
	if(mysql_result($query,0)==0) {
	
	
	 mysql_query("INSERT INTO `grub_reporting` (`grub_id`, `user_id`,`reason`) VALUES ('$image_id', '$user_id' , '$reason')");

		header('Location: reportsuccessful.php?success');

	} else{
	
		header('Location: reportsuccessful.php?success');
	
	}



}	


}



?>


<?php include 'includes/overall/overallfooter.php'; ?> 