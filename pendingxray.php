<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'LAB & IMAGING'  ";
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
$("#bookprocedure").modal();
$('[data-toggle="popover"]').popover(); 
//$("#pricelisttable").load("registry.php #accountstable");	


$("#bookprocedure").submit(function(){
$('#prepostmessage').modal('show');
$.post( "bookimaging.php",
$("#bookprocedure").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');
$("#bookedprocedures").load("pendingxray.php #bookedprocedurestable");
return false;
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
         $('#additem').click(function(){
 $('#itemdetails').append('<br><div class="container"><div class="row">  <div class="col-sm-6">'+
 '<input list="itemlist"  required style="text-transform:uppercase" pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="item"  name="procedure[]" type="text" size="15" placeholder="ENTER  ITEM"  required="on"  class="form-control input-sm"    autocomplete="off" >'+
 '</div><div class="col-sm-6">'+
  '<input   required style="text-transform:uppercase" pattern="[0-9 ]+" title="INVALID ENTRIES" id="item"  name="frequency[]" type="text" size="15" placeholder="ENTER FREQUENCY"  required="on"  class="form-control input-sm"    autocomplete="off" >'+
 '</div>'+
 '</div></div>');
            });
			
        });
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
  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="NEW  DETAILS" data-placement="bottom">
  <i class="fa-solid fa-circle-radiation" style="font-size:200%;"  data-toggle="modal" data-target="#bookprocedure" ></i></a>
  <i style="font-size:200%;" onclick="window.print()"  class="fas fa-print"></i>

    <!-- Modal -->
  </div>
  <h3 style="font-weight:bold;font-decoration:underline;text-align:center;">PENDING   procedures</h3>
	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  <form class="modal fade" id="bookprocedure" role="dialog" method="post"   action="bookprocedure2.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">NEW ITEM/SERVICE<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">PATIENT NUMBER 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER " data-placement="bottom">
<input style='text-transform:uppercase' required  name="patientnumber" type="text" list="patientnmberslist" pattern="[0-9 ]+"  title="INVALID ENTRIES"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>
<datalist id="patientnmberslist" >
<?php 
$x=$connect->query("SELECT ACCOUNT,CLIENT  FROM patientsrecord ORDER BY ACCOUNT  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ACCOUNT; ?> " > <?php print $data->CLIENT; ?></option>	
		
		<?php 	
	
}

?>
</datalist>

<br>BOOK MULTI TESTS
<button type="button" class="btn-info btn-sm"  id="additem"> <i class="fa-solid fa-circle-radiation" style="font-size:160%;"  ></i></button> 
 <div id="itemdetails">
</div>

 <datalist id="itemlist" >
<?php 
$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE   FROM imagingservices ORDER BY  DETAILS ASC   ");
while ($data = $x->fetch_object())
{
	0
?>
	 <option value="<?php print $data->DETAILS; ?> " > <?php print $data->DETAILS; ?> <?php print number_format($data->PRICE,2); ?> C.P <?php print number_format($data->COPRATEPRICE,2); ?></option>	
		
		<?php 	
	
}

?>
</datalist><br> 

<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
				<button type="button" class="btn-info btn-sm" data-dismiss="modal" >CLOSE</button> 
                      
<br>

 </div>
  
</div></div>

  
  </div></div></div></div>
  </form> 
  
   

<form id="bookedprocedures"   method="post"   > 

<table class="table"  id="bookedprocedurestable"  style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="5%" height="28" valign="top" style='text-align:center;' >NO.</td>
<td  class="theader"    height="28" valign="top"  style='text-align:left;' >PATIENT </td>
<td  class="theader"   width="30%" height="28" valign="top"  style='text-align:left;' >NAME </td>			
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > DETAILS </td> </tr>
 		
		
				<?php
				
$number=0;
$x=$connect->query(" SELECT pendingsales.PATIENTNUMBER,patientsrecord.CLIENT FROM pendingsales,imagingservices,patientsrecord WHERE pendingsales.DETAILS=imagingservices.DETAILS AND pendingsales.PATIENTNUMBER=patientsrecord.ACCOUNT AND pendingsales.STATUS='' GROUP BY  pendingsales.PATIENTNUMBER ORDER BY  DATE,pendingsales.ID ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td> 
					<td   style='text-align:left;'  ><?php print $data->PATIENTNUMBER; ?></td>
<td   style='text-align:left;' width='30%' ><?php print $data->CLIENT; ?></td>						
	            <td style='text-align:center;'  >
<a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="VIEW  PENDING  PROCEDURES" data-placement="bottom" href="pendingpxray2.php?patientnumber=<?php print $data->PATIENTNUMBER; ?>"  onclick="return confirm('VIEW PENDING PROCEDURES ?');" ><i class="fas fa-x-ray" style="font-size:160%;"></i></a>
			 </td>
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

