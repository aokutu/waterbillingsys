<?php
session_start();
include_once("password.php");
?>
 <link rel="stylesheet" href="stylesheets/bootsraplocal.css">
     <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">


 <link rel="stylesheet" href="stylesheets/bootsraplocal.css">
     <link rel="stylesheet" href="css/style.css">
     <script src="pluggins/jqueryslim.js"></script>
<script src="pluggins/bootstrapmin.js"></script>
  <style>
  @media print{ display:none;}
        /* Custom green color scheme */
        :root {
            --primary-color: #5eba7d;
        }
        
        /* Add green background color to navigation bar */
        .navbar {
            background-color: var(--primary-color);
        }
        
        /* Add green color to text in navigation bar */
        .navbar a {
            color: blueviolet;
        }
        
        /* Add green color to active navigation link */
        .navbar .nav-item.active a {
            background-color: #3b865a;
        }

       
    /* Custom green background color for patient menu */
    #customer-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#customer-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #customer-menu a {
        color: white;
    }


   /* Custom green background color for patient menu */
     #inventory-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#inventory-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #inventory-menu a {
        color: white;
    }


 /* Custom green background color for patient menu */
     #mapping-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#mapping-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #mapping-menu a {
        color: white;
    }
	
	
	
	
	 /* Custom green background color for patient menu */
     #annualreport-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#annualreport-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #annualreport-menu a {
        color: white;
    }
	

	 /* Custom green background color for patient menu */
     #staffpayroll-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#staffpayroll-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #staffpayroll-menu a {
        color: white;
    }

	 /* Custom green background color for patient menu */
     #damages-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#damages-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #damages-menu a {
        color: white;
    }
	
	
     /* Custom green background color for patient menu */
     #meter-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#meter-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #meter-menu a {
        color: white;
    }

     /* Custom green background color for patient menu */
     #bill-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#bill-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #bill-menu a {
        color: white;
    }
    
     /* Custom green background color for patient menu */
     #billing-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#billing-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #billing-menu a {
        color: white;
    }
 /* Custom green background color for patient menu */
     #rep-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#rep-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #rep-menu a {
        color: white;
    }
      /* Custom green background color for patient menu */
      #pay-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#pay-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #pay-menu a {
        color: white;
    }

     /* Custom green background color for patient menu */
     #admin-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#admin-menu {
        background-color: #5eba7d;
    }
    /* Custom white color for text and links within patient menu */
    #admin-menu a {
        color: white;
    }
.card-body{
        background-color: #4d8dbc;
    }
     /* Custom blue background color for dashboard section */
    .card-body{
        background-color: #4d8dbc;
    }
    /* Custom white color for text and links within dashboard */
    .card-body a {
        color: white;
    }
    /* Position drop-down sign to the far end of menu item */
    .nav-item .fa-caret-down {
        float: right;
    }
    /* Add white horizontal line to divide menu items */
    .nav-item {
        border-top: 1px solid white;
    }
    
      #set-menu a {
        color: white;
    }
     /* Custom green background color for patient menu */
     #set-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#set-menu {
        background-color: #5eba7d;
    }
     #sm-menu a {
        color: white;
    }
     /* Custom green background color for patient menu */
     #sm-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#sm-menu {
        background-color: #5eba7d;
    }
      #patient-menu a {
        color: white;
    }
     /* Custom green background color for patient menu */
     #patient-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#patient-menu {
        background-color: #5eba7d;
    }
    
      /* Custom white color for text and links within patient menu */
    #m-menu a {
        color: white;
    }
     /* Custom green background color for patient menu */
     #m-menu {
        background-color: #5eba7d;
    }
/* Custom green background color for patient menu */
#m-menu {
        background-color: #5eba7d;
    }
    </style>
     <script src="pluggins/jquery.min.js"></script>

<!-- Popper JS -->
<script src="pluggins/popper.js"></script>

<!-- Latest compiled JavaScript -->
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
   <!--body  oncontextmenu="return false;" -->
  <body   >
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
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
                        
                        
                    </div>
                    

                </div>
                <div class="card-body">
                <ul class="nav flex-column">
                    
 <li class="nav-item">
                            <div class="nav-link" >
                               <div id="connection1"><i class='fas fa-network-wired' style='color:white' ></i></div>
<div id="connection2" ><i class='fas fa-network-wired'   style='color:red' ></i></div> </div>
                        </li> 
                       <li class="nav-item">
                            <a class="nav-link" href="exit.php" target= "_parent" >
                                <i class="fas fa-sign-out-alt" data-target="#modalLoginForm"></i> Logout </a>
                        </li> 
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" id="customerDropdown" data-target="#customer-menu" aria-expanded="false" aria-controls="customer-menu">
    <i class="fas fa-cogs"></i> ADMINISTRATOR<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="customer-menu">
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
</li>

<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" id="meterDropdown" data-target="#meter-menu" aria-expanded="false" aria-controls="meter-menu">
    <i class="fas fa-user-alt"></i> CLIENT REG<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="meter-menu">
<ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="newaccount.php" target="right" >New client</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="accountedit.php" target="right">Edit client</a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="accountedit2.php" target="right">Multi Edit</a>
            </li>
                <li class="nav-item">
                <a class="nav-link" href="accounttransfer.php" target="right">Acc Taken  Over</a>
            </li>
             </li>
               

               <li class="nav-item">
                <a class="nav-link" href="accountsregistry.php" target="right">View client</a>
            </li>
            
                 <li class="nav-item">
                <a class="nav-link" href="accountstrail.php" target="right">Acc trail</a>
            </li>
            
        
            
            <li class="nav-item"><a class="nav-link" href="accountstatus3.php" target="right">Clients  Tally  </a></li>
            <li class="nav-item"><a class="nav-link" href="accountstatusreport.php" target="right">Client  Status  Tally  </a></li>
            

        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" id="billDropdown" data-target="#bill-menu" aria-expanded="false" aria-controls="bill-menu">
        <i class="fas fa-tachometer-alt"></i> METERS I <i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="bill-menu">
        <ul class="nav flex-column"><li class="nav-item">
                <a class="nav-link" href="metersregistry2.php" target="right">Meters Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="meterregistry.php" target="right">Meters Reg</a>
            </li>
          
               <li class="nav-item">
                <a class="nav-link" href="metertrail.php" target= "right">Meter trail</a>
            </li>
        </ul>
    </div>
</li>

                  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#set-menu" aria-expanded="false" aria-controls="set-menu">
    <i class="fas fa-tachometer-alt"></i> PRODUCTION<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="set-menu">
<ul class="nav flex-column">
      <li class="nav-item">
                <a class="nav-link" href="productionbilling.php"   target= "right" >PRODUCTION</a>
            </li>
        <li class="nav-item">
                <a class="nav-link" href="mastermeters.php"  target= "right" >MASTER METERS</a>
            </li>
            
             <li class="nav-item">
                <a class="nav-link" href="mastermeters.php"  target= "right" >Production /Consumption Reports</a>
            </li>
 <li class="nav-item"><a class="nav-link" href="waterflow.php"  target="right">WATER FLOW  REPORT</a></li>
           
        </ul>
    </div>
</li>  


<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" id="billingDropdown" data-target="#billing-menu" aria-expanded="false" aria-controls="billing-menu">
        <i class="fas fa-clipboard-list"></i> BILLING<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="billing-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="printbill2.php"  target= "right" >PRINT BILL</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="mainbilling.php" target= "right">Single Billing</a>
            </li>
                <li class="nav-item">
                <a class="nav-link" href="billing.php" target= "right">Multi Billing </a>
            </li>
                  <li class="nav-item">
                <a class="nav-link" href="fieldbilling.php" target= "right">Field Billing </a>
            </li>
                  <li class="nav-item">
                <a class="nav-link" href="billsreport.php" target= "right">Bills Report I</a>
            </li>
            
              <li class="nav-item">
                <a class="nav-link" href="nonwaterbillsreport.php" target= "right">Non Water Bills</a>
            </li>
                 <li class="nav-item">
                <a class="nav-link" href="ministatement.php" target= "right">MiniStatement</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="statements.php" target= "right">Full Statement</a>
            </li>
            
            <li class="nav-item"><a class="nav-link" href="bills2report.php"  target="right">Bills Report II</a></li>
                <li class="nav-item"><a class="nav-link" href="watersalereport.php" target="right">Consumtion Report</a></li>
                <li class="nav-item"><a class="nav-link" href="duebillingreport.php" target="right">Unread water  meters </a></li>
        </ul>
    </div>
</li>



                        <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#mapping-menu" aria-expanded="false" aria-controls="mapping-menu">
    <i class="fas fa-screwdriver"></i>DAMAGES<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="mapping-menu">
<ul class="nav flex-column">
      <li class="nav-item">
                <a class="nav-link" href="miscellinious.php" target="right" >DAMAGES</a>
            </li>
           
        </ul>
    </div>
</li> 




<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" id="mDropdown" data-target="#m-menu" aria-expanded="false" aria-controls="m-menu">
    <i class="far fa-money-bill-alt"></i>ACCOUNTS<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="m-menu">
<ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="paymentcodes.php" target= "right">Payments codes</a>
            </li>
            
                  <li class="nav-item">
                <a class="nav-link" href="bankstatements.php" target= "right">Payment Uploads</a>
            </li>
           
                 <li class="nav-item">
                <a class="nav-link" href="linkslips.php" target="right">Link slips</a>
            </li>
            
     <li class="nav-item">
                <a class="nav-link" href="paynotifications.php" target="right">Pay notification</a>
            </li>
                 <li class="nav-item">
                <a class="nav-link" href="reciepts.php" target= "right">Receipts</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="cashsalerecieptsreport.php"  target="right">Receipts Reports </a></li>
            <li class="nav-item"><a class="nav-link"href="revenue.php" target="right">Accounts Report I</a></li>
            <li class="nav-item"><a class="nav-link" href="balancereport.php" target="right">Pending Balances report </a></li>
             <li class="nav-item"><a class="nav-link" href="accountstatus.php" target="right">Detailed Pending Balances</a></li>
              <li class="nav-item"><a class="nav-link" href="paypointreport.php" target="right">Paypoint  Report</a></li>
            <li class="nav-item"><a class="nav-link" href="billpaymentreport.php" target="right">Bill/Payment  Report</a></li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" id="payDropdown" data-target="#pay-menu" aria-expanded="false" aria-controls="pay-menu">
    <i class="fas fa-sms"></i> SMS <i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="pay-menu">
<ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="sms.php" target= "right">Billing sms</a>
            </li>
                <li class="nav-item">
                <a class="nav-link" href="custormsms.php" target= "right">Custorm sms</a>
            </li>
                   <li class="nav-item">
                <a class="nav-link" href="sendsmsemail.php" target= "right">Send sms</a>
            </li>
            
                 <li class="nav-item">
                <a class="nav-link"href="viewsms.php" target= "right">View sms</a>
            </li>
                   <li class="nav-item">
                <a class="nav-link" href="contacts.php" target= "right">Edit contacts</a>
            </li>
            
            

        </ul>
    </div>
</li>




<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#inventory-menu" aria-expanded="false" aria-controls="inventory-menu">
    <i class="fas fa-dolly-flatbed"></i> INVENTORY<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="inventory-menu">
<ul class="nav flex-column">
      <li class="nav-item">
               <a  class="nav-link"  href="itemcategory.php" target="right">ITEM CATEGORIES</a>
            </li>
           <li class="nav-item">
               <a  class="nav-link"  href="suppliers.php" target="right">SUPPLIERS</a>
            </li>
           <li class="nav-item"><a  class="nav-link"  href="inventory.php" target="right">INVENTORY</a></li>
           <li class="nav-item"><a class="nav-link"  href="stockadjustment.php" target="right">STOCK ADJUSTMENT</a></li>
           <li class="nav-item"><a  class="nav-link"  href="purchasesreq.php" target="right">PURCHASES REQ</a></li>
           <li class="nav-item"><a  class="nav-link" href="quotationrequest.php"  target="right">REQUEST FOR QUOTATION</a></li>
           <li class="nav-item"><a  class="nav-link"  href="lpos.php"  target="right">L.P.O'S & L.S.O'S</a></li>
           <li class="nav-item"><a class="nav-link"  href="purchases.php"  target="right">GOODS RECIEVED</a></li>
           <li class="nav-item"><a  class="nav-link"  href="storesissuenotes.php" target="right">STORES ISSUE</a></li>
           <li class="nav-item"><a class="nav-link"  href="gatepass.php" target="right">GATE PASS</a></li>
           <li class="nav-item"><a  class="nav-link"  href="stockmovementreport.php" target="right">STOCK CARD</a></li>
 </ul>
    </div>
</li>
            
 
                        <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#mapping-menu" aria-expanded="false" aria-controls="mapping-menu">
    <i class="fas fa-globe"></i> MAPPING<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="mapping-menu">
<ul class="nav flex-column">
      <li class="nav-item">
                <a class="nav-link" href="generatemap.php" target="right" >Geo-Map</a>
            </li>
           
        </ul>
    </div>
</li>     
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#rep-menu" aria-expanded="false" aria-controls="rep-menu">
    <i class="fas fa-clipboard-list"></i> REPORTS<i class="fas fa-caret-down"></i>
    </a>
    <div class="collapse" id="rep-menu">
<ul class="nav flex-column">
      <li class="nav-item">
                <a class="nav-link" href="graphsummary.php"  target= "right"  >Graph Summary</a>
            </li>
       
<li class="nav-item"><a class="nav-link" href="refunddeposit.php"target="right">REFUND DEPOSIT</a></li>
<li class="nav-item"><a class="nav-link" href="banking.php"  target="right">UNPROCESSED NOTIFICATION</a></li>

<li class="nav-item"><a class="nav-link" href="masterdistribution.php"  target="right">MASTER METERS REPORT</a></li>

<li class="nav-item"><a class="nav-link" href="accountsactivity.php" target="right">ACTIVITIES  DISTRIBUTION REPORT   </a></li>
<li class="nav-item"><a class="nav-link" href="debtorsreport.php" target="right">DEBTORS REPORT   </a></li>
<li class="nav-item"><a class="nav-link" href="creditorsreport.php" target="right">CREDITORS REPORT   </a></li>
<li class="nav-item"><a class="nav-link" href="agingreport.php" target="right">AGING ANALYSIS REPORT   </a></li>
<li class="nav-item"><a class="nav-link" href="consumeranalysis.php" target="right">CONSUMERS ANALYSIS REPORT   </a></li>
             
        </ul>
    </div>
</li>   
                          
                       
                   </ul>
                </div>
            </div>
        </div>
        </body>
 
 



