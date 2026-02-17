<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW REPORTS' ";
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
$('[data-toggle="popover"]').popover(); 
  $('#viewreports').modal('show');
$("#report").load("accountreports.php #reportdata");
   $("#viewreports").submit(function(){
$.post("waterflowsession.php",$("#viewreports").serialize(),function (data){
$("#content").load("message.php #content"); 
$('#message').modal('show');
$("#report").load("accountreports.php #reportdata");
	})
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
<div class="container">

 <div class="container">
  <div class="row">
  <div class="col-sm-12">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="VIEW REPORTS" data-placement="bottom"><button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#viewreports">VIEW REPORTS</button></a>
   
   
   
   <button class="btn-info btn-sm" onclick="window.print()">PRINT</button><br />
     </div></div></div>
  
   
    <!-- Modal -->
  </div>
 
 
   
  <form class="modal fade" id="viewreports" role="dialog"    action="waterflowsession.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">SELECT GROUP METHOD 
  <div class="container">
  <div class="row">
  <div class="col-sm-8">  <br>
GROUP BY<select class="form-control"   required= "on"  name="category" >
			   <option value="">GROUP BY</option>
			    <option value="ZONE">ZONE</option>
			  <option value="STATUS">ACCOUNTS STATUS</option>
	      <option value="CLASS">CLASS</option>
	      <option value="SIZE">METER SIZE</option>
	    	  <option value="LOCATION">LOCATION</option>
	    	  <option value="STATUS2">METER STATUS </option>
		

		  
			  </select><br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>
  
  
   
<form id="report" method="post" >

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

