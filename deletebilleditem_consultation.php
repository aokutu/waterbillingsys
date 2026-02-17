<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query(" SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class deleteitem 
{
public $id=null;		
}

$deleteitem=new deleteitem;
$deleteitem->id=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['itemid']))));


$connect ->query("UPDATE inventory AS TS,pendingsales AS  TV SET TS.QUANTITY=TS.QUANTITY+TV.QUANTITY  WHERE TS.ITEM=TV.DETAILS  AND TV.ID=$deleteitem->id; ");


$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('RETURNED TO SHELF ',QUANTITY,' ',DETAILS,' FROM PENDING BILL'),DATE_ADD(NOW(), INTERVAL 10 HOUR) FROM pendingsales WHERE ID=$deleteitem->id ");
$connect ->query("DELETE FROM pendingsales WHERE   ID=$deleteitem->id  ");
$_SESSION['message']="DELETED";
//header("LOCATION:consultation.php");exit; 
?>