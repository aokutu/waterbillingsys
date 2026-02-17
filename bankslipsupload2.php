 <?php 
 @session_start();
set_time_limit(0);
$user=$_SESSION['user'];
$password=$_SESSION['password'];
$zone=$_SESSION['zone'];
include_once("password.php");
$currentmonth=date('Y-m-').'01';
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'UPLOAD SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

    
  $x="CREATE  TEMPORARY TABLE IF NOT EXISTS `BANKTRANSACTION` (
  `TRDATE` text,
  `ACDETAILS` text,
  `REFF` text,
  `AMOUNT` float,
  PAYPOINT text,
  ZONE text,
  STATUS text
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["mpesaslips"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
////////////////////////////////
move_uploaded_file($_FILES["mpesaslips"]["tmp_name"], $target_file);
$filename = $_FILES['mpesaslips']['name'];


    
$lines = 0;
if ($fh = fopen('uploads/'.$filename.'','r')) {
  while (! feof($fh)) {
    if (fgets($fh)) {$lines++;}
  }
}
 
  if($lines >1000){header("LOCATION:accessdenied4.php");exit;}


   if (($handle = fopen($target_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
         //$date=substr($data[1], 0,10);
          $date2 = date('Y-m-d', strtotime(str_replace('/', '-', $data[1])));
         $account = substr($data[5], 0,11);
          $amnt=str_replace(',', '', $data[4]);
         $x= "INSERT INTO BANKTRANSACTION(`TRDATE`,ACDETAILS,REFF,AMOUNT,PAYPOINT) VALUES ('".$date2."','".$account."','".$data[0]."','".$amnt."','MPESA')";
         
          mysqli_query($connect,$x)or die(mysqli_error($connect));
          
        }
        fclose($handle);
      }
      
$x="DELETE FROM BANKTRANSACTION WHERE AMOUNT <='0' OR  ACDETAILS ='' OR ACDETAILS IS  NULL OR REFF ='' OR REFF IS  NULL ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
      $x="UPDATE BANKTRANSACTION SET TRDATE=TRIM(TRDATE),ACDETAILS=TRIM(ACDETAILS),REFF=TRIM(REFF),AMOUNT=TRIM(AMOUNT)";
mysqli_query($connect,$x)or die(mysqli_error($connect));

   $x="UPDATE BANKTRANSACTION SET AMOUNT = REPLACE(AMOUNT, ',', '')";
      mysqli_query($connect,$x)or die(mysqli_error($connect));
    $x="UPDATE BANKTRANSACTION SET PAYPOINT='MPESA' ";
    mysqli_query($connect,$x)or die(mysqli_error($connect));
      	$x=$connect->query("SELECT *  FROM zones  ");
  while ($data = $x->fetch_object())
  { 
      $clienttable='accounts'.$data->number;  $acctstable='wateraccounts'.$data->number;$zone=$data->number;$zonename=$data->zone;
      
      $a=$connect->query("UPDATE BANKTRANSACTION SET ZONE='$zone' WHERE ACDETAILS IN(SELECT ACCOUNT FROM $clienttable) ");
      
        $a=$connect->query("UPDATE BANKTRANSACTION SET STATUS='EXISTS IN ZONE $zonename' WHERE REFF IN (SELECT TRANSACTION FROM $acctstable) AND TRDATE IN(SELECT DEPOSITDATE FROM $acctstable )");    
      
  }

  $a=$connect->query("UPDATE BANKTRANSACTION SET STATUS='ACC MISSING ' WHERE ZONE IS NULL ");
  
  
      	$x=$connect->query("SELECT *  FROM zones  ");
  while ($data = $x->fetch_object())
  { 
      $clienttable='accounts'.$data->number;  $acctstable='wateraccounts'.$data->number;$zone=$data->number;$zonename=$data->zone;
      
      
      $connect->query("INSERT INTO $acctstable (ACCOUNT,CREDIT,DEPOSITDATE,PAYPOINT,TRANSACTION,CODE) SELECT ACDETAILS,AMOUNT,TRDATE,PAYPOINT,REFF,(SELECT CODE FROM paymentcode WHERE NAME= 'WATER BILL' LIMIT 1 ) FROM BANKTRANSACTION WHERE ZONE='$zone' AND STATUS IS  NULL ");
  }
  
  $a=$connect->query("UPDATE BANKTRANSACTION SET STATUS='PROCESSED' WHERE STATUS IS NULL ");
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
 #mainbilling{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:2%;}
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}    .dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

	#zoneheader1{ -webkit-box-reflect: below 2px
			 -webkit-linear-gradient(bottom, white, transparent 40%, transparent); 
			   text-shadow: 0 1px 0 #ccc,
               0 2px 0 #c9c9c9,
               0 3px 0 #bbb,
               0 4px 0 #b9b9b9,
               0 5px 0 #aaa,
               0 6px 1px rgba(0,0,0,.1),
               0 0 5px rgba(0,0,0,.1),
               0 1px 3px rgba(0,0,0,.3),
               0 3px 5px rgba(0,0,0,.2),
               0 5px 10px rgba(0,0,0,.25),
               0 10px 10px rgba(0,0,0,.2),
               0 20px 20px rgba(0,0,0,.15);font-family:"Comic Sans MS";
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#registry").modal();
$('[data-toggle="popover"]').popover(); 
	



  $( '#checkall' ).click( function () {
   $(':checkbox').each(function() {
          this.checked = true;
      });
  })
  
    $( '#checknone' ).click( function () {
   $(':checkbox').each(function() {
          this.checked = false;
      });
  })
  
  
  var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

 })
  
  </script>
    <script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "nometersautocomplete.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container" >
 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
    <!-- Modal -->
  </div>
  
<h4   style="text-align:center"><strong>PAYMENT TRANSACTIONS <a href="data.txt" download>report</a> </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td  class="theader"    height="21" valign="top" >DEPOSIT DATE  </td>
            <td  class="theader"    height="21" valign="top" >ACCOUNT	  </td>
		  <td  class="theader"   height="21" valign="top" >PAYPOINT	  </td>
		  <td  class="theader"   height="21" valign="top" >REFF  </td>
		  <td  class="theader"   height="21" valign="top" >STATUS	  </td>
		  <td  class="theader"   height="21" valign="top" >AMOUNT	  </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
$filename = "data.txt";
$file = fopen($filename, "w");
	fwrite($file,"TRANSACTION DATE "."\t"."AC DETAILS "."\t"."PAYPOINT"."\t"."REFFERENCE"."\t"."STATUS"."\t"."AMOUNT"."\t". "\n");	
	$x=$connect->query("SELECT *  FROM BANKTRANSACTION  ");
  while ($data = $x->fetch_object())
  { 
		
		
	fwrite($file, $data->TRDATE."\t".$data->ACDETAILS."\t".$data->PAYPOINT."\t".$data->REFF."\t".$data->STATUS."\t".number_format($data->AMOUNT,2)."\t". "\n");	
		   echo"<tr class='filterdata'>
		   <td>".$data->TRDATE."</td>
                <td>".$data->ACDETAILS."</td>				
             <td>".$data->PAYPOINT."</td> 
             <td>".$data->REFF."</td>
             <td>".$data->STATUS."</td>
             <td>".number_format($data->AMOUNT,2)."</td>
		
           </tr>";
		 }
	fclose ($file);
	
	
$connect->query("INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'POSTED MPESA SLIPS',DATE_ADD(NOW(), INTERVAL 7 HOUR)) ");
	?>
        </tbody>
		
      </table>
	  <br />
<div class="modal fade" id="prepostmessage" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="prepostcontent"> <img src ='giphy.gif'><h2></div></div></div>
  </div>
 <div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="content"> </div></div></div>
  </div>
</body>
</html>

