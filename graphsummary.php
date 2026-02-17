<?PHP 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$currentreading=$_POST['current'];@$previousreading=$_SESSION['previousreading']; 
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{header("LOCATION:accessdenied.php");exit;}

 ?>

<!DOCTYPE html>
<html>
<script src="pluggins/chart.js"></script>
<body>
 <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
   <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" />
<link rel="stylesheet"  href="stylesheets/dashboard.css" />

<style type="text/css">
  @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;}}

#levelchart{ width:100%;}
  </style>
  
		  <style type="text/css" >
	
  </style>
	<style>

		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }
	 .container{width:100%;margin-right:1%; margin-left:5%;}
</style>


  

	 <button class="btn-info btn-sm"  id="printbill" onclick="window.print()">PRINT</button>

<h1  style='text-align:center;text-decoration: underline;' ><strong><ul>GRAPH SUMMARY REPORT AS AT <?php print date("Y-M");?></ul></strong></h1>



<div class="container">
  <div class="row">
   <div class="col-sm-5"><canvas id="myChart4" style="width:100%;"></canvas></div>

  <div class="col-sm-5"><canvas id="myChart2" style="width:100%;"></canvas></div>
  </div></div>


<div class="container">
  <div class="row">
    <div class="col-sm-5"><canvas id="myChart5" style="width:100%;"></canvas>  </div>

  <div class="col-sm-5"><canvas id="myChart3" style="width:100%;"></canvas>
  </div>
  </div></div>
  
  
  
    <div class="container">
  <div class="row">
  <div class="col-sm-5"><canvas id="myChart7" style="width:100%;"></canvas>
  </div>
  <div class="col-sm-5"><canvas id="myChart8" style="width:100%;"></canvas></div>
  </div></div>
  
  <div class="container">
  <div class="row">
  <div class="col-sm-5"><canvas id="billedaccounts" style="width:100%;"></canvas></div>
    <div class="col-sm-5"><canvas id="paidaccounts" style="width:100%;"></canvas></div>

  </div></div>
  
  
  <div class="container">
  <div class="row">
  <div class="col-sm-5"><canvas id="myChart9" style="width:100%;"></canvas>
  </div>
  <div class="col-sm-5"><canvas id="revenuegenerated" style="width:100%;"></canvas></div>
  </div></div>
  
    <div class="container">
  <div class="row">
  <div class="col-sm-5"><canvas id="myChart11" style="width:100%;"></canvas>
  </div>
  <div class="col-sm-5"><canvas id="myChart12" style="width:100%;"></canvas></div>
  </div></div>
  
   <div class="container">
  <div class="row">
  <div class="col-sm-5"><canvas id="nonwaterbill" style="width:100%;"></canvas>
  </div>
  <div class="col-sm-5"><canvas id="nonwaterrevenue" style="width:100%;"></canvas></div>
  </div></div>
  
 <div class="container">
  <div class="col-sm-5"><canvas id="accountstatusannual" style="width:100%;"></canvas></div>
   <div class="row">
  <div class="col-sm-5">
  </div>
  </div></div>

<style>

</style>
<script>
var xValues = [ <?php 


 $x="CREATE TEMPORARY TABLE METERSTATUS(STATUS TEXT,TALLY INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	$b="INSERT INTO METERSTATUS (STATUS,TALLY) select clientmetersreg.STATUS,COUNT(STATUS) FROM clientmetersreg group by clientmetersreg.status;";
mysqli_query($connect,$b)or die(mysqli_error($connect));

		

$x="SELECT STATUS FROM `METERSTATUS`  group  by  STATUS  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['STATUS']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `METERSTATUS`   group  by  STATUS  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
	?> ];
var barColors = [  <?php  

$x="SELECT CONCAT('green') AS color FROM `METERSTATUS` group  by  STATUS  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
?>   ];

new Chart("myChart2", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "METERS STATUS"
    }
  }
});
</script>
<?php 
$x="DROP TABLE METERSTATUS";
mysqli_query($connect,$x)or die(mysqli_error($connect));
?>

<script>

<?PHP 
 $x="CREATE TEMPORARY TABLE ACCOUNTSTATUS(STATUS TEXT,TALLY INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;
	$b="INSERT INTO ACCOUNTSTATUS (STATUS,TALLY) select $accountstable.STATUS,COUNT(STATUS) FROM $accountstable group by $accountstable.STATUS;";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		
		}
		}
?>


var xValues = [ <?php 

$x="SELECT STATUS FROM `ACCOUNTSTATUS` GROUP BY STATUS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['STATUS']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php 	
	$x="SELECT SUM(TALLY) FROM `ACCOUNTSTATUS` GROUP  BY  STATUS   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
	
	
?> ];
var barColors = [  <?php  

$x="SELECT CONCAT('orange') AS color FROM `ACCOUNTSTATUS`  GROUP  BY STATUS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
?>   ];

new Chart("myChart3", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ACCOUNT STATUS GRAPH"
    }
  }
});
</script>
<?php 
$x="DROP TABLE ACCOUNTSTATUS";
mysqli_query($connect,$x)or die(mysqli_error($connect));
?>

<?PHP 

 $x="CREATE TEMPORARY TABLE METERSSIZE(SIZE TEXT,TALLY INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	$b="INSERT INTO METERSSIZE (SIZE,TALLY) select clientmetersreg.SIZE,SUM(SIZE) FROM clientmetersreg group by clientmetersreg.SIZE;";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		
?>


<script>
var xValues = [ <?php 


 $x="CREATE TEMPORARY TABLE METERSSIZES(SIZES TEXT,TALLY INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	$b="INSERT INTO METERSSIZES (SIZES,TALLY) select clientmetersreg.SIZE,COUNT(SIZE) FROM clientmetersreg group by clientmetersreg.SIZE;";
mysqli_query($connect,$b)or die(mysqli_error($connect));

		

$x="SELECT SIZES FROM `METERSSIZES`  group  by  SIZES  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['SIZES']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `METERSSIZES`   group  by  SIZES  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
	?> ];
var barColors = [  <?php  

$x="SELECT CONCAT('orangered') AS color FROM `METERSSIZES` group  by  SIZES  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
?>   ];

new Chart("myChart4", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "METERS SIZES"
    }
  }
});
</script>
<?php 
$x="DROP TABLE METERSSIZES";
mysqli_query($connect,$x)or die(mysqli_error($connect));
?>


<script>
<?PHP 
 $x="CREATE TEMPORARY TABLE ACCOUNTCLASS(CLASS TEXT,TALLY INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;
	$b="INSERT INTO ACCOUNTCLASS (CLASS,TALLY) select $accountstable.CLASS,COUNT(CLASS) FROM $accountstable group by $accountstable.CLASS;";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		
		}
		}
?>


var xValues = [ <?php 

$x="SELECT CLASS FROM `ACCOUNTCLASS` GROUP BY CLASS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $class=$y['CLASS']; echo json_encode($class).",";  }}
?> ];
var yValues = [  <?php 	
	$x="SELECT SUM(TALLY) FROM `ACCOUNTCLASS` GROUP  BY  CLASS   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
	
	
?> ];
var barColors = [  <?php  

$x="SELECT CONCAT('moccasin') AS color FROM `ACCOUNTCLASS`  GROUP  BY CLASS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
?>   ];

new Chart("myChart5", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ACCOUNT CLASS"
    }
  }
});
</script>
<?php 
$x="DROP TABLE ACCOUNTCLASS";
mysqli_query($connect,$x)or die(mysqli_error($connect));
?>

<script>
<?PHP 
 $x="CREATE TEMPORARY TABLE BILLUPDATED(CLASS TEXT,STATUS TEXT,TALLY INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$accountstable='accounts'.$i;
	
	////////////////
		$b="INSERT INTO BILLUPDATED (CLASS,TALLY) 
	select CONCAT('BILLED'),COUNT(ACCOUNT) FROM $accountstable WHERE  YEAR(DATE2) =(SELECT YEAR(CURDATE()) )  AND MONTH(DATE2)  =(SELECT MONTH(CURDATE())) ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		$b="INSERT INTO BILLUPDATED (CLASS,TALLY) 
	select CONCAT('NOT BILLED'),COUNT(ACCOUNT) FROM $accountstable WHERE  YEAR(DATE2) !=(SELECT YEAR(CURDATE()) )  AND MONTH(DATE2)  !=(SELECT MONTH(CURDATE())) ";
mysqli_query($connect,$b)or die(mysqli_error($connect));	
	//////////////////
		$b="INSERT INTO BILLUPDATED (CLASS,TALLY) 
	SELECT CONCAT('BILLED'),COUNT(ACCOUNT) FROM $billstable  ";
mysqli_query($connect,$b)or die(mysqli_error($connect));

		
		}
		}
?>


var xValues = [ <?php 

$x="SELECT CLASS FROM `BILLUPDATED` GROUP BY CLASS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $class=$y['CLASS']; echo json_encode($class).",";  }}
?> ];
var yValues = [  <?php 	
	$x="SELECT SUM(TALLY) FROM `BILLUPDATED` GROUP  BY  CLASS   ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
	
	
?> ];
var barColors = [  <?php  

$x="SELECT CONCAT('khaki') AS color FROM `BILLUPDATED`  GROUP  BY CLASS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
?>   ];


new Chart("billedaccountsX", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "BILLED ACCOUNTS"
    }
  }
});
</script>


<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALBILLEDACCOUNTS(CONSUMTIONMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;
		$b="INSERT INTO ANNUALBILLEDACCOUNTS (CONSUMTIONMONTH,TALLY,MONTHPOS) SELECT CONCAT(YEAR(DATE),'-',MONTH(DATE)) ,COUNT(ACCOUNT),MONTH(DATE) FROM $billstable WHERE YEAR(DATE) = YEAR(CURDATE()) GROUP BY YEAR(DATE),MONTH(DATE) ORDER BY DATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));	
		
		}}
	
	
	

			
			

$x="SELECT CONSUMTIONMONTH  FROM `ANNUALBILLEDACCOUNTS` GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['CONSUMTIONMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALBILLEDACCOUNTS`  GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('coral') AS color FROM `ANNUALBILLEDACCOUNTS`  GROUP BY CONSUMTIONMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALBILLEDACCOUNTS";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("billedaccounts", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL BILLED ACCOUNTS "
    }
  }
});
</script>

<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALPAIDACCOUNTS(CONSUMTIONMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccounts='wateraccounts'.$i;
		$b="INSERT INTO ANNUALPAIDACCOUNTS (CONSUMTIONMONTH,TALLY,MONTHPOS) 
		SELECT CONCAT(YEAR(DEPOSITDATE),'-',MONTH(DEPOSITDATE)) ,COUNT(ACCOUNT),MONTH(DEPOSITDATE) FROM $wateraccounts WHERE YEAR(DEPOSITDATE) = YEAR(CURDATE()) GROUP BY YEAR(DEPOSITDATE),MONTH(DEPOSITDATE) ORDER BY DEPOSITDATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));	
		
		}}		
			

$x="SELECT CONSUMTIONMONTH  FROM `ANNUALPAIDACCOUNTS` GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['CONSUMTIONMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALPAIDACCOUNTS`  GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('khaki') AS color FROM `ANNUALPAIDACCOUNTS`  GROUP BY CONSUMTIONMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALPAIDACCOUNTS";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("paidaccounts", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL PAID ACCOUNTS "
    }
  }
});
</script>

<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ZONESTABLE(ZONE TEXT,TALLY INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	$x="SELECT number,zone FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$accountstable='accounts'.$i;$zone=$y['zone'];
	$b="INSERT INTO ZONESTABLE (ZONE,TALLY) select CONCAT('$zone'),COUNT(ACCOUNT) FROM $accountstable group by $accountstable.account;";
mysqli_query($connect,$b)or die(mysqli_error($connect));
		
		}
		}
			
			

$x="SELECT ZONE  FROM `ZONESTABLE`     group  by  ZONE  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['ZONE']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY),CONCAT('red') AS color FROM `ZONESTABLE`   group  by  ZONE  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT CONCAT('yellowgreen') AS color FROM `ZONESTABLE`   group  by  ZONE  ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ZONESTABLE";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("myChart7", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ZONE GRAPH"
    }
  }
});
</script>


<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALWATERPRODUCTION(PRODUCTIONMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

	$b="INSERT INTO ANNUALWATERPRODUCTION (PRODUCTIONMONTH,TALLY,MONTHPOS) 
	SELECT CONCAT(YEAR(DATE),'-',MONTH(DATE)) ,SUM(UNITS),MONTH(DATE) FROM waterproduction WHERE YEAR(DATE) = YEAR(CURDATE()) GROUP BY YEAR(DATE),MONTH(DATE) ORDER BY DATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));
			
			

$x="SELECT PRODUCTIONMONTH  FROM `ANNUALWATERPRODUCTION` GROUP BY PRODUCTIONMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['PRODUCTIONMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALWATERPRODUCTION`  GROUP BY PRODUCTIONMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('purple') AS color FROM `ANNUALWATERPRODUCTION`  GROUP BY PRODUCTIONMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALWATERPRODUCTION";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("myChart8", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL WATER PRODUCTION"
    }
  }
});
</script>



<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALWATERUSAGE(CONSUMTIONMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;
		$b="INSERT INTO ANNUALWATERUSAGE (CONSUMTIONMONTH,TALLY,MONTHPOS) SELECT CONCAT(YEAR(DATE),'-',MONTH(DATE)) ,SUM(UNITS),MONTH(DATE) FROM $billstable WHERE YEAR(DATE) = YEAR(CURDATE()) GROUP BY YEAR(DATE),MONTH(DATE) ORDER BY DATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));	
		
		}}
	
	
	

			
			

$x="SELECT CONSUMTIONMONTH  FROM `ANNUALWATERUSAGE` GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['CONSUMTIONMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALWATERUSAGE`  GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('powderblue') AS color FROM `ANNUALWATERUSAGE`  GROUP BY CONSUMTIONMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALWATERUSAGE";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("myChart9", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL WATER USAGE"
    }
  }
});
</script>

<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALREVENUE(CONSUMTIONMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccountstable='wateraccounts'.$i;
		$b="INSERT INTO ANNUALREVENUE (CONSUMTIONMONTH,TALLY,MONTHPOS) SELECT CONCAT(YEAR(DEPOSITDATE),'-',MONTH(DEPOSITDATE)) ,SUM(CREDIT),MONTH(DEPOSITDATE) FROM $wateraccountstable WHERE YEAR(DEPOSITDATE) = YEAR(CURDATE()) GROUP BY YEAR(DEPOSITDATE),MONTH(DEPOSITDATE) ORDER BY DEPOSITDATE ASC";
		//$b="INSERT INTO ANNUALREVENUE (CONSUMTIONMONTH,TALLY,MONTHPOS) SELECT CONCAT(YEAR(DEPOSITDATE),'-',MONTH(DEPOSITDATE)) ,SUM(CREDIT),MONTH(DEPOSITDATE) FROM $wateraccountstable WHERE CODE IN(SELECT CODE FROM PAYMENTCODE WHERE NAME  REGEXP 'WATER BILL') AND  YEAR(DEPOSITDATE) = YEAR(CURDATE()) GROUP BY YEAR(DEPOSITDATE),MONTH(DEPOSITDATE) ORDER BY DEPOSITDATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));	
		
		}}
	
	
	

			
			

$x="SELECT CONSUMTIONMONTH  FROM `ANNUALREVENUE` GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['CONSUMTIONMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALREVENUE`  GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('red') AS color FROM `ANNUALREVENUE`  GROUP BY CONSUMTIONMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALREVENUE";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("revenuegenerated", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL REVENUE GENERATED"
    }
  }
});
</script>



<script>

var xValues = [ <?php  


 $x="CREATE TEMPORARY TABLE ANNUALUNBILLED(UNBILLEDMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

$b="INSERT INTO ANNUALUNBILLED (UNBILLEDMONTH,TALLY,MONTHPOS) 
SELECT CONCAT(YEAR(DATE),'-',MONTH(DATE)) ,SUM(UNITS),MONTH(DATE) FROM waterproduction WHERE YEAR(DATE) = YEAR(CURDATE()) GROUP BY YEAR(DATE),MONTH(DATE) ORDER BY DATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));

	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccountstable='wateraccounts'.$i;
$b="INSERT INTO ANNUALUNBILLED (UNBILLEDMONTH,TALLY,MONTHPOS) 
SELECT CONCAT(YEAR(DATE),'-',MONTH(DATE)) ,-1*SUM(UNITS),MONTH(DATE) FROM $billstable WHERE YEAR(DATE) = YEAR(CURDATE()) GROUP BY YEAR(DATE),MONTH(DATE) ORDER BY DATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));	
		
		}
		}
	
	
 $x="CREATE TEMPORARY TABLE WATERLOSS(UNBILLEDMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
$x="SELECT * FROM ANNUALUNBILLED";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));

$b="INSERT INTO WATERLOSS (UNBILLEDMONTH,TALLY,MONTHPOS) SELECT UNBILLEDMONTH,TALLY,MONTHPOS FROM ANNUALUNBILLED ";
mysqli_query($connect,$b)or die(mysqli_error($connect));
			
			

$x="SELECT UNBILLEDMONTH  FROM `WATERLOSS` GROUP BY UNBILLEDMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['UNBILLEDMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `WATERLOSS`  GROUP BY UNBILLEDMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('tomato') AS color FROM `WATERLOSS`  GROUP BY UNBILLEDMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE WATERLOSS";mysqli_query($connect,$x)or die(mysqli_error($connect));
	$x="DROP TEMPORARY TABLE ANNUALUNBILLED";mysqli_query($connect,$x)or die(mysqli_error($connect));
	
?>   ];

new Chart("myChart11", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL WATER LOSS "
    }
  }
});
</script>

<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALBILL(CONSUMTIONMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;
		$b="INSERT INTO ANNUALBILL (CONSUMTIONMONTH,TALLY,MONTHPOS) SELECT CONCAT(YEAR(DATE),'-',MONTH(DATE)) ,SUM(BALANCE),MONTH(DATE) FROM $billstable WHERE YEAR(DATE) = YEAR(CURDATE()) GROUP BY YEAR(DATE),MONTH(DATE) ORDER BY DATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));
	
		
		}}
	
	
	

			
			

$x="SELECT CONSUMTIONMONTH  FROM `ANNUALBILL` GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['CONSUMTIONMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALBILL`  GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('limegreen') AS color FROM `ANNUALBILL`  GROUP BY CONSUMTIONMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALBILL";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("myChart12", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL AMOUNT BILLED"
    }
  }
});
</script>



<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALNONWATERBILL(CONSUMTIONMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$nonwaterbills='nonwaterbills'.$i;
		$b="INSERT INTO ANNUALNONWATERBILL (CONSUMTIONMONTH,TALLY,MONTHPOS) SELECT CONCAT(YEAR(DATE),'-',MONTH(DATE)) ,SUM(AMOUNT),MONTH(DATE) FROM $nonwaterbills WHERE YEAR(DATE) = YEAR(CURDATE()) GROUP BY YEAR(DATE),MONTH(DATE) ORDER BY DATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));
	
		
		}}

$x="SELECT CONSUMTIONMONTH  FROM `ANNUALNONWATERBILL` GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['CONSUMTIONMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALNONWATERBILL`  GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('pink') AS color FROM `ANNUALNONWATERBILL`  GROUP BY CONSUMTIONMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALNONWATERBILL";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("nonwaterbill", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL NONWATER BILLED"
    }
  }
});
</script>

<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALNONWATERBILL(CONSUMTIONMONTH TEXT,TALLY INT,MONTHPOS INT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccountstable='wateraccounts'.$i;
		$b="INSERT INTO ANNUALNONWATERBILL (CONSUMTIONMONTH,TALLY,MONTHPOS) SELECT CONCAT(YEAR(DEPOSITDATE),'-',MONTH(DEPOSITDATE)) ,SUM(CREDIT),MONTH(DEPOSITDATE) FROM $wateraccountstable WHERE 
		CODE IN(SELECT CODE FROM paymentcode WHERE NAME NOT REGEXP 'WATER BILL') AND YEAR(DEPOSITDATE) = YEAR(CURDATE()) GROUP BY YEAR(DEPOSITDATE),MONTH(DEPOSITDATE) ORDER BY DEPOSITDATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));
	
		
		}}

$x="SELECT CONSUMTIONMONTH  FROM `ANNUALNONWATERBILL` GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['CONSUMTIONMONTH']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALNONWATERBILL`  GROUP BY CONSUMTIONMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('lightblue') AS color FROM `ANNUALNONWATERBILL`  GROUP BY CONSUMTIONMONTH  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALNONWATERBILL";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("nonwaterrevenue", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL NONWATER REVENUE"
    }
  }
});
</script>


<script>

var xValues = [ <?php  

 $x="CREATE TEMPORARY TABLE ANNUALSTATUS(STATUSMONTH TEXT,TALLY INT,MONTHPOS INT,STATUS TEXT);";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));


	$x="SELECT number FROM zones ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		 while ($y=@mysqli_fetch_array($x))
		{
			
	$i=$y['number'];$billstable='bills'.$i;$wateraccountstable='wateraccounts'.$i;
	/*	$b="INSERT INTO ANNUALSTATUS (STATUSMONTH,TALLY,MONTHPOS) SELECT CONCAT(YEAR(DEPOSITDATE),'-',MONTH(DEPOSITDATE)) ,SUM(CREDIT),MONTH(DEPOSITDATE) FROM $wateraccountstable WHERE 
		CODE IN(SELECT CODE FROM paymentcode WHERE NAME NOT REGEXP 'WATER BILL') AND YEAR(DEPOSITDATE) = YEAR(CURDATE()) GROUP BY YEAR(DEPOSITDATE),MONTH(DEPOSITDATE) ORDER BY DEPOSITDATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));*/
	
		
		}}
	$b="INSERT INTO ANNUALSTATUS (STATUSMONTH,TALLY,MONTHPOS,STATUS) SELECT CONCAT(YEAR(DATE),'-',MONTH(DATE)) ,COUNT(STATUS),MONTH(DATE),STATUS FROM statustrail WHERE 
		 YEAR(DATE) = YEAR(CURDATE()) GROUP BY YEAR(DATE),MONTH(DATE),STATUS ORDER BY DATE ASC";
mysqli_query($connect,$b)or die(mysqli_error($connect));



$x="SELECT STATUSMONTH,STATUS  FROM `ANNUALSTATUS` GROUP BY STATUSMONTH,STATUS ORDER BY  MONTHPOS    ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{ $status=$y['STATUSMONTH'].'-'.$y['STATUS']; echo json_encode($status).",";  }}
?> ];
var yValues = [  <?php  

$x="SELECT SUM(TALLY) FROM `ANNUALSTATUS`  GROUP BY STATUSMONTH ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$tally=$y['SUM(TALLY)']; echo json_encode($tally).",";  }}
?> ];
var barColors = [  <?php  

$x="SELECT  CONCAT('purple') AS color FROM `ANNUALSTATUS`  GROUP BY STATUSMONTH,STATUS  ORDER BY  MONTHPOS ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{$color=$y['color']; echo json_encode($color).",";  }}
	
	
	$x="DROP TEMPORARY TABLE ANNUALSTATUS";mysqli_query($connect,$x)or die(mysqli_error($connect));
?>   ];

new Chart("accountstatusannual", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "ANNUAL  STATUS  UPDATE"
    }
  }
});
</script>

  

 
</body>
</html>