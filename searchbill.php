<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if(!empty($_POST["keyword"])) {
$x ="SELECT * FROM  $billstable  where  concat(account,meternumber,date)  like  '" . $_POST["keyword"] . "%' ORDER BY DATE DESC  LIMIT 8";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
		{
?>
<ul id="idnumber-list">
<?php
 while ($y=@mysqli_fetch_array($x))
		{
?>
<li onClick="selectCountry('<?php echo $y["account"]."-".$y["meternumber"]."-".$y['date']; ?>');"><?php echo $y["account"]."-".$y["meternumber"]."-".$y['date']; ?></li>
<?php } ?>
</ul>
<?php } } ?>
