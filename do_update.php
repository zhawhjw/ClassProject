<?php


if(!isset($_COOKIE["current_admin"][0])){
	echo "Please login at first!</br>";
	exit(1);
}


include( '2databaseconn.php' );

$excarray = array();

$update_books ="";

$size=count($_POST["b_id"]);

if($size===0){
	echo "You didn't post any update data here, please back to search page to redo search and update to post value!</br>";
}


for($i=0;$i<$size;$i++){
	if(	(preg_match("/^([1-9]{1,6}|[0])+([.]\d{1,2})?$/",$_POST['price'][$i]) 
	     || preg_match("/^\d+$/",$_POST['price'][$i]))
	     && preg_match("/^\d+$/",$_POST['b_id'][$i])
		
	){
		if($i===0){
			$update_books = "(";
			$update_books = $update_books.$_POST['b_id'][$i];
		}
		$update_books = $update_books.",".$_POST['b_id'][$i];
	}else{
		
		//echo "NO</br>";
		array_push($excarray,$_POST['b_id'][$i]);
		continue;
	}
}

$update_books = $update_books.")";

//$regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";

if(strcmp($update_books,")")===0){
	$db->close();
	echo "The expression has illegal characters!</br>";
	echo "<a href='a_update_search_bar.php'>Search Page</a>";
	exit(1);
}

$query = "select * from Books where b_id in".$update_books;

$db_result = $db -> query($query);

if(!$db_result){
	echo "Error: ".mysqli_error($db)."</br>";
}


reset($excarray);

$e_size=count($excarray);

if(empty($excarray)){
	$flag = false;
}else{
	$flag = true;
	$sentinal = array_shift($excarray);
	$e_size--;
	echo $sentinal."</br>";
}



for($i=0;$i<$size;$i++){

	$row = $db_result -> fetch_assoc();

	if(	   !isset($_POST['title'][$i]) && $_POST['title'][$i]===""
		&& !isset($_POST['author'][$i]) && $_POST['author'][$i]===""
		&& !isset($_POST['price'][$i]) && $_POST['price'][$i]===""
		&& !isset($_POST['description'][$i]) && $_POST['description'][$i]===""
		&& !isset($_POST['a_id'][$i]) && $_POST['a_id'][$i]===""

	){
			echo "Please do not leave the any \"\" value or NULL for ROW ".$i."!</br>";
			continue;
	}

	if($flag){
		
		if($sentinal===$_POST['b_id'][$i]){
		//	echo $_POST['pid'][$i];
		//	echo $sentinal."</br>";
			echo "The quantity of product with id ".$sentinal." has a illegal input! NO UPDATE!</br>";
			
		//	echo $sentinal."</br>";
			if($e_size<=0){
				$flag = false;
			}else{
				$sentinal = array_shift($excarray);
				$e_size--;
			}
			continue;
		}


	}
			$query = "update Books set title='".$_POST['title'][$i]."' 
									 ,description='".$_POST['description'][$i]."' 
									 ,author='".$_POST['author'][$i]."'
									 ,category=".$_POST['category'][$i]." 
									 ,price=".$_POST['price'][$i]." 
									 ,admin_add=".$_COOKIE["current_admin"][2]." 
									 where b_id=".$row['b_id']." 
									 and ('".$_POST['title'][$i]."'!='".$row['title']."'
									 or   '".$_POST['description'][$i]."'!='".$row['description']."'
									 or   '".$_POST['author'][$i]."'!='".$row['author']."'
									 or   ".$_POST['price'][$i]."!=".$row['price']."
									 or   ".$_POST['category'][$i]."!=".$row['category']."
									 or   ".$_POST['a_id'][$i]."!=".$row['admin_add']."
									      )";

	//echo $query."</br>";
	//var_dump($query);
	$result = $db->query($query);

	if(is_null($result)){
		echo "Error: ".mysqli_error($db)."</br>";
	}

	if($db -> affected_rows){
		echo "<b>Succeed update for product with id ".$_POST['b_id'][$i]."!</b></br>";		
	}else{
		echo " no item updated for product with id ".$_POST['b_id'][$i]."!</br>";
	}
	
}
	
	



$db->close();


?>
<a href="a_update_search_bar.php">Search Page</a>
