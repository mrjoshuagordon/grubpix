<?php 
include 'core/init.php';
include 'includes/overall/overallheader.php' ;

if(isset($_GET['username']) === true && empty($_GET['username']) === false) {
	$username = $_GET['username'];
	
	if(user_exists($username) === true) {
	$user_id  = user_id_from_username($username);
	$profile_data = user_data($user_id, 'username', 'first_name', 'last_name', 'email','profile', 'gender', 'age');
	$profile_settings = user_settings($user_id, 'allow_first_name', 'allow_last_name', 'allow_email_profile', 'allow_gender', 'allow_age');
	//print_r($profile_data);
	?>
		
	
		<h1> <?php echo $profile_data['username']; ?>'s Profile </h1>
			
		<!-- <p>	Email: <?php echo $profile_data['email']; ?>  </p> -->
		
	
		
		
	
	<div class="profile_page">

<?php 
			if(empty($profile_data['profile']) === false){
			 echo '<img class="settings-profile-img" src="', $profile_data['profile'],'" alt="',$profile_data['first_name'],'\'s Profile">';
			
			} else{
			
			
			echo '<img class="settings-profile-img" src=images/profile/no_profile.jpg>';
			
			
			}

?>


	
		<?php
		
	if($profile_settings['allow_first_name'] == '1') { echo '<p> First Name: '. $profile_data['first_name'] .'</p>'; }	  
	if($profile_settings['allow_last_name'] == '1') { echo '<p> Last Name: '. $profile_data['last_name'].'</p>'; }	
	if($profile_settings['allow_email_profile'] == '1') { echo '<p> Email: '. $profile_data['email'] .'</p>'; }	
	if($profile_settings['allow_gender'] == '1') { echo '<p> Gender: '. $profile_data['gender'] .'</p>'; }	
	if($profile_settings['allow_age'] == '1') { echo '<p> Age:'. $profile_data['age'] .'</p>' ; }		
		
		
		
		?>
		


 <?php if($profile_data['email'] == $user_data['email']) { ?><br><br>	<a href="./settings.php"> Edit Profile</a> <?php ; } ?>
	</div>
	
	
	<!-- Users Grubs -->
	<?php  
	
	$images = find_grub_ids_by_user_id ($user_id );
	//print_r($images);
	  ?>

		<?php echo $profile_data['username'].'\'s' ; ?> Grubs:
	<div class="wrap">
    <table class="head">
        <tr>
            <td>Grub</td>
            <td>Title</td>
            <td>Description</td>
        </tr>
    </table>
    <div class="inner_table_profile">
        <table> <?php 
							for($i = 0; $i < max(count($images),0); $i++){
						
						 $image = $images[$i]; 
						$grub_id = image_id_from_imagename($image); 
						$temp = image_data( $grub_id );	
						
						echo '<tr href="grubinfo.php?image='.$image.'"> <td> <a href="grubinfo.php?image='.$image.'"><img id="grub-rec-widget" src="uploads/thumbs/'.$image.'"></img></a></td> <td> '. $temp['title'].'</td> <td>'. substr($temp['description'],0,30).'...'.'</td> </tr>';
						}
					?>
    </table>
    </div>
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

