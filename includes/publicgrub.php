<div class="grub_detail">
	<a href="report.php?grub_id=<?php echo $image_id; ?>&report=1"> Report Abuse</a>
 <?php 

$user_id_temp  = user_id_from_image_id($image_data['grub_id']);
 $user_name_temp = user_name_from_id($user_id);
 $temp = find_profile($user_id_temp);	 

if(!empty($temp['profile']))
 {

 $profile = 'images/profile/thumbs/'.end(explode('/',$temp['profile']));

} else{

 $profile = 'images/profile/thumbs/no_profile.jpg';

} 

 ?>
	
<!-- <table>
	<tr>
	  <td >Uploaded By:</td>
	  <td >
	   <?php echo  '<a href="./'.$user_name_temp.'"><img width="50px"  src="'.$profile.'">'. ' '. $user_name_temp.'</a>' ?>
	  
	  
	   </td>
	</tr>
  <tr>
    <td>Image Title</td>
    <td><?php echo $image_data['title']; ?>  </td>
  </tr>
 <tr>
    <td>Location</td>
    <td><?php echo $image_data['location']; ?> </td>
  </tr>
  <tr>
    <td>Price</td>
    <td><?php if(  $image_data['price'] != 0 )  {   echo '$'.$image_data['price'];  } else { echo '-' ;   }   ?></td>
  </tr>
  <tr>
    <td>Description</td>
    <td><?php echo $image_data['description']; ?></td>
  </tr>
  <tr>
	  <td>Upload Date</td>
	  <td><?php echo  $image_data['time']  ; ?></td>
	</tr>
</table> -->
  
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

	
	


</div>


<?php

include 'includes/grubcomment.php' ; 

?>