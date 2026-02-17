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
$x ="SELECT $wateraccountstable.id,$wateraccountstable.account,$accountstable.client,$wateraccountstable.depositdate,$wateraccountstable.code,$wateraccountstable.credit FROM  $wateraccountstable,$accountstable  where  $wateraccountstable.account like  '" . $_POST["keyword"] . "%' AND  $wateraccountstable.account=$accountstable.account AND $wateraccountstable.STATUS !='RECIEPTED' AND RECIEPTNUMBER=''  ORDER BY $wateraccountstable.account  LIMIT 8";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
		{
?>
<ul id="idnumber-list">
<?php
 while ($y=@mysqli_fetch_array($x))
		{
?>
<li onClick="selectCountry('<?php echo $y["id"]; ?>');"><?php echo $y["account"]."-".$y['client']."-".$y['depositdate']." CODE ".$y['code']." Ksh".number_format($y['credit'],2); ?></li>
<?php } ?>
</ul>
<?php } } ?>
