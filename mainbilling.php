<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH BILLING SOFTWARE</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
body {margin-right:2%; margin-left:2%}
#statement>table{margin-right:4%; margin-left:1%;}
  @media print{tbody{ overflow:visible;} #statement>table{margin-right:4%; margin-left:1%;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;}}
#levelchart{ width:80%;   }
table{border-color:#000000; border-spacing: 2%; border-bottom-width:thick;  }
  </style>
  
		  <style type="text/css" >
	
  </style>
	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
#mainbillingx{ border-style:solid;border-radius:2%;}
	#footer{ font-weight:bolder;}
	img{border-style:solid;}.dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
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
   $("#mainbilling").load("meterdetails2.php #accountdetails");
$("#searchaccount").submit(function()
{
	var  action1=$("#action1:checked").val() ;
	var  action2=$("#action2:checked").val()
	
$.post( "setaccount2.php",
$("#searchaccount").serialize(),
function(data){
	if(action1 =='BILLING')
	{
	$("#content").load("message.php #content");$("#mainbilling").load("meterdetails2.php #accountdetails");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
	}
	
	else if(action2 =='PRINTBILL')
	{
	$("#content").load("message.php #content");$("#mainbilling").load("backup/singlebill.php");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
	}

});  return false;
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

$("#printbill").click(function(){$('#prepostmessage').modal('show');
$.post( "printedbill.php",
$("#printinfo").serialize(),
function(data){
$("#content").load("message.php #content"); $('#prepostmessage').modal('hide');
$('#message').modal('show');$('#searchaccount').modal('show');
return false;});
return false;
})

$("#mainbillingx").submit(function(){$('#prepostmessage').modal('show');
$.post( "mainbilling2.php",
$("#mainbilling").serialize(),
function(data){
$("#content").load("message.php #content");$("#mainbilling").load("meterdetails2.php #accountdetails");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
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
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<div class="container">
  <!-- Trigger the modal with a button -->
 
	  <form action="nextaccount.php" method="post" style="text-align:center;" >
	  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH METER NUMBER" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#searchaccount">SEARCH A/C</button>
	    </a>
	 <button class="btn-info btn-sm"  id="printbill" onclick="window.print()">PRINT</button>
	<button type="submit" class="btn-info btn-sm"  id="previous"   name="action" value="previous"  >PREVIOUS AC&nbsp;&nbsp;&nbsp; </button>
 <button type="submit" class="btn-info btn-sm"  id="next" name="action"   value="next"   >NEXT AC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button><br><br>
  </form><br>
   
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
  
  <form class="modal fade" id="searchaccount" role="dialog"    action="setaccount2.php" method="post"  >
<div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">SELECT ACCOUNT <?php print $_SESSION['accountstable'];?></div></div>
  <div class="container">
  <div class="row">
    <div class="col-sm-8" >
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
	<input  style='text-transform:uppercase'  list="accountslist"  name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" >
	</a>
	
	
		 <datalist id="accountslist">
	<?php 
$actb=$_SESSION['accountstable'];
$x="SELECT DISTINCT ACCOUNT,CLIENT FROM   $actb   WHERE CLASS !='' AND SIZE >0 ORDER BY ACCOUNT    ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['ACCOUNT']."'>".$y['ACCOUNT']."  ".$y['CLIENT']."</option>";	
		}}

?> 
 </datalist>
<br>
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ACTION" data-placement="bottom">
     <label class="checkbox-inline"> 
        <input type="radio" name="action" checked id="action1" value="BILLING" >BILLING
     </label> 
     <label class="checkbox-inline"> 
        <input disabled  type="radio" name="action" id="action2"   value="PRINTBILL"> PRINT BILL
     </label> 
	   </a>
	   
	   
    </div>
     <div class="col-sm-4" ></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn btn-default" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  
  <form id="mainbilling"  method="post" action="mainbilling2.php" > 


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
