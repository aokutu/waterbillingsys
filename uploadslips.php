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
$x ="SELECT * FROM wateraccounts  where  concat(transaction,'**',account,'**',depositdate) like  '" . $_POST["keyword"] . "%'  AND CREDIT2 >0  AND CODE !='REVERSED' ORDER BY account,transaction,depositdate  ";
$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
	if(mysqli_num_rows($x)>0)
		{
?>
<ul id="idnumber-list">
<?php
 while ($y=@mysqli_fetch_array($x))
		{
?>
<li onClick="selectCountry('<?php echo $y['id']; ?>');"><?php echo $y['transaction']."**".$y["account"]."**".$y['depositdate']."**".number_format($y['credit'],2)."**".number_format($y['credit2'],2); ?></li>
<?php } ?>
</ul>
<?php } } ?>