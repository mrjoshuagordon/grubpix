<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;


if (empty($_POST) === false) { 

	$email = $_POST['email'];

	$required_fields = array('first_name','email');
	foreach($_POST as $key => $value){
		if ( empty($value)  && in_array($key, $required_fields) === true) {
			$errors[] = 'Fields marked with an asterix are required';
			break 1;		
		} 
	}
	
	if(empty($errors) === true) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL ) === false) {
			$errors[] = 'A valid email address is required';
		} else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
			$errors[] = 'Sorry the email \''. $_POST['email'] . '\' is already taken.';
		}	
	
	} 
	
	
}


?>

<h2> Settings </h2>

<?php 

if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	echo 'Your details have changed';

}  else{ 


	if(empty($_POST) === false && empty($errors) === true) {
		$allow_email = ($_POST['allow_email'] == 'on') ? 1 : 0 ;
	
		$update_data = array(
		'first_name' 		=> $_POST['first_name'],
		'last_name' 		=> $_POST['last_name'],
		'email' 			=> $_POST['email'],
		'gender'			=> $_POST['gender'],
		'age'				=> $_POST['age'],
		'allow_email'		=> $allow_email
		);
	
		update_user($_SESSION['user_id'],$update_data);
		header('Location: settings.php?success');
		exit();

	} else if(empty($errors) === false) {
		echo output_errors($errors);
	}

	?>


		<form action="" method="post"> 
				<ul > 
			
					<li> First Name*:<br>
						<input type="text" name="first_name" size="35" value="<?php echo $user_data['first_name']; ?>">  
					</li>
					<li> Last Name:<br>
						<input type="text" name="last_name" size="35" value="<?php echo $user_data['last_name']; ?>">   
					</li>
					<li> Email*:<br>
						<input type="text" name="email" size="35" value="<?php echo $user_data['email']; ?>">  
					</li>
					
					<li>	
					Gender: <select width="60" style="width: 100px" name="gender">
								<option><?php echo $user_data['gender']; ?></option>
								
								<?php  
								
								if($user_data['gender']=='Male') {
								
								echo '<option>Female</option>';
								} else{
								
								echo '<option>Male</option>';
								}
								
								?>
							
								
							</select>
					</li>
					<li>	
						Age: <select width="60" style="width: 60px" name="age">
								<option><?php echo $user_data['age']; ?></option>
								<?php
								for($i=1; $i<101; $i++){
								if($i != $user_data['age'] ) {
								echo '<option>'.$i.'</option>' ;
								}
							}			?>
							</select>
					</li>		
					
					<li> 
						<input type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == 1 ) {  echo 'checked="checked"' ; } ?> >  Would you like to receive email from us?
					</li>
				
					
					<li> 
						<input type="Submit" value="Submit Changes">  
					</li>
				</ul>
			</form>
  


	<?php
}



include 'includes/overall/overallfooter.php'; 
?> 

