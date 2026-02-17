<?php 

@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];

include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'UPLOAD SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:backuprestore.php");exit;}
$_SESSION['filename']=$filename;
$search=$_SESSION['filename']; if(empty($search)){print '<div  class="btn-info btn-sm">'.$search.' </div>';$search='0';}

?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH SOFTWARES</title>
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
body{font-size:small;}
#levelchart{ width:80%;}
  </style>
  	<style>
	
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
table{ font-size: 80%;}  #newslip{ font-size: 80%;} 
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
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" >
  $(document).ready(function(){

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
  
  
$("#searchbankslips").submit(function(){$('#prepostmessage').modal('show');
$.post( "bankslipsuploads.php",
$("#searchbankslips").serialize(),
function(data){
$("#content").load("message.php #content"); $('#prepostmessage').modal('hide');$('#message').modal('show'); 

$("#bankslipsarchive").load("bankslipsarchives.php #bankslipstable");
return false;});
return false;
})


	$("#bankslipsarchive").submit(function(){
	var x=$("#slipsaction").val();   	
	if (x=="DELETE")
	{ return true;}
    else  if (x=="EXPORT")
	{
		$('#prepostmessage').modal('show');
$.post( "deletebankslips.php",
$("#bankslipsarchive").serialize(),
function(data){
$("#bankslipsarchive").load("bankslipsarchives.php #bankslipstable");
 $("#content").load("message.php #content"); $('#prepostmessage').modal('hide');$('#message').modal('show');  

return false;});	
		
		
	}
	
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


var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
	  
  	$("#searchbankslips").submit(function(){$('#prepostmessage').modal('show'); $.post( "searchbankslips.php",
$("#searchbankslips").serialize(),
function(data){
$("#content").load("message.php #content"); $('#message').modal('show'); 
$("#slips").load("backuprestore.php #slipstable");$('#prepostmessage').modal('hide');
return false;});
return false;
})  
  })
  
  </script>

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
   <form method="post" action="bankslipsupload.php" enctype="multipart/form-data"   id="uploads">
   
     <div class="container">
  <div class="row">
  <div class="col-sm-8">SELECT  THE  BANK SLIP FILE (wateraccounts.txt)
    <a href="#" title="SELECT  BANKSPLIPS FILE " data-toggle="popover" data-trigger="hover" data-content="(wateraccounts.txt)" data-placement="bottom"><input type="file" name="file"  id="file"   class="form-control input-sm"   required="required"  /></a><br>
	   <input type="submit"  class="btn-info btn-sm"  value="UPLOAD FILE"  />  
	  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#layout">LAYOUT</button> 
	   
 <a href="uploadreport.csv" download="uploadreport.csv"   title="CLICK TO" data-toggle="popover" data-trigger="hover" data-content=" DOWNLOAD ANNUAL CHLORINE  REPORT" data-placement="bottom"  ><input type="button"  class="btn-info btn-sm"  value="REPORT"  /></a>
 
<br><h4   style="text-align:center"><strong>PROCESS ID <?php $processid=$_SESSION['processid']; if(empty($processid)){$processid=0;}  print $processid;?> 	  
</strong>
</h4> 
 
	</div>
	<div class="col-sm-4">
<BR><input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
	  
 
 </div>
 </div></div>
    <div class="container">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>  
    
</form>

 
   <form class="modal fade" id="searchbankslips" method="post" action="searchbankslips.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">
  <div class="col-sm-4">    <div class="frmSearch">

<input  style='text-transform:uppercase'   name="slipcode" type="text" size="15" placeholder="ENTER  PROCESS ID."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9]+"  title="ENTER  NUMERIC CHARACTERS"  autocomplete="off" >


<div id="suggesstion-box"></div>
</div></div>
   <div class="col-sm-4"><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button></div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>
  
  
  <div id="slips" >
<div  id="slipstable">

<br />

</div>
</div>

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
 <div class="modal fade" id="layout" role="dialog"     >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-10">  <br>
  <img src ="layout.png"   width="80%"  height="80%"   >
 <button type="button" class="btn-info btn-sm" data-dismiss="modal" >CLOSE</button>
  </div><div class="col-sm-2"></div></div></div></div></div></div></div></div>
</body>
</html>
