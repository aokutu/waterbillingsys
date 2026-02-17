<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="ADMIN";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class itemdetails 
{
	
public $item=null;
public $price=null;
public $itemcategory=null;

}

$itemdetails=new itemdetails;
$itemdetails->item=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['item']))));
$itemdetails->price=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['price']))));
$itemdetails->itemcategory=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['itemcategory']))));

if($itemdetails->itemcategory=='ITEM')
{
$x = $connect ->query("SELECT  ITEM FROM INVENTORY WHERE ITEM='$itemdetails->item'  ");
if(mysqli_num_rows($x)<1)
{
$connect ->query("INSERT INTO INVENTORY(ITEM,PRICE) VALUES('$itemdetails->item',$itemdetails->price)  ");	
$connect ->query("INSERT INTO EVENTS(user,session,action,date) VALUES('$dbdetails->user',NOW(),CONCAT($itemdetails->item,' PRICE SET'),NOW())  ");	
	
}
	
}

if($itemdetails->itemcategory=='SERVICE')
{
$x = $connect ->query("SELECT  DETAILS FROM SERVICES WHERE DETAILS='$itemdetails->item'  ");
if(mysqli_num_rows($x)<1)
{
$connect ->query("INSERT INTO SERVICES(DETAILS,PRICE) VALUES('$itemdetails->item',$itemdetails->price)  ");	
$connect ->query("INSERT INTO EVENTS(user,session,action,date) VALUES('$dbdetails->user',NOW(),CONCAT($itemdetails->item,' PRICE SET'),NOW())  ");	
	
}
	
}
$_SESSION['message']=$itemdetails->item." UPDATED";
?>