<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
@$account=$_SESSION['account'];
if($min2 <1){$min2=0;} if($max2 <1){$max2=0;}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'VIEW REPORTS'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$duedate=date("Y-m");
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLLING SOFTWARE </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
body{font-size:small;}
#levelchart{ width:80%;}
  </style>
  	<style>
	
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:left;
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
   $('#acrange').modal('show');

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


 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>
     <div class="col-sm-8">  
   
 
 
 <h4   style="text-align:center"><strong>OVERDUE BILLING DATE   REPORT AS  AT <?php echo $duedate;?></strong></h4>
</div> <img src="letterhead.png"    id="letterhead"  width="70%"  height="30%"  /><button class="btn-info btn-sm" onclick="window.print()">PRINT</button> 
<form id="updatebillform" action="waterbill2.php" method="post" >
<div  id="billingtable"> 
<div class="container">  
  <div class="row">
  <div class="col-sm-2"> </div>


<div class="col-sm-4"><input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off"></div>
 </div>
 
    <!-- Modal -->
  </div>
  
<table class="table table-bordered"  id="smstable">
        <!--DWLayoutTable-->
        <thead>
          
        </thead>
        <tbody>
            <tr>
		   <td  class="theader"   valign="top" >ACCOUNT</td> 
			<td  class="theader"   valign="top" >METER NUMBER </td>		   
		    <td  class="theader"  valign="top" >LAST READING </td>
			 <td  class="theader"  valign="top" >DAYS ELAPSED</td>
          </tr>
       <?php
	   $x="CREATE TEMPORARY TABLE DUEBALANCE(A TEXT,B TEXT,C TEXT,D TEXT)";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	  // $x="INSERT INTO DUEBALANCE (A,B,C,D) SELECT ACCOUNT,METERNUMBER,MAX(DATE),DATEDIFF(CURRENT_DATE,MAX(DATE)) FROM $billstable  WHERE  ACCOUNT IN(SELECT ACCOUNT FROM $accountstable WHERE STATUS='CONNECTED')    GROUP BY ACCOUNT  ";
	  	  $x="INSERT INTO DUEBALANCE (A,B,C,D) SELECT ACCOUNT,METERNUMBER,MAX(DATE),DATEDIFF(CURRENT_DATE,MAX(DATE)) FROM $billstable  WHERE  ACCOUNT IN(SELECT ACCOUNT FROM $accountstable WHERE STATUS='CONNECTED' )    GROUP BY ACCOUNT  ";

mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT A,B,C,D FROM DUEBALANCE WHERE D >30 ORDER BY A";

		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
              <td>".$y['A']."</td>    
			  <td>".$y['B']."</td>  
			    <td>".$y['C']."</td>
				  <td>".$y['D']."</td>
           </tr>";
		 }
		 
		 } 
		 
		 else {
	echo ' <tr>
	<td    height="28" valign="top" >  </td><td    height="28" valign="top" >  </td>	
		   <td    height="28" valign="top" >ACCOUNT</td> 	   
		    <td    height="28" valign="top" >MISSING</td>     
			 <td    height="28" valign="top" ></td>
 </tr>	';	 
		 }
		 
		 
$x="SELECT COUNT(A) FROM DUEBALANCE WHERE D >30 ";

		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 
	 echo"<tr class='filterdata'>
              <td>TOTAL</td>    
			  <td>".$y['COUNT(A)']."</td>  
			    <td></td>
				  <td></td>
           </tr>";
		 }
		 
		 } 
		 	$x="DROP TEMPORARY TABLE DUEBALANCE";mysqli_query($connect,$x)or die(mysqli_error($connect));

		?>

        </tbody>
    </table>
</div>
</form>

  
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
  
  
  <!--dashboard-->



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
