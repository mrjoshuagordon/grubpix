<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/overallheader.php' ;


if (isset($_GET['success']) === true && empty($_GET['email']) === true )  {
?>

<h2> Thanks, we activated your account </h2> 
<p> You are free to login</p>

<?php


}

else if ( isset($_GET['email'], $_GET['email_code'] ) === true ) {

	$email = trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
	
	if(email_exists($email) === false ) {
	
	$errors[] = 'Oops something went wrong and we could not find that email address.';
	
	} else if(activate($email, $email_code) === false) {
	$errors[] = 'We had problems activating your account';		
	} 
	
	if(empty($errors) === false) {
	?> 
	<h2>  Oops... </h2>
	
	
	<?php
	
	echo output_errors($errors);
	
	} else{
	header('Location: activate.php?success');
	exit();
	
	
	}

} else{
header('Location: index.php');
exit();

}






include 'includes/overall/overallfooter.php'; ?> 

