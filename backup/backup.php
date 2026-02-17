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
 use G4\Crypto\Crypt;
 use G4\Crypto\Adapter\OpenSSL;

$crypto = new Crypt(new OpenSSL());
$crypto->setEncryptionKey('HADDASSAHSOFTWARES');

$db = new mysqli('localhost', 'lawascoco', 'Lamuwater@24',$company);
$dump = new MySQLDump($db);
$dump->save('BACKUP.txt');

/////////////
$file = 'BACKUP.txt';

/////////
$content = file_get_contents($file);

$encryptedMessage = $crypto->encode($content);
$message = $crypto->decode(file_get_contents($file));
file_put_contents($file,$encryptedMessage);
//////////// DECRYPTION  OF  YOUR DATA 

//$myFile = 'xx.txt';

//file_put_contents($myFile,$message);
///////////////

/////////////////////////////////////////////////////////
//$message = $crypto->decode(file_get_contents($file))///
///file_put_contents($file, $message);
////////////////////////////////////////////////////////



$s = new sendfile();

// file
$file = 'BACKUP.txt';

/////////
$current = file_get_contents($file);
///////////
// send the file
try {
    $s->send($file);
} catch (\Exception $e) {
    echo $e->getMessage();
}


$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'BACKED UP DATABASE',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
  $_SESSION['message']="DATA  EXPORTED SUCCESSFULLY";
	?>