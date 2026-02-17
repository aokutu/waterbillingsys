<?php 
header("LOCATION:accessdenied4.php");exit;
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
@$depositdate1=$_SESSION['depositdate1'];@$depositdate2=$_SESSION['depositdate2'];
if($depositdate1 == NULL ){$depositdate1=date('Y-m-d');}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS'";
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
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
$('[data-toggle="popover"]').popover(); 
	
	   $('#transactiondetails').dblclick(function()
{
	var slipid=$('#search-box').val();
	if(slipid <1  ){alert('ENTER TRANSACTION DETAILS');return false;}
	$('#prepostmessage').modal('show');
$.post( 'sessionregistry.php',
$('#search-box').serialize(),
function(data){$('#content').load('message.php #content');
$('#transactiondetails').load('selecttransactiondetails.php #transactiondetails2');
$('#prepostmessage').modal('hide');$('#message').modal('show'); 
});  return false;
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
	$('#search-box').keyup(function(){
		$.ajax({
		type: 'POST',
		url: 'unprocessedslip.php',
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$('#search-box').css('background','#FFF url(LoaderIcon.gif) no-repeat 165px');
		},
		success: function(data){
			$('#suggesstion-box').show();
			$('#suggesstion-box').html(data);
			$('#search-box').css('background','#FFF');
		}
		});
	});
});

function selectCountry(val) {
$('#search-box').val(val);
$('#suggesstion-box').hide();
}
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
 <div class='container'>
  <div class='row'>
  <div class='col-sm-12'>
  
  <a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='SET  RANGE' data-placement='bottom'><button type='button' class='btn-info btn-sm' data-toggle='modal' data-target='#acrange'>AC-DATE RANGE</button></a>
  
  <a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='NEW  BANK SLIP' data-placement='bottom'><button type='button' class='btn-info btn-sm' data-toggle='modal' data-target='#newslip'>LINK SLIPS</button></a>
 
   <button class='btn-info btn-sm' onclick='window.print()'>PRINT</button><br />
   <input type='text' class='form-control input-sm' id='searchtext' placeholder='Type to search' autosearch='off'>
  </div></div></div> 
 
 
  <form class='modal fade' id='newslip' role='dialog'    action='bankslip3.php' method='post'  >
  <div class='modal-dialog modal-lg'  >
  <div class='modal-content'><div class='modal-header'><div class='modal-header'>
  <div class='container'>
  <div class='row'>
  <div class='col-sm-8'>  <br>
  
  <div class='frmSearch'>SLIP I.D
<a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='ENTER  TRANSACTION DETAILS' data-placement='bottom'>
<input  style='text-transform:uppercase' name='slipid' type='text' size='15' placeholder='TRANSACTION DETAILS'  required='on'  class='form-control input-sm'   id='search-box'   autocomplete='off' ></a>
<div id='suggesstion-box'></div>
</div>
<br>
TRANSACTION DETAILS
<a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='TRANSACTION SLIP DETAILS' data-placement='bottom'>

<div  id='transactiondetails'>
<select class='form-control input-sm'   required='on' >
<option value=''>CLICK TO CONFIRM DETAILS</option>
</select>

</div>
</a>

<br>
<a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='ENTER  ACCOUNT' data-placement='bottom'>
<input  style='text-transform:uppercase' name='account' type='text' size='15' placeholder='ENTER ACCOUNT NO.'  required='on'  class='form-control input-sm'   title='INVALID ENTRIES'  autocomplete ></a>


</div></div></div>
<br>

	<br>		  

<div class='container'>
  <div class='row'>
  <div class='col-sm-2'></div>
  <div class='col-sm-5'></div>
  <div class='col-sm-5'></div>
  </div></div>
CODE :

<a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='SELECT TRANSACTION CODE ' data-placement='bottom'>
<select class='form-control'   required= 'on'  name='code'  id='code'>
			   <option value=''>CODE</option>
			   <?php 
		  
	$x='SELECT * FROM paymentcode ORDER BY CODE  ';
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ print ' <option value="'.$y['code'].'">CODE'.$y['code'].'-'.$y['name'].'</option>';}}		   
			   
			   ?>
			  </select>

</a>

			  <hr>			  
AMOUNT

<a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='ENTER  AMOUNT' data-placement='bottom'>
<input type='number' class='form-control input-sm' name='amount' id='amount' placeholder='AMOUNT' autosearch='off'   pattern='[0-9]' title='ENTER  ONLY  NUMERICS '  > <hr>
</a>

<button type='submit' class='btn-info btn-sm' >SUBMIT</button><button type='reset' class='btn-info btn-sm'>RESET</button> <button type='button' class='btn-info btn-sm' data-dismiss='modal' id='close2'>CLOSE</button>
  </div><div class='col-sm-4'></div></div></div></div></div></div></div></form>
  
  
  
 <form class='modal fade' id='acrange' role='dialog' method='post'  action='depositslipsrange.php'>
  <div class='modal-dialog modal-lg'  >
  <div class='modal-content'><div class='modal-header'><div class='modal-header'>
  <div class='container'>
  <div class='row'>
  <div class='col-sm-8'>
<div>
    <input type='text' name='account1'  value='<?php print $_SESSION['account1'];?>'   autocomplete   id='account1'  class='form-control input-sm' autocomplete='off'   pattern='[0-9]{11}'  title='ENTER (8) ALPHA NUMERIC CHARACTERS' style='text-transform:uppercase'  placeholder='ENTER   MIN ACC NUMBER' required='on' />
        </div><br>
		<div>
    <input type='text' name='account2'  value='<?php print $_SESSION['account2'];?>'   autocomplete     id='account2'   class='form-control input-sm' autocomplete='off'   pattern='[0-9]{11}'  title='ENTER (8) ALPHA NUMERIC CHARACTERS' style='text-transform:uppercase' placeholder='ENTER   MAX ACC NUMBER' required='on'  />
        </div><br>
 <br />
FROM<input type='date' class='form-control input-sm' name='date1' id='acc1'  autosearch='off'><br />
TO<input type='date' class='form-control input-sm'   name='date2' id='acc2'  autosearch='off'><br />
<br>
<button type='submit' class='btn-info btn-sm' >SUBMIT</button><button type='reset' class='btn-info btn-sm'>RESET</button> <button type='button' class='btn-info btn-sm' data-dismiss='modal' id='procedureclose'>CLOSE</button>
  </div><div class='col-sm-4'></div></div></div></div></div></div></div>
  </form>
  <img src='letterhead.png'    id='letterhead'  width='50%'  height='50%'  />
   <div class='container'>
  <div class='row'>
  <div class='col-sm-4' ></div>
  <div class='col-sm-4' >CHECK ALL 		 
<input name='' type='checkbox' id='checkall' class='form-control input-sm'></div>
  <div class='col-sm-4' >UNCHECK ALL  
			   <input name='' type='checkbox' id='checknone' class='form-control input-sm'></div>
  </div></div>  
<form id='delslip' method='post' action='delslip.php'>

<div  id='slipstable'>

<h4   style="text-align:center"><strong>PAYMENT DEPOSITS  FOR ACC <?php print $account1 ;?> TO <?php print $account2;?> AS  FROM  <?php print   $depositdate1; ?> TO <?php print  $depositdate2; ?></strong></h4>
<table class='table'  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class='theader'  height='28' valign='top' >REFF </td> 
		   		   <td  class='theader'  height='28' valign='top' >ACCOUNT </td>     
		    <td  class='theader'  height='28'   width='30%' valign='top' >NAME</td> 
<td  class='theader'  height='28' valign='top' >NUMBER CODE</td>					
			 <td  class='theader'  height='28' valign='top' >SLIP CODE</td>	
<td  class='theader'  height='28' valign='top' >AMOUNT</td>				 
			  <td  class='theader'  height='28' valign='top' >POSTING DATE </td> 
			  
			    <td  class='theader'  height='28' valign='top' >	
				<select class='form-control' id ='slipsaction'   name='action' required='on'>
 <option value=''>ACTION</option>
 <option value='DELETE'>DELETE </option>
 <option value='EDIT'>EDIT</option>
 </select></td> 
		 			  
          </tr>
        </thead>
        <tbody>

        <?php
	 $x="SELECT $accountstable.client,$wateraccounts.*,$wateraccounts.id AS identity FROM $wateraccountstable,$accountstable WHERE ACCOUNTS2.account=WATERACCOUNTS2.account ";
	 	 $x="SELECT $accountstable.client,$wateraccountstable.*,$wateraccountstable.id AS identity FROM $wateraccountstable,$accountstable WHERE $accountstable.account=$wateraccountstable.account   AND  $wateraccountstable.depositdate >='$depositdate1'   AND  $wateraccountstable.depositdate <='$depositdate2'
	 AND $accountstable.account >='$account1'  AND $accountstable.account  <='$account2'";

			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo'<tr class="filterdata">
				<td>'.$y['identity'].'</td>  	  
              <td>'.$y['account'].'</td>  
			    <td  width="30%" >'.$y['client'].'</td>
				  <td>'.$y['code'].'</td>
				  
			   <td>'.$y['transaction'].'</td>
			    <td>'.number_format($y['credit'],2).'</td>
			   <td>'.$y['depositdate'].'</td>
			
			  <td><input name="del[]" type="checkbox" value="'.$y['identity'].'"   class="form-control input-sm"> </td>    
				
           </tr>';
		 }
		 
		 }
/*include("password.php");

	 $x='select  * from $accountstable';
			mysqli_query($connect,$x)or die(mysqli_error($connect));
		exit;	
	 //$x='select  SUM(credit),COUNT(WATERACCOUNTS2.ID) AS TTLACS  FROM WATERACCOUNTS2 ,$accountstable  where ACCOUNTS2.account=WATERACCOUNTS2.account AND  WATERACCOUNTS2.depositdate >="$depositdate1"   AND  WATERACCOUNTS2.depositdate <="$depositdate2"   AND ACCOUNTS2.account >="$account1"  AND ACCOUNTS2.account  <="$account2"';
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	 $ttl=number_format($y['SUM(credit)'],2);$ttlacs=$y['TTLACS'];
		 }
		 
		 }*/
		 
		 
		?>
		
			  <tr  class='btn-info btn-sm' >
		  
		  <td  class='theader'    valign='top'>TOTAL ACC</td>
		  <td  valign='top'><?php print $ttlacs;?></td>
		  <td width='30%'  valign='top'></td>
			
				  <td  valign='top'>TOTAL AMNT</td>
				  <td  valign='top'><?php print $ttl;?> </td>
				  
		 <td  valign='top'></td>
					
		  </tr>
		  
		  
		  <tr   class='btn-info btn-sm'  >
		 
		 		
		  </tr>
	
        </tbody>
    </table>
<br />
<button type='submit' class='btn-info btn-sm'   id='deletebutton'>SUBMIT</button>
<button type='reset' class='btn-info btn-sm'>RESET</button> 
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

