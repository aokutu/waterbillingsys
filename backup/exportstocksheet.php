 <?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@include_once("../password.php");
@$category=$_POST['category'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'INVENTORY REG'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:../dashboard.php");exit;}
 @session_start();
 @include_once("../password.php");
 require_once 'vendor/autoload.php';
  use diversen\sendfile;
 
 
 $file ="STOCKTAKESHEET.txt";
$myFile = fopen($file, "w");
$number=0;
	$x="SELECT ITEM,ITEMCODE,CATEGORY,QUANTITY,BPRICE,UNITS,MINSTOCKLEVEL,LOCATION FROM INVENTORY  WHERE CATEGORY ='$category' ORDER  BY  ID,ITEMCODE  ASC ";

		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
			fputs($myFile," STOCK  WORKSHEET AS AT  ".date('Y-m-d')." \t  \t   \t  \t  \t  \t \t \t \t  \n");
		 	fputs($myFile,"ITEM NO \t CODE \t  ITEM  \t UNITS \t CATEGORY \t LOCATION \t QUANTITY \t UNIT PRICE \t VALUE \t PHYSICAL COUNT \t  DIFFERENCE \t REMARKS \n");
		 while ($y=@mysqli_fetch_array($x)) 
		 { $number +=1;
		   
		   	fputs($myFile, $number."\t".$y['ITEMCODE']."\t".$y['ITEM']."\t".$y['UNITS']."\t".$y['CATEGORY']."\t".$y['LOCATION']. "\t".$y['QUANTITY']."\t".number_format($y['BPRICE'],2)."\t".number_format($y['BPRICE']*$y['QUANTITY'],2).  "\t \t  \t  \n");

		 }
		 
		 }
		 
			$x="SELECT SUM(BPRICE*QUANTITY) AS TTL  FROM INVENTORY  WHERE CATEGORY ='$category'  ";

		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x)) 
		 { $number +=1;
		   
		   	fputs($myFile, $number."\t \t \t \t \t \t \t \t".number_format($y['TTL'],2).  "\t \t  \t  \n");

		 }
		 
		 }
		 
	$_SESSION['message']='EXPORTED';
passthru('exportstocksheet.pyw');	 

$s = new sendfile();
$file='STOCKTAKESHEET.csv';
// file
$file = $file;

/////////
$current = file_get_contents($file);
///////////
// send the file
try {
    $s->send($file);
} catch (\Exception $e) {
    echo $e->getMessage();
}


?>