<?php


if(!isset($_COOKIE["current_customer"][0])){
	echo "Please login at first!</br>";
	exit(1);
}

$cookie = stripslashes($_COOKIE["current_customer"][1]);
$arr = json_decode($cookie, true);//
		 
?>

<table width="100" height="37"border="1">
  <tr>
   <td width="158">title</td>
   <td width="154">category</td>
    <td width="154">price</td>
   <td width="154">number</td>
   <td width="177">delete</td>
   <td width="177">Mine</td>
   <td width="177">Plus</td>
   <td width="177">Total</td>
  </tr>
<?php
foreach($arr as $a)//
{
?>
     <tr>
	<td width="158"><?php echo $a["title"]?></td>

	<td width="154"><?php echo $a["category"]?></td>
	<td width="154"><?php echo $a["price"]?></td>
	<td width="154"><?php echo $a["num"]?></td>
	<td width="177"><a href="delete.php?bid=<?php echo $a["bid"]?>">Delete</a></td>
	<td width="177"><a href="mine.php?bid=<?php echo $a["bid"]?>&title=<?php echo $a["title"]?>">Minus</a></td>
	<td width="177"><a href="buy.php?bid=<?php echo $a["bid"]?>&title=<?php echo $a["title"]?>">Plus</a></td>
	<td width="177"><?php echo $total=$a["price"]*$a["num"] ?></td>
     </tr>
<?php
}
?>
</table>
</form>
<a href="c_purchase_search_bar.php">Continue shopping</a>
<a href="pending.php">Pending</a>


