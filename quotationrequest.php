<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'INVENTORY REG'      ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if($_SESSION['supplier']==null){$_SESSION['supplier']='';}
if($_SESSION['invoicenumber']==null){$_SESSION['invoicenumber']='';}
if(!isset($_SESSION['quotationrequest'])){$_SESSION['quotationnumber']=null;$_SESSION['quotationrequest']=1;}

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
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

#newquotationrequest{
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
   $('#newquotationrequest').modal('show');
   
   // $("#searchvalue").prop("disabled",true);
    $("#searchsupplier").prop("disabled",true);
	 $('#loadprice').dblclick( function() 
   {    $.post( "pricesession.php",
$("#search-box").serialize(),
function(data){$("#loadprice").load("searchprices.php #sprice");
});  return false;

   return false;

	   })	   

     $('#nextrequest').click( function() 
   {  
var action='GENERATE  NEW REQUEST<br> FOR QUOTATION ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newquotationrequestserial.php",
$("#quotationnumber").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("quotationrequest2.php #newquotationrequests");
$("#nextrequest2").load("quotationrequest.php #quotationnumber");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});	 
	 
	   })
	   
   
	   
$("#deleteitems").load("quotationrequest2.php #newquotationrequests");
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
	        
$("#newquotationrequest").submit(function(){
	var action='ENTER REQUEST FOR QUOTATION ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newquotationrequest.php",
$("#newquotationrequest").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("quotationrequest2.php #newquotationrequests");
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#search").submit(function(){
		var action='SEARCH REQUESTS FOR QUOTATION  ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#search").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("quotationrequests3.php #quotationrequests");

$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})



$("#deleteitems").submit(function(){
	
var action='DELETE THE  QUOTATION REQUESTS ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "deletequotationrequests.php",
$("#deleteitems").serialize(),
function(data){
$("#deleteitems").load("quotationrequest2.php #newquotationrequests");
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
     <a href="#" title="NEW" data-toggle="popover" data-trigger="hover" data-content="QUOTATION REQUEST" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newquotationrequest">NEW QUOTATION REQUEST</button> </a>
	           <a href="#" title="COMPREHENSIVE" data-toggle="popover" data-trigger="hover" data-content="REPORTS " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#search">SEARCH</button> </a>
   <a href="#" title="SEARCH" data-toggle="popover" data-trigger="hover" data-content=" REQUEST FOR QUOTATION " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#viewquotationrequest">VIEW REQUEST FOR QUOTATION </button> </a>
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
  <form class="modal fade" id="newquotationrequest" role="dialog" method="post" action="newquotationrequest.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h1 style="text-align:center;">REQUEST FOR QUOTATION</h1></div></div>
 
 
  <div class="container">
  <div class="row">
  <div class="col-sm-4" > QUOTATION REQUEST SERIALNUMBER   
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SERIAL NUMBER  " data-placement="bottom">
	<div id="nextrequest2">
	<input type="text"  style='text-transform:uppercase' readonly  value ="<?php 	if($_SESSION['quotationnumber'] !=null){print $_SESSION['quotationnumber'];} ?>"   placeholder="SERIAL NUMBER  " class="form-control input-sm"  name="quotationnumber" id="quotationnumber" />
</div></a>
	
	<br></div>
  <div class="col-sm-4" >
  <br><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CLICK TO NEXT REQ.  " data-placement="bottom">
  <button type="button" id="nextrequest" class="btn-info btn-sm" >NEW REQ.</button>  
  </a>
  
  </div>
  <div class="col-sm-4" ></div>
  </div></div>
  
  
  
 <div class="container">
  <div class="row">
  <div class="col-sm-4" >
  SUPPLIER 
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
	
	</div>
   <div class="col-sm-4" >

	</div>
    <div class="col-sm-4" ></div>
  </div></div>
  <hr>

 <div class="container">
  <div class="row">

    <div class="col-sm-4" >
			ITEM NAME
	  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ITEM NAME" data-placement="bottom">
<input  style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" name="item" type="text" size="15" placeholder="ENTER  ITEM NAME"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div><br><br><br><br><br><br><br><br><br><br><br><br>
		


	<div > 

 </div>

	</div>
	<div class="col-sm-4">
QUANTITY
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text" class="form-control input-sm" min="1" pattern="[0-9.]+" title="INVALID ENTRIES"  name="quantity" placeholder="ENTER  QUANTITY"   id="quantity" required="on" /></a>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>	
	
	</div>
	<div class="col-sm-4"></div>
  </div>
</div>
 <div class="container">
  <div class="row">

    <div class="col-sm-4" >



	

	</div>
	    <div class="col-sm-4" >

	


		
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
  
  <form class="modal fade" id="viewquotationrequest" method="post" action="viewquotationrequest.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH REQUEST FOR QUOTATION</h4>
 <br>

	<br>
	<a href="#" title="ENTER  STORES" data-toggle="popover" data-trigger="hover" data-content=" REQUEST FOR QUOTATION #" data-placement="bottom">
    <input type="text" pattern="[0-9]{10}"  title="ENTER TEN DIGITS NUMBER"  class="form-control input-sm"  list="quotationlist"  style='text-transform:uppercase' id="searchvalue" required name ="serialnumber" autocomplete="off"    placeholder="ENTER REQUEST FOR QUOTATION #"  />
	
		 <datalist id="quotationlist">
<?php 
$x="SELECT DISTINCT SERIALNUMBER  FROM QUOTATIONREQUESTS  WHERE DATEDIFF(CURDATE(), DATE) <=1825   ORDER BY  SERIALNUMBER   ";
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
   <h4>SEARCH STORES PURCHASES REQUISITIONS</h4>
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
<form id="deleteitems" method="post" action="deletequotationrequests.php">
xxx
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
<?php include_once("dashboard3.php");  ?>
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
