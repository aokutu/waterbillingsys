<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'INVENTORY REG' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$action=$_POST['action'];

if($action =='DELETEPAY')
{
foreach($_POST['payment'] as  $data)
{ 
$x="DELETE FROM SUPPLIERPAYMENT  WHERE ID='$data' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}

 ////////////////////////////////
 $x="UPDATE SUPPLIERS SET BALANCE=0,CREDIT=0,DEBIT=0 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="CREATE TEMPORARY TABLE x      SELECT SUPPLIER, SUM(PRICE) AS TheSum  FROM STOCKIN   GROUP BY  SUPPLIER ;";
mysqli_query($connect,$x)or die(mysqli_error($connect));		

$x="UPDATE SUPPLIERS  JOIN x ON (SUPPLIERS.SUPPLIER = x.SUPPLIER)
    SET SUPPLIERS.CREDIT = x.TheSum
    WHERE SUPPLIERS.SUPPLIER = x.SUPPLIER";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DROP TEMPORARY TABLE x";mysqli_query($connect,$x)or die(mysqli_error($connect));
////////////////////////////////////////////////

	   /////////////////////////////////
$x="CREATE TEMPORARY TABLE x      SELECT SUPPLIER, SUM(AMOUNT) AS TheSum  FROM SUPPLIERPAYMENT   GROUP BY  SUPPLIER ;";
mysqli_query($connect,$x)or die(mysqli_error($connect));		

$x="UPDATE SUPPLIERS  JOIN x ON (SUPPLIERS.SUPPLIER = x.SUPPLIER)
    SET SUPPLIERS.DEBIT = x.TheSum
    WHERE SUPPLIERS.SUPPLIER = x.SUPPLIER";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DROP TEMPORARY TABLE x";mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="UPDATE SUPPLIERS  TU, SUPPLIERS TS  SET TU.BALANCE=TS.CREDIT-TS.DEBIT WHERE TU.SUPPLIER=TS.SUPPLIER ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

////////////////////////////////////////////////
	
$_SESSION['message']="SUPPLIERS DELETED <BR>  PAYMENTS ";exit;	
}
@$name=$_POST['name'];
foreach($name as  $companyx)
{ 

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'DELETED   SUPPLIER  :$companyx',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE FROM SUPPLIERS  WHERE SUPPLIER='$companyx' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="SUPPLIERS DELETED";exit;
?>