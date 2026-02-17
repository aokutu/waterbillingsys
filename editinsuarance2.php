<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INSUARANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class newsupplier
{
public $companyname=null;	
public $companyaddress=null;
public $phonenumber=null;
public $email=null;
public $insuaranceid=null;

}
$newsupplier=new newsupplier;
$newsupplier->companyname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['companyname']))));
$newsupplier->companyaddress=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['companyaddress']))));
$newsupplier->phonenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['phonenumber']))));
$newsupplier->email=$connect->real_escape_string(trim(addslashes($_POST['email'])));
$newsupplier->insuaranceid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['insuaranceid']))));

$connect ->query(" UPDATE invoicerecords SET INSUARANCE='$newsupplier->companyname' WHERE  INSUARANCE=(SELECT  INSUARANCE FROM insuarances WHERE ID='$newsupplier->insuaranceid') ");

$connect ->query(" UPDATE insuarancepayment SET INSUARANCE='$newsupplier->companyname' WHERE  INSUARANCE=(SELECT  INSUARANCE FROM insuarances WHERE ID='$newsupplier->insuaranceid') ");

$connect ->query(" UPDATE insuarances SET INSUARANCE='$newsupplier->companyname',BOXADDRESS='$newsupplier->companyaddress',PHONENUMBER='$newsupplier->phonenumber',EMAIL='$newsupplier->email' WHERE  ID='$newsupplier->insuaranceid' ");

$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'UPDATED   DETAILS  FOR  INSUARANCE  $newsupplier->companyname ',DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
header("LOCATION:insuarancerececompanies.php");exit;
?>