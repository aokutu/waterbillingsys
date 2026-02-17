<?PHP
//print_r(get_declared_classes());
/*$mysqli = new mysqli("localhost", "root", "", "schooldatabase");
if (mysqli_connect_errno()) {
 echo("Failed to connect, the error message is : ".
 mysqli_connect_error());
exit();}

$result = $mysqli ->query("select * from users");
while ($data = $result->fetch_object())
{
 echo $data->id." : '".$data->id."' \n";
}
*/


class details extends mysqli
{
public $user ='root';
public $db='lakwa';
}
$myuser =new details; 

$mysqli = new mysqli("localhost", $myuser->user, "", "$myuser->db");
if (mysqli_connect_errno()) {
 echo("Failed to connect, the error message is : ".
 mysqli_connect_error());
exit();}
?>
<?php
@$action=1;
@$balance=$_SESSION['balance'];
?>
<div id="smstable">
  <style type="text/css">
@media print { select{display:none;} #searchtext{display:none;} button{display:none;}; tbody{ overflow:visible;} tbody{ overflow:visible;}}
body{font-size:90%;}
#levelchart{ width:80%;}
  </style>
<h4   style="text-align:center"><strong>SMS\EMAIL REPORT   FOR ACC <?php print $account1 ;?> TO <?php print $account2;?>  AS  AT  <?php print date ("Y-m-d");?></strong></h4>
<table class="table"  id="smstable">
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  height="21" valign="top" >ACCOUNT  </td>
			 <td  class="theader"  height="21" valign="top" >CURRENT </td> 
			 <td  class="theader"  height="21" valign="top" >PREVIOUS </td> 			 
			 <td  class="theader"  height="21" valign="top" >UNITS  </td>
			  <td  class="theader"  height="21" valign="top" > CHARGES</td>  
			   <td  class="theader"  height="21" valign="top" >BALBF </td> 
			    <td  class="theader"  height="21" valign="top" >TOTAL </td>   
				 <td  class="theader"  height="21" valign="top" >DATE </td> 
 <td  class="theader"  height="21" valign="top" >
 <select class="form-control" name="mode" required="on">
 <option value="">SELECT CONTACT TYPE </option>
 <option value="EMAIL">EMAIL </option>
 <option value="CELL">MOBILE PHONE </option>
  </select> </td>				 
		</tr>
        </thead>
        <tbody>
       <?php

	  if($action=='1')
	   {
		$x="SELECT *  FROM  SMS WHERE CONSUMTION >='$balance' ORDER BY ACCOUNT ASC ";
	   }
	   else if($action=='2')
	   {
		 $x="SELECT *  FROM  SMS WHERE BILL >='$balance' ORDER BY ACCOUNT ASC  ";
	   
	   }
	   else if($action=='3')
	   {
	 $x="SELECT *  FROM  SMS WHERE TOTALBILL >='$balance' ORDER BY ACCOUNT ASC";
	   }
	   else {$x="SELECT *  FROM  sms order by  account asc ";}
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		 { 
		   echo"<tr   class='filterdata'  >
                <td  >".$y['account']."</td>
				  <td  >".$y['current']."</td>
				 <td  >".$y['previous']."</td>
				 <td  >".$y['consumtion']."</td>
				  <td  >".number_format($y['bill'],2)."</td>
				   <td  >".number_format($y['balbf'],2)."</td>
				    <td  >".number_format($y['totalbill'],2)."</td>
                <td >".$y['date']."</td>
 <td><input name='id[]' type='checkbox' value='".$y['id']."'   class='form-control input-sm'> </td>  				
           </tr>";
		 }
		 }

	?>
	<tr id="total" >
	<td></td>
	<td></td>
	<td><button type="submit" class="btn-info btn-sm" >SUBMIT</button></td>
	<td><button type="reset" class="btn-info btn-sm">RESET</button></td>
	<td></td>
	<td></td>
	<td>&nbsp;&nbsp;&nbsp;
	
	</td>
	</tr>
        </tbody>
    </table>
	</div>
<?php 



/*
class newentry
{
public $idnumber =null;
public $krapin=null;
public $name=null;
}
$newentry=new newentry;
$newentry->idnumber='24185670';
$newentry->krapin='AA223344';
$newentry->name='KELVIN OTIENO';
print $newentry->krapin;
//$mysqli->query("INSERT INTO staffs(idnumber,krapin,title,names) VALUES($newentry->idnumber,$newentry->idnumber,$newentry->idnumber,$newentry->idnumber)");

$mysqli->query("INSERT INTO staffs(idnumber,krapin,title,names) VALUES('$newentry->idnumber','$newentry->krapin','$newentry->idnumber','$newentry->name')");

class querys
{
public  $process=null;
function task1()
{
$this ->process="SELECT CONCAT('ONE') AS TASK ";

}
}
$querys=new querys;
$querys->task1();
$x=$mysqli->query($querys->process);
while ($data = $x->fetch_object())
{ print $data->TASK; }
//print $querys->process;  
///interface cant  have   properties  but  methods  which are  abstract  without  abstract  keyword    interface  dont   really  follow   parent child hierachy 
/*interface intro   
{
public function brand(); 
}
trait dadphin
{
 public $dadfirst ='andrew';
 static public $dadsecond='OKUTU';
}

trait grandmaphin
{
 public $grandmafirst ='truphena';
}

abstract class religion
{
 abstract function religion();

}
 class mumphin  
{
const mumid="123456";
public $mumfirst ='carolyne';
const first="roby";
public $familyname;
final public function __construct() //final  overrides  all  the child  classes 
{
$this ->familyname='OKUTU OKUTU';

}

public function test()
{  return " TEST 1 "; }


}
class phin   extends mumphin  implements intro  //calling  motherclass using  extends  and  using implements  to  call interface 
{
use dadphin,grandmaphin;///calling several  traits unlike  inheritence  where  a child  can only inherit   from  one   parent 
public $first ='phin';
public $second ='okutu';
public $familyname ='OKUTU3';
public $brandname="PIRNEYASS";
public function brand()
{return $this->brandname; }

public function test()
{  return " TEST 2 "; }

public function one ($first,$second)
{
$first =$this ->first;
$second =$this ->second;

}

public function two()
{ return $this ->first;

}

public function three()
{ return $this ->second;

}


public function __toString()
{
    return "THANKS";
}
}


$phin =new phin;
var_dump($phin ->two());
var_dump($phin->three());
var_dump($phin->dadfirst);
var_dump(phin::$dadsecond);
var_dump($phin->familyname);
var_dump($phin->mumfirst);
var_dump($phin->__toString());
var_dump(mumphin::mumid);
var_dump($phin->grandmafirst);
var_dump($phin->first);
var_dump(mumphin::first);
var_dump(mumphin::test());  //making   parent  class  method  overiding  child  class   method   with the same    name 
$serial=serialize(mumphin::first);
//print ($serial);  */
?>



