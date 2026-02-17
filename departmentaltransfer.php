<?php
@session_start();
include_once("password2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

?>
 <script type="text/javascript" >
  $(document).ready(function(){   
	
$(document).on('click', '#nursedesklink', function(event) {
        event.preventDefault();
        
        var patientnumber = $(this).data('patientnumber');
		 patientnumber = (patientnumber || '').trim();
        var msg = 'NURSE DESK  ' + patientnumber;
       if (patientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    patientnumber: patientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
					  $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
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


$(document).on('click', '#registrylink', function(event) {
        event.preventDefault();
        
        var registrypatientnumber = $(this).data('registrypatientnumber');
		 registrypatientnumber = (registrypatientnumber || '').trim();
		
        var msg = 'REGISTRY  ' + registrypatientnumber;
       if (registrypatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    registrypatientnumber: registrypatientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
					  $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
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

	
$(document).on('click', '#xraylink', function(event) {
        event.preventDefault();
        
        var xraypatientnumber = $(this).data('xraypatientnumber');
		 xraypatientnumber = (xraypatientnumber || '').trim();
		
        var msg = 'XRAY & IMAGING  ' + xraypatientnumber;
       if (xraypatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    xraypatientnumber: xraypatientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
					  $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
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

$(document).on('click', '#phamarcybookinglink ', function(event) {
        event.preventDefault();
        
        var phamarcypatientnumber = $(this).data('patientnumber');
		 phamarcypatientnumber = (phamarcypatientnumber || '').trim();
        var msg = 'PHAMARCY BOOKING  ' + phamarcypatientnumber;
       if (phamarcypatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    phamarcypatientnumber: phamarcypatientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
					  $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
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


$(document).on('click', '#traige', function(event) {
        event.preventDefault();
        
        var patientnumber = $(this).data('patientnumber');
		 patientnumber = (patientnumber || '').trim();
        var msg = 'NURSE DESK BOOKING  ' + patientnumber;
       if (patientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    patientnumber: patientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
			  $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
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
	
	
	$(document).on('click', '#billing', function(event) {
        event.preventDefault();
        
        var billingpatientnumber = $(this).data('patientnumber');
		 billingpatientnumber = (billingpatientnumber || '').trim();
        var msg = 'BILLING BOOKING  ' + billingpatientnumber;
       if (billingpatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    billingpatientnumber: billingpatientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
			  $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
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
	
	
$(document).on('click', '#consultationlink', function(event) {
        event.preventDefault();
        
        var consultationpatientnumber = $(this).data('patientnumber');
		 consultationpatientnumber = (consultationpatientnumber || '').trim();
        var msg = 'CONSULTATION DESK  ' + consultationpatientnumber;
       if (consultationpatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    consultationpatientnumber: consultationpatientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
			  $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
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
$("#newadmission").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'newadmission.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
              $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
                });
                  $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                 $('#message').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
                $('#prepostmessage').modal('hide'); // Hide modal in case of error
            }
        });

        // Return false to prevent default form submission (this is the correct place)
        return false;
    });
	

 $(document).on('click', '#inpatientadmission', function(event) {
        event.preventDefault();
		var inpatientnumber = $(this).data('patientnumber');
		$("#patientnumberadmitted").val(inpatientnumber);
		$('#newadmission').modal('show');
		return false;
		  //$('#patientnumberclass').val(editpatientnumber);
		 patientnumberadmit = (patientnumberadmit || '').trim();
		$('#newadmission').modal('show');
        return false;
    });
	
	
	$(document).on('click', '#servicesbooking', function(event) {
        event.preventDefault();
        
        var labandimagingpatientnumber = $(this).data('patientnumber');
		 labandimagingpatientnumber = (labandimagingpatientnumber || '').trim();
        var msg = 'LAB & IMAGING BOOKING  ' + labandimagingpatientnumber;
       if (labandimagingpatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    labandimagingpatientnumber: labandimagingpatientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
			  $("#registrytable").load("departmentaltransfer.php #patientdetails ", function() {
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
	
	
$('[data-toggle="popover"]').popover(); 

//$("#registrytable").load("registry.php #accountstable");
$("#bookprocedure").submit(function(){
$('#prepostmessage').modal('show');
$.post( "bookprocedure2.php",
$("#bookprocedure").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');
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
 $('#itemdetails').append('<br><div class="container"><div class="row"><input list="itemlist"  required style="text-transform:uppercase" pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="item"  name="procedure[]" type="text" size="15" placeholder="ENTER  ITEM"  required="on"  class="form-control input-sm"    autocomplete="off" ></div></div>');
            });
			
        });
    </script>
<form class="modal fade" id="bookprocedure" role="dialog" method="post"   action="bookprocedure2.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">NEW ITEM/SERVICE<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">PATIENT NUMBER 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER " data-placement="bottom">
<input readonly id="procedurepatientid" style='text-transform:uppercase' required  name="patientnumber" type="text"  pattern="[0-9 ]+"  title="INVALID ENTRIES"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>


<br>BOOK MULTI TESTS

<button type="button" class="btn-info btn-sm"  id="additem"> <i class="fa-solid fa-microscope" style="font-size:160%;"  ></i></button> 
 <div id="itemdetails">
</div>

 <datalist id="itemlist" >
<?php 
$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE   FROM services ORDER BY  DETAILS ASC   ");
while ($data = $x->fetch_object())
{
	0
?>
	 <option value="<?php print $data->DETAILS; ?> " > <?php print $data->DETAILS; ?> <?php print number_format($data->PRICE,2); ?> C.P <?php print number_format($data->COPRATEPRICE,2); ?></option>	
		
		<?php 	
	
}

?>
</datalist><br> 

<button type="submit" class="btn-info btn-sm" >SUBMIT</button>
				<button type="button" class="btn-info btn-sm" data-dismiss="modal" >CLOSE</button> 
                      
<br>

 </div>
  
</div></div>

  
  </div></div></div></div>
  </form> 
  
  
    <form class="modal fade" id="newadmission" role="dialog" method="post"   action="newadmission.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">NEW ADMISSION <div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12"><i class="fa-solid fa-bed" style="font-size:150%;" ></i>  <br>
PATIENT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PATIENT NAME" data-placement="bottom">
<input readonly  style='text-transform:uppercase' id="patientnumberadmitted" name="patientnumber" type="text"  required pattern="[0-9 ]+"  title="ENTER ADMISSION "   size="15" placeholder="ENTER PATIENT NAME."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

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
  </form> 

 <form class="modal fade" id="inpatientadmissionform" role="dialog" method="POST"   action="setpatientsession.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">EDIT CLASSES<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input readonly id="patientnumberadmit" style='text-transform:uppercase' required  name="classpatientnumber" type="text"  pattern="[0-9 ]+"  title="PATIENT NUMBER"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
xxxx
 <br>
 <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" >CLOSE</button> 

 </div>
</div></div>

  
  </div></div></div></div>
  </form> 
  
  
  
  <form id="registrytable"   method="post" > 
<div class="container" id="patientdetails">
  <div class="row">
  <div class="col-sm-12">
  <?php
  class patient 
  {
public $patientnumber=null;
  }
  $patient=new patient;
  $patient->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
  
  $x=$connect->query("SELECT URGENCY   FROM consultation  WHERE  PATIENTNUMBER='$patient->patientnumber'  ");
while ($data = $x->fetch_object())
{
	
$department=$data->URGENCY;
}
 $x=$connect->query("SELECT CLIENT,ACCOUNT,GENDER,CLASS,INSUARANCE,INSUARANCENUMBER  FROM patientsrecord  WHERE  ACCOUNT='$patient->patientnumber'  ");
while ($data = $x->fetch_object())
{ ?>
  
  <div class="grid grid-cols-1 gap-4">
  <div class="square w-full h-32 bg-blue-200  flex justify-center items-center">DEPARTMENT: <?php print $department; ?></div>
</div>
<br>
      <div class="grid grid-cols-4 gap-4 ">
        <!-- Create 12 squares -->
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK NURSE DESK" data-placement="bottom" id="traige" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-user-nurse" style="font-size:260%;"> </div>
  <br>NURSE DESK   </a>		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK BILLING" data-placement="bottom" id="billing" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-cash-register" style="font-size:260%;"> </div>
  <br>BILLING   </a>			
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="LAB IMAGING" data-placement="bottom" id="servicesbooking" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-vials" style="font-size:260%;"> </div>
 <br> LABORATORY</a> 
 
 
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
  
  <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK PHAMARCY" data-placement="bottom" id="phamarcybookinglink" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-pills" style="font-size:260%;"> </div>
  <br>PHAMARCY   </a>
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK CONSULTATION" data-placement="bottom" id="consultationlink" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-user-md" style="font-size:260%;"> </div>
  <br>CONSULTATION   </a>

  
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
	<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="GENERATE BILL" data-placement="bottom" href="pointofsale2.php?patientnumber=<?php  print $data->ACCOUNT; ?>"  onclick="return confirm('GENERATE  PATIENT BILL  ?')" > 
  <div class="fas fa-receipt" style="font-size:260%;"> </div>
 <br> GENERATE BILL</a>
</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
  	<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK XRAY & IMAGING" data-placement="bottom" id="xraylink" data-xraypatientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-x-ray" style="font-size:260%;"> </div>
  <br>X-RAY & IMAGING   </a>
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
		
		<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK REGISTY" data-placement="bottom" id="registrylink" data-registrypatientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fa fa-address-card" style="font-size:260%;"> </div>
  <br>REGISTRATION    </a>	
		
		</div>
    </div>
<?php
}

?>
  

  
  
  </div>
  </div></div>
             
 </form>