<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'FINANCE'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class deleteitem 
{
public $id=null;		
}

$deleteitem=new deleteitem;
$deleteitem->id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['deleteitemid']))));


$connect ->query("UPDATE inventory AS TS,pendingsales AS  TV SET TS.QUANTITY=TS.QUANTITY+TV.QUANTITY  WHERE TS.ITEM=TV.DETAILS  AND TV.ID=$deleteitem->id; ");
$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),CURRENT_TIMESTAMP,CONCAT('RETURNED TO SHELF ',QUANTITY,' ',DETAILS,' FROM PENDING BILL'),CURRENT_DATE FROM pendingsales WHERE ID=$deleteitem->id ");
$connect ->query("DELETE FROM pendingsales WHERE ID=$deleteitem->id");
header("LOCATION:crosscounterdrugdispence.php");exit;
?>