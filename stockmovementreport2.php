<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
set_time_limit(0);
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   REGEXP  'INVENTORY REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$item=trim(addslashes(strtoupper($_SESSION['item '])));
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];


$x="CREATE TEMPORARY TABLE STOCKBAL(QUANTITY FLOAT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));

	$x="INSERT INTO STOCKBAL(QUANTITY) SELECT SUM(QUANTITY)  FROM STOCKIN WHERE ITEM ='$item' AND DATE <'$date1'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO STOCKBAL(QUANTITY) SELECT SUM(QUANTITY)  FROM ADJUSTMENT  WHERE ITEM ='$item' AND DATE <'$date1'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO STOCKBAL(QUANTITY) SELECT SUM(QUANTITY)*-1  FROM STOCKOUT WHERE ITEM ='$item' AND DATE <'$date1'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="CREATE TEMPORARY TABLE STOCKCARD(ID INT,A TEXT,B TEXT,C TEXT,D TEXT,E TEXT,F TEXT,G TEXT,H TEXT,I TEXT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE STOCKCARD ADD PRIMARY KEY (`ID`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE STOCKCARD MODIFY ID int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  STOCKCARD (C,F,B,A) SELECT IFNULL(SUM(QUANTITY),0),SUM(QUANTITY),CONCAT('OPENING BAL'),CONCAT('$date1') FROM STOCKBAL";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  STOCKCARD (A,B,C,F,G,H) SELECT DATE,CONCAT('PURCHASES'),STOCKIN.QUANTITY,STOCKIN.QUANTITY,VOUCHERNUMBER,RECEIPIENT FROM STOCKIN
WHERE STOCKIN.ITEM='$item' AND DATE >= '$date1' AND DATE <='$date2' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="INSERT INTO  STOCKCARD (A,B,D,F,G,H,I) SELECT DATE,CONCAT('STOCKOUT'),STOCKOUT.QUANTITY,-1*STOCKOUT.QUANTITY,TRANSACTIONREFF,REQUISITIONER,PURPOSE FROM STOCKOUT
WHERE STOCKOUT.ITEM='$item' AND DATE >= '$date1' AND DATE <='$date2' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));


//$x="UPDATE  STOCKCARD  TU, requisition TS  SET TU.G=TS.serialnumber  WHERE TU.G=TS.transactionreff AND TU.B='STOCKOUT' ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  STOCKCARD (A,B,C,F) SELECT DATE,DESCRIPTION,QUANTITY,QUANTITY FROM ADJUSTMENT
WHERE ITEM='$item' AND DATE >= '$date1' AND DATE <='$date2' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE STOCKCARD SET F=0 WHERE F IS NULL";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT ITEMCODE,MINSTOCKLEVEL,UNITS,LOCATION FROM  INVENTORY  WHERE ITEM='$item' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ 
		 while ($y=@mysqli_fetch_array($x))
		{ $code=$y['ITEMCODE'];$units=$y['UNITS'];$minlevel=$y['MINSTOCKLEVEL'];$location=$y['LOCATION']; }}
	
	
?>
<div id="stockmovementreport" >
<style>
#stockcardheader{font-weight:bold;font-size:120%;text-align:left;
border: 1px solid black;border-collapse: collapse;
}
#stockcardheader >div{border: 1px solid black;border-collapse: collapse;}

</style><hr>
<h3 style="font-weight:bold;font-size:170%;text-align:center;text-decoration:underline;">STOCK CARD REPORT</h3>
  <div class="container" id="stockcardheader">
  <div class="row">
  <div class="col-sm-10" >DESCRIPTION:<?php print $item;   ?></div>
  <div class="col-sm-2" >UNITS:<?php print $units;   ?>   </div>
  </div>
  
  
  <div class="row">
  <div class="col-sm-10" >RE ORDER LEVEL:<?php print $minlevel;?> LOCATION:<?php print $location; ?></div>
  <div class="col-sm-2" >CODE:<?php print $code;?></div>
  
  </div>
  </div>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr  style='text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;' >
		  <td  class="theader" height="21" valign="top" >DATE  </td>
		   <td  class="theader"   height="21" valign="top" >TRANSACTION </td>
		    <td  class="theader" width='10%'  height="21" valign="top" >ISSUED TO </td>
			<td  class="theader" width='20%'   height="21" valign="top" >PURPOSE </td>
		   <td width='15%' class="theader"   height="21" valign="top" >GOODS RECIEVED/ISSUE NOTE # </td>
		   <td  class="theader"   height="21" valign="top" >IN </td>
		   <td  class="theader"   height="21" valign="top" >OUT </td>
		    <td  class="theader"   height="21" valign="top" >BALANCE </td>
			
          </tr>
        </thead>
        <tbody>
		
	
       <?php
		   $x="SET @TTL=0";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SELECT I,G,A,B,C,D,E,H,F,(@TTL := F + @TTL) AS TTLSUM FROM STOCKCARD ORDER BY A ASC  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ 
		 while ($y=@mysqli_fetch_array($x))
		 {  $ttl=$y['TTLSUM'];
		   echo"<tr class='filterdata'  style='text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;' >
				  <td >".$y['A']."</td>
				   <td >".$y['B']."</td>
				   <td  width='10%'   >".$y['H']."</td>
				    <td width='20%' >".$y['I']."</td>
				    <td width='15%' >".$y['G']."</td>
				    <td >".$y['C']."</td>
					 <td >".$y['D']."</td>
					 <td >". $y['TTLSUM']."</td>

           </tr>";

		 }
		 
		 
		
		 
		 }
		 
		 print  "<tr class='filterdata' style='font-weight:bold;'>
				  <td ></td>
				   <td ></td>
				   <td   width='10%'  ></td>
				    <td width='20%' ></td>
				    <td  width='15%'>TOTAL</td>
				    <td ></td>
					 <td ></td>
					 <td >".$ttl."</td>

           </tr>";
	?>
	<tr>
	<td></td>
	</tr>
        </tbody>
		
      </table>
	  <br />
</div >