<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$item=$_POST['item']; $item=strtoupper(addslashes($item));
$units=$_POST['units']; $units=trim(strtoupper(addslashes($units)));
if($item=='VAT'){$_SESSION['message']=$item.'INVALID NAME'; exit;}
@$price=$_POST['price']; $price=trim(strtoupper(addslashes($price)));
@$sprice=$_POST['sprice']; $sprice=trim(strtoupper(addslashes($sprice)));
@$location=trim(strtoupper(addslashes($_POST['location'])));
@$paymode=$_POST['paymode'];
@$batch=$_POST['batch']; $batch=trim(strtoupper(addslashes($batch)));
@$payrefference=$_POST['payrefference']; $payrefference=trim(addslashes(strtoupper($payrefference)));
///@$price=$_POST['sprice']; $price=trim(strtoupper(addslashes($price)));
@$dispenceid=$_POST['dispenceid'];
@$date=$_POST['date'];
@$bprice=$_POST['bprice']; $bprice=trim(strtoupper(addslashes($bprice)));
@$quantity=$_POST['quantity'];
@$action=$_POST['action']; 
@$action2=$_POST['action2'];@$discount=$_POST['discount'];$_SESSION['discount']=$discount;
@$category=$_POST['category'];
@$itemcode=trim(strtoupper(addslashes($_POST['itemcode'])));
@$minstocklevel=trim(strtoupper(addslashes($_POST['minstocklevel'])));
$_SESSION['message']="COMPLETE"; @$description=addslashes(strtoupper($_POST['description']));

if ($action =='UPDATE INVENTORY')
{

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'       ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

	
$x="SELECT * FROM INVENTORY WHERE  ITEM ='$item'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
print $itemcode;
if(mysqli_num_rows($x)>0)
{
$x="UPDATE INVENTORY SET BPRICE='$bprice',LOCATION='$location',PRICE='$sprice',CATEGORY='$category',ITEMCODE='$itemcode',MINSTOCKLEVEL='$minstocklevel',UNITS='$units' WHERE ITEM ='$item'  AND ITEM !='VAT'";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'UPDATED  ITEM $item  DETAILS ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
$_SESSION['message']=$item."<br> UPDATED";exit;

}
	
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'REGISTERED NEW ITEM $item ',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="INSERT INTO  INVENTORY(ITEM,BPRICE,PRICE,QUANTITY,CATEGORY,ITEMCODE,UNITS,LOCATION,MINSTOCKLEVEL) VALUES('$item','$bprice','$sprice','0','$category','$itemcode','$units','$location','$minstocklevel')";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']=$item." REGISTERED <br>";exit; 	
}


else if (($action =='SALES')&&($quantity >0))
{

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

	

$x="SELECT  *  FROM INVENTORY WHERE ITEM ='$item' AND QUANTITY >=$quantity";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

if(mysqli_num_rows($x)<1){$_SESSION['message']=$item."<br> INSUFFICIENT STOCK ";exit;}
	$x="INSERT INTO SALES(ITEM,PRICE,QUANTITY,TOTAL,BPRICE) 
	SELECT ITEM,CONCAT('$sprice'),CONCAT('$quantity'),CONCAT('$quantity'*'$sprice'),BPRICE FROM INVENTORY WHERE ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$_SESSION['message']="<br> BILLED SUCCESSFULLY ";exit;

}



else if ($action =='MULTIBILL')
{

@$quantity=$_POST['quantity'];
//@$sprice=$_POST['sprice'];

foreach($quantity as $key =>$data)
{
	if($data <=0){unset($quantity[$key]);}
	
}

foreach($quantity as $key =>$data)
{
	
$x="SELECT  *  FROM INVENTORY WHERE  ITEM='$key' AND QUANTITY < $data";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){ $_SESSION['message']=$item."<br> INSUFFICIENT STOCK ON ".$key;exit;}

} 

foreach($quantity as $key =>$data)
{	

	$x="INSERT INTO SALES(ITEM,PRICE,QUANTITY,TOTAL,BPRICE) 
	SELECT ITEM,PRICE,CONCAT('$data'),CONCAT('$data'*PRICE),BPRICE FROM INVENTORY WHERE ITEM='$key'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

}





/*

foreach($quantity as $key =>$data)
{
	
$x="SELECT  *  FROM INVENTORY WHERE  ITEM='$key' AND QUANTITY < $data";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1){   $_SESSION['message']=$item."<br> INSUFFICIENT STOCK ON ".$key;exit;}

} 



/*$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

	

$x="SELECT  *  FROM INVENTORY WHERE ITEM ='$item' AND QUANTITY >=$quantity";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

if(mysqli_num_rows($x)<1){$_SESSION['message']=$item."<br> INSUFFICIENT STOCK ";exit;}
	$x="INSERT INTO SALES(ITEM,PRICE,QUANTITY,TOTAL,BPRICE) 
	SELECT ITEM,CONCAT('$sprice'),CONCAT('$quantity'),CONCAT('$quantity'*'$sprice'),BPRICE FROM INVENTORY WHERE ITEM='$item'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE INVENTORY tu, INVENTORY ts SET tu.quantity = ts.quantity - $quantity  where tu.id=ts.id  AND tu.item ='$item' AND ts.quantity -$quantity >=0 ";mysqli_query($connect,$x)or die(mysqli_error($connect));
*/
$_SESSION['message']="<br> BILLED SUCCESSFULLY ";exit;

}

	

/* if (($action =='PRICING')&&($sprice >0))
{

	$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$x="UPDATE INVENTORY SET PRICE =$sprice,BPRICE='$bprice' WHERE ITEM ='$item'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'SET SELLING PRICE OF  $item TO $price ',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$_SESSION['message']="<br> PRICE SET SUCCESSFULLY ";exit;
$_SESSION['message']=$sprice;exit;
	
}
/*else if (($action =='RESTOCK')&&($quantity >0))
{

$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'RESTOCK ITEM' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
	
$x="UPDATE INVENTORY tu, INVENTORY ts SET tu.quantity = ts.quantity + $quantity  where tu.id=ts.id  AND tu.item ='$item' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'RESTOCKED  $item QNTY : $quantity',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="INSERT INTO ADJUSTMENT (ITEM,QUANTITY,DESCRIPTION,DATE) VALUES('$item','$quantity','$description',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']=$item."<br> RESTOCKED SUCCESSFULLY ";exit; 	
}

else if (($action =='UN-STOCK')&&($quantity >0))
{
	
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'UNSTOCK ITEM' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

	
$x="SELECT  *  FROM INVENTORY WHERE ITEM ='$item' AND QUANTITY >=$quantity";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)<1){$_SESSION['message']=$item." INSUFFICIENT STOCK ";exit;}
	
$x="UPDATE INVENTORY tu, INVENTORY ts SET tu.quantity = ts.quantity - $quantity  where tu.id=ts.id  AND tu.item ='$item' AND ts.quantity -$quantity >=0 ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO ADJUSTMENT (ITEM,QUANTITY,DESCRIPTION,DATE) VALUES('$item',-1*$quantity,'$description',now())";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),CONCAT(CURRENT_TIMESTAMP),CONCAT('UN-STOCK ','$item',' QNTY',$quantity),CONCAT(CURRENT_DATE)  FROM INVENTORY WHERE ITEM ='$item' AND QUANTITY >=0  ";mysqli_query($connect,$x)or die(mysqli_error($connect));	

$_SESSION['message']=$item."<br> UN-STOCKED  SUCCESSFULLY ";exit; 	
} */

 if($action2 =='DELETE')
{
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'DELETE ITEM' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}	
$id=$_POST['id'];
foreach ($id as $data)
{
$x="INSERT INTO events(user,session,action,date)  SELECT CONCAT('$user'),CONCAT(CURRENT_TIMESTAMP),CONCAT('DELETED  ',item,' QNTY',quantity),CONCAT(CURRENT_DATE)  FROM INVENTORY WHERE id=$data ";mysqli_query($connect,$x)or die(mysqli_error($connect));	
$x="DELETE FROM INVENTORY WHERE ID=$data";mysqli_query($connect,$x)or die(mysqli_error($connect));	
	
}

$_SESSION['message']=$item." DELETED  SUCCESSFULLY ";exit; 	
}


else if ($action2 =="DELSALES")
{
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'DELETE SALES' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$id=$_POST['id'];
foreach($id as $data)
{
/*
$x="UPDATE INVENTORY tu, INVENTORY ts SET tu.quantity = ts.quantity +(SELECT QUANTITY FROM SALES WHERE ID =$data)  
where tu.id=ts.id  AND tu.item =(SELECT ITEM FROM SALES WHERE ID =$data)";mysqli_query($connect,$x)or die(mysqli_error($connect));
*/
$x="DELETE FROM SALES WHERE ID= $data";mysqli_query($connect,$x)or die(mysqli_error($connect));
}	
	$_SESSION['message']="REFUNDED SALES";exit;
	
}


 if (($action2 =="PROCESS")  && ($date !=null))
{
	$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$id=$_POST['id'];
$x="SELECT IFNULL(MAX(REFFERENCE)+1,1) AS REFF FROM RECIEPT ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$reffnumber=$y['REFF'];}}
foreach($id as $data)
{
$x="INSERT INTO RECIEPT(ITEM,BPRICE,PRICE,QUANTITY,QUANTITY2,TOTAL,REFFERENCE,PAYMODE,PAYMODEREFFERENCE,DATE) 
SELECT SALES.ITEM,SALES.BPRICE,SALES.PRICE,SALES.QUANTITY,SALES.QUANTITY,CONCAT(SALES.PRICE*SALES.QUANTITY),CONCAT('$reffnumber'),CONCAT('$paymode'),CONCAT('$payrefference'),CONCAT('$date') FROM SALES,INVENTORY  WHERE SALES.ITEM=INVENTORY.ITEM  AND SALES.ID =$data";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('SOLD ',QUANTITY,' ',ITEM,' CHARGES',TOTAL,' REFF NO. ',REFFERENCE),CURRENT_DATE FROM RECIEPT  ORDER BY ID DESC LIMIT 1 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}

foreach($id as $data)
{
$x="DELETE FROM SALES WHERE ID= $data";mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$x="SELECT MAX(REFFERENCE) FROM RECIEPT ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['reffnumber']=$y['MAX(REFFERENCE)'];}}
			$_SESSION['message']="SALES COMPLETE";exit;
			
		
}



if ($action =="DISPATCH")
{
$x="SELECT QUANTITY2  FROM RECIEPT WHERE ID =$dispenceid";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['dispencequantity']=$y['QUANTITY2'];}}
$_SESSION['dispenceid']=$dispenceid;$_SESSION['message']="DISPENCE ITEMS";exit;		
}


if ($action =="DISPATCH2")
{
	
$total=array_sum($quantity);
if($total > $_SESSION['dispencequantity']){$_SESSION['message']="INVALID ENTRIES";exit;}

$x="CREATE TEMPORARY TABLE STOCKBALANCE (ITEM TEXT,QUANTITY INT )"; 
mysqli_query($connect,$x)or die(mysqli_error($connect));

foreach($quantity as $key =>$data)
{
$x="UPDATE STOCKIN  TU, STOCKIN TS  SET TU.STOCKBALANCE=TS.STOCKBALANCE-$data WHERE TU.ID=TS.ID  AND TU.ID=$key AND TU.STOCKBALANCE >=$data  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO STOCKBALANCE ( ITEM,QUANTITY) SELECT ITEM,SUM(STOCKBALANCE) FROM STOCKIN WHERE ITEM  =(SELECT ITEM FROM STOCKIN WHERE ID =$key)";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}

$x="UPDATE RECIEPT  TU, RECIEPT TS  SET TU.QUANTITY2=TS.QUANTITY2-$total WHERE TU.ID=TS.ID AND TS.ID='".$_SESSION['dispenceid']."'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE INVENTORY  TU, STOCKBALANCE TS  SET TU.QUANTITY=TS.QUANTITY WHERE TU.ITEM=TS.ITEM";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DROP  TABLE STOCKBALANCE";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']="DISPENCE ITEMS";exit;
}

if ($action=='VIEWRECIEPTS'){@$_SESSION['salesdate']=$_POST['salesdate'];$_SESSION['message']=" LOAD RECIEPTS";exit; }
if ($action=='VIEWITEMS'){@$_SESSION['recieptnumber']=$_POST['recieptnumber'];$_SESSION['message']=" LOAD ITEMS";exit; }

if ($action=='DELETEITEMS'){
foreach ($_POST['id'] as $data)
{
$x="INSERT INTO ADJUSTMENT (ITEM,QUANTITY,DESCRIPTION,DATE) 
SELECT ITEM,QUANTITY,CONCAT('DELETED ITEM IN RECIEPT NO ',REFFERENCE),CURRENT_DATE FROM RECIEPT WHERE  ID ='$data'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) 
SELECT CONCAT('$user'),CURRENT_TIMESTAMP,CONCAT('DELETE ',QUANTITY,' ',ITEM,'FROM RECIEPT ',REFFERENCE,' WORTH ',TOTAL),CURRENT_DATE FROM RECIEPT  WHERE   ID ='$data'  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE  FROM   RECIEPT WHERE ID ='$data'";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}
$_SESSION['message']=" ITEMS  DELETED";exit;
	}

if ($action=='BILLED'){$_SESSION['message']=" LOAD BILL";exit; }
else {$_SESSION['message']=" INVALID ENTRIES";exit;}

?>