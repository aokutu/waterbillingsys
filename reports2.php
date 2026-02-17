 <?php 
 set_time_limit(0);
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
@$date1=date('Y-m-d');@$date2=date('Y-m-d');
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS' ";
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
  @media print { select{display:none;}}
  body{ font-size:100%}
  table{ font-size:100%}
#levelchart{ width:80%;} .dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
	   $('#search').modal('show');
	   
   $('[data-toggle="popover"]').popover(); 
   
$("#close1").click(function() {
        $("input").val("");
    });

$("#close2").click(function() {
        $("input").val("");
    });
$("#search").submit(function(){
$.post( "searchsession.php",
$("#search").serialize(),
function(data){
alert(data);
$("#datatable").load("reports3.php #reportstable");
return false;});
return false;
})


$("#zonesearch").submit(function(){
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){
$("#content").load("message.php #content"); $('#message').modal('show'); 

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
  <!-- Trigger the modal with a button -->
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="Click to set  Date  range " data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#search">SEARCH</button></a>


<button class="btn-info btn-sm" onClick="window.print()">PRINT</button>
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>
   <form class="modal fade" id="searchmod3" role="dialog" method="post" action="searchmethod.php">
   <div class="modal-dialog modal-lg">
  <div class="modal-content"><div class="modal-header"><div class="modal-header">SEARCH METHOD</div></div>
  <div class="container">
  <div class="row">
    <div class="col-sm-6" >
	<select class="form-control" name="searchmethodx" required="on">
 <option value="">SEARCH  METHOD</option>
 <option value="firstname">FIRST  NAME</option>
 <option value="secondname">SECOND  NAME</option>
 <option value="thirdname">THIRD  NAME</option>
 </select>
 </div>
	<div class="col-sm-6"> <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal">CLOSE</button></div>
	</div>
	</div>
	</div>
	</div>
   </form>
 <form class="modal fade" id="search" role="dialog" method="post"  action="searchsession.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">SEARCH DATE  RANGE </div></div>
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
  FIRST DATE
  <input type="date"    name="date1"  class="form-control input-sm"  placeholder="FIRST DATE" required="on"  /><br /><br />
  LAST DATE 
<input type="date"    name="date2"  class="form-control input-sm"  placeholder="LAST  DATE" required="on"  /><br />
</div>
<div class="col-sm-4"></div>  
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  
  <form class="modal fade" id="audittrail" role="dialog" method="post" action="audittrail.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">SELECT DATE RANGE</div></div>
  <div class="container">
  <div class="row">
  <div class="col-sm-2"><strong>FROM</strong><br /><br /><strong>TO</strong></div>
    <div class="col-sm-6" >
      <div class="frmSearch">
	  
<input type="date" class="form-control input-sm"  name="date1"    required="on" /><br />
<input type="date" class="form-control input-sm"  name="date2"    required="on" />
<div id="suggesstion-box"></div>
</div>

   <br />

    </div>
	<div class="col-sm-4"></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  <div id="levelchat"  class="modal fade" role="dialog" >

  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">USERS  LEVELS  CHART</div></div>
  <div class="container">
  <div class="row">

  </div></div></div></div>
  
</div>
<form id="results">

<div  id="datatable" class="table-responsive"> 
<h4   style="text-align:center"><strong>ZONAL COMPARISON REPORT FROM <?php echo $date1; ?>  TO   <?php echo $date2; ?></strong></h4>
<table class="table "  id="reportstable">
  <style type="text/css" >
  #loading{background-color:#0099FF; border:thick; border:#000000; font-size:150%; font-family:Georgia, "Times New Roman", Times, serif;}
  </style>
        <thead>
          <tr>
 <td  class="theader"  height="21" valign="top" >ZONES </td>
 <td  class="theader"  height="21" valign="top" >ACTIVE</td> 
 <td  class="theader"  height="21" valign="top" >NON ACTIVE</td>            
 <td  class="theader" valign="top">STALLED</td>
 <td  class="theader" valign="top">RUNNING</td>
 <td  class="theader" valign="top">DISCONNECTED</td> 
 <td  class="theader" valign="top">CONSUMED M&sup3;</td> 
 <td  class="theader" valign="top">RENT FEE(Ksh)</td> 
 <td  class="theader" valign="top">WATER SALES(Ksh)</td>
 <td  class="theader" valign="top">TTL REV(Ksh)</td>  
   <td  class="theader" valign="top">DBT(Ksh)</td>
          </tr>
        </thead>
        <tbody>
		            <tr>
 <td  class="theader"  height="21" valign="top" >ZONE 375	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '375%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active11=mysqli_num_rows($x);
		echo $active11;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '375%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive11=mysqli_num_rows($x);
		echo $nonactive11;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '375%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled11=mysqli_num_rows($x);
		echo $stalled11;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running11=$active11+$nonactive11-$stalled11;
 echo $running11;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '375%'  AND  status ='CONP'  OR  account LIKE '375%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected11=mysqli_num_rows($x);
		echo $disconnected11;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '375%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];
	$sumunits11=$y['sum(units)'];		
		}}
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '375%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)']; $summetercharges11=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '375%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges11=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '375%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];	$ttl11=$y['ttl'];	
		}}
 ;?></td>  
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where account  like '375%'  and   depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit11=$y['sum(credit)'];		
		}}
 
 ?></td> 
          </tr>
            <tr>
 <td  class="theader"  height="21" valign="top" >ZONE 376001	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376000%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active1=mysqli_num_rows($x);
		echo $active1;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376001%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive1=mysqli_num_rows($x);
		echo $nonactive1;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376001%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled1=mysqli_num_rows($x);
		echo $stalled1;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running1=$active1+$nonactive1-$stalled1;
 echo $running1; 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376001%'  AND  status ='CONP'  OR  account LIKE '376001%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected1=mysqli_num_rows($x);
		echo $disconnected1;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376001%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];
	$sumunits1=$y['sum(units)'];			
		}}
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376001%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges1=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376001%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges1=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376001%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];$ttl1=$y['ttl'];		
		}}
 ;?></td> 
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376001%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit1=$y['sum(credit)'];		
		}}
 
 ?></td>  
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376002  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376002%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active2=mysqli_num_rows($x);
		echo $active2;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376002%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive2=mysqli_num_rows($x);
		echo $nonactive2;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376002%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled2=mysqli_num_rows($x);
		echo $stalled2;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running2=$active2+$nonactive2-$stalled2;
 echo $running2;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376002%'  AND  status ='CONP'  OR  account LIKE '376002%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected2=mysqli_num_rows($x);
		echo $disconnected2;
 
 ?></td>            
 <td  class="theader" valign="top">
 <?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376002%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];		
		}}
 ?> </td>
<td  class="theader"  height="21" valign="top" >
<?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376002%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges2=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376002%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges2=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376002%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];$ttl2=$y['ttl'];		
		}}
 ;?></td>   
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376002%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit2=$y['sum(credit)'];		
		}}
 
 ?></td>
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376003	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376003%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active3=mysqli_num_rows($x);
		echo $active3;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376003%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive3=mysqli_num_rows($x);
		echo $nonactive3;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376003%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled3=mysqli_num_rows($x);
		echo $stalled3;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running3=$active3+$nonactive3-$stalled3;
  echo $running3;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376003%'  AND  status ='CONP'  OR  account LIKE '376003%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected3=mysqli_num_rows($x);
		echo $disconnected3;
 
 ?></td>            
 <td  class="theader" valign="top">
 <?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376003%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];
	$sumunits3=$y['sum(units)'];			
		}}
 ?> </td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376003%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges3=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" >
 <?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376003%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges3=$y['sum(charges)'];		
		}}
 
 ?> </td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376003%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];$ttl3=$y['ttl'];		
		}}
 ;?></td>   
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376003%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit3=$y['sum(credit)'];		
		}}
 
 ?></td>
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376004	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376004%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active4=mysqli_num_rows($x);
		echo $active4;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376004%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive4=mysqli_num_rows($x);
		echo $nonactive4;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376004%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled4=mysqli_num_rows($x);
		echo $stalled4;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running4=$active4+$nonactive4-$stalled4;
  echo $running4;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376004%'  AND  status ='CONP'  OR  account LIKE '376004%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected4=mysqli_num_rows($x);
		echo $disconnected4;
 
 ?></td>            
 <td  class="theader" valign="top">
 <?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376004%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];
	$sumunits4=$y['sum(units)'];			
		}}
 ?> </td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376004%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges4=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376004%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges4=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376004%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];$ttl4=$y['ttl'];		
		}}
 ;?></td>   
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376004%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit4=$y['sum(credit)'];		
		}}
 
 ?></td>
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376005	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376005%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active5=mysqli_num_rows($x);
		echo $active5;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376005%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive5=mysqli_num_rows($x);
		echo $nonactive5;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376005%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled5=mysqli_num_rows($x);
		echo $stalled5;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running5=$active5+$nonactive5-$stalled5;
  echo $running5;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376005%'  AND  status ='CONP'  OR  account LIKE '376005%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected5=mysqli_num_rows($x);
		echo $disconnected5;
 
 ?></td>            
 <td  class="theader" valign="top">
 <?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376005%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];	$sumunits5=$y['sum(units)'];		
		}}
 ?> </td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376005%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges5=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" >
 <?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376005%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges5=$y['sum(charges)'];		
		}}
 
 ?> </td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376005%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];$ttl5=$y['ttl'];		
		}}
 ;?></td> 
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376005%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit5=$y['sum(credit)'];		
		}}
 
 ?></td>  
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376006	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376006%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active6=mysqli_num_rows($x);
		echo $active6;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376006%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive6=mysqli_num_rows($x);
		echo $nonactive6;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376006%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled6=mysqli_num_rows($x);
		echo $stalled6;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running6=$active6+$nonactive6-$stalled6;
  echo $running6;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376006%'  AND  status ='CONP'  OR  account LIKE '376006%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected6=mysqli_num_rows($x);
		echo $disconnected6;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376006%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];	$sumunits6=$y['sum(units)'];		
		}}
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376006%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges6=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376006%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges6=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376006%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];	$ttl6=$y['ttl'];	
		}}
 ;?></td>  
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376006%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit6=$y['sum(credit)'];		
		}}
 
 ?></td> 
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376007	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376007%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active7=mysqli_num_rows($x);
		echo $active7;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376007%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive7=mysqli_num_rows($x);
		echo $nonactive7;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376007%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled7=mysqli_num_rows($x);
		echo $stalled7;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running7=$active7+$nonactive7-$stalled7;
  echo $running7;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376007%'  AND  status ='CONP'  OR  account LIKE '376007%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected7=mysqli_num_rows($x);
		echo $disconnected7;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376007%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)']; $sumunits7=$y['sum(units)'];			
		}}
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376007%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges7=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376007%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges7=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376007%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];	$ttl7=$y['ttl'];	
		}}
 ;?></td>     <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376007%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit7=$y['sum(credit)'];		
		}}
 
 ?></td>
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376008	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376008%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active8=mysqli_num_rows($x);
		echo $active8;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376008%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive8=mysqli_num_rows($x);
		echo $nonactive8;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376008%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled8=mysqli_num_rows($x);
		echo $stalled8;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running8=$active8+$nonactive8-$stalled8;
 echo $running8;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376008%'  AND  status ='CONP'  OR  account LIKE '376008%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected8=mysqli_num_rows($x);
		echo $disconnected8;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376008%'  AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];	$sumunits8=$y['sum(units)'];		
		}}
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376008%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges8=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376008%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges8=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376008%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];$ttl8=$y['ttl'];		
		}}
 ;?></td>     <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376008%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit8=$y['sum(credit)'];		
		}}
 
 ?></td>
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376009	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376009%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active9=mysqli_num_rows($x);
		echo $active9;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376009%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive9=mysqli_num_rows($x);
		echo $nonactive9;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376009%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled9=mysqli_num_rows($x);
		echo $stalled9;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running9=$active9+$nonactive9-$stalled9;
 echo $running9;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376009%'  AND  status ='CONP'  OR  account LIKE '376009%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected9=mysqli_num_rows($x);
		echo $disconnected9;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376009%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)']; $sumunits9=$y['sum(units)'];			
		}}
?></td>
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376009%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges9=$y['sum(metercharges)'];		
		}}
?></td>
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376009%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];$watercharges9=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376009%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];	$ttl9=$y['ttl'];	
		}}
 ;?></td>   
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376009%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit9=$y['sum(credit)'];		
		}}
 
 ?></td>
          </tr>
		  <tr>
 <td  class="theader"  height="21" valign="top" >ZONE  376010	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376010%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active10=mysqli_num_rows($x);
		echo $active10;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376010%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive10=mysqli_num_rows($x);
		echo $nonactive10;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '376010%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled10=mysqli_num_rows($x);
		echo $stalled10;
 
 ?></td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $running10=$active10+$nonactive10-$stalled10;
 echo $running10;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '376010%'  AND  status ='CONP'  OR  account LIKE '376010%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected10=mysqli_num_rows($x);
		echo $disconnected10;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '376010%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];$sumunits10=$y['sum(units)'];			
		}}
?></td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '376010%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)'];$summetercharges10=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '376010%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)'];  $watercharges10=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '376010%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];	$ttl10=$y['ttl'];	
		}}
 ;?></td>   
   <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '376010%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit10=$y['sum(credit)'];		
		}}
 
 ?></td>
          </tr>
		  
		  		            <tr>
 <td  class="theader"  height="21" valign="top" >ZONE 377	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '377%'  AND  status ='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$active12=mysqli_num_rows($x);
		echo $active12;
 
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '377%'   AND   status !='CONNECTED'  "; 
	$x=mysqli_query($connect,$x);
		$nonactive12=mysqli_num_rows($x);
		echo $nonactive12;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT $billstable.account  FROM  $billstable.account,accounts  where bills.previous=bills.current   and  bills.current=$acccountstable.email and $billstable.account=$accountstable.account  and  $billstable.account  like '377%' GROUP BY $billstable.account  DESC  "; 
	$x=mysqli_query($connect,$x);
		$stalled12=mysqli_num_rows($x);
		echo $stalled12;
 
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 $running12=$active12+$nonactive12-$stalled12;
 echo $running12;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 $x="SELECT id  FROM   METERS  WHERE account LIKE '377%'  AND  status ='CONP'  OR  account LIKE '377%'  AND  status ='COR'  "; 
	$x=mysqli_query($connect,$x);
		$disconnected12=mysqli_num_rows($x);
		echo $disconnected12;
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
  $x="SELECT  sum(units)  from   bills   where  account  LIKE '377%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(units)'];	$sumunits12=$y['sum(units)'];		
		}}
?></td>
<td  class="theader"  height="21" valign="top" ><?php 
  $x="SELECT  sum(metercharges)  from   bills   where  account  LIKE '377%'    AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(metercharges)']; $summetercharges12=$y['sum(metercharges)'];		
		}}
?></td> 
 <td  class="theader"  height="21" valign="top" ><?php  
  $x="SELECT  sum(charges)  from   bills   where  account  LIKE '377%'   AND date >='$date1' AND date <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(charges)']; $watercharges12=$y['sum(charges)'];		
		}}
 
 ?></td>            
 <td  class="theader" valign="top"><?php 
 $x="SELECT  sum(charges)+sum(metercharges)+sum(refuse)  AS ttl from   bills   where  account  LIKE '377%'   AND date >='$date1' AND date <='$date2' "; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['ttl'];	$ttl12=$y['ttl'];	
		}}
 ;?></td>     <td  class="theader" valign="top"><?php  
  $x="SELECT  sum(credit)  FROM $wateraccountstable   where  account  LIKE '377%'   AND depositdate >='$date1' AND depositdate <='$date2'"; 
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	echo $y['sum(credit)'];$credit12=$y['sum(credit)'];		
		}}
 
 ?></td>
          </tr>
		   <tr>
 <td  class="theader"  height="21" valign="top" >TTL	  </td>
 <td  class="theader"  height="21" valign="top" ><?php 
 echo $active1+$active2+$active3+$active4+$active5+$active6+$active7+$active8+$active9+$active10+$active11+$active12;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 echo $nonactive1+$nonactive2+$nonactive3+$nonactive4+$nonactive5+$nonactive6+$nonactive7+$nonactive8+$nonactive9+$nonactive10+$nonactive11+$nonactive12;
 ?></td>            
 <td  class="theader" valign="top"><?php 
 echo $stalled1+$stalled2+$stalled3+$stalled4+$stalled5+$stalled6+$stalled7+$stalled8+$stalled9+$stalled10+$stalled11+$stalled12;
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 echo $running1+$running2+$running3+$running4+$running5+$running6+$running7+$running8+$running9+$running10+$running11+$running12;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 echo $disconnected1+$disconnected2+$disconnected3+$disconnected4+$disconnected5+$disconnected6+$disconnected7+$disconnected8+$disconnected9+$disconnected10+$disconnected11+$disconnected12;
 ?></td>            
 <td  class="theader" valign="top"><?php 
 echo $sumunits1+$sumunits2+$sumunits3+$sumunits4+$sumunits5+$sumunits6+$sumunits7+$sumunits8+$sumunits9+$sumunits10+$sumunits11+$sumunits12;
 ?></td>
<td  class="theader"  height="21" valign="top" ><?php 
 echo $summetercharges1+$summetercharges2+$summetercharges3+$summetercharges4+$summetercharges5+$summetercharges6+$summetercharges7+$summetercharges8+$summetercharges9+$summetercharges10+$summetercharges11+$summetercharges12;
 ?></td> 
 <td  class="theader"  height="21" valign="top" ><?php 
 echo $watercharges1+$watercharges2+$watercharges3+$watercharges4+$watercharges5+$watercharges6+$watercharges7+$watercharges8+$watercharges9+$watercharges10+$watercharges11+$watercharges12;
 ?></td>            
 <td  class="theader" valign="top"><?php 
 echo $ttl1+$ttl2+$ttl3+$ttl4+$ttl5+$ttl6+$ttl7+$ttl8+$ttl9+$ttl10+$ttl11+$ttl12;
 ?></td>   
   <td  class="theader" valign="top"><?php 
 echo $credit1+$credit2+$credit3+$credit4+$credit5+$credit6+$credit7+$credit8+$credit9+$credit10+$credit11+$credit12;
 ?></td>
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
<?php include_once("dashboard3.php"); include_once("chat.php");?>

</body>
</html>
