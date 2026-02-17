<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$requisitioner=$_POST['requisitioner'];$_SESSION['requisitioner']=$requisitioner;
$action=$_POST['action'];
@$purpose=trim(addslashes(strtoupper($_POST['purpose'])));
@$requisitioner=trim(addslashes(strtoupper($_POST['requisitioner'])));
@$requisitionertitle=trim(addslashes(strtoupper($_POST['requisitionertitle'])));
@$authorizer=trim(addslashes(strtoupper($_POST['authorizer'])));
@$authorizertitle=trim(addslashes(strtoupper($_POST['authorizertitle'])));
@$approver=trim(addslashes(strtoupper($_POST['approver'])));
@$approvertitle=trim(addslashes(strtoupper($_POST['approvertitle'])));
@$refference=$_POST['refference'];
@$issuer=trim(addslashes(strtoupper($_POST['issuer'])));
@$issuertitle=trim(addslashes(strtoupper($_POST['issuertitle'])));
@$id=$_POST['id'];

if ($action=='DELETE')
{
foreach ($id as $data)
{

$x="DELETE  FROM  REQUISITION WHERE  ID='$data'";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}
$_SESSION['message']=" REQUISITION <br>REQUEST DELETED ";exit;	
}

if ($action=='GENERATEISSUENOTE')
{

$x="SELECT IFNULL(MAX(SERIALNUMBER)+1,1) AS ISSUENUMBER   FROM REQUISITION   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['storeissuenotenumber']=$y['ISSUENUMBER'];      $issuenotenumber=$y['ISSUENUMBER'];}}
	
foreach ($id as $data)
{



$x="UPDATE  REQUISITION  SET SERIALNUMBER ='$issuenotenumber' ,PURPOSE='$purpose',REQUISITIONER='$requisitioner' ,REQUISITIONERTITLE='$requisitionertitle',AUTHORIZER='$authorizer',
AUTHORIZERTITLE='$authorizertitle',ISSUER='$issuer',ISSUERTITLE='$issuertitle',APPROVER='$approver',APPROVERTITLE='$approvertitle',STATUS='APPROVED' WHERE  ID='$data'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

	
}
$_SESSION['message']=" REQUISITION <br>REQUEST DELETED ";
header("LOCATION:generateissuenote.php");
exit;	
}

if ($action=='DISPATCH')
{ 

foreach($id as $key =>$data)
{
	if($data <=0){unset($id[$key]);}
	
}

$transactionreff=str_pad(date('ymd').rand(0,9999), 10, "0", STR_PAD_RIGHT);
foreach ($id as $data)
{	
$x="SELECT ITEM FROM INVENTORY  WHERE ITEM =(SELECT ITEM FROM REQUISITION WHERE ID ='$data') AND QUANTITY <(SELECT QUANTITY FROM REQUISITION WHERE ID ='$data')    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$item=$y['ITEM'];}	
		$_SESSION['message']=" INSUFICIENT STOCK ON <br> $item ";exit; 
}
}


foreach ($id as $data)
{	
	
$x="UPDATE INVENTORY  TU, REQUISITION TS  SET TU.QUANTITY=TU.QUANTITY-TS.QUANTITY,TS.TRANSACTIONREFF='$transactionreff' WHERE TU.ITEM=TS.ITEM  AND TS.ID='$data'";
mysqli_query($connect,$x)or die(mysqli_error($connect));


}
foreach($id as $data)
{
$x="INSERT  INTO STOCKOUT(ITEM,UNITS,QUANTITY,TRANSACTIONREFF,REQUISITIONER,PURPOSE,DATE)  
SELECT ITEM,UNITS,QUANTITY,SERIALNUMBER,REQUISITIONER,PURPOSE,CURRENT_DATE FROM REQUISITION WHERE ID='$data' AND STATUS ='APPROVED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('DISPATCHED ',QUANTITY,' ',ITEM,'TRANSACTION REFF  $transactionreff'),CURRENT_DATE FROM REQUISITION WHERE  ID='$data' AND STATUS='ISSUED'";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}

foreach ($id as $data)
{	
	
$x="UPDATE REQUISITION SET STATUS='ISSUED' ,TRANSACTIONREFF='$transactionreff' WHERE ID='$data'";mysqli_query($connect,$x)or die(mysqli_error($connect));

}

$_SESSION['message']=" ITEMS  DISPATCHED <br> TR NO $transactionreff  ";exit;	
}

$_SESSION['message']=" UPDATED  ";exit;


?>