<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INVENTORY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class deleteinvoiceitem 
{
public $deleteid=null;	
public $accessname=null;
public $accesspass=null;

}
$deleteinvoiceitem =new deleteinvoiceitem;
$deleteinvoiceitem->deleteid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['deleteid']))));
$deleteinvoiceitem->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$deleteinvoiceitem->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));
$_SESSION['message']=$deleteinvoiceitem->deleteid;

$x = $connect ->query("SELECT * FROM users  WHERE  name='$deleteinvoiceitem->accessname' AND password='$deleteinvoiceitem->accesspass' ");
if(mysqli_num_rows($x)>0)
{
$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('DELETED  ',ITEM,' FROM  SUPPLIER ',SUPPLIER,' INVOICE NUMBER ',INVOICENUMBER),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM stockin WHERE  ID='$deleteinvoiceitem->deleteid'  ");
$connect ->query("UPDATE inventory  TU, inventory TS  SET TU.QUANTITY=TS.QUANTITY-(SELECT QUANTITY FROM stockin WHERE  ID='$deleteinvoiceitem->deleteid' ) WHERE TU.ITEM=TS.ITEM  AND  TU.ITEM=(SELECT ITEM FROM stockin WHERE  ID='$deleteinvoiceitem->deleteid' )");
$connect ->query("DELETE  FROM stockin WHERE  ID='$deleteinvoiceitem->deleteid' ");
$_SESSION['message']='PAYMENT DELETED';exit;
}
else{
$_SESSION['message']="ACCESS  DENIED";exit;
} 
?>