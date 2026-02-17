<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];@$month=$_POST['month'];
include_once("password.php");
@$account=$_SESSION['account'];$date1=$_SESSION['date1'];$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
  if($account ==null){$account=1;} 
$x="SELECT * FROM $accountstable  WHERE  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $_SESSION['client']=$y['client'];$account=$y['account']; $status=$y['status'];$meternumber=$y['meternumber'];  $size=$y['size']; $class=$y['class']; $lastreading=$y['email'];}}
	
$x="SELECT *  from $meterstable  WHERE  account='$account'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$name=$y['client']; $contact=$y['contact'];}}
		
$x="CREATE TEMPORARY TABLE  STATEMENTX (ID INT,A TEXT,B TEXT ,C TEXT,D TEXT,E TEXT,F TEXT,G TEXT,H TEXT,TRANSACTION TEXT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));		
$x="ALTER TABLE STATEMENTX ADD PRIMARY KEY (`ID`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE STATEMENTX  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
///////////////previous//////////////

	 
	 $x="SELECT IFNULL(SUM(amount),0) FROM  financearchive WHERE account='$account' AND date <'$date1'  ";
		  	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { $previousbill=$y['SUM(amount)'];}}
  //////////////////////////////////////////
$x="insert  into STATEMENTX(A,B,H,transaction,G) select concat('$date1'),concat('PREVIOUS BAL'),concat($previousbill),concat('PREVIOUS BAL'),concat($previousbill)";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,B,C,H,transaction) select depositdate,code,transaction,-1* credit,concat('CREDIT')  FROM  $wateraccountstable  WHERE  account='$account'    AND depositdate >'$date1' AND depositdate <='$date2' ";	mysqli_query($connect,$x)or die(mysqli_error($connect));
/*$x="insert  into STATEMENTX(A,B,C,G,H,transaction) select depositdate,code,transaction, credit,concat(0),concat('CREDIT')  FROM  $wateraccountstable  WHERE  account='$account'    AND depositdate >'$date1' AND depositdate <='$date2' ";	mysqli_query($connect,$x)or die(mysqli_error($connect));*/
$x="insert  into STATEMENTX(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('DEBIT')    FROM   $billstable  WHERE  account='$account'  AND date >'$date1' AND date <='$date2'  AND STATUS ='PENDING' OR account='$account'  AND date >'$date1' AND date <='$date2'  AND STATUS  IS NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('ADJUSTMENT')    FROM   $billstable  WHERE  account='$account'  AND date >'$date1' AND date <='$date2'  AND STATUS ='ADJUSTMENT' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,transaction,H) select date,NAME,AMOUNT    FROM   $nonwaterbills  WHERE  account='$account'  AND date >'$date1' AND date <='$date2' ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="insert  into STATEMENTX(A,B,transaction,H) select date,concat('METER&nbsp-',meter),status ,concat(0)   FROM  $statushistorytable  WHERE  account='$account'  AND date >'$date1' AND date <='$date2' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE STATEMENTX tu, paymentcode ts SET tu.B=CONCAT(ts.NAME,' ',ts.CODE)  WHERE tu.B=ts.CODE ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

?>

<div  id="ministatement">
<h4   style="text-align:center"><strong>ARCHIVED STATEMENT  <?php print $account;?> FROM  <?php print $date1;?>.TO<?php print $date2;?> </strong></h4>

<div  class="table-responsive"> 
<table class="table "  id="reportstable" style="text-align:center;">
        <!--DWLayoutTable-->
      <thead>
          <tr>
<td  class="theader"  height="21" valign="top" > DATE </td>  
<td  class="theader"  height="21" valign="top" > TRANSACTION </td>  
<td  class="theader" width='30%' height="21" valign="top" >PREV  </td> 
<td  class="theader"  height="21" valign="top" > CURR</td>
<td  class="theader"  height="21" valign="top" > UNITS </td> 
<td  class="theader"  height="21" valign="top" >STANDING CHARGES  </td> 
<td  class="theader"  height="21" valign="top" >CHARGES  </td> 
<td  class="theader"  height="21" valign="top" > TTL </td> 
<td  class="theader"  height="21" valign="top" > BALBF </td>
  			
		</tr>
        </thead>
       <tbody>
       <?php	 
	   
	   $x="SET @TTL=0";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SELECT A,B,C,D,E,F,G,H,transaction, (@TTL := H + @TTL) AS TTLSUM FROM   STATEMENTX  ORDER BY  A,ID  ASC ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ 
	echo"<tr  class='filterdata' >
                <td  >".$y['A']."</td>  <td  >".$y['transaction']." </td ><td width='30%'   >".$y['C']."</td><td  >".$y['B']."</td>
				<td  >".$y['D']."</td><td  >".number_format($y['E'],2)."</td>
				<td  >".number_format($y['G'],2)."</td>
				<td  >".number_format(abs($y['H']),2)."</td>
				<td  >".number_format($y['TTLSUM'],2)."</td>
           </tr>";
		   
		 }
		 }

	?>
	 <tr>
<td   height="21" valign="top" >  </td>  
<td   height="21" valign="top" >  </td>
<td   height="21" width='30%'  valign="top" >  </td>
<td   height="21" valign="top" >  </td>
<td   height="21" valign="top" >  </td>
<td   height="21" valign="top" >  </td>
<td   height="21" valign="top" >TTL BILL</td>
<td   height="21" valign="top" >TTL DEBIT   </td>
<td   height="21" valign="top" >CUR BAL </td>
  			
		</tr>
		
	<tr   class="btn-info btn-sm">
<td  class="theader"  height="21" valign="top" ><?PHP
 	$x="SELECT MAX(A) FROM STATEMENTX      ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{echo $y['MAX(A)'];}}
 ?></td>  
<td  class="theader"  height="21" valign="top" >  </td>  
<td  class="theader"  height="21" valign="top" >  </td> 
<td  class="theader" width='30%' height="21" valign="top" >  </td>
 
<td  class="theader"  height="21" valign="top" ></td> 
<td  class="theader"  height="21" valign="top" >TOTAL</td> 
<td  class="theader"  height="21" valign="top" ><?php 
/*$x="SELECT SUM(H) FROM  STATEMENTX  WHERE TRANSACTION='CREDIT'      ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ echo number_format($y['SUM(H)'],2);}}*/
 ?></td> 
<td  class="theader"  height="21" valign="top" ><?php 
/*$x="SELECT  SUM(H) FROM  STATEMENTX  WHERE TRANSACTION='DEBIT' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ echo number_format($y['SUM(H)'],2);}}*/
 ?> </td>
<td  class="theader"  height="21" valign="top" ><?php 
$x="SELECT SUM(H) FROM  STATEMENTX   ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ echo number_format($y['SUM(H)'],2);}}
 ?></td>
  	
		</tr>
		
        </tbody>
    </table></div>

</div>
<?php

$x="DROP TEMPORARY TABLE STATEMENTX ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
?>