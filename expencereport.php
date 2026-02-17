<?php
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="FINANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND  ACCESS  REGEXP  '$dbdetails->userrights'   ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
include_once("interface.php");

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
  <title>HADDASSAH SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;           
  width: 100%;
  position: absolute;
}
h4{ text-align:center;}
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
			  text-align:center;
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
	  table  td:nth-child(5){ text-transform: none;}
	   @media print {table td:nth-child(6){display: none;}
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src='pluggins/jquery.autosize.js'></script>
  <script type="text/javascript" >
  $(document).ready(function(){
 $('#additem').click(function() {
  var newItem = $('<div class="container"><div class="row">'+
  '<div class="col-sm-4 bg-blue-200 ">'+
  '<input  required style="text-transform:uppercase"  title="INVALID ENTRIES"  name="details[]" type="text" size="15" placeholder="ENTER DETAILS" required="on" class="form-control input-sm" autocomplete="off" />'+
  '</div>'+
  '<div class="col-sm-4"><input  required style="text-transform:uppercase"  pattern ="[0-9]+" title="INVALID ENTRIES" id="item" name="quantity[]" type="text" size="15" placeholder="ENTER QNTITY" required="on" class="form-control input-sm" autocomplete="off" /></div><div class="col-sm-4 bg-blue-200">'+
    '<input  required style="text-transform:uppercase"  pattern ="[0-9. ]+"  title="INVALID ENTRIES" id="item" name="unitprice[]" type="text" size="15" placeholder="ENTER PRICE"  class="form-control input-sm" autocomplete="off" />'+
  '</div></div></div>');
  
  
  var deleteButton = $('<i class="fas fa-trash-alt delete-btn"></i>');
  
  newItem.append(deleteButton);
  $('#itemdetails').append(newItem);
  
  $('.delete-btn').click(function() {
    $(this).closest('.container').remove();
  });
});	  

  });
</script>
 
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

$("#deletecompany").load("expencereport.php #zones");	
return false;
});
return false;
})

 })
  
  </script>
  
<script>
$(document).ready(function() {
$('[data-toggle="popover"]').popover(); 
    $("#newexpense").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect form data
       /* var expencename = $("#expencename").val();
        var description = $("#description").val();
        var amount = $("#amount").val();
        var email = $("#email").val(); */
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'newexpense.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
                $("#deletecompany").load("expencereport.php #zones", function() {
                    // Optional: Rebind event handlers if necessary
                });
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
                $('#prepostmessage').modal('hide'); // Hide modal in case of error
            }
        });

        // Return false to prevent default form submission (this is the correct place)
        return false;
    });
});

 $(document).on('click', '.deletelink', function(event) {
	
        event.preventDefault();
        
		var deleteid = $(this).data('deleteid');
        var msg = 'DELETE EXPENSE ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        var accessname = prompt('NAME');
        var accesspass = prompt('PASSWORD');
           if (confirmdelete && accessname != null && accesspass != null) {
            $.ajax({
                type: 'POST',
                url: 'deletemiscexpense.php',
                data: {
                    deleteid: deleteid,
                    accessname: accessname,
                    accesspass: accesspass // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                    $("#deletecompany").load("expencereport.php #zones",  function() {
                        // Optional: Rebind event handlers if necessary
                        // e.g., $('a').off('click').on('click', yourFunction);
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
    });
	
 $(document).on('click', '.editlink', function(event) {
        event.preventDefault();
        
        var editid = $(this).data('editid');
		 
		   $.ajax({ 
		  type: 'POST',
                url: 'editexpence.php',
                data: {
                    editid:editid
                },
beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
success: function(response) {
                 $("#expencescontent").load("editexpence.php #expencedetails2" );	
                    $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                    $('#message').modal('show');
                }				
		   });
		
		$('#expencedetails').modal('show');
	return false;
        return true;
    });


</script>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW EXPENSE" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newexpense"> <i style="font-size:200%;" class="fas fa-money-check-alt"></i>NEW</button> </a>
   <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="DATE  RANGE" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#daterange"><i class="fas fa-calendar-alt" style="font-size:200%;" ></i>DATE RANGE</button></a>
   
   
   <button class="btn-info btn-sm" onClick="window.print()"><i style="font-size:200%;" class="fas fa-print"></i></button>  
  

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
  <form class="modal fade" id="newexpense" role="dialog" method="post" action="newexpense.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header bg-blue-200" >EXPENCE DETAILS </div></div>
  <div class="container">
  <div class="row">
<div class="col-sm-4">
	PAYMENT  MODE:
	<select class="form-control"    required  id="paymentmode" name="paymentmode"  >
	 <option value="PAYMENT INVOICE">PAYMENT INVOICE</option>
        <option value="CASH PAY RECEIPT">CASH PAY RECEIPT </option>
		<option value="PAYMENT VOUCHER">PAYMENT VOUCHER </option>
		<option value="GENERAL EXPENCE LEDGER">GENERAL EXPENCE LEDGER </option>
			  </select>		<br>
	PAYMENT  REFF:
		<input type="text" class="form-control input-sm" style ="text-transform:uppercase" required  title ="INVALID ENTRIES"  placeholder="PAYMENT REFF" pattern ="[a-zA-Z0-9 ]+"  style='text-transform:uppercase' id="paymentreff" name="paymentreff"   autocomplete="off" />
		<br>
			<br>
</div>

	<div class="col-sm-4">

		PAYMENT  DATE:
		<input type="date"  required class="form-control input-sm" id="paymentdate" name="paymentdate"   autocomplete="off" />
		<br>
		PAID TO:
	   <input type="text" title ="INVALID ENTRIES" placeholder="PAID TO " pattern ="[a-zA-Z0-9 ]+"  style ="text-transform:uppercase" 		required  class="form-control input-sm" id="paidto" name="paidto"   autocomplete="off" />
		<br>
		
 <button type="button" class="btn-info btn-sm" id="additem"  >ADD</button>
		<br>
	</div>
	
<div class="col-sm-4">
PAYMENT CHANNEL:
	<select class="form-control"    required  id="paymentchannel" name="paymentchannel"  >
	 <option value="CASH">CASH </option>
        <option value="M-PESA">M-PESA </option>
		<option value="INVOICE">INVOICE </option>
			  </select><br>	
			  PAYMENT CHANNEL  REFF:
		<input type="text" class="form-control input-sm" style ="text-transform:uppercase"  title ="INVALID ENTRIES"  placeholder="PAYMENT CHANNEL  REFF" pattern ="[a-zA-Z0-9 ]+"  style='text-transform:uppercase' name="paymentchanneltreff"   autocomplete="off" />
		<br>
</div>
  </div>
  
  <div id ="itemdetails">
	
	</div>
	<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn btn-default" data-dismiss="modal" id="close2">CLOSE</button>
</div>
 

  </div>
  </div>
  </form>
<form id="deletecompany" method="post" action="deleteinsuarancerececompanies.php">
<div id="zones">
<h4 class="underline" ><strong> EXPENSES <br>FROM <?php print $daterange->startdate; ?>TO <?php print $daterange->startdate; ?></strong></h4>
 <table   style="font-size:80%;text-transform: none;" class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
       
        </thead>
        <tbody>
		   <tr >
		   <td class="theader"    height="21" valign="top" >#  </td>
		    <td  class="theader"    height="21" valign="top" >ACCOUNT </td>
           <td  class="theader"    height="21" valign="top" >PAYMODE	  </td>
			<td  class="theader"    height="21" valign="top" >PAYREFF	  </td>
		<td  class="theader" width="15%"   height="21" valign="top" >DATE	  </td>
		  <td  class="theader"    height="21" valign="top" >AMOUNT	  </td>
		  <td  class="theader" width="15%"   height="21" valign="top" >ACTION	  </td>
			   
          </tr>
		  
		 
<?php
$num=0;
$x=$connect->query(" SELECT ID, SUM(AMOUNT) AS AMOUNT, PAYMENTMODE, PAYMENTREFF,PAIDTO, DATE  FROM miscexpences WHERE DATE >='$daterange->startdate' AND DATE <='$daterange->enddate' GROUP BY PAIDTO,PAYMENTMODE,PAYMENTREFF ORDER BY  DATE");
while ($data = $x->fetch_object())
{ 
$num +=1; 
?>
 <tr>
 <td class="theader"    height="21" valign="top" ><?php print $num; ?>		  </td>
 <td  class="theader"    height="21" valign="top" ><?php print $data->PAIDTO; ?>	  </td>
        			<td  class="theader"    height="21" valign="top" ><?php print $data->PAYMENTMODE; ?>	  </td>
			<td  class="theader"    height="21" valign="top" ><?php print $data->PAYMENTREFF; ?>	  </td>

		  <td  class="theader" width="15%"   height="21" valign="top" ><?php print $data->DATE; ?>  </td>
		  <td  class="theader"    height="21" valign="top" ><?php print number_format($data->AMOUNT,2); ?>	  </td>
		  <td  class="theader" width="15%"   height="21" valign="top" >
<a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="<?php print $data->PAYMENTMODE.' '.$data->PAYMENTREFF; ?> " data-placement="left" class="deletelink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
 <a title="VIEW DETAILS" data-toggle="popover" data-trigger="hover"  data-content="<?php print $data->PAYMENTMODE.' '.$data->PAYMENTREFF; ?> "   data-placement="left" href="editexpence.php?editid=<?php  print $data->ID; ?>"  onclick="return confirm('LOAD DETAILS ?')" > <div class="fas fa-print" style="font-size:160%;"> </div></a>
		  
		  </td>
          </tr>
<?php }

?>

<?php
$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT  FROM miscexpences  WHERE DATE >='$daterange->startdate' AND DATE <='$daterange->enddate' ");
while ($data = $x->fetch_object())
{ 
?>
 <tr>
			<td  class="theader"    height="21" valign="top" >	  </td>
			<td  class="theader"    height="21" valign="top" >	  </td>
			<td  class="theader"    height="21" valign="top" >	  </td>
			<td  class="theader"    height="21" valign="top" >	  </td>
		  <td  class="theader" width="15%"   height="21" valign="top" >TOTAL  </td>
		  <td  class="theader"    height="21" valign="top" ><?php print number_format($data->AMOUNT,2); ?>	  </td>
		  <td  class="theader" width="15%"   height="21" valign="top" >  </td>
          </tr>
<?php }

?>
        </tbody>
		
      </table>
	  <br />
</div>
</form>

 
  
  
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

 <div class="modal fade" id="expencedetails" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="expencescontent"> X</div></div></div>
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
