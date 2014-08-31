<?php

$connect_error = 'Sorry we are experiencing a connection issue.';


mysql_connect('localhost:1234','root','') or die($connect_error);
mysql_select_db('grubpix') or die($connect_error); 


	$name = array();
	$query_run = mysql_query("SELECT * FROM `image_data` ");
		
		while($query_row = mysql_fetch_assoc($query_run)){
		
			  $name[] = $query_row['location'];
		
		}

$arr = array_unique($name);
 $out = '"'.implode('", "',$arr).'"';


//print_r($name);
?>


<?php

?>


<html>



<head>


    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
         //   var data = ["Boston Celtics", "Chicago Bulls", "Miami Heat", "Orlando Magic", "Atlanta Hawks", "Philadelphia Sixers", "New York Knicks", "Indiana Pacers", "Charlotte Bobcats", "Milwaukee Bucks", "Detroit Pistons", "New Jersey Nets", "Toronto Raptors", "Washington Wizards", "Cleveland Cavaliers"];
			  var data = [  <?php echo $out ?>];
		   $("#seed_one").autocomplete({source:data});
        });
    </script>
</head>

<body>
    <input id="seed_one" type="text" name="seed_one"/>
</body>
</html>