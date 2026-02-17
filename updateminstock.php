<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INVENTORY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class updateminstock
{
public $updateitem=null;
public $stocklevel=null;
}
$updateminstock=new updateminstock;
$updateminstock->updateitem=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['updateitem']))));
$updateminstock->stocklevel=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['stocklevel']))));
$connect ->query("UPDATE inventory SET MINSTOCKLEVEL='$updateminstock->stocklevel' WHERE ITEM='$updateminstock->updateitem' ");
$_SESSION['message']='STOCK  LEVEL UPDATED';exit;
?>