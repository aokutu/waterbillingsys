<?php 
session_start();
if($_SESSION['message']==null ){ $_SESSION['message']="MISSING   VARIABLE";}
?>
<h2  id="content"><?php echo  $_SESSION['message']; ?>  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="messageclose">CLOSE</button></h2>
<?php  $_SESSION['message']=NULL; ?>


