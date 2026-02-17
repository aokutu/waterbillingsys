<?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   AND  ACCESS  REGEXP  'PRODUCTION BILLING'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$refferencenumber=$_POST['refferencenumber']; $refferencenumber=addslashes(strtoupper($refferencenumber));
@$date1=$_POST['date1']; @$date2=$_POST['date2'];
$_SESSION['date1']=$date1;
$_SESSION['date2']=$date2;
$_SESSION['message']="SEARCHING REPORTS"; exit;
?>

<div  id="productionmetertable">
 <h4   style="text-align:center"><strong>WATER PRODUCTION  FROM <?php print $date1; ?> TO  <?php print  $date2;?>  </strong></h4>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		 <td class="theader"   valign="top">REFFERENCE</td>		
		  <td  class="theader" valign="top">LOCATION</td>
            <td   class="theader"  height="21" valign="top" >LAST READING </td>
            <td  class="theader" valign="top">LAST READING DATE</td>
			<td class="theader"  valign="top">		
			<select class="form-control"   id="action" name="action" required="on">
 <option value="">SEARCH  ACTION</option>
 <option value="LOAD">UPDATE READNINGS</option>
 <option value="DELETE">DELETE</option>
 
 </select></td>
          </tr>
        </thead>
        <tbody>
        <?php
$x="SELECT *  FROM  PRODUCTIONMETERS ORDER BY  REFFERENCENUMBER  ASC ";			
			$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {  
	 echo"<tr class='filterdata'>
             <td  >".$y['refferencenumber']."</td>
		  
		   <td >".$y['location']."</td>
           <td  >".$y['reading']."</td>
		    <td  >".$y['date']."</td>
			<td  ><input type='checkbox'   name ='id[]'  value='".$y['id']."'   class='form-control input-sm'></td>  
				
           </tr>";
		 }
		 
		 }  ?>
		 

  </tbody>
    </table>
<br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>
