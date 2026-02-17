<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT COUNT(ID) FROM $accountstable";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$ttl1=$y['COUNT(ID)'];}}
	$x="SELECT COUNT(ID) FROM $accountstable WHERE STATUS ='CONNECTED'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$ttl2=$y['COUNT(ID)'];}}
	
		$x="SELECT COUNT(ID) FROM $accountstable WHERE STATUS ='COR'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$ttl5=$y['COUNT(ID)'];}}
	
	$x="SELECT COUNT(ID) FROM $accountstable WHERE STATUS ='CONP'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$ttl6=$y['COUNT(ID)'];}}
	
	$x="SELECT COUNT(ID) FROM $accountstable WHERE STATUS ='NEW ACC'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$ttl7=$y['COUNT(ID)'];}}
	
	
	
		   $x="TRUNCATE  OPENTABLE1 ";mysqli_query($connect,$x)or die(mysqli_error($connect));
	   $x="INSERT INTO OPENTABLE1 (A,C,D) SELECT ACCOUNT,MAX(DATE),DATEDIFF(CURRENT_DATE,MAX(DATE)) FROM $billstable  WHERE  ACCOUNT IN(SELECT ACCOUNT FROM $accountstable WHERE STATUS='CONNECTED')    GROUP BY ACCOUNT  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT COUNT(A) FROM OPENTABLE1 WHERE D <=30 ORDER BY A";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	$ttl3=$y['COUNT(A)'];
		 }
		 
		 } 
		 
		 
		 $x="SELECT COUNT(A) FROM OPENTABLE1 WHERE D  >30 ORDER BY A";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	$ttl4=$y['COUNT(A)'];
		 }
		 
		 }
		 
		 
		 
		 
?>
<div id="details">
 <div class="container">
  <div class="row">
 
    <div class="col-sm-8" id="" >
	<h5>BILLS SUMMARY REPORT</h5>
	ZONE :<?php print "ZONE-".$zone;?><br>
	TOTAL A/CS :<?php print $ttl1; ?><br>
    <?php
	$x="SELECT COUNT(ID),STATUS FROM $accountstable GROUP BY STATUS";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{print $y['STATUS']."=".$y['COUNT(ID)']."<BR>";}}
	
	?>
<br>
	BILLED A/CS :<?php print  $ttl3;?><br>
	UNBILLED A/CS <?php print $ttl4;?><br>
	
	</div>
	
	<div class="col-sm-4" id="" ></div>
	</div>
	</div>
</div>




