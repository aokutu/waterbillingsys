<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->password=$_SESSION['password'];
$dbdetails->user=$_SESSION['user'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'DELETE SLIPS'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));

$connect->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),CURRENT_TIMESTAMP,CONCAT('DELETED PAY SLIP OF ',NAMES,' OF ',MONTH),CURRENT_DATE FROM PAYROLL  WHERE ID ='$id' ");

$connect->query("DELETE FROM PAYROLL WHERE ID ='$id' ");
header("LOCATION:staffpayroll.php");
?>