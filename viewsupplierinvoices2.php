<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INVENTORY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class supplierinvoices
{
public $suppliercompany=null;
public $date1=null;
public $date2=null;
public $invoicenumber=null;
}
$supplierinvoices=new supplierinvoices;
$supplierinvoices->suppliercompany=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['suppliercompany']))));
$supplierinvoices->date1=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$supplierinvoices->date2=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));
$supplierinvoices->invoicenumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['invoicenumber']))));



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
$('[data-toggle="popover"]').popover(); 
//$("#pricelisttable").load("registry.php #accountstable");	
	
$(document).on('click', '.deletelink', function(event) {
        event.preventDefault();
        
        var deleteid = $(this).data('deleteid');
		//deleteid = (deleteid || '').trim();
        var msg = 'DELETE  INVOICE  ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        var accessname = prompt('NAME');
        var accesspass = prompt('PASSWORD');
        
        if (confirmdelete && accessname != null && accesspass != null) {
            $.ajax({
                type: 'POST',
                url: 'deletesuppliersinvoiceitem.php',
                data: {
                    deleteid: deleteid,
                    accessname: accessname,
                    accesspass: accesspass // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                    $("#patientinvoices").load("viewsupplierinvoices2.php #patientinvoicestable", function() {
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
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container" > 
 <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
  </div>

<form id="patientinvoices"   method="post"   >
<div id="patientinvoicestable">
	<h3  style="text-align:center;font-weight:bold;text-decoration:underline;" >INVOICES <br><?php 
	
	print $supplierinvoices->suppliercompany;  ?><br>INV NO.<?php print $supplierinvoices->invoicenumber; ?></h3>

<table class="table"    style="text-align:center;font-size:90%;margin-right:2%;margin-left:2%;">

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
        <tr >
 <td  class="theader"    height="21" valign="top" >#  </td>
  <td  class="theader"    height="21" valign="top" >ITEM	  </td>
  <td  class="theader"    height="21" valign="top" >PRICE	  </td>
			<td  class="theader"    height="21" valign="top" >QNTY 	  </td>
						<td  class="theader"    height="21" valign="top" >AMOUNT	  </td>
			<td  class="theader"    height="21" valign="top" >ACTION	  </td>
			   
          </tr>
 		
		
				<?php
$x=$connect->query("SELECT ID,ITEM,UNITPRICE,QUANTITY,PRICE   FROM stockin  WHERE SUPPLIER='$supplierinvoices->suppliercompany'  AND  INVOICENUMBER='$supplierinvoices->invoicenumber' " );
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
 <td  class="theader"    height="21" valign="top" ><?php print $number; ?></td> 
  <td  class="theader"    height="21" valign="top" ><?php print $data->ITEM; ?></td> 
  <td  class="theader"    height="21" valign="top" ><?php print number_format($data->UNITPRICE,2); ?></td> 
  <td  class="theader"    height="21" valign="top" ><?php print $data->QUANTITY; ?></td> 
  <td  class="theader"    height="21" valign="top" ><?php print number_format($data->PRICE,2); ?></td> 
				            <td style='text-align:center;'  >
<a  title="ITEM" data-toggle="popover" data-trigger="hover" data-content="DELETE"  data-placement="left" class="deletelink" data-deleteid="<?php print $data->ID; ?>""><i class="fas fa-trash" style="font-size:160%;"></i></a>

							</td>
	 </tr>
<?php }	?>

				<?php
$x=$connect->query("SELECT SUM(PRICE) AS TTL    FROM stockin  WHERE SUPPLIER='$supplierinvoices->suppliercompany'  AND  INVOICENUMBER='$supplierinvoices->invoicenumber'   " );
while ($data = $x->fetch_object())
{
	$number+=1;	?>
  <tr class='filterdata'  style='text-align:center;' >
				<td    style='text-align:center;' > </td> 
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

