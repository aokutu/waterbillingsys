<?php 
@session_start();
$_SESSION['message']=null;
//include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'    ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIEDx"; header("LOCATION:accessdenied4.php");exit;}

class registrationbooking
{
public $patientnumber=null;
public $consultationpatientnumber=null;
public $patientsearchpatientnumber=null;
public $editpatientnumber=null;
public $classpatientnumber=null;
public $patientclass=null;
public $phamarcypatientnumber=null;
public $prenatalpatientnumber=null;
public $labandimagingpatientnumber=null;
public $billingpatientnumber=null;
public $xraypatientnumber=null;
public $clearpatientnumber=null;
public $registrypatientnumber=null;
public $natalcarepatientnumber=null;
public $user=null;
public $user2=null;
public $inpatientpatientnumber=null;
public $accessname=null;
public $accesspass=null;
public $debtpatientnumber=null;
}
$registrationbooking=new registrationbooking;
$registrationbooking->patientnumber=$_POST['patientnumber'];
$registrationbooking->consultationpatientnumber=$_POST['consultationpatientnumber'];
$registrationbooking->patientsearchpatientnumber=$_POST['patientsearchpatientnumber'];
$registrationbooking->classpatientnumber=$_POST['classpatientnumber'];
$registrationbooking->patientclass=$_POST['patientclass'];
$registrationbooking->phamarcypatientnumber=$_POST['phamarcypatientnumber'];
$registrationbooking->phamarcypatientnumber=$_POST['phamarcypatientnumber'];
$registrationbooking->prenatalpatientnumber=$_POST['prenatalpatientnumber'];
$registrationbooking->labandimagingpatientnumber=$_POST['labandimagingpatientnumber'];
$registrationbooking->billingpatientnumber=$_POST['billingpatientnumber'];
$registrationbooking->xraypatientnumber=$_POST['xraypatientnumber'];
$registrationbooking->clearpatientnumber=$_POST['clearpatientnumber'];
$registrationbooking->registrypatientnumber=$_POST['registrypatientnumber'];
$registrationbooking->user=$_POST['user'];
$registrationbooking->user2=$_GET['user2'];
$registrationbooking->debtpatientnumber =$_GET['debtpatientnumber'];
$registrationbooking->inpatientpatientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['inpatientpatientnumber']))));
$registrationbooking->accessname=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accessname']))));
$registrationbooking->accesspass=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['accesspass']))));
$registrationbooking->natalcarepatientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['natalcarepatientnumber']))));

if(isset($registrationbooking->patientnumber))
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->patientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$registrationbooking->patientnumber','TRAIGE',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");

}
else
{
$connect->query("UPDATE consultation SET URGENCY='TRAIGE' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$registrationbooking->patientnumber' ");	
$_SESSION['message']=$registrationbooking->patientnumber."<br>TRAIGE BOOKED";

}
exit;
}


if( strlen($registrationbooking->natalcarepatientnumber)>0 )
{
	
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->natalcarepatientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$registrationbooking->natalcarepatientnumber','NATAL CARE',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']=$registrationbooking->natalcarepatientnumber."<br>NATAL CARE  BOOKED";
}
else
{
$connect->query("UPDATE consultation SET URGENCY='NATAL CARE' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$registrationbooking->natalcarepatientnumber' ");	
$_SESSION['message']=$registrationbooking->natalcarepatientnumber."<br>NATAL CARE  BOOKED";

}
exit;
}



if(strlen($registrationbooking->inpatientpatientnumber) >0  )
{	

$x = $connect ->query("SELECT * FROM users  WHERE  name='$registrationbooking->accessname' AND password='$registrationbooking->accesspass'  AND ACCESS REGEXP 'FINANCE' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']=$registrationbooking->accessname."ACCESS  DENIED";exit;} 

	

$x=$connect->query("SELECT PATIENTNUMBER  FROM  inpatientsrecord WHERE PATIENTNUMBER ='$registrationbooking->inpatientpatientnumber' ");
if(mysqli_num_rows($x)>0 )
{
$connect ->query("INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$dbdetails->user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),CONCAT('DISHARGED PATIENT NUMBER  ',PATIENTNUMBER,' FROM INPATIENT '),DATE_ADD(NOW(), INTERVAL 10 HOUR)  FROM inpatientsrecord  WHERE PATIENTNUMBER ='$registrationbooking->inpatientpatientnumber' ");

$connect ->query("DELETE FROM  inpatientsrecord WHERE PATIENTNUMBER ='$registrationbooking->inpatientpatientnumber' ");
$_SESSION['message']=$registrationbooking->inpatientpatientnumber."<br>DISCHARGED ";
}
else
{
$_SESSION['message']=$registrationbooking->inpatientpatientnumber."<br>NOT ADMITTED ";
}
exit; 
} 


if(isset($registrationbooking->user))
{
$connect->query("INSERT  INTO  activeshift(ATTENDANT,STARTTIME) VALUES('$registrationbooking->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR))"); 
$connect->query("INSERT INTO events(user,session,action,date) VALUES('$registrationbooking->user',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'STARTED REGISTRY  SHIFT  ',DATE_ADD(NOW(), INTERVAL 10 HOUR))"); 

$_SESSION['message']='SHIFT STARTED '; exit; 
}


if(isset($registrationbooking->user2) )
{

$x=$connect->query(" SELECT  STARTTIME,DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR) AS ENDTIME FROM activeshift WHERE  ATTENDANT ='$registrationbooking->user2' ");
while ($data = $x->fetch_object())
{
$starttime=$data->STARTTIME; $endtime=$data->ENDTIME; 
}

include_once("closeshiftreport.php"); 
//$connect->query("DELETE FROM activeshift WHERE  ATTENDANT ='$registrationbooking->user2' "); 
$connect->query("INSERT INTO events(user,session,action,date) VALUES('$registrationbooking->user2',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),'END  REGISTRY  SHIFT  ',DATE_ADD(NOW(), INTERVAL 10 HOUR))"); 

$_SESSION['message']='SHIFT ENDED '; exit; 
}





if(isset($registrationbooking->debtpatientnumber) )
{

include_once("debtpayment.php"); 
$_SESSION['message']='LOADING DETAILS '; exit; 
}



if(isset($registrationbooking->registrypatientnumber))
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->registrypatientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$registrationbooking->registrypatientnumber','REGISTRY',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']=$registrationbooking->patientnumber."<br>REGISTRY BOOKED";
}
else
{
$connect->query("UPDATE consultation SET URGENCY='REGISTRY' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$registrationbooking->registrypatientnumber' ");	
$_SESSION['message']=$registrationbooking->registrypatientnumber."<br>REGISTRY BOOKED";

}
}

if(isset($registrationbooking->xraypatientnumber))
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->xraypatientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$registrationbooking->xraypatientnumber','XRAY &  IMAGING',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']=$registrationbooking->xraypatientnumber."<br>XRAY &  IMAGING BOOKED";
}
else
{
$connect->query("UPDATE consultation SET URGENCY='XRAY &  IMAGING' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$registrationbooking->xraypatientnumber' ");	
$_SESSION['message']=$registrationbooking->xraypatientnumber."<br>XRAY &  IMAGING BOOKED";

}
exit; 
}


if(isset($registrationbooking->clearpatientnumber))
{

$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'  AND   ACCESS REGEXP 'REGISTRATION'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED";exit;}

$connect->query("DELETE   FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->clearpatientnumber' ");
$_SESSION['message']=$registrationbooking->clearpatientnumber."<br>CLEARED";

}


if(isset($registrationbooking->billingpatientnumber))
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->billingpatientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$registrationbooking->billingpatientnumber','BILLING',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']=$registrationbooking->billingpatientnumber."<br>BILLING BOOKED";
}
else
{
$connect->query("UPDATE consultation SET URGENCY='BILLING' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$registrationbooking->billingpatientnumber' ");	
$_SESSION['message']=$registrationbooking->billingpatientnumber."<br>BILLING BOOKED";

}
}


if(isset($registrationbooking->labandimagingpatientnumber))
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->labandimagingpatientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$registrationbooking->labandimagingpatientnumber','LAB & IMAGING',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']=$registrationbooking->labandimagingpatientnumber."<br>LAB & IMAGING BOOKED";
}
else
{
$connect->query("UPDATE consultation SET URGENCY='LAB & IMAGING' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$registrationbooking->labandimagingpatientnumber' ");	
$_SESSION['message']=$registrationbooking->labandimagingpatientnumber."<br>LAB & IMAGING BOOKED";

}
}





if(isset($registrationbooking->phamarcypatientnumber))
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->phamarcypatientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$registrationbooking->phamarcypatientnumber','PHAMARCY',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']=$registrationbooking->phamarcypatientnumber."<br>PHARMACY BOOKED";

$connect ->query("INSERT INTO treatmentreport(PATIENTNUMBER,PRESCRIPTION,TREATMENT,ATTENDANT,DATE) 
VALUES('$registrationbooking->phamarcypatientnumber','NONE','NONE','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");

}
else
{
$connect->query("UPDATE consultation SET URGENCY='PHARMACY' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$registrationbooking->phamarcypatientnumber' ");	
$_SESSION['message']=$registrationbooking->phamarcypatientnumber."<br>PHARMACY BOOKED";

$connect ->query("INSERT INTO treatmentreport(PATIENTNUMBER,PRESCRIPTION,TREATMENT,ATTENDANT,DATE) 
VALUES('$registrationbooking->phamarcypatientnumber','NONE','NONE','$dbdetails->user',DATE_ADD(NOW(), INTERVAL 10 HOUR))");

}
}



if(isset($registrationbooking->consultationpatientnumber))
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$registrationbooking->consultationpatientnumber' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   
VALUES('$registrationbooking->consultationpatientnumber','CONSULTATION',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
$_SESSION['message']=$registrationbooking->consultationpatientnumber."<br>CONSULTTION BOOKED";
}
else
{
$connect->query("UPDATE consultation SET URGENCY='CONSULTATION' ,DATE=NOW(),BOOKEDIN=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR)  WHERE PATIENTNUMBER ='$registrationbooking->consultationpatientnumber' ");	
$_SESSION['message']=$registrationbooking->consultationpatientnumber."<br>CONSULTATION BOOKED";

}
}


if(isset($registrationbooking->patientsearchpatientnumber))
{
$_SESSION['patientnumber']=$registrationbooking->patientsearchpatientnumber;
$_SESSION['message']=$registrationbooking->patientsearchpatientnumber."<br>LOAD DETAILS";
	
	
}

if(isset($registrationbooking->editpatientnumber))
{
$_SESSION['patientnumber']=$registrationbooking->editpatientnumber;
$_SESSION['message']=$registrationbooking->editpatientnumber."<br>LOAD DETAILS";

}

if(isset($registrationbooking->classpatientnumber))
{
$connect->query("UPDATE patientsrecord SET CLASS='$registrationbooking->patientclass'   WHERE ACCOUNT ='$registrationbooking->classpatientnumber' ");	

$_SESSION['message']=$registrationbooking->editpatientnumber."<br>LOAD DETAILS";

}
 /* */
?>