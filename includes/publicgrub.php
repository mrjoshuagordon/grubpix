<div class="grub_detail">
	<a href="report.php?grub_id=<?php echo $image_id; ?>&report=1"> Report Abuse</a>

	
<table>

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
</table>
 
	
	


</div>


<?php

include 'includes/grubcomment.php' ; 

?>