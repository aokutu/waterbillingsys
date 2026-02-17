 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$chatmate=$_SESSION['chatmate'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");
$day=date('Y-m-d');
?>
<div id="chathist">
 <?php
$x="SELECT * FROM CHATROOM WHERE CHATROOM.SENDER='$user' AND CHATROOM.RECIPIENT='$chatmate'  OR  CHATROOM.SENDER='$chatmate' AND CHATROOM.RECIPIENT='$user' ORDER BY DATE DESC";			   
	$x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		//print "<div style='background-color:#ADD8E6; border-radius:2%; text-align:left;'>".$y['sender']."</div>".$y['message']."<hr>";	
	echo "<div style='background-color:#ADD8E6; border-radius:2%;width:100%; text-align:left;text-transform:initial'>".$y['sender']."</div>".$y['message']."<hr>\n\n";

		}}
			   
			   ?>

</div>