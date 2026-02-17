<video id="video" width="640" height="480" autoplay> </video>
<script>
var video=document.getElemwntById("video");
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
{navigator.mediaDevices.getUserMedia({video:true, audio :true;}).then (function (stream))}
</script>