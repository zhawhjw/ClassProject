<?php
include( '2databaseconn.php' );

$categories = array();

$query = "select * from Category";

$result = $db -> query($query);

if(!$result){
	echo "Error: ".mysqli_error($db);
}

$num_row = $result -> num_rows;
//echo $num_row;

for($i = 0;$i<$num_row;$i++){
	$row = $result -> fetch_assoc();
	array_push($categories,array(
						"ID" => $row["c_id"],
						"Name" => $row["name"],

			       )
	);
}

//echo $categories[0]["Name"];


?>
