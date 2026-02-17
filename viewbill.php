<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$account=$_SESSION['min2'];  if( $account <1 ){ $account =1;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;}} #footer{ font-weight:bolder;} 
#levelchart{ width:80%;}
  </style>
  
		  <style type="text/css" >
	
  </style>
	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
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
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $('#searchaccount').modal('show');

	$("#searchaccount").submit(function()
{$('#prepostmessage').modal('show');

$.post( "statementaccountsettings.php",
$("#searchaccount").serialize(),
function(data){$('#prepostmessage').modal('hide');

});  return true;
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
<body>
<div class="container">
 <?php	 
$x="SELECT * FROM $accountstable  WHERE  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $_SESSION['client']=$y['client'];$account=$y['account']; $status=$y['status'];$contact=$y['contact'];  $size=$y['size']; $class=$y['class']; $lastreading=$y['email']; $meternumber=$y['meternumber'];}}
	 ?>
  <!-- Trigger the modal with a button -->

  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
	    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH ACCOUNT" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#searchaccount">ACCOUNT DETAILS</button>
	    </a>


   <button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
   
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
  
  <form class="modal fade" id="searchaccount" role="dialog"    action="statementaccountsettings.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  
  <div class="frmSearch">
ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input style='text-transform:uppercase' name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>


<div id="suggesstion-box"></div>
</div>
<br>FROM DATE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  START DATE" data-placement="bottom"><input  type="date"  name="date1"  required="on" class="form-control input-sm" value="<?php $yr= date("Y")-5; echo $yr.date("-m-d");?>" ></a>
<br>TO DATE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  LAST  DATE" data-placement="bottom"><input  type="date"  name="date2"   required="on" class="form-control input-sm"  value="<?php echo date("Y-m-d");?>" ></a>
<hr>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
 
<form id="statement">
<img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
	<h4   style="text-align:center"><strong>BILLING REPORT  FROM   <?php print $date1;?> TO <?php print $date2;?> FOR ACCOUNT <?php print $account;?></strong></h4>
	<table class="table "  id="reportstable">
	<thead>
          <td   class="theader"  height="21" valign="top" >Bill No</td>
            <td   class="theader"  height="21" valign="top" >Previous.</td>
            <td  class="theader" valign="top">Current</td>
			<td  class="theader" valign="top">Units</td>
			<td  class="theader" valign="top">Charges</td>
			<td  class="theader" valign="top">Meter</td>
			<td  class="theader" valign="top">Refuse</td>
			<td  class="theader" valign="top">Total</td>
			<td  class="theader" valign="top">Date</td>
        </thead>
		
 <tbody>
		
		
          <?php
		  $totalcharges=0;
$x="SELECT id,previous,current,units,charges,metercharges,refuse,balance,date FROM   $billstable  WHERE   date>='$date1'  AND   date<='$date2'   AND  account='$account'  ORDER  BY  date   ASC ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {$totalcharges+=$y['charges']+$y['metercharges']+$y['refuse'];
		 
		   echo"<tr   class='filterdata'>
		    <td  >".$y['id']."</td>
                <td  >".$y['previous']."</td>
                <td >".$y['current']."</td>
                <td>".$y['units']."</td> 
			 <td>".number_format($y['charges'],2)."</td>
			 <td>".number_format($y['metercharges'],2)."</td>
			 <td>".number_format($y['refuse'],2)."</td> 
			 <td>".number_format($y['balance'],2)."</td> 
				  <td>".$y['date']."</td>         
           </tr>";
		 }
		 }
 $totalcharges=0;

	?>
	
	<?php
 $x="SELECT SUM(balance) FROM  $billstable  WHERE   date>='$date1'  AND   date<='$date2'   AND  account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		print ("<tr class='theader'><td></td><td></td><td></td><td></td><td></td><td></td><td>Bill</td><td>");
		 while ($y=@mysqli_fetch_array($x))
		 {
		   $currentbill=  $y['SUM(balance)'];
		 }
		 }
	
	echo number_format($currentbill+$previousbill,2);
	$totalbill= $currentbill+$previousbill;;
	?></td><td></td></tr> 
	 
		         
		  	    <tr id="footer"  class="btn-info btn-sm" >
		  <td     height="21" valign="top" >ATTENDANT  </td>
            <td     height="21" valign="top" ><?php echo $user;?></td>
            <td   valign="top">MONTH.</td>
			<td   valign="top"><?php echo $_SESSION['month'];?></td>
			<td valign="top">PRINT DATE</td>
			<td  valign="top"><?php print date("Y-m-d"); ?></td>
			<td   valign="top"></td>
			<td  valign="top"></td>
			<td   valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td></h4>
          </tr>
        </tbody>
		
	</table>
	</div>

</form>
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
<?php  include_once("dashboard3.php");  include_once("chat.php");?>

  
   <form class="modal fade" id="accountstatus" role="dialog" method="post"  action="accountstatussummary.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
<div class="container">
  <div class="row">
  <div class="col-sm-8" >
 <div id="accountdetails"><br>
  <select class="form-control input-sm"  id="loadedzone"  name="zone" required="on" >
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
	<br>
	ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT"  title="eleven digits" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"     autocomplete="on" ></a><br />
</div>
<br>
<div id="acstatus">current status</div><br><input type="date"  name="date"  id="date"  class="form-control input-sm" required="on" ><br>
<br>
  <select class="form-control input-sm"  id="actionx" name="action" required="on" >
<option value=''>SELECT ACTION</option>
<option value='CONP'>CONP</option>
<option value='COR'>COR</option>
<option value='CONNECTED'>RE-CONNECTION</option>
<option value='FUNCTION'>FUNCTION</div>
<option value='MALFUNCTION'>MALFUNCTION</div>
<option value="STOLEN">STOLEN</option>
</select>
	
<br>

<div  id="slip"></div>
<br>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button>
  <button type="button" class="btn-info btn-sm"  id="loaddetails">LOAD DETAILS</button>  
  <button type="button" class="btn-info btn-sm"  id="loadslip">LOAD SLIP</button>
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>

  </div>
    <div class="col-sm-4" > </div>
  </div>
  </div>
  </div>
  </div>
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
