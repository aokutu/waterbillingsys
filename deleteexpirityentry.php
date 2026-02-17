<?php
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="PHAMARCY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class deleteitem
{
public $deleteid=null;
public $accessname=null;
public $accesspass=null;

}
$deleteitem = new deleteitem;
$deleteitem->deleteid=$connect->real_escape_string($_POST['deleteid']);
$deleteitem->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$deleteitem->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));


$connect ->query("UPDATE inventory AS TS,expirydates AS  TV SET TS.QUANTITY=TV.QUANTITY-TV.QUANTITY  WHERE TV.ID='$deleteitem->deleteid' AND TS.ITEM=TV.NAME; ");

$connect ->query(" DELETE FROM expirydates WHERE  ID ='$deleteitem->deleteid' ");
$_SESSION['message']="DELETED ";exit;
?>