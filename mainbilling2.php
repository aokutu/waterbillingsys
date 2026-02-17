<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$currentreading=$_POST['current'];@$previousreading=$_SESSION['previousreading'];@$deduction=$_POST['deduction']; $deduction=0; 

include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BILLING'";

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

if(mysqli_num_rows($x)>0){}

else{header("LOCATION:dashboard.php");exit;}

$file=$_FILES['file']; @$billingmode=$_POST['billingmode'];

$meter=$_POST['meter'];

$account=$_SESSION['account'];

$date=$_POST['date'];

if($billingmode=='1')
{
    
 $x="SELECT $accountstable.*  FROM $accountstable,clientmetersreg WHERE $accountstable.account ='$account' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=clientmetersreg.account AND clientmetersreg.status='FUNCTION'  LIMIT 1 ";

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{ while ($y=@mysqli_fetch_array($x))

{ $_SESSION['account']=$y['account'];
 $meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
 $previous=$y['email'];  if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$account;header("LOCATION:fieldbilling.php");exit;}
 
}
    
}
 else if(mysqli_num_rows($x)<1){$_SESSION['message']="INVALID ACCOUNT-METER DETAILS";header("LOCATION:fieldbilling.php"); exit;}
 
 $billed=$currentreading-$previous;

$units=$billed-$deduction;

$units=round($units,0);
 
if($units <0){$_SESSION['message']="INVALID ENTRIES \n".$account; header("LOCATION:fieldbilling.php");exit;}


$meterstatus='RUNNING';
if($units==0)
{
$meterstatus='ESTIMATE';   
$x="SELECT AVG(UNITS) AS UNITX FROM $billstable WHERE ACCOUNT ='$account' AND DATE  >= DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH) "; $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)

{
	while ($y=@mysqli_fetch_array($x))

{
 $units=round($y['UNITX'],0);  
    
}
    
}  
}

if (($class =='A')&&($units >0) &&($units <=6))
{$watercharges=300;}

else if (($class =='A')&&($units >6) &&($units <=20))

{$watercharges=300 + ( ($units-6)*80);}

else if (($class =='A')&&($units >20) &&($units <=50))

{$watercharges=1420 + ( ($units-20)*100);}

else if (($class =='A')&&($units >50) &&($units <=100))

{$watercharges=4420 + ( ($units-50)*120);}

else if (($class =='A')&&($units >100) &&($units <=300))

{$watercharges=10420 + ( ($units-100)*140);}

else if (($class =='A')&&($units >300))

{$watercharges=38420 + ( ($units-300)*160);}

if (($class =='B')&&($units >0) &&($units <=6))

{$watercharges=$units*65;}

else if (($class =='B')&&($units >6) &&($units <=20))

{$watercharges=390 + ( ($units-6)*85);}

else if (($class =='B')&&($units >20) &&($units <=50))

{$watercharges=1580 + ( ($units-20)*105);}

else if (($class =='B')&&($units >50) &&($units <=100))

{$watercharges=4730 + ( ($units-50)*125);}



else if (($class =='B')&&($units >100) &&($units <=300))

{$watercharges=10980 + ( ($units-100)*145);}

else if (($class =='B')&&($units >300))
{$watercharges=39980 + ( ($units-300)*165);}
else if (($class =='C')&&($units >0))

{$watercharges=$units*75;}

else if (($class =='D')&&($units >0))

{$watercharges=$units*35;}

if($size==0.5)

{$metercharges=50;}

else if($size==0.75)

{$metercharges=100;}

else if($size==1)

{$metercharges=250;}

else if($size==1.5)

{$metercharges=250;}

else if($size==2)
{$metercharges=250;}

else if($size==3)

{$metercharges=450;}

else if($size==4)

{$metercharges=800;}

else if($size==6)

{$metercharges==1250;}

else if($size>=8)

{$metercharges=2000;}

$total=$watercharges+$metercharges;

$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,balance,status,accountstatus,meterstatus,class,date,user) 

VALUES('$account','$meternumber','$currentreading','$previous','$billed','$units','$deduction','$watercharges','$metercharges','$total','PENDING','$status','$meterstatus','$class','$date','$user')";

mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE $accountstable  SET email='$currentreading',DATE2='$date'  WHERE  account='$account' ";

mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('BILLED ACCOUNT $account  ON $date'),DATE_ADD(NOW(), INTERVAL 7 HOUR)";

mysqli_query($connect,$x)or die(mysqli_error($connect));
/////////// 
}


else if ($billingmode==2)
{
 $x="SELECT $accountstable.*  FROM $accountstable,clientmetersreg WHERE $accountstable.account ='$account' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=clientmetersreg.account AND clientmetersreg.status='FUNCTION'  LIMIT 1 ";

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{ while ($y=@mysqli_fetch_array($x))

{ $_SESSION['account']=$y['account'];
 $meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
 $previous=$y['email'];  if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$account;header("LOCATION:fieldbilling.php");exit;}
 
}
    
}
 else if(mysqli_num_rows($x)<1){$_SESSION['message']="INVALID ACCOUNT-METER DETAILS";header("LOCATION:fieldbilling.php"); exit;}    
 ///////////  
 $billed=$currentreading;

$units=$billed-$deduction;if($units <0){$_SESSION['message']="INVALID ENTRIES \n".$account;  header("LOCATION:fieldbilling.php");exit;}

$units=round($units,0);

if($units <0){$_SESSION['message']="INVALID ENTRIES \n".$account; header("LOCATION:fieldbilling.php");exit;}
 if (($class =='A')&&($units >0) &&($units <=6))
{$watercharges=300;}

else if (($class =='A')&&($units >6) &&($units <=20))

{$watercharges=300 + ( ($units-6)*80);}

else if (($class =='A')&&($units >20) &&($units <=50))

{$watercharges=1420 + ( ($units-20)*100);}

else if (($class =='A')&&($units >50) &&($units <=100))

{$watercharges=4420 + ( ($units-50)*120);}

else if (($class =='A')&&($units >100) &&($units <=300))

{$watercharges=10420 + ( ($units-100)*140);}

else if (($class =='A')&&($units >300))

{$watercharges=38420 + ( ($units-300)*160);}

if (($class =='B')&&($units >0) &&($units <=6))

{$watercharges=$units*65;}

else if (($class =='B')&&($units >6) &&($units <=20))

{$watercharges=390 + ( ($units-6)*85);}

else if (($class =='B')&&($units >20) &&($units <=50))

{$watercharges=1580 + ( ($units-20)*105);}

else if (($class =='B')&&($units >50) &&($units <=100))

{$watercharges=4730 + ( ($units-50)*125);}



else if (($class =='B')&&($units >100) &&($units <=300))

{$watercharges=10980 + ( ($units-100)*145);}

else if (($class =='B')&&($units >300))
{$watercharges=39980 + ( ($units-300)*165);}
else if (($class =='C')&&($units >0))

{$watercharges=$units*75;}

else if (($class =='D')&&($units >0))

{$watercharges=$units*35;}

if($size==0.5)

{$metercharges=50;}

else if($size==0.75)

{$metercharges=100;}

else if($size==1)

{$metercharges=250;}

else if($size==1.5)

{$metercharges=250;}

else if($size==2)
{$metercharges=250;}

else if($size==3)

{$metercharges=450;}

else if($size==4)

{$metercharges=800;}

else if($size==6)

{$metercharges==1250;}

else if($size>=8)

{$metercharges=2000;}

$total=$watercharges+$metercharges;

$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,balance,status,accountstatus,meterstatus,class,date,user) 

VALUES('$account','$meternumber','$previous','$previous','$billed','$units','$deduction','$watercharges','$metercharges','$total','PENDING','$accountstatus','ESTIMATE','$class','$date','$user')";

mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE $accountstable  SET email='$previous',DATE2='$date'  WHERE  account='$account' ";

mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('BILLED ACCOUNT  $account ON $date'),DATE_ADD(NOW(), INTERVAL 7 HOUR)";

mysqli_query($connect,$x)or die(mysqli_error($connect));
}


else if ($billingmode==3)
{
    
$x="UPDATE $accountstable  SET email='$currentreading' ,DATE2='$date'  WHERE  account='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'UPDATE METER READING OF ACCOUNT $account',DATE_ADD(NOW(), INTERVAL 7 HOUR))";

mysqli_query($connect,$x)or die(mysqli_error($connect)); $_SESSION['message']="UPDATED";

$_SESSION['message']="ACCOUNT UPDATED";    
    
    
}

else if ($billingmode==4)
{
 $x="UPDATE $accountstable  SET avgunit=$currentreading ,avg='AVG' WHERE  account='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'SET AVERAGE  UNIT TO $currentreading ON ACC. $account',DATE_ADD(NOW(), INTERVAL 7 HOUR))";

mysqli_query($connect,$x)or die(mysqli_error($connect)); $_SESSION['message']="UPDATED";

$_SESSION['message']="ACCOUNT  UPDATED";   
    
    
}


else if ($billingmode==5)
{
    
$x="UPDATE $accountstable  SET avgunit =null ,avg=null WHERE  account='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'UNSET AVERAGE  UNITS  ON ACC. $account',DATE_ADD(NOW(), INTERVAL 7 HOUR))";

mysqli_query($connect,$x)or die(mysqli_error($connect)); $_SESSION['message']="UPDATED";

$_SESSION['message']="ACCOUNT  UPDATED";
}
else if ($billingmode=='AVG')
{
  $x="SELECT $accountstable.*  FROM $accountstable,clientmetersreg WHERE $accountstable.account ='$account' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=clientmetersreg.account AND clientmetersreg.status='FUNCTION'  LIMIT 1 ";

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{ while ($y=@mysqli_fetch_array($x))

{ $_SESSION['account']=$y['account'];
 $meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
 $previous=$y['email'];  if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$account;header("LOCATION:fieldbilling.php");exit;}  

    
}}

 $billed=$avgunits;

$units=$billed-$deduction;

$units=round($units,0);
 
if($units <=0){$_SESSION['message']="INVALID ENTRIES \n".$account; header("LOCATION:fieldbilling.php");exit;}

if (($class =='A')&&($units >0) &&($units <=6))
{$watercharges=300;}

else if (($class =='A')&&($units >6) &&($units <=20))

{$watercharges=300 + ( ($units-6)*80);}

else if (($class =='A')&&($units >20) &&($units <=50))

{$watercharges=1420 + ( ($units-20)*100);}

else if (($class =='A')&&($units >50) &&($units <=100))

{$watercharges=4420 + ( ($units-50)*120);}

else if (($class =='A')&&($units >100) &&($units <=300))

{$watercharges=10420 + ( ($units-100)*140);}

else if (($class =='A')&&($units >300))

{$watercharges=38420 + ( ($units-300)*160);}

if (($class =='B')&&($units >0) &&($units <=6))

{$watercharges=$units*65;}

else if (($class =='B')&&($units >6) &&($units <=20))

{$watercharges=390 + ( ($units-6)*85);}

else if (($class =='B')&&($units >20) &&($units <=50))

{$watercharges=1580 + ( ($units-20)*105);}

else if (($class =='B')&&($units >50) &&($units <=100))

{$watercharges=4730 + ( ($units-50)*125);}



else if (($class =='B')&&($units >100) &&($units <=300))

{$watercharges=10980 + ( ($units-100)*145);}

else if (($class =='B')&&($units >300))
{$watercharges=39980 + ( ($units-300)*165);}

else if (($class =='C')&&($units >0))

{$watercharges=$units*75;}

else if (($class =='D')&&($units >0))

{$watercharges=$units*35;}

if($size==0.5)

{$metercharges=50;}

else if($size==0.75)

{$metercharges=100;}

else if($size==1)

{$metercharges=250;}

else if($size==1.5)

{$metercharges=250;}

else if($size==2)
{$metercharges=250;}

else if($size==3)

{$metercharges=450;}

else if($size==4)

{$metercharges=800;}

else if($size==6)

{$metercharges==1250;}

else if($size>=8)

{$metercharges=2000;}


$total=$watercharges+$metercharges;

$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,balance,status,accountstatus,meterstatus,class,date,user) 

VALUES('$account','$meternumber','$previous','$previous','$billed','$units','$deduction','$watercharges','$metercharges','$total','PENDING','$accountstatus','$meterstatus','$class','$date','$user')";

mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE $accountstable  SET email='$previous',DATE2='$date'  WHERE  account='$account' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('BILLED ACCOUNT  $account ON $date'),DATE_ADD(NOW(), INTERVAL 7 HOUR)";

mysqli_query($connect,$x)or die(mysqli_error($connect));
}
else {$_SESSION['message']="NO TASK SELECTED "; header("LOCATION:fieldbilling.php"); exit;}

$_SESSION['message']="ACCOUNT  ".$account." UPDATED"; 
/* Upload image code 
if(!isset($FILES['file'])){header("LOCATION:fieldbilling.php");exit;}

$newname=$account."-".$meter."-".$date;

$newPath = 'uploads/photos/' . basename($_FILES['file']['name']);
$path = $_FILES['file']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
switch($extension) {
case "png":move_uploaded_file($_FILES['file']['tmp_name'], $newPath);rename("uploads/photos/".$path."","uploads/photos/".$newname.".".$extension."");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED BILL IMAGE $newname',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
break;
case "jpeg":move_uploaded_file($_FILES['file']['tmp_name'], $newPath);rename("uploads/photos/".$path."","uploads/photos/".$newname.".".$extension."");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED BILL IMAGE $newname',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
break;
case "jpg":move_uploaded_file($_FILES['file']['tmp_name'], $newPath);rename("uploads/photos/".$path."","uploads/photos/".$newname.".".$extension."");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED BILL IMAGE $newname',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
break;
case "gif":move_uploaded_file($_FILES['file']['tmp_name'], $newPath);rename("uploads/photos/".$path."","uploads/photos/".$newname.".".$extension."");
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED BILL IMAGE $newname',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
break;
default:exit;
            }
            */
          
header("LOCATION:mainbilling.php");exit;

?>