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
@$serialnumber=trim(strtoupper(addslashes($_POST['serialnumber'])));
@$supplier=trim(strtoupper(addslashes($_POST['supplier'])));
@$quantity=trim(strtoupper(addslashes($_POST['quantity'])));
@$buyprice=trim(strtoupper(addslashes($_POST['buyprice'])));

@$tenderreffnumber=trim(strtoupper(addslashes($_POST['tenderreffnumber'])));$_SESSION['tenderreffnumber']=$tenderreffnumber;
@$action=trim(strtoupper(addslashes($_POST['action'])));$_SESSION['action']=$action;
@$contractreffnumber=trim(strtoupper(addslashes($_POST['contractreffnumber'])));$_SESSION['contractreffnumber']=$contractreffnumber;
@$contractdate=trim(strtoupper(addslashes($_POST['contractdate'])));$_SESSION['contractdate']=$contractdate;
@$requisitionreffnumber=trim(strtoupper(addslashes($_POST['requisitionreffnumber'])));$_SESSION['requisitionreffnumber']=$requisitionreffnumber;
@$requisitiondate=trim(strtoupper(addslashes($_POST['requisitiondate'])));$_SESSION['requisitiondate']=$requisitiondate;
	$x="SELECT SERIALNUMBER     FROM LPOS WHERE  SERIALNUMBER ='$serialnumber' AND SUPPLIER='$supplier'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ $_SESSION['serialnumber']=strtoupper(str_pad($serialnumber, 10, "0", STR_PAD_LEFT)); }
	else {
		$x="SELECT IFNULL(MAX(SERIALNUMBER)+1,1)  AS SERIALNUMBER   FROM LPOS  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['serialnumber']=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));
		$serialnumber=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));
	
	
	}}	
		
	}
	if($action =="L.P.O")
	{
$x="SELECT * FROM INVENTORY WHERE  ITEM ='$item'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1 ){$_SESSION['message']=$item."<br> NOT REGISTERED ";exit;}	
	
$x="INSERT INTO LPOS(CATEGORY,SERIALNUMBER,ITEM,UNITS,PRICE,QUANTITY,AMOUNT,SUPPLIER,TENDERNUMBER,CONTRACTNUMBER,CONTRACTDATE,REQUISITIONNUMBER,REQUISITIONDATE,DATE)
     SELECT CONCAT('$action'),CONCAT('$serialnumber'),ITEM,UNITS,CONCAT('$buyprice'),CONCAT('$quantity'),CONCAT('$buyprice'*'$quantity'),CONCAT('$supplier'),CONCAT('$tenderreffnumber'),CONCAT('$contractreffnumber'),CONCAT('$contractdate'),CONCAT('$requisitionreffnumber'),CONCAT('$requisitiondate'),CURRENT_DATE FROM INVENTORY WHERE  ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));		
	}
	else if($action =="L.S.O")
	{
$x="INSERT INTO LPOS(CATEGORY,SERIALNUMBER,ITEM,PRICE,QUANTITY,AMOUNT,SUPPLIER,TENDERNUMBER,CONTRACTNUMBER,CONTRACTDATE,REQUISITIONNUMBER,REQUISITIONDATE,DATE)
 VALUES('$action','$serialnumber','$item','$buyprice','$quantity','$quantity*$buyprice','$supplier','$tenderreffnumber','$contractreffnumber','$contractdate','$requisitionreffnumber','$requisitiondate',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));		
	}



$_SESSION['supplier']=$supplier;
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ORDERED $quantity  $item  IN $action REFF # . $serialnumber ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="ORDER  REQUEST  $action # <br>".$serialnumber."<br> UPDATED ";exit;
?>