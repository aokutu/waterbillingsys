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


class updateservices 
{
public $id=null;
public $service=null;
public $price=null;
public $coprateprice=null;
}

$updateservices=new updateservices;
$updateservices->id=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['id']))));
$updateservices->service=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['service']))));
$updateservices->price=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['price']))));
$updateservices->coprateprice=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['coprateprice']))));

$connect->query("INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'UPDATE $updateservices->service PRICE TO $updateservices->price',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$connect->query("UPDATE services  SET  DETAILS='$updateservices->service' ,PRICE='$updateservices->price',COPRATEPRICE='$updateservices->coprateprice' WHERE ID=$updateservices->id ");
header("LOCATION:pricelist.php");

?>