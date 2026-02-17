<?php 
require_once 'backup/vendor/autoload.php'; // Include Dompdf autoload file
use Dompdf\Dompdf;
use Dompdf\Options;
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
$attendant=strtoupper($user);
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ACCOUNTS REG'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$account=$_SESSION['account'];
$x="SELECT * FROM $accountstable  WHERE account='$account'";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
while ($y=@mysqli_fetch_array($x))
{
$meternumber=$y['meternumber'];$class=$y['class'];$client=$y['client'];$size=$y['size'];$location=$y['location'];$reading=$y['email'];$readingdate=$y['date2'];
$contact=$y['contact'];$status=$y['status'];$idnumber=$y['idnumber'];$avgunit=$y['avgunit']; $email=$y['clientemail'];$connectionnumber=$y['plotnumber'];$deposit=$y['deposit'];
 $long=$y['longitude']; $lattitude=$y['lattitude'];
 
  }}
  
  
  
  $x="SELECT serialnumber FROM $meterstable  WHERE account='$account' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
while ($y=@mysqli_fetch_array($x))
{
$serialnumber=$y['serialnumber'];}}


$path = 'letterhead.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
// Create an instance of Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true); // Enable HTML5 parser
$options->set('isPhpEnabled', true); // Enable PHP code inside the HTML
$dompdf = new Dompdf($options);


$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {font-size:80%; }table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid black; padding: 8px; }
    </style>
</head>
<body>
<img src="'.$base64.'" width="500px" height="150px"/>
<h2 style="text-align:center;">CLIENT BIO DATA</h2>
<table>
    <tr>
    <td width="8%">ACCOUNT</td>
     <td>'.$account.'</td>
      <td width="10%" >NAMES</td>
       <td>'.$client.'</td>
    </tr>
    <tr>
    <td width="8%">ID/PPT</td>
     <td>'.$idnumber.'</td>
      <td width="10%" >CONTACT</td>
       <td>'.$contact.'</td>
    </tr>
    
      <tr>
    <td width="8%">EMAIL</td>
     <td>'.$email.'</td>
      <td width="10%" >LOCATION</td>
       <td>'.$location.'</td>
    </tr>
    </table>
    
     <h2 style="text-align:center;">ACCOUNT DETAILS</h2>
    <table>
    <tr>
    <td width="12%">CLASS</td>
     <td>'.$class.'</td>
      <td width="12%" >STATUS</td>
       <td>'.$status.'</td>
    </tr>
    
     <tr>
    <td width="12%">CONN NO.</td>
     <td>'.$connectionnumber.'</td>
      <td width="12%" >LAT/LONG</td>
       <td>'.$lattitude.'/'.$long.'</td>
    </tr>
    
    </table> 
    
     <h2 style="text-align:center;">METER DETAILS</h2>
    <table>
    <tr>
    <td width="12%">METER No.</td>
     <td>'.$meternumber.'</td>
      <td width="12%" >SERIAL</td>
       <td>'.$serialnumber.'</td>
       
    </tr>
    
     <tr>
    <td width="12%">SIZE</td>
     <td>'.$size.'</td>
      <td width="12%" >READING</td>
       <td>'.$reading.'</td>
    </tr>
    
    </table>
    
<h2 style="text-align:center;">TERMS  OF SERVICE</h2>
    <table>
    <tr>
    <td style="text-align:center;" >THESE ARE THE TERMS OF SERVICE BETWEEN YOU AND THE ORGANISATION</td>
     
    </tr>
    </table>
    
    <table>
    <tr>
    <td width="10%" >SIGN</td>
     <td ></td>
     <td width="10%" >DATE</td>
     <td ></td>
    </tr>
    
    <tr>
    <td width="10%" >ATTENDANT</td>
     <td >'.$attendant.'</td>
     <td width="10%" >DATE</td>
     <td >'.$_SESSION['date'].'</td>
    </tr>
    </table></body>
</html>';

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation (optional)
$dompdf->setPaper('A4', 'portrait');

// Render PDF (output to a file or browser)
$dompdf->render();

// Output PDF to the browser
$dompdf->stream($account.'.pdf', array('Attachment' => 0)); 

?>