<?php 
include 'core/init.php';
include 'includes/overall/overallheader.php' ;

if(isset($_GET['username']) === true && empty($_GET['username']) === false) {
	$username = $_GET['username'];
	
	if(user_exists($username) === true) {
	$user_id  = user_id_from_username($username);
	$profile_data = user_data($user_id, 'first_name', 'last_name', 'email','profile');
	?>
		
	
		<h1> <?php echo $profile_data['first_name']; ?>'s Profile </h1>
			
		<p>	Email: <?php echo $profile_data['email']; ?>  </p>
	
	<div class="profile_page">

<?php 
			if(empty($profile_data['profile']) === false){
			 echo '<img src="', $profile_data['profile'],'" alt="',$profile_data['first_name'],'\'s Profile">';
			
			} else{
			
			
			echo '<img src=images/profile/no_profile.jpg>';
			
			
			}

?>
<br><br>	<a href="./settings.php"> Edit Profile</a>
	</div>
	
	
	<?php
	
	} else{
		echo 'Sorry that user does not exist';	
	
	}
	

} else{
	header('Location: index.php');
	exit();

}




include 'includes/overall/overallfooter.php'; ?> 

