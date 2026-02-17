<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password2.php");
class receipt 
{
public $receiptnumber=null;	
public $accessname=null;
public $accesspass=null;
}

$receipt =new receipt;
$receipt->receiptnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['receiptnumber']))));
$receipt->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$receipt->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));
$x = $connect ->query("SELECT * FROM users  WHERE  name='$receipt->accessname' AND password='$receipt->accesspass' AND ACCESS REGEXP 'DELETE RECEIPT' ");
if(mysqli_num_rows($x)>0)
{
	
$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),CONCAT('DELETED RECEIPT NUMBER   $receipt->receiptnumber APPROVED BY $receipt->accessname '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$connect ->query("DELETE  FROM  receiptrecords  WHERE RECEIPTNUMBER='$receipt->receiptnumber' ");
$connect ->query("DELETE  FROM  receiptsdetails  WHERE RECEIPTNUMBER='$receipt->receiptnumber' ");
$_SESSION['message']='RECEIPT DELETED';exit;

}
else{ $_SESSION['message']="ACCESS  DENIED";exit;}  


?>