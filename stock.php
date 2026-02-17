<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'INVENTORY REG' OR name='$user' AND password='$password'     AND  ACCESS  REGEXP  'P.O.S'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$stock = "stock.txt"; 
$myFile = fopen($stock, "w");

?>

<div id="stock">
<h4   style="text-align:center"><strong>INVENTORY </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader" width="60%"   height="21" valign="top" >ITEM	  </td>
			
		  <td  class="theader"   height="21" valign="top" >QNTY	  </td>
		   
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT A,B FROM STATEMENT   order BY A  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 	fputs($myFile,"ITEM \t QUANTITY \n");
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
                <td  width='60%'>".$y['A']."</td>
				 <td>".$y['B']."</td>
		
           </tr>";
		   	fputs($myFile, $y['A']."\t".$y['B']."\n");

		 }
		 print passthru("stock.pyw ");
		 
		 }

	?>
	<tr>
	<td>
	 <a href="stock.csv" download="stock.csv"   title="CLICK TO" data-toggle="popover" data-trigger="hover" data-content=" DOWNLOAD ANNUAL CHLORINE  REPORT" data-placement="bottom"  ><input type="button"  class="btn-info btn-sm"  value="DOWNLOAD"  /></a>

	</td>
	<td></td>
	</tr>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>