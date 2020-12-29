
<?php
$con = mysqli_connect("localhost","root","","noahhms");
							
$ree = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 1 AND MONTH(date_paid) = ".date('m')."");
							
$ree2 = mysqli_fetch_assoc($ree);
							
$sum = intval($ree2['SUM(to_pay)']);

						
$res = mysqli_query($con,"SELECT SUM(amount) FROM accounts WHERE payment_status = 2 AND MONTH(date_paid) = ".date('m')."");

$res2 = mysqli_fetch_assoc($res);

$sum2 = intval($res2['SUM(amount)']);


$ree3 = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 3 AND MONTH(date_paid) = ".date('m')."");
							
$ree4 = mysqli_fetch_assoc($ree3);
							
$sum3 = intval($ree4['SUM(to_pay)']);


$ree5 = mysqli_query($con,"SELECT SUM(to_pay) FROM accounts WHERE payment_status = 4 AND MONTH(date_paid) = ".date('m')."");
							
$ree6 = mysqli_fetch_assoc($ree5);
							
$sum4 = intval($ree6['SUM(to_pay)']);

if ($sum == 0) {
	echo "0.00";
}else{
	echo $sum2 + $sum + $sum3 + $sum4 ;
}

?> 