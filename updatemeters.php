<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$action=$_POST['action'];
@$del=$_POST['del'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'EDIT METER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

if($action =='UNINSTALL')
{

 $x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'EDIT METER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACESS DENIED ";	 exit;} 

 $x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'EDIT METER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACESS DENIED ";	 exit;} 


 foreach($del  as  $id ){
 	$x="SELECT number FROM zones  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$statushistorytable='statushistory'.$i;$accountstablex='accounts'.$i;    
   $a="UPDATE $accountstablex SET METERNUMBER='NOT INSTALLED' WHERE ACCOUNT=(SELECT ACCOUNT  FROM clientmetersreg WHERE  ID  =$id );   ";
	mysqli_query($connect,$a)or die(mysqli_error($connect));
	$b="INSERT INTO $statushistorytable(account,meter,status,task,date) SELECT ACCOUNT,METERNUMBER,CONCAT('METER UNINSTALLED'),CONCAT('UPDATE METER STATUS'),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID=$id ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		    
		}}
	$x="INSERT INTO metertrail (METERNUMBER,ACCOUNT,ACTIVITY,DATE) SELECT METERNUMBER,ACCOUNT,CONCAT('METER UNINSTALLED'),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID=$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('CHANGED STATUS  TO UNINSTALLED ON METER ',METERNUMBER),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID  =$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
		
		$x="UPDATE clientmetersreg SET ACCOUNT='NOT INSTALLED', ZONE =NULL WHERE ID=$id  ";
		mysqli_query($connect,$x)or die(mysqli_error($connect));
     
 }  
 $_SESSION['message']='METERS UN-INSTALLED';exit; 
}

else  if ($action =='DELETE')
{
 $x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'DELETE METER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACESS DENIED ";	 exit;} 

 foreach($del  as  $id ){
 	$x="SELECT number FROM zones  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$statushistorytable='statushistory'.$i;$accountstablex='accounts'.$i;    
   $a="UPDATE $accountstablex SET METERNUMBER='NOT INSTALLED' WHERE ACCOUNT=(SELECT ACCOUNT  FROM clientmetersreg WHERE  ID  =$id );   ";
	mysqli_query($connect,$a)or die(mysqli_error($connect));
	$b="INSERT INTO $statushistorytable(account,meter,status,task,date) SELECT ACCOUNT,METERNUMBER,CONCAT('METER DELETED'),CONCAT('DELETED METER '),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID=$id ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		    
		}}
	$x="INSERT INTO metertrail (METERNUMBER,ACCOUNT,ACTIVITY,DATE) SELECT METERNUMBER,ACCOUNT,CONCAT('METER DELETED'),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID=$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('METER DELETED ',METERNUMBER),CURRENT_DATE FROM clientmetersreg WHERE  ID  =$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
		
		$x="DELETE FROM clientmetersreg  WHERE ID=$id  ";
		mysqli_query($connect,$x)or die(mysqli_error($connect));
     
 }
 

 
 $_SESSION['message']='METERS DELETED';exit; 
 
}
else {
 $x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'EDIT METER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACESS DENIED ";	 exit;} 

	foreach($del  as  $id ){ 
	    
	    	$a="SELECT number FROM zones  ";
		$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
		{
		 while ($y=@mysqli_fetch_array($a))
		{
			
	$i=$y['number'];$statushistorytable='statushistory'.$i; 
	$b="INSERT INTO $statushistorytable(account,meter,status,task,date) SELECT ACCOUNT,METERNUMBER,CONCAT('METER $action'),CONCAT('$action METER '),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID=$id ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		    
		}}
		
	$x="INSERT INTO metertrail (METERNUMBER,ACCOUNT,ACTIVITY,DATE) SELECT METERNUMBER,ACCOUNT,CONCAT('METER $action'),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID=$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('METER ',METERNUMBER,' $action '),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM clientmetersreg WHERE  ID  =$id ";mysqli_query($connect,$x)or die(mysqli_error($connect));
				
	$x="UPDATE clientmetersreg SET STATUS='$action' WHERE ID=$id ";
	mysqli_query($connect,$x)or die(mysqli_error($connect));
		}
$_SESSION['message']='METERS UPDATED';exit;    
}
?>