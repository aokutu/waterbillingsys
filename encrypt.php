<?php 
require_once 'vendor/autoload.php';
use G4\Crypto\Crypt;
use G4\Crypto\Adapter\OpenSSL;

$crypto = new Crypt(new OpenSSL());
$crypto->setEncryptionKey('tHi5Is');
$file =file_get_contents('lawasco.sql');
$encryptedMessage = $crypto->encode($file);
file_put_contents('xx.txt', $encryptedMessage);

//$message = $crypto->decode(file_get_contents($file));///
//file_put_contents($file, $message);
//print $encryptedMessage;
print "<br>..............<br>".$encryptedMessage;
