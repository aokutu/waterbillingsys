<?php
@session_start();
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  STATUS ='ACTIVE' AND   LEVEL >=1 ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
$x="SELECT  CURRENT_DATE ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$currentdate =$y['CURRENT_DATE'];}}
	$finaldate='2018-09-10';
	$currentdate=strtotime($currentdate);
	$finaldate=strtotime($finaldate);
	if ($finaldate <$currentdate){header("LOCATION:sms.php");exit;}
$startaccount=strtoupper(addslashes($_POST['startaccount']));
$lastaccount=strtoupper(addslashes($_POST['lastaccount']));

$x="TRUNCATE TABLE  report";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="TRUNCATE TABLE  currentcharges";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  report(account,credit)  SELECT $billstable.account,SUM(bills.balance)  FROM  $billstable  WHERE $billstable.account >='$startaccount'  AND  $billstable.account <='$lastaccount'  GROUP BY $billstable.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE report   SET   debit=0  WHERE  debit  IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  report(account,debit)  SELECT  $wateraccountstable.account,SUM($wateraccountstable.credit)  FROM $wateraccountstable  WHERE    wateraccounts.account >='$startaccount'  AND  $wateraccountstable.account<='$lastaccount'   AND code =(SELECT CODE FROM PAYMENTCODE WHERE NAME ='WATER BILL' LIMIT 1) GROUP BY   $wateraccountstable.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  currentcharges(account,name,currentreading,charges,date)  VALUES('ACCOUNT','NAME','READING','CHARGES','DATE')";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  currentcharges(account,charges)  SELECT  account ,SUM(credit)-SUM(debit)  AS  total   FROM report  GROUP BY account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE report   SET   credit=0  WHERE  credit   IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentcharges AS U1, accounts AS U2  SET U1.name = U2.client,U1.currentreading=U2.email,  U1.date=U2.date2    WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
////////////////SMS////////////
$x="TRUNCATE TABLE sms";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert into sms (account,previous,current,consumtion,date,billid) select t1.account,t1.previous,t1.current,t1.units,t1.date,t1.id  FROM  $billstable t1  join(select date,account,max(id) id  FROM  $billstable group  by account)  t2  on t1.id=t2.id  and t1.account=t2.account  and t1.units>0  and  t1.account >='$startaccount'  and  t1.account <='$lastaccount'   ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE sms AS U1, bills AS U2  SET U1.bill= U2.balance ,U1.consumtion=U2.units  WHERE U2.id = U1.billid";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE sms AS U1, currentcharges AS U2  SET U1.totalbill= U2.charges   WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE sms tu, sms ts SET tu.balbf = ts.totalbill-ts.bill where tu.id=ts.id";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>
 
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />

  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;}}
body{font-size:small;}
#levelchart{ width:80%;}
  </style>
  	<style>
	
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
table{ font-size:80%;}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $('#acrange').modal('show');
$("#close1").click(function() {
        $("input").val("");
    });

$("#close2").click(function() {
        $("input").val("");
    });
var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

  })
  
  </script>

<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autocompletelibrary.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>

<script>
$(document).ready(function(){
	$("#autosearch1").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autosearch.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container">
  <div class="row">
  <div class="col-sm-8" ><input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off"></div>
    <div class="col-sm-4" ><button class="btn-info btn-sm" onclick="window.print()">PRINT</button></div>

  </div>
     <!-- Modal -->
	  
	   
  </div>
    
<form id="updatecontactform" method="post" action="updatecontactform">
<div class="table-responsive">
<table class="table"  id="smstable">
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  height="21" valign="top" >ACCOUNT  </td>
			<td  class="theader"  height="21" valign="top" >ID NUMBER.</td>
			 <td  class="theader"  height="21" valign="top" >CLIENT.</td>
			 <td  class="theader"  height="21" valign="top" >METER NO.</td>
			 <td  class="theader"  height="21" valign="top" >LOCATION.</td>

			 <td  class="theader"  height="21" valign="top" >CURRENT </td> 
			 <td  class="theader"  height="21" valign="top" >PREVIOUS </td> 			 
			 <td  class="theader"  height="21" valign="top" >UNITS  </td>
			  <td  class="theader"  height="21" valign="top" > CHARGES</td>  
			   <td  class="theader"  height="21" valign="top" >BALBF </td> 
			    <td  class="theader"  height="21" valign="top" >TOTAL </td>   
				 <td  class="theader"  height="21" valign="top" >DATE </td>              			     
		</tr>
        </thead>
        <tbody>
       <?php
	$x="select  $accountstable.account,$accountstable.idnumber,$accountstable.client,$accountstable.meternumber,$accountstable.location,sms.current ,sms.current,sms.previous,sms.consumtion,sms.bill,sms.balbf,sms.totalbill,sms.date FROM  $accountstable,sms where    $accountstable.account=sms.account order by  sms.account,sms.date asc ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo "<tr   class='filterdata'  >
                <td  >".$y['account']."</td>
				 <td  >".$y['idnumber']."</td>
				 <td  >".$y['client']."</td>
				 <td  >".$y['meternumber']."</td>
				  <td  >".$y['location']."</td>
				   <td  >".$y['current']."</td>
				   <td  >".$y['previous']."</td>
				   <td  >".$y['consumtion']."</td>
				   <td  >".$y['bill']."</td>
				   <td  >".$y['balbf']."</td>
				   <td  >".$y['totalbill']."</td>
				   <td  >".$y['date']."</td>			 
				  		
           </tr>" ;
		 }
		 }

	?>
        </tbody>
    </table>
</div>
</form>
</body>
</html>
