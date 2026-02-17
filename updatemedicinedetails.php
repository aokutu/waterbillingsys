<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->password=$_SESSION['password'];
$dbdetails->user=$_SESSION['user'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'FINANCE'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class updatemedicine 
{
public $id=null;
public $item=null;
public $price=null;
public $coprateprice=null;
}

$updatemedicine=new updatemedicine;
$updatemedicine->id=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['id']))));
$updatemedicine->item=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['item']))));
$updatemedicine->coprateprice=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['coprateprice']))));
$updatemedicine->price=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['price']))));


$connect->query("INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'UPDATE $updatemedicine->item PRICE TO $updateservices->price',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$connect->query("UPDATE inventory  SET  ITEM='$updatemedicine->item' ,PRICE='$updatemedicine->price',COPRATEPRICE='$updatemedicine->coprateprice' WHERE ID=$updatemedicine->id ");
header("LOCATION:pricelist.php");

?>