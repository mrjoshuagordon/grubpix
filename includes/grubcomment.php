<br >
<div class="comment_container">

<h4> Enter a comment: </h4>


<?php


$user_id = $user_data['user_id'];
$username = $user_data['username'];
$image_id = image_id_from_imagename($image); 



if(empty($_POST) === false) { 
 

$comment = $_POST['comment'];	
	
if(empty($comment) === true) {
	$comment_errors[] = 'Please enter a comment';
	
}	


if(strlen($comment) > 255) {
	
	$comment_errors[] = 'Comment must be less than 255 characters';


} 

	if(empty($comment_errors) === false ) {
			echo '<h2> Please fix the following:</h2>';
				echo output_errors($comment_errors);
				
		} else {
	

	post_comment($image_id, $user_id, $username, $comment);
	

	}



}

	
?>




<form action="" method="POST"> 


<textarea name="comment"></textarea>  <br>




<input type="Submit" value="Comment" name="comment_submit">  
	

			
</form> 



</div>						

<div class="comment_container">
<h4> User Comments: </h4>


<?php //get user comment

$comments = find_image_comments($image_id);
//print_r($comments[0]);

?>

	


<div class="comment_output">

<table class="comment_table">
<?php

foreach($comments as $comment){
	echo '<tr> <td>'.  $comment[0].'</td> <td>'. $comment[1] . '</td> </tr>';
}




?>
</table> 

</div>

</div>

