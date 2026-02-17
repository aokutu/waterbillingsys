<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INSUARANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class deleteinsuarancepay 
{
public $deleteid=null;	
public $accessname=null;
public $accesspass=null;

}
$deleteinsuarancepay =new deleteinsuarancepay;
$deleteinsuarancepay->deleteid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['deleteid']))));
$deleteinsuarancepay->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$deleteinsuarancepay->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));

$x = $connect ->query("SELECT * FROM users  WHERE  name='$deleteinsuarancepay->accessname' AND password='$deleteinsuarancepay->accesspass' ");
if(mysqli_num_rows($x)>0)
{
$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('DELETED  ',TRANSACTION,' PAYMENT WORTH ',AMOUNT,' REFF ',TRANSACTIONREFF,' FROM  ',COMPANY),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM cashflow WHERE  ID='$deleteinsuarancepay->deleteid'  ");
$connect ->query("DELETE  FROM insuarancepayment  WHERE INSUARANCE=(SELECT COMPANY FROM cashflow  WHERE ID='$deleteinsuarancepay->deleteid')   AND PAYMENTREFF=(SELECT TRANSACTIONREFF FROM cashflow  WHERE ID='$deleteinsuarancepay->deleteid') ");
$_SESSION['message']='PAYMENT DELETED';exit;
}
else{
$_SESSION['message']="ACCESS  DENIED";exit;
}
?>