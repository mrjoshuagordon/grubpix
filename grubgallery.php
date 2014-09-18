<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;

$grub_ids = find_grub_ids_by_settings();

//print_r($grub_ids);
//die();

//$order = 'ASC';
//$locations= get_locations_for_gallery();
$locations = array_merge(array('Any'), get_locations_for_gallery());
print_r($locations);
//print_r(image_data( $grub_ids[0]));









// retreive the user settings for limit

if(isset($_POST['peer-id'])) {
	user_setting_limit_input($session_user_id, $_POST['peer-id'],$_POST['sort-id'],$_POST['rating-id'],'%' ); 	
	$result = get_setting_limit($session_user_id);
	$limit = $result['limit'];
	//header('Location: grubgallery.php');
	
} else{

	if(!empty(get_setting_limit($session_user_id)))  {
			$result = get_setting_limit($session_user_id);
			$limit = $result['limit'];
		
	
	} else{
	
	$limit = 25;


		}
}  // end limit find 


// retreive the user settings for sort 
if(isset($_POST['sort-id'])) {

	$_POST['sort-id'] == 'Newest' ? $order = 'DESC' : $order = 'ASC';

	user_setting_limit_input($session_user_id, $_POST['peer-id'],$order,$_POST['rating-id'],'%' ); 	
	$result = get_setting_limit($session_user_id);
	$order = $result['order'];
	header('Location: grubgallery.php');

	
	
} else{

	if(!empty(get_setting_limit($session_user_id)))  {
			$result = get_setting_limit($session_user_id);
			$order = $result['order'];
			
	
	} else{
	
	$order = 'ASC';


		}
} // emd order find 





if(isset($_POST['rating-id'])) {

	user_setting_limit_input($session_user_id, $_POST['peer-id'],$order, $_POST['rating-id'],'%' ); 	
	$result = get_setting_limit($session_user_id);
	$rating = $result['rating'];
	//header('Location: grubgallery.php');
	
} else{

	if(!empty(get_setting_limit($session_user_id)))  {
			$result = get_setting_limit($session_user_id);
			$rating = $result['rating'];
		
	
	} else{
	
	$rating = 1;


		}
}  // end limit find 


// retreive the user settings for sort 
if(isset($_POST['location-id'])) {

	$_POST['location-id'] == 'Any' ? $location = '%' : $location = $_POST['location-id'] ;
	
	user_setting_limit_input($session_user_id, $_POST['peer-id'],$order,$_POST['rating-id'],$location ); 	
	$result = get_setting_limit($session_user_id);
	$location = $result['location'];
	header('Location: grubgallery.php');

	
	
} else{

	if(!empty(get_setting_limit($session_user_id)))  {
			$result = get_setting_limit($session_user_id);
			$location = $result['location'];
			
	
	} else{
	
	$location = '%';


		}
} // emd order find 



echo $location;
//die();

$images = find_public_images_query($grub_ids, $order, $rating, $location); 


//echo $order;


$limits = [1,2,5,10,25,50,100,500,1000];
$ratings = [0,1,2,3,4];
?>

<script>
function change(){
    document.getElementById("myform").submit();
  
}



</script>



<form id="myform" method="post">
Grubs shown: 

<select name = 'peer-id' onchange="change()" width="80" style="width: 80px" >
	
	<option><?php echo $limit; ?> </option>
								<?php
								for($i=1; $i<count($limits); $i++){
								if($limits[$i] != $limit ) {
								echo '<option>'.$limits[$i].'</option>' ;
								}
							}			?>
	
	
</select>

Show First:  <select name = 'sort-id' onchange="change()" width="100" style="width: 100px" >
	
	<!-- Code to change the sort by -->
	 
	<option><?php if($order != 'ASC') {  echo 'Newest';} else { 	echo 'Oldest'; }?>  </option>
	<option> <?php if($order != 'ASC') {  echo 'Oldest';} else { echo 'Newest'; }?> </option>		
	
	
</select>


</select>

Avg Rating:  <select name = 'rating-id' onchange="change()" width="100" style="width: 100px" >
	
	<!-- Code to change the rating -->
	
	<option><?php echo $rating .'+'; ?> </option>
								<?php
								for($i=0; $i<5; $i++){
								if($ratings[$i] != $rating ) {
								echo '<option>'.$ratings[$i].'+ </option>' ;
								}
							}			?>	
	
	
</select>

</select>

Location:  <select name = 'location-id' onchange="change()" width="100" style="width: 100px" >
	
	<!-- Code to change the rating -->
	
	
	<?php if($location =='%') {$location = 'Any';}?>
	
	<option><?php echo $location  ?> </option>
								<?php
								for($i=0; $i<count($locations); $i++){
								if($locations[$i] != $location) { 
								echo '<option>'.$locations[$i].'</option>' ;
								}
							}			?>	
	
	
</select>


</form> 


<br >



<div class="wrap">
    <table class="head">
        <tr>
            <td>Grub</td>
            <td>Title</td>
            <td>Description</td>
        </tr>
    </table>
    <div class="inner_table">
        <table> <?php 
							for($i = 0; $i < min($limit, count($images)); $i++){
						
						 $image = $images[$i]['image']; 
						$grub_id = image_id_from_imagename($image); 
						$temp = image_data( $grub_id );	
						
						echo '<tr onclick="window.location=\'./grubinfo.php?image='.$image.'\'"> <td> <a href="grubinfo.php?image='.$image.'"><img src="uploads/thumbs/'.$image.'"></img></a></td> <td> '. $temp['title'].'</td> <td>'. substr($temp['description'],0,30).'...'.'</td> </tr>';
						}
					?>
    </table>
    </div>
</div> 








<?php

/*
<div style="height:500px ; overflow:auto;"> 
<table id="grubsTable" class="comment_table" border="1" align="center">  


echo   ' <tr> <td> Grub </td> <td> Title </td> <td> Detail </td> </tr>';

for($i = 0; $i < count($images); $i++){
	 $image = $images[$i]; 
	echo '<tr> <td> <a href="grubinfo.php?image='.$image.'"><img src="uploads/thumbs/'.$image.'"></img></a></td> <td>test</td> <td>test</td> </tr>';
}
</table>
</div>

*/
?>




<?php include 'includes/overall/overallfooter.php'; ?> 



