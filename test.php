<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;
?> 


<?php

//mysql_query("INSERT INTO `grubs` (`user_id`, `image`, `name`) VALUES ($session_user_id  , 'hello' , 'world' )");	 


print_r( find_user_images($session_user_id) );

?>



<?php include 'includes/overall/overallfooter.php'; ?> 

