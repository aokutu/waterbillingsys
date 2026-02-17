


<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif; text-transform:uppercase;}
* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 50%;
  width: 25%;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 50%;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 70px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
#chathistory
{
	width: 100%; 
	overflow-y: scroll;      
  height: 180px;            //  <-- Select the height of the body
   position: absolute;	
	
}
</style>
  <script type="text/javascript" >
  $(document).ready(function(){ 
  
  $("#chathistory").load("chathistory.php #chathist");
  
  $("#distcalc").submit(function()
{$.post( "sessionregistry.php",
$("#distcalc").serialize(),
function(data){//alert(data);
$("#distance").load("distcalc2.php #results");return false;});
return false; 
})
 })
  </script>
 
</head>

<button class="open-button" onclick="openForm()">DIST-CALC</button>

<div class="chat-popup" id="myForm">
  <form action=""  method="post"  class="form-container"  id="distcalc">
   POINT A CORDINATES
	<br><a href="#" title="POINT A" data-toggle="popover" data-trigger="hover" data-content="LONGITUDE" data-placement="bottom">
	<input type="text" name="long1" class="form-control input-sm"  required="on" placeholder="LONG" >
	</a>
		<br>
		<a href="#" title="POINT A" data-toggle="popover" data-trigger="hover" data-content="LATTITUDE" data-placement="bottom">
		<input type="text" name="latt1" class="form-control input-sm"  required="on" placeholder="LATT" >
		</a>
<hr>POINT B CORDINATES
	<br>
	<a href="#" title="POINT B" data-toggle="popover" data-trigger="hover" data-content="LONGITUDE" data-placement="bottom">
	<input type="text" name="long2"  class="form-control input-sm"  required="on" placeholder="LONG" >
	</a>
		<br>
		<a href="#" title="POINT B" data-toggle="popover" data-trigger="hover" data-content="LATTITUDE" data-placement="bottom">
		<input type="text" name="latt2" class="form-control input-sm"   required="on" placeholder="LATT" >
		</a>
	<hr>
<select class="form-control"   required= "on" class="form-control input-sm"   id="chatmate"  name="units" >
			   <option value="">SELECT CALLIBRATION</option>
			     <option value="METERS">METERS</option> 
				  <option value="KILOMETERS">KILOMETERS</option>
			  </select>	
			  <hr>
			 <div id="distance" >=</div>
			 <hr>
<div id="refresh"> </div>

    <button type="submit" class="btn">CALCULATE</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

</script>