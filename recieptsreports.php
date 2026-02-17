<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$date=$_SESSION['date'];
$date1=$_SESSION['date1'];
$date2=$_SESSION['date2'];
$category=$_SESSION['category'];



$x="CREATE TEMPORARY TABLE RECIEPTSREPORT(ZONE TEXT,ACCOUNT TEXT,DATE DATE,RECIEPT TEXT,TRANSACTION TEXT,DEPOSITDATE DATE,CREDIT FLOAT,AMOUNT FLOAT,DETAILS TEXT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT *,zone FROM zones ";
 $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
 if(mysqli_num_rows($x)>0)
		{
	while ($y=@mysqli_fetch_array($x))
		{
$i=$y['number'];$billstablex='bills'.$i;$nonwaterbillsx='nonwaterbills'.$i;$wateraccountsx='wateraccounts'.$i;$zonename=$y['zone'];

$b="INSERT INTO RECIEPTSREPORT (ZONE,ACCOUNT,DATE,RECIEPT,AMOUNT,DETAILS,TRANSACTION,DEPOSITDATE) SELECT CONCAT('$zonename'),ACCOUNT,DATE,RECIEPTNUMBER,CREDIT,CODE,TRANSACTION,DEPOSITDATE  FROM $wateraccountsx  WHERE DEPOSITDATE >='".$_SESSION['date1']."'  AND  DEPOSITDATE <='".$_SESSION['date2']."'    ";
mysqli_query($connect,$b)or die(mysqli_error($connect));


			
			
		}
	
	}



 

 
 ?>
 <div id="accbaldatax"></div>
<div  id="accbaldata">
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
 <h4   style="text-align:center;"><strong><u><?php print $company;?> RECIEPTS DISTRIBUTION <br> FROM  <?php print $_SESSION['date1']; ?> TO <?php print $_SESSION['date2']; ?> </u> </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->

        <tbody>
        <?php
	 if($category =='company')
	 {
		 
        $x="SELECT COUNT(RECIEPT),SUM(AMOUNT) FROM RECIEPTSREPORT  ORDER BY RECIEPT,DATE ASC  ";			
        $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
    if(mysqli_num_rows($x)>0)
    {
       
        print '     <tr class="btn-info btn-sm" ">
        <td    height="21" valign="top" >ZONE  </td>
  <td     height="21" valign="top" >ACCOUNT  </td>		 
          <td     height="21" valign="top" >DATE</td>
      <td     height="21" valign="top" >RECIEPT</td>
      <td    height="21" valign="top" >AMOUNT </td>
      <td    height="21" valign="top" >DEPOSIT DATE   </td>
      <td    height="21" valign="top" >BANK SLIP   </td>
        </tr>'; 

     while ($y=@mysqli_fetch_array($x))
    { 
 echo"<tr class='filterdata'>
 <td >".$company."</td>
                <td ></td>
    <td ></td>
        <td >".$y['COUNT(RECIEPT)']."</td>
        <td >".number_format($y['SUM(AMOUNT)'],2)."</td>
        <td ></td>
        <td ></td>
                </tr>";
        
    }}
		 
		 
		 
	 }
else  if($category =='zones')
	 {
        $x="SELECT ZONE,ACCOUNT,DATE,RECIEPT,SUM(AMOUNT),DETAILS,TRANSACTION,DEPOSITDATE FROM RECIEPTSREPORT  GROUP BY  RECIEPT ORDER BY RECIEPT,DATE ASC  ";			
        $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
    if(mysqli_num_rows($x)>0)
    {
      print '     <tr class="btn-info btn-sm" ">
      <td    height="21" valign="top" >ZONE  </td>
<td     height="21" valign="top" >ACCOUNT  </td>		 
        <td     height="21" valign="top" >DATE</td>
    <td     height="21" valign="top" >RECIEPT</td>
    <td    height="21" valign="top" >AMOUNT </td>
    <td    height="21" valign="top" >DEPOSIT DATE   </td>
    <td    height="21" valign="top" >BANK SLIP   </td>
      </tr>'; 
     while ($y=@mysqli_fetch_array($x))
    { 
 echo"<tr class='filterdata'>
 <td >".$y['ZONE']."</td>
                <td >".$y['ACCOUNT']."</td>
    <td >".$y['DATE']."</td>
        <td >".sprintf("%07d",$y['RECIEPT'])."</td>
        <td >".number_format($y['SUM(AMOUNT)'],2)."</td>
        <td >".$y['DEPOSITDATE']."</td>
        <td >        
        <details  ><summary>".$y['TRANSACTION']."</summary>";
        $n="SELECT TRANSACTION,AMOUNT,DETAILS  FROM RECIEPTSREPORT  WHERE RECIEPT ='".$y['RECIEPT']." '  ";			
        $n=mysqli_query($connect,$n)or die(mysqli_error($connect));
    if(mysqli_num_rows($n)>0)
    {
       
     while ($m=@mysqli_fetch_array($n))
    { print "<div   style='font-size:80%;' >CODE ". $m['DETAILS']." | ".number_format($m['AMOUNT'],2)."</div> <br>";}}

       
	
	print" </details>
        
        </td>
       
                </tr>";
        
    }}

     }	

else 
	 {
		 ///MODE TEXT,DATE DATE,RECIEPT TEXT,AMOUNT FLOAT,DETAILS TEXT
		  $x="SELECT ZONE,ACCOUNT,DATE,RECIEPT,AMOUNT,DETAILS FROM RECIEPTSREPORT  WHERE ZONE ='$category'  ORDER BY RECIEPT,DATE ASC  ";			
          $x="SELECT ZONE,ACCOUNT,DATE,RECIEPT,SUM(AMOUNT),DETAILS,TRANSACTION,DEPOSITDATE FROM RECIEPTSREPORT  WHERE ZONE ='$category'   GROUP BY  RECIEPT ORDER BY RECIEPT,DATE ASC  ";			
          $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
      if(mysqli_num_rows($x)>0)
      {
        print '     <tr class="btn-info btn-sm" ">
        <td    height="21" valign="top" >ZONE  </td>
  <td     height="21" valign="top" >ACCOUNT  </td>		 
          <td     height="21" valign="top" >DATE</td>
      <td     height="21" valign="top" >RECIEPT</td>
      <td    height="21" valign="top" >AMOUNT </td>
      <td    height="21" valign="top" >DEPOSIT DATE   </td>
      <td    height="21" valign="top" >BANK SLIP   </td>
        </tr>'; 
       while ($y=@mysqli_fetch_array($x))
      { 
   echo"<tr class='filterdata'>
   <td >".$y['ZONE']."</td>
                  <td >".$y['ACCOUNT']."</td>
      <td >".$y['DATE']."</td>
          <td >".sprintf("%07d",$y['RECIEPT'])."</td>
          <td >".number_format($y['SUM(AMOUNT)'],2)."</td>
          <td >".$y['DEPOSITDATE']."</td>
          <td >        
          <details  ><summary>".$y['TRANSACTION']."</summary>";
          $n="SELECT TRANSACTION,AMOUNT,DETAILS  FROM RECIEPTSREPORT  WHERE RECIEPT ='".$y['RECIEPT']." '  ";			
          $n=mysqli_query($connect,$n)or die(mysqli_error($connect));
      if(mysqli_num_rows($n)>0)
      {
         
       while ($m=@mysqli_fetch_array($n))
      { print "<div   style='font-size:80%;' >CODE ". $m['DETAILS']." | ".number_format($m['AMOUNT'],2)."</div> <br>";}}
  
         
      
      print" </details>
          
          </td>
         
                  </tr>";
          
      }}	
		 
		 
		 
	 }	 




     if($category =='company')
	 {
		 
        $x="SELECT COUNT(RECIEPT),SUM(AMOUNT) FROM RECIEPTSREPORT  ORDER BY RECIEPT,DATE ASC  ";			
        $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
    if(mysqli_num_rows($x)>0)
    {
       


     while ($y=@mysqli_fetch_array($x))
    { 
 echo"<tr class='btn-info btn-sm'>
 <td >TOTAL</td>
                <td ></td>
    <td ></td>
        <td >".$y['COUNT(RECIEPT)']."</td>
        <td >".number_format($y['SUM(AMOUNT)'],2)."</td>
        <td ></td>
        <td ></td>
                </tr>";
        
    }}
		 
		 
		 
	 }
else  if($category =='zones')
	 {
        $x="SELECT SUM(AMOUNT),COUNT(RECIEPT) FROM RECIEPTSREPORT    ";			
        $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
    if(mysqli_num_rows($x)>0)
    {
       
     while ($y=@mysqli_fetch_array($x))
    { 
 echo"<tr  class='btn-info btn-sm' >
 <td >TOTAL</td>
                <td ></td>
    <td ></td>
        <td >".$y['COUNT(RECIEPT)']."</td>
        <td >".number_format($y['SUM(AMOUNT)'],2)."</td>
        <td ></td>
        <td > </td>
       
                </tr>";
        
    }}

     }	

else 
	 {
		 ///MODE TEXT,DATE DATE,RECIEPT TEXT,AMOUNT FLOAT,DETAILS TEXT
          $x="SELECT COUNT(RECIEPT),SUM(AMOUNT) FROM RECIEPTSREPORT  WHERE ZONE ='$category' ";			
          $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
      if(mysqli_num_rows($x)>0)
      {
         
       while ($y=@mysqli_fetch_array($x))
      { 
   echo"<tr class='btn-info btn-sm' >
   <td >TOTAL</td>
                  <td ></td>
      <td ></td>
          <td >".$y['COUNT(RECIEPT)']."</td>
          <td >".number_format($y['SUM(AMOUNT)'],2)."</td>
          <td ></td>
          <td >  
          </td>  </tr>";
          
      }}	
		 
		 
		 
	 }
 

 ?>
		 

  </tbody>
    </table>
<br />
</div>