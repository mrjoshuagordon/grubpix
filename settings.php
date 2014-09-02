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



<?php 

if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	echo 'Your details have changed';

}  else{ 
echo '<h2> Profile Data   ( * required ) </h2>';

	if(empty($_POST) === false && empty($errors) === true) {
	//	$allow_email = ($_POST['allow_email'] == 'on') ? 1 : 0 ;
		if(!empty($_POST['allow_email']) && $_POST['allow_email'] == 'on') { $allow_email  = 1 ; } else {$allow_email  = 0; }	

	
		if(!empty($_POST['allow_first_name']) && $_POST['allow_first_name'] == 'on') { $allow_first_name  = 1 ; } else {$allow_first_name  = 0; }	
		if(!empty($_POST['allow_last_name']) && $_POST['allow_last_name'] == 'on') { $allow_last_name  = 1 ; } else {$allow_last_name  = 0; }
		if(!empty($_POST['allow_email_profile']) && $_POST['allow_email_profile'] == 'on') { $allow_email_profile  = 1 ; } else {$allow_email_profile  = 0; }
		if(!empty($_POST['allow_gender']) && $_POST['allow_gender'] == 'on') { $allow_gender  = 1 ; } else {$allow_gender  = 0; }
		if(!empty($_POST['allow_age']) && $_POST['allow_age'] == 'on') { $allow_age  = 1 ; } else {$allow_age  = 0; }
				
	
		$update_data = array(
		'first_name' 		=> $_POST['first_name'],
		'last_name' 		=> $_POST['last_name'],
		'email' 			=> $_POST['email'],
		'gender'			=> $_POST['gender'],
		'age'				=> $_POST['age'],
		'allow_email'		=> $allow_email
		);
		
		
		$update_settings = array(
		
						
		'allow_first_name' => $allow_first_name, 
		'allow_last_name'  => $allow_last_name ,
		'allow_email_profile' => $allow_email_profile,
		'allow_gender' => $allow_gender,
		'allow_age' => $allow_age
		
		
		);
		
		
		update_settings($_SESSION['user_id'],$update_settings);
		update_user($_SESSION['user_id'],$update_data);
		header('Location: settings.php?success');
		exit();

	} else if(empty($errors) === false) {
		echo output_errors($errors);
	}

	?>
<div id="mobile_settings">


	<div class="inner">
	<div class="profile">
		<?php
		
		
		$grub_ids = find_grub_ids();
		$images =  find_public_images( $grub_ids );
		

		
		if(isset($_FILES['profile']) === true){
				
			if(empty($_FILES['profile']['name'])===true){
			 	echo 'Please choose a file';
			
			} else{
				$allowed = array('jpg','jpeg','gif','png');
				
				$file_name = $_FILES['profile']['name'];
				$file_ext = strtolower(end(explode('.',$file_name)));
				$file_temp = $_FILES['profile']['tmp_name'];
				
				if(in_array($file_ext, $allowed) === true){
					
					change_profile_image($session_user_id, $file_temp, $file_ext);
					make_profile_thumbs();
					header('Location: ' .$current_file);
					exit();
				} else{
				
					echo 'Incorrect file type. Allowed: ';
					echo implode(', ', $allowed);
				}
				
				
				// need to limit file size
				
				
			}
						
		}
		
			if(empty($user_data['profile']) === false){
			 echo '<img src="', $user_data['profile'],'" alt="',$user_data['first_name'],'\'s Profile">';
			
			}
		 ?>
			 <form action="" method="post" enctype="multipart/form-data">
			 <input type="file" name="profile"> <input type="submit">
			 </form>
	</div>
		<ul>
			<li>	<a href="logout.php">Logout</a> </li>
			<li>	<a href="<?php echo $user_data['username']; ?>" > Your Profile</a>  </li>
			<li>	<a href="changepassword.php">Change Password</a>  </li> 
			<li>	<a href="settings.php">Settings</a>   </li>
		</ul>	
	
	</div>	 
	

	


</div>


		<form action="" method="post"> 
				<ul > 
			<table id="comment_table_settings">
			  <tr class="settings-header"'>
			  	<td class="settings-label" > Setting </td>
            	<td>Data</td>
            	<td >Show on Profile?</td>            	
        	</tr>
        	  <tr>
            	<td class="settings-label" >First Name<sup>*</sup>:</td>
            	<td class="settings-input" ><input type="text" name="first_name" size="25" value="<?php echo $user_data['first_name']; ?>">  </td>         	
            	<td >
            	
            	     <input class="checkbox1" type="checkbox" name="allow_first_name" <?php if($user_settings['allow_first_name'] == '1' ) {  echo 'checked="checked"' ; } ?> ><label for="allow_first_name"><span></span></label>

            	</td>            	
        	</tr>
        	 <tr>
            	<td class="settings-label" >Last Name:</td>
            	<td class="settings-input"><input type="text" name="last_name" size="25" value="<?php echo $user_data['last_name']; ?>">  </td>         	
            	<td>
            	
            	
     <input class="checkbox1" type="checkbox" name="allow_last_name" <?php if($user_settings['allow_last_name'] == '1' ) {  echo 'checked="checked"' ; } ?> ><label for="allow_last_name"><span></span></label>

            	
            	
            	</td>            	
        	</tr>
        	<tr>
            	<td class="settings-label" >Email<sup>*</sup>:</td>
            	<td class="settings-input"><input type="text" name="email" size="25" value="<?php echo $user_data['email']; ?>">   </td>         	
            	<td>
            	
   <input class="checkbox1" type="checkbox" name="allow_email_profile" <?php if($user_settings['allow_email_profile'] == '1' ) {  echo 'checked="checked"' ; } ?> ><label for="allow_email_profile"><span></span></label>
            	
            	
            	</td>            	
        	</tr>
        	<tr>
            	<td class="settings-label" >Gender</td>
            	<td class="settings-input">
            	
            	<select width="60" style="width: 100px" name="gender">
								<option><?php if(!empty($user_data['gender']))  {echo $temp_gender = $user_data['gender'] ;} else{ echo $temp_gender = 'Male';} ?></option>
								
								<?php  
								
								if($temp_gender =='Male') {
								
								echo '<option>Female</option>';
								} else{
								
								echo '<option>Male</option>';
								}
								
								?>
							
								
							</select>
            	
            	 </td>         	
            	<td>
   <input class="checkbox1" type="checkbox" name="allow_gender" <?php if($user_settings['allow_gender'] == '1' ) {  echo 'checked="checked"' ; } ?> ><label for="allow_gender"><span></span></label>


            	</td>            	
        	</tr>
        	
        	<tr>
            	<td class="settings-label" >Age: </td>
            	<td class="settings-input">
            	
            	<select width="60" style="width: 60px" name="age">
								<option><?php echo $user_data['age']; ?></option>
								<?php
								for($i=1; $i<101; $i++){
								if($i != $user_data['age'] ) {
								echo '<option>'.$i.'</option>' ;
								}
							}			?>
				</select>
            	
            	            	
            	   </td>         	
            	<td>
            	

       					 <input class="checkbox1" type="checkbox" name="allow_age" <?php if($user_settings['allow_age'] == '1' ) {  echo 'checked="checked"' ; } ?> ><label for="allow_age"><span></span></label>
      				
            	
            </td>            	

        	</tr>
        	
        	
        	

        	
			
			

				<tr>
				<td class="settings-label" colspan="2">  Would you like to receive email from us? </td>
				
				<td >  <input class="checkbox1" type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == '1' ) {  echo 'checked="checked"' ; } ?> ><label for="allow_email"><span></span></label> </td>

				</tr>
       			</table>	
					
				
					
					<li> 
						<input type="Submit" value="Submit Changes">  
					</li>
				</ul>
			</form>
  

        	  <section title=".squaredFour">
    <!-- .squaredFour -->
   
    <!-- end .squaredFour -->




	<?php
}



include 'includes/overall/overallfooter.php'; 
?> 

