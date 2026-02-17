<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$serialnumber=$_POST['serialnumber'];$_SESSION['issuenotenumber']=$serialnumber;

$x="SELECT STATUS,REQUISITIONER,REQUISITIONERTITLE,AUTHORIZER,AUTHORIZERTITLE,ISSUER,ISSUERTITLE,APPROVER,APPROVERTITLE,PURPOSE FROM REQUISITION WHERE SERIALNUMBER='$serialnumber' AND STATUS='ISSUED' LIMIT 1  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
			
$_SESSION['purpose']=$y['PURPOSE'];
$_SESSION['requisitioner']=$y['REQUISITIONER'];
$_SESSION['requisitionertitle']=$y['REQUISITIONERTITLE'];
$_SESSION['authorizer']=$y['AUTHORIZER'];
$_SESSION['authorizertitle']=$y['AUTHORIZERTITLE'];
$_SESSION['issuer']=$y['ISSUER'];
$_SESSION['issuertitle']=$y['ISSUERTITLE'];
$_SESSION['approver']=$y['APPROVER'];
$_SESSION['approvertitle']=$y['APPROVERTITLE'];
			
		}}


?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />


	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}

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
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $("#statement").load("backup/storeissuenote.php");
 
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




 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container"  style="text-align:center;">
 
  <button class="btn-info btn-sm"  id="printbill" onclick="window.print()">PRINT</button>
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
   
<form id="statement">
	
	
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

