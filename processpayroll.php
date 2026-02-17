<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class processpayroll
{
public $month=null;
public $staffid=null;

}
$processpayroll=new processpayroll;
$processpayroll->month=$connect->real_escape_string($_POST['month']);
$processpayroll->staffid=$_POST['staffid'];

foreach ($processpayroll->staffid as $data) {
    # code...
    $connect ->query("INSERT INTO PAYROLL (IDNUMBER,NAMES,MONTH,POSTINGDATE,BASICSALARY,HOUSEALLOWANCE,TRAVELALLOWANCE,HARDSHIPALLOWANCE,PAYEE,NHIF,NSSF)
    SELECT IDNUMBER,NAMES,CONCAT('$processpayroll->month'),CURRENT_DATE,BASICSALARY,HOUSEALLOWANCE,TRAVELALLOWANCE,HARDSHIPALLOWANCE,PAYEE,NHIF,NSSF  FROM STAFFS WHERE ID ='$data'
    ");
$connect->query("INSERT INTO events(user,session,action,date) 
    SELECT CONCAT('$dbdetails->user'),CURRENT_TIMESTAMP,CONCAT('POSTED $processpayroll->month  SALARY  TO ',NAMES),CURRENT_DATE FROM STAFFS  WHERE ID ='$data' ");
    
}
$_SESSION['message']=$processpayroll->month." SALARY   POSTED";exit;
?>