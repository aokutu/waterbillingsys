<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
if(empty($zone)){header("Location:loggin.php");exit;}
if (!isset($zone)){header("Location:loggin.php");exit;}
$x=isset($_SERVER['HTTP_REFERER']);
if($x==1){$connect=mysqli_connect('localhost','root','',$company);}  
else {header("Location:accessdenied2.php");exit;}
error_reporting(0);
//////////////
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$category=$_SESSION['category'];
 $x="TRUNCATE TABLE STATEMENT";mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$meterstablex='meters'.$i; 
$b="INSERT INTO STATEMENT (A,B,C,D) SELECT ACCOUNT,STATUS,SIZE,CONCAT('ZONE $i') FROM $meterstablex";
mysqli_query($connect,$b)or die(mysqli_error($connect));		
		}
		}	
//////////////////////////////
			
?>
<div  id="reportdata">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
 <h4   style="text-align:center"><strong><?php print $company;?>  METERS DISTRIBUTION REPORT GROUP BY <?php print $category;?></strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td class="theader"   valign="top"><?php print $category;?></td>	
		   <td class="theader"   valign="top">ZONE</td>	
		 <td class="theader"   valign="top">TALLY</td>		
		 
		
          </tr>
        </thead>
        <tbody>
        <?php
		if(empty($category)){ $x="SELECT COUNT(A),B AS CAT FROM  STATEMENT WHERE A  IS NULL ";}
		else if($category=='STATUS'){ $x="SELECT COUNT(A),B AS CAT,D FROM  STATEMENT GROUP BY D,B ORDER BY A,B";}
		else if($category=='ZONE'){ $x="SELECT COUNT(A),D AS CAT FROM  STATEMENT GROUP BY D ORDER BY A,D";}
		else if($category=='SIZE'){ $x="SELECT COUNT(A),C AS CAT,D FROM  STATEMENT GROUP BY D,C ORDER BY A,C";}
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
	 <td  >".$y['CAT']."</td>";
	  if(($category=='STATUS')||($category=='SIZE')){print "<td  >".$y['D']."</td>";}
	  else {print "<td  >TOTAL</td>";}
	  
          print"   <td  >".$y['COUNT(A)']."</td>		  
		     
		  
           </tr>";
		 }
		 
		 } 
		 if(empty($category)){ $x="SELECT COUNT(A)  FROM  STATEMENT WHERE A  IS NULL";}
		else { $x="SELECT COUNT(A)  FROM  STATEMENT ";}
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
	 <td  >TOTAL</td>
	  <td  >TOTAL</td>
             <td  >".$y['COUNT(A)']."</td>		  
		     
		  
           </tr>";
		 }
		 
		 }
		 
		 ?>
		 

  </tbody>
    </table>
<br />
</div>