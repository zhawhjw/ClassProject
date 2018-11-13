<?php
	//echo $_COOKIE['current_employee']."</br>";
	//echo $_COOKIE['current_customer']."</br>";
	
	//setcookie("current_customer", NULL);
	if(is_array($_COOKIE['current_customer'])){
		foreach($_COOKIE['current_customer'] as $index => $value){
			setcookie("current_customer[".$index."]",NULL);
		}
	}

	if(is_array($_COOKIE['current_admin'])){
		foreach($_COOKIE['current_admin'] as $index => $value){
			setcookie("current_admin[".$index."]",NULL);
		}
	}
	
	
?>

<script language="javascript" type="text/javascript"> 
// direct
window.location.href='2employee_login.php';
// timer
//setTimeout("javascript:location.href='hello.html'", 5000); 
</script>
