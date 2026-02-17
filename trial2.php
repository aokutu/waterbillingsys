<?php
@session_start(); 
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'      AND  ACCESS  REGEXP  'ADMINISTRATOR' OR   name='$user' AND password='$password'      AND  ACCESS  REGEXP  'USER'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED";exit;}
$id=$_SESSION['id'];
?><html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title >L.C.P.S.B</title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<style type="text/css">
			 .heading{ background-color:#ADD8E6; border-style:double; border-radius:3%; text-align:left;}
			 body{ font-size:98%;margin-left:4%; margin-right:1%; }					 


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
<body  >
 
 <h4   style="text-align:center"><STRONG>APPLICANTS  INVENTORY </STRONG></h4>
 <div id="applicantforms">
<?php 

foreach($id as $identity )
{

$x="SELECT * FROM  jobapplications  WHERE id=$identity  ORDER  BY firstname ASC ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  $idnumber=$y['idnumber']; $reffnumber=$y['reffnumber'];$title=$y['title']; $surname=$y['surname']; $firstname=$y['firstname']; $othername=$y['othername'];}}
print '<ul class="list-inline">'.$title.'&nbsp;&nbsp;'.$firstname.'&nbsp;&nbsp;'.$surname.'&nbsp;&nbsp;'.$othername;
$files = scandir('upload/'.$reffnumber.'/'.$idnumber.'');
foreach ($files as  $key => $file)
{
$string =$file; 
$needle = '.pdf'; 
$x=strstr($string, $needle); 
if($x !=null){ echo ' <li><a href="upload/'.$reffnumber.'/'.$idnumber.'/'.$string.'" download>'.$string.'</a></li>';}	
}

print '</ul><hr>';	
}


?></body>