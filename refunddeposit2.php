<?php 
@session_start();

$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


$x="CREATE TEMPORARY TABLE DEPOSIT(REFF TEXT,ACCOUNT TEXT,AMOUNT FLOAT);";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$search=$_SESSION['category'];
if($search =='company')	
{

	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;
//////////////////////

$a="INSERT INTO DEPOSIT(REFF,ACCOUNT,AMOUNT) SELECT CONCAT('$company'),CONCAT('$company'),DEPOSIT FROM $accountstable WHERE DEPOSIT >0 ";
mysqli_query($connect,$a)or die(mysqli_error($connect));
	///////////////////////
	
		}
		}

		
	
}

else if($search =='zones')
{



	$x="SELECT number,zone FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;$zonename=$y['zone'];
//////////////////////

$a="INSERT INTO DEPOSIT(REFF,ACCOUNT,AMOUNT) SELECT CONCAT('$zonename'),CONCAT('$zonename'),DEPOSIT FROM $accountstable  WHERE DEPOSIT >0";
mysqli_query($connect,$a)or die(mysqli_error($connect));
	///////////////////////
	
		}
		}
		
	
}


else 
{

	$x="SELECT number,zone FROM zones WHERE NUMBER='".$_SESSION['category']."' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;$zonename=$y['zone'];
//////////////////////

$a="INSERT INTO DEPOSIT(REFF,ACCOUNT,AMOUNT) SELECT ACCOUNT,ACCOUNT,DEPOSIT FROM $accountstable  WHERE DEPOSIT >0 ";
mysqli_query($connect,$a)or die(mysqli_error($connect));
	///////////////////////
	
		}
		}
	
}



?>
<div id="reportx" >
<h4   style="text-align:center"><strong> REFUND DEPOSIT <?php print $search; ?> FROM   </strong></h4>
  <table class="table"  >
        <!--DWLayoutTable-->
        <thead>
          <tr  style='text-align:left'>
		   <td    height="21" valign="top" >REFF </td>
            <td    height="21" valign="top" >ACCOUNT  </td>
			<td    height="21" valign="top" >AMOUNT  </td>
			                			     
		</tr>
        </thead>
        <tbody>
       <?php 
	

$x="SELECT REFF,ACCOUNT,SUM(AMOUNT)  FROM DEPOSIT    GROUP BY REFF   ORDER BY  ACCOUNT ";


		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo"<tr   style='text-align:left' >
		    <td  >".$y['REFF']."</td>
                <td  >".$y['ACCOUNT']."</td>
				  <td  >".number_format($y['SUM(AMOUNT)'],2)."</td>
				
				   		
           </tr>";
		 }
		 }
		 
$x="SELECT SUM(AMOUNT)  FROM DEPOSIT    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo"<tr   class='btn-info btn-sm' style='text-align:left' >
		    <td  >TOTAL</td>
                <td  ></td>
				  <td  >".number_format($y['SUM(AMOUNT)'],2)."</td>
				
				   		
           </tr>";
		 }
		 }	
		 
		 



	?>
        </tbody>
    </table>
 <br>  
  </div>