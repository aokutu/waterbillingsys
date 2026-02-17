<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$issuenotenumber=trim(addslashes(strtoupper($_POST['issuenotenumber'])));
$_SESSION['issuenotenumber']=$issuenotenumber;
$_SESSION['message']="LOAD ITEMS  <br> STORE ISSUE NOTE  <br># $issuenotenumber ";exit;
$x="SELECT SERIALNUMBER  FROM REQUISITION,INVENTORY WHERE SERIALNUMBER='$issuenotenumber' AND STATUS =='APPROVED' AND INVENTORY.ITEM=REQUISITION.ITEM AND INVENTORY.QUANTITY >=REQUISITION.QUANTITY ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
$x="UPDATE INVENTORY  TU, REQUISITION TS  SET TU.QUANTITY=TU.QUANTITY-TS.QUANTITY  WHERE TU.ITEM=TS.ITEM  AND TS.SERIALMUMBER='$issuenotenumber'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE  REQUISITION SET  STATUS ='ISSUED' ,DATE=CURRENT_DATE() WHERE SERIALNUMBER='$issuenotenumber' AND STATUS =='APPROVED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO STOCK";
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ISSUED ITEMS  IN  ISSUE NOTE # $issuenotenumber ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="STORES ISSUE NOTE  <br>  # $issuenotenumber   CLEARED";exit;	
}
$_SESSION['message']="STORES ISSUE NOTE  <br>  # $issuenotenumber   NOT CLEARED";exit;
	



?>