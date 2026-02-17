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
@$date2=$_POST['date2']; $_SESSION['date2']=$date2;
@$searchmethod=$_POST['searchmethod'];$_SESSION['searchmethod']=$searchmethod;
@$supplier=$_POST['supplier'];$_SESSION['supplier']=$supplier;
@$searchvalue=$_POST['searchvalue']; $searchvalue=trim(strtoupper(addslashes($searchvalue)));$_SESSION['searchvalue']=$searchvalue;
$_SESSION['searchvalue']=$searchvalue;
$_SESSION['message']=$searchvalue.'SEARCHING';
?>