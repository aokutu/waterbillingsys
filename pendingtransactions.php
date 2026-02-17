<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'FINANCE'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

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

#bookprocedure{
  	 overflow-y: scroll;      
  height: 380px;            
  width: 100%;
  position: absolute;        
}	 
@media print {
  a[href]:after {
    content: none !important;
  }
}

@media print {
    /* Hide the last column in the printed version */
    table th:last-child,
    table td:last-child {
        display: none;
    }
}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$('[data-toggle="popover"]').popover(); 
//$("#pricelisttable").load("registry.php #accountstable");	
 var $rows = $('.filterdata');
 
 setInterval(function() {
        $('#pendingtransaction').load(location.href + ' #pendingtransactiontable');
    }, 10000); // 10 seconds
	
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
		url: "nometersautocomplete.php",
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
<div class="container" >
  <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
  </div>
  <h3 style="font-weight:bold;font-decoration:underline;text-align:center;">PENDING   TRANSACTIONS</h3>
<form  id="pendingtransaction"  > 

<table class="table"  id="pendingtransactiontable"  style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
<td  class="theader"    height="28" valign="top"  style='text-align:left;' ># </td>
<td  class="theader"    height="28" valign="top"  style='text-align:left;' >PATIENT </td>
<td  class="theader"  width='20%' height="28" valign="top"  style='text-align:left;' >NAME </td>
<td  class="theader" width='40%'   height="28" valign="top"  style='text-align:left;' >ITEM </td>
<td  class="theader"    height="28" valign="top"  style='text-align:right;' >PRICE </td>
<td  class="theader"    height="28" valign="top"  style='text-align:right;' >QNTY </td>
<td  class="theader"    height="28" valign="top"  style='text-align:right;' >TTL </td>
<td  class="theader"    height="28" valign="top"  style='text-align:right;' >STATUS </td>
<td  class="theader"    height="28" valign="top"  style='text-align:right;' >DEL </td>			
		
		</tr>
				<?php
				
$number=0;
$x=$connect->query("SELECT STATUS,pendingsales.DETAILS,pendingsales.ID,PATIENTNUMBER,CLIENT,PRICE,TOTAL,QUANTITY FROM  pendingsales,patientsrecord WHERE patientsrecord.ACCOUNT=pendingsales.PATIENTNUMBER  ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
<td   style='text-align:left;'  ><?php print $number; ?></td>						
<td   style='text-align:left;'  ><?php print $data->PATIENTNUMBER; ?></td>						
<td width='20%'  style='text-align:left;'  ><?php print $data->CLIENT; ?></td>
<td  width='40%' style='text-align:left;'  ><?php print $data->DETAILS; ?></td>
<td    style='text-align:right;'  ><?php print number_format($data->PRICE,2); ?></td>
<td    style='text-align:right;'  ><?php print $data->QUANTITY; ?></td>
<td    style='text-align:right;'  ><?php print number_format($data->TOTAL,2); ?></td>
<td    style='text-align:right;'  ><?php print $data->STATUS; ?></td>	
	            <td style='text-align:right;'  >
							<a   href="deletependingtransaction.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE  ?');" ><i class="fas fa-trash" style="font-size:160%;"></i></a>
			 </td>
	 </tr>
<?php }	?> 

 
 				<?php
				
$number=0;
$x=$connect->query("SELECT COUNT(ID) AS  TALLY FROM  pendingsales ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
 <td   style='text-align:left;'  ></td>						
<td   style='text-align:left;'  ></td>						
<td  width='20%' style='text-align:left;'  >TALLY</td>
<td  width='40%' style='text-align:left;'  ><?php print $data->TALLY; ?></td>	
	            <td   style='text-align:right;'  ></td>
				 <td   style='text-align:right;'  ></td>
				  <td   style='text-align:right;'  ></td>
				   <td   style='text-align:right;'  ></td>
				<td style='text-align:right;'  ></td>
	 </tr>
<?php }	?> 
 </tbody>
 </table>
                      
					  
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

