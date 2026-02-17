<?php
$connect=mysqli_connect('localhost','lawascoco','Stealmouse@355.','lawascoco_Lawasco');
/*
$x="CREATE TEMPORARY TABLE `accountsuploads` (
  `id` INT NOT NULL,
  `account` TEXT NOT NULL,
  `amount` FLOAT,
   `readx` FLOAT,
  `class` TEXT,
  `meternumber` TEXT
)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `accountsuploads`   ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `accountsuploads`   MODIFY `id` INT NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
 

$target_file='export2.csv';
  if (($handle = fopen($target_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
        {
  $x="INSERT INTO accountsuploads (ACCOUNT,AMOUNT) VALUES('$data[0]','$data[1]')";  
  mysqli_query($connect,$x)or die(mysqli_error($connect));}
        fclose($handle);
      }
  $x="UPDATE accountsuploads SET account= TRIM(account),amount=TRIM(amount)";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="DELETE FROM  bills7 WHERE  DATE <='2023-12-31'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE accountsuploads AS U1, accounts7 AS U2 SET U1.class=U2.class WHERE U1.account=U2.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO bills7 (ACCOUNT,BALANCE,STATUS,METERSTATUS,CLASS,DATE,USER) SELECT ACCOUNT,AMOUNT,CONCAT('ADJUSTMENT'),CONCAT('RUNNING'),CLASS,CONCAT('2023-12-31'),CONCAT('ANDREW') FROM accountsuploads 
";

mysqli_query($connect,$x)or die(mysqli_error($connect));
/*
$x="INSERT INTO accounts1(account,meternumber,class,client,status,email,size) 
SELECT account,account,CONCAT('A'),account,CONCAT('CONNECTED'),readx,CONCAT('0.5') FROM accountsuploads WHERE ACCOUNT NOT IN (SELECT ACCOUNT FROM accounts6) ;
";  mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="TRUNCATE meters6 ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO meters6 (account,meternumber,serialnumber,status,size) 
SELECT account,account,meternumber,CONCAT('FUNCTION'),size FROM accounts6  WHERE METERNUMBER !='NOT INSTALLED' ;
";  mysqli_query($connect,$x)or die(mysqli_error($connect)); 
$x="DELETE  FROM  clientmetersreg WHERE account LIKE '376006%'";
mysqli_query($connect,$x)or die(mysqli_error($connect)); 
 
$x="INSERT INTO clientmetersreg (account,meternumber,serialnumber,status,size,zone) 
SELECT account,account,meternumber,CONCAT('FUNCTION'),size,CONCAT(7) FROM accounts6  WHERE METERNUMBER !='NOT INSTALLED';
";  mysqli_query($connect,$x)or die(mysqli_error($connect)); 

$x="INSERT INTO bills6(account,status,balance,meterstatus,class,date,user) 
SELECT account,CONCAT('ADJUSTMENT'),amount,CONCAT('RUNNING'),CONCAT('A'),CONCAT('2023-12-31'),CONCAT('ANDREW') FROM accountsuploads WHERE amount >0  OR amount <0 ;
";  mysqli_query($connect,$x)or die(mysqli_error($connect)); */

print "xx";
?>