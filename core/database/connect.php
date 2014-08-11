<?php 
$connect_error = 'Sorry we are experiencing a connection issue.';


mysql_connect('localhost:1234','root','') or die($connect_error);
mysql_select_db('grubpix') or die($connect_error);


?>