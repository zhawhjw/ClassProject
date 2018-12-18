<?php
	function admin_update_book($ca, $kw){

		include( 'category_array_entity.php' );

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

		$result=$db ->query($query);

		if(!$result){	
			echo "Error: ".mysqli_error($db);	
		}

		$num_rows = $result->num_rows; 
	 	

		if(!$num_rows){
			echo "No product found for search keyword:'<b>".$kw."</b>' under category '<b>".$ca_name."</b>'</br>";
			return;
		}

		echo "Available product list for search keyword: '<b>".$kw."</b>' under category '<b>".$ca_name."</b>'</br>";


?>	
		<form action ="do_update.php" name="b_update" method = "post">
		<table border="1">
			<tr>
				<td><input type="submit" value= "Update"></td>
				<td>ID</td>
  				<td>Title</td>
				<td>Cover</td>
  				<td>Category</td>
  				<td>Author</td>
  				<td>Sell Price</td>
  				<td>Description</td>
  				<td>Last Add/Updated By</td>
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
				
				<td></td>
				<td><input 
					type="hidden" 
					name="b_id[<?php echo $i;?>]" 
					value="<?php echo $field_id; ?>"><?php echo $field_id; ?></td>

  				<td><input 
					type="text" 
					name="title[<?php echo $i;?>]" 
					value="<?php echo $field_title; ?>" 
					required="required"></td>

				<td><img src=<?php if($field_cover) {echo "img/".$field_cover;} ?>></td>
  				
				<td>
				<select name="category[<?php echo $i;?>]">
<?php   					foreach( $categories as $key => $subarr )
						{
							if(is_array($subarr)){

								foreach( $subarr as $subkey => $ele )
								{
									if(strcmp($subkey,"ID")===0){
										$c_id = $ele;
									}

									if(strcmp($subkey,"Name")===0){
										$c_name = $ele;
									}
								}
							}
							
							$selected = "";

							if(strcmp($field_category,$c_name)===0){ $selected="selected='selected'";}

							echo "<option value=".$c_id." ".$selected." >".$c_name."</option>";
							
						}

					
?>				</select>
				
				</td>

  				<td><input 
					type="text" 
					name="author[<?php echo $i;?>]" 
					value="<?php echo $field_author; ?>" 
					required="required"></td>

  				<td><input 
					type="text" 
					name="price[<?php echo $i;?>]" 
					value="<?php echo $field_price; ?>" 
					required="required"></td>

  				<td><textarea 
					rows="4" 
					cols="50" 
					name="description[<?php echo $i;?>]" 
					maxlength="250" 
					required><?php echo $field_description; ?></textarea></td>

  				<td><input 
					type="hidden" 
					name="a_id[<?php echo $i;?>]" 
					value="<?php echo $field_aid; ?>"><?php echo $field_aid; ?></td>
				
			</tr>
<?php		

		}
		$db->close();
	}


?>
		</form>
