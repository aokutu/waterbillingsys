<?php 
session_start();
$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.',$_SESSION['company']);
?>



<div  id="zonesx">
<select class="form-control input-sm" name="loadedzone"  >
<option value=''>SELECT  ZONE</option>
<?php 

$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}  

?>
</select>
</div>