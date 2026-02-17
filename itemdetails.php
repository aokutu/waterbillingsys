<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'INVENTORY REG' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$x="SELECT LOCATION,ITEMCODE,MINSTOCKLEVEL,CATEGORY,UNITS,BPRICE,PRICE FROM INVENTORY WHERE  ITEM ='".$_SESSION['item ']."' LIMIT 1";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{$location=$y['LOCATION'];$itemcode=$y['ITEMCODE'];$minstocklevel=$y['MINSTOCKLEVEL'];$itemcategory=$y['CATEGORY'];
	$bprice=$y['BPRICE'];$sprice=$y['PRICE'];$units=$y['UNITS'];
	}}
?>
<div  class="container" id="details">

  <div class="row">

    <div class="col-sm-4" >

	

	<div id="loaditem"></div>
	<br>
	<input type="hidden" name="action" value="UPDATE INVENTORY" >
STORAGE LOCATION
<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  STORAGE LOCATION" data-placement="bottom">
	<input type="text"  value="<?php print $location; ?>"  pattern="[A-Za-z0-9.\/ -+_]+" placeholder="ENTER STORAGE LOCATION "   class="form-control input-sm"  name="location"  id="location"  required="on"   /></a>
	<br>
	
ITEM CODE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER ITEM CODE " data-placement="bottom">
	<input   value="<?php print $itemcode; ?>"  style="text-transform:uppercase"  type="text"  pattern="[A-Za-z0-9]+" placeholder="ENTER ITEM CODE" title="INVALID ENTRIES"  class="form-control input-sm"  name="itemcode"  id="itemcode"  required="on" /></a>
	<br>


	
	
	
			MINIMUM STOCK LEVEL
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  MINIMUM STOCK LEVEL" data-placement="bottom">
	<input  value="<?php print $minstocklevel; ?>" type="text" min="0" required="on"   style='text-transform:uppercase' pattern="[0-9]+" title="INVALID ENTRIES" class="form-control input-sm"  name="minstocklevel" placeholder="MINIMUM STOCK LEVEL" id="minstocklevel"  /></a>

<br>

		   <select class="form-control"   required= "on"   id="category" name="category"  required= "on" >
			   
			   <option value="<?php print $itemcategory; ?>"><?php print $itemcategory;?> </option>
			   <option value="">SELECT ITEM CATEGORY </option>
			  <?php 
		$x="SELECT CATEGORY FROM ITEMCATEGORIES ";	  
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{
	print "<option value='".$y['CATEGORY']."'>".$y['CATEGORY']."</option>";		
		
			
		}}
			  
			  ?>
			    <option value=""> </option>
 			  </select>
			  
		   <br>
	

	<div > <br><br>
	
 </div>
	</div>
	<div class="col-sm-4"><br>
	UNIT 
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  UNITS" data-placement="bottom">
	<input type="text" value="<?php print $units; ?>" style="text-transform:uppercase"   pattern="[A-Z,a-z.]+" placeholder="UNIT " title="INVALID ENTRIES"  class="form-control input-sm"  name="units"  id="units"  required="on"   /></a>

	<br>UNIT BUYING PRICE
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text" value="<?php print $bprice; ?>"  min ="0" pattern="[0-9.]+" placeholder="UNIT BUYING PRICE" title="ENTER DECIMALS OR WHOLE NUMBERS"  class="form-control input-sm"  name="bprice"  id="bprice"  required="on"   /></a>
	<br>
	

	UNIT SELL PRICE
	
	<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  QUANTITY" data-placement="bottom">
	<input type="text"  value="<?php print $sprice; ?>" min ="0" placeholder ="UNIT SELL PRICE" pattern="[0-9.]+" title="ENTER DECIMALS OR WHOLE NUMBERS" class="form-control input-sm"  name="sprice"  id="price"  required="on"   /></a>
	<br></div>
	<div class="col-sm-4"></div>
	
  </div>
</div>