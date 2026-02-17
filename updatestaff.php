<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password2.php");
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

include ("staffdetailsclass.php");

$updatestaffdetails=  new staffdetails;
$updatestaffdetails->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$updatestaffdetails->krapin=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['krapin']))));
$updatestaffdetails->title=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['title']))));
$updatestaffdetails->names=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['names']))));
$updatestaffdetails->basicsalary=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['basicsalary']))));
$updatestaffdetails->houseallowance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['houseallowance']))));
$updatestaffdetails->travellallowance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['travellallowance']))));
$updatestaffdetails->hardshipallowance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['hardshipallowance']))));
$updatestaffdetails->payee=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['payee']))));
$updatestaffdetails->nhif=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nhif']))));
$updatestaffdetails->nssf=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nssf']))));
$updatestaffdetails->staffid=$connect->real_escape_string($_POST['staffid']);


$connect->query(" UPDATE STAFFS  SET  IDNUMBER='$updatestaffdetails->idnumber', KRAPIN='$updatestaffdetails->krapin',TITLE='$updatestaffdetails->title',NAMES ='$updatestaffdetails->names',BASICSALARY ='$updatestaffdetails->basicsalary' ,HOUSEALLOWANCE ='$updatestaffdetails->houseallowance',
HARDSHIPALLOWANCE ='$updatestaffdetails->hardshipallowance',TRAVELALLOWANCE='$updatestaffdetails->travellallowance',PAYEE='$updatestaffdetails->payee',NHIF='$updatestaffdetails->nhif',NSSF='$updatestaffdetails->nssf' WHERE  ID ='$updatestaffdetails->staffid' ");
$connect->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',now(),'UPDATED STAFF DETAILS OF $updatestaffdetails->names ',now())");

header("LOCATION:staffsregistry.php");

?>