<?php
@session_start();
include_once("password2.php");
include_once("interface2.php");

$dbdetails->user=$connect->real_escape_string($_SESSION['user']);
$dbdetails->password=$connect->real_escape_string($_SESSION['password']);
$dbdetails->userrights="LAB & IMAGING";
$x = $connect ->query("SELECT * FROM users  WHERE  name='$dbdetails->user' AND password='$dbdetails->password' AND ACCESS REGEXP '$dbdetails->userrights' ");
if(mysqli_num_rows($x)>0)
{}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}  


class imagingresults
{
public $trackkey=null;
public $imagelink=null;	
}
$imagingresults =new imagingresults;

if(isset($_GET['trackkey'])) {$imagingresults->trackkey=$_GET['trackkey'];}
if(isset($_SESSION['trackkey'])) {$imagingresults->trackkey=$_SESSION['trackkey'];}


$imagingresults->imagelink='xrayimages/'.$imagingresults->trackkey.'.png';

?>


<div class="mr-2 ml-2" id="loadimage">

<style>
.slidecontainer {
    width: 100%; /* Full-width container */
    margin-bottom: 20px; /* Spacing below the slider */
}

.slider {
    -webkit-appearance: none; /* Override default CSS styles */
    width: 100%; /* Full-width slider */
    height: 15px; /* Slider height */
    background: #ddd; /* Slider background */
    border-radius: 5px; /* Rounded edges */
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none; /* Override default styles */
    appearance: none;
    width: 25px; /* Thumb width */
    height: 25px; /* Thumb height */
    background: #4CAF50; /* Thumb color */
    border-radius: 50%; /* Rounded thumb */
}

.image-description {
    margin-top: 10px; /* Space above the description */
    font-family: Arial, sans-serif; /* Font style */
}

.image-description h3 {
    margin: 0; /* Remove default margin */
    font-size: 1.5em; /* Font size for title */
}

.image-description p {
    font-size: 1em; /* Font size for paragraph */
    color: #555; /* Text color */
}


@media print {
#patientdetails tr td:last-child	{
        display: none;
    }
}
</style>
    <div class="slidecontainer">
        <input type="range" min="25" max="100" value="25" class="slider" id="imageSizeSlider">
        <label for="imageSizeSlider">Image Size: <span id="sizeValue">25%</span></label>
    </div>

    <div id="loadimage2">
	<?php 
$x=$connect->query("SELECT  DISTINCT TRACKKEY,PROCEDURES,ATTENDANT,DATE,PATIENTNUMBER,NAME,GENDER,AGE  FROM  imagingresults  WHERE 
TRACKKEY='$imagingresults->trackkey'  ");

while ($data = $x->fetch_object())
{ 

$attendant=$data->ATTENDANT;
$date=$data->DATE;
 	

?>
	<table class="min-w-full bg-white border border-black-300"  id="patientdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" >NAMES</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->NAME; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >AGE</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->AGE; ?></td>
<td class="w-1/12  border border-black px-4 py-2" ><i id="rotateButton" style="font-size:160%;" class="fas fa-sync"></i></td>
</tr>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" >GENDER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->GENDER; ?></td>
<td class="w-1/6  border border-black px-4 py-2" >REFF NUMBER</td>
<td class="w-1/6  border border-black px-4 py-2" ><?php print $data->TRACKKEY;  ?></td>
<td class="w-1/12  border border-black px-4 py-2" ><i  style="font-size:160%;" onclick ="window.print()"  class="fas fa-print"></i></td>
</tr>
</tbody>
</table> 
<?php 
}
?>
        <img src='<?php print $imagingresults->imagelink; ?>' class="ml-5 mt-5 border border-blue-400 px-4 py-2"  id="zoomableImage" style="width: 25%;">
		  
		  
		  <br><br>
		 <div class="image-description">
		 <div  >REPORT 
<br>



<table class="min-w-full bg-white border border-black-300"  id="imagingdetails">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" >PARAMETER</td>
<td class="w-1/4  border border-black px-4 py-2" >OBSERVATION</td>
<td class="w-1/4  border border-black px-4 py-2" >CONCLUSION</td>
</tr>

<?php 
$x=$connect->query(" SELECT  PARAMETERS,RESULTS,RANGES  FROM  imagingresults  WHERE TRACKKEY='$imagingresults->trackkey'  ");

while ($data = $x->fetch_object())
{ 
?>

<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/12  border border-black px-4 py-2" ><?php print $data->PARAMETERS; ?></td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->RESULTS; ?></td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $data->RANGES; ?></td>
</tr>

<?php 
}
?>
</tbody>
</table>
<br>
<table class="min-w-full bg-white border border-black-300"  id="">
<tbody>
<tr class="bg-blue-100 text-black-700 font-bold" >
<td class="w-1/6  border border-black px-4 py-2" >RADIOLOGIST</td>
<td class="w-1/4  border border-black px-4 py-2" ><?php print $attendant; ?></td>
<td class="w-1/12  border border-black px-4 py-2" >SIGN</td>
<td class="w-1/6  border border-black px-4 py-2" ></td>
<td class="w-1/12  border border-black px-4 py-2" >DATE</td>
<td class="w-1/6  border border-black px-4 py-2" ></td>

</tr>
</tbody>
</table>

    </div>  
    </div>
	
	



</div>
</div>

	<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById("imageSizeSlider");
    const zoomableImage = document.getElementById("zoomableImage");
    const sizeValue = document.getElementById("sizeValue");

    // Update image size and display value when slider changes
    slider.oninput = function() {
        const newSize = this.value;
        zoomableImage.style.width = newSize + '%'; // Adjust image width based on slider value
        sizeValue.textContent = newSize + '%'; // Display current size percentage
    };
});

document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById("imageSizeSlider");
    const zoomableImage = document.getElementById("zoomableImage");
    const sizeValue = document.getElementById("sizeValue");
    const rotateButton = document.getElementById("rotateButton");

    let rotation = 0;

    // Update image size and display value when slider changes
    slider.oninput = function() {
        const newSize = this.value;
        zoomableImage.style.width = newSize + '%'; // Adjust image width based on slider value
        sizeValue.textContent = newSize + '%'; // Display current size percentage
    };

    // Rotate the image when the button is clicked
    rotateButton.addEventListener('click', function() {
        rotation += 90;
        zoomableImage.style.transform = `rotate(${rotation}deg)`;
    });
});


</script>


