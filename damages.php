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
   public $idnumber=null;
   public $name=null;
   public $amount=null;
    public $amount2=null;
}

$damage = new damage();
$damage->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['name']))));
$damage->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$damage->amount=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']))));
$damage->amount2=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']*-1))));

$connect->query("INSERT INTO damages(IDNUMBER,NAME,TRANSACTION,AMOUNT,DATE) 
VALUES('$damage->idnumber','$damage->name','PAYMENT','$damage->amount2',now())");
$connect->query("INSERT INTO events(user,session,action,date) 
VALUES('$dbdetails->user',now(),'DAMAGES REPAYMENT  $damage->amount TO $damage->name ID NUMBER $damage->idnumber ',now())");
header("LOCATION:miscellinious.php");exit;
?>