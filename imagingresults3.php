<?php
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class imagingresults
{
public $parameters =null;
public $results	=null;
public $details =null;	
public $datex =null;
public $patientnumber =null;
public $procedure =null;
public $id =null;
public $age =null;
public $gender =null;
public $name =null;
public $trackkey =null;
}
$imagingresults =new imagingresults; 
$imagingresults->trackkey=str_pad(rand(1,10000000),8, '0', STR_PAD_LEFT);
$imagingresults->id=$_GET['id'];
$target_dir = "xrayimages/"; // Directory where the file will be uploaded
$new_filename = $imagingresults->trackkey.".png"; // New name for the uploaded file
$target_file = $target_dir . $new_filename; // Full path with new filename

$uploadOk = 1; // Flag to check if upload is OK
$fileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)); // Get file extension

// Check if the file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0; // Set upload flag to 0 if file exists
}

// Check file size (optional)
if ($_FILES["image"]["size"] > 500000) { // Example limit: 500KB
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats (optional)
if ($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg" && $fileType != "gif") {
    echo "Sorry, only PNG, JPG, JPEG, and GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // Attempt to move the uploaded file to the target directory with the new name
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file has been uploaded as " . htmlspecialchars($new_filename);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['operationprocedurenotes'])))));
$imagingresults->id=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedureid']))));
$imagingresults->patientnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['patientnumber']))));
$imagingresults->procedure=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['procedure']))));
$imagingresults->age=$_POST['age'];
$imagingresults->gender=$_POST['gender'];
$imagingresults->datex =$_POST['date'];
$imagingresults->name=$_POST['name'];


  if (count($_POST['parameters']) === count($_POST['results']) && count($_POST['results']) === count($_POST['details']))
	  {
        // Loop through each iteme
	for ($i = 0; $i < count($_POST['parameters']); $i++) 
	{

$imagingresults->parameters =$_POST['parameters'][$i];
$imagingresults->results =$_POST['results'][$i];
$imagingresults->details =$_POST['details'][$i];
print $imagingresults->details;		
/*
$imagingresults->results = $connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['parameters'][$i])))));
$imagingresults->details = $connect->real_escape_string(nl2br(htmlspecialchars(trim(addslashes($_POST['parameters'][$i])))));
print $imagingresults->details;
*/
$connect ->query("INSERT INTO imagingresults (TRACKKEY,PATIENTNUMBER,NAME,AGE,GENDER,PROCEDURES,PARAMETERS,RESULTS,RANGES,ATTENDANT,DATE) 
VALUES ('$imagingresults->trackkey','$imagingresults->patientnumber','$imagingresults->name','$imagingresults->age','$imagingresults->gender','$imagingresults->procedure',
'$imagingresults->parameters','$imagingresults->results','$imagingresults->details','$dbdetails->user','$imagingresults->datex')");

}
	  }
	  
$connect ->query("UPDATE pendingsales SET STATUS ='ISSUED' WHERE  ID ='$imagingresults->id' ");	
$_SESSION['trackkey'] = $imagingresults->trackkey;
header("LOCATION:reprintxrayimage.php");
?>