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


class fluidsintake
{
public $datetime=null;
public $bodyweight=null;
public $instruction=null;
public $systolicbp=null;
public $fluidtype=null;
public $intravenousintake=null;
public $oralintake=null;
public $totalintake=null;
public $patientnumber=null;
public function total()
{
$this->totalintake=$this->intravenousintake+$this->oralintake;
}
}
$fluidsintake =new fluidsintake;
$fluidsintake->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$fluidsintake->datetime=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['datetime']))));
$fluidsintake->bodyweight=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bodyweight']))));
$fluidsintake->instruction=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['instruction']))));
$fluidsintake->systolicbp=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['systolicbp']))));
$fluidsintake->fluidtype=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['fluidtype']))));
$fluidsintake->intravenousintake=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['intravenousintake']))));
$fluidsintake->oralintake=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['oralintake']))));
$fluidsintake->total();
$connect ->query("INSERT INTO fluidsintakerecord (PATIENTNUMBER, DATETIME, BODYWEIGHT, INSTRUCTION, SYSTOLICBP, FLUIDTYPE, 
INTRAVENOUSINTAKE, ORALINTAKE, TOTALINTAKE, ATTENDANT) 
VALUES ('$fluidsintake->patientnumber', '$fluidsintake->datetime', '$fluidsintake->bodyweight', '$fluidsintake->instruction', 
'$fluidsintake->systolicbp', '$fluidsintake->fluidtype', '$fluidsintake->intravenousintake', '$fluidsintake->oralintake', '$fluidsintake->totalintake', '$dbdetails->user')");
$connect->query(" INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR),'POSTED FLUIDS INTAKE  ON PATEINT  $fluidsintake->patientnumber ',DATE_ADD(NOW(), INTERVAL 10 HOUR))");

$_SESSION['message']=$fluidsintake->totalintake."POSTED";

?>