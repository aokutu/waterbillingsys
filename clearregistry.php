 <?php 
 set_time_limit(0);
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
@$searchregistry=$_SESSION['searchregistry'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'MULTI EDIT' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
 $id=$_POST['id'];
print $searchregistry; 
 if($searchregistry=='ACCOUNTREGISTRY')
 {
//////////

foreach($id as $data)
 {
	//print $data."<br>";
	$x="SELECT *  FROM SEARCH WHERE ID=$data";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tbl=$y['E'];$acc=$y['B']; $zone=$y['D']; $meterstablex='meters'.$zone;
	$b="DELETE  FROM  DEBTREGISTRY  WHERE  ACCOUNT ='$acc'";mysqli_query($connect,$b)or die(mysqli_error($connect));
   $b="DELETE  FROM  DEBTPAY  WHERE  ACCOUNT ='$acc'";mysqli_query($connect,$b)or die(mysqli_error($connect));
 $b="DELETE  FROM  $billstable  WHERE  ACCOUNT ='$acc'"; mysqli_query($connect,$b)or die(mysqli_error($connect));
 $b="DELETE  FROM  $wateraccountstable  WHERE  ACCOUNT ='$acc'";mysqli_query($connect,$b)or die(mysqli_error($connect));
 $b="DELETE  FROM  $nonwaterbills  WHERE  ACCOUNT ='$acc'";mysqli_query($connect,$b)or die(mysqli_error($connect));
 $b="DELETE  FROM $statushistorytable  WHERE  ACCOUNT ='$acc'";mysqli_query($connect,$b)or die(mysqli_error($connect));
 $b=" UPDATE $meterstablex SET ACCOUNT ='NOT INSTALLED' WHERE ACCOUNT ='$acc'";mysqli_query($connect,$b)or die(mysqli_error($connect));
$b="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),CONCAT(CURRENT_TIMESTAMP),CONCAT('DELETED ACCOUNT NUMBER ','$acc'),CONCAT(CURRENT_DATE)";mysqli_query($connect,$b)or die(mysqli_error($connect));

	  	  $b="DELETE FROM $tbl WHERE ACCOUNT ='$acc'";mysqli_query($connect,$b)or die(mysqli_error($connect));

	}}
	 
 }


////////////	 
$_SESSION['message']="ACCOUNTS DELETED "; 	 
 }
 
 else  if($searchregistry=='METERREGISTRY')
 {
//////////

foreach($id as $data)
 {
	//print $data."<br>";
	$x="SELECT *  FROM SEARCH WHERE ID=$data";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tbl=$y['E'];$meter=$y['C'];$accountstablex='accounts'.$y['D'];
	$b="UPDATE $accountstablex SET METERNUMBER='NOT INSTALLED' WHERE METERNUMBER='$meter'";mysqli_query($connect,$b)or die(mysqli_error($connect));
	  $b="DELETE FROM $tbl WHERE METERNUMBER ='$meter'";mysqli_query($connect,$b)or die(mysqli_error($connect));
	}}
	 
 }


////////////	 
$_SESSION['message']="METERS DELETED"; 	 
 }
 
 else  if($searchregistry=='ACCOUNTREGISTRY2')
 {
//////////

foreach($id as $data)
 {
	//print $data."<br>";
	$x="SELECT *  FROM SEARCH WHERE ID=$data";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tbl=$y['E'];$id=$y['A'];$account=$y['B'];$accountstablex='accounts'.$y['D'];
	  $b="DELETE FROM $tbl WHERE ID='$id'";mysqli_query($connect,$b)or die(mysqli_error($connect));
	}}
	 
 }


////////////	 
$_SESSION['message']="ENTRY  DELETED"; 	 
 }
 
 
 if($searchregistry=='METERREGISTRY2')
 {
//////////

foreach($id as $data)
 {
	//print $data."<br>";
	$x="SELECT *  FROM SEARCH WHERE ID=$data";
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tbl=$y['E'];$acc=$y['B'];$id=$y['A']; $zone=$y['D']; $meterstablex='meters'.$zone;
		  $b="DELETE FROM $tbl WHERE  ID='$id'";mysqli_query($connect,$b)or die(mysqli_error($connect));


	}}
	$_SESSION['message']="ENTRY  DELETED"; 	 
 
 }
 }


 
 ?>