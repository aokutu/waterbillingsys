<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
include_once("dashboard3.php");
$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  NAME='$dbdetails->user' AND PASSWORD='$dbdetails->password' AND ACCESS  REGEXP  'GATE PASS' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


if($_SESSION['supplier']==null){$_SESSION['supplier']='';}
if($_SESSION['invoicenumber']==null){$_SESSION['invoicenumber']='';}
if(!isset($_SESSION['gatepass'])){$_SESSION['gatepassnumber']=null;$_SESSION['gatepass']=1;}

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
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}
  table { font-size:80%;}

	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; } body {text-transform:inherit;}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            
  width: 100%;
  position: absolute;
}
h4{ text-align:center;}
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
  height: 80%;            
  width: 100%;
  position: absolute;
}

#newgatepass{
  overflow-y: scroll;      
  height: 80%;            
  width: 100%;
  position: absolute;
}
  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
   $('#newgatepass').modal('show');
   
   // $("#searchvalue").prop("disabled",true);
    $("#searchsupplier").prop("disabled",true);
	 $('#loadprice').dblclick( function() 
   {    $.post( "pricesession.php",
$("#search-box").serialize(),
function(data){$("#loadprice").load("searchprices.php #sprice");
});  return false;

   return false;

	   })
	   
	   
	   
		 $('#loadbuyprice').dblclick( function() 
   {    $.post( "pricesession.php",
$("#search-box").serialize(),
function(data){$("#loadbuyprice").load("searchprices.php #bprice");
});  return false;

   return false;

	   })
	   

     $('#nextrequisition').click( function() 
   {  
var action='GENERATE  NEW GATEPASS ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newgatepassserial.php",
$("#serialnumber").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("gatepass2.php #newgatepasses");
$("#nextgatepass2").load("gatepass.php #serialnumber");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});	 
	 
	   })
	  	  
     	   
$("#deleteitems").load("gatepass2.php #newgatepasses");
//$("#deleteitems").load("purchasesinvoices.php   #newstock ");
	   
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
	        
$("#newgatepass").submit(function(){
	var action='GENERATE  NEW  GATE PASS ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
	  $.post( "newgatepass.php",
$("#newgatepass").serialize(),
function(data){
$("#deleteitems").load("gatepass2.php #newgatepasses");
	
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});

return false;
})




$("#search").submit(function(){
		var action='SEARCH GATE PASSES ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#search").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("gatepass3.php #newgatepasses");

$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})



$("#deleteitems").submit(function(){
	
var action='DELETE THE  REQUISITIONS ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "deletepurchasesreq.php",
$("#deleteitems").serialize(),
function(data){
$("#deleteitems").load("gatepass2.php #newgatepasses");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
return false;});
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
     <a href="#" title="NEW" data-toggle="popover" data-trigger="hover" data-content="NEW GATE PASS " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newgatepass">NEW GATE PASS</button> </a>
	           <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="REPORTS " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#search">SEARCH</button> </a>
   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH GATE PASS " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#viewgatepass">VIEW GATE PASS</button> </a>
  <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  

    <!-- Modal -->
  </div>
  
   <div class="container">
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
  <form class="modal fade" id="newgatepass" role="dialog" method="post" action="newgatepass.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h1 style="text-align:center;">GATE PASS </h1></div></div>
 
 
  <div class="container">
  <div class="row">
  <div class="col-sm-4" > GATE PASS SERIAL NUMBER  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SERIAL NUMBER  " data-placement="bottom">
	<div id="nextgatepass2">
	<input type="text"  style='text-transform:uppercase' readonly  value ="<?php 	if($_SESSION['gatepassnumber'] !=null){print $_SESSION['gatepassnumber'];} ?>"   placeholder="SERIAL NUMBER  " class="form-control input-sm"  name="serialnumber" id="serialnumber" />
</div></a>
	
	<br></div>
  <div class="col-sm-4" >
  <br><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CLICK TO NEXT GATE PASS.  " data-placement="bottom">
  <button type="button" id="nextrequisition" class="btn-info btn-sm" >NEW GATE PASS.</button>  
  </a>
  
  </div>
  <div class="col-sm-4" ></div>
  </div></div>
  
  
  
 <div class="container">
  <div class="row">
  <div class="col-sm-4" >
		ISSUED  BY 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ISSUED  BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase' value ="<?php 	if($_SESSION['issuer'] !=null){print $_SESSION['issuer'];} ?>"   placeholder="ISSUED  BY " class="form-control input-sm"  name="issuer" id="issuer"  required="on" /></a>
	<br>
		RECEIVED BY  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RECEIVED BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['receiver'] !=null){print $_SESSION['receiver'];} ?>" placeholder="RECEIVED BY " class="form-control input-sm"  name="receiver" id="receiver"  required="on" /></a>
	<br>
	TRANSPORTED BY  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="TRANSPORTED BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['transporter'] !=null){print $_SESSION['transporter'];} ?>" placeholder="TRANSPORTED BY " class="form-control input-sm"  name="transporter" id="transporter"  required="on" /></a>
	<br>
	VEHICLE 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="VEHICLE " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['vehicle'] !=null){print $_SESSION['vehicle'];} ?>" placeholder="APPROVED BY " class="form-control input-sm"  name="vehicle" id="vehicle"  required="on" /></a>
	
	</div>
   <div class="col-sm-4" >
	ISSUER	TITLE  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ISSUER  TITLE  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['issuertitle'] !=null){print $_SESSION['issuertitle'];} ?>" placeholder=" ISSUER TITLE " class="form-control input-sm"  name="issuertitle" id="issuertitle"  required="on" /></a>
	<br>
	RECEIVER TITLE  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RECEIVER TITLE  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['receivertitle'] !=null){print $_SESSION['receivertitle'];} ?>" placeholder="RECEIVER TITLE " class="form-control input-sm"  name="receivertitle" id="receivertitle"  required="on" /></a>
	<br>
	TRANSPORTER TITLE  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="TRANSPORTER TITLE  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['transportertitle'] !=null){print $_SESSION['transportertitle'];} ?>" placeholder="TRANSPORTER TITLE " class="form-control input-sm"  name="transportertitle" id="transportertitle"  required="on" /></a>
	<br>NO.  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="VEHICLE NUMBER  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['vehiclenumber'] !=null){print $_SESSION['vehiclenumber'];} ?>" placeholder="VEHICLE NUMBER " class="form-control input-sm"  name="vehiclenumber" id="vehiclenumber"  required="on" /></a>
	<br>
	
	</div>
    <div class="col-sm-4" ></div>
  </div></div>

 <div class="container">
  <div class="row">

    <div class="col-sm-8" >
	 <div id="itemdetails"></div>
	<br>
	 <div class="container">
  <div class="row">

    <div class="col-sm-3" >ITEM <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ITEM NAME" data-placement="bottom">
<input  style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES"   name="item" type="text" size="15" placeholder="ENTER  ITEM NAME"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div><br><br><br><br><br><br><br><br><br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm" >RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>   

	</div>
	    <div class="col-sm-3" >QUANTITY<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="QUANTITY   " data-placement="bottom">
	<input type="text"   style='text-transform:uppercase'   placeholder="QUANTITY " class="form-control input-sm"  name="quantity" id="quantity"  required="on" /></a>
	<br></div>

    <div class="col-sm-3" >POINT OF USE  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="POINT OF  USE  " data-placement="bottom">
	<input type="text"   style='text-transform:uppercase' value ="<?php 	if($_SESSION['pointofuse'] !=null){print $_SESSION['pointofuse'];} ?>"   placeholder="POINT OF USE " class="form-control input-sm"  name="pointofuse" id="pointofuse"  required="on" /></a>
	<br></div>
	<div class="col-sm-3" ></div>

	</div>
	</div>
	<br>
			


	<div > 

 </div>
 <br><br><br>
 <br><br><br>
 <br><br><br>
	</div>
	<div class="col-sm-4"></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  
  <form class="modal fade" id="viewgatepass" method="post" action="viewgatepass.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH GATE PASS</h4>
 <br>

	<br>
	<a href="#" title="ENTER  STORES" data-toggle="popover" data-trigger="hover" data-content=" GATE PASS SERIAL  #" data-placement="bottom">
    <input autocomplete="off" list="gatepasslist"  type="text" pattern="[0-9]{10}"  title="ENTER TEN DIGITS NUMBER"  class="form-control input-sm"  style='text-transform:uppercase' id="searchvalue" required name ="serialnumber"     placeholder="ENTER GATE PASS  #"  />
	
	<datalist id="gatepasslist">
	<?php 
$x=$connect->query("SELECT DISTINCT SERIALNUMBER FROM GATEPASS   WHERE DATEDIFF(CURDATE(), DATE) <=1825    ORDER BY SERIALNUMBER     ");
while ($data = $x->fetch_object())
{   	
print "
<option value='".$data->SERIALNUMBER."'>".$data->SERIALNUMBER."</option>";	
		}

?> 
 </datalist>
	</a>

   <br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>

  
  
  <form class="modal fade" id="search" method="post" action="searchinvoices.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH GATE PASSES</h4>
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
<form id="deleteitems" method="post" action="deletepurchasesreq.php">

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
