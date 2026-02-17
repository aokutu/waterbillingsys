<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$invoicenumber=$_SESSION['invoicenumber'];
@$supplier=$_SESSION['supplier'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND ACCESS  REGEXP  'GATE PASS'  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


?>
<div id="newgatepasses">
<h2 style='text-align:center' ><strong>GATE PASS</strong></h2>
<h4><strong>
<div  style='text-align:center'>SERIAL NUMBER :<?php print $_SESSION['gatepassnumber'];?>  </div>
</strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"   height="21" valign="top" >NO	  </td>
		   <td  class="theader"   height="21" valign="top" >ISSUE NOTE # </td>
            <td  class="theader" width="30%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader"   height="21" valign="top" >UNIT	  </td>
		  <td  class="theader"   height="21" valign="top" >QUANTITY </td>
		  <td  class="theader"   height="21" valign="top" > DEL </td>
			   
          </tr>
        </thead>
        <tbody>
       <?php
	   //
		$number=0;
	$x="SELECT ID,ITEM,QUANTITY,UNITS,ISSUENOTE FROM GATEPASS  WHERE SERIALNUMBER ='".$_SESSION['gatepassnumber']."'   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { $number +=1;
		   echo"<tr class='filterdata'>
		   <td>".$number."</td>
		   <td>".$y['ISSUENOTE']."</td>
                <td  width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
		 <td>". $y['QUANTITY']."</td>
              <td >	  
<input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'>
			</td> 
		
           </tr>";
		 }
		 }
?>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>