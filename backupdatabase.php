<?php 
@session_start();
header("LOCATION:accessdenied4.php");exit; 
include_once("password.php");
include_once("loggedstatus.php");
$user=$_SESSION['user'];
$password=$_SESSION['password'];

@$min2=$_SESSION['acc1'];@$max2=$_SESSION['acc2'];
if($min2 <1){$min2=0;} if($max2 <1){$max2=0;}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BACKUP DATABASE' OR  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'ARCHIVE'  ";  
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
$("#registry").modal();
$('[data-toggle="popover"]').popover(); 
	$("#archive").submit(function(){
	    var x=confirm("WARNING ACTION IS IRREVASABLE ");   
	 if(x ==false){return false; } 
    
	    $('#prepostmessage').modal('show');
	
$.post( "processarchive.php",
$("#archive").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#content").load("message.php #content");$('#prepostmessage').modal('hide');
return true;});
})

	$("#searchaccount").submit(function(){
$('#prepostmessage').modal('show');
$.post( "sessionregistry.php",
$("#searchaccount").serialize(),
function(data){$('#prepostmessage').modal('show');
$("#content").load("message.php #content");
$("#archivecontent").load("archivedstatements2.php #ministatement");
$('#prepostmessage').modal('hide');});
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
		url: "searcharchive.php",
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
  <div class="modal fade" id="layout" role="dialog"     >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-10">  <br>
  <img src ="layout.png"   width="80%"  height="80%"   >

<hr>
 <button type="button" class="btn-info btn-sm" data-dismiss="modal" >CLOSE</button>
  </div><div class="col-sm-2"></div></div></div></div></div></div></div></div>
  
  

   <form action="backup/backup.php" method="post" id="backup" >
        <div class="container">
  <div class="row">
  <div class="col-sm-6">BACK UP  DATABASE</div><div class="col-sm-6"><input type="submit"  class="btn-info btn-sm"  value="BACKUP"  />  
 </div></div></div>
  
</form>
   <form action="processarchive.php" method="post" id="archive"  >
        <div class="container">
  <div class="row">
  <div class="col-sm-6">ARCHIVE DATE <input type="date" class="form-control input-sm"  name="archivedate"    required="on" /> </div><div class="col-sm-6"><br><input type="submit"  class="btn-info btn-sm"  value="ARCHIVE"  />  
</div></div>
<br>
 <div class="row">
  <div class="col-sm-6">SEARCH  ARCHIVED ACCOUNT</div>
<div class="col-sm-6" >
     <a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SEARCH ACCOUNT" data-placement="bottom">
	    <button type="button" class="btn-info btn-sm" data-toggle="modal" data-target="#searchaccount">SEARCH</button>
	    </a>   
    
</div>
</div>

</div>
  
</form>


  <form class="modal fade" id="searchaccount" role="dialog"   action="sessionregistry.php" method="post"  >
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8"> ACCOUNT NUMBER
  
  <div class="frmSearch">
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT" data-placement="bottom"><input  style='text-transform:uppercase' name="account" type="text" size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"   id="search-box"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"  autocomplete="off" ></a>


<div id="suggesstion-box"></div>
</div><br>
FROM <input  style='text-transform:uppercase' name="date1" type="date" size="15"   required="on"  class="form-control input-sm"    autocomplete="off" ><br>
TO<input  style='text-transform:uppercase' name="date2" type="date" size="15"   required="on"  class="form-control input-sm"   autocomplete="off" ><br>
<hr>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div></form>

<hr class="btn-info btn-sm">
<div id="archivecontent">
    </div>
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
