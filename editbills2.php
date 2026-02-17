<?php 
@session_start();
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'EDIT BILLS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$meternumber=$_POST['meter'];
@$clientaccount=$_POST['clientaccount'];
@$previous=$_POST['previous'];@$current=$_POST['current'];
@$units=$_POST['units'];
@$ttlcharges=$_POST['ttlcharges'];@$date=$_POST['date'];
@$clientaccount=$_POST['clientaccount'];
@$deduction=$_POST['deduction'];
$billid=$_POST['reffnumber'];
@$account=$clientaccount;
 $x="SELECT $accountstable.*  FROM $accountstable,clientmetersreg WHERE $accountstable.account ='$clientaccount'  LIMIT 1 ";

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{ while ($y=@mysqli_fetch_array($x))

{ $_SESSION['account']=$y['account'];
 $meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);
}
    
}
 else if(mysqli_num_rows($x)<1){$_SESSION['message']="INVALID ACCOUNT-METER DETAILS";header("LOCATION:billsreport.php"); exit;}
 
 $billed=$current-$previous;

//$units=$billed-$deduction;
$units=$billed;

$units=round($units,0);
if($units==0){$meterstatus='ESTIMATE';
    
    $x="SELECT AVG(UNITS) AS UNITX FROM $billstable WHERE ACCOUNT ='$account' AND  ID !='$billid' AND DATE  >= DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH)  "; $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)

{
	while ($y=@mysqli_fetch_array($x))

{
 $units=round($y['UNITX'],0);
    
}
    
}
    
    
    
}
else if($units >0){$meterstatus='RUNNING';}
else  if($units <0){$_SESSION['message']="INVALID ENTRIES \n".$account; header("LOCATION:billsreport.php");exit;}


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

/////////// 
$meterstatus='RUNNING';
if($previous==$current){$meterstatus='ESTIMATE';}
$x="UPDATE   $billstable  SET METERSTATUS='$meterstatus',BILLED='$billed',UNITS='$units' ,ACCOUNT='$clientaccount',DATE='$date',previous='$previous',current='$current',BALANCE='$total', metercharges='$metercharges',charges='$watercharges',METERSTATUS='$meterstatus' WHERE ID=$billid";mysqli_query($connect,$x)or die(mysqli_error($connect));
/*$x="UPDATE $accountstable SET EMAIL='$current',DATE2='$date'   WHERE ACCOUNT =(SELECT ACCOUNT FROM $billstable WHERE  ID =$billid) ";
mysqli_query($connect,$x)or die(mysqli_error($connect));*/
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'EDITED  BILL  REFF NO :$billid',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']=$meternumber."BILL EDITED";
header("LOCATION:billsreport.php");
exit;
?>