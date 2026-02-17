<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  ACCESS  REGEXP  'INVENTORY REG'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if($_SESSION['supplier']==null){$_SESSION['supplier']='';}
if($_SESSION['invoicenumber']==null){$_SESSION['invoicenumber']='';}
if(!isset($_SESSION['goodsreceived'])){$_SESSION['serialnumber']=null;$_SESSION['goodsreceived']=1;}

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
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
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
  height: 40%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

#newstock{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
   $('#newstock').modal('show');
   
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
	   

     $('#invoice').click( function() 
   {
	   
	 var x=$("#invoice").prop("checked"); 
	if(x ==true){$("#searchsupplier").prop("disabled",false);
	}
	else if(x ==false){ $("#searchsupplier").prop("disabled",true);
	} 

	   })
		   
$("#deleteitems").load("newstock2.php #newstock");
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
	        
$("#newstock").submit(function(){
	var action='ENTER NEW PURCHASES?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newstock.php",
$("#newstock").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("newstock2.php #newstock");
$("#serialnumberdetails1").load("purchases.php #serialnumberdetails2");
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#newitem").submit(function(){
 	$('#prepostmessage').modal('show');
 $.post( "editstock.php",
$("#newitem").serialize(),
function(data){
//$("#deleteitems").load("stockreport.php #stock");
	
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})



$("#search").submit(function(){
		var action='GENERATE REPORT ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#search").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("searchreceiveditems.php #receiveditems");

$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#searchinvoices").submit(function(){
		var action='GENERATE REPORT ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "searchinvoices.php",
$("#searchinvoices").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("searchinvoices2.php #invoices");

$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#searchinvoices2").submit(function(){
		var action='GENERATE COMPREHENSIVE REPORT ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#searchinvoices2").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("searchinvoices4.php #invoices");

$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})



$("#deleteitems").submit(function(){
	
var action=$('#action').val();
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
	 
if(action=='DELETETRANSACTION')
{
$.post( "deleteinvoice.php",
$("#deleteitems").serialize(),
function(data){
$("#deleteitems").load("newstock2.php #newstock");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
return false;});
}

if(action=='DELETETRANSACTION2')
{
$.post( "deleteinvoice.php",
$("#deleteitems").serialize(),
function(data){
$("#deleteitems").load("searchreceiveditems.php #receiveditems");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
return false;});
}

else if(action=='VIEWDETAILS')
{ 

$.post( "searchinvoices6.php",
$("#deleteitems").serialize(),
function(data){ 
$("#deleteitems").load("searchinvoices5.php #invoices");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
return false;});

 return false;
}

else if(action=='VIEWINVOICES')
{ 

$.post( "searchinvoices7.php",
$("#deleteitems").serialize(),
function(data){ 
$("#deleteitems").load("searchinvoices8.php #invoices");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
return false;});

 return false;
} 
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
		url: "searchinventory.php",
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
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RECEIVE GOODS " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newstock">RECEIVE GOODS</button> </a>
	 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH PURCHASES " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#search">SEARCH</button> </a>
       <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH PURCHASES " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#searchinvoices">REPORTS</button> </a>
	           <a href="#" title="COMPREHENSIVE" data-toggle="popover" data-trigger="hover" data-content="REPORTS " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#searchinvoices2">COMPREHENSIVE</button> </a>
   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH G.R.N " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#receivenote">RECEIVE NOTE </button> </a>
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
  <form class="modal fade" id="newstock" role="dialog" method="post" action="newstock.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h1 style="text-align:center;">GOODS RECIEVED NOTE</h1></div></div>
 
 <div class="container">
  <div class="row">
  <div class="col-sm-4" >SUPPLIER
  <select class="form-control input-sm"  name="supplier" id="supplier" required="on" >
	<?php if($_SESSION['supplier'] !=null)
	{print "<option value='".$_SESSION['supplier']."'>".$_SESSION['supplier']."</option>";}
?>
<option value=''>SELECT  SUPPLIERS</option>
<?php 
$x="SELECT SUPPLIER FROM SUPPLIERS    ORDER BY SUPPLIER  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['SUPPLIER']."'>".$y['SUPPLIER']."</option>";	
		}}

?>
    </select>
	<br>
	DELIVERY DATE
		<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT DELIVERY DATE" data-placement="bottom">
	<input type="date" class="form-control input-sm" value ="<?php 	if($_SESSION['deliverydate'] !=null){print $_SESSION['deliverydate'];} ?>"  name="deliverydate" id="deliverydate" required="on" /></a>
	<br>
	DELIVERED BY 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DELIVERED BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase' value ="<?php 	if($_SESSION['delivered'] !=null){print $_SESSION['delivered'];} ?>"   placeholder="DELIVERED BY " class="form-control input-sm"  name="delivered" id="delivered"  required="on" /></a>
	<br>
		RECEIVED BY 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RECEIVED BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['received'] !=null){print $_SESSION['received'];} ?>" placeholder="RECEIVED BY " class="form-control input-sm"  name="received" id="received"  required="on" /></a>
	<br>
	LSO/LPO #
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="LSO/LPO   " data-placement="bottom">
	<input type="text" list="lponumberlist" style='text-transform:uppercase' value ="<?php 
	if($_SESSION['ordernumber'] !=null){print $_SESSION['ordernumber'];} ?>"   placeholder="LSO/LPO # " class="form-control input-sm"  name="ordernumber" id="ordernumber" autocomplete="off"  required="on" />
	
	 <datalist id="lponumberlist">
	<?php 
$x="SELECT DISTINCT SERIALNUMBER  FROM LPOS  WHERE DATEDIFF(CURDATE(), DATE) <=1825  ORDER BY SERIALNUMBER    ";
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
	
	</a>
	<br>
	
	
	</div>
   <div class="col-sm-4" >SERIAL NUMBER 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SERIAL NUMBER " data-placement="bottom">
	<div id="serialnumberdetails1">
	<input type="text" id="serialnumberdetails2" style='text-transform:uppercase'  value ="<?php print $_SESSION['vouchernumber'];?>" placeholder="SERIAL  NUMBER" class="form-control input-sm"  name="xinvoicenumber" readonly  />
	</div>
	</a>
	<br>
	DELIVERY NOTE/INVOICE #
		<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DELIVERY NOTE/INVOICE # " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 
	if($_SESSION['invoicenumber'] !=null){print $_SESSION['invoicenumber'];}
	
	?>" placeholder="DELIVERY NOTE/INVOICE #" class="form-control input-sm"  name="invoicenumber" id="invoicenumber"  required="on" /></a>
	<br>DESIGNATION 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DESIGNATION" data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['designation1'] !=null){print $_SESSION['designation1'];} ?>" placeholder="DESIGNATION " class="form-control input-sm"  name="designation1" id="invoicenumber"  required="on" /></a>
	<br>DESIGNATION 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DESIGNATION" data-placement="bottom">
	<input type="text"  style='text-transform:uppercase' value ="<?php 	if($_SESSION['designation2'] !=null){print $_SESSION['designation2'];} ?>"  placeholder="DESIGNATION " class="form-control input-sm"  name="designation2" id="invoicenumber"  required="on" /></a>
		<br>DEPARTMENT
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DEPARTMENT   " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase' value ="<?php 
	if($_SESSION['department'] !=null){print $_SESSION['department'];} ?>"   placeholder="DEPARTMENT" class="form-control input-sm"  name="department" id="department"  required="on" /></a>
	<br>
	</div>
    <div class="col-sm-4" ></div>
  </div></div>

 <div class="container">
  <div class="row">

    <div class="col-sm-8" >
	<br>
	 <div class="container">
  <div class="row">

    <div class="col-sm-4" ><br>
	</div>
	    <div class="col-sm-4" >
	</div>

    <div class="col-sm-4" ></div>

	</div>
	</div>
	<br>
			ITEM NAME
	  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ITEM NAME" data-placement="bottom">
<input  style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" name="item" type="text" size="15" placeholder="ENTER  ITEM NAME"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div><br>
    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW ITEM " data-placement="bottom">
	<button class="btn-info btn-sm"  data-toggle="modal" data-target="#newitem">NEW ITEM</button> </a>


	<div > 

 </div>
 <br><br><br>
 <br><br><br>
	</div>
	<div class="col-sm-4"></div>
  </div>
</div>
 <div class="container">
  <div class="row">

    <div class="col-sm-4" >

	QUANTITY
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'   pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"  name="quantity" placeholder="ENTER  QUANTITY"   id="quantity" required="on" /></a>
	<br>
	UNIT BUY PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT BUY PRICE" data-placement="bottom">
	<div id="loadbuyprice">
	
		<input type="text"  pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"  name="buyprice"   id="unitbuyprice" required="on" />

	</div>
	</a><br>
	LOCALITY
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER LOCALITY " data-placement="bottom">
	<input type="text" style='text-transform:uppercase'  pattern="[A-Za-z0-9. ]+" placeholder="ENTER  LOCALITY" title="INVALID ENTRIES"  class="form-control input-sm"  name="locality"  id="locality"  required="on" /></a>
	<br>

	</div>
	    <div class="col-sm-4" >
UNIT SELL PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT SELL PRICE" data-placement="bottom">
	<div id="loadprice">
	
		<input type="text" readonly   pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"  name="price"   id="unitprice"  />

	</div>
	</a><br><br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
		
		</div>
    <div class="col-sm-4" ></div>

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
  
  <form class="modal fade" id="receivenote" method="post" action="goodsreceivednote.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH GOODS RECEIVED  NOTE</h4>
 <br>

	<br>
    <input type="text" pattern="[0-9]{10}"class="form-control input-sm"  list="goodsreceivedlist" style='text-transform:uppercase' id="searchvalue" required name ="serialnumber"   autocomplete="off"  placeholder="ENTER SEARCH DETAILS"  />
 <datalist id="goodsreceivedlist">
<?php 
$x="SELECT DISTINCT VOUCHERNUMBER  FROM STOCKIN  WHERE DATEDIFF(CURDATE(), DATE) <=1825  ORDER BY VOUCHERNUMBER   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['VOUCHERNUMBER']."'>".$y['VOUCHERNUMBER']."</option>";	
		}}

?> 
 </datalist> 
   <br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>

  
  
  <form class="modal fade" id="searchinvoices2" method="post" action="searchinvoices.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>PURCHASES COMPREHENSIVE REPORTS</h4>
   FROM
    <input type="date" class="form-control input-sm"     name="date1"  required   /><br>
	TO <input type="date" class="form-control input-sm"     name="date2"  required   /><br>
   <br>
   SELECT SUPPIER
   <select class="form-control input-sm"  name="supplier" id="supplier" >
<option value=''>ALL SUPPLIERS</option>
<?php 
$x="SELECT DISTINCT SUPPLIER FROM STOCKIN     ORDER BY SUPPLIER  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['SUPPLIER']."'>".$y['SUPPLIER']."</option>";	
		}}

?>
    </select><br>
	<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>
  
  <form class="modal fade" id="search" method="post" action="searchreceiveditems.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH GOODS RECEIVED RECORDS</h4>
   FROM
    <input type="date" class="form-control input-sm"     name="date1"  required   /><br>
	TO <input type="date" class="form-control input-sm"     name="date2"  required   /><br>
   <br>

	<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>
  
  
  
  
  
     <form class="modal fade" id="newitem" role="dialog" method="post"  action="editstock.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
<h2 style='text-transform:uppercase;text-align:center;' >ENTER NEW ITEM DETAILS</h2><br>
ITEM NAME
<input type="text"  pattern="[0-9A-Za-z`/\- .,]+" title="INVALID ENTRIES" placeholder="ENTER ITEM  NAME "  class="form-control input-sm" name="item"   style='text-transform:uppercase'  required  id="item" >
<br />

 <div class="container">
  <div class="row">
  <div class="col-sm-4">
  ITEM CODE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER ITEM CODE " data-placement="bottom">
	<input type="text"  pattern="[A-Za-z0-9]+" placeholder="ENTER ITEM CODE" title="INVALID ENTRIES"  class="form-control input-sm"  name="itemcode"  id="itemcode"  required="on" /></a>
	<br>

UNIT 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNITS" data-placement="bottom">
	<input type="text"  pattern="[A-Z,a-z.]+" placeholder="UNIT " title="INVALID ENTRIES"  class="form-control input-sm"  name="units"  id="units"  required="on" /></a>
	<br>
MINIMUM STOCK LEVEL
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  MINIMUM STOCK LEVEL" data-placement="bottom">
	<input type="number" min="0" required="on"   style='text-transform:uppercase' pattern="[0-9]+" title="INVALID ENTRIES" class="form-control input-sm"  name="minstocklevel" placeholder="MINIMUM STOCK LEVEL" id="minstocklevel"  /></a>

<br>	
	</div>
  <div class="col-sm-4">
  <input type="hidden"    class="form-control input-sm" name="action"   style='text-transform:uppercase'  value ="NEWITEM">
<input type="hidden"    class="form-control input-sm" name="quantity"   style='text-transform:uppercase'  value ="0">

UNIT BUY PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT BUY PRICE" data-placement="bottom">
		<input type="text"   style='text-transform:uppercase' pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"   name="bprice"    required="on" />

	</a><br>
	UNIT SELL PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT SELL PRICE" data-placement="bottom">
		<input type="text"  style='text-transform:uppercase'  pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"  name="sprice"   required="on" />

	</a>
	<br><br>
	<select class="form-control"   required= "on"   id="category" name="category"  required= "on" >
			   <option value="">SELECT ITEM CATEGORY </option>
			  <?php 
		$x="SELECT CATEGORY FROM ITEMCATEGORIES ";	  
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<option value='".$y['CATEGORY']."'>".$y['CATEGORY']."</option>";		
		
			
		}}
			  
			  ?>
			    <option value=""> </option>
 			  </select>
		   <br>
	
	</div>
  <div class="col-sm-4"></div>
  </div></div>
  
  
<br>

	


	
	
    </div>
		<div>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
  
   <form class="modal fade" id="searchinvoices" method="post" action="searchinvoices.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
    <input type="date" class="form-control input-sm"     name="date1"  required   /><br>
	<input type="date" class="form-control input-sm"     name="date2"  required   /><br>
    <input type="text" class="form-control input-sm"  style='text-transform:uppercase' name="searchvalue"     placeholder="ENTER SEARCH DETAILS"  />
 <br>
 <select class="form-control input-sm"  name="supplier"  id="supplier" >
 
<option value=''>SELECT  SUPPLIERS</option>
<?php 
$x="SELECT SUPPLIER FROM SUPPLIERS   ORDER BY SUPPLIER ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['SUPPLIER']."'>".$y['SUPPLIER']."</option>";	
		}}

?>
    </select><br>
	<br>
<select class="form-control input-sm" required="on" name="searchmethod"  >
<option value="">SELECT SEARCH</option>
<option value="item">ITEM NAME</option>
<option value="invoice">DELIVERY NOTE/INVOICE #</option>
<option value="voucher">GOODS RECEIVED NOTE # </option>
<option value="supplier"     >SUPPIER</option>
<option value="batch">SERIAL NUMBER </option>
<option value="deliverydate">DELIVERY DATE </option>
</select>
   <br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>

<form id="deleteitems" method="post" action="deleteinvoice.php">

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
