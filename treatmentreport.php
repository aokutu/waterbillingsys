<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'PHAMARCY'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

?>

 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>CLOUD 254 SOFTWARES</title>
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
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

 })
 
  $(document).on('click', '.deletedispence1', function(event) {
        event.preventDefault();
        var patientnumber = $(this).data('patientnumber');
		 patientnumber = (patientnumber || '').trim();
        var msg = 'PATIENT NUMBER ' + patientnumber;
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
        
        if (confirmdelete) {
            $.ajax({
                type: 'POST',
                url: 'deletephamarcypatients.php',
                data: {
                    patientnumber: patientnumber
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                // Update page content and hide modal
                $("#phamarcypatients").load("treatmentreport.php #phamarcypatientstable", function() {
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
  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="CROSS COUNTER" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#crosscounter">
<i style="font-size:200%;" class="fa-solid fa-prescription-bottle-medical"></i>  </i>CROSS COUNTER </button></a>
 
  <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
  </div>
  <h3 style="font-weight:bold;font-decoration:underline;text-align:center;">PENDING   DRUGS DISPENCE</h3>
	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
<form  id="phamarcypatients"  > 

<table id="phamarcypatientstable" class="table"  id="bookedprocedurestable"  style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="5%" height="28" valign="top" style='text-align:center;' >NO.</td>
<td  class="theader"    height="28" valign="top"  style='text-align:left;' >PATIENT </td>
<td  class="theader"   width="30%" height="28" valign="top"  style='text-align:left;' >NAME </td>			
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > ACTION </td> </tr>
 		
		
				<?php
				
$number=0;
$x=$connect->query(" SELECT  PATIENTNUMBER,CLIENT  FROM  treatmentreport,patientsrecord WHERE ACCOUNT=PATIENTNUMBER AND STATUS='' GROUP BY PATIENTNUMBER ORDER BY treatmentreport.DATE,treatmentreport.ID   ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td> 
					<td   style='text-align:left;'  ><?php print $data->PATIENTNUMBER; ?></td>
<td   style='text-align:left;' width='30%' ><?php print $data->CLIENT; ?></td>						
	            <td style='text-align:center;'  >
<a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="DRUGS DISPENCE" data-placement="bottom" href="drugdispencesession.php?patientnumber=<?php print $data->PATIENTNUMBER; ?>"  onclick="return confirm('DISPENCE  ?');" ><i class="fas fa-pills" style="font-size:160%;"></i></a>
&nbsp;&nbsp;<a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="DELETE " data-placement="bottom" class="deletedispence1" data-patientnumber="<?php print $data->PATIENTNUMBER; ?>" ><i class="fas fa-trash" style="font-size:160%;"></i></a>

			 </td>
	 </tr>
<?php }	?> 

 				<?php
$x=$connect->query("  SELECT pendingsales.PATIENTNUMBER,patientsrecord.CLIENT FROM pendingsales,patientsrecord WHERE  pendingsales.PATIENTNUMBER=patientsrecord.ACCOUNT AND pendingsales.PATIENTNUMBER NOT IN(SELECT PATIENTNUMBER FROM treatmentreport ) AND STATUS !='ISSUED' AND pendingsales.DETAILS IN(SELECT ITEM FROM inventory ) GROUP BY pendingsales.PATIENTNUMBER  ORDER BY  pendingsales.DATE,pendingsales.ID 
  ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td> 
					<td   style='text-align:left;'  ><?php print $data->PATIENTNUMBER; ?></td>
<td   style='text-align:left;' width='30%' ><?php print $data->CLIENT; ?></td>						
	            <td style='text-align:center;'  >
<a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="DRUGS DISPENCE" data-placement="bottom" href="drugdispencesession.php?patientnumber=<?php print $data->PATIENTNUMBER; ?>"  onclick="return confirm('DISPENCE  ?');" ><i class="fas fa-pills" style="font-size:160%;"></i></a>

			 </td>
	 </tr>
<?php }	?> 
 
 </tbody>
 </table>
                      
					  
 </form>
 
   <form class="modal fade" id="crosscounter" role="dialog" method="post"   action="crosscountersession.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">CROSS  COUNTER<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12"> 
<br>PATIENT NUMBER 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER " data-placement="bottom">
<input style='text-transform:uppercase' required id="patientnumber" name="patientnumber" type="text" list="patientnmberslist" pattern="[0-9 ]+"  title="INVALID ENTRIES"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>
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
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" >CLOSE</button> 

 </div>
  
</div></div>

  
  </div></div></div></div>
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

