<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$action=$_POST['action'];
@$qnty=$_POST['qnty'];
foreach($qnty as $key =>$data)
{
if($data<=0){unset($qnty[$key]);}
}

@$id=$_POST['id'];
mysql_connect('localhost','andrew','waterbilling'); 
mysql_select_db('waterbilling');
if($action=='del')
{
 foreach($id as $del)
 {$x="DELETE FROM accpayables WHERE id=$del";
 mysql_query($x)or die(mysql_error());
  header("Location:ordersreview.php");
 }

}
else if($action=='view')
{
 $_SESSION['id']=reset($id);
 header("Location:ordersreview.php");
 
}
else if($action=='edit')
{
foreach($qnty as $key =>$data)
{

$x="SELECT * FROM accpayables WHERE id=$key";
$x=mysql_query($x)or die(mysql_error());
if(mysql_num_rows($x)>0)
{		
while ($y=@mysql_fetch_array($x))
		 {$item=$y['item'];$sprice=$y['price'];$total=$sprice*$data;
$x="UPDATE accpayables SET total=$total,quantity=$data WHERE id=$key";
 mysql_query($x)or die(mysql_error());
 
		 }
		 }
}
}
	
?>