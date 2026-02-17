 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$amount=$_SESSION['amount'];
if (empty($amount)){$amount=0;}
  if($zone==""){$zone=0;}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ACCOUNTS REG'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$x="TRUNCATE TABLE  report";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="TRUNCATE TABLE  currentcharges";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="TRUNCATE TABLE sms";mysqli_query($connect,$x)or die(mysqli_error($connect));

 $connect2=mysqli_connect('localhost','root','','company');
$x="SELECT * FROM company WHERE name='$company' ";
		$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	$zones=$y['zones'];	
		}}
	for ($i= 1; $i <=$zones; $i++) 
		{
$accountstable2='accounts'.$i;$billstable2='bills'.$i;$wateraccountstable2='wateraccounts'.$i;
$x="INSERT INTO  report(account,credit)  SELECT $billstable2.account,SUM($billstable2.balance)  FROM  $billstable2  GROUP BY $billstable2.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE report   SET   debit=0  WHERE  debit  IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  report(account,debit)  SELECT $wateraccountstable2.account,SUM($wateraccountstable2.credit)  FROM $wateraccountstable2  WHERE $wateraccountstable2.code =(SELECT CODE FROM PAYMENTCODE WHERE NAME ='WATER BILL' LIMIT 1) GROUP BY $wateraccountstable2.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  currentcharges(account,charges)  SELECT  account ,SUM(credit)-SUM(debit)  AS  total   FROM report  GROUP BY account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE report   SET   credit=0  WHERE  credit   IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentcharges AS U1, $accountstable2 AS U2  SET U1.name = U2.client,U1.currentreading=U2.email,  U1.date=U2.date2    WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert into sms (account,previous,current,consumtion,date,billid) select t1.account,t1.previous,t1.current,t1.units,t1.date,t1.id  FROM  $billstable2 t1  join(select date,account,max(id) id  FROM  $billstable2 group  by account)  t2  on t1.id=t2.id  and t1.account=t2.account  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE sms AS U1, $billstable2 AS U2  SET U1.bill= U2.balance ,U1.consumtion=U2.units  WHERE U2.id = U1.billid";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE sms AS U1, currentcharges AS U2  SET U1.totalbill= U2.charges   WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE sms tu, sms ts SET tu.balbf = ts.totalbill-ts.bill where tu.id=ts.id";mysqli_query($connect,$x)or die(mysqli_error($connect));

	}	

////////////////SMS////////////

$x="INSERT INTO  sms(account,totalbill)  SELECT $accountstable.account,CONCAT(0)  FROM  $accountstable  ";mysqli_query($connect,$x)or die(mysqli_error($connect));

?>

<div  id="contacttable">
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  /> 
<h4   style="text-align:center"><strong><?php print $zone;?>METER NUMBERS   FOR ACCx <?php print $account1 ;?> TO <?php print $account2;?></strong></h4>
  
<table class="table"  id="smstable">
        <!--DWLayoutTable-->
        <thead>
          <tr>
         <td  class="theader"   height="21" valign="top" >ACCOUNT  </td>
		 <td  class="theader"  height="21" valign="top" >BALBF </td>   
		  <td  class="theader"  height="21" valign="top" >CONP </td>              			     
		</tr>
        </thead>
        <tbody>
       <?php
	$x="select  sms.account,sum(balbf) from sms   group by sms.account  order by sms.account   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo "<tr   class='filterdata'  >
                <td  >".$y['account']."</td>

				<td  >".number_format($y['sum(balbf)'],2)."</td>
				<td  >
				<input  name='account[".$y['sms.account']."]'  type='checkbox'  placeholder='NEW UPDATES  ' value='".$y['sms.account']."'   style='text-transform:uppercase'    class='form-control input-sm'   autocomplete='off' ></a>
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