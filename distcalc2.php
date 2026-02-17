<?php
session_start();
function pc_sphere_distance($lat1, $lon1, $lat2, $lon2, $radius = 6378.135) {
  $rad = doubleval(M_PI/180.0);

  $lat1 = doubleval($lat1) * $rad;
  $lon1 = doubleval($lon1) * $rad;
    $lat2 = doubleval($lat2) * $rad;
    $lon2 = doubleval($lon2) * $rad;

  $theta = $lon2 - $lon1;
  $dist = acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($theta));
  if ($dist < 0) { $dist += M_PI; }

    return $dist = $dist * $radius; // Default is Earth equatorial radius in kilometers
}

// NY, NY (10040)
$lat1 =$_SESSION['lat1'];
$lon1 = $_SESSION['lon1'];

// SF, CA (94144)
$lat2 = $_SESSION['lat2'];
$lon2 = $_SESSION['lon2'];

/////////////
// NY, NY (10040)
//$lat1 =40;
//$lon1 = -2;

// SF, CA (94144)
//$lat2 = 40;
//$lon2 = -3;
//////////////
$dist = pc_sphere_distance($lat1, $lon1, $lat2, $lon2);
$dist=(round($dist,4));
if($_SESSION['units'] =='METERS'){$dist=round($dist*1000,4);}

//printf("%.2f\n", $dist); // Format and convert to miles
?>
<h2 id="results">=<?php print  number_format($dist,2)." -----". $_SESSION['units'];  ?></h2>