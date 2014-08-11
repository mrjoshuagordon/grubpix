<?php 

include 'core/init.php';

logged_in_redirect();


if(empty($_POST)===false){
	$username = $_POST['username'];
	$password =  $_POST['password'];
	
	
	if(empty($username) === true || empty($password) === true ){
		$errors[] = 'You need to enter a username and password';
	} else if (user_exists($username) ===false) {
		$errors[] = 'We cannot find that username, have you registered?';
	}	else if (user_active($username) ===false) {
		$errors[] = 'You have not activated your account.';
	} else{ // log the user in
	
		if(strlen($password) > 32 ) {
		$errors[] = 'Password too long';
		
		}
	
		$login = login($username, $password);
		if($login === false){
			$errors[] = 'That username/password combination is incorrect';
		} else{
			// user logged in correctly!
			//die($login);
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
		
		}
	} 
	
	//print_r($errors);
	

} else{
	$errors[] = 'No Data Received';
	
	}


include 'includes/overall/overallheader.php'; 
	


if(empty($errors)===false) { 

?> 

<h2> We've tried to log you in but...</h2>

<?php
 echo output_errors($errors); 

}
 
	
include 'includes/overall/overallfooter.php'; 
?>