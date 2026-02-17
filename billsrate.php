<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password'   AND  ACCESS  REGEXP  'BILL RATES'  ");
if(mysqli_num_rows($x)>0)
{}
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
  @media print{a[href]:after{content:none}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}
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
  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
	$("#zonesearch").submit(function(){
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#content").load("message.php #content");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})

$("#newbillrate").submit(function(){$('#prepostmessage').modal('show');
$.post( "newbillsrate.php",
$("#newbillrate").serialize(),
function(data){
$("#content").load("message.php #content");$("#unitrates").load("billsrate.php #zones");$('#prepostmessage').modal('hide'); $('#message').modal('show'); 
 
return false;});
return false;
})

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
$(".proceedaction").click(function()
{
	var x=confirm("DELETE CLASS CHARGE RATES ? ");   
	 if(x ==false){return false; } 

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
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="NEW  CLASS RATES" data-placement="bottom"><button class="btn-info btn-sm"  data-toggle="modal" data-target="#newbillrate"> NEW RATES</button> </a>
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
  

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
  <form class="modal fade" id="newbillrate" role="dialog" method="post" action="newbillsrate.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ENTER CHARGES  DETAILS  </div></div>
  <div class="container">
  <div class="row">

    <div class="col-sm-8" >UNITS
	<input type="text" class="form-control input-sm" style="text-transform:uppercase;"  pattern="[0-9]+" title="INVALID ENTRIES" placeholder="ENTER CUBIC UNITS  " name="units"    required="on" /><br>
	CLASS A CHARGES 
	<input type="text"  pattern="[0-9. ]+"   title="INVALID ENTRIES"  placeholder="ENTER CLASS A CHARGES" class="form-control input-sm"  name="acclassa"   autocomplete="off" required="on" /><br>
	CLASS B CHARGES
	<input type="text" pattern="[0-9. ]+"  autocomplete="off"   title="INVALID ENTRIES"  class="form-control input-sm"  name="acclassb"  placeholder="ENTER CLASS B CHARGES" required="on" /><br>
	ENTER CLASS C CHARGES
		<input type="text"  pattern="[0-9. ]+"  autocomplete="off"   title="INVALID ENTRIES" class="form-control input-sm"  name="acclassc" placeholder="ENTER CLASS C CHARGES" required="on"    /><br>
		ENTER CLASS D CHARGES
	<input type="text"  pattern="[0-9. ]+"  autocomplete="off"   title="INVALID ENTRIES" class="form-control input-sm"  name="acclassd" placeholder="ENTER CLASS D CHARGES" required="on"    />
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

<form >
<div id ="unitrates">
<div id="zones">
<h4   style="text-align:center"><strong><u>BILLING CHARGE RATES </u></strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td  class="theader"    height="21" valign="top" >UNITS  </td>
            <td  class="theader"    height="21" valign="top" >CLASS A </td>
			<td  class="theader"   height="21" valign="top" >CLASS B	  </td>
		  <td  class="theader"   height="21" valign="top" >CLASS C	  </td>
		  <td  class="theader"   height="21" valign="top" >CLASS D  </td>
		  <td  class="theader"   height="21" valign="top" >EDIT	  </td>
		   <td  class="theader"   height="21" valign="top" >DELETE	  </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x=$connect->query("SELECT  ID,UNITS,A,B,C,D FROM  WATERBILLINGRATES  ");
  while ($data = $x->fetch_object())
  { 
		   echo"<tr class='filterdata'>
		   <td>".$data->UNITS."</td>
                <td>".$data->A."</td>
<td>".$data->B."</td>					
  <td>".$data->C."</td>	
   <td>".$data->D."</td>
    <td >"; ?>

              <a class ="proceedaction"  href="deleterates.php?id=<?php print $data->ID;?>" class="deletebillsrate">

				   <button type="button" class="btn-info btn-sm">EDIT</button> 
				   </a>

       <?php print " </td> 
              <td >"; ?>
              <a class ="proceedaction"  href="deleterates.php?id=<?php print $data->ID;?>" class="deletebillsrate">
				   <button type="button" class="btn-info btn-sm">DEL</button> 
				   </a>

       <?php print " </td> 
		
           </tr>";
		 }

	?>
        </tbody>
		
      </table>
	  <br />
</div>
</div>
</form>

 
<?php  include_once("dashboard3.php"); include_once("zonechange.php"); include_once("chat.php");?>
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
