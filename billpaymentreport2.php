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

$x="SELECT DATEDIFF('$date2','$date1') AS DIFF ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 { if($y['DIFF'] <0 ){$_SESSION['message']="INVALID DATES";exit;};  }}
$category=trim(addslashes(strtoupper($_SESSION['category'])));

$x="TRUNCATE TABLE BALANCEREPORT";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="TRUNCATE TABLE BILL";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="TRUNCATE TABLE  PAYMENT";
mysqli_query($connect,$x)or die(mysqli_error($connect));
//////////////////////
  $x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
 $billstablex='bills'.$y['NUMBER'];$zonename=$y['ZONE'];$wateraccountstablex='wateraccounts'.$y['NUMBER']; $nonwaterbillsx='nonwaterbills'.$y['NUMBER'];
 $n="INSERT INTO BALANCEREPORT (COMPANY,ZONE,ACCOUNT) SELECT CONCAT('$company'),CONCAT('$zonename'),ACCOUNT FROM $billstablex UNION SELECT CONCAT('$company'),CONCAT('$zonename'),ACCOUNT FROM $wateraccountstablex  UNION SELECT CONCAT('$company'),CONCAT('$zonename'),ACCOUNT FROM $nonwaterbillsx ";
mysqli_query($connect,$n)or die(mysqli_error($connect));


$n="INSERT INTO BILL(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(BALANCE) FROM $billstablex WHERE DATE < '$date1'  GROUP BY ACCOUNT  UNION SELECT ACCOUNT,SUM(AMOUNT) FROM  $nonwaterbillsx  WHERE DATE < '$date1'  GROUP BY ACCOUNT ";
mysqli_query($connect,$n)or die(mysqli_error($connect));

$n="INSERT INTO PAYMENT(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(CREDIT) FROM $wateraccountstablex WHERE DEPOSITDATE < '$date1'  GROUP BY ACCOUNT ";
//="INSERT INTO PAYMENT(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(CREDIT) FROM $wateraccountstablex WHERE  CODE =(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'WATER BILL') GROUP BY ACCOUNT ";

mysqli_query($connect,$n)or die(mysqli_error($connect));
  }}
  
///////////////////////////
$x="UPDATE BALANCEREPORT AS U1, BILL AS U2  SET   U1.PREVIOUS=U2.AMOUNT WHERE U1.ACCOUNT=U2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE BALANCEREPORT AS U1, PAYMENT AS U2  SET   U1.PREVIOUS=U1.PREVIOUS-U2.AMOUNT  WHERE U1.ACCOUNT=U2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BALANCEREPORT SET PREVIOUS=0 WHERE PREVIOUS IS NULL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="TRUNCATE PAYMENT";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="TRUNCATE BILL";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT NUMBER,ZONE FROM zones ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0)
{
 while ($y=@mysqli_fetch_array($x))
 {
 $billstablex='bills'.$y['NUMBER'];$zonename=$y['ZONE'];$wateraccountstablex='wateraccounts'.$y['NUMBER']; 

 $n="INSERT INTO PAYMENT(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(CREDIT) FROM $wateraccountstablex WHERE DEPOSITDATE >= '$date1' AND DEPOSITDATE <='$date2'   GROUP BY ACCOUNT ";
mysqli_query($connect,$n)or die(mysqli_error($connect));
$n="INSERT INTO BILL(ACCOUNT,AMOUNT) SELECT ACCOUNT,SUM(BALANCE) FROM $billstablex WHERE DATE >= '$date1'  AND DATE <='$date2' UNION  SELECT ACCOUNT,SUM(AMOUNT) FROM $nonwaterbillsx  WHERE DATE >= '$date1'  AND DATE <='$date2'  GROUP BY ACCOUNT ";
mysqli_query($connect,$n)or die(mysqli_error($connect));


 }}

$x="UPDATE BALANCEREPORT AS U1, BILL AS U2  SET   U1.CURRENT=U2.AMOUNT WHERE U1.ACCOUNT=U2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE BALANCEREPORT AS U1, PAYMENT AS U2  SET   U1.CURRENT=U1.CURRENT-U2.AMOUNT  WHERE U1.ACCOUNT=U2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BALANCEREPORT SET CURRENT=0 WHERE CURRENT IS NULL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));  
?>
<div id="accbaldata">
    <style>
        table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:left;
  } 
        
    </style>
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
         
        </thead>
        <tbody>
               <td  class="theader"  height="21" valign="top" ><?print $category; ?>ACCOUNT </td>
			  <td  class="theader"  height="21" valign="top" > PREVIOUS Bal</td>  
			   <td  class="theader"  height="21" valign="top" >CURRENT Bal</td> 
			    <td  class="theader"   style="text-align:left;" height="21" valign="top" >TOTAL Bal</td>   
				 
		</tr>
       <?php
 $x="SELECT ACCOUNT AS REFF,PREVIOUS,CURRENT  FROM  BALANCEREPORT  WHERE ZONE=(SELECT ZONE  FROM zones WHERE  NUMBER ='$category')  ORDER BY ACCOUNT ";


if($category=='ZONES')
{
$x="SELECT ZONE AS REFF,SUM(PREVIOUS) AS PREVIOUS,SUM(CURRENT) AS CURRENT   FROM  BALANCEREPORT GROUP BY ZONE  ";
}

if($category=='COMPANY')
{
$x="SELECT COMPANY AS REFF,SUM(PREVIOUS) AS PREVIOUS,SUM(CURRENT) AS CURRENT   FROM  BALANCEREPORT GROUP BY COMPANY  ";
}

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
	{
	 while ($y=@mysqli_fetch_array($x))
	 { 
	   echo"<tr   class='filterdata'  >
			<td  >".$y['REFF']."</td>
			  <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['PREVIOUS'],2)."</td>
			   <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['CURRENT'],2)."</td>
				<td   >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['CURRENT']+$y['PREVIOUS'],2)."</td>
	   </tr>";
	 }
	 }



 $x="SELECT SUM(PREVIOUS),SUM(CURRENT)  FROM  BALANCEREPORT WHERE ZONE=(SELECT ZONE  FROM zones WHERE  NUMBER ='$category')  ";
if($category=='ZONES')
{
	$x="SELECT SUM(PREVIOUS),SUM(CURRENT)  FROM  BALANCEREPORT ";
}

else if($category=='COMPANY')
{
	$x="SELECT SUM(PREVIOUS),SUM(CURRENT)  FROM  BALANCEREPORT ";
}

         $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
         if(mysqli_num_rows($x)>0)
         {
          while ($y=@mysqli_fetch_array($x))
          { 
            echo"<tr   class='filterdata'  >
                 <td  ><strong>TOTAL</strong></td>
                   <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>".number_format($y['SUM(PREVIOUS)'],2)."</strong></td>
                    <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>".number_format($y['SUM(CURRENT)'],2)."</strong></td>
                     <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>".number_format($y['SUM(CURRENT)']+$y['SUM(PREVIOUS)'],2)."</strong></td>
            </tr>";
          }
          }



	?>
        </tbody>
    </table>
	</div>