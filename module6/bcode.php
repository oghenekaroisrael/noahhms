<?php
$a=1;
while ($a<=40) {
	$r = rand(100000,111111);
	$db = mysqli_connect("localhost","root","","coastal");
	mysqli_query($db,"UPDATE `prescription` SET `Stock_number` = '$r' WHERE `prescription_id` = $a LIMIT 1");
	$a++;
}

?>
