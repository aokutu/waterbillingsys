<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
include_once("password.php");
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'     AND  ACCESS  REGEXP  'USERS ADMIN'     ";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
$id=$_SESSION['id'];  if($id== null ){$id=0; }
$x="SELECT * FROM users where id=$id  ";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{while ($y=@mysqli_fetch_array($x))
		{$access=$y['access']; $edituser=$y['name'];  $editpassword=$y['password'];}}

$accessdata=explode(',',$access);
	
?> 
 <div class="container">
  <div class="row">
  <div class="col-sm-4">
  <input type="hidden" value="edit2" name="action" />   <input type="hidden" value="<?php echo   $id; ?>" name="id" />
  <input type="text"  style='text-transform:uppercase' value="<?php   echo  $edituser; ?>"  name="name"   pattern="[0-9A-Za-z]{5,10}"  title="ENTER 5-10 ALPHANUMERIC"    class="form-control input-sm"   required="on"  />
		
</div>
<div class="col-sm-4"></div>  
  </div>
</div>
  <div class="col-sm-12"><div class="btn-info btn-sm" >ADMINISTRATOR MODULE</div><br></div>
  

  </div> <div class="row">
  <div class="col-sm-4">USERS ADMIN<input name='right[]'  <?php    if(in_array("USERS ADMIN",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='USERS ADMIN'   class='form-control input-sm'></div>
<div class="col-sm-4">RESET PASSWORD<input name='right[]' <?php    if(in_array("USERS ADMIN",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='RESET PASSWORD'   class='form-control input-sm'></div>
  <div class="col-sm-4">COMPANY ADMIN <input name='right[]' <?php    if(in_array("USERS ADMIN",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='>COMPANY ADMIN'   class='form-control input-sm'></div>
 

   </div>
   <div class="row">
    <div class="col-sm-4">ZONE ADMIN <input name='right[]' <?php    if(in_array("ZONE ADMIN",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='ZONE ADMIN'   class='form-control input-sm'></div>
	  <div class="col-sm-4">BACKUP DATABASE<input name='right[]'  <?php    if(in_array("BACKUP DATABASE",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='BACKUP DATABASE'   class='form-control input-sm'></div>
  <div class="col-sm-4">AUDIT TRAIL<input name='right[]'  <?php    if(in_array("AUDIT TRAIL",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='AUDIT TRAIL'   class='form-control input-sm'></div>
   </div>
     <div class="row">
	<div class="col-sm-4">PRODUCTION BILLING <input name='right[]' <?php    if(in_array("PRODUCTION BILLING",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='PRODUCTION BILLING'   class='form-control input-sm'></div>
<div class="col-sm-4">MULTI EDIT <input name='right[]' <?php    if(in_array("MULTI EDIT",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='MULTI EDIT'   class='form-control input-sm'></div>
</div>
 <div class="row">
	  <div class="col-sm-4">ARCHIVE<input name='right[]' <?php    if(in_array("ARCHIVE",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='ARCHIVE'   class='form-control input-sm'></div>
</div>

  
<div class="row">
 <div class="col-sm-12"><div class="btn-info btn-sm" >SMS/EMAILS MODULE</div><br></div>
 </div>
  
 <div class="row"><div class="col-sm-4">POST SMS-EMAILS<input name='right[]' <?php    if(in_array("POST SMS-EMAILS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='POST SMS-EMAILS'   class='form-control input-sm'></div>
  <div class="col-sm-4">SEND  SMS-EMAILS<input name='right[]' <?php    if(in_array("SEND  SMS-EMAILS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'  value='SEND  SMS-EMAILS'   class='form-control input-sm'></div>
  <div class="col-sm-4">EDIT CONTACTS<input name='right[]' <?php    if(in_array("EDIT CONTACTS",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='EDIT CONTACTS'   class='form-control input-sm'></div>
   </div>
  
    <div class="row">
	 <div class="col-sm-4">DELETE SMS-EMAILS<input name='right[]' <?php    if(in_array("DELETE SMS-EMAILS",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='DELETE SMS-EMAILS'   class='form-control input-sm'></div>
	 <div class="col-sm-4">UPLOAD CONTACTS<input name='right[]'  <?php  if(in_array("UPLOAD CONTACTS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='UPLOAD CONTACTS'   class='form-control input-sm'></div>
	
	</div>
	
  <div class="col-sm-12"><div class="btn-info btn-sm" >BILLING  MODULE</div><br></div>
  

  </div>
  
   <div class="row">
  <div class="col-sm-4">BILLING <input name='right[]'  <?php    if(in_array("BILLING",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='BILLING'   class='form-control input-sm'></div>
    <div class="col-sm-4">VIEW BILLS <input name='right[]'  <?php    if(in_array("VIEW BILLS",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='VIEW BILLS'   class='form-control input-sm'></div>
  <div class="col-sm-4">DELETE BILLS <input name='right[]' <?php    if(in_array("DELETE BILLS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='DELETE BILLS'   class='form-control input-sm'></div>
  </div>
  <div class="row">
  <div class="col-sm-4">EDIT BILLS <input name='right[]'  <?php    if(in_array("EDIT BILLS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='EDIT BILLS'   class='form-control input-sm'></div>
     <div class="col-sm-4">UPLOAD BILLS <input name='right[]' <?php    if(in_array("UPLOAD BILLS",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='UPLOAD BILLS'   class='form-control input-sm'></div>

  </div>
   
 <div class="row">
  
  <div class="col-sm-12"><div class="btn-info btn-sm" >PAYMENT MODULE</div><br></div>
  
 
  </div>
  
   <div class="row">
  <div class="col-sm-4">VIEW SLIPS<input name='right[]' <?php    if(in_array("VIEW SLIPS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='VIEW SLIPS'   class='form-control input-sm'></div>
  <div class="col-sm-4">ADD SLIPS<input name='right[]' <?php    if(in_array("ADD SLIPS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='ADD SLIPS'   class='form-control input-sm'></div>
  <div class="col-sm-4">DELETE SLIPS<input name='right[]' <?php    if(in_array("DELETE SLIPS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='DELETE SLIPS'   class='form-control input-sm'></div>
  </div>
   <div class="row"> 
   <div class="col-sm-4">EDIT SLIPS <input name='right[]' <?php    if(in_array("EDIT SLIPS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='EDIT SLIPS'   class='form-control input-sm'></div>
   <div class="col-sm-4">UPLOAD SLIPS<input name='right[]' <?php    if(in_array("UPLOAD SLIPS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='UPLOAD SLIPS'   class='form-control input-sm'></div>
   <div class="col-sm-4">PAYMENT CODES <input name='right[]' <?php    if(in_array("PAYMENT CODES",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='PAYMENT CODES'   class='form-control input-sm'></div>
   </div> 
  
   <div class="row">
 <div class="col-sm-12"><div class="btn-info btn-sm" >RECIEPT MODULE</div><br></div>
</div>
 <div class="row">
  <div class="col-sm-4">VIEW RECEIPTS<input name='right[]' <?php    if(in_array("VIEW RECEIPTS",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='VIEW RECIEPTS'   class='form-control input-sm'></div>
  <div class="col-sm-4">ADD RECIEPTS<input name='right[]' <?php    if(in_array("ADD RECIEPTS",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='ADD RECIEPTS'   class='form-control input-sm'></div>
  <div class="col-sm-4">REVERSE RECIEPTS<input name='right[]' <?php    if(in_array("REVERSE RECIEPTS",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='REVERSE RECIEPTS'   class='form-control input-sm'></div>
<div class="col-sm-4"></div>
  </div>
  
     <div class="row">
<div class="col-sm-12"><div class="btn-info btn-sm" >REPORTS MODULE</div><br></div>
</div>
  <div class="row">
  <div class="col-sm-4">VIEW REPORTS<input name='right[]' <?php    if(in_array("VIEW REPORTS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='VIEW REPORTS'   class='form-control input-sm'></div>
  <div class="col-sm-4">GRAPH SUMMARY<input name='right[]' <?php    if(in_array("GRAPH SUMMARY",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='GRAPH SUMMARY'   class='form-control input-sm'></div>

 </div>
  <div class="row">
 <div class="col-sm-12"><div class="btn-info btn-sm" >REGISTRY MODULE</div><br></div>
 </div>
   <div class="row">
  <div class="col-sm-4">ACCOUNTS REG<input name='right[]' <?php    if(in_array("ACCOUNTS REG",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='ACCOUNTS REG'   class='form-control input-sm'></div>
  <div class="col-sm-4">EDIT ACCOUNT<input name='right[]'  <?php    if(in_array("EDIT ACCOUNT",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='EDIT ACCOUNT'   class='form-control input-sm'></div>
  <div class="col-sm-4">UPDATE STATUS<input name='right[]' <?php    if(in_array("UPDATE STATUS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox' value='UPDATE STATUS'   class='form-control input-sm'></div>
 
  
  </div>
  <div class="row">
   <div class="col-sm-4">DELETE ACCOUNT<input name='right[]' <?php    if(in_array("DELETE ACCOUNT",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='DELETE ACCOUNT'   class='form-control input-sm'></div>
  <div class="col-sm-4">NEW CONNECTION <input name='right[]' <?php    if(in_array("NEW CONNECTION",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='NEW CONNECTION'   class='form-control input-sm'></div>
  <div class="col-sm-4">ACCOUNT TRANSFER <input name='right[]' <?php    if(in_array("ACCOUNT TRANSFER",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='ACCOUNT TRANSFER'   class='form-control input-sm'></div>
   

  </div>
    <div class="row">
	 <div class="col-sm-4">ACCOUNTS TRAIL <input name='right[]' <?php    if(in_array("ACCOUNTS TRAIL",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='ACCOUNTS TRAIL'   class='form-control input-sm'></div>
	<div class="col-sm-4">UPLOAD ACCOUNTS <input name='right[]' <?php    if(in_array("UPLOAD ACCOUNTS",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='UPLOAD ACCOUNTS'   class='form-control input-sm'></div>
	</div>
  
   <div class="row">
 <div class="col-sm-12"><div class="btn-info btn-sm" >METER REGISTRY MODULE</div><br></div>
 </div>
  
    <div class="row">
  <div class="col-sm-4">METER REG<input name='right[]' <?php    if(in_array("METER REG",$accessdata)) { echo "checked ='on'"; }  ?>   type='checkbox' value='METER REG'   class='form-control input-sm'></div>
  <div class="col-sm-4">NEW METER<input name='right[]' <?php    if(in_array("NEW METER",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='NEW METER'   class='form-control input-sm'></div>
  <div class="col-sm-4">EDIT METER<input name='right[]' <?php    if(in_array("EDIT METER",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='EDIT METER'   class='form-control input-sm'></div>
  
    
  </div>
   <div class="row"> <div class="col-sm-4">DELETE METER<input name='right[]' <?php    if(in_array("DELETE METER",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox' value='DELETE METER'   class='form-control input-sm'></div>
   
   <div class="col-sm-4">PRODUCTION METER<input name='right[]' <?php    if(in_array("PRODUCTION METER",$accessdata)) { echo "checked ='on'"; }  ?>    type='checkbox' value='PRODUCTION METER'   class='form-control input-sm'></div>
   </div>
      

  <div class="row">
 <div class="col-sm-12"><div class="btn-info btn-sm" >GEO MAPPING MODULE</div><br></div>
 </div> 
   
     <div class="row">
  <div class="col-sm-4">UPDATE CORDINATES<input name='right[]' <?php    if(in_array("UPDATE CORDINATES",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'     value='UPDATE CORDINATES'   class='form-control input-sm'></div>
  <div class="col-sm-4">GENERATE MAP<input name='right[]' <?php    if(in_array("GENERATE MAP",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'       value='GENERATE MAP'   class='form-control input-sm'></div>
   .
  </div>
   <div class="row">
 <div class="col-sm-12"><div class="btn-info btn-sm" >INVENTORY MODULE</div><br></div>
 </div>
  
    <div class="row">
  <div class="col-sm-4">INVENTORY REG<input name='right[]' <?php    if(in_array("INVENTORY REG",$accessdata)) { echo "checked ='on'"; }  ?>  type='checkbox'     value='INVENTORY REG'   class='form-control input-sm'></div>
  <div class="col-sm-4">DELETE ITEM<input name='right[]' <?php    if(in_array("DELETE ITEM",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'       value='DELETE ITEM'   class='form-control input-sm'></div>
  <div class="col-sm-4">RESTOCK ITEM <input name='right[]' <?php    if(in_array("RESTOCK ITEM",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'       value='RESTOCK ITEM'   class='form-control input-sm'></div>
  
	
  </div>
  
    <div class="row"><div class="col-sm-4">UNSTOCK ITEM <input name='right[]' <?php    if(in_array("UNSTOCK ITEM",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'       value='UNSTOCK ITEM'   class='form-control input-sm'></div>
  <div class="col-sm-4">REQUISITION <input name='right[]' <?php    if(in_array("REQUISITION",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'       value='REQUISITION'   class='form-control input-sm'></div>
	  <div class="col-sm-4">GATE PASS <input name='right[]' <?php    if(in_array("GATE PASS",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'       value='GATE PASS'   class='form-control input-sm'></div>
   

  </div>
  
  <div class="row"> <div class="col-sm-4">L.P.O <input name='right[]' <?php    if(in_array("L.P.O",$accessdata)) { echo "checked ='on'"; }  ?> type='checkbox'       value='L.P.O'   class='form-control input-sm'></div></div><div class="container">
  <div class="row">
 
  <div class="col-sm-3"><button type="submit" class="btn-info btn-sm"   id="deletebutton">SUBMIT</button> </div>
  <div class="col-sm-3"><button type="reset" class="btn-info btn-sm">RESET</button></div>
<div class="col-sm-3"></div>
  </div></div>
  
 

