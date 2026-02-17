<?php 
 @session_start();
 require_once 'vendor/autoload.php';
use SakibRahaman\DecimalToWords\DecimalToWords;
//print floor(12.56)."<br>";
print fmod(12.567,1);
print round(12.567,2)


/*
// Basic
$converted_number = DecimalToWords::convert(123.529);
var_dump($converted_number);
// One Hundred Twenty Three Point Fifty Three

// With currency ( 'currency_whole' & 'currency_decimal')
$converted_number = DecimalToWords::convert(42123.529,'dollar',
    'cents');
var_dump($converted_number);
// Forty Two Thousand One Hundred Twenty Three dollar and Fifty Three cents

// With case ('lower' & 'upper')
$converted_number = DecimalToWords::convert(42123.529,'dollar',
    'cents','upper');
var_dump($converted_number);
// FORTY TWO THOUSAND ONE HUNDRED TWENTY THREE DOLLAR AND FIFTY THREE CENTS

*/

/*require_once 'vendor/autoload.php';
use Konekt\PdfInvoice\InvoicePrinter;

  $invoice = new InvoicePrinter();
  
  /* Header settings */
 // $invoice->setLogo("images/sample1.jpg");   //logo image path
  /*$invoice->setColor("#007fff");      // pdf color scheme
  $invoice->setType("Sale Invoice");    // Invoice Type
  $invoice->setReference("INV-55033645");   // Reference
  $invoice->setDate(date('M dS ,Y',time()));   //Billing Date
  $invoice->setTime(date('h:i:s A',time()));   //Billing Time
  $invoice->setDue(date('M dS ,Y',strtotime('+3 months')));    // Due Date
  $invoice->setFrom(array("Seller Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740"));
  $invoice->setTo(array("Purchaser Name","Sample Company Name","128 AA Juanita Ave","Glendora , CA 91740"));
  
  $invoice->addItem("AMD Athlon X2DC-7450","2.4GHz/1GB/160GB/SMP-DVD/VB",6,0,580,0,3480);
  $invoice->addItem("PDC-E5300","2.6GHz/1GB/320GB/SMP-DVD/FDD/VB",4,0,645,0,2580);
  $invoice->addItem('LG 18.5" WLCD',"",10,0,230,0,2300);
  $invoice->addItem("HP LaserJet 5200","",1,0,1100,0,1100);
  
  $invoice->addTotal("Total",9460);
  $invoice->addTotal("VAT 21%",1986.6);
  $invoice->addTotal("Total due",11446.6,true);
  
  $invoice->addBadge("Payment Paid");
  
  $invoice->addTitle("Important Notice");
  
  $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");
  
  $invoice->setFooternote("My Company Name Here");
  
  $invoice->render('example1.pdf','I'); */
  ?>