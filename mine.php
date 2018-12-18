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

$book=$arr[$bid];

//如果是数组，说明以前买过东西
//如果买过东西又分两种情况：
if(array_key_exists($bid,$arr)&& $book["num"]!=1){

  $book["num"] -= 1;  //改变数量，将数量加1
  $arr[$bid]=$book; //改完后再将此一维数组放回二维数组中
}

$json = json_encode($arr, true);
setcookie("current_customer[0]",$username,time()+1200);
setcookie("current_customer[1]",$json,time()+1200);
setcookie("current_customer[2]",$userid,time()+1200);
header("location:car.php");//跳转到购物车界面(car.php)
?>
