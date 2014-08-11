<?php 
include 'core/init.php';
include 'includes/overall/overallheader.php' ;
?> 


<h1> Home </h1>
<p> This is our home </p>
<?php

if( logged_in() === true ) { 


if(has_access($session_user_id,1) === true) {

echo 'Admin';
} else if(has_access($session_user_id,2) === true) {

echo 'Moderator';

} else{

echo 'Welcome to GrubNums, '. $user_data['first_name'].'.';
}

}

?>


<?php include 'includes/overall/overallfooter.php'; ?> 

