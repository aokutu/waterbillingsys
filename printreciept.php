 <?php
 session_start();
include_once("password.php"); 
 $discount=$_SESSION['discount'];
 if($discount >0){
	 $discount =$discount*-1;
$b="INSERT INTO RECIEPT(ITEM,TOTAL,REFFERENCE,DATE) VALUES('DISCOUNT','$discount','".$_SESSION['reffnumber']."',now())";
mysqli_query($connect,$b)or die(mysqli_error($connect));	 
	 }
 ?><div  id="reciept">
<style  type="text/css"  >
#heading{text-align:center; }
#reciept{ font-size:80%;}
</style>
<div>

<div class="container">
  <div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-8" id="heading">
  <strong>DIPAL'S NINE CHEMISTS</strong><br>
  <strong>P.O.BOX 1980-00232 RUIRU</strong><br>
  <strong>PHONE 0781150072</strong><br>
 <strong>TELLER :<?php print $_SESSION['user'];?></strong>
    <strong><?php
	$x="SELECT DATE FROM RECIEPT WHERE REFFERENCE='".$_SESSION['reffnumber']."' LIMIT 1   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{print $y['DATE'];}}
 
 ?></strong> 
 <strong>RECIEPT NO. <?php print sprintf('%06d',$_SESSION['reffnumber']);?></strong>

  
 
 
  <!--<img  src="logoimage.jpg"   id="letterhead"  width="100%"  height="50%"  align="middle" /> -->
  </div>
  <div class="col-sm-2"></div>
  </div>
  </div>



</div>
<div  class="table-responsive"> 

<table class="table "  id="reportstable" >
       
      <thead>
	
          <tr>
<td  class="theader"  width="40%"   height="21" valign="top" > ITEM. </td>  
<td  class="theader"  height="21" valign="top" >PRICE  </td> 
<td  class="theader"  height="21" valign="top" > QNTY </td>
<td  class="theader" width='25%'  height="21" valign="top" > TOTAL </td> 

		</tr>
      </thead>
       <tbody>
	       <?php
		
	$x="SELECT ITEM,PRICE,QUANTITY,TOTAL FROM RECIEPT WHERE REFFERENCE='".$_SESSION['reffnumber']."'  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr    class='filterdata'>
                <td width='40%' >".$y['ITEM']."</td>
				 <td  > ".$y['PRICE']."</td>
				  <td >".$y['QUANTITY']."</td>
				  <td  width='25%' > ". number_format($y['TOTAL'],2)."</td>
		
           </tr>";
		 }
		 }

	?>
		 <tr  class="btn-info btn-sm" >
		 <td  width="40%"  >TOTAL</td>
		 <td ></td>
		 <td ></td>
		 <td  width='25%'  > <?php 
		 $x="SELECT  SUM(TOTAL) FROM RECIEPT WHERE REFFERENCE= '".$_SESSION['reffnumber']."'";
		 	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{		
		 while ($y=@mysqli_fetch_array($x))
		{print number_format($y['SUM(TOTAL)'],2);}}
		 
		 ?><BR><BR><BR><BR><BR><BR></td>
	
		 </tr>
		 
		 <tr  class="btn-info btn-sm" >
		 <td  width='40%' >XXXXX</td>
		 <td   ></td>
		 <td  >XXX</td>
		 <td  width="25%"  >XXXXX</td>
		 </tr>

<tr  class="btn-info btn-sm" >
		 <td  width='100%' >
		  <h4><strong>WELCOME</strong> </h4>
  <h4><strong>KARIBU</strong> </h4></td>
		 </tr>
		 

	  </tbody>
    </table>

	
  </div>
</div>