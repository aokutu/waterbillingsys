<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


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

 ?>
<div  id="consumersdata">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
  table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:right;
  }
</style>
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%">
<h4   style="text-align:center">
 <strong>
 <?php 
 
 if($category=='company')
 {$categoryx = str_replace('lawascoco_', "", $company);}
 else 
 {
   $x="SELECT ZONE FROM zones WHERE NUMBER='$category' ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{ $categoryx=$y['ZONE']; }}
 
     
 }
 print $categoryx; ?>  
 CONSUMER ANALYSIS REPORT AS AT 
 <?php print $date."TO".$lastdate; ?> 
 <a href="consumeranalysistopdf.php"><i class="fas fa-file-pdf"></i> </a> 
 <a href="consumeranalysistoexcel.php"><i class="fas fa-file-excel"></i> </a>
 </strong></h4>


<table class="table">
        <thead>
         
          
								
									
		
        
        </thead>
        <tbody>
        <?php
    // $x="SELECT CLASS,ACCOUNT,TOTALREVENUE FROM revenueanalysis   ";
    
$x="SELECT CATEGORY,CONNECTED,NONACTIVE,CONSUMTION,BILLED,METERRENT,TOTALCHARGES,RUNNING,ESTIMATE,REVENUE,TOTALCONNECTION FROM consumeranalysis ";
     
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
?>
 <tr>
    <td class="theader"   valign="top">CATEGORY</td>
		 <td class="theader"   valign="top">BILLED</td>
				<td   class="theader"  height="21" valign="top" >M/RENT</td>
					<td   class="theader"  height="21" valign="top" >CONS M<sup>3</sup></td>
						<td   class="theader"  height="21" valign="top" >ESTIMATE</td>
							<td   class="theader"  height="21" valign="top" >RUNNING</td>
								<td   class="theader"  height="21" valign="top" >ACTIVE</td>
								
									<td   class="theader"  height="21" valign="top" >NON ACTIVE</td>
										<td   class="theader"  height="21" valign="top" >TTL CONNECTION</td>
											<td   class="theader"  height="21" valign="top" >TTL BILLED</td>
											 <td   class="theader"  height="21" valign="top" >TTL REVENUE</td>
											  </tr>
											
<?php 
		
		
		
		 while ($y=@mysqli_fetch_array($x))
		{

/* echo "<tr class='filterdata >
		       <td  >".$y['RUNNING']+$y['ESTIMATE']+$y['NONACTIVE']."</td>

<td  >".$y['CLASS']."</td>
        <td  >".number_format($y['TOTALREVENUE'],2)."</td>
</tr>";  */
//CONNECTED
	echo "<tr class='filterdata'>
	   <td  >".$y['CATEGORY']."</td>
        <td  >".number_format($y['BILLED'],2)."</td>
               <td  >".number_format($y['METERRENT'],2)."</td>
		  <td  >".number_format($y['CONSUMTION'],2)."</td>
		    
		     <td  >".$y['ESTIMATE']."</td>
		    <td  >".$y['RUNNING']."</td>
		    <td  >".$y['RUNNING']+$y['ESTIMATE']."</td>
		      <td  >".$y['NONACTIVE']."</td> 
		       <td  >".$y['TOTALCONNECTION']."</td>
		       <td  >".number_format($y['TOTALCHARGES'],2)."</td> 
		         <td  >".number_format($y['REVENUE'],2)."</td> 
		    
           </tr>";
          	
           
			
		}}
		
		
$x="SELECT SUM(CONNECTED),SUM(NONACTIVE),SUM(CONSUMTION),SUM(BILLED),SUM(METERRENT),SUM(TOTALCHARGES),SUM(RUNNING),SUM(ESTIMATE),SUM(REVENUE),SUM(TOTALCONNECTION) FROM consumeranalysis ";
     
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
 
		
		
		
		 while ($y=@mysqli_fetch_array($x))
		{

/* echo "<tr class='filterdata >
		       <td  >".$y['RUNNING']+$y['ESTIMATE']+$y['NONACTIVE']."</td>

<td  >".$y['CLASS']."</td>
        <td  >".number_format($y['TOTALREVENUE'],2)."</td>
</tr>";  */
//CONNECTED
	echo "<tr class='filterdata'>
	   <td  >TOTAL</td>
        <td  >".number_format($y['SUM(BILLED)'],2)."</td>
               <td  >".number_format($y['SUM(METERRENT)'],2)."</td>
		  <td  >".number_format($y['SUM(CONSUMTION)'],2)."</td>
		    
		     <td  >".$y['SUM(ESTIMATE)']."</td>
		    <td  >".$y['SUM(RUNNING)']."</td>
		    <td  >".$y['SUM(RUNNING)']+$y['SUM(ESTIMATE)']."</td>
		      <td  >".$y['SUM(NONACTIVE)']."</td> 
		       <td  >".$y['SUM(TOTALCONNECTION)']."</td>
		       <td  >".number_format($y['SUM(TOTALCHARGES)'],2)."</td> 
		         <td  >".number_format($y['SUM(REVENUE)'],2)."</td> 
		    
           </tr>";
          	
           
			
		}}
				
		
		
	 $x="SELECT SUM(CONSUMTION)  FROM consumeranalysis ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		    $consumedvol=$y['SUM(CONSUMTION)'];
		    
		    
		}}
?>
<?php 

if($category=='company')
 {
     
    print " <tr class='btn-info btn-sm'>
	   <td  >SUPPLY</td>
             <td  >PRODUCTION</td>
             	 <td  >METERED WATER</td>	
			 <td  >BULK</td>
		      <td  >TTL WATER</td>
		      <td  >UNBILLED <br>NAVY BASE</td>
		      <td  >U.F.W M<sup>3</sup></sup></td>
		      <td  >U.F.W %</td>
		       <td  >Chl (KGS)</td>
		       <td  >NEW CONNECTION</td>
		 </tr> "; 
  if($consumedvol <1){$consumedvol=0;}
 $x="SELECT COUNT(ID)  FROM statustrail  WHERE STATUS ='NEW CONNECTION' AND DATE >='$date' AND DATE <='$lastdate' ";
 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$neaccounts=$y['COUNT(ID)'];}}
 
 	      $x="SELECT ID  FROM  waterproduction  WHERE  DATE >='$date' AND DATE <='$lastdate' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		    
		      $x="SELECT SUM(UNITS),SUM(CHLORINE)  FROM  waterproduction  WHERE  DATE >='$date' AND DATE <='$lastdate' ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		    $ufwpercent=$y['SUM(UNITS)']-$consumedvol;
		    $ufwpercent=$ufwpercent/$y['SUM(UNITS)'];
		    $ufwpercent=$ufwpercent*100;
		    
		    
print "<tr class='filterdata'>
	   <td  >".str_replace('lawascoco_','',$_SESSION['company'])."</td>
             <td  >".number_format($y['SUM(UNITS)'],2)."</td>
             	 <td  >".number_format($consumedvol,2)."</td>	
			 <td  ></td>
		      <td  >".number_format($consumedvol,2)."</td>
		      <td  ></td>
		      <td  >".number_format($y['SUM(UNITS)']-$consumedvol,2)." M<sup>3</sup></sup></td>
		      <td  >".number_format($ufwpercent,2)." %</td>
		       <td  >".number_format($y['SUM(CHLORINE)'],2)."KGS</td>
		       <td  >".$neaccounts."</td>
		 </tr>";
		    
		    
		}} 		    
		    
		    
		}
		else 
		{}    
     
     
 }
?>

 
 
 <?php

 ?>
           


  </tbody>
    </table>

</div>