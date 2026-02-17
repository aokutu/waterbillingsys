<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$purpose=trim(strtoupper(addslashes($_POST['purpose'])));$_SESSION['purpose']=$purpose;
@$requisitioner=trim(strtoupper(addslashes($_POST['requisitioner'])));$_SESSION['requisitioner']=$requisitioner;
@$requisitionertitle=trim(strtoupper(addslashes($_POST['requisitionertitle'])));$_SESSION['requisitionertitle']=$requisitionertitle;
@$item=trim(strtoupper(addslashes($_POST['item'])));
@$quantity=trim(strtoupper(addslashes($_POST['quantity'])));
@$authorizer=trim(strtoupper(addslashes($_POST['authorizer'])));$_SESSION['authorizer']=$authorizer; 
@$authorizertitle=trim(strtoupper(addslashes($_POST['authorizertitle'])));$_SESSION['authorizertitle']=$authorizertitle;
$issuenotenumber=$_SESSION['issuenotenumber'];
@$issuer=trim(addslashes(strtoupper($_POST['issuer'])));$_SESSION['issuer']=$issuer;
@$issuertitle=trim(addslashes(strtoupper($_POST['issuertitle'])));$_SESSION['issuertitle']=$issuertitle;
@$approver=trim(addslashes(strtoupper($_POST['approver'])));$_SESSION['approver']=$approver;
@$approvertitle=trim(addslashes(strtoupper($_POST['approvertitle'])));$_SESSION['approvertitle']=$approvertitle;
@$serialnumber=trim(addslashes(strtoupper($_POST['serialnumber']))); 


	$x="SELECT STATUS,SERIALNUMBER   FROM REQUISITION  WHERE SERIALNUMBER='$serialnumber' AND STATUS !='APPROVED' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
			 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['message']='ISSUE NOTE <br># '.$serialnumber." ".$y['STATUS']." ";exit; }}

$x="SELECT ITEM   FROM  INVENTORY  WHERE ITEM ='$item'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)< 1 )
		{  $_SESSION['message']=$item."<br> MISSING ";exit;}
	
$x="SELECT ITEM   FROM  INVENTORY  WHERE ITEM ='$item' AND QUANTITY < '$quantity' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{  $_SESSION['message']=$item."<br>INSUFFICIENT STOCK";exit;}

/*$x="SELECT ITEM   FROM   INVENTORY WHERE QUANTITY <(SELECT SUM(QUANTITY)   FROM REQUISITION  WHERE ITEM ='$item' AND STATUS ='APPROVED')  AND ITEM='$item' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{$_SESSION['message']=$item."<br>INSUFFICIENT STOCK";exit;}*/
		
	
$x="INSERT  INTO REQUISITION (VALUE,ITEMCODE,SERIALNUMBER,ITEM,UNITS,QUANTITY,REQUISITIONER,REQUISITIONERTITLE,AUTHORIZER,AUTHORIZERTITLE,ISSUER,ISSUERTITLE,APPROVER,APPROVERTITLE,PURPOSE,STATUS,DATE) 
SELECT BPRICE,ITEMCODE,CONCAT('$issuenotenumber'),ITEM,UNITS,CONCAT('$quantity'),CONCAT('$requisitioner'),CONCAT('$requisitionertitle'),CONCAT('$authorizer'),CONCAT('$authorizertitle'),CONCAT('$issuer'),CONCAT('$issuertitle'),CONCAT('$approver'),CONCAT('$approvertitle'),CONCAT('$purpose'),CONCAT('APPROVED'),CURRENT_DATE FROM INVENTORY WHERE   ITEM ='$item' AND QUANTITY >='$quantity'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT ITEM   FROM  INVENTORY  WHERE ITEM ='$item'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ }
else {
$x="INSERT  INTO REQUISITION (SERIALNUMBER,ITEM,QUANTITY,REQUISITIONER,REQUISITIONERTITLE,AUTHORIZER,AUTHORIZERTITLE,ISSUER,ISSUERTITLE,APPROVER,APPROVERTITLE,PURPOSE,STATUS,DATE)
VALUES('$issuenotenumber','$item','$quantity','$requisitioner','$requisitionertitle','$authorizer','$authorizertitle','$issuer','$issuertitle','$approver','$approvertitle','$purpose','APPROVED',now()) ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
	




$issuenotenumber=strtoupper(str_pad($issuenotenumber, 11, "0", STR_PAD_LEFT));
$_SESSION['issuenotenumber']=$issuenotenumber;
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ISSUED $quantity   $item ISSUE NOTE NO $issuenotenumber',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']=$item."<br> REQUISITION POSTED ";exit;

?>
