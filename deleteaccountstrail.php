<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'ACCOUNTS TRAIL' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{header("LOCATION:accessdenied4.php");exit;}
@$id=$_GET['id'];
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),CONCAT(DATE_ADD(NOW(), INTERVAL 7 HOUR)),CONCAT('DEL TASKS ',STATUS,' ON ACC ',ACCOUNT),CONCAT(DATE_ADD(NOW(), INTERVAL 7 HOUR)) FROM  $statushistorytable    WHERE id=$id";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM  $statushistorytable   WHERE id=$id";mysqli_query($connect,$x)or die(mysqli_error($connect));
header("LOCATION:accountstrail.php");
?>
