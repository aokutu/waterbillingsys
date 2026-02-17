<?php 
@session_start();
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");  
include_once("password2.php");
$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'  AND  ACCESS  REGEXP  'NEW CONNECTION' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
body{font-size:small;}
#levelchart{ width:80%;}
#newaccount{ font-size: 85%;}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
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
  
		  <style type="text/css" >
	  #statement{ font-size:70%;}
	  
  </style>
	
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
  // $('[data-toggle="popover"]').popover();    
   $('#newaccount').modal('show');   
 $("#charges").attr("disabled","disabled");
   $("#loaddetails").click(function()
{
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
$("#slip").load("accountsummary2.php #slip2");
});  return false;
 return false;
})


})
  
  </script>




 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<hr />
<div class="container">
	    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH ACCOUNT" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newaccount">ACCOUNT</button>
	    </a>
<button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
   
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
  
 <form class="modal fade" id="newaccount" role="dialog"    action="newclient3.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" ><div class="modal-header"  ><h2 class="glyphicon glyphicon-plus" style="text-align:center;">CREATE  NEW  ACCOUNT </h2>
  <div class="container">
  <div class="row">
  <div class="col-sm-4">  <br>
   
ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT"  title="eleven digits" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text"  pattern="[0-9]{11}"  title="INVALID ENTRIES"   size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

ACCOUNT NAME<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT NAME" data-placement="bottom">
<input  style='text-transform:uppercase' name="name" type="text"  pattern="[0-9A-Za-z ]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="ENTER ACCOUNT NAME."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />
CONTACT<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  CONTACT"   data-placement="bottom">
<input  style='text-transform:uppercase' name="contact" type="text"  pattern="254[0-9]{9}"  title="ENTER PHONE NUMBER WITH 254  CODE "   size="15" placeholder="ENTER CONTACT"   class="form-control input-sm"       autocomplete="off" ></a><br />

ID  NUMBER <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  METER READINGS" data-placement="bottom">
<input  style='text-transform:uppercase' name="idnumber" type="number" size="15" placeholder="ENTER  ID NUMBER"    class="form-control input-sm"     pattern="[0-9]+"  title=" NUMERIC CHARACTERS"  autocomplete="off" ></a><br />
LOCATION<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  LOCATION" data-placement="bottom">
<input  style='text-transform:uppercase' name="location" type="text"  pattern="[0-9A-Za-z ]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="LOCATION"  class="form-control input-sm"       autocomplete="off" ></a><br />

<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   


  </div>
  
  
  <div class="col-sm-4"><br>
ACCOUNT  CATEGORY 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ACCOUNT  CATEGORY" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="class" >
			   <option value="">CATEGORY</option>
			  <option value="A">A(DOMESTIC)</option>
        <option value="B">B(COMMERCIAL/INSTITUTION/GOVERMENT)</option>
       <option value="C">C(SCHOOLS)</option>
        <option value="D">D(Kiosk)</option>
			  </select></a><br />
  ACCOUNT  STATUS 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT  ACCOUNT  STATUS" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="status"  id="action">
			   <option value="">STATUS</option>
			   <option value='CONNECTED'>CONNECTED</option>
              <option value='COR'>COR</option>
			  <option value='CONP'>CONP</option>
			  <option value='MNOS'>MNOS(METER NOT ON SITE )</option>
			  <option value='STOLEN'>STOLEN(METER STOLEN )</option>
			  <option value='ILLEGAL'>ILLEGAL(ILLEGAL CONNECTION)</option>
			  <option value='VANDALISED'>VANDALISED(VANDALISED CONNECTION)</option>
			  </select></a>
<br>
EMAIL ADDRESS<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  EMAIL ADDRESS" data-placement="bottom">
<input   name="email" type="text"  pattern="[0-9A-Za-z@_- ]+"  title="INVALID EMAIL ADDRESS "   size="15" placeholder="ENTER  EMAIL ADDRESS."   class="form-control input-sm"     autocomplete="off" ></a>

<br>
CONNECTION NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PLOT NUMBER" data-placement="bottom">
<input   name="plotnumber"  style="text-transform:uppercase" type="text"  pattern="[0-9A-Za-z/ _- ]+"  title="INVALID PLOT NUMBER"   size="15" placeholder="ENTER  CONNECTION NUMBER."   class="form-control input-sm"     autocomplete="off" ></a>

<br>			  
 
  	  
</div>

<div class="col-sm-4">
</div>
</div></div>

</div></div></div></div></form>
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

