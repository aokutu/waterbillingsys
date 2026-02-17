<?php 
$connect=mysqli_connect('localhost','root','','lawasco');
$x="truncate statement";mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i; 
	print $accountstable."<br>";
$b="INSERT INTO STATEMENT (A,B,C,D,E,F) SELECT ACCOUNT,STATUS,CLASS,SIZE,LOCATION,CONCAT('ZONE $i') FROM $accountstable";
mysqli_query($connect,$b)or die(mysqli_error($connect));		
		}
		}