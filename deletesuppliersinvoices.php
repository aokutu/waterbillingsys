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


class deletesupplierpay 
{
public $deleteid=null;	
public $accessname=null;
public $accesspass=null;

}
$deletesupplierpay =new deletesupplierpay;
$deletesupplierpay->deleteid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['deleteid']))));
$deletesupplierpay->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$deletesupplierpay->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));
$_SESSION['message']=$deletesupplierpay->deleteid;exit;
$x = $connect ->query("SELECT * FROM users  WHERE  name='$deletesupplierpay->accessname' AND password='$deletesupplierpay->accesspass' ");
if(mysqli_num_rows($x)>0)
{
/*$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('DELETED  ',TRANSACTION,' PAYMENT WORTH ',AMOUNT,' REFF ',TRANSACTIONREFF,' FROM  ',COMPANY),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM cashflow WHERE  ID='$deletesupplierpay->deleteid'  ");*/
$connect ->query("DELETE  FROM stockin  WHERE SUPPLIER=(SELECT COMPANY FROM cashflow  WHERE ID='$deletesupplierpay->deleteid')   AND INVOICENUMBER=(SELECT TRANSACTIONREFF FROM cashflow  WHERE ID='$deletesupplierpay->deleteid') ");
$_SESSION['message']='INVOICE DELETED';exit;
}
else{
$_SESSION['message']="ACCESS  DENIED";exit;
}
?>