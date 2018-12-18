<?php 

	if(!isset($_COOKIE["current_admin"][0])){
		echo "Please login at first!</br>";
		exit(1);
	}

	if( !isset($_POST["n_password"]) || !isset($_POST["n_password_confirm"])){
		echo "Please submit your new password from the change password dashboard!</br>";
		exit(1);
	}

	$regex = "/\/|\*|\~|\!|\@|\#|\\$|\%|\^|\&|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
	
	if( preg_match($regex,$_POST["n_password"]) ||  preg_match($regex,$_POST["n_password_confirm"])){
		echo "There are illegal characters in new password!</br>";
		exit(1);
	}

	if( $_POST["n_password"]==="" || $_POST["n_password_confirm"]===""){
		echo "Please submit your new password from the change password dashboard!</br>";
		exit(1);
	}

	if( strcmp($_POST["n_password"], $_POST["n_password_confirm"])!==0){
		echo "Make sure password fields are consistent to each other!</br>";
		exit(1);
	}
	
	include( '2databaseconn.php' );

	$query = "update Admin set a_password='".$_POST["n_password_confirm"]."' where a_id=".$_COOKIE["current_admin"][2];
	
	$result = $db->query($query);

	if(is_null($result)){
		echo "Error: ".mysqli_error($db)."</br>";
	}

	if($db -> affected_rows){
		echo "<b>Succeed update password for admin with id ".$_COOKIE["current_admin"][2]."!</b></br>";		
	}else{
		echo " no password updated for product with id ".$_COOKIE["current_admin"][2]."!</br>";
	}

	$db->close();

?>
<a href="2employee_login_check.php">Admin Dashboard</a>
