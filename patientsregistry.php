<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
include_once("interface.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'REGISTRATION'  ";
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
	</style>
	<style>
table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:right;
  }
  
 
  
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#newpatient").modal();
$('[data-toggle="popover"]').popover(); 

//$("#registrytable").load("registry.php #accountstable");

$("#newpatient").submit(function(){
$('#prepostmessage').modal('show');
$.post( "newpatient.php",
$("#newpatient").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$("#registrytable").load("patientsregistry.php #patientstable");
$('#prepostmessage').modal('hide');
return false;
});

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
  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="NEW  PATIENT" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newpatient"><i class="fas fa-user-injured" style="font-size:200%;" ></i>NEW PATIENT</button></a>
  
  <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
  </div>
  
      <div class="flex justify-center"   ><img src="letterhead.png"    id="letterhead"   width="50%"  height="10%"   /></div>
	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  <form class="modal fade" id="newpatient" role="dialog" method="post"   action="newpatient.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;"> <i class="bi bi-house-door icon"></i>NEW PATIENT<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-4"> 
PATIENT NAME<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PATIENT NAME" data-placement="bottom">
<input  style='text-transform:uppercase' name="name" type="text"  pattern="[0-9A-Za-z ]+"  title="INVALID ENTRIES"   size="15" placeholder="ENTER PATIENT NAME."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

BIRTH DATE <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  BIRTH DATE " data-placement="bottom">
<input  style='text-transform:uppercase' name="birthdate" type="date"   size="15" required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />
GENDER <a href="#" title="INFO"  data-toggle="popover" data-trigger="hover" data-content="SELECT PATIENT  GENDER " data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="gender" >
	 <option value="MALE">MALE</option>
        <option value="FEMALE">FEMALE</option>
			  </select></a>
<br />
  CONTACT<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  CONTACT"   data-placement="bottom">
<input  style='text-transform:uppercase' name="contact" type="text"  pattern="[0-9]{10}"  title="ENTER 10 DIGIT  PHONE NUMBER "   size="15" placeholder="ENTER CONTACT"   class="form-control input-sm"       autocomplete="off" ></a><br />

ID NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ID NUMBER" data-placement="bottom">
<input style='text-transform:uppercase'  name="idnumber" type="text"  pattern="[0-9]+"  title="ID NUMBER"   size="15" placeholder="ID NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>


 </div>
  
  
  <div class="col-sm-4">
  
 RESIDENCE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RESIDENCE" data-placement="bottom">
<input  style='text-transform:uppercase'  list="residencelist" name="residence" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="INVALID ENTRIES "   size="15" placeholder="ENTER  RESIDENCE."   class="form-control input-sm"     autocomplete="off" ></a>

<br>
<datalist id="residencelist" >
<?php 
$x=$connect->query("SELECT DISTINCT(LOCATION) AS LOCATION  FROM patientsrecord ORDER BY LOCATION  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->LOCATION; ?> " > <?php print $data->LOCATION; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>



NEXT OF KIN 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEXT OF KIN" data-placement="bottom">
<input  style='text-transform:uppercase'  name="nextofkin" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="INVALID ENTRIES"   size="15" placeholder="NEXT ON KIN"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
NEXT OF KIN  RELATION 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEXT OF KIN RELATIONSHIP" data-placement="bottom">
<input  style='text-transform:uppercase' list="relationship" name="nextofkinrelation" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="INVALID ENTRIES"   size="15" placeholder="NEXT ON KIN RELATIONSHIP"   class="form-control input-sm"     autocomplete="off" ></a>
<datalist id="relationship" >
<?php 
$x=$connect->query("SELECT DISTINCT(NEXTOFKINRELATION) AS RELATIONSHIP  FROM patientsrecord ORDER BY LOCATION  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->RELATIONSHIP; ?> " > <?php print $data->RELATIONSHIP; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
<br>NEXT OF KIN CONTACTS
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEXT OF KIN  CONTACT" data-placement="bottom">
<input  style='text-transform:uppercase'  name="nextofkincontact" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="NEXT OF KIN  CONTACT"   size="15" placeholder="NEXT OF KIN  CONTACT"   class="form-control input-sm"     autocomplete="off" ></a>

 
</div>

<div class="col-sm-4">

PATIENT  CATEGORY 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT PATIENT  CATEGORY" data-placement="bottom"> 
 <select class="form-control"     name="patienttype" >
	 <option value="WALK IN">CASH PAY WALK IN</option>
        <option value="INSUARANCE">INSUARANCE  PAY </option>
		<option value="INVOICED">INVOICED CREDITED </option>
			  </select></a><br />

INSUARANCE /CREDIT COMPANY
<select class="form-control"    name="insuarance" >
 <option value="">SELECT INSUARNCE</option>
 <?php $x=$connect->query("SELECT  INSUARANCE  FROM insuarances ORDER BY INSUARANCE  ");
while ($data = $x->fetch_object())
{ ?>
	 <option value="<?php print $data->INSUARANCE; ?>"><?php print $data->INSUARANCE; ?></option>
<?php } ?>
			  </select>

<br>
REFF  NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RESIDENCE" data-placement="bottom">
<input style='text-transform:uppercase'   name="refferencenumber" type="text"  pattern="[0-9A-Za-z@_' - ]+"  title="INSUARANCE/THIRD PARTY NUMBER "   size="15" placeholder="INSUARANCE/THIRD PARTY NUMBER."   class="form-control input-sm"     autocomplete="off" ></a>

<br>


<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button>   
 

</div>
</div></div>

  
  </div></div></div></div>
  </form> 
<h4   style="text-align:center"><strong>CUSTOMERS   REGISTRY </h4>  
 <form id="registrytable"   method="post" action="deleteaccounts.php"  > 
  

<table class="table"  id="patientstable"  style="text-align:center;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody style="font-weight:bold;text-decoration:underline;">
             <tr >
		  <td  class="theader" width="5%"  height="28" valign="top" style='text-align:center;' >NO.</td>   
		   <td  class="theader"  height="28" valign="top"  style='text-align:center;'  >REFF #</td>     
		    <td  class="theader"  width="20%"  height="28" valign="top" style='text-align:center;'  >NAME</td>  
		 			
			 <td  class="theader"    height="28" valign="top"  style='text-align:center;' >CONTACT</td>
			  <td  class="theader"  height="28" valign="top" style='text-align:center;'  >GENDER </td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > CHECKUP  </td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > ACTION </td> </tr>
        <?php
$x=$connect->query("SELECT DISTINCT(t1.ACCOUNT),t1.ID,t1.CLASS,t1.GENDER,t1.CLIENT,t1.CONTACT,TIMESTAMPDIFF(YEAR, t1.BIRTHDATE, CURDATE()) AS YRS,TIMESTAMPDIFF(MONTH,t1.BIRTHDATE, CURDATE()) % 12 AS  MONTHS, t2.URGENCY FROM patientsrecord t1 LEFT JOIN consultation t2 ON t1.account = t2.patientnumber WHERE t1.ACCOUNT !='00000'  ORDER BY t1.ID DESC ,t1.CLIENT ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
<tr class='filterdata'  style='text-align:center;' >
				<td  width='5%'  style='text-align:center;' ><?php print $number; ?> </td>  
              
			    <td    style='text-align:center;'  ><?php  print $data->ACCOUNT; ?></td>
				
			   <td  width="20%"  style='text-align:center;'  ><?php  print $data->CLIENT; ?></td>
				  <td style='text-align:center;' ><?php  print $data->CONTACT; ?></td>
				   <td style='text-align:center;'  ><?php  print $data->GENDER; ?></td>
				   <td style='text-align:center;' ><?php 
		if($data->URGENCY=='PRIORITY')
		{print '<div style="color:red;font-weight:bold;" >PRIORITY</div>';}
else {print '<div >'.$data->URGENCY.'</div>';} 
			?></td>  
				            <td style='text-align:center;'  >
							<a  title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="VIEW DETAILS" data-placement="bottom"  href="customerdetails.php?clientid=<?php  print $data->ID; ?>"><i class="fas fa-desktop" style="font-size:160%;"></i></a>
							<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="EDIT DETAILS" data-placement="bottom" title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="EDIT" data-placement="bottom" href="editpatient.php?clientid=<?php  print $data->ID; ?>"  onclick="return confirm('EDIT ?')" ><i class="fas fa-pencil-alt" style="font-size:160%;"></i></a>
			 <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK PROCEDURE" data-placement="bottom"  href="booktraige.php?clientid=<?php  print $data->ACCOUNT; ?>"  onclick="return confirm('BOOK TRAIGE ?')" > <div class="fas fa-user-nurse" style="font-size:160%;"> </div></a>
				 <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="GENERATE BILL" data-placement="bottom"  href="pointofsale2.php?patientnumber=<?php  print $data->ACCOUNT; ?>"  onclick="return confirm('GENERATE BILL ?')" > <div class="fas fa-receipt" style="font-size:160%;"> </div></a>
		 <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="DELETE" data-placement="bottom"   href="deletepatient.php?patientnumber=<?php  print $data->ACCOUNT; ?>"  onclick="return confirm('DELETE  PATIENT ?')" ><div class="fas fa-trash" style="font-size:160%;"> </div></a>

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

