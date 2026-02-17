<?php 
@session_start();
//include_once("loggedstatus.php");
include_once("password2.php");
include_once("interface.php");
$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="ADMIN";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


class edititem 
{
public $id1=null;
public $id2=null;
public $id3=null;	
}

$edititem =new edititem;
$edititem->id1=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id1']))));
$edititem->id2=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id2']))));
$edititem->id3=$connect->real_escape_string(trim(addslashes(strtoupper($_GET['id3']))));

if($edititem->id3 !=null)
{ ?>

<form method="post" action="updateimagingdetails.php">
<?php
$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE,ID  FROM imagingservices WHERE ID=$edititem->id3 ");
while ($data = $x->fetch_object())
{
?>

<HR>
<div class="container">
  <div class="row">
  <div class="col-sm-12">DESCRIPTION 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SERVICE   NAME " data-placement="bottom">
<input style='text-transform:uppercase'   <?php if(($data->DETAILS=='BED CHARGES') OR ($data->DETAILS=='CONSULTATION') OR ($data->DETAILS=='COMPLETE BLOOD COUNT') OR ($data->DETAILS=='URINE ANALYSIS') ){print 'readonly';}  ?> required value="<?php print $data->DETAILS;?>" name="service" type="text"  pattern="[A-Za-z'0-9 -'%(),/.'" ]+"  title="INVALID ENTRIES"   size="15" placeholder="ITEM NAME"   class="form-control input-sm"     autocomplete="off" ></a>
<br>NORMAL PRICE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' value="<?php print $data->PRICE;?>" required  name="price" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15" placeholder="ITEM  PRICE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
COPRATE PRICE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="COPRATE PRICE" data-placement="bottom">
<input style='text-transform:uppercase' value="<?php print $data->COPRATEPRICE;?>" required  name="coprateprice" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15" placeholder="COPRATE  PRICE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<label><input type="radio" id="cashpay"  checked="on" name="itemcategory" checked value="IMAGING">IMAGING</label>  
<label><input type="radio" id="cashpay"  disabled name="itemcategory"  value="SERVICE">SERVICE</label>  
		 <label><input disabled type="radio" id="mpesapay"  name="itemcategory" value="ITEM">ITEM</label> 
		  <label><input type="hidden" name="id" value="<?php print $data->ID;?>">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</label>

 </div>
  

</div></div>
<?php }
?>
</form>

<?php
	
}


if($edititem->id1 !=null)
{  ?>
<form method="post" action="updateservicedetails.php">
<?php
$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE,ID  FROM services WHERE ID=$edititem->id1 ");
while ($data = $x->fetch_object())
{
?>

<HR>
<div class="container">
  <div class="row">
  <div class="col-sm-12">DESCRIPTION 
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="SERVICE   NAME " data-placement="bottom">
<input style='text-transform:uppercase'   <?php if(($data->DETAILS=='BED CHARGES') OR ($data->DETAILS=='CONSULTATION') OR ($data->DETAILS=='COMPLETE BLOOD COUNT') OR ($data->DETAILS=='URINE ANALYSIS') ){print 'readonly';}  ?> required value="<?php print $data->DETAILS;?>" name="service" type="text"  pattern="[A-Za-z'0-9 -'%(),/.'" ]+"  title="INVALID ENTRIES"   size="15" placeholder="ITEM NAME"   class="form-control input-sm"     autocomplete="off" ></a>
<br>NORMAL PRICE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' value="<?php print $data->PRICE;?>" required  name="price" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15" placeholder="ITEM  PRICE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
COPRATE PRICE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="COPRATE PRICE" data-placement="bottom">
<input style='text-transform:uppercase' value="<?php print $data->COPRATEPRICE;?>" required  name="coprateprice" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15" placeholder="COPRATE  PRICE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<label><input type="radio" id="cashpay"  checked="on" name="itemcategory" checked value="SERVICE">SERVICE</label>  
		 <label><input disabled type="radio" id="mpesapay"  name="itemcategory" value="ITEM">ITEM</label> 
		  <label><input type="hidden" name="id" value="<?php print $data->ID;?>">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</label>

 </div>
  

</div></div>
<?php }
?>
</form>
<?php
 } 

else if($edititem->id2 !=null)
{
	
	 ?>
<form  method="post" action="updatemedicinedetails.php" >



<?php
$x=$connect->query("SELECT ITEM,PRICE,ID,UNITS  FROM inventory WHERE ID=$edititem->id2 ");
while ($data = $x->fetch_object())
{
?>


<div class="container">
  <div class="row">
  <div class="col-sm-12">PHARMACETICALS
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM   NAME " data-placement="bottom">
<input style='text-transform:uppercase' required  name="item" type="text"  value="<?php print $data->ITEM;?>" pattern="[A-Za-z'0-9 -'%(),/.'" ]+"  title="INVALID ENTRIES"   size="15" placeholder="ITEM NAME"   class="form-control input-sm"     autocomplete="off" ></a>
<br>PRICE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ITEM PRICE" data-placement="bottom">
<input style='text-transform:uppercase' value="<?php print $data->PRICE;?>"required  name="price" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15" placeholder="ITEM  PRICE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
COPRATE PRICE
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="COPRATE PRICE" data-placement="bottom">
<input style='text-transform:uppercase' value="<?php print $data->COPRATEPRICE;?>" required  name="coprateprice" type="text"  pattern="[0-9.]+"  title="INVALID ENTRIES"   size="15" placeholder="COPRATE  PRICE"   class="form-control input-sm"     autocomplete="off" ></a>
<br>
<label><input type="radio" id="cashpay" disabled  name="itemcategory" checked value="SERVICE">SERVICE</label>  
		 <label><input type="radio" checked="on"  id="mpesapay"  name="itemcategory" value="ITEM">ITEM</label>
<label><input type="hidden" name="id" value="<?php print $data->ID;?>">
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button>
</label>		 
<br>

 </div>
</div></div>
<?php }
?>

<datalist id="patientnmberslist" >
<?php 
$x=$connect->query("SELECT DISTINCT(UNITS)  FROM  inventory");
while ($data = $x->fetch_object())
{
	
?>
	 <option value="<?php print $data->UNITS; ?> " >  <?php print $data->UNITS; ?></option>	
		
		<?php 	
	
	
}
		  
		

?>
</datalist>
</form>
<?php
 } ?>