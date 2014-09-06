<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;
$out = get_locations();

//echo $out;

if(isset($_GET['image']) && !empty($_GET['image'])){

	$image = $_GET['image'];
	$link  ='./uploads/'.$image;
	
	
	$image_id = image_id_from_imagename($image);
	$image_data = image_data($image_id);
	$image = $_GET['image'];
	
	

}



if(empty($_POST['Publish']) === false) {



			if(empty($_POST['title']) === true) {
				$errors[] = 'Title is Required';
		
			}			
		

		
			if(empty($_POST['location']) === true)  {
				$errors[] = 'Location is required';
		
			}
			
			
					
			if(empty($errors) === false ) {
			echo '<div class="comment_container"> <h2> Please fix the following:</h2>';
				echo output_errors($errors);		
			echo '</div>'	;
			}  else{
			
			$image_id = image_id_from_imagename($image);			
			
			if( isset($_POST['public_check']) && $_POST['public_check'] == 'on'){
			$allow_public = 1;
						
			} else{
			
			$allow_public = 0 ;
			} 		
			
				
			
			if($allow_public === 1 ) {
				add_image($image_id, $_POST['title'], $_POST['location'], $_POST['description'], $_POST['price'] );
				publish_image($image_id);
				header('Location: grubinfo.php?image='.$image); 
				
			} else{
				add_image($image_id, $_POST['title'], $_POST['location'], $_POST['description'],  $_POST['price'] );
				header('Location: grubinfo.php?image='.$image); 
				
			
			}
			
							
				
			}
		
		

	
	
	
			
		}



?>




<?php


	echo ' <div class="grub_info">  <a href='.$link.'> <img id="grub-main-edit" src='.$link.'> </a> </div> <br>'; 


?> 



<a href="./grubinfo.php?image=<?php echo $image?>"> Public View </a> 
<h4> Please fill out the image details, fields marked with an * are required: </h4>

<div class="comment_container"> 	
	<form action="" method="post" name="image_detail_form" id="image_detail_form"> 
		<ul > 
			<label>
				<li> Image Title*:<br>
					<input type="text" name="title" size=35 value="<?php echo $image_data['title']; ?>">  
				</li>
			</label>
			
			
					   
			<div width="200px"  >   Location (e.g. Homemade, Chipotle, etc.)*:  <br>
 			<input id="location" type="text" name="location" value="<?php echo $image_data['location']; ?>" autocomplete="off"/> <span  style="background-color: #eceff0;" id="hold"> </span> <br>	
				</div>
				
				<div width="200px"  >   Price ($):  <br>
 			<input id="price" type="text" name="price" value="<?php echo $image_data['price']; ?>" /> <br>	
				</div>	
				
				
				<?php  //add in dynamic drop down?>
				<li> Description:<br>				
				<textarea type="text" name="description" class="comment_container_textarea" ><?php echo $image_data['description']; ?></textarea> 
				</li>
								
				<li> 
					<input type="checkbox" name="public_check" <?php if($image_data['active'] == 1 ) {  echo 'checked="checked"' ; } ?>">  Make this image public? 
				</li>
				
				<li> 
					<input type="Submit" value="Publish" name="Publish">  
				</li>
			
		</ul>
	</form> 
</div>

<br/>


<?php  include 'includes/usersgrub.php' ;
?> 

   <script type="text/javascript">
        $(document).ready(function(){
         //   var data = ["Boston Celtics", "Chicago Bulls", "Miami Heat", "Orlando Magic", "Atlanta Hawks", "Philadelphia Sixers", "New York Knicks", "Indiana Pacers", "Charlotte Bobcats", "Milwaukee Bucks", "Detroit Pistons", "New Jersey Nets", "Toronto Raptors", "Washington Wizards", "Cleveland Cavaliers"];
			  var data = [  <?php echo $out ?>];
		   $("#location").autocomplete({

		   source:data,
		appendTo: "#hold"
		

		   
		   });
        });
    </script>

<?php include 'includes/overall/overallfooter.php'; ?> 

 
