<?php


include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;





	

		if(isset($_GET['grub_id'],$_GET['report'])){
	
			$image_id = (int)$_GET['grub_id'];
			$report = (int) $_GET['report'] ;
			$image = image_name_from_id($image_id); 
			$user_id = $user_data['user_id'];
		?>			



		<div class="comment_container">
		<form action="" method="post" name="reportform"> 
				<input id="report-input" type="radio" name="report-type" value="not_food">  Not Food<br>
				<input id="report-input" type="radio" name="report-type" value="spam" >Spam<br>
				<input id="report-input" type="radio" name="report-type" value="nudity">Nudity<br>
				<input id="report-input" type="radio" name="report-type" value="child"  >Child Exploitation<br>
				<input id="report-input" type="radio" name="report-type" value="theft" >Identity theft or stolen personal information<br>
				<input id="report-input" type="radio" name="report-type" value="copyright"  >Copyright Infringement<br>
				<input type="submit" value="Report" name="report-submit">
				</form> 
				</div>
		<?php	
	
		  } else{ 

			  header('Location:error.php');
			exit();
		}



  if (isset($_POST['report-submit'])) {
    
      if (!empty($_POST['report-type'])) 
      { 
      
      $selected = sanitize($_POST['report-type']);
      	header('Location: reportsuccessful.php?image='.$image_id.'&reason='.$selected);
      	
      	}
 		else { 
 		echo "Your answer will not be graded.";
 		 }
  } else
   { echo "Please submit the form.";
    }
  
  




?>


<?php include 'includes/overall/overallfooter.php'; ?> 