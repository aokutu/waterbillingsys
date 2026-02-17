<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ADD DEBT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$account=$_POST['account'];@$action=$_SESSION['action']; 	
$x="SELECT SUM(CREDIT) FROM $wateraccountstable WHERE ACCOUNT='$account'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$deposit=$y['SUM(CREDIT)'];}}
	 
$x="SELECT SUM(BALANCE) FROM $billstable WHERE ACCOUNT='$account'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$waterbill=$y['SUM(BALANCE)'];}}
	 
	 $x="SELECT SUM(AMOUNT) FROM $nonwaterbills WHERE ACCOUNT='$account'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$nonwaterbill=$y['SUM(AMOUNT)'];}}
	
		$bal=$waterbill+$nonwaterbill-$deposit;

?>

 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLING SOFTWARE</title>
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
#results{ font-size:90%;}body { margin-left:2%;}

	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; } body {text-transform:inherit;}
.dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}

  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
   $('#newdebt').modal('show');
   
       $("#period").click(function() {
     var installment=$("#installment").val();
	 var debt=$("#debt").val();
	 var period=debt/installment;
	 $("#period").val(period);
	 });
	 
	 
	  $("#installment").click(function() {
     var period=$("#period").val();
	 var debt=$("#debt").val();
	 var installment=debt/period;
	 $("#installment").val(installment);
	 });
	 
   
	$("#zonesearch").submit(function(){
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
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

<form id="newdebt" method="post" action="newdebt2.php">

<hr>
  <h3>DEBT DETAILS  <?php print $account;?></h3>
  <div class="row">

    <div class="col-sm-8" >
	ACCOUNT NO.
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT NUMBER" data-placement="bottom">
<input  style='text-transform:uppercase'  readonly  value="<?php print $account;?>"  name="account" type="text" size="15" placeholder="ENTER  ACCOUNT NUMBER"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a><br>
	DEBT BALANCE
	
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  DEBT BALANCE" data-placement="bottom">
	<div id ="currentbill"><input type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES " readonly class="form-control input-sm" value="<?php print $bal;?>"   name="debt"  id="debt"  required="on" /></div></a>
	<br>
	MONTHLY INSTALLMENT 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  MONTHLY INSTALLMENT" data-placement="bottom">
	<input type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES "  class="form-control input-sm"  name="installment"   id="installment"  required="on" /></a>
	<br>
	PERIOD  IN MONTHS
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PERIOD IN MONTHS" data-placement="bottom">
	<input type="number" class="form-control input-sm"  name="period"  id="period"  required="on" /></a>
	<br>
	<?php if ($bal >0 )
	{
print '<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
<input type="hidden" class="form-control input-sm" value ="NEWDEBT" name="action"  id="action"  required="on" /> 
  
';		
		
	}

?>
		</div>
	<div class="col-sm-4"></div>
  </div>
  <hr>
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
