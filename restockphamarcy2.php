<?php
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INVENTORY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class invoicedetails
{
public $supplier=null;
public $invoicenumber=null;
public $date=null;
public $totalcharges=null;
}
$invoicedetails= new invoicedetails;
$invoicedetails->supplier=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['supplier']))));
$invoicedetails->invoicenumber=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['invoicenumber']))));
$invoicedetails->date=$connect->real_escape_string(trim(addslashes(strtoupper( $_POST['date']))));

class itemdetails
{
public $name=null;
public $price=null;
public $quantity=null;
public $batchnumber=null;
public $expiredate=null;
public $restockmode=null;
public $description=null;
}
$itemdetails=new itemdetails;
$itemdetails->restockmode = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['restockmode']))));
$itemdetails->description = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['description']))));

    $names = $_POST['item'];
    $prices = $_POST['unitprice'];
    $quantities = $_POST['quantity'];
	$batchnumbers = $_POST['batchnumber'];
	$expiredates = $_POST['expiredate'];

    // Check if all arrays have the same length
    if (count($names) === count($prices) && count($names) === count($quantities) && count($names) === count($batchnumbers) && count($names) === count($expiredates) ) {
        // Loop through each item
        for ($i = 0; $i < count($names); $i++) {
            $itemdetails->name = $connect->real_escape_string(trim(addslashes(strtoupper($names[$i]))));
             $itemdetails->price = $connect->real_escape_string(trim(addslashes(strtoupper($prices[$i]))));
             $itemdetails->quantity = $connect->real_escape_string(trim(addslashes(strtoupper($quantities[$i]))));
			 $itemdetails->batchnumber = $connect->real_escape_string(trim(addslashes(strtoupper($batchnumbers[$i]))));
			 $itemdetails->expiredate = $connect->real_escape_string(trim(addslashes(strtoupper($expiredates[$i]))));

if($itemdetails->restockmode=='NEW STOCK')
{
 $connect ->query("UPDATE inventory  TU, inventory TS  SET TU.QUANTITY=TS.QUANTITY+$itemdetails->quantity ,TU.BPRICE='$itemdetails->price'   WHERE TU.ITEM=TS.ITEM  AND  TU.ITEM='$itemdetails->name'");
$connect ->query(" UPDATE inventory SET QUANTITY ='0' WHERE ITEM ='$itemdetails->name' AND QUANTITY < '0'");
$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'RESTOCKED  $itemdetails->name QNTY $itemdetails->quantity ',DATE_ADD(NOW(), INTERVAL 10 HOUR))");



$connect ->query(" INSERT  INTO  stockin (ITEM,UNITS,QUANTITY,UNITPRICE,PRICE,INVOICENUMBER,SUPPLIER,DATE)
	 SELECT ITEM,UNITS,CONCAT('$itemdetails->quantity'),CONCAT('$itemdetails->price'),
	 CONCAT($itemdetails->price*$itemdetails->quantity),CONCAT('$invoicedetails->invoicenumber'),CONCAT('$invoicedetails->supplier'),
	 CONCAT('$invoicedetails->date')  FROM inventory WHERE ITEM ='$itemdetails->name' ");
$x= $connect ->query("SELECT ID  FROM expirydates  WHERE  NAME='$itemdetails->name' AND BATCH='$itemdetails->batchnumber' AND EXPIRE='$itemdetails->expiredate' ");
if(mysqli_num_rows($x)<1)
{
$connect ->query(" INSERT INTO expirydates (NAME, BATCH,QUANTITY, EXPIRE) VALUES ('$itemdetails->name', '$itemdetails->batchnumber','$itemdetails->quantity','$itemdetails->expiredate' ) ");
}

else if(mysqli_num_rows($x)>0)
{

$connect ->query("UPDATE expirydates  TU, expirydates TS  SET TU.QUANTITY=TS.QUANTITY+$itemdetails->quantity   WHERE TU.ID=TS.ID  AND  TU.NAME='$itemdetails->name' AND TU.BATCH='$itemdetails->batchnumber' AND TU.EXPIRE='$itemdetails->expiredate'");
	
}
	
}


else  if($itemdetails->restockmode=='INVENTORY ADJUSTMENT')
{
 $connect ->query("UPDATE inventory  TU, inventory TS  SET TU.QUANTITY=TS.QUANTITY+$itemdetails->quantity ,TU.BPRICE='$itemdetails->price'   WHERE TU.ITEM=TS.ITEM  AND  TU.ITEM='$itemdetails->name'");
$connect ->query(" UPDATE inventory SET QUANTITY ='0' WHERE ITEM ='$itemdetails->name' AND QUANTITY < '0'");
	$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'INVENTORY ADJUSTMENT  OF $itemdetails->name QNTY $itemdetails->quantity ',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
	 
$x= $connect ->query("SELECT ID  FROM expirydates  WHERE  NAME='$itemdetails->name' AND BATCH='$itemdetails->batchnumber' AND EXPIRE='$itemdetails->expiredate' ");
if(mysqli_num_rows($x)<1)
{
$connect ->query(" INSERT INTO expirydates (NAME, BATCH,QUANTITY, EXPIRE) VALUES ('$itemdetails->name', '$itemdetails->batchnumber','$itemdetails->quantity','$itemdetails->expiredate' ) ");
}

else if(mysqli_num_rows($x)>0)
{

$connect ->query("UPDATE expirydates  TU, expirydates TS  SET TU.QUANTITY=TS.QUANTITY+$itemdetails->quantity   WHERE TU.ID=TS.ID  AND  TU.NAME='$itemdetails->name' AND TU.BATCH='$itemdetails->batchnumber' AND TU.EXPIRE='$itemdetails->expiredate'");
	
}	 
	 $_SESSION['message']=$itemdetails->item."<br> STOCK ADJUSTED <br> SUCCESSFULLY ";//exit;
	 	
}
else  if($itemdetails->restockmode=='RECORD ADJUSTMENT')
{
	$connect ->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'RECORDS ADJUSTMENT  OF $itemdetails->name QNTY $itemdetails->quantity ',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
	$connect ->query(" INSERT INTO adjustment (ITEM,QUANTITY,DESCRIPTION,DATE)  VALUES('$itemdetails->name','$itemdetails->quantity','$itemdetails->description',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
	 $_SESSION['message']=$itemdetails->item."<br> STOCK ADJUSTED <br> SUCCESSFULLY ";//exit;
	
	
}


	
$_SESSION['message']=" STOCK ADJUSTED <br> SUCCESSFULLY "; 	 
        }
    } else {
$_SESSION['message']=" STOCK ADJUSTED <br> FAILED "; exit;	 
    }
?>