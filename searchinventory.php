<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if(!empty($_POST["keyword"])) {
$x ="SELECT * FROM inventory  where  item like  '" . $_POST["keyword"] . "%' ORDER BY item  LIMIT 8";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
		{
?>
<ul id="idnumber-list">
<?php
 while ($y=@mysqli_fetch_array($x))
		{
?>
<li onClick="selectCountry('<?php echo $y["item"]; ?>');"><?php echo $y["item"]."-".$y['units']."-".$y['category']."-".$y['itemcode']."-".$y['quantity']; ?></li>
<?php } ?>
</ul>
<?php } } ?>
