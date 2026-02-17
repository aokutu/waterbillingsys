<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ include_once("accessdenied2.php");exit;}
?>

<style type="text/css">

button > a{ font-size:150%;}
  </style>
<html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >HADDASSAH SOFTWARE</title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<style type="text/css">
			body {text-transform:uppercase;}
			 #inputs{ background-color:#87CEEB; border-style:; border-radius:2%; margin-left:5%; margin-right:5%; text-transform:uppercase;}
			 #header{ background-color: #87CEEB; height:60px;  border-radius:2%; text-align:center  }
			</style>
	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
  
	<SCRIPT type="text/javascript">

    window.history.forward();

    function noBack() { window.history.forward(); }

</SCRIPT>
<script type="text/javascript"> 
$(document).ready(function(){
$('[data-toggle="popover"]').popover(); 
 setInterval(function(){
$("#clock").load('review.php #clock')
}, 1000);


});
</script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>
</head>
<body   onLoad="noBackx();" ><hr>
<div class="container" id="header">
  <div class="row">
  <div class="col-sm-3" ></div>
    <div class="col-sm-6"  >
<h4 align="center" >ACCESS DENIED !</h4><div  class="clock"   id="clock"   ></div>
	</div>
	 <div class="col-sm-3" ></div>
	</div>
	</div><br>
<div  id="inputs"> 
 
 <div class="container">
  <div class="row">
  <div class="col-sm-1" ></div>
    <div class="col-sm-10" id="" ><br>
	 <div class="container">
	<div class="container">
  <div class="row">
  <div class="col-sm-3" > 
  
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#" id="administrator">ADMINISTRATOR </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a   href="users.php" target= "_parent" >USER ADMIN </a></li><li><a   href="companyadmin.php" target= "_parent" >COMPANY ADMIN </a></li><li><a   href="zoneadmin.php" target= "_parent" >ZONE ADMIN </a></li>  
        <li><a href="backupdatabase.php">BACKUP DATABASE</a></li> 
		 <li><a  href="trail.php" target= "_parent" >AUDIT TRAIL </a></li><li><a  href="processautomation.php" target= "_blank" >TASK AUTOMATION</a></li> 
      </ul> 
   </div> 
 </div>
  <br><br>
 
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#">REPORTS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="accountstatus.php">ACC CURRENT STATUS </a></li><li><a href="watersalereport.php">WATER SALE REPORT </a></li> 
         
		 <li><a href="ministatement.php">MINISTATEMENT</a></li>  
      </ul> 
   </div> 
 </div>

 </div>
	<div class="col-sm-3" >
	
	 <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#">BILLING &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
      <li><a   href="billing.php" target= "_parent" >NEW BILL</a></li> 		
        <li><a href="viewbill.php">BILLS SUMMARY</a></li> 
		  <li><a href="billsreport.php">BILLS REPORT</a></li> <li><a href="nonwaterbillsreport.php">NON WATER BILLS</a></li><li><a href="clientquotations.php">QUOTATIONS</a></li><li><a href="archives.php">IMAGE ARCHIVES</a></li> 
		 <li><a href="ministatement.php">MINISTATEMENT</a></li> 
		 <li><a href="statements.php">FULL STATEMENT</a></li><li><a href="refunddeposit.php">REFUND DEPOSIT</a></li><li><a href="archivedstatements.php">ARCHIVED STATEMENT</a></li> 
      </ul> 
   </div> 
 </div>
  <br><br>
   	 <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown"> 
       <a href="#"  title="DEBT MNG" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >DEBT MNG&nbsp;&nbsp;&nbsp;&nbsp;<img src ="ICON16.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	   <li><a   href="debtmanagement.php" target= "_parent" > DEBT MANAGEMENT</a></li>
         </ul> 
   </div> 
 </div>
 
  <br><br>
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#">PAYMENT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="paymentcodes.php">PAYMENT CODES </a></li><li><a href="bankstatements.php">PAYMENT SLIPS </a></li> 
        <li><a href="backuprestore.php">UPLOAD SLIPS</a></li><li><a href="linkslips.php">LINK SLIPS</a></li><li><a href="paynotifications.php">PAY NOTIFICATIONS</a></li><li><a href="reciepts.php">RECEIPTS</a></li><li><a href="unprocessedslips.php">UNPROCESSED SLIPS</a></li> 
		 
      </ul> 
   </div> 
 </div>
  <br><br>
   <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="OCCURANCE " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   JOB TICKETS&nbsp;&nbsp;&nbsp;<img src ="ICON23.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a   href="clienttickets.php" target= "_parent" >JOB  TICKETS </a></li> 
		  
        </ul> 
   </div> 
 </div>
 
 <br><br>
     <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="INVENTORY " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   INVENTORY &nbsp;<img src ="ICON25.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="itemcategory.php">ITEM CATEGORIES</a></li><li><a href="suppliers.php">SUPPLIERS</a></li><li><a href="inventory.php">INVENTORY</a></li><li><a href="stockadjustment.php">STOCK ADJUSTMENT</a></li><li><a href="purchasesreq.php">PURCHASES REQ</a></li><li><a href="quotationrequest.php">REQUEST FOR QUOTATION</a></li><li><a href="lpos.php">L.P.O'S & L.S.O'S</a></li><li><a href="purchases.php">GOODS RECIEVED</a></li><li><a href="storesissuenotes.php">STORES ISSUE</a></li><li><a href="gatepass.php">GATE PASS</a></li><li><a href="stockmovementreport.php">STOCK CARD</a></li>
		 
        </ul> 
   </div> 
 </div>
 <br><br>
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="REPAIR & MANTAINANCE " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   REPAIR & MANTAINANC&nbsp;&nbsp;&nbsp;<img src ="ICON15.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="mantainance.php">REPAIR & MANTAINANC</a></li> 
		 
        </ul> 
   </div> 
 </div>
 <br><br>
  <?php 
  $x="SELECT  DATEDIFF(LOCKDATE,CURRENT_DATE) AS ddays FROM CLOCK";
  $x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$days=$y['ddays']; print '<div id="trialdays"  class="btn btn-default">TRIAL DAYS:'.$days.'</div>';}}
  
  ?>
	</div>
	<div class="col-sm-3" >
	
	 <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#">REGISTRY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="newaccount.php" target="_parent" >NEW ACCOUNT </a></li> 
        <li><a  href="accountedit.php" target="_parent" >EDIT ACCOUNT</a></li>
		<li><a  href="accountedit2.php" target="_parent" >MULTI EDIT</a></li><li><a  href="accounttransfer.php" target="_parent" >ACCOUNT NUMBER CHANGE</a></li>
		
		<li><a  href="accountsregistry.php" target="_parent" >VIEW ACCOUNTS</a></li><li><a  href="accountstransfer.php" target="_parent" >ACCOUNTS TRANSFER</a></li><li><a  href="advancedsearch.php" target="_parent" >ADVANCED REG SEARCH</a></li><li><a  href="accountstrail.php" target="_parent" > ACCOUNTS TRAIL</a></li>
      </ul> 
   </div> 
 </div>
 
 
 <br><br>
 
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#">SMS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="sms.php" target= "_parent">BILLING SMS/EMAILS </a></li> <li><a href="custormsms.php" target= "_parent">CUSTORM  SMS/EMAILS </a></li><li><a href="sendsmsemail.php" target= "_blank">SEND  SMS/EMAILS </a></li><li><a href="balinquery.php" target= "_parent">BALANCE  INQUERY  </a></li><li><a href="viewsms.php" target= "_parent">VIEW  SMS/EMAILS </a></li> 
		  <li><a href="contacts.php" target= "_parent">EDIT CONTACTS </a></li> 
      </ul> 
   </div> 
 </div>
<br><br><br>
 
  <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="METER REGISTRY" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   METER REGISTRY<img src ="ICON24.png"  width="16%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="meterregistry.php" target= "_parent">METER REGISTRY </a></li><li><a href="unregisteredmeterregistry.php" target= "_parent">UNREGISTERED ACCOUNTS  </a></li><li><a href="metertrail.php" target= "_parent">METER TRAIL </a></li>  
      </ul> 
   </div> 
 </div>
 <br><br>   <div class="btn-group"> 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="DEBT MANAGEMENT" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   DEBT MANAGEMENT<img src ="ICON20.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="debtregistry.php" target= "_parent">DEBT MANAGEMENT </a></li>	
      </ul> 
   </div> 
 </div>
 <br><br>
 
 <form action="exit.php" method="post" target="_parent"  onClick="noBack();">
 <input name="button3" type="submit" value="LOG OUT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" class="btn-info btn-lg"   id="logout"/>
</form>
 
 
	</div>
	<div class="col-sm-3" ></div>
  </div></div>
	 

	 
	 
	 </div>
	
<br> 
</div>
	 <div class="col-sm-1" ></div>
	</div>
	</div>

</div><br>
<div class="container" id="header">
  <div class="row">
  <div class="col-sm-3" ></div>
    <div class="col-sm-6"  >
	<marquee><h4  align="center">LAWASCO SOFTWARE </h4></marquee>
	</div>
	 <div class="col-sm-3" ></div>
	</div>
	</div><hr>
</body>
</html>
