<style>
#myDIV {
    display: none;
}

#myDIV3 {
    display: inline;
}
</style>


<script type="text/javascript">
function myFunction() {
    var x = document.getElementById("priceDiv");
    var e = document.getElementById("select_bar");
    var t = document.getElementById("restDiv");

    var pmin_bar = document.getElementById("p_min");
    var pmax_bar = document.getElementById("p_max");
    var keyword_bar = document.getElementById("k_bar");

    if (e.options[3].selected === true) {
       x.style.display = "inline";
       t.style.display = "none";

       keyword_bar.required = false;
       pmin_bar.required = true;
    } else {
        x.style.display = "none";
        t.style.display = "inline";

        keyword_bar.required = true;
        pmin_bar.required = false;
        pmax_bar.required = false;
    }
}


function priceMax() {
    var p = document.getElementById("check_box");
    var m = document.getElementById("p_max");
	
    if (p.checked) {
		m.disabled = false;
                m.required = true;
    } else {
		m.disabled = true;
                m.required = false;
    }
}



</script>
<?php
	
	if(!isset($_COOKIE["current_admin"][0])){
		echo "Please login at first!</br>";
		exit(1);
	}
	
	include( '2databaseconn.php' );
	include( 'a_delete_book_f.php' );	
?>



	<form action ="a_delete_search_bar.php" name="a_delete_search" method = "post" onsubmit="check(this); return false;">
		<div class = "title">
				<span>search book(* for all):</span>		
		</div>
				<select id="select_bar" name="search_item" onchange="myFunction()">
				
					<option value="title">title</option>
					<option value="category">category</option>
					<option value="author">author</option>
					<option value="price">price</option>
					<option value="description">description</option>
				</select>
				
				<div id="priceDiv">
					min price
					<input id="p_min" type = "text" name = "pmin"/>
					~max price
					<input id='p_max' type = "text" name = "pmax" disabled="disabled"/>
					<input type="checkbox" id="check_box" name="c_box" onclick="priceMax()"/>
				</div>
				
				<div id="restDiv">
					<input id= "k_bar" type = "text" name = "keyword"/>
				</div>

				<input type="submit" value= "Search">
		</div>

	</form>

<script type="text/javascript">
function setOptionBack() {
    var x = document.getElementById("priceDiv");
    var t = document.getElementById("restDiv");
    var s = document.getElementById("select_bar");
    
    var pmin_bar = document.getElementById("p_min");
    var pmax_bar = document.getElementById("p_max");
    var keyword_bar = document.getElementById("k_bar");
    var sVar = <?php if(isset($_POST["search_item"])){echo "'".$_POST["search_item"]."'";}else{echo -1;}?>;

    if(sVar===-1){
	s.options[0].selected =true;

    }else{
	
	switch(sVar){
		case "title":
			s.options[0].selected =true;
			break;
		case "category":
			s.options[1].selected = true;
			break;
		case "author":
			s.options[2].selected = true;
			break;
		case "price":
			s.options[3].selected = true;
			break;
		case "description":
			s.options[4].selected = true;
			break;	
	}
	
    }

    if (s.options[3].selected === true) {
       x.style.display = "inline";
       t.style.display = "none";

       keyword_bar.required = false;
       pmin_bar.required = true;

    } else {
        x.style.display = "none";
        t.style.display = "inline";

        keyword_bar.required = true;
        pmin_bar.required = false;
        pmax_bar.required = false;
    }
}

setOptionBack();
</script>

<?php
	
	if(!isset($_POST["search_item"])){
		$db->close();
		//echo "Please choose the category!</br>";
		//echo "</br>";
		exit(1);	
	}

	$s_item = NULL;
	$keyword = NULL;
	

	if(strcmp($_POST["search_item"],"price")===0){
		
		echo "min price is ".$_POST["pmin"]."</br>";
		
		$pmin = $_POST["pmin"];
		$pmax = NULL;

		if(preg_match("/^([1-9]{1,6}|[0])+([.]\d{1,2})?$/",$pmin)){

			$s_item = " price >=".$pmin;

		}else{
			$db->close();
			echo "There are illegal characters in 'min price' field!</br>";
			exit(1);
		} 

		
		if(isset($_POST["pmax"])){

			echo "max price is ". $_POST["pmax"]."</br>";

			$pmax = $_POST["pmax"];
			if(preg_match("/^([1-9]{1,6}|[0])+([.]\d{1,2})?$/",$pmax)){
				
                                $s_item =  $s_item." and price <=".$pmax;
			}else{
				$db->close();
				echo "There are illegal characters in 'max price' field!</br>";
				exit(1);
			}	
		}

		
		
	}else{
		$s_item = $_POST["search_item"];

		if(!isset($_POST["keyword"])){
			$db->close();
			echo "Please input the keyword!</br>";
			echo "</br>";
			exit(1);	
		}

		$regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";

		if(preg_match($regex,$_POST["keyword"])){
			echo "There are illegal characters in the keyword!</br>";
			echo "</br>";
			exit(1);
		}
		
		$keyword = trim($_POST['keyword']);

		if($keyword==""){
			$db->close();
			echo "Please do not leave field blank and input valid keyword!</br>";
			echo "</br>";
			exit(1);	
		}
			
	}



	echo "p1</br>";
	//#######################################################
	
	echo "p2</br>";
	admin_delete_book($s_item,$keyword);
	$db->close();
?>

