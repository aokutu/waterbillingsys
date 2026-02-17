<?PHP
set_time_limit(0);
@session_start();

$companyname=$_POST['companyname']; $companyname=strtoupper($companyname);

$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'COMPANY ADMIN' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$companyname=$_POST['companyname']; $companyname=strtoupper($companyname);

//////////////////////////
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'COMPANY ADMIN' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$companyname=$_POST['companyname']; $companyname=strtoupper($companyname);
$connect2=mysqli_connect('localhost','root','','COMPANY');
$x="SELECT NAME FROM COMPANY WHERE NAME ='$companyname' ";
		$x=mysqli_query($connect2,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{$_SESSION['message']=$companyname."COMPANY EXISTS"; exit;}
	$x="INSERT INTO COMPANY (NAME) VALUES('$companyname')";mysqli_query($connect2,$x)or die(mysqli_error($connect));
	$connect3=mysqli_connect('localhost','root','');
$x="CREATE DATABASE $companyname ";mysqli_query($connect3,$x)or die(mysqli_error($connect3));
$connect4=mysqli_connect('localhost','root','',$companyname);
$zonenumber=1;
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
  `balance` float DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` float NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL,
  `plotnumber` text NOT NULL,
  `deposit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE `purchasesrequisition` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `units` text NOT NULL,
  `prevbalance` int(11) NOT NULL,
  `price` float NOT NULL,
  `value` float NOT NULL,
  `purpose` text NOT NULL,
  `requester` text NOT NULL,
  `requestertitle` text NOT NULL,
  `checker` text NOT NULL,
  `checkertitle` text NOT NULL,
  `confirmer` text NOT NULL,
  `confirmertitle` text NOT NULL,
  `approver` text NOT NULL,
  `approvertitle` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE `adjustment` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

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
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)
";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));	 
$meters='meters'.$zonenumber;
 $x="CREATE TABLE IF NOT EXISTS `$meters` (
  `id` int(11) NOT NULL,
  `meternumber` text,
  `serialnumber` text NOT NULL,
  `size` text,
  `account` text NOT NULL,
  `status` text,
  `date` date  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$statushistory='statushistory'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$statushistory` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$wateraccounts='wateraccounts'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$wateraccounts` (
  `id` int(11) NOT NULL,
  `transaction` text DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `account` text DEFAULT NULL,
  `depositdate` text DEFAULT NULL,
  `code` text NOT NULL,
  `credit2` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `linked` text NOT NULL,
  `recieptnumber` text NOT NULL,
  `recieptdate` date NOT NULL,
  `paypoint` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$nonwaterbills='nonwaterbills'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$nonwaterbills` (
  `account` TEXT NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` float NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$accounts='accounts'.$zonenumber;		
$x="ALTER TABLE `$accounts`ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$bills='bills'.$zonenumber;
$x="ALTER TABLE `$bills`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$meters='meters'.$zonenumber;
$x="ALTER TABLE `$meters`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$statushistory='statushistory'.$zonenumber;
$x="ALTER TABLE `$statushistory`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$wateraccounts='wateraccounts'.$zonenumber;
$x="ALTER TABLE `$wateraccounts` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$nonwaterbills='nonwaterbills'.$zonenumber;
$x="ALTER TABLE `$nonwaterbills`   ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$accounts='accounts'.$zonenumber;		
$x="ALTER TABLE `$accounts`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$bills='bills'.$zonenumber;
$x="ALTER TABLE `$bills`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$meters='meters'.$zonenumber;
$x="ALTER TABLE `$meters`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$statushistory='statushistory'.$zonenumber;
$x="ALTER TABLE `$statushistory` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$wateraccounts='wateraccounts'.$zonenumber;
$x="ALTER TABLE `$wateraccounts`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));	
$nonwaterbills='nonwaterbills'.$zonenumber;
$x="ALTER TABLE `$nonwaterbills`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));	


$x="CREATE TABLE IF NOT EXISTS `wateraccounts` (
  `transaction` text,
  `credit` float DEFAULT NULL,
  `account` text,
  `depositdate` text,
  `code` text NOT NULL,
  `credit2` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `wateraccounts`
  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  $x="ALTER TABLE `wateraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  $x="CREATE TABLE `stockin` (
  `id` int(11) NOT NULL,
  `itemcode` text NOT NULL,
  `item` text DEFAULT NULL,
  `locality` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float DEFAULT NULL,
  `unitprice` float NOT NULL,
  `price` float NOT NULL,
  `batchnumber` text DEFAULT NULL,
  `expire` date DEFAULT NULL,
  `ordernumber` text NOT NULL,
  `invoicenumber` text DEFAULT NULL,
  `vouchernumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `supplier` text DEFAULT NULL,
  `department` text NOT NULL,
  `delivery` text NOT NULL,
  `deliverydesignation` text NOT NULL,
  `receipient` text NOT NULL,
  `receipientdesignation` text NOT NULL,
  `stockbalance` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

  $x="CREATE TABLE IF NOT EXISTS `deposituploads` (
  `transaction` text,
  `credit` float DEFAULT NULL,
  `account` text,
  `depositdate` text,
  `code` text NOT NULL,
  `credit2` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `zone` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `deposituploads`
  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  $x="ALTER TABLE `deposituploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  $x="
CREATE TABLE IF NOT EXISTS `balance3` (
  `id` bigint(20) NOT NULL,
  `account` text NOT NULL,
  `previous` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `consumtion` int(11) NOT NULL,
  `bill` float NOT NULL,
  `balbf` float NOT NULL,
  `totalbill` int(11) NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL,
  `date2` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=latin1;";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  
$x="CREATE TABLE IF NOT EXISTS `chatroom` (
  `sender` text NOT NULL,
  `message` text NOT NULL,
  `recipient` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));	


$x="CREATE TABLE IF NOT EXISTS `contactsupload` (
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `currentcharges` (
  `account` text NOT NULL,
  `name` text NOT NULL,
  `currentreading` text NOT NULL,
  `charges` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `category` text NOT NULL,
  `itemcode` text NOT NULL,
  `minstocklevel` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `bprice` float NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE `itemcategories` (`category` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE `localpurchaseorders` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) NOT NULL,
  `supplier` text NOT NULL,
  `reffnumber` text NOT NULL,
  `contractreff` text NOT NULL,
  `contractdate` date NOT NULL,
  `requisitionreff` text NOT NULL,
  `requisitiondate` date NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `session` text NOT NULL,
  `action` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=564 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `newbill` (
  `identity` text NOT NULL,
  `account` text NOT NULL,
  `units` float NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));


$x="CREATE TABLE IF NOT EXISTS `offline` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL,
  `G` text NOT NULL,
  `H` text NOT NULL,
  `I` text NOT NULL,
  `J` text NOT NULL,
  `K` text NOT NULL,
  `L` text NOT NULL,
  `M` text NOT NULL,
  `N` text NOT NULL,
  `O` text NOT NULL,
  `P` text NOT NULL,
  `Q` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `outbox` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `productionmeters` (
  `id` int(11) NOT NULL,
  `refferencenumber` text NOT NULL,
  `location` text NOT NULL,
  `reading` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `mapping` (
   `id` int(11) NOT NULL,
  `lattitude` text NOT NULL,
  `longitude` text NOT NULL,
  `account` text NOT NULL,
  `client` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `report` (
 `account` bigint(20) NOT NULL,
  `credit` float NOT NULL,
  `debit` float NOT NULL,
  `cubic` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `revenue` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `sms` (
  `id` bigint(20) NOT NULL,
  `account` text NOT NULL,
  `previous` float NOT NULL,
  `current` float NOT NULL,
  `consumtion` float NOT NULL,
  `standingcharges` float NOT NULL,
  `commission` float NOT NULL,
  `bill` float NOT NULL,
  `balbf` float NOT NULL,
  `totalbill` float NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `statement` (
  `A` text,
  `B` text,
  `C` text,
  `D` text,
  `E` text,
  `F` text,
  `G` text,
  `H` text,
  `I` text NOT NULL,
  `transaction` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket` int(4) unsigned zerofill NOT NULL,
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `complain` text NOT NULL,
  `category` text NOT NULL,
  `assign` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `access` text NOT NULL,
  `logged` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `waterflow` (
  `flow` text NOT NULL,
  `inflow` text NOT NULL,
  `outflow` int(11) NOT NULL,
  `collection` float NOT NULL,
  `revenue` float NOT NULL,
  `billed` float NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `zone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `metertrail` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `account` text NOT NULL,
  `activity` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `metertrail` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `metertrail` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `waterproduction` (
  `id` int(11) NOT NULL,
  `refferencenumber` text NOT NULL,
  `location` text NOT NULL,
  `previous` float NOT NULL,
  `current` float NOT NULL,
  `units` float NOT NULL,
  `chlorine` float NOT NULL,
  `price` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `zones` (
  `zone` text NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="INSERT INTO  ZONES(ZONE,NUMBER) VALUES('ZONE $zonenumber',$zonenumber)";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `financearchive` (
  `account` text NOT NULL,
  `zone` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `archived` date NOT NULL,
  `transaction` text NOT NULL,
  `meternumber` text NOT NULL,
  `consumsion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `paymentcode` (
  `code` text NOT NULL,
  `name` text NOT NULL,
  `effect` text NOT NULL,
  `dbcode` text NOT NULL,
  `charges` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `balance1` (
  `account` text NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `balance2` (
  `account` text NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));


$x="CREATE TABLE IF NOT EXISTS `opentable1` (
  `id` int(11) NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL,
  `G` text NOT NULL,
  `H` text NOT NULL,
  `J` text NOT NULL,
  `K` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `search` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `search` ADD PRIMARY KEY (`id`)";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `search`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `repairs` (
  `id` int(11) NOT NULL,
  `location` text NOT NULL,
  `long` text NOT NULL,
  `latt` text NOT NULL,
  `ticket` text NOT NULL,
  `status` text NOT NULL,
  `damages` text NOT NULL,
  `reportdate` date NOT NULL,
  `completiondate` date NOT NULL,
  `technician` text NOT NULL,
  `materials` text NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `debtregistry` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `initialbal` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `currentbal` int(11) NOT NULL,
  `installment` int(11) NOT NULL,
  `date` date NOT NULL,
  `date2` date NOT NULL,
  `regdate` date NOT NULL,
  `zone` text NOT NULL
  
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `debtregistry` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `debtregistry`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `debtpay` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `amount` float NOT NULL,
  `details` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
 
$x="CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL,
  `item` text,
  `price` text,
  `quantity` text,
  `total` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `reciept` (
  `id` int(11) NOT NULL,
  `item` text,
  `price` text,
  `quantity` text,
  `total` text,
  `refference` int(6) unsigned zerofill NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE `gatepass` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `issuenote` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `issuer` text NOT NULL,
  `issuertitle` text NOT NULL,
  `receiver` text NOT NULL,
  `receivertitle` text NOT NULL,
  `transporter` text NOT NULL,
  `transportertitle` text NOT NULL,
  `vehicle` text NOT NULL,
  `vehiclenumber` text NOT NULL,
  `pointofuse` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE `clientquotations` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `account` text NOT NULL,
  `names` text NOT NULL,
  `contact` text NOT NULL,
  `plotnumber` text NOT NULL,
  `location` text NOT NULL,
  `preparer` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE `stockout` (
  `id` int(11) NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `transactionreff` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE `supplierpayment` (
  `id` int(11) NOT NULL,
  `supplier` text NOT NULL,
  `paymode` text NOT NULL,
  `payrefference` text NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier` text DEFAULT NULL,
  `boxaddress` text NOT NULL,
  `phonenumber` text NOT NULL,
  `email` text NOT NULL,
  `balance` text NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `WATERBILLINGRATES` (
`id` int(11) NOT NULL,
`units` int NOT NULL,
  `A` float,
  `B` float,
  `C` float,
  `D` float
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `WATERBILLINGRATES` ADD PRIMARY KEY (`id`);

ALTER TABLE `WATERBILLINGRATES`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
 $x="
CREATE TABLE `accountsstatus` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `status` text NOT NULL,
  `class` text NOT NULL,
  `zone` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
ALTER TABLE `accountsstatus`  ADD PRIMARY KEY (`id`);
ALTER TABLE `accountsstatus`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `METERRATES` (
  `id` int(11) NOT NULL,
  `SIZE` float,
  `CHARGES` float
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `METERRATES` ADD PRIMARY KEY (`id`);
ALTER TABLE `METERRATES`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `stockout`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `stockout` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `supplierpayment`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `supplierpayment` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `suppliers`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `suppliers` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="ALTER TABLE `bAlance3`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `bAlance3` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `clientquotations`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `clientquotations` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `stockin`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `stockin`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="ALTER TABLE `debtpay`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `debtpay`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `opentable1`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `opentable1`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `events` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `outbox` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `productionmeters` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `sms` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `statement`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `users` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `waterproduction`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `events`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=564;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `outbox`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `productionmeters`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `sms`   MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `statement` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `users`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `waterproduction`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `inventory`  ADD PRIMARY KEY (`id`)";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `inventory`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `repairs`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `repairs`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `SALES` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `SALES`MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `RECIEPT` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `RECIEPT`MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="INSERT INTO users (name, password, access, logged) VALUES('HADDASSAH', 'haddassah', 'USERS ADMIN,BACKUP DATABASE,
AUDIT TRAIL,RESET PASSWORD,PRODUCTION BILLING,POST SMS-EMAILS,SEND  SMS-EMAILS,EDIT CONTACTS,DELETE SMS-EMAILS,
BILLING,VIEW BILLS,UNLOCK BILLS,DELETE BILLS,EDIT BILLS,IMAGE ARCHIVES,VIEW SLIPS,ADD SLIPS,DELETE SLIPS,
UPLOAD SLIPS,EDIT SLIPS,VIEW REPORTS,ACCOUNTS REG,EDIT ACCOUNT,UPDATE STATUS,DELETE ACCOUNT,NEW CONNECTION,
METER REG,NEW METER,EDIT METER,DELETE METER,GENERATE TICKETS,ASSIGN TICKETS,POST TICKETS,DELETE TICKETS,
UPDATE CORDINATES,GENERATE MAP', 'OFF')";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

        $is_conn = true; //action when connected
		//////////////////SMS CODE/////////
		$contact="254711487030";$message=$companyname;
	$url = 'https://sms.lamuwater.co.ke/api/services/sendsms/';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


  $curl_post_data = array(
          //Fill in the request parameters with valid values
         'partnerID' => '215',
         'apikey' => '094610704102e238472f243a61e6d152',
         'mobile' => $contact,
         'message' => $message,
         'shortcode' => 'LAMU-WATER',
         'pass_type' => 'plain', //bm5 {base64 encode} or plain
  );

  $data_string = json_encode($curl_post_data);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

  $curl_response = curl_exec($curl);
  //print_r($curl_response);
	//////////////////////////
	print passthru("internet.pyw ");
		$_SESSION['message']=$companyname."CREATED";
        fclose($connected);
    
//////////////////////////
exit;


function is_connected()
{
  $connected = @fsockopen("216.58.223.69",443); 
	//$connected = @fsockopen("127.0.0.1",80); 

                                        //website, port  (try 80 or 443)
if ($connected){
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'COMPANY ADMIN' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$companyname=$_POST['companyname']; $companyname=strtoupper($companyname);
$connect2=mysqli_connect('localhost','root','','COMPANY');
$x="SELECT NAME FROM COMPANY WHERE NAME ='$companyname' ";
		$x=mysqli_query($connect2,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{$_SESSION['message']=$companyname."COMPANY EXISTS"; exit;}
	$x="INSERT INTO COMPANY (NAME) VALUES('$companyname')";mysqli_query($connect2,$x)or die(mysqli_error($connect));
	$connect3=mysqli_connect('localhost','root','');
$x="CREATE DATABASE $companyname ";mysqli_query($connect3,$x)or die(mysqli_error($connect3));
$connect4=mysqli_connect('localhost','root','',$companyname);
$zonenumber=1;
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
  `email` int(11) DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `avg` text NOT NULL,
  `avgunit` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `lattitude` text NOT NULL,
  `clientemail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));


$bills='bills'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$bills` (
  `id` int(11) NOT NULL,
  `meternumber` text,
  `current` bigint(20) DEFAULT NULL,
  `previous` bigint(20) DEFAULT NULL,
  `account` text,
  `balance` int(11) DEFAULT NULL,
  `units` decimal(11,0) DEFAULT NULL,
  `charges` decimal(11,0) DEFAULT NULL,
  `metercharges` decimal(11,0) DEFAULT NULL,
  `refuse` int(11) DEFAULT NULL,
  `status` text,
  `reciept` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)
";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));	 
$meters='meters'.$zonenumber;
 $x="CREATE TABLE IF NOT EXISTS `$meters` (
  `id` int(11) NOT NULL,
  `meternumber` text,
  `serialnumber` text NOT NULL,
  `size` text,
  `account` text NOT NULL,
  `status` text,
  `date` date  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$statushistory='statushistory'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$statushistory` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `meter` text NOT NULL,
  `status` text NOT NULL,
  `task` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$wateraccounts='wateraccounts'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$wateraccounts` (
  `transaction` text,
  `credit` decimal(10,0) DEFAULT NULL,
  `account` text,
  `depositdate` text,
  `code` text NOT NULL,
  `credit2` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;# MySQL returned an empty result set (i.e. zero rows)
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$nonwaterbills='nonwaterbills'.$zonenumber;
$x="CREATE TABLE IF NOT EXISTS `$nonwaterbills` (
  `account` TEXT NOT NULL,
  `meternumber` text NOT NULL,
  `name` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$accounts='accounts'.$zonenumber;		
$x="ALTER TABLE `$accounts`ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$bills='bills'.$zonenumber;
$x="ALTER TABLE `$bills`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$meters='meters'.$zonenumber;
$x="ALTER TABLE `$meters`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$statushistory='statushistory'.$zonenumber;
$x="ALTER TABLE `$statushistory`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$wateraccounts='wateraccounts'.$zonenumber;
$x="ALTER TABLE `$wateraccounts` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$nonwaterbills='nonwaterbills'.$zonenumber;
$x="ALTER TABLE `$nonwaterbills`   ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$accounts='accounts'.$zonenumber;		
$x="ALTER TABLE `$accounts`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$bills='bills'.$zonenumber;
$x="ALTER TABLE `$bills`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$meters='meters'.$zonenumber;
$x="ALTER TABLE `$meters`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$statushistory='statushistory'.$zonenumber;
$x="ALTER TABLE `$statushistory` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$wateraccounts='wateraccounts'.$zonenumber;
$x="ALTER TABLE `$wateraccounts`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));	
$nonwaterbills='nonwaterbills'.$zonenumber;
$x="ALTER TABLE `$nonwaterbills`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));	


$x="CREATE TABLE IF NOT EXISTS `wateraccounts` (
  `transaction` text,
  `credit` decimal(10,0) DEFAULT NULL,
  `account` text,
  `depositdate` text,
  `code` text NOT NULL,
  `credit2` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `wateraccounts`
  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  $x="ALTER TABLE `wateraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  

  $x="CREATE TABLE IF NOT EXISTS `deposituploads` (
  `transaction` text,
  `credit` decimal(10,0) DEFAULT NULL,
  `account` text,
  `depositdate` text,
  `code` text NOT NULL,
  `credit2` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` text NOT NULL,
  `zone` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `deposituploads`
  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  $x="ALTER TABLE `deposituploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  $x="
CREATE TABLE IF NOT EXISTS `balance3` (
  `id` bigint(20) NOT NULL,
  `account` text NOT NULL,
  `previous` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `consumtion` int(11) NOT NULL,
  `bill` int(11) NOT NULL,
  `balbf` int(11) NOT NULL,
  `totalbill` int(11) NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL,
  `date2` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=latin1;";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
  
$x="CREATE TABLE IF NOT EXISTS `chatroom` (
  `sender` text NOT NULL,
  `message` text NOT NULL,
  `recipient` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));	


$x="CREATE TABLE IF NOT EXISTS `contactsupload` (
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `currentcharges` (
  `account` text NOT NULL,
  `name` text NOT NULL,
  `currentreading` text NOT NULL,
  `charges` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));


$x="CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `session` text NOT NULL,
  `action` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=564 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `newbill` (
  `identity` text NOT NULL,
  `account` text NOT NULL,
  `units` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE `quotationrequests` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` float NOT NULL,
  `supplier` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `offline` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL,
  `G` text NOT NULL,
  `H` text NOT NULL,
  `I` text NOT NULL,
  `J` text NOT NULL,
  `K` text NOT NULL,
  `L` text NOT NULL,
  `M` text NOT NULL,
  `N` text NOT NULL,
  `O` text NOT NULL,
  `P` text NOT NULL,
  `Q` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `outbox` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `productionmeters` (
  `id` int(11) NOT NULL,
  `refferencenumber` text NOT NULL,
  `location` text NOT NULL,
  `reading` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `mapping` (
  `lattitude` text NOT NULL,
  `id` int(11) NOT NULL,
  `longitude` text NOT NULL,
  `account` text NOT NULL,
  `client` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `report` (
 `account` bigint(20) NOT NULL,
  `credit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `cubic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `revenue` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `sms` (
  `id` bigint(20) NOT NULL,
  `account` text NOT NULL,
  `previous` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `consumtion` int(11) NOT NULL,
  `bill` int(11) NOT NULL,
  `balbf` int(11) NOT NULL,
  `totalbill` int(11) NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `statement` (
  `A` text,
  `B` text,
  `C` text,
  `D` text,
  `E` text,
  `F` text,
  `G` text,
  `H` text,
  `I` text NOT NULL,
  `transaction` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket` int(4) unsigned zerofill NOT NULL,
  `account` text NOT NULL,
  `contact` text NOT NULL,
  `complain` text NOT NULL,
  `category` text NOT NULL,
  `assign` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `access` text NOT NULL,
  `logged` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `waterflow` (
  `flow` text NOT NULL,
  `inflow` text NOT NULL,
  `outflow` int(11) NOT NULL,
  `collection` int(11) NOT NULL,
  `revenue` int(11) NOT NULL,
  `billed` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `zone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `metertrail` (
  `id` int(11) NOT NULL,
  `meternumber` text NOT NULL,
  `account` text NOT NULL,
  `activity` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `metertrail` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `metertrail` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE IF NOT EXISTS `waterproduction` (
  `id` int(11) NOT NULL,
  `refferencenumber` text NOT NULL,
  `location` text NOT NULL,
  `previous` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `chlorine` int(11) NOT NULL,
  `price` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `zones` (
  `zone` text NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="INSERT INTO  ZONES(ZONE,NUMBER) VALUES('ZONE $zonenumber',$zonenumber)";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `financearchive` (
  `account` text NOT NULL,
  `zone` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `archived` date NOT NULL,
  `transaction` text NOT NULL,
  `meternumber` text NOT NULL,
  `consumsion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `paymentcode` (
  `code` text NOT NULL,
  `name` text NOT NULL,
  `effect` text NOT NULL,
  `dbcode` text NOT NULL,
  `charges` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `balance1` (
  `account` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `balance2` (
  `account` text NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `opentable1` (
  `id` int(11) NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `F` text NOT NULL,
  `G` text NOT NULL,
  `H` text NOT NULL,
  `J` text NOT NULL,
  `K` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `search` (
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `E` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `search` ADD PRIMARY KEY (`id`)";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `search`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `repairs` (
  `id` int(11) NOT NULL,
  `location` text NOT NULL,
  `long` text NOT NULL,
  `latt` text NOT NULL,
  `ticket` text NOT NULL,
  `status` text NOT NULL,
  `damages` text NOT NULL,
  `reportdate` date NOT NULL,
  `completiondate` date NOT NULL,
  `technician` text NOT NULL,
  `materials` text NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `debtregistry` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `initialbal` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `currentbal` int(11) NOT NULL,
  `installment` int(11) NOT NULL,
  `date` date NOT NULL,
  `date2` date NOT NULL,
  `regdate` date NOT NULL,
  `zone` text NOT NULL
  
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `debtregistry` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `debtregistry`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="CREATE TABLE IF NOT EXISTS `debtpay` (
  `id` int(11) NOT NULL,
  `account` text NOT NULL,
  `amount` int(11) NOT NULL,
  `details` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
 
$x="CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL,
  `item` text,
  `price` text,
  `quantity` text,
  `total` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="CREATE TABLE `lpos` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `price` float NOT NULL,
  `quantity` float NOT NULL,
  `amount` float NOT NULL,
  `supplier` text NOT NULL,
  `tendernumber` text NOT NULL,
  `contractnumber` text NOT NULL,
  `contractdate` date NOT NULL,
  `requisitionnumber` text NOT NULL,
  `requisitiondate` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
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
$x="CREATE TABLE `requisition` (
  `id` int(11) NOT NULL,
  `serialnumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `itemcode` text NOT NULL,
  `item` text NOT NULL,
  `units` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `value` float NOT NULL,
  `purpose` text NOT NULL,
  `requisitioner` text NOT NULL,
  `requisitionertitle` text NOT NULL,
  `authorizer` text NOT NULL,
  `authorizertitle` text NOT NULL,
  `issuer` text NOT NULL,
  `issuertitle` text NOT NULL,
  `approver` text NOT NULL,
  `approvertitle` text NOT NULL,
  `status` text NOT NULL,
  `transactionreff` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `idnumber` text NOT NULL,
  `names` text NOT NULL,
  `paypoint` text NOT NULL,
  `month` text NOT NULL,
  `postingdate` date NOT NULL,
  `basicsalary` float NOT NULL,
  `travelallowance` float NOT NULL,
  `houseallowance` float NOT NULL,
  `hardshipallowance` float NOT NULL,
  `payee` float NOT NULL,
  `nhif` float NOT NULL,
  `nssf` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `idnumber` text NOT NULL,
  `krapin` text NOT NULL,
  `title` text NOT NULL,
  `names` text NOT NULL,
  `basicsalary` float NOT NULL,
  `houseallowance` float NOT NULL,
  `travelallowance` float NOT NULL,
  `hardshipallowance` float NOT NULL,
  `payee` float NOT NULL,
  `nhif` float NOT NULL,
  `nssf` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="CREATE TABLE `lastrecieptnumber` (
  `lastnumber` bigint(7) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `payroll` ADD PRIMARY KEY (`id`);";
  mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `staffs`  ADD PRIMARY KEY (`id`);";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `payroll` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `staffs` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
 
$x="ALTER TABLE `$mastermeterbill` ADD PRIMARY KEY (`id`)";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `$mastermeterbill` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `lpos`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `lpos` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `requisition`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `requisition` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="ALTER TABLE `adjustment`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `adjustment` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `bAlance3`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `bAlance3` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";
mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `purchasesrequisition`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `purchasesrequisition` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `quotationrequests`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `quotationrequests` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="ALTER TABLE `gatepass`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `gatepass` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `localpurchaseorders`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `localpurchaseorders` MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

$x="ALTER TABLE `debtpay`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `debtpay`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `opentable1`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `opentable1`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `events` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `outbox` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `productionmeters` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `sms` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `statement`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `users` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `waterproduction`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `events`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=564;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `outbox`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `productionmeters`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `sms`   MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `statement` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `users`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `waterproduction`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `repairs`  ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `repairs`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `SALES` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `SALES`MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `RECIEPT` ADD PRIMARY KEY (`id`);";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="ALTER TABLE `RECIEPT`MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1";mysqli_query($connect4,$x)or die(mysqli_error($connect4));
$x="INSERT INTO users (name, password, access, logged) VALUES('HADDASSAH', 'haddassah', 'USERS ADMIN', 'OFF')";mysqli_query($connect4,$x)or die(mysqli_error($connect4));

        $is_conn = true; //action when connected
		//////////////////SMS CODE/////////
		$contact="254711487030";$message=$companyname;
	$url = 'https://sms.lamuwater.co.ke/api/services/sendsms/';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header


  $curl_post_data = array(
          //Fill in the request parameters with valid values
         'partnerID' => '215',
         'apikey' => '094610704102e238472f243a61e6d152',
         'mobile' => $contact,
         'message' => $message,
         'shortcode' => 'LAMU-WATER',
         'pass_type' => 'plain', //bm5 {base64 encode} or plain
  );

  $data_string = json_encode($curl_post_data);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

  $curl_response = curl_exec($curl);
  //print_r($curl_response);
	//////////////////////////
	print passthru("internet.pyw ");
		$_SESSION['message']=$companyname."CREATED";
        fclose($connected);
    }else{
        $is_conn = false;
$_SESSION['message']="NO INTERNET CONNECTION";exit;     
}


}
is_connected();

$_SESSION['message']=$companyname."COMPANY CREATED";exit; 
?>