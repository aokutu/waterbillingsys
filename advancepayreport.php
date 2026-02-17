<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password2.php");

$x = $connect ->query("SELECT * FROM users  WHERE  NAME='$dbdetails->user' AND PASSWORD='$dbdetails->password' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
//include ("staffdetailsclass.php");
//print $_POST['staffname'];  
class advance {
   public $id=null;
   public $idnumber=null;
   public $date1=null;
   public $date2=null;
   public $name=null;
}

$advance = new advance();
$advance->idnumber=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['idnumber']))));
$advance->name=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['staffname']))));
$advance->date1=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date1']))));
$advance->date2=$connect->real_escape_string(trim(addslashes(strtoupper($_POST['date2']))));
$_SESSION['date1']=$advance->date1;$_SESSION['date2']=$advance->date2;
$_SESSION['idnumber']=$advance->idnumber;$_SESSION['name']=$advance->name;
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
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  

 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
    <!-- Modal -->
  </div>

<form id="staffregistry" method="post" >
<div id="staffs">
<h4   style="text-align:center"><strong><?php print $advance->name;  ?>  ADVANCED   PAYMENT REPORT FROM <?php print $advance->date1; ?>  TO <?php print $advance->date2; ?> </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td  class="theader"    height="21" valign="top" >    TRANSACTION   </td>
            <td  class="theader"    height="21" valign="top" >AMOUNT  </td>
             <td  class="theader"  style="text-align:left;"  height="21" valign="top" >TOTAL  </td>
		  <td  class="theader"   height="21" valign="top" >DELETE  </td>
			   
          </tr>
        </thead>
        <tbody>
   <?php
   
   $connect->query("SET @TTL=0 ");
	$x=$connect->query("SELECT *,(@TTL := AMOUNT + @TTL) AS TTLSUM  FROM advancedsalary WHERE IDNUMBER='$advance->idnumber'AND DATE >='$advance->date1' AND DATE <='$advance->date2' ");
  while ($data = $x->fetch_object())
  { 
		   echo"<tr class='filterdata'>
		   <td>".$data->transaction."</td>
                <td>".number_format($data->amount,2)."</td>
                 <td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($data->TTLSUM,2)."</td>
              <td >&nbsp;&nbsp;&nbsp;&nbsp;" ; ?>
                 <a   href="deleteadvancepay.php?id=<?php print $data->id;?>"  onclick="return confirm('DELETE ?')" >
DEL
                       </a>

                       <?php               
                         print "</td>  
		
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
