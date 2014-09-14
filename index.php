<?php 
include 'core/init.php';
include 'includes/overall/overallheader.php' ;
?> 




<?php

if( logged_in() === false ) { 
echo '<h2> Welcome to Grubnums  </h2>';
echo 'Please Login or Register';
?>


    <div id="mobile-login"> 
 		<h2> Log in/Register  </h2>

		<form action="login.php" method="post">
		<ul>
			<li> 
				Username: <br>
					<input type="text" name="username">
			</li> 
			<li> 
				Password: <br>
					<input type="password" name="password">
			</li>
			<li>
			<input type="submit" value="login">
			 </li>
			<li> 
			<a href="register.php"> Register </a>
			</li>
			<li> 
			Forgotten your  <a href="recover.php?mode=username"> username </a> or  <a href="recover.php?mode=password"> password </a> ? 
			</li>
		</ul>
		</form>
		Login Form 

    
    </div> 


<?php

} else{

echo '<h2> Welcome to GrubNums, '. $user_data['username'].'</h2>';

		$grub_ids = find_grub_ids();
		$images =  find_public_images( $grub_ids );
		$comments = find_comments();


?>

<div id="home_rec_grubs"> 
		Recent Grubs:
	<div class="home_recent_grubs">
    <table class="head">
        <tr>
            <td>Grub</td>
            <td>Title</td>
            <td>Description</td>
        </tr>
    </table>
    <div class="inner_home_recent_grubs">
        <table> <?php 
			for($i = 0; $i < 3; $i++){
		
		 $image = $images[$i]; 
		$grub_id = image_id_from_imagename($image); 
		$temp = image_data( $grub_id );	
		
		echo '<tr href="grubinfo.php?image='.$image.'"> <td> <a href="grubinfo.php?image='.$image.'"><img id="grub-rec-widget" src="uploads/thumbs/'.$image.'"></img></a></td> <td> '. $temp['title'].'</td> <td>'. substr($temp['description'],0,30).'...'.'</td> </tr>';
		}
					?>
    </table>
    </div>
	</div> 
	
	</div>
	

<br / >

<div id="home_rec_comments">
	Recent Comments:
	<div class="home_recent_comment">
    <table class="head">
        <tr>
            <td>Grub</td>
            <td>User</td>
            <td>Comment</td>
        </tr>
    </table>
    <div class="inner_home_recent_comments">
        <table> <?php 
			for($i = 0; $i < 3; $i++){
		
		 $comment = $comments[$i]; 
		$image = image_name_from_id($comment['grub_id']) ;
		
		 $comment_user_id  = user_id_from_username($comment['username']);
		$temp = find_profile($comment_user_id);	
		$profile = 'images/profile/thumbs/'.end(explode('/',$temp['profile']));
		
		
		
		echo '<tr href="grubinfo.php?image='.$image.'"> <td> <a href="grubinfo.php?image='.$image.'"><img id="grub-rec-widget" src="uploads/thumbs/'.$image.'"></img></a></td> <td> <a href="./'.$comments[$i]['username'].'"><img id="grub-rec-widget"  src="'.$profile.'">'. ' '.   $comment['username'].'</a></td> <td>'. substr($comment['comment'],0,20).'...'.'</td> </tr>';
		}
					?>
    </table>
    </div>
	</div> 


</div>








<?php










}



?>


<?php include 'includes/overall/overallfooter.php'; ?> 

