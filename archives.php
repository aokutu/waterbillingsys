  <?php
//header("LOCATION:accessdenied4.php");exit; 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$search=$_SESSION['filename']; if(empty($search)){print '<div  class="btn-info btn-sm">'.$search.' </div>';$search='0';}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH BILLING SOFTWARE </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#filesupload{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;} .images{width:10%;height:2%; border-radius:3%;border:1px solid #000000;}  .images:hover{ width:70%;height:70%; border-radius:4%; border:5px solid #000000;  }
 .theader{background-color:#ADD8E6}
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
   $('[data-toggle="popover"]').popover(); 
$("#deleteimages").submit(function(){

 var x=confirm("DELETE ?");   
	 if(x ==false){return false; }
	 
$.post( "deleteimages.php",
$("#deleteimages").serialize(),
function(data){$('#prepostmessage').modal('show');
	
$("#content").load("message.php #content"); $('#prepostmessage').modal('hide');
$('#filesupload').modal('hide'); 
$('#message').modal('show'); 
$("#imagestable").load("archives.php #images");
})
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


$("#zonesearch").submit(function(){$('#prepostmessage').modal('show');
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){
$("#content").load("message.php #content");$("#imagestable").load("archives.php #images"); $('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})
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
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container"><br>
  <!-- Trigger the modal with a button -->
   <a href="#" title="CLICK TO" data-toggle="popover" data-trigger="hover" data-content="  SEARCH  FOR IMAGES" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#filesearch">	FILE SEARCH</button></a>
 
	  
	  
 <div class="row">
    <div class="col-sm-12" >
	<input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
	</div>
	
</div>
 

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>
    <form class="modal fade" id="filesearch" role="dialog"    action="filesearch.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  FILE NAME" data-placement="bottom">
<input  style='text-transform:uppercase'   name="filename" type="text" size="15" placeholder="ACCOUNTNUMBER-METERNUMBER-UPLOADINGDATE." value='<?php print @$search; ?>' required="on"  class="form-control input-sm"  autocomplete="off" ></a>

<hr>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
  <div class="container">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>
<form id="deleteimages" method="post"  action="deleteimages.php" >
<div  id="imagestable"> 
 <table class="table"  id="images">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader" width='50%'  height="21" valign="top" >ARCHIVED IMAGES	  </td>
			<td  class="theader"  height="21" valign="top" >UPLOAD DATE	  </td>
			  <td  class="theader" valign="top">DEL</td>    
          </tr>
        </thead>
        <tbody>
        <?php  	
$files=scandir('uploads/photos');
foreach($files as $file)
{//print $file."<br>";
unset ($files[0]);unset ($files[1]);

}


foreach($files as $key => $file)
{//print $file."<br>";
    if($file =='index.php' ){unset($files[$key]);}
	if(!strstr($file,$search)){unset($files[$key]);}
	
}
foreach($files as $file)  //print(date("l F d, Y", $LastAccess))
{
	$filepath='uploads/photos/'.$file;
if(is_file($filepath)){print 
"<tr class='filterdata'>
 <td  width='50%' >".$file."<br><a href='".$filepath."'   target='_blank'><img src ='".$filepath."' class='images' alt='NOT AN IMAGE'  ></a></td>

 <td>".date('Y-m-d',(filectime($filepath)))." </td>      
<td><input name='filename[".$y['file']."]' type='checkbox' value='".$file."'   class='form-control input-sm'> </td>      
		       
           </tr>";}	
}	?>
        </tbody>
		
    </table>
	  
	  </div>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
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
<?php include_once("dashboard3.php");  include_once("chat.php");?>
  
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
