<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
include_once("loggedstatus.php");
include_once("password.php");
@$depositdate1=$_SESSION['date1'];@$depositdate2=$_SESSION['date2'];
if($depositdate1 == NULL ){$depositdate1=date('Y-m-d');}

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'VIEW SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
  else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLING SOFTWARES</title>
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
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}    .dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}

#newslip,#uploads{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

@media print {
  a[href]:after {
    content: none !important;
  }
}
table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:left;
  } 	 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){  
$('[data-toggle="popover"]').popover(); 
  $('#acrange').modal('show');
     $("#account2").click(function() {
     var account=$("#account1").val();
	 $("#account2").val(account);
	 });


$("#acrange").submit(function(){$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#acrange").serialize(),
function(data){
$("#content").load("message.php #content");$("#delslip").load("bankstatements.php #slipstable"); $('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})


$( '#checkall' ).click( function () {
   $(':checkbox').each(function() {
          this.checked = true;
      });
  })
  
    $( '#checknone' ).click( function () {
   $(':checkbox').each(function() {
          this.checked = false;
      });
  })
  
  $("#delslip").submit(function()
{
    
    var x=confirm("DELETE ?");   
	 if(x ==false){return false; }  
	$('#prepostmessage').modal('show');
$.post( "delslip.php",
$("#delslip").serialize(),
function(data){$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');$("#delslip").load("bankstatements.php #slipstable");


/// $("#delslip").load("bankstatements.php #slipstable");
});  return false; 

})

$("#newslip").submit(function()
{$('#prepostmessage').modal('show');
$.post( "newtransactionslip.php",
$("#newslip").serialize(),
function(data){ 
$("#content").load("message.php #content");
$("#delslip").load("bankstatements.php #slipstable");
$("#transactiondetails").load("bankstatements.php #transactioncode");
$('#newslip').modal('hide');  $('#prepostmessage').modal('hide'); $('#message').modal('show'); 
});  return false;
})






$("#newslip").submit(function()
{$('#prepostmessage').modal('show');
$.post( "newtransactionslip.php",
$("#newslip").serialize(),
function(data){ 
$("#content").load("message.php #content");
$("#delslip").load("bankstatements.php #slipstable");
$("#transactiondetails").load("bankstatements.php #transactioncode");
$('#newslip').modal('hide');  $('#prepostmessage').modal('hide'); $('#message').modal('show'); 
});  return false;
})
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
    <script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readCountry.php",
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

<script>
$(document).ready(function(){
	$("#autosearch1").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autosearch.php",
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
<div class="container">

 <div class="container">
  <div class="row">
  <div class="col-sm-12">
  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SET  RANGE" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#acrange">AC-DATE RANGE</button></a>
  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW  BANK SLIP" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newslip">NEW  BANK  SLIP</button></a>
 
    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW  BANK/MPESA SLIP" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#uploads">UPLOADS</button></a>
   <button class="btn-info btn-sm" onclick="window.print()">PRINT</button><br />
   <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  </div></div></div>
  
   
    <!-- Modal -->
  </div>

  
     <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
    
   <div class="modal fade" id="uploads"  role="dialog"  > 
   
   <form  action="bankslipsupload.php" enctype="multipart/form-data" method="post"  >
  
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h2>SELECT  TRANSACTION FILES </h2></div></div>
  <div class="container">
    <div class="row">
  <div class="col-sm-8">
     EQUITY SLIPS
<a data-html="true" href="#" title="Comma Delimeter File " data-toggle="popover" data-trigger="hover" data-content="DATE|BLANK|ACCOUNT|TR-REFF|AMOUNT" data-placement="bottom">
     <input type="file" name="bankslips" class="form-control input-sm"   id="fileToUpload">
     </a>
  </div>
    <div class="col-sm-4" ></div>
  
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal"  class="btn-info btn-sm">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
     <form  action="bankslipsupload2.php" enctype="multipart/form-data" method="post"  >
  
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h2>SELECT  TRANSACTION FILES </h2></div></div>
  <div class="container">
    <div class="row">
  <div class="col-sm-8">
 MPESA SLIP
<a data-html="true" href="#" title="Comma Delimeter File " data-toggle="popover" data-trigger="hover" data-content="TR-REFF|DATE|BLANK|BLANK|AMOUNT|ACCOUNT" data-placement="bottom">
<input type="file" name="mpesaslips" class="form-control input-sm"   id="fileToUpload">
</a>
  
  </div>
    <div class="col-sm-4" ></div>
  
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal"  class="btn-info btn-sm">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>

     <form  action="bankslipsupload3.php" enctype="multipart/form-data" method="post"  >
  
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h2>SELECT  TRANSACTION FILES </h2></div></div>
  <div class="container">
    <div class="row">
  <div class="col-sm-8">
 KCB SLIP
 <a data-html="true" href="#" title="Comma Delimeter File " data-toggle="popover" data-trigger="hover" data-content="DATE|ACCOUNT|AMOUNT|TR-REFF" data-placement="bottom">
  <input type="file" name="mpesaslips" class="form-control input-sm"   id="fileToUpload">
  </a>
  
  </div>
    <div class="col-sm-4" ></div>
  
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal"  class="btn-info btn-sm">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
   
   </div> 
<form class="modal fade" id="newslip" role="dialog"    action="newtransactionslip.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  
  <div class="frmSearch">ACCOUNT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input  style='text-transform:uppercase' name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>
<div id="suggesstion-box"></div>
</div>
<br>
PAY POINT
<select class="form-control"   required= "on"  name="paypoint"  >
			   <option value="">PAY POINT </option>
			   <option value="EQUITY">EQUITY DEPOSIT </option>
			   <option value="MPESA"> MPESA </option>
			   <option value="KCB"> KCB DEPOSIT </option>
			  
			   
			   
		
			  </select>
<br>
TRANSACTION CODE
<div id="transactiondetails">
<input type="text"   class="form-control input-sm" name="transactioncode" id="transactioncode" pattern="[0-9A-Za-z -]+"  title="ENTER CAPITAL ALPHA NUMERIC "  style='text-transform:uppercase'  required="on"  placeholder="TRANSACTION CODE" autosearch="off">
</div><br>
DEPOSIT DATE:<input type="date" class="form-control input-sm" name="postdate" id="depositdate"  required="on"  autosearch="off"><br />

<br>
<table class="table" width="70%"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr  style='text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;' >
		  <td  class="theader"   height="28" valign="top" >CODE</td> 
		   <td  class="theader" width="40%"  height="28" valign="top" >ITEM </td> 
		    <td  class="theader"  height="28" valign="top" >AMOUNT </td> 
		   		  </td> 
		 			  
          </tr>
        </thead>
        <tbody>
        <?php
	 $x="SELECT * FROM paymentcode ORDER BY CODE  ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata' style='text-align:left;font-weight:bold;border: 1px solid black; border-collapse: collapse;'>
	 <td >".$y['code']."</td>
				<td width='40%'>".$y['name']."</td>
			         
			
			  <td><input width='20px' name='code[".$y['code']."]' type='text' autocomplete ='off' placeholder='ENTER AMOUNT'  pattern='[0-9.]+'    class='form-control input-sm'> </td>    
				
           </tr>";
		 }
		 
		 }   		 
		?>
		
		<tr class='filterdata'>
		<td> </td> 
				<td width='40%'><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button></td>
			         
			
			  <td> </td>    
				
           </tr>


        </tbody>
    </table>
	<br>
</div>


<div  class="col-sm-4" ></div></div></div>
 </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
  
   <form class="modal fade" id="acrange" role="dialog" method="post"  action="depositslipsrange.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
    <input autocomplete="off" list="accountslist" type="text" name="account1"  value="<?php print $_SESSION['account1'];?>"   autocomplete   id="account1"  class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase'  placeholder="ENTER   MIN ACC NUMBER" required="on" />
        </div><br>
		<div>
    <input  autocomplete="off" list="accountslist"  type="text" name="account2"  value="<?php print $_SESSION['account2'];?>"   autocomplete     id="account2"   class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase' placeholder="ENTER   MAX ACC NUMBER" required="on"  />
        </div><br>
		
		
		
		<datalist id="accountslist">
	<?php 
$x="SELECT DISTINCT ACCOUNT,CLIENT FROM $accountstable     ORDER BY ACCOUNT    ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['ACCOUNT']."'>".$y['ACCOUNT']."  ".$y['CLIENT']."</option>";	
		}}

?> 
 </datalist>
 <br />
FROM<input type="date" class="form-control input-sm" name="date1" id="acc1"  autosearch="off"><br />
TO<input type="date" class="form-control input-sm"   name="date2" id="acc2"  autosearch="off"><br />
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
  
  
  <form id="delslip" method="post" action="delslip.php">
<div  id="slipstable">

<h4   style="text-align:center"><strong>PAYMENT DEPOSITS  FOR ACC <?php print $account1 ;?> TO <?php print $account2;?> AS  FROM  <?php print   $depositdate1; ?> TO <?php print  $depositdate2; ?></strong></h4>
<table class="table" style ="text-align:center;"  >
	  
        <!--DWLayoutTable-->
        <thead style ="text-align:center;" >
          
        </thead>
        <tbody style ="text-align:center;" >
            <tr>
		   <td  class="theader" style='text-align:left;' width="4%" height="28" valign="top" >REFF </td> 
		    <td  class="theader"  height="28" valign="top" >PAYPOINT </td> 
		   		   <td  class="theader"  height="28" valign="top" >ACCOUNT </td>     
		    <td  class="theader"  height="28"   width="25%" valign="top" >NAME</td> 
<td  class="theader"  height="28" valign="top" >NUMBER CODE</td>					
			 <td  class="theader"  style='text-align:center;'   height="28" valign="top" >TR REFF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>	
<td  class="theader" style='text-align:center;'   height="28" valign="top" >AMOUNT &nbsp;&nbsp;&nbsp;&nbsp;</td>				 
			  <td  class="theader"  style='text-align:left;'   height="28" valign="top" >POST DATE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> 
			  
			    <td  class="theader" style='text-align:left;'   height="28" valign="top" >EDIT/DEL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> 
			     <td  class="theader" style='text-align:left;'  height="28" valign="top" >DEL</td> 
		 			  
          </tr>
        <?php
	 $x="select  $accountstable.client,$wateraccountstable.*,$wateraccountstable.id as  identity  FROM $wateraccountstable,$accountstable  where $accountstable.account=$wateraccountstable.account AND  $wateraccountstable.depositdate >='$depositdate1'   AND  $wateraccountstable.depositdate <='$depositdate2'   AND $accountstable.account >='$account1'  AND $accountstable.account  <='$account2'  ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr  class='filterdata' style ='text-align:center;'>
				<td  width='4%' style='text-align:left;'  >".$y['identity']."</td>
			<td>".$y['paypoint']."</td>				
              <td>".$y['account']."</td>  
			    <td  width='25%' >".$y['client']."</td>
				  <td>".$y['code']."</td>
				  
			   <td  style='text-align:center;'  >".$y['transaction']."</td>
			    <td>".number_format($y['credit'],2)."</td>
			   <td   style='text-align:center;' >".$y['depositdate']."</td>
			
			  <td style ='text-align:left;' >";?>
			  <a   href="editpayslip.php?id=<?php print $y['id'];?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
EDIT </a> <a   href="deletepay.php?id=<?php print $y['id'];?>" >
DEL
                       </a> </td>    
				
           <?php print " <td><input name='del[]'  type='checkbox' value='".$y['id']."'  class='form-control input-sm'></td>  </tr>";
		 }
		 
		 }   
		 
	 $x="select  SUM(credit),COUNT($wateraccountstable.ID) AS TTLACS  FROM $wateraccountstable,$accountstable  where $accountstable.account=$wateraccountstable.account AND  $wateraccountstable.depositdate >='$depositdate1'   AND  $wateraccountstable.depositdate <='$depositdate2'   AND $accountstable.account >='$account1'  AND $accountstable.account  <='$account2'   ";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	 $ttl=number_format($y['SUM(credit)'],2);$ttlacs=$y['TTLACS'];
		 }
		 
		 }
	?>
		
			  <tr  class="btn-info btn-sm" ><td width='4%' valign="top"></td>
		  
		  <td  class="theader"    valign="top">TOTAL ACC</td>
<td  valign="top"><?php print $ttlacs;?></td>		  
		  <td  width="25%" valign="top"></td>
		   
			
			<td   valign="top">TOTAL AMNT </td>	<td  valign="top"> </td>
				 
				  <td   valign="top"><?php print $ttl;?> </td>
				 
				  
		 <td  valign="top"><button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button> </td>
		  <td  valign="top"></td>
				  <td  valign="top"><button type="reset" class="btn-info btn-sm">RESET</button></td>		
		  </tr>
		  
		  
		 
	
        </tbody>
    </table>
<br />

</div>
</form>

<form class="modal fade" id="acrange" role="dialog" method="post"  action="depositslipsrange.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-10">
<input type="text" class="form-control input-sm" name="acc1" id="acc1" placeholder="MIN ACCOUNT" autosearch="off"><br />
<input type="text" class="form-control input-sm"   name="acc2" id="acc2" placeholder="MAX ACCOUNT" autosearch="off"><br />
FROM<input type="date" class="form-control input-sm" name="date1" id="acc1"  autosearch="off"><br />
TO<input type="date" class="form-control input-sm"   name="date2" id="acc2"  autosearch="off"><br />

<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-2"></div></div></div></div></div></div></div>
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

