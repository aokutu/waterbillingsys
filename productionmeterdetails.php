<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'PRODUCTION METER' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

@$id=$_GET['id'];
$x="SELECT *  FROM  productionmeters  WHERE  id=$id";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$location=$y['location']; $lastreading=$y['reading']; $refferencenumber=$y['refferencenumber']; }}else {$refferencenumber=null;} 
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO BILLING  SOFTWARE </title>
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
	

<form action ="productionbill.php" method ="post">	 <h4   style="text-align:center"><strong>PRODUCTION METERS UPDATES</strong></h4>
  <div class="row">
  <div class="col-sm-10">  <br>
  
  <div >
REFFERENCE NUMBER
  <input  style='text-transform:uppercase' name="refferencenumber" type="text" size="15"    readonly  class="form-control input-sm"     autocomplete="off"  value="<?php  echo $refferencenumber;?>" ><br/>
LOCATION  
<input  style='text-transform:uppercase' name="location" type="text" size="15"  readonly="readonly" value="<?php print $location;?>"   class="form-control input-sm"     autocomplete="off" ><br/>
CURRENT   READINGS
<input  style='text-transform:uppercase' name="previous" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES " size="15"     readonly  class="form-control input-sm"     autocomplete="off"   value="<?php  echo $lastreading ;?>"><br />

NEW READING 
<input  style='text-transform:uppercase' name="current" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES "   required size="15"   class="form-control input-sm"    pattern="[0-9]+" title="ENTER NUMERIC ONLY" autocomplete="off" ><br />

CHLORINE USED (GRAMMS)
<input  style='text-transform:uppercase' name="chlorine" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES "  placeholder="CHLORINE USED" required  size="15"   class="form-control input-sm"    pattern="[0-9]+" title="ENTER NUMERIC ONLY" autocomplete="off" ><br />


READING DATE
<input  style='text-transform:uppercase' name="date"  required  type="date" size="15"   class="form-control input-sm"     autocomplete="off" ><br />
<input   name="action"  value="UPDATE" id="action" required  type="hidden" ><br />
<br>
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>
<br/>
 
  </div><div class="col-sm-2"></div></div>
<br></form>

 