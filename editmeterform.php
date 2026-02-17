<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'EDIT METER'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied4.php");exit;}
$id=$_GET['id'];if($id <1){$id=0;}
$x="SELECT *  FROM   clientmetersreg  WHERE id=$id  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$meternumber=$y['meternumber']; $size=$y['size']; $serialnumber=$y['serialnumber']; $status=$y['status'];$zonex=$y['zone'];}} 
		
	 ?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
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
$("#registry").modal();
$('[data-toggle="popover"]').popover(); 
	
 })
  
  </script>
 
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
   
<form method="post" action="updatemeters2.php" id ="updatemeters">
<input type="hidden" name="id" value="<?php print $id; ?>" >
<input type="hidden" name="zonex" value="<?php print $zonex; ?>" >
    <div class="container"  id="meterdetails"><br>
  <div class="row">
  <div class="col-sm-8" > OLD METER NUMBER 
 <input type="text" class="form-control input-sm"  value="<?php print $meternumber;?>"  pattern="[0-9a-zA-Z.]+"  title="ENTER ANY ALPHA NUMERIC PATTERN"
    style='text-transform:uppercase' name="oldmeter" value=""  required="on" readonly  placeholder="METER NUMBER" autocomplete="off" />
 <br>
 NEW METER NUMBER 
 <input type="text" class="form-control input-sm"  value="<?php print $meternumber;?>"  pattern="[0-9a-zA-Z.]+"  title="ENTER ANY ALPHA NUMERIC PATTERN"
    style='text-transform:uppercase' name="meternumber"  required="on"   placeholder="METER NUMBER" autocomplete="off" /><br>
 SERIAL NUMBER
 <input type="text" class="form-control input-sm"  pattern="[0-9a-zA-Z.]+"  title="ENTER ANY ALPHA NUMERIC PATTERN"
    style='text-transform:uppercase' name="serialnumber" value="<?php print $serialnumber;?>" required="on" value=""  placeholder="METER NUMBER" autocomplete="off" />
 <br>
 METER SIZE
  <select class="form-control input-sm" name="size"  required="on"   id="level" required="on">
<option value="<?php print $size;?>">SIZE <?php print $size;?> </option>
<option value="0.5">SIZE 1/2</option>
<option value="0.75">SIZE 3/4</option>
<option value="1">SIZE 1</option>
<option value="1.5">SIZE 1 & 1/2</option>
<option value="2">SIZE 2</option>
<option value="3">SIZE 3</option>
<option value="4">SIZE 4</option>
<option value="5">SIZE 5</option>
<option value="6">SIZE 6</option>
<option value="7">SIZE 7</option>
<option value="8">SIZE 8</option>
</select>
 <br>
 STATUS 
<select class="form-control input-sm" required="on" name="status"  id="level" required="on">
<option value="<?php print $status;?>"  >  <?php print $status;?> </option>
<option value="">SELECT STATUS</option>
<option value="FUNCTION">FUNCTION</option>
<option value="MALFUNCTION">MALFUNCTION</option>
</select>
<br>
<input type="hidden" class="form-control input-sm"  id="selectaction" name="action" value="EDIT2"  />
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
  </div>
    <div class="col-sm-4" >
	
</div>
</div></div>

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

