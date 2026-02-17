 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'UPDATE STATUS'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;}}

#levelchart{ width:80%;}
  </style>
  
		  <style type="text/css" >
	
  </style>
	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
body{width:80%; margin-left:3%; margin-right:2%;}
#searchaccounth{ border-style:solid;border-radius:2%; width:80%; margin-left:2%; margin-right:0%;}   .dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
} 
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
table{ font-size: 80%;}  #newslip{ font-size: 80%;} 
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
			   text-align:center;
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	

	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $('#searchaccount').modal('show');
 $("#loadslips").click(function()
{$('#prepostmessage').modal('show'); $("#content").load("message.php #content"); $('#message').modal('show'); 
$.post( "payrefferencesession.php",
$("#account").serialize(),
function(data){$("#payrefference").load("payrefference.php #payrefference2");$('#prepostmessage').modal('hide');
});  return false;
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


$("#reconnect").submit(function()
{
$.post( "reconnectsession.php",
$("#reconnect").serialize(),
function(data){$("#content").load("message.php #content"); $('#message').modal('show');
});  return false;
})
 })
  
  </script>
  <script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "readCountry.php",
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
  <!-- Trigger the modal with a button -->

   
    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div>    
    
	
<form id="reconnect"  method="post"    action="reconnectsession.php"> 

<?php 
$account=$_SESSION['account'];
$x="SELECT *  from $accountstable  WHERE  account='$account' AND status !='CONNECTED'";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$location=$y[6];$name=$y['client']; $contact=$y['contact'];  $meternumber=$y['meternumber'];   $status=$y['status'];  }}
?>
     <div class="container" id="accountdetails">
	 <h4   style="text-align:center"><strong>RECONNECTION CLIENT <?php print  $name;?> CURRENT STATUS  <?php print $status;?></strong></h4>
  <div class="row">
  <div class="col-sm-10">  <br>
  
  <div >
METER NUMBER
  <input  style='text-transform:uppercase' name="meter" type="text" size="15"    readonly  class="form-control input-sm"     autocomplete="off"  value="<?php  echo $meternumber;?>" ><br/>
ACCOUNT NUMBER
<input  style='text-transform:uppercase'  required="on" name="account" id="account"  type="text" size="15"  readonly="readonly" value="<?php echo  $_SESSION['account'];?>"   class="form-control input-sm"     autocomplete="off" ><br/>
<br>


PAY CODE REFFERENCE
<div  id="payrefference" >
<select class='form-control'   name='payrefference' required="on"  >
 <option value=''>SELECT  PAY SLIP </option>

			  </select></div><br />
</div>
<br/>
 
  </div><div class="col-sm-2"></div></div><button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" id="loadslips" class="btn-info btn-sm">LOAD SLIPS</button>   
</div><br>

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
