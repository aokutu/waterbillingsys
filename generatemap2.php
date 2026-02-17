<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$searchvalue=$_SESSION['searchvalue'];$searchmethod=$_SESSION['searchmethod'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'GENERATE MAP'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;} 
if($searchvalue ==null){$searchvalue =" ";}
?>

<div  id="accountstable"  method="post" action="deleteaccount.php"> 
<h4   style="text-align:center"><strong>MAPPED ACCOUNTS WHERE <?php print $searchmethod; ?>  IS LIKE  <?php print $searchvalue;?> </strong></h4>
	<select class="form-control input-sm" required="on" name="maptype"  id="maptype" >
<option value="">SELECT MAP TYPE </option>
<option value="HYBRID">HYBRID</option>
<option value="ROADMAP">ROADMAP</option>
<option value="TERRAIN">TERRAIN</option>
<option value="SATELLITE">SATELLITE</option>
<option value="RESET">RESET COORDINATES</option>

</select>
<table class="table"  id="userstable">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"  height="28" valign="top" >ACCOUNT</td>     
		    <td  class="theader"  width="20%"  height="28" valign="top" >NAME</td>  
			<td  class="theader"  height="28" valign="top" >LATT</td> 			
			 <td  class="theader"  height="28" valign="top" >LONG</td>
			  <td  class="theader"  height="28" valign="top" >METER </td>	
			  <td  class="theader"  height="28" valign="top" >STATUS </td>
			   <td  class="theader"  height="28" valign="top" >CLASS</td>
			  <td  class="theader"  height="28" valign="top" >SIZE</td>
			   <td  class="theader" style="text-align:left;" height="28" valign="top" >LOCATION </td>
			   <td  class="theader"  height="28" valign="top" >SELECT
			   </td>
			 
		 			  
          </tr>
        </thead>
        <tbody>
        <?php

		if($searchmethod==null){$x="select *  FROM  $accountstable   where longitude !='' and lattitude !=''  limit 50  ";}
		else if($searchmethod=='client'){$x="select *  FROM  $accountstable  where   client  REGEXP '$searchvalue'  and longitude !='' and lattitude !='' "; }		
		else if($searchmethod=='account'){$x="select *  FROM  $accountstable  where   account  REGEXP  '$searchvalue'   and longitude !='' and lattitude !='' "; }
		else if($searchmethod=='meternumber'){$x="select *  FROM  $accountstable  where  meternumber  REGEXP  '$searchvalue' and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='status'){$x="select *  FROM  $accountstable  where  status  REGEXP  '$searchvalue' and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='idnumber'){$x="select *  FROM  $accountstable  where  idnumber  REGEXP  '$searchvalue' and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='size'){$x="select *  FROM  $accountstable  where  size = '$searchvalue' and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='contact'){$x="select *  FROM  $accountstable  where  contact REGEXP  '$searchvalue' and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='class'){$x="select *  FROM  $accountstable  where  class REGEXP  '$searchvalue' and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='location'){$x="select *  FROM  $accountstable  where  location REGEXP  '$searchvalue' and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='avg'){$x="select *  FROM  $accountstable  where  avg = 'AVG' and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='stalledmeter'){$x="select  $accountstable.* FROM $accountstable  where avg='AVG'   and longitude !='' and lattitude !='' ";}
		else if($searchmethod=='unregisteredmeter'){$x="select * FROM $accountstable  where not exists (select account FROM   $meterstable where    $accountstable.account=$meterstable.account) and $accountstable.longitude !='' and $accountstable.lattitude !='' ";}
		else if($searchmethod=='overdue'){  
		
	 $x="TRUNCATE OFFLINE ";mysqli_query($connect,$x)or die(mysqli_error($connect));
	   $x="INSERT INTO OFFLINE (A,B,C,D) SELECT ACCOUNT,METERNUMBER,MAX(DATE),DATEDIFF(CURRENT_DATE,MAX(DATE)) FROM $billstable  WHERE  ACCOUNT IN(SELECT ACCOUNT FROM $accountstable WHERE STATUS='CONNECTED')    GROUP BY ACCOUNT  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="select *  FROM  $accountstable   where longitude !='' and lattitude !=''  and status ='CONNECTED' and  account in (select A  from offline   where D >=30) ";

}

else if($searchmethod=='billed'){  
		
	 $x="TRUNCATE OFFLINE ";mysqli_query($connect,$x)or die(mysqli_error($connect));
	   $x="INSERT INTO OFFLINE (A,B,C,D) SELECT ACCOUNT,METERNUMBER,MAX(DATE),DATEDIFF(CURRENT_DATE,MAX(DATE)) FROM $billstable  WHERE  ACCOUNT IN(SELECT ACCOUNT FROM $accountstable WHERE STATUS='CONNECTED')    GROUP BY ACCOUNT  ";
mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="select *  FROM  $accountstable   where longitude !='' and lattitude !=''  and status ='CONNECTED' and account in (select A  from offline   where D  <30) ";

}

		else if($searchmethod=='meterstatus'){$x="select *  FROM  $accountstable,$meterstable  where   longitude !='' and lattitude !=''  AND $accountstable.ACCOUNT=$meterstable.ACCOUNT AND $meterstable.status  REGEXP  '$searchvalue' "; }
		else if($searchmethod=='ticket'){$x="select *  FROM  $accountstable,tickets  where   longitude !='' and lattitude !=''  AND $accountstable.ACCOUNT=tickets.ACCOUNT AND tickets.ticket  REGEXP  '$searchvalue' "; }
		else if($searchmethod=='complain'){$x="select *  FROM  $accountstable,tickets  where   longitude !='' and lattitude !=''  AND $accountstable.ACCOUNT=tickets.ACCOUNT AND tickets.category  REGEXP  '$searchvalue' "; }

		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 		   echo"<tr class='filterdata'>
              <td>".$y['account']."</td>  
			    <td   width='20%' >".$y['client']."</td>
				 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['lattitude']."</td>
			   <td>&nbsp;&nbsp;&nbsp;&nbsp;".$y['longitude']."</td>
			   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['meternumber']."</td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['status']."</td>
				  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['class']."</td>
				   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['size']."</td>
				   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$y['location']."</td>
				   <td><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td>  
           </tr>";
		 }
		 
		 } 
		?>
	 <tr>
		   <td    height="28" valign="top" ></td>     
		    <td    height="28"  width="30%"   valign="top" >
			<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button>
			<button type="reset" class="btn-info btn-sm">RESET</button></td>  
			<td    height="28" valign="top" ></td> 			
			 <td    height="28" valign="top" ></td>
			  <td    height="28" valign="top" > </td>
				<td    height="28" valign="top" ></td>			  
			  <td    height="28" valign="top" ><h4   style="text-align:center"></td>
			   <td    height="28" valign="top" > </td>
			  <td    height="28" valign="top" ></td>
			   <td    height="28" valign="top" ></td>
			 
		 			  
          </h4></tr>
	
        </tbody>
    </table>
 <br>
</div>