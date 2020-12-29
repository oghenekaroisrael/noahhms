<?php 

$a = 0;
$db = mysqli_connect("localhost","root","","noahhms");

while (($a++) != 1) {
$link = uniqid();
$c = mysqli_query($db,"UPDATE `patients` SET `front_desk` = '".$link."' WHERE `id` = ".$a."");
if ($c) {
	$b .= "Done ".$a.",<br>";
}else{
	$b .= "Not Done ".$a.",<br>";
}
}
echo $b;
?>