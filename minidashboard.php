<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
  <title>LAWASCO SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
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
  </style>
  <style type="text/css">
			body {text-transform:uppercase;} 
			 #inputs{ background-color:#87CEEB; border-style:solid;border-radius:2%;text-transform:uppercase;}
			 #header{ background-color: #87CEEB; height:60px;  border-radius:2%; text-align:center  }
			 img{ width 10%;height 20%;} #header{ border-style:solid;border-radius:2%;}
			.btn-group{ border-style:solid;border-radius:2%;}  .dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}
			</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
   
$("#close1").click(function() {
        $("input").val("");
    });

$("#close2").click(function() {
        $("input").val("");
    });
$("#newuser").submit(function(){
$.post( "newuser.php",
$("#newuser").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#newuser').modal('hide'); 
$('#message').modal('show'); 
$("#results").load("users.php #datatable");
return false;});
return false;
})


$("#results").submit(function(){

$.post( "editusers.php",
$("#results").serialize(),
function(data){
var action=$("#action").val();
if(action =='delete'){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#results").load("users.php #datatable");}
if(action =='edit'){
	$("#content").load("message.php #content"); 
$('#message').modal('show');

	$("#results").load("editusers2.php");
	return false;
	}
if(action =='edit2'){
$("#content").load("message.php #content"); 
$('#message').modal('show');
	$("#results").load("users.php #datatable");}

if(action =='reset'){
$("#content").load("message.php #content"); 
$('#message').modal('show');
	$("#results").load("users.php #datatable");}
})
return false;
})


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
		url: "readCountry.php",
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

<div class="container">
   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="Click to create New User" data-placement="bottom"></a>
  <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>
   <form class="modal fade" id="searchmod3" role="dialog" method="post" action="searchmethod.php">
   <div class="modal-dialog modal-lg">
  <div class="modal-content"><div class="modal-header"><div class="modal-header">SEARCH METHOD</div></div>
  <div class="container">
  <div class="row">
    <div class="col-sm-6" >
	<select class="form-control" name="searchmethodx" required="on">
 <option value="">SEARCH  METHOD</option>
 <option value="firstname">FIRST  NAME</option>
 <option value="secondname">SECOND  NAME</option>
 <option value="thirdname">THIRD  NAME</option>
 </select>
 </div>
	<div class="col-sm-6"> <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal">CLOSE</button></div>
	</div>
	</div>
	</div>
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
   <?php  include_once("dashboard3.php");  include_once("chat.php");?>
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><div class="modal-header"><div id="zoneheader"><h3 id="zoneheader1">LAWASCO M.I.S <?php   print   $company.'-ZONE-'.$zonename; ?></h3><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="A/C STATUS SUMMARY" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#accountstatus">A/C STATUS</button></a></div></div></div></div>
   
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
 </div>
  <br><br>
 
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="REPORTS" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >REPORTS&nbsp;&nbsp;&nbsp;&nbsp;<img src ="ICON17.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	  <li><a href="graphsummary.php"  target= "_blank">GRAPH SUMMARY</a></li> 
        <li><a href="accountstatus.php">ACC CURRENT STATUS </a></li><li><a href="watersalereport.php">WATER SALE REPORT </a></li> 
         
		 <li><a href="ministatement.php">MINISTATEMENT</a></li> 
  		 
		  
      </ul> 
   </div> 
 </div>
 <br><br>
   <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="ANNUAL REPORTS" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >ANNUAL REPORTS&nbsp;&nbsp;&nbsp;
	   <img src ="ICON17.png"  width="20%"  height="20%"> 
	   </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"></ul> 
   </div> 
 </div>
<br><br>
   <div class="btn-group"> 
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
 </div>
 <br><br>
   <div class="btn-group"> 
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
 
 </div>
	<div class="col-sm-3" >
	
	 <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown"> 
       <a href="#"  title="BILLING" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >BILLING&nbsp;&nbsp;&nbsp;&nbsp;<img src ="ICON16.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	   <li><a   href="billsrate.php" target= "_parent" > BILL RATES</a></li><li><a   href="printbill2.php" target= "_parent" >MASS  PRINT BILL</a></li><li><a   href="mainbilling.php" target= "_parent" > BILLING</a></li>
      <li><a   href="billing.php" target= "_parent" >MULTI BILLING</a></li>
	<li><a   href="fieldbilling.php" target= "_parent" >FIELD BILLING</a></li> 	  
        <li><a href="viewbill.php">BILLS SUMMARY</a></li> 
		  <li><a href="billsreport.php">BILLS REPORT</a></li> <li><a href="nonwaterbillsreport.php">NON WATER BILLS</a></li><li><a href="clientquotations.php">QUOTATIONS</a></li><li><a href="archives.php">IMAGE ARCHIVES</a></li> 
		 <li><a href="ministatement.php">MINISTATEMENT</a></li> 
		 <li><a href="statements.php">FULL STATEMENT</a></li><li><a href="refunddeposit.php">REFUND DEPOSIT</a></li><li><a href="archivedstatements.php">ARCHIVED STATEMENT</a></li> 
      </ul> 
   </div> 
 </div>
  <br><br>
   	  <div class="btn-group"> 
 
  <br><br>
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" title="PAYMENT" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom"  >PAYMENT <img src ="ICON20.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="paymentcodes.php">PAYMENT CODES </a></li><li><a href="bankstatements.php">PAYMENT SLIPS </a></li> 
        <li><a href="backuprestore.php">UPLOAD SLIPS</a></li><li><a href="linkslips.php">LINK SLIPS</a></li><li><a href="paynotifications.php">PAY NOTIFICATIONS</a></li><li><a href="reciepts.php">RECEIPTS</a></li><li><a href="unprocessedslips.php">UNPROCESSED SLIPS</a></li> 
		 
      </ul> 
   </div> 
 </div>
 
	</div>
	<div class="col-sm-3" >
	
	 <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown"> 
       <a href="#"  title="REGISTRY" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom"  >REGISTRY<img src ="ICON1.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="newaccount.php" target="_parent" >NEW ACCOUNT </a></li> 
        <li><a  href="accountedit.php" target="_parent" >EDIT ACCOUNT</a></li>
		
		<li><a  href="accountsregistry.php" target="_parent" >VIEW ACCOUNTS</a></li><li><a  href="accountstransfer.php" target="_parent" >ACCOUNTS TRANSFER</a></li><li><a  href="advancedsearch.php" target="_parent" >ADVANCED REG SEARCH</a></li><li><a  href="accountstrail.php" target="_parent" > ACCOUNTS TRAIL</a></li>
		
      </ul> 
   </div> 
 </div>
 
 
 <br><br>
 
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="SMS/EMAILS"  data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   SMS/EMAILS<img src ="ICON3.png"  width="16%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="sms.php" target= "_parent">BILLING SMS/EMAILS </a></li> <li><a href="custormsms.php" target= "_parent">CUSTORM  SMS/EMAILS </a></li><li><a href="sendsmsemail.php" target= "_blank">SEND  SMS/EMAILS </a></li><li><a href="balinquery.php" target= "_parent">BALANCE  INQUERY </a></li><li><a href="viewsms.php" target= "_parent">VIEW  SMS/EMAILS </a></li> 
		  <li><a href="contacts.php" target= "_parent">EDIT CONTACTS </a></li> 
      </ul> 
   </div> 
 </div>
<br><br><br>
 
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="METER REGISTRY" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   METER REGISTRY<img src ="ICON24.png"  width="16%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="meterregistry.php" target= "_parent">METER REGISTRY </a></li><li><a href="unregisteredmeterregistry.php" target= "_parent">UNREGISTERED ACCOUNTS  </a></li><li><a href="metertrail.php" target= "_parent">METER TRAIL </a></li>  
      </ul> 
   </div> 
 </div>
 <br><br><button type="button" class="btn btn-default" data-dismiss="modal" id="close2">CLOSE</button>

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
