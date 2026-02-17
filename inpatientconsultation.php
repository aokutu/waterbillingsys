<?php
@session_start();
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="consultation";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
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
$patientdetails->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['patientnumber']))));
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
				
                $("#pendingproceduresdiv").load("consultation.php #pendingprocedures", function() {
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
            url: 'theatreoperationnotes.php',
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
   <script>
        $(document).ready(function(){
            $('#additem').click(function(){
 $('#itemdetails').append('<br><div class="container"><div class="row"><input list="itemlist"  required style="text-transform:uppercase" pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" id="item"  name="item[]" type="text" size="15" placeholder="ENTER  ITEM"  required="on"  class="form-control input-sm"    autocomplete="off" ></div></div>');
            });

   $('#resetbookprocedures').click(function(){
 $('#itemdetails').load("consultation.php #blankcontent");
            });

			
        });
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
	  .accordion-header,button,.deletecolumn,.deletevitals,#patienttitle{
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
    <div class="accordion-header"><div class="text-blue-500" ><i class="fa-solid fa-temperature-three-quarters" style="font-size:160%;" ></i>VITAL SIGNS MONITORING</div></div>
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
<input  style='text-transform:uppercase' name="tempreture" min="0" type="number"    title="INVALID ENTRIES "   size="15" placeholder="ENTER  TEMPRATURE"  required="on"  class="form-control input-sm"     autocomplete="off" ></a><br />

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

MEDICAL NOTES<textarea name="medicalnote"  style="width: 100%; height: 15%" ></textarea><br>
<label><input checked style="font-color:red;" type="radio" id="emergency"   name="status" value="REVIEW">REVIEW </label> 
 <label ><input   type="radio" id="emergency"   name="status" value="CONSULTATION">CONSULTATION  </label> 
 <label ><input   type="radio" id="emergency"   name="status" value="PRIORITY">PRIORITY  </label> 
		
</div>


</div></div>
  </form></p>
    </div>
  </div> 
  
      <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i class="fa-solid fa-tablets" style="font-size:160%;" ></i>MEDICATION TREATMENT SHEET </div></div>
    <div class="accordion-content">
      <p>
	  <form action="patientcomplaint.php" method="post"  id="patientcomplaint">
	      PATIENT COMPLAINT<br>
		   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="PATIENT COMPLAINTS" data-placement="top">
	  <textarea name="complaints" style="width: 50%; height: 15%" ></textarea>
	  </a>
<br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</form>
	  </p>
    </div>
  </div>
  
  
       <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i class="fas fa-user-nurse" style="font-size:160%;" ></i>NURSING  CARE PLAN </div></div>
    <div class="accordion-content">
      <p>
	  <form action="presentingillness.php" method="post"  id="presentingillness">
	      PRESENTING ILLNESS<br>
		   <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content=" PRESENTING ILLNESS" data-placement="top">
	  <textarea name="presentingillness" style="width: 50%; height: 15%" ></textarea>
	  </a>
<br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</form>
	  </p>
    </div>
  </div>
  
  
  
  
    <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i style="font-size:160%;" class="fas fa-tint"></i>FLUID INTAKE AND  OUTPUT </div></div>
    <div class="accordion-content">
      <p><form method="post" id="medicalhistory" action="medicalhistory.php">
	  
	  <div class="container">
  <div class="row">
  <div class="col-sm-6">
MEDICAL/SURGICAL HISTORY<br>
<a href="#" title="PATIENT'S " data-toggle="popover" data-trigger="hover" data-content=" MEDICAL HISTORY NOTE" data-placement="top">
	 <textarea name="medicalhistory" style="width: 100%; height: 15%" ></textarea>
	 </a>
	 	<br>PERSONAL HISTORY(Occupation Maritul status,Smoking and drinkiing)<br>
<a href="#" title="INFO " data-toggle="popover" data-trigger="hover" data-content=" PERSONAL HISTORY" data-placement="top">
	 <textarea name="personalhistory" style="width: 100%; height: 15%" ></textarea>
	 </a>
	  <br>FAMILY HISTORY(Hereditary  diseases)<br>
<a href="#" title="PATIENT'S " data-toggle="popover" data-trigger="hover" data-content=" MEDICAL HISTORY NOTE" data-placement="top">
	 <textarea name="familyhistory" style="width: 100%; height: 15%" ></textarea>
	 </a>
<br>SEXUAL  HISTORY(History  of  STI and  # of Sexual partners)<br>
<a href="#" title="PATIENT'S " data-toggle="popover" data-trigger="hover" data-content=" MEDICAL HISTORY NOTE" data-placement="top">
	 <textarea name="sexualhistory" style="width: 100%; height: 15%" ></textarea>
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
    <div class="accordion-header" ><div class="text-red-500" ><i style="font-size:160%;" class="fas fa-tint"></i>BLOOD SUGAR</div>  </div>
    <div class="accordion-content">
      <p><form method="post" id="gaenocology" action="gaenocology.php">
	  <div class="container">
  <div class="row">
  <div class="col-sm-12">
XXXX</div>
 
 
  </div></div>

	  
	  

</form></p>
    </div>
  </div>

  
  
   
   <div class="accordion-item">
    <div class="accordion-header"><div class="text-red-500" ><i class="fas fa-fill-drip"  style="font-size:160%;" ></i> BLOOD TRANSFUSION </div></div>
    <div class="accordion-content">
      <p>	<form action="clinicalobservation.php" method="post" id="clinicalobservation">
  <div class="container"  style="width: 100%; ">
  <div class="row">
  <div class="col-sm-4">GENERAL EXAMINATION
 
  <textarea  title="INFO" data-toggle="popover" data-trigger="hover" data-content="GENERAL EXAMINATION" data-placement="top" class='animated' name="localexamination" style="width: 100%; height: 15%" ></textarea>
 <br>CARDIOVASCULAR
   
   <textarea  title="INFO" data-toggle="popover" data-trigger="hover" data-content="CARDIOVASCULAR" data-placement="top" name="cardiovascular" style="width: 100%; height: 15%" ></textarea>
 
   
   <br>MASCULAR SKELETON
   <textarea title="INFO" data-toggle="popover" data-trigger="hover" data-content="MASCULAR SKELETON" data-placement="top"  name="mascularskeleton" style="width: 100%; height: 15%" ></textarea>
    <br>DIFFERENTIAL DIAGNOSIS/INTERPRETATION
   <textarea title="DIFFERENTIAL DIAGNOSIS" data-toggle="popover" data-trigger="hover" data-content="INTERPRETATION" data-placement="top" name="differentialdiagnosis" style="width: 100%; height: 15%" ></textarea>
  </div>
   <div class="col-sm-4">RESPIRATORY SYSTEM
   <textarea title="INFO" data-toggle="popover" data-trigger="hover" data-content="RESPIRATORY SYSTEM" data-placement="top" name="respiratory" style="width: 100%; height: 15%" ></textarea>

   ABDOMEN
   <textarea title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="ABDOMEN" data-placement="top" name="abdomen" style="width: 100%; height: 15%" ></textarea>
   GUT
   <textarea  title="INFO" data-toggle="popover" data-trigger="hover" data-content="GIT" data-placement="top" name="git" style="width: 100%; height: 15%" ></textarea>
  
   
   </div>
   <div class="col-sm-4">E.N.T
   <textarea title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="E.N.T" data-placement="top" name="ent" style="width: 100%; height: 15%" ></textarea>
  <br>CNS
   <textarea title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="CNS" data-placement="top" name="cns" style="width: 100%; height: 15%" ></textarea>
   <br>SKIN
   <textarea title="INFO" data-toggle="popover" data-trigger="hover" data-content="SKIN" data-placement="top" name="skin" style="width: 100%; height: 15%" ></textarea>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
  </div></div>
  </form></p>
    </div>
  </div>
  
  
     <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i class="fas fa-procedures"  style="font-size:160%;" ></i>PRE OPERATIVE  </div></div>
    <div class="accordion-content">
      <p>	<form action="clinicalobservation2.php" method="post" id="clinicalobservation2">
  <div class="container"  style="width: 100%; ">
  <div class="row">
  <div class="col-sm-4">OBSERVATION
     <a href="#" title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="OBSERVATION NOTE" data-placement="top">
  <textarea class='animated' name="observation" style="width: 100%; height: 15%" ></textarea>
 </a> 
  </div>
   <div class="col-sm-4">CONCLUSION
     <a href="#" title="MEDICAL" data-toggle="popover" data-trigger="hover" data-content="CONCLUSION NOTE" data-placement="top">   
   <textarea name="conclusion" style="width: 100%; height: 15%" ></textarea>
   </a>
   </div>
   <div class="col-sm-4"><br><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
  </div></div>
  </form></p>
    </div>
  </div>
  
   <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i style="font-size:160%;" class="fas fa-clipboard-check"></i>THEATRE PRE OPERATIVE CHECKLIST </div></div>
    <div class="accordion-content">
      <p>
<form id="bookprocedures"  action="bookprocedures.php" method="post"   > 
<div class="container"><div class="row">
<button type="button" class="btn-info btn-sm"  id="additem"> <i class="fa-solid fa-microscope" style="font-size:160%;"  ></i></button> </div></div>
 <div id="itemdetails">
</div>
 <div id="blankcontent">
</div>

 <datalist id="itemlist" >
<?php 
$x=$connect->query("SELECT DETAILS,PRICE   FROM services  ORDER BY  DETAILS ASC   ");
while ($data = $x->fetch_object())
{
	0
?>
	 <option value="<?php print $data->DETAILS; ?> " > <?php print $data->DETAILS; ?> <?php print number_format($data->PRICE,2); ?></option>	
		
		<?php 	
	
}

?>
</datalist><br> 
<div class="container"><div class="row">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset"  id="resetbookprocedures" class="btn-info btn-sm">RESET</button>
</div></div>
				  
 </form> </p>
    </div>
  </div>
   <div class="accordion-item">
    <div class="accordion-header"><div class="text-blue-500" ><i style="font-size:160%;" class="fas fa-clipboard-list"></i>THEATRE OPERATION  NOTES </div></div>
    <div class="accordion-content">
      <p>
	<form method="post"  action="theatreoperationnotes.php" id="theatreoperationnotes" >
	<div class="container"  style="width: 100%; ">
  <div class="row">
   <div class="col-sm-6">
      DIAGNOSIS <input name="diagnosis" type="text" pattern="[0-9A-Za-z_- ']+" title="INVALID ENTRIES"  id="diagnosis" class="form-control input-sm" required placeholder="ENTER  DIAGNOSIS " autocomplete="off">
     DATE <input name="date" type="date" pattern="[0-9A-Za-z_- ']+" title="INVALID ENTRIES"  id="diagnosis" class="form-control input-sm" required placeholder="ENTER  DIAGNOSIS " autocomplete="off">

   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
   <div class="col-sm-6">
   </div>
  
  </div></div>
    OPERATION PROCEDURE<textarea name="conclusion"  style="width: 100%; height: 15%" ></textarea> 

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

$x=$connect->query("SELECT ITEM,QUANTITY FROM inventory WHERE PRICE >0 AND QUANTITY >0");
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
<br> MEICATION DISPENCED<textarea title="ENTER" data-toggle="popover" data-trigger="hover" data-content="MEICATION DISPENCED" data-placement="top" placeholder="ENTER MEDICATION DISPENCED " name="treatment"  style="width: 100%; height: 15%" ></textarea>
<br>
   <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</div>
  </div></div>
</form>	
	  
	  
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
  
  

  #pendingprocedures td:nth-child(1),td:nth-child(3){
    width: 10%;
  }
  
  
   #pendingprocedures td:nth-child(2){
    width: 80%;
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

<table   class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading" >PENDING LAB & IMAGING PROCEDURES</td></tr>
</tbody>
</table>
<div id="pendingproceduresdiv" >
<table id="pendingprocedures" class="generictable">
<tbody>
<tr><td width="1%">DATE</td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;">DETAILS </div></td>
<td class="deletecolumn"></td>
</tr>

<?php
//PATIENTNUMBER='$patientdetails->patientnumber' 
$x=$connect->query("SELECT pendingsales.ID,pendingsales.DETAILS,pendingsales.DATE FROM pendingsales,services WHERE pendingsales.DETAILS=services.DETAILS AND pendingsales.STATUS =''  ORDER BY  DATE,pendingsales.ID DESC ");
while ($data = $x->fetch_object())
{ ?>
<tr><td width="1%"><?php print $data->DATE;?></td>
<td width="49%" style="text-align:left;"><div style="margin-left:2%;"><?php print $data->DETAILS;?></div></td>
<td class="deletecolumn">
 <a   href="deletependingprocedures.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
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
<tr><td  class="heading" >LAB & IMAGING RESULTS</td></tr>
</tbody>
</table>

<table  id="procedureresults">
<tbody>
<tr>
<td   style="text-align:left;"><div >DATE</div></td>
<td   style="text-align:left;"><div >ATTENDANT</div></td>
<td   style="text-align:left;"><div >PROCEDURE</div></td>
<td   style="text-align:left;"><div >SUMMARY</div></td>
<td    style="text-align:left;"><div >OBSERVATION</div></td>
<td  style="text-align:left;"><div >CONCLUSION</div></td>
<td width="0.5%"  class="deletecolumn">

</td>
</tr>
<?php
//PATIENTNUMBER='$patientdetails->patientnumber' 
$x=$connect->query("SELECT ID,PATIENTNUMBER,procedures,SUMMARY,OBSERVATION,CONCLUSION,ATTENDANT,DATE FROM procedurereports WHERE PATIENTNUMBER='$patientdetails->patientnumber'  AND procedurereports.DATE >='$patientdetails->date1' AND procedurereports.DATE<='$patientdetails->date2'  ORDER BY DATE,ID DESC ");
if(mysqli_num_rows($x)>0)
{}

while ($data = $x->fetch_object())
{ ?>
<tr>
<td  style="text-align:left;"><div ><?php print $data->DATE;?></div></td>
<td  style="text-align:left;"><div ><?php print $data->ATTENDANT;?></div></td>
<td  style="text-align:left;"><div ><?php print $data->procedures;?></div></td>
<td  style="text-align:left;"><div ><?php print $data->SUMMARY;?></div></td>
<td  style="text-align:left;"><div ><?php print $data->OBSERVATION;?></div></td>
<td  style="text-align:left;"><div ><?php print $data->CONCLUSION;?></div></td>
<td width="0.5%" class="deletecolumn">
 <a   href="deleteprocedures.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a>
</td>
</tr>
<?php } ?>
</tbody>

</table>

<?php
//PATIENTNUMBER='$patientdetails->patientnumber' 
$x=$connect->query("SELECT ID,PROTEIN,GLUCOSE,KETONE,PATIENTNUMBER, COLOR, APPEARANCE, MUCUS, SPECIFICGRAVITY, LEUKOCYTES, NITRATE, BLOOD,BILIRUBIN,UROBILINOGEN, PH,RBCS, WBCS, EPITHELIALCELLS, BACTERIA, CASTS, CRYSTALS,OTHERPARTICLES, ATTENDANT, DATE FROM urinalysis WHERE PATIENTNUMBER='$patientdetails->patientnumber'  AND urinalysis.DATE >='$patientdetails->date1' AND urinalysis.DATE<='$patientdetails->date2'  ORDER BY DATE,ID DESC ");
if(mysqli_num_rows($x)>0)
{
?>


<table class="generictable">
<thead></thead>
<tbody>
<tr><td  class="heading" >URINALYSIS RESULTS</td></tr>
</tbody>
</table>
<?php	
	
}

while ($data = $x->fetch_object())
{ ?>


<table id="urineanalysistable" >
<thead></thead>
<tbody>
<tr>
<td  >COLOR</td>
<td  ><?php print $data->COLOR;?></td>
<td  >LEUKOCYTES</td>
<td  ><?php print $data->LEUKOCYTES;?></td>
<td  >PROTEIN</td>
<td  ><?php print $data->PROTEIN;?></td>
<td  >BILIRUBIN</td>
<td  ><?php print $data->BILIRUBIN;?></td>
</tr>
<tr>
<td  >APPEARANCE</td>
<td  ><?php print $data->APPEARANCE;?></td>
<td  >NITRATE</td>
<td  ><?php print $data->NITRATE;?></td>
<td  >GLUCOSE</td>
<td  ><?php print $data->GLUCOSE;?></td>
<td  >RBCS</td>
<td  ><?php print $data->RBCS;?></td>
</tr>
<tr>
<td  >MUCUS</td>
<td  ><?php print $data->MUCUS;?></td>
<td  >BLOOD</td>
<td  ><?php print $data->BLOOD;?></td>
<td  >KETONE</td>
<td  ><?php print $data->KETONE;?></td>
<td  >WBCS</td>
<td  ><?php print $data->WBCS;?></td>
</tr>
<tr>
<td  >SPEIFIC GRAVITY</td>
<td  ><?php print $data->SPECIFICGRAVITY;?></td>
<td  >PH</td>
<td  ><?php print $data->PH;?></td>
<td  >UROBILINOGEN</td>
<td  ><?php print $data->UROBILINOGEN;?></td>
<td  >EPITHELIAL CELLS</td>
<td  ><?php print $data->EPITHELIALCELLS;?></td>
</tr>

<tr>
<td  >BACTERIA</td>
<td  ><?php print $data->BACTERIA;?></td>
<td  >CASTS</td>
<td  ><?php print $data->CASTS;?></td>
<td  >CRYSTALS</td>
<td  ><?php print $data->CRYSTALS;?></td>
<td  >OTHER PARTICLES</td>
<td  ><?php print $data->OTHERPARTICLES;?></td>
</tr>

<tr>
<td  >DATE</td>
<td  ><?php print $data->DATE;?></td>
<td  >ATTENDANT</td>
<td  ><?php print $data->ATTENDANT;?></td>
<td  ></td>
<td class="deletecolumn" > <a   href="deleteurinalysis.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a></td>
<td  ></td>
<td  ></td>
</tr>
</tbody>
</table>
<br>

<?php } 
?>


<?php
//PATIENTNUMBER='$patientdetails->patientnumber' 
$x=$connect->query("SELECT ID,WBC, LYMPHPERCENTAGE, GRANPERCENTAGE, MIDPERCENTAGE, LYMPH, GRAN, MID, RBC, HGB, HCTPERCENTAGE, MCV, MCH, MCHC, RSWCVPERCENTAGE, RWSD, PLT, MPV, PDW, RCT, PLCR, PLCC, DATE FROM completebloodcountresults WHERE PATIENTNUMBER='$patientdetails->patientnumber'  
AND completebloodcountresults.DATE >='$patientdetails->date1' AND completebloodcountresults.DATE<='$patientdetails->date2'  ORDER BY DATE,ID DESC ");
if(mysqli_num_rows($x)>0)
{
?>

<h4 style="font-weight:bold;text-decoration:underline;text-align:center;">COMPLETE  BLOOD COUNT </h4>

<table  id="completebloodcount">
<tbody>
<tr>
<td  style="text-align:left;"><div >PARAMETERS</div></td>
<td  style="text-align:right;"><div >RESULTS</div></td>
<td  style="text-align:right;"><div >ADULT</div></td>
<td  style="text-align:right;"><div >CHILD</div></td>
<td  style="text-align:left;"><div >PARAMETERS</div></td>
<td  style="text-align:right;"><div >RESULTS</div></td>
<td  style="text-align:right;"><div >ADULT</div></td>
<td  style="text-align:right;"><div >CHILD</div></td>
<td  style="text-align:left;"><div >PARAMETERS</div></td>
<td  style="text-align:right;"><div >RESULT</div></td>
<td  style="text-align:right;"><div >ADULTS</div></td>
<td  style="text-align:right;"><div >CHILD</div></td>

</tr>
</tbody>
</table>
<?php 

}

while ($data = $x->fetch_object())
{ ?>
<table  id="completebloodcount">
<tbody>
<tr>
<td  style="text-align:left;"><div >WBC</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->WBC,2);?></div></td>
<td  style="text-align:right;"><div >5.00-12.00</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >RBC</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->RBC,2);?></div></td>
<td  style="text-align:right;"><div >4.00-5.20</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >RW-SD</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->RWSD,2);?></div></td>
<td  style="text-align:right;"><div >35.0–46.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>

</tr>

<tr>
<td  style="text-align:left;"><div >LYMPH%</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->LYMPHPERCENTAGE,2);?></div></td>
<td  style="text-align:right;"><div >20.00-40.00</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >HGB</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->HGB,2);?></div></td>
<td  style="text-align:right;"><div >12.0-15.5</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >PLT</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->PLT,2);?></div></td>
<td  style="text-align:right;"><div >100–300</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>

</tr>
<tr>
<td  style="text-align:left;"><div >GRAN %</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->GRANPERCENTAGE,2);?></div></td>
<td  style="text-align:right;"><div >50.00-70.00</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >HCT %</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->HCTPERCENTAGE,2);?></div></td>
<td  style="text-align:right;"><div >35.0-49.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >MPV</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->MPV,2);?></div></td>
<td  style="text-align:right;"><div >7.0–11.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>

</tr>


<tr>
<td  style="text-align:left;"><div >MID %</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->MIDPERCENTAGE,2);?></div></td>
<td  style="text-align:right;"><div >3.0-9.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >MCV</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->MCV,2);?></div></td>
<td  style="text-align:right;"><div >82.0–95.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >PDW</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->PDW,2);?></div></td>
<td  style="text-align:right;"><div >9.0–17.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>

</tr>

<tr>
<td  style="text-align:left;"><div >LYMPH</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->LYMPH,2);?></div></td>
<td  style="text-align:right;"><div >0.80-4.00</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >MCH</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->MCH,2);?></div></td>
<td  style="text-align:right;"><div >27.0–31.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >RCT</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->RCT,2);?></div></td>
<td  style="text-align:right;"><div >0.108–0.282</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>

</tr>
<tr>
<td  style="text-align:left;"><div >GRAN</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->GRAN,2);?></div></td>
<td  style="text-align:right;"><div >2.00-7.00</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >MCHC</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->MCHC,2);?></div></td>
<td  style="text-align:right;"><div >32.0–36.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >P-LCR</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->PLCR,2);?></div></td>
<td  style="text-align:right;"><div >11.0–45.0</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>

</tr>

<tr>
<td  style="text-align:left;"><div >MID</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->MID,2);?></div></td>
<td  style="text-align:right;"><div >0.10-0.90</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >RSW-CV %</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->RSWCVPERCENTAGE,2);?></div></td>
<td  style="text-align:right;"><div >11.5–14.5</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>
<td  style="text-align:left;"><div >P-LCC</div></td>
<td  style="text-align:right;"><div ><?php print number_format($data->PLCC,2);?></div></td>
<td  style="text-align:right;"><div >80-90</div></td>
<td  style="text-align:right;"><div ><?php print $data->ID;?></div></td>

</tr>

</tbody>

</table>
<h4 >DATE  <?php print $data->DATE;?>  
<a  class="deletecolumn" href="deletecompletebloodcountresults.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
<div class="fas fa-trash" style="font-size:160%;"></div>
</a></h4>

<?php } ?>




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
 <a   href="deletetheatreoperationnotes.php?id=<?php print $data->ID; ?>"  onclick="return confirm('DELETE ?')" >
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
<td width="98%" style="text-align:left;"><div style="margin-left:2%;">TREATMENT</div></td>
<td class="deletecolumn" ></td>
</tr>

<?php
$x=$connect->query("SELECT ID,TREATMENT,DATE,ATTENDANT,STATUS,PRESCRIPTION,ATTENDANT  FROM treatmentreport  WHERE PATIENTNUMBER='$patientdetails->patientnumber' ORDER BY  DATE,ID DESC ");
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
