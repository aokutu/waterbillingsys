<?php 

@session_start();


include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'   AND  ACCESS  REGEXP  'BILL RATES'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:dashboard.php");exit;}


class newrates
{
public $size=null;
public $charges=null;
}
$newrates=new newrates;

@$newrates->size=$connect->real_escape_string(addslashes(strtoupper($_POST['size'])));

@$newrates->charges=$connect->real_escape_string(addslashes(strtoupper($_POST['charges'])));

$x=$connect->query("SELECT *  FROM  METERRATES WHERE SIZE ='$newrates->size'");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO METERRATES (SIZE,CHARGES) VALUES('$newrates->size','$newrates->charges')");
}

$connect->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',now(),'UPDATED THE  METER  CHARGES  FOR  METER SIZR $newrates->size',now())");
$_SESSION['message']="UPDATED METER SIZE".$newrates->size."<br> CHARGRS";exit;
?>