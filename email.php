<?php
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer-master/src/Exception.php');
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
?>
<?php
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "email@gmail.com";
$mail->Password = "password";
$mail->SetFrom("example@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("email@gmail.com");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }*/
 
 

    ?>
	
	<button type="button" 
    name="btnScanBarcode" 
    id="btnScanBarcode" 
    style="height:56px;border-width:0px;"
    onclick="javascript:startBarcodeScanner();">
<img src="barcode_2d.png" style="height: 50px; width: 50px">
</button>

<script>
function startBarcodeScanner() 
{    
	alert("Using client JavaScript to start scanner.");
	window.location.href = 'bwstw://startscanner?field=txtField2';
}


on_scanner() // init function

function on_scanner() {
    let is_event = false; // for check just one event declaration
    let input = document.getElementById("scanner");
    input.addEventListener("focus", function () {
        if (!is_event) {
            is_event = true;
            input.addEventListener("keypress", function (e) {
                setTimeout(function () {
                    if (e.keyCode == 13) {
                        scanner(input.value); // use value as you need
                        input.select();
                    }
                }, 500)
            })
        }
    });
    document.addEventListener("keypress", function (e) {
        if (e.target.tagName !== "INPUT") {
            input.focus();
        }
    });
}

function scanner(value) {
    if (value == '') return;
    console.log(value)
}

$(document).scannerDetection({
	   
  //https://github.com/kabachello/jQuery-Scanner-Detection

	timeBeforeScanTest: 200, // wait for the next character for upto 200ms
	avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
	preventDefault: true,

	endChar: [13],
		onComplete: function(barcode, qty){
   validScan = true;
   
   
    	$('#scannerInput').val (barcode);
	
    } // main callback function	,
	,
	onError: function(string, qty) {

	$('#userInput').val ($('#userInput').val()  + string);

	
	}
	
	
});
</script>

 <input id="userInput" type="text"  autofocus/>


<br>

<div class="test">


   <input id="scannerInput" type="text" value="barcodescan" autofocus/>
</div>
