<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password'       ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$_SESSION['requisitioner'];
?>

 <select class="form-control input-sm"  name="authorizer" id="authorizer2" required="on"   >
<option >SELECT  AUTHORIZER  </option>
<?php 
$x="SELECT AUTHORIZER,AUTHORIZERTITLE  FROM REQUISITION  WHERE REQUISITIONER='".$_SESSION['requisitioner']."' AND  STATUS !='ISSUED' GROUP BY AUTHORIZER  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['AUTHORIZER']."'>".$y['AUTHORIZER'].' '.$y['AUTHORIZERTITLE']."</option>";	
		}}

?>

    </select>