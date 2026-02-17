<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
include_once("loggedstatus.php");
include_once("password.php");
@$depositdate1=$_SESSION['depositdate1'];@$depositdate2=$_SESSION['depositdate2'];
if($depositdate1 == NULL ){$depositdate1=date('Y-m-d');}

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'VIEW RECIEPTS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
  else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
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
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
  </style>
  	<style>
	
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
table{ font-size: 80%;}  #reciept{ font-size: 80%;} 
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            
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
    text-align:left;
  }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	

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
  
 



$("#acrange").submit(function()
{	
$('#prepostmessage').modal('show');
$.post( "depositslipsrange.php",
$("#acrange").serialize(),
function(data){ 
$("#content").load("message.php #content");$("#delslip").load("reciepts.php #slipstable");
$('#acrange').modal('hide');  $('#prepostmessage').modal('hide'); $('#message').modal('show'); 
});
 return false;
})

$("#delslip").submit(function()
{
	
 var act=$("#slipsaction").val();
 if(act =='REVERSE')
   {
	var x=confirm("REVERSE ?");   
	 if(x ==false){return false; }  
	 
	 
	 //////////////
$.post( "reciept2.php",
$("#delslip").serialize(),
function(data){ 

if(act=='REVERSE'){ $("#content").load("message.php #content");$('#message').modal('show');
 $('#prepostmessage').modal('hide');$("#delslip").load("reciepts.php #slipstable");return false;}

/// $("#delslip").load("reciepts.php #slipstable");
}); 	 
	 return false;
	 ////////////////
   }
 

 if(act=='PRINT'){}
 
 return true;
	})

	

$("#reciept").submit(function()
{	
if ($("#action1").is(':checked')){return true;}
$('#prepostmessage').modal('show');
$.post( "processreciept.php",
$("#reciept").serialize(),
function(data){ 
$("#content").load("message.php #content");$("#delslip").load("reciepts.php #slipstable");
$("#slips").load("reciepts.php #receiptslist");
$('#reciept').modal('hide');  $('#prepostmessage').modal('hide'); $('#message').modal('show'); 
});
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
		url: "searchtransaction.php",
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

<script>
$(document).ready(function(){
	$("#autosearch1").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autosearch.php",
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

 <div class="container">
  <div class="row">
  <div class="col-sm-12">
  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SET  RANGE" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#acrange">AC-DATE RANGE</button></a>
  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW  BANK SLIP" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#reciept">NEW  RECIEPT</button></a>
 
   
   <button class="btn-info btn-sm" onclick="window.print()">PRINT</button><br />
   <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  </div></div></div>
  
   
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
 <form class="modal fade" id="reciept" role="dialog"    action="processreciept.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  <h3 style="text-align:center;">RECIEPT DETAILS</h3>
  <div class="frmSearch">PAY REFFERENCE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom">
<input  list="receiptslist"   style='text-transform:uppercase' name="payid" type="text" size="15" placeholder="SELECT PAY DETAILS."  required="on"  class="form-control input-sm"     pattern="[0-9a-zA-Z- ]+"  title="INVALID ENTRIES "  autocomplete="off" ></a>



</div>
<div id="slips" >
		 <datalist style="width:50px;" id="receiptslist">
	<?php 
$x ="SELECT CONCAT($wateraccountstable.transaction,$wateraccountstable.depositdate) AS details,$wateraccountstable.transaction,$wateraccountstable.id,$wateraccountstable.account,$accountstable.client,$wateraccountstable.depositdate,$wateraccountstable.code,$wateraccountstable.credit FROM  $wateraccountstable,$accountstable  where  $wateraccountstable.account like  '" . $_POST["keyword"] . "%' AND  $wateraccountstable.account=$accountstable.account AND $wateraccountstable.STATUS ='' AND RECIEPTNUMBER=''  GROUP BY CONCAT(TRANSACTION,DEPOSITDATE)  ORDER BY $wateraccountstable.account  LIMIT 8";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['details']."'> ".$y['account']." | ".$y['client']." | ".$y['depositdate']." | ".$y['transaction']." | ".number_format($y['credit'],2)."</option>";	
		}}

?> 
 </datalist>
 </div>
 
</div></div></div>
<br>			  


  <br>
RECIEPT NUMBER : <?php 
/*
$maxreciepts=array();

	$a="SELECT  CONCAT('WATERACCOUNTS',NUMBER) AS WTBLX FROM zones; ";
	$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
		{
		
		 while ($c=@mysqli_fetch_array($a))
		{
	$x="SELECT  MAX(RECIEPTNUMBER) AS RCPT FROM ".$c['WTBLX']."  ";	
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ 
	array_push($maxreciepts,$y['RCPT']);
	}}	
			
		}}
		
		foreach($maxreciepts as $key =>$data)
{ 
	if($data ==0){unset($maxreciepts[$key]);}
}

		foreach($maxreciepts as $key =>$data)
{ 
	 print $data.'<br>';
}
 $newrecieptnumber =max($maxreciepts)+1;
 print $newrecieptnumber;
*/
 //$newrecieptnumber =max($maxreciepts)+1;  $newrecieptnumber2= sprintf("%07d", $newrecieptnumber);
		
?>
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  RECIEPT NUMBER" data-placement="bottom">

<input type="number" disabled  value="<?php echo $newrecieptnumber; ?>" class="form-control input-sm" name="recieptnumber" id="transactioncode" pattern="[0-9]+"  title="ENTER CAPITAL ALPHA NUMERIC "  style='text-transform:uppercase'  required="on"  placeholder="NEW RECEIPT NUMBER" autosearch="off">
</a>
			  <hr>
			  
RECIEPTING DATE:
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  RECIEPTING DATE" data-placement="bottom">

<input type="date" class="form-control input-sm" name="recieptdate" id="recieptdate"  required="on"  autosearch="off">
</a>

<br />
<br> <label class="checkbox-inline"> 
        <input type="radio" name="action"  id="action1" value="PRINT" >PRINT
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="action"  checked id="action2"   value="NO PRINT">IGNORE PRINT
     </label> 
<hr>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
  
  
  
 <form class="modal fade" id="acrange" role="dialog" method="post"  action="depositslipsrange.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>

    <input  autocomplete="off" list="accountslist"  type="text" name="account1"  value="<?php print $_SESSION['account1'];?>"   autocomplete   id="account1"  class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase'  placeholder="ENTER   MIN ACC NUMBER" required="on" />
        </div><br>
		<div>
    <input  autocomplete="off" list="accountslist"  type="text" name="account2"  value="<?php print $_SESSION['account2'];?>"   autocomplete     id="account2"   class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase' placeholder="ENTER   MAX ACC NUMBER" required="on"  />
        </div><br>
        <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
		 <datalist id="accountslist">
	<?php 
	
		$a="SELECT  CONCAT('accounts',NUMBER) AS ACTBLX FROM zones; ";
	$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
		{
		
		 while ($c=@mysqli_fetch_array($a))
		{
			
 $x="SELECT DISTINCT ACCOUNT,CLIENT FROM  ".$c['ACTBLX']." ORDER BY ACCOUNT    ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['ACCOUNT']."'>".$y['ACCOUNT']."  ".$y['CLIENT']."</option>";	
		} 
		
		}			
			
		}
		
		}

?> 
 </datalist>
 
 <br />
FROM<input type="date" class="form-control input-sm" name="date1" id="acc1"  autosearch="off"><br />
TO<input type="date" class="form-control input-sm"   name="date2" id="acc2"  autosearch="off"><br />
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
  <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
   <div class="container">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>  
<form id="delslip" method="post" action="reciept2.php">
<div  id="slipstable">

<h4   style="text-align:center"><strong>RECEIPTS  FOR ACC <?php print $account1 ;?> TO <?php print $account2;?> AS  FROM  <?php print   $depositdate1; ?> TO <?php print  $depositdate2; ?></strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          
        </thead>
        <tbody>
            <tr>
		  <td  class="theader"  height="28" valign="top" >RECIEPT DATE </td>
		  <td  class="theader"  height="28" valign="top" >RECIEPT</td> 
		   		   <td  class="theader"  height="28" valign="top" >ACCOUNT </td>     
		    <td  class="theader"  height="28"   width="30%" valign="top" >NAME</td>
			
			 	
<td  class="theader"  height="28" valign="top" >AMOUNT</td>
<td width='30%' class="theader"  height="28" valign="top" >DEPOSIT DETAILS</td>
				 
			   
			  
			    <td  class="theader"  height="28" valign="top" >	
				<select class="form-control" id ="slipsaction"   name="action" required="on">
 <option value="">ACTION</option>
 <option value="REVERSE">REVERSE RECIEPT </option>
 <option value="PRINT">MASS PRINT</option>
 </select></td> 
		 			  
          </tr>
        <?php
	$a="SELECT CONCAT('wateraccounts',NUMBER) AS WTBLX, CONCAT('accounts',NUMBER) AS ACTBLX FROM zones; ";
	$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
		{
		
		 while ($c=@mysqli_fetch_array($a))
		{
		 $x="select  ".$c['WTBLX'].".recieptnumber,".$c['ACTBLX'].".client,sum(credit),".$c['WTBLX'].".*,".$c['WTBLX'].".recieptnumber as  identity  FROM ".$c['WTBLX'].",".$c['ACTBLX']."  where ".$c['ACTBLX'].".account=".$c['WTBLX'].".account AND  ".$c['WTBLX'].".date >='$depositdate1'   AND  ".$c['WTBLX'].".date <='$depositdate2'   AND ".$c['ACTBLX'].".account >='$account1'  AND ".$c['ACTBLX'].".account  <='$account2'  AND ".$c['WTBLX'].".STATUS='RECIEPTED'  GROUP BY RECIEPTNUMBER";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	$reciept=$y['recieptnumber'];	   echo"<tr class='filterdata'>
	  <td>".$y['date']."</td>
				 <td>".sprintf("%07d",$y['recieptnumber'])."</td>  	  
              <td>".$y['account']."</td>  
			    <td  width='30%' >".$y['client']."</td>
			  
			    <td>".number_format($y['sum(credit)'],2)."</td>
			  
			<td width='30%'>
	<details><summary>DETAILS</summary>";
	$n="SELECT DEPOSITDATE,TRANSACTION,CREDIT,PAYPOINT,CODE FROM ".$c['WTBLX']." WHERE RECIEPTNUMBER=".$y['recieptnumber']."  ";
	$n=mysqli_query($connect,$n)or die(mysqli_error($connect));
		if(mysqli_num_rows($n)>0)
		{
		
		 while ($y=@mysqli_fetch_array($n))
		{ 
	print $y['PAYPOINT']."|".$y['DEPOSITDATE']." ".$y['TRANSACTION']."|".$y['CODE']."|".number_format($y['CREDIT'],2)."<hr>";
	}}
	
	print" </details>
<a href='#'  data-html='true' title='TRANSACTION DETAILS' style='width:250px;'  data-toggle='popover' data-trigger='click' data-content='"; 
print "";

	
	
print "' data-placement='bottom'>

</a>
         
        			
			</td>
			
			  <td><input name='del[]' type='checkbox' value='".$reciept."'   class='form-control input-sm'> </td>    
				
           </tr>";
		 }
		 
		 }   
		 
		}}

		 
	 $x="select  SUM(credit)  FROM $wateraccountstable,$accountstable  where $accountstable.account=$wateraccountstable.account AND  $wateraccountstable.depositdate >='$depositdate1'   AND  $wateraccountstable.depositdate <='$depositdate2'   AND $accountstable.account >='$account1'  AND $accountstable.account  <='$account2' AND $wateraccountstable.STATUS ='RECIEPTED'";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	 $ttl=number_format($y['SUM(credit)'],2);$ttlacs=$y['TTLACS'];
		 }
		 
		 }
		 
		 
		?>
		
			  <tr  class="btn-info btn-sm" >
		  
		  <td  class="theader"    valign="top"></td>
		  <td  valign="top"></td>
		  <td width="30%"  valign="top"></td>
			
				  <td  valign="top">TOTAL AMNT</td>
				  <td  valign="top"><?php print $ttl;?> </td>
				  
		 <td width='30%' valign="top"></td><td  valign="top"></td>
					
		  </tr>
		  
		  
		  <tr   class="btn-info btn-sm"  >
		 
		 		
		  </tr>
	
        </tbody>
    </table>
<br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
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
