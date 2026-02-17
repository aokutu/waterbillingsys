<?php
@session_start();
include_once("password2.php");
include_once("interface.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="PHAMARCY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class treatment 
{
public $patientnumber=null;	
}

$treatment =new treatment;
$treatment->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));


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
$('#treatmentnote').modal('show');  
$("#processbill").load("drugdispence.php #billtable");
//$('#selecteditem').focus();
$("#billing").submit(function(){
$('#prepostmessage').modal('show');
$.post( "billing.php",
$("#billing").serialize(),
function(data){
$("#content").load("message.php #content");
$("#loadprice").load("loadprices.php #itemdetails");
	$("#totalamount").load("loadprices.php #totalload");
	
	
	$("#processbill").load("drugdispence.php #billtable");
$('#prepostmessage').modal('hide'); $('#message').modal('show');

//$('#selecteditem').focus();
$('#quantity').val('');

return false;});


return false;
})



    $('#receipt').click(function() {
        // Enable the button when clicked
        $("#cashpay,#paymentreffnumber,#mpesapay,#eft").prop('disabled', false);
    });
	
	  $('#mpesapay,#eft').click(function() {
        // Enable the button when clicked
        $('#paymentreffnumber').prop('disabled', false);$('#paymentreffnumber').val('');
    });
	
$("#discount").focusout(function() {
let total=parseFloat($("#totalcharges").val());
let discount=parseFloat($('#discount').val());
let actual=parseFloat(total-discount);
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
 
 

$("#selecteditem").change(function() {
	$('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#selecteditem,#patientnumber").serialize(),
function(data){
	$("#loadprice").load("loadprices.php #itemdetails");
	$("#loadbatchnumber").load("loadprices.php #bestbatch");
	});
 $('#prepostmessage').modal('hide');
 return false;
 });
 
 
 $("#selectquantity").change(function() {
	$('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#billing").serialize(),
function(data){
	 
$("#loadprice").load("loadprices.php #itemdetails");
$("#totalamount").load("loadprices.php #totalload");
 return false;	
	});
 $('#prepostmessage').modal('hide');
 return false;
 });
 
 

 
 
 /* $("#selecteditem").focusout(function() {
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
 });*/
 
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
 <form id="billing"   method="post" action="billing.php"  >  
<hr class="btn-info btn-sm">

<?php
$x=$connect->query("SELECT treatmentreport.PRESCRIPTION,treatmentreport.PATIENTNUMBER,TREATMENT,ATTENDANT, CLIENT FROM treatmentreport,patientsrecord WHERE treatmentreport.PATIENTNUMBER='$treatment->patientnumber' AND treatmentreport.PATIENTNUMBER=patientsrecord.ACCOUNT UNION 
SELECT CONCAT('NONE') AS PRESCRIPTION,pendingsales.PATIENTNUMBER,CONCAT('NONE') AS TREATMENT, CONCAT('NONE') AS ATTENDANT, CLIENT FROM pendingsales,patientsrecord WHERE pendingsales.PATIENTNUMBER='$treatment->patientnumber' AND pendingsales.PATIENTNUMBER=patientsrecord.ACCOUNT LIMIT 1;" );
while ($data = $x->fetch_object())
{ 
$client=$data->CLIENT;$patientnumber=$data->PATIENTNUMBER;
?>

  

  
<div class="container">
  <div class="row">
  <div class="col-sm-8">
PATIENT NUMBER
   <input name="patientnumber"  readonly value="<?php print $_SESSION['patientnumber'];?>" list="numberlist" required type="text"  id="patientnumber"  class="form-control input-sm" required placeholder="PATIENT NUMBER" autocomplete="off"><br> 
  
ITEM<input name="selecteditem" type="text" autofocus id="selecteditem" list="details" class="form-control input-sm" required placeholder="SEARCH DETAILS" autocomplete="off">

<div id="loadprice" >
PRICE
<input type="text"  class="form-control input-sm" required placeholder="PRICE" autosearch="off">
</div>


</div>

<div class="col-sm-4">
QNTITY<input type="text" required name="selectquantity" id="selectquantity" class="form-control input-sm" required placeholder="QNTY" autosearch="off">
TOTAL<div id="totalamount" >
<input type="text" readonly class="form-control input-sm" required placeholder="AMOUNT" autosearch="off">
</div>

<div id="loadbatchnumber" >
</div>

<button type="submit" class="btn-info btn-sm" >ADD</button><button type="reset" class="btn-info btn-sm">RESET</button><button data-toggle="modal"  data-target="#treatmentnote" class="btn-info btn-sm">
MEDIC NOTE
</button>

 


</div>
</div>
</div>
	
	
	
	
<?php }

?>
  <div class="modal fade" id="treatmentnote" role="dialog"   >

  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
  <i class="fas fa-times"  style="font-size:160%;" data-dismiss="modal" ></i>
<?php
$x=$connect->query("SELECT treatmentreport.PRESCRIPTION,TREATMENT,ATTENDANT FROM treatmentreport WHERE PATIENTNUMBER='$treatment->patientnumber' 
UNION SELECT CONCAT('NONE') AS PRESCRIPTION,CONCAT('NONE') AS TREATMENT,CONCAT('NONE') AS ATTENDANT 
FROM pendingsales WHERE PATIENTNUMBER='$treatment->patientnumber' AND 
PATIENTNUMBER NOT IN(SELECT PATIENTNUMBER FROM treatmentreport) AND 
DETAILS NOT IN (SELECT DETAILS FROM services )" );
while ($data = $x->fetch_object())
{ 
?>


 
  <div class="container"> 
  <div class="row">
  <div class="col-sm-6"><div style="font-weight:bold;font-decoration:underline;">PHYSICIAN:<?php print $data->ATTENDANT; ?></div><br><?php print $data->PRESCRIPTION; ?>
  
  </div>
 <div class="col-sm-6">
NOTE <br><?php print $data->TREATMENT; ?>
 </div>

</div></div>





  <?php }

?>
</div></div>
  </div>
 </form>
 
<div id="detailsdiv">
<datalist id="details" >
<?php 

$x=$connect->query("SELECT ITEM,QUANTITY FROM inventory WHERE  PRICE >0 AND QUANTITY >0 OR COPRATEPRICE >0 AND QUANTITY >0 ");
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
<form method="post" action="processbill.php" id="processbill" >
 <div id="billtable" >
<h3 style="font-weight:bold;text-align:center;text-decoration:underline;">
REFF:<?php 
print $_SESSION['patientnumber'];
$x=$connect->query("SELECT  CLASS,CLIENT FROM patientsrecord WHERE ACCOUNT='".$_SESSION['patientnumber']."'");
while ($data = $x->fetch_object())
{
print '&nbsp;&nbsp;&nbsp;'.$data->CLIENT;	
$patientclass=$data->CLASS;
	
}

?>
</h3>
	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
<table class="table"  id="pricelisttable"  style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="5%" height="28" valign="top" style='text-align:center;' >NO.</td>   
		    <td  class="theader"  width="40%"  height="28" valign="top" style='text-align:left;'  >DESCRIPTION</td> 
<td  class="theader"    height="28" valign="top"  style='text-align:right;' >STATUS</td>	
<td  class="theader"    height="28" valign="top"  style='text-align:right;' >UNIT</td>			
			 <td  class="theader"    height="28" valign="top"  style='text-align:right;' >PRICE</td>
			 <td  class="theader"    height="28" valign="top"  style='text-align:right;' >QNTY</td>
			 <td  class="theader"    height="28" valign="top"  style='text-align:right;' >TOTAL</td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > ACTION </td> </tr>
 		
		

				<?php
$x=$connect->query("SELECT DETAILS,PRICE,ID,UNIT,TOTAL,TAXES,GROSSTOTAL,QUANTITY,STATUS,PATIENTNUMBER,DATE  FROM pendingsales WHERE STATUS='' AND  PATIENTNUMBER= '".$_SESSION['patientnumber']."' AND DETAILS  IN (SELECT ITEM FROM inventory )  ");
//$x=$connect->query("SELECT DETAILS,PRICE,ID,UNIT,TOTAL,TAXES,GROSSTOTAL,QUANTITY,STATUS,PATIENTNUMBER,DATE  FROM pendingsales WHERE STATUS='' AND  PATIENTNUMBER= '".$_SESSION['patientnumber']."'  ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td>  
			    <td   width='40%' style='text-align:left;'  ><?php print $data->DETAILS; ?></td>
				<td   style='text-align:right;'  ><?php print $data->STATUS; ?></td>
				 <td   style='text-align:right;'  ><?php print $data->UNIT; ?></td>
				  <td   style='text-align:right;'  ><?php print number_format($data->PRICE,2); ?></td>
				   <td   style='text-align:right;'  ><?php print $data->QUANTITY; ?></td>
			   <td   style='text-align:right;'  ><?php print number_format($data->TOTAL,2); ?></td>
				            <td style='text-align:center;'  >
						<a   href="deletebilleditem.php?deleteitemid=<?php print $data->ID; ?>"  onclick="return confirm('RETURN ITEM ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>
	 </tr>
<?php } ?> 

				<?php
$x=$connect->query("SELECT DETAILS,PRICE,ID,UNIT,TOTAL,TAXES,GROSSTOTAL,QUANTITY,STATUS,PATIENTNUMBER,DATE  FROM pendingsales WHERE STATUS='ISSUED' AND  PATIENTNUMBER= '".$_SESSION['patientnumber']."' AND DETAILS  IN (SELECT ITEM FROM inventory )  ");
//$x=$connect->query("SELECT DETAILS,PRICE,ID,UNIT,TOTAL,TAXES,GROSSTOTAL,QUANTITY,STATUS,PATIENTNUMBER,DATE  FROM pendingsales WHERE STATUS='' AND  PATIENTNUMBER= '".$_SESSION['patientnumber']."'  ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td>  
			    <td   width='40%' style='text-align:left;'  ><?php print $data->DETAILS; ?></td>
				 <td   style='text-align:right;'  ><?php print $data->STATUS; ?></td>
				 <td   style='text-align:right;'  ><?php print $data->UNIT; ?></td>
				  <td   style='text-align:right;'  ><?php print number_format($data->PRICE,2); ?></td>
				   <td   style='text-align:right;'  ><?php print $data->QUANTITY; ?></td>
			   <td   style='text-align:right;'  ><?php print number_format($data->TOTAL,2); ?></td>
				            <td style='text-align:center;'  >
						<a   href="deletebilleditem.php?deleteitemid=<?php print $data->ID; ?>"  onclick="return confirm('RETURN ITEM ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>
	 </tr>
<?php } ?> 
<?php
$x=$connect->query("SELECT SUM(TOTAL) AS TOTAL  FROM pendingsales  WHERE   PATIENTNUMBER ='".$_SESSION['patientnumber']."'  AND DETAILS  IN (SELECT ITEM FROM inventory ) ");
while ($data = $x->fetch_object())
{	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' > </td>  
			    <td   width='40%' style='text-align:left;'  >TOTAL</td>
				 <td   style='text-align:right;'  ></td>
				  <td   style='text-align:right;'  ></td>
				  <td   style='text-align:right;'  ></td>
				  <td style='text-align:center;'  ></td>
			   <td   style='text-align:right;'  ><?php $totalcharges=$data->TOTAL+$bed; print number_format($bed+$data->TOTAL,2); ?></td>
				            <td style='text-align:center;'  ></td>
	 </tr>
<?php } ?> 
 

   <tr  class="unprint" style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' > </td>  
			    
	<?php 
	if($patientclass=='INSUARANCE')
	{
		?>
		<td    style='text-align:left;'  >
		 <label><input type="radio" checked onclick="$('#cashpay,#mpesapay,#eft,#paymentreffnumber').prop('disabled', true);$('#paymentreffnumber').val('')"  id="invoice"  name="document" value="INVOICE">INVOICE</label> 
		</td>
	 <td   style='text-align:left;'  > 
			  </td>
	<?php 
if ($bed >0 )
{
?>
 <td   style='text-align:left;'  > ADMIT DATE
	 <input     name="admissiondate"   type="date"   value="<?php print date('Y-d-m');?>"     size="15" placeholder="ADMISSION DATE"   class="form-control input-sm"     autocomplete="off" ></a>

			  </td>
				  <td   style='text-align:left;'  >DISCHARGE DATE
				  	 <input     name="dischargedate"  value="<?php print date('Y-d-m');?>"   type="date"      size="15" placeholder="DISCHARGE DATE"   class="form-control input-sm"     autocomplete="off" ></a>

 </td>
<?php 	
	
}	
	?>
			   <td   style='text-align:right;'  >
					DATE<input type="datetime-local" name="billdate" class="form-control input-sm" required placeholder="DATE" autosearch="off">
			   </td>	
		<?php
		
	}
	else 
	{
	?>
	<td    style='text-align:left;'  >
	<label><input type="radio" id="receipt"   name="document" checked value="RECEIPT">RECEIPT</label> 
					
</td>
 <td   style='text-align:left;'  > 
  <label><input type="radio" id="cashpay" onclick="$('#paymentreffnumber').prop('disabled', true);$('#paymentreffnumber').val('')"  name="paymentmode" value="CASH">CASH </label>  
		 <label><input type="radio" id="mpesapay"  name="paymentmode" value="MPESA">M-PESA</label>
			  </td>
				  <td   style='text-align:left;'  >
		 <label><input type="radio" id="eft"  name="paymentmode" value="EFT">EFT</label>
 </td>
				  <td style='text-align:center;'  >
PAY REFF <input type="text" class="form-control input-sm" name="paymentreffnumber"   placeholder="PAY REFF NUMBER" autosearch="off">
		</td>
			   <td   style='text-align:right;'  >
			   </td>
	<?php	
	}
	?>
				 
				  
				
	 </tr>
	 
  
	 
  <tr  class="unprint" style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' > </td>  
			    <td    style='text-align:left;'  >   
TOTAL CHARGES<input type="text" name="totalcharges" class="form-control input-sm" value="<?php print $totalcharges; ?>" id="totalcharges" readonly  placeholder="TOTAL CHARGES" autosearch="off">
</td>
				 <td   style='text-align:left;'  >DISCOUNT<input type="text" name="discount" value="0" min="0" pattern="[0-9.]+" class="form-control input-sm" id="discount" placeholder="DISCOUNT" autosearch="off"></td>
				  <td   style='text-align:left;'  >ACTUAL <input value="<?php print $totalcharges; ?>"  type="text" class="form-control input-sm" name="actualcharges" id="actualcharges" readonly placeholder="ACTUAL CHARGES" autosearch="off"></td>
				  <td style='text-align:center;'  ><br><button type="submit" class="btn-info btn-sm" >SUBMIT</button>
				  </td>
			   <td   style='text-align:right;'  ><br><button type="reset" class="btn-info btn-sm">RESET</button></td>
	 </tr>
	 
 </tbody>
 </table>
  <div class="container">
  <div class="row">
  <div class="col-sm-12">
  </div> 
</div>
</div>  

 
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
