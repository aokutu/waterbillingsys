<?php 
session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$account1=$_SESSION['account1'];
$account2=$_SESSION['account2'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
if($date1 == NULL ){$date1=date('Y-m-d');}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'ACCOUNTS TRAIL'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
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

@media print {
  a[href]:after {
    content: none !important;
  }
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
$('[data-toggle="popover"]').popover(); 
  $('#acrange').modal('show');
     $("#account2").click(function() {
     var account=$("#account1").val();
	 $("#account2").val(account);
	 });


$("#acrange").submit(function(){$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#acrange").serialize(),
function(data){
$("#content").load("message.php #content");$("#deltrail").load("accountstrail.php #trailtable"); $('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})


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
		url: "readCountry.php",
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
<body>
 <div class="container">
  <div class="row">
  <div class="col-sm-12">
  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SET  RANGE" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#acrange">AC-DATE RANGE</button></a>
     
    
  <button class="btn-info btn-sm" onclick="window.print()">PRINT</button><br />
   <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  </div></div></div>
  
     <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  />
    

 <form class="modal fade" id="acrange" role="dialog" method="post"  action="sessionregistry.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
    <input type="text" name="account1" list="accountslist"  value="<?php print $_SESSION['account1'];?>"   autocomplete="off"   id="account1"  class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase'  placeholder="ENTER   MIN ACC NUMBER" required="on" />
        </div><br>
		<div>
    <input type="text" list="accountslist" name="account2"  value="<?php print $_SESSION['account2'];?>"   autocomplete="off"     id="account2"   class="form-control input-sm" autocomplete="off"   pattern="[0-9A-Za-z]{11}"  title="ENTER (8) ALPHA NUMERIC CHARACTERS" style='text-transform:uppercase' placeholder="ENTER   MAX ACC NUMBER" required="on"  />
        </div><br>
		
		 <datalist id="accountslist">
	<?php 
$x="SELECT DISTINCT ACCOUNT,CLIENT FROM $accountstable     ORDER BY ACCOUNT    ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "
<option value='".$y['ACCOUNT']."'>".$y['ACCOUNT']."  ".$y['CLIENT']."</option>";	
		}}

?> 
 </datalist>
 <br />
FROM<input type="date" class="form-control input-sm" name="date1" id="acc1"  autosearch="off"><br />
TO<input type="date" class="form-control input-sm"   name="date2" id="acc2"  autosearch="off"><br />
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
  
    
<form id="deltrail" method="post" >

  <h4   style="text-align:center"><strong>ACCOUNTS TRAIL  FOR ACC <?php print $account1 ;?> TO <?php print $account2;?> FROM  <?php print   $date1; ?>  TO  <?php print  $date2; ?>   </strong></h4>
<div  id="trailtable">
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		
		 <td class="theader"   valign="top">ACCOUNT</td>		
		  <td  class="theader" valign="top">METER NO.</td>
            <td   class="theader"  height="21" valign="top" > TASK</td>
			<td  class="theader"  valign="top">DATE</td>
			
			<td class="theader"  valign="top">
		</td>
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT * FROM $statushistorytable WHERE   date>='$date1'  AND    date<='$date2'    AND    account >='$account1'   AND    account <='$account2'  ORDER BY  account,date  ASC";			
//$x="SELECT * FROM $statushistorytable ";			
//$x="SELECT * FROM $statushistorytable WHERE     account >='$account1'   AND    account <='$account2'  ORDER BY  account,date  ASC";			

			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>	
             <td  >".$y['account']."</td>
		  
		   <td >".$y['meter']."</td>
           <td  >".$y['status']."</td>
				<td  >".$y['date']."</td>
			
				<td  >"; ?>
	<a   href="deleteaccountstrail.php?id=<?php print $y['id'];?>"  onclick="return confirm('DELETE ?')" >
DEL</a>			
				
				<?php print "</td>    </tr>";
		 }
		 
		 }  ?>
		 
       </tbody>
    </table>
<br />
</div>
</form>
 
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

