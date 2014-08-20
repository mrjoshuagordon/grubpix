<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;
require 'Gallery.php';
$gallery = new Gallery();
$gallery->setPath('./uploads/'); 


$grub_ids = find_grub_ids();

$public_images = find_public_images($grub_ids ) ; 
$images = $gallery->getAllImages(array('jpg','png','jpeg','gif'), $public_images);


?> 


<h1> Grub Gallery </h1>
<p> Public Grubs from All Users  </p>




<div class="container_gallery">
			<?php if($images): ?>
			<div class="gallery cf">
				<?php  foreach($images as $image):  ?>
				<div class="gallery-item">
					<a href="<?php echo  'grubinfo.php?image='.end(explode('/',$image['full'])); ?> " ><img src="<?php echo $image['thumb'];  ?>"> </a> 
				</div>
				<?php endforeach;  ?>
			</div>
			<?php else: ?>
				There are no images
			<?php endif; ?>
		</div>


<?php include 'includes/overall/overallfooter.php'; ?> 

