<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INVENTORY";
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
public $supplierid=null;

}
$newsupplier=new newsupplier;
$newsupplier->companyname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['companyname']))));
$newsupplier->companyaddress=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['companyaddress']))));
$newsupplier->phonenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['phonenumber']))));
$newsupplier->email=$connect->real_escape_string(trim(addslashes($_POST['email'])));
$newsupplier->supplierid=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['supplierid']))));


$connect ->query(" UPDATE stockin SET SUPPLIER='$newsupplier->companyname' WHERE  SUPPLIER=(SELECT SUPPLIER FROM suppliers WHERE ID='$newsupplier->supplierid') ");
$connect ->query(" UPDATE supplierpayment SET SUPPLIER='$newsupplier->companyname' WHERE  SUPPLIER=(SELECT SUPPLIER FROM suppliers WHERE ID='$newsupplier->supplierid') ");
$connect ->query(" UPDATE suppliers SET SUPPLIER='$newsupplier->companyname',BOXADDRESS='$newsupplier->companyaddress',PHONENUMBER='$newsupplier->phonenumber',EMAIL='$newsupplier->email' WHERE  ID='$newsupplier->supplierid' ");
$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'UPDATED   DETAILS  FOR  SUPPLIER  $newsupplier->companyname ',DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");

header("LOCATION:suppliers.php");exit;
?>