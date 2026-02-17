<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW RECIEPTS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED";exit;}
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
  <div style="text-align:center;"> 
   <button class="btn-info btn-sm" onclick="window.print()">PRINT</button><br />
   </div>
  
<?php
@$action=$_POST['action'];
$del=$_POST['del'];



foreach($del as $id)
{
  if($id <1){unset($del[$id]);}
}

if($action=="REVERSE")
{


/*$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'REVERSE RECIEPTS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS DENIED";exit;}*/


	
foreach($del as $id)
{
	
$x="SELECT transaction,code,account,credit FROM $wateraccountstable   WHERE id=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{ while ($y=@mysqli_fetch_array($x)){ $acc=$y['account'];$amnt=$y['credit'];$reff=$y['transaction'];$code=$y['code'];}}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'REVERSED RECIEPT NUMBER .$id',DATE_ADD(NOW(), INTERVAL 7 HOUR))";mysqli_query($connect,$x)or die(mysqli_error($connect));
}


foreach($del as $id)
{
    $rcpt=sprintf("%07d", $id);
$x="UPDATE  $wateraccountstable  SET RECIEPTNUMBER = NULL ,RECIEPTDATE =NULL,STATUS=NULL  WHERE RECIEPTNUMBER='$id'";mysqli_query($connect,$x)or die(mysqli_error($connect));

}
$_SESSION['message']="RECIEPTS  REVERSED ";

}

else if($action =='PRINT')
{

//////////////

foreach($del as $id)
{
		
$_SESSION['recieptnumber']=$id;	
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'PRINTED RECIEPT NUMBER .$id',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
include("backup/printreciept2.php");
}
///////////////////	

}

 

?>
