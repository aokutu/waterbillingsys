<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'REQUISITION'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if($_SESSION['supplier']==null){$_SESSION['supplier']='';}
if($_SESSION['invoicenumber']==null){$_SESSION['invoicenumber']='';}
if(!isset($_SESSION['purchaserequisition'])){$_SESSION['purchasereqnumber']=null;$_SESSION['purchaserequisition']=1;}

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

#newrequisition{
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
   $('#newrequisition').modal('show');
   
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
var action='GENERATE  NEW REQUISITION ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newpurchasereqserialnumber.php",
$("#purchasereqnumber").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("purchasesreq2.php #newrequisitions");
$("#nextrequisition2").load("purchasesreq.php #purchasereqnumber");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});	 
	 
	   })
	   
   
$("#deleteitems").load("purchasesreq2.php #newrequisitions");
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
	        
$("#newrequisition").submit(function(){
	var action='ENTER REQUISITION ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newpurchasesreq.php",
$("#newrequisition").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("purchasesreq2.php #newrequisitions");
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})



$("#search").submit(function(){
		var action='SEARCH REQUISITIONS ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#search").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deleteitems").load("purchasesreq3.php #newrequisitions");

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
$("#deleteitems").load("purchasesreq2.php #newrequisitions");
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
     <a href="#" title="NEW" data-toggle="popover" data-trigger="hover" data-content="PURCHASES REQUISITION " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newrequisition">NEW REQUISITION</button> </a>
	           <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="REPORTS " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#search">SEARCH</button> </a>
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH REQUISITION " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#viewrequistition">VIEW REQUISITION</button> </a>
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
  <form class="modal fade" id="newrequisition" role="dialog" method="post" action="newpurchasesreq.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h1 style="text-align:center;">STORES PURCHASES REQUISITION</h1></div></div>
 
 
  <div class="container">
  <div class="row">
  <div class="col-sm-4" > STORES PURCHASES SERIAL NUMBER  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SERIAL NUMBER  " data-placement="bottom">
	<div id="nextrequisition2">
	<input type="text"  style='text-transform:uppercase' readonly  value ="<?php 	if($_SESSION['purchasereqnumber'] !=null){print $_SESSION['purchasereqnumber'];} ?>"   placeholder="SERIAL NUMBER  " class="form-control input-sm"  name="purchasereqnumber" id="purchasereqnumber" />
</div></a>
	
	<br></div>
  <div class="col-sm-4" >
  <br><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CLICK TO NEXT REQ.  " data-placement="bottom">
  <button type="button" id="nextrequisition" class="btn-info btn-sm" >NEW REQ.</button>  
  </a>
  
  </div>
  <div class="col-sm-4" ></div>
  </div></div>
  
  
  
 <div class="container">
  <div class="row">
  <div class="col-sm-4" >
		REQUESTED  BY 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="REQUESTED  BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase' value ="<?php 	if($_SESSION['requester'] !=null){print $_SESSION['requester'];} ?>"   placeholder="REQUESTED  BY " class="form-control input-sm"  name="requester" id="requester"  required="on" /></a>
	<br>
		CHECKED BY  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CHECKED BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['checker'] !=null){print $_SESSION['checker'];} ?>" placeholder="CHECKED BY " class="form-control input-sm"  name="checker" id="checker"  required="on" /></a>
	<br>
	CONFIRMED BY  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CONFIRMED BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['confirmer'] !=null){print $_SESSION['confirmer'];} ?>" placeholder="CONFIRMED BY " class="form-control input-sm"  name="confirmer" id="confirmer"  required="on" /></a>
	<br>
	APPROVED BY  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="APPROVED BY  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['approver'] !=null){print $_SESSION['approver'];} ?>" placeholder="APPROVED BY " class="form-control input-sm"  name="approver" id="approver"  required="on" /></a>
	
	</div>
   <div class="col-sm-4" >
	TITLE 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="REQUESTER TITLE  " data-placement="bottom">
	<input type="text"   style='text-transform:uppercase' value ="<?php 	if($_SESSION['requestertitle'] !=null){print $_SESSION['requestertitle'];} ?>"   placeholder="REQUESTER TITLE " class="form-control input-sm"  name="requestertitle" id="requestertitle"  required="on" /></a>
	<br>
		TITLE  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CHECKER TITLE  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['checkertitle'] !=null){print $_SESSION['checkertitle'];} ?>" placeholder=" CHECKER TITLE " class="form-control input-sm"  name="checkertitle" id="checkertitle"  required="on" /></a>
	<br>
	TITLE  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CONFIRMER TITLE  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['confirmertitle'] !=null){print $_SESSION['confirmertitle'];} ?>" placeholder="CONFIRMER TITLE " class="form-control input-sm"  name="confirmertitle" id="confirmertitle"  required="on" /></a>
	<br>
	TITLE  
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="APPROVER TITLE  " data-placement="bottom">
	<input type="text"  style='text-transform:uppercase'  value ="<?php 	if($_SESSION['approvertitle'] !=null){print $_SESSION['approvertitle'];} ?>" placeholder="APPROVER TITLE " class="form-control input-sm"  name="approvertitle" id="approvertitle"  required="on" /></a>
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


	<div > 

 </div>
 <br><br><br>
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
	<input type="number" class="form-control input-sm"  name="quantity" placeholder="ENTER  QUANTITY"   id="quantity" required="on" /></a>
	<br>
	UNIT BUY PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT BUY PRICE" data-placement="bottom">
	<div id="loadbuyprice">
	
		<input type="text"  pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"  name="buyprice"   id="unitbuyprice" required="on" />

	</div>
	</a><br>

	</div>
	    <div class="col-sm-4" >
<br>
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PURPOSE" data-placement="bottom">
	<input type="text"  attern="[0-9A-Za-z ,.]+" title="INVALID ENTRIES"   class="form-control input-sm"  name="purpose" placeholder="ENTER  PURPOSE"   id="purpose" required="on" />
	</a>
	<br><br>
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
  
  <form class="modal fade" id="viewrequistition" method="post" action="viewpurchasesreq.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SEARCH STORES PURCHASES REQUISITION</h4>
 <br>

	<br>
	<a href="#" title="ENTER  STORES" data-toggle="popover" data-trigger="hover" data-content=" PURCHASES REQUISITION #" data-placement="bottom">
    <input type="text" pattern="[0-9]{10}"  title="ENTER TEN DIGITS NUMBER"  autocomplete="off"  list="purchasesrequisitionlist"  class="form-control input-sm"  style='text-transform:uppercase' id="searchvalue" required name ="serialnumber"     placeholder="ENTER STORES PURCHASES REQUISITION #"  />
	 <datalist id="purchasesrequisitionlist">
<?php 
//WHERE DATEDIFF(CURDATE(), DATE) <=1825  ORDER BY  SERIALNUMBER
$x="SELECT DISTINCT SERIALNUMBER  FROM PURCHASESREQUISITION      ";
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
<form id="deleteitems" method="post" action="deletepurchasesreq.php">
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
