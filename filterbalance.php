<?php
@session_start();
$_SESSION['message']="SEARCHINGXX";
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$balance=$_POST['balance'];
@$action=$_POST['action'];
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];

include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS' OR  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$x="CREATE TEMPORARY TABLE `currentbalance` (
  `id` INT NOT NULL,
  `account` TEXT NOT NULL,
  `previous` FLOAT NOT NULL,
  `current` FLOAT NOT NULL,
  `consumtion` FLOAT NOT NULL,
  `bill` FLOAT NOT NULL,
  `balbf` FLOAT NOT NULL,
  `totalbill` FLOAT NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL,
  `date2` date NOT NULL,
  RECIEPT TEXT DEFAULT NULL,
  AMNTRCPT FLOAT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `currentbalance`   ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `currentbalance`   MODIFY `id` INT NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="CREATE TEMPORARY TABLE REPORT1(ACCOUNT TEXT,CREDIT  FLOAT,DEBIT FLOAT,CUBIC FLOAT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="CREATE TEMPORARY TABLE CHARGES(ACCOUNT TEXT,NAME TEXT,CURRENTREADING TEXT,CHARGES  FLOAT,DATE DATE);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="INSERT INTO  REPORT1(account,credit)  SELECT $billstable.account,SUM($billstable.balance)  FROM  $billstable  WHERE $billstable.account >='$account1' AND  $billstable.account <='$account2'  GROUP BY $billstable.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE REPORT1   SET   debit=0  WHERE  debit  IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  REPORT1(account,debit)  SELECT $wateraccountstable.account,SUM($wateraccountstable.credit)  FROM $wateraccountstable  WHERE    $wateraccountstable.account >='$account1'   AND $wateraccountstable.account <='$account2'     AND $wateraccountstable.code =(SELECT CODE FROM paymentcode WHERE NAME ='WATER BILL' LIMIT 1) GROUP BY $wateraccountstable.account";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  CHARGES(account,charges)  SELECT  account ,SUM(credit)-SUM(debit)  AS  total   FROM REPORT1  GROUP BY account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE REPORT1   SET   credit=0  WHERE  credit   IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE CHARGES AS U1, $accountstable AS U2  SET U1.name = U2.client,U1.currentreading=U2.email,  U1.date=U2.date2    WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect)); 
////////////////SMS////////////
$x="insert into currentbalance (account,previous,current,consumtion,date,billid) select t1.account,t1.previous,t1.current,t1.units,t1.date,t1.id  FROM  $billstable t1  join(select date,account,max(id) id  FROM  $billstable group  by account)  t2  on t1.id=t2.id  and t1.account=t2.account  and  t1.account >='$account1'  and  t1.account <='$account2'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $billstable AS U2  SET U1.bill= U2.balance ,U1.consumtion=U2.units  WHERE U2.id = U1.billid";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, CHARGES AS U2  SET U1.totalbill= U2.charges   WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance tu, currentbalance ts SET tu.balbf = ts.totalbill-ts.bill where tu.id=ts.id";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $billstable AS U2 SET U1.date=U2.date WHERE U2.account = U1.account AND U2.DATE = ANY(SELECT MAX(DATE) FROM $billstable where $billstable.account=U1.account )";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.date2=U2.depositdate WHERE U2.account = U1.account AND U2.DEPOSITDATE= ANY(SELECT MAX(DEPOSITDATE) FROM $wateraccountstable where $wateraccountstable.account=U1.account )";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.RECIEPT=U2.RECIEPTNUMBER WHERE U2.account = U1.account AND U2.DEPOSITDATE= ANY(SELECT MAX(DEPOSITDATE) FROM $wateraccountstable where $wateraccountstable.account=U1.account )";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.AMNTRCPT =(SELECT SUM(CREDIT) FROM $wateraccountstable WHERE RECIEPTNUMBER IN (SELECT RECIEPT FROM currentbalance) ) WHERE U2.account = U1.account AND U1.RECIEPT=U2.RECIEPTNUMBER ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

 ?>
 
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
   <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
  @media print{tbody{ overflow:visible;}}
#levelchart{ width:80%;}
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #87CEEB; height:350px;  margin-top: 5%; border-radius:2%; text-align:center}
#menu{ background-color: #87CEEB; height:60px;  border-radius:2%; text-align:center  }
body{ font-size:100%;  text-transform:inherit;}
.dropdown-menu{ overflow-y: scroll; height: 300%;width:100%;        
   position: absolute;
}
#dashboard{
  overflow-y: scroll;      
  height: 80%;            
  width: 100%;
  position: absolute;
}
	#zoneheader1{ -webkit-box-reflect: below 2px
			 -webkit-linear-gradient(bottom, white, transparent 40%, transparent); 
			   text-shadow: 0 1px 0 #ccc,
               0 2px 0 #c9c9c9,
               0 3px 0 #bbb,
               0 4px 0 #b9b9b9,
               0 5px 0 #aaa,
               0 6px 1px rgba(0,0,0,.1),
               0 0 5px rgba(0,0,0,.1),
               0 1px 3px rgba(0,0,0,.3),
               0 3px 5px rgba(0,0,0,.2),
               0 5px 10px rgba(0,0,0,.25),
               0 10px 10px rgba(0,0,0,.2),
               0 20px 20px rgba(0,0,0,.15);font-family:"Comic Sans MS";
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
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
  
  $("#loaddetails").click(function()
{
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
$("#slip").load("accountsummary2.php #slip2");
});  return false;
 return false;
})

  $("#loadslip").click(function()
{
	var x=$("#actionx").val();    
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
if(x !='CONNECTED'){$("#slip").load("accountsummary2.php #slip2"); return false;}
else if(x =='CONNECTED'){$("#slip").load("accountsummary2.php #slip3"); return false;}
return false;});  return false;
 return false;
})



$("#accountstatus").submit(function(){
  var x=$("#actionx").val();    
	 if((x =='CONP')||(x=="COR"))
   {
	var x=confirm("CLIENT TO BE BILLED ");   
	 if(x ==false){return false; }  
   }
   
	
	$('#prepostmessage').modal('show');
$.post( "accountstatussummary.php",
$("#accountstatus").serialize(),
function(data){
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

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
<body style="font-size:140%;">
<div class="container">
  <div class="row">
  <div class="col-sm-8" ><input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off"></div>
    <div class="col-sm-4" >

<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="FILTER " data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#filter">FILTER</button></a>

<button class="btn-info btn-sm" onclick="window.print()">PRINT</button></div>

  </div>
     <!-- Modal -->
	  
	   
  </div>
  

 <form class="modal fade" id="filter" role="dialog" method="post" action="filterbalance.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">MINIMUM BALANCE</div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER MINIMUM VALUE" data-placement="bottom">
<input  style='text-transform:uppercase'   pattern="[0-9]+"  title="ENTER  NUMERIC VALUES"  name="balance" type="number" size="15" placeholder="ENTER  MINIMUM VALUE"  required="on"  class="form-control input-sm"   autocomplete="off" >
</a>

<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ACTION" data-placement="bottom">
     <label class="checkbox-inline"> 
        <input type="radio" name="action"     id="optionsRadios3" 
            value="1" >UNITS
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="action" id="optionsRadios4" 
            value="2">CURRENT BALANCE
     </label> 
	   <label class="checkbox-inline"> 
        <input type="radio" name="action" id="optionsRadios4" 
            value="3"> ACCUMULATIVE BALANCE
     </label>

   <label class="checkbox-inline"> 
        <input type="radio" name="action" id="optionsRadios4" 
            value="4"> DELAY DAYS
     </label>
	 </a>
<br>
</div>
	<div class="col-sm-4"></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>

  <div id="content">
  <form id="updatecontactform" method="post" action="updatecontactform">
<img src="letterhead.png"   width="70%"  height="30%"  />
<div class="table-responsive">

<h3 style="text-align:center;"><strong>CURRENT  ACCOUNT  STATUS  FOR ZONE <?php print $zone;
 if ($action =='1'){print " CUBIC UNITS >= ".$balance."M&sup3";}
 else  if ($action =='2'){print " CURRENT BILL  >= ".number_format($balance,2);}
  else  if ($action =='3'){print " TOTAL BILL  >= ".number_format($balance,2);}
  else  if ($action =='4'){print " DELAY DAYS  >= ".$balance;}

 ?></strong></h3>
<table class="table"  id="currentbalancetable">
        <!--DWLayoutTable-->
        <thead>
                      <tr>
            <td  class="theader" style="text-align:left"  width="10%" height="21" valign="top" >ACCOUNT  </td>
			 <td  class="theader" style="text-align:left" height="21"   width="20%" valign="top" >CLIENT.</td>
			 <td  class="theader" style="text-align:left" height="21" valign="top" >UNITS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
			  <td  class="theader" style="text-align:left" height="21" valign="top" > CHARGES</td>  
			   <td  class="theader" style="text-align:left" height="21" valign="top" >BALBF </td> 
			    <td  class="theader" style="text-align:left" height="21" valign="top" >ACCUM TTL  </td>   
				 <td  class="theader" style="text-align:left" height="21" valign="top" >BILL DATE</td>

				   <td  class="theader" style="text-align:left"  height="21" valign="top" >DELAY </td>
		</tr>
        </thead>
        <tbody>
       <?php
	   if($action=='1')
	   {
		$x="select  amntrcpt,$accountstable.account,$accountstable.idnumber,$accountstable.client,$accountstable.meternumber,$accountstable.contact,currentbalance.current ,currentbalance.current,currentbalance.previous,currentbalance.consumtion,currentbalance.bill,currentbalance.balbf,currentbalance.totalbill,currentbalance.reciept,currentbalance.date,currentbalance.date2,IFNULL(DATEDIFF(CURRENT_DATE,currentbalance.date2),'NEVER') AS DDYS FROM  
	$accountstable,currentbalance where    $accountstable.account=currentbalance.account  and consumtion >=$balance order by  currentbalance.account,currentbalance.date asc ";
   
	   
	   }
	   else if($action=='2')
	   {
	
		$x="select  amntrcpt,$accountstable.account,$accountstable.idnumber,$accountstable.client,$accountstable.meternumber,$accountstable.contact,currentbalance.current ,currentbalance.current,currentbalance.previous,currentbalance.consumtion,currentbalance.bill,currentbalance.balbf,currentbalance.totalbill,currentbalance.reciept,currentbalance.date,currentbalance.date2,IFNULL(DATEDIFF(CURRENT_DATE,currentbalance.date2),'NEVER') AS DDYS FROM  
	$accountstable,currentbalance where    $accountstable.account=currentbalance.account  and bill >=$balance order by  currentbalance.account,currentbalance.date asc ";
	
	   
	   }
	   else if($action=='3')
	   {
		$x="select  amntrcpt,$accountstable.account,$accountstable.idnumber,$accountstable.client,$accountstable.meternumber,$accountstable.contact,currentbalance.current ,currentbalance.current,currentbalance.previous,currentbalance.consumtion,currentbalance.bill,currentbalance.balbf,currentbalance.totalbill,currentbalance.reciept,currentbalance.date,currentbalance.date2,IFNULL(DATEDIFF(CURRENT_DATE,currentbalance.date2),'NEVER') AS DDYS FROM  
	$accountstable,currentbalance where    $accountstable.account=currentbalance.account  and totalbill >=$balance order by  currentbalance.account,currentbalance.date asc ";
	   
	   
	   }
	   
	      else if($action=='4')
	   {
	$x="select  amntrcpt,$accountstable.account,$accountstable.idnumber,$accountstable.client,$accountstable.meternumber,$accountstable.contact,currentbalance.current ,currentbalance.current,currentbalance.previous,currentbalance.consumtion,currentbalance.bill,currentbalance.balbf,currentbalance.totalbill,currentbalance.reciept,currentbalance.date,currentbalance.date2,IFNULL(DATEDIFF(CURRENT_DATE,currentbalance.date2),'NEVER') AS DDYS FROM  
	$accountstable,currentbalance where    $accountstable.account=currentbalance.account  and DATEDIFF(CURRENT_DATE,currentbalance.DATE2) >=$balance  OR $accountstable.account=currentbalance.account and DATEDIFF(CURRENT_DATE,currentbalance.DATE2) IS NULL  order by  currentbalance.account,currentbalance.date asc ";

	   }
		


	?>
	
	
	<?php
	
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo "<tr   class='filterdata'  >
                    <td width='10%'  >".$y['account']."</td>
				 <td  width='20%' >".$y['client']."</td>
				   <td  >".number_format($y['consumtion'],2)."</td>
				   <td  > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['bill'],2)."</td>
				   <td  > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['balbf'],2)."</td>
				   <td  > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".number_format($y['totalbill'],2)."</td>
				   <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['date']."</td>
				
				   <td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; > ".$y['DDYS']."</td>				 
				   
				   
				  		
           </tr>" ;
		 }
		 }
		 
	
if($action=='1')
	   {
		$x=" SELECT COUNT(ID),SUM(CONSUMTION),SUM(BILL),SUM(BALBF),SUM(TOTALBILL) FROM  currentbalance where    consumtion >=$balance ";
	   }
	   
	   	   else if($action=='2')
	   {
		$x=" SELECT COUNT(ID),SUM(CONSUMTION),SUM(BILL),SUM(BALBF),SUM(TOTALBILL) FROM  currentbalance where    bill >=$balance  ";
	   }
	   else if($action=='3')
	   {
	 $x="SELECT COUNT(ID),SUM(CONSUMTION),SUM(BILL),SUM(BALBF),SUM(TOTALBILL) FROM  currentbalance where    totalbill >=$balance  ";
	   }
	   
	      else if($action=='4')
	   {
	 $x="SELECT COUNT(ID),SUM(CONSUMTION),SUM(BILL),SUM(BALBF),SUM(TOTALBILL) FROM  currentbalance where  DATEDIFF(CURRENT_DATE,currentbalance.DATE2) >=$balance  OR  DATEDIFF(CURRENT_DATE,currentbalance.DATE2) IS NULL";
	   }
	   
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo "<tr   class='btn-info btn-sm'  >
                <td width='10%'  >TOTAL</td>
				 
				 <td  width='20%' >  ".$y['COUNT(ID)']."</td>
				
				   
				 <td  >".number_format($y['SUM(CONSUMTION)'],2)."</td>
				 <td  >".number_format($y['SUM(BILL)'],2)."</td>
				   <td  >".number_format($y['SUM(BALBF)'],2)."</td>
				   <td  >".number_format($y['SUM(TOTALBILL)'],2)."</td>
				   <td  >>&nbsp;&nbsp;&nbsp;</td>
<td  ></td> 				   
				  		
           </tr>" ;
		 }
		 }
	//$x="DROP TEMPORARY TABLE REPORT1";mysqli_query($connect,$x)or die(mysqli_error($connect));
	//$x="DROP TEMPORARY TABLE CHARGES";mysqli_query($connect,$x)or die(mysqli_error($connect));
	

	?>
	
        </tbody>
    </table>
</div>
</form>
  </div>


<!-- 	dashboard-->

   <form class="modal fade" id="accountstatus" role="dialog" method="post"  action="accountstatussummary.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
<div class="container">
  <div class="row">
  <div class="col-sm-8" >
 <div id="accountdetails"><br>
  <select class="form-control input-sm"  id="loadedzone"  name="zone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select>
	<br>
	ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT"  title="eleven digits" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"     autocomplete="on" ></a><br />
</div>
<br>
<div id="acstatus">current status</div><br><input type="date"  name="date"  id="date"  class="form-control input-sm" required="on" ><br>
<br>
  <select class="form-control input-sm"  id="actionx" name="action" required="on" >
<option value=''>SELECT ACTION</option>
<option value='CONP'>CONP</option>
<option value='COR'>COR</option>
<option value='CONNECTED'>RE-CONNECTION</option>
<option value='FUNCTION'>FUNCTION</div>
<option value='MALFUNCTION'>MALFUNCTION</div>
<option value="STOLEN">STOLEN</option>
</select>
	
<br>

<div  id="slip"></div>
<br>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button>
  <button type="button" class="btn-info btn-sm"  id="loaddetails">LOAD DETAILS</button>  
  <button type="button" class="btn-info btn-sm"  id="loadslip">LOAD SLIP</button>
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>

  </div>
    <div class="col-sm-4" > </div>
  </div>
  </div>
  </div>
  </div>
  </form>
</html> 