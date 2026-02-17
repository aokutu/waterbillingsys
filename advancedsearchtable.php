 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
//$x="TRUNCATE SEARCH ";mysqli_query($connect,$x)or die(mysqli_error($connect));  
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW REPORTS' OR name='$user' AND password='$password'     AND  ACCESS  REGEXP  'BILLING' OR name='$user' AND password='$password'     AND  ACCESS  REGEXP  'METER REG'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$search=$_SESSION['search'];$searchcategory=$_SESSION['searchcategory'];
@$searchregistry=$_SESSION['searchregistry'];


?>

<div id="data">

  <h4   style="text-align:center"><strong>SEARCH :<?php echo $searchregistry;?> <?php print $searchcategory;?> LIKE <?php print $search;?></strong></h4>
<div  class="table-responsive"> 
<table class="table "  id="reportstable">
        <!--DWLayoutTable-->
      <thead>
 <tr>
<td  class="theader"  height="21" valign="top" >ACCOUNT </td>  
<td  class="theader"  height="21" valign="top" > METER NUMBER </td>  
<td  class="theader"  height="21" valign="top" >ZONE  </td> 
<td  class="theader"  height="21" valign="top" >DELETE  </td> 
</tr>
        </thead>
       <tbody>
	 
	  <?php
	  $count=0;
	$x="SELECT number,zone FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
	$i=$y['number'];$zone=$y['zone'];$accountstablex='accounts'.$i;$meterstablex='meters'.$i; 
	if(($searchregistry=='ACCOUNTREGISTRY') && ($searchcategory=='ACCOUNT'))
	{
 $x="CREATE TEMPORARY TABLE SEARCHX(A TEXT,B TEXT,C TEXT,D TEXT,E TEXT);";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));		
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$zone'),CONCAT('$accountstablex') FROM $accountstablex WHERE ACCOUNT REGEXP '$search' ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}
	else if(($searchregistry=='ACCOUNTREGISTRY') && ($searchcategory=='METERNUMBER'))
	{ 
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$zone'),CONCAT('$accountstablex') FROM $accountstablex WHERE METERNUMBER REGEXP '$search' ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}
		else if(($searchregistry=='METERREGISTRY') && ($searchcategory =='ACCOUNT'))
	{ 
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$zone'),CONCAT('$meterstablex') FROM $meterstablex WHERE ACCOUNT REGEXP '$search' ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}
			else if(($searchregistry=='METERREGISTRY') && ($searchcategory =='METERNUMBER'))
	{ 
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$zone'),CONCAT('$meterstablex') FROM $meterstablex WHERE METERNUMBER REGEXP '$search' ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}
	
		}
		} 
		
		$x="SELECT * FROM SEARCHX";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {$count +=1;
		   echo"<tr class='filterdata'>
                <td     >".$y['B']."</td>
                <td  >".$y['C']."</td>
                <td  >".$y['D']."</td> 
				 <td><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td> 
           </tr>";
		 }
		 }  
	  ?> 
	 <tr>
	 <td>TOTAL</td>
	 <td><?php print $count; ?></td>
	 <td><button type="submit" class="btn-info btn-sm" >SUBMIT</button></td>
	 <td><button type="reset" class="btn-info btn-sm">RESET</button>
</td>

	 </tr>  
</tbody>
    </table></div>
</div>