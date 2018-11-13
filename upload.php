<!DOCTYPE html>
<html>
<head>
	<title>Upload Image</title>




</head>
	<body>
		
		

		<?php
			
 

			if(isset($_FILES['file']['name'])){
				$image = explode("/", $_FILES["file"]["type"]);
				$target="/home/students/zhangyun/public_html/CPS5921/Pro2/test.".end($image);
				
#				echo "<br>$target\n";
				#move_uploaded_file($_FILES["file"]["tmp_name"],"test.".end($image));
				move_uploaded_file($_FILES["file"]["tmp_name"],$target);
				$picture=explode('/',$target);
				
				#$a=shell_exec("python3 label_image.py --graph=./disney_graph.pb --labels=./disney_labels.txt --input_layer=Placeholder --output_layer=final_result --image=./test.jpg");
				$a=shell_exec("python3 label_image.py --graph=./disney_graph.pb --labels=./disney_labels.txt --input_layer=Placeholder --output_layer=final_result --image=$target");
				echo '<img src="'.end($picture).'">';
				echo "<pre>".$a."</pre>";
				echo "Successful upload file.";
			}
			else{
				echo "<div align='center'>
				<form name='input' action='upload.php' method='post' enctype='multipart/form-data'>
				<b>Upload File</b><br>
				<input type='file' value='file' name='file'>
				<input type='submit' value='submit' name='submit'>
				</form>
				";
			}
			
			
			
			
			
		?>
		
		</div>

</body>
	<style>
	h1 {font-size:60px;}
html, body, h1, h2, h3, h4, h5, h6 {
font-family: "Comic Sans MS", cursive, sans-serif;
}
	body { 
		
		background-size:1500px 900px;
		background-repeat: no-repeat;
		background-position:-20px -100px;
		background-attachment:fixed;

		
  color: 	#336699; 
}
	ul {
		list-style-type: none;
		float: right;
    	margin: 0;
    	padding: 0;
    	overflow: hidden;
   		border: 1px solid #e7e7e7;
    	background-color: #f3f3f3;
    }

	li {
    	float: left;
	}

	li a {
    	display: block;
    	color: #666;
   		text-align: center;
    	padding: 14px 16px;
    	text-decoration: none;
	}

	li a:hover:not(.active) {
    	background-color: #ddd;
	}

	li a.active {
    	color: white;
    	background-color: #BFDFFF;
	}

	</style>
		<style type= "text/css">
		table.hovertable {
		font-family: verdana,arial,sans-serif;
		font-size:11px;
		color:#333333;
		border-width: 1px;
		border-color: #999999;
		border-collapse: collapse;
	}
	table.hovertable th {
		background-color:#c3dde0;
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #a9c6c9;
	}
	table.hovertable tr {
		background-color:#d4e3e5;
	}
	table.hovertable td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #a9c6c9;
	}
</style>
</html>
	
