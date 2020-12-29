<?php
$con = mysqli_connect("localhost","root","","noahhms");
							
$ree = mysqli_query($con,"SELECT SUM(to_pay) as tp FROM accounts WHERE payment_status = 1 AND date_paid LIKE '%".date('Y-m-d')."%'");
							
$ree2 = mysqli_fetch_assoc($ree);
							
$sum = $ree2['tp'];
						
$res = mysqli_query($con,"SELECT SUM(amount) as am, SUM(to_pay) as tp FROM accounts WHERE payment_status = 2 AND date_paid LIKE '%".date('Y-m-d')."%'");

$res2 = mysqli_fetch_assoc($res);

$val2 = (intval($res2['tp'])) - (intval($res2['am']));

$sum2 = intval($sum) + intval($val2);							
if ($sum == 0) {
	echo "0.00";
}else{
	echo number_format($sum2);
}

?> 
