<?php
$con = mysqli_connect("localhost","root","","noahhms");

$ree = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 3 AND MONTH(date_paid) = ".date('m')."");

$ree2 = mysqli_fetch_assoc($ree);

$sum = $ree2['SUM(to_pay)'];

if ($sum == 0) {
	echo "0.00";
}else{
	echo $sum;
}
?> 