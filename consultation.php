<?php
@session_start();
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="CONSULTATION";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' OR 
name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'NURSE' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  

class patientdetails 
{
	
public $patientnumber=null;
public $date1=null;
public $date2=null; 

}

$patientdetails=new patientdetails;
$patientdetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['patientnumber']))));
$patientdetails->date1=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date1']))));
$patientdetails->date2=$connect->real_escape_string(trim(addslashes(strtoupper($_SESSION['date2']))));

$connect->query("UPDATE consultation  SET CHECKIN=CURRENT_TIME  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND  CHECKIN ='00:00:00' ");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accordion Example</title>
<link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<script   src="pluggins/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src='pluggins/jquery.autosize.js'></script>
 <link rel="stylesheet" href="icons/css/all.css">
  <link href="stylesheets/tailwind.css" rel="stylesheet">

 <script>
   $(document).ready(function(){   
$('[data-toggle="popover"]').popover();
    $("#newvitals").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'newvitals.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
                $("#vitalreportsdiv").load("consultation.php #vitalreports", function() {
                    // Optional: Rebind event handlers if necessary
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
$(function(){$('textarea').autosize();});

    $("#patientcomplaint").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'patientcomplaint.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
                $("#patientcomplaintsdiv").load("consultation.php #patientcomplaints", function() {
                    // Optional: Rebind event handlers if necessary
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

    $("#presentingillness").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'presentingillness.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
				
                $("#presentingillnessreportdiv").load("consultation.php #presentingillnessreport", function() {
                    // Optional: Rebind event handlers if necessary
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
	
	




    $("#medicalhistory").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'medicalhistory.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
				
                $("#medicalhistoryxdiv").load("consultation.php #medicalhistoryx", function() {
                    // Optional: Rebind event handlers if necessary
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
$("#gaenocology").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'gaenocology.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
				
                $("#gaenocologytablediv").load("consultation.php #gaenocologytable", function() {
                    // Optional: Rebind event handlers if necessary
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

$("#bookprocedures").submit(function(event) {
        event.preventDefault(); // Prevent default form submission        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'bookprocedures.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
				
                $("#pendingproceduresdiv").load("consultationlabresults.php #pendingprocedures", function() {
                    // Optional: Rebind event handlers if necessary
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
$("#diagnosis").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'diagnosis.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
				
                $("#diagnosisreportdiv").load("consultation.php #diagnosisreport", function() {
                    // Optional: Rebind event handlers if necessary
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
	

 
$("#reportdate2").change(function() {
$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#daterange").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$('#prepostmessage').modal('hide');
location.reload();

});
 });

$(document).ready(function() {
$('[data-toggle="popover"]').popover(); 
    $("#treatment").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
		var medicine= $("#selecteditem").val()+"<br>";
     $('#pendingdispencedrugs').append(medicine);  
        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'treatment.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
                $("#treatmentreport").load("consultation.php #treatmentreporttbody", function() {
                    // Optional: Rebind event handlers if necessary
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
});




	
	
$("#clinicalobservation2").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'clinicalobservation2.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
				
                $("#patientexmination3div").load("consultation.php #patientexmination3", function() {
                    // Optional: Rebind event handlers if necessary
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
$("#clinicalobservation").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        
		var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'clinicalobservation.php',
            data: formData,
            beforeSend: function() {
                $('#prepostmessage').modal('show');
            },
            success: function(response) {
                // Update page content and hide modal
				
                $("#patientexminationdiv").load("consultation.php #patientexmination", function() {
                    // Optional: Rebind event handlers if necessary
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
	
	

  })
  </script>

 </script>
 
<style>
  .accordion {
    max-width: 100%;
    margin: 20px auto;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
  }
  .accordion-item {
    border-top: 1px solid #ccc;
  }
  .accordion-header {
    background-color: #f1f1f1;
    padding: 10px 15px;
    cursor: pointer;
  }
  .accordion-content {
    padding: 15px;
    display: none;
  }
  .accordion-item.active .accordion-content {
    display: block;
  }
  
  
  
  @media print {
	  .accordion-header,button,.deletecolumn,.deletevitals,#patienttitle,form,.fas{
	  display: none;}
	 
  }
  </style>
</head>
<body>
<h3 id="patienttitle" style="text-align:center;font-weight:bold;text-decoration:underline;">REFF :<?php print $patientdetails->patientnumber;   
	 $x=$connect->query("SELECT CLIENT  FROM patientsrecord WHERE ACCOUNT='$patientdetails->patientnumber' ");
while ($data = $x->fetch_object())
{
print  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data->CLIENT;	
	
}


 ?> </h3>
<div class="accordion">

  <div class="accordion-item">
    <div class="accordion-header"><i class="fa-solid fa-temperature-three-quarters" style="font-size:160%;" ></i>VITAL SIGNS MONITORING</div>
    <div class="accordion-content">
      <p>	<form  id="newvitals" method="post" action="newvitals.php" >
 <div class="container">
  <div class="row">
  <div class="col-sm-6">PATIENT NUMBER
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT NUMBER" data-placement="bottom">
<input style='text-transform:uppercase' readonly required list="patientnmberslist" name="patientnumber"  value="<?php print $_SESSION['patientnumber'];?>" type="text"    size="15" placeholder="PATIENT NUMBER"   class="form-control input-sm"     autocomplete="off" ></a>

<br>DATE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  DATE" data-placement="bottom">
<input  style='text-transform:uppercase' name="date"  type="date"   required  title="ENTER DATE "   size="15" placeholder="DATE."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />
 TIME  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  TIME" data-placement="bottom">
<input  style='text-transform:uppercase' placeholder="ENTER  TIME"  name="time"  type="time"    title="INVALID ENTRIES "   size="15" placeholder="TIME"  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

TEMPRETURE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  TEMPRETURE" data-placement="bottom">
<input  style='text-transform:uppercase' name="tempreture"  type="text"    title="INVALID ENTRIES "   size="15" placeholder="ENTER  TEMPRATURE"  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

PULSE/HEART RATE <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  PULSE/HEART RATE " data-placement="bottom">
<input  style='text-transform:uppercase' name="pulserate" type="text"  title="ENTER PULSE RATE "  size="15" required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newadmission">CLOSE</button>   
 </div>
  


<div class="col-sm-6">
RESPIRATION RATE <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  RESPIRATION RATE " data-placement="bottom">
<input  style='text-transform:uppercase'  title="ENTER RESPIRATION RATE " name="respiratoryrate"  type="text"  pattern="[0-9A-Za-z ./-]+"  title="INVALID ENTRIES"   size="15" placeholder="ENTER RESPIRATION RATE "  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

BLOOD PRESSURE<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  BLOOD  PRESSURE" data-placement="bottom">
<input  style='text-transform:uppercase'  title="ENTER BLOOD PRESSURE " name="bloodpressure"  type="text"  pattern="[0-9A-Za-z ./-]+"  title="INVALID ENTRIES "   size="15" placeholder="ENTER BLOOD PRESSURE"   class="form-control input-sm"     autocomplete="off" ></a><br />

WEIGHT <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  BLOOD  PRESSURE" data-placement="bottom">
<input  style='text-transform:uppercase'  title="ENTER BLOOD PRESSURE " name="weight"  type="text"  pattern="[0-9A-Za-z ./-]+"  title="INVALID ENTRIES"   size="15" placeholder="ENTER WEIGHT."   class="form-control input-sm"     autocomplete="off" ></a><br />

MEDICAL NOTES<textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="medicalnote"  style="width: 100%; height: 15%" ></textarea><br>
<label><input checked style="font-color:red;" class="form-control input-sm"  type="radio" id="emergency"   name="status" value="REVIEW">REVIEW </label> 
 <label ><input   class="form-control input-sm"  type="radio" id="emergency"   name="status" value="CONSULTATION">CONSULTATION  </label> 
 <label ><input   class="form-control input-sm"  type="radio" id="emergency"   name="status" value="PRIORITY">PRIORITY  </label> 
		
</div>


</div></div>
  </form></p>
    </div>
  </div> 
  
      <div class="accordion-item">
    <div class="accordion-header"><i class="fas fa-user-injured" style="font-size:160%;" ></i>PATIENT COMPLAINTS </div>
    <div class="accordion-content">
      <p>
	  <form action="patientcomplaint.php" method="post"  id="patientcomplaint">
	      PATIENT COMPLAINT<br>
		   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT COMPLAINTS" data-placement="top">
	  <textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="complaints" style="width: 50%; height: 15%" ></textarea>
	  </a>
<br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</form>
	  </p>
    </div>
  </div>
  
  
       <div class="accordion-item">
    <div class="accordion-header"><i class="fa-solid fa-briefcase-medical" style="font-size:160%;" ></i>PRESENTING  ILLNESS </div>
    <div class="accordion-content">
      <p>
	  <form action="presentingillness.php" method="post"  id="presentingillness">
	      PRESENTING ILLNESS<br>
		   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content=" PRESENTING ILLNESS" data-placement="top">
	  <textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="presentingillness" style="width: 50%; height: 15%" ></textarea>
	  </a>
<br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</form>
	  </p>
    </div>
  </div>
  
  
  
  
    <div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fas fa-notes-medical"></i>MEDICAL HISTORY </div>
    <div class="accordion-content">
      <p><form method="post" id="medicalhistory" action="medicalhistory.php">
	  
	  <div class="container">
  <div class="row">
  <div class="col-sm-6">
MEDICAL/SURGICAL HISTORY<br>
<a href="#" title="PATIENT'S " data-toggle="popover" data-trigger="hover" data-content=" MEDICAL HISTORY NOTE" data-placement="top">
	 <textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="medicalhistory" style="width: 100%; height: 15%" ></textarea>
	 </a>
	 	<br>PERSONAL HISTORY(Occupation Maritul status,Smoking and drinkiing)<br>
<a href="#" title="INFO " data-toggle="popover" data-trigger="hover" data-content=" PERSONAL HISTORY" data-placement="top">
	 <textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="personalhistory" style="width: 100%; height: 15%" ></textarea>
	 </a>
	  <br>FAMILY HISTORY(Hereditary  diseases)<br>
<a href="#" title="PATIENT'S " data-toggle="popover" data-trigger="hover" data-content=" MEDICAL HISTORY NOTE" data-placement="top">
	 <textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="familyhistory" style="width: 100%; height: 15%" ></textarea>
	 </a>
<br>SEXUAL  HISTORY(History  of  STI and  # of Sexual partners)<br>
<a href="#" title="PATIENT'S " data-toggle="popover" data-trigger="hover" data-content=" MEDICAL HISTORY NOTE" data-placement="top">
	 <textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="sexualhistory" style="width: 100%; height: 15%" ></textarea>
	 </a>
  </div>
  <div class="col-sm-6">
  LAST HIV TEST DATE<a href="#" title="DATE   OF  LAST" data-toggle="popover" data-trigger="hover" data-content="  HIV TEST" data-placement="bottom">
<input     name="hivtestdate"   type="date"      size="15" placeholder="HIV LAST DATE TEST"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DRUG ALLERGIES" data-placement="bottom">
<input     name="allergies"   type="text"  pattern="[0-9A-Za-z ,. ]+"  title="INVALID ENTRIES"   size="15" placeholder="DRUG ALLERGIES"   class="form-control input-sm"     autocomplete="off" ></a>
<br><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CURRENT MEDICTION" data-placement="bottom">
<input     name="currentmedication"   type="text"  pattern="[0-9A-Za-z ,. ]+"  title="INVALID ENTRIES"   size="15" placeholder="CURRENT MEDICATION"   class="form-control input-sm"     autocomplete="off" ></a>
<br><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CHRONIC CONDITION" data-placement="bottom">
<input     name="chroniccondition"   type="text"  pattern="[0-9A-Za-z ,. ]+"  title="INVALID ENTRIES"   size="15" placeholder="CHRONIC CONDITION"   class="form-control input-sm"     autocomplete="off" ></a>
<br><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SURGERIES ADMISSIONS TRANSFUSION" data-placement="bottom">
<input     name="surgeries"   type="text"  pattern="[0-9A-Za-z ,. ]+"  title="INVALID ENTRIES"   size="15" placeholder="SURGERIES ADMISSIONS TRANSFUSION"   class="form-control input-sm"     autocomplete="off" ></a>
<br>	 	
<br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>  
  
  
  </div>
  </div></div>
	 
</form></p>
    </div>
  </div>
  
  <div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fas fa-venus"></i>OBSTETRICS/GYNECOLOGICAL  HISTORY </div>
    <div class="accordion-content">
      <p><form method="post" id="gaenocology" action="gaenocology.php">
	  <div class="container">
  <div class="row">
  <div class="col-sm-4">LMP
	  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="LMB" data-placement="bottom">
<input   style='text-transform:uppercase'  name="lmb"   type="text"  pattern="[0-9A-Za-z ,. ]+"  title="INVALID ENTRIES"   size="15" placeholder="LMB"   class="form-control input-sm"     autocomplete="off" ></a>
</div>
  <div class="col-sm-4">GRAVIDA  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="GRAVIDA" data-placement="bottom">
<input    style='text-transform:uppercase' name="gravida"   type="text"  pattern="[0-9A-Za-z ,. ]+"  title="INVALID ENTRIES"   size="15" placeholder="GRAVIDA"   class="form-control input-sm"     autocomplete="off" ></a>
<br></div>
  <div class="col-sm-4">PARA <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PARA" data-placement="bottom">
<input   style='text-transform:uppercase' name="para"   type="text"  pattern="[0-9A-Za-z ,. ]+"  title="INVALID ENTRIES"   size="15" placeholder="PARA"   class="form-control input-sm"     autocomplete="off" ></a>
</div>
  </div></div>
  
   <div class="container">
  <div class="row">
  <div class="col-sm-12">
  <fieldset><legend>CONTRACEPTION</legend>
  <a href="#" title="SELECT" data-toggle="popover" data-trigger="hover" data-content="CONTRACEPTION" data-placement="bottom"><label><input checked style="font-color:red;" class="form-control input-sm"  type="radio" id="contraceptive"   name="contraceptive" value="IUCD">IUCD </label> 
 <label ><input   class="form-control input-sm"  type="radio" id="contraceptive"   name="contraceptive" value="IMPLANTS">IMPLANTS  </label> 
 <label ><input   class="form-control input-sm"  type="radio" id="contraceptive"   name="contraceptive" value="CONDOM">CONDOM  </label>
  <label ><input   class="form-control input-sm"  type="radio" id="contraceptive"   name="contraceptive" value="DEPO PROVERA">DEPO PROVERA  </label> 
 <label ><input   class="form-control input-sm"  type="radio" id="contraceptive"   name="contraceptive" value="HERBAL">HERBAL  </label> 
 <label ><input   class="form-control input-sm"  type="radio" id="contraceptive"  checked name="contraceptive" value="NONE">NONE  </label></a> 
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
 </fieldset>
 <br>
  
  </div></div></div>
	  
	  

</form></p>
    </div>
  </div>

  
  
   
   <div class="accordion-item">
    <div class="accordion-header"><i class="fas fa-search"  style="font-size:160%;" ></i> EXAMINATION </div>
    <div class="accordion-content">
      <p>	<form action="clinicalobservation.php" method="post" id="clinicalobservation">
  <div class="container"  style="width: 100%; ">
  <div class="row">
  <div class="col-sm-4">GENERAL EXAMINATION
 
  <textarea class="border-4 border-blue-500 p-2 rounded-lg"   title="INFO" data-toggle="popover" data-trigger="hover" data-content="GENERAL EXAMINATION" data-placement="top" class='animated' name="localexamination" style="width: 100%; height: 15%" ></textarea>
 <br>CARDIOVASCULAR
   
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"   title="INFO" data-toggle="popover" data-trigger="hover" data-content="CARDIOVASCULAR" data-placement="top" name="cardiovascular" style="width: 100%; height: 15%" ></textarea>
 
   
   <br>MASCULAR SKELETON
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="INFO" data-toggle="popover" data-trigger="hover" data-content="MASCULAR SKELETON" data-placement="top"  name="mascularskeleton" style="width: 100%; height: 15%" ></textarea>
    <br>DIFFERENTIAL DIAGNOSIS/INTERPRETATION
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="DIFFERENTIAL DIAGNOSIS" data-toggle="popover" data-trigger="hover" data-content="INTERPRETATION" data-placement="top" name="differentialdiagnosis" style="width: 100%; height: 15%" ></textarea>
  </div>
   <div class="col-sm-4">RESPIRATORY SYSTEM
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="INFO" data-toggle="popover" data-trigger="hover" data-content="RESPIRATORY SYSTEM" data-placement="top" name="respiratory" style="width: 100%; height: 15%" ></textarea>

   ABDOMEN
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="ABDOMEN" data-placement="top" name="abdomen" style="width: 100%; height: 15%" ></textarea>
   GUT
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"   title="INFO" data-toggle="popover" data-trigger="hover" data-content="GIT" data-placement="top" name="git" style="width: 100%; height: 15%" ></textarea>
  
   
   </div>
   <div class="col-sm-4">E.N.T
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="E.N.T" data-placement="top" name="ent" style="width: 100%; height: 15%" ></textarea>
  <br>CNS
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="CNS" data-placement="top" name="cns" style="width: 100%; height: 15%" ></textarea>
   <br>SKIN
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="INFO" data-toggle="popover" data-trigger="hover" data-content="SKIN" data-placement="top" name="skin" style="width: 100%; height: 15%" ></textarea>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
  </div></div>
  </form></p>
    </div>
  </div>
  
  
     <div class="accordion-item">
    <div class="accordion-header"><i class="fas fa-stethoscope"  style="font-size:160%;" ></i>CLINICAL OBSERVATION  </div>
    <div class="accordion-content">
      <p>	<form action="clinicalobservation2.php" method="post" id="clinicalobservation2">
  <div class="container"  style="width: 100%; ">
  <div class="row">
  <div class="col-sm-4">OBSERVATION
     <a href="#" title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="OBSERVATION NOTE" data-placement="top">
  <textarea class="border-4 border-blue-500 p-2 rounded-lg"  class='animated' name="observation" style="width: 100%; height: 15%" ></textarea>
 </a> 
  </div>
   <div class="col-sm-4">CONCLUSION
     <a href="#" title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="CONCLUSION NOTE" data-placement="top">   
   <textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="conclusion" style="width: 100%; height: 15%" ></textarea>
   </a>
   </div>
   <div class="col-sm-4"><br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
  </div></div>
  </form></p>
    </div>
  </div>
  
   <div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fa-solid fa-microscope"></i>LABORATORY & IMAGING INVESTIGATIONS </div>
    <div class="accordion-content" id="labandimagecontainer1">
      <p id="labandimagecontainer2" >
<?php include_once("consultationlabresults.php"); ?>

 </p>
    </div>
  </div>
   <div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fa-solid fa-viruses"></i>&nbsp;&nbsp;&nbsp;DIAGNOSIS </div>
    <div class="accordion-content">
      <p>
	<form method="post"  action="diagnosis.php" id="diagnosis" >
	<div class="container"  style="width: 100%; ">
  <div class="row">
  <div class="col-sm-2">DIAGNOSIS<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER DIAGNOSIS" data-placement="bottom">
<input  style='text-transform:uppercase'  list="diagnosislist" name="diagnosis" type="text"    title="INVALID ENTRIES " pattern="[0-9A-Za-z ]+"  size="15" placeholder="ENTER  DIAGNOSIS."  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
   <div class="col-sm-6">
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="DIAGNOSIS NOTE" data-placement="top">
 DETAILS<textarea class="border-4 border-blue-500 p-2 rounded-lg"  name="conclusion"  style="width: 100%; height: 15%" ></textarea>
  </a> 
   </div>
   <div class="col-sm-4">
</div>
  </div></div>
</form>	
	  
	  
	  </p>
    </div>
  </div>
  
     <div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fa-solid fa-tablets"></i>&nbsp;&nbsp;&nbsp;MEDICATION & TREATMENT </div>
    <div class="accordion-content">
      <p>
	<form method="post"  action="treatment.php" id="treatment" >
	<div class="container"  style="width: 100%; ">
  <div class="row">
   <div class="col-sm-6">
   MEDICATION <input name="medication" type="text" pattern="[0-9A-Za-z_- ']+" title="INVALID ENTRIES"  id="selecteditem" list="medication" class="form-control input-sm" required placeholder="ENTER  MEDICATION " autocomplete="off">

   <datalist id="medication" >
<?php 

$x=$connect->query("SELECT ITEM,QUANTITY FROM inventory WHERE QUANTITY >0");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->ITEM; ?> " > <?php print $data->ITEM.'  QNTY '.$data->QUANTITY; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
   
   
   ROUTE  <select class="form-control"   required= "on"  name="route" >
  <option value="">SELECT ROUTE</option>
	 <option value="PO">PO</option>
        <option value="SL">SL </option>
		<option value="PR">PR </option>
		<option value="INH"> INH</option>
		<option value="TOP">TOP </option>
		<option value="TD">TD </option>
		<option value="IV"> IV</option>
		<option value="IM">IM </option>
		<option value="SC">SC</option>
		<option value="IT">IT </option>
			  </select><br />
DOSAGE<input  style='text-transform:uppercase' name="dosage" type="text" pattern="[0-9A-Za-z-,/.]+" title="INVALID ENTRIES"  class="form-control input-sm" required placeholder="ENTER DOSAGE " autocomplete="off">

   <div id="pendingdispencedrugs"></div>
   </div>
   <div class="col-sm-6">
FREQUENCY
<select class="form-control"   required= "on"  name="frequency" >
 <option value="">SELECT FREQUENCY</option>
	 <option value="qd">qd</option>
        <option value="bid">bid </option>
		<option value="tid">tid </option>
		<option value="qid">qid</option>
		<option value="prn">prn </option>
			  </select>
			  <br>
PERIOD<input name="period"  style='text-transform:uppercase' type="text" pattern="[0-9A-Za-z-,/.]+" title="INVALID ENTRIES"  class="form-control input-sm" required placeholder="ENTER PERIOD " autocomplete="off">
<br> MEICATION DISPENCED<textarea class="border-4 border-blue-500 p-2 rounded-lg"  title="ENTER" data-toggle="popover" data-trigger="hover" data-content="MEICATION DISPENCED" data-placement="top" placeholder="ENTER MEDICATION DISPENCED " name="treatment"  style="width: 100%; height: 15%" ></textarea>
<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
  </div></div>
</form>	
	 
<hr class="btn-info btn-sm">
  </p>
    </div>
  </div>
  
   <div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fas fa-receipt"></i>PHAMARCUTICALS  & SERVICES BOOKING </div>
    <div class="accordion-content">
      <p>
<?php include_once("consultationpointofsale.php");?> 
	  
	  
	  </p>
    </div>
  </div>
  
  
  
   <div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fas fa-exchange-alt"></i>PATIENT DEPARTMENTAL TRANSFER </div>
    <div class="accordion-content">
      <p>
<?php include_once("departmentaltransfer.php");?> 
	  
	  
	  </p>
    </div>
  </div>
  
  
   <div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fas fa-file-medical"></i>PATIENT DISCHARGE REPORT </div>
    <div class="accordion-content">
      <p id="consdischargereport">
<?php  include_once("patientdischagereport.php");
?> 
	  
	  
	  </p>
    </div>
  </div>

  <div class="accordion-item">
    <div class="accordion-header" ><div class="text-blue-500" ><i style="font-size:160%;" class="fas fa-user-nurse"></i>NURSING CARE PLAN</div>  </div>
    <div class="accordion-content">
      <p>
<?php  
include_once("nursingcareplan.php");
?>

</p>
    </div>
  </div>
 
   <div class="accordion-item">
    <div class="accordion-header" ><div class="text-red-500" ><i style="font-size:160%;" class="fas fa-tint"></i>BLOOD SUGAR</div>  </div>
    <div class="accordion-content">
      <p>
<?php 
include_once("bloodsugarlevel.php");
?>

</p>
    </div>
  </div>
  
     <div class="accordion-item">
    <div class="accordion-header" ><div class="text-blue-500" ><i style="font-size:160%;" class="fas fa-tint"></i>FLUIDS INTAKE </div>  </div>
    <div class="accordion-content">
      <p>
<?php include_once("fluidsintake.php");?>
</p>
    </div>
  </div>
  
  
   <div class="accordion-item">
    <div class="accordion-header" ><div class="text-blue-500" ><i style="font-size:160%;" class="fas fa-fill-drip"></i>FLUIDS OUTPUT</div>  </div>
    <div class="accordion-content">
      <p>
	  
<?php include_once("fluidsoutput.php");?>
</p>
    </div>
  </div>
  
  
   <div class="accordion-item">
    <div class="accordion-header" ><div class="text-red-500" ><i style="font-size:160%;" class="fas fa-fill-drip"></i>BLOOD TRANSFUSION</div>  </div>
    <div class="accordion-content">
      <p>
<?php include_once("bloodtransfusion.php"); ?>
</p>
    </div>
  </div>
  
      <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i class="fas fa-heartbeat"  style="font-size:160%;" ></i>PRE OPERATIVE  </div></div>
    <div class="accordion-content">
      <p>	
<?php include_once("preoperative.php"); ?>
  </p>
    </div>
  </div>
  
  <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i style="font-size:160%;" class="fas fa-clipboard-check"></i>THEATRE PRE OPERATIVE CHECKLIST </div></div>
    <div class="accordion-content">
      <p>
<form id="bookprocedures"  action="bookprocedures.php" method="post"   > 
NURSING PROCEDURES<hr class="border-t-2 border-blue-500 my-4">
<div class="grid grid-cols-5 gap-4">

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="PRE MEDICATION" data-placement="top" placeholder="PRE MEDICATION" class="form-control input-sm"  type="text"   name="premedication">
</div>


<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="KNOWN ALLERGIES" data-placement="top" placeholder="KNOWN ALLERGIES" class="form-control input-sm"  type="text"   name="knownallergies">
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="BP" data-placement="top" placeholder="BP" class="form-control input-sm"  type="text"   name="bp">
</div>
<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="PULSE" data-placement="top" placeholder="PULSE" class="form-control input-sm"  type="text"   name="pulse">
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="RESPIRATION" data-placement="top" placeholder="RESPIRATION" class="form-control input-sm"  type="text"   name="respiration">
</div>
</div>
		<hr class="border-t-2 border-blue-500 my-4">
<div class="grid grid-cols-2 gap-4">

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="TEMPRETURE" data-placement="top" placeholder="TEMPRETURE" class="form-control input-sm"  type="text"   name="tempreture">
</div>


<div class="square w-full h-20  flex justify-left items-left">TIME TAKEN
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="TIME TAKEN" data-placement="top" placeholder="TIME TAKEN" class="form-control input-sm"  type="time"   name="timetaken">
</div>

</div>

<hr class="border-t-2 border-blue-500 my-4">
<div class="grid grid-cols-5 gap-4">

<div class="square w-full h-20  flex justify-left items-left">IV LINE FIXED RUNING
<input title="IV LINE" data-toggle="popover" data-trigger="hover" data-content=" FIXED RUNNING" data-placement="top" placeholder="IV LINE FIXED RUNNNING" class="form-control input-sm"  type="checkbox"   name="ivlinefixed" value="YES">
</div>


<div class="square w-full h-20  flex justify-left items-left">URETHRAL CATHERERIZATIN
<input title="URETHRAL" data-toggle="popover" data-trigger="hover" data-content="CATHERERIZATIN" data-placement="top" placeholder="URETHRAL CATHERERIZATIN" class="form-control input-sm"  type="checkbox"   name="urethralcatherezatin" value="YES" >
</div>

<div class="square w-full h-20  flex justify-left items-left">SHAVING
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="SHAVING" data-placement="top" placeholder="SHAVING" class="form-control input-sm"  type="checkbox"   name="shaving" value="YES">
</div>

<div class="square w-full h-20  flex justify-left items-left">THEATRE GOWN
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="THEATRE GOWN" data-placement="top" placeholder="THEATRE GOWN" class="form-control input-sm"  type="checkbox"   name="theatregown" value="YES">
</div>

<div class="square w-full h-20  flex justify-left items-left">STARVED SINCE
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="STARVED SINCE" data-placement="top" placeholder="STARVED SINCE" class="form-control input-sm"  type="time"   name="starvedsince">
</div>


</div>	<hr class="border-t-2 border-blue-500 my-4">
<div class="grid grid-cols-5 gap-4">

<div class="square w-full h-20  flex justify-left items-left">DENTURE,RINGS etc REMOVED
<input title="DENTURE,RINGS" data-toggle="popover" data-trigger="hover" data-content=" etc REMOVED" data-placement="top" placeholder="DENTURE,RINGS etc REMOVED" class="form-control input-sm"  type="checkbox"   name="dentureringsremoved" value="YES">
</div>


<div class="square w-full h-20  flex justify-left items-left">ENEMA(WHERE INDICATED)
<input title="ENEMA" data-toggle="popover" data-trigger="hover" data-content="(WHERE INDICATED)" data-placement="top" placeholder="ENEMA (WHERE INDICATED)" class="form-control input-sm"  type="text"   name="enema" >
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="THEATRE FEE" data-placement="top" placeholder="THEATRE FEE" class="form-control input-sm"  type="text"   name="theatrefee" >
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="RECEIPT NO." data-placement="top" placeholder="RECEIPT NO." class="form-control input-sm"  type="text"   name="receiptnumber" >
</div>

<div class="square w-full h-20  flex justify-left items-left">INFORMED CONSENT
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="INFORMED CONSENT" data-placement="top" placeholder="INFORMED CONSENT" class="form-control input-sm"  type="checkbox"   name="informedconcent">
</div>


</div>	<hr class="border-t-2 border-blue-500 my-4">INVESTIGATIONS
<div class="grid grid-cols-5 gap-4">

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="HB" data-placement="top" placeholder="HB" class="form-control input-sm"  type="text"  autocomplete="off" required name="hb">
</div>


<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="URINALYSIS" data-placement="top" placeholder="URINALYSIS" class="form-control input-sm"  type="text" autocomplete="off" required  name="urinalysis">
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="UREA" data-placement="top" placeholder="UREA" class="form-control input-sm"  type="text" autocomplete="off" required  name="urea">
</div>
<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="ELECTROLYTES" data-placement="top" placeholder="ELECTROLYTES" class="form-control input-sm"  type="text"  autocomplete="off" required name="electrolytes">
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="CREATININE" data-placement="top" placeholder="CREATININE" class="form-control input-sm"  type="text" autocomplete="off" required  name="creatinine">
</div>
</div>

<div class="grid grid-cols-4 gap-4">

<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="BLOOD SUGAR" data-placement="top" placeholder="BLOOD SUGAR" class="form-control input-sm"  type="text"  autocomplete="off" required name="bloodsugar">
</div>


<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="BLOOD GXM" data-placement="top" placeholder="BLOOD GXM" class="form-control input-sm"  type="text" autocomplete="off" required  name="bloodgxm">
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="UNITS" data-toggle="popover" data-trigger="hover" data-content="OF BLOOD" data-placement="top" placeholder="UNITS OF BLOOD" class="form-control input-sm"  type="text" autocomplete="off" required  name="unitsofblood">
</div>
<div class="square w-full h-20  flex justify-left items-left">
<input title="INFO " data-toggle="popover" data-trigger="hover" data-content="X-RAY/ULTRA SOUND" data-placement="top" placeholder="X-RAY/ULTRA SOUND" class="form-control input-sm"  type="text"  autocomplete="off" required name="xrayultrasound">
</div>

</div>
		<hr class="border-t-2 border-blue-500 my-4">
		
<div class="grid grid-cols-3 gap-4">

<div class="square w-full h-20  flex justify-left items-left">
<input title="PATIENT" data-toggle="popover" data-trigger="hover" data-content="PREPARED BY" data-placement="top" placeholder="PATIENT PREPARED BY" class="form-control input-sm"  type="text"  autocomplete="off" required name="preparedby">
</div>


<div class="square w-full h-20  flex justify-left items-left">
<input title="PATIENT" data-toggle="popover" data-trigger="hover" data-content="HANDED OVER BY" data-placement="top" placeholder="PATIENT HANDED OVER BY" class="form-control input-sm"  type="text" autocomplete="off" required  name="handedoverby">
</div>

<div class="square w-full h-20  flex justify-left items-left">
<input title="PATIENT" data-toggle="popover" data-trigger="hover" data-content="RECEIVED IN THEATRE BY" data-placement="top" placeholder="PATIENT RECEIVED IN THEATRE BY" class="form-control input-sm"  type="text" autocomplete="off" required  name="receivedby">
</div>

</div>
		<hr class="border-t-2 border-blue-500 my-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
		
 </form> </p>
    </div>
  </div>
    <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i style="font-size:160%;" class="fas fa-clipboard-list"></i>THEATRE OPERATION  NOTES </div></div>
    <div class="accordion-content">
      <p>
<?php include_once("theatreoperativenotes.php"); ?>

  </p>
    </div>
  </div>
   

<div class="accordion-item">
    <div class="accordion-header"><i style="font-size:160%;" class="fa-solid fa-file-medical"></i>MEDICAL REPORT </div>
    <div id="medicalreport" class="accordion-content">
      <p id="medicalreport2">
	 <style>
	table {
    border-collapse: collapse;width:100%;  }
  td, th {
    border: 1px solid black;
    text-align:center;width:25%;
  }
 
 
 
 
 
  #pricelisttable td:nth-child(2) {
    width: 70%;
  }
  
  #treatmentreport td:nth-child(5) {
    width: 35%;
  }
  
   #treatmentreport td:nth-child(4) {
    width: 35%;
  }
  #treatmentreport td:nth-child(1),td:nth-child(2),td:nth-child(3){
    width: 8%;
  }
  
  #diagnosisreport td:nth-child(1),td:nth-child(2),td:nth-child(3){
    width: 10%;
  }
  
   #diagnosisreport  td:nth-child(4){
    width: 45%;
  }
   #diagnosisreport  td:nth-child(5){
    width: 5%;
  }
  
  
   #clinicalobservations td:nth-child(1),td:nth-child(2){
    width: 10%;
  }
  
   #clinicalobservations  td:nth-child(3),td:nth-child(4){
    width: 35%;
  }
   #clinicalobservations  td:nth-child(5){
    width: 5%;
  }
  
  #medicalhistory td:nth-child(3) {
    width: 70%;
  }
  
  #medicalhistory td:nth-child(1),td:nth-child(2){
    width: 8%;
  }
  
  
   #presentingillnessreport td:nth-child(3), #patientcomplaints td:nth-child(3) {
    width: 70%;
  }
  
  #presentingillnessreport td:nth-child(1),td:nth-child(2),#patientcomplaints td:nth-child(1),td:nth-child(2){
    width: 8%;
  }
  
#vitalreports td:nth-child(2),td:nth-child(1),td:nth-child(3){
    width: 20%;
  }
  
   #vitalreports td:nth-child(2){
    width: 40%;
  }
  
   #procedureresults td:nth-child(5),td:nth-child(6) { width: 35%;}
   #procedureresults td:nth-child(4) { width: 5%;}
	#procedureresults td:nth-child(3) {width: 10%;}
	#procedureresults td:nth-child(2) {width: 5%;}
	#procedureresults td:nth-child(1) {width: 5%;}
	#procedureresults td:nth-child(7) {width: 5%;}
.heading{ text-decoration:underline;font-weight:bold;font-size:110%;}
#history  td:nth-child(1),td:nth-child(2){width:50%;}
#history  td:nth-child(2){width:70%;}

#history2 td:nth-child(3),td:nth-child(4),td:nth-child(5),td:nth-child(6) {width: 20%;}
#history2 td:nth-child(1),td:nth-child(2) {width: 8%;}
#history2 td:nth-child(7) {width: 1%;}
#gaenocologytable td:nth-child(1),td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5) {width: 19%;}
#patientexmination td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5),td:nth-child(6),td:nth-child(7) {width: 16%;}
#patientexmination td:nth-child(1){width: 8%;}

#patientexmination2 td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5) {width: 22%;}
#patientexmination2 td:nth-child(1){width: 9%;}

#patientexmination3 td:nth-child(2) {width: 40%;}
#patientexmination3 td:nth-child(3) {width: 40%;}
#patientexmination3 td:nth-child(1){width: 10%;}

#completebloodcount td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(6),td:nth-child(7),td:nth-child(8),td:nth-child(10),td:nth-child(11),td:nth-child(12) {width: 8%;text-align:right;}

#completebloodcount td:nth-child(1),td:nth-child(5),td:nth-child(9){width: 10%;font-weight:bold;}
#urineanalysistable td:nth-child(1),td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5),td:nth-child(6),td:nth-child(7),td:nth-child(8),td:nth-child(9) {text-align:center;}
#urineanalysistable td:nth-child(1),td:nth-child(3),td:nth-child(5),td:nth-child(7),td:nth-child(9){font-weight:bold;}
#urineanalysistable{font-size:85%;}
#medicalreport{margin-left:2%'margin-right:2%;}
#completebloodcount {font-size:70%;}
</style>
	 <?php 
	 $x=$connect->query("SELECT GENDER,ACCOUNT,CLIENT,CONTACT,CLASS,INSUARANCE,INSUARANCENUMBER,NEXTKIN,NEXTKINCONTACT,LOCATION,IDNUMBER,CLASS,EMAIL,BIRTHDATE,TIMESTAMPDIFF(YEAR, BIRTHDATE, CURDATE()) AS YRS,TIMESTAMPDIFF(MONTH,BIRTHDATE, CURDATE()) % 12 AS  MONTHS  FROM patientsrecord WHERE ACCOUNT='$patientdetails->patientnumber' ");
while ($data = $x->fetch_object())
{ ?>


<table>
<tbody>
<tr><td class="heading" > <div class="flex justify-center"><div style="text-align:center;"><img src="letterhead.png"    id="letterhead"   width="50%"  height="10%"   /></div></div>
</tr>
<tr><td class="heading" ><h2>MEDICAL REPORT</h2></td></tr>

</table>
<form action="session.php" id="daterange" method="post" >
<input  style='text-transform:uppercase' name="patientnumber" value="<?php print $patientdetails->patientnumber; ?>" type="hidden"   required  required="on"  class="form-control input-sm"     autocomplete="off" >
<table class="generictable" width="100%">
<thead></thead>
<tbody>
<tr><td class="heading" >
FROM <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  DATE" data-placement="bottom">
<input  style='text-transform:uppercase' value="<?php print $_SESSION['date1']; ?>" name="date1"  type="date"   required  title="ENTER DATE "   size="15" placeholder="DATE."  required="on"  class="form-control input-sm"     autocomplete="off" ></a>
</td>
<td class="heading" >
TO <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  DATE" data-placement="bottom">
<input  style='text-transform:uppercase' value="<?php print $_SESSION['date2']; ?>" name="date2" id="reportdate2" type="date"   required  title="ENTER DATE "   size="15" placeholder="DATE."  required="on"  class="form-control input-sm"     autocomplete="off" ></a> 
</td>

</tr>
</tbody>

</table>
</form>
<table class="generictable"><hr>
<thead>

</thead>
<tbody>
<tr>
<td>PATIENT NUMBER</td>
<td><?php print $data->ACCOUNT;?></td>
<td>NAME</td>
<td><?php print $data->CLIENT;?></td>
</tr>

<tr>
<td>DATE OF BIRTH</td>
<td><?php print $data->BIRTHDATE;?></td>
<td>AGE </td>
<td><?php print $data->YRS;?> YEARS <?php print $data->MONTHS;?> MONTHS</td>
</tr>

<tr>
<td>GENDER</td>
<td><?php print $data->GENDER;?></td>
<td>RESIDENCE</td>
<td><?php print $data->LOCATION;?></td>
</tr>



</tbody>
</table>
<table class="generictable" >
<thead></thead>
<tbody>
<tr><td   class="heading" >VITAL  SIGNS  </td></tr>
</tbody>

</table>
<div id ="vitalreportsdiv">
<?php	
} $x=$connect->query("SELECT vitalsreport.WEIGHT,vitalsreport.MEDICALNOTE,vitalsreport.ID,vitalsreport.PATIENTNUMBER,DATE,TIME,vitalsreport.TEMPRETURE,vitalsreport.PULSERATE,vitalsreport.RESPIRATORYRATE,vitalsreport.BLOODPRESSURE FROM vitalsreport,patientsrecord  WHERE vitalsreport.PATIENTNUMBER='$patientdetails->patientnumber' AND vitalsreport.DATE >='$patientdetails->date1' AND vitalsreport.DATE<='$patientdetails->date2' ORDER BY  DATE,TIME,ID DESC LIMIT 1");
while ($data = $x->fetch_object())
{ ?>


<table  id="vitalreports" class="generictable">
<thead></thead>
<tbody>
<tr>
<td>DATE </td>
<td><?php print $data->DATE; ?> </td>
<td>TIME</td>
<td><?php print $data->TIME; ?></td>
</tr>

<tr>
<td>TEMPRETURE </td>
<td><?php print $data->TEMPRETURE; ?> </td>
<td>BLOOD  PRESSURE</td>
<td><?php print $data->BLOODPRESSURE; ?></td>
</tr>

<tr>
<td>PULSE RATE</td>
<td><?php print $data->PULSERATE; ?> </td>
<td>RESPIRATORY RATE</td>
<td><?php print $data->RESPIRATORYRATE; ?></td>
</tr>


<tr class="deletevitals" >
<td>WEIGHT </td>
<td><?php print $data->WEIGHT; ?> </td>
<td>DELETE</td>
<td> <a   href="deletevitals2.php?vitalsid=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a></td>
</tr>

<tr>

<td>MEDICAL NOTE</td>
<td><?php print $data->MEDICALNOTE; ?></td>
<td></td>
<td> </td>
</tr>
<?php } ?>

</tbody>

</table>
</div>
<table class="generictable">
<thead></thead>
<tbody>
<tr><td   class="heading">MEDICAL HISTORY</td></tr>
</tbody>
</table>
<div>
<div id="medicalhistoryxdiv"><div id="medicalhistoryx" >
<div id="historydiv">
<?php
$x=$connect->query("SELECT SEXUALHISTORY,FAMILYHISTORY,PERSONALHISTORY,MEDICALHISTORY,ID,medicalhistory,DATE,ATTENDANT  FROM medicalhistory  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND medicalhistory.DATE >='$patientdetails->date1' AND medicalhistory.DATE<='$patientdetails->date2' ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>
<table id="history" class="generictable">
<thead></thead>
<tbody>
<tr>
<td   >MEDICAL HISTORY<br><?php print $data->MEDICALHISTORY;?></td>
<td   >PERSONAL HITORY<br><?php print $data->PERSONALHISTORY;?></td>

</tr>
<tr>
<td   >FAMILY HISTORY<br><?php print $data->FAMILYHISTORY;?></td>
<td   >SEXUAL HISTORY<br><?php print $data->SEXUALHISTORY;?></td>
</tr>
</tbody>
</table>
<?php } ?>

</div>

<div id="history2div">
<?php
$x=$connect->query("SELECT CHRONICILLNESS,SURGERIES,CURRENTMEDICATION,DATE,ALLERGY,ID  FROM medicalhistory  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND medicalhistory.DATE >='$patientdetails->date1' AND medicalhistory.DATE<='$patientdetails->date2' ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>
<table id="history2" class="generictable">
<thead></thead>
<tbody>
<tr>
<td><?php print $data->DATE;?></td>
<td>HIV TEST DATE<br><?php print $data->DATE;?></td>
<td>DRUG ALLERGY<br><?php print $data->ALLERGY;?></td>
<td>CURRENT MEDICATION<br><?php print $data->CURRENTMEDICATION;?></td>
<td>CHRONIC CONDITION<br><?php print $data->CHRONICILLNESS;?></td>
<td>SURGERIES<br><?php print $data->SURGERIES;?></td>

<td> <a   href="deletemedicalhistory.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a></td>

</tr>

</tbody>
</table>
<?php } ?>
</div>

</div></div>
<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading">GAENOCOLOGICAL HISTORY </td></tr>
</tbody>
</table>
<div id="gaenocologytablediv">
<table  id="gaenocologytable"  class="generictable">
<tbody>
<?php
$x=$connect->query("SELECT ID,LMB,GRAVIDA,PARA,CONTRACEPTIVE,DATE FROM gaenocology  WHERE PATIENTNUMBER='$patientdetails->patientnumber'  AND gaenocology.DATE >='$patientdetails->date1' AND gaenocology.DATE<='$patientdetails->date2' ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>

<tr>
<td >DATE<br><?php print $data->DATE;?></td>
<td >LMB<br><?php print $data->LMB;?></td>
<td >GRAVIDA<br><?php print $data->GRAVIDA;?></td>
<td >PARA<br><?php print $data->PARA;?></td>
<td >CONTRACEPTIVE<br><?php print $data->CONTRACEPTIVE;?></td>
<td class="deletecolumn">
 <a   href="deletegaenoclologyhistory.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>

<?php } ?>
</tbody>

</table>

</div>
<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading">EXAMINATION </td></tr>
</tbody>
</table>
<div id="patientexminationdiv">
<table style="text-align:left;" id="patientexmination"  class="generictable">
<tbody>
<?php
$x=$connect->query("SELECT ID,DATE,LOCAL,CARDIOVASCULAR,RESPIRATORY,ABDOMEN,ENT,CNS FROM patientclinicalreport  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND patientclinicalreport.DATE >='$patientdetails->date1' AND patientclinicalreport.DATE<='$patientdetails->date2' ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>

<tr>
<td >DATE<br><?php print $data->DATE;?></td>
<td >LOCAL EXAMINATION<br><?php print $data->LOCAL;?></td>
<td >CARDIOVASCULAR EXAMINATION<br><?php print $data->CARDIOVASCULAR;?></td>
<td >RESPIRATORY EXAMINATION<br><?php print $data->RESPIRATORY;?></td>
<td >ABDOMEN EXAMINATION<br><?php print $data->ABDOMEN;?></td>
<td >ENT EXAMINATION<br><?php print $data->ENT;?></td>


<td class="deletecolumn">
 <a   href="deleteexaminationhistory.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>

<?php } ?>
</tbody>

</table>
</div>


<table style="text-align:left;" id="patientexmination2"  class="generictable">
<tbody>
<?php
$x=$connect->query("SELECT ID,MASCULARSKELETON,DIFFERENTIALDIAGNOSIS,GIT,SKIN,CNS,DATE FROM patientclinicalreport  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND patientclinicalreport.DATE >='$patientdetails->date1' AND patientclinicalreport.DATE<='$patientdetails->date2' ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>

<tr>
<td >DATE<br><?php print $data->DATE;?></td>
<td >MASCULAR SKELETON<br><?php print $data->MASCULARSKELETON;?></td>
<td >GUT<br><?php print $data->GIT;?></td>
<td >SKIN<br><?php print $data->SKIN;?></td>
<td >DIFFERENTIAL DIAGNOSIS/INTERPRETATION<br><?php print $data->DIFFERENTIALDIAGNOSIS;?></td>
<td >CNS<br><?php print $data->CNS;?></td>
<td class="deletecolumn">
 <a   href="deleteexaminationhistory.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>

<?php } ?>
</tbody>

</table>

<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading">CLINICAL OBSERVATION  </td></tr>
</tbody>
</table>
<div id="patientexmination3div">
<table style="text-align:left;" id="patientexmination3"  class="generictable">
<tbody>
<?php
$x=$connect->query("SELECT ID,DATE,OBSERVATION,CONCLUSION FROM clinicalobservation  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND clinicalobservation.DATE >='$patientdetails->date1' AND clinicalobservation.DATE<='$patientdetails->date2' ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>

<tr>
<td >DATE<br><?php print $data->DATE;?></td>
<td >OBSERVATION<br><?php print $data->OBSERVATION;?></td>
<td >CONCLUSION<br><?php print $data->CONCLUSION;?></td>
<td class="deletecolumn">
 <a   href="deleteclinicalobservations2.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>

<?php } ?>
</tbody>

</table>
</div>


<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading">PATIENT COMPLAINTS </td></tr>
</tbody>
</table>

<div id="patientcomplaintsdiv">
<table id="patientcomplaints" class="generictable">
<tbody>

<tr><td width="1%">DATE</td>
<td width="1%">ATTENDANT</td>
<td width="97.99%" style="text-align:left;"><div style="margin-left:2%;">PATIENT COMPLAINTS</div></td>
<td class="deletecolumn"></td>
</tr>

<?php
$x=$connect->query("SELECT ID,COMPLAINTS,DATE,ATTENDANT  FROM patientcomplaints  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND patientcomplaints.DATE >='$patientdetails->date1' AND patientcomplaints.DATE<='$patientdetails->date2'  ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>
<tr><td width="1%"><?php print $data->DATE;?></td>
<td width="1%"><?php print $data->ATTENDANT;?></td>
<td width="97.99%" style="text-align:left;"><div style="margin-left:2%;"><?php print $data->COMPLAINTS;?></div></td>
<td class="deletecolumn">
 <a   href="deletepatientcomplaints.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>
<?php } ?>
</tbody>

</table>
</div>


<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading">HISTORY  OF THE  PRESENTING ILLNESS </td></tr>
</tbody>
</table>

<div  id="presentingillnessreportdiv">
<table id="presentingillnessreport" class="generictable">
<tbody>

<tr><td >DATE</td>
<td >ATTENDANT</td>
<td  style="text-align:left;"><div style="margin-left:2%;">PRESENTING ILLNESS</div></td>
<td class="deletecolumn"></td>
</tr>

<?php
$x=$connect->query("SELECT ID,PRESENTINGILLNESS,DATE,ATTENDANT  FROM presentingillness  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND presentingillness.DATE >='$patientdetails->date1' AND presentingillness.DATE<='$patientdetails->date2'  ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>
<tr><td ><?php print $data->DATE;?></td>
<td ><?php print $data->ATTENDANT;?></td>
<td  style="text-align:left;"><div style="margin-left:2%;"><?php print $data->PRESENTINGILLNESS;?></div></td>
<td class="deletecolumn">
 <a   href="deletepresentinghistory.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>
<?php } ?>
</tbody>

</table>
</div>

<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading">CLINICAL OBSERVATIONS </td></tr>
</tbody>
</table>

<table id="clinicalobservations" class="generictable">
<tbody>
<tr><td width="1%">DATE</td>
<td width="1%">ATTENDANT</td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;">OBSERVATIONS</div></td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;">CONCLUSION</div></td>
<td class="deletecolumn"></td>

</tr>
<?php
$x=$connect->query("SELECT ID,OBSERVATION,CONCLUSION,DATE,ATTENDANT  FROM patientclinicalreport  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND patientclinicalreport.DATE >='$patientdetails->date1' AND patientclinicalreport.DATE<='$patientdetails->date2'  ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>
<tr><td width="1%"><?php print $data->DATE;?></td>
<td width="1%"><?php print $data->ATTENDANT;?></td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;"><?php print $data->OBSERVATION;?></div></td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;"><?php print $data->CONCLUSION;?></div></td>
<td class="deletecolumn">
 <a   href="deleteclinicalobservations.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>

</tr>
<?php } ?>

</table>


<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading" >DIAGNOSIS REPORT</td></tr>
</tbody>
</table>
<div id="diagnosisreportdiv">
<table id="diagnosisreport" class="generictable">
<tbody>
<tr><td width="1%">DATE</td>
<td width="1%">ATTENDANT</td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;">DIAGNOSIS</div></td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;">DETAILS</div></td>
<td class="deletecolumn"></td>
</tr>

<?php
$x=$connect->query("SELECT ID,DIAGNOSIS,DETAILS,DATE,ATTENDANT  FROM diagnosisreport  WHERE PATIENTNUMBER='$patientdetails->patientnumber' ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>
<tr><td width="1%"><?php print $data->DATE;?></td>
<td width="1%"><?php print $data->ATTENDANT;?></td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;"><?php print $data->DIAGNOSIS;?></div></td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;"><?php print $data->DETAILS;?></div></td>
<td class="deletecolumn">
 <a   href="deletediagnosis.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>
<?php } ?>
</tbody>

</table>
</div>


<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading">TREATMENT REPORT</td></tr>
</tbody>
</table>

<table id="treatmentreport" class="generictable">
<tbody id="treatmentreporttbody">
<tr><td width="1%">DATE</td>
<td width="1%">ATTENDANT</td>
<td width="1%">STATUS</td>
<td width="1%">PRESCRIPTION</td>
<td width="98%" style="text-align:left;"><div style="margin-left:2%;">DETAILS</div></td>
<td class="deletecolumn" ></td>
</tr>

<?php
$x=$connect->query("SELECT ID,TREATMENT,DATE,ATTENDANT,STATUS,PRESCRIPTION,ATTENDANT  FROM treatmentreport  WHERE PATIENTNUMBER='$patientdetails->patientnumber' AND DATE >='$patientdetails->date1' AND DATE <='$patientdetails->date2' ORDER BY  DATE,ID DESC ");
while ($data = $x->fetch_object())
{ ?>
<tr><td width="1%"><?php print $data->DATE;?></td>
<td width="1%"><?php print $data->ATTENDANT;?></td>
<td width="1%"><?php print $data->STATUS;?></td>
<td width="1%"><?php print $data->PRESCRIPTION;?></td>

<td width="98%" style="text-align:left;"><div style="margin-left:2%;"><?php print $data->TREATMENT;?></div></td>
<td class="deletecolumn">
 <a   href="deletetreatment.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>
<?php } ?>
</tbody>

</table>

  <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>

<datalist id="diagnosislist" >
<?php 

$x=$connect->query("SELECT DISTINCT(DIAGNOSIS) FROM diagnosisreport ");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->DIAGNOSIS; ?> " > <?php print $data->DIAGNOSIS; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>

	  </p>
    </div>
  </div>
  
</div>
<script>
  // JavaScript to handle accordion functionality
  document.addEventListener("DOMContentLoaded", function() {
	 // $('#prepostmessage').modal('show');
    const accordionItems = document.querySelectorAll(".accordion-item");

    accordionItems.forEach(item => {
      const header = item.querySelector(".accordion-header");

      header.addEventListener("click", function() {
        // Close all accordion items
        accordionItems.forEach(accItem => {
          if (accItem !== item) {
            accItem.classList.remove("active");
            accItem.querySelector(".accordion-content").classList.remove("show");
          }
        });

        // Toggle active class to expand/collapse accordion item
        item.classList.toggle("active");

        // Toggle display of accordion content
        const content = item.querySelector(".accordion-content");
        content.classList.toggle("show");
      });
    });
  });
</script>

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
