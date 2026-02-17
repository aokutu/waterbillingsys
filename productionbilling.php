<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION METER'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLING  SOFTWARE </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;}}

  </style>
  	<style>
	
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
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
			   text-align:center;
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }

	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $('#newaccount').modal('show');
   $("#productionmeterdetails").load("productionmeterstable.php #productionmetertable");
   $("#newaccount").submit(function(){$('#prepostmessage').modal('show');
$.post("productionmeternew.php",$("#newaccount").serialize(),function (data){
$("#content").load("message.php #content"); $('#prepostmessage').modal('hide');
$('#message').modal('show');
	$("#productionmeterdetails").load("productionmeterstable.php #productionmetertable");})
return false;
})


   $("#viewreports").submit(function(){$('#prepostmessage').modal('show');
$.post("productionbilldatesession.php",$("#viewreports").serialize(),function (data){
$("#content").load("message.php #content"); $('#prepostmessage').modal('hide');
$('#message').modal('show');
$("#productionmeterdetails").load("waterproductionreport.php #productionmetertable");
	})
return false;
})

  $("#productionmeterdetails").submit(function(){
	  var act=$("#action").val(); 
   if(act =='DELETE')
   {
	var x=confirm("DELETE ?");   
	 if(x ==false){return false; }  
   }
   
   else   if(act =='DELETE2')
   {
	var x=confirm("DELETE ?");   
	 if(x ==false){return false; }  
   } 
	
	  $('#prepostmessage').modal('show');
$.post("editproductionmeter.php",$("#productionmeterdetails").serialize(),function (data){
$("#content").load("message.php #content"); $('#prepostmessage').modal('hide');
$('#message').modal('show');
var action=$("#action").val();
if(action=="DELETE" ){ $("#productionmeterdetails").load("productionmeterstable.php #productionmetertable"); return false;}
else if(action=="LOAD" ){$("#productionmeterdetails").load("productionmeterdetails.php #accountdetails"); return false;}
else if(action=="UPDATE" ){ $("#productionmeterdetails").load("productionmeterstable.php #productionmetertable"); return false;}
else if(action=="DELETE2" ){$("#productionmeterdetails").load("waterproductionreport.php #productionmetertable"); return false;}
	
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
		alert("xxx");
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
 <div class="container">
  <div class="row">
  <div class="col-sm-12">
  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CREATE   NEW  METER" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newaccount">NEW  METER</button></a>
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="VIEW REPORTS" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#viewreports">VIEW REPORTS</button></a>
   
    
   
   <button class="btn-info btn-sm" onclick="window.print()">PRINT</button><br />
     </div></div></div>

  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
 <form class="modal fade" id="newaccount" role="dialog" method="post"  action="productionmeternew.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container"><h3>NEW  PRODUCTION  METER DETAILS</h3><br>
  <div class="row">
  <div class="col-sm-8">
REFFERENCE NUMBER<input type="text"   style='text-transform:uppercase' pattern="[0-9A-Za-z ]+"  title="ENTER  ALPHANUMERIC CHARACTERS" class="form-control input-sm" name="reffnumber" id="reffnumber"  required  autocomplete ="off"><br />
LOCATION <input type="text" class="form-control input-sm"   style='text-transform:uppercase'   pattern="[0-9A-Za-z ]+"  title="ENTER  ALPHANUMERIC CHARACTERS"    name="location" id="location"  required  autocomplete ="off"><br />
METER READING<input type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES " class="form-control input-sm" name="meterreading" id="meterreading"  pattern="[0-9]+"  title="ENTER  NUMERIC CHARACTERS" required><br />
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
  
  
  <form class="modal fade" id="viewreports" role="dialog"    action="productionbillsession.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ENTER DETAILS 
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
FROM <input   name="date1" type="date" size="15"   required="on"  class="form-control input-sm"    autocomplete="off" >
<br>
TO  <input   name="date2" type="date" size="15"   required="on"  class="form-control input-sm"    autocomplete="off" ><br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>

   
<form id="productionmeterdetails" method="post" action="editproductionmeter.php">
 
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
