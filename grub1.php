<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;
require 'Gallery.php';
$gallery = new Gallery();
$gallery->setPath('./uploads/'); 


$user_image = find_user_images  ($session_user_id) ;

$images = $gallery->getImages(array('jpg','png','jpeg','gif'), $user_images); 



?> 




<h1> Grub Gallery </h1>
<p> This is our forum page </p>

<div class="container_gallery">
			<?php if($images): ?>
			<div class="gallery cf">
				<?php  foreach($images as $image):  ?>
				<div class="gallery-item">
					<a href="<?php echo  $image['full']; ?> " ><img src="<?php echo $image['thumb'];  ?>"> </a> 
				</div>
				<?php endforeach;  ?>
			</div>
			<?php else: ?>
				There are no images
			<?php endif; ?>
		</div>

<?php include 'includes/overall/overallfooter.php'; ?> 

