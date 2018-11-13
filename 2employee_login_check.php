<?php
	//include( 'session.php' );
	include( '2databaseconn.php' );
	

	if(isset($_COOKIE['current_admin'][0])){
		goto INBLOCK;
	}
	
	if(isset($_POST['username']) && isset($_POST['password'])){
		if(!($_POST['username']=="") && !($_POST['password']=="")){
	
	
			$username = $_POST['username'];
			$rawpassword = $_POST['password'];
			$password =hash("sha256",$rawpassword);
			//echo $password;
			//echo $username;
			$query = "select * from Admin where a_username =\"".$username."\"";
			//echo $query;
			$result = $db->query($query);
			
			$num_row = $result->num_rows;
			//echo $num_row;
			//echo $password;
			if($num_row){
				$row = $result->fetch_assoc();
				if(strcmp($row['a_password'],$rawpassword)==0){ // case check
				
				//	setcookie("current_employee[id]",$row['emplyoee_id']/*,time()+1200*/);
					setcookie("current_admin[0]",$username,time()+1200);
					//setcookie("current_employee[1]",$row['role'],time()+1200);
					setcookie("current_admin[2]",$row['a_id'],time()+1200);
					//setcookie("current_employee[3]",$password,time()+1200);
					//setcookie("current_employee[4]",$row['name'],time()+1200);
					//$_SESSION['current_user'] = $username;
					//$_SESSION['time'] = time();
INBLOCK:				

 					echo "Welcome, Administator".$row[a_id]."</br>";	
					$ip = $_SERVER["REMOTE_ADDR"];
					$userdir = getcwd();
					//echo $userdir;
					//echo "Your IP: ";
					//echo $ip."</br>";

					$dip = explode('.',$ip);

					
					//if($dip[0]=="10" || ($dip[0]=="131" && $dip[1]=="125")){

					       // echo "You are from Kean University</br>";

					//}else{

					       // echo "You are NOT from Kean University</br>";

					//}
						
					
?>
						<a href="logout_check.php">Admin logout</a></br>
				<!--		<form name="input" action="view_report.php" method="post">
  							View Reports -
 						 	period:
  							<select name="report_period">
  								<option value="all">all</option>
  								<option value="past_week">past week</option>
  								<option value="current_month">current month</option>
  								<option value="past_month">past month</option>
  								<option value="this_year">this year</option>
  								<option value="past_year">past year</option>
  							</select>
  							, by:
  							<select name="report_type">
  								<option value="all">all sales</option>
  								<option value="products">products</option>
  								<option value="vendors">vendors</option>
  							</select>
  							<input type="submit" value="Submit">
  						</form>
						-->
					<a href="product_add.php">Add Books</a></br> 
				<!--	<a href="view_vendors.php">View all vendors</a></br> -->
					<!--<a href="em_search.php">Search & Update Books</a></br> -->
<?php
					
					
				}else{
					echo "Admin \"".$username."\" exists, but passowrd does not match!</br>";
					
				}				
			}else{
				echo "Login ID \"".$username."\" doesn't exist in the database!</br>";
				
				
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
