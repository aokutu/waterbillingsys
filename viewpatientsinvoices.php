<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'FINANCE'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

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


$("#daterange").submit(function(){
$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#daterange").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');

$("#patientinvoices").load("viewpatientsinvoices.php #patientinvoicestable");	
return false;
});
return false;
})

$(document).on('click', '.deletelink', function(event) {
        event.preventDefault();
        
        var invoicenumber = $(this).data('invoicenumber');
		 invoicenumber = (invoicenumber || '').trim();
        var msg = 'DELETE INVOICE NUMBER ' + invoicenumber;
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        var accessname = prompt('NAME');
        var accesspass = prompt('PASSWORD');
        
        if (confirmdelete && accessname != null && accesspass != null) {
            $.ajax({
                type: 'POST',
                url: 'deletepatientinvoice.php',
                data: {
                    invoicenumber: invoicenumber,
                    accessname: accessname,
                    accesspass: accesspass // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                    $("#patientinvoices").load("viewpatientsinvoices.php #patientinvoicestable", function() {
                        // Optional: Rebind event handlers if necessary
                        // e.g., $('a').off('click').on('click', yourFunction);
                    });
                    //$("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                    //$('#message').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });


$("#searchinvoice").submit(function(){
$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#searchinvoice").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');

$("#patientinvoices").load("viewpatientsinvoices.php #patientinvoicestable");	
return false;
});
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
  


<form id="patientinvoices"   method="post"   >
<div id="patientinvoicestable">
	<h3  style="text-align:center;font-weight:bold;text-decoration:underline;" >DATE  RANGE <?php print $daterange->startdate; ?> TO <?php print $daterange->enddate; ?></h3>

<table class="table"    style="text-align:center;font-size:90%;margin-right:2%;margin-left:2%;">

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="5%" height="28" valign="top" style='text-align:center;' >NO.</td> 
<td  class="theader"    height="28" valign="top"  style='text-align:left;' >INVOICE #</td>	
		  
		    <td  class="theader"   height="28" valign="top" style='text-align:left;'  >PATIENT NAME</td> 
		
			 <td  class="theader"    height="28" valign="top"  style='text-align:left;' >PATIENT NUMBER</td>
			 <td  class="theader"    height="28" valign="top"  style='text-align:left;' >INSUARANCE</td>
			 <td  class="theader"    height="28" valign="top"  style='text-align:left;' >INSUARANCENUMBER</td>
			  <td  class="theader"    height="28" valign="top"  style='text-align:right;' >AMOUNT</td>
			  <td  class="theader"    height="28" valign="top"  style='text-align:right;' >DATE</td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > ACTION </td> </tr>
 		
		
				<?php
$x=$connect->query("SELECT invoicerecords.INSUARANCE,invoicerecords.INSUARANCEREFF,invoicerecords.ID,INVOICENUMBER,PAYMODE,PAYMENTREFF,AMOUNT,DISCOUNT,invoicerecords.DATE,TOTALCHARGES,DATE,CASHIER,CLIENTNUMBER,CLIENT FROM invoicerecords,patientsrecord  WHERE invoicerecords.CLIENTNUMBER=patientsrecord.ACCOUNT  AND invoicerecords.DATE >='$daterange->startdate' AND invoicerecords.DATE <='$daterange->enddate' ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td> 
 <td   style='text-align:left;'  >
 <?php print $data->INVOICENUMBER; ?>
 </td>				
			    <td    style='text-align:left;'  ><?php print $data->CLIENT; ?></td>
	<td   style='text-align:left;'  ><?php print $data->CLIENTNUMBER; ?></td>
<td   style='text-align:left;'  ><?php print $data->INSUARANCE; ?></td>	
<td   style='text-align:left;'  ><?php print $data->INSUARANCEREFF; ?></td>		
			   <td   style='text-align:right;'  ><?php print number_format($data->TOTALCHARGES,2); ?></td>
			   <td   style='text-align:right;'  ><?php print $data->DATE; ?></td>
				            <td style='text-align:center;'  >
							<a   href="reprintpatientinvoice.php?invoicenumber=<?php print $data->INVOICENUMBER; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  class="deletelink" data-invoicenumber="<?php print $data->INVOICENUMBER; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>
	 </tr>
<?php }	?>

				<?php
$x=$connect->query("SELECT SUM(TOTALCHARGES) AS TTL  FROM invoicerecords  WHERE invoicerecords.DATE >='$daterange->startdate' AND invoicerecords.DATE <='$daterange->enddate' ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
  <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' > </td> 
 <td   style='text-align:left;'  > </td>				
			    <td    style='text-align:left;'  >TOTAL</td>
	<td   style='text-align:left;'  ></td>
 <td   style='text-align:left;'  > </td>
 <td   style='text-align:left;'  > </td> 
			   <td   style='text-align:right;'  ><?php print number_format($data->TTL,2); ?></td>
			   			   <td   style='text-align:right;'  ></td>
			   
				            <td style='text-align:center;'  > </td>
	 </tr>
<?php }	?>



</tbody>
 </table>
                      
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

