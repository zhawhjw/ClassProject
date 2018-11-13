<?php
	$db = new mysqli();
	$src = 'imc.kean.edu';
	$user = 'zhangyun';
	$password= '871513';
	$schema = '2017F_zhangyun';
    $db -> connect($src,$user,$password,$schema);
     if(mysqli_connect_errno()){
			echo 'Error: Cannot connect to database!'.mysqli_connect_error();
			exit;
			}
			// It is the initialization of the database connection. Almost all of 
			// code files will include this file.
?>
