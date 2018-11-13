<?php
include( 'category_array_entity.php' );

if(!isset($_COOKIE["current_admin"][0])){
	echo "Please login at first!</br>";
	header("Location:2employee_login.php");
	goto OUTBLOCK;
	exit(1);
}
if(isset($_POST["keyword"])&&$_POST["keyword"]!=""){
	if($_POST["keyword"]=="*"){
		$query = "select * from Books";
	}else{
		$query = "select t.*,e.name as e_name from CPS5920.EMPLOYEE2 e join(select p.*,v.name as vendor_name from PRODUCT p join CPS5920.VENDOR v on p.vendor_id = v.vendor_id where p.name like'%".$_POST["keyword"]."%' or p.description like '%".$_POST["keyword"]."%') t on e.employee_id = t.employee_id order by t.product_id";
	}

	$result=$db ->query($query);
	
	if(!$result){	
		echo "Error: ".mysqli_error($db);
		//exit(0);	
	}

	$num_rows = $result->num_rows; 
	//echo $num_rows;

	if(!$num_rows){
		echo "No product found for search keyword:".$_POST["keyword"]."</br>";
		goto OUTBLOCK;
		//exit(0);
	}
	echo "Available product list for search keyword: <b>".$_POST["keyword"]."</b></br>";

		//$j = 0;
?>		
		<form action ="product_update.php" name="e_update" method = "post">	
		<table border="1">
			<tr>
				<td>ID</td>
  				<td>Product Name</td>
  				<td>Description</td>
  				<td>Cost</td>
  				<td>Sell Price</td>
  				<td>Available Quantity</td>
  				<td>Vendor Name</td>
  				<td>Last Updated By</td>
			</tr>				
<?php

		for($i=0;$i<$num_rows;$i++){
			$row = $result -> fetch_assoc();

			$field_id=$row['product_id']; //id
			$field_Name=$row['name']; //  name
        	$field_Description=$row['description'];//  description
        	$field_cost=$row['cost'];//  cost
       	 	$field_SellPrice=$row['sell_price'];//  Sell Price
       		$field_Quantity=$row['quantity'];//  quantity
       		$field_VendorName=$row['vendor_name'];//  vendor name
       		$field_eid=$row['employee_id'];//  employee id
       		$field_ename=$row['e_name'];//  employee id
?>
			<tr>
				<td><input type="hidden" name="pid[<?php echo $i;?>]" value="<?php echo $field_id; ?>" ><?php echo $field_id; ?></td>
  				<td><input type="text" name="pname[<?php echo $i;?>]" value="<?php echo $field_Name; ?>" required="required"></td>
  				<td><input type="text" name="pdesc[<?php echo $i;?>]" value="<?php echo $field_Description; ?>" required="required"></td>
  				<td><input type="text" name="pcost[<?php echo $i;?>]" value="<?php echo $field_cost; ?>" required="required"></td>
  				<td><input type="text" name="psprice[<?php echo $i;?>]" value="<?php echo $field_SellPrice; ?>" required="required"></td>
  				<td><input type="text" id ="pquan[<?php echo $i;?>]" name="pquantity[<?php echo $i;?>]" value="<?php echo $field_Quantity; ?>" required="required"></td>
  				<td>
	  				<select name="vendor_id[<?php echo $i;?>]">
		        	<?php foreach( $vendors as $key => $subarr ){
			        	
							if(is_array($subarr)){

								foreach( $subarr as $subkey => $ele ){
									if(strcmp($subkey,"ID")==0){
									$v_id = $ele;
									}

									if(strcmp($subkey,"Name")==0){
										$v_name = $ele;
									}
								}
							}
?>
								<option value=<?php echo $v_id; if(strcmp($v_name,$field_VendorName)==0){echo " selected='selected'";}?>> <?php echo $v_name;?> </option>";
<?php
						}
					?>

					</select>
				</td>
  				<td><?php echo $field_ename; ?></td>
			</tr>
<?php	
		}
?>	
		</table>
		<input type="submit" value= "Update Product">
		</form>	
<?php
}else{
	echo "Please type the keyword!</br>";
}
OUTBLOCK:
$db->close();
?>		
<a href="2employee_login_check.php">Employee Page</a></br>
<script language="javascript" type="text/javascript">
// Select your input element.

var number;
var max = <?php echo $num_rows;?>;
for(var i=0;i<max;i++){
	number= document.getElementById('pquan['+i+']');

// Listen for input event on numInput.
	number.onkeydown = function(e) {
    	if(!((e.keyCode > 95 && e.keyCode < 106)
      	|| (e.keyCode > 47 && e.keyCode < 58) 
      	|| e.keyCode == 8)) {
        	return false;
    	}
	}
	
}

</script>

<canvas id="textarea" tabindex="1" width="300" height="200"></canvas>

<script type="text/javascript">
   var el = document.getElementById("textarea");
   e = el.Event('keydown');
      my(e);
function my(evt) {
       var charCode = evt.keyCode;
       //var charStr = String.fromCharCode(charCode);
       alert(charCode);
   };
</script>
