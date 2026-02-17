 <style  type="text/css"> 
 #myCanvas { border: dotted 2px black;}
 </style>
 <script> 
 $('document').ready(function(){ 
 draw(); 
function draw(){var canvas = document.getElementById("myCanvas");
var context = canvas.getContext("2d");
context.strokeStyle = "red";
}
  }); 
 </script> 
 
 <canvas id="myCanvas"  width="200"  height="200"> 
 Sorry! Your browser doesn’t support Canvas. 
 </canvas>