 <?php 
 //header("LOCATION:accessdenied4.php");exit;
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'SEND  SMS-EMAILS'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARE</title>
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
#sendsmsemail{ font-size: 85%;}


  </style>
  
		  <style type="text/css" >
	  #statement{ font-size:70%;}
	  
  </style>
	
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
  // $('[data-toggle="popover"]').popover();    
   $('#sendsmsemail').modal('show');   
   
})
  
  </script>




 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<hr />
<div class="container">
	    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH ACCOUNT" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#sendsmsemail">ACCOUNT</button>
	    </a>
<button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
   
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
  
  <form class="modal fade" id="sendsmsemail" role="dialog"    action="sendsmsemail2.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">SELECT SEND ITEMS
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  
SEND  
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT SENDING ITEM" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="send" >
			   <option value="">SELECT</option>
			  <option value="EMAIL">EMAIL</option>
	      <option value="SMS">TEXT  MESSAGE</option>
	        </select></a><br>

<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  </div>
<div class="col-sm-4"></div></div></div>

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
