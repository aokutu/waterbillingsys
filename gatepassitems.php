<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
@$invoicenumber=$_SESSION['invoicenumber'];
@$supplier=$_SESSION['supplier'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' ";$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}


?>
<div id="itemsissuedtable">
<style>
tr {
width: 100%;
display: inline-table;
table-layout: fixed;
}

table{
 height:200px;              // <-- Select the height of the table
 display: -moz-groupbox; 
 // Firefox Bad Effect
}
tbody{
  overflow-y: scroll;      
  height: 180px;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

</style>
<h4 style='text-align:center' ><strong>STORE ISSUE NOTE DETAILS</strong></h4>
<h4><strong>
<div  style='text-align:center'>SERIAL NUMBER :<?php print  strtoupper(str_pad($_SESSION['issuenotenumber'], 10, "0", STR_PAD_LEFT));?>  </div>
</strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		   <td  class="theader"   height="21" valign="top" >NO	  </td>
            <td  class="theader" width="30%"   height="21" valign="top" >ITEM	  </td>
			<td  class="theader"   height="21" valign="top" >UNITS</td>
		  <td  class="theader"   height="21" valign="top" >QUANTITY	  </td>
        	   
          </tr>
        </thead>
        <tbody>
       <?php
		$number=0;
	$x="SELECT ITEM,QUANTITY,UNITS  FROM REQUISITION  WHERE SERIALNUMBER='".$_SESSION['issuenotenumber']."' AND STATUS ='ISSUED'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { $number +=1;
		   echo"<tr class='filterdata'>
		   <td>".$number."</td>
                <td  width='30%'>".$y['ITEM']."</td>
				<td>". $y['UNITS']."</td>
		 <td>". $y['QUANTITY']."</td>		
           </tr>";
		 }
		 }


		 
	?>
        </tbody>
		
      </table>
	  <br />
</div>