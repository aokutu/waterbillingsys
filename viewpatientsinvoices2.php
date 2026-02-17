<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'FINANCE'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

class  search
{
public $cretaria=null;
public $details=null;

}
$search =new search;
$search->cretaria=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['cretaria']))));
$search->details=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['details']))));
?>
<div id="patientinvoicestable">
	<h3  style="text-align:center;font-weight:bold;text-decoration:underline;" ><?php print $_SESSION['cretaria']; ?> </h3>

<table class="table"    style="text-align:center;font-size:90%;">

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="5%" height="28" valign="top" style='text-align:center;' >NO.</td> 
<td  class="theader"    height="28" valign="top"  style='text-align:left;' >INVOICE #</td>	
		  
		    <td  class="theader"  width="40%"  height="28" valign="top" style='text-align:left;'  >PATIENT NAME</td> 
		
			 <td  class="theader"    height="28" valign="top"  style='text-align:left;' >PATIENT NUMBER</td>
			  <td  class="theader"    height="28" valign="top"  style='text-align:right;' >AMOUNT</td>
			  <td  class="theader"    height="28" valign="top"  style='text-align:right;' >DATE</td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > ACTION </td> </tr>
 		
		
				<?php
			if($search->cretaria=='INSUARANCE')
			{
$x=$connect->query("SELECT invoicerecords.ID,INVOICENUMBER,PAYMODE,PAYMENTREFF,AMOUNT,DISCOUNT,invoicerecords.DATE,TOTALCHARGES,DATE,CASHIER,CLIENTNUMBER,CLIENT FROM invoicerecords,patientsrecord  WHERE invoicerecords.CLIENTNUMBER=patientsrecord.ACCOUNT  AND invoicerecords.INSUARANCE REGEXP '$search->details' ");
			}
else if($search->cretaria=='INSUARANCENUMBER')
			{
$x=$connect->query("SELECT invoicerecords.ID,INVOICENUMBER,PAYMODE,PAYMENTREFF,AMOUNT,DISCOUNT,invoicerecords.DATE,TOTALCHARGES,DATE,CASHIER,CLIENTNUMBER,CLIENT FROM invoicerecords,patientsrecord  WHERE invoicerecords.CLIENTNUMBER=patientsrecord.ACCOUNT  AND invoicerecords.INSUARANCEREFF REGEXP   '4664' ");
			}
else if($search->cretaria=='PATIENTNUMBER')
			{
$x=$connect->query("SELECT invoicerecords.ID,INVOICENUMBER,PAYMODE,PAYMENTREFF,AMOUNT,DISCOUNT,invoicerecords.DATE,TOTALCHARGES,DATE,CASHIER,CLIENTNUMBER,CLIENT FROM invoicerecords,patientsrecord  WHERE invoicerecords.CLIENTNUMBER=patientsrecord.ACCOUNT  AND invoicerecords.CLIENTNUMBER  REGEXP '$search->details' ");
			}
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td> 
 <td   style='text-align:left;'  >
 <?php print $data->INVOICENUMBER; ?>
 </td>				
			    <td   width='40%' style='text-align:left;'  ><?php print $data->CLIENT; ?></td>
	<td   style='text-align:left;'  ><?php print $data->CLIENTNUMBER; ?></td>			
			   <td   style='text-align:right;'  ><?php print number_format($data->TOTALCHARGES,2); ?></td>
			   <td   style='text-align:right;'  ><?php print $data->DATE; ?></td>
				            <td style='text-align:center;'  >
							<a   href="reprintpatientinvoice.php?invoicenumber=<?php print $data->INVOICENUMBER; ?>"   ><i class="fas fa-print" style="font-size:160%;"></i></a>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a   href="deletepatientinvoice.php?invoicenumber=<?php print $data->INVOICENUMBER; ?>"  onclick="return confirm('DELETE INVOICE ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>
	 </tr>
<?php }	?>

				<?php
$x=$connect->query("SELECT SUM(TOTALCHARGES) AS TTL  FROM invoicerecords  WHERE invoicerecords.DATE >='$search->startdate' AND invoicerecords.DATE <='$search->enddate' ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' > </td> 
 <td   style='text-align:left;'  > </td>				
			    <td   width='40%' style='text-align:left;'  >TOTAL</td>
	<td   style='text-align:left;'  ></td>			
			   <td   style='text-align:right;'  ><?php print number_format($data->TTL,2); ?></td>
			   <td   style='text-align:left;'  ></td>	
				            <td style='text-align:center;'  > </td>
	 </tr>
<?php }	?>



</tbody>
 </table>
                      
	</div>				  
 