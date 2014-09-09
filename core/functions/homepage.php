<?php



function find_comments(){


$result = array();

$query = mysql_query("SELECT * FROM `grub_comment` ORDER BY `comment_id` DESC ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		$result[] = array( 
		'grub_id' => $row['grub_id'],
		'username' => $row['username'],
		'comment' => $row['comment'],
				
		);
	
	} 
	return $result;


}





?>