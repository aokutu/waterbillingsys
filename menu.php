<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->password=$_SESSION['password'];
$dbdetails->user=$_SESSION['user'];
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);

$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link   href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/assets/css/docs.min.css" rel="stylesheet">
       <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />



   <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
 <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>



    <title>Bootstrap Example</title>
    <script src="pluggins/bootstrap.bundle.min.js"></script>
      <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
<style>
button{width:100%;}
ul {width:100%;font-size:20%;}
</style>
 <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
   
   
   


$("#zonesearch").submit(function(){$('#prepostmessage').modal('show');
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){
$("#content").load("message.php #content");$("#mainbilling").load("meterdetails2.php #accountdetails");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

 })
  
  </script>
  </head>
  <body class="p-3 m-0 border-0 bd-example" style="font-size:100%;">

<a   href="exit.php" target= "_parent" ><button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            <div  class="fas fa-clock">LOGG OFF</div>
          </button> </a>
 

             <a href="#" title="SELECT" data-toggle="popover" data-trigger="hover" data-content="ZONE WINDOW" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#zonesearch">ZONE</button></a>

    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            ADMIN<img src ="ICON7.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
          <div class="accordion-body">
			<div class="moduleloader" id="usersadmin" >
			     
			             <li><a   href="users.php" target= "right" >USER ADMIN </a></li><li><a   href="companyadmin.php" target= "right" >COMPANY ADMIN </a></li><li><a   href="zoneadmin.php" target= "right" >ZONE ADMIN </a></li>  

        <li><a href="backupdatabase.php" target="right">BACKUP DATABASE</a></li> 

		 <li><a  href="trail.php" target= "right" >AUDIT TRAIL </a></li></div>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
           REGISTRY<img src ="ICON1.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
          <div class="accordion-body"><li><a href="newaccount.php" target="right" >NEW ACCOUNT </a></li> 

        <li><a  href="accountedit.php" target="right" >EDIT ACCOUNT</a></li>

		<li><a  href="accountedit2.php" target="right" >MULTI EDIT</a></li><li><a  href="accounttransfer.php" target="right" >ACCOUNT NUMBER CHANGE</a></li>
		
		<li><a  href="accountsregistry.php" target="right" >VIEW ACCOUNTS</a></li><li><a  href="accountstransfer.php" target="right" >ACCOUNTS TRANSFER</a></li><li><a  href="advancedsearch.php" target="right" >ADVANCED REG SEARCH</a></li><li><a  href="accountstrail.php" target="right" > ACCOUNTS TRAIL</a></li>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
           METERS I <img src ="ICON24.png"  width="16%"  height="20%">
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <li><a href="meterregistry.php" target= "right">METER REGISTRY </a></li><li><a href="unregisteredmeterregistry.php" target= "right">UNREGISTERED ACCOUNTS  </a></li>
		
		<li><a href="metertrail.php" target= "right">METER TRAIL </a></li>
          </div>
        </div>
      </div>
	   <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
           BILLING<img src ="ICON16.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
          <div class="accordion-body"> <li><a   href="printbill2.php" target= "right" >MASS  PRINT BILL</a></li><li><a   href="mainbilling.php" target= "right" > BILLING</a></li>

      <li><a   href="billing.php" target= "right" >MULTI BILLING</a></li>
<li><a   href="fieldbilling.php" target= "right" >FIELED BILLING</a></li> 	  
        <li><a href="viewbill.php" target="right">BILLS SUMMARY</a></li> 
		  <li><a href="billsreport.php" target= "right">BILLS REPORT</a></li> <li><a href="nonwaterbillsreport.php" target="right">NON WATER BILLS</a></li><li><a href="clientquotations.php"  target="right">QUOTATIONS</a></li><li><a href="archives.php" target="right">IMAGE ARCHIVES</a></li> 
</div>
        </div>
      </div>
	  
	  
	   <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            PAYMENT <img src ="ICON20.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
          <div class="accordion-body">
             <li><a href="paymentcodes.php"target="right">PAYMENT CODES </a></li><li><a href="bankstatements.php" target="right">PAYMENT SLIPS </a></li> 

        <li><a href="backuprestore.php" target="right">UPLOAD SLIPS</a></li><li ><a href="linkslips.php" target="right">LINK SLIPS</a></li><li><a href="paynotifications.php" target="right">PAY NOTIFICATIONS</a></li><li><a href="reciepts.php" target="right">RECEIPTS</a></li> 
          </div>
        </div>
      </div>
	  
	  <div class="accordion-item">



        <h2 class="accordion-header" id="headingTen">

          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
           SMS/EMAIL<img src ="ICON21.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
          <div class="accordion-body"><li><a href="sms.php" target= "right">BILLING SMS/EMAILS </a></li> <li><a href="custormsms.php" target= "right">CUSTORM  SMS/EMAILS </a></li>

		<li><a href="sendsmsemail.php" target= "right">SEND  SMS/EMAILS </a></li>

		<li><a href="balinquery.php" target= "right">BALANCE  INQUERY </a></li><li><a href="viewsms.php" target= "right">VIEW  SMS/EMAILS </a></li> 
		  <li><a href="contacts.php" target= "right">EDIT CONTACTS </a></li> 
 </div>
        </div>
      </div>
	   <div class="accordion-item">
        <h2 class="accordion-header" id="headingSix">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
            INVENTORY <img src ="ICON25.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <li><a href="itemcategory.php" target="right">ITEM CATEGORIES</a></li><li><a href="suppliers.php" target="right">SUPPLIERS</a></li><li><a href="inventory.php" target="right">INVENTORY</a></li><li><a href="stockadjustment.php" target="right">STOCK ADJUSTMENT</a></li><li><a href="purchasesreq.php" target="right">PURCHASES REQ</a></li><li><a href="quotationrequest.php"  target="right">REQUEST FOR QUOTATION</a></li><li><a href="lpos.php"  target="right">L.P.O'S & L.S.O'S</a></li><li><a href="purchases.php"  target="right">GOODS RECIEVED</a></li><li><a href="storesissuenotes.php" target="right">STORES ISSUE</a></li><li><a href="gatepass.php" target="right">GATE PASS</a></li><li><a href="stockmovementreport.php" target="right">STOCK CARD</a></li>

		 
          </div>
        </div>
      </div>
	  
	  
	   <div class="accordion-item">
        <h2 class="accordion-header" id="headingSeven">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
           GEO MAP<img src ="ICON21.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
          <div class="accordion-body">
 <a href="generatemap.php" target="right">GENERATE MAP </a><br><a href="mapping2.php" target="right">GEO LOCATION </a></div>
        </div>
      </div>
	  
	   <div class="accordion-item">
        <h2 class="accordion-header" id="headingEight">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
           METERS II<img src ="ICON1.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
          <div class="accordion-body">
                   <li><a href="productionbilling.php"   target= "right">PRODUCTION METERS</a></li><li><a href="mastermeters.php"   target= "right">MASTER METERS </a></li>
          </div>
        </div>
      </div>
	  
	   <div class="accordion-item">
        <h2 class="accordion-header" id="headingNine">
          <button class="btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
            REPORTS
	   <img src ="ICON17.png"  width="20%"  height="20%">
          </button>
        </h2>
        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            
          <li><a href="graphsummary.php"  target= "right">GRAPH SUMMARY</a></li> 
        <li><a href="accountstatus.php"  target="right">ACC CURRENT STATUS </a></li><li><a href="watersalereport.php" target="right">WATER SALE REPORT </a></li> 
         
		 <li><a href="ministatement.php" target="right">MINISTATEMENT</a></li> 
		   <li><a href="statements.php" target="right">FULL STATEMENT</a></li><li><a href="refunddeposit.php"target="right">REFUND DEPOSIT</a></li><li><a href="archivedstatements.php" target="right">ARCHIVED STATEMENT</a></li><li><a href="bills2report.php"  target="right">BILLS DISTRIBUTION  REPORT</a></li><li><a href="revenue.php" target="right">REVENUE  DISTRIBUTION  REPORT</a></li>
		   <li><a href="balancereport.php" target="right">ACC  BAL DISTRIBUTION REPORT </a></li>
       <li><a href="cashsalerecieptsreport.php"  target="right">RECEIPTS REPORT </a></li>
       <li><a href="analysisreport.php" target="right">MONTHLY DATA ANALYSIS </a></li><li><a href="banking.php"  target="right">UNPROCESSED NOTIFICATION</a></li>
		   <li><a href="waterflow.php"  target="right">WATER FLOW  REPORT</a></li><li><a href="masterdistribution.php"  target="right">MASTER METERS REPORT</a></li>
		   
		   <li><a href="accountstatus3.php" target="right">ACCOUNTS  DISTRIBUTION  REPORT   </a></li>
		   <li><a href="meterstatus.php"  target="right">METER DISTRIBUTION REPORT   </a></li><li><a href="accountsactivity.php" target="right">ACTIVITIES  DISTRIBUTION REPORT   </a></li>

<li><a href="duebillingreport.php" target="right">DUE BILLING REPORT</a></li>   
            
          </div>
        </div>
      </div>
	  
	  <!-- -->
    </div>
    <form class="modal fade" id="zonesearch" role="dialog" method="post"  action="zonesearch.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
<select class="form-control input-sm"  id="loadedzone"  name="loadedzone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
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
    </select>
        </div>
    <div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
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
    <!-- End Example Code -->
  </body>
</html>