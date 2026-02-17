<?php 
header("LOCATION:accessdenied4.php");exit;

@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'DELETE NOTIFICATIONS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#userdetails{
  overflow-y: scroll;      
  height: 480px;            //  <-- Select the height of the body
  width: 90%; margin-right:10%; 
  position: absolute;
}

#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
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
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; } </style>

  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
$("#close1").click(function() {
        $("input").val("");
    });



$("#zonesearch").submit(function(){$('#prepostmessage').modal('show');
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})


$("#deletenotification").submit(function(){$('#prepostmessage').modal('show');
$.post( "deletenotification.php",
$("#deletenotification").serialize(),
function(data){
	$("#notification").load("paynotifications.php #notificationcontent");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

  $( '#checkall' ).click( function () {
   $(':checkbox').each(function() {
          this.checked = true;
      });
  })
  
    $( '#checknone' ).click( function () {
   $(':checkbox').each(function() {
          this.checked = false;
      });
  })
  
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



$("submit").click(function() {
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
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
  

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 


    <div class="container">
  <div class="row">
  <div class="col-sm-4" > <br><input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
</div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>
  
<form id="deletenotification"   method="post" action="deletenotification.php"  >
<h4 style="text-align:center"><strong>PENDING NOTIFICATIONS </strong></h4>
<div id="notification" >
<table class="table" id="notificationcontent"" style="text-align:left">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"  height="28" valign="top" >DATE</td>     
			  <td  class="theader" width='40%'  height="28" valign="top" >NOTIFICATION</td>	
			   <td  class="theader"  height="28" valign="top" >DELETE
			   </td>
			 
		 			  
          </tr>
        </thead>
        <tbody >
		
        <?php
	$x="select DATE,MESSAGE,ID  FROM  NOTIFICATION   ORDER BY DATE DESC   ";
		$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['DATE']."</td>  
			    <td   width='40%' >".$y['MESSAGE']."</td>
			  
				   <td>
				   <input name='del[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'> </td>  
           </tr>";
		 }
		 
		 } 
		 
		?>	
		
        </tbody>
    </table>
	
	<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button>
<button type="reset" class="btn-info btn-sm">RESET</button>
	</div>
	</form>
 <form class="modal fade" id="zonesearch" role="dialog" method="post"  action="zonesearch.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
<select class="form-control input-sm"  id="loadedzone"  name="loadedzone" required="on" >
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
        </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
<?php include_once("chat.php");?>
<form class="modal fade" id="dashboard" role="dialog" action="exit.php" method="post" target="_parent"  onClick="noBack();"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><div id="zoneheader"><h3 id="zoneheader1">LAWASCO M.I.S <?php   print   $company.'-ZONE-'.$zonename; ?></h3><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="A/C STATUS SUMMARY" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#accountstatus">A/C STATUS</button></a></div></div></div>
   
<div id="frame">
<div  id="inputs"> 
 
 <div class="container">
  <div class="row">
 
    <div class="col-sm-12" id="" ><br>
	 <div class="container">
	<div class="container">
  <div class="row">
  <div class="col-sm-3" > 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="ADMINISTRATOR" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   ADMIN&nbsp;&nbsp;&nbsp;&nbsp;<img src ="ICON7.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a   href="users.php" target= "_parent" >USER ADMIN </a></li><li><a   href="companyadmin.php" target= "_parent" >COMPANY ADMIN </a></li><li><a   href="zoneadmin.php" target= "_parent" >ZONE ADMIN </a></li>  
        <li><a href="backupdatabase.php">BACKUP DATABASE</a></li> 
		 <li><a  href="trail.php" target= "_parent" >AUDIT TRAIL </a></li><li><a  href="processautomation.php" target= "_blank" >TASK AUTOMATION</a></li> 
      </ul> 
   </div> 
  <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="REPORTS" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >REPORTS&nbsp;&nbsp;&nbsp;&nbsp;
	   <img src ="ICON17.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu" id="longmenu"> 
	  <li><a href="graphsummary.php"  target= "_blank">GRAPH SUMMARY</a></li> 
        <li><a href="accountstatus.php">ACC CURRENT STATUS </a></li><li><a href="watersalereport.php">WATER SALE REPORT </a></li> 
         
		 <li><a href="ministatement.php">MINISTATEMENT</a></li> 
		   <li><a href="statements.php">FULL STATEMENT</a></li><li><a href="refunddeposit.php">REFUND DEPOSIT</a></li><li><a href="archivedstatements.php">ARCHIVED STATEMENT</a></li><li><a href="bills2report.php">BILLS DISTRIBUTION  REPORT</a></li><li><a href="revenue.php">REVENUE  DISTRIBUTION  REPORT</a></li>
		   <li><a href="balancereport.php">ACC  BAL DISTRIBUTION REPORT </a></li><li><a href="analysisreport.php">MONTHLY DATA ANALYSIS </a></li><li><a href="banking.php">UNPROCESSED NOTIFICATION</a></li>
		   <li><a href="waterflow.php">WATER FLOW  REPORT</a></li><li><a href="masterdistribution.php">MASTER METERS REPORT</a></li>
		   
		   <li><a href="accountstatus3.php">ACCOUNTS  DISTRIBUTION  REPORT   </a></li>
		   <li><a href="meterstatus.php">METER DISTRIBUTION REPORT   </a></li><li><a href="accountsactivity.php">ACTIVITIES  DISTRIBUTION REPORT   </a></li>

<li><a href="duebillingreport.php">DUE BILLING REPORT</a></li> 	 		 
		  
      </ul> 
   </div> 
  <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="ANNUAL REPORTS" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >ANNUAL REPORTS&nbsp;&nbsp;&nbsp;
	   <img src ="ICON17.png"  width="20%"  height="20%"> 
	   </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu">
	          <li><a href="annualchlorinereport.php">CHLORINE REPORT </a></li> 
			  <li><a href="annualproductionreport.php">PRODUCTION REPORT </a></li> 
			   
			  <li><a href="annualreconnectionreport.php">RECONNECTION REPORT </a></li>
			  <li><a href="annualdisconnectionreport.php">DISCONNECTION REPORT </a></li>
			  <li><a href="annualrevenuereport.php">REVENUE REPORT </a></li> 
			  
			     			  
	  </ul> 
   </div> 
<br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="GEO MAPPING" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >GEO MAPPING&nbsp;&nbsp;&nbsp;<img src ="ICON21.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	   
        <li><a href="generatemap.php">GENERATE MAP </a></li><li><a href="mapping2.php">GEO LOCATION </a></li> 
         
      </ul> 
   </div> 
 <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="INFO" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >HELP  MODULE&nbsp;&nbsp;&nbsp;<img src ="ICON22.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	  <li><a href="help.php">HELP </a></li> 
         
      </ul> 
   </div> 
 </div>
	<div class="col-sm-3" >
	
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown"> 
       <a href="#"  title="BILLING" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >BILLING&nbsp;&nbsp;&nbsp;&nbsp;<img src ="ICON16.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	   <li><a   href="billsrate.php" target= "_parent" > BILL RATES</a></li><li><a   href="printbill2.php" target= "_parent" >MASS  PRINT BILL</a></li><li><a   href="mainbilling.php" target= "_parent" > BILLING</a></li>
      <li><a   href="billing.php" target= "_parent" >MULTI BILLING</a></li>
	<li><a   href="fieldbilling.php" target= "_parent" >FIELED BILLING</a></li> 	  
        <li><a href="viewbill.php">BILLS SUMMARY</a></li> 
		  <li><a href="billsreport.php">BILLS REPORT</a></li> <li><a href="nonwaterbillsreport.php">NON WATER BILLS</a></li><li><a href="clientquotations.php">QUOTATIONS</a></li><li><a href="archives.php">IMAGE ARCHIVES</a></li> 
      </ul> 
   </div> 
  <br><br>
 <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" title="PAYMENT" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom"  >PAYMENT <img src ="ICON20.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="paymentcodes.php">PAYMENT CODES </a></li><li><a href="bankstatements.php">PAYMENT SLIPS </a></li> 
        <li><a href="backuprestore.php">UPLOAD SLIPS</a></li><li><a href="linkslips.php">LINK SLIPS</a></li><li><a href="paynotifications.php">PAY NOTIFICATIONS</a></li><li><a href="reciepts.php">RECEIPTS</a></li> 
		 
      </ul> 
   </div> 
  <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="OCCURANCE " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   JOB TICKETS&nbsp;&nbsp;&nbsp;<img src ="ICON23.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a   href="clienttickets.php" target= "_parent" >JOB  TICKETS </a></li> 
		  
        </ul> 
   </div> 
 <br><br>
 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="INVENTORY " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   INVENTORY &nbsp;<img src ="ICON25.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="itemcategory.php">ITEM CATEGORIES</a></li><li><a href="suppliers.php">SUPPLIERS</a></li><li><a href="inventory.php">INVENTORY</a></li><li><a href="stockadjustment.php">STOCK ADJUSTMENT</a></li><li><a href="purchasesreq.php">PURCHASES REQ</a></li><li><a href="quotationrequest.php">REQUEST FOR QUOTATION</a></li><li><a href="lpos.php">L.P.O'S & L.S.O'S</a></li><li><a href="purchases.php">GOODS RECIEVED</a></li><li><a href="storesissuenotes.php">STORES ISSUE</a></li><li><a href="gatepass.php">GATE PASS</a></li><li><a href="stockmovementreport.php">STOCK CARD</a></li>
		 
        </ul> 
   </div> 
 <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="REPAIR & MANTAINANCE " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   REPAIR & MANTAINANC&nbsp;&nbsp;&nbsp;<img src ="ICON15.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="mantainance.php">REPAIR & MANTAINANC</a></li> 
		 
        </ul> 
   </div>
 <br><br>

  <?php 
  $x="SELECT  DATEDIFF(LOCKDATE,CURRENT_DATE) AS ddays FROM CLOCK";
  $x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$days=$y['ddays']; print '<div id="trialdays"  class="btn btn-default">TRIAL DAYS:'.$days.'</div>';}}
  
  ?>
 
	</div>
	<div class="col-sm-3" >
	 <div class="dashboardbutton">
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown"> 
       <a href="#"  title="REGISTRY" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom"  >REGISTRY<img src ="ICON1.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="newaccount.php" target="_parent" >NEW ACCOUNT </a></li> 
        <li><a  href="accountedit.php" target="_parent" >EDIT ACCOUNT</a></li>
		<li><a  href="accountedit2.php" target="_parent" >MULTI EDIT</a></li><li><a  href="accounttransfer.php" target="_parent" >ACCOUNT NUMBER CHANGE</a></li>
		
		<li><a  href="accountsregistry.php" target="_parent" >VIEW ACCOUNTS</a></li><li><a  href="accountstransfer.php" target="_parent" >ACCOUNTS TRANSFER</a></li><li><a  href="advancedsearch.php" target="_parent" >ADVANCED REG SEARCH</a></li><li><a  href="accountstrail.php" target="_parent" > ACCOUNTS TRAIL</a></li>
		
      </ul> 
   </div> 
 </div>
 
 <br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="SMS/EMAILS"  data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   SMS/EMAILS<img src ="ICON3.png"  width="16%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="sms.php" target= "_parent">BILLING SMS/EMAILS </a></li> <li><a href="custormsms.php" target= "_parent">CUSTORM  SMS/EMAILS </a></li>
		<li><a href="sendsmsemail.php" target= "_blank">SEND  SMS/EMAILS </a></li>
		<li><a href="balinquery.php" target= "_parent">BALANCE  INQUERY </a></li><li><a href="viewsms.php" target= "_parent">VIEW  SMS/EMAILS </a></li> 
		  <li><a href="contacts.php" target= "_parent">EDIT CONTACTS </a></li> 
      </ul> 
   </div> 
 <br><br><br>
 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="METER REGISTRY" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   METER REGISTRY<img src ="ICON24.png"  width="16%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="meterregistry.php" target= "_parent">METER REGISTRY </a></li><li><a href="unregisteredmeterregistry.php" target= "_parent">UNREGISTERED ACCOUNTS  </a></li>
		
		<li><a href="metertrail.php" target= "_parent">METER TRAIL </a></li>
		 
      </ul> 
   </div> 
 <br><br>
 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="DEBT MANAGEMENT" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   DEBT MANAGEMENT<img src ="ICON20.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="debtregistry.php" target= "_parent">DEBT MANAGEMENT </a></li>	
      </ul> 
   </div> 
 <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="WATER PRODUCTION" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   WATER PRODUCTION<img src ="ICON1.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="productionbilling.php"   target= "_parent">PRODUCTION METERS</a></li><li><a href="mastermeters.php"   target= "_parent">MASTER METERS </a></li>	
      </ul> 
   </div> 
 <br><br>
  <button type="button" class="btn btn-default" data-dismiss="modal" >CLOSE</button>
 <button type="submit" class="btn btn-default"  >LOGG OFF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>

	</div>
	<div class="col-sm-3" ></div>
  </div></div>	 
	 </div>
	
<br> 
</div>
	</div>
	</div>

</div>



<br>
	</br>
	</div>
 
  </div>
  </div>
  </form>
  <!--dashboard-->
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
  <div class="modal fade" id="prepostmessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="prepostcontent"> <img src ='giphy.gif'><h2></div></div></div>
  </div>
  <div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="content"> </div></div></div>
  </div>
</body>
</html>
