<?php 
header("LOCATION:accessdenied4.php");exit;
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" manifest="cache.manifest" >
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
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

#levelchart{ width:80%;}
  </style>
  
		  <style type="text/css" >
	
  </style>
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
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }

	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $('#searchaccount').modal('show');
   $("#mainbilling").load("meterdetails.php #accountdetails");
   
$("#mainbilling").submit(function(){
var account=$("#account").val();
var reading=$("#current").val();
var action =$("#billingmode").val();
if(action==1 )
{
	var y="NEW BILL \t" + account +" \t READING \t "+ reading;
var x=confirm(y);
	 if(x ==false){return false; }	
}

else if(action==2 )
{
	var y="NEW BILL \t" + account +" \t UNITS  \t "+ reading;
var x=confirm(y);
	 if(x ==false){return false; }
return true;	 
}

if(action==4 )
{
	var y="NEW BILL \t" + account +" \t UNITS \t "+ reading;
var x=confirm(y);
	 if(x ==false){return false; }
return true;	 
}
$('#prepostmessage').modal('show');
return true;
})

        $("#loadbillreport").click(function()
{
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#billsstatus").load("billssummaryreport.php #details");
});  return false;
 return false;
})


   $("#loaddetails").click(function()
{
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
$("#slip").load("accountsummary2.php #slip2");
});  return false;
 return false;
})

  $("#loadslip").click(function()
{
	var x=$("#actionx").val();    
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
if(x !='CONNECTED'){$("#slip").load("accountsummary2.php #slip2"); return false;}
else if(x =='CONNECTED'){$("#slip").load("accountsummary2.php #slip3"); return false;}
return false;});  return false;
 return false;
})



$("#accountstatus").submit(function(){
  var x=$("#actionx").val();    
	 if((x =='CONP')||(x=="COR"))
   {
	var x=confirm("CLIENT TO BE BILLED ");   
	 if(x ==false){return false; }  
   }
   
	
	$('#prepostmessage').modal('show');
$.post( "accountstatussummary.php",
$("#accountstatus").serialize(),
function(data){
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})
$("#searchaccount").submit(function()
{
$.post( "setaccount.php",
$("#searchaccount").serialize(),
function(data){$("#content").load("message.php #content");$("#mainbilling").load("meterdetails.php #accountdetails");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

});  return false;
})


 })
  
  </script>
  <script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "searchconnected.php",
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
<script>
    function DownloadFile() {
        file = input.files[0];
        fr = new FileReader();
        fr.readAsDataURL(file);
        const account =document.getElementById('account');
		const meter = document.getElementById('meter');
		const date = document.getElementById('date');
		namex=account.value + '-'+ meter.value +'-'+date.value+'.jpg';
        var blob = new Blob([file], { type: "image/jpg" });

        var objectURL = window.URL.createObjectURL(blob);
        console.log(objectURL);

        if (navigator.appVersion.toString().indexOf('.NET') > 0) {
            window.navigator.msSaveOrOpenBlob(blob, namex);
        } else {
            var link = document.createElement('a');
            link.href = objectURL;
            link.download = namex;
            document.body.appendChild(link);
            link.click();
            link.remove();
        }
		
		alert("IMAGE DOWNLOADED");
		 $("#input").val("");
    }
	
	$("#save").click(function() {
		
        $("#input").val("");
    });
	
</script>

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<div class="container">
  <!-- Trigger the modal with a button -->
   <form action="nextaccount2.php" method="post" >
	    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH ACCOUNT NUMBER" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#searchaccount">SEARCH A/C</button>
	    </a>
  

  	<button type="submit" class="btn-info btn-sm"  id="previous"   name="action" value="previous"  >PREVIOUS AC&nbsp;&nbsp;&nbsp; </button>
 <button type="submit" class="btn-info btn-sm"  id="next" name="action"   value="next"   >NEXT AC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button><br><br>

  </form>
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
  
  <form class="modal fade" id="searchaccount" role="dialog"    action="statementaccount.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  
  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input  style='text-transform:uppercase' name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box" value="
<?php
$x="SELECT LEFT(ACCOUNT,6) FROM $accountstable ORDER BY ACCOUNT ASC LIMIT 1 ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ print $y['LEFT(ACCOUNT,6)'];}}
?>" pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>
<div id="suggesstion-box"></div>
</div>
<hr>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
 
<form id="mainbilling"  method="post"   enctype="multipart/form-data"   action="mainbilling2.php"> 


</form>
 <form class="modal fade" id="zonesearch" role="dialog" method="post"  action="zonesearch.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
<select class="form-control input-sm"  id="loadedzone"  name="loadedzone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select>
        </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
<?php include_once("dashboard3.php"); include_once("chat.php");?>

  

   <form class="modal fade" id="accountstatus" role="dialog" method="post"  action="accountstatussummary.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
<div class="container">
  <div class="row">
  <div class="col-sm-8" >
 <div id="accountdetails"><br>
  <select class="form-control input-sm"  id="loadedzone"  name="zone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select>
	<br>
	ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT"  title="eleven digits" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"     autocomplete="on" ></a><br />
</div>
<br>
<div id="acstatus">current status</div><br><input type="date"  name="date"  id="date"  class="form-control input-sm" required="on" ><br>
<br>
  <select class="form-control input-sm"  id="actionx" name="action" required="on" >
<option value=''>SELECT ACTION</option>
<option value='CONP'>CONP</option>
<option value='COR'>COR</option>
<option value='CONNECTED'>RE-CONNECTION</option>
<option value='FUNCTION'>FUNCTION</div>
<option value='MALFUNCTION'>MALFUNCTION</div>
<option value="STOLEN">STOLEN</option>
</select>
	
<br>

<div  id="slip"></div>
<br>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button>
  <button type="button" class="btn-info btn-sm"  id="loaddetails">LOAD DETAILS</button>  
  <button type="button" class="btn-info btn-sm"  id="loadslip">LOAD SLIP</button>
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>

  </div>
    <div class="col-sm-4" > </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  
  
       <form class="modal fade" id="billssummaryreport" role="dialog" method="post"  action="accountstatussummary.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
<div class="container">
  <div class="row">
  <div class="col-sm-8" >
 <div id="accountdetails"><br>
</div>
<br>
<div id="billsstatus">bills report</div>
<br>

  <button type="button" class="btn-info btn-sm"  id="loadbillreport">LOAD DETAILS</button>  
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>

  </div>
    <div class="col-sm-4" > </div>
  </div>
  </div>
  </div>
  </div>
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
