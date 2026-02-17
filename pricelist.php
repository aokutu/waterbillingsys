<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND ACCESS REGEXP 'FINANCE'  
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'LAB & IMAGING' 
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'PHAMARCY'
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'POINT OF SALE' 
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'CONSULTATION' 
OR name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'NURSE'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

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
$("#newitem").modal();

    $('#medicine').click(function() {
        // Enable the button when clicked
      $('#units').prop('disabled', false);$('#units').val('');
    });
	
var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});


$('[data-toggle="popover"]').popover(); 
//$("#registrytable").load("registry.php #accountstable");	
 })
  </script>
  
  
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<div class="container" > 
  <a href="#" title="ENTER  " data-toggle="popover" data-trigger="hover" data-content="NEW  DETAILS" data-placement="bottom">
  <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newitem"><i class="fas fa-clipboard" style="font-size:200%;" ></i>NEW ITEM</button></a>
 <button class="btn-info btn-sm" onclick="window.print()"> <i style="font-size:200%;" class="fas fa-print"></i>PRINT</button>
    <!-- Modal -->
  </div>
	  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
  <form class="modal fade" role="dialog" method="post"  id="newitem" action="newitem.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header" style="text-align:center;"><div class="font-bold" >NEW ITEM/SERVICE</div><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-12">DESCRIPTION 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' required  name="item" type="text"  pattern="[A-Za-z'0-9 -'%(),/.'" ]+"  title="INVALID ENTRIES"   size="15" placeholder="ITEM NAME"   class="form-control input-sm"     autocomplete="off" ></a>
<br>NORMAL PRICE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' required  name="price" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15" placeholder="ITEM  PRICE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>COPRATE  PRICE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="COPRATE PRICE" data-placement="bottom">
<input style='text-transform:uppercase'  required  name="coprateprice" id="coprateprice" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15" placeholder="COPRATE PRICE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<label><input type="radio" id="cashpay"  onclick="$('#units').prop('disabled', true);$('#units').val('')" name="itemcategory"  value="IMAGING">IMAGING </label>  
<label><input type="radio" id="cashpay"  onclick="$('#units').prop('disabled', true);$('#units').val('')" name="itemcategory"  value="SERVICE">SERVICE</label>  
		 <label><input type="radio" id="medicine" checked  name="itemcategory" value="ITEM">PHARMACETICALS</label> 
<br>

<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button><button type="button" class="btn-info btn-sm" data-dismiss="modal" id="newitem">CLOSE</button> 

 </div>
  

</div></div>

  
  </div></div></div></div>
  </form> 
  
   

<form id="details"   method="post"   >
<div id="itemdetails"> 
<?php include_once("pricelisttable.php");?>
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

