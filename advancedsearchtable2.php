 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
 $x="CREATE TEMPORARY TABLE SEARCHX(ID INT,A TEXT,B TEXT,C TEXT,D TEXT,E TEXT);";mysqli_query($connect,$x)or die(mysqli_error($connect));		
$x="ALTER TABLE SEARCHX  ADD PRIMARY KEY (ID);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE SEARCHX  MODIFY ID int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="CREATE TEMPORARY TABLE SEARCHY(ID INT,A TEXT,B TEXT,C TEXT,D TEXT,E TEXT);";mysqli_query($connect,$x)or die(mysqli_error($connect));		
$x="ALTER TABLE SEARCHY  ADD PRIMARY KEY (ID);";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="ALTER TABLE SEARCHY  MODIFY ID int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connect,$x)or die(mysqli_error($connect));
$b="TRUNCATE SEARCH ";mysqli_query($connect,$b)or die(mysqli_error($connect));
	$x="TRUNCATE OFFLINE";mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'VIEW REPORTS' OR name='$user' AND password='$password'     AND  ACCESS  REGEXP  'BILLING' OR name='$user' AND password='$password'     AND  ACCESS  REGEXP  'METER REG'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{$_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$searchregistry=$_SESSION['searchregistry']; 


?>

<div id="data">

  <h4   style="text-align:center"><strong>SEARCH DUPLICATE 
  <?php  
  if($searchregistry=='ACCOUNTREGISTRY'){print "ACCOUNTS IN ACCOUNTS REGISTRY";}
  else if($searchregistry=='METERREGISTRY'){print "METERS IN METERS REGISTRY";}
  else if($searchregistry=='ACCOUNTREGISTRY2'){print "ACCOUNTS IN METERS REGISTRY";}
  else if($searchregistry=='METERREGISTRY2'){print "DUPLICATE  METERS IN ACCOUNTS REGISTRY";}
  
  ?> </strong></h4>
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
	$i=$y['number'];$accountstablex='accounts'.$i;$meterstablex='meters'.$i; $zone=$y['zone'];
	if($searchregistry=='ACCOUNTREGISTRY')
	{
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$i'),CONCAT('$accountstablex') FROM $accountstablex  WHERE  METERNUMBER NOT REGEXP 'NOT INSTALLED' ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}
		else if($searchregistry=='METERREGISTRY')
	{ 
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$i'),CONCAT('$meterstablex') FROM $meterstablex WHERE ACCOUNT NOT REGEXP 'NOT INSTALLED'";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}
	
		else if($searchregistry=='ACCOUNTREGISTRY2')
	{ 
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$i'),CONCAT('$meterstablex') FROM $meterstablex WHERE ACCOUNT NOT REGEXP 'NOT INSTALLED'";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}

	if($searchregistry=='METERREGISTRY2')
	{
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$i'),CONCAT('$accountstablex') FROM $accountstablex  WHERE  METERNUMBER NOT REGEXP 'NOT INSTALLED' ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}

	
		}
		} 
		
	$b="INSERT INTO SEARCHY(A,B,C)  SELECT B,C,D FROM SEARCHX GROUP BY B HAVING COUNT(*)>1";	
	mysqli_query($connect,$b)or die(mysqli_error($connect));
	
	
		$b="TRUNCATE SEARCH";mysqli_query($connect,$b)or die(mysqli_error($connect));


		  $count=0;
	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{			
	$i=$y['number'];$accountstablex='accounts'.$i;$meterstablex='meters'.$i; 
	if($searchregistry=='ACCOUNTREGISTRY')
	{
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$i'),CONCAT('$accountstablex') FROM $accountstablex  WHERE  METERNUMBER IN(SELECT B FROM SEARCHY) ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}
		else if($searchregistry=='METERREGISTRY')
	{ 
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$i'),CONCAT('$meterstablex') FROM $meterstablex WHERE ACCOUNT IN(SELECT A  FROM SEARCHY )";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}
	
		else if($searchregistry=='ACCOUNTREGISTRY2')
	{ 
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$i'),CONCAT('$meterstablex') FROM $meterstablex WHERE ACCOUNT IN(SELECT A  FROM SEARCHY) ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}

	if($searchregistry=='METERREGISTRY2')
	{
	$b="INSERT INTO SEARCHX(A,B,C,D,E) 
	SELECT ID,ACCOUNT,METERNUMBER ,CONCAT('$i'),CONCAT('$accountstablex') FROM $accountstablex  WHERE  METERNUMBER IN(SELECT B FROM SEARCHY) ";
	mysqli_query($connect,$b)or die(mysqli_error($connect));	
	}

	
		}
		} 
		
		
		if($searchregistry=='ACCOUNTREGISTRY')
	{$x="SELECT  B,C,D,ID FROM SEARCHX  ORDER BY B ASC ";}
	else if($searchregistry=='METERREGISTRY')
	{$x="SELECT  B,C,D,ID FROM search SEARCHX   ORDER BY C ASC  ";}

	else if($searchregistry=='ACCOUNTREGISTRY2')
	{$x="SELECT  B,C,D,ID FROM SEARCHX ORDER BY B ASC  ";}
	else 	if($searchregistry=='METERREGISTRY2')
	{$x="SELECT  B,C,D,ID FROM SEARCHX  ORDER BY  C ASC ";}



		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {$count +=1;
		   echo"<tr class='filterdata'>
                <td     >".$y['B']."</td>
                <td  >".$y['C']."</td>
                <td  >ZONE ".$y['D']."</td> 
				 <td><input name='id[]'  type='checkbox' value='".$y['ID']."'   class='form-control input-sm'> </td> 
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