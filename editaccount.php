<?php  
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'EDIT ACCOUNT'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="INVALID ENTRIES";exit;}$class=$_POST['class'];
@$account=$_POST['account'];$account=strtoupper(addslashes($account));if($account==""){$_SESSION['message']="INVALID ENTRIES";exit;}
@$name=$_POST['name'];$name=strtoupper(addslashes($name));if($name==""){$_SESSION['message']="INVALID ENTRIES";exit;}
@$contact=$_POST['contact'];$contact=addslashes($contact);if($contact==""){ $contact='07';} 
@$status=$_POST['status'];
@$size=$_POST['size'];
//if($size <1){$_SESSION['message']=$size."INVALID ENTRIES";exit;}

@$idnumber=strtoupper(addslashes($_POST['idnumber']));  @$email=$_POST['email'];
@$location=strtoupper(addslashes($_POST['location']));

@$plotnumber=strtoupper(addslashes($_POST['plotnumber']));
$x="SELECT * FROM $accountstable  WHERE   account='$account'";

$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1){$_SESSION['message']="ACCOUNT ".$account."MISSING IN ZONE".$zone;exit;}

	
$x="SELECT number FROM zones WHERE number!='$zone' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstablex='accounts'.$i; $meterstablex='meters'.$i;
$a="SELECT * FROM $accountstablex  WHERE   account ='$account' ";
$a=mysqli_query($connect,$a)or die(mysqli_error($connect));
if(mysqli_num_rows($a)>0){$_SESSION['message']="CONFLICT IN  ZONE".$i;exit;}	
	}
		}

$x="UPDATE $accountstable  SET status='$status',client='$name' ,location='$location',idnumber='$idnumber' ,contact='$contact' ,class='$class' ,clientemail='$email',plotnumber='$plotnumber' WHERE account='$account'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x=" UPDATE accountsstatus SET status ='$action' WHERE ACCOUNT ='$account' AND MONTH(DATE)=MONTH( DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 7 HOUR)); ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'EDITED ACC  $account ',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="ACCOUNT".$account."<br>UPDATED";exit; 

?>
