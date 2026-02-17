<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND ACCESS  REGEXP  'GATE PASS'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$item=$_POST['item']; $item=trim(strtoupper(addslashes($item)));
@$serialnumber=trim(strtoupper(addslashes($_POST['serialnumber'])));
$_SESSION['gatepassnumber']=$serialnumber;

@$issuer=$_POST['issuer'];  $issuer=trim(strtoupper(addslashes($issuer)));$_SESSION['issuer']=$issuer;
@$receiver=$_POST['receiver'];  $receiver=trim(strtoupper(addslashes($receiver)));$_SESSION['receiver']=$receiver;
@$transporter=$_POST['transporter'];  $transporter=trim(strtoupper(addslashes($transporter)));$_SESSION['transporter']=$transporter;
@$vehicle=$_POST['vehicle'];  $vehicle=trim(strtoupper(addslashes($vehicle)));$_SESSION['vehicle']=$vehicle;

@$issuertitle=$_POST['issuertitle'];  $issuertitle=trim(strtoupper(addslashes($issuertitle)));$_SESSION['issuertitle']=$issuertitle;
@$receivertitle=$_POST['receivertitle'];  $receivertitle=trim(strtoupper(addslashes($receivertitle)));$_SESSION['receivertitle']=$receivertitle;
@$transportertitle=$_POST['transportertitle'];  $transportertitle=trim(strtoupper(addslashes($transportertitle)));$_SESSION['transportertitle']=$transportertitle;
@$vehiclenumber=$_POST['vehiclenumber'];  $vehiclenumber=trim(strtoupper(addslashes($vehiclenumber)));$_SESSION['vehiclenumber']=$vehiclenumber;

@$pointofuse=trim(strtoupper(addslashes($_POST['pointofuse'])));
@$quantity=trim(strtoupper(addslashes($_POST['quantity'])));	

$x="INSERT INTO GATEPASS(SERIALNUMBER,ITEM,QUANTITY,UNITS,ISSUER,ISSUERTITLE,RECEIVER,RECEIVERTITLE,TRANSPORTER,TRANSPORTERTITLE,VEHICLE,VEHICLENUMBER,POINTOFUSE, DATE)
   SELECT CONCAT('$serialnumber'),ITEM,CONCAT('$quantity'),UNITS,CONCAT('$issuer'),CONCAT('$issuertitle'),CONCAT('$receiver'),CONCAT('$receivertitle'),CONCAT('$transporter'),CONCAT('$transportertitle'),CONCAT('$vehicle'),CONCAT('$vehiclenumber'),CONCAT('$pointofuse'),CURRENT_DATE FROM INVENTORY WHERE ITEM='$item' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	
$x="SELECT  ITEM  FROM  INVENTORY  WHERE ITEM ='$item'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1 )
{
$x="INSERT INTO GATEPASS(SERIALNUMBER,ITEM,QUANTITY,ISSUER,ISSUERTITLE,RECEIVER,RECEIVERTITLE,TRANSPORTER,TRANSPORTERTITLE,VEHICLE,VEHICLENUMBER,POINTOFUSE, DATE)
   SELECT CONCAT('$serialnumber'),CONCAT('$item'),CONCAT('$quantity'),CONCAT('$issuer'),CONCAT('$issuertitle'),CONCAT('$receiver'),CONCAT('$receivertitle'),CONCAT('$transporter'),CONCAT('$transportertitle'),CONCAT('$vehicle'),CONCAT('$vehiclenumber'),CONCAT('$pointofuse'),CURRENT_DATE ";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
	
}

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'GENERATED GATE PASS SERIAL NUMBER $serialnumber',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['oldserialnumber']=$serialnumber;


$_SESSION['message']="GATE PASS  # <br>".$serialnumber."<br> GENERATED ";
$x="SELECT IFNULL(MAX(SERIALNUMBER)+1,1)  AS SERIALNUMBER   FROM GATEPASS  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['serialnumber']=strtoupper(str_pad($y['SERIALNUMBER'], 10, "0", STR_PAD_LEFT));
	
	
	}}

	header("LOCATION:viewgatepass.php");
?>