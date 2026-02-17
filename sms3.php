<?php
@session_start();
set_time_limit(0);
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$action=$_SESSION['action'];
@$balance=$_SESSION['balance'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'POST SMS-EMAILS' ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{include_once("accessdenied.php");exit;}
?>
<div id="smstable">
  <style type="text/css">
@media print { select{display:none;} #searchtext{display:none;} button{display:none;}; tbody{ overflow:visible;} tbody{ overflow:visible;}}
body{font-size:90%;}
#levelchart{ width:80%;}
  </style>
<h4   style="text-align:center"><strong>SMS\EMAIL REPORT   FOR ACC <?php print $account1 ;?> TO <?php print $account2;?>  AS  AT  <?php print date ("Y-m-d");?></strong></h4>
<table class="table"  id="smstable">
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  height="21" valign="top" >ACCOUNT  </td>
			 <td  class="theader"  height="21" valign="top" >CURRENT </td> 
			 <td  class="theader"  height="21" valign="top" >PREVIOUS </td> 			 
			 <td  class="theader"  height="21" valign="top" >UNITS  </td>
			  <td  class="theader"  height="21" valign="top" > CHARGES</td>  
			   <td  class="theader"  height="21" valign="top" >BALBF </td> 
			    <td  class="theader"  height="21" valign="top" >TOTAL </td>   
				 <td  class="theader"  height="21" valign="top" >DATE </td> 
 <td  class="theader"  height="21" valign="top" >
 <select class="form-control" name="mode" required="on">
 <option value="">SELECT CONTACT TYPE </option>
 <option value="EMAIL">EMAIL </option>
 <option value="CELL">MOBILE PHONE </option>
  </select> </td>				 
		</tr>
        </thead>
        <tbody>
       <?php

	  if($action=='1')
	   {
		$x="SELECT *  FROM  smsreport WHERE CONSUMTION >='$balance' ORDER BY ACCOUNT ASC ";
	   }
	   else if($action=='2')
	   {
		 $x="SELECT *  FROM  smsreport WHERE BILL >='$balance' ORDER BY ACCOUNT ASC  ";
	   
	   }
	   else if($action=='3')
	   {
	 $x="SELECT *  FROM  smsreport WHERE TOTALBILL >='$balance' ORDER BY ACCOUNT ASC";
	   }
	   else {$x="SELECT *  FROM  smsreport order by  account asc ";}
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo"<tr   class='filterdata'  >
                <td  >".$y['account']."</td>
				  <td  >".$y['current']."</td>
				 <td  >".$y['previous']."</td>
				 <td  >".$y['consumtion']."</td>
				  <td  >".number_format($y['bill'],2)."</td>
				   <td  >".number_format($y['balbf'],2)."</td>
				    <td  >".number_format($y['totalbill'],2)."</td>
                <td >".$y['date']."</td>
 <td><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td>  				
           </tr>";
		 }
		 }

	?>
	<tr id="total" >
	<td></td>
	<td></td>
	<td><button type="submit" class="btn-info btn-sm" >SUBMIT</button></td>
	<td><button type="reset" class="btn-info btn-sm">RESET</button></td>
	<td></td>
	<td></td>
	<td>&nbsp;&nbsp;&nbsp;
	
	</td>
	</tr>
        </tbody>
    </table>
	</div>