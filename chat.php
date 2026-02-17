 <?php 
@session_start();
@$user=$_SESSION['user'];
@$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("password.php");

?>


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
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
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
  
  $("#chat").submit(function()
{
$.post( "processchat.php",
$("#chat").serialize(),
function(data){//alert(data);
$("#chathistory").load("chathistory.php #chathist");$("textarea").val("");
return false;

});
return false; 
})





  $("#refreshbtn").click(function()
{
$("#refresh").load("chat.php #chatmate");
})


  setInterval(function(){
$("#chathistory").load("chathistory.php #chathist"); 

}, 2500);
   })
  </script>
  
  
  <script>
    window.onload = function() {
        var source = new EventSource("chahistory.php");
        source.onmessage = function(event) {
            document.getElementById("chathistory").innerHTML =event.data;
        };
    };
</script>
</head>

<button class="open-button" onclick="openForm()">Chat</button>

<div class="chat-popup" id="myForm">
  <form action=""  method="post"  class="form-container"  id="chat">
 
    <h4   style="text-align:center">Chat</h4>
<div id="chathistory">
</div>
    <label for="msg">
	<b >MESSAGE</b></label>
    <textarea placeholder="Type message.."   maxlength ="50" name="msg" required   style='text-transform:initial' ></textarea>
<div id="refresh"> <select class="form-control"   required= "on"  id="chatmate"  name="chatmate" >
			   <option value="">SELECT CHAT MATE</option>
			   <?php
$x="SELECT NAME FROM users WHERE NAME !='$user'  AND LOGGED='ON'";			   
	$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{
		print "<option value='".$y['NAME']."'>".$y['NAME']."</option>";	
			
		}}
			   
			   ?>
			      
			  </select></div>
    <button type="submit"  id="postmessage" class="btn">Send</button>
	 <button id="refreshbtn" type="button" class="btn">REFRESH</button>
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
