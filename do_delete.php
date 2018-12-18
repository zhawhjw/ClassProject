<?php
	include( '2databaseconn.php' );

	if(!isset($_COOKIE['current_admin'][0])){
		echo "Please login at first!</br>";
		echo "</br>";
		exit(1);
	}

	if(!isset($_POST["b_id"])){
		echo "Please choose the value to be deleted!</br>";
		echo "</br>";
		exit(1);
	}

	$b_t_id = $_POST["b_id"];

	$query = "delete from Books where b_id=".$b_t_id;
	$result = $db -> query($query);
	
	$affect = $db -> affected_rows;
	
	//echo $affect."</br>";

	if($affect){
		echo "Successfully to delete book ".$b_t_id."</br>";
	}else{
		echo "Error: ".mysqli_error($db)."</br>";
	}
		
	

	$db->close();

	
?>
