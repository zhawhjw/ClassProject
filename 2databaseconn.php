<?php
	$db = new mysqli();
	$src = 'xxxx';
	$user = 'xxxxx';
	$password= 'xxxxx';
	$schema = 'xxxxxx';
    $db -> connect($src,$user,$password,$schema);
     if(mysqli_connect_errno()){
			echo 'Error: Cannot connect to database!'.mysqli_connect_error();
			exit;
			}
			// It is the initialization of the database connection. Almost all of 
			// code files will include this file.
?>
