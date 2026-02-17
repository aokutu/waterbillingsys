<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class consultationbooking 
{
public $traige=null;
public $familyplanning=null;
public $prenatalcare=null;
public $postnatal=null;
public $procedure=null;
public $injection=null;
}
$consultationbooking= new consultationbooking;
$consultationbooking->traige=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['traige']))));
$consultationbooking->familyplanning=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['familyplanning']))));
$consultationbooking->prenatalcare=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['prenatalcare']))));
$consultationbooking->postnatal=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['postnatal']))));
$consultationbooking->procedure=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['procedure']))));

if($consultationbooking->traige !=null)
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$consultationbooking->traige' AND  URGENCY='TRAIGE' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   VALUES('$consultationbooking->traige','TRAIGE',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
header("LOCATION:registration.php");exit;		
}
}


if($consultationbooking->familyplanning !=null)
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$consultationbooking->familyplanning' AND  URGENCY='FAMILY PLANNING' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   VALUES('$consultationbooking->familyplanning','FAMILY PLANNING',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
header("LOCATION:registration.php");exit;		
}
}

if($consultationbooking->postnatal !=null)
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$consultationbooking->postnatal' AND  URGENCY='POST NATAL CARE' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   VALUES('$consultationbooking->postnatal','POST NATAL CARE',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
header("LOCATION:registration.php");exit;		
} 	
	
}


if($consultationbooking->prenatalcare !=null)
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$consultationbooking->postnatal' AND  URGENCY='PRE NATAL CARE' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   VALUES('$consultationbooking->prenatalcare','PRE NATAL CARE',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
header("LOCATION:registration.php");exit;		
} 	
	
}

if($consultationbooking->procedure !=null)
{
$x=$connect->query("SELECT PATIENTNUMBER  FROM  consultation WHERE PATIENTNUMBER ='$consultationbooking->procedure' AND  URGENCY='PROCEDURE' ");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO consultation (PATIENTNUMBER,URGENCY,BOOKEDIN,DATE)   VALUES('$consultationbooking->procedure','PROCEDURE',DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 10 HOUR),DATE_ADD(NOW(), INTERVAL 10 HOUR))");
header("LOCATION:registration.php");exit;		
}	
}
/*


 
*/
else
{
header("LOCATION:registration.php");exit;}

?>
