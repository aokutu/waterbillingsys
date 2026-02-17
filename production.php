<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'PRODUCTION METER' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
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
#userdetails{
  overflow-y: scroll;      
  height: 480px;            //  <-- Select the height of the body
  width: 90%; margin-right:10%; 
  position: absolute;
}

#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}

#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
 #mainbilling{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:2%;}
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}    .dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
/* $("#close1").click(function() {
        $("input").val("");
    });*/

$("#newproductionmeter").submit(function(){
$.post( "newproductionmeter.php",
$("#newproductionmeter").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#newproductionmeter').modal('hide'); 
$('#message').modal('show'); 
$("#detailsform").load("production.php #tabledetails");
return false;});
return false;
})

$("#loadmeterdetails").submit(function(){
$.post( "loadmeterdetailssession.php",
$("#loadmeterdetails").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#loadmeterdetails').modal('hide'); 
$('#message').modal('show'); 
$("#detailsform").load("production.php #tabledetails");
return false;});
return false;
})
/////////////load  current reading////////////
 $("#search-box").dblclick(function()
{
$.post( "productionmeterreadingsession.php",
$("#search-box").serialize(),
function(data){$("#previousreading").load("productionmeterreading.php #reading");
});  return false;
})
////////////////////

$("#detailsform").submit(function(){
$.post( "deleteproductionmeters.php",
$("#detailsform").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#detailsform").load("production.php #tabledetails");
return false;});
return false;
})

$("#zonesearch").submit(function(){
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){
$("#content").load("message.php #content"); $('#message').modal('show'); 

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
		url: "readproductionmeters.php",
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
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="CLICK TO  CREATE NEW  METER" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newproductionmeter"> NEW METER</button> </a>
   <a href="#" title="CLICK TO  ADD " data-toggle="popover" data-trigger="hover" data-content="NEW WATER OUTPUT" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#loadmeterdetails"> NEW WATER OUTPUT</button> </a>
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
 
 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
  
  <form class="modal fade" id="loadmeterdetails" role="dialog" method="post" action="loadmeterdetailssession.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">NEW WATER  OUTPUT</div></div>
  <div class="container">
  <div class="row">
     <div class="col-sm-8" >ENTER  METER REFFERENCE NUMBER
  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input  style='text-transform:uppercase' name="refferencenumber" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>
<div id="suggesstion-box"></div>
</div><br>		
    </div>
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
  <form class="modal fade" id="newproductionmeter" role="dialog" method="post" action="newproductionmeter.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ENTER DETAILS</div></div>
  <div class="container">
  <div class="row">
     <div class="col-sm-8" >METER REFFERENCE NUMBER
	  <input type="text"   style='text-transform:uppercase'  name="refferencenumber" class="form-control input-sm"  placeholder="REFFERENCE NUMBER"   required="on"  autocomplete="off"><br>
		LOCATION<input    name="location"  style='text-transform:uppercase'  type="text" class="form-control input-sm"  placeholder="LOCATION"   required="on"   autocomplete="off"><br>
		CURRENT READINGS<input type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES "   name="reading" class="form-control input-sm"  placeholder="CURRENT READINGS "  required="on"  autocomplete="off"><br>
		
    </div>
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

<form id="detailsform" method="post" action="deleteproductionmeters.php">
<div  id="tabledetails">
<h4   style="text-align:center"><strong>PRODUCTION METERS  </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"   height="21" valign="top" >REFF NUMBER	  </td>
			 <td  class="theader"    height="21" valign="top" >LOCATION</td> 
			 <td  class="theader"    height="21" valign="top" >LAST READINGS</td> 
		<td  class="theader"     height="21" valign="top" >DATE</td> 
		<td  class="theader"   height="21" valign="top" ><select class="form-control"   required= "on"  name="action"  id="action">
			   <option value="">ACTION</option>
			   <option value="DELETE">DELETE</option>
			  <option value="VIEW REPORT">VIEW REPORT </option>
			  
			  
			  </select></td> 		
			   
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT * FROM productionmeters";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
                <td     >".$y['refferencenumber']."</td>
                <td     >".$y['location']."</td>
                <td  >".$y['reading']."</td> 
				 <td   >".$y['date']."</td> 
				 	<td><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td> 
		
           </tr>";
		 }
		 }

	?>
        </tbody>
		
      </table>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>  	  
	  </div>
</form>
 <form class="modal fade" id="zonesearch" role="dialog" method="post"  action="zonesearch.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
<select class="form-control input-sm"  id="loadedzone"  name="loadedzone" required="on" >
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
        </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
<?php include_once("dashboard3.php"); include_once("chat.php");?>

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
  
   <div class="modal fade" id="errormessage1" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="feedbackcontent">
<h2  id="content">ENTER   THE   REFFERENCE<br> NUMBER FIRST<button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button></h2>
  </div></div></div>
  </div> 
</body>
</html>
