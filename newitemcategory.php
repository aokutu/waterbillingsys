<?php 
@session_start();

include_once("password2.php");
$dbdetails->password=$_SESSION['password'];
$dbdetails->user=$_SESSION['user'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND  ACCESS  REGEXP  'INVENTORY REG'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$category=$connect->real_escape_string(trim(strtoupper(addslashes($_POST['category']))));

$x = $connect ->query("SELECT CATEGORY FROM ITEMCATEGORIES WHERE CATEGORY ='$category' ");
if(mysqli_num_rows($x)>0){$_SESSION['message']="CATEGORY EXISTS ";exit;}

$connect->query("INSERT  INTO ITEMCATEGORIES (CATEGORY) VALUES('$category')");
$connect->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',now(),'CREATED $category CATEGORY',now())");

$_SESSION['message']=$category." <br>CATEGORY CREATED";exit;
?>