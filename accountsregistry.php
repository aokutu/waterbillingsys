<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'ACCOUNTS REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

?>

 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
 #mainbilling{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:2%;}
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}    .dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}

	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
@media print {
  a[href]:after {
    content: none !important;
  }
}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#registry").modal();
$('[data-toggle="popover"]').popover(); 
$("#registrytable").load("registry.php #accountstable");	

$("#registry").submit(function(){
$.post( "searchregistry.php",
$("#registry").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
	$("#registrytable").load("registry.php #accountstable");
//return false;
});
return false;
})

$("#registrytable").submit(function(){
 var act=$("#selectaction").val(); 
   if(act =='DELETE')
   {
	var x=confirm("DELETE ?");   
	 if(x ==false){return false; }  
   }	
	$('#prepostmessage').modal('show');
$.post( "deleteaccounts.php",
$("#registrytable").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
	$("#registrytable").load("registry.php #accountstable");return false;
});
var action=$("#selectaction").val();
if (action=="CONP"){$("#registrytable").load("registry.php #accountstable");$('#prepostmessage').modal('hide'); return false;}
else if(action=="MNOS"){$("#registrytable").load("registry.php #accountstable");$('#prepostmessage').modal('hide'); return false;}
else if(action=="STOLEN"){$("#registrytable").load("registry.php #accountstable");$('#prepostmessage').modal('hide'); return false;}
else if(action=="ILLEGAL"){$("#registrytable").load("registry.php #accountstable");$('#prepostmessage').modal('hide'); return false;}
else if(action=="VANDALISED"){$("#registrytable").load("registry.php #accountstable");$('#prepostmessage').modal('hide'); return false;}
else if(action=="COR"){$("#registrytable").load("registry.php #accountstable");$('#prepostmessage').modal('hide');return false;}
else if(action=="NEW CONNECTION"){$('#prepostmessage').modal('hide'); return true;}
else if(action=="DELETE"){$('#prepostmessage').modal('hide'); $("#registrytable").load("registry.php #accountstable");$('#prepostmessage').modal('hide');  return false;}
else if(action=="BALANCE"){$('#prepostmessage').modal('hide');return false;}
else if(action=="DELINK"){$("#registrytable").load("registry.php #accountstable");$('#prepostmessage').modal('hide');  return false;}
else if(action=="DETAILS"){return true;}
else if(action=="CONNECTED"){return true;}
else if(action=="DEPOSIT"){return true;}
else {return false;}

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
		url: "nometersautocomplete.php",
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
<body>
<div class="container" >  <a href="#" title="ENTER" data-toggle="popover" data-trigger="hover" data-content=" ACCOUNT DETAILS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#registry">SEARCH AC</button></a>
  <a href="#" title="SELECT " data-toggle="popover" data-trigger="hover" data-content="UPLOADS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#uploads">A/CS UPLOADS</button></a>
  
  
  
  <button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
    <!-- Modal -->
  </div>
  
     <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
  <form class="modal fade" id="registry" role="dialog" method="post"  action="searchregistry.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ACCOUNTS-DETAILS</div></div>
<div class="container">
  <div class="row">
  <div class="col-sm-8" > 
 <input type="text" class="form-control input-sm"    style='text-transform:uppercase' name="searchvalue"     placeholder="ENTER VALUE"  />
 <br>
<select class="form-control input-sm" required="on" name="searchmethod"  id="level"   >
<option value="">SELECT SEARCH</option>
<option value="all">ALL ACCOUNTS</option>
<option value="account">ACCOUNT NUMBER</option>
<option value="client"     >ACCOUNT  NAME</option>
<option value="idnumber">ID NUMBER</option>
<option value="meternumber">METER  NUMBER </option>
<option value="size">METER SIZE </option>
<option value="status">ACCOUNT STATUS </option>
<option value="stalled">STALLED METERS</option>
<option value="unregisteredmeter">UNREGISTERED METER</option>
<option value="avg">USER AVG BILLING</option>
<option value="class">ACCOUNT  CLASS </option>
<option value="location">LOCATION</option>
<option value="contact">CELL PHONE</option>
<option value="email">EMAIL ADDRESS</option>
<option value="mapped">MAPPED</option>
<option value="not mapped">NOT MAPPED</option>
<option value="plot">PLOT NUMBER</option>
</select>
<br>
  </div>
    <div class="col-sm-4" >
	
</div>
</div></div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  
     <form class="modal fade" id="uploads" role="dialog" method="post" enctype="multipart/form-data"  action="accountsupload.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">
  <div class="col-sm-8">
    <a href="#" title="SELECT  ACCOUNTS UPLOAD  " data-toggle="popover" data-trigger="hover" data-content="(TEXT FILE)" data-placement="bottom"><input type="file" name="file"  id="file"   class="form-control input-sm"   required="required" accept=".txt" /></a>
	<br>
<br><input type="submit"  class="btn-info btn-sm"  value="UPLOAD FILE"  /> 
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#layout">LAYOUT</button> 
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
	</div>
	<div class="col-sm-4">
     
  </div></div></div>
  
  </div></div></div></div>
  </form>   
 <form id="registrytable"   method="post" action="deleteaccounts.php"  >  <?php include_once("registry.php")?> 
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

