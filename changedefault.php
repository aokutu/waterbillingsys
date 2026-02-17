<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='123456' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}
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
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
#levelchart{ width:80%;}
#resetpassword{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#userdetails{
  overflow-y: scroll;      
  height: 480px;            //  <-- Select the height of the body
  width: 90%; margin-right:10%; 
  position: absolute;
}

#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;} #resetpassword{ width:80%;}
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();
$('#resetpassword').modal('show');
})
  
  </script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>

 <form class="modal fade" id="resetpassword" role="dialog" method="post"  action="resetpassword.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"  id="userdetails"  ><div class="modal-header"><div class="modal-header"><div class="btn-info btn-sm">ENTER NEW PASSWORD DETAILS</div></div></div>
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
  
  <input type="password"  style='text-transform:uppercase'   name="password1" pattern="[0-9A-Za-z]{5,10}"  title="ENTER 5-10 ALPHANUMERIC"  class="form-control input-sm"  placeholder="NEW PASSWORD" required="on"  /><br>
   <input type="password"   style='text-transform:uppercase' name="password2" pattern="[0-9A-Za-z]{5,10}"  title="ENTER 5-10 ALPHANUMERIC"  class="form-control input-sm"  placeholder="REPEAT PASSWORD" required="on" /><br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
   </div>
   <div class="col-sm-4">  </div>  
  </div>
  </div>
 
  </form>
</body>
</html>
