<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password' AND  ACCESS  REGEXP  'BILLING'       ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$id=$_POST['id'];



foreach ($_POST['id2'] as $data)
{

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED ',ITEM,' FROM CLIENT QUOTATION # ',SERIALNUMBER),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM CLIENTQUOTATIONS WHERE ID='$data'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE  FROM  CLIENTQUOTATIONS WHERE  ID='$data'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	
}
header("LOCATION:clientquotations.php");


?>