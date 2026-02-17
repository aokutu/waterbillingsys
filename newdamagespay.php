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
class damages {
   public $id=null;
   public $idnumber=null;
   public $name=null;
   public $amount=null;
   public $amount2=null;

}

$damages = new damages();
$damages->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['staffname']))));
$damages->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$damages->amount=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']))));
$damages->amount2=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amount']*-1))));
$damages->id=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['id']))));
$connect->query("INSERT INTO advancedsalary(IDNUMBER,STAFFNAME,TRANSACTION,AMOUNT,DATE) 
VALUES('$damages->idnumber','$damages->name','ADVANCE DEBITED','$damages->amount2',now())");
$connect->query("INSERT INTO events(user,session,action,date) 
    VALUES('$dbdetails->user',now(),'DEBITED $damages->amount TO $damages->name AS AN  ADVANCED  PAY ',now())");
header("LOCATION:advancesalary.php");exit;
?>