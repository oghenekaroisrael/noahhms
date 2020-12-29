<?php
$db = mysqli_connect("localhost","root","","noahhms");
$sql = mysqli_query($db, "SELECT * FROM lab_temps");
while ($get = mysqli_fetch_assoc($sql)) {
	$temp = $get['temp_name'];
	$find = array(" ",".");
	$replace = array("_","|");
	$temp_name = lcfirst(str_replace($find, $replace, $temp));
	$id = $get['id'];
	mysqli_query($db, "UPDATE `lab_temps` SET `temp_name` = '".$temp_name."' WHERE `lab_temps`.`id` = ".$id."");
}
?>