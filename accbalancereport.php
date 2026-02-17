<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$date=$_SESSION['date'];
$date1=$_SESSION['date1'];
$date2=$_SESSION['date2'];
$category=trim(addslashes(strtoupper($_SESSION['category'])));
$x="SELECT DATEDIFF('$date2','$date1') AS DIFF ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 { if($y['DIFF'] <0 ){$_SESSION['message']="INVALID DATES";exit;};  }}
 
 $x="CREATE  TEMPORARY TABLE `BALANCEREPORTX` (
  `ID` bigint(20) NOT NULL,
  `COMPANY` text DEFAULT NULL,
  `ZONE` text DEFAULT NULL,
  `ACCOUNT` text DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `PREVIOUS` float DEFAULT NULL,
  `CURRENT` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";
 mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x=" CREATE TEMPORARY TABLE `BILLX` (
  `ACCOUNT` text DEFAULT NULL,
  `AMOUNT` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";
 mysqli_query($connect,$x)or die(mysqli_error($connect));
$x=" CREATE TEMPORARY TABLE `PAYMENTX` (
  `ACCOUNT` text DEFAULT NULL,
  `AMOUNT` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";
 mysqli_query($connect,$x)or die(mysqli_error($connect)); 
   $x="ALTER TABLE `BALANCEREPORTX`
  ADD PRIMARY KEY (`ID`);";
 mysqli_query($connect,$x)or die(mysqli_error($connect)); 
 $x="ALTER TABLE `BALANCEREPORTX`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
   mysqli_query($connect,$x)or die(mysqli_error($connect)); 
  
  //////////////////////
  $x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
 $billstablex='bills'.$y['NUMBER'];$zonename=$y['ZONE'];$wateraccountstablex='wateraccounts'.$y['NUMBER']; $nonwaterbillsx='nonwaterbills'.$y['NUMBER'];
 
 print $billstablex;
 $n="INSERT INTO BALANCEREPORTX (COMPANY,ZONE,ACCOUNT) SELECT CONCAT('$company'),CONCAT('$zonename'),ACCOUNT FROM $billstablex UNION SELECT CONCAT('$company'),CONCAT('$zonename'),ACCOUNT FROM $wateraccountstablex  UNION SELECT CONCAT('$company'),CONCAT('$zonename'),ACCOUNT FROM $nonwaterbillsx ";
mysqli_query($connect,$n)or die(mysqli_error($connect));

$n="INSERT INTO BILLX(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(BALANCE) FROM $billstablex WHERE DATE < '$date1'  GROUP BY ACCOUNT  UNION SELECT ACCOUNT,SUM(AMOUNT) FROM  $nonwaterbillsx  WHERE DATE < '$date1'  GROUP BY ACCOUNT ";
mysqli_query($connect,$n)or die(mysqli_error($connect));

$n="INSERT INTO PAYMENTX(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(CREDIT) FROM $wateraccountstablex WHERE DEPOSITDATE < '$date1'  GROUP BY ACCOUNT ";
//="INSERT INTO PAYMENT(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(CREDIT) FROM $wateraccountstablex WHERE  CODE =(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'WATER BILL') GROUP BY ACCOUNT ";

mysqli_query($connect,$n)or die(mysqli_error($connect));
  }}
  
///////////////////////////

$x="UPDATE BALANCEREPORTX AS U1, BILLX AS U2  SET   U1.PREVIOUS=U2.AMOUNT WHERE U1.ACCOUNT=U2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE BALANCEREPORTX AS U1, PAYMENTX AS U2  SET   U1.PREVIOUS=U1.PREVIOUS-U2.AMOUNT  WHERE U1.ACCOUNT=U2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BALANCEREPORTX SET PREVIOUS=0 WHERE PREVIOUS IS NULL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
 $billstablex='bills'.$y['NUMBER'];$zonename=$y['ZONE'];$wateraccountstablex='wateraccounts'.$y['NUMBER']; 

 $n="INSERT INTO PAYMENTX(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(CREDIT) FROM $wateraccountstablex WHERE DEPOSITDATE >= '$date1' AND DEPOSITDATE <='$date2'   GROUP BY ACCOUNT ";
mysqli_query($connect,$n)or die(mysqli_error($connect));
$n="INSERT INTO BILLX(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(BALANCE) FROM $billstablex WHERE DATE >= '$date1'  AND DATE <='$date2' UNION  SELECT ACCOUNT,SUM(AMOUNT) FROM $nonwaterbillsx  WHERE DATE >= '$date1'  AND DATE <='$date2'  GROUP BY ACCOUNT ";
mysqli_query($connect,$n)or die(mysqli_error($connect));


 }}
 
 $x="UPDATE BALANCEREPORTX AS U1, BILLX AS U2  SET   U1.CURRENT=U2.AMOUNT WHERE U1.ACCOUNT=U2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE BALANCEREPORTX AS U1, PAYMENTX AS U2  SET   U1.CURRENT=U1.CURRENT-U2.AMOUNT  WHERE U1.ACCOUNT=U2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BALANCEREPORTX SET CURRENT=0 WHERE CURRENT IS NULL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

if(($category !='ZONES')||($category!='COMPANY'))
{
   print $category; 
}
?>



<div id="accbaldata">
	<h4 align="center" style="text-decoration:underline;"><strong><?php 
	if($category =='COMPANY'){print $company; } 
	if($category =='ZONES'){print "ALL ZONES"; }
	else {
$x="SELECT ZONE   FROM  zones WHERE  NUMBER ='$category'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
	{
	 while ($y=@mysqli_fetch_array($x))
	 {
	print $y['ZONE'];	
	}}
}
	?> BALANCE REPORT FROM <?php print $date1; ?> TO <?php print $date2; ?></strong></h4>
<table class="table">
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  height="21" valign="top" ><?print $category; ?>ACCOUNT </td>
			  <td  class="theader"  height="21" valign="top" > PREVIOUS Bal</td>  
			   <td  class="theader"  height="21" valign="top" >CURRENT Bal</td> 
			    <td  class="theader" style="text-align:left;" height="21" valign="top" >TOTAL Bal</td>   
				 
		</tr>
        </thead>
        <tbody>
       <?php
 $x="SELECT ACCOUNT AS REFF,PREVIOUS,CURRENT  FROM  BALANCEREPORTX  WHERE ZONE=(SELECT ZONE  FROM zones WHERE  NUMBER ='$category')  ORDER BY ACCOUNT ";


if($category=='ZONES')
{
$x="SELECT ZONE AS REFF,SUM(PREVIOUS) AS PREVIOUS,SUM(CURRENT) AS CURRENT   FROM  BALANCEREPORTX GROUP BY ZONE  ";
}

if($category=='COMPANY')
{
$x="SELECT COMPANY AS REFF,SUM(PREVIOUS) AS PREVIOUS,SUM(CURRENT) AS CURRENT   FROM  BALANCEREPORTX GROUP BY COMPANY  ";
}

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
	{
	 while ($y=@mysqli_fetch_array($x))
	 { 
	   echo"<tr   class='filterdata'  >
			<td  >".$y['REFF']."</td>
			  <td  >".number_format($y['PREVIOUS'],2)."</td>
			   <td  >".number_format($y['CURRENT'],2)."</td>
				<td   >".number_format($y['CURRENT']+$y['PREVIOUS'],2)."</td>
	   </tr>";
	 }
	 }



 $x="SELECT SUM(PREVIOUS),SUM(CURRENT)  FROM  BALANCEREPORTX WHERE ZONE=(SELECT ZONE  FROM zones WHERE  NUMBER ='$category')  ";
if($category=='ZONES')
{
	$x="SELECT SUM(PREVIOUS),SUM(CURRENT)  FROM  BALANCEREPORTX ";
}

else if($category=='COMPANY')
{
	$x="SELECT SUM(PREVIOUS),SUM(CURRENT)  FROM  BALANCEREPORTX ";
}

         $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
         if(mysqli_num_rows($x)>0)
         {
          while ($y=@mysqli_fetch_array($x))
          { 
            echo"<tr   class='filterdata'  >
                 <td  ><strong>TOTAL</strong></td>
                   <td  ><strong>".number_format($y['SUM(PREVIOUS)'],2)."</strong></td>
                    <td  ><strong>".number_format($y['SUM(CURRENT)'],2)."</strong></td>
                     <td    ><strong>".number_format($y['SUM(CURRENT)']+$y['SUM(PREVIOUS)'],2)."</strong></td>
            </tr>";
          }
          }



	?>
        </tbody>
    </table>
	</div>