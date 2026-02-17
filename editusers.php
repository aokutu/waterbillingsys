<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$action=$_POST['action'];
//print $action; exit;
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'       AND  ACCESS  REGEXP  'USERS ADMIN' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ echo "ACESS DENIED";exit;}
$id=$_POST['id'];

if($action=="delete"){

 foreach ($id as $del)
{

$x="SET @user='$user'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT @user,DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('DELETED USER ',name),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM users  WHERE id=$del";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="DELETE FROM users WHERE id=$del";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="USER DELETED";exit;
}


else if($action=="loggoff"){
 foreach ($id as $del)
{

$x="SET @user='$user'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT @user,DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('FORCE LOGG OFF  ',name),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM users  WHERE id=$del";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE users SET LOGGED='OFF' WHERE id=$del";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="USER LOGGED OFF ";exit;
}


else if($action=="suspend"){
 foreach ($id as $del)
{

$x="SET @user='$user'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT @user,DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('SUSPEND USER  ',name),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM users  WHERE id=$del";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE users SET LOGGED='SUSPEND' WHERE id=$del";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="USER SUSPENDED ";exit;
}

else if($action=="activate"){
 foreach ($id as $del)
{

$x="SET @user='$user'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT @user,now(),CONCAT('ACTIVATED USER  ',name),now() FROM users  WHERE id=$del";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE users SET LOGGED='OFF' WHERE id=$del";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="USER ACTIVATED ";exit;
}

else if ($action =='reset')
{	
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'       AND  ACCESS  REGEXP  'RESET PASSWORD' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACESS DENIEDx";exit;}

	 foreach ($id as $del)
{

$x="SET @user='$user'";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) SELECT @user,DATE_ADD(NOW(), INTERVAL 7 HOUR),CONCAT('RESET PASSWORD OF ',name),DATE_ADD(NOW(), INTERVAL 7 HOUR) FROM users  WHERE id=$del";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE  users  SET    PASSWORD='123456'  WHERE  id=$del";
mysqli_query($connect,$x)or die(mysqli_error($connect));
}
$_SESSION['message']="PASSWORD RESET";exit;
}

else if ($action =='edit')
{	
$_SESSION['id']=reset($id);
$_SESSION['message']="UPDATE USER RIGHT";exit;
}

else if ($action=='edit2')
{
@$updatename=addslashes(strtoupper($_POST['name']));$data=implode(',',$_POST['right']);  $id=$_SESSION['id'];  
$x="UPDATE users  SET name='$updatename',access='$data' WHERE id=$id;";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'EDIT USER  $updatename CREDENCIALS',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="USER  EDITED";exit;

}

?>
