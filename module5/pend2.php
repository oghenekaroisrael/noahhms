<?php
$con = mysqli_connect("localhost","root","","noahhms");

$ree = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 0 AND MONTH(date_paid) = ".date('m')."");

$ree2 = mysqli_fetch_assoc($ree);

$sum = $ree2['SUM(to_pay)'];

$ree3 = mysqli_query($con,"SELECT SUM(amount), to_pay FROM accounts WHERE payment_status = 2 AND MONTH(date_paid) = ".date('m')."");

$ree4 = mysqli_fetch_assoc($ree3);

$sum2 = $ree4['SUM(amount)'];

//Company Billing
$ree_com = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 3 AND MONTH(date_paid) = ".date('m')."");

$res_com = mysqli_fetch_assoc($ree_com);

$sum_com = intval($res_com['SUM(to_pay)']);

//Defer Payment
$ree_def = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 4 AND MONTH(date_paid) = ".date('m')."");

$res_def = mysqli_fetch_assoc($ree_def);

$sum_def = intval($res_def['SUM(to_pay)']);

if ($sum + $sum2 + $sum_com + $sum_def == 0) {
	echo "0.00";
}else{
	echo $sum + $sum2 + $sum_com + $sum_def;
}
?> 