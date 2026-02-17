<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("loggedstatus.php");
include_once("password.php");
$x="SELECT * FROM users  WHERE   name='$user' AND password='$password'      ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
if($_SESSION['date1']==null){$_SESSION['date1']=date('Y-m-d');}
if($_SESSION['date2']==null){$_SESSION['date2']=date('Y-m-d');}
?>

<div id="stock">
<h4><strong>SALES STOCK  REPORT <BR>FROM  <?php  print $_SESSION['date1']; ?> TO <?php print $_SESSION['date2']; ?> <br><?php 
print 'CATEGORY '.$_SESSION['action'];
?></strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
      <td  class="theader"   height="21" valign="top" >DATE </td>
            <td  class="theader" width="40%"   height="21" valign="top" >ITEM	  </td>
			
		  <td  class="theader"   height="21" valign="top" >QNTY	  </td>
		  <td  class="theader"   height="21" valign="top" >SELL PRICE	  </td>
		  <td  class="theader"   height="21" valign="top" >BUY PRICE </td>
		  <td  class="theader"   height="21" valign="top" >PROFIT </td>
          </tr>
        </thead>
        <tbody>
       <?php
	$x="SELECT ITEM,SUM(QUANTITY),SUM(TOTAL),SUM(BPRICE*QUANTITY),DATE   FROM RECIEPT WHERE DATE >='".$_SESSION['date1']."'  AND DATE <='".$_SESSION['date2']."'  GROUP BY DATE,ITEM,REFFERENCE,PRICE  ORDER BY DATE,ITEM ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x)) 
		 {$profit=$y['C']-$y['D'];
		   echo"<tr class='filterdata'>
		   		 <td>".$y['DATE']."</td>
                <td  width='40%'>".$y['ITEM']."</td>
				 <td>".$y['SUM(QUANTITY)']."</td>
				   <td>".number_format($y['SUM(TOTAL)'],2)."</td>
				  <td>".number_format($y['SUM(BPRICE*QUANTITY)'],2)."</td>
				   <td>".number_format($y['SUM(TOTAL)']-$y['SUM(BPRICE*QUANTITY)'],2)."</td>
		
           </tr>";

		 }		 
		 }
 
	$x="SELECT SUM(TOTAL),SUM(BPRICE*QUANTITY),SUM(QUANTITY)  FROM RECIEPT WHERE DATE >='".$_SESSION['date1']."'  AND DATE <='".$_SESSION['date2']."'     ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{$profit=$y['SUM(C)']-$y['SUM(D)'];
	 echo"<tr class='btn-info btn-sm'>
	  <td> </td>
                <td  width='40%'>TOTAL</td>
				 <td>".$y['SUM(QUANTITY)']." </td>				 
				   <td>".number_format($y['SUM(TOTAL)'],2)."</td>
				  <td>".number_format($y['SUM(BPRICE*QUANTITY)'],2)."</td>
				   <td>".number_format($y['SUM(TOTAL)']-$y['SUM(BPRICE*QUANTITY)'],2)."</td>
		
           </tr>";
   
		}}
	?>
	<tr>
	<td>

	</td>
	<td></td>
	</tr>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>