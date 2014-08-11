<?php
header('Content-Type: application/json');

$uploaded = array();

if(!empty($_FILES['file']['name'][0])){
	foreach($_FILES['file']['name'] as $position => $name){
	
	$allowed = array('jpg','jpeg','gif','png');
	$file_name = $_FILES['file']['name'][$position];
	$file_ext = strtolower(end(explode('.',$file_name)));

	if(in_array($file_ext, $allowed) === false || $_FILES['file']['size'][$position] > 2100000 )  {
	
	$uploaded[] = array('name' => 'File not allowed, please use: jpg, jpeg, gif, or png. Max Size 2MB',
						'file' => 'uploads/error.jpg');
	
	} else{
	
	if(move_uploaded_file($_FILES['file']['tmp_name'][$position], 'uploads/'.$name)){
			$uploaded[] = array(
				'name' => $name,
				'file' => 'uploads/' . $name
			
			);
			
		}
	
	}
		
	
	
	
	}
}

echo json_encode($uploaded) ;


?>

