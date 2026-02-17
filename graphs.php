
<?PHP 
 $connect=mysqli_connect('localhost','root','','jeep');


 $x="CREATE TEMPORARY TABLE ACCOUNTSREGISTRY(LOCATION TEXT,XX INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="TRUNCATE STATEMENT";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;
	PRINT $accountstable."<br>";
	$b="INSERT INTO STATEMENT (A,B) select $accountstable.location,COUNT(LOCATION) FROM $accountstable group by $accountstable.location;";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		
		}
		}
			

	
	 ?>