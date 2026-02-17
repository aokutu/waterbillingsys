<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
	///
 $x="CREATE TEMPORARY TABLE WATERFLOWX(FLOW TEXT,INFLOW FLOAT,OUTFLOW FLOAT,COLLECTION FLOAT,REVENUE FLOAT,BILLED FLOAT,MONTH TEXT,YEAR INT,ZONE TEXT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if($_SESSION['category']=='company')
{
    
$x="INSERT INTO WATERFLOWX (INFLOW,MONTH,YEAR) SELECT UNITS,MONTHNAME(DATE),YEAR(DATE) FROM waterproduction WHERE  DATE >='$date1' AND  DATE <='$date2'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE WATERFLOWX  SET FLOW='INFLOW'  WHERE  FLOW  ='' ";mysqli_query($connect,$x)or die(mysqli_error($connect));

//////////////////////////////
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccountstable='wateraccounts'.$i;
//$b="INSERT INTO WATERFLOWX (OUTFLOW,MONTH,YEAR) SELECT BILLED,MONTH(DATE),YEAR(DATE) FROM  $billstable WHERE  DATE >='$date1' AND  DATE <='$date2'";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO WATERFLOWX (OUTFLOW,MONTH,YEAR) SELECT BILLED,MONTHNAME(DATE),YEAR(DATE) FROM  $billstable WHERE  DATE >='$date1' AND  DATE <='$date2' ";mysqli_query($connect,$b)or die(mysqli_error($connect));

$b="UPDATE WATERFLOWX  SET FLOW='OUTFLOW'  WHERE  FLOW  =''  ";mysqli_query($connect,$b)or die(mysqli_error($connect));

		
		}
		}      
    
}


if($_SESSION['category']=='zones')
{
	$x="SELECT number,zone FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccountstable='wateraccounts'.$i;$zonename=$y['zone'];
//$b="INSERT INTO WATERFLOWX (OUTFLOW,MONTH,YEAR) SELECT BILLED,MONTH(DATE),YEAR(DATE) FROM  $billstable WHERE  DATE >='$date1' AND  DATE <='$date2'";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO WATERFLOWX (OUTFLOW,MONTH,YEAR,ZONE) SELECT BILLED,MONTHNAME(DATE),YEAR(DATE),CONCAT('$zonename') FROM  $billstable WHERE  DATE >='$date1' AND  DATE <='$date2' ";mysqli_query($connect,$b)or die(mysqli_error($connect));

$b="UPDATE WATERFLOWX  SET FLOW='OUTFLOW'  WHERE  FLOW  =''  ";mysqli_query($connect,$b)or die(mysqli_error($connect));

		
		}
		}      
    
    
}

if($_SESSION['category']>=0)
{
	$x="SELECT number,zone FROM zones  WHERE number='".$_SESSION['category']."' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccountstable='wateraccounts'.$i;$zonename=$y['zone'];
//$b="INSERT INTO WATERFLOWX (OUTFLOW,MONTH,YEAR) SELECT BILLED,MONTH(DATE),YEAR(DATE) FROM  $billstable WHERE  DATE >='$date1' AND  DATE <='$date2'";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO WATERFLOWX (OUTFLOW,MONTH,YEAR,ZONE) SELECT BILLED,MONTHNAME(DATE),YEAR(DATE),CONCAT(ACCOUNT) FROM  $billstable WHERE  DATE >='$date1' AND  DATE <='$date2' ";mysqli_query($connect,$b)or die(mysqli_error($connect));

$b="UPDATE WATERFLOWX  SET FLOW='OUTFLOW'  WHERE  FLOW  =''  ";mysqli_query($connect,$b)or die(mysqli_error($connect));

		
		}
		}      
    
    
}

?>

<div  id="productionmetertable">
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
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
 <h4   style="text-align:center"><strong>  WATER  CONSUMTION ANALYSIS  FROM <?php print $date1;?> TO <?php print $date2;?> ON  <?php   print $_SESSION['category']; ?>     </strong></h4>

	  
      
       
        <?php
        
        
       if($_SESSION['category']>=0)
{
           $x="SELECT ZONE,FLOW,SUM(INFLOW),SUM(OUTFLOW),YEAR,MONTH,SUM(INFLOW)-SUM(OUTFLOW) AS BAL  FROM  WATERFLOWX GROUP BY ZONE,YEAR,MONTH   ORDER BY YEAR,MONTH,ZONE  ASC";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		?>
		<table class="table"  >
		 <thead>
         
        </thead>
        <tbody>
             <tr>
		 <td class="theader"   valign="top"><?php print $_SESSION['category']; ?>PERIOD</td>	
		  <td class="theader"   valign="top">ACOUNT</td>		
		 
		   <td  class="theader" valign="top">WATER BILLED</td>
           
			
          </tr>
		<?php
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata' style='font-weight:bold;' >
	 <td  >".$y['YEAR']."/".$y['MONTH']."</td>		
             <td  >".$y['ZONE']."</td>	  

		    <td >".number_format($y['SUM(OUTFLOW)'],2)." M <sup>3</sup></td>
          
		    
		  	
           </tr>";
		 }
		 
		 }
		 
  $x="SELECT ZONE,FLOW,SUM(OUTFLOW),YEAR,MONTH  FROM  WATERFLOWX ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		    
	 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata' style='font-weight:bold;' >
	 <td  ></td>		
             <td  >TOTAL </td>	  

		    <td >".number_format($y['SUM(OUTFLOW)'],2)." M <sup>3</sup></td>
          
		    
		  	
           </tr>";
		 }		    
		    
		    
		    
		}
		 
} 

else if($_SESSION['category']=='company')
{
           $x="SELECT FLOW,SUM(INFLOW),SUM(OUTFLOW),YEAR,MONTH,SUM(INFLOW)-SUM(OUTFLOW) AS BAL  FROM  WATERFLOWX   GROUP BY YEAR,MONTH ORDER BY YEAR,MONTH";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ ?>
		<table class="table"  >
		 <thead>
          <tr>
		 <td class="theader"   valign="top">COMPANY</td>	
		  <td class="theader"   valign="top">REFF</td>		
		  <td  class="theader" valign="top">WATER GENERATED</td>
		   <td  class="theader" valign="top">WATER BILLED</td>
            <td   class="theader"  height="21" valign="top" >LOSS</td>
			
          </tr>
        </thead>
        <tbody>
		<?php
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr >
	  <td  >".str_replace("lawascoco_","",$company) ."</td>
             <td  >".$y['YEAR']."/".$y['MONTH']."</td>		  
		   <td >".number_format($y['SUM(INFLOW)'],2)."M <sup>3</sup></td>
		    <td >".number_format($y['SUM(OUTFLOW)'],2)."M <sup>3</sup></td>
           <td  >".number_format( $y['BAL'],2)."M <sup>3</sup></td>
		    
		  	
           </tr>";
		 }
		 
		 }
}
  
else  if($_SESSION['category']=='zones')
{
           $x="SELECT ZONE,FLOW,SUM(INFLOW),SUM(OUTFLOW),YEAR,MONTH,SUM(INFLOW)-SUM(OUTFLOW) AS BAL  FROM  WATERFLOWX GROUP BY ZONE,YEAR,MONTH   ORDER BY YEAR,MONTH,ZONE  ASC";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		?>
		<table class="table"  >
		 <thead>
          <tr>
		 <td class="theader"   valign="top">PERIOD</td>	
		  <td class="theader"   valign="top">ZONES</td>		
		 
		   <td  class="theader" valign="top">WATER BILLED</td>
           
			
          </tr>
        </thead>
        <tbody>
		<?php
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata' style='font-weight:bold;' >
	 <td  >".$y['YEAR']."/".$y['MONTH']."</td>		
             <td  >".$y['ZONE']."</td>	  

		    <td >".number_format($y['SUM(OUTFLOW)'],2)."M <sup>3</sup></td>
          
		    
		  	
           </tr>";
		 }
		 
		 }
}
 ?>
		 

  </tbody>
    </table>
<br />
</div> 
