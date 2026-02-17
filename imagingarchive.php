<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class  daterange
{
public $startdate=null;
public $enddate=null;

}
$daterange =new daterange;
$daterange->startdate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$daterange->enddate=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));
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
$("#daterange").modal();
$('[data-toggle="popover"]').popover(); 
//$("#pricelisttable").load("registry.php #accountstable");	


 $(document).on('click', '.imagelink', function(event) {
        event.preventDefault();
        
        var imageid = $(this).data('imageid');
		$('#imageid').val(imageid);
		
		 $.ajax({
                type: 'POST',
                url: 'imagearchive2.php',
                data: {
                    imageid: imageid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#imagediv").load("imagearchive2.php #loadimage", function() {
                    // Optional: Rebind event handlers if necessary
                });
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#image').modal('show');
            },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
			
			
			
		
        return false;
        return true;
    });
	
	

 $(document).on('click', '.deletecompletebloodcount', function(event) {
        event.preventDefault();
        
        var proedureid = $(this).data('procedureid');
        var msg = 'DELETE PROCEDURE RESULTS ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletecompletebloodcount.php',
                data: {
                    proedureid: proedureid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#patientreciepts").load("labandimagingresults.php #patientrecieptstable", function() {
                    // Optional: Rebind event handlers if necessary
                });
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
            },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });
	

 $(document).on('click', '.deleteurinalysis', function(event) {
        event.preventDefault();
        
        var proedureid = $(this).data('procedureid');
        var msg = 'DELETE PROCEDURE RESULTS ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deleteurinalysis2.php',
                data: {
                    proedureid: proedureid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#patientreciepts").load("labandimagingresults.php #patientrecieptstable", function() {
                    // Optional: Rebind event handlers if necessary
                });
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
            },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });
	
	
	
	$(document).on('click', '.deleteprocedure', function(event) {
        event.preventDefault();
        
        var trackkey= $(this).data('trackkey');
        var msg = 'DELETE PROCEDURE RESULTS '+trackkey;
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deleteimagingprocedure.php',
                data: {
                    trackkey:trackkey
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#patientreciepts").load("imagingarchive.php #patientrecieptstable", function() {
                    // Optional: Rebind event handlers if necessary
                });
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
            },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });


	
$("#daterange").submit(function(){
$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#daterange").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');

$("#patientreciepts").load("labandimagingresults.php #patientrecieptstable");	
return false;
});
return false;
})


 $(document).on('click', '.deletelink', function(event) {
        event.preventDefault();
        
        var receiptnumber = $(this).data('receiptnumber');
		 receiptnumber = (receiptnumber || '').trim();
        var msg = 'DELETE RECEIPT NUMBER ' + receiptnumber;
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        var accessname = prompt('NAME');
        var accesspass = prompt('PASSWORD');
        
        if (confirmdelete && accessname != null && accesspass != null) {
            $.ajax({
                type: 'POST',
                url: 'deletepatientreceipt.php',
                data: {
                    receiptnumber: receiptnumber,
                    accessname: accessname,
                    accesspass: accesspass // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                    $("#patientreciepts").load("viewpatientsreceipts.php #patientrecieptstable", function() {
                        // Optional: Rebind event handlers if necessary
                        // e.g., $('a').off('click').on('click', yourFunction);
                    });
                   // $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                  //  $('#message').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });


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
    <script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "nometersautocomplete.php",
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
  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="NEW  DETAILS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#daterange"><i class="fas fa-calendar-alt" style="font-size:200%;" ></i>DATE RANGE</button></a>
 <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
  </div>
	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  <form class="modal fade" id="daterange" role="dialog" method="post"   action="sessionregistry.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">ENTER DATE RANGE<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">FROM 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' required  name="date1" type="date"    title="INVALID ENTRIES"   size="15" placeholder="START DATE "   class="form-control input-sm"     autocomplete="off" ></a>
TO 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' required list="patientnmberslist" name="date2" type="date"     size="15" placeholder="END DATE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="daterange">CLOSE</button> 

 </div>
  

</div></div>

  
  </div></div></div></div>
  </form> 
  
   

<form id="patientreciepts"   method="post"   >
<div id="patientrecieptstable">
	<h3  style="text-align:center;font-weight:bold;text-decoration:underline;" >LAB & IMAGING   PROCEDURES  <br>FROM  <?php print $daterange->startdate; ?> TO <?php print $daterange->enddate; ?></h3>

<table class="table"    style="text-align:center;font-size:90%;margin-right:2%;margin-left:2%;">

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="5%" height="28" valign="top" style='text-align:center;' >NO.</td> 
		  <td  class="theader"    height="28" valign="top"  style='text-align:left;' >REFF NUMBER </td>
		  <td  class="theader" width="40%"   height="28" valign="top"  style='text-align:left;' >PROCEDURE</td>
<td  class="theader"    height="28" valign="top"  style='text-align:left;' >PATIENT NUMBER </td>	
		 <td  class="theader"    height="28" valign="top" style='text-align:left;'  >PATIENT NAME</td> 
			   <td  class="theader"    height="28" valign="top"  style='text-align:right;' >DATE</td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > ACTION </td> </tr>
			   
<?php 
//$x=$connect->query("SELECT PROCEDUREID,procedurehistory.ID,procedurehistory.PATIENTNUMBER,procedurehistory.PROCEDURES,procedurehistory.DATE,procedurehistory.ATTENDANT,CLIENT   FROM procedurehistory,patientsrecord  WHERE procedurehistory.DATE >='$daterange->startdate' AND procedurehistory.DATE <='$daterange->enddate' AND procedurehistory.PATIENTNUMBER=patientsrecord.ACCOUNT AND procedurehistory.PROCEDURES='COMPLETE BLOOD COUNT' ");

$x=$connect->query("SELECT  DISTINCT TRACKKEY,PROCEDURES,ATTENDANT,DATE,PATIENTNUMBER,NAME,GENDER,AGE  FROM  imagingresults  WHERE DATE >='$daterange->startdate' AND DATE <='$daterange->enddate'  ");

while ($data = $x->fetch_object())
{
	$number+=1;	?>
	
    <tr >
		  <td    width="5%" height="28" valign="top" style='text-align:center;' ><?php print $number; ?></td> 
	<td      height="28" valign="top"  style='text-align:left;' ><?php print $data->TRACKKEY; ?> </td>	
	<td      height="28" width="40%" valign="top"  style='text-align:left;' ><?php print $data->PROCEDURES; ?></td>	  
<td      height="28" valign="top"  style='text-align:left;' ><?php print $data->PATIENTNUMBER; ?> </td>	
		 <td      height="28" valign="top" style='text-align:left;'  ><?php print $data->NAME; ?></td> 
		
			   <td      height="28" valign="top"  style='text-align:right;' ><?php print $data->DATE; ?></td>
			   <td    height="28" valign="top" style='text-align:center;'  >
			   <a   href="reprintxrayimage.php?trackkey=<?php print $data->TRACKKEY; ?>"   ><i class="fas fa-image" style="font-size:160%;"></i></a>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  class="deleteprocedure" data-trackkey="<?php print $data->TRACKKEY; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
 </td> </tr>
	
	<?php
}


?>		
</tbody>
 </table>
                      
	</div>				  
 </form>
 
 
 
   <form class="modal fade" id="accessrights" role="dialog" method="post" >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">ENTER DATE RANGE<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">NAME
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' required  name="accessrightsname" type="text" id="accessrightsname"   title="INVALID ENTRIES"   size="15" placeholder="START DATE "   class="form-control input-sm"     autocomplete="off" ></a>
PASSWORD
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' required list="patientnmberslist" name="password" type="password"     size="15" placeholder="END DATE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="daterange">CLOSE</button> 

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