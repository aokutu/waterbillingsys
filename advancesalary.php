<?php
 @session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS  REGEXP  'ZONE ADMIN' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  
  <link rel="stylesheet"  href="stylesheets/font-awesome.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
  
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	
$("#newstaff").submit(function(){$('#prepostmessage').modal('show');
$.post( "newstaff.php",
$("#newstaff").serialize(),
function(data){
$("#content").load("message.php #content");$("#staffregistry").load("advancesalary.php #staffs");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
 
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
         <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="Click TO ADD STAFF" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newstaff"> NEW STAFF</button> </a>
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  

 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
    <!-- Modal -->
  </div>
   <form class="modal fade" id="newstaff" role="dialog" method="post" action="newstaff.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ENTER STAFFS DETAILS </div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >STAFF ID  
	<input type="text" class="form-control input-sm" style="text-transform:uppercase;"  pattern="[0-9A-Z,a-z- ]+" title="INVALID ENTRIES" placeholder="ENTER ZONE NAME " name="idnumber"    required="on" /><br>
	STAFF NAME 
	<input type="text" class="form-control input-sm"  pattern="[0-9A-Z,a-z- ]+" name="staffname"    required="on" /></div>
	<div class="col-sm-4"></div>
  </div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn btn-default" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>

<form id="staffregistry" method="post" action="deletezones.php">
<div id="staffs">
<h4   style="text-align:center"><strong>STAFFS </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td  class="theader"    height="21" valign="top" >STAFF ID   </td>
            <td  class="theader"    height="21" valign="top" >NAMES  </td>
             <td  class="theader"  style="text-align:left;"  height="21" valign="top" >BALANCE  </td>
		  <td  class="theader"   height="21" valign="top" >ACTION  </td>
			   
          </tr>
        </thead>
        <tbody>
   <?php
$connect->query("CREATE TEMPORARY TABLE ADVANCED (IDNUMBER INT,AMOUNT FLOAT)");	
$connect->query("UPDATE staffs SET AMOUNT=0");
$connect->query("INSERT INTO ADVANCED (IDNUMBER,AMOUNT) SELECT IDNUMBER,SUM(AMOUNT) FROM advancedsalary GROUP BY IDNUMBER ");
$connect->query("UPDATE staffs TU, ADVANCED TS  SET TU.AMOUNT=TS.AMOUNT WHERE TU.IDNUMBER=TS.IDNUMBER");
	$x=$connect->query("SELECT *  FROM staffs  ");
  while ($data = $x->fetch_object())
  { 
		   echo"<tr class='filterdata'>
		   <td>".$data->idnumber."</td>
                <td>".$data->name."</td>
                 <td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($data->amount,2)."</td>
              <td >&nbsp;&nbsp;&nbsp;&nbsp;" ; ?>
                 <a   href="deletestaff.php?id=<?php print $data->id;?>"  onclick="return confirm('DELETE ?')" >
DEL |
                       </a>
                       
                       <a   href="newadvance.php?id=<?php print $data->id;?>" >
ADVANCE |
                       </a>
                               <a   href="advancerepay.php?id=<?php print $data->id;?>"  >
REPAYMENT |
                       </a>
                       <a   href="advancedreport.php?id=<?php print $data->id;?>" >
REPORT
                       </a>
                       <?php               
                         print "</td>  
		
           </tr>";
		 }


	$x=$connect->query("SELECT SUM(AMOUNT) AS TTL  FROM staffs  ");
  while ($data = $x->fetch_object())
  { 
		   echo"<tr class='filterdata'>
		   <td>TOTAL</td>
                <td></td>
                 <td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($data->TTL,2)."</td>
              <td></td>  
		
           </tr>";
		 }	

	?>
	
	
	
	
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
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
