<?php 
@session_start();
set_time_limit(0);
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$table=$_POST['table'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$supplier=$_POST['supplier']; @$amount=trim(addslashes(strtoupper($_POST['amount'])));
@$paymode=$_POST['paymode'];@$payrefference=trim(addslashes(strtoupper($_POST['payrefference'])));

$x="INSERT  INTO SUPPLIERPAYMENT(SUPPLIER,PAYMODE,PAYREFFERENCE,AMOUNT,DATE) VALUES('$supplier','$paymode','$payrefference','$amount',now()) ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


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

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'PAY SUPPLIER $supplier   $amount',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']='PROCESSED';
?>