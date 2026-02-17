<link href="stylesheets/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
	<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
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
<script type="text/javascript"> 
$(document).ready(function(){
$('[data-toggle="popover"]').popover(); 
$('#message').modal('show');
});
</script>
	
<?php 
if(!isset($_POST['SUBMIT'])){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">APPLY THE JOB FIRST  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';}
set_time_limit(0);
@session_start();
include_once("password.php");  
@$jobrefference=$_POST['jobrefference']; $jobrefference=strtoupper(addslashes($jobrefference));
if(empty($jobrefference)){
print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">JOB REFFERENCE MISSING  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';
 include_once("index.php");exit;} 
if($jobrefference==""){$_SESSION['message']="<br>ENTER THE  REFF  NUMBER  <BR> APPLIED FOR  IN SECTION (A) <br>";header("LOCATION:index.php"); exit;}
	$x="SELECT * FROM vacancies where refferencenumber ='$jobrefference'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{

	while ($y=@mysqli_fetch_array($x)){  $vacancy=$y['vacancy'];  $department=$y['department'];}}
	else { print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">JOB REFFERENCE NOT VACANT  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}  

@$surname=$_POST['surname']; $surname=strtoupper(addslashes($surname));
if($surname==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">SURNAME MISSING  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
@$nationality=$_POST['nationality']; $nationality=strtoupper(addslashes($nationality));
if($nationality==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">NATIONALITY MISSING <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
@$firstname=$_POST['firstname']; $firstname=strtoupper(addslashes($firstname));
if($firstname==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">FIRST NAME  MISSING  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
@$gender=$_POST['gender']; $gender=strtoupper(addslashes($gender));
if($gender==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">SELECT GENDER  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
@$idnumber=$_POST['idnumber']; $idnumber=strtoupper(addslashes($idnumber));
if($idnumber <1){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">ENTER ID NUMBER  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
  @$title=$_POST['title']; $title=strtoupper(addslashes($title));
if($title==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">ENTER TITLE  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
@$dateofbirth=$_POST['dateofbirth']; $dateofbirth=strtoupper(addslashes($dateofbirth));
if($dateofbirth==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">SELECT  DATE OFC  BIRTH  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}

@$boxaddress=$_POST['boxaddress']; $boxaddress=strtoupper(addslashes($boxaddress));
@$postalcode=$_POST['postalcode']; $postalcode=strtoupper(addslashes($postalcode));
@$county=$_POST['county']; $county=strtoupper(addslashes($county));
if($county==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">SELECT HOME  COUNTY  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
@$mobile=$_POST['mobile']; $mobile=strtoupper(addslashes($mobile));
if($mobile==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">ENTER MOBILE NUMBER  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}   
@$subcounty=$_POST['subcounty']; $subcounty=strtoupper(addslashes($subcounty));
@$email=$_POST['email']; $email=addslashes($email);@$disability=$_POST['disability']; $disability=strtoupper(addslashes($disability));
@$othername=$_POST['othername']; $othername=strtoupper(addslashes($othername));
@$kranumber=$_POST['kranumber']; $kranumber=strtoupper(addslashes($kranumber));
@$ethnic=$_POST['ethnic']; $ethnic=strtoupper(addslashes($ethnic));
if($ethnic==""){print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">ETHNICITY MISSING  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
 
@$constituency=$_POST['constituency']; $constituency=strtoupper(addslashes($constituency));

@$contactperson=$_POST['contactperson']; $contactperson=strtoupper(addslashes($contactperson));
@$subtribe=$_POST['subtribe']; $subtribe=strtoupper(addslashes($subtribe));@$contactpersonmobile=$_POST['contactpersonmobile']; $contactpersonmobile=strtoupper(addslashes($contactpersonmobile));
@$disabilitydetails=$_POST['disabilitydetails']; $disabilitydetails=strtoupper(addslashes($disabilitydetails));
@$department2=$_POST['department2']; $department2=strtoupper(addslashes($department2));
@$section2=$_POST['section2']; $section2=strtoupper(addslashes($section2));@$currentpublicjobgroup=$_POST['currentpublicjobgroup']; $currentpublicjobgroup=strtoupper(addslashes($currentpublicjobgroup));
@$currentpublicpost=$_POST['currentpublicpost']; $currentpublicpost=strtoupper(addslashes($currentpublicpost));
@$publicjobemploymentdate=$_POST['publicjobemploymentdate']; $publicjobemploymentdate=strtoupper(addslashes($publicjobemploymentdate));
@$upgradingpublicjobpost=$_POST['upgradingpublicjobpost']; $upgradingpublicjobpost=strtoupper(addslashes($upgradingpublicjobpost));
$upgradingeffectivedate=$_POST['upgradingeffectivedate']; $upgradingeffectivedate=strtoupper(addslashes($upgradingeffectivedate));
@$termsofpublicjob=$_POST['termsofpublicjob']; $termsofpublicjob=strtoupper(addslashes($termsofpublicjob));
@$currentprivatejob=$_POST['currentprivatejob']; $currentprivatejob=strtoupper(addslashes($currentprivatejob));
@$currentprivateemployer=$_POST['currentprivateemployer']; $currentprivateemployer=strtoupper(addslashes($currentprivateemployer));
@$privatejobsalary=$_POST['privatejobsalary']; $privatejobsalary=strtoupper(addslashes($privatejobsalary));
$privateemployeddate=$_POST['privateemployeddate']; $privateemployeddate=strtoupper(addslashes($privateemployeddate));
@$languages=$_POST['languages']; $languages=strtoupper(addslashes($languages));
@$physicalimpairment=$_POST['physicalimpairment']; $physicalimpairment=strtoupper(addslashes($physicalimpairment));
@$physicalimpairmentdetails=$_POST['physicalimpairmentdetails']; $physicalimpairmentdetails=strtoupper(addslashes($physicalimpairmentdetails));
@$convicted=$_POST['convicted']; $convicted=strtoupper(addslashes($convicted));
@$dismissed=$_POST['dismissed']; $dismissed=strtoupper(addslashes($dismissed));
@$dismissaldate=$_POST['dismissaldate']; $dismissaldate=strtoupper(addslashes($dismissaldate));
@$dismissalreason=$_POST['dismissalreason']; $dismissalreason=strtoupper(addslashes($dismissalreason));
@$everinterviewed=$_POST['everinterviewed']; $everinterviewed=strtoupper(addslashes($everinterviewed));
@$interviewedpost=$_POST['interviewedpost']; $interviewedpost=strtoupper(addslashes($interviewedpost));
@$intervieweddate=$_POST['intervieweddate']; $intervieweddate=strtoupper(addslashes($intervieweddate));
@$academicstartdate1=$_POST['academicstartdate1']; $academicstartdate1=strtoupper(addslashes($academicstartdate1));
@$academicfinishdate1=$_POST['academicfinishdate1']; $academicfinishdate1=strtoupper(addslashes($academicfinishdate1));
@$academicstartdate2=$_POST['academicstartdate2']; $academicstartdate2=strtoupper(addslashes($academicstartdate2));
@$academicfinishdate2=$_POST['academicfinishdate2']; $academicfinishdate2=strtoupper(addslashes($academicfinishdate2));
@$academicstartdate3=$_POST['academicstartdate3']; $academicstartdate3=strtoupper(addslashes($academicstartdate3));
@$academicfinishdate3=$_POST['academicfinishdate3']; $academicfinishdate3=strtoupper(addslashes($academicfinishdate3));
@$academicstartdate4=$_POST['academicstartdate4']; $academicstartdate4=strtoupper(addslashes($academicstartdate4));
@$academicfinishdate4=$_POST['academicfinishdate4']; $academicfinishdate4=strtoupper(addslashes($academicfinishdate4));
@$institution1=$_POST['institution1']; $institution1=strtoupper(addslashes($institution1));
@$institution2=$_POST['institution2']; $institution2=strtoupper(addslashes($institution2));
@$institution3=$_POST['institution3']; $institution3=strtoupper(addslashes($institution3));
@$institution4=$_POST['institution4']; $institution4=strtoupper(addslashes($institution4));
@$level1=$_POST['level1']; $level1=strtoupper(addslashes($level1));@$level2=$_POST['level2']; $level2=strtoupper(addslashes($level2));
@$level3=$_POST['level3']; $level3=strtoupper(addslashes($level3));@$level4=$_POST['level4']; $level4=strtoupper(addslashes($level4));
@$course1=$_POST['course1']; $course1=strtoupper(addslashes($course1));@$course2=$_POST['course2']; $course2=strtoupper(addslashes($course2));
@$course3=$_POST['course3']; $course3=strtoupper(addslashes($course3));@$course4=$_POST['course4']; $course4=strtoupper(addslashes($course4));
@$subject1=$_POST['subject1']; $subject1=strtoupper(addslashes($subject1));@$subject2=$_POST['subject2']; $subject2=strtoupper(addslashes($subject2));
@$subject3=$_POST['subject3']; $subject3=strtoupper(addslashes($subject3));@$subject4=$_POST['subject4']; $subject4=strtoupper(addslashes($subject4));
@$class1=$_POST['class1']; $class1=strtoupper(addslashes($class1));@$class2=$_POST['class2']; $class2=strtoupper(addslashes($class2));
@$class3=$_POST['class3']; $class3=strtoupper(addslashes($class3));@$class4=$_POST['class4']; $class4=strtoupper(addslashes($class4));
@$shortcoursedate1=$_POST['shortcoursedate1']; $shortcoursedate1=strtoupper(addslashes($shortcoursedate1));
@$shortcoursedate2=$_POST['shortcoursedate2']; $shortcoursedate2=strtoupper(addslashes($shortcoursedate2));
@$shortcoursedate3=$_POST['shortcoursedate3']; $shortcoursedate3=strtoupper(addslashes($shortcoursedate3));
@$shortcoursedate4=$_POST['shortcoursedate4']; $shortcoursedate4=strtoupper(addslashes($shortcoursedate4));
@$shortcourseinstitution1=$_POST['shortcourseinstitution1']; $shortcourseinstitution1=strtoupper(addslashes($shortcourseinstitution1));
@$shortcourseinstitution2=$_POST['shortcourseinstitution2']; $shortcourseinstitution2=strtoupper(addslashes($shortcourseinstitution2));
@$shortcourseinstitution3=$_POST['shortcourseinstitution3']; $shortcourseinstitution3=strtoupper(addslashes($shortcourseinstitution3));
@$shortcourseinstitution4=$_POST['shortcourseinstitution4']; $shortcourseinstitution4=strtoupper(addslashes($shortcourseinstitution4));
@$shortcourse1=$_POST['shortcourse1']; $shortcourse1=strtoupper(addslashes($shortcourse1));
@$shortcourse2=$_POST['shortcourse2']; $shortcourse2=strtoupper(addslashes($shortcourse2));
@$shortcourse3=$_POST['shortcourse3']; $shortcourse3=strtoupper(addslashes($shortcourse3));
@$shortcourse4=$_POST['shortcourse4']; $shortcourse4=strtoupper(addslashes($shortcourse4));
@$shortcoursedetails1=$_POST['shortcoursedetails1']; $shortcoursedetails1=strtoupper(addslashes($shortcoursedetails1));
@$shortcoursedetails2=$_POST['shortcoursedetails2']; $shortcoursedetails2=strtoupper(addslashes($shortcoursedetails2));
@$shortcoursedetails3=$_POST['shortcoursedetails3']; $shortcoursedetails3=strtoupper(addslashes($shortcoursedetails3));
@$shortcoursedetails4=$_POST['shortcoursedetails4']; $shortcoursedetails4=strtoupper(addslashes($shortcoursedetails4));
@$proffessionalbody1=$_POST['proffessionalbody1']; $proffessionalbody1=strtoupper(addslashes($proffessionalbody1));
@$proffessionalbody2=$_POST['proffessionalbody2']; $proffessionalbody2=strtoupper(addslashes($proffessionalbody2));
@$proffessionalbody3=$_POST['proffessionalbody3']; $proffessionalbody3=strtoupper(addslashes($proffessionalbody3));
@$membershipnumber1=$_POST['membershipnumber1']; $membershipnumber1=strtoupper(addslashes($membershipnumber1));
@$membershipnumber2=$_POST['membershipnumber2']; $membershipnumber2=strtoupper(addslashes($membershipnumber2));
@$membershipnumber3=$_POST['membershipnumber3']; $membershipnumber3=strtoupper(addslashes($membershipnumber3));
@$membertype1=$_POST['membertype1']; $membertype1=strtoupper(addslashes($membertype1));
@$membertype2=$_POST['membertype2']; $membertype2=strtoupper(addslashes($membertype2));
@$membertype3=$_POST['membertype3']; $membertype3=strtoupper(addslashes($membertype3));
@$renewaldate1=$_POST['renewaldate1']; $renewaldate1=strtoupper(addslashes($renewaldate1));
@$renewaldate2=$_POST['renewaldate2']; $renewaldate2=strtoupper(addslashes($renewaldate2));
@$renewaldate3=$_POST['renewaldate3']; $renewaldate3=strtoupper(addslashes($renewaldate3));
@$fromjobdate1=$_POST['fromjobdate1']; $fromjobdate1=strtoupper(addslashes($fromjobdate1));
@$fromjobdate2=$_POST['fromjobdate2']; $fromjobdate2=strtoupper(addslashes($fromjobdate2));
@$fromjobdate3=$_POST['fromjobdate3']; $fromjobdate3=strtoupper(addslashes($fromjobdate3));
@$fromjobdate4=$_POST['fromjobdate4']; $fromjobdate4=strtoupper(addslashes($fromjobdate4));
@$tojobdate1=$_POST['tojobdate1']; $tojobdate1=strtoupper(addslashes($tojobdate1));
@$tojobdate2=$_POST['tojobdate2']; $tojobdate2=strtoupper(addslashes($tojobdate2));
@$tojobdate3=$_POST['tojobdate3']; $tojobdate3=strtoupper(addslashes($tojobdate3));
@$tojobdate4=$_POST['tojobdate4']; $tojobdate4=strtoupper(addslashes($tojobdate4));
@$employer1=$_POST['employer1']; $employer1=strtoupper(addslashes($employer1));
@$employer2=$_POST['employer2']; $employer2=strtoupper(addslashes($employer2));
@$employer3=$_POST['employer3']; $employer3=strtoupper(addslashes($employer3));
@$employer4=$_POST['employer4']; $employer4=strtoupper(addslashes($employer4));
@$position1=$_POST['position1']; $position1=strtoupper(addslashes($position1));
@$position2=$_POST['position2']; $position2=strtoupper(addslashes($position2));
@$position3=$_POST['position3']; $position3=strtoupper(addslashes($position3));
@$position4=$_POST['position4']; $position4=strtoupper(addslashes($position4));
@$grade1=$_POST['grade1']; $grade1=strtoupper(addslashes($grade1));
@$grade2=$_POST['grade2']; $grade2=strtoupper(addslashes($grade2));
@$grade3=$_POST['grade3']; $grade3=strtoupper(addslashes($grade3));
@$grade4=$_POST['grade4']; $grade4=strtoupper(addslashes($grade4));
@$refference1=$_POST['refference1']; $refference1=strtoupper(addslashes($refference1));
@$refference2=$_POST['refference2']; $refference2=strtoupper(addslashes($refference2));
@$refference3=$_POST['refference3']; $refference3=strtoupper(addslashes($refference3));
@$refferenceaddress1=$_POST['refferenceaddress1']; $refferenceaddress1=strtoupper(addslashes($refferenceaddress1));
@$refferenceaddress2=$_POST['refferenceaddress2']; $refferenceaddress2=strtoupper(addslashes($refferenceaddress2));
@$refferenceaddress3=$_POST['refferenceaddress3']; $refferenceaddress3=strtoupper(addslashes($refferenceaddress3));
@$refferencetel1=$_POST['refferencetel1']; $refferencetel1=strtoupper(addslashes($refferencetel1));
@$refferencetel2=$_POST['refferencetel2']; $refferencetel2=strtoupper(addslashes($refferencetel2));
@$refferencetel3=$_POST['refferencetel3']; $refferencetel3=strtoupper(addslashes($refferencetel3));
@$refferenceemail1=$_POST['refferenceemail1']; $refferenceemail1=addslashes($refferenceemail1);
@$refferenceemail2=$_POST['refferenceemail2']; $refferenceemail2=addslashes($refferenceemail2);
@$refferenceemail3=$_POST['refferenceemail3']; $refferenceemail3=addslashes($refferenceemail3);
@$refferenceoccupation1=$_POST['refferenceoccupation1']; $refferenceoccupation1=strtoupper(addslashes($refferenceoccupation1));
@$refferenceoccupation2=$_POST['refferenceoccupation2']; $refferenceoccupation2=strtoupper(addslashes($refferenceoccupation2));
@$refferenceoccupation3=$_POST['refferenceoccupation3']; $refferenceoccupation3=strtoupper(addslashes($refferenceoccupation3));
@$refferenceperiod1=$_POST['refferenceperiod1']; $refferenceperiod1=strtoupper(addslashes($refferenceperiod1));
@$refferenceperiod2=$_POST['refferenceperiod2']; $refferenceperiod2=strtoupper(addslashes($refferenceperiod2));
@$refferenceperiod3=$_POST['refferenceperiod3']; $refferenceperiod3=strtoupper(addslashes($refferenceperiod3));
@$currentduties=$_POST['currentduties']; $currentduties=nl2br(strtoupper(addslashes($currentduties)));
@$skills=$_POST['skills']; $skills=nl2br(strtoupper(addslashes($skills)));

//$x="DELETE   FROM  jobapplications  WHERE  reffnumber='$jobrefference'  AND  IDNUMBER='$idnumber'";mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SELECT * FROM  jobapplications  WHERE  reffnumber='$jobrefference'  AND  IDNUMBER='$idnumber' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0){ print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">DOUBLE APPLICATION  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;}
		

$x="INSERT  INTO  jobapplications(vacancy,reffnumber,department,title,surname,firstname,othername,birthdate,gender,ethnic,subtribe,
nationality,idnumber,kranumber,address,postalcode,disability,disabilitydetail,homecounty,subcounty,constituency,mobile,email,
contactperson,contactpersonmobile,department2,section2,currentpublicpost,currentpublicjobgroup,publicjobemploymentdate,
upgradingpublicjobpost,upgradingeffectivedate,termsofpublicjob,currentprivatejob,currentprivateemployer,privatejobsalary,privateemployeddate,
languages,physicalimpairment,physicalimpairmentdetails,convicted,dismissed,dismissaldate,dismissalreason,everinterviewed,interviewedpost,intervieweddate,
academicstartdate1,academicfinishdate1,academicstartdate2,academicfinishdate2,academicstartdate3,academicfinishdate3,academicstartdate4,academicfinishdate4,institution1,institution2,institution3,institution4,level1,level2,level3,level4,course1,course2,course3,course4,subject1,subject2,subject3,subject4,class1,class2,class3,class4,
shortcoursedate1,shortcoursedate2,shortcoursedate3,shortcoursedate4,shortcourseinstitution1,shortcourseinstitution2,shortcourseinstitution3,shortcourseinstitution4,shortcourse1,shortcourse2,shortcourse3,shortcourse4,shortcoursedetails1,shortcoursedetails2,shortcoursedetails3,shortcoursedetails4,proffessionalbody1,proffessionalbody2,proffessionalbody3,membershipnumber1,membershipnumber2,membershipnumber3,membertype1,membertype2,membertype3,
renewaldate1,renewaldate2,renewaldate3,fromjobdate1,fromjobdate2,fromjobdate3,fromjobdate4,tojobdate1,tojobdate2,tojobdate3,tojobdate4,employer1,employer2,employer3,employer4,position1,position2,position3,position4,grade1,grade2,grade3,grade4,currentduties,skills,
refference1,refference2,refference3,refferenceaddress1,refferenceaddress2,refferenceaddress3,refferencetel1,refferencetel2,refferencetel3,refferenceemail1,refferenceemail2,refferenceemail3,refferenceoccupation1,refferenceoccupation2,refferenceoccupation3,refferenceperiod1,refferenceperiod2,refferenceperiod3,date)
VALUES('$vacancy','$jobrefference','$department','$title','$surname','$firstname','$othername','$dateofbirth',
'$gender','$ethnic','$subtribe','$nationality','$idnumber','$kranumber','$boxaddress','$postalcode','$disability',
'$disabilitydetails','$county','$subcounty','$constituency','$mobile','$email','$contactperson','$contactpersonmobile',
'$department2','$section2','$currentpublicpost','$currentpublicjobgroup','$publicjobemploymentdate',
'$upgradingpublicjobpost','$upgradingeffectivedate','$termsofpublicjob','$currentprivatejob','$currentprivateemployer',
'$privatejobsalary','$privateemployeddate','$languages','$physicalimpairment','$physicalimpairmentdetails','$convicted','$dismissed','$dismissaldate','$dismissalreason','$everinterviewed',
'$interviewedpost','$intervieweddate','$academicstartdate1','$academicfinishdate1','$academicstartdate2','$academicfinishdate2','$academicstartdate3','$academicfinishdate3','$academicstartdate4','$academicfinishdate4','$institution1','$institution2','$institution3','$institution4',
'$level1','$level2','$level3','$level4','$course1','$course2','$course3','$course4','$subject1','$subject2','$subject3','$subject4','$class1','$class2','$class3','$class4','$shortcoursedate1','$shortcoursedate2','$shortcoursedate3','$shortcoursedate4',
'$shortcourseinstitution1','$shortcourseinstitution2','$shortcourseinstitution3','$shortcourseinstitution4','$shortcourse1','$shortcourse2','$shortcourse3','$shortcourse4','$shortcoursedetails1','$shortcoursedetails2','$shortcoursedetails3','$shortcoursedetails4','$proffessionalbody1','$proffessionalbody2','$proffessionalbody3','$membershipnumber1','$membershipnumber2','$membershipnumber3','$membertype1','$membertype2','$membertype3',
'$renewaldate1','$renewaldate2','$renewaldate3','$fromjobdate1','$fromjobdate2','$fromjobdate3','$fromjobdate4','$tojobdate1','$tojobdate2','$tojobdate3','$tojobdate4','$employer1','$employer2','$employer3','$employer4','$position1','$position2','$position3','$position4','$grade1','$grade2','$grade3','$grade4','$currentduties','$skills',
'$refference1','$refference2','$refference3','$refferenceaddress1','$refferenceaddress2','$refferenceaddress3','$refferencetel1','$refferencetel2','$refferencetel3','$refferenceemail1','$refferenceemail2','$refferenceemail3','$refferenceoccupation1','$refferenceoccupation2','$refferenceoccupation3','$refferenceperiod1','$refferenceperiod2','$refferenceperiod3',now())";
 mysqli_query($connect,$x)or die(mysqli_error($connect));  
/////////////////////
 mkdir('upload/'.$jobrefference.'/'.$idnumber); 
 ///////////////
 copy("upload/index.php",'upload/'.$jobrefference.'/'.$idnumber.'/index.php');
 ///////////////
$newname='IDCOPY';
$newPath ='upload/'.$jobrefference."/".$idnumber."/" . basename($_FILES['file']['name']);
$path = $_FILES['file']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($extension =='pdf')
{
move_uploaded_file($_FILES['file']['tmp_name'], $newPath);
rename("upload/".$jobrefference."/".$idnumber."/".$path.""   ,    "upload/".$jobrefference."/".$idnumber."/".$newname.".".$extension."");
}
 ////////////////   
 $newname=$level1."1";
$newPath ='upload/'.$jobrefference."/".$idnumber."/" . basename($_FILES['academicfile1']['name']);
$path = $_FILES['academicfile1']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($extension =='pdf')
{
move_uploaded_file($_FILES['academicfile1']['tmp_name'], $newPath);
rename("upload/".$jobrefference."/".$idnumber."/".$path.""   ,    "upload/".$jobrefference."/".$idnumber."/".$newname.".".$extension."");
}
///////////////// 
////////////////   
 $newname=$level2."2";
$newPath ='upload/'.$jobrefference."/".$idnumber."/" . basename($_FILES['academicfile2']['name']);
$path = $_FILES['academicfile2']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($extension =='pdf')
{
move_uploaded_file($_FILES['academicfile2']['tmp_name'], $newPath);
rename("upload/".$jobrefference."/".$idnumber."/".$path.""   ,    "upload/".$jobrefference."/".$idnumber."/".$newname.".".$extension."");
}
////////////
 $newname=$level3."3";
$newPath ='upload/'.$jobrefference."/".$idnumber."/" . basename($_FILES['academicfile3']['name']);
$path = $_FILES['academicfile3']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($extension =='pdf')
{
move_uploaded_file($_FILES['academicfile3']['tmp_name'], $newPath);
rename("upload/".$jobrefference."/".$idnumber."/".$path.""   ,    "upload/".$jobrefference."/".$idnumber."/".$newname.".".$extension."");
}
//////////// 
 $newname=$level4."4";
$newPath ='upload/'.$jobrefference."/".$idnumber."/" . basename($_FILES['academicfile4']['name']);
$path = $_FILES['academicfile4']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($extension =='pdf')
{
move_uploaded_file($_FILES['academicfile4']['tmp_name'], $newPath);
rename("upload/".$jobrefference."/".$idnumber."/".$path.""   ,    "upload/".$jobrefference."/".$idnumber."/".$newname.".".$extension."");
}
////////////

 $newname=$shortcourse1;
$newPath ='upload/'.$jobrefference."/".$idnumber."/" . basename($_FILES['shortcoursefile1']['name']);
$path = $_FILES['shortcoursefile1']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($extension =='pdf')
{
move_uploaded_file($_FILES['shortcoursefile1']['tmp_name'], $newPath);
rename("upload/".$jobrefference."/".$idnumber."/".$path.""   ,    "upload/".$jobrefference."/".$idnumber."/".$newname.".".$extension."");
}
////////////

$newname=$shortcourse2;
$newPath ='upload/'.$jobrefference."/".$idnumber."/" . basename($_FILES['shortcoursefile2']['name']);
$path = $_FILES['shortcoursefile2']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($extension =='pdf')
{
move_uploaded_file($_FILES['shortcoursefile2']['tmp_name'], $newPath);
rename("upload/".$jobrefference."/".$idnumber."/".$path.""   ,    "upload/".$jobrefference."/".$idnumber."/".$newname.".".$extension."");
}
////////////


$newname=$shortcourse3;
$newPath ='upload/'.$jobrefference."/".$idnumber."/" . basename($_FILES['shortcoursefile3']['name']);
$path = $_FILES['shortcoursefile3']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($extension =='pdf')
{
move_uploaded_file($_FILES['shortcoursefile3']['tmp_name'], $newPath);
rename("upload/".$jobrefference."/".$idnumber."/".$path.""   ,    "upload/".$jobrefference."/".$idnumber."/".$newname.".".$extension."");
}
////////////


print  '<div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">APPLIED SUCCESSFUILLY  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button><hr></h2>
  </div></div></div>
  </div> ';  include_once("index.php");exit;
?>
