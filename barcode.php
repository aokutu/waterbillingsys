<?php
print  "xxxx";
require_once 'backup/vendor/autoload.php';
use \Milon\Barcode\DNS1D;

$d = new DNS1D();
$d->setStorPath(__DIR__.'/cache/');
echo $d->getBarcodeHTML('9780691147727', 'EAN13');