<?php
	include( '2databaseconn.php' );
	$regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
	$_POST["TEL"] = preg_replace($regex,"",$_POST["TEL"]);
	
	if($_POST["Password"]!=$_POST["Retype_Password"]){
		echo "Retyped password does not match the password!</br>";
	}else{
		$query = "select * from Customer where u_id ='".$_POST["LoginID"]."'";
		$result=$db->query($query);
		
		if($result->num_rows){
			//$row = $result->fetch_assoc();
			echo "The \"loginID\" already exists in database, please use another ID!</br>";
			//echo $row["login_id"];
		}else{
			$query="INSERT INTO Customer (u_username, u_password, u_first_name,u_last_name,u_tel,u_address,u_city,u_zipcode,u_state) 
			VALUES ('".$_POST["LoginID"]."','".$_POST["Password"]."','".$_POST["First_Name"]."','".$_POST["Last_Name"]."','".			$_POST["TEL"]."','".$_POST["Address"]."','".$_POST["City"]."','".$_POST["Zipcode"]."','".$_POST["State"]."')";
			$result=$db->query($query);
			if($result){
				echo "Thanks for you registration</br>";	
			}else{
				echo "Error: ".mysqli_error($db);
			}
		}
		
		
	}
	$db->close();
?>

<script language="javascript" type="text/javascript"> 
// timer
setTimeout("javascript:location.href='customer_login.php'", 3000); 
</script>
