<?php 
session_start();
include_once("password.php");
 if($zone==""){$zone=0;}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'MULTI EDIT'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


$x="TRUNCATE TABLE  report";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="TRUNCATE TABLE  currentcharges";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  report(account,credit)  SELECT $billstable.account,SUM($billstable.balance)  FROM  $billstable  WHERE $billstable.account >='$account1' AND  $billstable.account <='$account2'  GROUP BY $billstable.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  report(account,credit)  SELECT $nonwaterbills.account,SUM($nonwaterbills.amount)  FROM  $nonwaterbills  WHERE $nonwaterbills.account >='$account1' AND  $nonwaterbills.account <='$account2'  GROUP BY $nonwaterbills.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE report   SET   debit=0  WHERE  debit  IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  report(account,debit)  SELECT $wateraccountstable.account,SUM($wateraccountstable.credit)  FROM $wateraccountstable  WHERE    $wateraccountstable.account >='$account1'   AND $wateraccountstable.account <='$account2'    GROUP BY $wateraccountstable.account";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  currentcharges(account,charges)  SELECT  account ,SUM(credit)-SUM(debit)  AS  total   FROM report  GROUP BY account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE report   SET   credit=0  WHERE  credit   IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentcharges AS U1, $accountstable AS U2  SET U1.name = U2.client,U1.currentreading=U2.email,  U1.date=U2.date2    WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect)); 

////////////////SMS////////////
$x="TRUNCATE TABLE sms";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert into sms (account,previous,current,consumtion,date,billid) select t1.account,t1.previous,t1.current,t1.units,t1.date,t1.id  FROM  $billstable t1  join(select date,account,max(id) id  FROM  $billstable group  by account)  t2  on t1.id=t2.id  and t1.account=t2.account  and  t1.account >='$account1'  and  t1.account <='$account2'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE sms AS U1, $billstable AS U2  SET U1.bill= U2.balance ,U1.consumtion=U2.units  WHERE U2.id = U1.billid";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE sms AS U1, currentcharges AS U2  SET U1.totalbill= U2.charges   WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE sms tu, sms ts SET tu.balbf = ts.totalbill-ts.bill where tu.id=ts.id";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  sms(account,totalbill)  SELECT $accountstable.account,CONCAT(0)  FROM  $accountstable  WHERE $accountstable.account >='$account1' AND  $accountstable.account <='$account2'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']=" ACCOUNTS LOADED";

?>

<div  id="contacttable">
<h4   style="text-align:center"><strong>DETAILS   FOR ACC <?php print $account1 ;?> TO <?php print $account2;?></strong></h4>
  <div class="container">
  <div class="row">
  <div class="col-sm-4"><input  style='text-transform:uppercase' name="date"  value="<?php echo date("Y-m-d");?>"  type="date" size="15"   class="form-control input-sm"     autocomplete="off" ></div>
  <div class="col-sm-4"><select class="form-control"   required= "on"  name="action" id="action">
			    <option value="">SELECT ACTION </option>
			 
			    <option value="2">NEW METER READING</option>
				 <option value="3">UPDATE CLASS</option>
			   <option value="4">ACC ADJUSTMENTS </option>
			    <option value="5">UPDATE ACCOUNTS STATUS</option>
				 <option value="6">UPDATE ACCOUNT NUMBER</option>
			  </select></div>
  <div class="col-sm-4"></div>
  </div></div>


 
<table class="table"  id="smstable">
        <!--DWLayoutTable-->
        <thead>
          <tr>
         <td  class="theader"   height="21" valign="top" >ACCOUNT  </td>
		 <td  class="theader"   height="21" valign="top" >STATUS  </td>
		<td  class="theader"  height="21" valign="top" >METER NO.</td>
		<td  class="theader"  style='text-align:center;'   height="21" valign="top" >CLASS.</td>
				<td  class="theader"  style='text-align:center;'   height="21" valign="top" >READING.</td>
			<td  class="theader"  height="21" valign="top" >DATE </td>	
		 <td  class="theader" style="text-align:left;" height="21" valign="top" >CURR BAL </td>   
		  <td  class="theader"  height="21" valign="top" >UPDATE </td>              			     
		</tr>
        </thead>
        <tbody>
       <?php
	$x="select  $a$accountstable.status,$accountstable.account,$accountstable.date2,$accountstable.email,$accountstable.meternumber,$accountstable.class,sms.current ,sms.current,sms.previous,sms.consumtion,sms.bill,sms.balbf,sms.totalbill,sms.date FROM  $accountstable,sms where    $accountstable.account=sms.account group by  sms.account order by sms.account,sms.totalbill,sms.date asc ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo "<tr   class='filterdata'  >
                <td  >".$y['account']."</td>
				 <td  >".$y['status']."</td>
				<td  >".$y['meternumber']."</td>
				<td   style='text-align:center;'  >".$y['class']."</td>
				<td  style='text-align:center;'  >".$y['email']."</td>
				<td  >".$y['date2']."</td>
				<td style='text-align:center;' >".number_format($y['totalbill'],2)."</td>
				<td  >
				<input  name='account[".$y['account']."]'  type='text'  placeholder='NEW UPDATES  '   style='text-transform:uppercase'    class='form-control input-sm'   autocomplete='off' ></a>
</td>			 
				  		
           </tr>" ;
		 }
		 }
	?>
        </tbody>
    </table>
 <br><br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
	  <button class="btn-info btn-sm" onclick="window.print()">PRINT</button></div>