<?php 
session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'EDIT CONTACTS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
$file=$_FILES['file'];
$newPath = 'uploads/' . basename($_FILES['file']['name']);
$path = $_FILES['file']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['file']['name']);
$filename = $_FILES['file']['name'];
$newPath = 'uploads/' . basename($_FILES['file']['name']);
$path = $_FILES['file']['name'];
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$lines = 0;
if ($fh = fopen('uploads/'.$filename.'','r')) {
  while (! feof($fh)) {
    if (fgets($fh)) {$lines++;}
  }
}

if($lines >1000){header("LOCATION:accessdenied4.php");exit;}


$x="CREATE TEMPORARY TABLE CONTACTS (ACCOUNT TEXT,CONTACT TEXT,EMAIL TEXT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));


    if (($handle = fopen($target_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
         
          $x= "INSERT INTO CONTACTS(ACCOUNT,CONTACT,EMAIL) VALUES ('".$data[0]."','".$data[1]."','".$data[2]."')";
          mysqli_query($connect,$x)or die(mysqli_error($connect));
          
        }
        fclose($handle);
      }
$x="UPDATE $accountstable AS U1, CONTACTS AS U2  SET U1.contact= U2.CONTACT  ,U1.clientemail= U2.EMAIL  WHERE U1.account= U2.ACCOUNT ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'UPDATED CONTACTS USING FILE UPLOAD ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
header("Location:contacts.php");exit;

?>
