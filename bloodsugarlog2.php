<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="consultation";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class bloodsugardetails
{
public $datex=null;
public $timex=null;
public $bloodsugarlevel=null;
public $patientnumber=null; 
}
$bloodsugardetails = new bloodsugardetails;
$bloodsugardetails->datex=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date']))));
$bloodsugardetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));

$bloodsugardetails->timex=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['time']))));
$bloodsugardetails->bloodsugardetails=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bloodsugarlevel']))));

$connect ->query(" INSERT INTO bloodsugarrecord (PATIENTNUMBER,DATE,TIME,BLOODSUGARLEVEL) 
VALUES ('$bloodsugardetails->patientnumber','$bloodsugardetails->datex','$bloodsugardetails->timex','$bloodsugardetails->bloodsugardetails')");
$_SESSION['message']="POSTED"; 
?>