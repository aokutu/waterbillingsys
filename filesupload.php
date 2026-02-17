<?php 
@session_start();
set_time_limit(0);
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$zone=$_SESSION['zone'];
include_once("password.php");
$table=$_POST['table'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'BACKUP DATABASE' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$file=$_FILES['file'];
$newPath = 'uploads/' . basename($_FILES['file']['name']);
$path = $_FILES['file']['name'];
if($path=='accounts.txt'){
move_uploaded_file($_FILES['file']['tmp_name'], $newPath);
copy('uploads/accounts.txt','../mysql/data/'.$company.'/accounts.txt');
$x="TRUNCATE OFFLINE ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="LOAD DATA INFILE  'accounts.txt'  INTO TABLE  OFFLINE ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT O FROM OFFLINE WHERE O >=0";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
		$i=$y['O']; $accountstablex='accounts'.$i; 
$x="INSERT INTO $accountstablex (ACCOUNT,METERNUMBER,CLIENT,CLASS,IDNUMBER,LOCATION,CONTACT,CLIENTEMAIL,STATUS,EMAIL,SIZE,DATE2,LONGITUDE,LATTITUDE) SELECT A,B,C,D,E,F,G,H,I,J,K,L,M,N FROM OFFLINE WHERE  O='$i'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
		
		}}

$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED NEW  accounts.txt  FILE',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
header("Location:backupdatabase.php");exit;
}

else if($path=='meters.txt'){
move_uploaded_file($_FILES['file']['tmp_name'], $newPath);
copy('uploads/meters.txt','../mysql/data/'.$company.'/meters.txt');
$x="TRUNCATE OFFLINE ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="LOAD DATA INFILE  'meters.txt'  INTO TABLE  OFFLINE ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT F FROM OFFLINE WHERE F NOT  REGEXP 'ZONE'";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
		$i=$y['F']; $meterstablex='meters'.$i;   
	$x="INSERT INTO $meterstablex (ACCOUNT,METERNUMBER,SERIALNUMBER,STATUS,SIZE) SELECT A,B,C,D,E FROM OFFLINE WHERE F='$i' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
		}}
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED NEW  meters.txt  FILE',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
//header("Location:backupdatabase.php");
exit;
} 

else if($path=='bills.txt'){
move_uploaded_file($_FILES['file']['tmp_name'], $newPath);
copy('uploads/bills.txt','../mysql/data/'.$company.'/bills.txt');
$x="LOAD DATA INFILE  'bills.txt'  INTO TABLE  $billstable";mysqli_query($connect,$x)or die(mysqli_error($connect));

		
		
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED NEW  BILLS.TXT FILE',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
header("Location:backupdatabase.php");

$x="INSERT INTO $accountstable (ACCOUNT,METERNUMBER,EMAIL,SIZE,CLASS,STATUS,CONTACT) select ACCOUNT,METERNUMBER,CURRENT,CONCAT('0.5'),CONCAT('A'),CONCAT('CONNECTED'),CONCAT('0711487030') FROM  $billstable WHERE not exists(select account FROM $accountstable WHERE $billstable.account=$accountstable.ACCOUNT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));
exit;
}

else if($path=='payments.txt'){
move_uploaded_file($_FILES['file']['tmp_name'], $newPath);
copy('uploads/payments.txt','../mysql/data/'.$company.'/payments.txt');
$x="LOAD DATA INFILE  'payments.txt'  INTO TABLE  $wateraccountstable";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPLOADED NEW  PAYMENTS.TXT FILE',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));
header("Location:backupdatabase.php");exit;
}

else if($path=='summary.txt'){
move_uploaded_file($_FILES['file']['tmp_name'], $newPath);
copy('uploads/summary.txt','../mysql/data/'.$company.'/summary.txt');
$x="TRUNCATE TABLE statement ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="LOAD DATA INFILE  'summary.txt'  INTO TABLE  statement  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $accountstable (ACCOUNT,CLIENT,METERNUMBER,CONTACT,SIZE,CLASS) SELECT A,B,C,D,G,H  FROM STATEMENT WHERE NOT EXISTS(SELECT ACCOUNT FROM $accountstable where    $accountstable.account=STATEMENT.A )";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  $meterstable  (ACCOUNT,METERNUMBER,SIZE) SELECT ACCOUNT,METERNUMBER,SIZE FROM $accountstable WHERE  EXISTS(SELECT  $accountstable.ACCOUNT FROM $accountstable,$meterstable where    $accountstable.account=$meterstable.ACCOUNT AND $accountstable.meternumber !='')";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $billstable(ACCOUNT,METERNUMBER,BALANCE,DATE)  SELECT A,C,E,CONCAT('2020-02-10')  FROM STATEMENT WHERE E>0 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO $billstable (ACCOUNT,METERNUMBER,BALANCE,date) SELECT A,C,F,CONCAT('2020-01-10')  FROM STATEMENT WHERE F>0  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
header("Location:backupdatabase.php");exit;
}
header("Location:backupdatabase.php");exit;
//
?>