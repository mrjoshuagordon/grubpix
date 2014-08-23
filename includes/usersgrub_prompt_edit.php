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
	  <td>Description</td>
	  <td><?php echo$image_data['description']; ?></td>
	</tr>
  </table>


	 <a href = " <?php echo 'grubedit.php?image='.$image ;?> " > Edit </a> 

<?php

include 'includes/grubcomment.php' ; 

?>


