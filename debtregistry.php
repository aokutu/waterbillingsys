<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'DEBT REG' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$x="UPDATE DEBTREGISTRY tu,DEBTREGISTRY ts SET tu.PERIOD=(SELECT TIMESTAMPDIFF(MONTH,CURRENT_DATE,ts.date2)) WHERE ts.ID=tu.ID";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

			
$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
	$i=$y['number'];$wateraccountsx='wateraccounts'.$i;$accountstablex='accounts'.$i;$billstablex='bills'.$i; $nonwaterbillx='nonwaterbills'.$i;
	$b="UPDATE DEBTREGISTRY tu,DEBTREGISTRY ts SET 
tu.CURRENTBAL=((select IFNULL(SUM(balance),0) FROM $billstablex WHERE ACCOUNT=TS.ACCOUNT)+
(SELECT IFNULL(SUM(AMOUNT),0) FROM $nonwaterbillx WHERE ACCOUNT=TS.ACCOUNT  )-
(SELECT IFNULL(SUM(CREDIT),0) FROM $wateraccountsx WHERE ACCOUNT=TS.ACCOUNT AND CODE !=(SELECT CODE FROM PAYMENTCODE WHERE NAME REGEXP 'DEPOSIT' LIMIT  1) ) )
WHERE ts.ID=tu.ID AND ts.ZONE ='$i'";
$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		}}



$x="UPDATE DEBTREGISTRY tu,DEBTREGISTRY ts SET tu.INSTALLMENT=ts.CURRENTBAL/ts.PERIOD WHERE ts.ID=tu.ID";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT  ACCOUNT   FROM $accountstable ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
	$account=$y['ACCOUNT'];	

	
	$b="SELECT  SUM(CREDIT)  FROM $wateraccountstable WHERE ACCOUNT ='$account' ";
	$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{		
		 while ($y=@mysqli_fetch_array($b))
		{$deposit3 =$y['SUM(CREDIT)'];}}
		
	
	$b="SELECT  SUM(BALANCE)  FROM $billstable WHERE ACCOUNT ='$account' ";
	$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{		
		 while ($y=@mysqli_fetch_array($b))
		{$waterbill3=$y['SUM(BALANCE)'];}}
	
		$b="SELECT  SUM(AMOUNT)  FROM $nonwaterbills WHERE ACCOUNT ='$account'";
	$b=mysqli_query($connect,$b)or die(mysqli_error($connect));
		if(mysqli_num_rows($b)>0)
		{		
		 while ($y=@mysqli_fetch_array($b))
		{$nonwaterbill3=$y['SUM(AMOUNT)'];}}
	$finalbal=$waterbill3+$nonwaterbill3-$deposit3;
}}
		
		
$x="DELETE FROM DEBTREGISTRY WHERE CURRENTBAL <=0 "; mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM DEBTPAY WHERE ACCOUNT NOT IN (SELECT ACCOUNT FROM DEBTREGISTRY)";mysqli_query($connect,$x)or die(mysqli_error($connect));

?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;};{display:none;};}
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}

	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; } body {text-transform:inherit;}
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
   $('#newdebt').modal('show');
	$("#zonesearch").submit(function(){
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})


  $("#loaddetails").click(function()
{
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
$("#slip").load("accountsummary2.php #slip2");
});  return false;
 return false;
})

  $("#loadslip").click(function()
{
	var x=$("#actionx").val();    
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
if(x !='CONNECTED'){$("#slip").load("accountsummary2.php #slip2"); return false;}
else if(x =='CONNECTED'){$("#slip").load("accountsummary2.php #slip3"); return false;}
return false;});  return false;
 return false;
})



$("#accountstatus").submit(function(){
  var x=$("#actionx").val();    
	 if((x =='CONP')||(x=="COR"))
   {
	var x=confirm("CLIENT TO BE BILLED ");   
	 if(x ==false){return false; }  
   }
   
	
	$('#prepostmessage').modal('show');
$.post( "accountstatussummary.php",
$("#accountstatus").serialize(),
function(data){
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})




$("#editdebts").submit(function(){ 

 var act=$("#selectaction").val(); 
   if(act =='DELETE') 
   {
	var x=confirm("DELETE ?");   
	 if(x ==false){return false; }  
   }
   else  if(act =='DELETE2') 
   {
	var x=confirm("DELETE ?");   
	 if(x ==false){return false; }  
   }
$('#prepostmessage').modal('show');
$.post( "editdebts.php",
$("#editdebts").serialize(),
function(data){return false;});

var action=$("#selectaction").val();
if (action =='STATEMENT')
{
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $("#editdebts").load("debtstatement.php #debtstatement");  $('#message').modal('show');
return false;
}
else if (action =='DELETE')
{
	$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $("#editdebts").load("debtregistry.php #debtsregiststry");  $('#message').modal('show');
return false;
}

else if (action =='DELETE2')
{
	$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $("#editdebts").load("debtregistry.php #debtsregiststry");  $('#message').modal('show');
return false;
}

else 
{
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $("#editdebts").load("debtstatement.php #debtstatement");
return false;
	}

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
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="Click to add new zone" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newdebt"> DEBT REGISTRY</button> </a>
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
  

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
  <form class="modal fade" id="newdebt" role="dialog" method="post" action="newdebt.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ENTER DEBT DETAILS</div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >
	ACCOUNT NO.
	  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT NUMBER" data-placement="bottom">
<input  style='text-transform:uppercase'   name="account" type="text" size="15" placeholder="ENTER  ACCOUNT NUMBER"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div>
<br>
</div>
	<div class="col-sm-4"></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  <img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
 <div class="container">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>
<form id="editdebts" method="post" action="editdebts.php">
<div id="debtsregiststry">

<h4   style="text-align:center"><strong>DEBT REGISTRY  </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"    height="21" valign="top" >ACCOUNT 	  </td>
		  <td  class="theader"   height="21" valign="top" >INITIAL BAL	  </td>
		  <td  class="theader"   height="21" valign="top" >PERIOD	REMAINING  </td>
		<td  class="theader"   height="21" valign="top" >INSTALLMENT	  </td>
		<td  class="theader"   height="21" valign="top" >CURRENT BAL	  </td>
		<td  class="theader"   height="21" valign="top" >REGISTRY DATE </td>
		<td  class="theader"   height="21" valign="top" >LAST PAYMENT </td>
		<td  class="theader"   height="21" valign="top" >DEADLINE DATE</td>	
		
		<td  class="theader"   height="21" valign="top" >
<select class='form-control'   name='action' required="on"   id="selectaction" >
 <option value=''>SELECT ACTION</option>

			  <option value='STATEMENT'>VIEW STATEMENT</option> 
 <option value='DELETE'>DELETE DEBT</option> 			  
			  </select>
		</td>			
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT DEBTREGISTRY.*,TIMESTAMPDIFF(MONTH,CURRENT_DATE, DEBTREGISTRY.DATE2) AS periodx FROM DEBTREGISTRY,$accountstable  WHERE DEBTREGISTRY.ACCOUNT=$accountstable.ACCOUNT   ORDER BY DEBTREGISTRY.ID   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
                <td  >".$y['account']."</td>
				 <td>".number_format($y['initialbal'],2)."</td>
				  <td>".$y['periodx']." MONTHS</td>
				   <td>".number_format($y['installment'],2)."</td>
				     <td>".number_format($y['currentbal'],2)."</td>
				    <td>".$y['regdate']."</td>
					 <td>".$y['date']."</td>
					 <td>".$y['date2']."</td>
              <td ><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'></td> 
		
           </tr>";
		 }
		 }
		 
		 	$x="SELECT SUM(INITIALBAL),SUM(CURRENTBAL) FROM DEBTREGISTRY,$accountstable   WHERE DEBTREGISTRY.ACCOUNT=$accountstable.ACCOUNT   ORDER BY DEBTREGISTRY.ID   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='btn-info btn-sm'>
                <td  >TOTAL</td>
				 <td>".number_format($y['SUM(INITIALBAL)'],2)."</td>
				  <td></td>
				   <td></td>
				    
				     <td>".number_format($y['SUM(CURRENTBAL)'],2)."</td>
					 <td></td>
				    <td></td>
					 <td></td>
              <td ></td> 
		
           </tr>";
		 }
		 }
		 
		 

	?>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
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
    </select>    </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
<?php include_once("dashboard3.php"); include_once("chat.php");?>

  
  
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
