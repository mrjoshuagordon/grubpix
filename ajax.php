<?php

include 'core/init.php';

	$load = htmlentities(strip_tags($_POST['load']));

		$query = mysql_query("SELECT * FROM `grubs` LIMIT ".$load.",1"); 
	
		
		
	while(($row = mysql_fetch_assoc($query)) !== false){


?>

	<p> <a href="<?php echo 'grubinfo.php?image='.$row['image']; ?>" ><img src="<?php echo 'uploads/thumbs/'. $row['image']; ?>" height="500"> </a> </p>

	<?php
}	
		

?>