<?php
@session_start();
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$account1=$_POST['account1'];
@$account2=$_POST['account2'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'POST SMS-EMAILS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
@$account1=$_POST['account1'];
@$account2=$_POST['account2'];
$_SESSION['account1']=$account1;
$_SESSION['account2']=$account2;
$lastaccount=strtoupper(addslashes($_POST['lastaccount']));
$x="CREATE TEMPORARY TABLE REPORT1(ACCOUNT TEXT,CREDIT  FLOAT,DEBIT FLOAT,CUBIC FLOAT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="CREATE TEMPORARY TABLE CHARGES(ACCOUNT TEXT,NAME TEXT,CURRENTREADING TEXT,CHARGES  FLOAT,DATE DATE);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  REPORT1(account,credit)  SELECT $billstable.account,SUM($billstable.balance)  FROM  $billstable  WHERE $billstable.account >='$account1' AND  $billstable.account <='$account2'  GROUP BY $billstable.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE REPORT1   SET   debit=0  WHERE  debit  IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  REPORT1(account,debit)  SELECT $wateraccountstable.account,SUM($wateraccountstable.credit)  FROM $wateraccountstable  WHERE    $wateraccountstable.account >='$account1'   AND $wateraccountstable.account <='$account2'     AND $wateraccountstable.code =(SELECT CODE FROM paymentcode  WHERE NAME ='WATER BILL' LIMIT 1) GROUP BY $wateraccountstable.account";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  CHARGES(account,charges)  SELECT  account ,SUM(credit)-SUM(debit)  AS  total   FROM REPORT1  GROUP BY account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE REPORT1   SET   credit=0  WHERE  credit   IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE CHARGES AS U1, $accountstable AS U2  SET U1.name = U2.client,U1.currentreading=U2.email,  U1.date=U2.date2    WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect)); 
////////////////SMS////////////
$x="CREATE TEMPORARY TABLE `smsreport` (
  `id` bigint(20) NOT NULL,
  `account` text NOT NULL,
  `previous` float NOT NULL,
  `current` float NOT NULL,
  `consumtion` float NOT NULL,
  `bill` float NOT NULL,
  `balbf` float NOT NULL,
  `totalbill` float NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="ALTER TABLE `smsreport`
  ADD PRIMARY KEY (`id`);";
  mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `smsreport`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="TRUNCATE TABLE smsreport";mysqli_query($connect,$x)or die(mysqli_error($connect));
//**********$x="insert into sms (account,previous,current,consumtion,date,billid) select t1.account,t1.previous,t1.current,t1.units,t1.date,t1.id  FROM  $billstable t1  join(select date,account,max(id) id  FROM  $billstable group  by account)  t2  on t1.id=t2.id  and t1.account=t2.account  and  t1.account >='$account1'  and  t1.account <='$account2'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="insert into smsreport (account,date) select account,max(date) from $billstable where account >='$account1' AND account <='$account2' GROUP BY ACCOUNT ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE smsreport AS U1, $billstable AS U2  SET U1.previous= U2.previous ,  U1.current= U2.current , U1.bill= U2.balance , U1.consumtion=U2.units       WHERE U2.account = U1.account AND U2.date=U1.date  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
//**********$x="UPDATE sms AS U1, $billstable AS U2  SET U1.bill= U2.balance ,U1.consumtion=U2.units  WHERE U2.id = U1.billid";mysqli_query($connect,$x)or die(mysqli_error($connect));*/
$x="UPDATE smsreport AS U1, CHARGES AS U2  SET U1.totalbill= U2.charges   WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE smsreport tu, smsreport ts SET tu.balbf = ts.totalbill-ts.bill where tu.id=ts.id";mysqli_query($connect,$x)or die(mysqli_error($connect));
//**********$x="INSERT INTO  sms(account,totalbill)  SELECT $accountstable.account,CONCAT(0)  FROM  $accountstable  WHERE $accountstable.account >='$account1' AND  $accountstable.account <='$account2'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="DROP TEMPORARY TABLE REPORT1";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DROP TEMPORARY TABLE CHARGES";mysqli_query($connect,$x)or die(mysqli_error($connect));

?>
 
 <!--DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
@media print { select{display:none;} #searchtext{display:none;} button{display:none;}; tbody{ overflow:visible;} tbody{ overflow:visible;}}
body{font-size:170%;}
#levelchart{ width:80%;}
  </style>
  	<style>
	
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
.dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}


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
			   text-align:center;
			 text-align:center;
			 }
.btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }			 
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $('#acrange').modal('show');
$("#postbillsms").load("sms3.php #smstable"); 
$("#postbillsms").submit(function(){ $('#prepostmessage').modal('show');
$.post( "postbillsms.php",
$("#postbillsms").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#prepostmessage').modal('hide'); $('#message').modal('show');
$("#postbillsms").load("sms3.php #smstable");
});
return false;
})


$("#filter").submit(function(){$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#filter").serialize(),
function(data){ 
$("#content").load("message.php #content"); 
$('#prepostmessage').modal('hide'); $('#message').modal('show');
$("#postbillsms").load("sms3.php #smstable");

return false;});
return false;
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
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="FILTER " data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#filter">FILTER</button></a>


   <button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
 <div class="container">
  <div class="row">
  <div class="col-sm-4" ></div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>
    
<form id="postbillsms" method="post" action="postbillsms.php" style="font-size:170%;">

</form>
<form class="modal fade" id="filter" role="dialog" method="post" action="filter.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">MINIMUM BALANCE</div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER MINIMUM VALUE" data-placement="bottom">
<input  style='text-transform:uppercase'   pattern="[0-9]+"  title="ENTER  NUMERIC VALUES"  name="balance" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES " size="15" placeholder="ENTER  MINIMUM VALUE"  required="on"  class="form-control input-sm"   autocomplete="off" >
</a>

<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ACTION" data-placement="bottom">
     <label class="checkbox-inline"> 
        <input type="radio" name="action"     id="optionsRadios3" 
            value="1" >UNITS
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="action" id="optionsRadios4" 
            value="2">CURRENT BALANCE
     </label> 
	   <label class="checkbox-inline"> 
        <input type="radio" name="action" id="optionsRadios4" 
            value="3"> ACCUMULATIVE BALANCE
     </label> </a>
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
 