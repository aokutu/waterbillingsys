<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  



class gaenacology 
{
	
public $patientnumber=null;
public $lmb=null;
public $gravida=null;
public $para=null;
public $contraceptive=null;

}

$gaenacology=new gaenacology;

$gaenacology->lmb=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['lmb']))));

$gaenacology->patientnumber=$_SESSION['patientnumber'];
$gaenacology->gravida=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['gravida']))));
$gaenacology->para=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['para']))));
$gaenacology->contraceptive=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['contraceptive']))));
$connect ->query("INSERT INTO gaenocology(PATIENTNUMBER,GRAVIDA,PARA,CONTRACEPTIVE,ATTENDANT,DATE) VALUES('$gaenacology->patientnumber','$gaenacology->gravida','$gaenacology->para','$gaenacology->contraceptive','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$connect ->query("INSERT INTO events(USER,SESSION,ACTION,DATE) VALUES('$dbdetails->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('UPDATED  GAENOCOLOGY  HISTORY OF PATIENT   MUMBER $gaenacology->patientnumber '),DATE_ADD(NOW(), INTERVAL 10 HOUR)) ");
$_SESSION['message']='OBSTETRICS/GYNECOLOGICAL HISTORY  UPDATED'.$gaenacology->patientnumber;
?>
