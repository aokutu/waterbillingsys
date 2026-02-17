<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password2.php");

$x = $connect ->query("SELECT * FROM users  WHERE  NAME='$dbdetails->user' AND PASSWORD='$dbdetails->password' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

//include ("staffdetailsclass.php");
//print $_POST['staffname'];  
class damage {
   public $details=null;
   public $idnumber=null;
   public $name=null;
   public $amount=null;
}

$damage = new damage();
$damage->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['name']))));
$damage->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$damage->amount=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']))));
$damage->details=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['details']))));

$connect->query("INSERT INTO damages(IDNUMBER,NAME,TRANSACTION,AMOUNT,DATE) 
VALUES('$damage->idnumber','$damage->name','$damage->details','$damage->amount',now())");
$connect->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',now(),'$damage->details  $damage->amount TO $damage->name ID NUMBER $damage->idnumber ',now())");
header("LOCATION:miscellinious.php");exit;
?>