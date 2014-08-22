<?php

include 'core/init.php';


$article = null;

if(isset($_GET['id'])){
	 $id = (int) $_GET['id'];
	  
	 
}


$query = mysql_query("SELECT * from `grubs` WHERE `grub_id` = '$image_id'");


$result = array(); 


while(($row = mysql_fetch_assoc($query)) !== false){


	$result[] = $row['grub_id'];

} 




?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Article </title>
	
	<head>
	<body>
	<?php  if($article):  ?>
		<div class="article"> 
		This is article "<?php echo $article->title; ?>"
			<div class=""> Rating: <?php echo round($article->rating,2)?>/5 </div>
			<div class=""> 
				Rate this article:
					<?php foreach(range(1,5) as $rating):?>
						<a href="rate.php?article=<?php echo $article->id; ?>&rating=<?php echo $rating ;?>"><?php echo $rating." "; ?> </a>
					<?php endforeach;?>
			
			</div>
		</div>
	<?php endif;  ?> 
	</body>
	
</html>