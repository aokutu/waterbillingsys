 <?php 
set_time_limit(0);
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}
@$date1=$_POST['date1']; $_SESSION['date1']=$date1;
@$supplier=$_POST['supplier']; $_SESSION['supplier']=$supplier;
@$action=$_POST['action'];$_SESSION['action']=$action;
@$item=addslashes(strtoupper($_POST['item'])); $_SESSION['item']=$item;
$_SESSION['message']='PROCESSED';
?>