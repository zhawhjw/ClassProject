<?php
	//include( 'session.php' );
	include( '2databaseconn.php' );

	if(isset($_POST['username']) && isset($_POST['password'])){
		if(!($_POST['username']=="") && !($_POST['password']=="")){
	
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			//echo $username;
			$query = "select * from Customer where u_username =\"".$username."\"";
			//echo $query;
			$result = $db->query($query);
			
			$num_row = $result->num_rows;
			//echo $num_row;
			//echo $password;
			if($num_row){
				$row = $result->fetch_assoc();
				if(strcmp($row['u_password'],$password)==0){ // case check
					
					
					setcookie("current_customer[0]",$username,time()+1200);
					setcookie("current_customer[1]",array(),time()+1200);
					setcookie("current_customer[2]",$row['u_id'],time()+1200);
					//$_SESSION['current_user'] = $username;
					//$_SESSION['time'] = time();
					echo "Welcome customer: <b>".$row['u_first_name']." ".$row['u_last_name']."</b></br>";
					echo $row['u_address'].", ".$row["u_city"].", ".$row['u_state']." ".$row['u_zipcode']."</br>";
					
					//$ip = $_SERVER["REMOTE_ADDR"];
					//echo "Your IP: ";
					//echo $ip."</br>";

					//$dip = explode('.',$ip);

					
					/*if($dip[0]=="10" || ($dip[0]=="131" && $dip[1]=="125")){

					        echo "You are from Kean University</br>";

					}else{

					        echo "You are NOT from Kean University</br>";

					}*/

					
					
?>					<a href="logout_check.php">Customer logout</br></a>
					
					<a href="c_purchase_search_bar.php">Purchase Books</a></br>  
					<a href="car.php">View My Cart</a></br>
<?php				//echo $_COOKIE['current_user'];	
					
					
				}else{
					echo "Authentication error, plase try again!</br>";
					
				}				
			}else{
				echo "Authentication error, plase try again!</br>";
				
				
			}
			//echo mysqli_error($db);
			
		}else{
			echo "Please do not leave any field blank!</br>";
		}
	//setcookie(session_name(),'',time()-10,'/','',0);
	/*if (time()-$_SESSION['time']>5)
	{
		//setcookie(session_name(),'',time()-0,'/','',0);
	    //unset($_SESSION['valid_user']);
	    //session_destroy();
	}
	else
	{
		$_SESSION['time'] = time();
	}*/
	
	}else{
		echo "Please login at first!</br>";
	}
	$db->close();
?>
