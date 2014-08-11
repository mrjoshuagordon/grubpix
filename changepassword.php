<?php 
include 'core/init.php';
protect_page();




	if(empty($_POST)=== false ){
		$required_fields = array('current_password','password','password_again');
			foreach($_POST as $key => $value){
			if ( empty($value)  && in_array($key, $required_fields) === true) {
				$errors[] = 'Fields marked with an asterix are required';
				break 1;		
			} 
		}
	
		if(md5($_POST['current_password']) === $user_data['password']){
			if(trim($_POST['password']) !== trim($_POST['password_again'])){
				$errors[] = 'Your new passwords do not match';  
			} else if ( strlen($_POST['password']) < 6 ){
				$errors[] = 'Your password must be at least 6 characters';  
			} 
		
	
		} else{
			$errors[] = 'Your current password is incorrect'; 
	
		}
	



	}



	include 'includes/overall/overallheader.php' ;


	?> 


	<h1> Change Password </h1>

	<?php


if(isset($_GET['success']) && empty($_GET['success'])){
	echo 'Your password has been changed';

	} else {  

	if(isset($_GET['force']) === true && empty($_GET['force']) === true) {
	?>
	
	<p> You must change your password before proceeding. </p>
	
	
	<?php
	}
			

	if( empty($_POST) === false && empty($errors) === true ) {
	// no errors
		change_password($session_user_id,$_POST['password'] );
		header('Location: changepassword.php?success');
	} else if (empty($errors) === false ) {
	//errors
		echo output_errors($errors);

	}

	?>


	<form action="" method="post"> 
			<ul > 
			
				<li> Password*:<br>
					<input type="password" name="current_password">  
				</li>
				<li> New Password*:<br>
					<input type="password" name="password">  
				</li>
				<li> New Password again*:<br>
					<input type="password" name="password_again">  
				</li>
				<li> 
					<input type="Submit" value="Change Password">  
				</li>
			</ul>
		</form>
 


	<?php 

}
include 'includes/overall/overallfooter.php'; ?> 

