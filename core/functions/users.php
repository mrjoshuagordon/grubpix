<?php 


function update_settings($user_id, $update_data) {

	$update = array();
	$insert = array();
	$values = array();
	
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data ) {
		$update[] = '`' . $field . '` = \''. $data .'\''; 
	}	


	foreach($update_data as $field=>$data ) {
		$insert[] = '`' . $field . '`';
	}	
	
	foreach($update_data as $field=>$data ) {
		$values[] = '\'' . $data . '\'';
	}	
	
//	echo "INSERT INTO `user_settings` ( `user_id`,  " . implode(', ', $insert) . ") VALUES ( ".$user_id.", ". implode(', ', $values) .")";
	
	
	
	
	$query = mysql_query("SELECT COUNT(`user_id`) from `user_settings` WHERE `user_id` = '$user_id'  "); 
	
		if( mysql_result($query,0)>=1) {
	
	mysql_query("UPDATE `user_settings` SET " . implode(', ', $update) . " WHERE `user_id` =  " . $user_id);	
			} else{
			
	mysql_query("INSERT INTO `user_settings` ( `user_id`,  " . implode(', ', $insert) . ") VALUES ( ".$user_id.", ". implode(', ', $values) .")");	
			
			} 
			
	//		mysql_query("INSERT INTO `user_settings` (`user_id`, `image_view`, `order`) VALUES ('$user_id' , '$limit', '$order')");

	
	}






function user_settings($user_id){
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if($func_num_args > 1 ) {
		unset($func_get_args[0]);
		
		$fields = '`'. implode('`, `',$func_get_args) . '`' ;
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields from `user_settings` WHERE `user_id` = $user_id"));
		
		return $data;	
			
	} 
	


}





function get_active_users() {

$result = array();

$query = mysql_query("SELECT *  FROM `users` WHERE `active` = 1 ");

	while(($row = mysql_fetch_assoc($query)) !== false){
	
		if(empty($row['profile'])) {
		
		$result[] = array('no_profile.jpg', $row['username']); 
		
	//	$result[] = 'no_profile.jpg';
	
			} else{
	
		$result[] = array(end(explode('/',$row['profile'])), $row['username']); 
	//	$result[] = end(explode('/',$row['profile']));
	
		} // end if
	
	}  // end while 
	return $result;

}


function find_username_from_profile($image) {

return mysql_result(mysql_query("SELECT `username` from `users` where `profile` = '$image'"),0,
	'username');


}














function change_profile_image($user_id, $file_temp, $file_ext){
	$file_name = 'images/profile/'.substr(md5(time()),0, 10). '.' .$file_ext ;
	move_uploaded_file($file_temp, $file_name);
	mysql_query("UPDATE `users` SET `profile` = '".$file_name."' WHERE `user_id` = ".(int)$user_id );	
		
}


function mail_users($subject, $body){
	$query = mysql_query("SELECT `email`, `first_name` FROM `users` where `allow_email` = 1");
	
	while(($row = mysql_fetch_assoc($query)) !== false){
	

		email($row['email'], $subject, "Hello " . $row['first_name'] .",\n\n ". $body);
	
	}
	
	
}


function mail_grubnums($subject, $body, $user_id, $first_name, $email){

 	$user_info = $user_id." - " . $first_name . " - " . $email ;
 
	
	mail('mr.joshuagordon@gmail.com', $subject . " --- " . $user_info , "This is a message from ".$email."\n\n". $body, "From: ".$email ); 
	

}


function has_access($user_id, $type){
	$user_id = (int) $user_id;
	$type = (int) $type;
	return(mysql_result(mysql_query("SELECT COUNT(`user_id`) from `users` WHERE `user_id` = $user_id  AND `type` = $type "),0) == 1) ? true : false;

}



function recover($mode, $email){
	$mode 	= sanitize($mode);
	$email  = sanitize($email);

	$user_data = user_data(user_id_from_email($email), 'user_id', 'first_name', 'username');
		
	if($mode === 'username') {
		email($email, 'Your username', "Hello ". $user_data['first_name'] .", \n\nYour username is: ". $user_data['username'] ." \n\n - Josh");
	} else if( $mode === 'password') {
		$generated_password = substr(md5(rand(9999,999999)),0,8);
		change_password($user_data['user_id'], $generated_password);
		
		update_user($user_data['user_id'], array( 'password_recover' => '1')); 
		
		email($email, 'Your password recovery', "Hello ". $user_data['first_name'] .", \n\nYour new password is: ". $generated_password ." \n\n - Josh");
	} 

}


function update_user($user_id, $update_data) {

	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data ) {
		$update[] = '`' . $field . '` = \''. $data .'\''; 
	}	
	
	
		
mysql_query("UPDATE `users` SET " . implode(', ', $update) . " WHERE `user_id` =  " . $user_id);	

	
	
	}


function activate($email, $email_code) {
	$email = mysql_real_escape_string($email);
	$email_code = mysql_real_escape_string($email_code);
		
		if (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND 
		 `email_code` = '$email_code'  and `active` = 0"),0) == 1) {
		
		mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$email' ");	
		return true;
		
		} else{
		
		 return false;
		}
		

}


function email($to, $subject, $body) {
	mail($to, $subject, $body, 'From: mr.joshuagordon@gmail.com');

}


function change_password($user_id, $password){
	$user_id = (int) $user_id ; 
	$password = md5($password);

	mysql_query("UPDATE `users` SET `password` = '$password', `password_recover` = 0 WHERE `user_id` = $user_id ");

}


function register_user($register_data) {
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`' ;
	$data = '\''. implode('\', \'', $register_data) . '\'' ;
	

	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
	
	email($register_data['email'], 'Activate your account', "Hello " . $register_data['first_name'] . ",\n\nYou need to active your account so use the link below: \n\n	http://localhost:1234/grubpix/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']." \n\n- josh");
	}
//5f4dcc3b5aa765d61d8327deb882cf99

function user_data($user_id){
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if($func_num_args > 1 ) {
		unset($func_get_args[0]);
		
		$fields = '`'. implode('`, `',$func_get_args) . '`' ;
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields from `users` WHERE `user_id` = $user_id"));
		
		return $data;	
			
	} 
	


}

function logged_in() {
 return (isset($_SESSION['user_id'])) ? true : false; 
}

function user_exists($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) from `users` WHERE `username`
	= '$username' ");
	return (mysql_result($query,0)==1) ? true : false;

} 

function email_exists($email){
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`user_id`) from `users` WHERE `email`
	= '$email' ");
	return (mysql_result($query,0)==1) ? true : false;

} 

function user_active($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) from `users` WHERE `username`
	= '$username' AND `active` = 1 ");
	return (mysql_result($query,0)==1) ? true : false;

}  

function user_id_from_username($username){
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `user_id` from `users` where `username` = '$username'"),0,
	'user_id');
}


function user_id_from_email($email){
	$email= sanitize($email);
	return mysql_result(mysql_query("SELECT `user_id` from `users` where `email` = '$email'"),0,
	'user_id');
} 


function user_name_from_id($user_id){
	return mysql_result(mysql_query("SELECT `username` from `users` where `user_id` = '$user_id'"),0,
	'username');
} 


function login($username, $password){
	$user_id = user_id_from_username($username);
	$username = sanitize($username);
	$password = md5($password);
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) from `users` WHERE `username`
	= '$username' and `password` = '$password' "),0)== 1) ? $user_id : false;
}



?>