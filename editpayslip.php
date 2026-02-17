<?php
session_start();
include_once("password.php");
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
@$depositdate1=$_SESSION['depositdate1'];@$depositdate2=$_SESSION['depositdate2'];
if($depositdate1 == NULL ){$depositdate1=date('Y-m-d');}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'EDIT SLIPS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:dashboard.php");exit;}

$id=$_GET['id'];
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

#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

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
})
  
  </script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
    <form method="post" action ="updatepayslip.php" id ="updatepayslip">
 <div class="container">
  <div class="row">
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
      
 <?php 
 $x="SELECT ACCOUNT,PAYPOINT,TRANSACTION,DEPOSITDATE,CODE,CREDIT  FROM $wateraccountstable WHERE ID =$id";
 		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  ?>
  <div class="col-sm-8">  <br>
  <input type="hidden" value ="<?php print $id; ?>" name="id" >
  <div class="frmSearch">ACCOUNT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input  style='text-transform:uppercase'  value ="<?php print $y['ACCOUNT'];?>" name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO." list="accountslist"   required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>



<div id="suggesstion-box"></div>
</div>
<br>
PAY POINT
<select class="form-control"   required= "on"  name="paypoint"  >
    
     <option value ="<?php print $y['PAYPOINT'];?>">PAY POINT <?php print $y['PAYPOINT'];?> </option>
			   <option value="">PAY POINT </option>
			   <option value="KCB">K.C.B DEPOSIT </option>
			   <option value="MPESA"> MPESA </option>
			   <option value="EQUITY">EQUITY </option>
					  </select>
<br>
TRANSACTION CODE
<div id="transactiondetails">
<input type="text"   class="form-control input-sm" name="transactioncode" id="transactioncode" value ="<?php print $y['TRANSACTION'];?>" pattern="[0-9A-Za-z -]+"  title="ENTER CAPITAL ALPHA NUMERIC "  style='text-transform:uppercase'  required="on"  placeholder="TRANSACTION CODE" autosearch="off">
</div><br>
DEPOSIT DATE:<input type="date" class="form-control input-sm" name="postdate" id="depositdate"  required="on"  value ="<?php print $y['DEPOSITDATE'];?>"  autosearch="off"><br />

<br>PAYMENT CODE 
<select class="form-control"   required= "on"  name="code"  >
    
     <option value ="<?php print $y['CODE'];?>">XPAY CODE <?php print $y['CODE'];?> </option>
			  <?php 
$b="SELECT * FROM paymentcode    "  ;
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{
		
		 while ($c=@mysqli_fetch_array($b))
		{ 
	print "<option value='".$c['code']."'>".$c['name']." CODE ".$c['code']." CHARGES ".number_format($c['charges'],2)."</option>";
	}}		   
?>	   
			   
			   
		
			  </select>
	<br>
	AMOUNT <?php print $y['CREDIT'];?>
	 <input type="test" class="form-control input-sm" name="amount" id="amount"  required="on"  value ="<?php print $y['CREDIT'];?>"  autosearch="off">
	 <br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>

</div>
<?php   	}}
 ?>     <br>

<div  class="col-sm-4" ></div></div></div>
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

