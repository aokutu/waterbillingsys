 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@include_once("../password.php");
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'BACKUP DATABASE'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:../dashboard.php");exit;}
 @session_start();
 @include_once("../password.php");
 require_once 'vendor/autoload.php';
  use diversen\sendfile;
 
 
 $file ="BILLSIMPORT.txt";
$myFile = fopen($file, "w");

$x="SELECT ACCOUNT,METERNUMBER,CLASS,EMAIL  FROM $accountstable  WHERE STATUS='CONNECTED' AND METERNUMBER IN(SELECT METERNUMBER FROM $meterstable)   ORDER BY ACCOUNT  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
			fputs($myFile," BILLING \t  \t ZONE  \t ".$zonename." \t  \t  \n");
		 	fputs($myFile,"ACCOUNT \t METER \t  CLASS  \t PREVIOUS \t CURRENT \t DEDUCTION \n");
		 while ($y=@mysqli_fetch_array($x))
		 {
		   
		   	fputs($myFile, $y['ACCOUNT']."\t".$y['METERNUMBER']."\t".$y['CLASS']."\t".$y['EMAIL']."\n");

		 }
		 
		 }
	$_SESSION['message']='EXPORTED';
passthru('importbillsheet.pyw');	 

$s = new sendfile();
$file='BILLSIMPORT.csv';
// file
$file = $file;

/////////
$current = file_get_contents($file);
///////////
// send the file
try {
    $s->send($file);
} catch (\Exception $e) {
    echo $e->getMessage();
}

print "success";
?>