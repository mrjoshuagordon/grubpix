<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/overallheader.php' ;

$grub_ids = find_grub_ids_by_settings();

//print_r($grub_ids);
//die();

//$order = 'ASC';



//print_r(image_data( $grub_ids[0]));




if(isset($_POST['peer-id'])) {
	user_setting_limit_input($session_user_id, $_POST['peer-id'],$_POST['sort-id'] ); 	
	$result = get_setting_limit($session_user_id);
	$limit = $result['limit'];
	
	
} else{

	if(!empty(get_setting_limit($session_user_id)))  {
			$result = get_setting_limit($session_user_id);
			$limit = $result['limit'];

	
	} else{
	
	$limit = 25;


		}
} 


if(isset($_POST['sort-id'])) {
	user_setting_limit_input($session_user_id, $_POST['peer-id'],$_POST['sort-id'] ); 	
	$result = get_setting_limit($session_user_id);
	$order = $result['order'];
	
	
} else{

	if(!empty(get_setting_limit($session_user_id)))  {
			$result = get_setting_limit($session_user_id);
			$order = $result['order'];

	
	} else{
	
	$order = 'ASC';


		}
} 









$images = find_public_images_query($grub_ids, $order); 


echo $order;


$limits = [1,2,5,10,25,50,100,500,1000];
?>

<script>
function change(){
    document.getElementById("myform").submit();
  
}
</script>



<form id="myform" method="post">
Images shown:  <select name = 'peer-id' onchange="change()" width="60" style="width: 60px" >
	
	<option><?php echo $limit; ?> </option>
								<?php
								for($i=1; $i<count($limits); $i++){
								if($limits[$i] != $limit ) {
								echo '<option>'.$limits[$i].'</option>' ;
								}
							}			?>
	
	
</select>

Sort By:  <select name = 'sort-id' onchange="change()" width="100" style="width: 100px" >
	
	<option><?php echo $order; ?> </option>
	<option> <?php if($order == 'ASC') {  echo 'DESC';} else { echo 'ASC'; }?> </option>		
	
	
</select>


</form> 






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
						
						echo '<tr> <td> <a href="grubinfo.php?image='.$image.'"><img src="uploads/thumbs/'.$image.'"></img></a></td> <td>'. $temp['title'].'</td> <td>'. substr($temp['description'],0,30).'...'.'</td> </tr>';
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



