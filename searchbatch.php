<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
//$keyword=addslashes($_POST['keyword']);
$keyword=$_POST['keyword'];
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if(!empty($keyword)) {
$x ="SELECT BATCHNUMBER,ITEM FROM STOCKIN   WHERE   BATCHNUMBER  LIKE  '" . $keyword . "%' ORDER BY BATCHNUMBER ASC    ";
$x=mysqli_query($connect,$x)or die(print 'INVALID CHARACTERS');
	if(mysqli_num_rows($x)>0)
		{
?>
<ul id="idnumber-list">
<?php
 while ($y=@mysqli_fetch_array($x))
		{
?>
<li onClick="selectCountry('<?php echo $y["BATCHNUMBER"]; ?>');"><?php echo $y["BATCHNUMBER"]."  ".$y["ITEM"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>
