<?php
include 'core/init.php';
header('Content-Type: application/json');

$session_user_id = $_SESSION['user_id'];
$uploaded = array();

if(!empty($_FILES['file']['name'][0])){
	foreach($_FILES['file']['name'] as $position => $name){
	
	$allowed = array('jpg','jpeg','gif','png');
	$file_name = $_FILES['file']['name'][$position];
	
	$file_ext = strtolower(end(explode('.',$file_name)));


	//$file_store_name = 'uploads/';
	
		
	$random_name = substr(md5(time()),rand(0,9), rand(30,40)).'.'.$file_ext;
	
	$file_check = 'uploads/'.$random_name;
	
	//generate a unique while name using a do while loop.
		
		do{
		$random_name = substr(md5(time()),rand(0,9), rand(20,40)).'.'.$file_ext;
		$file_check = 'uploads/'.$random_name;
		}  while(file_exists($file_check));
	
	


	if(in_array($file_ext, $allowed) === false || $_FILES['file']['size'][$position] > 2100000 )  {
	
	$uploaded[] = array('name' => 'File not allowed, please use: jpg, jpeg, gif, or png. Max Size 2MB',
						'file' => 'withheld/error.jpg');
	
	} else{
	
	if(move_uploaded_file($_FILES['file']['tmp_name'][$position], 'uploads/'.$random_name)){
			$uploaded[] = array(
				'name' => $name,
				'file' => 'uploads/' . $random_name,
				'link' => 'grubinfo.php?image=' . $random_name
			
	 		);
	
	//	create_thumbnail($file_name, 'thumbs/'.$random_name, 100, 100);  
	date_default_timezone_set('America/Los_Angeles');
	$time = date("Y-m-d h:i:sa", time()) ; 
		
	mysql_query("INSERT INTO `grubs` (`user_id`, `image`, `name`, `time`) VALUES ($session_user_id  , '$random_name' , '$name', '$time' )");	 

		//mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
		
		
		// To do, add in assignment to database 	
		}
	
	}
		
	
	
	
	} //end foreach
}


make_thumbs();




echo json_encode($uploaded) ;


?>
