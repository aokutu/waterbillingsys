<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'ACCOUNTS REG'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$account=$_SESSION['account'];
$x="SELECT * FROM $accountstable  WHERE account='$account'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
while ($y=@mysqli_fetch_array($x))
{
$meternumber=$y['meternumber'];	 $client=$y['client'];$size=$y['size'];$location=$y['location'];$reading=$y['email'];$readingdate=$y['date2'];
$contact=$y['contact'];$status=$y['status'];$idnumber=$y['idnumber'];$avgunit=$y['avgunit'];  $email=$y['clientemail'];$deposit=$y['deposit'];$plotnumber=$y['plotnumber'];
  }}
?>
<!doctype html>
<html lang="us"><head>
	<meta charset="utf-8"  http-equiv="cache-control"  content="NO-CACHE">
		<title ><?php echo $account; ?></title>
		 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
<link href="stylesheets/jquery-ui.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="stylesheets/dhtmlxcalendar.css"/>
			<link rel="stylesheet"  href="stylesheets/dashboard.css" />
			<style type="text/css">

  @media print{ button{display:none;};  select{display:none;}; #previous{display:none;}; }
		 .heading{ background-color:#ADD8E6; border-style:double; border-radius:3%; text-align:left;}
			 body{ font-size:98%;  text-transform:inherit;}  tr:hover{ background-color: #CCCCCC; cursor:pointer; color:#0000FF;}
			 tr >td:hover{ background-color: #B0C4DE; cursor:pointer; color:#0000FF;}
			 .bold{ font-weight: bolder;} form{ margin-right:5%; margin-left:5%;}
form{ border-style:solid;border-radius:2%;margin-left:1%; margin-right:1%;}
			</style>
	<script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" class="" ></script>
  
	<SCRIPT type="text/javascript">

    window.history.forward();

    function noBack() { window.history.forward(); }

</SCRIPT>
<script type="text/javascript"> 
$(document).ready(function()
{
$("#print").click(function (){return false;})
$("#next").click(function (){return true;})
$("#previous").click(function (){return true;})
})

});</script>
</head>
<script src="pluggins/jquery.js"></script>
<script src="pluggins/jquery-ui.js"></script>
<script src="pluggins/jquery.client.js"></script>
</head>
<body    oncontextmenu="return false;"  >

<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">

<form  id="clientdetails"   method ="post"  action="processdetails.php" > 
<img src="letterhead.png"    id="letterhead"  width="50%"  height="50%"  />
<div class="bold"><h4   style="text-align:center"><strong>CLIENT DETAILS</strong></h4></div>
<table class="table table-bordered" >
<tr>
            <td    height="21" valign="top" ><div class="bold">CLIENT NAME</div>	  </td>
			 <td    height="21" valign="top" ><?php echo $client;?></td> 
			 <td    height="21" valign="top" ><div class="bold">ID NUMBER.</div></td>            
			  <td   valign="top"><?php echo $idnumber;?></td>
 <td    height="21" valign="top" ><div class="bold">PLOT NUMBER</div></td>            
			  <td   valign="top"><?php print $plotnumber;?></td> 			</tr>
<tr>			
			  <td    height="21" valign="top" ><div class="bold">DEPOSIT</div></td>            
			  <td   valign="top"><?php echo number_format($deposit,2);?></td> 
			  <td    height="21" valign="top" ><div class="bold"></div></td>            
			  <td   valign="top"></td>
			  <td    height="21" valign="top" ><div class="bold"></div></td>            
			  <td   valign="top"></td> 
          </tr>
<tr>			
			  <td    height="21" valign="top" ><div class="bold">LOCATION</div></td>            
			  <td   valign="top"><?php echo $location;?></td> 
			  <td    height="21" valign="top" ><div class="bold">CONTACT</div></td>            
			  <td   valign="top"><?php echo $contact;?></td>
			  <td    height="21" valign="top" ><div class="bold">EMAIL</div></td>            
			  <td   valign="top"><?php echo $email;?></td> 
          </tr> 
		  
		  </table>
		  <div class="bold"><h4   style="text-align:center">METER DETAILS</h4></div>
 <table class="table table-bordered" >
 
		  <tr>
            <td    height="21" valign="top" ><div class="bold">ACCOUNT NUMBER	</div>  </td>
			 <td    height="21" valign="top" ><?php echo $account;?></td> 
			 <td    height="21" valign="top" ><div class="bold">METER NUMBER</div></td>            
			  <td   valign="top"><?php echo $meternumber;?></td>
		</tr>
<tr>		
			 <td    height="21" valign="top" ><div class="bold">METER SIZE.</div></td>            
			  <td   valign="top"><?php echo $size;?></td>
			  <td    height="21" valign="top" ><div class="bold">METER STATUS </div></td>            
			  <td   valign="top"><?php echo $status;?></td> 
			  
			   
          </tr>
		  
<tr>		
			 <td    height="21" valign="top" ><div class="bold">SET AVG UNIT.</div></td>            
			  <td   valign="top"><?php echo $avgunit;?></td>
			  <td    height="21" valign="top" ><div class="bold">LAST METER READING </div></td>            
			  <td   valign="top"><?php print $reading;?>&nbsp;&nbsp;&nbsp; DATE <?php print $readingdate; ?></td> 
			  
			   
          </tr>			  
		 	  
		  
	</div>
	</table>
	 <div class="bold"><h4   style="text-align:center">TERMS   OF SERVICE</h4> </div> 
	 <table   class="table table-bordered">
	 <tr> <td>THESE  ARE THE  TERMS  OF   SERVICE   BETWEEN  YOU    AND  THE   ORGANISATION</td></tr>
	 </table>
 <table class="table table-bordered" >
<tr>		
			 <td    height="21" valign="top" ><div class="bold">SIGN.</div></td>            
			  <td   valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  </tr>
			 <tr> <td    height="21" valign="top" ><div class="bold">DATE.</div></td>            
			  <td   valign="top"><?php echo date("Y-M-d");?></td></tr>
			  <tr><td    height="21" valign="top" ><div class="bold">SERVED BY </div></td>            
			  <td   valign="top"><?php echo $user;?></td> 
			  
			   
          </tr> 
		  
		 	  
		  
	</div>
	</table>
<button class="btn-info btn-sm" onClick="window.print()"   id="print"  name="action"   value="print"  >PRINT</button>
 
 <button type="submit" class="btn-info btn-sm"  id="previous"   name="action" value="previous"  >PREVIOUS AC&nbsp;&nbsp;&nbsp; </button>
 <button type="submit" class="btn-info btn-sm"  id="next" name="action"   value="next"   >NEXT AC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button><br><br>
	
</form>
<hr>
<?php include_once("dashboard3.php"); ?>

</body>
</html>