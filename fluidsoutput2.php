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

class fluidsoutput
{
public $patientnumber =null; 
public $date  =null; 
public $time =null; 
public $bodyweight =null;
public $nastrogastricsuction =null;
public $vomitus=null;
public $drainstoolfistula=null;
public $urinevolume=null;
}
$fluidsoutput =new fluidsoutput;
$fluidsoutput->patientnumber =$_SESSION['patientnumber'];
$fluidsoutput->date=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date'])))); 
$fluidsoutput->time=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['time'])))); 
$fluidsoutput->bodyweight=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['bodyweight'])))); 
$fluidsoutput->nastrogastricsuction=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['nastrogastricsuction'])))); 
$fluidsoutput->vomitus=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['vomitus'])))); 
$fluidsoutput->drainstoolfistula=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['drainstoolfistula'])))); 
$fluidsoutput->urinevolume=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['urinevolume'])))); 

$connect ->query("  INSERT INTO fluidsoutput (PATIENTNUMBER, DATE, TIME, WEIGHT, NASTROGASTRICSUCTION, VOMITUS, DRAINSTOOLFISTULA, URINEVOLUME) 
VALUES ('$fluidsoutput->patientnumber', '$fluidsoutput->date', '$fluidsoutput->time', 
'$fluidsoutput->bodyweight', '$fluidsoutput->nastrogastricsuction', '$fluidsoutput->vomitus',
 '$fluidsoutput->drainstoolfistula', '$fluidsoutput->urinevolume'); ");
$_SESSION['message']="POSTED";

?>