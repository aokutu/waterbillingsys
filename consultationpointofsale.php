<?php
@session_start();
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class treatment 
{
public $patientnumber=null;	
}

$treatment =new treatment;
if(isset($_GET['patientnumber'])){$treatment->patientnumber=$_GET['patientnumber'];}
else {$treatment->patientnumber=$_SESSION['patientnumber'];}

?>


  <script type="text/javascript" >
  
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();
$('#treatmentnote').modal('show');  
$("#processbill").load("consultationpointofsale.php #billtable");
//$('#selecteditem').focus();

$("#consultationbilling").submit(function(){
$('#prepostmessage').modal('show');
$.post( "consultationbilling.php",
$("#consultationbilling").serialize(),
function(data){
$("#content").load("message.php #content");
$("#loadprice").load("consultationloadprices.php #itemdetails");
	$("#consultationpostotalamount").load("consultationloadprices.php #totalload");
$("#processbill").load("consultationpointofsale.php #billtable");
$('#prepostmessage').modal('hide'); $('#message').modal('show');

//$('#selecteditem').focus();
$('#quantity').val('');

return false;});


return false;
})


$("#billservice").submit(function(){
$('#prepostmessage').modal('show');
$.post( "bookprocedure2.php",
$("#billservice").serialize(),
function(data){
$("#content").load("message.php #content");
$("#loadprice").load("consultationloadprices.php #itemdetails");
	$("#consultationpostotalamount").load("consultationloadprices.php #totalload");
$("#processbill").load("consultationpointofsale.php #billtable");
$("#pendingproceduresdiv").load("consultation.php #pendingprocedures");
$('#prepostmessage').modal('hide'); $('#message').modal('show');

//$('#selecteditem').focus();
$('#quantity').val('');

return false;});


return false;
})



$("#selecteditemcons").change(function() {
	$('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#selecteditemcons,#patientnumber").serialize(),
function(data){
	$("#loadprice").load("consultationloadprices.php #itemdetails");
	$("#loadbatchnumber").load("consultationloadprices.php #bestbatch");
	});
 $('#prepostmessage').modal('hide');
 return false;
 });
 
 
 $("#consultationselecedquantity").change(function() {
	 
	$('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#consultationbilling").serialize(),
function(data){
	 
$("#loadprice").load("consultationloadprices.php #itemdetails");
$("#consultationpostotalamount").load("consultationloadprices.php #totalload");
 return false;	
	});
 $('#prepostmessage').modal('hide');
 return false;
 });
 
///////////////////////////
$(document).on('change', '#period,#frequency,#dosage', function(event) {
        event.preventDefault();
		if($("#selecteditemcons").val()===""){alert("SELECT DRUG");return false; }
		var dosage =$("#dosage").val();
		var frequency =$("#frequency").val();
		var actualfrequency=null;
		if(frequency=='qd'){actualfrequency=1;}
		else if(frequency=='bid'){actualfrequency=2;}
		else if(frequency=='tid'){actualfrequency=3;}
		else if(frequency=='qid'){actualfrequency=4;}
		else if(frequency=='tid'){actualfrequency=6;}
		else if(frequency=='qhs'){actualfrequency=1;}
		else if(frequency=='q4h'){actualfrequency=6;}
		else if(frequency=='q8h'){actualfrequency=3;}
		else if(frequency=='prn'){actualfrequency=1;}
		var period =$("#period").val();
		$("#consultationselecedquantity").val(period*actualfrequency*dosage);
		
		//////////////
			$('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#consultationbilling").serialize(),
function(data){
	 
$("#loadprice").load("consultationloadprices.php #itemdetails");
$("#consultationpostotalamount").load("consultationloadprices.php #totalload");
 return false;	
	});
 $('#prepostmessage').modal('hide');
		////////////////
		 return false;
        var itemid = $(this).data('itemid');
        var msg = 'DELETE ITEM';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletebilleditem_consultation.php',
                data: {
                    dosage:dosage,
					actualfrequency:actualfrequency,
					period:period
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#processbill").load("consultationpointofsale.php #billtable", function() {
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

////////////////////////////    

$(document).on('click', '.deletebilleditemid', function(event) {
	   
        event.preventDefault();
        var itemid = $(this).data('itemid');
        var msg = 'DELETE ITEM';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletebilleditem_consultation.php',
                data: {
                    itemid: itemid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#processbill").load("consultationpointofsale.php #billtable", function() {
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


 
   $(document).on('click', '.deletebilleditemid', function(event) {
	   
        event.preventDefault();
        var itemid = $(this).data('itemid');
        var msg = 'DELETE ITEM';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletebilleditem_consultation.php',
                data: {
                    itemid: itemid
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#processbill").load("consultationpointofsale.php #billtable", function() {
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
 /* $("#selecteditem").focusout(function() {
	$('#prepostmessage').modal('show');
	$.post("loadprices2.php",
$("#billing").serialize(),
function(data){
	$("#loadprice").load("consultationloadprices.php #itemdetails");
	$("#consultationpostotalamount").load("consultationloadprices.php #totalload");
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
 <form id="consultationbilling"   method="post" action="consultationbilling.php"  >  
<hr class="btn-info btn-sm">

<?php
$x=$connect->query("SELECT ACCOUNT,CLIENT FROM patientsrecord WHERE  ACCOUNT='$treatment->patientnumber' " );
while ($data = $x->fetch_object())
{ 
$client=$data->CLIENT;$patientnumber=$data->ACCOUNT;
?>

  

  
<div class="container">
  <div class="row">
  <div class="col-sm-4">
PATIENT NUMBER
   <input name="patientnumber"  readonly value="<?php print $_SESSION['patientnumber'];?>" list="numberlist" required type="text"  id="patientnumber"  class="form-control input-sm" required placeholder="PATIENT NUMBER" autocomplete="off"><br> 
  
PHAMARCUTICALS<input name="selecteditem" type="text" autofocus id="selecteditemcons" list="details" class="form-control input-sm" required placeholder="SEARCH DETAILS" autocomplete="off">

<div id="loadprice" >
PRICE
<input type="text"  class="form-control input-sm" required placeholder="PRICE" autosearch="off">
</div>


</div>

 <div class="col-sm-4">
  ROUTE  <select class="form-control"   required= "on"  name="route" >
  <option value="">SELECT ROUTE</option>
	 <option value="PO">PO</option>
        <option value="SL">SL </option>
		<option value="PR">PR </option>
		<option value="INH"> INH</option>
		<option value="TOP">TOP </option>
		<option value="TD">TD </option>
		<option value="IV"> IV</option>
		<option value="IM">IM </option>
		<option value="SC">SC</option>
		<option value="IT">IT </option>
			  </select>
DOSAGE<input  style='text-transform:uppercase' name="dosage" id="dosage" type="text" pattern="[0-9 ]+" title="INVALID ENTRIES"  class="form-control input-sm" required placeholder="ENTER DOSAGE " autocomplete="off">
FREQUENCY
<select class="form-control"   required= "on" id="frequency" name="frequency" >
 <option value="">SELECT FREQUENCY</option>
	 <option value="qd">qd</option>
        <option value="bid">bid </option>
		<option value="tid">tid </option>
		<option value="qid">qid</option>
		<option value="q4h">q4h</option>
		<option value="q8h">q8h</option>
		<option value="qhs">qhs</option>
		<option value="prn">prn </option>
		
			  </select>
			  <br>
PERIOD<input name="period" id="period" style='text-transform:uppercase'  type="text" pattern="[0-9 ]+" title="INVALID ENTRIES"  class="form-control input-sm" required placeholder="ENTER PERIOD " autocomplete="off">
<br>
 
 </div>

<div class="col-sm-4">

QNTITY<input type="text" name="selectquantity" readonly  id="consultationselecedquantity" class="form-control input-sm" required placeholder="QNTY" autocomplete="off" >
TOTAL<div id="consultationpostotalamount" >
<input type="text" readonly class="form-control input-sm" required placeholder="AMOUNT" autosearch="off">
</div>

<div id="loadbatchnumber" >
</div>
<br> MEICATION DISPENCED<textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="ENTER" data-toggle="popover" data-trigger="hover" data-content="MEICATION DISPENCED" data-placement="top" placeholder="ENTER MEDICATION DISPENCED " name="treatment"  style="width: 100%; height: 15%" ></textarea>

<button type="submit" class="btn-info btn-sm" >ADD</button><button type="reset" class="btn-info btn-sm">RESET</button>

 


</div>
</div>
</div>
	
	
	
	
<?php }

?>
<br>
<hr class="btn-info btn-sm" >
 </form>
 <form id="billservice" action="post" method="billservice.php">
 <div class="container"  >
  <div class="row">
  <div class="col-sm-4"><input type= "hidden" name= "patientnumber" value= "<?php print $_SESSION['patientnumber'];?>" >SERVICES
  <input name="procedure[]" type="text" required id="selectedservice" list="servicedetails" class="form-control input-sm" required placeholder="SEARCH DETAILS" autocomplete="off">
  </div>
    <div class="col-sm-4">
  FREQUENCY<input name="frequency[]" type="text" required  class="form-control input-sm" required placeholder="ENTER FREQUENCY " autocomplete="off">
	
	</div>
	<div class="col-sm-4"><br> <button type="submit" class="btn-info btn-sm" >ADD</button><button type="reset" class="btn-info btn-sm">RESET</button></div>
  </div>
 </div>
 </form>
<div id="detailsdiv">
<datalist id="details" >
<?php 

$x=$connect->query("SELECT ITEM,QUANTITY FROM inventory WHERE PRICE >0 AND QUANTITY >0 OR COPRATEPRICE >0 AND QUANTITY >0");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ITEM; ?> " > <?php print $data->ITEM.'  QNTY '.$data->QUANTITY; ?></option>	
		
		<?php 	
	
	
}

?>
</datalist>
<datalist id="servicedetails" >
<?php 

$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE FROM services UNION SELECT DETAILS,PRICE,COPRATEPRICE FROM imagingservices");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->DETAILS; ?> " > <?php print $data->DETAILS; ?></option>	
		
		<?php 	
	
	
}

?>
</datalist>
</div>
  <hr class="btn-info btn-sm">
<form method="post" action="processbill2.php" id="processbill" >
 <div id="billtable" >
<h3 style="font-weight:bold;text-align:center;text-decoration:underline;">
REFF:<?php 
print $_SESSION['patientnumber'];
$x=$connect->query("SELECT  CLIENT,CLASS FROM patientsrecord WHERE ACCOUNT='".$_SESSION['patientnumber']."'");
while ($data = $x->fetch_object())
{
print $data->CLASS.'&nbsp;&nbsp;&nbsp;'.$data->CLIENT;	
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
<td  class="theader"    height="28" valign="top"  style='text-align:right;' >UNIT</td>			
			 <td  class="theader"    height="28" valign="top"  style='text-align:right;' >PRICE</td>
			 <td  class="theader"    height="28" valign="top"  style='text-align:right;' >QNTY</td>
			 <td  class="theader"    height="28" valign="top"  style='text-align:right;' >TOTAL</td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > ACTION </td> </tr>
 		
		
				<?php
$x=$connect->query("SELECT DETAILS,PRICE,ID,UNIT,TOTAL,TAXES,GROSSTOTAL,QUANTITY,STATUS,PATIENTNUMBER,DATE  FROM pendingsales WHERE  PATIENTNUMBER= '".$_SESSION['patientnumber']."'  ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td>  
			    <td   width='40%' style='text-align:left;'  ><?php print $data->DETAILS; ?></td>
				 <td   style='text-align:right;'  ><?php print $data->UNIT; ?></td>
				  <td   style='text-align:right;'  ><?php print number_format($data->PRICE,2); ?></td>
				   <td   style='text-align:right;'  ><?php print $data->QUANTITY; ?></td>
			   <td   style='text-align:right;'  ><?php print number_format($data->TOTAL,2); ?></td>
				            <td style='text-align:center;'  >
		
<a  title="<?php print $data->DETAILS;?>" data-toggle="popover" data-trigger="hover" data-content="DELETE " data-placement="bottom" class="deletebilleditemid" data-itemid="<?php print $data->ID; ?>" ><i class="fas fa-trash" style="font-size:160%;"></i></a>

		</td>
	 </tr>
<?php } ?> 

<?php

$x=$connect->query(" SELECT PRICE,COPRATEPRICE FROM services WHERE DETAILS REGEXP 'BED CHARGES' ");
while ($data = $x->fetch_object())
{
if($patientclass=='WALK IN'){$bedcharges=$data->PRICE;}
else {$bedcharges=$data->COPRATEPRICE;}

if($bedcharges==null){$bedcharges=0;}	
	
}
$bed=0;
$x=$connect->query("SELECT (SELECT PRICE FROM services WHERE DETAILS REGEXP 'BED CHARGES')*IFNULL(DATEDIFF(CURRENT_DATE,ADMISSIONDATE),0) AS TTL,IFNULL(DATEDIFF(CURRENT_DATE,ADMISSIONDATE),'NEVER') AS DDYS FROM inpatientsrecord WHERE PATIENTNUMBER= '".$_SESSION['patientnumber']."' AND ADMISSIONDATE <CURRENT_DATE() ");
while ($data = $x->fetch_object())
{
$number+=1;		
$bed=$data->DDYS*$bedcharges;
$_SESSION['bedcharges']=$bed;
?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td>  
			    <td   width='40%' style='text-align:left;'  >BED CHARGES</td>
				 <td   style='text-align:right;'  >DAY</td>
				  <td   style='text-align:right;'  ><input type="hidden" name="bedcharges" value="<?php print $bedcharges; ?>"><?php print number_format($bedcharges,2);?></td>
				   <td   style='text-align:right;'  ><input type="hidden" name="days" value="<?php print $data->DDYS; ?>"> <?php print $data->DDYS; ?></td>
			   <td   style='text-align:right;'  ><?php print number_format($data->DDYS*$bedcharges,2); ?></td>
				            <td style='text-align:center;'  >
			 </td>
	 </tr>
<?php } ?> 

 
 				<?php
$x=$connect->query("SELECT SUM(TOTAL) AS TOTAL  FROM pendingsales  WHERE  PATIENTNUMBER ='".$_SESSION['patientnumber']."' ");
while ($data = $x->fetch_object())
{	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' > </td>  
			    <td   width='40%' style='text-align:left;'  >TOTAL</td>
				 <td   style='text-align:right;'  ></td>
				  <td   style='text-align:right;'  ></td>
				  <td style='text-align:center;'  ></td>
			   <td   style='text-align:right;'  ><?php $totalcharges=$data->TOTAL+$bed; print number_format($totalcharges,2); ?></td>
				            <td style='text-align:center;'  ></td>
	 </tr>
<?php } ?> 	 
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
