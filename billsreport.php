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

	$("#delbill").submit(function(){$('#prepostmessage').modal('show');
	
	var x=confirm("DELETE ?");   
	 if(x ==false){return false; } 
$.post( "delbills.php",
$("#delbill").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#delbill").load("billsreport.php #billstable"); $('#prepostmessage').modal('hide'); $('#message').modal('show'); 

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
  
  
 <form class="modal fade" id="acrange" role="dialog" method="post"  action="billsrange.php">
  
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">BILL DETAILS </div></div>
  <div class="container">
  <div class="row">
    <div class="col-sm-8" >
	
	<div>
    <input  autocomplete="off" list="accountslist"  type="text" name="account1"  value="<?php print $_SESSION['account1'];?>"   autocomplete   id="account1"  class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase'  placeholder="ENTER   MIN ACC NUMBER" required="on" />
	
        </div><br>
		<div>
    <input  autocomplete="off" list="accountslist" type="text" name="account2"  value="<?php print $_SESSION['account2'];?>"   autocomplete     id="account2"   class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase' placeholder="ENTER   MAX ACC NUMBER" required="on"  />
        
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
 <br />
FROM<input type="date" class="form-control input-sm" name="date1" id="acc1"  autosearch="off"><br />
TO<input type="date" class="form-control input-sm"   name="date2" id="acc2"  autosearch="off"><br />
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

<form id="delbill" method="post" action="delbills.php">

  <h4   style="text-align:center"><strong>BILLS FOR ACC <?php print $account1 ;?> TO <?php print $account2;?> FROM  <?php print   $depositdate1; ?>  TO  <?php print  $depositdate2; ?>   </strong></h4>
<div  id="billstable"  >
<table class="table"   >
	  
        <!--DWLayoutTable-->
        <thead style="text-align:center;" >
        
        </thead>
        
           
        <tbody>
            
         
        <?php
$x="SELECT $billstable.commission,$billstable.billed,$billstable.deduction,$billstable.charges,$billstable.meterstatus,$billstable.metercharges,$billstable.refuse,$billstable.account,$billstable.id,$billstable.meternumber,$billstable.previous,$billstable.current,$billstable.units,$billstable.balance,$billstable.date,$accountstable.status AS  statusx FROM $billstable,$accountstable WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'  AND $billstable.account=$accountstable.account ORDER BY  $billstable.account,$billstable.date  ASC";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
?>

  <tr>
		  <td  style="text-align:left;" valign='top' >reff</td>	
		 <td    valign='top'>Account</td>		
		  <td width='12%'  valign='top'>Meter No.</td>
            <td    height='21' valign='top' >Previous.</td>
            <td  valign='top'>Current</td>
			<td    valign='top'>Units</td>
			
			<td   valign='top'>Water </td>
			
			<td    valign='top'>Mtr </td>
			<td     valign='top'>Status </td>
				<td    valign='top'>Total </td>
			<td   width='8%' valign='top'>Date</td>
			<td   valign='top'></td>
				<td   valign='top'>DEL</td>
          </tr>
<?php 
		 while ($y=@mysqli_fetch_array($x))
		 { 	$charges=$y['balance'];	$chargex=$y['charges']+$y['commission'];   
	 echo"<tr class='filterdata' style='text-align:center;' >
	 <td   >".$y['id']."</td>
             <td  >".$y['account']."</td>
		  
		   <td width='12%'   >".$y['meternumber']."</td>
           <td  >".$y['previous']."</td>
		    <td  >".$y['current']."</td>
			<td  >".$y['units']."</td>
				<td  >".number_format($y['charges'],2).  "</td>
			<td  >".number_format($y['metercharges'],2).  "</td>
			<td  >".$y['meterstatus']."</td>
			<td  >".number_format($y['balance'],2).  "</td>
			<td width='8%' >".$y['date']."</td>
			  <td > " ; ?> 
			  <a   href="editbills1.php?id=<?php print $y['id'];?>" >
 EDIT </a> <a   href="deletebillslip.php?id=<?php print $y['id'];?>" >
DEL </a>
                       <?php  print "</td> 
                       
            <td><input name='del[]'  type='checkbox' value='".$y['id']."'  class='form-control input-sm'></td> 
                       </tr>";
		 }
		 
		 }  ?>
		 

		  <tr>
		 
		  <td  valign="top"  >TOTAL</td>
		  
		  
		  <td  valign="top">		
		  <?php 	 $x="SELECT   COUNT($billstable.id) AS TTL FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		 echo  $y['TTL'];  
		 }} ?>
		 </td>
		
				<td   width='12%' valign="top">
			<?php 	 $x="SELECT   COUNT($billstable.id) AS TTL,SUM(billed) FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		// echo  number_format($y['SUM(billed)'],2)."M&sup3;";  
		 }} ?>
			</td>
				<td  valign="top">
			<?php 	 $x="SELECT  SUM(deduction) FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		 // echo  number_format($y['SUM(deduction)'],2)."M&sup3;";  
		 }} ?>
			</td>
			<td  valign="top">
			<?php 	 $x="SELECT  SUM(units) FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		// echo  number_format($y['SUM(units)'],2)."M&sup3;";  
		 }} ?>
			</td>
		   			<td  valign="top">
		   		<?php 	 $x="SELECT  SUM(units) FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		 echo  number_format($y['SUM(units)'],2)."M&sup3;";  
		 }} ?>		
		   			
		   			
		   			
		   			<?php 	 $x="SELECT  SUM(metercharges) FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		 //echo number_format($y['SUM(metercharges)'],2);
		 }} ?></td>
		 
		 	<td  valign="top" style="align:center;"><?php 	 $x="SELECT  SUM(charges) FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		 echo  number_format($y['SUM(charges)'],2);
		 }} ?></td>
		 
			<td  valign="top"><?php 	 $x="SELECT  SUM(metercharges) FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		 echo number_format($y['SUM(metercharges)'],2);
		 }} ?></td>
		 
		 	<td  valign="top"  ><!--DWLayoutEmptyCell-->&nbsp;</td>
			<td  valign="top"><?php 	 $x="SELECT  SUM(balance) FROM  $billstable    WHERE   $billstable.date>='$depositdate1'  AND    $billstable.date<='$depositdate2'  
   AND    $billstable.account >='$account1'   AND    $billstable.account <='$account2'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 {
		 echo number_format($y['SUM(balance)'],2);
		 }} ?></td>
		 
		 	<td  valign="top" width='8%' ><!--DWLayoutEmptyCell-->&nbsp;</td>
		  		<td  valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
		  			<td  valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
		  		
		
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
