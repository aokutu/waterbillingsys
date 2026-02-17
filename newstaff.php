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
$staffname=$_POST['staffname']; 
$deleteidnumber=$_GET['idnumber'];
class staff {
   public $name=null;
   public $idnumber=null;
   public $deleteidnumber=null;

}

$staff = new staff();
$staff->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['staffname']))));
$staff->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$staff->deleteidnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['deleteidnumber']))));

$connect->query("INSERT INTO events(user) 
SELECT CONCAT('$dbdetails->user') FROM staffs WHERE  IDNUMBER='$staff->deleteidnumber'");

/*
$newstaffdetails=  new staffdetails;
$newstaffdetails->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$newstaffdetails->names=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['names']))));
/*$newstaffdetails->krapin=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['krapin']))));
$newstaffdetails->title=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['title']))));

$newstaffdetails->basicsalary=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['basicsalary']))));
$newstaffdetails->houseallowance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['houseallowance']))));
$newstaffdetails->travellallowance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['travellallowance']))));
$newstaffdetails->hardshipallowance=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['hardshipallowance']))));
$newstaffdetails->payee=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['payee']))));
$newstaffdetails->nhif=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nhif']))));
$newstaffdetails->nssf=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nssf'])))); */
if ($staff->idnumber !=null )
{
$x = $connect ->query("SELECT * FROM staffs   WHERE  IDNUMBER='$staff->idnumber'  ");
if(mysqli_num_rows($x)>0)
{$_SESSION['message']="STAFF ".$staff->name." EXISTS";exit;}
else{}

$connect->query("INSERT INTO staffs(idnumber,name) 
VALUES('$staff->idnumber','$staff->name')");

$connect->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',now(),'CREATED NEW  STAFF $staff->name ',now())");

$_SESSION['message']="STAFF ".$staff->name." CREATED ";//header("LOCATION:staffsregistry.php");exit;    
    
    
}

?>