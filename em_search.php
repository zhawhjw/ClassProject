<?php
if(isset($_COOKIE['current_admin'][0])){
?>
<a href="logout_check.php">Admin logout</a></br>
<?php		
}else{
?>
<a href="2employee_login.php">Admin login</a></br>
<?php
}
?>
<form action ="em_product_display.php" name="Search" method = "post" onsubmit="check(this); return false;">
	<div class = "title">
			<span>search books by</span>		
	</div>
	<div class = "category">
			<select name="attribute_name">		
	</div>
	<div class = "searchbox">
			<input type = "text" name = "keyword"  required="required"/>
			<input type="submit" value= "Search">
	</div>

</form>
<a href="2employee_login_check.php">Admin Home Page</a></br>

