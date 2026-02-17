<?php
@session_start();
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x) <1){header("LOCATION:accessdenied4.php");}

 $x="CREATE TEMPORARY TABLE `consumeranalysis` (
  `id` INT NOT NULL,
  `category` TEXT NOT NULL,
  `connected` INT NOT NULL,
  `billed` FLOAT NOT NULL,
  `meterrent` FLOAT NOT NULL,
  `consumtion` FLOAT NOT NULL,
  `revenue` FLOAT NOT NULL,
  `running` INT NOT NULL,
  `estimate` INT NOT NULL,
  `meterstatus` TEXT NOT NULL,
  `accountstatus` TEXT NOT NULL,
   `class` text DEFAULT NULL,
  `nonactive` INT NOT NULL,
  `totalconnection` INT NOT NULL,
  `totalcharges` FLOAT NOT NULL,
  `totalrevenue` FLOAT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `consumeranalysis`   ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `consumeranalysis`   MODIFY `id` INT NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="CREATE TEMPORARY TABLE `billsanalysis` (
  `id` INT NOT NULL,
  `account` TEXT NOT NULL,
  `class` TEXT NOT NULL,
  `billed` FLOAT NOT NULL,
   `totalcharges` FLOAT NOT NULL,
  `meterrent` FLOAT NOT NULL,
  `consumtion` FLOAT NOT NULL,
  `meterstatus` TEXT NOT NULL,
  `accountstatus` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `billsanalysis`   ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `billsanalysis`   MODIFY `id` INT NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="CREATE TEMPORARY TABLE `revenueanalysis` (
  `id` INT NOT NULL,
  `account` TEXT NOT NULL,
  `class` TEXT NOT NULL,
  `totalrevenue` FLOAT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `revenueanalysis`   ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `revenueanalysis`   MODIFY `id` INT NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));

$date=$_SESSION['month'].'-01';
 $x="SELECT LAST_DAY('$date') AS LASTDATEX ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{ $lastdate=$y['LASTDATEX']; }}
		
$category=$_SESSION['category'];
 $x="SELECT LAST_DAY('$date') AS LASTDATEX ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{ $lastdate=$y['LASTDATEX']; }}
		
if ($category =='company') 
{
    ///////////////////////////////
  $x="INSERT INTO consumeranalysis (CATEGORY) SELECT CLASS FROM accountsstatus WHERE DATE >='$date' AND DATE <='$lastdate' GROUP  BY  CLASS  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS CNCTD     FROM accountsstatus   WHERE  STATUS='CONNECTED' AND DATE >='$date' AND DATE <='$lastdate'  GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.CONNECTED= t2.CNCTD";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS NOTCNCTD     FROM accountsstatus   WHERE  STATUS !='CONNECTED' AND DATE >='$date' AND DATE <='$lastdate'  GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.NONACTIVE= t2.NOTCNCTD";
mysqli_query($connect,$x)or die(mysqli_error($connect));

 $x="SELECT * FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{ 
		$zone=$y['number']; $nonwaterbillx='nonwaterbills'.$zone;$statushistoryx='statushistory'.$zone;$accountstablex='accounts'.$zone;$billstablex='bills'.$zone;$wateraccountsx='wateraccounts'.$zone;

$b="INSERT INTO billsanalysis(account,class,billed,meterrent,consumtion,meterstatus,totalcharges) SELECT ACCOUNT,CLASS,CHARGES,METERCHARGES,UNITS,METERSTATUS,BALANCE FROM $billstablex WHERE $billstablex.DATE >='$date'   AND  $billstablex.DATE <='$lastdate'  ";
mysqli_query($connect,$b)or die(mysqli_error($connect));

$b="INSERT INTO revenueanalysis(account,totalrevenue,class) SELECT $wateraccountsx.ACCOUNT,$wateraccountsx.CREDIT,CLASS FROM  $wateraccountsx,$accountstablex  WHERE DEPOSITDATE >='$date' AND  DEPOSITDATE <='$lastdate' AND $accountstablex.ACCOUNT=$wateraccountsx.ACCOUNT AND $wateraccountsx.CODE =(SELECT CODE FROM  paymentcode WHERE  NAME ='WATER BILL' LIMIT 1 )";
mysqli_query($connect,$b)or die(mysqli_error($connect));
}}

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,SUM(CONSUMTION) AS CONS,SUM(BILLED) AS BLD,SUM(METERRENT) AS MRENT,SUM(TOTALCHARGES) AS TTL     FROM  billsanalysis   GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.CONSUMTION= t2.CONS,t1.BILLED=t2.BLD,t1.METERRENT=t2.MRENT,t1.TOTALCHARGES=t2.TTL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,SUM(TOTALREVENUE) AS TTLREV FROM  revenueanalysis   GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.REVENUE= t2.TTLREV";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS RUNIN     FROM  billsanalysis   WHERE  METERSTATUS ='RUNNING'   GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.RUNNING= t2.RUNIN";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS EST     FROM  billsanalysis   WHERE  METERSTATUS ='ESTIMATE'   GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.ESTIMATE= t2.EST";
mysqli_query($connect,$x)or die(mysqli_error($connect));  

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS TTLAC     FROM accountsstatus   WHERE  DATE >='$date' AND DATE <='$lastdate'  GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.TOTALCONNECTION= t2.TTLAC";
mysqli_query($connect,$x)or die(mysqli_error($connect));
    
//////////////////////////////////////////////////    
}
else 
{
    ///////////////////////////////
  $x="INSERT INTO consumeranalysis (CATEGORY) SELECT CLASS FROM accountsstatus WHERE DATE >='$date' AND DATE <='$lastdate' AND ZONE='$category' GROUP  BY  CLASS  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS CNCTD     FROM accountsstatus   WHERE   ZONE='$category' AND STATUS='CONNECTED' AND DATE >='$date' AND DATE <='$lastdate'  GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.CONNECTED= t2.CNCTD";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS NOTCNCTD     FROM accountsstatus   WHERE  ZONE='$category' AND STATUS !='CONNECTED' AND DATE >='$date' AND DATE <='$lastdate'  GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.NONACTIVE= t2.NOTCNCTD";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS TTLAC     FROM accountsstatus   WHERE  ZONE='$category'  AND DATE >='$date' AND DATE <='$lastdate'  GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.TOTALCONNECTION= t2.TTLAC";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$billstablex='bills'.$category; $wateraccountsx='wateraccounts'.$category; $accountx='accounts'.$category; 
$b="INSERT INTO billsanalysis(account,class,billed,meterrent,consumtion,meterstatus,totalcharges) SELECT ACCOUNT,CLASS,CHARGES,METERCHARGES,UNITS,METERSTATUS,BALANCE FROM $billstablex WHERE $billstablex.DATE >='$date'   AND  $billstablex.DATE <='$lastdate'  ";
//$b="INSERT INTO billsanalysis(account,class) SELECT ACCOUNT,CLASS  FROM $billstablex WHERE $billstablex.DATE >='$date'   AND  $billstablex.DATE <='$lastdate'  ";
mysqli_query($connect,$b)or die(mysqli_error($connect));

$b="INSERT INTO revenueanalysis(account,totalrevenue,class) SELECT $wateraccountsx.ACCOUNT,$wateraccountsx.CREDIT,CLASS FROM  $wateraccountsx,$accountx  WHERE DEPOSITDATE >='$date' AND  DEPOSITDATE <='$lastdate' AND $accountx.ACCOUNT=$wateraccountsx.ACCOUNT AND $wateraccountsx.CODE =(SELECT CODE FROM  paymentcode WHERE  NAME ='WATER BILL' LIMIT 1 )";
mysqli_query($connect,$b)or die(mysqli_error($connect));


$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,SUM(CONSUMTION) AS CONS,SUM(BILLED) AS BLD,SUM(METERRENT) AS MRENT,SUM(TOTALCHARGES) AS TTL     FROM  billsanalysis   GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.CONSUMTION= t2.CONS,t1.BILLED=t2.BLD,t1.METERRENT=t2.MRENT,t1.TOTALCHARGES=t2.TTL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,SUM(TOTALREVENUE) AS TTLREV FROM  revenueanalysis   GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.REVENUE= t2.TTLREV";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS RUNIN     FROM  billsanalysis   WHERE  METERSTATUS ='RUNNING'   GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.RUNNING= t2.RUNIN";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE consumeranalysis t1  JOIN (     SELECT CLASS,COUNT(*) AS EST     FROM  billsanalysis   WHERE  METERSTATUS ='ESTIMATE'   GROUP BY CLASS ) t2 ON t1.CATEGORY = t2.CLASS SET t1.ESTIMATE= t2.EST";
mysqli_query($connect,$x)or die(mysqli_error($connect));  
 
//////////////////////////////////////////////////    
}

// Create/open the CSV file for writing
$csv_filename = 'data.csv';
$file = fopen($csv_filename, 'w');
$conn=$connect;

 if($category=='company')
 {$categoryx = str_replace('lawascoco_', "", $company);}
 else {
      $x="SELECT ZONE FROM zones WHERE NUMBER='$category' ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{ $categoryx=$y['ZONE']; }}
     
 }
 
fputcsv($file,array(' '.$categoryx.' CONSUMTION ANALYSIS REPORT  AS FROM '.$date.' TO'.$lastdate.' '));
$sql = "SELECT CATEGORY,CONNECTED,NONACTIVE,CONSUMTION,BILLED,METERRENT,TOTALCHARGES,RUNNING,ESTIMATE,REVENUE,TOTALCONNECTION FROM consumeranalysis ";
$result = $conn->query($sql);
fputcsv($file,array('CATEGORY','BILLED','M/RENT','CONS','ESTIMATE','RUNNING','ACTIVE','NON ACTIVE','TTL CONNECTION','TTL BILLED','TTL REVENUE'));
if ($result->num_rows > 0) {
    // Loop through each row of the result set
    while ($row = $result->fetch_assoc()) {
        // Write the row to the CSV file
        fputcsv($file,$row);
    }
} else {
    header("LOCATION:accessdenied4.php");exit;
}



$sql = "SELECT CONCAT('TOTAL'),SUM(CONNECTED),SUM(NONACTIVE),SUM(CONSUMTION),SUM(BILLED),SUM(METERRENT),SUM(TOTALCHARGES),SUM(RUNNING),SUM(ESTIMATE),SUM(REVENUE),SUM(TOTALCONNECTION) FROM consumeranalysis ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Loop through each row of the result set
    while ($row = $result->fetch_assoc()) {
        // Write the row to the CSV file
        fputcsv($file,$row);
    }
} else {
    header("LOCATION:accessdenied4.php");exit;
}

$x="SELECT SUM(CONSUMTION)  FROM consumeranalysis ";			
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
while ($y=@mysqli_fetch_array($x))
{
 $consumedvol=$y['SUM(CONSUMTION)'];
}}

if($category=='company')
 {
fputcsv($file,array(' '));
fputcsv($file,array('SUPPLY','PRODUCTION','METERED WATER','BULK','TTL WATER','UNBILLED NAVY BASE','U.F.W','U.F.W','Chl','NEW CONNECTION'));
    

 if($consumedvol <1){$consumedvol=0;}
 
  $x="SELECT COUNT(ID)  FROM statustrail  WHERE STATUS ='NEW CONNECTION' AND DATE >='$date' AND DATE <='$lastdate' ";
 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$neaccounts=$y['COUNT(ID)'];}}
		
	      $x="SELECT SUM(UNITS),SUM(CHLORINE)  FROM  waterproduction  WHERE  DATE >='$date' AND DATE <='$lastdate' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		    $ufwpercent=$y['SUM(UNITS)']-$consumedvol;
		    $ufwpercent=$ufwpercent/$y['SUM(UNITS)'];
		    $ufwpercent=$ufwpercent*100;
		    
fputcsv($file,array(str_replace('lawascoco_','',$_SESSION['company']),number_format($y['SUM(UNITS)'],2),number_format($consumedvol,2),'',number_format($consumedvol,2),' ',number_format($y['SUM(UNITS)']-$consumedvol,2),number_format($ufwpercent,2),number_format($y['SUM(CHLORINE)'],2),$neaccounts));
		}} 		    
		    
		    		
 }		

fclose($file);
header("LOCATION:downloadbilltemplate.php");
?>