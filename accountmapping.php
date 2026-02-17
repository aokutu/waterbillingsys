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
@$account=$_POST['account'];$_SESSION['accounts']=$accounts;
@$lat1 =$_POST['latt1'];$_SESSION['lat1']=$lat1;
@$lon1 = $_POST['long1'];$_SESSION['lon1']=$lon1;
$x="UPDATE $accountstable  SET LONGITUDE='$lon1' ,LATTITUDE='$lat1'  WHERE ACCOUNT ='$account'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'MAPPED  ACCOUNT $account',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']='ACCOUNT '.$account.' UPDATED';
?>