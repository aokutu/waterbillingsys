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


class newinsuarance
{
public $companyname=null;	
public $companyaddress=null;
public $phonenumber=null;
public $email=null;	

}
$newinsuarance=new newinsuarance;
$newinsuarance->companyname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['companyname']))));
$newinsuarance->companyaddress=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['companyaddress']))));
$newinsuarance->phonenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['phonenumber']))));
$newinsuarance->email=$connect->real_escape_string(trim(addslashes($_POST['email'])));

/**/	


$x=$connect ->query("SELECT ID FROM insuarances  WHERE  insuarance='$newinsuarance->companyname' ");
if(mysqli_num_rows($x)<1)
{
$connect ->query("INSERT INTO insuarances (INSUARANCE,BOXADDRESS,PHONENUMBER,EMAIL) 
VALUES('$newinsuarance->companyname','$newinsuarance->companyaddress','$newinsuarance->phonenumber','$newinsuarance->email') ");

$connect ->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'CREATED NEW   INSUARANCE  $newinsuarance->companyname ',DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");

$_SESSION['message']=$companyname."COMPANY CREATED <BR>";exit;

}
$_SESSION['message']=$newinsuarance->companyname." EXISTS <BR>";exit;
?>