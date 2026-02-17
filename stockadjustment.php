<?php  header("LOCATION:accessdenied4.php");exit;
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'INVENTORY REG'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}

	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; } body {text-transform:inherit;}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}


#idnumber-list
{
	 overflow-y: scroll;      
  height: 30%;            //  <-- Select the height of the body
  width: 100%;
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
			  text-align:center;
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }
	 
	 	 #idnumber-list
{
	 overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
    $('#batchsearch').modal('show');
$("#stockadjust").load("batchdetails.php #batchdetails");

$("#newstock").submit(function(){
	var action='ADJUST   STOCK?';
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "newstock3.php",
$("#newstock").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#inventory").load("stockadjustment.php #inventorytable");
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})


$("#newitem").submit(function(){
 	$('#prepostmessage').modal('show');
 $.post( "editstock.php",
$("#newitem").serialize(),
function(data){
//$("#deleteitems").load("stockreport.php #stock");
	
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#stockadjust").submit(function(){
	var action='ADJUST STOCK  ';
	 var x=confirm(action);   
	 if(x ==false){return false; }
	 $('#prepostmessage').modal('show');
$.post( "stockadjustment2.php",
$("#stockadjust").serialize(),
function(data){
$("#stockadjust").load("batchdetails.php #batchdetails");
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
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
		url: "searchinventory.php",
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
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
         <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="STOCK ADJUSTMENT " data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newstock">STOCK ADJUSTMENT</button> </a>
  <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">

    <!-- Modal -->
  </div>
  <div class="container">
  <div class="row">
  <div class="col-sm-4" >
</div>

  </div></div>
 
<div id="inventory">
<table  id="inventorytable"  class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"   height="21" valign="top" >CODE	  </td>
            <td  class="theader" width="30%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader" width='10%'  height="21" valign="top" >UNITS  </td>
			<td  class="theader" width='10%'  height="21" valign="top" >CATEGORY  </td>
			
		  <td  class="theader"   height="21" valign="top" >QNTY	  </td>
		  <td  class="theader"   height="21" valign="top" >SALE PRICE	  </td>
		   <td  class="theader"   height="21" valign="top" >BUY PRICE	  </td>		  		  
				    <td  class="theader"   height="21" valign="top" >MARGIN	  </td>
				  <td  class="theader"   height="21" valign="top" >STOCK VALUE	  </td>
		 
			   
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT ID,ITEM,ITEMCODE,CATEGORY,QUANTITY,BPRICE,PRICE,UNITS FROM INVENTORY  ORDER  BY CATEGORY,ITEMCODE,ITEM  ASC  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		   <td   >".$y['ITEMCODE']."</td>
                <td  width='30%'>".$y['ITEM']."</td>
				 <td   width='10%'>".$y['UNITS']."</td>
				 <td   width='10%'>".$y['CATEGORY']."</td>
				 <td>".$y['QUANTITY']."</td>
				 <td>". number_format($y['PRICE'],2)."</td>
				   <td>". number_format($y['BPRICE'],2)."</td>				  
				    <td>". number_format($y['PRICE']-$y['BPRICE'],2)."</td>
				   <td>". number_format($y['BPRICE']*$y['QUANTITY'],2)."</td>
             
		
           </tr>";
		 }
		 }
		 
	$x="SELECT SUM(BPRICE*QUANTITY) FROM inventory  order by item  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		   <td    ></td>
                <td  width='30%'>TOTAL</td>
				<td   width='10%' ></td>
				<td   width='10%' ></td>
				 <td></td>
				   <td></td><td></td>
				  <td></td>
				   <td>". number_format($y['SUM(BPRICE*QUANTITY)'],2)."</td>
             
		
           </tr>";
		 }
		 }

	?>
        </tbody>
		
      </table>
	  </div>



<form class="modal fade" id="newstock" role="dialog" method="post" action="newstock3.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h2 style='text-transform:uppercase;text-align:center;'  >NEW STOCK ADJUSTMENT</h2></div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >
	
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT  ADJUSTMENT MODE" data-placement="bottom">
	   <label class="checkbox-inline"> 
        <input type="radio" name="record" checked
            value="STANDARD"> STANDARD ADJUSTMENT
     </label>
	 <?php 
	 $x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'INVENTORY REG'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){ ;
?>

  <label class="checkbox-inline"> 
        <input type="radio" name="record" 
            value="INVENTORY"> INVENTORY ADJUSTMENT
     </label>
	 
	  <label class="checkbox-inline"> 
        <input type="radio" name="record" 
            value="RECORDS">RECORDS ADJUSTMENT
     </label>
<?php 
	
	
}
	 ?>
	
   </a>
<HR>
	<br>
			ITEM NAME
	  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ITEM NAME" data-placement="bottom">
<input  style='text-transform:uppercase' pattern="[0-9A-Za-z,.`:%- ]+" title="INVALID ENTRIES" name="item" type="text" size="15" placeholder="ENTER  ITEM NAME"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div><br>
    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW ITEM " data-placement="bottom">
	<button class="btn-info btn-sm"  data-toggle="modal" data-target="#newitem">NEW ITEM</button> </a>


	<div > 

 </div>
 <br><br><br>
 <br><br><br>
 <br><br><br>
	</div>
	<div class="col-sm-4"></div>
  </div>
</div>
 <div class="container">
  <div class="row">

    <div class="col-sm-4" >

	QUANTITY
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text" class="form-control input-sm" pattern="[0-9.-]+" title="INVALID ENTRIES"  name="quantity" placeholder="ENTER  QUANTITY"   id="quantity" required="on" /></a>
	<br>
<br>
	
	</div>
	    <div class="col-sm-4" >
DESCRIPTION
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER DESCRIPTION" data-placement="bottom">
	<input type="text" pattern="[0-9A-Za-z. ]+" title="INVALID ENTRIES"   style='text-transform:uppercase'  class="form-control input-sm" required  name="description"  id="description2"  /></a>
	<br>
	<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
		
		</div>
    <div class="col-sm-4" ></div>

	</div>
	</div>
	
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  
  
     <form class="modal fade" id="newitem" role="dialog" method="post"  action="editstock.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
ITEM NAME
<input type="text"  pattern="[0-9A-Za-z`/\- .,]+" title="INVALID ENTRIES" placeholder="ENTER ITEM  NAME "  class="form-control input-sm" name="item"   style='text-transform:uppercase'  required  id="item" >
<br />
<input type="hidden"    class="form-control input-sm" name="action"   style='text-transform:uppercase'  value ="NEWITEM"><br />
<input type="hidden"    class="form-control input-sm" name="quantity"   style='text-transform:uppercase'  value ="0"><br />

UNIT BUY PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT BUY PRICE" data-placement="bottom">
		<input type="text"   style='text-transform:uppercase' pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"   name="bprice"    required="on" />

	</a><br>
	UNIT SELL PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNIT SELL PRICE" data-placement="bottom">
		<input type="text"  style='text-transform:uppercase'  pattern="[0-9.]+" title="INVALID ENTRIES"  class="form-control input-sm"  name="sprice"   required="on" />

	</a>
	<br>
	 <select class="form-control"  id="category" name="category"  required= "on" >
		   <option >CATEGORY</option>
		   <option value="D.D.A">D.D.A </option>
		    <option value="CROSSCOUNTER">CROSSCOUNTER </option>
		   </select>
		   <br>
    </div>
		<div>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
 <?php include_once("dashboard3.php"); ?>
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
