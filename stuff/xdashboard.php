<?php
session_start();
include_once("password.php");
?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.accordion {
  background-color: white;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}

/* Custom green background color for patient menu */
     ul {
        background-color: white;
		width: 100%;
		 border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
    }
	ul {
    list-style-type: none;text-align:left;
}


</style>
  <link href=
"bullets.css" 
          rel="stylesheet">
		  
		   <script type="text/javascript" >
  $(document).ready(function(){
      $("#connection1").hide();
      $("#connection2").hide();
function connection()
{
if (navigator.onLine) {
   $("#connection1").show();
    $("#connection2").hide();
} else {
  $("#connection2").show();
    $("#connection1").hide();
}   
setTimeout(connection,5000);    
}
connection();

$("#selectzone").change(function(){
    var x; 
$.post( "zonesearch.php",
$("#selectzone").serialize(),
function(data){alert(data);location.reload();
});


})
  })
  
  </script>
   <!--body  oncontextmenu="return false;" -->
 
</head>
<body>

 <div id="sessiondetails">
                        
                <h3 class="card-title">SELECT ZONE
                    <select class="form-control input-sm" name="loadedzone" id="selectzone" >
<option value=''>SELECT  ZONE</option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}} 

?>


</select></h3>
<?php print $_SESSION['user']." @ ".$_SESSION['zonename'];?>        
                        
   <?php 
  $x="SELECT  DATEDIFF(LOCKDATE,CURRENT_DATE) AS ddays FROM CLOCK";
  $x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$days=$y['ddays']; print '<div id="trialdays"  class="btn btn-default">TRIAL DAYS:'.$days.'</div>';}}
  
  ?>                     
                    </div>

<button class="accordion"><img src ="ICON15.png"  width="5%"  height="5%">
 <figcaption  >ADMINISTRATOR</figcaption>
</figure>
</button>
<div class="panel">
  <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="users.php"  target="right" >USER ADMIN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="companyadmin.php" target="right" >COMPANY ADM</a>
                  <li class="nav-item">
                <a class="nav-link" href="zoneadmin.php"  target="right" >ZONE ADM</a>
            </li>
                 <li class="nav-item">
                <a class="nav-link" href="backupdatabase.php" target="right" >BACKUP DB</a>
            </li>
               <li class="nav-item">
                <a class="nav-link" href="trail.php" target="right">AUDIT TRAIL</a>
            </li>
  </ul>
</div>

<button class="accordion"> <img src ="ICON22.png"  width="5%"  height="5%">
 <figcaption>CLIENTS REG</figcaption></button>
<div class="panel">
<ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="newaccount.php" target="right" >NEW ACCOUNT</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="accountedit.php" target="right">EDIT ACCOUNT</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="accountedit2.php" target="right">MULTI EDIT</a>
            </li>
                <li class="nav-item">
                <a class="nav-link" href="accounttransfer.php" target="right">ACCOUNT NUMBER CHANGE</a>
            </li>
             </li>
               

               <li class="nav-item">
                <a class="nav-link" href="accountsregistry.php" target="right">VIEW ACCOUNTS</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="accountstransfer.php" target="right">ACCOUNTS TRANSFER</a>
            </li>
			  <li class="nav-item">
                <a class="nav-link" href="advancedsearch.php" target="right">ADVANCED REG SEARCH</a>
            </li>
			
                 <li class="nav-item">
                <a class="nav-link" href="accountstrail.php" target="right">ACCOUNTS TRAIL</a>
            </li>
     </ul>
</div>

	  <button class="accordion">
<img src ="ICON24.png"  width="5%"  height="5%">
 <figcaption>METER REG </figcaption>
</button>
<div class="panel">
  <ul class="dropdown-menu"> 
        <li><a href="meterregistry.php" target= "_parent">METER REGISTRY </a></li><li><a href="unregisteredmeterregistry.php" target= "_parent">UNREGISTERED ACCOUNTS  </a></li>
		
		<li><a href="metertrail.php" target= "_parent">METER TRAIL </a></li>
		 
      </ul>   </div>

	  <button class="accordion">
<img src ="ICON24.png"  width="5%"  height="5%">
 <figcaption>WATER PRODUCTION</figcaption>
</button>
<div class="panel">
<ul class="dropdown-menu"> 
        <li><a href="productionbilling.php"   target= "_parent">PRODUCTION METERS</a></li><li><a href="mastermeters.php"   target= "_parent">MASTER METERS </a></li>	
      </ul>   </div>	  
<button class="accordion">
<img src ="ICON1.png"  width="5%"  height="5%">
 <figcaption>BILLING </figcaption>
</button>
<div class="panel">
  <ul class="dropdown-menu"> 
	   <li><a   href="billsrate.php" target= "_parent" > BILL RATES</a></li><li><a   href="printbill2.php" target= "_parent" >MASS  PRINT BILL</a></li><li><a   href="mainbilling.php" target= "_parent" > BILLING</a></li>
      <li><a   href="billing.php" target= "_parent" >MULTI BILLING</a></li>
	<li><a   href="fieldbilling.php" target= "_parent" >FIELED BILLING</a></li> 	  
        <li><a href="viewbill.php">BILLS SUMMARY</a></li> 
		  <li><a href="billsreport.php">BILLS REPORT</a></li> <li><a href="nonwaterbillsreport.php">NON WATER BILLS</a></li><li><a href="clientquotations.php">QUOTATIONS</a></li><li><a href="archives.php">IMAGE ARCHIVES</a></li> 
      </ul> </div>

<button class="accordion"><img src ="ICON20.png"  width="5%"  height="5%">
 <figcaption>PAYMENTS</figcaption></button>
<div class="panel">
 <ul class="dropdown-menu"> 
        <li><a href="paymentcodes.php">PAYMENT CODES </a></li><li><a href="bankstatements.php">PAYMENT SLIPS </a></li> 
        <li><a href="backuprestore.php">UPLOAD SLIPS</a></li><li><a href="linkslips.php">LINK SLIPS</a></li><li><a href="paynotifications.php">PAY NOTIFICATIONS</a></li><li><a href="reciepts.php">RECEIPTS</a></li> 
		 
      </ul> </div>
	  <button class="accordion">
<img src ="SMS.png"  width="5%"  height="5%">
 <figcaption>SMS </figcaption>
</button>
<div class="panel">
   <ul class="dropdown-menu"> 
        <li><a href="sms.php" target= "_parent">BILLING SMS/EMAILS </a></li> <li><a href="custormsms.php" target= "_parent">CUSTORM  SMS/EMAILS </a></li>
		<li><a href="sendsmsemail.php" target= "_blank">SEND  SMS/EMAILS </a></li>
		<li><a href="balinquery.php" target= "_parent">BALANCE  INQUERY </a></li><li><a href="viewsms.php" target= "_parent">VIEW  SMS/EMAILS </a></li> 
		  <li><a href="contacts.php" target= "_parent">EDIT CONTACTS </a></li> 
      </ul>   </div>
<button class="accordion">
<img src ="ICON21.png"  width="5%"  height="5%">
 <figcaption>GEO MAPPING</figcaption>
</button>
<div class="panel">
   <ul class="dropdown-menu"> 
	   
        <li><a href="generatemap.php">GENERATE MAP </a></li><li><a href="mapping2.php">GEO LOCATION </a></li> 
         
      </ul> </div>
	  
	  <button class="accordion">
<img src ="INVENTORY.png"  width="8%"  height="16%">
 <figcaption>INVENTORY </figcaption>
</button>
<div class="panel">
 <ul class="dropdown-menu"> 
        <li><a href="itemcategory.php">ITEM CATEGORIES</a></li><li><a href="suppliers.php">SUPPLIERS</a></li><li><a href="inventory.php">INVENTORY</a></li><li><a href="stockadjustment.php">STOCK ADJUSTMENT</a></li><li><a href="purchasesreq.php">PURCHASES REQ</a></li><li><a href="quotationrequest.php">REQUEST FOR QUOTATION</a></li><li><a href="lpos.php">L.P.O'S & L.S.O'S</a></li><li><a href="purchases.php">GOODS RECIEVED</a></li><li><a href="storesissuenotes.php">STORES ISSUE</a></li><li><a href="gatepass.php">GATE PASS</a></li><li><a href="stockmovementreport.php">STOCK CARD</a></li>
		 
        </ul>   </div>

	  <button class="accordion">
<img src ="DAMAGES.png"  width="8%"  height="16%">
 <figcaption>DAMAGES </figcaption>
</button>
<div class="panel">
<ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link" href="advancedsearch.php" target="right" >DAMAGES </a>
            </li></ul>  </div>
			  <button class="accordion">
<img src ="PAYROLL.jpg"  width="8%"  height="16%">
 <figcaption>PAYROLL </figcaption>
</button>
<div class="panel">
<ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link" href="advancedsearch.php" target="right" >ADVANCED SALARIES </a>
            </li></ul>   </div>
	  
<button class="accordion"><img src ="ICON17.png"  width="5%"  height="5%">
 <figcaption>REPORTS</figcaption></button>
<div class="panel">
  <ul class="dropdown-menu" id="longmenu"> 
	  <li><a href="graphsummary.php"  target= "_blank">GRAPH SUMMARY</a></li> 
        <li><a href="accountstatus.php">ACC CURRENT STATUS </a></li><li><a href="watersalereport.php">WATER SALE REPORT </a></li> 
         
		 <li><a href="ministatement.php">MINISTATEMENT</a></li> 
		   <li><a href="statements.php">FULL STATEMENT</a></li><li><a href="refunddeposit.php">REFUND DEPOSIT</a></li><li><a href="archivedstatements.php">ARCHIVED STATEMENT</a></li><li><a href="bills2report.php">BILLS DISTRIBUTION  REPORT</a></li><li><a href="revenue.php">REVENUE  DISTRIBUTION  REPORT</a></li>
		   <li><a href="balancereport.php">ACC  BAL DISTRIBUTION REPORT </a></li>
       <li><a href="cashsalerecieptsreport.php">RECEIPTS REPORT </a></li>
       <li><a href="analysisreport.php">MONTHLY DATA ANALYSIS </a></li><li><a href="banking.php">UNPROCESSED NOTIFICATION</a></li>
		   <li><a href="waterflow.php">WATER FLOW  REPORT</a></li><li><a href="masterdistribution.php">MASTER METERS REPORT</a></li>
		   
		   <li><a href="accountstatus3.php">ACCOUNTS  DISTRIBUTION  REPORT   </a></li>
		   <li><a href="meterstatus.php">METER DISTRIBUTION REPORT   </a></li><li><a href="accountsactivity.php">ACTIVITIES  DISTRIBUTION REPORT   </a></li>

<li><a href="duebillingreport.php">DUE BILLING REPORT</a></li> 	 		 
		  
      </ul>
</div>

<button class="accordion"><img src ="ICON17.png"  width="5%"  height="5%">
 <figcaption>ANNUAL REPORTS</figcaption></button>
<div class="panel">
 <ul class="dropdown-menu">
	          <li><a href="annualchlorinereport.php">CHLORINE REPORT </a></li> 
			  <li><a href="annualproductionreport.php">PRODUCTION REPORT </a></li> 
			   
			  <li><a href="annualreconnectionreport.php">RECONNECTION REPORT </a></li>
			  <li><a href="annualdisconnectionreport.php">DISCONNECTION REPORT </a></li>
			  <li><a href="annualrevenuereport.php">REVENUE REPORT </a></li> 
			  
			     			  
	  </ul> </div>


<button class="accordion">Section 3</button>
<div class="panel">
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

</body>
</html>
