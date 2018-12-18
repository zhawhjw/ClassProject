<?php

if(!isset($_COOKIE["current_admin"][0])){
	echo "Please login at first!</br>";
	exit(1);
}


?>
<html>

<body>
	
<form action="a_do_passchange.php" method= "POST">
<table border = 0>
<tr bgcolor = #cccccc>
<th colspan="2" width ="-50">Change Password</th>

</tr>
<tr>
	<td>New Password</td>
	<td align= "center"><input type = "password" name = "n_password" size="15" maxlegth="100" required="required"/></td>

  
</tr>
<tr>
	<td>New Password</td>
	<td align= "center"><input type = "password" name = "n_password_confirm" size="15" maxlegth="100" required="required"/></td>
</tr>

<tr>
	<td colspan="2" align="center"><input type= Submit value= "Chnage"/></td>
</tr>

</table>
</form>	

</body>
</html>
