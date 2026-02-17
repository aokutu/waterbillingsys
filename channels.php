 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'GENERATE MAP'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
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
  @media print { select{display:none;} #searchtext{display:none;}}
  @media print{tbody{ overflow:visible;}}
#levelchart{ width:80%;}
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #87CEEB; height:350px;  margin-top: 5%; border-radius:2%; text-align:center}
#menu{ background-color: #87CEEB; height:60px;  border-radius:2%; text-align:center  }
body{ font-size:100%;}
  </style>
  <style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }.dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
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
	</style>

  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#registry").modal();
///$("#registrytable").load("generatemap2.php #accountstable");
$('[data-toggle="popover"]').popover(); 

$("#zonesearch").submit(function(){
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){
$("#content").load("message.php #content"); $('#message').modal('show'); 

return false;});
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


$("#accountstatus").submit(function(){$('#prepostmessage').modal('show');
$.post( "accountstatussummary.php",
$("#accountstatus").serialize(),
function(data){
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})


$("#registry").submit(function(){
$.post( "searchregistry.php",
$("#registry").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
	$("#registrytable").load("generatemap2.php #accountstable");
//return false;
});
return false;
})
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

$("#mapping").submit(function(){
$.post( "mapping.php",
$("#mapping").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
	$("#registrytable").load("generatemap2.php #accountstable");
return false;
});
return false;
})



$("#registrytable").submit(function(){
$.post( "searchmap.php",
$("#registrytable").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
	$("#registrytable").load("generatemap2.php #accountstable");
return false;
});
return false;
})
})
 </script>
 
 <script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readcoordinates.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container" >
  <!-- Trigger the modal with a button -->
  <a href="#" title="ENTER" data-toggle="popover" data-trigger="hover" data-content=" ACCOUNT DETAILS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#registry">SEARCH AC</button></a>
  
  <a href="map.html" download="offlinemap.html"   title="CLICK TO" data-toggle="popover" data-trigger="hover" data-content=" DOWNLOAD MAP" data-placement="bottom"  ><input type="button"  class="btn-info btn-sm"  value="DOWNLOAD MAP"  /></a>
    <a href="map.php" target= "_blank"   title="CLICK TO" data-toggle="popover" data-trigger="hover" data-content=" DISPLAY MAP (INTERNET )" data-placement="bottom"  ><input type="button"  class="btn-info btn-sm"  value="DISPLAY MAP"  /></a>

   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER ACC COORDINATES" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#mapping">MAPPING</button>
	    </a>
  
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>
  
    <form class="modal fade" id="mapping" role="dialog"    action="mapping.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  
  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input  style='text-transform:uppercase'   name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>
<div id="suggesstion-box"></div>
</div>

<br>
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  LATTITUDE CORDINATES" data-placement="bottom"> <input type="text" class="form-control input-sm"  pattern="[0-9-+.]+"  title="ENTER ONLY  WHOLE /DECIMAL NUMBERS"
    style='text-transform:uppercase' name="lattitude"   required="on"  placeholder="LATTITUDE"  /></a>
	<br>
	
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  LONGITUDE CORDINATES" data-placement="bottom"><input type="text" class="form-control input-sm"  pattern="[0-9-+.]+"  title="ENTER ONLY  WHOLE /DECIMAL NUMBERS"
    style='text-transform:uppercase' name="longitude"  required="on"   placeholder="LONGITUDE"  /></a>
<br>CHANNEL COLOR
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT  CHANNEL COLOR" data-placement="bottom">
 <input type="color"    id="color" name="color"  ></a>	<br>
	
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
 <form class="modal fade" id="registry" role="dialog" method="post"  action="searchregistry.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ACCOUNTS-DETAILS</div></div>
<div class="container">
  <div class="row">
  <div class="col-sm-8" > 
 <input type="text" class="form-control input-sm"  pattern="[0-9a-zA-Z.]+"  title="ENTER ANY ALPHA NUMERIC PATTERN"
    style='text-transform:uppercase' name="searchvalue"     placeholder="ENTER VALUE"  />
 <br>
<select class="form-control input-sm" required="on" name="searchmethod"  id="level" >
<option value="">SELECT SEARCH</option>
<option value="account">ACCOUNT NUMBER</option>
<option value="client"     >ACCOUNT  NAME</option>
<option value="idnumber">ID NUMBER</option>
<option value="meternumber">METER  NUMBER </option>
<option value="size">METER SIZE </option>
<option value="meterstatus">METER STATUS  </option>
<option value="status">ACCOUNT STATUS </option>
<option value="stalledmeter">STALLED  METER</option>
<option value="unregisteredmeter">UNREGISTERED METER</option>
<option value="avg">USER AVG BILLING</option>
<option value="class">ACCOUNT  CLASS </option>
<option value="location">LOCATION</option>
<option value="contact">CONTACT</option>
<option value="overdue">UNBILLED  ACCOUNTS </option>
<option value="billed">BILLED ACCOUNTS </option>
<option value="ticket">TICKET NUMBER  </option>
<option value="complain">COMPLAIN CATEGORY  </option>
</select>
<br>
  </div>
    <div class="col-sm-4" >
	
</div>
</div></div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  <img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  /> 

    <div class="container">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>
  
 <form id="registrytable"   method="post" action="searchmap.php"  >
 
 
<div  id="accountstable"  method="post" action="deleteaccount.php"> 
<h4   style="text-align:center"><strong>MAPPED ACCOUNTS WHERE <?php print $searchmethod; ?>  IS LIKE  <?php print $searchvalue;?> </strong></h4>
	<select class="form-control input-sm" required="on" name="maptype"  id="maptype" >
<option value="">SELECT MAP TYPE </option>
<option value="HYBRID">HYBRID</option>
<option value="ROADMAP">ROADMAP</option>
<option value="TERRAIN">TERRAIN</option>
<option value="SATELLITE">SATELLITE</option>
<option value="RESET">RESET COORDINATES</option>

</select>
<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		    <td  class="theader"  width="20%"  height="28" valign="top" >NAME</td>  
			<td  class="theader"  height="28" valign="top" >LATT</td> 			
			 <td  class="theader"  height="28" valign="top" >LONG</td>
			  <td  class="theader"  height="28" valign="top" >METER </td>	
			  <td  class="theader"  height="28" valign="top" >COLOR </td>
			   <td  class="theader"  height="28" valign="top" >DELETE CORDINATES</td>
			 	 
		 			  
          </tr>
        </thead>
        <tbody>
        <?php
	$x="select NAME,LONGITUDE,LATTITUDE,WEIGHT,COLOR  FROM  channels  ";

		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['NAME']."</td>  
				 <td>".$y['LATTITUDE']."</td>
			   <td>".$y['LONGITUDE']."</td>
			   <td>".$y['WEIGHT']."</td>
				  <td>".$y['COLOR']."</td>
				   <td><input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'> </td>  
           </tr>";
		 }
		 
		 } 
		?>	
        </tbody>
    </table>
 <br>
</div>

 </form>
  <form class="modal fade" id="zonesearch" role="dialog" method="post"  action="zonesearch.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
<select class="form-control input-sm"  id="loadedzone"  name="loadedzone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select>
        </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
 <?php 
 include_once("dashboard3.php"); include_once("chat.php");
 
 ?>

   <form class="modal fade" id="accountstatus" role="dialog" method="post"  action="accountstatussummary.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
<div class="container">
  <div class="row">
  <div class="col-sm-8" >
 <div id="accountdetails"><br>
  <select class="form-control input-sm"  id="loadedzone"  name="zone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select>
	<br>
	ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT"  title="eleven digits" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"     autocomplete="on" ></a><br />
</div>
<br>
<div id="acstatus">current status</div><br><input type="date"  name="date"  id="date"  class="form-control input-sm" required="on" ><br>
<br>
  <select class="form-control input-sm"  id="actionx" name="action" required="on" >
<option value=''>SELECT ACTION</option>
<option value='CONP'>CONP</option>
<option value='COR'>COR</option>
<option value='CONNECTED'>RE-CONNECTION</option>
<option value='FUNCTION'>FUNCTION</div>
<option value='MALFUNCTION'>MALFUNCTION</div>
<option value="STOLEN">STOLEN</option>
</select>
	
<br>

<div  id="slip"></div>
<br>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button>
  <button type="button" class="btn-info btn-sm"  id="loaddetails">LOAD DETAILS</button>  
  <button type="button" class="btn-info btn-sm"  id="loadslip">LOAD SLIP</button>
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>

  </div>
    <div class="col-sm-4" > </div>
  </div>
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
