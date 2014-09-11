 	 <a href = " <?php echo 'grubedit.php?image='.$image ;?> " > Edit Details </a> 
 <?php 







if(strlen($image_data['grub_id'])> 0) {
$user_id_temp  = user_id_from_image_id($image_data['grub_id']);
 $user_name_temp = user_name_from_id($user_id);
 $temp = find_profile($user_id_temp);	 
 

 
//echo empty($temp['profile']);
//in the upload by user, if they do not have a profile pic, add one.

if(!empty($temp['profile']))
 {

 $profile = 'images/profile/thumbs/'.end(explode('/',$temp['profile']));

} else{

 $profile = 'images/profile/thumbs/no_profile.jpg';

} 
 
 
 //usersgrub prompt edit file
 ?>
 
 
 <div class="comment_container-grubinfo">
  <table id="image_detail_table_settings-grubinfo">
	<tr>
	  <td class="image-detail-title">Published By</td>
	  <td class="image-detail-data">
	   <?php echo  '<a href="./'.$user_name_temp.'"><img width="50px"  src="'.$profile.'">'. ' '. $user_name_temp.'</a>' ?>
	  
	  
	   </td>
	</tr>
	<tr>
	  <td class="image-detail-title">Image Title</td>
	  <td class="image-detail-data"><?php echo $image_data['title']; ?>  </td>
	</tr>
   <tr>
	  <td class="image-detail-title">Location</td>
	  <td class="image-detail-data"><?php echo $image_data['location']; ?> </td>
	</tr>
	  <tr >
       <td class="image-detail-title">Price</td>
       <td class="image-detail-data"><?php if(  $image_data['price'] != 0 )  {   echo '$'.$image_data['price'];  } else { echo '-' ;   }   ?></td>
 	 </tr>
	<tr>
	  <td class="image-detail-title">Description</td>
	  <td class="image-detail-data"><?php echo$image_data['description']; ?></td>
	</tr>
	<tr>
	  <td class="image-detail-title">Modified Date</td>
	  <td class="image-detail-data"><?php echo $image_data['time'] ; ?></td>
	</tr>
  </table>

</div>


<?php
 } else{
 ?>
  <div class="comment_container-grubinfo">
  <table id="image_detail_table_settings-grubinfo">
	<tr>
	  <td class="image-detail-title">Published By</td>
	  <td class="image-detail-data">
	  
	  
	  
	   </td>
	</tr>
	<tr>
	  <td class="image-detail-title">Image Title</td>
	  <td class="image-detail-data"> </td>
	</tr>
   <tr>
	  <td class="image-detail-title">Location</td>
	  <td class="image-detail-data"> </td>
	</tr>
	  <tr >
       <td class="image-detail-title">Price</td>
       <td class="image-detail-data"></td>
 	 </tr>
	<tr>
	  <td class="image-detail-title">Description</td>
	  <td class="image-detail-data"></td>
	</tr>
	<tr>
	  <td class="image-detail-title">Modified Date</td>
	  <td class="image-detail-data"></td>
	</tr>
  </table>

</div>

 
 
 
 <?php
 
 }
include 'includes/grubcomment.php' ; 

?>


