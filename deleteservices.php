<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class deleteservices 
{
public $details=null;
public $item=null;
public function check()
{
if (($this->details=='CONSULTATION') OR ($this->details=='BED CHARGES') OR ($this->details=='COMPLETE BLOOD COUNT')  OR ($this->details=='URINE ANALYSIS') )
{
header("LOCATION:pricelist.php");exit;
}
}	
}

$deleteservices =new deleteservices;
$deleteservices->details=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['details']))));
$deleteservices->item=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['item']))));
$deleteservices->check();

$connect->query("DELETE FROM services WHERE DETAILS='$deleteservices->details'  ");
$connect->query("DELETE FROM inventory WHERE ITEM='$deleteservices->item' ");
header("LOCATION:pricelist.php");exit;

?>






