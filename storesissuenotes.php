<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password'  AND  ACCESS  REGEXP  'INVENTORY REG'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if(!isset($_SESSION['storeissuenote'])){$_SESSION['issuenotenumber']=null;$_SESSION['storeissuenote']=1;}

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
  height: 30%;            
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


$("#trsearch").submit(function(){
		var action='SEARCH TRANSACTION \n NUMBER '+$("#transactionreff").val()+'?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#trsearch").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#pendingrequisition").load("trsearch.php");
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
	var item=$("#search-box").val();
	var quantity=$("#quantity").val();
	
	var action='ISSUE '+ quantity + '\n '+ item;
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
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
$("#issuenotedetails1").load("storesissuenotes.php  #issuenotedetails2");
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
if(action =='DISPATCH'){  
$("#oldissuenotenumber").load("storesissuenotes.php   #newissuenotenumber"); 
$("#pendingrequisition").load("dispatchitems.php"); return false;}	  
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
	  <a href="#" title="SEARCH BY" data-toggle="popover" data-trigger="hover" data-content=" TRANSACTION NO. " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#trsearch">TR-SEARCH </button> </a>	 
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
	<input type="text"  style='text-transform:uppercase' readonly  value ="<?php 	if($_SESSION['issuenotenumber'] !=null){print $_SESSION['issuenotenumber'];} ?>"   placeholder="SERIAL NUMBER  " class="form-control input-sm"  name="serialnumber" id="serialnumber" />
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
			
	
	
	ITEM NAME
	  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ITEM NAME" data-placement="bottom">
<input  style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES"   name="item" type="text" size="15" placeholder="ENTER  ITEM NAME"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div><br><br><br><br><br><br>


  <div class="container" >
  <div class="row"  >
    <div class="col-sm-4" >QUANTITY
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text"  pattern="[0-9.]+" title="INVALID ENTRIES"   class="form-control input-sm"  name="quantity"   id="quantity" required="on" /></a>
	<br></div>
	<div class="col-sm-4" >PURPOSE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PURPOSE" data-placement="bottom">
	<input type="text"  placeholder="ENTER PURPOSE"  style='text-transform:uppercase'  class="form-control input-sm"  pattern="[0-9A-Za-z, .]+" title="INVALID ENTRIES"    name="purpose"  required="on" /></a>	
	<br></div>
	<div class="col-sm-4" ></div>
	</div></div>
	
	
	

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
  
  <form class="modal fade" id="trsearch" method="post" action="trsearch.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH TRANSACTION </h4>
   TRANSACTION NUMBER 
    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER TRANSACTION NUMBER" data-placement="bottom">
	
		 <input type="text" pattern="[0-9]{10}" title="INVALID ENTRIES" list="transactionlist"   class="form-control input-sm"  style='text-transform:uppercase'  required placeholder="ENTER TRANSACTION  REFFERENCE NUMBER"   autocomplete='off'  id="transactionreff" name="transactionreff" >  
 <datalist id="transactionlist">
<?php 
$x="SELECT DISTINCT TRANSACTIONREFF  FROM REQUISITION  WHERE DATEDIFF(CURDATE(), DATE) <=1825  AND STATUS='ISSUED'  ORDER BY TRANSACTIONREFF DESC   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['TRANSACTIONREFF']."'>".$y['TRANSACTIONREFF']."</option>";	
		}}

?> 
 </datalist> 
 </a>
 
	
	
	</a>
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
		 <input type="text" pattern="[0-9]{10}" title="INVALID ENTRIES" list="issuenotelist2"   class="form-control input-sm"  style='text-transform:uppercase' id="serialnumber" required placeholder="ENTER STORES ISSUE NOTE #" name="serialnumber" autocomplete="off" >  
 <datalist id="issuenotelist2">
<?php 
$x="SELECT DISTINCT SERIALNUMBER  FROM REQUISITION  WHERE DATEDIFF(CURDATE(), DATE) <=1825  ORDER BY SERIALNUMBER DESC   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['SERIALNUMBER']."'>".$y['SERIALNUMBER']."</option>";	
		}}

?> 
 </datalist> </a>
	
	
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
<div id="oldissuenotenumber">
<div  id="newissuenotenumber">
ISSUE NOTE NUMBER
<input type="text" pattern="[0-9]{10}" title="INVALID ENTRIES" list="issuenotelist"   class="form-control input-sm"  name="issuenotenumber"  required="on" autocomplete="off" >  
 <datalist id="issuenotelist">
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
 </datalist> 
 
 


<br />
    </div></div>
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

 <?php include_once("dashboard3.php"); ?>
 
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