<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
@$min=$_SESSION['min'];@$max=$_SESSION['max'];@$min2=$_SESSION['min2'];@$max2=$_SESSION['max2'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'BILLING' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?><!doctype html>
<html  lang="us">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Example Page</title>
	<link href="stylesheets/jquery-ui.css" rel="stylesheet">
	<link href="stylesheets/forms.css" rel="stylesheet">
				<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
	<style media="all" type="text/css">.credit{background-color: #FF9900;} .credit:hover { background-color: #999999;} .debit{ background-color:#0099CC;}  .debit:hover { background-color: #999999;}  .tableheader{width:100%; border:thin; border:#333333;}
	
.right{ width:50%; float:right;}.left{width:50%; float:left;} fieldset{border-radius:3%;}
	 </style>
	<script src="pluggins/dhtmlxcalendar.js"></script>
	<script src="pluggins/date.js"></script>
<script src="pluggins/jquery.form.js"></script> 
		<SCRIPT type="text/javascript">

    window.history.forward();

    function noBackx() { window.history.forward(); }

</SCRIPT>
</head>
<body   oncontextmenu="return false;"  onLoad="noBack();">

<div id="tabs">
	<ul>	<li>
		<li><a href="#tabs-9">EDIT A/c II   </a></li>
	
		<li><a href="#tabs-11">Credit   </a></li>

		</ul>
	<div  id="tabs-9"><form  action="meterupdate.php"   method="post"   id="meterupdate">
	<input type="text" class="searchtext" placeholder="Type to search">
		<div class="tbl_container" >
	<table class="table"  id="session">
            <!--DWLayoutTable-->
            <thead>
              <tr>
				 <td class="search"  valign="top">Account</td>
				 <td  class="theader"  valign="top" >Meter </td>
				
				<td  class="theader"  valign="top" >Balance </td>
              </tr>
            </thead>
            <tbody>
	<?php
	$x="SELECT * FROM $accountstable  WHERE    account >=$min2  AND   account <=$max2  ORDER BY  account  ASC ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		  echo"<tr>
		   <td >".$y['account']."</td>
       <td><input name='meter[".$y['id']."]' type='textbox' size='15'    placeholder='Meter Number'> </td>
		
		<td><input name='balance[".$y['account']."]' type='textbox' size='15'  class='input'  placeholder='Balance'> </td>          
           </tr>";
		 }
		 }


	?>
           </tbody>
            <tbillst>
            </tbillst>
          </table></div>
	<input name="" type="submit"  class="button"><input name="" type="reset"  class="button">
	</form></div>
	<div  id="tabs-11">
	<form  id="creditsession"   method="post"   action="creditsession.php">  <fieldset><legend>Credit  Search</legend><input type="text"  pattern="[0-9A-Za-z ]+"  title="INVALID ENTRIES "   placeholder="START  ACCOUNT"  id="first" name="first" required="on">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" id="last" name="last" placeholder="LAST  ACCOUNT" required="on">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" id="amount" name="amount" placeholder="MIN AMOUNT" required="on"><input name="" class="button"  type="submit"><input name=""  class="button"   type="reset"></fieldset></form>
	<form  id="results"></form>
	</div>
</div>


<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>

<script type="text/javascript"> 
$(document).ready(function(){
//////
var $rows = $('.table tr');
$('.searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
//////

$( "#tabs" ).tabs();
$("#newclient3").submit(function (){ 
			$.post("newclient3.php",$("#newclient3").serialize(),function(data) {alert(data)})
			return false;
			}) 

$("#delslip").submit(function (){
$.post( "delslip.php",
$("#delslip").serialize(),
function(data){alert(data); $("#slip1").load("waterbill.php #slip2"); });
return false;
})

$("#delbills").submit(function (){
				
if($(".delbills").is(":checked")){}else {alert("Select Meter bill to  delete");return false;}
var a=confirm("Delete  selected bills");
if (a==false){return false;}
$.post("delbills.php",$("#delbills").serialize(),function (data){alert(data); $("#billstable3").load("waterbill.php #billstable4");})
return false;
})
$("#checkbill").submit(function (){
				
if($(".action").is(":checked")){}else {alert("SELECT CLIENT");return false;}
var  action=$("#action").val();
if(action =="delete")
{
var a=confirm("Delete Selected  Accounts");
if (a==false){return false;}
}
})
$("#billing").submit(function(){
var a=$("#date").val();
if(a==""){alert("Invalid dates");return false;}
var add=0;
$(".input").each(function () {
add +=Number($(this).val());
});
if(isNaN(add)){alert("Invalid Entries"); return false ;}
else if(add<0){alert("Invalid Entries"); return false ;}
else if(add==""){alert("Invalid Entries"); return false ;}
$.post( "waterbill2.php",$("#billing").serialize(),function(data){
	$("#content").load("message.php #content"); 
$('#message').modal('show'); $("#billstable1").load("waterbill.php #billstable2"); $("#billstable3").load("waterbill.php #billstable4"); });return false;
})

$("#clearbill").submit(function(){
var add=0;
$(".input").each(function () {
add +=Number($(this).val());
});
if(isNaN(add)){alert("Invalid Entries"); return false ;}
else if(add<=0){alert("Invalid Entries"); return false ;}
else if(add==""){alert("Invalid Entries"); return false ;}
$.post( "clearbill.php",
$("#clearbill").serialize(),
function(data){
alert(data);
});
return false;
})


$("#bankslip2").submit(function(){

var add=0;
$(".amount").each(function () {
add +=Number($(this).val());
});
if(isNaN(add)){alert("Invalid Entries"); return false ;}
else if(add<=0){alert("Invalid Entries"); return false ;}
else if(add==""){alert("Invalid Entries"); return false ;}
$.post("bankslip2.php",$("#bankslip2").serialize(),function (data){alert(data);$("#slip1").load("waterbill.php #slip2");})
return false;
})


$("#meterupdate").submit(function(){
$.post("meterupdate.php",$("#meterupdate").serialize(),function (data){alert(data);})
return false;
})

$("#meterupdate2").submit(function(){
$.post("meterupdate2.php",$("#meterupdate2").serialize(),function (data){alert(data); $("#billstable1").load("waterbill.php #billstable2");  $("#meterreading1").load("waterbill.php #meterreading2");})
return false;
})
$("#updatebalances").submit(function(){
$.post("try.php",$("#updatebalances").serialize(),function (data){alert(data);})
return false;
})

$("#export").submit(function(){
$.post("export.php",$("#export").serialize(),function(data){alert(data);});return false;
});

$("#creditsession").submit(function(){
$.post("creditsession.php",$("#creditsession").serialize(),function(data){alert(data);  $("#results").load("creditreport.php #export");  });return false;
});

$("#checkbill").submit(function(){
var x=$("#action").val();
if(x !=='edit')
{
$.post("checkbill.php",$("#checkbill").serialize(),function(data){alert(x);
  $("#updatetable1").load("waterbill.php #updatetable2"); });return false;
}

});
})</script>
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
