<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="PHAMARCY";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$connect->query("DELETE FROM expirydates  WHERE QUANTITY <1  ");

?>

 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>MEDI CLOUD</title>
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
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}    .dropdown-menu{ overflow-y: scroll; height: 300%;        
   position: absolute;
}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;      
   position: absolute;
}

	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            
  width: 100%;
  position: absolute;
}
@media print {
  a[href]:after {
    content: none !important;
  }
}

@media print {
    /* Hide the last column in the printed version */
    table th:last-child,
    table td:last-child {
        display: none;
    }
}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   

$(document).on('click', '.deletelink', function(event) {
        event.preventDefault();
        
        var deleteid = $(this).data('deleteid');
        var msg = 'DELETE ITEM  ';
        var confirmdelete = confirm(msg);
		if(confirmdelete==false){return false;} 
		var accessname = prompt('NAME');
        var accesspass = prompt('PASSWORD');		
        if (confirmdelete ) {
            $.ajax({
                type: 'POST',
                url: 'deleteexpirityentry.php',
                data: {
                    deleteid: deleteid,
                    accessname: accessname,
                    accesspass: accesspass // Fixed this line
                    // Fixed this line
                },
                beforeSend: function() {
                    $('#prepostmessage').modal('show');
                },
                success: function(response) {
                    $("#patientinvoices").load("trackexpire.php #patientinvoicestable", function() {
                        // Optional: Rebind event handlers if necessary
                        // e.g., $('a').off('click').on('click', yourFunction);
                    });
                    $("#content").load("message.php #content");
                    $('#prepostmessage').modal('hide');
                    $('#message').modal('show');
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        }
        
        return true;
    });
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
  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="NEW  DETAILS" data-placement="bottom">
 <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
  </div>
	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">

<form id="patientinvoices"   method="post"   >
<div id="patientinvoicestable">
	<h3  style="text-align:center;font-weight:bold;text-decoration:underline;" >EXPIRY TRACKER </h3>

<table class="table"    style="text-align:center;font-size:90%;margin-right:2%;margin-left:2%;">

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader"  width="5%" height="28" valign="top" style='text-align:center;' >NO.</td> 
<td  class="theader"    height="28" valign="top"  style='text-align:left;' >ITEM</td>	
		  
		    <td  class="theader"   height="28" valign="top" style='text-align:left;'  >BATCH #</td> 
		 <td  class="theader"    height="28" valign="top"  style='text-align:left;' >QNTY</td>
			 <td  class="theader"    height="28" valign="top"  style='text-align:left;' >EXPIRY DATE</td>
			 <td  class="theader"    height="28" valign="top"  style='text-align:left;' >SHELF LIFE</td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  > ACTION </td> </tr>
 		
		
				<?php
		class shelflifecolorcode
		{
	public $shelflife=null;
	public $colorcode=null;
	public function processcolorcode()
	{
if($this->shelflife <1 ){$this->colorcode=" <div class='bg-red-600 text-white p-4'> EXPIRED</div> ";}
else if($this->shelflife <=15 ){$this->colorcode=" <div class='bg-red-300 text-black-900 p-4'>".$this->shelflife."    DAYS </div> ";}
else if($this->shelflife <=30 ){$this->colorcode=" <div class='bg-red-100 text-black-900 p-4'>".$this->shelflife."    DAYS </div> ";}
else if($this->shelflife >30 ){$this->colorcode=" <div class='bg-blue-400 text-black-900 p-4'>".$this->shelflife."    DAYS </div> ";}

	}
		}
$shelflifecolorcode = new shelflifecolorcode;

$x=$connect->query("SELECT ID,NAME,QUANTITY, BATCH, EXPIRE, DATEDIFF(EXPIRE,CURDATE()) AS SHELFLIFE FROM expirydates   ");
while ($data = $x->fetch_object())
{
$shelflifecolorcode->shelflife=$data->SHELFLIFE;
$shelflifecolorcode->processcolorcode();

	$number+=1;	?>
 <tr class='filterdata'  style='text-align:center;' >
				<td  width="5%"  style='text-align:center;' ><?php print $number; ?> </td> 
 <td   style='text-align:left;'  >
 <?php print $data->NAME; ?>
 </td>				
			    <td    style='text-align:left;'  ><?php print $data->BATCH; ?></td>
				  <td    style='text-align:left;'  ><?php print $data->QUANTITY; ?></td>
	<td   style='text-align:left;'  ><?php print $data->EXPIRE; ?></td>
<td   style='text-align:left;'  ><?php print $shelflifecolorcode->colorcode; ?></td>	
				            <td style='text-align:center;'  >
		 <a  class="deletelink" data-deleteid="<?php print $data->ID; ?>" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>
	 </tr>
<?php }	?>
</tbody>
 </table>
                      
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

