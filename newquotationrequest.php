<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$item=$_POST['item']; $item=trim(strtoupper(addslashes($item)));
@$quotationnumber=trim(strtoupper(addslashes($_POST['quotationnumber'])));
@$supplier=trim(strtoupper(addslashes($_POST['supplier'])));
@$quantity=trim(strtoupper(addslashes($_POST['quantity'])));

	$x="SELECT SERIALNUMBER     FROM QUOTATIONREQUESTS WHERE  SERIALNUMBER ='$quotationnumber' AND SUPPLIER='$supplier'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ $_SESSION['quotationnumber']=strtoupper(str_pad($quotationnumber, 10, "0", STR_PAD_LEFT)); }
	else {
		$x="SELECT IFNULL(MAX(SERIALNUMBER)+1,1)  AS SERIALNUMBER   FROM QUOTATIONREQUESTS  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['quotationnumber']=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));
		$quotationnumber=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));
	
	
	}}	
		
	}
$x="SELECT * FROM INVENTORY WHERE  ITEM ='$item'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1 ){$_SESSION['message']=$item."<br> NOT REGISTERED ";exit;}

$x="INSERT INTO QUOTATIONREQUESTS(SERIALNUMBER,ITEM,QUANTITY,UNITS,DATE,SUPPLIER)
SELECT CONCAT('$quotationnumber'),ITEM,CONCAT('$quantity'),UNITS,CURRENT_DATE,CONCAT('$supplier') FROM INVENTORY WHERE  ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['supplier']=$supplier;
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'REQUESTED FOR  QUOTATION OF $quantity  $item  IN REQUEST FOR QUOTATION . $quotationnumber ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="QUOTATION REQUEST # <br>".$quotationnumber."<br> UPDATED ";exit;
?>