<?php
@session_start(); 
include_once("password.php");
$x = "SELECT * FROM users  WHERE  name='$user' AND password='$password' AND ACCESS REGEXP 'DELETE BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}    
@$id=$_GET['id'];
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED BILL OF AC',ACCOUNT,'BILLED ON',DATE),DATE_ADD(NOW(), INTERVAL 7 HOUR)  FROM ".$_SESSION['billstable']."  WHERE ID='$id' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM $billstable  WHERE ID ='$id' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
header("LOCATION:billsreport.php");
?>