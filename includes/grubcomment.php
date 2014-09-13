<br >

<?php include 'includes/grub_recipe.php'; ?>

<?php  include 'includes/grub_rate.php' ;  ?>

<?php  include 'includes/grub_guess.php' ;  ?>



<div class="comment_table-grubinfo">

<h4> Enter a comment: </h4>


<?php




$user_id = $user_data['user_id'];
$username = $user_data['username'];
$image_id = image_id_from_imagename($image); 



if(!empty($_POST['comment_submit']) ) { 
 

$comment = $_POST['comment'];	
	
if(empty($comment) === true) {
	$comment_errors[] = 'Please enter a comment';
	
}	


if(strlen($comment) > 255) {
	
	$comment_errors[] = 'Comment must be less than 255 characters';


} 

	if(empty($comment_errors) === false ) {
			echo '<h2 class="h2-alert"> Please fix the following:</h2>';
				echo output_errors($comment_errors);
				
		} else {
	

	post_comment($image_id, $user_id, $username, $comment);
	
	

	}



}

	
?>










<form action="" method="POST"> 




<textarea class="textarea-style" name="comment"></textarea>  <br>

<input class="comment-submit" type="Submit" value="Comment" name="comment_submit">  
	

			
</form> 



</div>						

<div class="table_container">
<h4> User Comments: </h4>


<?php //get user comment


$comments = find_image_comments($image_id);
//print_r($comments[0]);
//print_r($comments[0]['username']);

?>

	


<div class="comment_output">

<table class="comment_table">
<tr> <td class="comment-header"> User </td> <td class="comment-header" > Comment </td> </tr>

<?php

for($i = 0; $i < count($comments) ; $i ++ ) {
	 $comment_user_id  = user_id_from_username($comments[$i]['username']);
	$temp = find_profile($comment_user_id);
	
	if(!empty($temp['profile'])) {
		$profile = 'images/profile/thumbs/'.end(explode('/',$temp['profile']));
			} else{
	$profile = 'images/profile/thumbs/no_profile.jpg';
	} 

	
	echo '<tr> <td class="comment-user"> <a href="./'.$comments[$i]['username'].'"><img id="comment-profile" src="'.$profile.'">'.  $comments[$i]['username'].'</a></td> <td class="comment-text">'. $comments[$i]['comment'] . '</td> </tr>';
}




?>
</table> 

</div>

</div>

