<?php 
mysql_pconnect('localhost','root'); 
mysql_select_db('lcpsb');
?><!doctype html>
<html lang="us">
<head>
	<meta charset="utf-8">
	<title>LAMU COUNTY   PUBLIC  SERVICE  BOARD </title>
	<link href="stylesheets/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
	<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
$('[data-toggle="popover"]').popover(); 
$("#content").load("message.php #content"); 
$('#errormessage').modal('show'); 
 //$('#message').modal('show');
 
 $("#reffnumber2").click(function()
{
var reff=$("#vacancynumber").val();$("#reffnumber2").val(reff);
})


 $("#idnumber2").click(function()
{
var id=$("#idnumber").val();$("#idnumber2").val(id);
})

 $("#openupload").click(function () { 
   $('#uploadmodal').modal('show');
     return false; 
  }); 
$( ".accordion" ).accordion();
 $("#processapplication").submit(function(){
			
$.post("processapplication.php",$("#processapplication").serialize(),function (data)
{
$("#feedbackcontent").load("message.php #content");  
$('#feedback').modal('show');
return true;	
	
})  
return true;
})


$("#idnumber").click(function()
{
if(jQuery("#idfile").val()==""){$('#idmessage').modal('show'); return false;}
})


$("#subcounty").click(function()
{
if(jQuery("#homecounty").val()==""){$('#subcountymessage').modal('show'); return false;}
})


$(".file1details").click(function()
{
if(jQuery("#academicfile1").val()==""){$('#academicmessage').modal('show'); return false;}
})

$(".file2details").click(function()
{
if(jQuery("#academicfile2").val()==""){$('#academicmessage').modal('show'); return false;}
})


$(".file3details").click(function()
{
if(jQuery("#academicfile3").val()==""){$('#academicmessage').modal('show'); return false;}
})

$(".file4details").click(function()
{
if(jQuery("#academicfile4").val()==""){$('#academicmessage').modal('show'); return false;}
})
$("#file1details").click(function()
{ if(jQuery("#academicfile1").val()==""){$('#academicmessage').modal('show'); return false;}})

$(".shortcoursefile1details").click(function()
{ if(jQuery("#shortcoursefile1").val()==""){$('#shortcoursemessage').modal('show'); return false;}})
	

$(".shortcoursefile2details").click(function()
{ if(jQuery("#shortcoursefile2").val()==""){$('#shortcoursemessage').modal('show'); return false;}})
	
$(".shortcoursefile3details").click(function()
{ if(jQuery("#shortcoursefile3").val()==""){$('#shortcoursemessage').modal('show'); return false;}})
	
$(".shortcoursefile4details").click(function()
{ if(jQuery("#shortcoursefile4").val()==""){$('#shortcoursemessage').modal('show'); return false;}})
});
</script>
	<script type="text/vbscript">
	function noBack() {window.history.forward();}	
	</script>
<style>	
	 

body{ background-color:#ADD8E6; font-size:98%} .container{ width:100%}
table{ font-size:xx-small;}  .header{ background-color:#FFFFFF; border-style:	solid; width:100%; color:#ADD8E6;}
#jobdetails{ background-color:#FFFFFF; border-style:	solid; width:100%;}
.accordion >.rows{ text-align:center;} #modal-header{ font-size:99%} 
.form-control input-sm{ background-color:#FF0000; border-bottom-color:#FF0000; background:#FF0000;}
#vacancy,#vacancynumber,#department,#section,#surname,#nationality,#title,#idnumber,#dateofbirth,#idfile,#file,#firstname,#jobrefference,#gender,#homecounty,#mobile,#ethnicity,#openupload{ border: 2px solid red;border-radius: 4px;
}
#signature{text-align:right}
	</style>

</head>
<body  oncontextmenu="return false;"  onLoad="noBack();">

<form  action ="processapplication.php"   id="processapplication" method="post"  >
<div class="container"    id="banner">
  <div class="row">
  <div class="col-sm-1" ></div>
    <div class="col-sm-10"  ><h3 align="center"  class="header"><U>  LAMU COUNTY   PUBLIC  SERVICE  BOARD JOB APPLICATION FORM  </U></h3><br>
	</div>
	 <div class="col-sm-1" ></div>
  </div>
	</div>
	
<div class="container">
  <div class="row">
    <div class="col-sm-12" >
	
	
	  
	
	
<div class="accordion">

	
	
	  <h3>  <a href="#" title="ALL APPLICANTS TO FILL " data-toggle="popover" data-trigger="hover" data-content="ENTER THE  VACANCY DETAILS & YOUR PERSONAL  DETAILS "  data-placement="bottom" > (A)VACANCY /POST DETAILS AND  PERSOAL DETAILS</a></h3> 
	<div class="links">
	<div class="row">
	 
  <div class="col-sm-8" >VACANCY / POST
  <a href="#" title="NOTE " data-toggle="popover" data-trigger="hover" data-content="SELECT  THE  VACANCY  "  data-placement="bottom" > 
  <div class="compulsory">
	<select class="form-control" name="jobrefference"  id="jobrefference" required="on">
 <option value="">VACANCY    REFFERENCE NUMBER   DEPARTMENT </option>
 <?php
	$x="SELECT * FROM VACANCIES ORDER  BY  VACANCY  ASC   ";
		$x=mysql_query($x)or die(mysql_error());
		if(mysql_num_rows($x)>0)
		{
		
		 while ($y=@mysql_fetch_array($x))
		{  echo "<option value=".$y['refferencenumber'].">".$y['vacancy']."&nbsp;&nbsp;".$y['refferencenumber']."&nbsp;&nbsp;".$y['department']."</option>"; }} 
 
 ?>
</select></div>
  
  </a> </div>
 
	 <div class="col-sm-4" ></div>
	<br/><br/>
	</div>
	<div class="container">
 <h3  class="btn-info btn-sm"><U  >PERSOAL DETAIL OF  APPLICANT</U></h3>
  <div class="row">
  <div class="col-sm-3" >SURNAME
  <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="SURNAME"  name="surname" id="surname"   required  autocomplete ="off">
  DATE OF BIRTH    <input type="date"   class="form-control input-sm" placeholder="DATE OF BIRTH"  name="dateofbirth"   id="dateofbirth"    required  autocomplete ="off">
  <br>NATIONALITY <input type="text"   style="text-transform:uppercase"   required  class="form-control input-sm" placeholder="NATIONALITY"  name="nationality" id="nationality"  autocomplete ="off">
   ADDRESS 
   <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="ADDRESS  "  name="boxaddress"   autocomplete ="off">
  <br>HOME COUNTY
  	<select class="form-control" name="county"  id="homecounty" required="on">
 <option value="">SELECT   HOME  COUNTY </option>
 <option value="LAMU">LAMU </option>
 <option value="KILIFI">KILIFI </option>
  <option value="TANA RIVER">TANA RIVER</option>
   <option value="KWALE">KWALE </option>
</select><br>         

  MOBILE <input type="text"    required  style="text-transform:uppercase"  id="mobile" class="form-control input-sm" placeholder="MOBILE"  name="mobile"   autocomplete ="off">
  </div>
    <div class="col-sm-3" id="inputs" >FIRST NAME <input type="text"   required  style="text-transform:uppercase"   class="form-control input-sm" placeholder="FIRST NAME  "  name="firstname"     id="firstname"  autocomplete ="off">GENDER 
	<div  id="gender"> 
     <label class="checkbox-inline"> 
        <input type="radio" name="gender"   class ="gender"  id="optionsRadios3" 
            value="MALE" >MALE
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="gender" id="optionsRadios4" 
            value="FEMALE"> FEMALE
     </label> 
 </div><BR>
 ID ATTACHMENT  <input type="file"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="OTHER NAME  "  name="idfile"  id="idfile"  required>

POSTAL CODE  <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="POSTAL CODE  "  name="postalcode"   autocomplete ="off">
<br><br>SUB COUNTY  <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="HOME SUB COUNTY  "  name="subcounty" id="subcounty"  autocomplete ="off"> 

	<br>	EMAIL <input type="text"      class="form-control input-sm" placeholder="EMAIL  "  name="email"   autocomplete ="off">



	</div>
	 <div class="col-sm-3" > OTHER NAME <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="OTHER NAME  "  name="othername"   autocomplete ="off">
	 ETHNICITY <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="ETHNICITY" id="ethnicity" name="ethnic"  required   autocomplete ="off">
	 <br>ID /PASSPORT NUMBER  <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="ID /PASSPORT NUMBER  "  name="idnumber"  id="idnumber" required size="1" autocomplete ="off"><BR><BR>
	 DISABILITY <div> 
  
     <label class="checkbox-inline"> 
        <input type="radio" name="disability" id="disability"   value="YES" >YES
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="disability" id="disability"
            value="NO" checked> NO
     </label> 
 </div><BR/>CONSTITUECNY
           <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="HOME CONSTITUECNY  "  name="constituency"   autocomplete ="off"> 
		ALTERNATIVE  CONTACT PERSON<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="ALTERNATIVE  CONTACT PERSON  "  name="contactperson"   autocomplete ="off">
	 </div>
	 
	 <div class="col-sm-3" >TITLE  <input type="text"    required   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MR/MRS/MISS/MS/REV  "  name="title"  id="title" autocomplete ="off">
	SUBTRIBE <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="SUBTRIBE  "  name="subtribe"   autocomplete ="off"> 
	<BR/>K.R.A PIN NUMBER <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="K.R.A   PIN  NUMBER   "  name="kranumber"  autocomplete ="off"><BR/><BR/>IF YES DETAILS 
	<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="IF YES DETAILS  "  name="disabilitydetails"   autocomplete ="off">
	
	<BR/><BR/><BR/>CONTACT PERSON MOBILE <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MOBILE  "  name="contactpersonmobile"   autocomplete ="off">
	 </div>

</BR>

 
	</div>
	
	</div>
   </div>
	
  <h3>  <a href="#" title=" PUBLIC SERVANTS  SECTION " data-toggle="popover" data-trigger="hover" data-content="THIS  SECTION   IS TO  BE   FILLED  BY  PUBLIC SERVANTS EITHER  FROM  COUNTY OR  NATIONAL GOVERMENT "  data-placement="top" >  
  (B)APPLICANT   IN   THE  PUBLIC SERVICE ONLY   </a></h3>
  
  
  <div class="container">
   <div class="row">
  <div class="col-sm-6" >MINISTRY/DEPARTMENT/LOCAL AUTHORITY/OTHER PUBLIC INSTITUTIONS 
  <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MINISTRY/DEPARTMENT/LOCAL AUTHORITY/OTHER PUBLIC INSTITUTIONS "  name="department2"   autocomplete ="off"> </div>
    <div class="col-sm-6" id="inputs" >SECTION <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="VACANCY / NUMBER  "  name="section2"   autocomplete ="off">
	</div>
	 
	</div>
	 
	 <div class="col-sm-4" >
	PRESENT  SUBSTATIVE   POST <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="VACANCY / POST "  name="currentpublicpost"   autocomplete ="off">
	 </div>
	  <div class="col-sm-4" >
	JOB GROUP <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="JOB GROUP "  name="currentpublicjobgroup"   autocomplete ="off">
	 </div>
	  <div class="col-sm-4" >
	EFFECTIVE  DATE <input type="date"   class="form-control input-sm" placeholder="EFFECTIVE  DATE "  name="publicjobemploymentdate"   autocomplete ="off">
	 </div>
	 
	 <div class="col-sm-6" >UPGRADING (IF APPLICABLE)POST 
  <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="UPGRADING (IF APPLICABLE)POST "  name="upgradingpublicjobpost"   autocomplete ="off"> </div>
    <div class="col-sm-6" id="inputs" >EFFECTIVE  DATE <input type="date"   class="form-control input-sm" placeholder="EFFECTIVE  DATE "  name="upgradingeffectivedate"   autocomplete ="off">
	</div><BR/>
	<div class="col-sm-12" >TERMS OF SERVICE 
	
	  <label class="checkbox-inline"> 
        <input type="radio" name="termsofpublicjob"  
            value="permanent" >PERMANENT AND  PENSIONABLE
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="termsofpublicjob" 
            value="contract">CONTRACT 
     </label>
	   <label class="checkbox-inline"> 
        <input type="radio" name="termsofpublicjob" 
            value="temporary" >TEMPORARY
     </label> 	 
	</div>
	</div>
	
	 <h3>
	 <a href="#" title=" PRIVATE SECTOR  " data-toggle="popover" data-trigger="hover" data-content="THIS  SECTION   IS TO  BE   FILLED  BY  PUBLIC EMPLOYEES  FROM  THE  PRIVATE AND N.G.O  SECTION  "  data-placement="top" >  
	 (C)APPLICANT   IN   THE  PRIVATE
	 </a>
	 </h3>
	   
	   	 <div class="container">
 <U>APPLICANT   IN THE   PRIVATE /NGO/OTHER  SECTORS </U>
  <div class="row">
  <div class="col-sm-3" >CURRENT  EMPLOYER  
  <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="CURRENT  EMPLOYER "  name="currentprivateemployer"   autocomplete ="off"> </div>
    <div class="col-sm-3" id="inputs" >POSITION  HELD <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="VACANCY / NUMBER  "  name="currentprivatejob"   autocomplete ="off">
	</div>
	 <div class="col-sm-3" > EFFECTIVE  DATE <input type="date"   class="form-control input-sm" placeholder="EFFECTIVE  DATE "  name="privateemployeddate"   autocomplete ="off"> </div>
	  <div class="col-sm-3" >SALARY(MONTHLY)  KSHS <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="SALARY(MONTHLY)  KSHS  "  name="privatejobsalary"   autocomplete ="off"></div>
	</div>
	</div>
	
	
	   
<h3><a href="#" title="ACADEMIC  QUALIFICATION " data-toggle="popover" data-trigger="hover" data-content="THIS SECTION  YOU  FILL YOUR  ACADEMIC,PROFFESSIOAL OR  TECHNICAL TRAININGS  YOU  HAVE   ACQUIRED     "  data-placement="top" >  

	   (E)ACADEMIC/PROFFESSIOAL/TECHNICAL QUALIFICATIONS (STARTING WITH THE  HIGHEST)	</a></h3>
	   
	    <div class="row">
  <div class="col-sm-12" > 
  <table width="200" border="1"   class="table">
  
  <tr class="tablehead">
    <td width="161">ATTACHMENT</td>
    <td  width="403">YEAR <br>
      FROM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TO</td>
    <td width="150">UNIVERSITY/COLLEGE/INSTITUTION/SCHOOL</td>
    <td width="242">AWARD /ATTAIMENT (EG  DEGREE,DIPLOMA,CERTIFICATE)</td>
	 <td width="264">COURSE (EG  MA,HD,BA)</td>
	  <td width="203">SUBJECT (ECN MATHS)</td>
	  <td width="161">CLASS/GRADE</td>
	
  </tr>
  <tr >  <td><input type="file"     class="form-control input-sm" placeholder="ATTACH "  name="academicfile1" id="academicfile1"   ></td>

    <td   class="file1details" width="403"><input type="date"      placeholder=""  name="academicstartdate1"   autocomplete ="off">
	<input type="date"       placeholder="  "  name="academicfinishdate1"   autocomplete ="off"></td>
    <td  class="file1details"  width="150"><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="UNIVERSITY/COLLEGE/INSTITUTION/SCHOOL  "  name="institution1"   autocomplete ="off"></td>
    <td   class="file1details">
		<select name="level1" class="form-control input-sm" >
		   <option value="">AWARD /ATTAINMENT</option>
		    <option  value="8">PHD</option>
			 <option  value="7">MASTERS</option>
			  <option  value="6">DEGREE</option>
			   <option  value="5">HIGHER DIP</option>
			    <option  value="4">DIPLOMA</option>
				 <option  value="3">CERTIFICATE</option>
				  <option  value="2">SECONDARY LEVEL</option>
				   <option  value="1">PRIMARY LEVEL</option>
		   <option  value="1">NONE</option>
		  </select>
	</td>
	 <td  class="file1details" ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="COURSE (EG  MA,HD,BA)  "  name="course1"   autocomplete ="off"></td>
	  <td   class="file1details" ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="SUBJECT (ECON MATHS)  "  name="subject1"   autocomplete ="off"></td>
	  <td  class="file1details"><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="CLASS/GRADE  "  name="class1"   autocomplete ="off"></td>
	 
 </tr>
  <tr>    <td><input type="file"     class="form-control input-sm" placeholder="ATTACH "  name="academicfile2"   id="academicfile2"  ></td>
    <td   class="file2details" width="403">
	<input type="date"      placeholder="START DATE  "  name="academicstartdate2"   autocomplete ="off">
	<input type="date"       placeholder="FINISH DATE "  name="academicfinishdate2"   autocomplete ="off">	</td>
    <td   class="file2details"  width="150">
	<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="UNIVERSITY/COLLEGE/INSTITUTION/SCHOOL  "  name="institution2"   autocomplete ="off">	</td>
    <td   class="file2details" >
	<select name="level2" class="form-control input-sm" >
		   <option value="">AWARD /ATTAINMENT</option>
		    <option  value="8">PHD</option>
			 <option  value="7">MASTERS</option>
			  <option  value="6">DEGREE</option>
			   <option  value="5">HIGHER DIP</option>
			    <option  value="4">DIPLOMA</option>
				 <option  value="3">CERTIFICATE</option>
				  <option  value="2">SECONDARY LEVEL</option>
				   <option  value="1">PRIMARY LEVEL</option>
		   <option  value="1">NONE</option>
		  </select>	</td>
	 <td  class="file2details" ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="COURSE (EG  MA,HD,BA)  "  name="course2"   autocomplete ="off"></td>
	  <td  class="file2details"><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="SUBJECT (ECON MATHS)  "  name="subject2"   autocomplete ="off"></td>
 <td   class="file2details" ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="CLASS/GRADE "  name="class2"   autocomplete ="off"></td>

  </tr>
  <tr>   <td><input type="file"     class="form-control input-sm" placeholder="ATTACH "  name="academicfile3"  id="academicfile3" ></td>
    <td   class="file3details" width="403"><input type="date"      placeholder="START DATE "  name="academicstartdate3"   autocomplete ="off">
	<input type="date"       placeholder="FINISH DATE "  name="academicfinishdate3"   autocomplete ="off"></td>
    <td   class="file3details" width="150"><input type="text"   style="text-transform:uppercase"   id="user"class="form-control input-sm" placeholder="UNIVERSITY/COLLEGE/INSTITUTION/SCHOOL  "  name="institution3"   autocomplete ="off"></td>
    <td  class="file3details" >	<select name="level3" class="form-control input-sm" >
		   <option value="">AWARD /ATTAINMENT</option>
		    <option  value="8">PHD</option>
			 <option  value="7">MASTERS</option>
			  <option  value="6">DEGREE</option>
			   <option  value="5">HIGHER DIP</option>
			    <option  value="4">DIPLOMA</option>
				 <option  value="3">CERTIFICATE</option>
				  <option  value="2">SECONDARY LEVEL</option>
				   <option  value="1">PRIMARY LEVEL</option>
		   <option  value="1">NONE</option>
		  </select></td>
	 <td  class="file3details" ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="COURSE (EG  MA,HD,BA)  "  name="course3"   autocomplete ="off"></td>
	  <td   class="file3details" ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="SUBJECT (ECON MATHS)  "  name="subject3"   autocomplete ="off"></td>
	  <td  class="file3details" ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="CLASS/GRADE  "  name="class3"   autocomplete ="off"></td>
 
  </tr>
  <tr>  <td><input type="file"     class="form-control input-sm" placeholder="ATTACH "  name="academicfile4"  id="academicfile4"   ></td>
    <td     class="file4details"  width="403">
	<input type="date"      placeholder="START DATE "  name="academicstartdate4"   autocomplete ="off">
	<input type="date"       placeholder="FINISH DATE"  name="academicfinishdate4"   autocomplete ="off">	</td>
   <td    class="file4details"   width="150">
	<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="UNIVERSITY/COLLEGE/INSTITUTION/SCHOOL  "  name="institution4"   autocomplete ="off">	</td>
    <td   class="file4details"  >	<select name="level4" class="form-control input-sm" >
		   <option value="">AWARD /ATTAINMENT</option>
		    <option  value="8">PHD</option>
			 <option  value="7">MASTERS</option>
			  <option  value="6">DEGREE</option>
			   <option  value="5">HIGHER DIP</option>
			    <option  value="4">DIPLOMA</option>
				 <option  value="3">CERTIFICATE</option>
				  <option  value="2">SECONDARY LEVEL</option>
				   <option  value="1">PRIMARY LEVEL</option>
		   <option  value="1">NONE</option>
		  </select></td>
	 <td   class="file4details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="COURSE (EG  MA,HD,BA) "  name="course4"   autocomplete ="off"></td>
	  <td   class="file4details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="SUBJECT (ECON MATHS) "  name="subject4"   autocomplete ="off"></td>
	  <td   class="file4details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="CLASS/GRADE  "  name="class4"   autocomplete ="off"></td>
 
 </tr>
  
</table>

  



  </div>
   </div>
  <h3>
  <a href="#" title=" OTHER COURSES " data-toggle="popover" data-trigger="hover" data-content="THIS  SECTION   THE APPLICANT TO  FILL SHORT COURSES ,TRAININGS OR PROFFESSIONAL BODIES EXAMINATIONS AD  TRAININGS  "  data-placement="top" >  
  (F)OTHER RELEVANT   COURSES AND   TRAINING/REGISTRATION/MEMBERSHIP/OR PROFFESSIONAL   BODIES /INSTITUTIONS (NOT  LESS THAN  A  WEEK)	</a></h3>
  
	 <div class="row">


<div class="col-sm-12" > 
  <table width="200" border="1"   class="table">
  <tr>
   <td >FILE</td>
    <td  width="242">YEAR</td>
    <td width="453">INSTITUTION/COLLEGE</td>
    <td width="401">COURSES</td>
	 <td width="398">DETAILS  & DURATION</td>
  </tr>
  <tr>
  <td   width="200"><input type="file"     class="form-control input-sm" placeholder="ATTACH "  name="shortcoursefile1"  id="shortcoursefile1"   ></td>
    <td  class="shortcoursefile1details" ><input type="text"  placeholder="YEAR" style="text-transform:uppercase"   class="form-control input-sm"   name="shortcoursedate1"   autocomplete ="off"></td>
	 <td   class="shortcoursefile2details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="INSTITUTION/COLLEGE  "  name="shortcourseinstitution1"   autocomplete ="off"></td>
	  <td  class="shortcoursefile3details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="COURSE  "  name="shortcourse1"   autocomplete ="off"></td>
	  <td   class="shortcoursefile4details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="DETAILS  "  name="shortcoursedetails1"   autocomplete ="off"></td>
  </tr>
    <tr>
	 <td><input type="file"     class="form-control input-sm" placeholder="ATTACH "  name="shortcoursefile1"  id="shortcoursefile2"   ></td>
    <td  class="shortcoursefile2details" ><input type="text"  placeholder="YEAR"   style="text-transform:uppercase"   class="form-control input-sm"  name="shortcoursedate2"   autocomplete ="off"></td>
	 <td   class="shortcoursefile2details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="INSTITUTION/COLLEGE "  name="shortcourseinstitution2"   autocomplete ="off"></td>
	  <td   class="shortcoursefile2details"   ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="COURSE  "  name="shortcourse2"   autocomplete ="off"></td>
	  <td    class="shortcoursefile2details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="DETAILS   "  name="shortcoursedetails2"   autocomplete ="off"></td>
  </tr>
   <tr>
    <td><input type="file"     class="form-control input-sm" placeholder="ATTACH "  name="shortcoursefile1"  id="shortcoursefile3"   ></td>
    <td    class="shortcoursefile3details" ><input type="text"  placeholder="YEAR"  style="text-transform:uppercase"   class="form-control input-sm"   name="shortcoursedate3"   autocomplete ="off"></td>
	 <td   class="shortcoursefile3details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="INSTITUTION/COLLEGE  "  name="shortcourseinstitution3"   autocomplete ="off"></td>
	  <td    class="shortcoursefile3details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="COURSE "  name="shortcourse3"   autocomplete ="off"></td>
	  <td    class="shortcoursefile3details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="DETAILS   "  name="shortcoursedetails3"   autocomplete ="off"></td>
  </tr>
    <tr>
	 <td><input type="file"     class="form-control input-sm" placeholder="ATTACH "  name="shortcoursefile1"  id="shortcoursefile4"   ></td>
    <td   class="shortcoursefile4details"  ><input type="text"  placeholder="YEAR"   style="text-transform:uppercase"   class="form-control input-sm"   name="shortcoursedate4"   autocomplete ="off"></td>
	 <td    class="shortcoursefile4details"><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="INSTITUTION/COLLEGE  "  name="shortcourseinstitution4"   autocomplete ="off"></td>
	  <td   class="shortcoursefile4details"  ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="COURSE  "  name="shortcourse4"   autocomplete ="off"></td>
	  <td   class="shortcoursefile4details" ><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="DETAILS   "  name="shortcoursedetails4"   autocomplete ="off"></td>
  </tr>
</table>

  



  </div>
  

  
  </div>
  
  
  <h3>
  REGISTRATION  WITH    OTHER   PROFFESSIONAL     BODIES</h3>
  
	 <div class="row">


<div class="col-sm-12" > 
  <table width="200" border="1"   class="table">
  <tr>
   
    <td width="453">PROFFESSIONAL  BODY</td>
    <td width="401">MEMBERSHIP NO </td>
	 <td width="398">MEMBER TYPE</td>
	  <td  width="242">DATE OF  RENEWAL</td>
  </tr>
  <tr>
	 <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="PROFESSIONAL BODY  "  name="proffessionalbody1"   autocomplete ="off"></td>
	  <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MEMBERSHIP NUMBER "  name="membershipnumber1"   autocomplete ="off"></td>
	  <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MEMBER TYPE  "  name="membertype1"   autocomplete ="off"></td>
      <td><input type="date"   style="text-transform:uppercase"   class="form-control input-sm"   name="renewaldate1"   autocomplete ="off"></td>

  </tr>
    <tr>
	 <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="PROFESSIONAL BODY  "  name="proffessionalbody2"   autocomplete ="off"></td>
	  <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MEMBERSHIP NUMBER "  name="membershipnumber2"   autocomplete ="off"></td>
	  <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MEMBER TYPE  "  name="membertype2"   autocomplete ="off"></td>
      <td><input type="date"   style="text-transform:uppercase"   class="form-control input-sm"   name="renewaldate2"   autocomplete ="off"></td>

  </tr>
     <tr>
	 <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="PROFESSIONAL BODY  "  name="proffessionalbody3"   autocomplete ="off"></td>
	  <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MEMBERSHIP NUMBER "  name="membershipnumber3"   autocomplete ="off"></td>
	  <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MEMBER TYPE  "  name="membertype3"   autocomplete ="off"></td>
      <td><input type="date"   style="text-transform:uppercase"   class="form-control input-sm"   name="renewaldate3"   autocomplete ="off"></td>

  </tr>
</table>

  



  </div>
  

  
  </div>
<h3><a href="#" title=" WORK EXPERIENCE " data-toggle="popover" data-trigger="hover" data-content="FILL  IN  THE  WORK  EXPERIENCE    YOU   HAVE ACQUIRED   IN  YOUR  CAREER  STARTING   WITH THE  MOST  RECENT  "  data-placement="top" >  
	   (G)EMPLOYMENT DETAILS (STARTING WITH MOST RECENT)	</a></h3>
	   
	   
	       <div class="row">
  <div class="col-sm-12" > 
  <table width="200" border="1"   class="table">
  <tr>
    <td  width="417">YEAR <br>
      FROM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TO</td>
    <td width="400">MINISTRY/STATEDEPARTMENT/INSTITUTION/ORGANIZATION </td>
    <td width="323">DESIGNNATION /POSITION</td>
	 <td width="354">JOB GROUP/GRADE/SCALE GROSS MONTHLY SALARY(KSHS) </td>
  </tr>
  <tr>
    <td   width="417"><input type="date"    name="fromjobdate1"   autocomplete ="off">
	<input type="date"   name="tojobdate1"   autocomplete ="off"></td>
    <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MINISTRY/STATEDEPARTMENT/INSTITUTION/ORGANIZATION  "  name="employer1"   autocomplete ="off"></td>
    <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="DESIGNNATION /POSITION  "  name="position1"   autocomplete ="off"></td>
	 <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="GROUP/GRADE/SCALE  "  name="grade1"   autocomplete ="off"></td>
  </tr>
  <tr>
    <td  width="417">
	<input type="date"   name="fromjobdate2"   autocomplete ="off">
	<input type="date"   name="tojobdate2"   autocomplete ="off">
	</td>
    <td>
	<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MINISTRY/STATEDEPARTMENT/INSTITUTION/ORGANIZATION  "  name="employer2"   autocomplete ="off">
	</td>
    <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="DESIGNNATION /POSITION  "  name="position2"  autocomplete ="off"></td>
	 <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="GROUP/GRADE/SCALE   "  name="grade2"   autocomplete ="off"></td>
	 
  </tr>
  <tr>
    <td   width="417"><input type="date"   name="fromjobdate3"   autocomplete ="off">
	<input type="date"    name="tojobdate3"   autocomplete ="off"></td>
    <td>
	<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MINISTRY/STATEDEPARTMENT/INSTITUTION/ORGANIZATION  "  name="employer3"   autocomplete ="off">
	</td>
    <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="DESIGNNATION /POSITION  "  name="position3"   autocomplete ="off"></td>
	 <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="GROUP/GRADE/SCALE   "  name="grade3"   autocomplete ="off"></td>
  </tr>
  <tr>
    <td  width="417">
	<input type="date"   name="fromjobdate4"   autocomplete ="off">
	<input type="date"     name="tojobdate4"   autocomplete ="off">
	</td>
   <td>
	<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="MINISTRY/STATEDEPARTMENT/INSTITUTION/ORGANIZATION  "  name="employer4"   autocomplete ="off">
	</td>
    <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="POSITION/RANK  "  name="position4"   autocomplete ="off"></td>
	 <td><input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="GROUP/GRADE/SCALE   "  name="grade4"  autocomplete ="off"></td>
  </tr>

</table>

  
 <div class="row">
  <div class="col-sm-6" > BRIEFLY   STATE  YOUR  CURRENT  DUTIES RESPONCIBILITIES   AND ASSIGNMENT <br/> <br/><br/><textarea    name="currentduties" placeholder=" BRIEFLY   STATE  YOUR  CURRENT  DUTIES RESPONCIBILITIES   AND ASSIGNMENT" class="form-control" rows="3"></textarea> </div>
  <div class="col-sm-6" ><br>PLEASE  GIVE  DETAILS    OF YOUR ABILITIES  SKILLS AND   EXPERIENCE  WHICH  YOU  CONSIDER TO   THE  POSITION  APPLIED  FOR .THE INFORMATION  MAY INCLUDE AN OUTLINE OF MOST  RECENT ACHIVEMETS AND REASONS FOR APPLYING 
  <textarea    name="skills" class="form-control" rows="3"  placeholder="PLEASE  GIVE  DETAILS    OF YOUR ABILITIES  SKILLS AND   EXPERIENCE  WHICH  YOU  CONSIDER TO   THE  POSITION  APPLIED  FOR .THE INFORMATION  MAY INCLUDE AN OUTLINE OF MOST  RECENT ACHIVEMETS AND REASONS FOR APPLYING 
  "></textarea>
  </div>
  </div>


  </div>
 
  </div>
  
  <h3>
	   (D)OTHER DETAILS	</h3>
    <div class="container">
 <U>OTHER DETAILS</U>
  <div class="row">
  <div class="col-sm-4" >LANGUAGES   PROFICIENT  IN   <a href="#" title=" NOTE " data-toggle="popover" data-trigger="hover" data-content="ENTER  THE  LANGUAGES  YOU  CAN  FLUENTLY COMMUNICATE IN "  data-placement="bottom" >
  
  <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="LANGUAGES   PROFICIENT  IN"  name="languages"     autocomplete ="off"> </a></div>
    <div class="col-sm-3" id="inputs" >DO YOU SUFFER  FROM  ANY  PHYSICAL    IMPAIRMENT 
	<label class="checkbox-inline"> 
        <input type="radio" name="physicalimpairment" 
            value="YES" >YES
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="physicalimpairment"  
            value="NO"  checked> NO
     </label> 
	</div>
	 <div class="col-sm-5" > IF YES  GIVE DETAILS <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="IF YES  GIVE DETAILS  "  name="physicalimpairmentdetails"   autocomplete ="off"> </div>
	
	</div>
	
	<div class="row">
  <div class="col-sm-4" >HAVE YOU   BEEN   CONVICTED  OF  ANY  CRIMINAL  OFFENCE OR  SUBJECTED   TO  PROBATION  ORDER  
  <label class="checkbox-inline"> 
        <input type="radio" name="convicted"  
            value="YES" >YES
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="convicted"  
            value="NO"  checked> NO
     </label> </div>
	 <div class="col-sm-4" >HAVE  YOU  BEEN  DISMISSED   OR  OTHERWISE REMOVED   FROM  EMPLOYMENT 
	  <label class="checkbox-inline"> 
        <input type="radio" name="dismissed" 
            value="YES" >YES
     </label> 
     <label class="checkbox-inline"> 
        <input type="radio" name="dismissed" 
            value="NO"  checked> NO
     </label>
	 </div>
	 
	  <div class="col-sm-4" >DISMISAL /REMOVAL EFFECTIVE  DATE   <input type="date"   class="form-control input-sm" placeholder="DISMISAL /REMOVAL EFFECTIVE  DATE "  name="dismissaldate"   autocomplete ="off">  </div>
	 </div>
	 
	 <div class="row">
  <div class="col-sm-12" >IF   YES STATE  REASON(S)  OF  DISMISAL /REMOVAL   <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="IF   YES STATE  REASON(S)  OF  DISMISAL /REMOVAL "  name="dismissalreason"   autocomplete ="off">  </div></div>
  
   <div class="row">
  <div class="col-sm-4" >HAVE  YOU  EVER  BEEN  INTERVIEWED BY  THE  LAMU  COUNTY  P.S.B <BR> 
  <label class="checkbox-inline"> 
        <input type="radio" name="everinterviewed" id="optionsRadios3" 
            value="YES" >YES
     </label> 
     <label class="checkbox-inline"> 
      <input type="radio" name="everinterviewed" 
            value="NO"   checked> NO  
     </label> </div>
	 <div class="col-sm-4" >IF YES STATE THE POST   <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="IF YES STATE THE POST "  name="interviewedpost"   autocomplete ="off"></div>
	 <div class="col-sm-4" >INTERVIEW DATE    <input type="date"   class="form-control input-sm" placeholder="INTERVIEW DATE "  name="intervieweddate"   autocomplete ="off"></div>
	 </div>
  
  
	</div>	   

<h3>
<a href="#" title=" REFFEREES  " data-toggle="popover" data-trigger="hover" data-content="FILL  THE  CONTANT    OF  THE  REFEREES IN  YOUR   WORKING  CAREER  "  data-placement="top" >  
(H)PERSONAL  REFFERENCE	</a></h3>
  <div class="container">
  <div class="row">
  <div class="col-sm-2" > FULL NAMES<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="FULL NAMES  "  name="refference1"   autocomplete ="off"> </div>
  <div class="col-sm-2" > ADDRESS <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="ADDRESS  "  name="refferenceaddress1"   autocomplete ="off"></div>
  <div class="col-sm-1"   > TEL NO<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="TEL NO  "  name="refferencetel1"   autocomplete ="off"> </div>
  <div class="col-sm-2" > EMAIL <input type="text"      class="form-control input-sm" placeholder="EMAIL  "  name="refferenceemail1"   autocomplete ="off"> </div>
  <div class="col-sm-2" > OCCUPATION<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="OCCUPATION  "  name="refferenceoccupation1"   autocomplete ="off"></div>
  <div class="col-sm-3" > PERIOD  FOR  WHICH HE/SHE  HAS  KNOWN YOU <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="PERIOD  FOR  WHICH HE/SHE  HAS  KNOWN YOU  "  name="refferenceperiod1"   autocomplete ="off"></div>
 </div>
 <br>
 
 <div class="row">
  <div class="col-sm-2" > FULL NAMES<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="FULL NAMES  "  name="refference2"   autocomplete ="off"> </div>
  <div class="col-sm-2" > ADDRESS <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="ADDRESS  "  name="refferenceaddress2"   autocomplete ="off"></div>
  <div class="col-sm-1" > TEL NO<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="TEL NO  "  name="refferencetel2"   autocomplete ="off"> </div>
  <div class="col-sm-2" > EMAIL <input type="text"     class="form-control input-sm" placeholder="EMAIL  "  name="refferenceemail2"   autocomplete ="off"> </div>
  <div class="col-sm-2" > OCCUPATION<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="OCCUPATION  "  name="refferenceoccupation2"   autocomplete ="off"></div>
  <div class="col-sm-3" > PERIOD  FOR  WHICH HE/SHE  HAS  KNOWN YOU <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="PERIOD  FOR  WHICH HE/SHE  HAS  KNOWN YOU  "  name="refferenceperiod2"   autocomplete ="off"></div>
 </div>
 <br>
  <div class="row">
  <div class="col-sm-2" > FULL NAMES<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="FULL NAMES  "  name="refference3"   autocomplete ="off"> </div>
  <div class="col-sm-2" > ADDRESS <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="ADDRESS  "  name="refferenceaddress3"   autocomplete ="off"></div>
  <div class="col-sm-1"  > TEL NO<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="TEL NO  "  name="refferencetel3"   autocomplete ="off"> </div>
  <div class="col-sm-2" > EMAIL <input type="text"     class="form-control input-sm" placeholder="EMAIL  "  name="refferenceemail3"   autocomplete ="off"> </div>
  <div class="col-sm-2" > OCCUPATION<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="OCCUPATION  "  name="refferenceoccupation3"   autocomplete ="off"></div>
  <div class="col-sm-3" > PERIOD  FOR  WHICH HE/SHE  HAS  KNOWN YOU <input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="PERIOD  FOR  WHICH HE/SHE  HAS  KNOWN YOU  "  name="refferenceperiod3"   autocomplete ="off"></div>
 </div>
 <hr>
  <div class="row">

  

  <div class="col-sm-4" ><div class="row"> <input name="SUBMIT" type="submit" id="submit" value="SUBMIT"   class="btn-info btn-lg">  
 <input name="RESET" type="reset"  class="btn-info btn-lg"> </div></div>
   <div class="col-sm-4" >
  
 <a href="#" title="ENSURE YOU FILL  AND   SUBMIT PART A-H BEFORE  YOU  UPLOAD YOUR FILES  " data-toggle="popover" data-trigger="hover" data-content="ALSO  ENSURE  ALL  THE  FILES ARE   IN   PDF  FORMAT  "  data-placement="top" >  
 <div    class="btn-info btn-lg"   id="openupload">CLICK TO ATTACH FILES </div>
 </a>
 </div>
  <div class="col-sm-4" ></div>
  </div>
 <hr>
 </div>
 
 
</div>
  </div></div>
</div>  

</form>

  <form action="upload.php"  method="post"    enctype="multipart/form-data">
  
  <div class="modal fade" id="uploadmodal" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
  <div class="modal-header">  <h5><U>NOTE:  KINDLY  ENSURE   YOU   FILL  PART  A TO  H  AND SUBMIT  BEFORE  UPLOADING  YOUR  FILES</U></h5>  </div>
  <div class="container">
  <div class="row">
   <div class="col-sm-4" > ATTACH  FILES<a href="#" title=" UPLOAD YOUR  ID  AND   " data-toggle="popover" data-trigger="hover" data-content="OTHER  RELEVANT  FILES (MAX 10 PDF FORMAT)  "  data-placement="bottom" > 
<input type="file"  class="form-control input-sm" placeholder="ID CARD"  name="file[]" id="inputfile"  method="multipart/form-data"   multiple >
	  </a></div>
  <div class="col-sm-4" id="inputs" >JOB REFF  NUMBER
	<a href="#" title="NOTE " data-toggle="popover" data-trigger="hover" data-content="ENTER  THE  JOB REFF  NUMBER"  data-placement="bottom" >
	<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="JOB REFF  NUMBER  "     name="reffnumber"  id="reffnumber2"   autocomplete ="off"></a>
	</div>
<div class="col-sm-4" id="inputs" >ID/PASSPORT NUMBER 
	<a href="#" title="NOTE " data-toggle="popover" data-trigger="hover" data-content="ENTER  THE  APPLICANTS  ID NUMBER"  data-placement="bottom" >
	<input type="text"   style="text-transform:uppercase"   class="form-control input-sm" placeholder="ID NUMBER  "  name="idnumber"   id="idnumber2"  autocomplete ="off"></a>
	</div>  

</div>


<input name="SUBMIT" type="submit" value="SUBMIT"   class="btn-info btn-sm">  
 <input name="RESET" type="reset"  class="btn-info btn-sm"> 
 <button type="button" class="btn-info btn-sm"  data-dismiss="modal" id="messageclose"> CLOSE</button>

  
  </div>
 
  </div></div>
  
  </div>
  </div>  </form>

  <div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header">  <h3><U><input name="" type="image" src="logo.png"  width="10%"  height="10%" >LAMU COUNTY PUBLIC  SERVICE BOARD<input name="" type="image" src="logo.png"  width="10%"  height="10%" ></U></h3>  </div>
  <div class="container"  id="content"><h4   style="text-align:center"><U>TERMS  FOR   JOB   APPLICATION </U></h4>
  
  <ul>
  <li><h4   style="text-align:center">ENSURE    YOU   FILL  ALL  THE   PARTS  (A-H) WHERE  APPLICABLE </h4></li>
    <li><h4   style="text-align:center">THE   PARTS  WITH  A RED  BOARDER  ARE  MANDATORY  TO FILL </h4></li>

  <li><h4   style="text-align:center">FALSE   INFORMATION WILL LEAD   TO  AUTOMATIC  DISQUALIFICATION </h4></li>
  <li><h4   style="text-align:center">THE  FORM   MUST BE FILLED  IN   BLOCKED   LETTERS UNLESS  ITS  AN EMAIL ADDRESS</h4></li>
  <li><h4   style="text-align:center">UPLOAD  YOUR  FILES AFTER SUCCESSFULLY  FILLING AND  SUBMITTING  THE  FORM</h4></li>
   <li><h4   style="text-align:center">INFORMATION  FILLED  IN THIS  FORM  SHALL  BE CONFIDENCIAL</h4></li>
    <li><h4   style="text-align:center">REMEMBER TO  ATTACH YOUR ID  AND  ACADEMIC  CERTIFICATES  IN   PDF   FORMAT</h4></li>
  
  </ul>
  <button type="button" class="btn-info btn-sm"  data-dismiss="modal" id="messageclose"> CLOSE</button></div></div></div>
  </div>
  
  <div class="modal fade" id="feedback" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent"> </div></div></div>
  </div>
  
  <div class="modal fade" id="academicmessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">ATTACH ACADEMIC FILE  FIRST  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div>
    <div class="modal fade" id="shortcoursemessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">ATTACH COURSE  FILE  FIRST  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div>
  
   <div class="modal fade" id="idmessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">ATTACH ID /PASSPORT  FILE  FIRST  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div>
  
  <div class="modal fade" id="subcountymessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">SELECT HOME COUNTY  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div>  
  
    <div class="modal fade" id="errormessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">  <?php include("message.php");?><hr></h2>
  </div></div></div>
  </div> 

<!-- Autocomplete -->
<h2 class="demoHeaders">&nbsp;</h2>
<!-- Dialog NOTE: Dialog is not generated by UI in this demo so it can be visually styled in themeroller-->
<h2 class="demoHeaders">
  <!-- Spinner -->
</h2>
<h2 class="demoHeaders">&nbsp;</h2>


</body>
</html>
