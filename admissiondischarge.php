<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
include_once("interface.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'NURSE'  ";
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

@media print {
    /* Hide the last column in the printed version */
    table th:last-child,
    table td:last-child {
        display: none;
    }
}
  table  td:nth-child(1),td:nth-child(5),td:nth-child(7),td:nth-child(9){width: 3%;}
  table  td:nth-child(2){width: 6%;}
  
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#newadmission").modal();
$('[data-toggle="popover"]').popover(); 
//$("#deleteinpatient").load("registry.php #accountstable");	

$("#newadmission").submit(function(){
$('#prepostmessage').modal('show');
$.post( "newadmission.php",
$("#newadmission").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');
$("#deleteinpatient").load("admissiondischarge.php #inpatients");
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
  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="NEW  ADMISSION" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newadmission"><i class="fa-solid fa-bed" style="font-size:200%;" ></i>ADMISSION</button></a>
    <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
  </div>
  
     <div class="flex justify-center"><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="50%"  height="10%"   /></div></div>
	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  <form class="modal fade" id="newadmission" role="dialog" method="post"   action="newadmission.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">NEW ADMISSION <div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12"><i class="fa-solid fa-bed" style="font-size:150%;" ></i>  <br>
PATIENT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PATIENT NAME" data-placement="bottom">
<input list="patientnumberlist" style='text-transform:uppercase' name="patientnumber" type="text"  required pattern="[0-9 ]+"  title="ENTER CAPITAL ALPHA NUMERIC "   size="15" placeholder="ENTER PATIENT NAME."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

WARD <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT WARD " data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="ward" >
	 <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
		<option value="PAEDIATRIC">PAEDIATRIC</option>
			  </select></a>
<br />
BED NUMBER <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  BED NUMBER"   data-placement="bottom">
<input  style='text-transform:uppercase'  required name="bednumber" type="number"  min="1" max="10"  title="ENTER BED NUMBER "   size="15" placeholder="ENTER BED NUMBER"   class="form-control input-sm"       autocomplete="off" ></a><br />
ADMISSION DATE <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ADMISSION DATE "   data-placement="bottom">
<input  style='text-transform:uppercase'  required name="date" type="date"   title="SELECT  ADMISSION DATE  "   size="15" placeholder="ENTER ADMISSION DATE"   class="form-control input-sm"       autocomplete="off" ></a><br />


<br>
<datalist id="patientnumberlist" >
<?php 
$x=$connect->query("SELECT ACCOUNT,CLIENT  FROM patientsrecord WHERE ACCOUNT NOT IN (SELECT PATIENTNUMBER FROM inpatientsrecord)");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ACCOUNT; ?> " > <?php print $data->ACCOUNT; ?>   <?php print $data->CLIENT; ?>  </option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newadmission">CLOSE</button>   

 </div>
</div></div>

  
  </div></div></div></div>
  </form>   <h3 style="font-decoration:underline;text-align:center;font-style:bold;">IN PATIENTS</h3>
 <form id="deleteinpatient"   method="post" action="deleteinpatient.php"  > 
 <table class="table"  id="inpatients"  style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader" width="1%"  height="28" valign="top" style='text-align:center;' >NO.</td>   
		   <td  class="theader"  height="28" valign="top"  style='text-align:center;'  >PATIENT #</td>     
		    <td  class="theader"  width="20%"  height="28" valign="top" style='text-align:center;'  >NAME</td>  
		 			
			 <td  class="theader"    height="28" valign="top"  style='text-align:center;' >WARD</td>
			  <td  class="theader"  height="28" valign="top" style='text-align:center;'  >BED </td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > BILLED  </td>
			    <td  class="theader"  height="28" valign="top" style='text-align:center;'  > BILLDAYS  </td>
				<td  class="theader"  height="28" valign="top" style='text-align:center;'  > ADMITTED   </td>
				<td  class="theader"  height="28" valign="top" style='text-align:center;'  > ADMITDAYS  </td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  >  </td> </tr>
        <?php
$x=$connect->query("SELECT IFNULL(DATEDIFF(CURRENT_DATE,ADMISSIONDATE),'NEVER') AS DDYS, IFNULL(DATEDIFF(CURRENT_DATE,ADMITDATE2),'NEVER') AS DDYS2, inpatientsrecord.WARD,inpatientsrecord.BEDNUMBER,ADMITDATE2,inpatientsrecord.ADMISSIONDATE,inpatientsrecord.PATIENTNUMBER,inpatientsrecord.ID,patientsrecord.CLIENT FROM inpatientsrecord,patientsrecord WHERE patientsrecord.ACCOUNT=inpatientsrecord.PATIENTNUMBER ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
<tr class='filterdata'  style='text-align:center;' >
				<td  width='1%'  style='text-align:center;' ><?php print $number; ?> </td>  
              <td style='text-align:center;' ><?php print $data->PATIENTNUMBER; ?></td>  
			    <td   width='20%' style='text-align:center;'  ><?php print $data->CLIENT; ?></td>
				
			   <td   style='text-align:center;'  ><?php print $data->WARD; ?></td>
				  <td style='text-align:center;' ><?php print $data->BEDNUMBER; ?></td>
				   <td style='text-align:center;'  ><?php print $data->ADMISSIONDATE; ?></td>
				    <td style='text-align:center;'  ><?php print $data->DDYS; ?></td>
					<td style='text-align:center;'  ><?php print $data->ADMITDATE2; ?></td>
					<td style='text-align:center;'  ><?php print $data->DDYS2; ?></td>     
				            <td style='text-align:center;'  >
							<a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="WARD TRANSFER" data-placement="bottom" href="wardtransfer.php?inpatientid=<?php print $data->ID; ?>"  onclick="return confirm('WARD TRANSFER  ?')" ><i class="fas fa-ambulance" style="font-size:160%;"></i></a><a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="INPATIENT CHECK UP" data-placement="bottom"  href="consultation.php?patientnumber=<?php print $data->PATIENTNUMBER; ?>"  onclick="return confirm('INPATIENT CHECKUP  ?')" > <div class="fas fa-user-md" style="font-size:160%;"> </div></a>
<?php }	?> 
 </tr>
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

