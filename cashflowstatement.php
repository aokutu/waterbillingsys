<?php
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
@$invoicenumber=$_SESSION['invoicenumber'];
@$supplier=$_SESSION['supplier'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'  AND  ACCESS  REGEXP   'INVENTORY REG' ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

$x="CREATE TEMPORARY TABLE `X` ( `TRANSACTION` text,`AMOUNT` float,`DATE` date) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO X(TRANSACTION,AMOUNT,DATE) SELECT CONCAT('OPEN BAL'),SUM(PRICE),CONCAT('".$_SESSION['date1']."') FROM STOCKIN WHERE DATE <'".$_SESSION['date1']."' AND SUPPLIER='".$_SESSION['supplier']."'";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO X(TRANSACTION,AMOUNT,DATE) SELECT CONCAT('OPEN BAL'),SUM(AMOUNT*-1),CONCAT('".$_SESSION['date1']."') FROM SUPPLIERPAYMENT WHERE DATE <'".$_SESSION['date1']."' AND SUPPLIER='".$_SESSION['supplier']."'";
mysqli_query($connect,$x)or die(mysqli_error($connect));


$x="INSERT INTO X(TRANSACTION,AMOUNT,DATE) SELECT INVOICENUMBER,SUM(PRICE),DATE FROM STOCKIN 
WHERE DATE >='".$_SESSION['date1']."'  AND DATE  <='".$_SESSION['date2']."' AND SUPPLIER='".$_SESSION['supplier']."' 
GROUP BY INVOICENUMBER,DATE ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT INTO X(TRANSACTION,AMOUNT,DATE) SELECT CONCAT(PAYMODE,PAYREFFERENCE),SUM(AMOUNT*-1),DATE FROM SUPPLIERPAYMENT 
WHERE DATE >='".$_SESSION['date1']."'  AND DATE  <='".$_SESSION['date2']."' AND SUPPLIER='".$_SESSION['supplier']."' ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="CREATE TEMPORARY TABLE `Y` ( `A` text,`B` float,`C` date) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="INSERT   INTO  Y (A,B,C) SELECT TRANSACTION,SUM(AMOUNT),DATE  FROM X GROUP BY  TRANSACTION,DATE ORDER BY DATE  ASC ";
mysqli_query($connect,$x)or die(mysqli_error($connect));

?>
<div id="cashflow">
 <table    class=" table table-hover">
	  <h4><strong><?php print $supplier; ?>CASH FLOW  FROM <?php print  $_SESSION['date1'];?>TO <?php print $_SESSION['date2'];?></strong></h4>
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td  class="theader"   height="21" valign="top" >DATE	  </td>
            <td  class="theader" width="25%"   height="21" valign="top" >TRANSACTION REFF	  </td>	
		  <td  class="theader"   height="21" valign="top" >AMOUNT	  </td>
		  <td  class="theader"   height="21" valign="top" >BAL	  </td>
   
          </tr>
        </thead>
        <tbody>
       <?php
 $x="UPDATE  Y SET B =0 WHERE B  IS NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
 $x="DELETE FROM   Y  WHERE A  IS NULL ";mysqli_query($connect,$x)or die(mysqli_error($connect));
	   
 $x="SET @TTL=0";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT A,B,C,(@TTL := B + @TTL) AS TTLSUM  FROM  Y     ORDER BY  C  ASC ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td  >".$y['C']."</td>
                <td  width='25%'>".$y['A']."</td>
				  <td>". number_format($y['B'],2)."</td>
				   <td>". number_format($y['TTLSUM'],2)."</td>
           </tr>";
		   
		 }
		 }
		 
		 
		$x="SELECT SUM(B)  FROM  Y     ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='btn-info btn-sm'>
		    <td  ></td>
                <td  width='25%'>BALANCE </td>
				  <td>". number_format($y['SUM(B)'],2)."</td>
				   <td>". number_format($y['SUM(B)'],2)."</td>
           </tr>";
		   
		 }
		 }

	?>
        </tbody>
		
      </table>
	  <br />
	  <button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 

</div>