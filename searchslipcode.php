 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED"; include_once("accessdenied.php");exit;}
@$_SESSION['processid']=addslashes($_POST['slipcode']);
$_SESSION['message']="SUBMITTED"; exit; 
?>