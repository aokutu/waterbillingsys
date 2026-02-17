<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

$keyword=addslashes($_POST['keyword']);
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if(!empty($keyword)) {
$x ="SELECT item,price,quantity FROM inventory  where  ITEM LIKE  '" . $keyword . "%' AND QUANTITY >0 AND PRICE > 0 UNION SELECT CONCAT('LABOUR'),CONCAT(' '),CONCAT(' ') UNION SELECT CONCAT('TRANSPORT'),CONCAT(' '),CONCAT(' ') UNION SELECT CONCAT('WAIVER'),CONCAT(' '),CONCAT(' ')     ORDER BY item  LIMIT 8  ";
$x=mysqli_query($connect,$x)or die(print 'INVALID CHARACTERS');
	if(mysqli_num_rows($x)>0)
		{
?>
<ul id="idnumber-list">
<?php
 while ($y=@mysqli_fetch_array($x))
		{
?>
<li onClick="selectCountry('<?php echo $y["item"]; ?>');"><?php echo $y["item"]." Ksh.".$y['price']." QNTY:".$y['quantity']; ?></li>
<?php } ?>
</ul>
<?php } } ?>