<?php 

if(!empty($_POST["keyword"])) {
$result = scandir('uploads/photos');
if(!empty($result)) {
?>
<ul id="idnumber-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country; ?>');"><?php echo $country; ?></li>
<?php } ?>
</ul>
<?php } } ?>
