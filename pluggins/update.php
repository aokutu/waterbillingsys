<?PHP	
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
mysql_connect('localhost','andrew','pointofsale'); 
mysql_select_db('pointofsale');
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND ADMIN='YES'";
$x=mysql_query($x)or die(mysql_error());
if(mysql_num_rows($x)>0){}
else{ include_once("accessdenied.php");exit;}   

$x="SELECT SUM(amount),COUNT(date) FROM wateraccounts ";
$x=mysql_query($x)or die(mysql_error());
if(mysql_num_rows($x)>0)
{		
while ($y=@mysql_fetch_array($x))
		 {$rows=$y['COUNT(date)'];$amount1=$y['SUM(amount)'];}}
		 
$x="LOAD DATA INFILE 'wateraccounts.txt'  INTO TABLE wateraccounts";
mysql_query($x)or die(header("Location:invalidentries.php"));
$x="SELECT SUM(amount),COUNT(date) FROM wateraccounts ";
$x=mysql_query($x)or die(mysql_error());
if(mysql_num_rows($x)>0)
{		
while ($y=@mysql_fetch_array($x))
		 {$rows2=$y['COUNT(date)'];$amount2=$y['SUM(amount)'];}}
$amount3=$amount2-$amount1;	 
if($rows2>$rows)
{
$x="SELECT * FROM accounts  WHERE    name='Bank' ";
		$x=mysql_query($x)or die(mysql_error());
		if(mysql_num_rows($x)>0)
		{
		
		 while ($y=@mysql_fetch_array($x))
		 {
		   $amount =$y['amount']; 
 $x="UPDATE accounts SET amount=$amount+$amount3  WHERE name='Bank'";
mysql_query($x)or die(mysql_error());
		 }
		 }
		 
$x="INSERT INTO cashflow(account,amount,transaction,user,date) VALUES('Bank',$amount3,'Deposit','$user',now())";
mysql_query($x)or die(mysql_error());
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'Updated Water Account',now())";
mysql_query($x)or die(mysql_error());
}
header("Location:waterbill.php");
 ?>