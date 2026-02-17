<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
if($date1 == NULL ){$date1=date('Y-m-d');}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW BILLS'";
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
table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:right;
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
     $("#delbillx").submit(function(){
	  var x=$('#billsaction').val();
  if(x =='DELETE')
   {
	var x=confirm("DELETE ?");   
	 if(x ==false){return false; }  
   }
   else  if(x =='PRINT')
   {
	var x=confirm("PRINT INVOICE ?");   
	 if(x ==false){return false; }  
   }
   
	   $('#prepostmessage').modal('show');
$.post("editnonwaterbills.php",$("#delbill").serialize(),function (data){
$("#content").load("message.php #content");$("#delbill").load("nonwaterbillsreport.php #billstable"); $('#prepostmessage').modal('hide'); $('#message').modal('show'); 
})
return false;
})

$("#acrange").submit(function(){$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#acrange").serialize(),
function(data){
$("#content").load("message.php #content");$("#delbill").load("nonwaterbillsreport.php #billstable"); $('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

 
 $("#newbill").submit(function(){$('#prepostmessage').modal('show');
$.post( "newnonwaterbill.php",
$("#newbill").serialize(),
function(data){
$("#content").load("message.php #content");$("#delbill").load("nonwaterbillsreport.php #billstable"); $('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
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
  <div class="row">
  <div class="col-sm-12">
  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SET  RANGE" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#acrange">AC-DATE RANGE</button></a>
    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW NON WATER BILL" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newbill">NEW BILL</button></a>
   
    
  <button class="btn-info btn-sm" onclick="window.print()">PRINT</button><br />
   <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  </div></div></div>
  
   <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
 <div class="container">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>   
<form id="delbill" method="post" action="editnonwaterbills.php">

<div  id="billstable">
  <h4   style="text-align:center"><strong>NON WATER BILLS FOR ACC <?php print $account1 ;?> TO <?php print $account2;?> FROM  <?php print   $date1; ?>  TO  <?php print  $date2; ?>   </strong></h4>

<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
      
        </thead>
        <tbody>
        <?php
$x="SELECT * FROM $nonwaterbills WHERE   date>='$date1'  AND    date<='$date2'  
   AND    account >='$account1'   AND    account <='$account2'  ORDER BY  account,date  ASC";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
	?>
	    <tr>
		
		 <td class="theader"   valign="top">ACCOUNT</td>		
		  <td  class="theader" valign="top">METER NO.</td>
            <td   class="theader"  height="21" valign="top" >BILL TYPE</td>
            <td  class="theader" valign="top">AMOUNT</td>
			<td  class="theader"  valign="top">DATE</td>
			
			<td class="theader"  valign="top">
			<select class="form-control" id ="billsaction"   name="action" required="on">
 <option value="">ACTION</option>
 <option value="DELETE">DELETE </option>
 <option value="PRINT">PRINT INVOICE</option>

 </select></td>
          </tr>
	<?php
		 while ($y=@mysqli_fetch_array($x))
		 { 	$charges=$y['balance'];	   
	 echo"<tr class='filterdata'>	
             <td  >".$y['account']."</td>
		  
		   <td >".$y['meternumber']."</td>
           <td  >".$y['name']."</td>
			<td  >".number_format($y['amount'],2).  "</td>
				<td  >".$y['date']."</td>
			
				<td  ><input type='checkbox'   name ='del[]'  value='".$y['id']."'   class='form-control input-sm'></td>  
				
           </tr>";
		 }
		 
		 }  ?>
		 
		  <tr   class="btn-info btn-sm" >
		 
		  <td  valign="top"></td>
		  <td  valign="top"></td>
		  <td  valign="top">TOTAL</td>
		 <td  valign="top"><?php 
		 
		 $x="SELECT SUM(AMOUNT) FROM $nonwaterbills WHERE   date>='$date1'  AND    date<='$date2'  
   AND    account >='$account1'   AND    account <='$account2'  ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{print  number_format($y['SUM(AMOUNT)'],2); }}
		 ?>  </td>
			<td  valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
			
			<td  valign="top"></td>
			</tr>
        </tbody>
    </table>
<br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>
</form>
 
    
 <form class="modal fade" id="acrange" role="dialog" method="post"  action="nonwaterbillsession.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
    <input list="accountslist" type="text" name="account1"  value="<?php print $_SESSION['account1'];?>"   autocomplete="off"   id="account1"  class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase'  placeholder="ENTER   MIN ACC NUMBER" required="on" />
        </div><br>
		<div>
    <input list="accountslist" type="text" name="account2"  value="<?php print $_SESSION['account2'];?>"   autocomplete="off"     id="account2"   class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase' placeholder="ENTER   MAX ACC NUMBER" required="on"  />
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
  
    <form class="modal fade" id="newbill" role="dialog"    action="newnonwaterbill.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header">ENTER THE NON WATER BILL DETAILS<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  ACCOUNT NO.
  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>
<div id="suggesstion-box"></div>
</div>
<br>
SELECT BILLING TYPE
<select class="form-control"   required= "on"  name="billid"  id="billid">
			   <option value="">SELECT THE NON WATER BILL TYPE</option>
		 <?php 
$x="SELECT * FROM paymentcode  ORDER BY  code ASC "  ;
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ 
	print "<option value='".$y['code']."'>".$y['name']." CODE ".$y['code']." CHARGES ".number_format($y['charges'],2)."</option>";
	}}		   
?>	   
		<option value=""></option>	  
			  </select>
			  
<br>
ENTER AMOUNT
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  AMOUNT" data-placement="bottom">
<input  style='text-transform:uppercase' name="amount" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES " size="15" placeholder="ENTER BILL AMOUNT." class="form-control input-sm"    title="ENTER AMOUNT"  autocomplete="off" ></a>

<br>
TRANSACTION DATE
<input type="date" class="form-control input-sm" name="trdate" id="trdate" required="on" autosearch="off"><br /><br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
  
  
  
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

