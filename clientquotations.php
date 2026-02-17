<?php  header("LOCATION:accessdenied4.php");exit; 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password' AND  ACCESS  REGEXP  'BILLING' OR name='$user' AND password='$password'  AND  ACCESS  REGEXP  'INVENTORY REG'       ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if(!isset($_SESSION['clientquotations'])){$_SESSION['serialnumber']=null;$_SESSION['clientquotations']=1;}

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

#newquotation{
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
   $('#newquotation').modal('show');
  $("#pendingrequisition").load("pendingquotations.php");
 
 $('#requisitioner').click( function() 
   {    $.post( "authorizerslist.php",
$("#requisitioner").serialize(),
function(data){$("#authorizerslist").load("authorizerslist2.php #authorizer2");
});  return false;

   return false;

	   })
	   
	   

$('#quantity').keyup(function() {
	var price = $('#unitprice').val();
var ttl=price *$('#quantity').val();
$("#totalprice").val(ttl);
});

$('#unitprice').keyup(function() {
	var price = $('#unitprice').val();
var ttl=price *$('#quantity').val();
$("#totalprice").val(ttl);
});


 
  $('#requisitioner2').click( function() 
   {    $.post( "authorizerslist.php",
$("#requisitioner2").serialize(),
function(data){$("#authorizerslist2").load("authorizerslist2.php #authorizer2");
});  return false;

   return false;

	   })
 
$("#search").submit(function(){
		var action='SEARCH FOR CLENT QUOTATIONS  ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#search").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#pendingrequisition").load("clientquotations2.php");
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


$("#newquotation").submit(function(){
	$('#prepostmessage').modal('show');
$.post( "newquotation.php",
$("#newquotation").serialize(),
function(data){
$("#content").load("message.php #content");
 $("#pendingrequisition").load("pendingquotations.php");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
 
return false;});
return false;
})

     $('#nextrequisition').click( function() 
   {  
var action='GENERATE  NEW QUOTATION ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newclientquotation.php",
$("#serialnumber").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#pendingrequisition").load("pendingquotations.php");
$("#quotationdetails1").load("clientquotations.php  #quotationdetails2");
$("#nextquotation2").load("clientquotations.php #serialnumber");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});	 
	 
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
		url: "quotationpos.php",
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
       <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW QUOTATION" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newquotation">NEW QUOTATION </button> </a>	 
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH QUOTATIONS " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#search">SEARCH </button> </a>	 
 <a href="#" title="SEARCH" data-toggle="popover" data-trigger="hover" data-content="VIEW QUOTATION" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#searchissuenote">VIEW QUOTATION </button></a>
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
  <form class="modal fade" id="newquotation" role="dialog" method="post" action="newquotation.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
  <div class="modal-header"><div class="modal-header"><h3 style="text-align:center;"><strong>NEW CLIENT QUOTATION</strong></h3></div></div>
  
  
  <div class="container" >
  <div class="row"  >

    <div class="col-sm-8" >
	  <div class="container" id="quotationdetails1"  >
  <div class="row" id="quotationdetails2" >

    <div class="col-sm-3" >
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SERIAL NUMBER  " data-placement="bottom">
	<div id="nextquotation2">
	<input type="text"  style='text-transform:uppercase' readonly  value ="<?php 	if($_SESSION['serialnumber'] !=null){print $_SESSION['serialnumber'];} ?>"   placeholder="SERIAL NUMBER  " class="form-control input-sm"  name="serialnumber" id="serialnumber" />
</div></a>
<br>
	ACCOUNT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT NUMBER" data-placement="bottom">
	<input type="text" style='text-transform:uppercase'   class="form-control input-sm"  pattern="[0-9A-Za-z]{11}" title="INVALID ENTRIES"  value ="<?php 	if($_SESSION['account'] !=null){print $_SESSION['account'];} ?>"   name="account"  id="account" autocomplete="off" /></a>	
	<br>
	
		NAMES
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  CLINET NAMES" data-placement="bottom">
	<input type="text" style='text-transform:uppercase'   class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES" value ="<?php 	if($_SESSION['name'] !=null){print $_SESSION['name'];} ?>"   name="name"  id="name" required="on" autocomplete="off" /></a>	
	
	</div><div class="col-sm-3" >
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CLICK TO NEXT QUOTATION.  " data-placement="bottom">
  <button type="button" id="nextrequisition" class="btn-info btn-sm" >NEXT QUOTATION.</button>  
  </a><br><br>
	CONTACTS
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  CONTACTS" data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES" value ="<?php 	if($_SESSION['contacts'] !=null){print $_SESSION['contacts'];} ?>"  name="contacts"  id="contacts"  /></a>	
	<br>
	
		DATE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  AUTHORIZER TITLE" data-placement="bottom">
	<input type="date"  style='text-transform:uppercase'  class="form-control input-sm"     value ="<?php 	if($_SESSION['date'] !=null){print $_SESSION['date'];} ?>"  name="date"  id="date" required="on" /></a>	
	<br>
		
	
	
	</div><div class="col-sm-3" >PREPARED BY
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER PREPARED BY" data-placement="bottom">
	<input type="text" placeholder="PREPARED BY " style='text-transform:uppercase'  class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES" value ="<?php 	if($_SESSION['preparer'] !=null){print $_SESSION['preparer'];} ?>"  name="preparer"  id="preparer"  /></a>	
	<br>PLOT NUMBER
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER PLOT NUMBER" data-placement="bottom">
	<input type="text" placeholder="PLOT NUMBER"   style='text-transform:uppercase'  class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES" value ="<?php 	if($_SESSION['plotnumber'] !=null){print $_SESSION['plotnumber'];} ?>"  name="plotnumber"  id="plotnumber"  /></a>	
	<br>
	LOCATION
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER LOCATION" data-placement="bottom">
	<input type="text" placeholder="PLOT LOCATION"  style='text-transform:uppercase'  class="form-control input-sm"  pattern="[0-9A-Za-z ]+" title="INVALID ENTRIES" value ="<?php 	if($_SESSION['location'] !=null){print $_SESSION['location'];} ?>"  name="location"  id="location"  /></a>	
	<br>
</div>
	<div class="col-sm-3" ></div>
	</div></div>
	<br>
			
	
	ITEM NAME
	  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ITEM NAME" data-placement="bottom">
<input  style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES"   name="item" type="text" size="15" placeholder="ENTER  ITEM NAME"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div><br><br><br><br><br><br><br>
 <div class="container">
  <div class="row">
   <div class="col-sm-3" >
PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT PRICE" data-placement="bottom">
	<input type="text"  pattern="[-0-9.]+" title="INVALID ENTRIES"   class="form-control input-sm"  name="price"   id="unitprice" required="on" /></a>
	<br>WAIVER
		<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  WAIVER" data-placement="bottom">
	<input type="text" placeholder="ENTER WAIVER " pattern="[-0-9.]+" title="INVALID ENTRIES"   class="form-control input-sm"  name="waiver"   id="waiver" /></a>

   </div>
    <div class="col-sm-3" > QUANTITY
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text"    class="form-control input-sm" pattern="[0-9.]+" title="INVALID ENTRIES" name="quantity"   id="quantity" required="on" /></a>
	<br><br>
	  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>

	</div>
	 <div class="col-sm-3" >AMOUNT
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT PRICE" data-placement="bottom">
	<input type="text"  pattern="[0-9.]+" title="INVALID ENTRIES"   class="form-control input-sm"  name="totalprice" readonly  id="totalprice" required="on" /></a>
 </div>
	  <div class="col-sm-3" > </div>
  </div></div>
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
  
   <form class="modal fade" id="search" method="post" action="searchinvoices.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH CLIENT QUOTATIONS</h4>
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
  
  <form class="modal fade" id="searchissuenote" method="post" action="searchquotation.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH CLIENT'S QUOTATION </h4>
 <br>

	<br>
	<a href="#" title="ENTER  CLIENT " data-toggle="popover" data-trigger="hover" data-content=" QUOTATION SERIAL #" data-placement="bottom">
    <input type="text" pattern="[0-9]{10}" autocomplete="off"  list="quotationlist" title="ENTER TEN DIGITS NUMBER"  class="form-control input-sm"  style='text-transform:uppercase' id="serialnumber" required name ="serialnumber"     placeholder="ENTER QUOTATION SERIAL #"  />
		 <datalist id="quotationlist">
	<?php 
$x="SELECT DISTINCT SERIALNUMBER  FROM CLIENTQUOTATIONS  WHERE DATEDIFF(CURDATE(), DATE) <=1825  ORDER BY SERIALNUMBER    ";
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
  
<form id="pendingrequisition" method="post" action="deleteclientquotation.php">

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

  <?php include_once("dashboard3.php");?>
 
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