<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;
require 'ProfileGallery.php';
$gallery = new ProfileGallery();
$gallery->setPath('./images/profile/'); 


$user_profiles = get_active_users();


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
<p> These are Grub Nums active Users </p>


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

