<?php 
if(!isset($_COOKIE["current_admin"][2])){
	header("Location: 2employee_login_check.php");
	echo "You cannot view this page!</br>";
	exit(1);
}
include( 'category_array_entity.php' );
?>
<a href="logout_check.php">Admin logout</a><br>
<a href="2employee_login_check.php">Admin Home Page</a></br>	
<b>Add Books</b>

<form name="input" action="product_insert.php" method="post" enctype='multipart/form-data'>
	<br> Book Title: <input type="text" name="title" required="required">

	<!-- <br> Cost: <input type="text" name="cost" required="required">  <input type="text" name="description" required="required">-->
	<br> Author: <input type="text" name="author" required="required">
	<br> Sell Price: <input type="number" step="any" min="0" name="sell_price" required="required">
	<!-- <br> Quantity: <input type="text" name="quantity" required="required"> -->

	<br>Select Category: 
	<select name="category_id">
<?php   foreach( $categories as $key => $subarr )
		{
			if(is_array($subarr)){

				foreach( $subarr as $subkey => $ele )
				{
					if(strcmp($subkey,"ID")==0){
						$c_id = $ele;
					}

					if(strcmp($subkey,"Name")==0){
						$c_name = $ele;
					}
				}
			}

			echo "<option value=".$c_id.">".$c_name."</option>";
		}

		$db -> close();
?>

	</select>
	<b>Upload Cover</b>
	<br><input type='file' value='file' name='file'>
	<br> description:<textarea rows="4" cols="50" name="description" maxlength="250" required></textarea>
	<br><input type="hidden" name="a_id" value=<?php echo $_COOKIE["current_admin"][2];?>>
	<br><input type="submit" value="Submit">
</form>
