<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INSUARANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND  ACCESS  REGEXP  '$dbdetails->userrights'   ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
include_once("interface.php");
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
<script>
$(document).ready(function() {
$('[data-toggle="popover"]').popover(); 
    $("#newinsuarance").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect form data
       /* var companyname = $("#companyname").val();
        var companyaddress = $("#companyaddress").val();
        var phonenumber = $("#phonenumber").val();
        var email = $("#email").val(); */
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'newinsuarance.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
                $("#deletecompany").load("insuarancerececompanies.php #zones", function() {
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

 $(document).on('click', '.invoicelink', function(event) {
        event.preventDefault();
        
        var insuarance = $(this).data('insuarance2');
		 insuarance = (insuarance || '').trim();
		$('#insuarance2').val(insuarance);
		$('#daterange2').modal('show');
        return false;
        return true;
    });
	
 $(document).on('click', '.searchlink', function(event) {
        event.preventDefault();
        
        var insuarance = $(this).data('insuarance');
		 insuarance = (insuarance || '').trim();
		$('#insuarancecompany').val(insuarance);
		$('#daterange').modal('show');
        return false;
        return true;
    });

 $(document).on('click', '.deletelink', function(event) {
        event.preventDefault();
        
        var insuarance = $(this).data('insuarance');
		 insuarance = (insuarance || '').trim();
        var msg = 'DELETE INSUARANCE ' + insuarance;
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deleteinsuarancerececompanies.php',
                data: {
                    insuarance: insuarance
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#deletecompany").load("insuarancerececompanies.php #zones", function() {
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

</script>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="Click to add new insuarance" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newinsuarance"> <i style="font-size:160%;" class="fas fa-shield-alt"></i>NEW</button> </a>
   <button class="btn-info btn-sm" onClick="window.print()"><i style="font-size:200%;" class="fas fa-print"></i></button>  
  

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
  <form class="modal fade" id="newinsuarance" role="dialog" method="post" action="newinsuarance.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header" ><h1  style="text-align:center;">ENTER INSUARANCE NAME</h1></div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >INSUARANCE NAME
	<input type="text" class="form-control input-sm"  pattern="[A-Z,a-z0-9 -.]+" title="INVALID ENTRIES" id="companyname" name="companyname" style='text-transform:uppercase' required="on" autocomplete="off" />
	<br> BOX ADDRESS
		<input type="text" style="text-transform:uppercase" class="form-control input-sm"  pattern="[A-Z,a-z0-9 -.]+" title="INVALID ENTRIES" id="companyaddress" name="companyaddress" style='text-transform:uppercase' required="on" autocomplete="off" />
	 	<br> PHONE
		<input type="text"  style="text-transform:uppercase"  class="form-control input-sm"  pattern="[0-9+]+" title="INVALID ENTRIES"  id="phonenumber" name="phonenumber" style='text-transform:uppercase'  autocomplete="off" />
		<br>
		EMAIL:
		<input type="email" class="form-control input-sm" id="email" name="email"   autocomplete="off" />
		<br>
		<br>
	</div>
	<div class="col-sm-4"></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn btn-default" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
<form id="deletecompany" method="post" action="deleteinsuarancerececompanies.php">
<div id="zones">
<h4><strong>INSUARANCE COMPANIES </strong></h4>
 <table   style="font-size:80%;text-transform: none;" class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
       
        </thead>
        <tbody>
		   <tr >
            <td width='25%' class="theader"    height="21" valign="top" >INSUARANCE	  </td>
			<td  class="theader"    height="21" valign="top" >ADDRESS	  </td>
			<td  class="theader"    height="21" valign="top" >PHONE	  </td>
			<td  width='25%' class="theader"    height="21" valign="top" >EMAIL	  </td>
			<td  class="theader"    height="21" valign="top" >BALANCE	  </td>
		  <td  class="theader" width="15%"   height="21" valign="top" >ACTION	  </td>
			   
          </tr>
		 
<?php
$connect->query(" UPDATE insuarances SET BALANCE='0' ,CREDIT='0',DEBIT='0' ");
$connect->query(" UPDATE insuarances JOIN ( SELECT insuarance, SUM(totalcharges) AS total FROM invoicerecords GROUP BY insuarance ) AS t2_sums ON insuarances.insuarance = t2_sums.insuarance SET insuarances.credit = t2_sums.total; " );
$connect->query(" UPDATE insuarances JOIN ( SELECT insuarance, SUM(amount) AS total FROM insuarancepayment GROUP BY insuarance ) AS t2_sums ON insuarances.insuarance = t2_sums.insuarance SET insuarances.debit = t2_sums.total; " );
$connect->query(" UPDATE insuarances AS t1 ,insuarances AS t2 SET t1.BALANCE=t2.CREDIT-t2.DEBIT WHERE t1.ID=t2.ID  ");
$x=$connect->query("SELECT ID,INSUARANCE,BOXADDRESS,BALANCE,PHONENUMBER,EMAIL   FROM insuarances  " );
while ($data = $x->fetch_object())
{ 
?>
 <tr>
            <td width='25%'     height="21" valign="top" ><?php print $data->INSUARANCE; ?>	  </td>
			<td      height="21" valign="top" ><?php print $data->BOXADDRESS; ?>  </td>
			<td     height="21" valign="top" ><?php print $data->PHONENUMBER; ?>	  </td>
			<td  width='25%'     height="21" valign="top" ><?php print $data->EMAIL; ?>	  </td>
			<td     height="21" valign="top" ><?php print number_format($data->BALANCE,2); ?>		  </td>
		  <td width="15%"  height="21" valign="top" >
		  <a title="INSUARANCE" data-toggle="popover" data-trigger="hover" data-content="CASH FLOW" data-placement="bottom"  class="searchlink" data-insuarance="<?php print $data->INSUARANCE; ?>" > <div class="fas fa-calendar-day" style="font-size:160%;"> </div></a>
&nbsp;&nbsp;&nbsp;<a title="INSUARANCE" data-toggle="popover" data-trigger="hover" data-content="INVOICES" data-placement="bottom" class="invoicelink" data-insuarance2="<?php print $data->INSUARANCE; ?>" > <div class="fas fa-file-invoice" style="font-size:160%;"> </div></a>

		&nbsp;&nbsp;&nbsp;<a title="INSUARANCE" data-toggle="popover" data-trigger="hover" data-content="EDIT" data-placement="bottom"  href="editinsuarance.php?insuarance=<?php  print $data->INSUARANCE; ?>"  onclick="return confirm('EDIT  INSUARANCE ?')" ><div class="fas fa-pencil-alt" style="font-size:160%;"> </div></a>
				   <a title="INSUARANCE" data-toggle="popover" data-trigger="hover" data-content="RECEIVE PAYMENT" data-placement="bottom"  href="insuarancepayments.php?insuarance=<?php  print $data->INSUARANCE; ?>"  onclick="return confirm('RECEIVE  PAYMENT ?')" ><div class="fas fa-wallet" style="font-size:160%;"> </div></a>
		  <?php  if($data->BALANCE <1 ) {?>  <a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="INSUARANCE" data-placement="left" class="deletelink" data-insuarance="<?php print $data->INSUARANCE; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a><?php }?>	  </td>
			   
          </tr>
<?php }


$x=$connect->query("SELECT SUM(BALANCE) AS BALANCE   FROM insuarances  " );
while ($data = $x->fetch_object())
{ 
?>
 <tr>
            <td width='25%'     height="21" valign="top" >  </td>
			<td      height="21" valign="top" >  </td>
			<td     height="21" valign="top" >	  </td>
			<td  width='25%'     height="21" valign="top" >TOTAL </td>
			<td     height="21" valign="top" ><?php print number_format($data->BALANCE,2); ?>		  </td>
		  <td  width="15%"  height="21" valign="top" >	  </td>
			   
          </tr>
<?php }
?>
        </tbody>
		
      </table>
	  <br />
</div>
</form>

  <form class="modal fade" id="daterange" role="dialog" method="post"   action="insuarancecashflow.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">CASHFLOW REPORT<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">INSUARANCE COMPANY
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' readonly required  id="insuarancecompany" name="insuarancecompany" type="text"    title="INVALID ENTRIES"  placeholder="[0-9.]+" title="INVALID ENTRIES" size="15" placeholder="ENTER INSUARANCE "   class="form-control input-sm"     autocomplete="off" ></a>

FROM 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' required  id="date1" name="date1" type="date"    title="INVALID ENTRIES"   size="15" placeholder="START DATE "   class="form-control input-sm"     autocomplete="off" ></a>
TO 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' required list="patientnmberslist" id="date2"  name="date2" type="date"     size="15" placeholder="END DATE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="daterange">CLOSE</button> 

 </div>
  

</div></div>

  
  </div></div></div></div>
  </form> 
  
  
   <form class="modal fade" id="daterange2" role="dialog" method="post"   action="insuaranceinvoices.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">INVOICES TRACKING REPORT<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">INSUARANCE COMPANY
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' readonly required  id="insuarance2" name="insuarance" type="text"    title="INVALID ENTRIES"  placeholder="[0-9.]+" title="INVALID ENTRIES" size="15" placeholder="ENTER INSUARANCE "   class="form-control input-sm"     autocomplete="off" ></a>

FROM 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' required  id="date1" name="date1" type="date"    title="INVALID ENTRIES"   size="15" placeholder="START DATE "   class="form-control input-sm"     autocomplete="off" ></a>
TO 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' required list="patientnmberslist" id="date2"  name="date2" type="date"     size="15" placeholder="END DATE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="daterange">CLOSE</button> 

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
