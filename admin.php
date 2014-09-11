<?php 
include 'core/init.php';
protect_page();
admin_protect();
include 'includes/overall/overallheader.php' ;
?> 


<h1> Admin </h1>
<p> Admin Home </p>

<?php

$reports = get_reported_images();
//print_r($reports);

?>

<div id="comment_output_admin">

<table id="comment_table_admin">

<?php
echo   ' <tr> <td> Image </td> <td> Reporting User </td> <td> Reason </td><td> Count </td> <td> Remove </td></tr>'; 

for($i=0; $i<count($reports) ; $i++){
	$report = $reports[$i];
	
	$grub_name = image_name_from_id($report['grub_id']);
	$username = user_name_from_id($report['user_id']);

	echo '<tr> <td> <img src="uploads/thumbs/'.$grub_name.'">'.'</td> <td>'. $username  . '</td> <td>'.$report['reason'] . '</td> <td>'.$report['count'] . '</td>  <td> Remove </td> </tr>';
}


?>


</table> 

</div>
















<?php include 'includes/overall/overallfooter.php'; ?> 

