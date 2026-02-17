<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("interface.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INSUARANCE";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class editinsuarance
{
public $insuarance=null;	
}
$editinsuarance=new editinsuarance;
$editinsuarance->insuarance=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['insuarance']))));

$x=$connect->query("SELECT ID,INSUARANCE,BOXADDRESS,PHONENUMBER,EMAIL   FROM insuarances  WHERE INSUARANCE='$editinsuarance->insuarance' " );
while ($data = $x->fetch_object())
{ 
?>

<script>
$(document).ready(function() {
$("#insuarancepayment").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'insuaranepayment2.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
				 $('#amount').val('');
				 $('#invoicenumber').val('');
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
</script>
<form method="post"  id="insuarancepayment" action="insuaranepayment2.php" >
  <div class="container">
  <div class="row">

    <div class="col-sm-12" >
		<input type="hidden" class="form-control input-sm" value="<?php print $data->ID; ?>"   name="insuaranceid" style='text-transform:uppercase' required="on" autocomplete="off" />

	COMPANY NAME
	<input type="text" class="form-control input-sm"  readonly value="<?php print $data->INSUARANCE; ?>" pattern="[A-Z,a-z0-9 -.]+" title="INVALID ENTRIES" id="companyname" name="companyname" style='text-transform:uppercase' required="on" autocomplete="off" />
	<br> PAYMENT  METHOD
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT PAYMENT  METHOD" data-placement="bottom"> 
 <select class="form-control" required  required= "on"  name="paymentmethod" >
	 <option value="">SELECT PAYMENT  METHOD</option>
        <option value="CASH">CASH  </option>
		<option value="CHEQUE">CHEQUE </option>
		<option value="EFT">EFT </option>
		<option value="MPESA">MPESA </option>
			  </select></a>
			  <br>PAYMENT  REFFERENCE NUMBER
		<input type="text"  style="text-transform:uppercase"  class="form-control input-sm"  pattern="[A-Za-z-. 0-9]+" title="INVALID ENTRIES"  id="paymentreff" name="paymentreff" style='text-transform:uppercase'  autocomplete="off" />
		<br>
		PAYMENT  DATE
		<input type="date"  required class="form-control input-sm"    name="date"   autocomplete="off" />
		
		<hr>
		INVOICE NUMBER
		<input type="text"  readonly class="form-control input-sm"  list="invoicenumberlist" id="invoicenumber" name="invoicenumber"   autocomplete="off" />
		<br> PAYMENT AMOUNT
		<input type="text" style="text-transform:uppercase"  required class="form-control input-sm"  pattern="[0-9.]+" title="INVALID ENTRIES" id="amount" name="amount" style='text-transform:uppercase' required="on" autocomplete="off" />
	 	<br>		
		  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   

		<br>
	</div>
  </div>
</div>
</form>


<?php }
?>

<datalist id="invoicenumberlist" >
<?php 
$x=$connect->query( "SELECT DISTINCT(INVOICENUMBER) AS INVOICENUMBER,INSUARANCE  FROM invoicerecords WHERE INSUARANCE='$editinsuarance->insuarance' ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->INVOICENUMBER; ?> " > <?php print $data->INVOICENUMBER; ?> <?php print $data->INSUARANCE; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>

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