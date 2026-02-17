<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->password=$_SESSION['password'];
$dbdetails->user=$_SESSION['user'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));

$connect->query("INSERT INTO events(date,user,action,session) 
SELECT CURRENT_DATE,CONCAT('$dbdetails->user'),CONCAT ('DELETED ',NAME,' FROM  THE  STAFF REGISTRY '),CURRENT_TIMESTAMP FROM staffs  WHERE ID ='$id' ");

$connect->query("DELETE FROM advancedsalary WHERE IDNUMBER =(SELECT IDNUMBER FROM staffs WHERE ID ='$id' )");
$connect->query("DELETE FROM staffs WHERE ID ='$id' ");
header("LOCATION:advancepayreport.php");
?>