 <?php 
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="ADMINISTRATOR";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


?>

 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>MEDI CLOUD</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<script src='pluggins/jquery.autosize.js'></script>
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
 #mainbilling{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:2%;}
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}    .dropdown-menu{ overflow-y: scroll; height: 300%;        
   position: absolute;
}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}

	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            
  width: 100%;
  position: absolute;
}
@media print {
  a[href]:after {
    content: none !important;
  }
}

@media print {
    /* Hide the last column in the printed version */
    table th:last-child,
    table td:last-child {
        display: none;
    }
}
	</style>
	<style>
table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:right;
  }
  
 
  #auto-resize-textarea {
    width: 100%;
    box-sizing: border-box;
    overflow: hidden; /* Hide scrollbar */
}

  </style>
  <script>
$(document).ready(function() {
    function resizeTextarea(el) {
        // Reset height to auto to calculate the new height
        $(el).css('height', 'auto');
        // Set the height to the scrollHeight of the textarea
        $(el).css('height', $(el)[0].scrollHeight + 'px');
    }

    // Apply resize on input
    $('#auto-resize-textarea').on('input', function() {
        resizeTextarea(this);
    });

    // Initial resize on page load (in case of pre-filled content)
    resizeTextarea('#auto-resize-textarea');
});
</script>

  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#bugsreport").modal();
$('[data-toggle="popover"]').popover(); 
$(function(){$('textarea').autosize();});
//$("#registrytable").load("registry.php #accountstable");

$("#bugsreport").submit(function(){
$('#prepostmessage').modal('show');
$.post( "bugsreport.php",
$("#bugsreport").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');
return false;
});

return false;
})

 })
  
  </script>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>

  
      <div style="text-align:center;"  class="flex justify-center"><img src="letterhead.png"    id="letterhead"   width="50%"  height="10%"   /></div>

<form class="modal fade" id="bugsreport" role="dialog" method="POST"   action="bugsreport.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">BUGS  REPORTING<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">
  MODULE
  <input style='text-transform:uppercase' required   name="module"  type="text"  pattern="[A-Za-z ]+"  title="MODULE"   size="15" placeholder="MODULE"   class="form-control input-sm"     autocomplete="off" ></a>

  <br>SUB MODULE
  <input style='text-transform:uppercase' required   name="submodule"  type="text"  pattern="[A-Za-z ]+"  title="SUB MODULE"   size="15" placeholder="SUB MODULE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
DETAILS 
<textarea name="details" id="auto-resize-textarea" required rows="3"></textarea>

  
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
  

</div></div>

  
  </div></div></div></div>
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

              