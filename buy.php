<?php

if(!isset($_COOKIE["current_customer"][0])){
	echo "Please login at first!</br>";
	exit(1);
}

$username=$_COOKIE["current_customer"][0];//用户名
$cookie = stripslashes($_COOKIE["current_customer"][1]);
$arr = json_decode($cookie, true);//将cookie中的变量取出来
$userid=$_COOKIE["current_customer"][2];//用户id

$bid=$_GET["bid"];//得到购买物品的id
$title=$_GET["title"];//得到购买物品的名字
$price=$_GET["price"];//得到价格
$category=$_GET["category"];//类型

$book=$arr[$bid];

//如果是数组，说明以前买过东西
//如果买过东西又分两种情况：
if(array_key_exists($bid,$arr)){
	//echo 1;
  //1、array_key_exists($bid,$arr)判断$arr中是否存在键值为$bid的一个一维数组，如果存在的话，就说明此商品以前购买过，只需要把数量加1
  //从二维数组里拿出对应的一维数组，该一维数组包括id title num 三个值
  $book["num"] += 1;  //改变数量，将数量加1
  $arr[$bid]=$book; //改完后再将此一维数组放回二维数组中
}else{   
	//echo 2;
  //2.此商品第一次购买，就将得到的id和title值组成一个一维数组
  $arr[$bid]=array("bid"=>$bid,"title"=>$title,"price"=>$price,"category"=>$category,"num"=>1);
	//echo $bid;
	


	
}

$json = json_encode($arr, true);

//下面先判断这个变量是否是数组,可以得到以前是否买过东西
setcookie("current_customer[0]",$username,time()+1200);
setcookie("current_customer[1]",$json,time()+1200);
setcookie("current_customer[2]",$userid,time()+1200);



//购买完后，将此数组重新放入cookie中，便可以在各个页面看到此cookie
header("location:car.php");//跳转到购物车界面(car.php)
?>
