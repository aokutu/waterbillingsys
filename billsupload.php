<?php 
@session_start();
set_time_limit(0);
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$table=$_POST['table'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'UPLOAD BILLS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$billdate=$_POST['billingdate'];
$file=$_FILES['file'];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['file']['name']);
$filename = $_FILES['file']['name'];
$newPath = 'uploads/' . basename($_FILES['file']['name']);
$path = $_FILES['file']['name'];
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$lines = 0;
if ($fh = fopen('uploads/'.$filename.'','r')) {
  while (! feof($fh)) {
    if (fgets($fh)) {$lines++;}
  }
}

if($lines >1000){header("LOCATION:accessdenied4.php");

exit;}

$x="SELECT  MAX(ID)  FROM $billstable";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $maxid=$y['MAX(ID)'];  }}
	
$x="CREATE TEMPORARY TABLE BILLSUPLOAD(ACCOUNT TEXT,METERNUMBER TEXT,CLASS TEXT,PREVIOUS FLOAT  DEFAULT 0,CURRENT FLOAT DEFAULT 0,DEDUCTION FLOAT DEFAULT 0,STATUS TEXT,PROCESSEDSTATUS TEXT,UNITS FLOAT DEFAULT 0,METERCHARGES FLOAT DEFAULT 0,WATERCHARGES FLOAT DEFAULT 0,TOTALCHARGES FLOAT DEFAULT 0,METERSIZE FLOAT DEFAULT 0,ACCOUNTSTATUS TEXT,METERSTATUS TEXT,DATE DATE,ID INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
$accounts='accounts'.$zonenumber;		
$x="ALTER TABLE BILLSUPLOAD ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE BILLSUPLOAD  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));

    if (($handle = fopen($target_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $account = substr($data[0], 0,11);
          $x= "INSERT INTO BILLSUPLOAD(ACCOUNT,PREVIOUS,CURRENT,DATE) VALUES ('".$account."','".$data[1]."','".$data[2]."','".$billdate."')";
          mysqli_query($connect,$x)or die(mysqli_error($connect));
          
        }
        fclose($handle);
      }
  $connect->query("DELETE FROM BILLSUPLOAD WHERE PREVIOUS IS NULL OR  CURRENT  IS NULL  ");
   $connect->query("DELETE FROM BILLSUPLOAD WHERE PREVIOUS =0 AND  CURRENT =0 ");
     $connect->query("UPDATE BILLSUPLOAD SET ACCOUNT= TRIM(ACCOUNT),amount= TRIM(PREVIOUS),readx= TRIM(CURRENT)");
     //
     $connect->query("DELETE n1 FROM BILLSUPLOAD n1,BILLSUPLOAD n2 WHERE n1.CURRENT <n2.PREVIOUS AND n1.ACCOUNT =n2.ACCOUNT");
////////////////////////////////
/* $x="SELECT ACCOUNT  FROM BILLSUPLOAD GROUP BY ACCOUNT HAVING COUNT(*)>1;";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){header("Location:accessdenied4.php");exit;}

 $x="DELETE n1 FROM BILLSUPLOAD n1,BILLSUPLOAD n2 WHERE n1.id>n2.id AND n1.ACCOUNT =n2.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));*/
////////////////////////////////////////////////////////////

$x="UPDATE BILLSUPLOAD SET DATE ='$billdate'";mysqli_query($connect,$x)or die(mysqli_error($connect));

 $connect->query("UPDATE BILLSUPLOAD tu, $accountstable ts SET tu.METERNUMBER = ts.METERNUMBER ,tu.CLASS=ts.CLASS, tu.STATUS=ts.STATUS,tu.ACCOUNTSTATUS=ts.STATUS,tu.METERSIZE=ts.SIZE where tu.ACCOUNT=ts.ACCOUNT ");
 
$x="UPDATE BILLSUPLOAD SET  UNITS='0',METERCHARGES='0',WATERCHARGES='0',TOTALCHARGES='0' ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD tu, BILLSUPLOAD ts SET tu.UNITS = ts.CURRENT-ts.PREVIOUS  where tu.ACCOUNT=ts.ACCOUNT AND tu.ID=ts.ID";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD JOIN (    SELECT ACCOUNT, ROUND(AVG(UNITS),0) AS avg_units  FROM $billstable  GROUP BY ACCOUNT ) AS avg_tbl2
ON BILLSUPLOAD.ACCOUNT = avg_tbl2.ACCOUNT SET BILLSUPLOAD.UNITS = avg_tbl2.avg_units WHERE BILLSUPLOAD.UNITS= 0;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
/* $x="UPDATE BILLSUPLOAD SET BILLSUPLOAD.UNITS=(SELECT AVG($billstable.UNITS) FROM $billstable  WHERE $billstable.ACCOUNT = BILLSUPLOAD.ACCOUNT AND DATE  >= DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH) ) WHERE EXISTS ( SELECT 1 FROM $billstable WHERE $billstable.ACCOUNT =BILLSUPLOAD.ACCOUNT
)";mysqli_query($connect,$x)or die(mysqli_error($connect));*/

$x="DELETE FROM BILLSUPLOAD WHERE UNITS <0 OR UNITS IS NULL  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD tu, BILLSUPLOAD ts SET tu.METERSTATUS ='RUNNING'  where tu.ACCOUNT=ts.ACCOUNT AND tu.ID=ts.ID AND ts.CURRENT >ts.PREVIOUS   ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE BILLSUPLOAD tu, BILLSUPLOAD ts SET tu.METERSTATUS ='ESTIMATE'  where tu.ACCOUNT=ts.ACCOUNT AND tu.ID=ts.ID AND ts.CURRENT =ts.PREVIOUS  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='50'    WHERE   METERSIZE='0.5'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='100'    WHERE  METERSIZE='0.75'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='250'    WHERE  METERSIZE='1'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='250'    WHERE  METERSIZE='1.5'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='250'    WHERE  METERSIZE='2'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='450'    WHERE  METERSIZE='3'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='800'    WHERE  METERSIZE='4'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='800'    WHERE  METERSIZE='6'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='1250'    WHERE  METERSIZE='6'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  SET METERCHARGES ='2000'    WHERE  METERSIZE >='8'  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $aa="UPDATE BILLSUPLOAD TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+(TS.RATE*(TU.UNITS-TS.MINUNITS)) WHERE  TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='A' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));


 $aa="UPDATE BILLSUPLOAD  TU, CHARGES TS  SET TU.WATERCHARGES=TS.CHARGES+(TS.RATE*(TU.UNITS-TS.MINUNITS)) WHERE  TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='B' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));

 $aa="UPDATE BILLSUPLOAD  TU, CHARGES TS  SET TU.WATERCHARGES=(TU.UNITS*TS.RATE) WHERE  TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='C' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));

 $aa="UPDATE BILLSUPLOAD  TU, CHARGES TS  SET TU.WATERCHARGES=(TU.UNITS*TS.RATE) WHERE  TU.UNITS >=TS.MINUNITS AND TU.UNITS <=TS.MAXUNITS AND TU.CLASS=TS.CLASS AND TU.CLASS='D' ";
mysqli_query($connect,$aa)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD  TU,  BILLSUPLOAD TS  SET TU.TOTALCHARGES=TS.WATERCHARGES+TS.METERCHARGES WHERE  TU.ACCOUNT=TS.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE BILLSUPLOAD tu, BILLSUPLOAD ts SET tu.TOTALCHARGES =ts.WATERCHARGES+ts.METERCHARGES   WHERE   tu.ID=ts.ID";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE BILLSUPLOAD SET PROCESSEDSTATUS='ACCOUNT MISSING' WHERE ACCOUNT NOT IN(SELECT ACCOUNT  FROM  $accountstable ) ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO $billstable (ACCOUNT,METERNUMBER,CURRENT,PREVIOUS,BALANCE,BILLED,UNITS,CHARGES,METERCHARGES,ACCOUNTSTATUS,METERSTATUS,CLASS,DATE) 
SELECT ACCOUNT,METERNUMBER,CURRENT,PREVIOUS,TOTALCHARGES,UNITS,UNITS,WATERCHARGES,METERCHARGES,ACCOUNTSTATUS,METERSTATUS,CLASS,DATE FROM BILLSUPLOAD
";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE $accountstable tu,BILLSUPLOAD ts  SET tu.EMAIL =ts.CURRENT ,tu.DATE2=ts.DATE  WHERE    tu.ACCOUNT=ts.ACCOUNT ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO events(user,session,action,date) VALUES('$user',DATE_ADD(NOW(), INTERVAL 7 HOUR),'UPLOADED  BILLS TO ZONE $zone  FILE',DATE_ADD(NOW(), INTERVAL 7 HOUR))";
mysqli_query($connect,$x)or die(mysqli_error($connect)); 
///header("Location:billing.php");exit; 
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

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container" >
 <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
  
 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
    <!-- Modal -->
  </div>
  
    <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>

   <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  width ="15%"  height="21" valign="top" >ACCOUNT </td>
			 <td  class="theader"   width ="15%"  height="21" valign="top" >DATE</td> 
			 <td  class="theader"   width ="70%"  height="21" valign="top" >STATUS</td>            
			   
          </tr>
        </thead>
        <tbody>
       <?php
$connect->query(" UPDATE BILLSUPLOAD tu, $billstable ts SET tu.PROCESSEDSTATUS = 'PROCESSED'  where tu.ACCOUNT=ts.ACCOUNT AND tu.PROCESSEDSTATUS !='ACCOUNT MISSING'  AND ts.ID>'$maxid' AND  tu.DATE=ts.DATE ");
$connect->query(" UPDATE BILLSUPLOAD tu, $billstable ts SET tu.PROCESSEDSTATUS = 'BILL POSTED'  where tu.ACCOUNT=ts.ACCOUNT  AND ts.ID>'$maxid' AND  tu.DATE=ts.DATE   ");
$connect->query(" UPDATE BILLSUPLOAD  SET PROCESSEDSTATUS = 'BILL NOT POSTED'  WHERE PROCESSEDSTATUS='' OR PROCESSEDSTATUS IS NULL  ");
	$x=$connect->query(" SELECT ACCOUNT,DATE,PROCESSEDSTATUS,CURRENT,PREVIOUS FROM BILLSUPLOAD  ");
	while ($data = $x->fetch_object())
{ 
		   echo"<tr class='filterdata'>
                <td   width ='15%'  >".$data->ACCOUNT."</td>
                <td   width ='15%'   >".$data->DATE."</td>
                <td  width ='70%' >".$data->PROCESSEDSTATUS."</td> 
		
           </tr>";
		 }
	

	?>
        </tbody>
        </table>
 

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