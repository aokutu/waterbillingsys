<?php
session_start();
include_once("password.php");
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">


     <link rel="stylesheet" href="css/style.css">
     <script src="pluggins/jqueryslim.js"></script>
<script src="pluggins/bootstrapmin.js"></script>
<script src="pluggins/jquery.min.js"></script>

<!-- Popper JS -->
<script src="pluggins/popper.js"></script>

<!-- Latest compiled JavaScript -->
<script src="pluggins/bootstrapmin.js"></script>
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
  
<style>
.accordion {
  background-color: #87CEEB;
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

table{
 height:500px;              // <-- Select the height of the table
 display: -moz-groupbox; 
 // Firefox Bad Effect
}
tbody{
  overflow-y: scroll;      
  height: 480px;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
body{background-color: #87CEEB;}
select{width:100%;}
</style>
<link href=
"stuff/bullets.css" 
          rel="stylesheet">
  <link href=
"bullets.css" rel="stylesheet">
</head>
<body>

    <div id="sessiondetails">
                        
                <h3 class="card-title">
                    <select class="btn btn-secondary dropdown-toggle" name="loadedzone" id="selectzone" >
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
        
              
               
               
                            <a class="nav-link" href="exit.php" target= "_parent" >
                                <i class="fas fa-sign-out-alt" data-target="#modalLoginForm"></i> 
                                <button class="accordion"> <img src ="stuff/LOGOUT.png"  width="25%"  height="25%">
 <figcaption>LOGGOUT</figcaption></button>  </a> 
 <hr>
                        
<button class="accordion"> <img src ="stuff/ICON15.png"  width="25%"  height="25%">
 <figcaption>ADMINISTRATOR</figcaption></button>
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
<hr>
<button class="accordion"> <img src ="stuff/ICON22.png"  width="25%"  height="25%">
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
<hr>
	  <button class="accordion">
<img src ="stuff/ICON24.png"  width="25%"  height="25%">
 <figcaption>METER REG </figcaption>
</button>
<div class="panel">
  <ul class="dropdown-menu"> 
        <li><a href="meterregistry.php" target= "right">METER REGISTRY </a></li>
        <li><a href="unregisteredmeterregistry.php" target= "right">UNREGISTERED ACCOUNTS  </a></li>
		
		<li><a href="metertrail.php" target= "right">METER TRAIL </a></li>
		 
      </ul>   </div>
<hr>
	  <button class="accordion">
<img src ="stuff/ICON24.png"  width="25%"  height="25%">
 <figcaption>WATER PRODUCTION</figcaption>
</button>
<div class="panel">
<ul class="dropdown-menu"> 
        <li><a href="productionbilling.php"   target="right" >PRODUCTION METERS</a></li><li><a href="mastermeters.php"   target= "right">MASTER METERS </a></li>	
      </ul>   </div>	  
<button class="accordion">
<img src ="stuff/ICON1.png" width="25%"  height="25%">
 <figcaption>BILLING </figcaption>
</button>
<div class="panel">
  <ul class="dropdown-menu"> 
	   <li><a   href="billsrate.php" target="right" > BILL RATES</a></li>
	   <li><a   href="printbill2.php" target= "right" >MASS  PRINT BILL</a></li>
	   <li><a   href="mainbilling.php" target= "right" > BILLING</a></li>
      <li><a   href="billing.php" target= "right" >MULTI BILLING</a></li>
	<li><a   href="fieldbilling.php" target= "right" >FIELED BILLING</a></li> 	  
        <li><a href="viewbill.php" target="right"  >BILLS SUMMARY</a></li> 
		  <li><a href="billsreport.php" target="right"  >BILLS REPORT</a></li>
		  <li><a href="nonwaterbillsreport.php" target="right"  >NON WATER BILLS</a></li>
		  <li><a href="clientquotations.php"  target="right"  >QUOTATIONS</a></li>
		  <li><a href="archives.php" target="right"  >IMAGE ARCHIVES</a></li> 
      </ul> </div>
<hr>
<button class="accordion"><img src ="stuff/ICON20.png"  width="25%"  height="25%">
 <figcaption>PAYMENTS</figcaption></button>
<div class="panel">
 <ul class="dropdown-menu"> 
        <li><a href="paymentcodes.php" target="right"  >PAYMENT CODES </a></li>
        <li><a href="bankstatements.php"  target="right"  >PAYMENT SLIPS </a></li> 
        <li><a href="backuprestore.php"  target="right"  >UPLOAD SLIPS</a></li>
        <li><a href="linkslips.php" target="right"  >LINK SLIPS</a></li>
        <li><a href="paynotifications.php"  target="right"  >PAY NOTIFICATIONS</a></li>
        <li><a href="reciepts.php"  target="right"  >RECEIPTS</a></li> 
		 
      </ul> </div>
	  <button class="accordion">
<img src ="stuff/SMS.png"  width="25%"  height="25%">
 <figcaption>SMS </figcaption>
</button>
<div class="panel">
   <ul class="dropdown-menu"> 
        <li><a href="sms.php" target= "right">BILLING SMS/EMAILS </a></li> 
        <li><a href="custormsms.php" target= "right">CUSTORM  SMS/EMAILS </a></li>
		<li><a href="sendsmsemail.php" target="right" >SEND  SMS/EMAILS </a></li>
		<li><a href="balinquery.php" target= "right">BALANCE  INQUERY </a></li>
		<li><a href="viewsms.php" target="right">VIEW  SMS/EMAILS </a></li> 
		  <li><a href="contacts.php" target= "right">EDIT CONTACTS </a></li> 
      </ul>   </div>
      <hr>
<button class="accordion">
<img src ="stuff/ICON21.png" width="25%"  height="25%">
 <figcaption>GEO MAPPING</figcaption>
</button>
<div class="panel">
   <ul class="dropdown-menu"> 
	   
        <li><a href="generatemap.php"  target= "right" >GENERATE MAP </a></li>
        <li><a href="mapping2.php"  target="right" >GEO LOCATION </a></li> 
         
      </ul> </div>
	  <hr>
	  <button class="accordion">
<img src ="stuff/INVENTORY.png"  width="25%"  height="25%">
 <figcaption>INVENTORY </figcaption>
</button>
<div class="panel">
 <ul class="dropdown-menu"> 
        <li><a href="itemcategory.php"  target="right"  >ITEM CATEGORIES</a></li>
        <li><a href="suppliers.php"  target="right"  >SUPPLIERS</a></li>
        <li><a href="inventory.php"  target="right"  >INVENTORY</a></li>
        <li><a href="stockadjustment.php"   target="right"  >STOCK ADJUSTMENT</a></li>
        <li><a href="purchasesreq.php"   target="right"  >PURCHASES REQ</a></li>
        <li><a href="quotationrequest.php" target="right"  >REQUEST FOR QUOTATION</a></li>
        <li><a href="lpos.php"  target="right"  >L.P.O'S & L.S.O'S</a></li><li>
            <a href="purchases.php" target="right"  >GOODS RECIEVED</a></li>
            <li><a href="storesissuenotes.php"  target="right"  >STORES ISSUE</a></li>
            <li><a href="gatepass.php"  target="right"  >GATE PASS</a></li>
            <li><a href="stockmovementreport.php"  target="right"  >STOCK CARD</a></li>
		 
        </ul>   </div>
<hr>
	  <button class="accordion">
<img src ="stuff/DAMAGES.png"  width="25%"  height="25%">
 <figcaption>DAMAGES </figcaption>
</button>
<div class="panel">
<ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link" href="advancedsearch.php" target="right" >DAMAGES </a>
            </li></ul>  </div>
            <hr>
			  <button class="accordion">
<img src ="stuff/PAYROLL.jpg"  width="25%"  height="25%">
 <figcaption>PAYROLL </figcaption>
</button>
<div class="panel">
<ul class="nav flex-column">
      <li class="nav-item"><a class="nav-link" href="advancedsearch.php" target="right" >ADVANCED SALARIES </a>
            </li></ul>   </div>
<hr>	  
<button class="accordion"><img src ="stuff/ICON17.png"  width="25%"  height="25%">
 <figcaption>REPORTS</figcaption></button>
<div class="panel">
  <ul class="dropdown-menu" id="longmenu"> 
	  <li><a href="graphsummary.php"  target="right" >GRAPH SUMMARY</a></li> 
        <li><a href="accountstatus.php">ACC CURRENT STATUS </a></li><li><a href="watersalereport.php">WATER SALE REPORT </a></li> 
         
		 <li><a href="ministatement.php"  target="right"  >MINISTATEMENT</a></li> 
		   <li><a href="statements.php"  target="right"  >FULL STATEMENT</a></li>
		   <li><a href="refunddeposit.php"  target="right"  >REFUND DEPOSIT</a></li>
		   <li><a href="archivedstatements.php"  target="right"  >ARCHIVED STATEMENT</a></li>
		   <li><a href="bills2report.php"  target="right"  >BILLS DISTRIBUTION  REPORT</a></li>
		   <li><a href="revenue.php"  target="right"  >REVENUE  DISTRIBUTION  REPORT</a></li>
		   <li><a href="balancereport.php"  target="right"  >ACC  BAL DISTRIBUTION REPORT </a></li>
       <li><a href="cashsalerecieptsreport.php"  target="right"  >RECEIPTS REPORT </a></li>
       <li><a href="analysisreport.php"  target="right"  >MONTHLY DATA ANALYSIS </a></li>
       <li><a href="banking.php" target="right"  >UNPROCESSED NOTIFICATION</a></li>
		   <li><a href="waterflow.php"  target="right"  >WATER FLOW  REPORT</a></li>
		   <li><a href="masterdistribution.php"  target="right"  >MASTER METERS REPORT</a></li>
		   
		   <li><a href="accountstatus3.php" target="right"  >ACCOUNTS  DISTRIBUTION  REPORT   </a></li>
		   <li><a href="meterstatus.php" target="right"  >METER DISTRIBUTION REPORT   </a></li>
		   <li><a href="accountsactivity.php"  target="right"  >ACTIVITIES  DISTRIBUTION REPORT   </a></li>

<li><a href="duebillingreport.php">DUE BILLING REPORT</a></li> 	 		 
		  
      </ul>
</div>
<hr>
<button class="accordion"><img  src ="stuff/ICON17.png"  width="25%"  height="25%">
 <figcaption>ANNUAL REPORTS</figcaption></button>
<div class="panel">
 <ul class="dropdown-menu">
	          <li><a href="annualchlorinereport.php"  target="right"  >CHLORINE REPORT </a></li> 
			  <li><a href="annualproductionreport.php"   target="right"  >PRODUCTION REPORT </a></li> 
			   
			  <li><a href="annualreconnectionreport.php"   target="right"  >RECONNECTION REPORT </a></li>
			  <li><a href="annualdisconnectionreport.php"   target="right"  >DISCONNECTION REPORT </a></li>
			  <li><a href="annualrevenuereport.php"  target="right"  >REVENUE REPORT </a></li> 
			  
			     			  
	  </ul> </div>

<hr>
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
