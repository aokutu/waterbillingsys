<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$currentreading=$_POST['currentreading'];@$deduction=$_POST['deduction'];@$avgreading=$_POST['avgreading'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='".$_SESSION['user']."' AND password='".$_SESSION['password']."'   AND  ACCESS  REGEXP  'BILLING'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:dashboard.php");exit;}


@$status=$_POST['status'];
$date=$_POST['date'];
@$billingtype=$_POST['billingtype'];

foreach($currentreading as $key =>$data)
{
	if($data <0){unset($currentreading[$key]);}
	if($data ==null ){unset($currentreading[$key]);}
}
if(isset($currentreading)) {
   if (count($currentreading)>50){$_SESSION['message']="ENTRIES EXCEED LIMIT  OF 50 ";exit;} 
}
foreach($deduction as $key =>$data)
{
	if($data <=0){unset($deduction[$key]);}
	
}


if(count($deduction)>50){
    $_SESSION['message']="ENTRIES EXCEED LIMIT  OF 50 ";exit;}

foreach($avgreading as $key =>$data)
{   
	if($data <=0){unset($currentreading[$key]);}
	if($data ==null){unset($currentreading[$key]);}
	if(!isset($data)){unset($currentreading[$key]);}
	
}

if((isset($avgreading)) &&(count($avgreading)>50)){
    $_SESSION['message']="ENTRIES EXCEED LIMIT  OF 50 ";exit;}

$x="CREATE TEMPORARY TABLE PROCESSBILL (
    ACCOUNT TEXT,
   METERNUMBER TEXT,
   METERSIZE FLOAT,
   CLASS TEXT,
   CURRENT FLOAT,
   PREVIOUS FLOAT,
   DEDUCTION FLOAT,
   BILLED FLOAT,
   UNITS FLOAT,
   WATERCHARGES FLOAT,
   METERCHARGES FLOAT,
   TOTALCHARGES FLOAT,
   DATE DATE
    )";
mysqli_query($connect,$x)or die(mysqli_errory($connect));
/////////////////////////////

if (($billingtype=='1')&&(isset($currentreading)))
{
    
foreach($currentreading as $key =>$data)
{
    
  $x="SELECT $accountstable.*  FROM $accountstable,clientmetersreg WHERE $accountstable.account ='$key' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=clientmetersreg.account AND clientmetersreg.status='FUNCTION' LIMIT 1 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{
    while ($y=@mysqli_fetch_array($x))
{ $_SESSION['account']=$y['account']; }}
else if(mysqli_num_rows($x)<1){
    $_SESSION['message']="INVALID ACCOUNT-METER DETAILS";exit;}
    
$x="SELECT *  FROM $accountstable WHERE account='$key' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{    while ($y=@mysqli_fetch_array($x))
{
$meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
$previous=$y['email'];$accountstatus=$y['status'];
 if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$key; exit;}
if($previous>$data){$_SESSION['message']=$key .$previous."Account Failed"; exit;}
$billed=$data-$previous;
$billed=round($billed,0);

$meterstatus='RUNNING';
if($billed ==0)

{
  $meterstatus='ESTIMATE'; 
 $b="SELECT AVG(UNITS) AS UNITX FROM $billstable WHERE ACCOUNT ='$key'  AND DATE  >= DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH) "; $b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0)

{
	while ($y=@mysqli_fetch_array($b))

{
 $billed= round($y['UNITX'],0) ;  
   
}
    
}   
    
    
}



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

$a="INSERT INTO PROCESSBILL(ACCOUNT,METERNUMBER,METERSIZE,CLASS,CURRENT,PREVIOUS,DEDUCTION,METERCHARGES,BILLED,DATE ) 
VALUES('$key','$meternumber','$size','$class','$data','$previous',0,'$metercharges','$billed','$date')";
mysqli_query($connect,$a)or die(mysqli_error($connect));
 
 
 
}
 
   
}


    
}    
    
/*foreach($deduction as $key =>$data)
{
      $data=round($data,0);
$x="UPDATE PROCESSBILL TU, PROCESSBILL TS  SET TS.DEDUCTION='$data' WHERE  TS.ACCOUNT ='$key' ";
mysqli_query($connect,$x)or die(mysqli_error($connect)); 
}*/
   
foreach($currentreading as $key =>$data)
{
  $aa="UPDATE PROCESSBILL  TU, PROCESSBILL TS  SET TU.UNITS=TS.BILLED WHERE TS.ACCOUNT ='$key' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect)); 
 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+(TS.RATE*(TU.UNITS-TS.MINUNITS)) WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='A' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));
 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+(TS.RATE*(TU.UNITS-TS.MINUNITS)) WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='B' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));

 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=(TU.UNITS*TS.RATE) WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='C' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));

 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=(TU.UNITS*TS.RATE) WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='D' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));
$x="UPDATE PROCESSBILL  TU, PROCESSBILL TS  SET TU.TOTALCHARGES=TS.WATERCHARGES+TS.METERCHARGES WHERE  TU.ACCOUNT=TS.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="UPDATE $accountstable  SET DATE2='$date',email='$data'  WHERE  account='$key' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


}   

    
$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,balance,status,accountstatus,meterstatus,class,date,user) 
SELECT ACCOUNT,METERNUMBER,CURRENT,PREVIOUS,BILLED,BILLED,DEDUCTION,WATERCHARGES,METERCHARGES,TOTALCHARGES,CONCAT('PENDING'),CONCAT('$accountstatus'),CONCAT('$meterstatus'),CONCAT('$class'),CONCAT('$date'),CONCAT('$user') FROM PROCESSBILL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


foreach($currentreading as $key =>$data)
{
$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 7 HOUR) ,CONCAT('BILLED ACCOUNT $key ON $date'),DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 7 HOUR)";
mysqli_query($connect,$x)or die(mysqli_error($connect));   
    
}




}


 if (($billingtype=='1')&&(isset($avgreading)))
{
     
foreach($avgreading as $key =>$data)
{
    
  $x="SELECT $accountstable.*  FROM $accountstable,clientmetersreg WHERE $accountstable.account ='$key' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=clientmetersreg.account AND clientmetersreg.status='FUNCTION' LIMIT 1 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{
    while ($y=@mysqli_fetch_array($x))
{ $_SESSION['account']=$y['account']; }}
else if(mysqli_num_rows($x)<1){
    $_SESSION['message']="INVALID ACCOUNT-METER DETAILS";exit;}
    
$x="SELECT *  FROM $accountstable WHERE account='$key' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{    while ($y=@mysqli_fetch_array($x))
{
$meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
$previous=$y['email']; 
 if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$key; exit;}
$billed=$data;
$billed=round($billed,0);


if($billed ==0)

{
    
 $b="SELECT AVG(UNITS) AS UNITX FROM $billstable WHERE ACCOUNT ='$key' ORDER BY DATE DESC LIMIT 12 "; $b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0)

{
	while ($y=@mysqli_fetch_array($x))

{
 $billed=$y['UNITX'];  
    
}
    
}   
    
    
}



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

$a="INSERT INTO PROCESSBILL(ACCOUNT,METERNUMBER,METERSIZE,CLASS,CURRENT,PREVIOUS,DEDUCTION,METERCHARGES,BILLED,DATE ) 
VALUES('$key','$meternumber','$size','$class','$previous','$previous',0,'$metercharges','$billed','$date')";
mysqli_query($connect,$a)or die(mysqli_error($connect));
 
 
 
}
 
   
}


    
}    
    
/*foreach($deduction as $key =>$data)
{
      $data=round($data,0);
$x="UPDATE PROCESSBILL TU, PROCESSBILL TS  SET TS.DEDUCTION='$data' WHERE  TS.ACCOUNT ='$key' ";
mysqli_query($connect,$x)or die(mysqli_error($connect)); 
}*/
  
foreach($avgreading as $key =>$data)
{

  $aa="UPDATE PROCESSBILL  TU, PROCESSBILL TS  SET TU.UNITS=TS.BILLED WHERE TS.ACCOUNT ='$key' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect)); 
 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+(TS.RATE*(TU.UNITS-TS.MINUNITS)) WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='A' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));
 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+(TS.RATE*(TU.UNITS-TS.MINUNITS)) WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='B' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));

 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+75 WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='C' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));

 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+35 WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='D' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));
$x="UPDATE PROCESSBILL  TU, PROCESSBILL TS  SET TU.TOTALCHARGES=TS.WATERCHARGES+TS.METERCHARGES WHERE  TU.ACCOUNT=TS.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="UPDATE $accountstable  SET DATE2='$date',email='$data'  WHERE  account='$key' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
   
}    
$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,balance,status,accountstatus,meterstatus,class,date,user) 
SELECT ACCOUNT,METERNUMBER,CURRENT,PREVIOUS,BILLED,BILLED,DEDUCTION,WATERCHARGES,METERCHARGES,TOTALCHARGES,CONCAT('PENDING'),CONCAT('$accountstatus'),CONCAT('$meterstatus'),CONCAT('$class'),DATE,CONCAT('$user') FROM PROCESSBILL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));



$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('BILLED ACCOUNT $key ON $date'),DATE_ADD(NOW(), INTERVAL 7 HOUR)";
mysqli_query($connect,$x)or die(mysqli_error($connect));    
  
}


///////////////////////
 if (($billingtype=='2')&&(isset($currentreading)))
{
foreach($currentreading as $key =>$data)
{

$x="UPDATE $accountstable  SET email=$data  ,DATE2 ='$date' WHERE  account='$key' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'UPDATE METER READING OF ACCOUNT $key',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}


$_SESSION['message']="METER  READING UPDATED"; exit;
}

 if (($billingtype=='3')&&(isset($currentreading)))
{
foreach($currentreading as $key =>$data)
{
$x="UPDATE $accountstable  SET avgunit=$data ,avg='AVG' WHERE  account='$key' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'SET METER TO AVERAGE READING OF ACCOUNT $key',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}
$_SESSION['message']="METER  SET  TO  AVERAGE BILLING"; exit;
}
 if (($billingtype=='4')&&(isset($avgreading)))
{
foreach($avgreading as $key =>$data)
{
	
$x="UPDATE $accountstable  SET avgunit=null ,avg=null WHERE  ACCOUNT='$key' ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'RESET METER TO AVERAGE READING OF ACCOUNT $key',DATE_ADD(NOW(), INTERVAL 7 HOUR)";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}
$_SESSION['message']="METER  UNSET  AVERAGE BILLING"; exit;
}

 if (($billingtype=='5')&&(isset($currentreading)))
{
    
foreach($currentreading as $key =>$data)
{
    
  $x="SELECT $accountstable.*  FROM $accountstable,clientmetersreg WHERE $accountstable.account ='$key' AND  $accountstable.STATUS='CONNECTED' AND $accountstable.account=clientmetersreg.account AND clientmetersreg.status='FUNCTION' LIMIT 1 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{
    while ($y=@mysqli_fetch_array($x))
{ $_SESSION['account']=$y['account']; }}
else if(mysqli_num_rows($x)<1){
    $_SESSION['message']="INVALID ACCOUNT-METER DETAILS";exit;}
    
$x="SELECT *  FROM $accountstable WHERE account='$key' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
{    while ($y=@mysqli_fetch_array($x))
{
$meternumber=$y['meternumber'];$size=$y['size'];$class=strtoupper($y['class']);$status=$y['status'];  $avg=$y['avg']; $avgunits=$y['avgunit']; 
$previous=$y['email']; 
 if($previous ==null){$_SESSION['message']="SET  PREVIOUS   METER READING ON \n".$key; exit;}
$billed=$data;
$billed=round($billed,0);


if($billed ==0)

{
    
 $b="SELECT AVG(UNITS) AS UNITX FROM $billstable WHERE ACCOUNT ='$key' ORDER BY DATE DESC LIMIT 12 "; $b=mysqli_query($connect,$b)or die(mysqli_error($connect));
if(mysqli_num_rows($b)>0)

{
	while ($y=@mysqli_fetch_array($x))

{
 $billed=$y['UNITX'];  
    
}
    
}   
    
    
}



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

$a="INSERT INTO PROCESSBILL(ACCOUNT,METERNUMBER,METERSIZE,CLASS,CURRENT,PREVIOUS,DEDUCTION,METERCHARGES,BILLED,DATE ) 
VALUES('$key','$meternumber','$size','$class','$previous','$previous',0,'$metercharges','$billed','$date')";
mysqli_query($connect,$a)or die(mysqli_error($connect));
 
 
 
}
 
   
}


    
}    
    
/*foreach($deduction as $key =>$data)
{
      $data=round($data,0);
$x="UPDATE PROCESSBILL TU, PROCESSBILL TS  SET TS.DEDUCTION='$data' WHERE  TS.ACCOUNT ='$key' ";
mysqli_query($connect,$x)or die(mysqli_error($connect)); 
}*/
   
foreach($currentreading as $key =>$data)
{
  $aa="UPDATE PROCESSBILL  TU, PROCESSBILL TS  SET TU.UNITS=TS.BILLED WHERE TS.ACCOUNT ='$key' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect)); 
 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+(TS.RATE*(TU.UNITS-TS.MINUNITS)) WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='A' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));
 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+(TS.RATE*(TU.UNITS-TS.MINUNITS)) WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='B' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));

 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+75 WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='C' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));

 $aa="UPDATE PROCESSBILL  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+35 WHERE TU.ACCOUNT ='$key' AND TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='D' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));
$x="UPDATE PROCESSBILL  TU, PROCESSBILL TS  SET TU.TOTALCHARGES=TS.WATERCHARGES+TS.METERCHARGES WHERE  TU.ACCOUNT=TS.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="UPDATE $accountstable  SET DATE2='$date'   WHERE  account='$key' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


}    
$x="INSERT INTO $billstable(account,meternumber,current,previous,billed,units,deduction,charges,metercharges,balance,status,accountstatus,meterstatus,class,date,user) 
SELECT ACCOUNT,METERNUMBER,CURRENT,PREVIOUS,BILLED,BILLED,DEDUCTION,WATERCHARGES,METERCHARGES,TOTALCHARGES,CONCAT('PENDING'),CONCAT('$accountstatus'),CONCAT('ESTIMATE'),CONCAT('$class'),DATE,CONCAT('$user') FROM PROCESSBILL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));



$x="INSERT INTO events(user,session,action,date) SELECT CONCAT('$user'),DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('BILLED ACCOUNT $key ON $date'),DATE_ADD(NOW(), INTERVAL 7 HOUR)";
mysqli_query($connect,$x)or die(mysqli_error($connect));    
    
}

/////////////////////////////////
$x="DROP TABLE PROCESSBILL";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="BILLS UPDATED UPDATED";exit;
?>