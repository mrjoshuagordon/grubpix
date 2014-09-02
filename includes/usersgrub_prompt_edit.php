 	 <a href = " <?php echo 'grubedit.php?image='.$image ;?> " > Edit Details </a> 
 
  <table class="image_detail_table_settings ">

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
	  <td class="image-detail-title">Upload Date</td>
	  <td class="image-detail-data"><?php echo $image_data['time'] ; ?></td>
	</tr>
  </table>




<?php

include 'includes/grubcomment.php' ; 

?>


