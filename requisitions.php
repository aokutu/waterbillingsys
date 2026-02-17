<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password'       ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
	@media print{reciept{ font-size:80%;}}
	@media print{body{font-weight: bold;width:100%; margin-right:0%; margin-left:0%;}}
  @media print{ button{display:none;} #checks{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%; }
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}
#reciept{ font-size:80%;}
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; } body {text-transform:inherit;}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}
h4{ text-align:center;}
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
			  text-align:center;
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }
	  #idnumber-list
{
	 overflow-y: scroll;      
  height: 60%;            
  width: 100%;
  position: absolute;
}

#newrequisition{
  overflow-y: scroll;      
  height: 100%;           
  width: 100%;
  position: absolute;
}

  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
   $('#newrequisition').modal('show');
  $("#pendingrequisition").load("pendingrequisition.php");
 
 $('#requisitioner').click( function() 
   {    $.post( "authorizerslist.php",
$("#requisitioner").serialize(),
function(data){$("#authorizerslist").load("authorizerslist2.php #authorizer2");
});  return false;

   return false;

	   })
 
  $('#requisitioner2').click( function() 
   {    $.post( "authorizerslist.php",
$("#requisitioner2").serialize(),
function(data){$("#authorizerslist2").load("authorizerslist2.php #authorizer2");
});  return false;

   return false;

	   })
 
$("#search").submit(function(){
		var action='SEARCH FOR STORE ISSUE  NOTES  ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#search").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#pendingrequisition").load("issuenotes.php");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})
		   
	    $('#billed').click( function() 
   {
	 var x=$("#billed").prop("checked"); 
	if(x ==true){$("#unitprice").prop("disabled",true);$("#bprice").prop("disabled",true);$("#quantity").prop("disabled",true); $("#search-box").prop("disabled",true);     }

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


$("#newrequisition").submit(function(){
	$('#prepostmessage').modal('show');
$.post( "newrequisition.php",
$("#newrequisition").serialize(),
function(data){
$("#content").load("message.php #content");
 $("#pendingrequisition").load("pendingrequisition.php");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
 
return false;});
return false;
})

     $('#nextrequisition').click( function() 
   {  
var action='GENERATE  NEW REQUISITION ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newissuenotenumber.php",
$("#serialnumber").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#pendingrequisition").load("pendingrequisition.php");
$("#issuenotedetails1").load("requisitions.php  #issuenotedetails2");
$("#nextgatepass2").load("purchasesreq.php #serialnumber");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});	 
	 
	   })
	   



$("#issueitems").submit(function(){
		var action='ISSUE  ITEMS ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "issueitems.php",
$("#issueitems").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#pendingrequisition").load("dispatchitems.php");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#pendingrequisition").submit(function(){
	
		var action=$("#action2").val();
	 var x=confirm(action);   
	 if(x ==false){return false; }
	  $('#prepostmessage').modal('show');
$.post("processrequisition3.php",
$("#pendingrequisition").serialize(),
function(data){	 
$("#content").load("message.php #content");	
}); 
$('#prepostmessage').modal('hide'); $('#message').modal('show');
if(action =='DELETE'){$("#pendingrequisition").load("pendingrequisition.php"); return false;}
if(action =='DISPATCH'){$("#pendingrequisition").load("dispatchitems.php"); return false;}	  
 return true;
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
		url: "searchpos.php",
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
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
       <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW STORES ISSUE NOTE" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newrequisition">NEW STORE ISSUE NOTE </button> </a>	 
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH ISSUE NOTES " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#search">SEARCH </button> </a>	 
	    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DISPATCH ITEMS" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#issueitems">DISPATCH </button></a>
 <a href="#" title="SEARCH" data-toggle="popover" data-trigger="hover" data-content="VIEW ISSUE NOTE" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#searchissuenote">VIEW ISSUE NOTE </button></a>
  <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
    <!-- Modal -->

  </div>
  
   <div class="container"  id="checks">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
  <form class="modal fade" id="newrequisition" role="dialog" method="post" action="newrequisition.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
  <div class="modal-header"><div class="modal-header"><h3 style="text-align:center;"><strong>NEW STORE ISSUE NOTE</strong></h3></div></div>
  
   <div class="container">
  <div class="row">
   <div class="col-sm-8" > 

   </div>
   <div class="col-sm-4" ></div>
  </div></div>
  <div class="container" >
  <div class="row"  >

    <div class="col-sm-8" >
	  <div class="container" id="issuenotedetails1"  >
  <div class="row" id="issuenotedetails2" >

    <div class="col-sm-4" >
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SERIAL NUMBER  " data-placement="bottom">
	<div id="nextgatepass2">
	<input type="text"  style='text-transform:uppercase' readonly  value ="<?php 	if($_SESSION['serialnumber'] !=null){print $_SESSION['serialnumber'];} ?>"   placeholder="SERIAL NUMBER  " class="form-control input-sm"  name="serialnumber" id="serialnumber" />
</div></a>
<br>
	REQUISITION BY
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  REQUISITIONER" data-placement="bottom">
	<input type="text" style='text-transform:uppercase'   class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES"  value ="<?php 	if($_SESSION['requisitioner'] !=null){print $_SESSION['requisitioner'];} ?>"   name="requisitioner"  id="requisitionerx" required="on"  /></a>	
	<br>
	
		AUTHORIZED BY
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  AUTHORIZER" data-placement="bottom">
	<input type="text" style='text-transform:uppercase'   class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES" value ="<?php 	if($_SESSION['authorizer'] !=null){print $_SESSION['authorizer'];} ?>"   name="authorizer"  id="authorizerx" required="on" /></a>	
	<br>
	ISSUED BY 
			<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ISSUER " data-placement="bottom">
	<input type="text"    class="form-control input-sm"  placeholder="ENTER  ISSUER" style='text-transform:uppercase'  pattern="[0-9A-Za-z ]+"  value ="<?php 	if($_SESSION['issuer'] !=null){print $_SESSION['issuer'];} ?>"   name="issuer"   id="issuer"  /></a>
	<br>
	APPROVED BY 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  APPROVER " data-placement="bottom">
	<input type="text"    class="form-control input-sm" placeholder="APPROVED BY"   style='text-transform:uppercase'  pattern="[0-9A-Za-z ]+"  value ="<?php 	if($_SESSION['approver'] !=null){print $_SESSION['approver'];} ?>"   name="approver"   id="approver"  /></a>
	
	</div><div class="col-sm-4" >
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CLICK TO NEXT ISSUE NOTE.  " data-placement="bottom">
  <button type="button" id="nextrequisition" class="btn-info btn-sm" >NEXT ISSUE NOTE.</button>  
  </a><br><br>
	REQUISITIONER TITLE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  REQUISITIONERER TITLE" data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES" value ="<?php 	if($_SESSION['requisitionertitle'] !=null){print $_SESSION['requisitionertitle'];} ?>"  name="requisitionertitle"  id="requisitionertitlx" required="on" /></a>	
	<br>
	
		AUTHORIZER TITLE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  AUTHORIZER TITLE" data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES"  value ="<?php 	if($_SESSION['authorizertitle'] !=null){print $_SESSION['authorizertitle'];} ?>"  name="authorizertitle"  id="authorizertitlex" required="on" /></a>	
	<br>
	ISSUER TITLE 
				<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ISSUER TITLE " data-placement="bottom">
	<input type="text"    class="form-control input-sm"  placeholder="ENTER  ISSUER TITLE"  style='text-transform:uppercase'  pattern="[0-9A-Za-z ]+"  value ="<?php 	if($_SESSION['issuertitle'] !=null){print $_SESSION['issuertitle'];} ?>"   name="issuertitle"   id="issuertitle"  /></a>
	<br>
	APPROVER TITLE
				<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  APPROVER TITLE " data-placement="bottom">
	<input type="text"    class="form-control input-sm"  placeholder="APPROVER TITLE" style='text-transform:uppercase'  pattern="[0-9A-Za-z ]+"  value ="<?php 	if($_SESSION['approvertitle'] !=null){print $_SESSION['approvertitle'];} ?>"    name="approvertitle"   id="approvertitle"  /></a>
				
	
	
	</div><div class="col-sm-4" ></div></div></div>
	<br>
			PURPOSE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PURPOSE" data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  class="form-control input-sm"  pattern="[0-9A-Za-z, .]+" title="INVALID ENTRIES" value ="<?php 	if($_SESSION['purpose'] !=null){print $_SESSION['purpose'];} ?>"   name="purpose"  id="purposex" required="on" /></a>	
	<br>
	
	
	ITEM NAME
	  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ITEM NAME" data-placement="bottom">
<input  style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES"   name="item" type="text" size="15" placeholder="ENTER  ITEM NAME"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div><br><br><br>

	QUANTITY
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="number"    class="form-control input-sm"  name="quantity"  min="1" id="quantity" required="on" /></a>
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
  
   <form class="modal fade" id="search" method="post" action="searchinvoices.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH STORES ISSUE NOTES ITEMS</h4>
   FROM
    <input type="date" class="form-control input-sm"     name="date1"  required   /><br>
	TO <input type="date" class="form-control input-sm"     name="date2"  required   /><br>
	<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>
  
  <form class="modal fade" id="searchissuenote" method="post" action="searchissuenote.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH STORES ISSUES NOTE </h4>
 <br>

	<br>
	<a href="#" title="ENTER  STORES" data-toggle="popover" data-trigger="hover" data-content=" STORES ISSUES NOTE #" data-placement="bottom">
    <input type="text" pattern="[0-9]{10}"  title="ENTER TEN DIGITS NUMBER"  class="form-control input-sm"  style='text-transform:uppercase' id="serialnumber" required name ="serialnumber"     placeholder="ENTER STORES ISSUE NOTE #"  />
	</a>

   <br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>



  
  <form class="modal fade" id="issueitems" role="dialog" method="post"  action="issueitems.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
  <h4>SELECT  STORES ISSUE  NOTE  NUMBER</h4>
<div>
ISSUE NOTE NUMBER
  <select class="form-control input-sm"  name="issuenotenumber"  required="on" >
<option >SELECT  REQUISITIONER</option>
<?php 
$x="SELECT SERIALNUMBER  FROM REQUISITION WHERE   SERIALNUMBER >0 AND STATUS='APPROVED'  GROUP BY SERIALNUMBER ORDER BY  SERIALNUMBER   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['SERIALNUMBER']."'>".$y['SERIALNUMBER']."</option>";	
		}}

?>
    </select>


<br />
    </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>  

<form id="pendingrequisition" method="post" action="processrequisition3.php">

</form>
   <form class="modal fade" id="reciepts" role="dialog" method="post"  action="posreciepts.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
FROM<input type="date" class="form-control input-sm" name="date1" id="date1"  required="on"><br />
TO <input type="date" class="form-control input-sm" name="date2" id="date2"  required="on"><br />

    </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>  

  <!--dashboard-->
  <!-- 	dashboard-->
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