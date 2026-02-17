<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'GENERATE TICKETS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$action=$_POST['action']; $id=$_POST['id']; @$officer=$_POST['officer'];  $officer=addslashes(strtoupper($officer));
if($action =='DELETE')
{
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'DELETE TICKETS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED"; exit;}

foreach($id as $del){
$x="DELETE  FROM TICKETS WHERE TICKET ='$del'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'DELETED TICKET NO. $del',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}	
$_SESSION['message']="TICKETS DELETED"; exit;	
}
else if($action =='POSTSMS')
{
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'POST TICKETS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED"; exit;}

foreach($id as $del){
$x="INSERT INTO OUTBOX(ACCOUNT,CONTACT,MESSAGE,STATUS,DATE )   SELECT ACCOUNT,CONTACT,CONCAT(CONCAT('TICKET NO:'),TICKET),CONCAT('PENDING'),CURRENT_TIMESTAMP FROM  TICKETS WHERE TICKET='$del'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ASSINGNED TICKET NO. $del  TO $officer',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}	
$_SESSION['message']="TICKET NUMBER POSTED "; exit;	
}
else if(($action =='ASSIGN') &&($officer !=''))
{
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ASSIGN TICKETS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED"; exit;}

foreach($id as $del){
$x="UPDATE TICKETS SET ASSIGN='$officer' WHERE TICKET='$del'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'ASSIGNED TICKET NO. $del TO $officer',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}	
$_SESSION['message']="TASKS ASSIGNED "; exit;	
}
$_SESSION['message']="UPDATE"; exit;
?>