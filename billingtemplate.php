<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


// Create connection
$conn=$connect;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select data from MySQL
$sql = "SELECT ACCOUNT,EMAIL FROM $accountstable WHERE  STATUS ='CONNECTED' ORDER BY  ACCOUNT ASC ";
$result = $conn->query($sql);

// Create/open the CSV file for writing
$csv_filename = 'data.csv';
$file = fopen($csv_filename, 'w');

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Loop through each row of the result set
    while ($row = $result->fetch_assoc()) {
        // Write the row to the CSV file
        fputcsv($file, $row);
    }
} else {
    echo "No records found";
}

// Close the file
fclose($file);

// Close MySQL connection
$conn->close();
header("LOCATION:downloadbilltemplate.php");
?>
