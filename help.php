<?php 
@session_start();
$user=$_SESSION['user'];
$password=$_SESSION['password'];
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
include_once("loggedstatus.php");
include_once("password.php");
@$date1=$_SESSION['date1'];@$date2=$_SESSION['date2'];
$x="SELECT * FROM users  WHERE  name='$user' AND password='$password'";
$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
if(mysqli_num_rows($x)>0){}
else{ $_SESSION['message']="ACCESS  DENIED"; header("LOCATION:accessdenied4.php");exit;}
?>
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>LAWASCO  BILLING SOFTWARES</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"   href="bootstrap/scss/bootstrap.min.css" />
  <link rel="stylesheet"  href="stylesheets/scrolltable.css" />
<link rel="stylesheet"  href="stylesheets/tables.css" /><link rel="stylesheet"  href="stylesheets/dashboard.css" />
  <style type="text/css">
    @media print{tbody{ overflow:visible;}}
  @media print{ button{display:none;} #checknone{display:none;} #checkall{display:none;};  }
  @media print { select{display:none;} #searchtext{display:none;}}
#levelchart{ width:80%;}
#newuser{ width:98%; margin-right:1%;margin-left:1%; border-radius:3%;}
#userdetails{
  overflow-y: scroll;      
  height: 480px;            //  <-- Select the height of the body
  width: 90%; margin-right:10%; 
  position: absolute;
}

#message{ width:50%;border-radius:3%; margin-right:20%; margin-left:20%}
#results{ font-size:90%;}.dropdown-menu{ overflow-y: scroll; height: 300%;        //  <-- Select the height of the body
   position: absolute;
}
#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
  </style>
  	<style>
	#idnumber-list{float:left;list-style:none;margin:0;padding:0;width:100%;}
#idnumber-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#idnumber-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} 
#header{ background-color: #80DCF0; height:400px; }
.dropdown-menu{ overflow-y: scroll; height: 300%; width:100%;       //  <-- Select the height of the body
   position: absolute;
}

#dashboard{
  overflow-y: scroll;      
  height: 80%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}

	#zoneheader1{ -webkit-box-reflect: below 2px
			 -webkit-linear-gradient(bottom, white, transparent 40%, transparent); 
			   text-shadow: 0 1px 0 #ccc,
               0 2px 0 #c9c9c9,
               0 3px 0 #bbb,
               0 4px 0 #b9b9b9,
               0 5px 0 #aaa,
               0 6px 1px rgba(0,0,0,.1),
               0 0 5px rgba(0,0,0,.1),
               0 1px 3px rgba(0,0,0,.3),
               0 3px 5px rgba(0,0,0,.2),
               0 5px 10px rgba(0,0,0,.25),
               0 10px 10px rgba(0,0,0,.2),
               0 20px 20px rgba(0,0,0,.15);font-family:"Comic Sans MS";
			 
			 }		 
	 .btn-group{ box-shadow: 10px 10px 10px #000000;padding:2%; }	
#idnumber-list
{
	 overflow-y: scroll;      
  height: 90%;            //  <-- Select the height of the body
  width: 100%;
  position: absolute;
}
	</style>
  <script   src="pluggins/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" >
  $(document).ready(function(){
   $('[data-toggle="popover"]').popover(); 
   $("#zonesearch").submit(function(){
$.post( "zonesearch.php",
$("#zonesearch").serialize(),
function(data){
$("#content").load("message.php #content"); $('#message').modal('show'); 

return false;});
return false;
})

$("#loaddetails").click(function()
{
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
$("#slip").load("accountsummary2.php #slip2");
});  return false;
 return false;
})

  $("#loadslip").click(function()
{
	var x=$("#actionx").val();    
$.post( "accountdetails.php",
$("#accountstatus").serialize(),
function(data){$("#acstatus").load("accountsummary2.php #details");
if(x !='CONNECTED'){$("#slip").load("accountsummary2.php #slip2"); return false;}
else if(x =='CONNECTED'){$("#slip").load("accountsummary2.php #slip3"); return false;}
return false;});  return false;
 return false;
})



$("#accountstatus").submit(function(){
  var x=$("#actionx").val();    
	 if((x =='CONP')||(x=="COR"))
   {
	var x=confirm("CLIENT TO BE BILLED ");   
	 if(x ==false){return false; }  
   }
   
	
	$('#prepostmessage').modal('show');
$.post( "accountstatussummary.php",
$("#accountstatus").serialize(),
function(data){
$("#content").load("message.php #content");
$('#prepostmessage').modal('hide'); $('#message').modal('show'); 

return false;});
return false;
})


var $rows = $('.filterdata');
$('#searchtext').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

  })
  
  </script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body   onLoad="noBack();"    oncontextmenu="return false;"  >
<div class="container">
  <!-- Trigger the modal with a button -->
   <button class="btn-info btn-sm" onClick="window.print()">PRINT</button>  
  
 
 <input type="text" class="form-control input-sm" id="searchtext" placeholder="Type to search" autosearch="off">

    <!-- Modal -->
  </div>
  <div class="container" id="tablecontainer">
  <div class="row">
  
  </div>
  </div> 
 

<form id="results" method="post" action="editusers.php">
<h4   style="text-align:center"><strong>HELP MODULE </strong></h4>
 <table    class=" table table-hover">
	  
        <!--DWLayoutTable-->
        <thead>
          <tr>
            <td  class="theader"  width ="15%"  height="21" valign="top" >MODULE	  </td>
			 <td  class="theader"   width ="15%"  height="21" valign="top" >UNIT</td> 
			 <td  class="theader"   width ="70%"  height="21" valign="top" >HELP</td>            
			   
          </tr>
        </thead>
        <tbody>
      <tr class='filterdata'>
                <td   width ='15%'  >LOGGIN</td>
                <td   width ='15%'   >LOGGIN</td>
                <td  width ='70%' >
				<ol>
				<li>Open the browser (prefferably Opera  or  Google Chrome browser)</li>
				<li>Type the  server address  at the   address bar (eg http://127.0.0.1)</li>
				<li>Loggin  page   will show up (if not check with the system admin )  </li>
				<li>Select the  company to  logg into </li>
				<li>Select the  zone (double click to load  the zones select options)</li>				
				<li>Enter accredited user name and password </li>
				<li>default password is 123456 (for first time logging or when password has been reset )</li>
				</ol>
				</td> 
		
           </tr>
		   
		       <tr class='filterdata'>
                <td   width ='15%'  >LOGGIN</td>
                <td   width ='15%'   >CHANGE ZONE</td>
                <td  width ='70%' >
				<ol>
				<li>CLICK THE  ZONE BUTTON  AND  SELECT  THE  NEW  ZONE  AND SUBMIT TO RESET THE  ZONE  </li>
				
				</ol>
				</td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >Administrator module</td>
                <td  width ='70%' >
				<ol> 
				<li>go to dashboard &rArr;admin</li>
				<li>the units are new user to create a  new user  and give them  rights to  access different  modules  within  the system  </li>
				<li>reset  password  which  allows you  to  reset  users  passwords</li>
				<li>delete user where  the selected  users are deleted</li>
				<li>to  delete  edit  or  reset  password select the  action within the  user rights table  and submit the selected users </li>
				<li>if  you  want to  re-asign  other rights or  reset  password select  edit  and submit   a  new  window  will load with the  user where you can  change th  user name and  re asign  new right to the  selected  user  then submit to make the  changes  effect</li>
				</ol>
				</td> 
		
           </tr>
		 <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >new User</td>
                <td  width ='70%' >
				<ol>
				<li>go to dashboard &rArr;admin&rArr;user admin&rArr;new user</li>
				<li>Click new user button to feed the new user details</li>
				<li>Enter  the user name and select all the rights the  user  needs (5 and above alphanumeric characters)</li>
				<li>Click submit  and the new user  has been created </li>
				<li>the new user will loggin with their user names and the  default password (123456)  </li>
				<li>When new user loggin for the first time they get a window asking them  to enter their  new password </li>
				<li>Then confirm the  password and submit (5 and above alphanumeric characters)</li>
				<li>Loggin afresh with the new  password</li>
				<li>Incase  you  loose your  passsword  or  your account has been compromised contact the system  admin to reset your  password </li>
				</ol>
				
				</td> 
		
           </tr>
<tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >Reset password</td>
                <td  width ='70%' >
				<ol>
				<li>go to dashboard &rArr;admin&rArr;user admin</li>
				<li>select the users whose password  is to be reset </li>
				<li>in the action select reset password and submit to reset the  selected users password</li>
				<li>the password  is  reset to default password</li>
				</ol>
				</td> 
		
           </tr>
<tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >Edit users</td>
                <td  width ='70%' >
				<ol>
				<li>go to dashboard &rArr;admin&rArr;user admin</li>
				<li>In edit users the admin can change  user  name and re-assign  new  user  rights to the selected user</li>
				</ol></td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >SUSPEND ACCOUNT</td>
                <td  width ='70%' >
				<ol>
				<li>go to dashboard &rArr;admin&rArr;user admin&rArr;Suspend account</li>
				<li>If an  account  is  suspended  the account  cant  access the  system  </li>
				<li>Select the  accounts to  be suspended  then  click  submit  </li>
				</ol></td> 
		
           </tr>
		   <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >ACTIVATE ACCOUNT</td>
                <td  width ='70%' >
				<ol>
				<li>go to dashboard &rArr;admin&rArr;user admin&rArr;Activate account</li>
				<li>If an  account  is  activated  the account  can  access the  system  </li>
				<li>Select the  accounts to  be activated then  click  submit  </li>
				</ol></td> 
		
           </tr>
		   <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >Delete users</td>
                <td  width ='70%' >
				<ol>
				<li>go to dashboard &rArr;admin&rArr;user admin</li>
				<li>Check the user  to  delete </li>
				<li>Then Sekect  Delete  and submit to  delete</li>
				</ol></td> 
		
           </tr>
<tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >AUDIT TRAIL</td>
                <td  width ='70%' >
				<ol><li>go to dashboard &rArr;admin&rArr;audit trail</li>
				<li>audit trail allows you  to do auditing  on all activities done within  the system along with the date and time  the task  was executed  </li>
				<li>the trail can be  filtered  based  on  dates go to audit trail &rArr;trail then  set the  date  range  and submit </li>
				<li>click on the  table listed  and  it will download the table data which can  be stored off the system eg  portable harddisk </li>
				</ol>
				</td> 
		
           </tr>
	   <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >FINANCE ARCHIVE</td>
                <td  width ='70%' >
				<ol>
				<li>Go to dashboard &rArr;admin&rArr;Finance archive </li>
				<li>This module enables you to clear old financial related transactions but retain the current Balance as a single entry </li>
				<li>The old financial related data  is sent to the archive and can be accessed if needed</li>
				<li>This modules helps  to clear outdated transactions yet retain its current balance</li>
				<li>This can be  used incase  of  start  of  a new financial year or period</li>
				<li>Also this can be  usefull in case the  system processess data slowly due to  data accumulation for a long time</li>
				</ol></td> 
		
           </tr>
		   
		   	   <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >Back up database</td>
                <td  width ='70%' >
				<ol>
				<li>go to dashboard &rArr;admin&rArr;Backup Database</li>
				<li>Click the  backup database button </li>
				<li>Click on the  table(s) to  download the backup files</li>
				<li>Save the downloaded files in the archives</li>
				</ol></td> 
		
           </tr>
		      <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >VIEW PRODUCTION METER </td>
                <td  width ='70%' ><ol>
				<li>Go to dashboard &rArr;admin&rArr;Production</li>
				<li>Close the  New  production meter form and the  production meters will be  displayed and their details  </li>
				</ol> </td> 
		
           </tr>
		   	       <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >PRODUCTION METER REPORTS   </td>
                <td  width ='70%' ><ol>
				<li>Go to dashboard &rArr;admin&rArr;Production</li>
				<li>Close the  New  production meter form  Click  View reports Then enter the  date  ranges  and and submit</li>
				<li>The  Reports  of  previous  production  Meter billing report will be displayed</li>
				
				</ol> </td> 
		
           </tr>
		     <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >VIEW PRODUCTION METER BILLS   </td>
                <td  width ='70%' ><ol>
				<li>Go to dashboard &rArr;admin&rArr;Production</li>
				<li>Close the  New  production meter form  Click  View reports Then enter the  date  ranges  and and submit</li>
				<li>The  Reports  of  previous  production  Meter billing report will be displayed</li>
				
				</ol> </td> 
		
           </tr>
		   
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >DELETE PRODUCTION METER </td>
                <td  width ='70%' ><ol>
				<li>Go to dashboard &rArr;admin&rArr;Production</li>
				<li>Close the  New  production meter form and the  production meters will be  displayed and their details  </li>
				<li>Select the  production meter to  be deleted  and  in the  action select option select delete  and click submit button which  will delete the  selected  Production meters  </li>
				</ol> </td> 
		
           </tr>
		   
	   <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >ENTER NEW PRODUCTION METER READINGS </td>
                <td  width ='70%' ><ol>
				<li>Go to dashboard &rArr;admin&rArr;Production</li>
				<li>Close the  New  production meter form and the  production meters will be  displayed and their details  </li>
				<li>Select the  production meter to  be updated readings  and  in the  action select option select update readings  and click submit button which  will load the  production  Meters  details    </li>
				<li>Enter the  new  Readings  and submit to  enter  the  new  production  meter readings </li>
				</ol> </td> 
		
           </tr>
		    <tr class='filterdata'>
                <td   width ='15%'  >ADMINISTRATOR MODULE</td>
                <td   width ='15%'   >TASKS AUTOMATION  </td>
                <td  width ='70%' ><ol>
				<li>Go to dashboard &rArr;admin&rArr;Task automation</li>
				<li>This is a  module which enables  some tasks to  run indipendently without any human  interaction   </li>
				<li>Check the tasks to automate then check start radio button and click submit after this the selected tasks will run independently so you can close that window and continue with  other tasks    </li>
				<li>The automated tasks will run  in the entire server so all companies automated tasks will run concurrent  </li>
				<li>Incase you want  to stop  the automted tasks  folow the  above  procedure but  on  the final part  dont  click start radio button  but  click stop radio button  and submit  ALL THE AUTOMATED TASKS WILL STOP </li>
				<li>The automated tasks are </li>
				<ol>
				<li>SENDING SMS</li>
				<li>SENDING EMAILS</li>
				<li>BALANCE INQUIRY</li>
				<li>PROCESS PAYMENT SLIPS</li>
				<li>BACKUP THE ENTIRE DATABASE (EVERY 8 HRS)</li>
				</ol>
				</ol> </td> 
		
           </tr>
		   
		   		   <tr class='filterdata'>
                <td   width ='15%'  >COMPANY ADMIN MODULE</td>
                <td   width ='15%'   >VIEW COMPANY</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;admin&rArr;Company admin</li>
				<li>Company table will display all the zones in the  company</li>
				</ol>
				</td> 
		
           </tr>
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >COMPANY ADMIN MODULE</td>
                <td   width ='15%'   >CREATE NEW COMPANY</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;admin&rArr;Company admin</li>
				<li>Click the new zone button then enter the new Company name and submit to create the new Company</li>
				</ol>
				</td> 
		
           </tr>
		    <tr class='filterdata'>
                <td   width ='15%'  >COMPANY ADMIN MODULE</td>
                <td   width ='15%'   >DELETE COMPANY</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;admin&rArr;Company admin</li>
				<li>Company table will display all the  companies</li>
				<li>select the Company to delete then click submit button to  delete them</li>
				</ol>
				</td> 
		
           </tr>

   <tr class='filterdata'>
                <td   width ='15%'  >ZONE ADMIN MODULE</td>
                <td   width ='15%'   >VIEW ZONE</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;admin&rArr;zone admin</li>
				<li>zones table will display all the zones in the  company</li>
				</ol>
				</td> 
		
           </tr>
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >ZONE ADMIN MODULE</td>
                <td   width ='15%'   >CREATE NEW ZONE</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;admin&rArr;zone admin</li>
				
				<li>Click the new zone button then enter the new zone number and submit to create the new zone</li>
				</ol>
				</td> 
		
           </tr>
		    <tr class='filterdata'>
                <td   width ='15%'  >ZONE ADMIN MODULE</td>
                <td   width ='15%'   >DELETE ZONE</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;admin&rArr;zone admin</li>
				<li>zones table will display all the zones in the  company</li>
				<li>select the zones to delete then click submit button to  delete them</li>
				</ol>
				</td> 
		
           </tr>
		   
		   

		   
		 <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT CODES MODULE</td>
                <td   width ='15%'   >VIEW PAYMENT CODES</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;payment codes</li>
				<li>Payment codes table will display all the payment codes</li>
				</ol>
				</td> 
		
           </tr>
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT CODES MODULE</td>
                <td   width ='15%'   >CREATE PAYMENT CODE</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;payment codes</li>				
				<li>Click the new New payment code button then enter the new payment code details  and submit to create the new payment code</li>
				</ol>
				</td> 
		
           </tr>
		    <tr class='filterdata'>
               <td   width ='15%'  >PAYMENT CODES MODULE</td>
                <td   width ='15%'   >DELETE PAYMENT CODE</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;payment codes</li>	
				<li>Payment codes table will display all the payment codes</li>
				<li>select the payment codes to delete then click submit button to  delete them</li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT MODULE</td>
                <td   width ='15%'   >VIEW BANK SLIPS</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;payment slips</li>
				<li>Select the Accounts Zone  and the  date  range</li>
				<li>submit  and then  the  bank slips will be  loaded</li>
				</ol>
				</td> 
		
           </tr>
	  <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT MODULE</td>
                <td   width ='15%'   >DELETE BANK SLIPS</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;payment slips</li>
				<li>Select the Accounts Zone  and the  date  range</li>
				<li>submit  and then  the  bank slips will be  loaded</li>
				<li>Check the  slips  to be deleted  and select  delete action and submit </li>
				</ol>
				</td> 
		
           </tr>
		   
		   	  <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT MODULE</td>
                <td   width ='15%'   >EDIT BANK SLIPS</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;payment slips</li>
				<li>Select the Accounts Zone  and the  date  range</li>
				<li>submit  and then  the  bank slips will be  loaded</li>
				<li>Check the  slip  to be Edited  and select  edit action and submit </li>
				<li>Details  of the  slip  will be loaded  change the details and finally submit</li>
				</ol>
				</td> 
           </tr>
		   
	   	  <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT MODULE</td>
                <td   width ='15%'   >NEW BANK SLIPS</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;payment slips</li>
				<li>Click  THE  NEW BANK SLIP button</li>
				<li>Enter the  new slip  details  and  submit  </li>
								</ol>
				</td> 
           </tr>
		   
		     <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT MODULE</td>
                <td   width ='15%'   >LINK SLIPS</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;link slips</li>
				<li>Click  THE  LINK SLIPS  button</li>
				<li>Enter the  transaction details of the slip to link to the account  </li>
				<li>click on the transactions details text box to  load the selected transaction details</li>
				<li>Enter the account to be linked to the transaction<li>
				
								</ol>
				</td> 
           </tr>
		   
		   
		   
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT MODULE</td>
                <td   width ='15%'   >UPLOAD BANK SLIPS</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;upload slips</li>
				<li>Select the wateraccounts.txt file</li>
				<li>Ensure the  columns follow the correct format  </li>
				<li>the arrangement is transactioncode amount account depositdate paymentcode </li>
				<li>Submit it and the file data will be uploaded </li>
				<li>The uploaded file  data cn  be seen at  the bank slips table below </li>
				<li>The process ID  is  the  unique  ID  to  identify the  uploaded files  data </li>
								</ol>
				</td> 
           </tr>
		      <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT MODULE</td>
                <td   width ='15%'   >BANK-API</td>
                <td  width ='70%' ><ol>
				<li>This enables one to   process bank transactions which have been posted through the  bank API</li>
				<li>Go to  Dashboard &rArr;payment&rArr;upload slips</li>
				
				<li>Click the BANK-API button </li>
				<li>The bank transactions will be  posted  immedietly  </li>
				<li>Let the  window open so  as bank transactions can be  processed on real time  </li>
				</ol>
				</td> 
           </tr>
		      
			      <tr class='filterdata'>
                <td   width ='15%'  >PAYMENT MODULE</td>
                <td   width ='15%'   >DELETE BANK SLIPS</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;payment&rArr;upload slips</li>
				<li>Select the $wateraccounts.txt file</li>
				<li>Ensure the  columns follow the correct format  </li>
				<li>the arrangement is transactioncode amount account depositdate paymentcode </li>
				<li>Submit it and the file data will be uploaded </li>
								</ol>
				</td> 
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >REPORTS  MODULE</td>
                <td   width ='15%'   >PRINT BILL</td>
                <td  width ='70%' >
				<ol>
				<li>go to dashboard &rArr;BILLING&rArr;PRINT BILL</li>
				<li>enter the account number  and  submit  </li>
				<li>the current  month bill will be generated</li>
				<li>print it</li>
				</ol>
				</td> 
		
           </tr>
	   <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >FULLSTATEMENT REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Fullstatement</li>
				<li>Show all activities directly affecting the financial status of  a  paticular account </li>
				<li>the activities include <ol><li>New account creation </li><li>Billing account history </li><li>All Bank Deposits history</li><li>Connection and Reconnection history</li></ol></li>
				<li>The activities are arranged chronologically based  on date of  activity</li>
				<li>also  how the account  is  affected financially  is  displayed </li>
				<li>To choose the  account  click account  and  enter the  account number and submit</li>
				</ol>
				</td> 
		
           </tr>

	<tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >MINISTATEMENT REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Ministatement</li>
				<li>Show all activities directly affecting the financial status of  a  paticular account  within the dates range </li>
				<li>the activities include <ol><li>New account creation </li><li>Billing account history </li><li>All Bank Deposits history</li><li>Connection and Reconnection history</li></ol></li>
				<li>The activities are arranged chronologically based  on date of  activity   with dates range</li>
				<li>also  how the account  is  affected financially  is  displayed </li>
				<li>To choose the  account  click account  and  enter the  account number  and the  date  range  and submit</li>
				</ol>
				</td> 
		
           </tr>
<tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >ARCHIVED STATEMENT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Archived statement</li>
				<li>Show all (archived) activities directly affecting the financial status of  a  paticular account  within the dates range </li>
				<li>the activities include <ol><li>New account creation </li><li>Billing account history </li><li>All Bank Deposits history</li><li>Connection and Reconnection history</li></ol></li>
				<li>The activities are arranged chronologically based  on date of  activity   with dates range</li>
				<li>also  how the account  is  affected financially  is  displayed </li>
				<li>To choose the  account  click account  and  enter the  account number  and the  date  range  and submit</li>
				</ol>
				</td> 
		
           </tr>
	<tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >MONTHLYSTATEMENT REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Monthlystatement</li>
				<li>Show all activities directly affecting the financial status of  a  paticular account  within the selected month </li>
				<li>the activities include <ol><li>New account creation </li><li>Billing account history </li><li>All Bank Deposits history</li><li>Connection and Reconnection history</li></ol></li>
				<li>The activities are arranged chronologically based  on date of  activity   within the selected month</li>
				<li>also  how the account  is  affected financially  is  displayed </li>
				<li>To choose the  account  click account  and  enter the  account number  and the  Month  and submit</li>
				</ol>
				</td> 
		
           </tr>

		   
		   <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >DUE BILLING REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Due billing report</li>
				<li>Due billing report shows accounts  whose billing is long overdue </li>
				</ol>
				</td> 
		
           </tr>
		   <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >METERBOOK  REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Manual billing report</li>
				<li>Manual billing report shows accounts and their last  readings </li>
				<li>It enables user to generate a sheet to  manually  enter new meter readings</li>
				<li>Click on the ACRANGE button  and  choose your the  Account Zone and  Submit</li>
				</ol>
				</td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >ACCOUNT CURRENT STATUS </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Account current status</li>
				<li>This report gives the current  status  of  accounts  in  a  given zone </li>
				<li>It shows  the  last bill and the balance brought foward  in the  current month </li>
				<li>Select  the  Zone  and submit to load the  report</li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		   	   <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >WATER FLOW REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Waterflow report</li>
				<li>This report gives the water produced against the water consumed in a given period  in the   entire company </li>
				<li>The given period is from one month to another month</li>
				<li>Click view reports  then  select the  months  range and submit to  get the  report</li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		   	   <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >ACC BAL DISTRIBUTION REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Acc Bal Distribution report</li>
				<li>This report gives the billed (Debit)against  Paid (Credit) amount at a paticular date for the whole company or zones or accounts  in  a given  zone  </li>
				<li>Click view reports  then  select the  date and the search criteria and submit to  get the  report</li>
				</ol>
				</td> 
		
           </tr>
		   
		     	   <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >WATER SALES  REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Waterflow distribution report</li>
				<li>This report gives the  water consumed in a given period  in the   entire company  or per zones in a given period of  time</li>
				<li>The given period is from one month to another month</li>
				<li>Click view reports  then  select the  months  range and submit to  get the  report</li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		         <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >BILLS  DISTRIBUTION REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Bills  distribution  report</li>
				<li>This report shows  the different category  of  Bills (Water and non water)    in  a given period in the   entire company  </li>
				<li>To  filter the  report click  view report  and enter the period to  get the report and the report coverage and  submit </li>
				<li>Click close button  to  view the  filtered Bills distribution report</li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >REVENUE  DISTRIBUTION REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Revenue  distribution  report</li>
				<li>This report shows  the different category  of  revenue  generated  in  a given period in the   entire company  </li>
				<li>To  filter the  report click  view report  and enter the period to  get the report and the report coverage and  submit </li>
				<li>Click close button  to  view the  filtered revenue distribution report</li>
				</ol>
				</td> 
		
           </tr>
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'>   BANKING REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Banking report</li>
				<li>This report shows  the  bank transactions  either uploaded from  wateraccounts.txt file or  through the  Banking A.P.I  </li>
				<li>To search for  a slip  click  on the search slip button and then feed the  slip details to  search for the  slip(s)</li>
				</ol>
				</td> 
		
           </tr>
		       <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'>ARCHIVED   BANKING REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Archived  Banking report</li>
				<li>This report shows  the  bank transactions which  have been  archived  </li>
				<li>To search for  a slip  click  on the search slip button and then feed the  slip details to  search for the  slip(s)</li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'>   PROCESS BANK SLIPS </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Banking report</li>
				<li>This show  bank transactions which have not  been processed for some reasons eg    </li>
				<ol><li>No client account to  link  in  all the companies</li></ol>
				<li> The unprocessed transactions have  an enabled checkbox </li>
				<li>Select the  bank slips to  process and click submit to  process them</li>
				<li>the  processed bank slip will not be  posted to the client account hence it doesnt affect the current balance of the client account</li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		   
		       <tr class='filterdata'>
                <td   width ='15%'  >REPORTS MODULE</td>
                <td   width ='15%'   >ACCOUNT STATUS REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Account status report</li>
				<li>This report gives the accounts tally using different search mode in all the entire company  </li>
				</ol>
				</td> 
		
           </tr>
		   
		    <tr class='filterdata'>
                <td   width ='15%'  >ANNUAL  REPORTS MODULE</td>
                <td   width ='15%'   > </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Annual Reports </li>
				<li>This is  a module  which has different types  of  annual reports which are divided   into four quoters annually  </li>
				<li>To view the report select the  annual report  type Go to  Dashboard &rArr;Annual Reports &rArr; select report  type </li>
				<li>Select the starting date and choose the range  of  report  you  want either 1st,2nd 3rd  or  4th quoter report and submit to load  the report</li>
				<li>At the bottom  of the  report their  is a download button click  it to  download the report in  C.S.V file format</li>
				</ol>
				</td> 
		
           </tr>
		   
		    <tr class='filterdata'>
                <td   width ='15%'  >ANNUAL  REPORTS MODULE</td>
                <td   width ='15%'   >CHLORINE  REPORT </td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Annual Reports &rArr;Chlorine report</li>
				<li>This report of how chlorine has been  used annually  </li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >JOBS TICKET MODULE</td>
                <td   width ='15%'   >JOB TICKETS</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Jobs tickets</li>
				<li>This enables us to  keep  a  track  record  of  customer  complains and the staff responce to them </li>
				<li>After loading the  jobs tickets from the dashboard one sees all the  pending jobs</li>
				<li>the table shows  <ol><li>the client detais client complaints/concerns</li>
				<li>the complain category/class</li>
				<li>staff asigned to attend to the complain</li>
				<li>date of  complain reporting and  its  ticket  number</li>
				</ol> </li>
				</ol></td> 
		
           </tr>
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >JOBS TICKET MODULE</td>
                <td   width ='15%'   >NEW TICKET</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Jobs tickets&rArr;New ticket</li>
				<li>This enables  us to  generate  a job  tiket  of a client  complain/concern</li>
				<li>Enter the  clients  account number,the  type  of the  complain  and the  complain  and  submit</li>
				<li>Choose whether the ticket will be  posted as an  sms or email to the  client</li>
				<li>then  a ticket  number  is  generated  which  is  used to  track  the  complain and  its  responce time </li>
				</ol></td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >JOBS TICKET MODULE</td>
                <td   width ='15%'   >DELETE JOB TICKET </td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Jobs tickets</li>
				<li>from the  action select  delete and  check the  tickets  to  delete and submit to  delete</li>
				</ol></td> 
		
           </tr>
	  <tr class='filterdata'>
                <td   width ='15%'  >JOBS TICKET MODULE</td>
                <td   width ='15%'   >ASSIGN JOB TICKET </td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Jobs tickets</li>
				<li>This enables  to  assign job tickets to  staffs  to  respond to those complains</li>
				<li>Enter  the  staff name  in the second textbox on top  of the  tickets table  select assign  action  and  check  the  tickets tyo  assign  and  finally submit to assign </li>
				<li>Th  assigned column should take the  name  of the  new  assigned  staff</li>
				</ol></td> 
		
           </tr>	   
	 <tr class='filterdata'>
                <td   width ='15%'  >JOBS TICKET MODULE</td>
                <td   width ='15%'   >POST  TICKET NUMBER</td>
                <td  width ='70%' ><ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Jobs tickets</li>
				<li>This enables  the  user to  generate  an  SMS of the  ticket  number to  the  client </li>
				<li>from the  action select  post ticket number  and  check the  tickets  to  post the  sms  and submit to generate SMS ready to  be  sent  to the  client</li>
				</ol></td> 
		
           </tr>	   
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >GEO MAPPING MODULE</td>
                <td   width ='15%'   >MAPPED ACCOUNTS</td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Geo mapping &rArr; Generate map</li>
				<li>This will show the  accounts  whose  coordinates  have been set/ mapped  accounts </li>
				<li>Click the  search  accounts  and  filter  accounts  from  the  mapped  accounts </li>
				</ol>
				</td> 
		
           </tr>
		   
		    <tr class='filterdata'>
                <td   width ='15%'  >GEO MAPPING MODULE</td>
                <td   width ='15%'   >GENERATE MAP</td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Geo mapping &rArr; Generate map</li>
				<li>Click Search  Ac  button to  filter the  accounts to  displayed  on the   map and submit  the  search  to  load the  accounts  from  filter and then close the window  </li>
				<li>This  table shows  only  accounts  which  have  already been  mapped  ie their  coordinates  have  been  set</li>
				<li>Select   the type  of  map to  generate</li>
				<li>Select the  accounts to  be  marked   on  the   map   and click  on the  submit button at the  bottom  of the  table</li>
				<li>Having  generated the    map   as  explained  above click  on the Download  map  button to  download the  map  to your  computer</li>
				<li>The file downloaded  is  called map.html so  open  it  using  browser  (opera/google chrome) and ensure  their  is  internet connectivity</li>
				<li>This will load  the  google  map with the  marked  accounts  displayed</li>
				</ol>
				</td> 
		
           </tr>
		        <tr class='filterdata'>
                <td   width ='15%'  >GEO MAPPING MODULE</td>
                <td   width ='15%'   >DISPLAY GEO MAPS</td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Geo mapping &rArr; Generate map</li>
				<li>Select the  mapped  accounts  to  generate their  geo maps and submit     </li>
				<li>To show the  map  ensure  their  is  internet connectivity ie it  be online  </li>
				<li>Click  on the Display Map  And the   map  is  displayed  </li>
				<li>Incase you  are to use the same map later just download it to access it  later </li>
				</ol>
				</td> 
		
           </tr>
		     <tr class='filterdata'>
                <td   width ='15%'  >GEO MAPPING MODULE</td>
                <td   width ='15%'   >DOWNLOAD GEO MAPS</td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Geo mapping &rArr; Generate map</li>
				<li>Select the  mapped  accounts  to  generate their  geo maps and submit     </li>
				
				<li>To show the  map  ensure  their  is  internet connectivity ie it  be online  </li>
				<li>Click  on the Download Map  And the   map  is  downloaded in  html format  use browser  to  open  it </li>
				<li>The  map  is  now  downloaded  in your machine  so  you  dont  need to  download  it again</li>
				<li>Ensure the map page can  access  internet  to  load the  google  maps</li>
				<li>if  the  mapped  area   is  cloudy the  maps  may be  invisible</li>
				</ol>
				</td> 
		
           </tr>
		  <tr class='filterdata'>
                <td   width ='15%'  >GEO MAPPING MODULE</td>
                <td   width ='15%'   >MAPPING ACCOUNTS</td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Geo mapping &rArr; Generate map</li>
				<li>this  is the  updating  of an  account coordinates</li>
				<li>click on the   mappings and  enter the  accout number ,the longitude and the  lattitude then submit </li>
				<li> if  you  dont  know  the  coordinates  download  any  map  with  a  location close to  the  area another  mapped  account  is  located</li>
				<li>After  loading the   map either  as  you  are  in the field  or  any where  with the   help   of the client  click on the  map on the location  of the  client premises</li>
				<li>as  you  click  on the   map to the   premises or  it's  proximity the coordinates will be  displayed  hence  you  can  enter the  coordinates  to map that   account</li>
				</ol>
				</td> 
		
           </tr>   
		   
		   	  <tr class='filterdata'>
                <td   width ='15%'  >INVENTORY MODULE</td>
                <td   width ='15%'   >INVENTORY REGISTRY</td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Inventory &rArr; Inventory</li>
				<li>This  is a module for controlling  the  flow of consumable items </li>
				<li>It show item  and their stock available</li>
				</ol>
				</td> 
		
           </tr>
		   
		    <tr class='filterdata'>
                <td   width ='15%'  >INVENTORY MODULE</td>
                <td   width ='15%'   >NEW ITEM /RESTOCK /UNSTOCK</td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Inventory &rArr; Inventory</li>
				<li>Click adjust inventory and enter the  new item details ie  name and quantity and check NEW ITEM  radio button  and submit </li>
				<li>Click adjust inventory and enter the   item to restock   and quantity and check RESTOCK  radio button  and submit to restock </li>
				<li>Click adjust inventory and enter the   item to unstock    and quantity and check UN-STOCK  radio button  and submit to unstock </li>
				</ol>
				</td> 
		
           </tr>
		   
		    <tr class='filterdata'>
                <td   width ='15%'  >INVENTORY MODULE</td>
                <td   width ='15%'   >DELETE ITEM</td>
                <td  width ='70%' >
				<ol>
				<li>Go to  Dashboard &rArr;Reports &rArr;Inventory &rArr; Inventory</li>
				<li>Check the  items to  delete and  submit to  delete   </li>
				</ol>
				</td> 
		
           </tr>
		   
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   > NEW ACCOUNT</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;New account</li>
				<li>This enables  you  to create  a  new  account  for the  client</li>
				<li> A form  to  feed  the new  client  details  is  loaded   then  feed the  data  and submit to  create  it  as  a  new  acount </li>
				
				</ol>	
				
				</td> 
		
           </tr>
		     	   <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   > VIEW ACCOUNTS</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;View accounts</li>
				<li>Enter the  filter details  and  submit to  get  the  accounts  filtered </li>
						
				</ol>	
				
				</td> 
		
           </tr>
		   
		   
		   	   <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   > EDIT ACCOUNT</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;Edit account</li>
				<li>Enter the  account  number  for the  account to  be edited </li>
				<li>Close that  window and the  account  details will have been loaded  if that  account exists  in  the database</li>
				<li>Edit  the  account details and submit the form </li>
				<li>One  can't change  meter details ,account number  and  account coordinates   in this module</li>
				
				</ol>	
				
				</td> 
		
           </tr>
		   
		   	   <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   > MULTI EDIT</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;Multi edit</li>
				<li>This  is a module allowing one to  do several type  of  changes on the accounts  which  may also  have  effect on  different  modules </li>
				<li>The  features are</li>
				<ol>
				<li>Update meter number &rArr;This enables  one to  enter  a new meter  which  has no  meter  installed  </li>
				<li>Update Account number &rArr;This enables  one to  enter  a new account number  </li>
				<li>New meter readings &rArr;This enables  one to  enter  a new meter readings  </li>
				<li>Update class &rArr;This enables  change the class  </li>
				<li>Account adjustment &rArr;This enables  one to add  figure to user bill (ACC ADJUSTMENTS) eg  opening  balance </li>
				</ol>
				<li>Edit  the  account details and submit the form </li>
				<li>One  can't change  meter details ,account number  and  account coordinates   in this module</li>
				
				</ol>	
				
				</td> 
		
           </tr>
		   
		      	   <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   > ACCOUNT TRANSFER</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;Account transfer</li>
				<li>This  is a module allows one transfer a given account to  a new account </li>
				<li>Click the account button enter the current accouunt nd enter the  new account number to  the  New account  number textbox</li>
				
				<li>Click to  check  if  the transfer will happen </li>
				<li>Hinderancce  of  account transfer</li>
				<ol>
				<li>If the current (old) account has a unpaid  water bill or non water bill </li>
				<li>If the  new account  number has been  asigned to  another account  in the same or different zone</li>
				<li>If the  new account  number has been  asigned to  another meter number   in the same or different zone</li>

				</ol>
				<li>If validated the old  account  details will be loaded  hence do the  necessary changes and submit to effect the changes </li>
				</ol>	
				
				</td> 
		
           </tr>
		   
		   
		   
		        	   <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   > DELETE ACCOUNTS</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;View accounts</li>
				<li>Enter the  filter details  and  submit to  get  the  accounts  filtered </li>
				<li>Select the  accounts to  delete  and  in the top select  option  chhose  delete and submit to delete the  accounts </li>		
				<li>Before delete the  accounts  ensure their bills  and  payment slips  have been  deleted and its been  disconnected from  their  meters  in the  meters  registry</li>
				</ol>	
				
				</td> 
		
           </tr>
		   
   <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   > Edit  meter number</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;Edit meter number</li>
				<li>This enables change  the  meter number  of  an  account</li>
				<li>Click ac range button  and choose the zone  then  submit to  load the  acounts  and their  meter  numbers in  a  new table</li>
				<li>Enter  the  new  meternumber and submit to  update the   meter  numbers </li>
				<li>Ensure the  meter  number  entered  is  registered  in  the  meter  registry  and  its  not allocated to  any  other account </li>
	
				</ol>	
				
				</td> 
		
           </tr>
		   
		    <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   >ADVANCED REG SEARCH</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;Advanced reg search</li>
				<li>This modules enables on  to  search for an account  or  a  meter in the  entire company</li>
				<li>Click on the accounts details and a window  pops up where you feed the search details  ie  account number  or meternumber </li>
				<li>Then  select  if you are to  search for  the  account  or  meter number   </li>
				<li>Then select  if  you are to  search  from  the account  registry  or the  meter registry </li>
				<li>Click  submit  and the  meter or  account details you submitted   will be  display </li>
				<li>If  you check  the accounts/meters and click submit the accounts/meters will be deleted depending  on the  registry you searched data from </li>
					<li>If you  delete from  the  meters registry  the  meter will be  deleted but the  account  will be retained</li>
					<li>If you delete  from the accounts registry the account  will be  deleted but the  meter retained  in the  meter registry  with  no  account number  linked to  it</li>
				</ol>	
				
				</td> 
		
           </tr>
		   
		   
		   
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >REGISTRY MODULE</td>
                <td   width ='15%'   >ACCOUNTS TRAIL</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Registry &rArr;Accounts trail</li>
				<li>This modules show all none water related tasks executed  to  a given account(s)</li>
				<li>The tasks include</li>
				<ol>
				<li>New Account creation</li>
				<li>New Account connection</li>
				<li>Meter conection </li>
				<li>Meter changes</li>
				<li>Accounts CONP</li>
				<li>Accounts COR</li>
				<li>Acounts reconnection</li>
				<li>Delete Account</li>
				</ol>
				<li>To delete a task  select DELETE  and check on the tasks to  delete and  click submit to delete  </li>
	
				</ol>	
				
				</td> 
		
           </tr>
		   
		   
		   
		   
<tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >NEW METER REGISTRY</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Meter Registry</li>
				<li>This enables one to enter  a new client meter  into  the  meter  registry</li>
				<li>To Enter new meter Click New meter  button  and Enter the  new  meter details   and submit </li>
				
				</ol>	
				</td> 
		
           </tr>

<tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >SEARCH METER REGISTRY</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Meter Registry</li>
				<li>This enables one to search  for  client meters within the meter  registry</li>
				<li>To  enter the  filter   Click Search meter  button  and Enter the  filter details    and submit </li>
				<li>The  meters  details will be  loaded  and displayed   </li>
				</ol>	
				</td> 
		
           </tr>
		   
		   
<tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >LINK METERS</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Meter Registry</li>
				<li>This enables one link an account to a given  meter which  hasnt been  linked to  any account </li>
				<li>Click  link meter button then  a window  pops  up  enter the account number  from the  displayed options  </li>
				<li>Then select  the  meter to  link  it  to  and submit   </li>
				<li>Both the   meter number  and the account should  be  in the same zone</li>
				
				</ol>	
				</td> 
		
           </tr>
		   
	<tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >UNREGISTERED ACCOUNTS</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Unregistered Account </li>
				<li>This show  the accounts  whose Meter number  isnt  in  their  zonal meter registry </li>
				<li>By  Checking  them  And submitting  one delinks them  from  those  meter numbers and their  meter number reads not  installed </li>
				
				
				</ol>	
				</td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >UPDATE  METER STATUS</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Meter Registry</li>
				<li>This enables one to change the  meter current status</li>
				<li>To  change the meter status  select the status   and then  check the  accounts to  change the  status  and submit </li>
				<li>Summary  of the status details   </li>
				<ol>
				<li>UNINSTALL this is  disconnecting the  meter to any account  hence free to  install it to  a new account</li>
				<li>STOLEN  this is  used to show the  meter  has been  stolen  though  still linked to the  same  account  if  any </li>
				<li>MALFUNCTION this  is  to  set the  meter being  destroyed or vandeerlized   </li>
				<li>FUNCTION this  is to set the  meter  functioning well </li>
				<li>DELETE  this  is to delete the  meter (It must first  hve been UNINSTALLED from  any account to be  deleted ) </li>
				</ol>
				</ol>	
				</td> 
		
           </tr>
		   
<tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >EDIT CLIENT METER DETAILS</td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Meter Registry</li>
				<li>Using search filter search for the  meter  then  select the  meter  and select edit  on the action options</li>
				<li>Submit form then checked meter details will be loaded </li>
				<li>Update the  meter details and submit the form  to update the  new  details   </li>
				</ol>	
				</td> 
		
           </tr>
	<tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >UNINSTALL CLIENT METER </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Meter Registry</li>
				<li>This enables  one to de link  a paticular  client  meter  from  a given account  hence one  can  re asign it to  a   new  acount  number</li>
				<li>Using search filter search for the  meter  then  select the  meter  and select uninstall on the action options</li>
				<li>Submit form then checked meter will be delinked from the  account it  was previosly installed at </li>
				</ol>	
				</td> 
		
           </tr>
		<tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >DELETE CLIENT METER </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Meter Registry</li>
				<li>One  must ensure the  client meter to  be deleted  its  not installed to  any  of the  accounts</li>
				<li>This enables  one to delete  a paticular  client  meter  from  the meter registry</li>
				<li>Using search filter search for the  meter  then  select the  meter  and select delete on the action options</li>
				<li>Submit form then checked meter will be deleted  from the  meter registry</li>
				</ol>	
				</td> 
		
           </tr>	
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >METER REGISTRY MODULE</td>
                <td   width ='15%'   >METER TRAIL </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Meter Registry &rArr;Meter trail</li>
				<li>This is a report  showing  different  activities executed to  a paticular  Meter   in a given  period  of time   </li>
				<li>Click search meter button  then  enter  the  meter number and the  date ranges  and submit to  generate the  report </li>
				
				</ol>	
				</td> 
		
           </tr>	
		   

<tr class='filterdata'>
                <td   width ='15%'  >SMS/EMAILS MODULE</td>
                <td   width ='15%'   >EDIT CONTACTS </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Send SMS/EMAILS &rArr;Edit contacts </li>
				<li>A window  will show you the  zones  and choose the  zones  from  which  the account  is  located and submit</li>
				<li>All the  accounts  in the  selected zone will be  loaded now  on top  of that table choose whether to  edit  the email  address  or the  mobile/cell phone  number </li>
				<li>Enter the  new  contact to  their corresponding  accounts  and submit to update their  new  contacts </li>
				<li>Also  one can  go to  registry module and edit the contacts  of the  selected  account  </li>
				</ol>	
				</td> 
		
           </tr>

<tr class='filterdata'>
                <td   width ='15%'  >SMS/EMAILS MODULE</td>
                <td   width ='15%'   >VIEW SMS/EMAILS </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Send SMS/EMAILS &rArr;View Sms/Emails </li>
				<li>This will show  you  all the  sms/emails  which  have been posted and they  are  pending to  be  sent to  the  clients  </li>
				<li>One  can  check  the Sms/Email  to  be deleted  before  sending  it to the  client  and  when  you  click the  submit button after  checking the Sms/Emails to  be  deleted the Sms/Emails will be deleted  and not  sent to the  client </li>
				
				</ol>	
				</td> 
		
           </tr>

<tr class='filterdata'>
                <td   width ='15%'  >SMS/EMAILS MODULE</td>
                <td   width ='15%'   >CUSTORM SMS/EMAILS </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Send SMS/EMAILS &rArr;Custorm Sms/Emails </li>
				<li>This Enables  one to  send a user  defined  message  to  custormers  either as  an  Email  or  as  an  Sms   </li>
				<li>Click  search Account button  and  a window  pops up  allowing  one to filter the  accounts  one  needs  to send the custorm  Sms/Email  then  click  submit to load the  filtered  accounts </li>
				<li>type  the  message  on the  text  area  written  "type  the  message here"</li>
				<li>Then select  Email  or  SMS in the Select  Contact type  option</li>
				<li>check  on the  accounts to  recieve the typed  message </li>
				<li>Ensure the selected  account  has got  an  email  address  or  phone  contact  depending  on the  kind  of  message you  are posting </li>
				<li>Submit the Entries  and themessage  will be  posted waiting to  be  sent to  the  client</li>
				</ol>	
				</td> 
		
           </tr>

<tr class='filterdata'>
                <td   width ='15%'  >SMS/EMAILS MODULE</td>
                <td   width ='15%'   >BILLING SMS/EMAILS </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Send SMS/EMAILS &rArr;Billing Sms/Emails </li>
				<li>This Enables  one to  send monthly bill   message  to  custormers  either as  an  Email  or  as  an  Sms   </li>
				<li>Click  search ACS RANGE button  and  a window  pops up  allowing  one to select the  zones  one  needs  to send the bill  Sms/Email  then  click  submit to load the  filtered  accounts </li>
				<li>Select the  contact type Email/Sms and then check the  accounts to  post the  billing  mesage and submit to  post the   message</li>
				<li>Ensure the selected  account  has got  an  email  address  or  phone  contact  depending  on the  kind  of  message you  are posting </li>
				
				</ol>	
				</td> 
		
           </tr>
		  
 
		    <tr class='filterdata'>
                <td   width ='15%'  >SMS/EMAILS MODULE</td>
                <td   width ='15%'   >BALANCE INQUERY </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;Send SMS/EMAILS &rArr;Balance Inquery </li>
				<li>This a  module enables one to  process balance inquery emails      </li>
				<li>It displays the  inqueries which  have  been recieved and are waiting to  be  processed  </li>
				<li>Click EMAILS-SMS-A.P.I button to process incoming emails </li>
				<li>After clicking  the inbox  emails will be  processed  and  an SMS showing current account balance  is  set to  be  sent to  the  client </li>
				<li>NB All the pending sms will also be sent  because the sms sending module will be activated</li>
				
				</ol>	
				</td> 
		
           </tr>
		   


<tr class='filterdata'>
                <td   width ='15%'  >BILLING MODULE</td>
                <td   width ='15%'   >PRINT BILL </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;BILLING &rArr;PRINT BILL </li>
				<li>This  Enables one to  print current account  status bill   </li>
				<li>Enter the Account number  of the bill to be  printed and  click  submit  button </li>
				<li>The Account current   bill will be  displayed  and  can  be  printed and  issued to the customer </li>
				</ol>	
				</td> 
		
           </tr>

<tr class='filterdata'>
                <td   width ='15%'  >BILLING MODULE</td>
                <td   width ='15%'   >BILLING </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;BILLING &rArr;Billing </li>
				<li>This  enables one to  enter new   bill details to  a  client  account  </li>
				<li>Search  account  window pops up  so  enter the  acount  number to  load the  acount  details  to  enter the  new bill </li>
				<li>In the  billing mode   </li>
				<ol><li>System billing  is the  actual billing to  the  selected account</li>
				<li>User units billing allows the  user to  set a  paticular  unit  (water consumtion) which  can be  used to bill that  account </li>
				<li>Reset  last reading allows one to  change the  meter reading  before  entering  a  new  bill  in the  selected account </li>
				</ol>
				<li>NEW READING/USER AVG UNITS  this  allows you  to enter the units to  feed  for the  options selected billing mode</li>
				<li>Reading  date  enter the  date  when the  new billing  happened </li>
				</ol>	
				</td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >BILLING MODULE</td>
                <td   width ='15%'   >MULTI BILLING </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;BILLING &rArr;MULTI BILLING </li>
				<li>This  enables one to  enter new   bill details to  a  client  account like billing module but  this allows  one to  bill multiple accounts  at once  </li>
				<li>A  window  pops up  which  allows you  to enter  minimum account  and  maximum  account if  not  displayed   click AC RANGE button  and the  window  will be  displayed </li>
				<li>Enter the minimum and  maximum  account and submit to load the  selected accounts  details   then click close to hide the account search  pop up  window  </li>
				<li></li>
				</ol>	
				</td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >BILLING MODULE</td>
                <td   width ='15%'   >FIELD BILLING </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;BILLING &rArr;Billing </li>
				<li>This  enables one to  enter new   bill details to  a  client  account also it  allows one to upload the billed meter image </li>
				<li>Search  account  window pops up  so  enter the  acount  number to  load the  acount  details  to  enter the  new bill </li>
				<li>In the  billing mode   </li>
				<ol><li>System billing  is the  actual billing to  the  selected account</li>
				<li>User units billing allows the  user to  set a  paticular  unit  (water consumtion) which  can be  used to bill that  account </li>
				<li>Reset  last reading allows one to  change the  meter reading  before  entering  a  new  bill  in the  selected account </li>
				</ol>
				<li>NEW READING/USER AVG UNITS  this  allows you  to enter the units to  feed  for the  options selected billing mode</li>
				<li>Reading  date  enter the  date  when the  new billing  happened </li>
				<li>Attach the  image  in the  imager  upload input  and submit  it to enter  the  new bill  </li>
				</ol>	
				</td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >BILLING MODULE</td>
                <td   width ='15%'   >BILLS SUMMARY </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;BILLING &rArr;BILLS SUMMARY </li>
				<li>This  shows  water bills  of  a paticular account for a given period of time   </li>
				<li> Click Accounts details button and the window pops up  enter the  account  number and  the date range and submit  </li>
			
				</ol>	
				</td> 
		
           </tr>
		  <tr class='filterdata'>
                <td   width ='15%'  >BILLING MODULE</td>
                <td   width ='15%'   >BILLS REPORT </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;BILLING &rArr;BILLS REPORT </li>
				<li>This  shows  water bills  of  a several accounts  for a given period of time   </li>
				<li> Click Ac-date range buton   and the window pops up  enter the  account range  and  the date range and submit  </li>
			
				</ol>	
				</td> 
		
           </tr>

		  <tr class='filterdata'>
                <td   width ='15%'  >BILLING MODULE</td>
                <td   width ='15%'   >NON WATER BILLS  </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;BILLING &rArr;NON WATER BILLS </li>
				<li>This  shows  non water bills  of  a several accounts  for a given period of time   </li>
				<li> Click Ac-date range buton   and the window pops up  enter the  account range  and  the date range and submit  </li>
			<li>Enter new non water bill</li>
			<ol><li>Click new bill then  enter the  account number and then select the  non water bill  type  then submit</li>
			<li>Some  of the non water bills need  not to  be  entered from  the  new non water bill because they are entered  in different  modules they  include</li>
			<ol><li>COR , CONP , NEW CONNECTION </li></ol>
			</ol>
				</ol>	
				</td> 
		
           </tr>
		
	<tr class='filterdata'>
                <td   width ='15%'  >BILLING MODULE</td>
                <td   width ='15%'   >UPLOAD BILLS </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;BILLING &rArr;MULTI BILLING&rArrBILLS UPLOAD </li>
				<li>This  enables one  to upload bills into the selected zone  </li>
				<li>Click on the  layout button  to   see the  columns arrangement  </li>
				<li>  Click on bills upload button then  search for the billsupload.txt file then click the upload file button</li>
				</ol>	
				</td> 
		
           </tr>
		   
		   
		   	<tr class='filterdata'>
                <td   width ='15%'  >DEBT MANAGEMENT  MODULE</td>
                <td   width ='15%'   >DEBT MANAGEMENT </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;DEBT MANAGEMENT &rArr;DEBT MANAGEMENT </li>
				<li>This  enables one   monitor  the payment  of large debts by clients and the  terms  of the agreement of the  same  </li>
				<li>Click  debt management    and  you  will see  the clients who are  currently  in the  debt registry   </li>
				</ol>	
				</td> 
		
           </tr>
		   
		      	<tr class='filterdata'>
                <td   width ='15%'  >DEBT MANAGEMENT  MODULE</td>
                <td   width ='15%'   >DEBT REGISTRY </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;DEBT MANAGEMENT &rArr;DEBT MANAGEMENT </li>
				<li>This  enables one   to  register  a new  client  into the  debt registry module   </li>
				<li>Click  debt  registry  and  enter the account  number  and submit   </li>
				<li>The system  will  load the  pending  bill balance  if  any after computation</li>
				<li> Enter the period and the monthly  installment  and submit to register the  new debt balance</li>
				<li>Incase of  any payment done after debt registration the system  computes the current monthly  bill and deducts  it from  the  payment done any suplus payment is classified as debt payment </li>
				<li>The extra amount  is  registered  in the  debt statement </li>
				<li>The system updates the current  debt status after every   payments</li>
				</ol>	
				</td> 
		
           </tr>
		   
		   <tr class='filterdata'>
                <td   width ='15%'  >DEBT MANAGEMENT  MODULE</td>
                <td   width ='15%'   >VIEW STATEMENT </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;DEBT MANAGEMENT &rArr;DEBT MANAGEMENT </li>
				<li>This  enables one   to view debt payment  history of a given debt  </li>
				<li>Select view statement at the  top of debt registry table then  check the checkbox of the debt and  submit  to  view it's statement</li>
				<li>This will display how  the  installments have been paid  for the  selected debt</li>
				</ol>	
				</td> 
		
           </tr>
		   
		      <tr class='filterdata'>
                <td   width ='15%'  >DEBT MANAGEMENT  MODULE</td>
                <td   width ='15%'   >DELETE DEBT </td>
                <td  width ='70%' >
			<ol>
				<li>Go to  Dashboard &rArr;DEBT MANAGEMENT &rArr;DEBT MANAGEMENT </li>
				<li>This  enables one   to delete a debt registered in a debt registry   </li>
				<li>Select delete debt  at the  top of debt registry table then  check the checkbox of the debt and  submit  to  delete it from the debt registry</li>
				</ol>	
				</td> 
		
           </tr>
		   
		   
<tr class='filterdata'>
                <td   width ='15%'  >CHAT</td>
                <td   width ='15%'   >CHAT </td>
                <td  width ='70%' >
			<ol>
				<li>Click the  gray button  labelled chat and the chat  window will pop up </li>
				<li>Once  you logg off then the chat history is  deleted</li>
				<li>Click Refresh button to  load  new  users  who  are  online currently</>
				</ol>	
				</td> 
		
           </tr>
<tr class='filterdata'>
                <td   width ='15%'  >MOBILE VERSION</td>
                <td   width ='15%'   >MOBILE VERSION </td>
                <td  width ='70%' >
			<ol>
			<li>This  is a smaller version  of the  entire system  </li>
				<li>It works when hand held devices  are used to  access the system  (480pixcells or less)   </li>
				<li>It can peform  the following functions </li>
				<ol><li>View and search registry (limited data displayed)</li>
				<li>Meter registry module</li>
				<li>Field billing option</li>
				<li>Image archives module</li>
				<li>Print bill</li>
				<li>Show ministatement </li>
				<li>Geo Mapping module</li>
				</ol>
				</ol>	
				</td> 
		
           </tr>		   
        </tbody>
		
      </table>
</form>
 <form class="modal fade" id="zonesearch" role="dialog" method="post"  action="zonesearch.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"><div class="modal-header">
  <div class="container">
  <div class="row">
  <div class="col-sm-8">
<div>
<select class="form-control input-sm"  id="loadedzone"  name="loadedzone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select>
        </div>
		<div>
    <input type="hidden"/>
        </div><br>
<br>
<button type="submit" class="btn-info btn-sm" >SUBMIT</button><button type="reset" class="btn-info btn-sm">RESET</button> <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="procedureclose">CLOSE</button>
  </div><div class="col-sm-4"></div></div></div></div></div></div></div>
  </form>
<?php   include_once("dashboard3.php"); include_once("chat.php");?>
<form class="modal fade" id="accountstatus" role="dialog" method="post"  action="accountstatussummary.php">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content">
<div class="container">
  <div class="row">
  <div class="col-sm-8" >
 <div id="accountdetails"><br>
  <select class="form-control input-sm"  id="loadedzone"  name="zone" required="on" >
<option value=''>SELECT  ZONE  FROM <?php  print $company;?></option>
<?php 
$x="SELECT * FROM zones";
		$x=mysqli_query($connect,$x)or die(mysqli_error($connect));
		if(mysqli_num_rows($x)>0)
		{
		
		 while ($y=@mysqli_fetch_array($x))
		{  	
print "<option value='".$y['number']."'>".$y['zone']."</option>";	
		}}

?>
    </select>
	<br>
	ACCOUNT NUMBER<a href="#" title="INFO" data-toggle="popover" data-trigger="hover" data-content="ENTER  ACCOUNT"  title="eleven digits" data-placement="bottom">
<input  style='text-transform:uppercase' name="account" type="text"  pattern="[0-9A-Za-z]{11}"  title="INVALID ENTRIES"   size="15" placeholder="ENTER ACCOUNT NO."  required="on"  class="form-control input-sm"     autocomplete="on" ></a><br />
</div>
<br>
<div id="acstatus">current status</div><br><input type="date"  name="date"  id="date"  class="form-control input-sm" required="on" ><br>
<br>
  <select class="form-control input-sm"  id="actionx" name="action" required="on" >
<option value=''>SELECT ACTION</option>
<option value='CONP'>CONP</option>
<option value='COR'>COR</option>
<option value='CONNECTED'>RE-CONNECTION</option>
<option value='FUNCTION'>FUNCTION</div>
<option value='MALFUNCTION'>MALFUNCTION</div>
<option value="STOLEN">STOLEN</option>
</select>
	
<br>

<div  id="slip"></div>
<br>
  <button type="submit" class="btn-info btn-sm" >SUBMIT</button>
  <button type="reset" class="btn-info btn-sm">RESET</button>
  <button type="button" class="btn-info btn-sm"  id="loaddetails">LOAD DETAILS</button>  
  <button type="button" class="btn-info btn-sm"  id="loadslip">LOAD SLIP</button>
  <button type="button" class="btn-info btn-sm" data-dismiss="modal" id="close2">CLOSE</button>

  </div>
    <div class="col-sm-4" > </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  
  <div class="modal fade" id="message" role="dialog">
  <div class="modal-dialog modal-lg"  >
  <div class="modal-content"><div class="modal-header"></div>
  <div class="container"  id="content"> </div></div></div>
  </div>
</body>
</html>
