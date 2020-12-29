<?php
header('Content-Type: application/json');

$conn1 = mysqli_connect("localhost","root","","noahhms");

$sqlQuery = "SELECT SUM(amount) as amount FROM accounts WHERE item = 9 AND payment_status = 0 OR payment_status = 5 OR payment_status = 4";
$sqlQuery2 = "SELECT SUM(amount) as amount  FROM accounts WHERE item = 8 AND payment_status = 0 OR payment_status = 5 OR payment_status = 4";
$sqlQuery3 = "SELECT SUM(amount) as amount  FROM accounts WHERE item = 5 AND payment_status = 0 OR payment_status = 5 OR payment_status = 4";
$sqlQuery4 = "SELECT SUM(amount) as amount  FROM accounts WHERE item = 3 AND payment_status = 0 OR payment_status = 5 OR payment_status = 4";
$sqlQuery5 = "SELECT SUM(amount) as amount  FROM accounts WHERE item = 2 AND payment_status = 0 OR payment_status = 5 OR payment_status = 4";

$res = mysqli_query($conn1,$sqlQuery);
$res2 = mysqli_query($conn1,$sqlQuery2);
$res3 = mysqli_query($conn1,$sqlQuery3);
$res4 = mysqli_query($conn1,$sqlQuery4);
$res5 = mysqli_query($conn1,$sqlQuery5);

$data = array();

foreach ($res as $key) {
$data[] = $key;
} 

foreach ($res2 as $key2) {
$data[] = $key2;
} 

foreach ($res3 as $key3) {
$data[] = $key3;
} 

foreach ($res4 as $key4) {
$data[] = $key4;
} 

foreach ($res5 as $key5) {
$data[] = $key5;
} 



mysqli_close($conn1);

echo json_encode($data);
?>