<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("interface.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'FINANCE'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

?>

<table class="table"  id="pricelisttable"  style="text-align:left;font-size:90%;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
<td  class="theader"  width="5%" height="28" valign="top" style='text-align:left;' >NO.</td>
<td   width='40%' style='text-align:left;'  ><?php print $data->DETAILS; ?></td>
<td  class="theader"   width="20%"  height="28" valign="top"  style='text-align:left;' >CATEGORY</td>
 <td  class="theader"    height="28" valign="top"  style='text-align:left;' >PRICE</td>
  <td  class="theader"    height="28" valign="top"  style='text-align:left;' >COPRATE PRICE</td>
<td  class="theader"  height="28" valign="top" style='text-align:left;'  > ACTION </td>		  
 </tr>
 				<?php
$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE,ID  FROM imagingservices  ORDER BY DETAILS");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:left;' >
<td  width="5%"  style='text-align:left;' ><?php print $number; ?> </td> 
 <td   width='40%' style='text-align:left;'  ><?php print $data->DETAILS; ?></td>
 <td  class="theader" width="20%"    height="28" valign="top"  style='text-align:left;' >IMAGING</td>
   <td   style='text-align:left;'  ><?php print number_format($data->PRICE,2); ?></td>
      <td   style='text-align:left;'  ><?php print number_format($data->COPRATEPRICE,2); ?></td>
				            <td style='text-align:left;'  >
							<a  title="<?php print $data->DETAILS;?>" data-toggle="popover" data-trigger="hover" data-content="EDIT" data-placement="bottom" href="editpricelist.php?id3=<?php print $data->ID; ?>"  onclick="return confirm('EDIT ?');" ><i class="fas fa-pencil-alt" style="font-size:160%;"></i></a>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="<?php print $data->DETAILS;?>" data-toggle="popover" data-trigger="hover" data-content="DELETE" data-placement="bottom"  href="deleteimagingservices.php?details=<?php print $data->DETAILS; ?>"  onclick="return confirm('DELETE SERVICE ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>   

			
	 </tr>
<?php }	?>	
		
				<?php
$x=$connect->query("SELECT DETAILS,PRICE,COPRATEPRICE,ID  FROM services  ORDER BY DETAILS");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:left;' >
<td  width="5%"  style='text-align:left;' ><?php print $number; ?> </td> 
 <td   width='40%' style='text-align:left;'  ><?php print $data->DETAILS; ?></td>
 <td  class="theader" width="20%"    height="28" valign="top"  style='text-align:left;' >SERVICES</td>
   <td   style='text-align:left;'  ><?php print number_format($data->PRICE,2); ?></td>
      <td   style='text-align:left;'  ><?php print number_format($data->COPRATEPRICE,2); ?></td>
				            <td style='text-align:left;'  >
							<a  title="<?php print $data->DETAILS;?>" data-toggle="popover" data-trigger="hover" data-content="EDIT" data-placement="bottom" href="editpricelist.php?id1=<?php print $data->ID; ?>"  onclick="return confirm('EDIT ?');" ><i class="fas fa-pencil-alt" style="font-size:160%;"></i></a>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="<?php print $data->DETAILS;?>" data-toggle="popover" data-trigger="hover" data-content="DELETE" data-placement="bottom"  href="deleteservices.php?details=<?php print $data->DETAILS; ?>"  onclick="return confirm('DELETE SERVICE ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>   

			
	 </tr>
<?php }	
$x=$connect->query("SELECT UNITS,ITEM,PRICE,COPRATEPRICE,ID  FROM inventory ORDER  BY  ITEM   ");
while ($data = $x->fetch_object())
{
	$number+=1;	?>
 <tr class='filterdata'  style='text-align:left;' >
<td  width="5%"  style='text-align:left;' ><?php print $number; ?> </td>
<td   width='40%' style='text-align:left;'  ><?php print $data->ITEM; ?></td> 
<td  width="20%" style='text-align:left;'  >PHARMACETICALS </td>	
<td   style='text-align:left;'  ><?php print number_format($data->PRICE,2); ?></td>
    <td   style='text-align:left;'  ><?php print number_format($data->COPRATEPRICE,2); ?></td>
 <td style='text-align:left;'  >
							<a title="<?php print $data->ITEM;?>" data-toggle="popover" data-trigger="hover" data-content="EDIT" data-placement="bottom"  href="editpricelist.php?id2=<?php print $data->ID; ?>"  onclick="return confirm('EDIT ?');" ><i class="fas fa-pencil-alt" style="font-size:160%;"></i></a>
		 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a title="<?php print $data->ITEM;?>" data-toggle="popover" data-trigger="hover" data-content="DELETE " data-placement="bottom"  href="deleteservices.php?item=<?php print $data->ITEM; ?>"  onclick="return confirm('DELETE ITEM ?')" > <div class="fas fa-trash" style="font-size:160%;"> </div></a>
			 </td>   
		
	 </tr>
<?php }	?> 

 
 
 </tbody>
 </table>