 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
include_once("interface.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
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

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#searchpatient").modal();

//$("#pricelisttable").load("loadpricelist.php #pricelisttable2");

    $("#searchpatient").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Collect form data
       /* var companyname = $("#companyname").val();
        var companyaddress = $("#companyaddress").val();
        var phonenumber = $("#phonenumber").val();
        var email = $("#email").val(); */
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'sessionregistry.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
                $("#registrytable").load("registration.php #patientdetails ", function() {
                    // Optional: Rebind event handlers if necessary
                });
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


$("#debitdebtaccount").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
		var formData = $(this).serialize();
        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'debitdebtaccount.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
					$("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                    $('#message').modal('show');            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
                $('#prepostmessage').modal('hide'); // Hide modal in case of error
            }
        });

        // Return false to prevent default form submission (this is the correct place)
        return false;
    });
	
	
		$(document).on('click', '#prepostnatalcarelink', function(event) {
        event.preventDefault();
        
        var natalcarepatientnumber = $(this).data('natalcarepatientnumber');
		 natalcarepatientnumber = (natalcarepatientnumber || '').trim();
        var msg = 'BOOK NATAL CARE  ' + natalcarepatientnumber;
       if (natalcarepatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    natalcarepatientnumber: natalcarepatientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
			  $("#registrytable").load("registration.php #patientdetails ", function() {
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
			  $("#registrytable").load("registration.php #patientdetails ", function() {
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
	
	


$(document).on('click', '#clearpatientlink', function(event) {
        event.preventDefault();
       
        var clearpatientnumber = $(this).data('clearpatientnumber');
		 clearpatientnumber = (clearpatientnumber || '').trim();
       if (clearpatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    clearpatientnumber: clearpatientnumber // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
					  $("#registrytable").load("registration.php #patientdetails ", function() {
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

$(document).on('click', '#inpatientdischargelink', function(event) {
        event.preventDefault();
        
        var inpatientpatientnumber = $(this).data('inpatientpatientnumber');
		 inpatientpatientnumber = (inpatientpatientnumber || '').trim();
		
        var msg = 'DISCHARGE INPATIENT  ' + inpatientpatientnumber;
		var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;}
		 var accessname = prompt('NAME');
        var accesspass = prompt('PASSWORD');
		if(accessname==null ){return false;}
		if(accesspass==null ){return false;}
       if (inpatientpatientnumber != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    inpatientpatientnumber: inpatientpatientnumber,
					accessname: accessname,
                    accesspass: accesspass // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
					  $("#registrytable").load("registration.php #patientdetails ", function() {
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
					  $("#registrytable").load("registration.php #patientdetails ", function() {
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
					  $("#registrytable").load("registration.php #patientdetails ", function() {
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
					  $("#registrytable").load("registration.php #patientdetails ", function() {
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
					  $("#registrytable").load("registration.php #patientdetails ", function() {
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
$(document).on('click', '#startsessionlink', function(event) {
        event.preventDefault();
        
        var user = $(this).data('startsession');
		 user = (user || '').trim();
		 
        var msg = 'START REGISTY SHIFT OF ' + user;
		
       if (user != null) {
            $.ajax({
                type: 'POST',
                url: 'nursebooking.php',
                data: {
                    user: user // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
			  $("#registrytable").load("registration.php #patientdetails ", function() {
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
			  $("#registrytable").load("registration.php #patientdetails ", function() {
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
	
	
$("#newdebtform").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
		var formData = $(this).serialize();
        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'newdebt.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
              $("#registrytable").load("registration.php #patientdetails ", function() {
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
              $("#registrytable").load("registration.php #patientdetails ", function() {
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
	
	
    $("#editclassform").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'nursebooking.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
              $("#registrytable").load("registration.php #patientdetails ", function() {
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
	
	
	
 $(document).on('click', '#debtacruedlink', function(event) {
        event.preventDefault();
      
        var patientnumber = $(this).data('patientnumber');
		  $('#newdebtpatientnumber').val(patientnumber);
		 patientnumber = (patientnumber || '').trim();
		 
		$('#newdebtform').modal('show');
        return false;
        return true;
    });
	
	
	 $(document).on('click', '#debitdebtacruedlink', function(event) {
        event.preventDefault();
      
        var patientnumber = $(this).data('patientnumber');
		 $('#newdebtpatientnumber2').val(patientnumber);
		 patientnumber = (patientnumber || '').trim();
		 
		$('#debitdebtaccount').modal('show');
        return false;
        return true;
    });
	
 $(document).on('click', '#editclass', function(event) {
        event.preventDefault();
      
        var editpatientnumber = $(this).data('patientnumber');
		  $('#patientnumberclass').val(editpatientnumber);
		 editpatientnumber = (editpatientnumber || '').trim();
		$('#editclassform').modal('show');
        return false;
        return true;
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
		var inpatientnumber = $(this).data('patientnumber');
		$("#procedurepatientid").val(inpatientnumber);
		$('#bookprocedure').modal('show');
		return false;
		  //$('#patientnumberclass').val(editpatientnumber);
		 patientnumberadmit = (patientnumberadmit || '').trim();
		$('#newadmission').modal('show');
        return false;
    });
	
$('[data-toggle="popover"]').popover(); 

//$("#registrytable").load("registry.php #accountstable");

$("#searchpatient").submit(function(){
$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#searchpatient").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$("#registrytable").load("registration.php #patientdetails");
$('#prepostmessage').modal('hide');
return false;
});

return false;
})


$("#bookprocedure").submit(function(){
$('#prepostmessage').modal('show');
$.post( "bookprocedure2.php",
$("#bookprocedure").serialize(),
function(data){
$("#registrytable").load("registration.php #patientdetails");
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');
return false;
});
return false;
})


$("#newpatient").submit(function(){
$('#prepostmessage').modal('show');
$.post( "newpatient.php",
$("#newpatient").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$("#registrytable").load("registration.php #patientdetails");
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
   $(document).on('keyup', '#searchitem', function(event) {
    var searchitem = $(this).val().trim(); // Get the value of the input field and trim whitespace
    
    // Send the value via AJAX
    $.ajax({
        type: 'POST',
        url: 'loadpricelist.php', // URL to the PHP file that processes the request
        data: {searchitem: searchitem}, // Send the typed value
        success: function(response) {
            $('#pricelisttable').html(response); // Display the response inside the 'output' div
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
});

    </script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
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
 <select class="form-control"   required= "on"  name="patienttype" >
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
REFF  NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="RESIDENCE" data-placement="bottom">
<input style='text-transform:uppercase'   name="patientnumber" type="text"  pattern="[0-9 ]+"  title="INVALID  ENTRIES "   size="15" placeholder="PATIENT NUMBER."   class="form-control input-sm"     autocomplete="off" ></a>

<br>


<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button>   
 

</div>
</div></div>

  
  </div></div></div></div>
  </form> 
  
  
   <form class="modal fade" id="searchpatient" role="dialog" method="get"   action="setpatientsession.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">APPOINTMENTS & BOOKINGS<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input style='text-transform:uppercase' required list="patientnmberslist" name="patientnumber" type="text"  pattern="[0-9 ]+"  title="PATIENT NUMBER"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>

<datalist id="patientnmberslist" >
<?php 
$x=$connect->query("SELECT ACCOUNT,CLIENT,CONTACT,IDNUMBER,CONTACT,INSUARANCENUMBER  FROM patientsrecord WHERE ACCOUNT !='00000' ORDER BY ACCOUNT  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ACCOUNT; ?> " > <?php print $data->CLIENT.'&nbsp;'.$data->CONTACT.'  '.$data->IDNUMBER.' '.$data->INSUARANCENUMBER; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
 </div>
  


<div class="col-sm-4">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button> 
</div>
</div></div>

  
  </div></div></div></div>
  </form> 
  
  
     <form class="modal fade" id="pricelist" role="dialog" method="POST"   action="setpatientsession.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">PRICE LIST<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">SELECT SERVICE/ PHAMACUTICAL
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input id="searchitem" style='text-transform:uppercase' required list="pricelistdetails" name="searchitem" type="text"  pattern="[0-9 ]+"  title="PATIENT NUMBER"   size="15" placeholder="ENTER PATICULAR"   class="form-control input-sm"     autocomplete="off" ></a>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button> 

<datalist id="pricelistdetails" >
<?php 
$x=$connect->query("SELECT ITEM,PRICE,COPRATEPRICE,QUANTITY  FROM inventory WHERE QUANTITY >0  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ITEM; ?> " > ORDINARY &nbsp;<?php print number_format($data->PRICE,2).' &nbsp;COPRATE &nbsp;'.number_format($data->COPRATEPRICE,2).'&nbsp; QNTY &nbsp;'.$data->QUANTITY; ?></option>	
		
		<?php 	
	
	
}
		  
$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE  FROM services  ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->DETAILS; ?> " > ORDINARY &nbsp;<?php print number_format($data->PRICE,2).' &nbsp;COPRATE &nbsp;'.number_format($data->COPRATEPRICE,2).'&nbsp; QNTY &nbsp;'.$data->QUANTITY; ?></option>	
		
		<?php 	
	
	
}		

?>
</datalist>		
<table class="table"  id="pricelisttable"  style="text-align:center;font-size:95%;">
        <tbody id="pricelisttable2" style="font-weight:bold;text-decoration:underline;height:80%;">
		 <tr>
	  <td>PATICULARS</td> 
	  <td>ODINARY</td>
	  <td>COPRATE</td>
	  <td>NHIF</td>
	  <td>QNTY</td>
	   </tr>
		
		</tbody>
		</table>

 </div>
  

</div></div>

  
  </div></div></div></div>
  </form> 
  
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
$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE   FROM services  UNION SELECT DETAILS,PRICE,COPRATEPRICE   FROM imagingservices ORDER BY  DETAILS ASC ");
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
  
     <form class="modal fade" id="editclassform" role="dialog" method="POST"   action="setpatientsession.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">EDIT CLASSES<div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input readonly id="patientnumberclass" style='text-transform:uppercase' required  name="classpatientnumber" type="text"  pattern="[0-9 ]+"  title="PATIENT NUMBER"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<select class="form-control"   required= "on"  name="patientclass" >
	 <option value="WALK IN">WALK IN</option>
	 <option value="CASH">CASH WALK IN</option>
        <option value="INSUARANCE">INSUARANCE  PAY </option>
		<option value="NHIF">NHIF  </option>
			  </select>
 <br>
 <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button> 

 </div>
</div></div>

  
  </div></div></div></div>
  </form> 
  
   <form class="modal fade" id="newdebtform" role="dialog" method="POST"   action="newdebt.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">NEW DEBT <div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input readonly id="newdebtpatientnumber" style='text-transform:uppercase' required  name="patientnumber" type="text"  pattern="[0-9 ]+"  title="PATIENT NUMBER"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="AMOUNT" data-placement="bottom">
<input  style='text-transform:uppercase' required  name="amount" type="text"  pattern="[0-9.  ]+"  title="INVALID ENTRIES"   size="15" placeholder="AMOUNT"   class="form-control input-sm"     autocomplete="off" ></a>

 <br>
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DATE" data-placement="bottom">
<input  style='text-transform:uppercase' required  name="date" type="datetime-local"  title="INVALID ENTRIES"   size="15" placeholder="DATE"   class="form-control input-sm"     autocomplete="off" ></a>

 <br>
 <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button> 

 </div>
</div></div>

  
  </div></div></div></div>
  </form> 
 
 
   <form class="modal fade" id="debitdebtaccount" role="dialog" method="POST"   action="debitdebtaccount.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;">DEBIT  DEBT ACCOUNT <div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input readonly id="newdebtpatientnumber2" style='text-transform:uppercase' required  name="patientnumber" type="text"  pattern="[0-9 ]+"  title="PATIENT NUMBER"   size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="AMOUNT" data-placement="bottom">
<input  style='text-transform:uppercase' required  name="amount" type="text"  pattern="[0-9.  ]+"  title="INVALID ENTRIES"   size="15" placeholder="AMOUNT"   class="form-control input-sm"     autocomplete="off" ></a>

 <br>
 
 <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DATE" data-placement="bottom">
<input  style='text-transform:uppercase' required  name="date" type="datetime-local"  title="INVALID ENTRIES"   size="15" placeholder="DATE"   class="form-control input-sm"     autocomplete="off" ></a>

 <br>
 
  <a href="#" title="INFO"  data-toggle="popover" data-trigger="hover" data-content="SELECT PATIENT  GENDER " data-placement="bottom"> 
 <select class="form-control"   required= "on"  name="paymode" >
	 <option value="CASH">CASH</option>
        <option value="M-PESA">M-PESA</option>
			  </select></a>
			  <br>
 
 <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button> 

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
<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newpatient">CLOSE</button> 

 </div>
</div></div>

  
  </div></div></div></div>
  </form> 
  
  
  
  <form id="registrytable"   method="post" > 
<div class="container" id="patientdetails">
 <h4 class="text-center underline font-bold" >REGISTRATION DASH BOARD </h4>

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
  
  <div class="grid grid-cols-2 gap-4">
  <!-- Row 1 -->
  <div class="square w-full h-32 bg-blue-200  flex justify-center items-center">PATIENT NUMBER: <?php print $_SESSION['patientnumber'];?></div>
  <div class="square w-full h-32 bg-blue-200  flex justify-center items-center">PATIENT NAME :<?php print $data->CLIENT;?></div>

  <!-- Row 2 -->
  <div class="square w-full h-32 bg-blue-200  flex justify-center items-center">PATIENT CLASS: <?php print $data->CLASS;?></div>
  <div class="square w-full h-32 bg-blue-200  flex justify-center items-center">GENDER: <?php print $data->GENDER;?></div>

  <!-- Row 3 -->
  <div class="square w-full h-32 bg-blue-200  flex justify-center items-center">INSURANCE:<?php print $data->INSUARANCE;?><br>REFF NO. <?php print $data->INSUARANCENUMBER;?></div>
  <div class="square w-full h-32 bg-blue-200  flex justify-center items-center">DEPARTMENT: <?php print $department; ?></div>
</div>
<br>
      <div class="grid grid-cols-4 gap-4 ">
        <!-- Create 12 squares -->
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
<a title="<?php print $data->CLIENT;?>" data-toggle="modal" data-target="#pricelist"  data-trigger="hover" data-toggle="popover" data-content="PRICE LIST" data-placement="bottom"   >		
<i  data-toggle="modal" data-target="#pricelist" class="fas fa-list-alt" style="font-size:200%;" ></i><br>PRICE LIST</a>		
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
   <a href="#" title="INFO  " data-toggle="modal" data-target="#newpatient" data-toggle="popover" data-trigger="hover" data-content="NEW PATIENT" data-placement="bottom">
<i   class="fas fa-user-injured" style="font-size:200%;" ></i><br>NEW PATIENT</a>
  		
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
		   <a href="#" title="INFO  " data-toggle="modal" data-target="#searchpatient" data-toggle="popover" data-trigger="hover" data-content="SEARCH PATIENT" data-placement="bottom">
<i   class="fa-solid fa-magnifying-glass" style="font-size:200%;" ></i><br>SEARCH  PATIENT</a> 

 </div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center "> 
		<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK TRAIGE" data-placement="bottom" id="nursedesklink" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-user-nurse" style="font-size:260%;"> </div>
  <br>NURSE DESK  </a> </div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK CONSULTATION" data-placement="bottom" id="consultationlink" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-user-md" style="font-size:260%;"> </div>
  <br>CONSULTATION   </a>

  
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="LAB IMAGING" data-placement="bottom" id="servicesbooking" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-vials" style="font-size:260%;"> </div>
 <br> BOOK PROCEEDURE</a> 
 
 
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
  
  <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK PHAMARCY" data-placement="bottom" id="phamarcybookinglink" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-pills" style="font-size:260%;"> </div>
  <br>PHAMARCY   </a>
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">

<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="IN PATIENT" data-placement="bottom" id="inpatientadmission" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fa-solid fa-bed" style="font-size:260%;"> </div>
 <br> ADMIT IN PATIENT</a>  


 
		
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center  ">  
		<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="GENERATE BILL" data-placement="bottom" href="pointofsale2.php?patientnumber=<?php  print $data->ACCOUNT; ?>"  onclick="return confirm('GENERATE  PATIENT BILL  ?')" > 
  <div class="fas fa-receipt" style="font-size:260%;"> </div>
 <br> GENERATE BILL</a> </div>
       
	   
	    <div class="square w-full h-32 bg-blue-200  flex justify-center items-center  ">  
		<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="EDIT CLASS" data-placement="bottom" id="editclass" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-edit" style="font-size:260%;"> </div>
 <br> EDIT CLASS</a> </div>
 
 
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
		<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK BILLING" data-placement="bottom" id="billing" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-cash-register" style="font-size:260%;"> </div>
  <br>BILLING   </a>
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
		
		<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK XRAY & IMAGING" data-placement="bottom" id="xraylink" data-xraypatientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-x-ray" style="font-size:260%;"> </div>
  <br>X-RAY & IMAGING   </a>
  
		
		</div>


      <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
	  
	  		<?php 
$y="SELECT ID FROM consultation    WHERE  PATIENTNUMBER  ='$patient->patientnumber'  ";
$y=mysqli_query($connect,$y)or die(mysqli_error($connect));
if(mysqli_num_rows($y)>0)
{
	?>
 <a title="INFO " data-toggle="popover" data-trigger="hover" data-content="CLEAR PATIENT" data-placement="bottom" id="clearpatientlink" data-clearpatientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fas fa-check" style="font-size:260%;"> </div>
  <br>DISCHARGE OUT PATIENT    </a>
	<?php
}
		?>
		
		

	  </div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
			<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="BOOK REGISTY" data-placement="bottom" id="registrylink" data-registrypatientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fa fa-address-card" style="font-size:260%;"> </div>
  <br>REGISTRATION    </a>
		</div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
		<?php 
$y="SELECT ID FROM inpatientsrecord   WHERE  PATIENTNUMBER  ='$patient->patientnumber'  ";
$y=mysqli_query($connect,$y)or die(mysqli_error($connect));
if(mysqli_num_rows($y)>0)
{
	?>
 <a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="DISCHARGE INPATIENT" data-placement="bottom" id="inpatientdischargelink" data-inpatientpatientnumber="<?php print $data->ACCOUNT; ?>"  > 
		<div class="fas fa-check" style="font-size:260%;"> </div><br>DISCHARGE  INPATIENT </a>
	<?php
}
		?>
		 </div>
        <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
 <a title="<?php print $data->CLIENT;?>PRE -ANTE  " data-toggle="popover" data-trigger="hover" data-content=" NATAL CARE" data-placement="bottom" id="prepostnatalcarelink" data-natalcarepatientnumber="<?php print $data->ACCOUNT; ?>"  > 

		<div class="fas fa-baby" style="font-size:260%;"> </div>
		PRE-ANTE NATAL CARE
		</a>
		</div>
	 <div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">	
		<?php 
		$y="SELECT ID FROM activeshift   WHERE  ATTENDANT  ='$user'  ";
$y=mysqli_query($connect,$y)or die(mysqli_error($connect));
if(mysqli_num_rows($y)>0)
{
		?>
  			 <a   href="nursebooking.php?user2=<?php  print $user; ?>"  onclick="return confirm('END SHIFT  ?')" > <div class="fas fa-user" style="font-size:260%;"> </div><br>END SESSION </a>

  
			<?php
}
else {
	?>
	<a title="INFO " data-toggle="popover" data-trigger="hover" data-content="START SESSION " data-placement="top" id="startsessionlink" data-startsession="<?php print $user; ?>"  > 
  <div class="fa fa-address-card" style="font-size:260%;"> </div>
  <br>START  SESSION    </a>
	<?php 
}
		?>
</div>

<div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
			<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="CREDIT DEBT " data-placement="bottom" id="debtacruedlink" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fa fa-coins" style="font-size:260%;"> </div>
  <br>CREDIT DEBT   </a>
		</div>
		
	<div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
			<a title="<?php print $data->CLIENT;?>" data-toggle="popover" data-trigger="hover" data-content="DEBIT DEBT " data-placement="bottom" id="debitdebtacruedlink" data-patientnumber="<?php print $data->ACCOUNT; ?>"  > 
  <div class="fa fa-coins" style="font-size:260%;"> </div>
  <br>DEBIT DEBT   </a>
		</div>
<div class="square w-full h-32 bg-blue-200  flex justify-center items-center ">
		  			 <a   href="nursebooking.php?debtpatientnumber=<?php  print $data->ACCOUNT; ?>"  onclick="return confirm('DEBT  STATEMENT ')" > <div class="fas fa-coins" style="font-size:260%;"> </div><br>DEBT STATEMENT  </a>

		</div>

    </div>
<?php
}

?>
  

  
  
  </div>
  </div></div>
             
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

