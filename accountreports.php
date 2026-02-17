<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW REPORTS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$x="CREATE TEMPORARY TABLE ACCOUNTSTATUS(STATUS TEXT,ACCOUNT TEXT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));

if($_SESSION['category']=='CLASS')
{
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;
	$a="INSERT INTO ACCOUNTSTATUS(ACCOUNT,STATUS) SELECT ACCOUNT,CLASS FROM $accountstable ";
	mysqli_query($connect,$a)or die(mysqli_error($connect));
		}}

    
}

if($_SESSION['category']=='STATUS')
{
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;
	$a="INSERT INTO ACCOUNTSTATUS(ACCOUNT,STATUS) SELECT ACCOUNT,STATUS FROM $accountstable ";
	mysqli_query($connect,$a)or die(mysqli_error($connect));
		}}

    
}

if($_SESSION['category']=='STATUS2')
{
$a="INSERT INTO ACCOUNTSTATUS(ACCOUNT,STATUS) SELECT METERNUMBER,STATUS FROM clientmetersreg ";
	mysqli_query($connect,$a)or die(mysqli_error($connect));

    
}

if($_SESSION['category']=='SIZE')
{
$a="INSERT INTO ACCOUNTSTATUS(ACCOUNT,STATUS) SELECT METERNUMBER,SIZE FROM clientmetersreg ";
	mysqli_query($connect,$a)or die(mysqli_error($connect));

    
}


if($_SESSION['category']=='LOCATION')
{
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;
	$a="INSERT INTO ACCOUNTSTATUS(ACCOUNT,STATUS) SELECT ACCOUNT,LOCATION FROM $accountstable ";
	mysqli_query($connect,$a)or die(mysqli_error($connect));
		}}

    
}

if($_SESSION['category']=='ZONE')
{
	$x="SELECT number,zone FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;$zone=$y['zone'];
	$a="INSERT INTO ACCOUNTSTATUS(ACCOUNT,STATUS) SELECT ACCOUNT,CONCAT('$zone') LOCATION FROM $accountstable ";
	mysqli_query($connect,$a)or die(mysqli_error($connect));
		}}

    
}
?>
 
<div id="reportdata">
  <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  width ="15%"  height="21" valign="top" ><?php  print $_SESSION['category'];?>	  </td>
			 <td  class="theader"   width ="15%"  height="21" valign="top" >TALLY</td> 
	           
			   
          </tr>
        </thead>
        <tbody>
       <?php
	$x=$connect->query("SELECT STATUS,COUNT(STATUS) AS TALLY FROM ACCOUNTSTATUS  GROUP  BY STATUS ");
	while ($data = $x->fetch_object())
{ 
		   echo"<tr class='filterdata'>
                <td   width ='15%'  >".$data->STATUS."</td>
                <td   width ='15%'   >".$data->TALLY."</td>
                
		
           </tr>";
		 }
		$x=$connect->query("SELECT COUNT(STATUS) AS TALLY FROM ACCOUNTSTATUS   ");
	while ($data = $x->fetch_object())
{ 
		   echo"<tr class='filterdata' style=' font-weight: bold;'>
                <td   width ='15%'  >TOTAL</td>
                <td   width ='15%'   >".$data->TALLY."</td>
                
		
           </tr>";
		 }

	?>
        </tbody>
        </table>


</div>

