 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'ACCOUNTS REG'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
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
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;}}
body{font-size:small;}
#levelchart{ width:80%;}
#newaccount{ font-size: 85%;}


  </style>
  
		  <style type="text/css" >
	  #statement{ font-size:70%;}
	  
  </style>
	
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
  // $('[data-toggle="popover"]').popover();  
$('#message').modal('show');   
   $('#newaccount').modal('show');   
   
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
  <div class="modal-content"><div class="modal-header"><div class="modal-header">CREATE  NEW  ACCOUNT
  <div class="container">
  <div class="row">
  <div class="col-sm-4">  <br>
  
  <div class="frmSearch">
ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT"  title="eleven digits" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />
ACCOUNT NAME<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT NAME" data-placement="bottom">
<input  style='text-transform:uppercase' name="name" type="text"  pattern="[0-9A-Za-z ]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="ENTER ACCOUNT NAME."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />
CONTACT<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  CONTACT"   data-placement="bottom">
<input  style='text-transform:uppercase' name="contact" type="text"  pattern="[0-9A-Za-z]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="ENTER CONTACT"   class="form-control input-sm"       autocomplete="off" ></a><br />
METER  READINGS<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  METER READINGS" data-placement="bottom">
<input  style='text-transform:uppercase' name="meterreading" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES " size="15" placeholder="ENTER METER READINGS"  required="on"  class="form-control input-sm"     pattern="[0-9]+"  title=" NUMERIC CHARACTERS"  autocomplete="off" ></a><br />
ID  NUMBER <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  METER READINGS" data-placement="bottom">
<input  style='text-transform:uppercase' name="idnumber" type="number" size="15" placeholder="ENTER  ID NUMBER"  required="on"  class="form-control input-sm"     pattern="[0-9]+"  title=" NUMERIC CHARACTERS"  autocomplete="off" ></a><br />
LOCATION<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  LOCATION" data-placement="bottom">
<input  style='text-transform:uppercase' name="location" type="text"  pattern="[0-9A-Za-z ]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="LOCATION"  required="on"  class="form-control input-sm"       autocomplete="off" ></a><br />
<div id="suggesstion-box"></div>
</div>

<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
    
  </div>
  
  
  <div class="col-sm-4"><br>METER NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
  <input  style='text-transform:uppercase' name="meter" type="text"  pattern="[0-9A-Za-z]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="ENTER METER NUMBER."  required="on"  class="form-control input-sm"       autocomplete="off" ></a><br />
ACCOUNT  CATEGORY 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ACCOUNT  CATEGORY" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="class" >
			   <option value="">CATEGORY</option>
			  <option value="A">A(Individual)</option>
	      <option value="B">B(Institution)</option>
	      <option value="C">C(Industrial)</option>
	      <option value="D">D(Kiosk)</option>
		  <option value="PRIVATE">PRIVATE</option>
			  </select></a><br />
  ACCOUNT  STATUS 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT  ACCOUNT  STATUS" data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="status"  id="action">
			   <option value="">STATUS</option>
			  <option value='CONNECTED'>CONNECTED</option>
              <option value='COR'>COR</option>
			  <option value='CONP'>CONP</option>
			   <option value='NEW ACC'>NEW ACC</option>
			  </select></a>
<br>
METER SIZE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  METER SIZE" data-placement="bottom">
<input  style='text-transform:uppercase' name="size" type="text"  pattern="[0-9.]+"  title="ENTER WHOLE/DECIMAL NUMBER "   size="15" placeholder="METER SIZE"  required="on"  class="form-control input-sm"       autocomplete="off" ></a>			  
			  <br />
	  
</div>

<div class="col-sm-4"></div></div></div>

</div></div></div></div></form>

  <div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><img src ="ICON8.png"  width="5%"  height="5%"></div>
  <div class="container"  id="content"> <?php echo "ACCOUNT". $_SESSION['account']."EXISTS"; ?>

  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button></div></div></div>
  </div>
</body>
</html>
