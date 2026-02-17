<?php 
@session_start(); 
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
@$depositdate1=$_SESSION['depositdate1'];@$depositdate2=$_SESSION['depositdate2'];
if($depositdate1 == NULL ){$depositdate1=date('Y-m-d');}

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'ADD RECIEPTS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
  else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
  
 @$payid=addslashes($_POST['payid']);@$recieptnumber=addslashes($_POST['recieptnumber']);@$recieptdate=$_POST['recieptdate'];
 
	///////////////////////
  $maxreciepts=array();

  $a="SELECT  CONCAT('wateraccounts',NUMBER) AS WTBLX FROM zones; ";
	$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
		if(mysqli_num_rows($a)>0)
		{
		
		 while ($c=@mysqli_fetch_array($a))
		{

      $x="SELECT MAX(RECIEPTNUMBER) FROM ".$c['WTBLX']." ";
      $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
      if(mysqli_num_rows($x)>0)
      {
      
       while ($y=@mysqli_fetch_array($x))
      {  array_push($maxreciepts,$y['MAX(RECIEPTNUMBER)']);  }}


    }}


  

 $recieptnumberx =max($maxreciepts);  $recieptnumberx= sprintf("%07d", $recieptnumberx);

 ////////////////////////
 
$x="SELECT * FROM $wateraccountstable WHERE  CONCAT(transaction,depositdate)='$payid'  AND  STATUS !='RECIEPTED'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1)
{
$_SESSION['message']="RECIEPT MISSING"; //header("LOCATION:accessdenied4.php");
exit;	
}

$x="UPDATE $wateraccountstable  SET RECIEPTNUMBER=(SELECT LASTNUMBER+1 FROM lastrecieptnumber ) ,DATE='$recieptdate',STATUS='RECIEPTED' WHERE CONCAT(transaction,depositdate)='$payid'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT LASTNUMBER+1 AS RCPT  FROM lastrecieptnumber ";
      $x=mysqli_query($connect,$x)or die(mysqli_error($connect));
      if(mysqli_num_rows($x)>0)
      {
      
       while ($y=@mysqli_fetch_array($x))
      {
	$recieptnumber=sprintf("%07d", $y['RCPT']);	  
	  }}

$x="UPDATE lastrecieptnumber  TU, lastrecieptnumber TS  SET TU.LASTNUMBER=TS.LASTNUMBER+1 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
/////OLD CODE  OF  MANUALLY   ENTER  RECIEPTNUMBER
//$x="UPDATE $wateraccountstable  SET RECIEPTNUMBER='$recieptnumber' ,RECIEPTDATE='$recieptdate',STATUS='RECIEPTED' WHERE CONCAT(transaction,depositdate)='$payid'";
// mysqli_query($connect,$x)or die(mysqli_error($connect));
  
  $x="INSERT INTO events(user,session,action,date) 
  VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'GENERATED RECIEPT NUMBER $recieptnumber',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
 $_SESSION['payid']=$payid; $_SESSION['recieptnumber']=$recieptnumber;$_SESSION['recieptdate']=$recieptdate;
 
$_SESSION['message']="RECIEPT UPDATED <br> RECEIPT NO. ".$recieptnumber;
?>
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
  </style>
  	<style>
	
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
table{ font-size: 80%;}  #reciept{ font-size: 80%;} 
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
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	

	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
   <div  style="text-align:center;">
   <button class="btn-info btn-sm" onclick="window.print()">PRINTx</button><br />
   </div>
  
  <?php include_once("backup/printreciept.php"); exit;?>
