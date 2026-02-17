<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];@$month=$_POST['month'];
include_once("password.php");
@$account=$_SESSION['account'];$date1=$_SESSION['date1'];$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'BACKUP DATABASE' OR  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'ARCHIVED'  ";  
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}

?>

<div  id="ministatement">
<h4   style="text-align:center"><strong>ARCHIVED STATEMENT FOR  ACCOUNT <?php print $account;?> FROM  <?php print $date1;?>.TO<?php print $date2;?> </strong></h4>

<div  class="table-responsive"> 
<table class="table "  id="reportstable">
        <!--DWLayoutTable-->
      <thead>
          <tr>
<td  class="theader" style="text-align:left" height="21" valign="top" > ACCOUNT </td>  
<td  class="theader" style="text-align:left" height="21" valign="top" > ZONE </td>  
<td  class="theader" style="text-align:left" height="21" valign="top" > TRANSACTION </td> 
<td  class="theader" style="text-align:left" height="21" valign="top" >TR DATE  </td> 
<td  class="theader" style="text-align:left" height="21" valign="top" >UNITS  </td> 
<td  class="theader" style="text-align:left" height="21" valign="top" > METER  </td>
<td  class="theader" style="text-align:left" height="21" valign="top" > ARCHIVE DATE  </td>  
<td  class="theader" style="text-align:left" height="21" valign="top" >AMOUNT  </td> 
<td  class="theader" style="text-align:left" height="21" valign="top" > TTL </td>
  			
		</tr>
        </thead>
       <tbody>
       <?php	 

	   $x="SET @TTL=0";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
	//$x="SELECT A,B,C,D,E,F,G,H,transaction, (@TTL := H + @TTL) AS TTLSUM FROM   STATEMENT  ORDER BY  A  ASC ";//WHERE  ACCOUNT='37600747882'
	//$x="SELECT *,(@TTL := AMOUNT + @TTL) AS TTLSUM   FROM financearchive WHERE DATE >='$date1' AND DATE <='$date2'  AND ACCOUNT ='$account' ORDER BY DATE ASC";
	$x="SELECT *,(@TTL := AMOUNT + @TTL) AS TTLSUM   FROM financearchive WHERE DATE >='$date1' AND DATE <='$date2'  ";
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{ 
	echo"<tr  class='filterdata' >
                <td  >".$y['account']."</td> 
				<td  >".$y['zone']." </td >
				<td  >".$y['transaction']."</td>
				<td  >".$y['date']."</td>
				<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['consumsion']."</td>
				<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['meternumber']."</td>
				<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['archived']."</td>
				<td  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($y['amount'],2)."</td>
				<td  >".number_format($y['TTLSUM'],2)."</td>
           </tr>";
		   
		 }
		 }

	?>
	       </tbody>
    </table></div>

</div>