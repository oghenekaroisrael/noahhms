<?php
$con = mysqli_connect("localhost","root","","noahhms");

$ree = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 0 AND date_paid LIKE '%".date('Y-m-d')."%'");

$ree2 = mysqli_fetch_assoc($ree);

$sum = $ree2['SUM(to_pay)'];

$ree3 = mysqli_query($con,"SELECT SUM(amount), to_pay FROM accounts WHERE payment_status = 2 AND date_paid LIKE '%".date('Y-m-d')."%'");

$ree4 = mysqli_fetch_assoc($ree3);

$sum2 = $ree4['SUM(amount)'];

//Company Billing
$ree_com = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 3 AND date_paid LIKE '%".date('Y-m-d')."%'");

$res_com = mysqli_fetch_assoc($ree_com);

$sum_com = intval($res_com['SUM(to_pay)']);

//Defer Payment
$ree_def = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 4 AND date_paid LIKE '%".date('Y-m-d')."%'");

$res_def = mysqli_fetch_assoc($ree_def);

$sum_def = intval($res_def['SUM(to_pay)']);

// //Wave Payment
// $ree_def = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 5 AND date_paid LIKE '%".date('Y-m-d')."%'");

// $res_def = mysqli_fetch_assoc($ree_def);

// $sum_def = intval($res_def['SUM(to_pay)']);

if ($sum + $sum2 + $sum_com + $sum_def == 0) {
	echo "0.00";
}else{
	echo number_format($sum + $sum2 + $sum_com + $sum_def);
}
?> 