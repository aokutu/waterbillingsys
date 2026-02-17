<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
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
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#procedurehistory").modal();
$('[data-toggle="popover"]').popover();
$("#procedures").load("procedurestable.php #procedurestable");
$("#procedurehistory").submit(function(){
$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#procedurehistory").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');
$("#procedures").load("procedurestable.php #procedurestable");
return false;
});
return false;
})
 
 })
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#procedurehistory"><i class="fa-solid fa-magnifying-glass" style="font-size:200%;" ></i></button></a>
  <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
  <form class="modal fade" id="procedurehistory" role="dialog" method="post"   action="sessionregistry.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">PROCEDURE CUMULATIVE REPORT<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input style='text-transform:uppercase'  required list="patientnmberslist" id="patientnumber" name="patientnumber" type="text"  pattern="[0-9 ]+"  title="PATIENT NUMBER"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>

<datalist id="patientnmberslist" >
<?php 
$x=$connect->query("SELECT DISTINCT(PATIENTNUMBER)  AS PATIENTNUMBER,CLIENT  FROM PROCEDUREREPORTS,PATIENTSRECORD WHERE ACCOUNT=PATIENTNUMBER  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->PATIENTNUMBER; ?> " ><?php print $data->CLIENT; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
<br>
<details>
    <summary><i style="font-size:160%;" class="fas fa-chevron-circle-down"></i></summary>
    <ul>
      <li>
FROM 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' id="date1" onclick="$('#patientnumber').prop('disabled', true);$('#patientnumber').val('');" name="date1" type="date"    title="INVALID ENTRIES"   size="15" placeholder="START DATE "   class="form-control input-sm"     autocomplete="off" ></a>
TO 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' id="date2"  name="date2" type="date" onclick="$('#patientnumber').prop('disabled', true);$('#patientnumber').val('');"    size="15" placeholder="END DATE"   class="form-control input-sm"     autocomplete="off" ></a>

	  </li>
    </ul>
  </details>

 </div>
  


<div class="col-sm-4">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" >CLOSE</button>
</div>
</div></div>

  
  </div></div></div></div>
  
 
  </form>
  <div id="procedures">xxx
</div>
 
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

  
