<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$account1=$_SESSION['account1'];@$account2=$_SESSION['account2'];
$month=$_SESSION['month'];
@$date1=$month.'-01';@$date2=$month.'-31';

$x="TRUNCATE TABLE  report";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  report(account,credit,cubic)   SELECT $billstable.account,SUM($billstable.balance),SUM($billstable.units)  FROM  $billstable  WHERE $billstable.account >= '$account1'  AND $billstable.account <= '$account2'  AND  date   LIKE '$month%'  GROUP BY $billstable.account";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE report   SET   debit=0  WHERE  debit  IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="INSERT INTO  report(account,debit)  SELECT  $wateraccountstable.account,SUM($wateraccountstable.credit)  FROM $wateraccountstable  WHERE   $wateraccountstable.account >='$account1'  AND  $wateraccountstable.account <='$account2'   AND  $wateraccountstable.code=(SELECT CODE FROM PAYMENTCODE WHERE NAME ='WATER BILL' LIMIT 1)  AND  date LIKE '$month%'    GROUP BY   $wateraccountstable.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE report   SET   credit=0  WHERE  credit   IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>
 <div id="export">
   <html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >HADDASSAH BILLING SOFTWARE </title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
 <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
<link rel="stylesheet"  href="stylesheets/tables.css" />
<style type="text/css">
@media print{tbody{ overflow:visible;}}
#total{ text-align:right;}
</style>
	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
  
	<SCRIPT type="text/javascript">

    window.history.forward();

    function noBack() { window.history.forward(); }
	

</SCRIPT>
<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
<h4   style="text-align:center"><strong>MONTHLY BALANCE   REPORT FOR ZONE <?php print $zone; ?> ACC <?php print $account1 ;?> TO <?php print $account2;?>  FOR  THE MONTH    OF    <?php echo $date2;  ?></strong></h4>
  <table class="table"  id="stockin2">
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  height="21" valign="top" >ACCOUNT  </td>
			 <td  class="theader"  height="21" valign="top" >CUBIC UNITS </td> 
			 <td  class="theader"  height="21" valign="top" >BILL </td> 
			 <td  class="theader"  height="21" valign="top" >ACCOUNT DEPOSITS </td> 
			 
			 
			 <td  class="theader"  height="21" valign="top" >CURRENT BAL  </td>                			     
		</tr>
        </thead>
        <tbody>
       <?php 
	$x="SELECT account ,SUM(credit),SUM(debit),SUM(credit)-SUM(debit)  AS  total,SUM(cubic)   FROM report  GROUP BY account  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo"<tr  class='filterdata' >
                <td  >".$y['account']."</td>
				  <td  >".$y['SUM(cubic)']."</td>
				   <td  >".number_format($y['SUM(credit)'],2)."</td>
				  <td  >".number_format($y['SUM(debit)'],2)."</td>
				
				
                <td >".number_format($y['total'],2)."</td> 		
           </tr>";
		 }
		 }

	$x="SELECT count(account) ,SUM(credit),SUM(debit),SUM(credit)-SUM(debit)  AS  total ,SUM(cubic)    FROM report    ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { $acts=$y['count(account)'];$dbt=number_format($y['SUM(debit)'],2); $crdt=number_format($y['SUM(credit)'],2); $bal=number_format($y['total'],2);
		   echo"	   
		  <tr  class='btn-info btn-sm'>
		   
                <td  >TOTAL:ACS".$acts."</td>
				 <td  >".$y['SUM(cubic)']."</td>
				 	 <td  >BILL".$crdt."</td>
				  <td  >DEPOSITS ".$dbt."</td>
			
				
                <td >BAL".$bal."</td> 		
           </tr> 
		   
		   ";
		 }
		 }

	?>
        </tbody>
    </table>
 <br>  
  </div>