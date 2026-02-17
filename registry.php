<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$searchvalue=$_SESSION['searchvalue'];$searchmethod=$_SESSION['searchmethod'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'    AND  ACCESS  REGEXP  'ACCOUNTS REG'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;} 

if($searchvalue ==null){$searchvalue =" ";}
?>

<div  id="accountstable"  method="post" action="deleteaccount.php"> 
  <link rel="stylesheet" href="stylesheets/jquery.sheetjs.css" />
  <script src="pluggins/jquery.sheetjs.js"></script>
<style>
table {
    border-collapse: collapse;
    overflow-y: scroll; 
  }
  td, th {
    border: 1px solid black;
    padding: 8px; /* Adjust padding as needed */
    text-align:right;
  }
  
 
  
  </style>
<h4   style="text-align:center"><strong>ACCOUNTS  REGISTRY WHERE <?php print $searchmethod; ?>  IS LIKE  <?php print $searchvalue;?> </strong></h4>

<div class="container">
  <div class="row">
  <div class="col-sm-4">
  <select class='form-control'   name='action' required="on"   id="selectaction" >
 <option value=''>SELECT STATUS</option>

			  <option value='CONNECTED'>CONNECTED</option>
              <option value='COR'>COR</option>
			  <option value='CONP'>CONP</option>
			  <option value='MNOS'>MNOS(METER NOT ON SITE)</option>
			  	  <option value='STOLEN'>STOLEN(METER STOLEN)</option>
			  	  	  <option value='ILLEGAL'>ILLEGAL(ILLEGAL CONNECTION)</option>
			  	  	   <option value='VANDALISED'>VANDALISED(VANDALISED METER)</option>
			   <option value='DELETE'>DELETE</option>
			   <option value='DETAILS'>PRINT DETAILS</option>
				 <option value='BALANCE'>CHECK BALANCE</option>
				 
				  
 
			  </select>
  </div>
    <div class="col-sm-4"><input type="date" class="form-control input-sm"  name="date"    required="on" /></div>

  <div class="col-sm-4"></div>

  </div>
  </div>
  

	

<table class="table"  id="userstable"  style="text-align:center;">
	

	  
        <!--DWLayoutTable-->
        <thead>
         
        </thead>
        <tbody>
             <tr >
		  <td  class="theader" width="5%"  height="28" valign="top" style='text-align:center;' >NO.</td>   
		   <td  class="theader"  height="28" valign="top"  style='text-align:center;'  >ACCOUNT</td>     
		    <td  class="theader"  width="20%"  height="28" valign="top" style='text-align:center;'  >NAME</td>  
		 			
			 <td  class="theader"    height="28" valign="top"  style='text-align:center;' >CONTACT</td>
			  <td  class="theader"  height="28" width="10%" valign="top" style='text-align:left;'  >METER &ensp;&ensp;&ensp;&ensp;&ensp; </td>	
			  <td  class="theader"  height="28" valign="top" style='text-align:right;'  >STATUS </td>
			   <td  class="theader"  height="28" valign="top" width='4%' style='text-align:center;'  >CLASS</td>
			  <td  class="theader"  height="28" valign="top"  width='5%' style='text-align:left;'  >SIZE</td>
			   <td  class="theader"  height="28" valign="top" style='text-align:left;'  >LOCATION  &ensp;&ensp;&ensp;&ensp;&ensp; </td>
			   <td  class="theader"  height="28" valign="top" style='text-align:center;'  >Conn No.</td>
			   <td  class="theader"  height="28" valign="top" style='text-align:right;'  >SELECT
			   </td>
			 
		 			  
          </tr>
        <?php
		$number=0;
		if($searchmethod==null){$x="select *  FROM  $accountstable   limit 50  ";}
		else if($searchmethod=='client'){$x="select *  FROM  $accountstable  where   client  REGEXP '$searchvalue' "; }		
		else if($searchmethod=='account'){$x="select *  FROM  $accountstable  where   account  REGEXP '$searchvalue' ";}
		else if($searchmethod=='meternumber'){$x="select *  FROM  $accountstable  where  meternumber  REGEXP '$searchvalue' ";}
		else if($searchmethod=='status'){$x="select *  FROM  $accountstable  where  status  REGEXP '$searchvalue' ";}
		else if($searchmethod=='idnumber'){$x="select *  FROM  $accountstable  where  idnumber  REGEXP '$searchvalue' ";}
		else if($searchmethod=='size'){$x="select *  FROM  $accountstable  where  size = '$searchvalue' ";}
		else if($searchmethod=='contact'){$x="select *  FROM  $accountstable  where  contact REGEXP '$searchvalue' ";}
		else if($searchmethod=='email'){$x="select *  FROM  $accountstable  where  clientemail REGEXP '$searchvalue' ";}
		else if($searchmethod=='class'){$x="select *  FROM  $accountstable  where  class REGEXP '$searchvalue' ";}
		else if($searchmethod=='location'){$x="select *  FROM  $accountstable  where  location REGEXP '$searchvalue' ";}
		else if($searchmethod=='avg'){$x="select *  FROM  $accountstable  where  avg = 'AVG' ";}
		else if($searchmethod=='mapped'){$x="select *  FROM  $accountstable  where  longitude !='' and lattitude !='' ";}
		else if($searchmethod=='not mapped'){$x="select *  FROM  $accountstable  where  longitude ='' or lattitude =''";}
		else if($searchmethod=='stalled'){$x="select  $accountstable.* FROM $accountstable  where    $accountstable.avg='AVG' ";}
		else if($searchmethod=='unregisteredmeter'){$x="select * FROM $accountstable  where not exists (select account FROM   $meterstable where    $accountstable.account=$meterstable.account) ";}
		else if($searchmethod=='all'){
			$x="select *  FROM  $accountstable   "; 
			}		
	
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		 { 	$number+=1;	   echo"<tr class='filterdata'  style='text-align:center;' >
				<td  width='5%'  style='text-align:center;' >".$number."</td>  
              <td style='text-align:center;' >".$y['account']."</td>  
			    <td   width='20%' style='text-align:center;'  >".$y['client']."</td>
				
			   <td   style='text-align:center;'  >".$y['contact']."<BR>".$y['clientemail']."</td>
			   <td style='text-align:left;' width='10%' >".$y['meternumber']."</td>
				  <td style='text-align:right;' >".$y['status']."</td>
				  <td style='text-align:center;' width='4%' >&ensp;&ensp;&ensp;".$y['class']."</td>
				   <td style='text-align:center;' width='5%' >&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;".$y['size']."</td>
				   <td style='text-align:right;'  >&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;".$y['location']."</td>
				    <td style='text-align:center;' >".$y['plotnumber']."</td>
				   <td style='text-align:right;'>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<input name='del[]'   type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td>  
           </tr>";
		 }
		 
		 } 
		 
		?>
	 <tr>
		   <td  style='text-align:center;'   height="28" valign="top" ></td>     
		    <td   style='text-align:center;'  height="28"  width="30%"   valign="top" >
			<button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button>
			<button type="reset" class="btn-info btn-sm">RESET</button></td>  
			
				<td  style='text-align:center;'   height="28" valign="top" ><h4   style="text-align:center"> TOTAL</h4> </td>			  
			  <td  style='text-align:center;'  height="28" valign="top" ><h4   style="text-align:center"><?php 
				if($searchmethod==null){$x="select count(account)  FROM  $accountstable   limit 50  ";}
		else if($searchmethod=='client'){$x="select count(account)  FROM  $accountstable  where   client  REGEXP '$searchvalue' "; }		
		else if($searchmethod=='account'){$x="select count(account)  FROM  $accountstable  where   account  REGEXP '$searchvalue' ";}
		else if($searchmethod=='meternumber'){$x="select count(account)  FROM  $accountstable  where  meternumber  REGEXP '$searchvalue' ";}
		else if($searchmethod=='status'){$x="select count(account) FROM  $accountstable  where  status  REGEXP '$searchvalue' ";}
		else if($searchmethod=='idnumber'){$x="select count(account)  FROM  $accountstable  where  idnumber  REGEXP '$searchvalue' ";}
		else if($searchmethod=='size'){$x="select count(account)  FROM  $accountstable  where  size = '$searchvalue' ";}
		else if($searchmethod=='contact'){$x="select count(account)  FROM  $accountstable  where  contact REGEXP '$searchvalue' ";}
		else if($searchmethod=='email'){$x="select count(account)  FROM  $accountstable  where  clientemail REGEXP '$searchvalue' ";}
		else if($searchmethod=='class'){$x="select count(account)  FROM  $accountstable  where  class REGEXP '$searchvalue' ";}
		else if($searchmethod=='location'){$x="select count(account)  FROM  $accountstable  where  location REGEXP '$searchvalue' ";}
		else if($searchmethod=='avg'){$x="select count(account)  FROM  $accountstable  where  avg = 'AVG' ";}
		else if($searchmethod=='stalled'){$x="select count(account)   FROM $accountstable  where    avg='AVG'  ";}
		else if($searchmethod==null){$x="select count(account)  FROM  $accountstable   limit 50  ";}
		else if($searchmethod=='unregisteredmeter'){$x="select count(account) FROM $accountstable  where not exists (select account FROM   $meterstable where    $accountstable.account=$meterstable.account) ";}
		else if($searchmethod=='double'){$x="SELECT NULL   "; }	
		else if($searchmethod=='all'){	$x="select count(account)  FROM  $accountstable   ";}			

	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=mysqli_fetch_array($x))
		{  echo  $y['count(account)'];
	///$y['count(id)'];
	}}
			  
			  ?> </td>
			  
			 
		 			  
          </h4></tr>
	
        </tbody>
    </table>
 <br>
</div>