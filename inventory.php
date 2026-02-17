<?php 
header("LOCATION:accessdenied4.php");exit;
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'INVENTORY REG' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} td > checkbox{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}
table { font-size:90%;}
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; } body {text-transform:inherit;}
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            
  width: 100%;
  position: absolute;
}
#editstock{
  overflow-y: scroll;      
  height: 100%;            
  width: 100%;
  position: absolute;
}
h4{text-align:center;}



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
  height: 30%;           
  width: 100%;
  position: absolute;
}
#editstock{margin-left:5%;}
  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
   $('#editstock').modal('show');
		 $('#loadprice').dblclick( function() 
   {    $.post( "pricesession.php",
$("#search-box").serialize(),
function(data){$("#loadprice").load("searchprices.php #sprice");
});  return false;

   return false;

	   })
	  
	  
		 $('#loadbuyprice').dblclick( function() 
   {    $.post( "pricesession.php",
$("#search-box").serialize(),
function(data){$("#loadbuyprice").load("searchprices.php #bprice");
});  return false;

   return false;

	   })
	   
      $('#newitem').click( function() 
   {
	 var x=$("#newitem").prop("checked"); 
	if(x ==true){$("#description").prop("disabled",true);$("#location").prop("disabled",false);$("#minstocklevel").prop("disabled",false);  $("#units").prop("disabled",false);$("#itemcode").prop("disabled",false);  $("#category").prop("disabled",false);$("#price").prop("disabled",false);$("#bprice").prop("disabled",false);$("#quantity").prop("disabled",true);$("#search-box").prop("disabled",false);   }
	else if(x ==false){ $("#price").prop("disabled",true);$("#bprice").prop("disabled",true);$("#category").prop("disabled",true);$("#location").prop("disabled",true);$("#minstocklevel").prop("disabled",true);} 

	   
	   
	   
	   
	   })
	   
	   
$('#search-box').keyup( function() 
   {    $.post( "sessionregistry.php",
$("#search-box,#newitem,#pricing").serialize(),
function(data){$("#itemdetails").load("itemdetails.php #details");
});  return false;

   return false;

	   })
	   
	   
$('.frmSearch').click( function() 
   {    $.post( "sessionregistry.php",
$("#search-box,#newitem,#pricing").serialize(),
function(data){$("#itemdetails").load("itemdetails.php #details");
});  return false;

   return false;

	   })
	   

$('#search-box').click( function() 
   {    $.post( "sessionregistry.php",
$("#search-box,#newitem,#pricing").serialize(),
function(data){$("#itemdetails").load("itemdetails.php #details");
});  return false;

   return false;

	   })
	   
	       $('#pricing').click( function() 
   {
	 var x=$("#pricing").prop("checked"); 
	if(x ==true){$("#description").prop("disabled",true);$("#location").prop("disabled",true); $("#units").prop("disabled",true); $("#itemcode").prop("disabled",true);$("#minstocklevel").prop("disabled",true);$("#category").prop("disabled",true);$("#price").prop("disabled",false);$("#bprice").prop("disabled",false); $("#quantity").prop("disabled",true);$("#search-box").prop("disabled",false); }
	else if(x ==false){$("#price").prop("disabled",true);$("#bprice").prop("disabled",true);} 

	   })
	   
	   
 $('#sales').click( function() 
   {
	 var x=$("#sales").prop("checked"); 
	if(x ==true){$("#description").prop("disabled",true);$("#category").prop("disabled",true); $("#price").prop("disabled",true);$("#bprice").prop("disabled",true);$("#quantity").prop("disabled",false); $("#search-box").prop("disabled",false); }

	   })
	 $('#unstock').click( function() 
   {
	 var x=$("#unstock").prop("checked"); 
	if(x ==true){$("#description").prop("disabled",false);$("#category").prop("disabled",true); $("#price").prop("disabled",true);$("#bprice").prop("disabled",true);$("#quantity").prop("disabled",false);$("#search-box").prop("disabled",false);  }

	   })
	   
	    $('#restock').click( function() 
   {
	 var x=$("#restock").prop("checked"); 
	if(x ==true){$("#description").prop("disabled",false); $("#price").prop("disabled",true);$("#bprice").prop("disabled",true);$("#quantity").prop("disabled",false);$("#search-box").prop("disabled",false);  }

	   })
	   
	    $('#billed').click( function() 
   {
	 var x=$("#billed").prop("checked"); 
	if(x ==true){$("#price").prop("disabled",true);$("#bprice").prop("disabled",true);$("#description").prop("disabled",true);$("#category").prop("disabled",true);$("#quantity").prop("disabled",true); $("#search-box").prop("disabled",true);     }

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
	        
$("#editstock").submit(function(){$('#prepostmessage').modal('show');
$.post( "editstock.php",
$("#editstock").serialize(),
function(data){
 var x=$("#sales").prop("checked"); 
 if(x==true)
 {
$("#content").load("message.php #content");$("#deleteitems").load("sales.php #zones");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
return false;	 
 }
 
  var x=$("#billed").prop("checked"); 
 if(x==true)
 {
$("#content").load("message.php #content");$("#deleteitems").load("sales.php #zones");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
return false;	 
 }
 
 
$("#content").load("message.php #content");$("#deleteitems").load("inventory.php #zones");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
 
return false;});
return false;
})

$("#deleteitems").submit(function(){
		var action=$("#action2").val();
	 var x=confirm(action);   
	 if(x ==false){return false; }
$.post( "editstock.php",
$("#deleteitems").serialize(),
function(data){
	var action=$("#action2").val();
	$('#prepostmessage').modal('show'); 
	if(action =='DELETE')
	{	

$("#deleteitems").load("inventory.php #zones");$('#prepostmessage').modal('hide'); 	
	}

else if(action =='EXPORT')
	{	

$("#deleteitems").load("stock.php #stock");$('#prepostmessage').modal('hide'); 	
	} 	
	else if(action=='PROCESS')
{$("#deleteitems").load("printreciept.php #reciept");$('#prepostmessage').modal('hide'); }

else if(action=='DELSALES')
{$("#deleteitems").load("sales.php #zones");$('#prepostmessage').modal('hide'); }

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
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="INVENTORY/P.O.S" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#editstock">INVENTORY</button> </a>
 <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
  
  <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="INVENTORY/P.O.S" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#stocksheet">STOCK SHEET</button> </a>
  
  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">

    <!-- Modal -->
  </div>
  
   <div class="container">
  <div class="row">
  <div class="col-sm-4" > <hr>
</div>
  <div class="col-sm-4" >CHECK ALL 		 
<input name='' type='checkbox' id="checkall" class='form-control input-sm'></div>
  <div class="col-sm-4" >UNCHECK ALL  
			   <input name='' type='checkbox' id="checknone" class='form-control input-sm'></div>
  </div></div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
  
    <form class="modal fade"  action="backup/exportstocksheet.php" id="stocksheet" role="dialog"   method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
  <h2 style="text-align:center;">SELECT ITEM  CATEGORY </h2>
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SELECT ITEM CATEGORY  " data-placement="bottom">

<select class="form-control"   required= "on"   id="category" name="category"  required= "on" >
			   <option value="">SELECT ITEM CATEGORY </option>
			  <?php 
		$x="SELECT CATEGORY FROM ITEMCATEGORIES ";	  
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<option value='".$y['CATEGORY']."'>".$y['CATEGORY']."</option>";		
		
			
		}}
			  
			  ?>
			    <option value=""> </option>
 			  </select>

</a>

<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
  <button type="button" class="btn btn-default" data-dismiss="modal" >CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
  <form class="modal fade" id="editstock" role="dialog" method="post" action="editstock.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><h4>ENTER ITEM DETAILS</h4></div></div>

	   ITEM NAME
	  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ITEM NAME" data-placement="bottom">
<input  style='text-transform:uppercase'  pattern="[0-9A-Za-z+`/\- .,]+" title="INVALID ENTRIES"    name="item" type="text" size="15" placeholder="ENTER  ITEM NAME"  required="on"  class="form-control input-sm"   id="search-box"   autocomplete="off" >
</a>
<div id="suggesstion-box"></div>
</div><br><br><br><br><br><br><br><br><br><br><br>

 <div class="container">
  
<div id="itemdetails">
<div class="row">

    <div class="col-sm-4" >

	

	<div id="loaditem"></div>
	<br>
	
STORAGE LOCATION
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  STORAGE LOCATION" data-placement="bottom">
	<input type="text"  pattern="[A-Za-z0-9./\- ]+" placeholder="ENTER STORAGE LOCATION "   class="form-control input-sm"  name="location"  id="location"  required="on"  disabled /></a>
	<br>
	
ITEM CODE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER ITEM CODE " data-placement="bottom">
	<input  style="text-transform:uppercase"  type="text"  pattern="[A-Za-z0-9]+" placeholder="ENTER ITEM CODE" title="INVALID ENTRIES"  class="form-control input-sm"  name="itemcode"  id="itemcode"  required="on" /></a>
	<br>


	
	
	
			MINIMUM STOCK LEVEL
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  MINIMUM STOCK LEVEL" data-placement="bottom">
	<input type="number" min="0" required="on"   style='text-transform:uppercase' pattern="[0-9]+" title="INVALID ENTRIES" class="form-control input-sm" disabled name="minstocklevel" placeholder="MINIMUM STOCK LEVEL" id="minstocklevel"  /></a>

<br>

		   <select class="form-control"   required= "on"   id="category" name="category"  required= "on" >
			   <option value="">SELECT ITEM CATEGORY </option>
			  <?php 
		$x="SELECT CATEGORY FROM ITEMCATEGORIES ";	  
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<option value='".$y['CATEGORY']."'>".$y['CATEGORY']."</option>";		
		
			
		}}
			  
			  ?>
			    <option value=""> </option>
 			  </select>
			  
		   <br>
	

	<div > <br><br>
	
 </div>
	</div>
	<div class="col-sm-4"><br>
	UNIT 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNITS" data-placement="bottom">
	<input type="text" style="text-transform:uppercase"   pattern="[A-Z,a-z.]+" placeholder="UNIT " title="INVALID ENTRIES"  class="form-control input-sm"  name="units"  id="units"  required="on"  disabled /></a>

	<br>UNIT BUYING PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text" min ="0" pattern="[0-9.]+" placeholder="UNIT BUYING PRICE" title="ENTER DECIMALS OR WHOLE NUMBERS"  class="form-control input-sm"  name="bprice"  id="bprice"  required="on"  disabled /></a>
	<br>
	

	UNIT SELL PRICE
	
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text"  min ="0" placeholder ="UNIT SELL PRICE" pattern="[0-9.]+" title="ENTER DECIMALS OR WHOLE NUMBERS" class="form-control input-sm"  name="sprice"  id="price"  required="on"  disabled /></a>
	<br></div>
	<div class="col-sm-4"></div>
	
  </div>


</div>
</div>
 
  <div class="modal-footer" >
  <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>   
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div>
  <div class="col-sm-8"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </form>

   <form class="modal fade" id="reports" role="dialog" method="post"  action="inventoryreports.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
SELECT REPORT
 <select class="form-control" name="action"  required= "on">
		   <option >SELECT  REPORT</option>
		  <option value="STOCK"> STOCK</option>
		   </select>
    </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
  
  
<form id="deleteitems" method="post" action="editstock.php">
<div id="zones">
<h4><strong>INVENTORY </strong></h4>
 <table  style="font-size:75%;"  class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"   height="21" valign="top" >NO. </td>
		   <td  class="theader"   height="21" valign="top" >CODE	  </td>
            <td  class="theader" width="30%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader" width='10%'  height="21" valign="top" >UNITS  </td>
			<td  class="theader" width='10%'  height="21" valign="top" >CATEGORY  </td>
			<td  class="theader"   height="21" valign="top" >LOCALITY</td>
			<td  class="theader"   height="21" valign="top" >MIN</td>
			<td  class="theader"   height="21" valign="top" >QNTY	  </td>
			<td  class="theader"   height="21" valign="top" >STATUS </td>
		  
		  <td  class="theader"   height="21" valign="top" >SALE PRICE	  </td>
		   <td  class="theader"   height="21" valign="top" >BUY PRICE	  </td>		  		  
				    <td  class="theader"   height="21" valign="top" >MARGIN	  </td>
				  <td  class="theader"   height="21" valign="top" >STOCK VALUE	  </td>
		  <td  class="theader"   height="21" valign="top" > 
		  <select class="form-control" name="action2"  required= "on"   id="action2">
		   <option >ACTION</option>
		  <option value="DELETE">DELETE ITEMS </option>
		   </select>	  </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
		$number=0;
	$x="SELECT ID,ITEM,LOCATION,ITEMCODE,CATEGORY,QUANTITY,BPRICE,PRICE,UNITS,MINSTOCKLEVEL FROM INVENTORY  ORDER  BY ID,ITEMCODE  ASC ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { $number +=1;
	 $status=null;
	 if($y['QUANTITY'] <=$y['MINSTOCKLEVEL']){$status='RESTOCK';}
		   echo"<tr class='filterdata'>
		    <td   >".$number."</td>
		   <td   >".$y['ITEMCODE']."</td>
                <td  width='30%'>".$y['ITEM']."</td>
				 <td   width='10%'>".$y['UNITS']."</td>
				 <td   width='10%'>".$y['CATEGORY']."</td>
				  <td>".$y['LOCATION']."</td>
				  <td>".$y['MINSTOCKLEVEL']."</td>
				   <td>".$y['QUANTITY']."</td>
				 <td>".$status."</td>
				 <td>". number_format($y['PRICE'],2)."</td>
				   <td>". number_format($y['BPRICE'],2)."</td>				  
				    <td>". number_format($y['PRICE']-$y['BPRICE'],2)."</td>
				   <td>". number_format($y['BPRICE']*$y['QUANTITY'],2)."</td>
              <td ><input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'></td> 
		
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
		   <td    ></td> <td    ></td>
                <td  width='30%'>TOTAL</td>
				<td   width='10%' ></td>
				<td   width='10%' ></td>
				 <td></td> <td></td>
			 <td></td>	 
				 <td></td><td></td>
				
				   <td></td><td></td>
				  
				   <td>". number_format($y['SUM(BPRICE*QUANTITY)'],2)."</td>
              <td ></td> 
		
           </tr>";
		 }
		 }

	?>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>
</form>
   <form class="modal fade" id="reciepts" role="dialog" method="post"  action="posreciepts.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
FROM<input type="date" class="form-control input-sm" name="date1" id="date1"  required="on"><br />
TO <input type="date" class="form-control input-sm" name="date2" id="date2"  required="on"><br />

    </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>  
    <!-- 	dashboard-->
  <form class="modal fade" id="dashboard" role="dialog" action="exit.php" method="post" target="_parent"  onClick="noBack();"   >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header"><div id="zoneheader"><h3 id="zoneheader1">LAWASCO M.I.S <?php   print   $company.'-ZONE-'.$zonename; ?></h3><a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="A/C STATUS SUMMARY" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#accountstatus">A/C STATUS</button></a></div></div></div>
   
<div id="frame">
<div  id="inputs"> 
 
 <div class="container">
  <div class="row">
 
    <div class="col-sm-12" id="" ><br>
	 <div class="container">
	<div class="container">
  <div class="row">
  <div class="col-sm-3" > 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="ADMINISTRATOR" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   ADMIN&nbsp;&nbsp;&nbsp;&nbsp;<img src ="ICON7.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a   href="users.php" target= "_parent" >USER ADMIN </a></li><li><a   href="companyadmin.php" target= "_parent" >COMPANY ADMIN </a></li><li><a   href="zoneadmin.php" target= "_parent" >ZONE ADMIN </a></li>  
        <li><a href="backupdatabase.php">BACKUP DATABASE</a></li> 
		 <li><a  href="trail.php" target= "_parent" >AUDIT TRAIL </a></li><li><a  href="processautomation.php" target= "_blank" >TASK AUTOMATION</a></li> 
      </ul> 
   </div> 
  <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="REPORTS" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >REPORTS&nbsp;&nbsp;&nbsp;&nbsp;
	   <img src ="ICON17.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu" id="longmenu"> 
	  <li><a href="graphsummary.php"  target= "_blank">GRAPH SUMMARY</a></li> 
        <li><a href="accountstatus.php">ACC CURRENT STATUS </a></li><li><a href="watersalereport.php">WATER SALE REPORT </a></li> 
         
		 <li><a href="ministatement.php">MINISTATEMENT</a></li> 
		   <li><a href="statements.php">FULL STATEMENT</a></li><li><a href="refunddeposit.php">REFUND DEPOSIT</a></li><li><a href="archivedstatements.php">ARCHIVED STATEMENT</a></li><li><a href="bills2report.php">BILLS DISTRIBUTION  REPORT</a></li><li><a href="revenue.php">REVENUE  DISTRIBUTION  REPORT</a></li>
		   <li><a href="balancereport.php">ACC  BAL DISTRIBUTION REPORT </a></li><li><a href="analysisreport.php">MONTHLY DATA ANALYSIS </a></li><li><a href="banking.php">UNPROCESSED NOTIFICATION</a></li>
		   <li><a href="waterflow.php">WATER FLOW  REPORT</a></li><li><a href="masterdistribution.php">MASTER METERS REPORT</a></li>
		   
		   <li><a href="accountstatus3.php">ACCOUNTS  DISTRIBUTION  REPORT   </a></li>
		   <li><a href="meterstatus.php">METER DISTRIBUTION REPORT   </a></li><li><a href="accountsactivity.php">ACTIVITIES  DISTRIBUTION REPORT   </a></li>

<li><a href="duebillingreport.php">DUE BILLING REPORT</a></li> 	 		 
		  
      </ul> 
   </div> 
  <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="ANNUAL REPORTS" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >ANNUAL REPORTS&nbsp;&nbsp;&nbsp;
	   <img src ="ICON17.png"  width="20%"  height="20%"> 
	   </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu">
	          <li><a href="annualchlorinereport.php">CHLORINE REPORT </a></li> 
			  <li><a href="annualproductionreport.php">PRODUCTION REPORT </a></li> 
			   
			  <li><a href="annualreconnectionreport.php">RECONNECTION REPORT </a></li>
			  <li><a href="annualdisconnectionreport.php">DISCONNECTION REPORT </a></li>
			  <li><a href="annualrevenuereport.php">REVENUE REPORT </a></li> 
			  
			     			  
	  </ul> 
   </div> 
<br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="GEO MAPPING" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >GEO MAPPING&nbsp;&nbsp;&nbsp;<img src ="ICON21.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	   
        <li><a href="generatemap.php">GENERATE MAP </a></li><li><a href="mapping2.php">GEO LOCATION </a></li> 
         
      </ul> 
   </div> 
 <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" 
        data-toggle="dropdown"> 
       <a href="#"  title="INFO" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >HELP  MODULE&nbsp;&nbsp;&nbsp;<img src ="ICON22.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	  <li><a href="help.php">HELP </a></li> 
         
      </ul> 
   </div> 
 </div>
	<div class="col-sm-3" >
	
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown"> 
       <a href="#"  title="BILLING" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >BILLING&nbsp;&nbsp;&nbsp;&nbsp;<img src ="ICON16.png"  width="20%"  height="20%"> </a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
	   <li><a   href="billsrate.php" target= "_parent" > BILL RATES</a></li><li><a   href="printbill2.php" target= "_parent" >MASS  PRINT BILL</a></li><li><a   href="mainbilling.php" target= "_parent" > BILLING</a></li>
      <li><a   href="billing.php" target= "_parent" >MULTI BILLING</a></li>
	<li><a   href="fieldbilling.php" target= "_parent" >FIELED BILLING</a></li> 	  
        <li><a href="viewbill.php">BILLS SUMMARY</a></li> 
		  <li><a href="billsreport.php">BILLS REPORT</a></li> <li><a href="nonwaterbillsreport.php">NON WATER BILLS</a></li><li><a href="clientquotations.php">QUOTATIONS</a></li><li><a href="archives.php">IMAGE ARCHIVES</a></li> 
      </ul> 
   </div> 
  <br><br>
 <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" title="PAYMENT" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom"  >PAYMENT <img src ="ICON20.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="paymentcodes.php">PAYMENT CODES </a></li><li><a href="bankstatements.php">PAYMENT SLIPS </a></li> 
        <li><a href="backuprestore.php">UPLOAD SLIPS</a></li><li><a href="linkslips.php">LINK SLIPS</a></li><li><a href="paynotifications.php">PAY NOTIFICATIONS</a></li><li><a href="reciepts.php">RECEIPTS</a></li> 
		 
      </ul> 
   </div> 
  <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="OCCURANCE " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   JOB TICKETS&nbsp;&nbsp;&nbsp;<img src ="ICON23.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a   href="clienttickets.php" target= "_parent" >JOB  TICKETS </a></li> 
		  
        </ul> 
   </div> 
 <br><br>
 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="INVENTORY " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   INVENTORY &nbsp;<img src ="ICON25.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="itemcategory.php">ITEM CATEGORIES</a></li><li><a href="suppliers.php">SUPPLIERS</a></li><li><a href="inventory.php">INVENTORY</a></li><li><a href="stockadjustment.php">STOCK ADJUSTMENT</a></li><li><a href="purchasesreq.php">PURCHASES REQ</a></li><li><a href="quotationrequest.php">REQUEST FOR QUOTATION</a></li><li><a href="lpos.php">L.P.O'S & L.S.O'S</a></li><li><a href="purchases.php">GOODS RECIEVED</a></li><li><a href="storesissuenotes.php">STORES ISSUE</a></li><li><a href="gatepass.php">GATE PASS</a></li><li><a href="stockmovementreport.php">STOCK CARD</a></li>
		 
        </ul> 
   </div> 
 <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#" id="administrator"  title="REPAIR & MANTAINANCE " data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" > 
	   REPAIR & MANTAINANC&nbsp;&nbsp;&nbsp;<img src ="ICON15.png"  width="20%"  height="20%">
	   </a>
        <span class="caret"></span> 
		
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="mantainance.php">REPAIR & MANTAINANC</a></li> 
		 
        </ul> 
   </div>
 <br><br>

  <?php 
  $x="SELECT  DATEDIFF(LOCKDATE,CURRENT_DATE) AS ddays FROM CLOCK";
  $x=mysqli_query($connect2,$x)or die(mysqli_error($connect2));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$days=$y['ddays']; print '<div id="trialdays"  class="btn btn-default">TRIAL DAYS:'.$days.'</div>';}}
  
  ?>
 
	</div>
	<div class="col-sm-3" >
	 <div class="dashboardbutton">
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown"> 
       <a href="#"  title="REGISTRY" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom"  >REGISTRY<img src ="ICON1.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="newaccount.php" target="_parent" >NEW ACCOUNT </a></li> 
        <li><a  href="accountedit.php" target="_parent" >EDIT ACCOUNT</a></li>
		<li><a  href="accountedit2.php" target="_parent" >MULTI EDIT</a></li><li><a  href="accounttransfer.php" target="_parent" >ACCOUNT NUMBER CHANGE</a></li>
		
		<li><a  href="accountsregistry.php" target="_parent" >VIEW ACCOUNTS</a></li><li><a  href="accountstransfer.php" target="_parent" >ACCOUNTS TRANSFER</a></li><li><a  href="advancedsearch.php" target="_parent" >ADVANCED REG SEARCH</a></li><li><a  href="accountstrail.php" target="_parent" > ACCOUNTS TRAIL</a></li>
		
      </ul> 
   </div> 
 </div>
 
 <br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="SMS/EMAILS"  data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   SMS/EMAILS<img src ="ICON3.png"  width="16%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="sms.php" target= "_parent">BILLING SMS/EMAILS </a></li> <li><a href="custormsms.php" target= "_parent">CUSTORM  SMS/EMAILS </a></li>
		<li><a href="sendsmsemail.php" target= "_blank">SEND  SMS/EMAILS </a></li>
		<li><a href="balinquery.php" target= "_parent">BALANCE  INQUERY </a></li><li><a href="viewsms.php" target= "_parent">VIEW  SMS/EMAILS </a></li> 
		  <li><a href="contacts.php" target= "_parent">EDIT CONTACTS </a></li> 
      </ul> 
   </div> 
 <br><br><br>
 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="METER REGISTRY" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   METER REGISTRY<img src ="ICON24.png"  width="16%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="meterregistry.php" target= "_parent">METER REGISTRY </a></li><li><a href="unregisteredmeterregistry.php" target= "_parent">UNREGISTERED ACCOUNTS  </a></li>
		
		<li><a href="metertrail.php" target= "_parent">METER TRAIL </a></li>
		 
      </ul> 
   </div> 
 <br><br>
 
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="DEBT MANAGEMENT" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   DEBT MANAGEMENT<img src ="ICON20.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="debtregistry.php" target= "_parent">DEBT MANAGEMENT </a></li>	
      </ul> 
   </div> 
 <br><br>
   <div class="btn-group"> 
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
       <a href="#"  title="WATER PRODUCTION" data-toggle="popover" data-trigger="hover" data-content="MODULE" data-placement="bottom" >
	   WATER PRODUCTION<img src ="ICON1.png"  width="20%"  height="20%"></a>
        <span class="caret"></span> 
      </button> 
      <ul class="dropdown-menu"> 
        <li><a href="productionbilling.php"   target= "_parent">PRODUCTION METERS</a></li><li><a href="mastermeters.php"   target= "_parent">MASTER METERS </a></li>	
      </ul> 
   </div> 
 <br><br>
  <button type="button" class="btn btn-default" data-dismiss="modal" >CLOSE</button>
 <button type="submit" class="btn btn-default"  >LOGG OFF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>

	</div>
	<div class="col-sm-3" ></div>
  </div></div>	 
	 </div>
	
<br> 
</div>
	</div>
	</div>

</div>



<br>
	</br>
	</div>
 
  </div>
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
