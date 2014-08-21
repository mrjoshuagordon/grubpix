<?php

$comment = sanitize($_POST['comment']);
$user_id = $user_data['user_id'];
$username = $user_data['username'];



if(empty($comment) === true) {
	$errors[] = 'Please enter a comment';
	
}	


else if(strlen($comment) > 255) {
	
	$errors[] = 'Comment must be less than 255 characters';


} else{

	if(empty($errors) === false ) {
			echo '<h2> Please fix the following:</h2>';
				echo output_errors($errors);		
		} else {
	


	mysql_query("INSERT INTO `grub_comment` (`grub_id`, `user_id`, `username`, `comment`) VALUES ('$image_id' , '$user_id' , '$username',' $comment' )");

	}

}


?>