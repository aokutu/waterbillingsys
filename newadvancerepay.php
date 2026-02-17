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

print "ll";
//include ("staffdetailsclass.php");
//print $_POST['staffname'];  
class advance {
   public $id=null;
   public $idnumber=null;
   public $name=null;
   public $amount=null;
   public $amount2=null;

}

$advance = new advance();
$advance->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['staffname']))));
$advance->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$advance->amount=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']))));
$advance->amount2=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']*-1))));
$advance->id=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['id']))));
$connect->query("INSERT INTO advancedsalary(IDNUMBER,STAFFNAME,TRANSACTION,AMOUNT,DATE) 
VALUES('$advance->idnumber','$advance->name','ADVANCE DEBITED','$advance->amount2',now())");
$connect->query("INSERT INTO events(user,session,action,date) 
    VALUES('$dbdetails->user',now(),'DEBITED $advance->amount TO $advance->name AS AN  ADVANCED  PAY ',now())");
header("LOCATION:advancesalary.php");exit;
?>