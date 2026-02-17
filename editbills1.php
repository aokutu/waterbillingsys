<?php
session_start();
include_once("password.php");
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
@$depositdate1=$_SESSION['depositdate1'];@$depositdate2=$_SESSION['depositdate2'];
if($depositdate1 == NULL ){$depositdate1=date('Y-m-d');}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'EDIT BILLS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:dashboard.php");exit;}
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
   $('[data-toggle="popover"]').popover();
   
  $("#editbills2").submit(function(){$('#prepostmessage').modal('show');
$.post( "editbills2.php",
$("#editbills2").serialize(),
function(data){
$("#content").load("message.php #content");$("#id1").load("editbills1.php #id2");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
 
return true;});
return true;
})



  })
  
  </script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container" >
 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
    <!-- Modal -->
  </div>
  

 <form method="post" id="editbills2" action="editbills2.php">
<?php
$x="SELECT *,billed,deduction,previous,current,units,balance,metercharges,meterstatus  FROM  ".$_SESSION['billstable']." WHERE  id='".$_GET['id']."' LIMIT 1";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { ?>
		     
	  <h4   style="text-align:center"><strong>EDIT BILL  </strong></h4>

  <div class="row" id="id1" >
  <div class="col-sm-4"  id="id2">  <br>
 ACCOUNT NUMBER
<input type="text" readonly style='text-transform:uppercase' name="clientaccount" required  size="15"   value="<?php echo  $y['account'];?>" pattern="[0-9]{11}"  title="INVALID ENTRIES"   class="form-control input-sm"     autocomplete="off" ><br/>
REFF NUMBER 
<input type="text"  style='text-transform:uppercase' name="reffnumber"  size="15"  readonly="readonly" value="<?php echo  $y['id'];?>"   class="form-control input-sm"      ><br/>
METER NUMBER
  <input  style='text-transform:uppercase' name="meter" type="text" size="15"  pattern="[A-Za-z0-9 -]+"  readonly  title="ENTER ALPHANUMERIC CHARACTERS"     class="form-control input-sm"  required   autocomplete="off"  value="<?php print $y['meternumber'];?>" ><br/>
PREVIOUS  READING 
<input  style='text-transform:uppercase'  name="previous"  type="text" size="15"   pattern="[0-9.]+"  title="INVALID ENTRIES"     class="form-control input-sm"   required  autocomplete="off"   value="<?php  echo $y['previous'];?>"><br />
CURRENT  READINGS
<input  style='text-transform:uppercase' required name="current" id="current" type="text" size="15"   pattern="[0-9.]+"  title="INVALID ENTRIES"     class="form-control input-sm"     autocomplete="off"   value="<?php  echo $y['current'] ;?>"><br />

 </div>
<div class="col-sm-4"><br>
BILLED
<input  style='text-transform:uppercase' readonly  name="billed" id="billed" type="text" size="15"    pattern="[0-9.]+"  title="INVALID ENTRIES"    class="form-control input-sm"     autocomplete="off"  required value="<?php  echo $y['billed'];?>"><br />
DEDUCTION
<input readonly style='text-transform:uppercase'   name="deduction" id="deduction" type="text" size="15"    pattern="[0-9.]+"  title="INVALID ENTRIES"    class="form-control input-sm"     autocomplete="off"  required value="<?php  echo $y['deduction'];?>"><br />
 
 UNITS
<input  style='text-transform:uppercase'  readonly name="units" id="units" type="text" size="15"    pattern="[0-9.]+"  title="INVALID ENTRIES"    class="form-control input-sm"     autocomplete="off"  required value="<?php  echo $y['units'] ;?>"><br />
   READING DATE
<input  style='text-transform:uppercase' name="date"  required   type="date" size="15"   value="<?php echo $y['date'];?>" class="form-control input-sm"     autocomplete="off" ><br />
 METER STATUS
 <input readonly style='text-transform:uppercase'  readonly  name="meterstatus"  type="text" size="15"     class="form-control input-sm"     autocomplete="off"   value="<?php  echo $y['meterstatus'];?>"><br />

  </div>   
  
  <div class="col-sm-4"><br>
  MTR CHARGES<input readonly  style='text-transform:uppercase' name="standingcharges" type="text" size="15"   pattern="[0-9.-]+"  title="INVALID ENTRIES"  required   class="form-control input-sm"     autocomplete="off"   value="<?php  echo $y['metercharges'];?>"><br />

WATER CHARGES<input  readonly style='text-transform:uppercase' name="watercharges" type="text" size="15"   pattern="[0-9.-]+"  title="INVALID ENTRIES"  required   class="form-control input-sm"     autocomplete="off"   value="<?php  echo $y['charges'];?>"><br />

TTL CHARGES<input  style='text-transform:uppercase' readonly  name="ttlcharges" type="text" size="15"   pattern="[0-9.-]+"  title="INVALID ENTRIES"  required   class="form-control input-sm"     autocomplete="off"   value="<?php  echo $y['balance'];?>"><br />


 <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button> 
  </div>
  </div>	     
		     
		     
	<?php	 }} ?>
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

