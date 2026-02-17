<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$account=$_SESSION['min2'];
/*
$x="CREATE TEMPORARY TABLE  STATEMENTX (A TEXT,B TEXT ,C TEXT,D TEXT,E TEXT,F TEXT,G TEXT,H TEXT,TRANSACTION TEXT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));		
$x="insert  into STATEMENTX(A,B,C,H,transaction) select depositdate,code,transaction,-1* credit,concat('CREDIT')  FROM  $wateraccountstable  WHERE  account='$account'   and   ";	mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('DEBIT')    FROM   $billstable  WHERE  account='$account' AND STATUS ='PENDING'   OR   account='$account' AND  STATUS IS NULL  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('ADJUSTMENT')    FROM   $billstable  WHERE  account='$account' AND STATUS ='ADJUSTMENT' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,transaction,H) select date,NAME,AMOUNT    FROM   $nonwaterbills  WHERE  account='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,B,transaction,H) select date,concat('METER&nbsp-',meter),status ,concat(0)   FROM  $statushistorytable  WHERE  account='$account' ";mysqli_query($connect,$x)or die(mysqli_error($connect));*/

$x="SELECT * FROM $accountstable  WHERE  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $_SESSION['client']=$y['client'];$account=$y['account']; $status=$y['status'];$meternumber=$y['meternumber'];  $size=$y['size']; $class=$y['class']; $lastreading=$y['email'];}}
	
$x="SELECT *  from $meterstable  WHERE  account='$account'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$name=$y['client']; $contact=$y['contact'];}}
		
$x="CREATE TEMPORARY TABLE  STATEMENTX (ID INT,A TEXT,B TEXT ,C TEXT,D TEXT,E TEXT,F TEXT,G TEXT,H TEXT,TRANSACTION TEXT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));		
$x="ALTER TABLE STATEMENTX ADD PRIMARY KEY (`ID`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE STATEMENTX  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="insert  into STATEMENTX(A,B,C,H,transaction) select depositdate,code,transaction,-1* credit,concat('CREDIT')  FROM  $wateraccountstable  WHERE  account='$account'   ";	mysqli_query($connect,$x)or die(mysqli_error($connect));
/*$x="insert  into STATEMENTX(A,B,C,G,H,transaction) select depositdate,code,transaction, credit,concat(0),concat('CREDIT')  FROM  $wateraccountstable  WHERE  account='$account'    AND depositdate >'$date1' AND depositdate <='$date2' ";	mysqli_query($connect,$x)or die(mysqli_error($connect));*/
$x="insert  into STATEMENTX(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('DEBIT')    FROM   $billstable  WHERE  account='$account'   AND STATUS ='PENDING' OR account='$account'   AND STATUS  IS NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,B,C,D,E,F,G,H,transaction) select date,current,previous,units,metercharges,refuse,charges,balance,concat('ADJUSTMENT')    FROM   $billstable  WHERE  account='$account'    AND STATUS ='ADJUSTMENT' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert  into STATEMENTX(A,transaction,H) select date,NAME,AMOUNT    FROM   $nonwaterbills  WHERE  account='$account'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="insert  into STATEMENTX(A,B,transaction,H) select date,concat('METER&nbsp-',meter),status ,concat(0)   FROM  $statushistorytable  WHERE  account='$account'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE STATEMENTX tu, paymentcode ts SET tu.B=CONCAT(ts.NAME,' ',ts.CODE)  WHERE tu.B=ts.CODE ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
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

table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:right;
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
$('#searchaccount').modal('show');
$("#close1").click(function() {
        $("input").val("");
    });	

$("#close2").click(function() {
        $("input").val("");
    });

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
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
	    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH ACCOUNT" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#searchaccount">ACCOUNT</button>
	    </a>


   <button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
   
    <!-- Modal -->
  </div>
   
    <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
  
  <form class="modal fade" id="searchaccount" role="dialog"    action="statementaccount.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  
  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input  style='text-transform:uppercase' name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>
<div id="suggesstion-box"></div>
</div>
<hr>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
 
<form id="statement">

  <h4   style="text-align:center"><strong>FULL STATEMENT FOR  ACCOUNT NUMBER:<?php echo $account;?> </strong></h4>
<div  id="ministatement">

<div  class="table-responsive"> 
<table class="table "  id="reportstable" style="text-align:center;">
        <!--DWLayoutTable-->
      <thead>
        
        </thead>
       <tbody>
       <?php	 
	   
	   $x="SET @TTL=0";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SELECT A,B,C,D,E,F,G,H,transaction, (@TTL := H + @TTL) AS TTLSUM FROM   STATEMENTX  ORDER BY  A,ID  ASC ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		   ?>
  <tr>
<td  class="theader"  height="21" valign="top" > DATE </td>  
<td  class="theader"  style='text-align:left;'  height="21" valign="top" > TRANSACTION </td>  
<td  class="theader"   height="21" valign="top" >PREV  </td> 
<td  class="theader"  height="21" valign="top" > CURR</td>
<td  class="theader"  height="21" valign="top" > UNITS </td> 
<td  class="theader"  height="21" valign="top" >STANDING CHARGES  </td> 
<td  class="theader"  height="21" valign="top" >CHARGES  </td> 
<td  class="theader"    style='text-align:left;' height="21" valign="top" > TOTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> 
<td  class="theader" style='text-align:left;'   height="21" valign="top" > BALBF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
  			
		</tr>
		   <?php
		   
		   
		 while ($y=@mysqli_fetch_array($x))
		{ 
	echo"<tr  class='filterdata' >
                <td  >".$y['A']."</td>  <td  >".$y['transaction']." </td ><td    >".$y['C']."</td><td  >".$y['B']."</td>
				<td  >".$y['D']."</td><td  >".number_format($y['E'],2)."</td>
				<td  >".number_format($y['G'],2)."</td>
				<td  style='text-align:center;'  >".number_format(abs($y['H']),2)."</td>
				<td  >".number_format($y['TTLSUM'],2)."</td>
           </tr>";
		   
		 }
		 }

	?>
	 <tr>
<td   height="21" valign="top" >  </td>  
<td   height="21" valign="top" >  </td>
<td   height="21" valign="top" >  </td>
<td   height="21" valign="top" >  </td>
<td   height="21" valign="top" >  </td>
<td   height="21" valign="top" >  </td>
<td   height="21" valign="top" >TTL BILL</td>
<td   height="21" valign="top" >TTL DEBIT   </td>
<td   height="21" valign="top" >CUR BAL </td>
  			
		</tr>
		
	<tr   class="btn-info btn-sm">
<td  class="theader"  height="21" valign="top" ><?PHP
 	$x="SELECT MAX(A) FROM STATEMENTX      ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{echo $y['MAX(A)'];}}
 ?></td>  
<td  class="theader"  height="21" valign="top" >  </td>  
<td  class="theader"  height="21" valign="top" >  </td> 
<td  class="theader"  height="21" valign="top" >  </td>
 
<td  class="theader"  height="21" valign="top" ></td> 
<td  class="theader"  height="21" valign="top" >TOTAL</td> 
<td  class="theader"  height="21" valign="top" ><?php 
/*$x="SELECT SUM(H) FROM  STATEMENTX  WHERE TRANSACTION='CREDIT'      ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ echo number_format($y['SUM(H)'],2);}}*/
 ?></td> 
<td  class="theader"  height="21" valign="top" ><?php 
/*$x="SELECT  SUM(H) FROM  STATEMENTX  WHERE TRANSACTION='DEBIT' ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ echo number_format($y['SUM(H)'],2);}}*/
 ?> </td>
<td  class="theader"  height="21" valign="top" ><?php 
$x="SELECT SUM(H) FROM  STATEMENTX   ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ echo number_format($y['SUM(H)'],2);}}
 ?></td>
  	
		</tr>
		
        </tbody>
    </table></div>

</div>
<?php

$x="DROP TEMPORARY TABLE STATEMENTX ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
?>
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

