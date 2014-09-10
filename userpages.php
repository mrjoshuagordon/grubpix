<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;
require 'ProfileGallery.php';
$gallery = new ProfileGallery();
$gallery->setPath('./images/profile/'); 
$limits = [10,25,50,100,500,1000]; 

?>


<script>
function change(){
    document.getElementById("num-users-form").submit();
  }
</script>


<?php
if(isset($_POST['users-id'])) {
	$limit = (int) $_POST['users-id'];
	unset($limits[array_search($limit,$limits)]); 
	array_unshift($limits, $limit);

	} else{
	
	$limit = 10;	
	
} 



$user_profiles = get_active_users($limit); 


$pics = array();
$names = array();


foreach($user_profiles as $p){
		$pics[] = $p[0];
		$names[] = $p[1];

}

//print_r($pics);




$images = $gallery->getImages(array('jpg','png','jpeg','gif'), $pics); 

?> 


<h1> User Pages </h1>
<p> GrubNums has <?php echo get_total_active_users();  ?> active Users </p>


<form id="num-users-form" method="post">
Users Shown:  <select name = 'users-id' onchange="change()" width="80" style="width: 80px" >
	

		<?php
		for($i=0; $i<count($limits); $i++){
			echo '<option>'.$limits[$i].'</option>' ;
			}			
		?>

	
</select>



</form> 

<div class="container_gallery">
			<?php if($images): ?>
			<div class="gallery cf">
			<?php $n = 0; ?>
				<?php  foreach($images as $image):  ?>
				
				<div class="gallery-item">
					<a href="<?php  echo $names[$n]  ?> " ><img src="<?php echo $image['thumb'];  ?>"> </a> 
				</div>
					
					<?php  $n = $n + 1;	?>
				
			
				
				
			

				
				<?php endforeach;  ?>
				
			
				
			</div>
			<?php else: ?>
				There are no images
			<?php endif; ?>
		</div>



<?php






?>


















<?php include 'includes/overall/overallfooter.php'; ?> 

