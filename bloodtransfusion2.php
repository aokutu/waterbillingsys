<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class bloodtransfusion
{
public $patietnumber=null;
public $age=null;
public $gender =null;
public $diagnosis =null;
public $transfusiondatetime =null;
public $transfusedbloodtype =null;
public $bloodunitdonornumber=null;
public $counterchecker=null;
public $startedby=null;
public $starttime=null;
public $transfusionrate=null;
////////ARRAYS
public $minutes=null;
public $time=null;
public $bloodpressure=null;
public $bodytempreture=null;
public $pr=null;
public $rr=null;
public $remarks=null;
////////////////////////
public $transfusionendtime=null;
public $amounttransfused=null;
public $general=null;
public $dermatological=null;
public $renal=null;
public $cardiac=null;
public $othercomplications=null;


public $unexplainedbleeding=null;
public $date=null;
public $intervention=null;
public $trackkey=null;
}
$bloodtransfusion =new bloodtransfusion;
$bloodtransfusion->patietnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$bloodtransfusion->diagnosis=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['diagnosis']))));
$bloodtransfusion->transfusiondatetime=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['transfusiondatetime']))));
$bloodtransfusion->transfusedbloodtype=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['transfusedbloodtype']))));
$bloodtransfusion->bloodunitdonornumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bloodunitdonornumber']))));

$bloodtransfusion->counterchecker=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['counterchecker']))));
$bloodtransfusion->startedby=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['startedby']))));
$bloodtransfusion->starttime=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['starttime']))));
$bloodtransfusion->transfusionrate=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['transfusionrate']))));
$bloodtransfusion->transfusionendtime=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['transfusionendtime']))));
$bloodtransfusion->amounttransfused=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['amounttransfused']))));
$bloodtransfusion->othercomplications=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['othercomplications']))));


$bloodtransfusion->general=implode(",",$_POST['general']);
$bloodtransfusion->cardiac=implode(",",$_POST['cardiac']);

$bloodtransfusion->dermatological=implode(",",$_POST['dermatological']);
$bloodtransfusion->renal=implode(",",$_POST['renal']);

$bloodtransfusion->unexplainedbleeding=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['unexplainedbleeding']))));
$bloodtransfusion->date=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date']))));
$bloodtransfusion->intervention=$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['intervention'])))));
$bloodtransfusion->trackkey =str_pad(rand(1,10000000),8, '0', STR_PAD_LEFT);



  if (count($_POST['minutes']) === count($_POST['time']) && count($_POST['bloodpressure']) === count($_POST['bodytempreture']) && count($_POST['pr']) === count($_POST['rr']) && count($_POST['minutes']) === count($_POST['remarks'])  )
	  {
        // Loop through each iteme
	for ($i = 0; $i < count($_POST['minutes']); $i++) 
	{
$bloodtransfusion->minutes = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['minutes'][$i]))));
$bloodtransfusion->time = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['time'][$i]))));
$bloodtransfusion->bloodpressure = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['bloodpressure'][$i]))));
$bloodtransfusion->bodytempreture = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['bodytempreture'][$i]))));
$bloodtransfusion->pr = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['pr'][$i]))));
$bloodtransfusion->rr = $connect->real_escape_string(trim(addslashes(strtoupper($_POST['rr'][$i]))));
$bloodtransfusion->remarks= $connect->real_escape_string(trim(addslashes(strtoupper($_POST['remarks'][$i]))));
$connect ->query(" INSERT INTO bloodtransfusionobservation (TRANSFUSIONID, MINUTESELAPSED, EXACTTIME, BLOODPRESSURE, BODYTEMPRETURE, PR, RR, REMARKS) 
VALUES ('$bloodtransfusion->trackkey', '$bloodtransfusion->minutes', '$bloodtransfusion->time', '$bloodtransfusion->bloodpressure', '$bloodtransfusion->bodytempreture',
 '$bloodtransfusion->pr', '$bloodtransfusion->rr', '$bloodtransfusion->remarks');  ");
	}}

$x=$connect->query(" SELECT GENDER,TIMESTAMPDIFF(YEAR, BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) AS YRS,
TIMESTAMPDIFF(MONTH,BIRTHDATE, DATE_ADD(NOW(), INTERVAL 10 HOUR)) % 12 AS  MONTHS FROM  patientsrecord  WHERE ACCOUNT='$bloodtransfusion->patietnumber' ");

while ($data = $x->fetch_object())
{
$bloodtransfusion->gender=$data->GENDER; 
$bloodtransfusion->age=$data->YRS.'YRS '.$data->MONTHS.' MONTH';	
}
$connect ->query(" INSERT INTO bloodtransfusion (TRACKKEY,
    PATIENTNUMBER,AGE,GENDER,DIAGNOSIS, TRANSFUSIONDATETIME, TRANSFUSEDBLOODTYPE, BLOODUNITDONORNUMBER,
    COUNTERCHECKER, STARTEDBY, STARTTIME, TRANSFUSIONRATE, MINUTES, TIME,
     TRANSFUSIONENDTIME, AMOUNTTRANSFUSED, GENERAL,CARDIAC,OTHERCOMPLICATIONS,
    DEMATOLOGICAL, RENAL, HAEMETOLOGICAL, INTERVENTION, DATE
) VALUES (
    '$bloodtransfusion->trackkey',
	'$bloodtransfusion->patietnumber',
	'$bloodtransfusion->age',
	'$bloodtransfusion->gender',
	'$bloodtransfusion->diagnosis',
    '$bloodtransfusion->transfusiondatetime', 
    '$bloodtransfusion->transfusedbloodtype', 
    '$bloodtransfusion->bloodunitdonornumber', 
    '$bloodtransfusion->counterchecker', 
    '$bloodtransfusion->startedby', 
    '$bloodtransfusion->starttime', 
    '$bloodtransfusion->transfusionrate', 
    '$bloodtransfusion->minutes',  -- Assuming this is defined
    '$bloodtransfusion->time',      -- Assuming this is defined
    '$bloodtransfusion->transfusionendtime', 
    '$bloodtransfusion->amounttransfused', 
    '$bloodtransfusion->general', 
	'$bloodtransfusion->cardiac', 
	'$bloodtransfusion->othercomplications', 
    '$bloodtransfusion->dermatological',
    '$bloodtransfusion->renal', 
    '$bloodtransfusion->unexplainedbleeding',  -- Ensure this is correct
    '$bloodtransfusion->intervention', 
    '$bloodtransfusion->date'
);  ");
$_SESSION['message']="POSTED";exit;
?>