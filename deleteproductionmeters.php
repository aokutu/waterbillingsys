<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'PRODUCTION' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@session_start();
include_once("loggedstatus.php");

include_once("password2.php");

$dbdetails->password=$_SESSION['password'];
$dbdetails->user=$_SESSION['user'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'AND ACCESS REGEXP 'PRODUCTION' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));
$connect->query("INSERT INTO events(user,session,action,date) SELECT CONCAT('$dbdetails->user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED PRODUCTION METER  ',refferencenumber),DATE_ADD(NOW(), INTERVAL 7 HOUR)  FROM productionmeters WHERE ID=$id ");

$connect->query("DELETE FROM productionmeters WHERE ID ='$id' ");
header("LOCATION:productionbilling.php");
exit;

?>