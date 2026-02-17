<?php 
@session_start();
$_SESSION['message']=null;
include_once("password2.php");
include_once("interface2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="REGISTRATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'    ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIEDx"; header("LOCATION:accessdenied4.php");exit;}
class debtstatement 
{
public   $patientnumber =null; 	
}
$debtstatement =new debtstatement; 
if(isset($_SESSION['debtpatientnumber']))
{
$debtstatement->patientnumber=$_SESSION['debtpatientnumber'];
}
else if(isset($registrationbooking->debtpatientnumber))
{
$debtstatement->patientnumber=$registrationbooking->debtpatientnumber;

}
$_SESSION['debtpatientnumber']=$debtstatement->patientnumber; 


?>

 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>MEDI CLOUD</title>
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
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}    .dropdown-menu{ overflow-y: scroll; height: 300%;        
   position: absolute;
}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}

	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            
  width: 100%;
  position: absolute;
}
@media print {
  a[href]:after {
    content: none !important;
  }
}
 #pricelisttable td:nth-child(1) { width: 45%;text-align:left;}
  
  
@media print {
    /* Hide the last column in the printed version */
    table th:last-child,
    table td:last-child {
        display: none;
    }
}
	</style>
	<style>

 
  
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

<script>
 $(document).ready(function(){  
$(document).on('click', '#deletelink', function(event) {
        event.preventDefault();
        
        var debtentryid = $(this).data('debtentryid');
		var accessname = prompt('NAME');
        var accesspass = prompt('PASSWORD');
		if(accessname==null ){return false;}
		if(accesspass==null ){return false;}
       if (debtentryid != null) {
            $.ajax({
                type: 'POST',
                url: 'deletedebtentry.php',
                data: {
                    debtentryid: debtentryid, // Fixed this line
					accessname: accessname,
                    accesspass: accesspass
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
			  $("#debtdetails").load("debtpayment.php #report", function() {
                    // Optional: Rebind event handlers if necessary
                }); 
                   $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                    $('#message').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });
	
  })
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div   id="debtdetails" >
<div id="report" >
<h4 class="text-center font-bold text-black text-2xl tracking-wide uppercase underline" >PATIENT NUMBER <?php print $_SESSION['patientnumber']; ?><br>DEBT STATMENT  </div> </h4>
<Br>
<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DATE</td>
<td class="w-1/6  border border-black px-4 py-2" >DETAILS </td>
<td class="w-1/6  border border-black px-4 py-2" >AMOUNT </td>
<td class="w-1/6  border border-black px-4 py-2" >TOTAL </td>
<td class="w-1/6  border border-black px-4 py-2" >DEL </td>
</tr>
<?php 
$connect->query("SET @TTL=0");
$x=$connect->query(" SELECT  ID,DATE(DATE) AS DATE,AMOUNT,DETAILS,(@TTL := AMOUNT + @TTL) AS TTLSUM  FROM debtrecords WHERE  PATIENTNUMBER ='".$_SESSION['patientnumber']."'  ORDER BY  DATE ASC   ");
while ($data = $x->fetch_object())
{ ?>

<tr class=" text-black-700" >
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DATE; ?></td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->DETAILS; ?> </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print number_format($data->AMOUNT,2); ?> </td>
<td class="w-1/6  border border-black px-4 py-2" ><?php  print number_format($data->TTLSUM,2); ?> </td>
<td class="w-1/6  border border-black px-4 py-2" >
<a title="INFO" data-toggle="popover" data-trigger="hover" data-content="DELETE" data-placement="bottom" id="deletelink" data-debtentryid="<?php print $data->ID; ?>"  > 
  <div class="fas fa-trash" style="font-size:100%;"> </div>
   </a> </td>

</tr>

<?php 
}
?>

<tr class="bg-white-900 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >DEBT ACCRUED</td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
<td class="w-1/6  border border-black px-4 py-2" > </td>
<td class="w-1/6  border border-black px-4 py-2" >
<?php
$x=$connect->query(" SELECT  SUM(AMOUNT) AS TTLSUM  FROM debtrecords  WHERE  PATIENTNUMBER ='".$_SESSION['patientnumber']."' ");
while ($data = $x->fetch_object())
{ 
print number_format($data->TTLSUM,2); 
}
?>
 </td>
<td class="w-1/6  border border-black px-4 py-2" > </td>

</tr>

</tbody>
</table>

<Br>

</div>
</div>


  
  
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

