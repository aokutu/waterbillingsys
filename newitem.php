<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class itemdetails 
{
	
public $item=null;
public $price=null;
public $coprateprice=null;
public $itemcategory=null;
public $units=null;

}


$itemdetails=new itemdetails;
$itemdetails->item=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['item']))));
$itemdetails->price=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['price']))));
$itemdetails->coprateprice=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['coprateprice']))));

$itemdetails->itemcategory=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['itemcategory']))));
$itemdetails->units=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['units']))));

$x = $connect ->query("SELECT ITEM  FROM  inventory WHERE  item='$itemdetails->item' ");
if(mysqli_num_rows($x)>0)
{header("LOCATION:pricelist.php"); exit;}

$x = $connect ->query("SELECT DETAILS   FROM  services WHERE  details='$itemdetails->item' ");
if(mysqli_num_rows($x)>0)
{header("LOCATION:pricelist.php"); exit;}

if($itemdetails->itemcategory=='ITEM')
{
$connect ->query("INSERT INTO inventory(ITEM,PRICE,COPRATEPRICE,UNITS) VALUES('$itemdetails->item','$itemdetails->price','$itemdetails->coprateprice','$itemdetails->units') ");
}

if($itemdetails->itemcategory=='SERVICE')
{
$connect ->query("INSERT INTO services(DETAILS,PRICE,COPRATEPRICE) VALUES('$itemdetails->item','$itemdetails->price','$itemdetails->coprateprice') ");
}

if($itemdetails->itemcategory=='IMAGING')
{
$connect ->query("INSERT INTO imagingservices(DETAILS,PRICE,COPRATEPRICE) VALUES('$itemdetails->item','$itemdetails->price','$itemdetails->coprateprice') ");
}

header("LOCATION:pricelist.php"); 
?>