<?php
@session_start();
$_SESSION['message']="SEARCHING";
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$account1=$_SESSION['account1'];@$account2=$_SESSION['account2'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS' OR  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW SLIPS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$account1=$_POST['account1'];
@$account2=$_POST['account2'];
$_SESSION['account1']=$account1;
$_SESSION['account2']=$account2;
$lastaccount=strtoupper(addslashes($_POST['lastaccount']));
$x="CREATE TEMPORARY TABLE `currentbalance` (
  `id` INT NOT NULL,
  `account` TEXT NOT NULL,
  `previous` FLOAT NOT NULL,
  `current` FLOAT NOT NULL,
  `consumtion` FLOAT NOT NULL,
  `bill` FLOAT NOT NULL,
  `balbf` FLOAT NOT NULL,
  `totalbill` FLOAT NOT NULL,
  `date` date NOT NULL,
  `billid` text NOT NULL,
  `date2` date NOT NULL,
  RECIEPT TEXT DEFAULT NULL,
  AMNTRCPT FLOAT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `currentbalance`   ADD PRIMARY KEY (`id`);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE `currentbalance`   MODIFY `id` INT NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="CREATE TEMPORARY TABLE REPORT1(ACCOUNT TEXT,CREDIT  FLOAT,DEBIT FLOAT,CUBIC FLOAT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="CREATE TEMPORARY TABLE CHARGES(ACCOUNT TEXT,NAME TEXT,CURRENTREADING TEXT,CHARGES  FLOAT,DATE DATE);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  REPORT1(account,credit)  SELECT $billstable.account,SUM($billstable.balance)  FROM  $billstable  WHERE $billstable.account >='$account1' AND  $billstable.account <='$account2'  GROUP BY $billstable.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  REPORT1(account,credit)  SELECT $nonwaterbills.account,SUM($nonwaterbills.amount)  FROM  $nonwaterbills  WHERE $nonwaterbills.account >='$account1' AND  $nonwaterbills.account <='$account2'  GROUP BY $nonwaterbills.account ";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="UPDATE REPORT1   SET   debit=0  WHERE  debit  IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="INSERT INTO  REPORT1(account,debit)  SELECT $wateraccountstable.account,SUM($wateraccountstable.credit)  FROM $wateraccountstable  WHERE    $wateraccountstable.account >='$account1'   AND $wateraccountstable.account <='$account2'  GROUP BY $wateraccountstable.account";mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO  CHARGES(account,charges)  SELECT  account ,SUM(credit)-SUM(debit)  AS  total   FROM REPORT1  GROUP BY account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE REPORT1   SET   credit=0  WHERE  credit   IS  NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE CHARGES AS U1, $accountstable AS U2  SET U1.name = U2.client,U1.currentreading=U2.email,  U1.date=U2.date2    WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect)); 
////////////////SMS////////////

$x="insert into currentbalance (account,date) select account,max(date) from $billstable where account >='$account1' AND account <='$account2' GROUP BY ACCOUNT ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $billstable AS U2  SET U1.previous= U2.previous , U1.current= U2.current , U1.bill= U2.balance , U1.consumtion=U2.units       WHERE U2.account = U1.account AND U2.date=U1.date  ";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, CHARGES AS U2  SET U1.totalbill= U2.charges   WHERE U2.account = U1.account";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance tu,currentbalance  ts SET tu.balbf = ts.totalbill-ts.bill where tu.id=ts.id";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.date2=U2.depositdate WHERE U2.account = U1.account
AND U2.DEPOSITDATE= ANY(SELECT MAX(DEPOSITDATE) FROM $wateraccountstable where $wateraccountstable.account=U1.account )";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.date2=U2.depositdate WHERE U2.account = U1.account AND U2.DEPOSITDATE= ANY(SELECT MAX(DEPOSITDATE) FROM $wateraccountstable where $wateraccountstable.account=U1.account )";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.RECIEPT=U2.RECIEPTNUMBER WHERE U2.account = U1.account AND U2.DEPOSITDATE= ANY(SELECT MAX(DEPOSITDATE) FROM $wateraccountstable where $wateraccountstable.account=U1.account )";
mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="UPDATE currentbalance AS U1, $wateraccountstable AS U2 SET U1.AMNTRCPT =(SELECT SUM(U2.CREDIT)) WHERE U2.account = U1.account AND U1.RECIEPT=U2.RECIEPTNUMBER ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
 ?>
 
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
   <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
  @media print{tbody{ overflow:visible;}}
#levelchart{ width:80%;}
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #87CEEB; height:350px;  margin-top: 5%; border-radius:2%; text-align:center}
#menu{ background-color: #87CEEB; height:60px;  border-radius:2%; text-align:center  }
body{ font-size:100%;  text-transform:inherit;}
.dropdown-menu{ overflow-y: scroll; height: 300%;width:100%;       
   position: absolute;
}
#dashboard{
  overflow-y: scroll;      
  height: 80%;           
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
			 
			 
			   table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:left;
  }
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $('#acrange').modal('show');
$("#close1").click(function() {
        $("input").val("");
    });
	
$("#close2").click(function() {
        $("input").val("");
    });
var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
  
  $("#loaddetails").click(function()
{
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
$("#slip").load("accountsummary2.php #slip2");
});  return false;
 return false;
})

  $("#loadslip").click(function()
{
	var x=$("#actionx").val();    
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
if(x !='CONNECTED'){$("#slip").load("accountsummary2.php #slip2"); return false;}
else if(x =='CONNECTED'){$("#slip").load("accountsummary2.php #slip3"); return false;}
return false;});  return false;
 return false;
})



$("#accountstatus").submit(function(){
  var x=$("#actionx").val();    
	 if((x =='CONP')||(x=="COR"))
   {
	var x=confirm("CLIENT TO BE BILLED ");   
	 if(x ==false){return false; }  
   }
   
	
	$('#prepostmessage').modal('show');
$.post( "accountstatussummary.php",
$("#accountstatus").serialize(),
function(data){
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})
  })
  
  </script>

<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autocompletelibrary.php",
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

<script>
$(document).ready(function(){
	$("#autosearch1").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autosearch.php",
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
<body style="font-size:140%;">
<div class="container">
  <div class="row">
  <div class="col-sm-8" ><input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off"></div>
    <div class="col-sm-4" >
<button class="btn-info btn-sm" onclick="window.print()">PRINT</button>

</div>

  </div>
     <!-- Modal -->
	  
	   
  </div>
  
  <div id="content">
  <form id="updatecontactform" method="post" action="updatecontactform">
<img src="letterhead.png"   width="70%"  height="30%"  />
<div class="table-responsive">

<h3 style="text-align:center"><strong>DEBTORS  REPORT FROM  <?php print $account1 ;?> TO <?php print $account2;?></strong>
<a href="debtorsreportpdf.php"><i class="fas fa-file-pdf"></i> </a>
<a href="debtorsreportoexcel.php"><i class="fas fa-file-excel"></i> </a>

</h3>
<table class="table"  id="currentbalancetable">
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
       <?php
	$x="select  amntrcpt,$accountstable.account,$accountstable.idnumber,$accountstable.client,$accountstable.meternumber,$accountstable.contact,currentbalance.current ,currentbalance.current,currentbalance.previous,currentbalance.consumtion,currentbalance.bill,currentbalance.balbf,currentbalance.totalbill,currentbalance.reciept,currentbalance.date,currentbalance.date2,IFNULL(DATEDIFF(CURRENT_DATE,currentbalance.date2),'NEVER') AS DDYS FROM  
	$accountstable,currentbalance where  currentbalance.totalbill >0 AND  $accountstable.account=currentbalance.account order by  currentbalance.account,currentbalance.date asc ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		    ?>
 <tr>
            <td  class="theader" height="21" valign="top" >ACCOUNT  </td>
			 <td  class="theader"  height="21"   width="20%" valign="top" >CLIENT. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td  class="theader"  style="text-align:left;"  height="21" valign="top" >ACCUM TTL  </td>   
			
		
				   
		</tr>		    
		    
		    
		    
		    <?php 
		    
		    
		    
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo "<tr   class='filterdata'  >
                <td   >".$y['account']."</td>
				 <td  width='20%' >".$y['client']."</td>
				   <td  >&nbsp;&nbsp;&nbsp;".number_format($y['totalbill'],2)."</td>

           </tr>" ;
		 }
		 }
		 
		 
		 $x="SELECT COUNT(currentbalance.ID),SUM(CONSUMTION),SUM(BILL),SUM(BALBF),SUM(TOTALBILL) FROM $accountstable,currentbalance where  currentbalance.totalbill >0 AND  $accountstable.account=currentbalance.account";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo "<tr  class='btn-info btn-sm'   >
                <td  >TOTAL</td>
				 
				 <td  width='20%' > </td>
			
				   <td  >".number_format($y['SUM(TOTALBILL)'],2)."</td>
				  
				  		
           </tr>" ;
		 }
		 }
	//$x="DROP TEMPORARY TABLE REPORT1";mysqli_query($connect,$x)or die(mysqli_error($connect));
	//$x="DROP TEMPORARY TABLE CHARGES";mysqli_query($connect,$x)or die(mysqli_error($connect));

	?>
        </tbody>
    </table>
</div>
</form>
  </div>



   <form class="modal fade" id="accountstatus" role="dialog" method="post"  action="accountstatussummary.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
<div class="container">
  <div class="row">
  <div class="col-sm-8" >
 <div id="accountdetails"><br>
  <select class="form-control input-sm"  id="loadedzone"  name="zone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select>
	<br>
	ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT"  title="eleven digits" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"     autocomplete="on" ></a><br />
</div>
<br>
<div id="acstatus">current status</div><br><input type="date"  name="date"  id="date"  class="form-control input-sm" required="on" ><br>
<br>
  <select class="form-control input-sm"  id="actionx" name="action" required="on" >
<option value=''>SELECT ACTION</option>
<option value='CONP'>CONP</option>
<option value='COR'>COR</option>
<option value='CONNECTED'>RE-CONNECTION</option>
<option value='FUNCTION'>FUNCTION</div>
<option value='MALFUNCTION'>MALFUNCTION</div>
<option value="STOLEN">STOLEN</option>
</select>
	
<br>

<div  id="slip"></div>
<br>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button>
  <button type="button" class="btn-info btn-sm"  id="loaddetails">LOAD DETAILS</button>  
  <button type="button" class="btn-info btn-sm"  id="loadslip">LOAD SLIP</button>
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>

  </div>
    <div class="col-sm-4" > </div>
  </div>
  </div>
  </div>
  </div>
  </form>
</html> 