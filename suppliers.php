<?php header("LOCATION:accessdenied4.php");exit;
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP   'INVENTORY REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$x="UPDATE SUPPLIERS SET BALANCE=0,CREDIT=0,DEBIT=0 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
 ////////////////////////////////
$x="CREATE TEMPORARY TABLE x      SELECT SUPPLIER, SUM(PRICE) AS TheSum  FROM STOCKIN   GROUP BY  SUPPLIER ;";
mysqli_query($connect,$x)or die(mysqli_error($connect));		

$x="UPDATE SUPPLIERS  JOIN x ON (SUPPLIERS.SUPPLIER = x.SUPPLIER)
    SET SUPPLIERS.CREDIT = x.TheSum
    WHERE SUPPLIERS.SUPPLIER = x.SUPPLIER";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DROP TEMPORARY TABLE x";mysqli_query($connect,$x)or die(mysqli_error($connect));
////////////////////////////////////////////////

   /////////////////////////////////
$x="CREATE TEMPORARY TABLE x      SELECT SUPPLIER, SUM(AMOUNT) AS TheSum  FROM SUPPLIERPAYMENT   GROUP BY  SUPPLIER ;";
mysqli_query($connect,$x)or die(mysqli_error($connect));		

$x="UPDATE SUPPLIERS  JOIN x ON (SUPPLIERS.SUPPLIER = x.SUPPLIER)
    SET SUPPLIERS.DEBIT = x.TheSum
    WHERE SUPPLIERS.SUPPLIER = x.SUPPLIER";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DROP TEMPORARY TABLE x";mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="UPDATE SUPPLIERS  TU, SUPPLIERS TS  SET TU.BALANCE=TS.CREDIT-TS.DEBIT WHERE TU.SUPPLIER=TS.SUPPLIER ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

////////////////////////////////////////////////

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
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
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
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 

$("#newsupplier").submit(function(){	
	
	$('#prepostmessage').modal('show');
$.post( "newsupplier.php",
$("#newsupplier").serialize(),
function(data){
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
$("#deletecompany").load("suppliers.php #zones"); 
return false;});
return false;
})

$("#payment").submit(function(){	
	var action="ENTER NEW PAYMENT ?";
	 var x=confirm(action);   
	 if(x ==false){return false; }
	$('#prepostmessage').modal('show');
$.post( "newpayment.php",
$("#payment").serialize(),
function(data){
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
$("#deletecompany").load("suppliers.php #zones"); 
return false;});
return false;
})


$("#paymentregistry").submit(function(){
		var action='GENERATE  REPORT ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#paymentregistry").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deletecompany").load("paymentregistry.php #payment");

$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})
 
 
 $("#cashflow").submit(function(){
		var action='GENERATE  REPORT ?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
$.post( "sessionregistry.php",
$("#cashflow").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#deletecompany").load("cashflowstatement.php #cashflow");

$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})
 
$("#deletecompany").submit(function(){
	var x=confirm("DELETE ?");   
	 if(x ==false){return false; } 	
	$('#prepostmessage').modal('show');
$.post( "deletesuppliers.php",
$("#deletecompany").serialize(),
function(data){
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
$("#deletecompany").load("suppliers.php #zones"); 
return false;});
return false;
})

 })
  
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="Click to add new company" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newsupplier"> NEW SUPPLIER</button> </a>
        <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW  SUPPLIES PAYMENT" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#payment">SUPPLIES PAYMENT</button> </a>
		<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content=" PAYMENT REGISTRY " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#paymentregistry">PAYMENT REGISTRY</button> </a>
        <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CASH FLOW " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#cashflow">CASH FLOW</button> </a>
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
  <form class="modal fade" id="newsupplier" role="dialog" method="post" action="newsupplier.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header" ><h1  style="text-align:center;">ENTER COMPANY NAME</h1></div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >COMPANY NAME
	<input type="text" class="form-control input-sm"  pattern="[A-Z,a-z0-9 -.]+" title="INVALID ENTRIES"  name="companyname" style='text-transform:uppercase' required="on" autocomplete="off" />
	<br> BOX ADDRESS
		<input type="text" style="text-transform:uppercase" class="form-control input-sm"  pattern="[A-Z,a-z0-9 -.]+" title="INVALID ENTRIES" name="companyaddress" style='text-transform:uppercase' required="on" autocomplete="off" />
	 	<br> PHONE
		<input type="text"  style="text-transform:uppercase"  class="form-control input-sm"  pattern="[0-9+]{13}" title="INVALID ENTRIES" name="phonenumber" style='text-transform:uppercase'  autocomplete="off" />
		<br>
		EMAIL:
		<input type="email" class="form-control input-sm"  name="email"   autocomplete="off" />
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
  
  
  <form class="modal fade" id="paymentregistry" method="post" action="paymentregistry.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>SUPPIERS PAYMENTS  REGISTRY</h4>
   FROM
    <input type="date" class="form-control input-sm"     name="date1"  required   /><br>
	TO <input type="date" class="form-control input-sm"     name="date2"  required   /><br>
   <br>
   SELECT SUPPIER
   <select class="form-control input-sm"  name="supplier" id="supplier" >
<option value=''>ALL SUPPLIERS</option>
<?php 
$x="  SELECT DISTINCT SUPPLIER FROM SUPPLIERS     ORDER BY SUPPLIER ";
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
	<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>
  
  
  <form class="modal fade" id="cashflow" method="post" action="cashflow.php"   role="dialog"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
<div class="container">
  <div class="row">

   <div class="col-sm-8">
   <h4>CASH FLOW STATEMENTS</h4>
   FROM
    <input type="date" class="form-control input-sm"     name="date1"  required   /><br>
	TO <input type="date" class="form-control input-sm"     name="date2"  required   /><br>
   <br>
   SELECT SUPPIER
   <select class="form-control input-sm"  name="supplier" required  id="supplier" >
<option value=''>SELECT  SUPPLIER</option>
<?php 
$x="SELECT DISTINCT SUPPLIER FROM SUPPLIERS ";
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
	<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
   </div>
    <div class="col-sm-4"></div>
  </div></div>
  
  </div></div></div></div>
  </form>
  
    <form class="modal fade" id="payment" role="dialog" method="post" action="newpayment.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ENTER COMPANY NAME</div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >
	SUPPLIER
<select class="form-control input-sm"  name="supplier" id="supplier" required="on" >
	<?php if($_SESSION['supplier'] !=null)
	{print "<option value='".$_SESSION['supplier']."'>".$_SESSION['supplier']."</option>";}
?>
<option value=''>SELECT  SUPPLIERS</option>
<?php 
$x="SELECT SUPPLIER FROM SUPPLIERS    ORDER BY SUPPLIER  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['SUPPLIER']."'>".$y['SUPPLIER']."</option>";	
		}}

?>
    </select>
	
<BR><BR>AMOUNT 
	 	  <input type='text'  pattern='[0-9]+' required title='INVALID ENTRIES' placeholder='AMOUNT ' style='text-transform:uppercase'  autocomplete ='off' class='form-control input-sm'  name='amount'   id='amount' />

	<br>PAYMENT MODE <br>
<label class='checkbox-inline'> 
        <input type='radio' name='paymode'   value='CASH' id='cashpayment'  checked > CASH.
     </label>
	 <label class='checkbox-inline'> 
        <input type='radio' name='paymode'   id='eftpayment' value='E.F.T'  > E.F.T
     </label>
	  <label class='checkbox-inline'> 
        <input type='radio' name='paymode'   id='chequepayment' value='CHEQUE'  > CHEQUE.
     </label>
	 <label class='checkbox-inline'> 
        <input type='radio' name='paymode'   id='mpesapayment' value='MPESA'  > M-PESA.
     </label><BR><BR>PAYMENT REFFERENCE
	 	  <input type='text'  pattern='[0-9A-Za-z -]+' title='INVALID ENTRIES' placeholder='PAYMENT REFFERENCE' style='text-transform:uppercase'  autocomplete ='off' class='form-control input-sm'  name='payrefference'   id='payrefference' />

	</div>
	<div class="col-sm-4"></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>


<form id="deletecompany" method="post" action="deletesuppliers.php">
<div id="zones">
<h4><strong>SUPPLIERS LIST </strong></h4>
 <table   style="font-size:80%;" class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td width='25%' class="theader"    height="21" valign="top" >SUPPLIER	  </td>
			<td  class="theader"    height="21" valign="top" >ADDRESS	  </td>
			<td  class="theader"    height="21" valign="top" >PHONE	  </td>
			<td  width='25%' class="theader"    height="21" valign="top" >EMAIL	  </td>
			<td  class="theader"    height="21" valign="top" >BALANCE	  </td>
		  <td  class="theader"   height="21" valign="top" >DELETE	  </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
	  
	$x="SELECT PHONENUMBER,EMAIL,SUPPLIER,BOXADDRESS,BALANCE  FROM SUPPLIERS  ORDER BY SUPPLIER   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
                <td   width='25%' >".$y['SUPPLIER']."</td>
				  <td>".$y['BOXADDRESS']."</td> <td>".$y['PHONENUMBER']."</td> <td   width='25%'>".$y['EMAIL']."</td>
				    
				<td>".number_format($y['BALANCE'],2)."</td>
              <td ><input name='name[]' type='checkbox' value='".$y['SUPPLIER']."'   class='form-control input-sm'></td> 
		
           </tr>";
		 }
		}
 	$x="SELECT SUM(BALANCE)  FROM SUPPLIERS ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td ></td>  <td ></td> <td ></td> 
                <td>TOTAL</td>
				<td>".number_format($y['SUM(BALANCE)'],2)."</td>
              <td ></td> 
		
           </tr>";
		 }
		 }

	?>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>
</form>
<?php include_once("dashboard3.php"); ?>
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
