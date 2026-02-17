<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'METER REG'  ";
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

#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
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
$("#registrytable").load("meterregistrytable2.php #accountstable");
//$("#loadmeters").load("meterregistrytable2.php #meternumber");
$('[data-toggle="popover"]').popover(); 
$("#registry").submit(function(){$('#prepostmessage').modal('show');
$.post( "searchregistry.php",
$("#registry").serialize(),
function(data){
$("#content").load("message.php #content");$("#registrytable").load("meterregistrytable2.php #accountstable");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

//return false;
});
return false;
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
  
  
  

$("#linkmeterx").submit(function(){$('#prepostmessage').modal('show');
$.post( "linkmeter.php",
$("#linkmeter").serialize(),
function(data){  
$("#content").load("message.php #content");$("#registrytable").load("meterregistrytable2.php #accountstable"); $("#loadmeters").load("meterregistrytable2.php #meternumber");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#newmeter").submit(function(){$('#prepostmessage').modal('show');
$.post( "newmeter.php",
$("#newmeter").serialize(),
function(data){
	$("#content").load("message.php #content");$("#registrytable").load("meterregistrytable2.php #accountstable"); $("#loadmeters").load("meterregistrytable2.php #meternumber");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

//return false;
});
return false;
})

$("#registrytable").submit(function(){
	var act=$("#selectaction").val(); 

	$('#prepostmessage').modal('show');
$.post( "updatemeters.php",
$("#registrytable").serialize(),
function(data){$("#content").load("message.php #content");$("#registrytable").load("meterregistrytable2.php #accountstable");$("#loadmeters").load("meterregistrytable2.php #meternumber");$('#prepostmessage').modal('hide'); $('#message').modal('show');return false;
});

return false;
})


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
<div class="container" >
  <!-- Trigger the modal with a button -->
 <a href="#" title="ENTER" data-toggle="popover" data-trigger="hover" data-content="NEW  METER DETAILS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newmeter">NEW METER</button></a>
 
 <a href="#" title="ENTER" data-toggle="popover" data-trigger="hover" data-content="LINK METER" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#linkmeter">LINK METER</button></a>
  
  <a href="#" title="ENTER" data-toggle="popover" data-trigger="hover" data-content="METER DETAILS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#registry">SEARCH METER</button></a>
  
  
  <button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
  
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>
  
 <form class="modal fade" id="registry" role="dialog" method="post"  action="meterregistrytable2.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">METERS-DETAILS</div></div>
<div class="container">
  <div class="row">
  <div class="col-sm-8" > 
 <input type="text" class="form-control input-sm"  pattern="[-0-9a-zA-Z.-]+"  title="ENTER ANY ALPHA NUMERIC PATTERN"
    style='text-transform:uppercase' name="searchvalue"    placeholder="ENTER VALUE"  />
 <br>
<select class="form-control input-sm" required="on" name="searchmethod"  id="level" >
<option value="">SELECT SEARCH</option>
<option value="all">ALL METERS</option>
<option value="account">ACCOUNT NUMBER</option>
<option value="meternumber">METER NUMBER</option>
<option value="serial">SERIAL NUMBER</option>
<option value="size">METER SIZE</option>
<option value="status">METER STATUS</option>
<option value="installed">INSTALLED METER</option>
<option value="notinstalled">NOT INSTALLED</option>
<option value=""></option>
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
  
    <form class="modal fade" id="linkmeter" role="dialog"    action="linkmeter.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  ACCOUNT NO.
  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input  style='text-transform:uppercase' name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>
<div id="suggesstion-box"></div>
</div>
<br>
METER NUMBER<div id="loadmeters">
    
    <select class="form-control"   required= "on"  name="meternumber"  id="meternumber">
			   <option value="">SELECT METER </option>
			  <?php 
		$x="SELECT METERNUMBER FROM clientmetersreg WHERE ACCOUNT ='NOT INSTALLED' AND STATUS='FUNCTION'";	  
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<option value='".$y['METERNUMBER']."'>".$y['METERNUMBER']."</option>";		
		
			
		}}
			  
			  ?>
			    <option value=""> </option>
 			  </select>
    
</div>
<hr>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
  
   <form class="modal fade" id="newmeter" role="dialog" method="post"  action="newmeter.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">METERS-DETAILS</div></div>
<div class="container">
  <div class="row">
  <div class="col-sm-8" > METER NUMBER
 <input type="text" class="form-control input-sm"  pattern="[0-9a-zA-Z-_]+"  title="INVALID ENTRIESX"
    style='text-transform:uppercase' name="meternumber"  required="on"   placeholder="METER NUMBER" autocomplete="off" />
 <br>
 SERIAL NUMBER
 <input type="text" class="form-control input-sm"  pattern="[0-9a-zA-Z.-]+"  title="ENTER ANY ALPHA NUMERIC PATTERN"
    style='text-transform:uppercase' name="serialnumber"  required="on"   placeholder="SERIAL NUMBER" autocomplete="off" />
 <br>
 METER SIZE
    <select class="form-control input-sm" name="size"  required="on"   id="level" required="on">
<option value="">SELECT METER SIZE</option>
<option value="0.5">SIZE 1/2</option>
<option value="0.75">SIZE 3/4</option>
<option value="1">SIZE 1</option>
<option value="1.5">SIZE 1 & 1/2</option>
<option value="2">SIZE 2</option>
<option value="3">SIZE 3</option>
<option value="4">SIZE 4</option>
<option value="5">SIZE 5</option>
<option value="6">SIZE 6</option>
<option value="7">SIZE 7</option>
<option value="8">SIZE 8</option>
</select>

 <br>
<select class="form-control input-sm" required="on" name="status"  id="level" required="on">
<option value="">SELECT STATUS</option>
<option value="FUNCTION">FUNCTION</option>
<option value="MALFUNCTION">MALFUNCTION</option>
<option value="DISCARD">DISCARD</option>
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
   <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
      <div class="container">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>
 <form id="registrytable"   method="post" action="updatemeters.php"  >
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
