<?php 
include 'core/init.php';
protect_page();
admin_protect();
include 'includes/overall/overallheader.php' ;
?> 


<h1> Email all users </h1>


<?php 

if(isset($_GET['success']) && empty($_GET['success'])){

 echo 'You\'re message has been sent!';
 
} else{



		if(empty($_POST) === false) {
			if(empty($_POST['subject']) === true) {
				$errors[] = 'Subject is required';
		
			}			
		

		
			if(empty($_POST['body']) === true)  {
				$errors[] = 'body is required';
		
			}
		
			if(empty($errors) === false ) {
				echo output_errors($errors);		
			}	else{
				mail_users($_POST['subject'], $_POST['body']);
				header('Location: mail.php?success');
				exit();	
			}
		
	
		}



?> 

<div class="comment_container">

	<form action="" method="post"> 
			<ul > 
			
				<li> Email Subject*<br>
					<input type="text" name="subject">  
				</li>
				<li> Body*:<br>
					<textarea type="text" name="body"></textarea>
				</li>
				<li> 
					<input type="Submit" value="Send">  
				</li>
			</ul>
		</form> 

</div>


<?php 

	}
	
include 'includes/overall/overallfooter.php'; ?> 

