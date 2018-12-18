<?php
	//echo "p3</br>";
	function customer_purchase_book($ca, $kw){

		
		include( '2databaseconn.php' );

		$query = "No search query specified!";

		if($kw===NULL){

			$query = "select b.*, c.name as c_name from Books b, Category c where b.category = c.c_id and b.".$ca;

		}else{

			if(strcmp($kw,"*")===0){

				$query = "select b.*, c.name as c_name from Books b, Category c where b.category = c.c_id";

			}else{

				if(strcmp($ca,"category")===0){

					$query = "select b.*, c.name as c_name from Books b, Category c where b.category = c.c_id and c.name like '%".$kw."%'";

				}else{

					$query = "select b.*, c.name as c_name from Books b, Category c where b.category = c.c_id and b.".$ca." like '%".$kw."%'";

				}

			}

		}

		echo $query."</br>";


		$result=$db ->query($query);

		if(!$result){	
			echo "Error: ".mysqli_error($db);	
		}
		
		$num_rows = $result->num_rows; 
	 	

		if(!$num_rows){
			echo "No product found for search keyword:'<b>".$kw."</b>' under category '<b>".$ca."</b>'</br>";
			return;
		}

		echo "Available product list for search keyword: '<b>".$kw."</b>' under category '<b>".$ca."</b>'</br>";


?>	
		<table border="1">
			<tr>
				<td></td>
  				<td>Title</td>
				<td>Cover</td>
  				<td>Category</td>
  				<td>Author</td>
  				<td>Sell Price</td>
  				<td>Description</td>
			</tr>	
<?php
		for($i=0;$i<$num_rows;$i++){
			$row = $result -> fetch_assoc();
			
			

			$field_id=$row['b_id']; 
			$field_title=$row['title']; 
			$field_category=$row['c_name'];
			$field_author=$row['author'];
       	 		$field_price=$row['price'];
        		$field_description=$row['description'];
        		$field_cover=$row['image'];
       			$field_aid=$row['admin_add']; 
?>

			<tr>
				<td><input type="button" value="Add to my cart" onclick="location='buy.php?bid=<?php echo $field_id?>&title=<?php echo $field_title?>&price=<?php echo $field_price?>&category=<?php echo $field_category?>'"> </td>
  				<td><?php echo $field_title; ?></td>
				<td><img src=<?php if($field_cover) {echo "img/".$field_cover;} ?>></td>
  				<td><?php echo $field_category; ?></td>
  				<td><?php echo $field_author; ?></td>
  				<td><?php echo $field_price; ?></td>
  				<td><?php echo $field_description; ?></td>
			</tr>
<?php		

		}
		
	}


?>
