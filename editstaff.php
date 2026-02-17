<?php 
@session_start();
include_once("password2.php");
$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  NAME='$dbdetails->user' AND PASSWORD='$dbdetails->password'  AND ACCESS REGEXP 'STAFF REGISTRY'  ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$id=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id']))));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>HADDASSAH SOFTWARES</title>
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
#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}

	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; } body {text-transform:inherit;}
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
	 
	 #idnumber-list
{
	 overflow-y: scroll;      
  height: 60%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

  </style>
  
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover();
   
   $("#updatestaff").submit(function(){
		var action="UPDATE";
	 var x=confirm(action);   
	 if(x ==false){return false; }
return true;
})




 })
  
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
<button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  

    <!-- Modal -->
  </div>
  
  
   <div class="container">
  <div class="row">  
  <form method="post" action="updatestaff.php" id="updatestaff">
  <div>
      <hr>
    <?php 
  

 $x = $connect ->query("SELECT ID,TITLE,IDNUMBER,NAMES,KRAPIN,BASICSALARY,HOUSEALLOWANCE,TRAVELALLOWANCE,HARDSHIPALLOWANCE,PAYEE,NHIF,NSSF FROM  STAFFS WHERE  ID ='$id' ");
while ($data = $x->fetch_object())
{ 
	?>
<div class="container">
  <div class="row">
  <div class="col-sm-3">
  ID  NUMBER
  <input type="text"  class="form-control input-sm" placeholder="ID NUMBER" name="idnumber" value="<?php print $data->IDNUMBER;?>"   style="text-transform:uppercase;" id="idnumber" pattern="[0-9]+" title="INVALID ENTRIES" autocomplete="off"  
  required="on" /><?php "XXX"; ?>
<br>
  K.R.A PIN  <input type="text" style='text-transform:uppercase' value="<?php print $data->KRAPIN;?>"  autocomplete="off"  placeholder="ENTER K.R.A PIN " class="form-control input-sm"  name="krapin" pattern="[A-Za-z0-9]+"  required="on" /><br>

  TITLE 
  <select class='form-control'   name='title' required="on"  >
 <option value="<?php print $data->TITLE;?>"><?php print $data->TITLE;?></option>
              <option value='MR.'>MR.</option>
			  <option value='MRS.'>MRS.</option>
			   <option value='MISS.'>MISS</option>
			  </select>

  <br>
  NAMES<input type="text" style='text-transform:uppercase' value="<?php print $data->NAMES;?>"  autocomplete="off"  placeholder="ENTER STAFF NAMES " class="form-control input-sm"  name="names" pattern="[A-Za-z,.` ]+" id="staffnames"   required="on" /><br>
  			  

			  
			  
<div>
       </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<div align="center"> 
</div>
  </div>
  
  <div class="col-sm-3">
  BASIC SALARY  <input type="text" style='text-transform:uppercase' value="<?php print $data->BASICSALARY;?>"  autocomplete="off"  placeholder="ENTER BASIC SALARY  " class="form-control input-sm"  name="basicsalary" pattern="[0-9]+"   required="on" /><br>
  HOUSE ALLOWANCE  <input type="text" style='text-transform:uppercase' value="<?php print $data->HOUSEALLOWANCE;?>"  autocomplete="off"  placeholder="ENTER HOUSE ALLOWANCE " class="form-control input-sm"  name="houseallowance" pattern="[0-9]+"   required="on" /><br>
  TRAVELLING ALLOWANCE   <input type="text" style='text-transform:uppercase' value="<?php print $data->TRAVELALLOWANCE;?>"   autocomplete="off"  placeholder="ENTER TRAVELLING ALLOWANCE " class="form-control input-sm"  name="travellallowance" pattern="[0-9]+"  required="on" /><br>
  
  HARDSHIP  ALLOWANCE   <input type="text" style='text-transform:uppercase' value="<?php print $data->HARDSHIPALLOWANCE;?>"  autocomplete="off"  placeholder="ENTER HARDSHIP ALLOWANCE" class="form-control input-sm"  name="hardshipallowance" pattern="[0-9]+"   required="on" /><br>


  </div>
  <div class="col-sm-3">
  PAYEE  <input type="text" style='text-transform:uppercase' value="<?php print $data->PAYEE;?>"  autocomplete="off"  placeholder="ENTER PAYEE  " class="form-control input-sm"  name="payee" pattern="[0-9]+"   required="on" /><br>
  NHIF  <input type="text" style='text-transform:uppercase' value="<?php print $data->NHIF;?>" autocomplete="off"  placeholder="ENTER NHIF DEDUCTION " class="form-control input-sm"  name="nhif" pattern="[0-9]+"   required="on" /><br>
  NSSF  <input type="text" style='text-transform:uppercase'  value="<?php print $data->NSSF;?>"  autocomplete="off"  placeholder="ENTER NSSF DEDUCTION " class="form-control input-sm"  name="nssf" pattern="[0-9]+"    required="on" /><br>
  <br>
  <input type="hidden" name ="staffid" value ="<?php print $id; ?>" >
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
<button type="reset" class="btn-info btn-sm">RESET</button> 

  </div>
  <div class="col-sm-3"></div> 
</div></div>
</form>
<?php 		
			
			
}
  
  ?>
  
  
 </form>
	
	</div>
  </div>


<?php 
include_once("dashboard3.php");
?>
 
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
  



