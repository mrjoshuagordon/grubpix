<?php
//All grubs
$query = mysql_query("SELECT * from `grubs` WHERE `grub_id` = '$image_id'");


$result = array(); 


while(($row = mysql_fetch_assoc($query)) !== false){
 $result[] = $row['grub_id'];

} 


//print_r($result);

?>



<div class="comment_container">
<h4> Rate this Grub </h4> 


<h5> Users Rated: <?php echo find_number_of_ratings($image_id);?>  </h5>










<?php foreach($result as  $r ):?>
		<div class="rating-div"> 
		<div id="rate" class=""> </div>
				<div class=""> 
					Rate this Grub:
						<?php foreach(range(1,5) as $rating):?>
							<a href="rate.php?grub_id=<?php echo $image_id; ?>&rating=<?php echo $rating ;?>"><?php echo $rating." "; ?> </a>
						<?php endforeach;?>
	
				</div>
		
		
		
		 <span id = "rating" > <div class=""> Overall rating: <?php if(find_user_rating ($image_id, $session_user_id) == '-')  { echo '?'; } else{ echo find_overall_rating ($image_id); } ?>/5 </div> </span> 
		 <span id = "rating" > <div class=""> Your rating: <?php echo find_user_rating ($image_id, $session_user_id) ;?>/5 </div> </span> 
		</div>
	
	<?php endforeach; ?>


</div>




