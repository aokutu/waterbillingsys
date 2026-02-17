<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}

	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; } body {text-transform:inherit;}
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
			   text-align:center;
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }
	 
	 #idnumber-list
{
	 overflow-y: scroll;      
  height: 60%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
@media print{a[href]:after{content:none}}
  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();
 $( '#names' ).click( function () {
	 
   $(':checkbox').each(function() {
          this.checked = true;
      });
  })
  
  $( '.deletestaff' ).click( function () {
	var action="DELETE STAFF ?";
	 var x=confirm(action);   
	 if(x ==false){return false;}	
  })
  $( '.editstaff' ).click( function () {
	var action="EDIT STAFF ?";
	 var x=confirm(action);   
	 if(x ==false){return false;}	
  })


  
  
  $("#viewpayslips").submit(function(){
	
  var action="LOAD PAYSLIPS ?";		 
 var x=confirm(action);   
 if(x ==false){return false; }
 
 $('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#viewpayslips").serialize(),
function(data){

$("#content").load("message.php #content");
$("#processpayroll").load("viewpayslips.php #payslips")
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#processpayroll").submit(function(){
	
		var action="PROCESS PAYROLL ?";		 
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 
 	$('#prepostmessage').modal('show');
 $.post( "processpayroll.php",
$("#processpayroll").serialize(),
function(data){

$("#content").load("message.php #content");
$("#processpayroll").load("staffpayroll.php #payrolltable")
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

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
		url: "searchinventory.php",
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
<br>
<div class="container">
  <!-- Trigger the modal with a button -->
  <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="VIEW PAYSLIPS" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#viewpayslips">VIEW PAYSLIPS</button></a>
  
  <br> <br>
  <input type="text"  style="width:30%;" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">

    <!-- Modal -->
  </div>
   
  <form class="modal fade" id="viewpayslips" role="dialog" method="post"  action="viewpayslips.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<h4 align="center" style="text-decoration:underline;"><strong>SALARY POSTING DATE </strong></h4>
FROM<input type="date" class="form-control input-sm" name="date1" id="acc1"  autosearch="off"><br />
TO<input type="date" class="form-control input-sm"   name="date2" id="acc2"  autosearch="off"><br />
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
  
<form id="processpayroll" method="post" action="processpayroll.php">
  <div id="payrolltable">
<h3 style="text-align:center;text-decoration:underline;"><strong>STAFFS REGISTRY.</strong></h3>

<br>
<div class="col-sm-3">SELECT MONTH<input type="month"  class="form-control input-sm"  name="month"  style="text-transform:uppercase;" required="on" /></div>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
          <td width='2%'  class="theader"  height="28" valign="top" >#</td>
		   <td   width='35%'  class="theader"  height="28" valign="top" >NAMES</td>
       <td  class="theader"  height="28" valign="top" >GROSS </td>
       <td  class="theader"  height="28" valign="top" >DEDUCTIONS</td>     
		    <td  class="theader"  height="28" valign="top" >NET </td>  
       <td  class="theader"   height="28" valign="top" >
       
<br>
       

       </td>			 			  
          </tr>
        </thead>
        <tbody>
        
		<?php
    $no =0;
$x = $connect ->query("SELECT ID,TITLE,IDNUMBER,NAMES,KRAPIN,CONCAT(BASICSALARY+HOUSEALLOWANCE+TRAVELALLOWANCE+HARDSHIPALLOWANCE) AS GROSS,CONCAT(PAYEE+NHIF+NSSF) AS DEDUCTIONS FROM  STAFFS  ");
while ($data = $x->fetch_object())
{ 		$no +=1;    echo"<tr class='filterdata'>
      <td  width='2%' >".$no."</td>
              <td width='35%'  >".$data->TITLE." ".$data->NAMES."</td>
              <td >".number_format($data->GROSS,2)."</td>
              <td  >".number_format($data->DEDUCTIONS,2)."</td>  
			    <td    >".number_format($data->GROSS-$data->DEDUCTIONS,2)."</td>
          <td><input name='staffid[]'   type='checkbox' value='".$data->ID."'   class='form-control input-sm'> </td>  
          </tr>";
		 }
		 
		?>
    <?php
   
$x = $connect ->query("SELECT SUM(CONCAT(BASICSALARY+HOUSEALLOWANCE+TRAVELALLOWANCE+HARDSHIPALLOWANCE)) AS GROSS,SUM(CONCAT(PAYEE+NHIF+NSSF)) AS DEDUCTIONS FROM  STAFFS  ");
while ($data = $x->fetch_object())
{ 		    echo"<tr class='filterdata'>
      <td  width='2%' ></td>
              <td width='35%'  ><strong>TOTAL</strong></td>
              <td ><strong>".number_format($data->GROSS,2)."</strong></td>
              <td  ><strong>".number_format($data->DEDUCTIONS,2)."</strong></td>  
			    <td    ><strong>".number_format($data->GROSS-$data->DEDUCTIONS,2)."</strong></td>
				 <td  ></td></tr>";
		 }
		 
		?>
      <tr class='filterdata'><strong>
      <td  width='2%' ></td>
              <td width='35%'  ><button type="submit" class="btn-info btn-sm" >SUBMIT</button></td>
              <td ><button type="reset" class="btn-info btn-sm">RESET</button></td>
              <td  ></td>  
			    <td    ></td>
				 <td  ></td></strong></tr>  
  </tbody>
    </table>
    <br>
    </div>
 
</form>
   <form class="modal fade" id="reciepts" role="dialog" method="post"  action="posreciepts.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
FROM<input type="date" class="form-control input-sm" name="date1" id="date1"  required="on"><br />
TO <input type="date" class="form-control input-sm" name="date2" id="date2"  required="on"><br />

    </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>  
<?php 
include_once("dashboard3.php");
?>
 
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
