<?PHP
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$zone=$_SESSION['zone'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  STATUS ='ACTIVE'  AND   LEVEL  >=10";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$file=$_FILES['accounts'];
$newPath = 'uploads/' . basename($_FILES['accounts']['name']);
$path = $_FILES['accounts']['name'];
$extension= pathinfo($path, PATHINFO_EXTENSION);
if($path=='accounts'){
move_uploaded_file($_FILES['accounts']['tmp_name'], $newPath);
copy('uploads/accounts','../mysql/data/'.$company.'/accounts');}

////////////////
////////////////////
$file=$_FILES['audittrail'];
$newPath = 'uploads/' . basename($_FILES['audittrail']['name']);
$path = $_FILES['audittrail']['name'];
if($path=='audittrail'){
move_uploaded_file($_FILES['audittrail']['tmp_name'], $newPath);
copy('uploads/audittrail','../mysql/data/'.$company.'/audittrail');
$x="TRUNCATE  TABLE events";mysqli_query($connect,$x)or die(mysqli_error($connect));mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="LOAD DATA INFILE 'audittrail'  INTO TABLE events";mysqli_query($connect,$x)or die(mysqli_error($connect));
unlink("../mysql/data/".$company."/audittrail");
}

/////////////////

$file=$_FILES['bankslips'];
$newPath = 'uploads/' . basename($_FILES['bankslips']['name']);
$path = $_FILES['bankslips']['name'];
if($path=='bankslips'){
move_uploaded_file($_FILES['bankslips']['tmp_name'], $newPath);
copy('uploads/bankslips','../mysql/data/'.$company.'/bankslips');
$x="TRUNCATE  TABLE $wateraccountstable ";mysqli_query($connect,$x)or die(mysqli_error($connect));mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="LOAD DATA INFILE 'bankslips'  INTO TABLE $wateraccountstable ";mysqli_query($connect,$x)or die(mysqli_error($connect));
unlink("../mysql/data/'.$company.'/bankslips");
}
///////////////////


$file=$_FILES['bills'];
$newPath = 'uploads/' . basename($_FILES['bills']['name']);
$path = $_FILES['bills']['name'];
if($path=='bills'){
move_uploaded_file($_FILES['bills']['tmp_name'], $newPath);
copy('uploads/bills','../mysql/data/'.$company.'/bills');
$x="TRUNCATE  TABLE bills ";mysqli_query($connect,$x)or die(mysqli_error($connect));mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="LOAD DATA INFILE 'bills'  INTO TABLE bills";mysqli_query($connect,$x)or die(mysqli_error($connect));
unlink("../mysql/data/'.$company.'/bills");
}

//////////////

$file=$_FILES['accounts'];
$newPath = 'uploads/' . basename($_FILES['accounts']['name']);
$path = $_FILES['accounts']['name'];
if($path=='accounts'){
move_uploaded_file($_FILES['accounts']['tmp_name'], $newPath);
copy('uploads/accounts','../mysql/data/'.$company.'/accounts');
$x="TRUNCATE  TABLE accounts ";mysqli_query($connect,$x)or die(mysqli_error($connect));mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="LOAD DATA INFILE 'accounts'  INTO TABLE  $accountstable";mysqli_query($connect,$x)or die(mysqli_error($connect));
unlink("../mysql/data/'.$company.'/accounts");
}

header("LOCATION:backuprestore.php");exit;
 ?>