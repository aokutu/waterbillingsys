<?php
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password' AND  ACCESS  REGEXP  'BILLING'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
@$account=trim(strtoupper(addslashes($_POST['account'])));$_SESSION['account']=$account;
@$name=trim(strtoupper(addslashes($_POST['name'])));$_SESSION['name']=$name;
@$item=trim(strtoupper(addslashes($_POST['item'])));
@$quantity=trim(strtoupper(addslashes($_POST['quantity'])));
@$price=trim(strtoupper(addslashes($_POST['price'])));
@$totalprice=trim(strtoupper(addslashes($_POST['totalprice'])));
@$contacts=trim(strtoupper(addslashes($_POST['contacts'])));$_SESSION['contacts']=$contacts; 
@$date=trim(strtoupper(addslashes($_POST['date'])));$_SESSION['date']=$date;
@$serialnumber=trim(addslashes(strtoupper($_POST['serialnumber']))); 
@$plotnumber=trim(strtoupper(addslashes($_POST['plotnumber'])));$_SESSION['plotnumber']=$plotnumber;
@$preparer=trim(strtoupper(addslashes($_POST['preparer'])));$_SESSION['preparer']=$preparer;
@$location=trim(strtoupper(addslashes($_POST['location'])));$_SESSION['location']=$location;
@$waiver=trim(strtoupper(addslashes($_POST['waiver'])));



	/*$x="SELECT STATUS,SERIALNUMBER   FROM CLIENTQUOTATIONS  WHERE SERIALNUMBER='$serialnumber' AND STATUS !='PAID' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
			 while ($y=@mysqli_fetch_array($x))
		{$_SESSION['message']='ISSUE NOTE <br># '.$serialnumber." ".$y['STATUS']." ";exit; }}*/	
 $x="INSERT  INTO CLIENTQUOTATIONS (SERIALNUMBER,ITEM,UNITS,QUANTITY,PRICE,AMOUNT,ACCOUNT,NAMES,CONTACT,STATUS,PLOTNUMBER,LOCATION,PREPARER,DATE) 
SELECT CONCAT('$serialnumber'),CONCAT('$item'),UNITS,CONCAT('$quantity'),CONCAT('$price'),CONCAT('$totalprice'),CONCAT('$account'),CONCAT('$name'),CONCAT('$contacts'),CONCAT('NOT PAID'),CONCAT('$plotnumber'),CONCAT('$location'),CONCAT('$preparer'),CONCAT('$date') FROM INVENTORY WHERE ITEM ='$item' LIMIT 1";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$x="SELECT ITEM    FROM INVENTORY  WHERE ITEM='$item' ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)<1)
		{
			
$a="INSERT  INTO CLIENTQUOTATIONS (SERIALNUMBER,ITEM,QUANTITY,PRICE,AMOUNT,ACCOUNT,NAMES,CONTACT,STATUS,PLOTNUMBER,LOCATION,PREPARER,DATE) 
SELECT CONCAT('$serialnumber'),CONCAT('$item'),CONCAT('1'),CONCAT('$price'),CONCAT('$totalprice'),CONCAT('$account'),CONCAT('$name'),CONCAT('$contacts'),CONCAT('NOT PAID'),CONCAT('$plotnumber'),CONCAT('$location'),CONCAT('$preparer'),CONCAT('$date') ";
mysqli_query($connect,$a)or die(mysqli_error($connect));		
			
	}

if(($item !=null)&&($totalprice >0 )&&($waiver >0))
{
 $x="INSERT  INTO CLIENTQUOTATIONS (SERIALNUMBER,ITEM,QUANTITY,PRICE,AMOUNT,ACCOUNT,NAMES,CONTACT,STATUS,PLOTNUMBER,LOCATION,PREPARER,DATE) 
SELECT CONCAT('$serialnumber'),CONCAT('WAIVER ON ','$item'),CONCAT('1'),CONCAT('$waiver'),CONCAT('$waiver'*-1),CONCAT('$account'),CONCAT('$name'),CONCAT('$contacts'),CONCAT('NOT PAID'),CONCAT('$plotnumber'),CONCAT('$location'),CONCAT('$preparer'),CONCAT('$date')";
mysqli_query($connect,$x)or die(mysqli_error($connect));	
}
$issuenotenumber=strtoupper(str_pad($issuenotenumber, 11, "0", STR_PAD_LEFT));
$_SESSION['issuenotenumber']=$issuenotenumber;
$x="INSERT INTO events(user,session,action,date) VALUES('$user',now(),'REQUEST CLIENTQUOTATIONS FOR  $item ',now())";
mysqli_query($connect,$x)or die(mysqli_error($connect));

$_SESSION['message']=$item."<br> CLIENTQUOTATIONS POSTED ";exit;

?>

<div id="pendingrequisition">
<h4><strong>PENDING CLIENTQUOTATIONS </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
		  <td  class="theader"   height="21" valign="top" >DATE</td>
		   <td  class="theader"   width="30%" height="21" valign="top" >ITEM </td>
			 <td  class="theader"    height="21" valign="top" >UNITS </td>
		  <td  class="theader"   height="21" valign="top" >QNTY</td> 
		    
			 
			 <td  class="theader"   height="21" valign="top" >
			  <select class="form-control input-sm"  name="action" id="action" required="on" >
<option value=''>SELECT  ACTION</option>
<option value='DETAILS'>VIEW CLIENTQUOTATIONS</option>
<option value='VIEW'>PRINT CLIENTQUOTATIONS</option>
<option value=''>SELECT  SUPPLIERS</option>
    </select>
			 
			 </td>
		 
			   
          </tr>
        </thead>
        <tbody>
       <?php
		
	$x="SELECT ITEM,UNITS,SERIALNUMBER,QUANTITY,CLIENTQUOTATIONSER,AUTHORIZER,DATE,ID FROM CLIENTQUOTATIONS GROUP  BY  SERIALNUMBER   ORDER BY DATE   ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 {
		   echo"<tr class='filterdata'>
		    <td>".$y['DATE']."</td>
                <td width='30%'>".$y['ITEM']."</td>
				<td>".$y['UNITS']."</td>
				<td>".$y['QUANTITY']."</td>			
				  <td>".$y['CLIENTQUOTATIONSER']."</td>
            <td>".$y['AUTHORIZER']."</td>
         		
			 <td ><input name='id[]' type='checkbox' value='".$y['ID']."'   class='form-control input-sm'></td> 			
		
           </tr>";
		 }
	
		 
		 
		 }
	?>
        </tbody>
		
      </table>
	  <br />
<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> 
</div>