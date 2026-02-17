<?PHP
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  ACCESS  REGEXP  'INVENTORY REG' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED<BR>"; header("LOCATION:accessdenied4.php");exit;}
@$companyname=trim(addslashes(strtoupper($_POST['companyname'])));
@$companyaddress=trim(addslashes(strtoupper($_POST['companyaddress'])));
@$phonenumber=trim(addslashes(strtoupper($_POST['phonenumber'])));
@$email=trim(addslashes($_POST['email']));

$x="SELECT SUPPLIER FROM SUPPLIERS WHERE SUPPLIER ='$companyname' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{print  $companyname; $_SESSION['message']=$companyname."COMPANY EXISTS<BR>"; exit;}
	$x="INSERT INTO SUPPLIERS (SUPPLIER,BOXADDRESS,PHONENUMBER,EMAIL) VALUES('$companyname','$companyaddress','$phonenumber','$email')";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'CREATED   SUPPLIER  :$companyname',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']=$companyname."COMPANY CREATED <BR>";exit; 
?>