<?php 

@session_start();

include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->password=$_SESSION['password'];
$dbdetails->user=$_SESSION['user'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'AND ACCESS REGEXP 'DELETE BILLS' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));
$connect->query("INSERT INTO events(user,session,action,date) SELECT CONCAT('$dbdetails->user'),CURRENT_TIMESTAMP,CONCAT('DELETED BILL REFF #  $id'),CURRENT_DATE ");
$connect->query("DELETE FROM $billstable  WHERE ID ='$id' ");
header("LOCATION:billsreport.php");
?>