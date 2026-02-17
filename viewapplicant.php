<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'ADMINISTRATOR' OR   name='$user' AND password='$password'      AND  ACCESS  REGEXP  'USER'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysql_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
$id=$_SESSION['id'];
$x="SELECT * FROM jobapplications WHERE id=$id  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysql_num_rows($x)>0)
		{
while ($y=@mysqli_fetch_array($x))
{
$birth=$y['birthdate'];	
	  $current=date("Y-m-d");  $birth=strtotime($birth); $current=strtotime($current); $age=round(($current-$birth)/31536000,0);
$vacancy=$y['vacancy'];$reffnumber=$y['reffnumber'];$department=$y['department'];$section=$y['section'];$title=$y['title'];$surname=$y['surname'];$firstname=$y['firstname'];$othername=$y['othername'];$birthdate=$y['birthdate'];$gender=$y['gender'];$ethnic=$y['ethnic'];$subtribe=$y['subtribe'];$nationality=$y['nationality'];$idnumber=$y['idnumber'];$kranumber=$y['kranumber'];$address=$y['address'];$postalcode=$y['postalcode'];$disabilitydetail=$y['disabilitydetail'];$disability=$y['disability'];
$homecounty=$y['homecounty'];$subcounty=$y['subcounty'];$constituency=$y['constituency'];$mobile=$y['mobile'];$email=$y['email'];$contactperson=$y['contactperson'];$contactpersonmobile=$y['contactpersonmobile'];$department2=$y['department2'];$section2=$y['section2'];$currentpublicpost=$y['currentpublicpost'];$currentpublicjobgroup=$y['currentpublicjobgroup'];$publicjobemploymentdate=$y['publicjobemploymentdate'];$upgradingpublicjobpost=$y['upgradingpublicjobpost'];$upgradingeffectivedate=$y['upgradingeffectivedate'];$termsofpublicjob=$y['termsofpublicjob'];$currentprivatejob=$y['currentprivatejob'];$currentprivateemployer=$y['currentprivateemployer'];
$privatejobsalary=$y['privatejobsalary'];$privateemployeddate=$y['privateemployeddate'];$languages=$y['languages'];$physicalimpairment=$y['physicalimpairment'];$physicalimpairmentdetails=$y['physicalimpairmentdetails'];$convicted=$y['convicted'];$dismissed=$y['dismissed'];$dismissaldate=$y['dismissaldate'];$dismissalreason=$y['dismissalreason'];$everinterviewed=$y['everinterviewed'];$interviewedpost=$y['interviewedpost'];$intervieweddate=$y['intervieweddate'];$academicstartdate1=$y['academicstartdate1'];$academicstartdate2=$y['academicstartdate2'];$academicstartdate3=$y['academicstartdate3'];$academicstartdate4=$y['academicstartdate4'];$academicfinishdate1=$y['academicfinishdate1'];$academicfinishdate2=$y['academicfinishdate2'];
$academicfinishdate3=$y['academicfinishdate3'];$academicfinishdate4=$y['academicfinishdate4'];$institution1=$y['institution1'];$institution2=$y['institution2'];$institution3=$y['institution3'];$institution4=$y['institution4'];$level1=$y['level1'];$level2=$y['level2'];$level3=$y['level3'];$level4=$y['level4'];$course1=$y['course1'];$course2=$y['course2'];$course3=$y['course3'];$course4=$y['course4'];$subject1=$y['subject1'];$subject2=$y['subject2'];$subject3=$y['subject3'];
$subject4=$y['subject4'];$class1=$y['class1'];$class2=$y['class2'];$class3=$y['class3'];$class4=$y['class4'];$shortcoursedate1=$y['shortcoursedate1'];$shortcoursedate2=$y['shortcoursedate2'];$shortcoursedate3=$y['shortcoursedate3'];$shortcoursedate4=$y['shortcoursedate4'];$shortcourseinstitution1=$y['shortcourseinstitution1'];$shortcourseinstitution2=$y['shortcourseinstitution2'];$shortcourseinstitution3=$y['shortcourseinstitution3'];$shortcourseinstitution4=$y['shortcourseinstitution4'];$shortcourse1=$y['shortcourse1'];$shortcourse2=$y['shortcourse2'];$shortcourse3=$y['shortcourse3'];$shortcourse4=$y['shortcourse4'];
$shortcoursedetails1=$y['shortcoursedetails1'];$shortcoursedetails2=$y['shortcoursedetails2'];$shortcoursedetails3=$y['shortcoursedetails3'];$shortcoursedetails4=$y['shortcoursedetails4'];$proffessionalbody1=$y['proffessionalbody1'];$proffessionalbody2=$y['proffessionalbody2'];$proffessionalbody3=$y['proffessionalbody3'];$membershipnumber1=$y['membershipnumber1'];$membershipnumber2=$y['membershipnumber2'];$membershipnumber3=$y['membershipnumber3'];$membertype1=$y['membertype1'];$membertype2=$y['membertype2'];$membertype3=$y['membertype3'];$renewaldate1=$y['renewaldate1'];$renewaldate2=$y['renewaldate2'];$renewaldate3=$y['renewaldate3'];$fromjobdate1=$y['fromjobdate1'];
$fromjobdate2=$y['fromjobdate2'];$fromjobdate3=$y['fromjobdate3'];$fromjobdate4=$y['fromjobdate4'];$tojobdate1=$y['tojobdate1'];$tojobdate2=$y['tojobdate2'];$tojobdate3=$y['tojobdate3'];$tojobdate4=$y['tojobdate4'];$employer1=$y['employer1'];$employer2=$y['employer2'];$employer3=$y['employer3'];$employer4=$y['employer4'];$position1=$y['position1'];$position2=$y['position2'];$position3=$y['position3'];$position4=$y['position4'];$grade1=$y['grade1'];$grade2=$y['grade2'];
$grade3=$y['grade3'];$grade4=$y['grade4'];$currentduties=$y['currentduties'];$skills=$y['skills'];$refference1=$y['refference1'];$refference2=$y['refference2'];$refference3=$y['refference3'];$refferenceaddress1=$y['refferenceaddress1'];$refferenceaddress2=$y['refferenceaddress2'];$refferenceaddress3=$y['refferenceaddress3'];$refferencetel1=$y['refferencetel1'];$refferencetel2=$y['refferencetel2'];$refferencetel3=$y['refferencetel3'];$refferenceemail1=$y['refferenceemail1'];$refferenceemail2=$y['refferenceemail2'];$refferenceemail3=$y['refferenceemail3'];$refferenceoccupation1=$y['refferenceoccupation1'];
$refferenceoccupation2=$y['refferenceoccupation2'];$refferenceoccupation3=$y['refferenceoccupation3'];$refferenceperiod1=$y['refferenceperiod1'];$refferenceperiod2=$y['refferenceperiod2'];$refferenceperiod3=$y['refferenceperiod3'];$date=$y['date'];

$current=date("Y-m-d");  $birth=strtotime($birth); $current=strtotime($current); $age=round(($current-$birth)/31536000,0);
	  $fromjobdatex1=$y['fromjobdate1'];$tojobdatex1=$y['tojobdate1']; $fromjobdatex1=strtotime($fromjobdatex1); $tojobdatex1=strtotime($tojobdatex1);$experiece1=round(($tojobdatex1-$fromjobdatex1)/31536000,0);
	  $fromjobdatex2=$y['fromjobdate2'];$tojobdatex2=$y['tojobdate2']; $fromjobdatex2=strtotime($fromjobdatex2); $tojobdatex2=strtotime($tojobdatex2);$experiece2=round(($tojobdatex2-$fromjobdatex2)/31536000,0);
	  $fromjobdatex3=$y['fromjobdate3'];$tojobdatex3=$y['tojobdate3']; $fromjobdatex3=strtotime($fromjobdatex3); $tojobdatex3=strtotime($tojobdatex3);$experiece3=round(($tojobdatex3-$fromjobdatex3)/31536000,0);
	  $fromjobdatex4=$y['fromjobdate4'];$tojobdatex4=$y['tojobdate4']; $fromjobdatex4=strtotime($fromjobdatex4); $tojobdatex4=strtotime($tojobdatex4);$experiece4=round(($tojobdatex4-$fromjobdatex4)/31536000,0);
	  $experiece=$experiece1+$experiece2+$experiece3+$experiece4;  
  }}
?>
<!doctype html>
<html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title ><?php echo $reffnumber.$idnumber; ?></title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<style type="text/css">
			 .heading{ background-color:#ADD8E6; border-style:double; border-radius:3%; text-align:left;}
			 body{ font-size:98%;}  tr:hover{ background-color: #CCCCCC; cursor:pointer; color:#0000FF;}
			 tr >td:hover{ background-color: #B0C4DE; cursor:pointer; color:#0000FF;}
			 .bold{ font-weight: bolder;}

			</style>
	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
  
	<SCRIPT type="text/javascript">

    window.history.forward();

    function noBack() { window.history.forward(); }

</SCRIPT>
<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>
</head>
<body   >

<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">

<form > 
<div class="bold">APPLIED JOB DETAILS</div>
<table class="table table-bordered" >
<tr>
            <td    height="21" valign="top" ><div class="bold">VACANCY</div>	  </td>
			 <td    height="21" valign="top" ><?php echo $vacancy;?></td> 
			 <td    height="21" valign="top" ><div class="bold">REFF NO.</div></td>            
			  <td   valign="top"><?php echo $reffnumber;?></td>
			  <td    height="21" valign="top" ><div class="bold">DEPARTMENT</div></td>            
			  <td   valign="top"><?php echo $department;?></td> 
			  <td    height="21" valign="top" ><div class="bold">SECTION</div></td>            
			  <td   valign="top"><?php echo $section;?></td> 
          </tr> 
		  </table>
		  <div class="bold">PERSONAL DETAILS</div>
 <table class="table table-bordered" >
 
		  <tr>
            <td    height="21" valign="top" ><div class="bold">ID/PP NO	</div>  </td>
			 <td    height="21" valign="top" ><?php echo $idnumber;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TITLE</div></td>            
			  <td   valign="top"><?php echo $title;?></td>
			  
			 <td    height="21" valign="top" ><div class="bold">SURNAME.</div></td>            
			  <td   valign="top"><?php echo $surname;?></td>
			  <td    height="21" valign="top" ><div class="bold">FIRST NAME</div></td>            
			  <td   valign="top"><?php echo $firstname;?></td> 
			  <td    height="21" valign="top" ><div class="bold">OTHER NAME</div></td>            
			  <td   valign="top"><?php echo $othername;?></td> 
			   
          </tr>
		   <tr>
		   
            <td    height="21" valign="top" ><div class="bold">GENDER </div> </td>
			 <td    height="21" valign="top" ><?php echo $gender;?></td> 
			 <td    height="21" valign="top" ><div class="bold">AGE</div></td>            
			  <td   valign="top"><?php echo $age;?></td>
			  <td    height="21" valign="top" ><div class="bold">D.O.B</div></td>            
			  <td   valign="top"><?php echo $birthdate;?></td>
			  
			  <td    height="21" valign="top" ><div class="bold">NATIONALITY</div></td>            
			  <td   valign="top"><?php echo $nationality;?></td>
			  <td    height="21" valign="top" ><div class="bold">ETHNICITY</div></td>            
			  <td   valign="top"><?php echo $ethnic;?></td>
			  <td    height="21" valign="top" ><div class="bold">SUBTRIBE</div></td>            
			  <td   valign="top"><?php echo $subtribe;?></td>
				  
          </tr>
		   <tr>
            <td    height="21" valign="top" ><div class="bold">K.R.A	</div>  </td>
			 <td    height="21" valign="top" ><?php echo $kranumber;?></td> 
			 <td    height="21" valign="top" ><div class="bold">MOBILE</div></td>            
			  <td   valign="top"><?php echo $mobile;?></td>
			  <td    height="21" valign="top" ><div class="bold">EMAIL</div></td>            
			  <td   valign="top"><?php echo $email;?></td> 
			  <td    height="21" valign="top" ><div class="bold">ADDRESS</div></td>            
			  <td   valign="top"><?php echo $address;?></td>
			  <td    height="21" valign="top" ><div class="bold">POSTAL CODE</div></td>            
			  <td   valign="top"><?php echo $postalcode;?></td> 
			  
          </tr>
		    <tr>
            <td    height="21" valign="top" ><div class="bold">COUNTY	</div>  </td>
			 <td    height="21" valign="top" ><?php echo $homecounty;?></td> 
			 <td    height="21" valign="top" ><div class="bold">SUB COUNTY</div></td>            
			  <td   valign="top"><?php echo $subcounty;?></td>
			  <td    height="21" valign="top" ><div class="bold">CONSTITUENCY</div></td>            
			  <td   valign="top"><?php echo $constituency;?></td> 
			  
          </tr>
		     <tr>
            <td    height="21" valign="top" ><div class="bold">DISABILITY</div>  </td>
			 <td    height="21" valign="top" ><?php echo $disability;?></td> 
			 <td    height="21" valign="top" ><div class="bold">DETAILS</div></td>            
			  <td   valign="top"><?php echo $disabilitydetail;?></td> 
		 </tr>
		 <tr>
            <td    height="21" valign="top" ><div class="bold">ALT CONTACT PERSON</div>	  </td>
			 <td    height="21" valign="top" ><?php echo $contactperson;?></td> 
			 <td    height="21" valign="top" ><div class="bold">MOBILE</div></td>            
			  <td   valign="top"><?php echo $contactpersonmobile;?></td>
			  <td    height="21" valign="top" ><div class="bold">EMAIL</div></td>            
			  <td   valign="top"><?php echo $contactperson;?></td> 
			  
          </tr>
		</table>
	<div class="bold">PUBLIC SERVICE DETAILS
	
	<table  class="table table-bordered"  >
		  <tr>
		   
            <td    height="21" valign="top" ><div class="bold">MIN/INSTITUTION</div>  </td>
			 <td    height="21" valign="top" ><?php echo $department2;?></td> 
			 <td    height="21" valign="top" ><div class="bold">SECTION</div></td>            
			  <td   valign="top"><?php echo $section2;?></td>
			  <td    height="21" valign="top" ><div class="bold">SUBSTATIVE  POST</div></td>            
			  <td   valign="top"><?php echo $currentpublicpost;?></td>
			  
			  <td    height="21" valign="top" ><div class="bold">JOB GROUP</div></td>            
			  <td   valign="top"><?php echo $currentpublicjobgroup;?></td>
			  <td    height="21" valign="top" ><div class="bold">EFFECTIVE  DATE</div></td>            
			  <td   valign="top"><?php echo $publicjobemploymentdate;?></td>
			  <td    height="21" valign="top" ><div class="bold">TERMS OF  SERVICE</div></td>            
			  <td   valign="top"><?php echo $termsofpublicjob;?></td>
				  
          </tr>
		  
		</table>
	<div class="bold">PRIVATE SECTOR DETAILS
	
	<table  class="table table-bordered"  >
		  	   <tr>
            <td    height="21" valign="top" ><div class="bold">CURRENT  EMPLOYER</div>	  </td>
			 <td    height="21" valign="top" ><?php echo $currentprivateemployer;?></td> 
			 <td    height="21" valign="top" ><div class="bold">POSITION </div></td>            
			  <td   valign="top"><?php echo $currentprivatejob;?></td>
			  <td    height="21" valign="top" ><div class="bold">EFFECTIVE DATE</div></td>            
			  <td   valign="top"><?php echo $privateemployeddate;?></td> 
			  <td    height="21" valign="top" ><div class="bold">SALARY (MONTHLY KSH)</div></td>            
			  <td   valign="top"><?php echo $privatejobsalary;?></td>
		 </tr>
		  
		  
		
    </table>
	EMPLOYMENT DETAILS
	<table  class="table table-bordered"  >
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FROM	</div>  </td>
			 <td    height="21" valign="top" ><?php echo $fromjobdate1;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TO</div></td>            
			  <td   valign="top"><?php echo $tojobdate1;?></td>
			  <td    height="21" valign="top" ><div class="bold">MIN/ORGANIZATION</div></td>            
			  <td   valign="top"><?php echo $employer1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">DESIGNATION</div></td>            
			  <td   valign="top"><?php echo $position1;?></td>
			  <td    height="21" valign="top" ><div class="bold">JOB GROUP /SALARY SCALE</div></td>            
			  <td   valign="top"><?php echo $grade1;?></td> 
			  
          </tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FROM	</div>  </td>
			 <td    height="21" valign="top" ><?php echo $fromjobdate2;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TO</div></td>            
			  <td   valign="top"><?php echo $tojobdate2;?></td>
			  <td    height="21" valign="top" ><div class="bold">MIN/ORGANIZATION</div></td>            
			  <td   valign="top"><?php echo $employer2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">DESIGNATION</div></td>            
			  <td   valign="top"><?php echo $position2;?></td>
			  <td    height="21" valign="top" ><div class="bold">JOB GROUP /SALARY SCALE</div></td>            
			  <td   valign="top"><?php echo $grade2;?></td> 
			  
          </tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FROM	</div>  </td>
			 <td    height="21" valign="top" ><?php echo $fromjobdate3;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TO</div></td>            
			  <td   valign="top"><?php echo $tojobdate3;?></td>
			  <td    height="21" valign="top" ><div class="bold">MIN/ORGANIZATION</div></td>            
			  <td   valign="top"><?php echo $employer3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">DESIGNATION</div></td>            
			  <td   valign="top"><?php echo $position3;?></td>
			  <td    height="21" valign="top" ><div class="bold">JOB GROUP /SALARY SCALE</div></td>            
			  <td   valign="top"><?php echo $grade3;?></td> 
			  
          </tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FROM	 </div> </td>
			 <td    height="21" valign="top" ><?php echo $fromjobdate4;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TO</div></td>            
			  <td   valign="top"><?php echo $tojobdate4;?></td>
			  <td    height="21" valign="top" ><div class="bold">MIN/ORGANIZATION</div></td>            
			  <td   valign="top"><?php echo $employer4;?></td> 
			  <td    height="21" valign="top" ><div class="bold">DESIGNATION</div></td>            
			  <td   valign="top"><?php echo $position4;?></td>
			  <td    height="21" valign="top" ><div class="bold">JOB GROUP /SALARY SCALE</div></td>            
			  <td   valign="top"><?php echo $grade4;?></td> 
			  
          </tr>
		  
		  
	</div>
	</table>
	<div class="bold">ACADEMIC/PROFFESSIOAL/TECHNICAL QUALIFICATIONS </div>
	<table  class="table table-bordered"  >
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FROM</div>	  </td>
			 <td    height="21" valign="top" ><?php echo $academicstartdate1;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TO</div></td>            
			  <td   valign="top"><?php echo $academicfinishdate1;?></td>
			  <td    height="21" valign="top" ><div class="bold">INSTITUTION</div></td>            
			  <td   valign="top"><?php echo $employer1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">AWARD</div></td>            
			  <td   valign="top"><?php echo $level1;?></td>
			  <td    height="21" valign="top" ><div class="bold">COURSE</div></td>            
			  <td   valign="top"><?php echo $course1;?></td> 
			  <td    height="21" valign="top"> <div class="bold">SUBJECT</div></td>            
			  <td   valign="top"><?php echo $subject1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">CLASS/ GRADE</div></td>            
			  <td   valign="top"><?php echo $class1;?></td>
			  
          </tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FROM</div>	  </td>
			 <td    height="21" valign="top" ><?php echo $academicstartdate2;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TO</div></td>            
			  <td   valign="top"><?php echo $academicfinishdate2;?></td>
			  <td    height="21" valign="top" ><div class="bold">INSTITUTION</div></td>            
			  <td   valign="top"><?php echo $employer2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">AWARD</div></td>            
			  <td   valign="top"><?php echo $level2;?></td>
			  <td    height="21" valign="top" ><div class="bold">COURSE</div></td>            
			  <td   valign="top"><?php echo $course2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">SUBJECT</div></td>            
			  <td   valign="top"><?php echo $subject2;?></td>
				<td    height="21" valign="top" ><div class="bold">CLASS/ GRADE</div></td>            
			  <td   valign="top"><?php echo $class2;?></td>			  
			  
          </tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FROM	  </td>
			 <td    height="21" valign="top" ><?php echo $academicstartdate3;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TO</td>            
			  <td   valign="top"><?php echo $academicfinishdate3;?></td>
			  <td    height="21" valign="top" ><div class="bold">INSTITUTION</td>            
			  <td   valign="top"><?php echo $employer3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">AWARD</td>            
			  <td   valign="top"><?php echo $level3;?></td>
			  <td    height="21" valign="top" ><div class="bold">COURSE</td>            
			  <td   valign="top"><?php echo $course3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">SUBJECT</td>            
			  <td   valign="top"><?php echo $subject3;?></td>
<td    height="21" valign="top" ><div class="bold">CLASS/ GRADE</td>            
			  <td   valign="top"><?php echo $class3;?></td>			  
			  
          </tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FROM	  </td>
			 <td    height="21" valign="top" ><?php echo $academicstartdate4;?></td> 
			 <td    height="21" valign="top" ><div class="bold">TO</td>            
			  <td   valign="top"><?php echo $academicfinishdate4;?></td>
			  <td    height="21" valign="top" ><div class="bold">INSTITUTION</td>            
			  <td   valign="top"><?php echo $employer4;?></td> 
			  <td    height="21" valign="top" ><div class="bold">AWARD</td>            
			  <td   valign="top"><?php echo $level4;?></td>
			  <td    height="21" valign="top" ><div class="bold">COURSE</td>            
			  <td   valign="top"><?php echo $course4;?></td> 
			  <td    height="21" valign="top" ><div class="bold">SUBJECT</td>            
			  <td   valign="top"><?php echo $subject4;?></td> 
			  <td    height="21" valign="top" ><div class="bold">CLASS/ GRADE</td>            
			  <td   valign="top"><?php echo $class3;?></td>
			  
          </tr>
		  
		  
	</div>
	</table>
	OTHER  SHORT COURSES 
	<table  class="table table-bordered"  >
		  <tr>
            <td    height="21" valign="top" ><div class="bold">YEAR	  </td>
			 <td    height="21" valign="top" ><?php echo $shortcoursedate1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">INSTITUTION</td>            
			  <td   valign="top"><?php echo $shortcourseinstitution1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">COURSE</td>            
			  <td   valign="top"><?php echo $shortcourse1;?></td>
			  <td    height="21" valign="top" ><div class="bold">DETAILS</td>            
			  <td   valign="top"><?php echo $shortcoursedetails1;?></td> 
			  
			  
          </tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">YEAR	  </td>
			 <td    height="21" valign="top" ><?php echo $shortcoursedate2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">INSTITUTION</td>            
			  <td   valign="top"><?php echo $shortcourseinstitution2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">COURSE</td>            
			  <td   valign="top"><?php echo $shortcourse2;?></td>
			  <td    height="21" valign="top" ><div class="bold">DETAILS</td>            
			  <td   valign="top"><?php echo $shortcoursedetails2;?></td> 
			  	  
			  
          </tr>
		  <tr>
           <td    height="21" valign="top" ><div class="bold">YEAR	  </td>
			 <td    height="21" valign="top" ><?php echo $shortcoursedate3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">INSTITUTION</td>            
			  <td   valign="top"><?php echo $shortcourseinstitution3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">COURSE</div></td>            
			  <td   valign="top"><?php echo $shortcourse3;?></td>
			  <td    height="21" valign="top" ><div class="bold">DETAILS</div> </td>            
			  <td   valign="top"><?php echo $shortcoursedetails3;?></td> 
			  		  
			  
          </tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">YEAR	 </div> </td>
			 <td    height="21" valign="top" ><?php echo $shortcoursedate4;?></td> 
			  <td    height="21" valign="top" ><div class="bold">INSTITUTION</div></td>            
			  <td   valign="top"><?php echo $shortcourseinstitution4;?></td> 
			  <td    height="21" valign="top" ><div class="bold">COURSE</div></td>            
			  <td   valign="top"><?php echo $shortcourse4;?></td>
			  <td    height="21" valign="top" ><div class="bold">DETAILS</div></td>            
			  <td   valign="top"><?php echo $shortcoursedetails4;?></td> 
			  
			  
          </tr>
	</table>
	<div class="bold">PROFFESSIOAL BODY   MEMBERSHIP</div>	
	<table  class="table table-bordered"  >
		  <tr>
            <td    height="21" valign="top" ><div class="bold">PROFFESSIOAL BODY</div>		  </td>
			 <td    height="21" valign="top" ><?php echo $proffessionalbody1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">MEMBERSHIP NO</div>	 </td>            
			  <td   valign="top"><?php echo $membershipnumber1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">MEMBER TYPE</div>	</td>            
			  <td   valign="top"><?php echo $membertype1;?></td>
			  <td    height="21" valign="top" ><div class="bold">RENEWAL DATE</div>	</td>            
			  <td   valign="top"><?php echo $renewaldate1;?></td> 
		</tr>
		  <tr>
            <td    height="21" valign="top" ><div class="bold">PROFFESSIOAL BODY</div>		  </td>
			 <td    height="21" valign="top" ><?php echo $proffessionalbody2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">MEMBERSHIP NO</div>	 </td>            
			  <td   valign="top"><?php echo $membershipnumber2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">MEMBER TYPE</div>	</td>            
			  <td   valign="top"><?php echo $membertype2;?></td>
			  <td    height="21" valign="top" ><div class="bold">RENEWAL DATE</div>	</td>            
			  <td   valign="top"><?php echo $renewaldate2;?></td> 
		</tr>
		   <tr>
            <td    height="21" valign="top" ><div class="bold">PROFFESSIOAL BODY</div>		  </td>
			 <td    height="21" valign="top" ><?php echo $proffessionalbody3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">MEMBERSHIP NO</div>	 </td>            
			  <td   valign="top"><?php echo $membershipnumber3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">MEMBER TYPE</div>	</td>            
			  <td   valign="top"><?php echo $membertype3;?></td>
			  <td    height="21" valign="top" ><div class="bold">RENEWAL DATE</div>	</td>            
			  <td   valign="top"><?php echo $renewaldate3;?></td> 
		</tr>
		  		  
	</div>
	</table>
	<div class="bold">REFEREES  DETAILS
	
	<table  class="table table-bordered"  >
		  <tr>
            <td    height="21" valign="top" ><div class="bold">FULL NAMES	</div>	  </td>
			 <td    height="21" valign="top" ><?php echo $refference1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">ADDRESS</div>	  </td>            
			  <td   valign="top"><?php echo $refferenceaddress1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">TEL NO</div>	</td>            
			  <td   valign="top"><?php echo $refferencetel1;?></td>
			  <td    height="21" valign="top" ><div class="bold">EMAIL</div>	</td>            
			  <td   valign="top"><?php echo $refferenceemail1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">OCCUPATION</div>	</td>            
			  <td   valign="top"><?php echo $refferenceoccupation1;?></td> 
			  <td    height="21" valign="top" ><div class="bold">KNOWING PERIOD</div>	</td>            
			  <td   valign="top"><?php echo $refferenceperiod1;?></td> 
		</tr>
		<tr>
            <td    height="21" valign="top" ><div class="bold">FULL NAMES</div>		  </td>
			 <td    height="21" valign="top" ><?php echo $refference2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">ADDRESS</div>	  </td>            
			  <td   valign="top"><?php echo $refferenceaddress2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">TEL NO</div>	</td>            
			  <td   valign="top"><?php echo $refferencetel2;?></td>
			  <td    height="21" valign="top" ><div class="bold">EMAIL</div>	</td>            
			  <td   valign="top"><?php echo $refferenceemail2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">OCCUPATION</div>	</td>            
			  <td   valign="top"><?php echo $refferenceoccupation2;?></td> 
			  <td    height="21" valign="top" ><div class="bold">KNOWING PERIOD</div>	</td>            
			  <td   valign="top"><?php echo $refferenceperiod2;?></td> 
		</tr>
		<tr>
            <td    height="21" valign="top" ><div class="bold">FULL NAMES</div>		  </td>
			 <td    height="21" valign="top" ><?php echo $refference3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">ADDRESS</div>	  </td>            
			  <td   valign="top"><?php echo $refferenceaddress3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">TEL NO</div>	</td>            
			  <td   valign="top"><?php echo $refferencetel3;?></td>
			  <td    height="21" valign="top" ><div class="bold">EMAIL</div>	</td>            
			  <td   valign="top"><?php echo $refferenceemail3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">OCCUPATION</div>	</td>            
			  <td   valign="top"><?php echo $refferenceoccupation3;?></td> 
			  <td    height="21" valign="top" ><div class="bold">KNOWING PERIOD</div>	</td>            
			  <td   valign="top"><?php echo $refferenceperiod3;?></td> 
		</tr>
		 
		  		  
	</div>
	</table>
	<table  class="table table-bordered"  >
		  <tr>
            <td    height="21" valign="top" ><div class="bold">CURRENT DUTIES  &  RESPONCIBILITIES	</div>	<br><?php echo $currentduties;?>  </td>
			 <td    height="21" valign="top" ><div class="bold">ABILITIES ,SKILLS AND EXPERINCE ACQUIRED   YEARS OF  EXPERIENCE  IN   <?php echo $experiece;?>YRS </div>	 <br><?php echo $skills;?>  </td> </table>
		<div class="bold">DOWNLOAD FILES </div>	 
			 
			 <table  class="table table-bordered"  >
		  <tr>
			 <td    height="21" valign="top" >
			 <ul class="list-inline"> 
<?php




$files = scandir('upload/'.$reffnumber.'/'.$idnumber.'');
foreach ($files as  $key => $file)
{
$string =$file; 
$needle = '.pdf'; 
$x=strstr($string, $needle); 
if($x !=null){ echo ' <li><a href="upload/'.$reffnumber.'/'.$idnumber.'/'.$string.'" download>'.$string.'</a></li>';}	
}
?> 
</ul>  </td> </table>
			 
			 

<button class="btn-info btn-sm" onClick="window.print()">PRINT</button>
	
</form>
<hr>

</body>
</html>