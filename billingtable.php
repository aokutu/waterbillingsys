<?php
@session_start();
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");@$min2=$_SESSION['acc1'];@$max2=$_SESSION['acc2'];
if($min2 <1){$min2=0;} if($max2 <1){$max2=0;}
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  STATUS ='ACTIVE'  AND   LEVEL  >=1";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />

  <style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;}}
body{font-size:small;}
#levelchart{ width:80%;}
  </style>
  	<style>
	
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();    
   $('#acrange').modal('show');
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

<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autocompletelibrary.php",
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

<script>
$(document).ready(function(){
	$("#autosearch1").keyup(function(){
		$.ajax({
		type: "POST",
		url: "autosearch.php",
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
     <!-- Modal -->
	
  </div>
    
<div  id="billingtable"> 
  <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">
<table class="table"  id="smstable">
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"  height="28" valign="top" >ACCOUNT</td>     
		    <td  class="theader"  height="28" valign="top" >PREVIOUS READING</td>     
			 <td  class="theader"  height="28" valign="top" >DATE </td>
			 	<td  class="theader"  height="28" valign="top" >STATUS</td>
			  <td  class="theader"  height="28" valign="top" > NEW READING </td>
          </tr>
        </thead>
        <tbody>
       <?php
$x="SELECT * FROM $accountstable  WHERE  account  >=$min2    AND  account <=$max2  ORDER BY account     ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['account']."</td>  
			    <td>".$y['email']."</td>
			   <td>".$y['date2']."</td>
			   <td>
			   <select class='form-control'   name='status' >
			   <option value=''>".$y['status']."</option>
			  <option value='CONNECTED'>CONNECTED</option>
              <option value='COR'>COR</option>
			  <option value='CONP'>CONP</option>
			   <option value='NEW ACC'>NEW ACC</option>
			  </select>
			   
			   
			   </td>
			   
<td>
<a href='#' title='INFO' data-toggle='popover' data-trigger='hover' data-content='ENTER NEW READING' data-placement='bottom'>
<input  name='currentreading[".$y['account']."]' type='number'  placeholder='NEW READING  '    class='form-control input-sm'   autocomplete='off' ></a>
</td> 
				
           </tr>";
		 }
		 
		 } 
		?>

        </tbody>
    </table>
 <br><br>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
	  <button class="btn-info btn-sm" onclick="window.print()">PRINT</button>
</div>
</body>
</html>
