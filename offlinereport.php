<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$account1=$_POST['account1'];
@$account2=$_POST['account2']; 
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BILLING'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$v=rand(0,1000);
$manifest='offlinereport.manifest';
 $myFile = fopen($manifest, "w");
 fputs($myFile,'CACHE MANIFEST
#cache version:'.$v.'
CACHE:
offline.php
offlinereport2.php
NETWORK
*
FALLBACK:
/ offline.html' ); 
$file = "offlinereport2.php"; 
 $myFile = fopen($file, "w");
 //////////////
fputs($myFile, '<html  manifest="offlinereport.manifest" > <head>
 <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style type="text/css">
table {border-spacing: 2%; background-color:#00FF7F;border-color:#00008B}
thead{ background-color:#87CEFA;}
tbody{background-color:#F0F8FF}
table{
width: 100%;
 height:500px;              // <-- Select the height of the table
 display: -moz-groupbox;    // Firefox Bad Effect
}
tbody{
  overflow-y: scroll;      
  height: 480px;            //  <-- Select the height of the body
  
  position: absolute;
}
</style>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
');

 
 /////////////////
 fputs($myFile, '

 <table border="4"> <thead>
 <tr>
 <td width="20%">ACCOUNT</td>
<td  width="20%" >METER  NUMBER</td>
<td  width="30%">CLIENT  <form action="offlinereportrefresh.php" method="post"  >

<input type="submit" class="btn"  value="REFFRESH"  />  
</form></td>
 <td width="20%" >STATUS</td>
 <td width="10%">LAST READINGS</td>
 
 </tr>
 </thead>
 
 <tbody>');
	
$x="SELECT account,meternumber,client,class,location,status,email,size,avgunit,date2  FROM $accountstable  WHERE STATUS='CONNECTED'   AND account >='$account1' AND  account <='$account2' ORDER BY account,meternumber ASC";
  		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=mysqli_fetch_array($x))
		{ //foreach($y as $z){//print $z;//	fputs($myFile, $z."\n"); }
	fputs($myFile, "<tr   class='filterdata'  >
	<td  width='20%'>".$y[0]."</td>
	<td width='20%'>".$y[1]."</td>
	<td  width='30%'>".$y[2]."</td>
	<td  width='20%' >".$y[5]."</td>
	<td width='10%' >".$y[6]."</td>");
	}

	fputs($myFile,'</tr></tbody></table>
	</html>');  
	}
	
	$_SESSION['message']="SUBMITTED";  header("LOCATION:offline.php");exit;	
	
 
?>
