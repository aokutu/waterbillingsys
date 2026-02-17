<?php 
 @session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'USERS ADMIN' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
#newuser{
  overflow-y: scroll;      
  height: 100%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
  font-size:80%;

}
</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){   
$("#registry").modal();
$('[data-toggle="popover"]').popover(); 
	
   $("#results").submit(function(){
	  // alert("xxxxx");return false;
	   
$.post( "editusers.php",
$("#results").serialize(),
function(data){
var action=$("#action").val();
if(action =='delete'){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#results").load("users.php #datatable");
return false;
}
else if(action =='edit'){
	$("#content").load("message.php #content"); 
$('#message').modal('show');
$("#results").load("editusers2.php");
	return false;
	}
else if(action =='edit2'){
$("#content").load("message.php #content"); 
$('#message').modal('show');
	$("#results").load("users.php #datatable");
return false;
	}
else if(action =='loggoff'){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#results").load("users.php #datatable");
return false;
}


else if(action =='suspend'){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#results").load("users.php #datatable");
return false;
}

else if(action =='activate'){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#results").load("users.php #datatable");
return false;
}
else if(action =='reset'){
$("#content").load("message.php #content"); 
$('#message').modal('show'); 
$("#results").load("users.php #datatable");
return false;
}

return false;});
return false;
})


$("#newuser").submit(function(){
$.post( "newuser.php",
$("#newuser").serialize(),
function(data){
$("#content").load("message.php #content"); 
$('#newuser').modal('hide'); 
$('#message').modal('show'); 
$("#results").load("users.php #datatable");
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
    <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="Click to create New User" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#newuser">NEW USER</button></a>
 
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button> 
 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
    <!-- Modal -->
  </div>
  
 <form class="modal fade" id="newuser" role="dialog" method="post"  action="newuser.php" >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">ENTER  NEW USER  DETAILS
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<input type="text"  style='text-transform:uppercase'   name="name" pattern="[0-9A-Za-z]{5,10}"  title="ENTER 5-10 ALPHANUMERIC"   class="form-control input-sm"  placeholder="USER NAME" required="on"  /><br>
 <div class="row">
  
  <div class="col-sm-10"><div class="btn-info btn-sm" >ADMINISTRATOR MODULE</div><br></div>
  

  </div> <div class="row">
  <div class="col-sm-4">USERS ADMIN<input name='right[]' type='checkbox' value='USERS ADMIN'   class='form-control input-sm'></div>
  <div class="col-sm-4">COMPANY ADMIN <input name='right[]' type='checkbox' value='>COMPANY ADMIN'   class='form-control input-sm'></div>
  <div class="col-sm-4">ZONE ADMIN <input name='right[]' type='checkbox' value='ZONE ADMIN'   class='form-control input-sm'></div>

   </div>
   
     <div class="row">
	  <div class="col-sm-4">BACKUP DATABASE<input name='right[]' type='checkbox' value='BACKUP DATABASE'   class='form-control input-sm'></div>
  <div class="col-sm-4">AUDIT TRAIL<input name='right[]' type='checkbox' value='AUDIT TRAIL'   class='form-control input-sm'></div>
<div class="col-sm-4">MULTI EDIT <input name='right[]' type='checkbox' value='MULTI EDIT'   class='form-control input-sm'></div>
</div>
 <div class="row">
	  <div class="col-sm-4">ARCHIVE<input name='right[]' type='checkbox' value='ARCHIVE'   class='form-control input-sm'></div>
</div>

<div class="row">
  
  <div class="col-sm-10"><div class="btn-info btn-sm" >SMS/EMAILS MODULE</div><br></div>
  

  </div>
  
   <div class="row"><div class="col-sm-4">POST SMS-EMAILS<input name='right[]' type='checkbox' value='POST SMS-EMAILS'   class='form-control input-sm'></div>
  <div class="col-sm-4">SEND  SMS-EMAILS<input name='right[]' type='checkbox' value='SEND  SMS-EMAILS'   class='form-control input-sm'></div>
  <div class="col-sm-4">EDIT CONTACTS<input name='right[]' type='checkbox' value='EDIT CONTACTS'   class='form-control input-sm'></div>
   </div>
  
    <div class="row">
	 <div class="col-sm-4">DELETE SMS-EMAILS<input name='right[]' type='checkbox' value='DELETE SMS-EMAILS'   class='form-control input-sm'></div>
	 <div class="col-sm-4">UPLOAD CONTACTS<input name='right[]' type='checkbox' value='UPLOAD CONTACTS'   class='form-control input-sm'></div>
	</div>
	  <div class="row">
  
  <div class="col-sm-10"><div class="btn-info btn-sm" >BILLING  MODULE</div><br></div>
  

  </div>
  
   <div class="row">
  <div class="col-sm-4">BILLING <input name='right[]' type='checkbox' value='BILLING'   class='form-control input-sm'></div>
    <div class="col-sm-4">VIEW BILLS <input name='right[]' type='checkbox' value='VIEW BILLS'   class='form-control input-sm'></div>
  <div class="col-sm-4">DELETE BILLS <input name='right[]' type='checkbox' value='DELETE BILLS'   class='form-control input-sm'></div>
  </div>
  <div class="row">
  <div class="col-sm-4">EDIT BILLS <input name='right[]' type='checkbox' value='EDIT BILLS'   class='form-control input-sm'></div>
   <div class="col-sm-4">UPLOAD BILLS <input name='right[]' type='checkbox' value='UPLOAD BILLS'   class='form-control input-sm'></div>

  </div>
    <div class="row">
  
  <div class="col-sm-10"><div class="btn-info btn-sm" >ACCOUNTS MODULE</div><br></div>
  
 
  </div>
  
   <div class="row">
  <div class="col-sm-4">VIEW SLIPS<input name='right[]' type='checkbox' value='VIEW SLIPS'   class='form-control input-sm'></div>
  <div class="col-sm-4">ADD SLIPS<input name='right[]' type='checkbox' value='ADD SLIPS'   class='form-control input-sm'></div>
  <div class="col-sm-4">DELETE SLIPS<input name='right[]' type='checkbox' value='DELETE SLIPS'   class='form-control input-sm'></div>
  </div>
   <div class="row"> 
   <div class="col-sm-4">EDIT SLIPS <input name='right[]' type='checkbox' value='EDIT SLIPS'   class='form-control input-sm'></div>
   <div class="col-sm-4">UPLOAD SLIPS<input name='right[]' type='checkbox' value='UPLOAD SLIPS'   class='form-control input-sm'></div>
   <div class="col-sm-4">PAYMENT CODES <input name='right[]' type='checkbox' value='PAYMENT CODES'   class='form-control input-sm'></div>
   </div> 
   
   
    <div class="row">
 <div class="col-sm-10"><div class="btn-info btn-sm" >RECIEPT MODULE</div><br></div>
</div>
 <div class="row">
  <div class="col-sm-4">VIEW RECEIPTS<input name='right[]' type='checkbox' value='VIEW RECIEPTS'   class='form-control input-sm'></div>
  <div class="col-sm-4">ADD RECIEPTS<input name='right[]' type='checkbox' value='ADD RECIEPTS'   class='form-control input-sm'></div>
  <div class="col-sm-4">REVERSE RECIEPTS<input name='right[]' type='checkbox' value='REVERSE RECIEPTS'   class='form-control input-sm'></div>
<div class="col-sm-4"></div>
  </div>
    <div class="row">
<div class="col-sm-10"><div class="btn-info btn-sm" >REPORTS MODULE</div><br></div>
</div>
  <div class="row">
  <div class="col-sm-4">VIEW REPORTS<input name='right[]' type='checkbox' value='VIEW REPORTS'   class='form-control input-sm'></div>
  <div class="col-sm-4">GRAPH SUMMARY<input name='right[]' type='checkbox' value='GRAPH SUMMARY'   class='form-control input-sm'></div>

 </div>
  <div class="row">
 <div class="col-sm-10"><div class="btn-info btn-sm" >REGISTRY MODULE</div><br></div>
 </div>
   <div class="row">
  <div class="col-sm-4">ACCOUNTS REG<input name='right[]' type='checkbox' value='ACCOUNTS REG'   class='form-control input-sm'></div>
  <div class="col-sm-4">EDIT ACCOUNT<input name='right[]' type='checkbox' value='EDIT ACCOUNT'   class='form-control input-sm'></div>
  <div class="col-sm-4">UPDATE STATUS<input name='right[]' type='checkbox' value='UPDATE STATUS'   class='form-control input-sm'></div>
 
  
  </div>
  <div class="row">
   <div class="col-sm-4">DELETE ACCOUNT<input name='right[]' type='checkbox' value='DELETE ACCOUNT'   class='form-control input-sm'></div>
  <div class="col-sm-4">NEW CONNECTION <input name='right[]' type='checkbox' value='NEW CONNECTION'   class='form-control input-sm'></div>
  <div class="col-sm-4">ACCOUNT TRANSFER <input name='right[]' type='checkbox' value='ACCOUNT TRANSFER'   class='form-control input-sm'></div>
   

  </div>
    <div class="row">
	 <div class="col-sm-4">ACCOUNTS TRAIL <input name='right[]' type='checkbox' value='ACCOUNTS TRAIL'   class='form-control input-sm'></div>
	<div class="col-sm-4">UPLOAD ACCOUNTS <input name='right[]' type='checkbox' value='UPLOAD ACCOUNTS'   class='form-control input-sm'></div>
	</div>
   <div class="row">
 <div class="col-sm-10"><div class="btn-info btn-sm" >METER REGISTRY MODULE</div><br></div>
 </div>
  
    <div class="row">
  <div class="col-sm-4">METER REG<input name='right[]' type='checkbox' value='METER REG'   class='form-control input-sm'></div>
  <div class="col-sm-4">NEW METER<input name='right[]' type='checkbox' value='NEW METER'   class='form-control input-sm'></div>
  <div class="col-sm-4">EDIT METER<input name='right[]' type='checkbox' value='EDIT METER'   class='form-control input-sm'></div>
  
    
  </div>
   <div class="row"> 
   <div class="col-sm-4">DELETE METER<input name='right[]' type='checkbox' value='DELETE METER'   class='form-control input-sm'></div> 
   <div class="col-sm-4">PRODUCTION METER<input name='right[]' type='checkbox' value='PRODUCTION METER'   class='form-control input-sm'></div>
   </div>
   
     <div class="row">
 <div class="col-sm-10"><div class="btn-info btn-sm" >GEO MAPPING MODULE</div><br></div>
 </div> 
   
     <div class="row">
  <div class="col-sm-4">UPDATE CORDINATES<input name='right[]' type='checkbox'     value='UPDATE CORDINATES'   class='form-control input-sm'></div>
  <div class="col-sm-4">GENERATE MAP<input name='right[]' type='checkbox'       value='GENERATE MAP'   class='form-control input-sm'></div>
   .
  </div>
     <div class="row">
 <div class="col-sm-10"><div class="btn-info btn-sm" >INVENTORY MODULE</div><br></div>
 </div>
  
    <div class="row">
  <div class="col-sm-4">INVENTORY REG<input name='right[]' type='checkbox'     value='INVENTORY REG'   class='form-control input-sm'></div>
  <div class="col-sm-4">DELETE ITEM<input name='right[]' type='checkbox'       value='DELETE ITEM'   class='form-control input-sm'></div>
  <div class="col-sm-4">RESTOCK ITEM <input name='right[]' type='checkbox'       value='RESTOCK ITEM'   class='form-control input-sm'></div>
  
	
  </div>
  
    <div class="row"><div class="col-sm-4">UNSTOCK ITEM <input name='right[]' type='checkbox'       value='UNSTOCK ITEM'   class='form-control input-sm'></div>
  <div class="col-sm-4">REQUISITION <input name='right[]' type='checkbox'       value='REQUISITION'   class='form-control input-sm'></div>
	  <div class="col-sm-4">GATE PASS <input name='right[]' type='checkbox'       value='GATE PASS'   class='form-control input-sm'></div>
   

  </div>
  
  <div class="row"> <div class="col-sm-4">L.P.O <input name='right[]' type='checkbox'       value='L.P.O'   class='form-control input-sm'></div></div>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-2"></div></div></div></div></div></div></div>
  </form>
 
  
  <form id="results" method="post" action="editusers.php">
 <h4   style="text-align:center"><strong>USER RIGHTS TABLE</strong></h4>
<div  id="datatable"> 
 <table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  height="21" valign="top" >NAME	  </td>
			            <td  class="theader"  height="21" valign="top" >LOGG STATUS</td>
			 <td   width="60%" class="theader"  height="21" valign="top" >ACCESS RIGHTS</td>            
			  <td  class="theader" valign="top">
			    <select class="form-control"   required= "on"  name="action"  id="action">
			   <option value="">ACTION</option>
			   <option value="reset">RESET PASSWORD</option>
			  <option value="delete">DELETE </option>
              <option value="loggoff">LOGG OFF  </option>
			   <option value="suspend">SUSPEND ACCOUNT </option>
			    <option value="activate">ACTIVATE  ACCOUNT </option>
			   <option value="edit">EDIT </option>
			  
			  </select></td>    
          </tr>
        </thead>
        <tbody>
        <?php
		
	$x="SELECT * FROM users  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['name']."</td>  
              <td>".$y['logged']."</td>  
			    <td  width='60%'>".$y['access']."</td>   	
				<td><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td>      
			       
           </tr>";
		 }
		 
		 }  
		 else 
		 {
		 echo"<tr  class='filterdata'><strong>
			   <td>NO DATA</td>    
                <td  >FOUND</td>	
				           
			       
          </strong> </tr>";
		 
		 }
	
	?>
        </tbody>
		
    </table>
	<br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
	  </div>
</form>
  
  
  <div class="modal-footer" >

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

