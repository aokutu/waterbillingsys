<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="ADMIN";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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
  </style>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();
$('#newpatient').modal('show');    
//$('#selecteditem').focus();
$("#billing").submit(function(){

$('#prepostmessage').modal('show');
$.post( "billing.php",
$("#billing").serialize(),
function(data){
$("#processbill").load("walkins.php #billtable");
$("#content").load("message.php #content");
$("#loadprice").load("loadprices.php #itemdetails");
	$("#totalamount").load("loadprices.php #totalload");
$('#prepostmessage').modal('hide'); $('#message').modal('show');
//$('#selecteditem').focus();
$('#quantity').val('');

return false;});


return false;
})


 
$("#discount").change(function() {
let total=parseFloat($("#totalcharges").val());
let discount=parseFloat($('#discount').val());
let actual=parseFloat(total-discount).toFixed(2);
$('#actualcharges').val(actual);
 return false;
 });
 
$("#discount").mouseout(function() {
let total=parseFloat($("#totalcharges").val());
let discount=parseFloat($('#discount').val());
let actual=parseFloat(total-discount).toFixed(2);
$('#actualcharges').val(actual);
 return false;
 }); 
 
$("#discount").focusout(function() {
let total=parseFloat($("#totalcharges").val());
let discount=parseFloat($('#discount').val());
let actual=parseFloat(total-discount);
$('#actualcharges').val(actual);
 return false;
 });
 
 

$("#selecteditem").change(function() {
	$('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#billing").serialize(),
function(data){
	$("#loadprice").load("loadprices.php #itemdetails");
	$("#totalamount").load("loadprices.php #totalload");	
	//$("#detailsdiv").load("walkins.php #detailsdiv");
	});
 $('#prepostmessage').modal('hide');
 return false;
 });
 
$("#quantity").change(function() {
		 $('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#billing").serialize(),
function(data){
	$("#loadprice").load("loadprices.php #itemdetails");
	$("#totalamount").load("loadprices.php #totalload");
//return false;
});
 $('#prepostmessage').modal('hide');
 });
 
 
 $("#selecteditem").focusout(function() {
	$('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#billing").serialize(),
function(data){
	$("#loadprice").load("loadprices.php #itemdetails");
	$("#totalamount").load("loadprices.php #totalload");
//return false;
});
 $('#prepostmessage').modal('hide');
 //alert($(this).val());
 });
 
/* $(document).on('keydown', function(e) {
 if (e.key === 'q' || e.key === 'Q') 
 {
     e.preventDefault(); // Prevent default Q key action
        $('#quantity').focus();
		$('#quantity').val('');
}
            });*/

 })
  
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
  <div class="container" id="tablecontainer">
  <div class="row">
   <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newpatient">ACCOUNT</button>
  </div>
  </div> 


 <form class="modal fade" id="newpatient" role="dialog"    action="selectnewpatient.php" method="post"  >

  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
  <div class="container">
  <div class="row">
  <div class="col-sm-4">PATIENT NUMBER
   <input name="patientnumber"  list="numberlist" required type="text"  id="patientnumber"  class="form-control input-sm" required placeholder="PATIENT NUMBER" autocomplete="off"><br> 

</div>
 <div class="col-sm-4"><br>
 <button type="submit" class="btn-info btn-sm" >LOAD DETAILS</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button>

 </div>

</div></div></div></div>
  </form>
  
  
 <form id="billing"   method="post" action="billing.php"  >  
<hr class="btn-info btn-sm">


<div class="container">
  <div class="row">
  <div class="col-sm-8">
PATIENT NUMBER
   <input name="patientnumber"  list="numberlist" required type="text"  id="patientnumber"  class="form-control input-sm" required placeholder="PATIENT NUMBER" autocomplete="off"><br> 
  
ITEM<input name="item" type="text" autofocus id="selecteditem" list="details" class="form-control input-sm" required placeholder="SEARCH DETAILS" autocomplete="off">

<div id="loadprice" >
PRICE
<input type="text"  class="form-control input-sm" required placeholder="PRICE" autosearch="off">
</div>
</div>

<div class="col-sm-4">
QNTITY<input type="text" required name="quantity" id="quantity" class="form-control input-sm" required placeholder="QNTY" autosearch="off">
TOTAL<div id="totalamount" >
<input type="text"  class="form-control input-sm" required placeholder="AMOUNT" autosearch="off">
</div>
<button type="submit" class="btn-info btn-sm" >ADD</button><button type="reset" class="btn-info btn-sm">RESET</button>

</div>
</div>
</div>



 </form>
 
 			<datalist id="numberlist" >
			
 <option value="WALK IN " > WALK IN </option>
<?php 

$x=$connect->query("SELECT ACCOUNT,CLIENT FROM patientsrecord  ORDER BY ACCOUNT ASC ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ACCOUNT; ?> " > <?php print $data->ACCOUNT.'   '.$data->CLIENT; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>

 <div id="detailsdiv">
<datalist id="details" >
<?php 

$x=$connect->query("SELECT ITEM,QUANTITY FROM inventory WHERE PRICE >0 AND QUANTITY >0");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ITEM; ?> " > <?php print $data->ITEM.'  QNTY '.$data->QUANTITY; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
</div>
  <hr class="btn-info btn-sm">
   <form id="processbill" method="post" action="processbill.php">
   <div id="billtable" >
   <script>
     $(document).ready(function(){
   $('#clientnumber').prop('disabled', true);
	 })
   </script>
   
   
   <div class="container">
  <div class="row">
  <div class="col-sm-6">
  <h4 style="text-align:center;text-decoration:underline;"><?php print $_SESSION['patientnumber']; ?> <?php print  $_SESSION['clientname']; ?></h4>
  </div>
   <div class="col-sm-6">

   </div>
  </div>
  </div>
  
  
   
  <table style="font-size:75%;"  class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
		
		 <tr>
		   <td  class="theader"  width="5%" height="21" valign="top" >NO. </td>
            <td  class="theader" width="20%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader"   height="21" valign="top" >UNITS  </td>
			<td  class="theader"  height="21" valign="top" >PRICE  </td>
			<td  class="theader"  height="21" valign="top" >VAT  </td>
			<td  class="theader"   height="21" valign="top" >QNTY	  </td>
		  <td  class="theader"   height="21" valign="top" >TOTAL	  </td>
		   <td  class="theader"   height="21" valign="top" >DEL	  </td>			   
          </tr>
		  
	
       <?php
$number=0;
$x=$connect->query("SELECT ID,DETAILS,UNIT,PRICE,QUANTITY,PRICE,TAXES,GROSSTOTAL,TOTAL FROM pendingsales  WHERE PATIENTNUMBER='".$_SESSION['patientnumber']."' ");
while ($data = $x->fetch_object())
{
$number +=1;
	?> <tr>
		   <td    width="5%" height="21" valign="top" ><?php print $number; ?> </td>
            <td   width="20%"   height="21" valign="top" ><?php print $data->DETAILS;  ?>  </td>
			<td     height="21" valign="top" ><?php print $data->UNIT; ?>  </td>
			<td    height="21" valign="top" ><?php print number_format($data->PRICE,2); ?>  </td>
			<td    height="21" valign="top" ><?php print number_format($data->TAXES,2); ?>  </td>
			<td     height="21" valign="top" ><?php print  $data->QUANTITY; ?>	  </td>
		  <td     height="21" valign="top" ><?php print number_format($data->GROSSTOTAL,2); ?>	  </td>
		   <td     height="21" valign="top" >
		   		 <a   href="deletebilleditem.php?deleteitemid=<?php print $data->ID ;?>"  onclick="return confirm('DELETE ITEM ? ?')" >
				 <div class="fas fa-trash" style="font-size:160%;"> </div>
				 </a>
 </td>			   
          </tr>

<?php }

$x=$connect->query("SELECT SUM(TOTAL) AS TTL,SUM(TAXES) AS TAX FROM pendingsales WHERE CASHIER='$dbdetails->user'  ");
while ($data = $x->fetch_object())
{
$number +=1;
	?> 
	
			  <tr style="font-weight:bold;"  >
		   <td    width="5%" height="21" valign="top" > </td>
            <td   width="20%"   height="21" valign="top" >  <div class="fa fa-arrow-circle-down"  style="font-size:200%;" ></div> CHARGES </td>
			<td    height="21" valign="top" > <div class="fa fa-arrow-circle-down"  style="font-size:200%;" ></div> VAT</td>
			<td     height="21" valign="top" ><div class="fa fa-arrow-circle-down"  style="font-size:200%;" ></div> VAT + TOTAL </td>
			<td     height="21" valign="top" ><div class="fa fa-arrow-circle-down"  style="font-size:200%;" ></div> DISCOUNT </td>
			<td     height="21" valign="top" ><div class="fa fa-arrow-circle-down"  style="font-size:200%;" ></div> TOTAL</td>
	
		   <td     height="21" valign="top" > </td>			   
          </tr>
		  
		  
	<tr>
		   <td    width="5%" height="21" valign="top" > </td>
            <td   width="20%"   height="21" valign="top" >
<input type="text" readonly  required="on" value="<?php print $data->TTL; ?>" class="form-control input-sm" required placeholder="AMOUNT" autosearch="off">  
</td>
<td     height="21" valign="top" > <input type="text" readonly name="vat" id="vat"  value="<?php print round($data->TAX,2); ?>" class="form-control input-sm" required placeholder="TAXES" autosearch="off">  
</td>
	
			<td     height="21" valign="top"> 
			<input type="text" readonly value="<?php print round(($data->TAX+$data->TTL),2); ?>" id="totalcharges" name="totalcharges" class="form-control input-sm"  placeholder="TOTAL CHARGES" autosearch="off"> 
			</td>
	
		   <td     height="21" valign="top" >
<input type="text"  id="discount" name="discount"  value="0"   placeholder="[0-9.]+" required  class="form-control input-sm" placeholder="DISCOUNT" autosearch="off"> 
		   
 </td>	
		<td    height="21" valign="top" >
<input type="text" readonly name="actualcharges" id="actualcharges" required="on"  placeholder="[0-9.]+" value="<?php print  round(($data->TAX+$data->TTL),2); ?>" class="form-control input-sm" required placeholder="AMOUNT" autosearch="off">  

		</td>
			<td     height="21" valign="top" >  </td> 
          </tr>
		  
		  <tr>
		   <td    width="5%" height="21" valign="top" > </td>
            <td   width="20%"   height="21" valign="top" >CLIENT DETAILS  </td>
						<td    height="21" valign="top" > <label><input id="walkin"  type="radio" onclick="$('#paymentreff').prop('disabled', false); $('#mpesapay').prop('disabled', false);$('#cashpay').prop('disabled', false); $('#clientnumber').prop('disabled', true);$('#clientnumber').val('');" checked name="clienttype" value="WALK IN"> CASH (WALK IN)</label> </td>
			<td     height="21" valign="top" >  <label><input type="radio" id="invoiced" name="clienttype" onclick="$('#paymentreff').prop('disabled', true);$('#paymentreff').val(''); $('#mpesapay').prop('disabled', true);$('#cashpay').prop('disabled', true); $('#clientnumber').prop('disabled', false);$('#clientnumber').val('');"  value="INVOICED" >INVOICED</label>  </td>
			<td     height="21" valign="top" >
			<input type="text"  disabled  name="clientnumber"  id="clientnumber" list="numberlist"  class="form-control input-sm" required placeholder="CLIENT NUMBER" autosearch="off">
			</td>

			<td     height="21" valign="top" > 
			<input type="text"   name="krapin"id="krapin" disabled class="form-control input-sm" required placeholder="KRA PIN" autosearch="off">
			</td>
	
		   <td     height="21" valign="top" >
		   
 </td>			   
          </tr>
		  
 
		  <tr>
		   <td    width="5%" height="21" valign="top" > </td>
            <td   width="20%"   height="21" valign="top" >PAYMENT MODE  </td>
						<td    height="21" valign="top" ><label><input type="radio" id="cashpay"  onclick="$('#paymentreff').prop('disabled', true);$('#paymentreff').val('');" name="paymode" checked value="CASH">CASH</label>  </td>
			<td     height="21" valign="top" > <label><input type="radio" id="mpesapay"  onclick="$('#paymentreff').prop('disabled', false);" name="paymode" value="MPESA">M-PESA</label>  </td>

			<td     height="21" valign="top" >
			<input type="text"  id="paymentreff" name="paymentreff" required disabled class="form-control input-sm"  placeholder="PAY REFF NUMBER" autosearch="off"> 

 </td>

			<td     height="21" valign="top" >
			<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
			</td>
	
		   <td     height="21" valign="top" >
		   
 </td>			   
          </tr>
		  

<?php }

	?>
	
        </tbody>
		
      </table>
	
  <style>
    label {
      display: inline-block;
      margin-right: 20px;
    }
  </style>
  

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
