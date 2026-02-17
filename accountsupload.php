<?php 
header("LOCATION:accessdenied4.php");exit;
/*accountsmeters.txt ACCOUNT|NAME|IDNUMBER|CLASS|STATUS|LOCATION|CONTACT|METERNUMBER|SERIALNUMBER|METERSIZE|LAST METERREADING|LAST READING DATE
date format:YYYY-MM-DAY */
@session_start();
set_time_limit(0);
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$table=$_POST['table'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS REGEXP  'UPLOAD ACCOUNTS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$file=$_FILES['file'];

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

move_uploaded_file($_FILES['file']['tmp_name'], $newPath);
$x="CREATE TEMPORARY TABLE TEMPORARYREGISTRY(ACCOUNT TEXT,METERNUMBER TEXT,NAME TEXT,CLASS TEXT,METERSIZE TEXT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

   if (($handle = fopen($target_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $account = substr($data[0], 0,11);
            $name=str_replace("'", '', $data[2]);
     
     // $x= "INSERT INTO TEMPORARYREGISTRY(ACCOUNT,METERNUMBER,NAME,CLASS,METERSIZE) VALUES ('".$account."','".$data[1]."','".$data[2]."','".$name."','".$data[4]."')";
     	$x="INSERT INTO $accountstable (ACCOUNT,CLIENT,METERNUMBER,CLASS,SIZE,STATUS,EMAIL,DATE2)
VALUES ('".$account."','".$name."','".$data[1]."','A','0.5','CONNECTED','0','2022-05-25') ";
         mysqli_query($connect,$x)or die(mysqli_error($connect));
          
        }
        fclose($handle);
      }
$x="UPDATE $accountstable SET SIZE=NULL ,METERNUMBER ='NOT INSTALLED' WHERE METERNUMBER ='' OR METERNUMBER IS NULL ";
mysqli_query($connect,$b)or die(mysqli_error($connect));      
 	$b="INSERT INTO clientmetersreg (ACCOUNT,METERNUMBER,SERIALNUMBER,SIZE,STATUS,ZONE) SELECT ACCOUNT,METERNUMBER,METERNUMBER,SIZE,CONCAT('FUNCTION'),CONCAT('3') FROM $accountstable WHERE METERNUMBER !='NOT INSTALLED' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED  ACCOUNTS   FILE',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));     
      
      
exit;


     
$x="SELECT number FROM zones";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
		$i=$y['number']; $accountstablex='accounts'.$i; $meterstablex='meters'.$i; 
		$b="DELETE FROM TEMPORARYREGISTRY  WHERE  ACCOUNT IN (SELECT ACCOUNT FROM $accountstablex )";mysqli_query($connect,$b)or die(mysqli_error($connect));
		    
		}}


$x="UPDATE TEMPORARYREGISTRY SET METERSIZE ='0.5' WHERE METERNUMBER !='NOT INSTALLED' ";
mysqli_query($connect,$b)or die(mysqli_error($connect));


mysqli_query($connect,$b)or die(mysqli_error($connect));


header("LOCATION:accountsregistry.php");exit;
?>