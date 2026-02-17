<?php
@session_start();
require_once 'backup/vendor/autoload.php'; // Include Dompdf autoload file
use Dompdf\Dompdf;
use Dompdf\Options;
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS' OR  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS' ";
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

$path = 'letterhead.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

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
$conn=$connect;

// Create a MySQL connection
//$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 $x="SELECT SUM(CONSUMTION)  FROM consumeranalysis ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		    $consumedvol=$y['SUM(CONSUMTION)'];
		    
		    
		}}
		
// Fetch data from MySQL
$sql = "SELECT CATEGORY,CONNECTED,NONACTIVE,ROUND(CONSUMTION,2),ROUND(BILLED,2),ROUND(METERRENT,2),ROUND(TOTALCHARGES,2),RUNNING,ESTIMATE,ROUND(REVENUE,2),TOTALCONNECTION FROM consumeranalysis ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start HTML content with table and styles
    $html = '<html><body>';
    $html .= '<style>';
    $html .= 'body {font-size:80%; }table { border-collapse: collapse; width: 100%; }';
    $html .= 'th, td { border: 1px solid black; padding: 8px; }';
    $html .= '</style>';
    $html .= '<img src="'.$base64.'" width="500px" height="150px"/>';
    $html .='<h4>'.$categoryx.'CONSUMER ANALYSIS REPORT AS AT '.$date.'TO '.$lastdate.' </h4>';
    $html .= '<table>';
    $html .= ' <tr>
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
											  </tr>';

    // Output data of each row in table rows
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['CATEGORY'] . '</td>';
         $html .= '<td>' .$row['ROUND(BILLED,2)'] . '</td>';
          $html .= '<td>' . $row['ROUND(METERRENT,2)'] . '</td>';
           $html .= '<td>' . $row['ROUND(CONSUMTION,2)'] . '</td>';
            $html .= '<td>' . $row['ESTIMATE'] . '</td>';
             $html .= '<td>' .$row['RUNNING']. '</td>';
              $html .= '<td>' . $row['RUNNING']+$row['ESTIMATE']. '</td>';
               $html .= '<td>' . $row['NONACTIVE'] . '</td>';
                $html .= '<td>' . $row['TOTALCONNECTION'] . '</td>';
                $html .= '<td>' . $row['ROUND(TOTALCHARGES,2)'] . '</td>';
                  $html .= '<td>' . $row['ROUND(REVENUE,2)'] . '</td>';
        $html .= '</tr>';
    }

$sql = "SELECT SUM(CONNECTED),SUM(NONACTIVE),ROUND(SUM(CONSUMTION),2),ROUND(SUM(BILLED),2),ROUND(SUM(METERRENT),2),ROUND(SUM(TOTALCHARGES),2),SUM(RUNNING),SUM(ESTIMATE),ROUND(SUM(REVENUE),2),SUM(TOTALCONNECTION) FROM consumeranalysis ";
$result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>TOTAL</td>';
         $html .= '<td>' .$row['ROUND(SUM(BILLED),2)'] . '</td>';
          $html .= '<td>' . $row['ROUND(SUM(METERRENT),2)'] . '</td>';
           $html .= '<td>' . $row['ROUND(SUM(CONSUMTION),2)'] . '</td>';
            $html .= '<td>' . $row['SUM(ESTIMATE)'] . '</td>';
             $html .= '<td>' .$row['SUM(RUNNING)']. '</td>';
              $html .= '<td>' . $row['SUM(RUNNING)']+$row['SUM(ESTIMATE)']. '</td>';
               $html .= '<td>' . $row['SUM(NONACTIVE)'] . '</td>';
                $html .= '<td>' . $row['SUM(TOTALCONNECTION)'] . '</td>';
                $html .= '<td>' . $row['ROUND(SUM(TOTALCHARGES),2)'] . '</td>';
                  $html .= '<td>' . $row['ROUND(SUM(REVENUE),2)'] . '</td>';
        $html .= '</tr>';
    }
    // Close table and HTML content
    
    
    if($category=='company')
{
  $html .='<tr >
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
		        <td  ></td>
		 </tr>';  
    
    if($consumedvol <1){$consumedvol=0;}
  $x="SELECT COUNT(ID)  FROM statustrail  WHERE STATUS ='NEW CONNECTION' AND DATE >='$date' AND DATE <='$lastdate' ";
 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$neaccounts=$y['COUNT(ID)'];}}
///////////////////////////		
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
		    
		    
  $html .= "<tr>
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
		        <td  ></td>
		 </tr>";
		    
		    
		}} 		    
		    
		    
		}
		else 
		{}   
}
  		
   
    $html .= '</table>';
    $html.= "<table><tr  >
		      <td  >PREPARED BY</td>
		       <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		        <td  >SIGN</td>
		      <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		         <td  >DATE</td>
		       <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		 
		 <tr>
		      <td  >FINANCIAL MNG</td>
		      <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		        <td  >SIGN</td>
		       <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		         <td  >DATE</td>
		       <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		 
		 <tr >
		      <td  >TECHNICAL MNG</td>
		      <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		        <td  >SIGN</td>
		       <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		         <td  >DATE</td>
		       <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		 <tr >
		      <td  >MANAGING DIRECTOR</td>
		      <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		        <td  >SIGN</td>
		       <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		         <td  >DATE</td>
		       <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr></table>";
    $html .= '</body></html>';

    // Create PDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Output the PDF as a file (download)
    $dompdf->stream('mysql_data.pdf', array('Attachment' => 0));
} else {
    echo 'No data found.';
}



// Close MySQL connection
$conn->close();
?>
