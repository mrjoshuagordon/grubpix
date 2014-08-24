<div class="comment_container">
<h4> Rate this Grub </h4> 

<?php
//All grubs
$query = mysql_query("SELECT * from `grubs` WHERE `grub_id` = '$image_id'");


$result = array(); 


while(($row = mysql_fetch_assoc($query)) !== false){
 $result[] = $row['grub_id'];

} 


//print_r($result);

?>


<?php foreach($result as  $r ):?>
		<div class=""> 
		 <span id = "rating" > <div class=""> Overall rating <?php find_overall_rating ($image_id); ?> /5 </div> </span> 
		 <span id = "rating" > <div class=""> Your rating <?php echo find_user_rating ($image_id, $user_id) ;?> /5 </div> </span> 
		</div>
	
	<?php endforeach; ?>


<div class=""> </div>
	<div class=""> 
		Rate this Grub:
			<?php foreach(range(1,5) as $rating):?>
				<a href="rate.php?grub_id=<?php echo $image_id; ?>&rating=<?php echo $rating ;?>"><?php echo $rating." "; ?> </a>
			<?php endforeach;?>
	
	</div>
</div>





<br/>


<?php  include 'includes/grub_guess.php' ;  ?>
