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
@$purchasereqnumber=trim(strtoupper(addslashes($_POST['purchasereqnumber'])));
@$price=$_POST['buyprice']; $price=trim(strtoupper(addslashes($price)));

@$requester=$_POST['requester'];  $requester=trim(strtoupper(addslashes($requester)));$_SESSION['requester']=$requester;
@$checker=$_POST['checker'];  $checker=trim(strtoupper(addslashes($checker)));$_SESSION['checker']=$checker;
@$confirmer=$_POST['confirmer'];  $confirmer=trim(strtoupper(addslashes($confirmer)));$_SESSION['confirmer']=$confirmer;
@$approver=$_POST['approver'];  $approver=trim(strtoupper(addslashes($approver)));$_SESSION['approver']=$approver;

@$requestertitle=$_POST['requestertitle'];  $requestertitle=trim(strtoupper(addslashes($requestertitle)));$_SESSION['requestertitle']=$requestertitle;
@$checkertitle=$_POST['checkertitle'];  $checkertitle=trim(strtoupper(addslashes($checkertitle)));$_SESSION['checkertitle']=$checkertitle;
@$confirmertitle=$_POST['confirmertitle'];  $confirmertitle=trim(strtoupper(addslashes($confirmertitle)));$_SESSION['confirmertitle']=$confirmertitle;
@$approvertitle=$_POST['approvertitle'];  $approvertitle=trim(strtoupper(addslashes($approvertitle)));$_SESSION['approvertitle']=$approvertitle;

@$quantity=trim(strtoupper(addslashes($_POST['quantity'])));
@$purpose=trim(strtoupper(addslashes($_POST['purpose'])));


	$x="SELECT SERIALNUMBER     FROM PURCHASESREQUISITION WHERE  SERIALNUMBER ='$purchasereqnumber'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ $_SESSION['serialnumber']=strtoupper(str_pad($purchasereqnumber, 10, "0", STR_PAD_LEFT)); }
	else {
		$x="SELECT IFNULL(MAX(SERIALNUMBER)+1,1)  AS SERIALNUMBER   FROM PURCHASESREQUISITION  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['purchasereqnumber']=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));
		$purchasereqnumber=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));
	
	
	}}	
		
	}
$x="SELECT * FROM INVENTORY WHERE  ITEM ='$item'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1 ){$_SESSION['message']=$item."<br> NOT REGISTERED ";exit;}

$x="INSERT INTO PURCHASESREQUISITION(SERIALNUMBER,ITEM,QUANTITY,UNITS,PREVBALANCE,PRICE,VALUE,PURPOSE,REQUESTER,REQUESTERTITLE,CHECKER,CHECKERTITLE,CONFIRMER,CONFIRMERTITLE,APPROVER,APPROVERTITLE,DATE)
SELECT CONCAT('$purchasereqnumber'),ITEM,CONCAT('$quantity'),UNITS,QUANTITY,CONCAT('$price'),CONCAT('$price'*'$quantity'),CONCAT('$purpose'),CONCAT('$requester'),CONCAT('$requestertitle'),CONCAT('$checker'),CONCAT('$checkertitle'),CONCAT('$confirmer'),
CONCAT('$confirmertitle'),CONCAT('$approver'),CONCAT('$approvertitle'),CURRENT_DATE FROM INVENTORY WHERE  ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'REQUISITIONED $quantity  $item  IN PURCHASE REQ  NO. $purchasereqnumber ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="REQUISITION # <br>".$purchasereqnumber."<br> UPDATED ";exit;
?>