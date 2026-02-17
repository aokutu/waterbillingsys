<?php 

@session_start();

include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'   AND  ACCESS  REGEXP  'BILL RATES'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:dashboard.php");exit;}

if(isset($_GET['id']))
{
$connect->query("INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),CURRENT_TIMESTAMP(),CONCAT('DELETETED METER SIZE ',SIZE),CURRENT_DATE()  FROM  METERRATES  WHERE ID  ='".$_GET['id']."'  ");
$connect->query("DELETE  FROM METERRATES  WHERE ID  ='".$_GET['id']."' "); 
}
header("LOCATION:metersrate.php"); exit;
?>