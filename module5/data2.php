<?php
header('Content-Type: application/json');

$conn1 = mysqli_connect("localhost","root","","noahhms");

$sqlQuery = "SELECT SUM(amount) as amount FROM accounts  WHERE payment_status = 1 OR payment_status = 3";
$sqlQuery2 = "SELECT SUM(amt) as amount FROM daily_expense";

$result = mysqli_query($conn1,$sqlQuery);
$result2 = mysqli_query($conn1,$sqlQuery2);

$res = mysqli_fetch_assoc($result);
$res2 = mysqli_fetch_assoc($result2);

$data = array();

foreach ($res as $key) {
$dat = array_push($data, $key);
} 

foreach ($res2 as $key2) {
$dat = array_push($data, $key2);
} 

mysqli_close($conn1);

echo json_encode($data);
?>