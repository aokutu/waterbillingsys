<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$item=$_POST['item']; $item=strtoupper(addslashes($item));
@$supplier=$_POST['supplier'];$_SESSION['supplier']=$supplier;
@$price=$_POST['buyprice']; $price=trim(strtoupper(addslashes($price)));
@$sprice=$_POST['sprice'];  $sprice=trim(strtoupper(addslashes($sprice)));
@$delivered=$_POST['delivered'];  $delivered=trim(strtoupper(addslashes($delivered)));$_SESSION['delivered']=$delivered;
@$received=$_POST['received'];  $received=trim(strtoupper(addslashes($received)));$_SESSION['received']=$received;
@$designation1=$_POST['designation1'];  $designation1=trim(strtoupper(addslashes($designation1)));$_SESSION['designation1']=$designation1;
@$designation2=$_POST['designation2'];  $designation2=trim(strtoupper(addslashes($designation2)));$_SESSION['designation2']=$designation2;
@$ordernumber=$_POST['ordernumber']; $ordernumber=trim(strtoupper(addslashes($ordernumber)));$_SESSION['ordernumber']=$ordernumber;
@$invoicenumber=$_POST['invoicenumber']; $invoicenumber=trim(strtoupper(addslashes($invoicenumber))); $_SESSION['invoicenumber']=$invoicenumber;
@$deliverydate=$_POST['deliverydate']; if($deliverydate==null){$_SESSION['message']="DELIVERY  DATE NOT SET"; header("LOCATION:accessdenied4.php");exit;}$_SESSION['deliverydate']=$deliverydate;  
@$department=$_POST['department']; $department=trim(strtoupper(addslashes($department))); $_SESSION['department']=$department;
@$locality=trim(addslashes(strtoupper($_POST['locality'])));
@$date=$_POST['date']; //if($date==null){$_SESSION['message']="EXPIRY DATE NOT SET"; header("LOCATION:accessdenied4.php");exit;}
@$batch=$_POST['batch']; $batch=trim(strtoupper(addslashes($batch)));

@$department=$_POST['department'];  $department=trim(strtoupper(addslashes($department)));$_SESSION['department']=$department;

	$x="SELECT VOUCHERNUMBER  AS VOUCHER  FROM STOCKIN WHERE SUPPLIER='$supplier' AND  INVOICENUMBER='$invoicenumber'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['vouchernumber']=$y['VOUCHER'];}}
	else {
		$x="SELECT MAX(VOUCHERNUMBER)+1  AS VOUCHER  FROM STOCKIN ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['vouchernumber']=$y['VOUCHER'];}}	
		
	}
//if($batch==null){$_SESSION['message']="ENTER BATCH NUMBER "; header("LOCATION:accessdenied4.php");exit;}
@$quantity=$_POST['quantity'];@$action=$_POST['action'];
$x="SELECT * FROM INVENTORY WHERE  ITEM ='$item'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1 ){$_SESSION['message']=$item."<br> NOT REGISTERED ";exit;}

$x="INSERT INTO STOCKIN(ITEMCODE,ITEM,LOCALITY,UNITS,QUANTITY,UNITPRICE,PRICE,ORDERNUMBER,DELIVERY,DELIVERYDESIGNATION,RECEIPIENT,RECEIPIENTDESIGNATION,BATCHNUMBER,EXPIRE,INVOICENUMBER,VOUCHERNUMBER,STOCKBALANCE,SUPPLIER,DEPARTMENT,DATE)
SELECT ITEMCODE,CONCAT('$item'),CONCAT('$locality'),UNITS,CONCAT('$quantity'),CONCAT('$price'),CONCAT('$price'*'$quantity'),'$ordernumber','$delivered','$designation1','$received','$designation2',CONCAT('$batch'),CONCAT('$date'),CONCAT('$invoicenumber'),CONCAT('".$_SESSION['vouchernumber']."'),CONCAT('$quantity'),CONCAT('$supplier'),CONCAT('$department'),CONCAT('$deliverydate') FROM INVENTORY WHERE  ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="UPDATE INVENTORY  TU, INVENTORY  TS  SET TU.QUANTITY=TU.QUANTITY+$quantity ,TU.LOCATION='$locality'  WHERE TU.ITEM=TS.ITEM  AND TU.ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'NEW PURCHASE OF $item QNTY $quantity FROM $supplier REFF NO. $invoicenumber ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));


@$_SESSION['invoicenumber']=$invoicenumber;$_SESSION['supplier']=$supplier;
$_SESSION['message']=$item."<br> UPDATED ";exit;
?>