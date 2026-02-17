<?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'UPLOAD BILLS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$countfiles = count($_FILES['file']['name']);
$path="offline/";
 // Looping all files
 for($i=0;$i<$countfiles;$i++){
	  $filename = $_FILES['file']['name'][$i];
	  //print $filename;
    // Upload file
$extension= pathinfo($filename, PATHINFO_EXTENSION);
if($extension =='jpg'){ move_uploaded_file($_FILES['file']['tmp_name'][$i],$path.$filename);};


 }
 
 $files=scandir('offline/');
 foreach($files as $file)
{
rename("offline/".$file."","uploads/photos/".$file."");
}
 header("LOCATION:offline.php");exit;
?>