<div class="widget"> 

<h2> Hello <?php echo $user_data['first_name'] ;?> ! </h2>
	<div class="inner">
	<div class="profile">
		<?php
		
		
		$grub_ids = find_grub_ids();
		$images =  find_public_images( $grub_ids );
		
	//	print_r($images[0]);
	//	die();
		
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
	

	
	Recently Added Grubs:
	
	<div class="wrap_rec">
    <table class="head">
        <tr>
            <td>Grub</td>
            <td>Title</td>
            <td>Description</td>
        </tr>
    </table>
    <div class="inner_table_rec">
        <table> <?php 
							for($i = 0; $i < 5; $i++){
						
						 $image = $images[$i]; 
						$grub_id = image_id_from_imagename($image); 
						$temp = image_data( $grub_id );	
						
						echo '<tr> <td> <a href="grubinfo.php?image='.$image.'"><img src="uploads/thumbs/'.$image.'"></img></a></td> <td>'. $temp['title'].'</td> <td>'. substr($temp['description'],0,30).'...'.'</td> </tr>';
						}
					?>
    </table>
    </div>
	</div> 
	
	
	

	
</div>
 