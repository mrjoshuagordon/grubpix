<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;
require 'Gallery.php';
$gallery = new Gallery();
$gallery->setPath('./uploads/'); 


$user_image = find_user_images  ($session_user_id) ;
//print_r($user_image);
$images = $gallery->getImages(array('jpg','png','jpeg','gif'), $user_images); 
//print_r($images);


$public_grubs = find_grub_ids_by_user_id ($session_user_id );
//print_r($public_grubs);

?> 




<h1> Your Grubs </h1>
<table id="table-legend">
<tr id="tr-public"> <td id="td-public"> Public </td> </tr>
<tr id="tr-private"> <td id="td-private"> Private </td> </tr>
</table>

<div id="container_gallery">
			<?php if($images): ?>
			<div class="gallery cf">
				<?php  //foreach($images as $image):  //make red or green if public or not
				foreach($user_image as $image):
				
				if(!in_array($image,$public_grubs)) {
				
				 ?>
				<div class="gallery-item-public">
				<!--	<a href="<?php echo  'grubinfo.php?image='.end(explode('/',$image['full'])); ?> " ><img src="<?php echo $image['thumb'];  ?>"> </a> -->
						<a href="<?php echo  'grubinfo.php?image='.$image; ?> " ><img src="<?php echo './uploads/thumbs/'.$image;  ?>"> </a> 
				</div>
				<?php
				} else{
				?>
				
				<div class="gallery-item-not-public">
				
						<a href="<?php echo  'grubinfo.php?image='.$image; ?> " ><img src="<?php echo './uploads/thumbs/'.$image;  ?>"> </a> 
				</div>
								
				<?php
				}
				?>
				<?php endforeach;  ?>
			</div>
			<?php else: ?>
				There are no images
			<?php endif; ?>
		</div>

<?php include 'includes/overall/overallfooter.php'; ?> 

