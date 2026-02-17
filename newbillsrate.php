<?php 



@session_start();

include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'   AND  ACCESS  REGEXP  'BILL RATES'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class newrates
{
public $acclassa=null;
public $acclassb=null;
public $acclassc=null;
public $acclassd=null;
public $units=null;
public $charges=null;
}
$newrates=new newrates;

@$newrates->acclassa=$connect->real_escape_string(addslashes(strtoupper($_POST['acclassa'])));

@$newrates->acclassb=$connect->real_escape_string(addslashes(strtoupper($_POST['acclassb'])));
@$newrates->acclassc=$connect->real_escape_string(addslashes(strtoupper($_POST['acclassc'])));

@$newrates->acclassd=$connect->real_escape_string(addslashes(strtoupper($_POST['acclassd'])));

@$newrates->units=$connect->real_escape_string(addslashes(strtoupper($_POST['units'])));

/*$connect->query("UPDATE WATERBILLINGRATES TU,WATERBILLINGRATES TS SET TU.RATE='$newrates->charges' ,TU.STANDINGCHARGES='$newrates->standingcharges',TU.COMMISSION='$newrates->commission' WHERE TU.CLASS='$newrates->'   AND TU.CLASS='$newrates->class' ");*/	

$x=$connect->query("SELECT *  FROM  WATERBILLINGRATES WHERE UNITS ='$newrates->units'");
if(mysqli_num_rows($x)<1)
{
$connect->query("INSERT INTO WATERBILLINGRATES (UNITS,A,B,C,D) VALUES('$newrates->units','$newrates->acclassa','$newrates->acclassb','$newrates->acclassc','$newrates->acclassd')");
}
else if(mysqli_num_rows($x)>0)
{
$connect->query("UPDATE WATERBILLINGRATES TU,WATERBILLINGRATES TS SET TU.A='$newrates->acclassa' ,TU.B='$newrates->acclassb',TU.C='$newrates->acclassc', TU.D='$newrates->acclassd' WHERE TU.UNITS='$newrates->units'");
}

$connect->query("INSERT INTO events(user,session,action,date) VALUES('$dbdetails->user',now(),'UPDATED THE  BILLING CHARGES  FOR  UNITS $newrates->units',now())");
$_SESSION['message']="UPDATED ".$newrates->units."<br> UNITS";exit;
?>