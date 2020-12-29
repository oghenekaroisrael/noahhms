
<?php
$con = mysqli_connect("localhost","root","","noahhms");
							
$re = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 1 AND MONTH(date_paid) = ".date('m')."");
							
$re2 = mysqli_fetch_assoc($re);
							
$sum_i = $re2['SUM(to_pay)'];
						
$rs = mysqli_query($con,"SELECT SUM(amount) FROM accounts WHERE payment_status = 2 AND MONTH(date_paid) = ".date('m')."");

$rs2 = mysqli_fetch_assoc($rs);

$sum2_i = intval($rs2['SUM(amount)']);

$re3 = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 3 AND MONTH(date_paid) = ".date('m')."");
							
$re4 = mysqli_fetch_assoc($re3);
							
$sm4 = $re4['SUM(to_pay)'];

$re5 = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 4 AND MONTH(date_paid) = ".date('m')."");
							
$re6 = mysqli_fetch_assoc($re5);
							
$sm5 = $ree6['SUM(to_pay)'];	

if ($sum_i + $sum2_i + $sm4 + $sm5 == 0) {
	$total = 0;
}else{
	 $total = $sum_i + $sum2_i + $sm4 + $sm5;
}

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
	$remove = 0;
}else{
	$remove = $sum + $sum2 + $sum_com + $sum_def;
}

echo $total + $remove;
?> 

