<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:loggin.php");exit;} 
?>
 <!DOCTYPE html>

<html>

   
   <head>
      <title>LAWASCO</title>
      <script>
      document.addEventListener("contextmenu", function (e){
    e.preventDefault();
}, false);
</script>
   </head>
   
   <frameset cols = "20%,80%"  style="border: 0" >
   <frame frameBorder="0"  style="border-style: solid;border-color:white;  @media print{ display:none;}"    name = "left" src ="dashboard.php" />
 <frame frameBorder="0"  style="border-style: solid;border-color:white;"  name = "right" src = "graphsummary.php" />
      

      <noframes>
         <body>Your browser does not support frames.</body>
      </noframes>
   </frameset>
   <a href = "index.php" target = "left">
</html>