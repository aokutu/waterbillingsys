<?php
session_start();
include_once("password.php");
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
@$depositdate1=$_SESSION['depositdate1'];@$depositdate2=$_SESSION['depositdate2'];
if($depositdate1 == NULL ){$depositdate1=date('Y-m-d');}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW BILLS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:dashboard.php");exit;}

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
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
	</style>
	<style>
table{font-size:65%;}
  table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 3px; /* Adjust padding as needed */
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
	 if((x =='C.O.N.P')||(x=="C.O.R"))
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
	 
$("#acrange").submit(function()
{
$.post( "accountrange.php",
$("#acrange").serialize(),
function(data){	$("#content").load("message.php #content");$("#updatebillform").load("billing.php #billingtable");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

});  return false;
})
$("#acc2").click(function()
{
var account=$("#acc1").val();$("#acc2").val(account);
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
  

$("#updatebillform").submit(function()
{$('#prepostmessage').modal('show');
$.post( "waterbill2.php",
$("#updatebillform").serialize(),
function(data){
$("#content").load("message.php #content");$("#updatebillform").load("billing.php #billingtable");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
});  return false;
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
		url: "autocompletelibrary.php",
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
	    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH ACCOUNT" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#acrange">ACCOUNT</button>
	    </a>
	     <a data-html="true" href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="UPLOAD BILLS" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#billsupload">UPLOADS</button>
	    </a>
	     <button type="button" class="btn-info btn-sm" onclick="window.open('http://lawasco.co.ke/system/billingtemplate.php','_self');" >BILL  TEMPLATE</button>
	    
<button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
   
    <!-- Modal -->
  </div>

  <form id="updatebillform" action="waterbill2.php" method="post" >
<div  id="billingtable"> 
<div class="container">  
  <div class="row">
  <div class="col-sm-6"> <a href="#" title="ENTER" data-toggle="popover" data-trigger="hover" data-content="BILLING DATE" data-placement="bottom">
  <input type="date"  name="date"  id="date" required="on"  class="form-control input-sm"  value="<?php echo date("Y-m-d");?>" ></a></div>

<div class="col-sm-6"><input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">

</div>
 </div>
 
    <!-- Modal -->
  </div>
<h4   style="text-align:center"><strong>MULTIPLE BILLING FORM   FOR ACC <?php print $account1 ;?> TO <?php print $account2;?></strong></h4>

<table class="table"  id="smstable">
        <!--DWLayoutTable-->
        <thead>
        </thead>
        <tbody>
       <?php
$x="SELECT $accountstable.*,clientmetersreg.status AS meterstatus  FROM $accountstable,clientmetersreg  WHERE  $accountstable.account  >='$account1'   AND $accountstable.account  <='$account2'  AND $accountstable.account=clientmetersreg.account  AND $accountstable.SIZE>0 AND $accountstable.CLASS !='' AND $accountstable.email >=0  GROUP BY $accountstable.ACCOUNT ORDER BY $accountstable.account     ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		?>
          <tr>
		   <td  class="theader"  height="28" valign="top" >ACCOUNT</td> 
		    <td  class="theader"  height="28" valign="top" >STATUS</td> 
			<td  class="theader"  height="28" valign="top" >METER STATUS</td> 			
		    <td  class="theader"  height="28" valign="top" >PREVIOUS READING</td> 
				 <td  class="theader"  height="28" valign="top" >SET AVG </td>  
				  <td  class="theader"  height="28" valign="top" >SET AVG UNIT</td>  
			 <td  class="theader" width='8%' height="28" valign="top" >DATE </td>
			 
			  <td  class="theader"  height="28" valign="top" >
			  <a href="#" title="SELECT THE" data-toggle="popover" data-trigger="hover" data-content="  NEW READING TYPE" data-placement="bottom">
			  <select class="form-control"   required= "on"  name="billingtype"  id="action">
			    <option value="">SELECT ACTION </option>
			  <option value="1">NEW BILLING</option>
			  <option value="2">NEW METER READING</option>
			  <option value="3">SET AVG UNITS</option>
			   <option value="4">UNSET AVG UNITS</option>
			    <option value="5">USER DEFINED </option>
			   
			  </select></a> </td>
			   <td  class="theader"  height="28" valign="top" >DEDUCTION </td>
          </tr>
		
		
		
		<?php 
	
		 while ($y=@mysqli_fetch_array($x))
		 { 		$avgunit=$y['avgunit']; $avg=$y['avg'];   if($avg!='AVG'){$avg='RUNNING';$avgunit=NULL;}   echo"<tr class='filterdata'>
              <td>".$y['account']."</td> 
			  <td>".$y['status']."</td> 
				<td>".$y['meterstatus']."</td> 			  
			    <td>".$y['email']."</td>
				  <td>".$avg."</td>
				  <td>".$avgunit."</td>
			   <td  width='8%' >".$y['date2']."</td>
						   
<td>";


if($avgunit >0 ){  print "
<a href='#' title='AC ".$y['account']."' data-toggle='popover' data-trigger='hover' data-content='ENTER NEW READING' data-placement='bottom'>
</a>
<a href='#' title='AC ".$y['account']."' data-toggle='popover' data-trigger='hover' data-content='BILL USER AVG ' data-placement='bottom'>
<input  name='avgreading[".$y['account']."]' type='checkbox' value='".$avgunit."'   class='form-control input-sm'   autocomplete='off' >

</a>
 ";
 print  "</td> 
 <td><a href='#' title='AC ".$y['account']."' data-toggle='popover' data-trigger='hover' data-content='ENTER DEDUCTION ' data-placement='bottom'>
<input readonly  name='deduction[".$y['account']."]' min='1'  type='text'   pattern='[0-9.]+'  title='INVALID ENTRIES'  placeholder='DEDUCTION '    class='form-control input-sm'   autocomplete='off' ></a>
<a href='#' title='AC ".$y['account']."' data-toggle='popover' data-trigger='hover' data-content='BILL USER AVG ' data-placement='bottom'>
</a></td>
 ";
 
 }

else if($avgunit <1 ){  print "<a href='#' title='AC ".$y['account']."' data-toggle='popover' data-trigger='hover' data-content='ENTER NEW READING' data-placement='bottom'>
<input  name='currentreading[".$y['account']."]' type='text'   pattern='[0-9.]+'  title='INVALID ENTRIES'  placeholder='NEW READING  '    class='form-control input-sm'   autocomplete='off' ></a>
<a href='#' title='AC ".$y['account']."' data-toggle='popover' data-trigger='hover' data-content='BILL USER AVG ' data-placement='bottom'>
</a>  ";
print  "</td>
 <td><a href='#' title='AC ".$y['account']."' data-toggle='popover' data-trigger='hover' data-content='ENTER DEDUCTION ' data-placement='bottom'>
<input readonly name='deduction[".$y['account']."]' min='1'  type='text'   pattern='[0-9.]+'  title='INVALID ENTRIES'  placeholder='DEDUCTION '    class='form-control input-sm'   autocomplete='off' ></a>
<a href='#' title='AC ".$y['account']."' data-toggle='popover' data-trigger='hover' data-content='BILL USER AVG ' data-placement='bottom'>
</a></td>
";

}

/**/
echo "


</tr>";
		 }
		 
		 } 
		 
		 else {
	echo ' <tr>
	<td    height="28" valign="top" >  </td>	
		   <td    height="28" valign="top" >ACCOUNT</td> 
	   <td    height="28" valign="top" ></td> 
		    <td    height="28" valign="top" >MISSING</td>     
			 <td    height="28" valign="top" ></td>
				<td    height="28" valign="top" ></td> 
			 <td>xxx</td>	
			  
          </tr>	';	 
		 }
		 
	
		?>

        </tbody>
    </table>
 <br><br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
	  
</div>
</form>
 
 <form class="modal fade" id="acrange" role="dialog" method="post"  action="accountrange.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ENTER ACCOUNT RANGE</div></div>
  <div class="container">
  <div class="row">
    <div class="col-sm-8" >
        <div>
    <input  autocomplete="off" list="accountslist" type="text" name="account1"  value="<?php print $_SESSION['account1'];?>"   autocomplete   id="account1"  class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (11) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase'  placeholder="ENTER   MIN ACC NUMBER" required="on" />
        </div><br>
		<div>
    <input  autocomplete="off" list="accountslist" type="text" name="account2"  value="<?php print $_SESSION['account2'];?>"   autocomplete     id="account2"   class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (11) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase' placeholder="ENTER   MAX ACC NUMBER" required="on"  />
        
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
		
		</div><br>
    </div>
     <div class="col-sm-4" ></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn btn-default" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
 
  <form class="modal fade" id="billsupload" role="dialog" method="post" enctype="multipart/form-data"  action="billsupload.php">
  
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">SELECT DATE RANGE</div></div>
  <div class="container">
  <div class="row">
    <div class="col-sm-8" >
         <a href="#" title="SELECT  BILLSUPLOAD FILE " data-toggle="popover" data-trigger="hover" data-content="(Comma Delimeter File)" data-placement="bottom">
	BILLING DATE
	<input type="date" name="billingdate"  class="form-control input-sm" required="required" >
<br>
	<input type="file" name="file"  id="file"   class="form-control input-sm"   required="required" accept=".txt" />
	<div style=" text-align:center;font-family:bold;">
	|ACCOUNT |PREV |CURRENT|</div> 
	<br>
    </div>
     <div class="col-sm-4" ></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn btn-default" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
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
