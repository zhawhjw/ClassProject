<?php
include( '2databaseconn.php' );
if(!isset($_COOKIE["current_admin"][2])){
	header("Location: 2employee_login_check.php");
	echo "You cannot view this page!</br>";
	exit(1);
}

$b_title = $_POST["title"];
$b_desc = $_POST["description"];
$c_id = (int)$_POST["category_id"];
$b_author = $_POST["author"];
$b_sprice = $_POST["sell_price"];
//$p_quan = (int)$_POST["quantity"];
$b_aid = (int)$_POST["a_id"];
$b_image = "";


$query = "insert into Books (title,description,category,author,price,admin_add)values('".$b_title."','".$b_desc."',".$c_id.",'".$b_author."',".$b_sprice.",".$b_aid.")";

//echo $query."</br>";

$result=$db->query($query);

//if insert succeed
if($result){

	//extract the b_id,image of the row just inserted under a condition file is uploaded succeessfully
	$query = "select b_id,image from Books where admin_add =".$b_aid." order by b_id desc limit 1";
	$result=$db->query($query);

	if(!$result){
		echo  "Error: ".mysqli_error($db);		
	}
	
	//if file is a picture, modify 'image' column
	//echo $_FILES['file']['name']."</br>";
	if(isset($_FILES['file']) && ( 	  ($_FILES["file"]["type"] == "image/png") 
		      			||($_FILES["file"]["type"] == "image/bmp")
	              			||($_FILES["file"]["type"] == "image/jpeg")
		      			||($_FILES["file"]["type"] == "image/pjpeg")
				     )
	){
			
		$num_row = $result->num_rows;
		//should be only 1 row
		$row = $result -> fetch_assoc();
		// if find a book just inserted by current admin
		if($num_row && $row['image'] ==NULL){
			
			//echo "Image Ready</br>";

			$b_id = $row['b_id'];
			//prepare the folder for containing uploaded image and rename image to match the book id
			// Create directory if it does not exist
			$destination = getcwd()."/img";
			if(!is_dir($destination)) {
				mkdir($destination);
			}
			$image = explode("/", $_FILES["file"]["type"]);
			$target=$destination."/".strval($b_id).".".end($image);

			//move image to folder ./img
			move_uploaded_file($_FILES["file"]["tmp_name"],$target);

			//$picture=explode('/',$target);
			
			//then update the image column for this book
			$query = "update Books set image='".strval($b_id).".".end($image)."' where b_id=".$b_id;
			$result = $db->query($query);

			if($db -> affected_rows){
				echo "Successful upload file for cover for book #".$b_id." by Administrator ".$b_aid;
				echo "</br>";		
			}else{
				echo  "Error: ".mysqli_error($db);
				echo "</br>";
				echo "Update image query for book #".$b_id." failed";
				echo "</br>";
			}
			//echo '<img src="'.end($picture).'">';
				


		//if cannpt find any last book just inserted by current admin
		}else{
			echo "Insert operation succeed, but there is a conflict that no book is added by current Administrator.";
			echo "</br>";
			echo "Maybe some other operation are performed simultaneously like 'DELETE'";
			echo "</br>";
			echo "Contact database manager or web developer to check anything wrong.";
			echo "</br>";
		}
				
	//if no file is uploaded, just no image will be displayed and the column of 'image' wil be set as NULL
	}else{
		echo "No cover is added for book #".$b_id;
		echo "</br>";
	}


	echo "The book #'".$b_id."' is successfully added!</br>";

}else{
	echo  "Error: ".mysqli_error($db);
}

$db->close();
?>
<a href="2employee_login_check.php">Admin Home Page</a>
<br>
<a href="product_add.php">Add More Books</a>

