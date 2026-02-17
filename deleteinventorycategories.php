<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->password=$_SESSION['password'];
$dbdetails->user=$_SESSION['user'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND  ACCESS  REGEXP  'INVENTORY REG'   ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$category=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['category']))));

$connect->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED ITEM CATEGORY ',CATEGORY),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM ITEMCATEGORIES  WHERE CATEGORY ='$category' ");

$connect->query("DELETE FROM ITEMCATEGORIES  WHERE CATEGORY ='$category' ");
header("LOCATION:itemcategory.php");
?>