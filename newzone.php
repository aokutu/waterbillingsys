<?php 
@session_start();
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP  'ZONE ADMIN'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$zonenumber=$_POST['zonenumber'];
@$zonename=addslashes(strtoupper($_POST['zonename']));

$x="SELECT * FROM zones WHERE NUMBER=$zonenumber ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){$_SESSION['message']="ZONE ".$zonenumber."EXISTS";exit;}
$x="INSERT INTO  zones(ZONE,NUMBER) VALUES('$zonename',$zonenumber)";mysqli_query($connect,$x)or die(mysqli_error($connect));


	 $accounts='accounts'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$accounts` (
  `id` int(11) NOT NULL,
  `client` text,
  `class` text,
  `account`  text,
  `meternumber` text,
  `size` text,
  `location` text,
  `contact` text,
  `status` text,
  `idnumber` text NOT NULL,
  `user` text,
  `date` date DEFAULT NULL,
  `date2` date NOT NULL,
  `id2` text,
  `email` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$bills='bills'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$bills` (
   `id` int(11) NOT NULL,
  `meternumber` text DEFAULT NULL,
  `current` float DEFAULT NULL,
  `previous` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `billed` float NOT NULL,
  `units` float DEFAULT NULL,
  `deduction` float NOT NULL,
  `commission` double NOT NULL,
  `charges` double DEFAULT NULL,
  `metercharges` double DEFAULT NULL,
  `refuse` float DEFAULT NULL,
  `status` text DEFAULT NULL,
   `meterstatustatus` text DEFAULT NULL,
    `accountstatus` text DEFAULT NULL,
     `class` text DEFAULT NULL,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)
";
mysqli_query($connect,$x)or die(mysqli_error($connect));	 
$statushistory='statushistory'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$statushistory` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$wateraccounts='wateraccounts'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$wateraccounts` (
   `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)
";mysqli_query($connect,$x)or die(mysqli_error($connect));


$nonwaterbills='nonwaterbills'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$nonwaterbills` (
  `account` TEXT NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` double NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect,$x)or die(mysqli_error($connect));

$mastermeters='mastermeters'.$zonenumber;
$x="CREATE TABLE `$mastermeters`(
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `serialnumber` text NOT NULL,
  `location` text NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `reading`float NOT NULL,
  `date` date
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="ALTER TABLE `$mastermeters` ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `$mastermeters` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
$mastermeterbill='mastermeterbill'.$zonenumber;

$x="CREATE TABLE `$mastermeterbill` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `current` float NOT NULL,
  `previous` float NOT NULL,
  `units` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `$mastermeterbill` ADD PRIMARY KEY (`id`)";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `$mastermeterbill` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$accounts='accounts'.$zonenumber;		
$x="ALTER TABLE `$accounts`ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$bills='bills'.$zonenumber;
$x="ALTER TABLE `$bills`  ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$meters='meters'.$zonenumber;
$statushistory='statushistory'.$zonenumber;
$x="ALTER TABLE `$statushistory`  ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$wateraccounts='wateraccounts'.$zonenumber;
$x="ALTER TABLE `$wateraccounts` ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$nonwaterbills='nonwaterbills'.$zonenumber;
$x="ALTER TABLE `$nonwaterbills`   ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));

$accounts='accounts'.$zonenumber;		
$x="ALTER TABLE `$accounts`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
$bills='bills'.$zonenumber;
$x="ALTER TABLE `$bills`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
$meters='meters'.$zonenumber;

$statushistory='statushistory'.$zonenumber;
$x="ALTER TABLE `$statushistory` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
$wateraccounts='wateraccounts'.$zonenumber;
$x="ALTER TABLE `$wateraccounts`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
$nonwaterbills='nonwaterbills'.$zonenumber;
$x="ALTER TABLE `$nonwaterbills`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));	


$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'CREATED ZONE $zonename N0. $zonenumber',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$_SESSION['message']="ZONE ".$zonenumber."CREATED";exit;
?>