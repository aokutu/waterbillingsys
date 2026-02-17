<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'SEND  SMS-EMAILS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ print"<h1>ACCESS DENIED</h1>";exit;}
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
  </style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
$("#close1").click(function() {
        $("input").val("");
    });

$("#close2").click(function() {
        $("input").val("");
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
  <script type="text/javascript"> 
$(document).ready(function(){
$('[data-toggle="popover"]').popover(); 
 
setInterval(function(){
$("#sendsms").load('smsapi.php #clock');
$("#pendingsms").load("pendingsms.php #sms"); 
}, 10000);


});
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
      <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 


<form id="results" method="post" action="editusers.php">
<h4   style="text-align:center"><strong>PENDING MESSAGES </strong></h4>
<div id="pendingsms">
 <table   id="sms" class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"   height="21" valign="top" >ACC	  </td>
			 <td  class="theader"     height="21" valign="top" >CONTACT</td> 
			 <td  class="theader" width ='60%'  width ="70%"  height="21" valign="top" >MESSAGE</td>            
			  <td  class="theader"   height="21" valign="top" >POST DATE</td> 
			   <td  class="theader"   height="21" valign="top" >PROCESSING</td>
          </tr>
        </thead>
		
        <tbody  >
       <?php
		
	$x="SELECT * FROM outbox     WHERE status ='PENDING' AND contact  NOT REGEXP '@' ORDER  BY  date ,account,contact ASC";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
                <td     >".$y['account']."</td>
                <td     >".$y['contact']."</td>
                <td  width ='60%' >".$y['message']."</td> 
				 <td  >".$y['date']."</td>
				 <td  ><img src ='LoaderIcon.gif'></td>
				
           </tr>";
		 }
		 }else {echo"<tr class='theader' >
                <td  class='btn-info btn-sm'   >NO</td>
                <td class='btn-info btn-sm'    >PENDIG</td>
                <td class='btn-info btn-sm' width ='60%' >MESSAGE</td> 
				 <td class='btn-info btn-sm' ><img src ='LoaderIcon.gif'></td>
				<td class='btn-info btn-sm' ><img src ='LoaderIcon.gif'></td>
           </tr>";}

	?>
        </tbody>
		
      </table></div>
</form>
<h4   style="text-align:center"><strong><div  id="sendsms">  <img src ="LoaderIcon.gif"></div></strong></h4>
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
