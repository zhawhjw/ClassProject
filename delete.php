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


foreach($arr as$key=>$proId)//遍历该二维数组中的键值，这里也就是商品的id
{
     if($key==$bid)//判断键值等于传过来的商品id
     {
          unset($arr[$key]);//清除该一维数组
     }
}

$json = json_encode($arr, true);

setcookie("current_customer[0]",$username,time()+1200);
setcookie("current_customer[1]",$json,time()+1200);
setcookie("current_customer[2]",$userid,time()+1200);

header("location:car.php");//跳转到购物车
?>
