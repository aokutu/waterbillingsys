<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS' OR  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
body{font-size:small;}
#levelchart{ width:80%;}
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #87CEEB; height:350px;  margin-top: 5%; border-radius:2%; text-align:center}
#menu{ background-color: #87CEEB; height:60px;  border-radius:2%; text-align:center  }
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
$("#smsreport").modal();
  $("#account2").click(function() {
     var account=$("#account1").val();
	 $("#account2").val(account);
	 });
$('[data-toggle="popover"]').popover(); 
$("#smsreport").submit(function(){$('#prepostmessage').modal('show');
$.post( "debtorsreport2.php",
$("#smsreport").serialize(),
function(data){$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); 
$('#message').modal('show'); 
return true;
});
return true;
})


 })
  
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<hr />
<div class="container"  id="menu">
  <!-- Trigger the modal with a button -->
  <a href="#" title="ENTER" data-toggle="popover" data-trigger="hover" data-content=" ACCOUNT  RANGE" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#smsreport">ACS RANGE</button>


  
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>
 <form class="modal fade" id="smsreport" role="dialog" method="post"  action="debtorsreport2.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ACCOUNTS-DETAILS</div></div>
<div class="container">
  <div class="row">
  <div class="col-sm-8" > 
<div>
    <input  autocomplete="off" list="accountslist" type="text" name="account1"  value="<?php print $_SESSION['account1'];?>"   autocomplete   id="account1"  class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase'  placeholder="ENTER   MIN ACC NUMBER" required="on" />
        
	 	
		
		
		</div><br>
		<div>
    <input  autocomplete="off" list="accountslist" type="text" name="account2"  value="<?php print $_SESSION['account2'];?>"   autocomplete     id="account2"   class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase' placeholder="ENTER   MAX ACC NUMBER" required="on"  />
        </div><br>
		
		<datalist id="accountslist">
	<?php 
$x="SELECT DISTINCT ACCOUNT,CLIENT FROM $accountstable     ORDER BY ACCOUNT    ";
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
  </div>
    <div class="col-sm-4" >
	
</div>
</div></div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
    <div id="levelchat"  class="modal fade" role="dialog" >
  
</div>
<form method="post"  id="updateexam" action="updateexam.php"></form>
 <form id="updatestudentstable" method="post" action="updatestudentstable.php">

 <div class="container"  >
  <div class="row">
  <div class="col-sm-2">
  </div>
   <div class="col-sm-8" id="header">
   <hr>
   <h2>LAWASCO </h2>
    <hr>
	 <hr>
   <h2>&nbsp;</h2>
    </div>
   <div class="col-sm-2">
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
