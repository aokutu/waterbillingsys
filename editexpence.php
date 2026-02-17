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

class expencedetails
{
public $editid=null;  
}
$expencedetails =new expencedetails; 
$expencedetails->editid=$_GET['editid'];
$_SESSION['message']=$expencedetails->editid;

?>
<script>
$(document).ready(function() {
$('[data-toggle="popover"]').popover(); 

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
                url: 'deletemiscexpense2.php',
                data: {
                    deleteid: deleteid,
                    accessname: accessname,
                    accesspass: accesspass // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                    $("#expencedetails2").load("editexpence.php #expencedetails3",  function() {
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
	  })
</script>
<div id ="expencedetails2" >
<div id ="expencedetails3" >
   <button class="btn-info btn-sm" onClick="window.print()"><i style="font-size:200%;" class="fas fa-print"></i></button>  
<h2 style ="font-size:120%" class="underline font-extrabold text-center" ><?php 
$x=$connect->query(" SELECT PAYMENTMODE,PAYMENTREFF,PAIDTO,PAYMENTCHANNEL,PAYMENTCHANNELREFF FROM miscexpences  WHERE ID='$expencedetails->editid' ");
while ($data = $x->fetch_object())
{
print $data->PAYMENTMODE.' '.$data->PAYMENTREFF.' '.$data->PAIDTO.'<br>'.$data->PAYMENTCHANNEL.' '.$data->PAYMENTCHANNELREFF;
} ?></h2>
 <table   style="font-size:80%;text-transform: none;" class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
       
        </thead>
        <tbody>
		   <tr >
		   <td class="theader"    height="21" valign="top" >#  </td>
           <td  class="theader"    height="21" valign="top" >DETAILS	  </td>
			<td  class="theader"    height="21" valign="top" >PRICE	  </td>
		<td  class="theader"   height="21" valign="top" >QNTY	  </td>
		  <td  class="theader"    height="21" valign="top" >AMOUNT	  </td>
		  <td  class="theader"    height="21" valign="top" >DATE	  </td>
		  <td  class="theader"   height="21" valign="top" >ACTION	  </td>
			   
          </tr>
		  
		 
<?php
$num=0;
$x=$connect->query(" SELECT ID,AMOUNT,DESCRIPTION,UNITPRICE,QUANTITY,AMOUNT, PAYMENTMODE, PAYMENTREFF, DATE  FROM miscexpences  WHERE paymentmode =(SELECT  PAYMENTMODE FROM  miscexpences WHERE ID =$expencedetails->editid ) 
AND PAYMENTREFF =(SELECT  PAYMENTREFF FROM  miscexpences WHERE ID=$expencedetails->editid ) ORDER BY  DATE ");
while ($data = $x->fetch_object())
{ 
$num +=1; 
?>
 <tr>
 <td class="theader"    height="21" valign="top" ><?php print $num; ?>		  </td>
           <td  class="theader"    height="21" valign="top" ><?php print $data->DESCRIPTION; ?>	  </td>
			<td  class="theader"    height="21" valign="top" ><?php print number_format($data->UNITPRICE,2); ?>  </td>
		<td  class="theader"   height="21" valign="top" ><?php print $data->QUANTITY; ?>	  </td>
		  <td  class="theader"    height="21" valign="top" ><?php print number_format($data->AMOUNT,2); ?>  </td>
		  <td  class="theader"    height="21" valign="top" ><?php print $data->DATE; ?>	  </td>
		  <td  class="theader"   height="21" valign="top" >
<a title="DELETE" data-toggle="popover" data-trigger="hover" data-content="<?php print $data->PAYMENTMODE.' '.$data->PAYMENTREFF; ?> " data-placement="left" class="deletelink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>

		  </td>
          </tr>
<?php }

?>

<?php
$x=$connect->query(" SELECT SUM(AMOUNT) AS AMOUNT    FROM miscexpences  WHERE paymentmode =(SELECT  PAYMENTMODE FROM  miscexpences WHERE ID =$expencedetails->editid ) 
AND PAYMENTREFF =(SELECT  PAYMENTREFF FROM  miscexpences WHERE ID=$expencedetails->editid ) ORDER BY  DATE ");
while ($data = $x->fetch_object())
{ 
?>
 <tr>
	 <td class="theader"    height="21" valign="top" >#  </td>
           <td  class="theader"    height="21" valign="top" >TOTAL	  </td>
			<td  class="theader"    height="21" valign="top" >	  </td>
		<td  class="theader"   height="21" valign="top" >	  </td>
		  <td  class="theader"    height="21" valign="top" ><?php print number_format($data->AMOUNT,2);?>  </td>
		  <td  class="theader"    height="21" valign="top" >	  </td>
		  <td  class="theader"   height="21" valign="top" >	  </td>
		  </tr>
<?php }

?>
        </tbody>
		
      </table>
</div>
</div>