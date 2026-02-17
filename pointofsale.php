<?php 

@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="POINT OF SALE";
$x = $connect ->query(" SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights'");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

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

@media print {
    /* Hide the last column in the printed version */
  .unprint {
        display: none;
    }
}


	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#searchpatient").modal();

$("#searchpatient").submit(function(){
$('#prepostmessage').modal('show');
$.post( "searchpatientsession2.php",
$("#searchpatient").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$("#postpayment").load("pointofsale.php #totalbill");
$('#prepostmessage').modal('hide');
return false;
});

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
 
 var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});


$('[data-toggle="popover"]').popover(); 
//$("#registrytable").load("registry.php #accountstable");	
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

  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="NEW  DETAILS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#searchpatient"><i class="fa-solid fa-magnifying-glass" style="font-size:200%;" ></i>SEARCH</button></a>
 <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>



  <form class="modal fade" id="searchpatient" role="dialog" method="get"   action="searchpatientsession2.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">  <i class="fas fa-times"  style="font-size:160%;" data-dismiss="modal" ></i>
<div class="modal-header" style="text-align:center;">MEDICAL REPORT<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input style='text-transform:uppercase' required list="patientnmberslist" name="patientnumber" type="text"  pattern="[0-9 ]+"  title="PATIENT NUMBER"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>

<datalist id="patientnmberslist" >
<?php 
$x=$connect->query("SELECT PATIENTNUMBER,CLIENT  FROM pendingsales,patientsrecord WHERE ACCOUNT=PATIENTNUMBER AND  STATUS='ISSUED'  GROUP  BY   PATIENTNUMBER ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->PATIENTNUMBER; ?> " >  <?php print $data->CLIENT; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
 </div>
  


<div class="col-sm-4">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
</div></div>

  
  </div></div></div></div>
  </form>
<form method="post" action="processbill2.php" id="postpayment" >
 <div id="totalbill" >
<h3 style="font-weight:bold;text-align:center;text-decoration:underline;">
REFF:<?php 
print $_SESSION['patientnumber'];
$x=$connect->query("SELECT  CLIENT,CLASS FROM patientsrecord WHERE ACCOUNT='".$_SESSION['patientnumber']."'");
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
						<a   href="deletebilleditem2.php?deleteitemid=<?php print $data->ID; ?>"  onclick="return confirm('RETURN ITEM ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>
	 </tr>
<?php } ?> 

<?php

$x=$connect->query(" SELECT PRICE,COPRATEPRICE FROM services WHERE DETAILS REGEXP 'BED CHARGES' ");
while ($data = $x->fetch_object())
{
if(($patientclass=='WALK IN') OR ($patientclass=='CASH')){$bedcharges=$data->PRICE;}
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
 
<tr  class="unprint" style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' > </td>  
			    
	<?php 
	if($patientclass=='INSUARANCE')
	{
		?>
		<td    style='text-align:left;'  >
		 <label><input type="radio" checked onclick="$('#cashpay,#mpesapay,#eft,#paymentreffnumber').prop('disabled', true);$('#paymentreffnumber').val('')"  id="invoice"  name="document" value="INVOICE">INVOICE</label> 
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
				  <td style='text-align:center;'  >
		</td>
			   <td   style='text-align:right;'  >
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
PAY REFF <input type="text" class="form-control input-sm" name="paymentreffnumber" id="paymentreffnumber"   placeholder="PAY REFF NUMBER" autosearch="off">
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
				  <td style='text-align:center;'  >
				  				DATE<input type="datetime-local" name="billdate" class="form-control input-sm" required placeholder="DATE" autosearch="off">
				  </td>
			   <td   style='text-align:right;'  >
			   </td>
	 </tr>

 <tr  class="unprint" style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' > </td>  
			    <td    style='text-align:left;'  >   
</td>
				 <td   style='text-align:left;'  >
				 </td>
				  <td   style='text-align:left;'  >
				  </td>
				  <td style='text-align:center;'  >
				  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
				  </td>
			   <td   style='text-align:right;'  >
			  <button type="reset" class="btn-info btn-sm">RESET</button>
			   </td>
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
