<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="INVENTORY";
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
.btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
	  table  td:nth-child(5){ text-transform: none;}
	   @media print {table td:nth-child(6){display: none;}
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
$('[data-toggle="popover"]').popover(); 


    $('#newstock').click(function() {
    $('#supplier').prop('disabled', false);$('#invoicenumber').prop('disabled', false);$('#date').prop('disabled', false);
    });
	
    $('#recordsadjustment').click(function() {
	$('#description').prop('disabled', false);$('#description').val('')
    });
    $("#restockphamarcy2").submit(function(event) {
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
            url: 'restockphamarcy2.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
                $("#tablecontainer1").load("restockphamarcy.php #tablecontainer2", function() {
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

</script>
 <script>
        $(document).ready(function(){
            $('#additem').click(function(){
                $('#itemdetails').append('<br><div class="container"><div class="row"><div class="col-sm-4"><input list="itemlist"  required style="text-transform:uppercase" pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="item"  name="item[]" type="text" size="15" placeholder="ENTER  ITEM"  required="on"  class="form-control input-sm"    autocomplete="off" ></div><div class="col-sm-2">	<input type="text" class="form-control input-sm" pattern="[0-9.-]+" title="INVALID ENTRIES"  name="unitprice[]" placeholder="ENTER  PRICE"   id="unitprice" autocomplete="off" required="on" /></div><div class="col-sm-2">	<input type="text" class="form-control input-sm" pattern="[0-9.-]+" title="INVALID ENTRIES"  name="quantity[]" placeholder="ENTER  QUANTITY"   id="quantity" autocomplete="off" required="on" /></div><div class="col-sm-2"> <input  style="text-transform:uppercase" pattern="[0-9A-Za-z]+" title="INVALID ENTRIES" id="batchnumber" name="batchnumber[]" type="text" size="15" placeholder="ENTER  BATCH NUMBER"  required="on"  class="form-control input-sm"    autocomplete="off" >   </div><div class="col-sm-2"><input  style="text-transform:uppercase"  title="INVALID ENTRIES" id="expiredate" name="expiredate[]" type="date" size="15" placeholder="ENTER  DATE"  required="on"  class="form-control input-sm"    autocomplete="off" ></div></div></div>');
            });
			
        });
    </script>

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

  
<form id="restockphamarcy2" method="post" action="restockphamarcy2.php">
<div id="tablecontainer1">
<div id="tablecontainer2">
   <div class="container" style="margin-top:5%;" >
  <div class="row"> <div style="text-align:center;font-weight:bold;text-decoration: underline;">RESTOCK  DETAILS </div>
  
   <div class="col-sm-12">
  <label><input checked type="radio" id="newstock" onclick="$('#description').prop('disabled', true);$('#description').val('')"  name="restockmode" checked value="NEW STOCK">NEW STOCK</label> 
<label><input type="radio" id="inventoryadjustment" disabled  onclick="$('#description').prop('disabled', true); $('#supplier').prop('disabled', true);$('#description').val(''); $('#date').val(''); $('#invoicenumber').val('');  $('#supplier').val(''); $('#invoicenumber').prop('disabled', true);$('#date').prop('disabled', true);" name="restockmode" value="INVENTORY ADJUSTMENT">INVENTORY ADJUSTMENT</label>
<label><input type="radio" id="recordsadjustment"  onclick="$('#supplier').prop('disabled', true);$('#date').val(''); $('#invoicenumber').val('');  $('#supplier').val(''); $('#invoicenumber').prop('disabled', true);$('#date').prop('disabled', true);" name="restockmode" value="RECORD ADJUSTMENT">RECORD ADJUSTMENT</label>

<br>  SUPPLIER SPECS<br>
   <select class="form-control input-sm"  required name="supplier" id="supplier" >
<option value=''>SELECT SUPPLIER</option>
<?php 
$x="  SELECT DISTINCT SUPPLIER FROM suppliers     ORDER BY SUPPLIER ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['SUPPLIER']."'>".$y['SUPPLIER']."</option>";	
		}}

?>
    </select><br>
INVOICE REFF
		<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  INVOICE NUMBER" data-placement="bottom">
<input  style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="invoicenumber" name="invoicenumber" type="text" size="15" placeholder="ENTER  INVOICE NUMBER"  required="on"  class="form-control input-sm"    autocomplete="off" >
</a><br>	
   DATE <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT DATE " data-placement="bottom">
<input  style='text-transform:uppercase'  title="INVALID ENTRIES" id="date" name="date" type="date" size="15" placeholder="ENTER  DATE"  required="on"  class="form-control input-sm"    autocomplete="off" >
</a><br>
REASON OF ADJUSTMENT
		<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER REASON  OF  ADJUSTMENT" data-placement="bottom">
<input disabled style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="description" name="description" type="text" size="15" placeholder="ENTER  ADJUSTMENT REASON"  required="on"  class="form-control input-sm"    autocomplete="off" >
</a><br>
   </div>
  </div>
  </div>
   <div id="itemdetails">
</div>
 <datalist id="itemlist" >
<?php 
$x=$connect->query("SELECT ITEM   FROM inventory ORDER BY  ITEM   ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ITEM; ?> " > <?php print $data->ITEM; ?></option>	
		
		<?php 	
	
}

?>
</datalist> 

</div>
</div>
<br>
<div class="container">
  <div class="row">


   <div class="col-sm-3">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button></div>
    <div class="col-sm-3">
	<button type="reset" class="btn-info btn-sm">RESET</button> </div>
	  <div class="col-sm-3">
<button type="button" class="btn-info btn-sm"  id="additem"> <i class="fas fa-cart-plus" style="font-size:160%;"  ></i>ITEM</button> 

</div>
	 <div class="col-sm-3"> </div>
  </div></div>
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
