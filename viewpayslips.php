<?php 
@session_start();
include_once("loggedstatus.php");
include_once("password2.php");
$dbdetails->user=$_SESSION['user'];
$dbdetails->password=$_SESSION['password'];
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP 'PAYROLL' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
<div id="payslips" >
<h3 style="text-align:center;text-decoration:underline;"><strong>PAY SLIPS POSTED FROM <?php print $_SESSION['date1'];?> TO <?php print $_SESSION['date2'];  ?></strong></h3>
<table class="table"  >
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
          <td width='2%'  class="theader"  height="28" valign="top" >#</td>
          <td  class="theader"  height="28" valign="top" >MONTH </td>
		   <td   width='35%'  class="theader"  height="28" valign="top" >NAMES</td>
       
       <td  class="theader"  height="28" valign="top" >GROSS </td>
       <td  class="theader"  height="28" valign="top" >DEDUCTIONS</td>     
		    <td  class="theader"  height="28" valign="top" >NET </td>  
       <td  class="theader"   height="28" valign="top" >
       
<br>
       

       </td>			 			  
          </tr>
        </thead>
        <tbody>
        
		<?php

    class slipdetails
    {
    public $date1=null;
    public $date2=null;
    public $process =null;
    public function summary()
    {
    $this->process="SELECT ID,IDNUMBER,NAMES,CONCAT(BASICSALARY+HOUSEALLOWANCE+TRAVELALLOWANCE+HARDSHIPALLOWANCE) AS GROSS,CONCAT(PAYEE+NHIF+NSSF) AS DEDUCTIONS,MONTH FROM  PAYROLL WHERE POSTINGDATE >='".$this->date1."' AND  POSTINGDATE <='".$this->date2."'  ";  
    }
  }
    $slipdetails=new slipdetails;
    $slipdetails->date1=$_SESSION['date1'];
    $slipdetails->date2=$_SESSION['date2'];
    $slipdetails->summary();
    $no =0;
$x = $connect ->query($slipdetails->process);
while ($data = $x->fetch_object())
{ 		$no +=1;    echo"<tr class='filterdata'>
      <td  width='2%' >".$no."</td>
      <td   >".$data->MONTH."</td>
              <td width='35%'  >".$data->NAMES."</td>
              <td >".number_format($data->GROSS,2)."</td>
              <td  >".number_format($data->DEDUCTIONS,2)."</td>  
			    <td    >".number_format($data->GROSS-$data->DEDUCTIONS,2)."</td>
          <td> "; ?> 
      <a   href="viewpayslip2.php?id=<?php print $data->ID;?>" class="deletestaff">
				   <button type="button" class="btn-info btn-sm">VIEW</button> 
				   </a>
           <a   href="deletepayslip.php?id=<?php print $data->ID;?>" >
				   <button type="button" class="btn-info btn-sm">DEL</button> 
				   </a>     
          
          <?php print " </td>  
          </tr>";
		 }


     $x = $connect ->query("SELECT SUM(CONCAT(BASICSALARY+HOUSEALLOWANCE+TRAVELALLOWANCE+HARDSHIPALLOWANCE)) AS GROSS,SUM(CONCAT(PAYEE+NHIF+NSSF)) AS DEDUCTIONS FROM  PAYROLL WHERE POSTINGDATE >='".$_SESSION['date1']."' AND  POSTINGDATE <='".$_SESSION['date2']."'  ");
     while ($data = $x->fetch_object())
     { 		    echo"<tr class='filterdata'>
           <td  width='2%' ></td> 
           <td   ></td>
                   <td width='35%'  >TOTAL</td>
                   <td >".number_format($data->GROSS,2)."</td>
                   <td  >".number_format($data->DEDUCTIONS,2)."</td>  
               <td    >".number_format($data->GROSS-$data->DEDUCTIONS,2)."</td>
               <td> </td>  
               </tr>";
          }


		 
		?> 
  </tbody>
    </table>
        </div>